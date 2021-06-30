from database.retrieveQuery import retrieveBiggestIdFromTable
from database.retrieveQuery import v_IN2
from database.retrieveQuery import v_AD1
#from reportProblem import reportProblemMethod
from database.reportProblem import check_if_problem_existed
from database.retrieveQuery import recentV_in
from database.retrieveQuery import retrieveQuery
import datetime
import time
import numpy as np

from database.retrieveQuery import insertProblem

import datetime as dt
from datetime import datetime, date,time

#from sendmail import sendmail
from database.retrieveQuery import updateProblem
from database.retrieveQuery import retrieveStatus

#the aim of this module is to catch LOW POWER 
#basing on the V_IN values' averages from the database
#each of the nodes have different average voltage values 
#so we distinguish......


# #######################################3
#classification_id for low power is 4
#########################################

def reportproblem(stationID, classification_id, NodeType,Value):

    #if(state == 'power loss'):
    #classification_id='4'
    result = retrieveStatus(stationID, classification_id, NodeType,Value)
    print(len(result))

    if len(result) == 0:
            #mycursor.execute("INSERT INTO DetectedAnalyzerProblems(Problem,stationID,NodeType,status) VALUES ('Packet dropping',"+str(stationID)+",'"+Nodetype+"','reported')")
        insertProblem(stationID,NodeType, classification_id, 'reported', Value)

        print(stationID, NodeType, 'Low Power', 'reported')
    else:
        status = result[0][0]
        entry_id = result[0][1]
        time_reported = result[0][2]
        #print(entry_id)
        # get time since epoch, [0;19] slices upto 19th index of string to fit strp requirements
            
        time_reported = dt.datetime.strptime(str(time_reported)[0:19], '%Y-%m-%d %H:%M:%S').timestamp()
        current_time = dt.datetime.now().timestamp()
        gap = (current_time - time_reported)/ 3600



        if status == 'reported' and gap > 24 and gap < 48: 
            updateProblem('re-reported', entry_id)
            #sendmail()
        if status == 're-reported':

            #print(gap)
            if(gap > 48):
                updateProblem('persistent', entry_id)
                #sendmail()
       
    #else:
    #else we have no packet dropping
    #check_if_problem_existed(stationID,'Low Power')

def no_isolation(node, average):
    #this is implemented by nodesNoIsolation()
    status='No powerloss'

    if(node == 'TwoMeterNode'):
        if((average < 3.0)):
            status = 'power loss'
            #print(status)
            
    elif(node == 'TenMeterNode'):
        if((average < 3.4)):   #orignally calculated value was 4.425
            status = 'power loss'
            #print(status)
            
    elif(node == 'SinkNode'):
        if((average < 3.4)): #orignally calculated value was 4.140
            status = 'power loss'
            #print(status)
                                            
    elif(node == 'GroundNode'):
        if((average < 3.4)): #orignally calculated value was 3.968
            status = 'power loss'
            #print(status)
    return status

def checkV_in(result1,tenvAD):
    v_in1 = np.array(result1) 
    v_inArr = []
    vAD = []
    #append to v_inArr upto atleast 32 records 
    #if ((result1 == []) and (tenvAD == [])):
        #this is highly possible
        #print("vin and vAD null")
    if(tenvAD != []):
        vAD = tenvAD[0][0] 
    if result1 is not None:
        #here we try to convert strings to floats since we cant find an..
        #..average of strings
        for i in v_in1:
            if (type(i) != None) or ( i != 'null'):
                try: 
                    try:
                        v_inA = float(i)
                        v_inArr.append(v_inA)
                    except TypeError as error:
                        print(error)
                except ValueError as error:
                    print(error)        
            else:
                break
               
    return v_inArr,vAD

       


def poweroffMethod(stationID,NodeType):
    classification_id='4'
    result1 = recentV_in(stationID,NodeType)
    tenvAD = v_AD1(stationID)
    #checkV_in(result1,tenvAD)

    v_inArray = []
    isolation = []
    v_inArray,isolation = checkV_in(result1,tenvAD) 
   # print('check_vin', v_inArray)
    state = ""
    if (v_inArray is not None):
        trendstate, average_voltage = checkTrend(v_inArray) 
        if (isolation is None ):
            #if isolation is missing the classification id is 6
            #reportproblem(stationID,'6', NodeType, 'isolation')
            state = nodesNoIsolation(NodeType,trendstate,average_voltage)
            if state == 'power loss':
                reportproblem(stationID,'4', NodeType, '-')
            else:
                check_if_problem_existed(stationID, classification_id,NodeType,Value='-')

        else:
            #First check if the value was missing before 
            #check_if_problem_existed(stationID, '6',NodeType,'isolation')         
            state = nodes(NodeType,trendstate,average_voltage,isolation)
            if state == 'power loss':
                reportproblem(stationID,'4', NodeType, '-')
            else:
                check_if_problem_existed(stationID, classification_id,NodeType, Value='-')
   
        print(stationID,NodeType,trendstate,average_voltage,state)
           
                     
    return state    


    

#function to check the voltage trends and also average value
def checkTrend(arr):
    x = []
    y = []
    #3.700 is a default value slightly less than the twoMeterNode 
    #average value...
    #there's a possibility that the v_in comes in empty
    #we can't divide by zero and neither can we have average = 0.0
    average = 3.700
    for i in range(len(arr)-1):
        if((arr[i] < arr[i+1]) or (arr[i]==arr[i+1])):
            a = "increase"
            x.append(i)
            
        elif(arr[i] > arr[i+1]):
            b = "decrease"
            y.append(i)

    state = "average"

    if (len(x)>len(y)):
        state = "normal"
    else:
        state = "leakage"


    try:
        if len(arr) != 0:
            average = sum(arr) / len(arr)
            #print ("av",average)
            #print("trend",state)
    except UnboundLocalError as error:
        #once we catch this error... we keep average at 3.700
        #Setting average to global average of all nodes
        print(error)

    return state, average      


def nodes(node, trendState ,average,vAD):
    status = 'normal'
    
    if (vAD != []) and (vAD != 'null'):
        #print(node,stationID)
        
        if (float(vAD) > 0.02807):#this is the average V_AD1 value from the database
            #this would mean conditions are normal if V_AD1 is greater the average value
            if(node == 'TwoMeterNode'): #all values here are average v_in values
                if((average < 3.708) and (trendState == 'leakage')):
                    status = 'power loss'
                    #print(status)
               
            elif(node == 'TenMeterNode'):
                if((average < 3.9) and (trendState == 'leakage')): #originally value was 4.425 for tenmeternode
                    status = 'power loss'
                    #print(status)
               
            elif(node == 'SinkNode'):
                if((average < 3.9) and (trendState == 'leakage')):
                    status = 'power loss'
                    #print(status)
                                                
            elif(node == 'GroundNode'):
                if((average < 3.9) and (trendState == 'leakage')):
                    status = 'power loss'
                    #print(status)
                

        else:
            #conditions are different either its night time or cold
            #that means we expect leakages since we may not be charging 
            #hence disregarding leakages but maintaining our averages
           status = no_isolation(node,average)
               
    return status   

def nodesNoIsolation(node,trendState,average):
    #this is the function to call when V_AD1 is not present..
    #after noticing that a couple of reports come in without it....
    #makes use of the worst case scenario hence only checks.. 
    #...for averages
    status = "No Power Loss"
    status = no_isolation(node,average)

    return status   

def powerMtd():

    sql = "SELECT `station_id` FROM `stations` WHERE `station_id` > 47 AND stationCategory='aws'" # > 49, #50
    stations_id_result = retrieveQuery(sql)
    result = stations_id_result[0]

    list_of_tables = ['TenMeterNode', 'TwoMeterNode','GroundNode','SinkNode']
    for stationID in result: #say48
    # print(stationID[0],"_______________#########################__________________")
        for table in list_of_tables: #Groundnode
            poweroffMethod(stationID[0],str(table))

