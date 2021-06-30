import mysql.connector
from database.connection import mydb
from dataCleaner.latestTimeStamp import getLatestTimeStamp
from dataCleaner.precipitation import getRainFall


cursor = mydb.cursor()

#this gets the records from the database depending the node
# we'll only consider cases where atmost one is missing 
def details(node,sID, rtc):
  values = []
  value = []

  stmt = "SELECT `StationName` FROM `stations` WHERE `station_id` = "+str(sID)+" AND `stationCategory` = 'aws'"
  #ORDER BY `station_id` DESC "
  cursor.execute(stmt)
  station = cursor.fetchall()

  # print(node,sID,rtc)

  StationName = station[0][0]


  # print()



  # #print(rtc)
  if (node == 'TwoMeterNode'):
    stmt2 = 'SELECT `T_SHT2X`, `RH_SHT2X`  FROM `TwoMeterNode` WHERE `stationID` = '+str(sID)+' AND `RTC_T` LIKE "'+str(rtc)+'" ORDER BY `id` DESC '
    #SELECT `T_SHT2X`, `RH_SHT2X` FROM `TwoMeterNode` WHERE `stationID` = 49 AND `RTC_T` LIKE '2018-11-22,12:%' ORDER BY `id` DESC
    cursor.execute(stmt2)
    value = cursor.fetchall()
    value.append(None)
    #print("=======",sID,"=======",rtc,"========",value[0][0])


    if value[0][0] == None:
      values = [('-',value[0][1])]
    elif value[0][1] == None:
      values = [(value[0][0],'-')]
    elif value[0][0] and value[0][1] == None:
      values = [('-','-')]  
    else:
      values = [(value[0][0], value[0][1])]   

  elif (node == 'TenMeterNode'):
    stmt2 = 'SELECT `windSpeed`, `V_A1`, `V_A2`, `V_AD1`  FROM `TenMeterNode` WHERE `stationID` = '+str(sID)+' AND `RTC_T` = "'+str(rtc)+'" ORDER BY `id` DESC '
    #SELECT `T_SHT2X`, `RH_SHT2X` FROM `TwoMeterNode` WHERE `stationID` = 49 AND `RTC_T` LIKE '2018-11-22,12:%' ORDER BY `id` DESC
    cursor.execute(stmt2)
    value = cursor.fetchall()
    
    ####print('value...', value)

    ####print('VA2', value[0][2])
    try:
      if value != []:
        #print("windDirection  ############################",value[0][1], value[0][2])
        if (value[0][1] and value[0][2]):

          if value[0][2] != 0:
            windDirection = round(((float(value[0][1])/float(value[0][2])-0.05)*400), 3)
          else:
            windDirection = '-' 
        else:
          windDirection = '-'
        if value[0][0] == None:
          values = [(value[0][3], '-', str(windDirection))]
        elif value[0][3] == None:
          values = [('-', value[0][0], str(windDirection))]    
        elif (value[0][1] or value[0][2]) == None:
          values = [(value[0][3], value[0][0], '-')]  
        elif (value[0][3] and value[0][0]) == None:
          values = [('-', '-', str(windDirection))] 
        else:
          values = [(value[0][3], value[0][0], str(windDirection))]  
      #print('ten meter VALUES ================', values)
    except (ZeroDivisionError, ValueError) as z:
      print(z)
          
  elif (node == 'GroundNode'):
    stmt2 = 'SELECT `P0_LST60`, `T1`, `P`  FROM `GroundNode` WHERE `stationID` = '+str(sID)+' AND `RTC_T` LIKE "'+str(rtc)+'" ORDER BY `id` DESC '
    cursor.execute(stmt2)
    # print(stmt2)
    value = cursor.fetchall()

    if value:
      if value[0][0] == None:
        values = [('-', value[0][1], value[0][2])]
      elif value[0][1] == None:
        values = [(value[0][0], '-', value[0][2])]
      elif value[0][2] == None:
        values = [(value[0][0], value[0][1], '-')]
      else:
        # print(StationName)
        currentTime=getLatestTimeStamp(str(StationName))
        print(currentTime)
        # print(getRainFall(currentTime,sID))
        values = [(getRainFall(currentTime,sID), value[0][1], value[0][2])]
        # we need to format rainfall. this is done by adding all the rain fall recieved the previous day then multiply by 0.2mm
    else:
      values=[('-','-','-')]
  return values  
