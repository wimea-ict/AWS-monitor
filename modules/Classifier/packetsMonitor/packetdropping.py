from database.retrieveQuery import packetRecord
from database.retrieveQuery import retrieveBiggestIdFromTable
from database.retrieveQuery import packetCluster
from database.retrieveQuery import retrieveQuery

from database.reportProblem import reportProblemMethod
from database.reportProblem import check_if_problem_existed

import datetime as dt
from datetime import datetime, date,time

#from sendmail import sendmail
from database.retrieveQuery import updateProblem
from database.retrieveQuery import retrieveStatus
from database.retrieveQuery import insertProblem


def packetDroppin(stationID,Nodetype):
    lastSeventeenRecords = packetRecord(stationID,Nodetype)
    problem = "Nothing"
    #this module sends alot of mail so adjusting it..
    #to send mail once but entailing the number of packet dropping occurences..
    #making use of a counter
    
    packetdropping_counter = 0 

    def minuteList(lastSeventeenRecords):
        new_lastSeventeenRecordsList = []
        #print(lastSeventeenRecords)
        if lastSeventeenRecords:
            for i in range(len(lastSeventeenRecords)-1):
                print(lastSeventeenRecords[i])
                try:
                    k = str(lastSeventeenRecords[i]).replace('(','').replace(')','').replace('\'','')#.replace(',','')
                    x = datetime.strptime(k,'%Y-%m-%d,%H:%M:%S,').minute
                    new_lastSeventeenRecordsList.append(x)
                except ValueError as error:
                    print(error)
                    #print("failed to covert")
        else:
            print("tuple has no values..") #should probably call reportProblemMethod if this ever happens

        print(new_lastSeventeenRecordsList) 
        return new_lastSeventeenRecordsList

    try:
        minList = minuteList(lastSeventeenRecords)
        #print(minList)
        #retrieving most common cluster
        cluster = packetCluster(stationID,Nodetype)
        minute = cluster[0][1][2]

        Problem = '9'#classificationID is 9 for packetdropping
        #print(minute)

        for i in range(len(minList)-1):
            difference = minList[i] - minList[i+1]
            if (int(difference) > int(minute)):
                #print("Packet dropping")
                problem = '9'#classificationID is 9 for packetdropping
                #normally we'd call reportProblemMethod right here but
                #that's what we're avoiding this time round 
                #so instead we increase the counter value
                #and also insert into the detectedAnalyserProblems directly too
                print(Nodetype+"............................................."+str(stationID))
                packetdropping_counter += 1
                result = retrieveStatus(stationID, problem, Nodetype,Value='-')
                if len(result) is 0:
                    #mycursor.execute("INSERT INTO DetectedAnalyzerProblems(Problem,stationID,NodeType,status) VALUES ('Packet dropping',"+str(stationID)+",'"+Nodetype+"','reported')")
                    #insertProblem(stationID, Nodetype, problem, 'reported')
                    insertProblem(stationID,Nodetype, problem, 'reported', Value='-')

                else:
                    if(type(result[0][2])!=float):
                        #id 7 is wrong date format 
                        check_if_problem_existed(stationID,'7',Nodetype,str(result[0][2]))      
                        status = result[0][0]
                        entry_id = result[0][1]
                        time_reported = result[0][2]
                        # get time since epoch, [0;19] slices upto 19th index of string to fit strp requirements
                        current_time = dt.datetime.now().timestamp()
                        print(stationID,str(Nodetype),type(current_time))
                        print(current_time, time_reported)
                       # gap = (current_time - time_reported)/ 3600
                        try:
                            gap = (current_time - time_reported)/ 3600
                            time_reported = dt.datetime.strptime(str(time_reported)[0:19], '%Y-%m-%d %H:%M:%S').timestamp()

                            if status == 'reported' and gap > 1 and gap < 2:

                                updateProblem('re-reported', entry_id)
                            
                            if status == 're-reported' and gap>2:

                                updateProblem('persistent', entry_id)

                        except TypeError as error:
                            print(error)
                    else:
                        reportproblem(stationID,'7', Nodetype, str(result[0][2]))
                   #reportProblemMethod(stationID,Nodetype,'Packet dropping')
            else:
                #else we have no packet dropping
                check_if_problem_existed(stationID, Problem, Nodetype,Value='-')

    except IndexError as err:
        print(err)           
    #print(packetdropping_counter)
    return problem, packetdropping_counter

#this is what stations module will call...
def packetDropping(stationID,Nodetype):
    prob, packetdropping_occurrences = packetDroppin(stationID,Nodetype)

  #  if prob == 'Packet dropping':
       #sendmail()

#this function should give us the occurences..
#and is called in retrieveQuery...
def occurences(stationID,Nodetype):
    prob, packetdropping_occurrences = packetDroppin(stationID,Nodetype)
    return packetdropping_occurrences

def TracePacket():

    sql = "SELECT `station_id` FROM `stations` WHERE `station_id` > 47 AND stationCategory='aws'" # > 49, #50
    stations_id_result = retrieveQuery(sql)
    result = stations_id_result[0]

    list_of_tables = ['GroundNode', 'SinkNode', 'TenMeterNode', 'TwoMeterNode']
    for stationID in result: #say48
    # print(stationID[0],"_______________#########################__________________")
        for table in list_of_tables: #Groundnode
            packetDropping(stationID[0],str(table))

# TracePacket()
