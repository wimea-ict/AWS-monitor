import datetime
from problems.retrieveQuery import retrieveQuery
from nodes.scanNodes import scanNodes 
from database.reportProblem import reportProblemMethod
from database.reportProblem import check_if_problem_existed
from database.connection import mydb
#from stations.sendmail import sendmail
#from outliers.outliers import Check4Outliers
import array
#from problems.packetdropping import packetDropping
#from problems.poweroff import poweroffMethod


def stations():
  #scan stations for on/off status
  # print("***********************************************************")
  sql = "SELECT `station_id` FROM `stations` WHERE `station_id` > 47 AND stationCategory='aws' ORDER by station_id DESC" # > 49, #50
  stations_id_result = retrieveQuery(sql)
  result = stations_id_result[0]
  #print(result," result")

  list_of_tables = ['GroundNode', 'SinkNode', 'TenMeterNode', 'TwoMeterNode']
  
  list_of_largest = []
  #array_of_clusters = array
  #


  for stationID in result:
    i=0
    list_of_gaps = []

    print("_______________________________________",stationID[0],"________________________________________________")
    list_of_latest_hours = []
    for table in list_of_tables: #Groundnode
        
        sql = "select hoursSinceEpoch from " +table+ " where `stationID` = " +str(stationID[0])+ " ORDER BY id  DESC limit 1"
        hours_result = retrieveQuery(sql)
        if not hours_result[0]:
          resultH = 0
        else:
          resultH = hours_result[0][0][0]
          list_of_latest_hours.append(resultH)
          i+=1
        scanNodes(stationID[0],str(table))

      
    largest = 0
    for time in list_of_latest_hours:
      if (time!=None):
        if (time > largest):
          largest = time
    #print(largest)
    if largest!=0:
      pos_of_largest = list_of_latest_hours.index(largest)
    #selecting from the clusters table
    #for table in list_of_tables:
    nodetype = list_of_tables[pos_of_largest]
    sql = "select cluster from ReportIntervalClusters where `stationID` = "+str(stationID[0])+" AND `Node`='"+nodetype+"' ORDER BY id  DESC limit 1"
    #cluster_for_a_station = retrieveQuery(sql)
    cursor = mydb.cursor()
    # Read records
    #lst_sql=list(sql)
    cursor.execute(sql)
    row = cursor.fetchall()
    list_of_clusters=[list(i) for i in row]

    if not list_of_clusters:
      most__frequent_cluster = 1
    else:                                                     #(int(list_of_clusters[0][0][2]!=0)):
      most_frequent_cluster=int(list_of_clusters[0][0][2])
    
    gap = datetime.datetime.now().timestamp() / 3600 - largest
    list_of_largest.append((stationID[0],largest))
    list_of_gaps.append((stationID[0],gap))
    #print(gap)

    #last time each station received data
    list_of_stationIDs_that_are_on = []
    #print(list_of_gaps)
    for station_tuple in list_of_gaps:
      #if the gap is greater than 24hours then station_off
      if (int(station_tuple[1]) <= 24):
         #append a tuple because the function below expects a tuple
         list_of_stationIDs_that_are_on.append((station_tuple[0]))
         Value=None
         check_if_problem_existed(str(stationID[0]),'Station_off',str(nodetype),Value)
         print("===========================Station ON============================")
         
      else:
       #changed most frequent cluster multipy by 1000 to check for 24hrs else if (int(station_tuple[1]) >(most_frequent_cluster*1000)
     # report problem
          Value=None
          reportProblemMethod(str(stationID[0]),'Station_off',str(nodetype),Value)
          #reportProblemMethod(stationID,problem,NodeType,Value)
          #print(int(station_tuple[1]))
          print("XXXXXXXXXXXXXXXXXX",str(stationID[0]), 'Station_off XXXXXXXXXXXXXXXXXXXXX')
          break;
    #print(list_of_stationIDs_that_are_on)

    
    print('----------------------------------------------------------------------------------------------\n\n')
          #print('                   @ NODE REPORT                    ')
          #print()


