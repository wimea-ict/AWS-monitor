from database.connection import mydb

def contacts(location): 
  print(location,'.........contacts....')
  cursor = mydb.cursor(prepared = True)
  
  sqlStatement = "SELECT users.name as name,users.email as email, maillist.userID as userID, stations.Location as location FROM maillist INNER JOIN users ON maillist.userID = users.id LEFT JOIN stations ON maillist.stationID = stations.station_id WHERE status = 1 AND stationID = "+str(location)
  #cursor.execute(sqlStatement,(location,))
  cursor.execute(sqlStatement)
  result = cursor.fetchall()
  
  firstname = []
  emails = []
  id = []

  for a_contact in result:
      #print(a_contact[0])
      firstname.append(str(a_contact[0].decode()))
      emails.append(str(a_contact[1].decode()))
      id.append(str(a_contact[2]))
 
  recipients = zip(firstname,emails,id)
    
  return recipients 


  