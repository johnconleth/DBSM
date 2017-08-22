# Overview
With these files you can monitor if a Remote Desktop Windows server goes down, restarts, has connectivity issues or other proxy/internet related issues. You can also use it to backup files at a specific location, once every 24 hours (or whatever interval you wish).

# STEP1: Setup DBSM on web hosting

Copy dbsm-setup.php and dbsm.php into a folder on your web hosting (I use a subdomain but a folder works the same). For example: http://YourWebsite.com/dbsm/

**dbsm-setup.php**
Run dbsm-setup.php to create a database and other things that are needed. If you don't get any error messages when you run dbsm-setup.php you can delete the file. Using the example above you would run the file via: http://YourWebsite.com/dbsm/dbsm-setup.php

**dbsm.php**
Edit dbsm.php and add the names of the Remote Desktops you want to monitor, along with an email address that you want notifications to go to.
```php
$notifyEmail = 'youremail@address.com'; // << enter the email address you want to receive notifications to
$serverNames = ['servername',]; // << List all servers - example: ['server1','vps2','myvps',];
```

# STEP2: Setup CRON
Add the following CRON task set to run every hour:
```
php /home/YOURACCOUNT/LOCATION-OF-DBSM/dbsm.php >/dev/null 2>&1
```

# STEP3: Setup DBSM on Remote Desktop
Download DBSM.exe onto your Remote Desktop and run it.

**ENABLE BACKUP**
*Tick the checkbox to enable this feature*
1. Fill in the SM2 Database Location with the filepath to SM2 (you can get this by clicking on Open Data Folder in SM2 and copying the filepath.
2. Fill in the SM2 Backup Destination (this can be any mapped location like your Dropbox folder, a mapped FTP drive, a USB drive etc.)

**ENABLE UPTIME MONITOR**
*Tick the checkbox to enable this feature*
1. Fill in the *DBSM script URL* with the full path to the dbsm.php file you uploaded to your web hosting PLUS *?server=name_of_server* at the end of the script. For example: http://YourWebsite.com/dbsm/dbsm.php?server=servername
2. (optional) Fill in the *Proxies - IP:PORT separated by commas* textarea with a list of proxies:ports separated by commas. For example: *192.168.0.10:8080,192.168.0.11:8080* - this is optional, if you leave it blank it will not use a proxy and connect via your Remote Desktop IP.

**CLICK RUN ON SCHEDULE**
When you click 'Run on Schedule' the program will run the backup automatically at 1.30AM and will run the uptime monitor every hour on the hour.

**NOTES**
I have not used a database so DBSM cannot remember the details you enter. If you close DBSM.exe you will have to enter all the details again so I suggest you copy all the details into a text file and keep it with DBSM.exe so you can easily copy the detail back in after a server restart etc.

Notification emails come from noreply@YourWebsite.com so remember to whitelist these emails as they will most likely go straight into SPAM if you don't setup a rule to mark the emails as safe.
