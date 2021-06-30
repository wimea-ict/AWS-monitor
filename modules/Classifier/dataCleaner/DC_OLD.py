import mysql.connector
import datetime as dt
import glob, os 
from os import path as p
from datetime import datetime, date,time
from database.connection import mydb
from paths.directories import cleanedFiles as path
import itertools
import csv


cursor = mydb.cursor()

#SELECT `station_id`, `StationName` FROM `stations` WHERE `stationCategory` = 'aws' ORDER BY `station_id` DESC

stmt = "SELECT `station_id`, `StationName` FROM `stations` WHERE `stationCategory` = 'aws' LIMIT 6"
#ORDER BY `station_id` DESC "
cursor.execute(stmt)
stations = cursor.fetchall()

nodes = ['TwoMeterNode', 'TenMeterNode', 'GroundNode']

#this gets the sinknode time its passed to the rtcs() to get the hour records
def sinkNodeTime(sID):
  ##print(sID)
  stmt2 = 'SELECT `RTC_T` FROM `SinkNode` WHERE `stationID` = '+str(sID)+'  ORDER BY `id` DESC Limit 1'
  cursor.execute(stmt2)
  times = cursor.fetchall()
  ##print('t',str(times[0]))
  return str(times[0])

#times = sinkNodeTime(48)
###print(times)

#this gets the records from the database depending the node
# we'll only consider cases where atmost one is missing 
def details(node,sID, rtc):
  values = []
  value = []
  # print(rtc)
  if (node == 'TwoMeterNode'):
    stmt2 = 'SELECT `T_SHT2X`, `RH_SHT2X`  FROM `TwoMeterNode` WHERE `stationID` = '+str(sID)+' AND `RTC_T` LIKE "'+str(rtc)+'" ORDER BY `id` DESC '
    #SELECT `T_SHT2X`, `RH_SHT2X` FROM `TwoMeterNode` WHERE `stationID` = 49 AND `RTC_T` LIKE '2018-11-22,12:%' ORDER BY `id` DESC
    cursor.execute(stmt2)
    value = cursor.fetchall()
    value.append(None)
    print("=======",sID,"=======",rtc,"========",value[0][0])


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
    
    ###print('value...', value)

    ###print('VA2', value[0][2])
    try:
      if value != []:
        windDirection = round(((float(value[0][1])/float(value[0][2])-0.05)*400), 3)
        ###print('wind direction is ', windDirection)
        if value[0][0] == None:
          values = [(value[0][3], '-', str(windDirection))]
        elif value[0][3] == None:
          values = [('-', value[0][0], str(windDirection))]    
        elif value[0][1] or value[0][2] == None:
          values = [(value[0][3], value[0][0], '-')]  
        elif (value[0][3] and value[0][0]) == None:
          values = [('-', '-', str(windDirection))] 
        else:
          values = [(value[0][3], value[0][0], str(windDirection))]  
      ###print('ten meter', value)
    except (ZeroDivisionError, ValueError) as z:
      print(z)
          
  elif (node == 'GroundNode'): 
    stmt2 = 'SELECT `P0_LST60`, `T1`, `P`  FROM `GroundNode` WHERE `stationID` = '+str(sID)+' AND `RTC_T` = "'+str(rtc)+'" ORDER BY `id` DESC '
    cursor.execute(stmt2)
    value = cursor.fetchall()

    if value[0][0] == None:
      values = [('-', value[0][1], value[0][2])]
    elif value[0][1] == None:
      values = [(value[0][0], '-', value[0][2])]
    elif value[0][2] == None:
      values = [(value[0][0], value[0][1], '-')]
    else:
      values = [(value[0][0], value[0][1], value[0][2])]


  return values  
  #   

#this gets rid of the minute and second bits of the time stamp
def anyTimeLike(rtcx):
  #'2018-12-12,17:07:16'
  rtc = rtcx.replace('(','').replace(')','').replace('\'','').rstrip(',')
  splits = rtc.split(':')
  # splits[2] = 
  concat = splits[0]+'%'
  return concat

#this selects rtcs within an hour
def rtcs(sID, node, rt):
  rtc = anyTimeLike(rt)
  stmt2 = 'SELECT `RTC_T`  FROM '+str(node)+' WHERE `stationID` = '+str(sID)+' AND `RTC_T` LIKE "'+str(rtc)+'" ORDER BY `id` DESC '
  #SELECT `T_SHT2X`, `RH_SHT2X` FROM `TwoMeterNode` WHERE `stationID` = 49 AND `RTC_T` LIKE '2018-12-14,04%' ORDER BY `id` DESC
  cursor.execute(stmt2)
  values = cursor.fetchall() 
  return values


#this divides the rtcArray into the desired ranges
def ranges(rtcArray):
  #ranges = [(0,14),(15,29),(30,44),(45,59)]
  zeroTofourteen = []
  fifteenTotwentyNine = []
  thirtyTofourtyfour = []
  fourtyfiveTofiftynine = []

  for i in rtcArray:
    ###print(i)
    k = str(i).replace('(','').replace(')','').replace('\'','')#.replace(',','')
    try:
      d = dt.datetime.strptime(k,'%Y-%m-%d,%H:%M:%S,').minute
    except ValueError as error:
      #print(error)
      d = 70
    #get minute d, if d is in a required range then append i to the 
    #required list
    if d in range(0,15):
      zeroTofourteen.append(i)
    elif d in range(15,30):
      fifteenTotwentyNine.append(i)
    elif d in range(30,45):
      thirtyTofourtyfour.append(i)
    elif d in range(45, 60) :
      fourtyfiveTofiftynine.append(i)

  return zeroTofourteen, fifteenTotwentyNine, thirtyTofourtyfour,fourtyfiveTofiftynine       

#locate the file with the specified station name
def fileLocator(stationName):
  f = ''
  try:
    os.chdir(path)
    for file in glob.glob("*.csv"):
      ##print(file)
      if p.exists(stationName+'.csv'):#file.split('.')[0] == stationName:
        ##print(file)
        f = file
        break
      else:
        #file doesnt exist yet
        # flle=path+'/'+stationName+'.csv'
        # getLatestTimeStamp(time,flle)
        with open(path+'/'+stationName+'.csv', "a", newline = '') as file:
          writer= csv.writer(file, delimiter=',')
          #writer.writerow(['STATIONID','DATETIME','NODE','AIRTEMP(T)','RH','SOLAR','WINDSPEED','W.DIRECTION','SOIL TEMPERATURE','SOIL MOISTURE','PRESSURE','RAIN'])
          writer.writerow(['STATIONID','DATETIME','AIRTEMP(T)','RH','SOLAR','WINDSPEED','W.DIRECTION','RAIN','SOILTEMPERATURE(T1)','PRESSURE'])
          break
    f = stationName+'.csv'
        
  except Exception as ex:
    print(ex)
  return f

#checks for non
def checkForNones(listOfValues):
  #res should contain None indices in the list
  res = [i for i in range(len(listOfValues)) if listOfValues[i] == None]
  #if it contains any Nones ie if it has any values in it, we return True else false
  if len(res) == 0:
    #no Nones in the list
    return False
  elif len(res) != 0:
    #there's nones in the list
    return True


#this finds the record in an interval
def recordInInterval(dateArray, node, sID):
  #dateArray is an interval eg 0-15
  #only write if the value is not null
  strr = []
  time = ''
  if dateArray:

    for i in dateArray:
      k = str(i).replace('(','').replace(')','').replace('\'','').rstrip(',')
      records = details(node, sID, k)
      if records != [] and checkForNones(records[0]) == False:
        time = i 
        for l in records:
          strr = l     
        break  
  else:
  	if (node == 'TwoMeterNode'):
  		strr=('-','-')
  	if (node == 'TenMeterNode' or node == 'GroundNode'):
  		strr=('-','-','-')
  return strr, time

def formatTime(rtc):
    #'2018-12-12,17:07:16,'
    k = str(rtc).replace('(','').replace(')','').replace('\'','').strip(',')#.replace(',','')
    mm = 0
    newRtc = rtc
    try:
        mm = dt.datetime.strptime(k,'%Y-%m-%d,%H:%M:%S').minute
        
        if mm in range(0,15):
            mm = 15
            splitRtc = rtc.split(':')
            newRtc = splitRtc[0]+':'+str(mm)
        elif mm in range(15,30):
            mm = 30
            splitRtc = rtc.split(':')
            newRtc = splitRtc[0]+':'+str(mm)
        elif mm in range(30,45):
            mm = 45
            splitRtc = rtc.split(':')
            newRtc = splitRtc[0]+':'+str(mm)
        elif mm in range(45, 60):
            #mm = 00
            hr = dt.datetime.strptime(k,'%Y-%m-%d,%H:%M:%S').hour
            nexthr = hr + 1 
            splitRtc = rtc.split(',')
            newRtc = splitRtc[0]+','+str(nexthr)+':'+'00' 

    except ValueError as e:
        print(e)        

    return newRtc


#RETRIEVING THE LATEST TIMESTAMP====================================
#=======function to check if a row is exists already===================

 #Ideal funtion getLatestTimeStamp(path) takes a path and returns time
def getLatestTimeStamp(stationName):
  with open(path+'/'+stationName+'.csv', "r") as f1:
    # rowCount=sum(1 for l in f1)
    # ##print(rowCount)
    for line in f1: pass
    Lst = line
    val = Lst.split(",")
    fn = val[1]+','+val[2]
    time = fn.replace('"', '')
    # ##print(time)
    return (time)



## main bit
def cleaner():
    for station in stations:
        ##print('station....',station)
        sinkNodeT = sinkNodeTime(station[0])
        ##print(sinkNodeT)
        fil = fileLocator(station[1])
        ##print(fil)
        timeAndID1 = () 
        timeAndID2 = ()
        timeAndID3 = ()
        timeAndID4 = ()

        
        wri = []
        #nodes = ['TenMeterNode', 'TwoMeterNode', 'GroundNode']
        a = []
        b = []
        c = []
        h = []
        for node in nodes:
            rtcArray = rtcs(station[0], node, sinkNodeT)
            rangeOne, rangeTwo, rangeThree, rangeFour = ranges(rtcArray)
            # print(rangeOne)
            dateList = []
            dateList.append(rangeOne)
            dateList.append(rangeTwo)
            dateList.append(rangeThree)
            dateList.append(rangeFour)

            # print(dateList)
            #RTC_T WITH FULL SENSOR RECORDS===============================================
            for date in dateList:
                strr, timeNow = recordInInterval(date, node, station[0])
                # print(date)

                ##print('results', strr)
              
                if strr !=[]:
                  k = str(timeNow).replace('(','').replace(')','').replace('\'','')#.replace(',','')
                  try:
                    d = dt.datetime.strptime(k,'%Y-%m-%d,%H:%M:%S,').minute

                    if d in range(0,15):
                      timeAndID1 = (str(station[0]), formatTime(str(timeNow).replace('(','').replace(')','').replace('\'','').rstrip(',')))
                      a.append(strr)

                      
                    elif d in range(15, 30):
                      timeAndID2 = (str(station[0]), formatTime(str(timeNow).replace('(','').replace(')','').replace('\'','').rstrip(',')))
                      b.append(strr)
                      # #print(strr)
                      
                    elif d in range(30, 45):
                      timeAndID3 = (str(station[0]), formatTime(str(timeNow).replace('(','').replace(')','').replace('\'','').rstrip(',')))
                      c.append(strr)
                      
                    elif d in range(45,59):
                      timeAndID4 = (str(station[0]), formatTime(str(timeNow).replace('(','').replace(')','').replace('\'','').rstrip(',')))
                      h.append(strr)   
                  except ValueError as error:
                    print(error)

        
        a.insert(0, timeAndID1)
        b.insert(0, timeAndID2)
        c.insert(0, timeAndID3)
        h.insert(0, timeAndID4)

       
        # #print('a',tuple(a))
        ##print('b',tuple(b))
        ##print('c',tuple(c))
        ##print('h',tuple(h))


        # r = [tuple(a),tuple(b), tuple(c), tuple(h)]
        r=[]
        
        if len(a)>1:
          r.append(a)
        if len(b)>1:
          r.append(b)
        if len(c)>1:
          r.append(c)
        if len(h)>1:
          r.append(h)

        # print((r))

        with open(path+'/'+fil,"a", newline='' ) as file:
          writer= csv.writer(file, delimiter=',')
          for j in r:
            print(j)
            if len(j[0]) != 0: #and len(j) == 4
              for m in j:
                for e in m:
                  wri.append(e)
                  # #print(e)
              # #print(wri[0])
              if getLatestTimeStamp(station[1]) < wri[1]:
                writer.writerow(wri)
                # #print('done with', wri)
                #resetting the list wri ....apparently if we just let that loop go on without
                #reseting that list... e is just appended for all the tuples a,b,c,h
                wri = []
              else:
                print(" ")
            else:
              print(" ")
            
              
              #breakit
        ##print('station done')


