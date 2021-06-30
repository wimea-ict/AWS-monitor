import datetime as dt
from datetime import datetime, date,time

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
            if (len(str(nexthr))==1):
                nexthr = '0'+str(nexthr)
                # print(nexthr)
            newRtc = splitRtc[0]+','+str(nexthr)+':'+'00' 
            # print(newRtc)

    except ValueError as e:
        print(e)        

    return newRtc
