from database.connection import mydb
from paths.directories import emailPath

def GENERATEMAILTEMPLATE(firstname):
  cursor = mydb.cursor(buffered=True)
  sensorIssue = 'Sensor_off'
  #problemList =  ['GroundNode_off','SinkNode_off','TwoMeterNode_off','TenMeterNode_off']
  f = open(emailPath+"/emaildetails.txt","w") 
  end = '\n' "Regards Admin."

  
    #sqlSTMT = "SELECT id, NodeType, when_reported, status FROM DetectedAnalyzerProblems WHERE Problem = '"+str(problem)+"' AND stationID = "+str(stationID)+" ORDER BY id DESC LIMIT 1"
  sqlSTMT = "SELECT DetectedAnalyzerProblems.stationID as stationid,DetectedAnalyzerProblems.NodeType as Nodetype, stations.StationName as name, stations.Location as location, DetectedAnalyzerProblems.Problem as problem, DetectedAnalyzerProblems.status as status,DetectedAnalyzerProblems.id as id, DetectedAnalyzerProblems.when_reported as when_reported,DetectedAnalyzerProblems.Value as Value FROM DetectedAnalyzerProblems INNER JOIN stations ON DetectedAnalyzerProblems.stationID = stations.station_id ORDER BY id DESC LIMIT 1"
  cursor.execute(sqlSTMT)
  problemDetails = cursor.fetchone()

  if len(problemDetails) != 0:
    if problemDetails[4] != sensorIssue:
      if problemDetails[5] == "reported":
        emailtemplate = "Dear "+str(firstname).replace('\'','').replace(']','').replace('[','')+","  '\n' "AWS located at "+str(problemDetails[3])+", station with id "+str(problemDetails[0])+" has a "+str(problemDetails[4])+" problem. The problem was identified on "+str(problemDetails[7])+", and has been reported."
        f.write(emailtemplate)
        f.write(end)
        f.close()
      elif problemDetails[5] == "re-reported":
        if problemDetails == "reported":
          emailtemplate = "Dear "+str(firstname).replace('\'','').replace(']','').replace('[','')+","  '\n' "AWS located at "+str(problemDetails[3])+", station with id "+str(problemDetails[0])+" has a "+str(problemDetails[4])+" problem. The problem was identified on "+str(problemDetails[7])+", and has been reported the second time."
          f.write(emailtemplate)
          f.write(end)
          f.close()
      elif problemDetails[5] == "persistent":
        if problemDetails == "reported":
          emailtemplate = "Dear "+str(firstname).replace('\'','').replace(']','').replace('[','')+","  '\n' "AWS located at "+str(problemDetails[3])+", station with id "+str(problemDetails[0])+" has a "+str(problemDetails[4])+" problem. The problem was identified on "+str(problemDetails[7])+", and has been reported the third time and it's now persistent."
          f.write(emailtemplate)
          f.write(end)
          f.close()
    else:
      if problemDetails[5] == "reported":
        emailtemplate = "Dear "+str(firstname).replace('\'','').replace(']','').replace('[','')+","  '\n' "AWS located at "+str(problemDetails[3])+", station with id "+str(problemDetails[0])+" has a "+str(problemDetails[4])+" problem, the missing Value is "+str(problemDetails[8])+" in the "+str(problemDetails[1])+". This problem was identified on "+str(problemDetails[7])+", and has been reported."
        f.write(emailtemplate)
        f.write(end)
        f.close()
      elif problemDetails[5] == "re-reported":
        if problemDetails == "reported":
          emailtemplate = "Dear "+str(firstname).replace('\'','').replace(']','').replace('[','')+","  '\n' "AWS located at "+str(problemDetails[3])+", station with id "+str(problemDetails[0])+" has a "+str(problemDetails[4])+" problem, the missing Value is "+str(problemDetails[8])+" in the "+str(problemDetails[1])+". This problem was identified on "+str(problemDetails[7])+", and has been reported the second time."
          f.write(emailtemplate)
          f.write(end)
          f.close()
      elif problemDetails[5] == "persistent":
        if problemDetails == "reported":
          emailtemplate = "Dear "+str(firstname).replace('\'','').replace(']','').replace('[','')+","  '\n' "AWS located at "+str(problemDetails[3])+", station with id "+str(problemDetails[0])+" has a "+str(problemDetails[4])+" problem, the missing Value is "+str(problemDetails[8])+" in the "+str(problemDetails[1])+". This problem was identified on "+str(problemDetails[7])+", and has been reported the third time and it's now persistent."
          f.write(emailtemplate)
          f.write(end)
          f.close()
  return problemDetails[3], str(problemDetails[4]), str(problemDetails[7])

      
