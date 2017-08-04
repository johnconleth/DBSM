<?php
/* DBSM Setup Script v0.1 by John Conleth */
    class MyDB extends SQLite3 {
      function __construct() {
         $this->open('dbsm.db');
      }
    }
    $db = new MyDB();
    if(!$db) {
        echo "ERROR - ".$db->lastErrorMsg()."<br>\n";
    } else {
      echo "SUCCESS - Opened new or existing database<br>\n";
    }
    // check if table exits in database
    $sql = "SELECT id FROM sqlite_master WHERE type='table' AND name='pings'; ";
    $res = $db->exec($sql);
    if(!$res){
        $sql =<<<EOF
      CREATE TABLE pings
      (id INTEGER PRIMARY KEY     AUTOINCREMENT,
      server         TEXT    NOT NULL,
      ip        CHAR(50)    NOT NULL,
      timestamp         INTEGER     NOT NULL);
EOF;
        $ret = $db->exec($sql);
        if(!$ret){
            echo "ERROR - ".$db->lastErrorMsg()."<br>\n";
        } else {
            echo "SUCCESS - Table(s) created<br>\n";
        }
        $db->close();
        
        if(!$_SERVER['HTTP_HOST']){
            echo "ERROR - HTTP_HOST is empty!";
        } else {
            echo "SUCCESS - HTTP_HOST works (make sure to add noreply@".$_SERVER['HTTP_HOST']." to your email contacts so notifications don't go into SPAM)<br>\n";
        }
    }
    echo "===========<br>\n"; 
    echo "If you didn't get any errors - you're good to go and should delete this file <em>dbsm-setup.php</em>\n";
