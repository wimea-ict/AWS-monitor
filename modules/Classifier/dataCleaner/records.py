from dataCleaner.details import details

#checks for non
def checkForNones(listOfValues):
  #res should contain None indices in the list
  res = [i for i in range(len(listOfValues)) if listOfValues[i] == None]
  #if it contains any Nones ie if it has any values in it, we return True else false
  if len(res) == 0:
    #no Nones in the list
    return False
  elif len(res) != 0:
    #there's nones in the list
    return True


#this finds the record in an interval
def recordInInterval(dateArray, node, sID):
  #dateArray is an interval eg 0-15
  #only write if the value is not null
  strr = []
  time = ''
  if dateArray:

    for i in dateArray:
      k = str(i).replace('(','').replace(')','').replace('\'','').rstrip(',')
      records = details(node, sID, k)
      if records != [] and checkForNones(records[0]) == False:
        time = i 
        for l in records:
          strr = l     
        break  
  else:
  	if (node == 'TwoMeterNode'):
  		strr=('-','-')
  	if (node == 'TenMeterNode' or node == 'GroundNode'):
  		strr=('-','-','-')
  
  return strr, time
