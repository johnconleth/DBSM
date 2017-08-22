# Setup DBSM on web hosting

Copy dbsm-setup.php and dbsm.php into a folder on your web hosting (I use a subdomain but a folder works the same). For example: http://YourWebsite.com/monitor

Run dbsm-setup.php to create a database and other things that are needed. If you don't get any error messages when you run dbsm-setup.php you can delete the file.

Edit dbsm.php and add the names of the Remote Desktops you want to monitor.

# Setup CRON
Add the following CRON task set to run every hour:
```
php /home/YOURACCOUNT/LOCATION-OF-DBSM/dbsm.php >/dev/null 2>&1
```

# Setup DBSM on Remote Desktop
Download DBSM.exe onto your Remote Desktop and run it.
