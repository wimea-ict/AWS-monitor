# importing os module  
import os 
  
# Path 
analyticsPath = "/var/www/html/awsmonitor/aws-monitor/public/files/"

analytics_path = os.path.relpath(analyticsPath) 
  
overPath = "/var/www/html/awsmonitor/aws-monitor/public/stationsData/weatherOverview"
overviewPath = os.path.relpath(overPath)
# Path of Start directory 
#start = "/var/www/html/awsmonitor/aws-monitor/public/"
emailTemplate = "/var/www/html/awsmonitor/modules/analyzer/wimea_analyzer_python/stations/"

cleanedFiles = "/var/www/html/awsmonitor/aws-monitor/public/stationsData/cleanedData/"

# Compute the relative file path 
# to the given path from the  
# the given start directory. 

cleanedDataPath = os.path.relpath(cleanedFiles)

emailPath = os.path.relpath(emailTemplate)

# Print the relative file path 
# to the given path from the  
# the given start directory. 
print(cleanedFiles) 
  