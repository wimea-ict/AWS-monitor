from paths.directories import emailPath

messageLog = emailPath+'/mailHistory.txt'

f = open(messageLog, 'r+')
f.truncate(0)
f.write('userId,problem,date')
f.close()