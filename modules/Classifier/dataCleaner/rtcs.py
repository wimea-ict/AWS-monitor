import mysql.connector
from database.connection import mydb

cursor = mydb.cursor()

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
  cursor.execute(stmt2)
  values = cursor.fetchall() 
  return values
