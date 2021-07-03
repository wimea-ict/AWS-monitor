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
  #scan stations for on/off statusP0_LST60
  # ##print("***********************************************************")
  problem ='7' #classification id for wrong dates is 7
  # essentialParameters=['T_SHT2X','RH_SHT2X','T','V_A1','V_A2','P0_LST60','V_AD1','V_AD2','P_MS5611','T1','P0_LST']
  #essentialParameters={'T_SHT2X':'Temperature', 'RH_SHT2X':'Humidity','V_A1':'Soil Moisture','V_A2':'WindDirection','P0_LST60':'Preciptation','V_AD1':'Isolation','T1':'Soil Temperature','P0_LST':'Wind Speed','Date':'','Time':''}
  
  TwoMeterNodeParametrs={'T_SHT2X':'Temperature','RH_SHT2X':'Humidity'}#,'T':'Box Temp'}

  TenMeterNodeParametrs={'V_A2':'WindDirection','V_AD1':'Isolation','windSpeed':'Wind Speed'}#,/*'V_AD2':'Isolation','T':'Box Temp'}
  
  SinkNodeParameters={' '}#,'T':'Box Temp'}
  
  GroundNodeParameters={'V_A1':'Soil Moisture','T1':'Soil Temperature','P0_LST60':'Preciptation'}#,'T':'Box Temp'}


  
  sql = "SELECT `station_id` FROM `stations` WHERE `station_id` > 47 AND stationCategory='aws'" # > 49, #50
  stations_id_result = retrieveQuery(sql)
  result = stations_id_result[0]

  list_of_tables = ['GroundNode', 'SinkNode', 'TenMeterNode', 'TwoMeterNode']
  format = "%Y-%m-%d,%H:%M:%S" #"%b %d %Y %H:%M:%S"
  

  for stationID in result: #for each station
  
    # print("_______________________________________",stationID[0],"_CATCHING WRONG DATES_________________________")
    for table in list_of_tables: #for each node on a aws

        # print(stationID,table)
        sql = "select * from " +table+ " where `stationID` = " +str(stationID[0])+ " ORDER BY id  DESC limit 1"
        result = retrieveQuery(sql)
        fieldname = getHeaders(sql)
        header = fieldname[0]
        # print(header)
   
        if len(result[0])>0:
	        nodeData = result[0][0]
	        date_string=nodeData[2]
	        try:
	          if date_string is not None:
	            datetime.strptime(date_string, format)
	            len(date_string)==19
	            check_if_problem_existed(stationID[0],problem,table,date_string)
	        except ValueError:
	          reportProblemMethod(str(stationID[0]),table, problem, date_string)

	#======================================CATCHING MISSING NODE VALUES============================================
	        if (table == 'TwoMeterNode'):
	           essentialParameters = TwoMeterNodeParametrs
	        if (table == 'TenMeterNode'):
	           essentialParameters = TenMeterNodeParametrs
	        if (table == 'SinkNode'):
	           essentialParameters = SinkNodeParameters
	        if (table == 'GroundNode'):
	           essentialParameters = GroundNodeParameters

	        for value in nodeData:
	          Param =[d for d in essentialParameters]
	          # print(header[nodeData.index(value)])
	          if header[nodeData.index(value)] in Param:
	            if value:
	              print(nodeData.index(value),header[nodeData.index(value)], value, stationID[0])
	              # print(header[nodeData.index(value)], value)
	              check_if_problem_existed(str(stationID[0]),'6',table,header[nodeData.index(value)])

# ========================================CATCHING INCORRECT SENSOR VALUES VALUES================================
	              try:
	                float(value)
	                check_if_problem_existed(str(stationID[0]),'8',table,str(header[nodeData.index(value)]))
	              except ValueError:
	              	incoValue = header[nodeData.index(value)]+' \"'+(value)+'\"'
	              	reportProblemMethod(str(stationID[0]),table, '8', incoValue)


# ====================================== CATCHING MISSING VALUES================================================
	            else:
	              reportProblemMethod(str(stationID[0]),table,'6',str(header[nodeData.index(value)]))
	              print(value,str(stationID[0]),table,'6',str(header[nodeData.index(value)]))






#============================== CATCHING INCORRECT SENSOR VALUES=========================================

        sql = "select DATE, TIME from " +table+ " where `stationID` = " +str(stationID[0])+ " ORDER BY id  DESC limit 1"
        result = retrieveQuery(sql)
        try:
          if date_string is not None and len(result[0])>0:
            datetime.strptime(date_string, format)
            dateAndTime= result[0][0]
            Time= dateAndTime[1]
            Date= dateAndTime[0]
            gatewayTime =Date+","+Time
            diff=datetime.strptime(gatewayTime,'%a %b %d %Y,%H:%M:%S')-datetime.strptime(date_string,'%Y-%m-%d,%H:%M:%S')
            safe_Diff = 3*(3600)
          if (diff.total_seconds()) > safe_Diff:
            vDiff=round((diff.total_seconds()/3600),2)
            reportProblemMethod(str(stationID[0]),table,'3',str(vDiff))
          else:
            vDiff=round((diff.total_seconds()/3600),2)
            check_if_problem_existed(stationID[0],'3',table,str(vDiff))
          if date_string:
          	datetime.strptime(date_string, format)
        except ValueError:
          reportProblemMethod(str(stationID[0]),table, problem, date_string)
  print("===========================END======================================") 
stations()