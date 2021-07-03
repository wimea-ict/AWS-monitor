import datetime
from database.retrieveQuery import getParameters
from database.connection import mydb
from problems.retrieveQuery import retrieveQuery
from database.reportProblem import reportProblemMethod
# from database.retrieveQuery import insertIntoChangeTracker
from database.retrieveQuery import ReportIntervalClusters
from database.reportProblem import check_if_problem_existed
from reports.sendmail import sendmail
def sensors(gap,sID,nodetype):

  param = True

  #sensors={'T_SHT2X':'Temperature', 'RH_SHT2X':'Humidity','V_A2':'WindDirection','P0_LST60':'Preciptation','V_AD1':'Isolation','P_MS5611':'Pressure','T1':'Soil Temperature','V_A1':'Wind Speed'}
  
  TwoMeterNodeParametrs={'T_SHT2X':'Temperature','RH_SHT2X':'Humidity'}#,'T':'Box Temp'}

  TenMeterNodeParametrs={'V_A2':'WindDirection','V_AD1':'Isolation','WindSpeed':'Wind Speed'}#,/*'V_AD2':'Isolation','T':'Box Temp'}
  
  SinkNodeParameters={' '}#,'T':'Box Temp'}
  
  GroundNodeParameters={'V_A1':'Soil Moisture','T1':'Soil Temperature','P0_LST60':'Preciptation'}#,'T':'Box Temp'}
  

  if (nodetype == 'TwoMeterNode'):
  	currentNodParams = TwoMeterNodeParametrs
  if (nodetype == 'TenMeterNode'):
    sql = "select WindSpeed,P0_LST60 from TenMeterNode where `stationID` = "+str(sID)+" ORDER BY id  DESC limit 1"
    result = retrieveQuery(sql)

    print((result[0][0][1]))

    try:
      result_windSpeed = result[0][0][0]
      result_P0_LST60 = result[0][0][1]
    except ValueError:
      result_windSpeed = ''
      result_P0_LST60 = ''
    
    # print(result_windSpeed[0][0])

    if(result_windSpeed or not result_P0_LST60):
      currentNodParams = TenMeterNodeParametrs
    else:
      currentNodParams={'V_A2':'WindDirection','V_AD1':'Isolation','P0_LST60':'Wind Speed'}
      print("=======================OLD FIRMWARE=====================")
      

  if (nodetype == 'SinkNode'):
  	currentNodParams = SinkNodeParameters
  if (nodetype == 'GroundNode'):
  	currentNodParams = GroundNodeParameters

  for sensor in currentNodParams:
    #catching moments when sensors donot send


    param=getParameters(sID,nodetype,sensor)

    ##print("param",len(param))
    param_received = []
    for val in param:
      ##print(val[0])
      if val[0] is not None :
        param_received.append(val)
    ##print("param_received",len(param_received))
    sql = "select cluster from ReportIntervalClusters where `stationID` = "+str(sID)+" AND `Node`='"+nodetype+"' ORDER BY id  DESC limit 1"
    cursor = mydb.cursor()
    cursor.execute(sql)
    row = cursor.fetchall()
    list_of_clusters=[list(i) for i in row]
    if not list_of_clusters:
      most__frequent_cluster = 1
      magnitude = 0
    else:
      most_occuring_difference=int(list_of_clusters[0][0][2])
      magnitude = most_occuring_difference * 10000

      ##print(magnitude)
    if type(gap) is int or type(gap) is float:
      gap = round(gap)
      if gap >= magnitude or len(param_received)==0:
        sensor_status = 'off'
        problem = 'Sensor_off'
        # if(nodetype=='TenMeterNode'):


        reportProblemMethod(sID,problem,nodetype,currentNodParams[sensor])

      elif gap < magnitude and len(param_received)>0:
        sensor_status = 'on'
        check_if_problem_existed(sID, 'Sensor_off',nodetype,currentNodParams[sensor])
        #print("solved   ",len(param_received))
        ##print(sID,'Sensor_on')
    else:
      node_status = 'not calculated, latest rtc is corrupt'
      ##print(len(param_received))







