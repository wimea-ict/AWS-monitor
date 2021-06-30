from database.connection import mydb

import time

import datetime

#1: 

#2:

#3: Big Difference between RTC and Gateway time 

#4: Node power values are below range.

#5: Sensor values are below range.

#6: Node has missing values

#7: Date(RTC) values are incorrect.

#8: Sensor values are incorrect.

#9: Packets were dropped.

#10: Sensor values below average 
 
def setCriticality():
	sql = "SELECT `station_id` FROM `stations` WHERE `station_id` > 47 AND stationCategory='aws'" # > 49, #50
	stations_id_result = retrieveQuery(sql)
	result = stations_id_result[0]
  #print(result," result")






def retrieveStatus(station_id,classificationid,Node,Value):
  cursor = mydb.cursor()
  sqlStatement = " select status, id, when_reported, Value from problems where (NodeType='"+Node+"' and stationID='"+str(station_id)+"') AND (classification_id = '"+classificationid+"' AND Value='"+Value+"' and status != 'fixed') ORDER BY id  DESC"
  cursor.execute(sqlStatement)
  result = cursor.fetchall()
  return result

######  




def  check_if_problem_existed(stationID, problem,NodeType,Value):
  result = retrieveStatus(stationID,problem,NodeType,Value)
  #print(len(result))

  if len(result) is not 0:
    entry_id = result[0][1]
    updateProblem('fixed', entry_id)

      
      



def insertProblem(stationID,NodeType, problem, status, Value):
  cursor = mydb.cursor()
  sql = "INSERT INTO problems (stationID,NodeType, classification_id, when_reported,status,Value) VALUES (%s, %s, %s,%s, %s,%s)"
  time = datetime.datetime.now()
  val = (str(stationID),NodeType, problem, str(time), status,Value)
  cursor.execute(sql, val)

  mydb.commit()


  ######
  # UPDATE QUERY
  #####

def updateProblem(status, entryID):
  mycursor = mydb.cursor()
  sql = "UPDATE problems SET status = '" +status+  "' WHERE id = " + str(entryID)
  
  mycursor.execute(sql)

  mydb.commit()

