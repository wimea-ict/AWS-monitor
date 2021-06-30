#function to report problems
########

import datetime

from database.retrieveQuery import retrieveStatus
from database.retrieveQuery import retrieveStatus_orig
#from retrieveQuery import retrieveStatus_orig
from database.retrieveQuery import insertProblem
from database.retrieveQuery import updateProblem
#from sendmail import sendmail

def reportProblemMethod(stationID,NodeType, classification_id,Value):
  result = retrieveStatus(stationID, classification_id,NodeType,Value)
  # print(stationID, classification_id,NodeType,Value)
  # print(result)

  # ##print(stationID, classification_id,NodeType,Value)
  if len(result) is 0:
    insertProblem(stationID, NodeType, classification_id, 'reported',Value)
    #sendmail()
  else :
    status = result[0][0]
    entry_id = result[0][1]
    time_reported = result[0][2]
    # get time since epoch, [0;19] slices upto 19th index of string to fit strp requirements
    time_reported = datetime.datetime.strptime(str(time_reported)[0:19], '%Y-%m-%d %H:%M:%S').timestamp()

    current_time = datetime.datetime.now().timestamp()
    gap = (current_time - time_reported)/ 3600

    if gap > 24 and gap < 48:
      updateProblem('re-reported', entry_id)
      # if problem != 'Out of range':
      #   sendmail()
    if (gap > 48):
      updateProblem('persistent', entry_id)
        #if problem != 'Out of range':
          #sendmail()

#######
# CHECK IF PROBLEM EXISTED, CHANGE STATUS TO FIXED
#######
def  check_if_problem_existed(stationID, problem,NodeType,Value):
  result = retrieveStatus(stationID,problem,NodeType,Value)
  # print(len(result),problem,Value,NodeType,stationID)
  if len(result) is not 0:
    ###print("=========================================FIXED================================================================================")
    entry_id = result[0][1]
    updateProblem('fixed', entry_id)
    ##print(len(result),stationID,problem,NodeType,Value)



def  check_if_problemExisted(stationID, problem,NodeType): #without value
  result = retrieveStatus_orig(stationID,problem,NodeType)
  ###print(len(result))
  if len(result) is not 0:
    entry_id = result[0][1]
    updateProblem('fixed', entry_id)
      
      

