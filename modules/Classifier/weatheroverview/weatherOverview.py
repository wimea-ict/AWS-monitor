import datetime
from time import time
from datetime import datetime, timedelta
from database.retrieveQuery import retrieveQuery
from database.retrieveQuery import Oftenstationoff
from database.retrieveQuery import retrieveBiggestIdFromTable
from dataCleaner.latestTimeStamp import getLatestTimeStamp
from paths.directories import overviewPath
from database.connection import mydb
import string
import itertools
import csv
import array

def overview():
  # now =datetime.today()-timedelta(days=7)
  sql = "SELECT `station_id`,`StationName` FROM `stations` WHERE `StationCategory`='aws' ORDER BY `station_id` DESC" # > 49, #50
  tic = time()
  stations = retrieveQuery(sql)
  toc =time()
  # stations = retrieveQuery(sql)
  stationSpecifics = stations[0]
  # stationNames = stations[1]
  print("Time elapse:",toc-tic)

  for station in stationSpecifics:
    # print(station[0])
    list_of_tables = ['Formula','Latest','Today','7 days','Month' ,'Year']
    with open(overviewPath+"/"+station[1]+".csv","w+", newline='' ) as file:
      writer= csv.writer(file, delimiter=',')


      # WRITE AVERAGE RELATIVE HUMIDITY
      print(station[1])
      writer.writerow(['stationID','Formula','Latest','Today','7 days','Month' ,'Year'])
      latestRH = getAverage(station[1],'RH_SHT2X',station[0],'TwoMeterNode','latest')
      print(latestRH)
      TodayRH = getAverage(station[1],'RH_SHT2X',station[0],'TwoMeterNode','Today')
      print(TodayRH)
      weekRH = getAverage(station[1],'RH_SHT2X',station[0],'TwoMeterNode','week')
      print(weekRH)
      MonthRH = getAverage(station[1],'RH_SHT2X',station[0],'TwoMeterNode','Month')
      print(MonthRH)
      YearRH = getAverage(station[1],'RH_SHT2X',station[0],'TwoMeterNode','Year')
      writer.writerow([station[0],'AVG(% RH)',latestRH,TodayRH,weekRH,MonthRH ,YearRH])
      print(YearRH)

      # WRITE AVERAGE WIND SPEED
      latestWD = getAverage(station[1],'windSpeed',station[0],'TenMeterNode','latest')
      TodayWD = getAverage(station[1],'windSpeed',station[0],'TenMeterNode','Today')
      weekWD = getAverage(station[1],'windSpeed',station[0],'TenMeterNode','week')
      MonthWD = getAverage(station[1],'windSpeed',station[0],'TenMeterNode','Month')
      YearWD = getAverage(station[1],'windSpeed',station[0],'TenMeterNode','Year')
      writer.writerow([station[0],'AVG(mps)',latestWD,TodayWD,weekWD,MonthWD ,YearWD])
      print(YearWD)

      print("WRITE AVERAGE PRESSURE")
      latestPRS = getAverage(station[1],'P',station[0],'GroundNode','latest')
      print(latestPRS)
      TodayPRS = getAverage(station[1],'P',station[0],'GroundNode','Today')
      print(TodayPRS)
      weekPRS = getAverage(station[1],'P',station[0],'GroundNode','week')
      print(weekPRS)
      MonthPRS = getAverage(station[1],'P',station[0],'GroundNode','Month')
      print(MonthPRS)
      YearPRS = getAverage(station[1],'P',station[0],'GroundNode','Year')
      writer.writerow([station[0],'AVG(hPa)',latestPRS,TodayPRS,weekPRS,MonthPRS ,YearPRS])
      print(YearPRS)

      print("WRITE Max WIND SPEED")
      latestMaxWD = MAXWD(station[1],'windSpeed',station[0],'TenMeterNode','latest')
      print(latestMaxWD)
      TodayMaxWD = MAXWD(station[1],'windSpeed',station[0],'TenMeterNode','Today')
      print(TodayMaxWD)
      weekMaxWD = MAXWD(station[1],'windSpeed',station[0],'TenMeterNode','week')
      print(weekMaxWD)
      MonthMaxWD = MAXWD(station[1],'windSpeed',station[0],'TenMeterNode','Month')
      print(MonthMaxWD)
      YearMaxWD = MAXWD(station[1],'windSpeed',station[0],'TenMeterNode','Year')
      writer.writerow([station[0],'MAX(mps)',latestMaxWD,TodayMaxWD,weekMaxWD,MonthMaxWD ,YearMaxWD])
      print(YearMaxWD)

      print("WRITE SUM RAIN FALL")
      latestRain = TotalRain(station[1],'P0_LST60',station[0],'GroundNode','latest')
      print(latestRain)
      TodayRain = TotalRain(station[1],'P0_LST60',station[0],'GroundNode','Today')
      print(TodayRain)
      weekRain = TotalRain(station[1],'P0_LST60',station[0],'GroundNode','week')
      print(weekRain)
      MonthRain = TotalRain(station[1],'P0_LST60',station[0],'GroundNode','Month')
      print(MonthRain)
      YearRain = TotalRain(station[1],'P0_LST60',station[0],'GroundNode','Year')
      writer.writerow([station[0],'SUM(mm)',latestRain,TodayRain,weekRain,MonthRain,YearRain])
      print(YearRain)

      print("WRITE AVERAGE TEMP")
      latestT = getAverage(station[1],'T_SHT2X',station[0],'TwoMeterNode','latest')
      print(latestT)
      TodayT = getAverage(station[1],'T_SHT2X',station[0],'TwoMeterNode','Today')
      print(TodayT)
      weekT = getAverage(station[1],'T_SHT2X',station[0],'TwoMeterNode','week')
      print(weekT)
      MonthT = getAverage(station[1],'T_SHT2X',station[0],'TwoMeterNode','Month')
      print(MonthT)
      YearT = getAverage(station[1],'T_SHT2X',station[0],'TwoMeterNode','Year')
      print(YearT)
      writer.writerow([station[0],'AVG(C)',latestT,TodayT,weekT,MonthT ,YearT])
      print(station[0])
      file.close()

        
def getAverage(stname,param,stnID,node,period):
  # print("++++++++++++++++++++++++++++++++",retrieveBiggestIdFromTable(stnID,node)[0][0])
  idd=retrieveBiggestIdFromTable(stnID,node)

  
  if idd:
    latestid=retrieveBiggestIdFromTable(stnID,node)[0][0]
  else:
    latestid=3000000

  # Calculating AVERAGE
  # # latest average relative Humidity
  currentRTC = str(getLatestTimeStamp(stname)).split(':')[0]
  # print(currentRTC)
  if period=='latest':
    ID = latestid-60
    if (str(getLatestTimeStamp(stname)).split(':')[1]=='00'):
      hr=str(getLatestTimeStamp(stname)).split(':')[0].split(' ')[1]
      dte=str(getLatestTimeStamp(stname)).split(':')[0].split(' ')[0]
      actualHR = int(hr)-1
      rtc = dte+','+str(actualHR)+'%'
      sql = "SELECT AVG("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` LIKE '"+rtc+"' AND `id` > "+str(ID)+""
      # print(rtc)
    else:
      ID = latestid-60
      date=currentRTC.split(' ')
      rtc = date[0]+','+date[1]+'%'
      sql = "SELECT AVG("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` LIKE '"+rtc+"'AND `id` > "+str(ID)+""

  if period=='Today':
    ID = latestid-1440
    rtc=str(getLatestTimeStamp(stname)).split(':')[0].split(' ')[0]+'%'
  	# print(rtc)
    sql = "SELECT AVG("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` LIKE '"+rtc+"'AND `id` > "+str(ID)+""
  if period=='week':
    ID = latestid-10080
    rtc = str(getLatestTimeStamp(stname) - timedelta(days=7))
  	# print(rtc)
    sql = "SELECT AVG("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` >= '"+rtc+"' AND `id` > "+str(ID)+""
  if period=='Month':
    ID = latestid-40320
    rtc = str(getLatestTimeStamp(stname) - timedelta(days=28))
  	# print(rtc)
    sql = "SELECT AVG("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` >= '"+rtc+"' AND `id` > "+str(ID)+""
  if period=='Year':
    ID = latestid-90320
    rtc = str(getLatestTimeStamp(stname) - timedelta(days=365))
  	# print(rtc)
    sql = "SELECT AVG("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` >= '"+rtc+"' AND `id` > "+str(ID)+""
  tic = time()
  avg = retrieveQuery(sql)
  toc =time()
  if avg[0][0][0] is not None:
    average=round(avg[0][0][0],1)
    # print(round(avg[0][0][0],1),station[0])
  else:
    # avg[0][0][0]='-'
    average ='-'
  print("Execution time for",param,"AVG time== ",toc-tic)
  return average

def MAXWD(stname,param,stnID,node,period):
  latestid=retrieveBiggestIdFromTable(stnID,node)[0][0]
  # Calculating AVERAGE
  # # latest average relative Humidity
  currentRTC = str(getLatestTimeStamp(stname)).split(':')[0]

  # print(currentRTC)
  if period=='latest':
    if (str(getLatestTimeStamp(stname)).split(':')[1]=='00'):
      ID = latestid-60
      hr=str(getLatestTimeStamp(stname)).split(':')[0].split(' ')[1]
      dte=str(getLatestTimeStamp(stname)).split(':')[0].split(' ')[0]
      actualHR = int(hr)-1
      rtc = dte+','+str(actualHR)+'%'
      sql = "SELECT MAX("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` LIKE '"+rtc+"'AND `id` > "+str(ID)+""
      # print(rtc)
    else:
      ID = latestid-60
      date=currentRTC.split(' ')
      rtc = date[0]+','+date[1]+'%'
      sql = "SELECT MAX("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` LIKE '"+rtc+"' AND `id` > "+str(ID)+""

  if period=='Today':
    ID = latestid-1440
    rtc=str(getLatestTimeStamp(stname)).split(':')[0].split(' ')[0]+'%'
  	# print(rtc)
    sql = "SELECT MAX("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` LIKE '"+rtc+"' AND `id` > "+str(ID)+""
  if period=='week':
    ID = latestid-10080
    rtc = str(getLatestTimeStamp(stname) - timedelta(days=7))
  	# print(rtc)
    sql = "SELECT MAX("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` >= '"+rtc+"' AND `id` > "+str(ID)+""
  if period=='Month':
    ID = latestid-20320
    rtc = str(getLatestTimeStamp(stname) - timedelta(days=28))
  	# print(rtc)
    sql = "SELECT MAX("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` >= '"+rtc+"' AND `id` > "+str(ID)+""
  if period=='Year':
    ID = latestid-90000
    rtc = str(getLatestTimeStamp(stname) - timedelta(days=365))
  	# print(rtc)
    sql = "SELECT MAX("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` >= '"+rtc+"' AND `id` > "+str(ID)+""
  
  tic = time()
  avg = retrieveQuery(sql)
  toc =time()
  if avg[0][0][0] is not None:
    maxx=avg[0][0][0]
    # print(round(avg[0][0][0],1),station[0])
  else:
    # avg[0][0][0]='-'
    maxx ='-'
  print(toc-tic)
  return maxx


def TotalRain(stname,param,stnID,node,period):
  latestid=retrieveBiggestIdFromTable(stnID,node)[0][0]
  # Calculating AVERAGE
  # # latest average relative Humidity
  currentRTC = str(getLatestTimeStamp(stname)).split(':')[0]

  # print(currentRTC)
  if period=='latest':
    if (str(getLatestTimeStamp(stname)).split(':')[1]=='00'):
      ID = latestid-60
      hr=str(getLatestTimeStamp(stname)).split(':')[0].split(' ')[1]
      dte=str(getLatestTimeStamp(stname)).split(':')[0].split(' ')[0]
      actualHR = int(hr)-1
      rtc = dte+','+str(actualHR)+'%'
      sql = "SELECT SUM("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` LIKE '"+rtc+"' AND `id` > "+str(ID)+""
      # print(rtc)
    else:
      ID = latestid-60
      date=currentRTC.split(' ')
      rtc = date[0]+','+date[1]+'%'
      sql = "SELECT SUM("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` LIKE '"+rtc+"' AND `id` > "+str(ID)+""

  if period=='Today':
    ID = latestid-1440
    rtc=str(getLatestTimeStamp(stname)).split(':')[0].split(' ')[0]+'%'
  	# print(rtc)
    sql = "SELECT SUM("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` LIKE '"+rtc+"' AND `id` > "+str(ID)+""
  if period=='week':
    ID = latestid-10080
    rtc = str(getLatestTimeStamp(stname) - timedelta(days=7))
  	# print(rtc)
    sql = "SELECT SUM("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` >= '"+rtc+"' AND `id` > "+str(ID)+""
  if period=='Month':
    ID = latestid-20320
    rtc = str(getLatestTimeStamp(stname) - timedelta(days=28))
  	# print(rtc)
    sql = "SELECT SUM("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` >= '"+rtc+"' AND `id` > "+str(ID)+""
  if period=='Year':
    ID = latestid-90000
    rtc = str(getLatestTimeStamp(stname) - timedelta(days=365))
  	# print(rtc)
    sql = "SELECT SUM("+param+") FROM "+node+" WHERE `stationID`="+str(stnID)+" AND `RTC_T` >= '"+rtc+"' AND `id` > "+str(ID)+""
  
  tic = time()
  avg = retrieveQuery(sql)
  toc =time()
  if avg[0][0][0] is not None:
    # print("P0_LST60 TOTAL",avg[0][0][0])
    rain=round(int(avg[0][0][0])*0.2,1)
    # print(round(avg[0][0][0],1),station[0])
  else:
    # avg[0][0][0]='-'
    rain ='-'
  print(toc-tic)
  return rain
overview()
