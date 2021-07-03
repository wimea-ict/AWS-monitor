#function to report problems
########

import datetime

from database.retrieveQuery import retrieveStatus
from database.retrieveQuery import retrieveStatusWithValue
from database.retrieveQuery import insertProblem
from database.retrieveQuery import updateProblem
from reports.sendmail import sendmail

def reportProblemMethod(stationID,problem,NodeType,Value):
  if Value is not None:
    result=retrieveStatusWithValue(stationID,problem,NodeType,Value)
  else:
    result=retrieveStatus(stationID,problem,NodeType)
    Value="-"
    # #print(NodeType)

  if len(result) is 0:
    ##print("First Report of the Problem",stationID,problem,NodeType,Value)
    insertProblem(stationID,NodeType, problem, 'reported',Value)
    
  else :
    status = result[0][0]
    entry_id = result[0][1]
    time_reported = result[0][2]
    # get time since epoch, [0;19] slices upto 19th index of string to fit strp requirements
    time_reported = datetime.datetime.strptime(str(time_reported)[0:19], '%Y-%m-%d %H:%M:%S').timestamp()

    current_time = datetime.datetime.now().timestamp()
    gap = (current_time - time_reported)/ 3600
    ###print(gap)

    if gap > 24 and gap < 48:
      updateProblem('re-reported', entry_id)
      sendmail(stationID)
      #if problem != 'Out of range':
      #sendmail(stationID)
    if (gap > 48):
     # if(gap > 48):
      
        updateProblem('persistent', entry_id)
        #sendmail(stationID)
        #if problem != 'Out of range':
          #sendmail()

#######
# CHECK IF PROBLEM EXISTED, CHANGE STATUS TO FIXED
#######
def  check_if_problem_existed(stationID, problem,NodeType,Value):
  # result = retrieveStatus(stationID,problem,NodeType,Value)
  if Value is not None:
    result=retrieveStatusWithValue(stationID,problem,NodeType,Value)
    # #print("Value is not none",Value)
  else:
    result=retrieveStatus(stationID,problem,NodeType)
    Value="-"
    #print(stationID, problem,NodeType,Value,"result :",len(result))

  

  if len(result) is not 0:
    ##print("Problem already reported",stationID,problem,NodeType,Value)
    entry_id = result[0][1]
    updateProblem('fixed', entry_id)

      
      

