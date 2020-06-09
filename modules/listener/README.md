WIMEA-ICT AWS LISTENER.
The module listens on a predefined port number for incoming TCP connections from remote Automatic Weather Stations (AWS). On receiving the packets/ string messages, the listener inserts what has been received in a file and another copy inserted into the database. 

How to use the module:   

project is written in node js
to run, simply clone project, 
run npm i in the directory,
run node app.js
to run in server environment, 
install pm2 with npm install pm2 --global
then pm2 start app.js