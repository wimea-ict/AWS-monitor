import glob, os 
from os import path as p
from paths.directories import cleanedFiles as path
import itertools
import csv

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
