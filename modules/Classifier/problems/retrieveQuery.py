
#from database.connection import connection
from database.connection import mydb


import datetime


def retrieveQuery(sql):
  cursor = mydb.cursor()
  # Read records
  cursor.execute(sql)
  result = cursor.fetchall()
  #result = [item[0] for item in row]
  #result = cursor.fetchone()
  # finally:
  # connection.close()
  return [result]

def retrieveBiggestIdFromTable(stationID,table):
  ############################################
  cursor = mydb.cursor()
  #limit RTC to length of 19 to avoid corrupt RTCs
  sqlStatement = "select id, RTC_T from " +table+ " where stationID = " +str(stationID)+ " and char_length(RTC_T)=19 ORDER BY id  DESC limit 1"
  cursor.execute(sqlStatement)
  result = cursor.fetchall()
  return result


def retrieveRTCforTrend(stationID, table, biggestId):
  cursor = mydb.cursor()
  sqlStatement = "select RTC_T from " +table+ " where stationID = " +str(stationID)+ " and id != " +str(biggestId)+ " and char_length(RTC_T)=19 ORDER BY id  DESC limit 1000"
  cursor.execute(sqlStatement)
  result = cursor.fetchall()
  return result


def retrieveStatus(station_id,problem,Node):
  cursor = mydb.cursor()
  sqlStatement = " select status, id, when_reported,Value from DetectedAnalyzerProblems where (NodeType='"+Node+"' and stationID='"+str(station_id)+"') AND (Problem = '"+problem +"' and status != 'fixed') ORDER BY id  DESC"
  cursor.execute(sqlStatement)
  result = cursor.fetchall()
  return result

# def retrieveStatus2(id,problem,NodeType):
#   cursor = mydb.cursor()
#   sqlStatement = " select status, id, when_reported from DetectedAnalyzerProblems where stationID = " +str(id)+ " and NodeType = '"+NodeType+"' and Problem = '" + problem + "' and status != 'fixed' ORDER BY id  DESC"
#   cursor.execute(sqlStatement)
#   result = cursor.fetchall()
#   return result


######  
def retrieveProblemRequest(firstname):
  cursor = mydb.cursor(buffered=True)
  sqlStatement = "SELECT DetectedAnalyzerProblems.stationID as stationid, stations.StationName as name, stations.Location, DetectedAnalyzerProblems.Problem as problem, DetectedAnalyzerProblems.status as status,DetectedAnalyzerProblems.id as id, DetectedAnalyzerProblems.when_reported as when_reported,DetectedAnalyzerProblems.value as value, DetectedAnalyzerProblems.NodeType as NodeType  FROM DetectedAnalyzerProblems INNER JOIN stations ON DetectedAnalyzerProblems.stationID = stations.station_id ORDER BY id DESC"
  cursor.execute(sqlStatement)
  result = cursor.fetchone()
  result2 = "Problem identified in "+str(result[8])+"... "+str(result[3])

  if str(result[4]) == 'reported':
    result2 = "Dear "+str(firstname).replace('\'','').replace(']','').replace('[','')+  '\n' " AWS located at "+str(result[2])+", station with id "+str(result[0])+" has an issue in the "+str(result[8])+", Identified on "+str(result[6])+". This is the First report of this problem, "+str(result[3])+"." '\n' "Regards Admin."
  elif str(result[4]) == 're-reported':
    result2 = "Dear "+str(firstname).replace('\'','').replace(']','').replace('[','')+  '\n' "AWS located at "+str(result[2])+", station with id "+str(result[0])+" has an issue in the "+str(result[8])+", Identified on "+str(result[6])+". This is the second report of this problem, "+str(result[3])+"." '\n' "Regards Admin."
  elif str(result[4]) == 'persistent' :
    result2 = "Dear "+str(firstname).replace('\'','').replace(']','').replace('[','')+  '\n' "AWS located at "+str(result[2])+", station with id "+str(result[0])+" has an issue in the "+str(result[8])+", Identified on "+str(result[6])+". This problem is now persistent , "+str(result[3])+"." '\n' "Regards Admin."
         
  return result2    
  


##########
def contacts(location): 
  cursor = mydb.cursor(prepared = True)
  
  sqlStatement = "SELECT users.name as name,users.email as email, stations.Location as location FROM maillist INNER JOIN users ON maillist.userID = users.id LEFT JOIN stations ON maillist.stationID = stations.station_id WHERE status = 1 AND stationID = ?"
  cursor.execute(sqlStatement,(location,))
  result = cursor.fetchall()
  
  firstname = []
  emails = []

  #result2 = [a for a, in result]
 # a_contact = []
 # arraylen=len(a_contact)
  #for i in range(arraylen):

  for a_contact in result:
      #print(a_contact[0])
      firstname.append(str(a_contact[0].decode()))
      emails.append(str(a_contact[1].decode()))
      print(firstname)
      print(emails)
  return firstname, emails

#here
def packetRecord(stationID,NodeType):
  cursor = mydb.cursor()
  sqlstatement = "SELECT RTC_T FROM " +NodeType+ " WHERE stationID = "+str(stationID)+"  and char_length(RTC_T)=19 ORDER by id DESC LIMIT 7"
  cursor.execute(sqlstatement)
  result = cursor.fetchall()
  return result


def packetCluster(stationID,NodeType):
  cursor = mydb.cursor()
  sqlstatement = "SELECT id, cluster FROM ReportIntervalClusters WHERE stationID = " +str(stationID)+ " AND Node = '"+NodeType+"' ORDER by id DESC LIMIT 1"
  cursor.execute(sqlstatement)
  result = cursor.fetchall()
  return result


def v_IN2(stationID,NodeType):
  cursor = mydb.cursor()
  sqlstatement2 = "SELECT RTC_T, V_IN FROM "+NodeType+" WHERE stationID = "+str(stationID)+" AND char_length(RTC_T)=19 ORDER by id DESC LIMIT 1,1"
  cursor.execute(sqlstatement2)
  result = cursor.fetchall()
  return result

def v_AD1(stationID):
  cursor = mydb.cursor()
  sqlstatement2 = "SELECT V_AD1 FROM TenMeterNode WHERE stationID = "+str(stationID)+" ORDER by id DESC LIMIT 1"
  cursor.execute(sqlstatement2)
  result = cursor.fetchall()
  return result  

def recentV_in(stationID,NodeType):
  cursor = mydb.cursor()
  sqlstatement2 = "SELECT V_IN FROM "+NodeType+" WHERE stationID = "+str(stationID)+" ORDER by id DESC LIMIT 32"
  cursor.execute(sqlstatement2)
  result = cursor.fetchall()
  return result 



#here

#####THE FILE IS CALLED RETRIEVE QUERY BUT WE SHALL DO INSERET QUERIES IN HERE AS WELL
#

def insertProblem(stationID,NodeType, problem, status):
  cursor = mydb.cursor()
  sql = "INSERT INTO DetectedAnalyzerProblems (stationID,NodeType, Problem, when_reported,status) VALUES (%s, %s, %s,%s, %s)"
  time = datetime.datetime.now()
  val = (str(stationID),NodeType, problem, str(time), status)
  cursor.execute(sql, val)

  mydb.commit()


  ######
  # UPDATE QUERY
  #####

def updateProblem(status, entryID):
  mycursor = mydb.cursor()
  sql = "UPDATE DetectedAnalyzerProblems SET status = '" +status+  "' WHERE id = " + str(entryID)

  mycursor.execute(sql)

  mydb.commit()


######
# insert into changer tracker
######3
def insertIntoChangeTracker(stationID, time_of_last_running_analyzer, Node, change, time_range_when_change_occured):
  cursor = mydb.cursor()
  sql = "INSERT INTO ChangeTracker (stationID, time_of_last_running_analyzer, Node, change_in_minutes, time_range_when_change_occured) VALUES (%s, %s, %s, %s, %s)"
  time = datetime.datetime.now()
  val = (str(stationID),  time_of_last_running_analyzer, Node, change, time_range_when_change_occured)
  cursor.execute(sql, val)

  mydb.commit()


#################
# insert into ReportIntervalClusters
##################
def ReportIntervalClusters(stationID, Node, cluster):
  cursor = mydb.cursor()
  sql = "INSERT INTO ReportIntervalClusters (stationID, Node, time_of_last_running_analyzer, cluster) VALUES (%s, %s, %s, %s)"
  time = datetime.datetime.now()
  val = (str(stationID), Node,  time, cluster)
  cursor.execute(sql, val)

  mydb.commit()

def Oftenstationoff(stationID):
  cursor = mydb.cursor()
  sql = "SELECT COUNT(stationID) from DetectedAnalyzerProblems WHERE stationID = "+stationID+" and status = 'fixed'"
  cursor.execute(sql)
  results = cursor.fetchall()


  return results


