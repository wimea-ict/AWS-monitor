import datetime as dt
from datetime import datetime, date,time,timedelta
import mysql.connector
import datetime as dt
import glob, os 
from os import path as p
from datetime import datetime, date,time
from database.connection import mydb
from paths.directories import cleanedFiles as path
import csv

cursor = mydb.cursor()

# from dataCleaner.latestTimeStamp import getLatestTimeStamp


def getRainFall(currentTime,sID):
    # print(currentTime)
    date_time = currentTime.strftime("%Y-%m-%d,%H:%M")
    dTOBJ = datetime.strptime(date_time,'%Y-%m-%d,%H:%M')
    d = dTOBJ - timedelta(days=1)

    YestadayDate=d.strftime("%Y-%m-%d")
    RTC_Yest=YestadayDate+'%'

    # print(sID)
    # print("cut time   and original ",dateAndTime,dTOBJ)
    
    stmt2 = "SELECT `P0_LST60` FROM `GroundNode` WHERE `stationID` = "+str(sID)+" AND `P0_LST60` IS NOT NULL AND `RTC_T` LIKE '"+(RTC_Yest)+"' ORDER BY `id` DESC"
    cursor.execute(stmt2)
    value = cursor.fetchall()
    out = [item for t in value for item in t]
    total=0
    # print(out)
    for val in out:
      if val:
        # print(val)
        total = total+int(val)
    totalrainYesterday=total*0.2
    round(totalrainYesterday, 1)

    return totalrainYesterday
    # print(totalrainYesterday)

