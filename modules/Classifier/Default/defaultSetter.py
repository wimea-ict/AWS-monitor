import datetime
from datetime import datetime
from database.retrieveQuery import retrieveQuery
from database.retrieveQuery import getHeaders
from database.reportProblem import reportProblemMethod
from database.reportProblem import check_if_problem_existed
from database.reportProblem import check_if_problemExisted
from database.connection import mydb
import array


def stations():
  # problem ='7' #classification id for wrong dates is 7
  # ========================================INACCESSIBLE STATIONS==============================================
  sql = "SELECT * FROM `stations` WHERE `stationCategory` = 'aws' ORDER BY station_id DESC" # > 49, #50
  stations_id = retrieveQuery(sql)
  allstations = stations_id[0]
  for station in allstations:
	  ##print(station[0])		
	  sql = "SELECT `stationID`,`NodeType` FROM `DetectedAnalyzerProblems` WHERE `stationID`="+str(station[0])+" AND `status` != 'fixed' AND `Problem`='Station_off' ORDER BY id DESC" # > 49, #50
	  stations_id_result = retrieveQuery(sql)
	  res = stations_id_result[0]
  # for stationID in result:
	  sql = "select * from `problems` where `stationID` = " +str(station[0])+ " AND status != 'fixed' AND classification_id < '8' AND classification_id != '1' "
	  result = retrieveQuery(sql)
	  ##print(len(result[0]),str(station[0]))
	  if len(result[0])==0 and len(res)!=0:
	    # print("Station Inaccessible",str(station[0]))
	    Value=None
	    classification_id='1'
	    reportProblemMethod(str(station[0]),'SinkNode', classification_id,Value)
	  else:
	    Value=None
	    problem='1'
	    	# check_if_problem_existed(str(stationID[0]), '1',str(stationID[1]),Value)
	    check_if_problem_existed(str(station[0]), problem,'SinkNode',Value)
	    print("Station Accessible",str(station[0]))
  print("=======================END OF STATIONS LEVEL========================")
        
#==============================================END OF ALGORITHM================================================


  # # ============================================INACCESSIBLE NODES==============================================
  sql = "SELECT * FROM `stations` WHERE `stationCategory` = 'aws' ORDER BY station_id DESC" # > 49, #50
  stations_id = retrieveQuery(sql)
  allstations = stations_id[0]
  for station in allstations:
	  #Nodes with Problems		
	  sql = "SELECT `stationID`,`NodeType` FROM `DetectedAnalyzerProblems` WHERE `stationID`="+str(station[0])+" AND `status` != 'fixed' AND `Problem`!='Station_off' AND `Problem`!='Sensor_off' ORDER BY id DESC" # > 49, #50
	  stations_id_result = retrieveQuery(sql)
	  resr = stations_id_result[0]

	  # print(station[0], len(resr))


	  Node_Inaccessible=[]
	  for stationID in resr:
	    Node_Inaccessible.append(stationID[1])
	    sql = "select * from `problems` where `stationID` = " +str(station[0])+ " AND NodeType='"+stationID[1]+"' AND status != 'fixed' AND classification_id < '8' AND classification_id > '2' "
	    result = retrieveQuery(sql)
	    if len(result[0])==0 and len(resr)!=0:
	      Value=None
	      classification_id='2'
	      reportProblemMethod(str(stationID[0]),stationID[1], classification_id,Value)
	    else:
	      Value=None
	      problem='2'
	      check_if_problem_existed(str(stationID[0]), problem,stationID[1],Value)

	  List=['TwoMeterNode','TenMeterNode','GroundNode','SinkNode']
	  for node in List:
	    sql = "select `NodeType`,`stationID` from `problems` where `stationID` = "+str(station[0])+" AND `NodeType` = '"+node+"'  AND status != 'fixed' "
	    rlt = retrieveQuery(sql)
	    # print(rlt)
	   
	    for val in rlt:
	      for i in val:
	        # print(i[0])
	        if i:
	          if (node not in Node_Inaccessible):
	            print(i[1],node,"    Node On")
	            Value=None
	            problem='2'
	            check_if_problem_existed(str(station[0]), problem,str(i[0]),Value)

	  
	#===============================================END OF ALGORITHM===============================================
	      
#print("===========================START======================================") 
stations()