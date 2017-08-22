# Overview
With these files you can monitor if a Remote Desktop Windows server goes down, restarts, has connectivity issues or other proxy/internet related issues. You can also use it to backup files at a specific location, once every 24 hours (or whatever interval you wish).

# STEP1: Setup DBSM on web hosting

Copy dbsm-setup.php and dbsm.php into a folder on your web hosting (I use a subdomain but a folder works the same). For example: http://YourWebsite.com/dbsm/

**dbsm-setup.php**
Run dbsm-setup.php to create a database and other things that are needed. If you don't get any error messages when you run dbsm-setup.php you can delete the file. Using the example above you would run the file via: http://YourWebsite.com/dbsm/dbsm-setup.php

**dbsm.php**
Edit dbsm.php and add the names of the Remote Desktops you want to monitor.
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

**Backup**


**Server monitor**


**NOTE**
I have not used a database so DBSM cannot remember the details you enter. If you close DBSM.exe you will have to enter all the detail again so I suggest you copy all the details into a text file and keep it with DBSM.exe so you can easily copy the detail back in after a server restart etc.
