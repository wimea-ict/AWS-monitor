import smtplib

from string import Template
import os
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

from reports.emailTemplate import GENERATEMAILTEMPLATE
from reports.contacts import contacts
from database.connection import mydb
from paths.directories import emailPath
from paths.directories import email
from paths.directories import emailPass


MY_ADDRESS = email
PASSWORD = emailPass

    
def read_template(filename):
    with open(filename, 'r', encoding='utf-8') as template_file:
        template_file_content = template_file.read()
    return Template(template_file_content)

def compare(file, string):
    contents = []
    with open(file) as fp:
        line = fp.readline()
        cnt = 0
        while line:
            line = fp.readline() 
            if len(line) != 0:
                contents.append(line.strip())      
            cnt += 1
    #print(contents)               
    for i in contents:
        if i == string:
            return True 
        else:
            continue                     
            

def sendmail(stationID):
    print("sendmail")
    cursor = mydb.cursor(buffered=True)
    sqlStatement = "SELECT `stationID` FROM `DetectedAnalyzerProblems` ORDER BY id DESC LIMIT 1"
    cursor.execute(sqlStatement)
    result = cursor.fetchone()
    
    if result[0] == stationID:
        print("id sendmail",result[0])
        #contacts returns a zip object of name and respective email
        recipients = contacts(stationID) 
    
    
        message_template = read_template(emailPath+'/emaildetails.txt')
        PATH = os.getcwd()
        #print(PATH)
        #set up the SMTP server
        s = smtplib.SMTP(host='smtp.gmail.com',port = 587)
        s.connect(host='smtp.gmail.com',port = 587)
        s.ehlo()
        s.starttls()
        s.login(MY_ADDRESS, PASSWORD)
    
        # For each contact, send the email:
        #recipients is a zip object containing name and its email
        for i in recipients:
            msg = MIMEMultipart() # create a message
            
            location, problem, time = GENERATEMAILTEMPLATE(i[0])
            
            message_template = read_template(emailPath+'/emaildetails.txt')
            EmaildetailsPath = emailPath+'/emaildetails.txt' 
            messageLog = emailPath+'/mailHistory.txt'

            log = open(messageLog,"a") 
            
            details = i[2]+','+problem+','+time
            
            logCheck = compare(messageLog, details)

            if logCheck == None:
                log.write('\n'+details)
                if os.stat(EmaildetailsPath).st_size != 0:
                    #this is where we check for an empty template
                    message = message_template.substitute(PERSON_NAME=i[0].title())
                    #setup the parameters of the message
                    msg['From']=MY_ADDRESS
                    msg['To']=i[1]
                    msg['Subject']=str(location)+" STATION ISSUES"
        
                    #add in the message body
                    msg.attach(MIMEText(message, 'plain'))
        
                    s.send_message(msg)
                    print('message sent to..',i[0])
                   
                else:
                    del msg
        
         # Terminate the SMTP session and close the connection
        s.quit()