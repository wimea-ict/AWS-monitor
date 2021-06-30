import mysql.connector
import datetime as dt
import glob, os 
from os import path as p
from datetime import datetime, date,time
from database.connection import mydb
from paths.directories import cleanedFiles as path
import csv

from dataCleaner.records import recordInInterval
from dataCleaner.fileLocator import fileLocator
from dataCleaner.formatTime import formatTime
from dataCleaner.rtcs import rtcs
from dataCleaner.ranges import ranges
from dataCleaner.latestTimeStamp import getLatestTimeStamp



cursor = mydb.cursor()

#SELECT `station_id`, `StationName` FROM `stations` WHERE `stationCategory` = 'aws' ORDER BY `station_id` DESC

stmt = "SELECT `station_id`, `StationName` FROM `stations` WHERE `stationCategory` = 'aws' ORDER BY `station_id` DESC"
#ORDER BY `station_id` DESC "
cursor.execute(stmt)
stations = cursor.fetchall()

nodes = ['TwoMeterNode', 'TenMeterNode', 'GroundNode']

#this gets the sinknode time its passed to the rtcs() to get the hour records
def sinkNodeTime(sID):
  ###print(sID)
  stmt2 = 'SELECT `RTC_T` FROM `SinkNode` WHERE `stationID` = '+str(sID)+'  ORDER BY `id` DESC Limit 1'
  cursor.execute(stmt2)
  times = cursor.fetchall()
  ###print('t',str(times[0]))
  print(sID,"|--15%-----", end ="")
  return str(times[0])

#times = sinkNodeTime(48)
# print(times)


def offNode(node):
  if (node == 'TwoMeterNode'):
    strr=('-','-')
  if (node == 'TenMeterNode' or node == 'GroundNode'):
    strr=('-','-','-')
  return strr
 
def insertDashes(dashes,node,a,b,c,h):
  if (node == 'TwoMeterNode'):
    a.insert(1,dashes)
    b.insert(1,dashes)
    c.insert(1,dashes)
    h.insert(1,dashes)
  if (node == 'TenMeterNode'):
    a.insert(2,dashes)
    b.insert(2,dashes)
    c.insert(2,dashes)
    h.insert(2,dashes)  
  if (node == 'GroundNode'):
    a.insert(3,dashes)
    b.insert(3,dashes)
    c.insert(3,dashes)
    h.insert(3,dashes)  

## main bit
def cleaner():
    for station in stations:
        ###print('station....',station)
        sinkNodeT = sinkNodeTime(station[0])
        # print(sinkNodeT)
        fil = fileLocator(station[1])
        ###print(fil)
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
        dashes = ()
        
        for node in nodes:
            rtcArray = rtcs(station[0], node, sinkNodeT)
            if len(rtcArray) != 0:
              rangeOne, rangeTwo, rangeThree, rangeFour = ranges(rtcArray)
              # #print(rangeOne)
              dateList = []
              dateList.append(rangeOne)
              dateList.append(rangeTwo)
              dateList.append(rangeThree)
              dateList.append(rangeFour)

              #RTC_T WITH FULL SENSOR RECORDS===============================================
              for date in dateList:
                strr, timeNow = recordInInterval(date, node, station[0])
          
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
                      # ##print(strr)
                      
                    elif d in range(30, 45):
                      timeAndID3 = (str(station[0]), formatTime(str(timeNow).replace('(','').replace(')','').replace('\'','').rstrip(',')))
                      c.append(strr)
                      
                    else:# d in range(45,59):
                      timeAndID4 = (str(station[0]), formatTime(str(timeNow).replace('(','').replace(')','').replace('\'','').rstrip(',')))
                      h.append(strr)
                      # print(timeAndID4, timeNow)   
                  except ValueError as error:
                    # print(error)
                    error
                    # continue
            else:
              #print("node off", node)
              dashes = offNode(node)
              insertDashes(dashes,node,a,b,c,h)
        print("30%---",end="")


        a.insert(0, timeAndID1)
        b.insert(0, timeAndID2)
        c.insert(0, timeAndID3)
        h.insert(0, timeAndID4)

        r=[]
        
        if len(a)>1:
          r.append(a)
        if len(b)>1:
          r.append(b)
        if len(c)>1:
          r.append(c)
        if len(h)>1:
          r.append(h)

        print("45%---",end="")

        with open(path+'/'+fil,"a", newline='' ) as file:
          writer= csv.writer(file, delimiter=',')
          for j in r:
            if len(j[0]) != 0 and len(j) == 4:
              #print("here")
              for m in j:
                for e in m:
                  wri.append(e)
              ##print(wri)
              # ##print(wri[0])
              dTOBJ = datetime.strptime(wri[1],'%Y-%m-%d,%H:%M')
              
              if getLatestTimeStamp(station[1]) < dTOBJ:
                writer.writerow(wri)
                #print('wrote....', wri)
                #resetting the list wri ....apparently if we just let that loop go on without
                #reseting that list... e is just appended for all the tuples a,b,c,h
                wri = []
        print("100%--| **COMPLETE**")
    

            
              
