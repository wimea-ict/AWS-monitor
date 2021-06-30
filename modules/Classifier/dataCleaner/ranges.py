import datetime as dt
import datetime as dt

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
      # print(error, "..........")
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
