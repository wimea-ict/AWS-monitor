# importing os module  
import os 
  
# Path 
analyticsPath = "/var/www/html/awsmonitor/aws-monitor/public/files/"
analytics_path = os.path.relpath(analyticsPath) 
  
# Path of Start directory 
#start = "/var/www/html/awsmonitor/aws-monitor/public/"
emailTemplate = "/var/www/html/awsmonitor/modules/analyzer/wimea_analyzer_python/reports/"

# Compute the relative file path 
# to the given path from the  
# the given start directory. 

emailPath = os.path.relpath(emailTemplate)

#email details
email = "aws.monitor.mail@gmail.com"
emailPass = "wimeaAWSMAIL"

# Print the relative file path 
# to the given path from the  
# the given start directory. 
#print(relative_path) 
  