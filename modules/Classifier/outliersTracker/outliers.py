#from outliers
# from outliers import smirnov_grubbs as grubbs

from database.connection import mydb
import outliersTracker.outcode as grubbs
from database.reportProblem import check_if_problem_existed
from database.reportProblem import reportProblemMethod
#from database.retrieveQuery import retrieveStatus
from database.retrieveQuery import retrieveQuery
#new

import mysql.connector
#import schedule
import numpy as np
#import warnings
import datetime
#import schedule
import time


mycursor = mydb.cursor()

def OutLiers(stationID,NodeType,valu):
    # Problem='5'#sensor values are below 
    # #print("_________________________________________________________________"+str(NodeType))
    mycursor.execute("SELECT id,"+valu+",stationID  FROM "+str(NodeType)+" WHERE "+valu+" AND stationID="+str(stationID)+" ORDER BY id DESC LIMIT 1000")

    gather=mycursor.fetchall()
    #arr1 = []
    arr = []
    #stationid=[]
    ##print("Searching For OutLiers..................")

#===================================CATCHING INCORRECT SENSOR VALUES==============================================================
    #sample elements per a particular node
    for x in gather:
        #arr1.append(x[0])
        ##print(x[])
        try:
            arr.append(float(x[1]))
            # print(x[1])
            # print(len(x[1]))
            # check_if_problem_existed(stationID,'8',NodeType,valu)
        except ValueError:
        	incoValue = valu+' \"'+(x[1])+'\"'
        	# classification ID 8 for incorect sensor values
        	# reportProblemMethod(str(stationID),NodeType, '8', incoValue)
        #stationid.append(x[2])

    data = np.array(arr)
    if data.size>0:

        g = grubbs.test(data, alpha=0.05)
        # print(data)
        # print(data)
        b=grubbs.two_sided_test_indices(data, alpha=0.05)
        ##print(b)
        list_of_non_outliers=[]
        #global parameter

        outOuliers_max=grubbs.max_test_outliers(data, alpha=.05)

        if outOuliers_max:
        	max_outlier=grubbs.max_test_outliers(outOuliers_max,alpha=.05)
        	# #print(data)
        	print(outOuliers_max[0], "  MAX", str(stationID),str(NodeType), '10')
        	sensorValue=valu+'  '+str(outOuliers_max[0])
        	reportProblemMethod(str(stationID),str(NodeType), '10', sensorValue)
            # #print(sensorValue+"   outOuliers_max")
        else:
            check_if_problem_existed(stationID,'10',NodeType,valu)

        outOuliers_min=grubbs.min_test_outliers(data, alpha=.05)
        #'5' sensor values are above range
        print(len(outOuliers_min),"min")

        if outOuliers_min:
        	min_outlier=grubbs.min_test_outliers(outOuliers_min,alpha=.05)
        	# #print(data)
        	print(outOuliers_min[0],"  MIN", str(stationID),str(NodeType), '5')
        	sensorValue=valu+'  '+str(outOuliers_min[0])
        	reportProblemMethod(str(stationID),str(NodeType), '5', sensorValue)
            # # #print(sensorValue+"   outOuliers_min")
        else:
            check_if_problem_existed(stationID,'5',NodeType,valu)





  # TwoMeterNodeParametrs={'T_SHT2X':'Temperature','RH_SHT2X':'Humidity'}#,'T':'Box Temp'}

  # TenMeterNodeParametrs={'V_A2':'WindDirection','V_AD1':'Isolation','V_A1':'Wind Speed'}#,/*'V_AD2':'Isolation','T':'Box Temp'}
  
  # SinkNodeParameters={' '}#,'T':'Box Temp'}
  
  # GroundNodeParameters={'V_A1':'Soil Moisture','T1':'Soil Temperature','P0_LST60':'Preciptation'}#,'T':'Box Temp'}
  


def Check4Outliers(stationID,NodeType):
    ##print(stationID)
    if NodeType == 'TwoMeterNode':
        print("")
        #T_SHT2X_col(stationID)
        OutLiers(stationID,NodeType,"T_SHT2X")
        #R_SHT2X_col(stationID)
        OutLiers(stationID,NodeType,"RH_SHT2X")
        
    elif NodeType == 'TenMeterNode':
        # OutLiers(stationID,NodeType,"WindSpeed")
        # V_A1(stationID)
        # #V_A2(stationID)
        # OutLiers(stationID,NodeType,"V_A2")
        # OutLiers(stationID,NodeType,"P0_LST60")
        # V_AD1(stationID)
        # #V_AD2(stationID)
        OutLiers(stationID,NodeType,"V_AD1")
        NodeType = 'TenMeterNode'


    elif NodeType =='GroundNode':
        # OutLiers(stationID,NodeType,"V_A1")
        OutLiers(stationID,NodeType,"T1")
        OutLiers(stationID,NodeType,"P0_LST60")
        # NodeType ='GroundNode'
       

def Outliers_main():
    sql = "SELECT `station_id` FROM `stations` WHERE `station_id` > 47 AND stationCategory='aws'" # > 49, #50
    stations_id_result = retrieveQuery(sql)
    result = stations_id_result[0]

    list_of_tables = ['GroundNode', 'SinkNode', 'TenMeterNode', 'TwoMeterNode']
    for stationID in result:
        #print(stationID[0],"_______________#########################__________________")
        for table in list_of_tables: #Groundnode
            Check4Outliers(stationID[0],str(table))
            # #print(str(table),stationID[0])




# ()
#V_AD1()
#G_V_A1()
#G_V_A2()

    # schedule.every(2).seconds.do(T_SHT2X_col)

    # schedule.every(2).seconds.do(V_A1)
    # schedule.every(2).seconds.do(V_A2)
    # schedule.every(2).seconds.do(V_AD1)
    # schedule.every(2).seconds.do(G_V_A1)
    # schedule.every(2).seconds.do(G_V_A2)






