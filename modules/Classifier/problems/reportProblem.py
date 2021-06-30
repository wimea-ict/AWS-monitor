#function to report problems
########

import datetime
from problems.retrieveQuery import retrieveStatus
from problems.retrieveQuery import insertProblem
from problems.retrieveQuery import updateProblem
#from stations.sendmail import sendmail

def reportProblemMethod(stationID,NodeType, problem):
  result = retrieveStatus(stationID, problem,NodeType)
  #print(len(result))
  if len(result) is 0:
    insertProblem(stationID,NodeType, problem, 'reported')
    print(stationID,NodeType, problem, 'reported')
    #sendmail(stationID, problem, NodeType)
  else :
    status = result[0][0]
    entry_id = result[0][1]
    time_reported = result[0][2]
    # get time since epoch, [0;19] slices upto 19th index of string to fit strp requirements
    time_reported = datetime.datetime.strptime(str(time_reported)[0:19], '%Y-%m-%d %H:%M:%S').timestamp()

    current_time = datetime.datetime.now().timestamp()
    gap = (current_time - time_reported)/ 3600

    if status == 'reported' and gap > 24 and gap < 48:
      updateProblem('re-reported', entry_id)
      #sendmail()
    if status == 're-reported':
     if(gap > 48):
        updateProblem('persistent', entry_id)
        #sendmail()

#######
# CHECK IF PROBLEM EXISTED, CHANGE STATUS TO FIXED
#######
def  check_if_problem_existed(stationID, problem,NodeType):
  result = retrieveStatus(stationID,problem,NodeType)

  if len(result) is not 0:
    entry_id = result[0][1]
    updateProblem('fixed', entry_id)

      
      

