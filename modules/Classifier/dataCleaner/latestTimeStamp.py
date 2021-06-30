from paths.directories import cleanedFiles as path
from datetime import datetime

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
    # print("fn", len(fn))
    if len(fn) == 18:
      time = fn.replace('"', '')
      t = datetime.strptime(time,'%Y-%m-%d,%H:%M')
      return (t)
    else: #2021-04-01,11:45
      return datetime.strptime('2018-01-01,11:45','%Y-%m-%d,%H:%M')

