import datetime
from datetime import datetime, timedelta
import os
import sys
from database.retrieveQuery import retrieveQuery
from database.retrieveQuery import Oftenstationoff
from paths.directories import analytics_path
from database.connection import mydb
import string
import itertools
import csv
import array

def analytics():
	# dirname = (os.path.abspath(__file__))
	# print(emailPath)
	now =datetime.today()-timedelta(days=7)
	#print(int(str(now)))

	sql = "SELECT `station_id`,`StationName` FROM `stations` WHERE `StationCategory`='aws'" # > 49, #50
	stations = retrieveQuery(sql)
	result = stations[0]
	print(stations[0])

	list_of_tables = ['GroundNode', 'SinkNode', 'TenMeterNode', 'TwoMeterNode']
	# out = list(itertools.chain(*tuple))

	with open(analytics_path+"/stationperfomances.csv","w+", newline='' ) as file:
		writer= csv.writer(file, delimiter=',')
		writer.writerow(['stations','often_off'])

		no_off=" "
		
		for station in result:
			frq =[]
			for table in list_of_tables:

				no_off=Oftenstationoff(str(station[0]),table)
				#frq=int(no_off[0][0])
				t=int(no_off[0][0])
				frq.append(t)
				#print("+++++ "+str(station[1]),int(sum(frq)),table+" +++++")
				#station.append(no_off)
			print(str(station[1]),str(sum(frq)),table)

			writer.writerow([str(station[1]),str(sum(frq))])
		

	#Problems mostly faced by the awses
	sql = "SELECT DISTINCT(`id`), problem_description FROM `problem_classification` WHERE id > '2'" # > 49, #50
	stations = retrieveQuery(sql)
	Problms = stations[0]
	print(stations[0])


	with open(analytics_path+"/awsproblems.csv","w+", newline='' ) as file:
		writer= csv.writer(file, delimiter=',')
		writer.writerow(['Problems','Frequency'])
		for classification_id in Problms:
			sqll= "SELECT COUNT(`classification_id`) FROM `problems`WHERE classification_id='"+str(classification_id[0])+"' AND when_reported > '"+str(now)+"' " # > 49, #50
			rst = retrieveQuery(sqll)
			frequencies = rst[0]
			for frequency in frequencies:
				print(frequency[0],str(classification_id[1]))
				writer.writerow([str(classification_id[1]),str(frequency[0])])
				#print()
				break;




        


