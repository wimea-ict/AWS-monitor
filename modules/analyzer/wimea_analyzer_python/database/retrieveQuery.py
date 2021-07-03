
#from database.connection import connection
from database.connection import mydb

import time

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
  if problem =='Station_off':
      cursor = mydb.cursor()
      sqlStatement = " select status, id, when_reported,Value from DetectedAnalyzerProblems where (stationID='"+str(station_id)+"' AND Problem = '"+str(problem) +"' and status != 'fixed') ORDER BY id  DESC"
      cursor.execute(sqlStatement)

      result = cursor.fetchall()
      #print(result)
      return result
  else:
    cursor = mydb.cursor()
    sqlStatement = " select status, id, when_reported,Value from DetectedAnalyzerProblems where (NodeType='"+Node+"' AND stationID='"+str(station_id)+"' AND Problem = '"+str(problem) +"' and status != 'fixed') ORDER BY id  DESC"
    cursor.execute(sqlStatement)

    result = cursor.fetchall()
    #print(result)
    return result

######  


def retrieveStatusWithValue(station_id,problem,Node,Value):
  cursor = mydb.cursor()
  sqlStatement = " select status, id, when_reported,Value from DetectedAnalyzerProblems where (NodeType='"+Node+"' and stationID='"+str(station_id)+"') AND (Problem = '"+problem +"' and Value='"+Value+"' and status != 'fixed') ORDER BY id  DESC"
  cursor.execute(sqlStatement)

  result = cursor.fetchall()
  # print(result)
  return result


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
      ##print(a_contact[0])
      firstname.append(str(a_contact[0].decode()))
      emails.append(str(a_contact[1].decode()))
      #print(firstname)
      #print(emails)
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

def insertProblem(stationID,NodeType, problem, status,Value):
  cursor = mydb.cursor()
  sql = "INSERT INTO DetectedAnalyzerProblems (stationID,NodeType,Problem,when_reported,status,Value) VALUES (%s, %s, %s,%s, %s, %s)"
  time = datetime.datetime.now()
  val = (str(stationID),NodeType, problem, str(time), status, Value)
  cursor.execute(sql, val)

  mydb.commit()


  ######
  # UPDATE QUERY
  #####

def updateProblem(status, entryID):
  mycursor = mydb.cursor()
  timenow = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
  sql = "UPDATE DetectedAnalyzerProblems SET status = '"+status+"', when_fixed = '"+str(timenow)+"'  WHERE id = " + str(entryID)

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

def Oftenstationoff(stationID,table):
  epoch_time = ((time.time())/3600)
  since=epoch_time-(24*7)
  ##print(since)
  ##print(time.ctime(epoch_time))
  cursor = mydb.cursor()
  sql = "SELECT COUNT(stationID) from "+table+" WHERE stationID = "+stationID+" and `hoursSinceEpoch`>"+str(since)+" ORDER by id DESC "
  cursor.execute(sql)
  results = cursor.fetchall()


  return results

###################################
#GETTING SENSOR PARAMETERS
###################################
def getParameters(stationID,NodeType,sensor):
  cursor = mydb.cursor()
  sqlstatement = "SELECT "+sensor+" FROM " +NodeType+ " WHERE stationID = "+str(stationID)+"  and char_length(RTC_T)=19 ORDER by id DESC LIMIT 30"
  cursor.execute(sqlstatement)
  result = cursor.fetchall()
  return result
