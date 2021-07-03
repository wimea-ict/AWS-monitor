
from database.retrieveQuery import retrieveBiggestIdFromTable
from database.retrieveQuery import retrieveRTCforTrend
from nodes.utils import analyseSeconds
from Sensors.scanSensors import sensors

import datetime
import statistics



def scanNodes(stationID,nodetype):
  #list_of_tables = ['GroundNode', 'SinkNode', 'TenMeterNode', 'TwoMeterNode']
  #for stationID in stationstationIDs:
# stationID
#for table in list_of_tables:
#if(table==nodetype):
  table=nodetype
  IDresult = retrieveBiggestIdFromTable(stationID, table)
  #print(table,len(IDresult))
  if IDresult: 
    latest_RTC = IDresult[0][1]
    if latest_RTC is not None and len(latest_RTC) == 19:
      latest_RTC = datetime.datetime.strptime(latest_RTC, '%Y-%m-%d,%H:%M:%S')
      latest_RTC = latest_RTC.timestamp()
      now = datetime.datetime.now().timestamp()
      gap = now - latest_RTC

      ##print("gap =",gap/60)
    else:
      # corrupt data detected, no problem will be reported
      latest_RTC = 0
      # gap=10000000000
      gap = 'not calculated, corrupt data'


    ###print(stationID,nodetype)
    # #print(IDresult[0][1])
    result_for_trend = retrieveRTCforTrend(stationID, table, IDresult[0][0])
    # #print(result_for_trend)
    list_of_times = []
    for rtc in result_for_trend:


      try:

        if rtc[0] is not None and len(rtc[0]) == 19:
          time = datetime.datetime.strptime(rtc[0], '%Y-%m-%d,%H:%M:%S')
          list_of_times.append({ 'rtc': rtc[0], 
                                  'time_in_seconds' : time.timestamp()
                                })
      except ValueError:
        print("Rtc Value Error")
    #print(gap)

    # #print(list_of_times)
      #else:
        ###print('dirty rtc')
    ###print('number of rows ' + str(x))
    ###print(nodetype)
    # ##print(table)
    

    analyseSeconds(gap,list_of_times, stationID, table)
    if nodetype != 'SinkNode':
      sensors(gap,stationID,nodetype)
  else:
    # gap='not calculated, corrupt data'
    gap = None
    list_of_times = []
    # list_of_times='0'
    list_of_times.append({ 'rtc': None, 
                                  'time_in_seconds' : None
                                })
    # #print(type(gap))
    analyseSeconds(gap,list_of_times, stationID, table)

