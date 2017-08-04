<?php
/* DBSM Uptime Script v0.1 by John Conleth */
$notifyEmail = 'youremail@address.com'; // << enter the email address you want to receive notifications to
$serverNames = ['servername',]; // << List all servers - example: ['server1','vps2','myvps',];



/* DO NOT EDIT BELOW THIS LINE */

class MyDB extends SQLite3 {
    function __construct() {
        $this->open('dbsm.db');
    }
}
$db = new MyDB();

if(!$db) {
    echo $db->lastErrorMsg();
} else {
    
    if(isset($_GET['server'])){
    // visit from server to uptime script 
    $sql = "INSERT INTO pings (server,ip,timestamp) VALUES ('".$_GET['server']."','".$_SERVER['REMOTE_ADDR']."',".time()."); ";
        if(!$db->exec($sql)){
            echo $db->lastErrorMsg();
        }
?>
<html>
    <head><title>DBSM</title></head>
    <body>
        <p id="serverip"><?=$_SERVER['REMOTE_ADDR']?></p>
    </body>
</html>
<?php
    } else {
    // check if the server has contacted this uptime script
    $pastHour = time() - (60 * 60);
    foreach($serverNames as $server){
        $sql = "SELECT * FROM pings WHERE server = '".$server."' AND timestamp > ".$pastHour."; ";
        $ret = $db->querySingle($sql);
        if(!$ret || count($ret) == 0){
            if($db->lastErrorMsg() != "not an error"){
                $errorMessage = ''.$db->lastErrorMsg();
            }
            else {
                $errorMessage = 'Error: Remote Desktop has not contacted the DBSM Uptime Script within the last hour.';
            }
            $subject = 'NOTICE: '.$server;
            $message = 'An error has been encountered with one of your Remote Desktops or Proxies:'. "\r\n" .
                        '==========='. "\r\n" .
                        'Remote Desktop (server): '.$server. "\r\n" .
                        $errorMessage. "\r\n" .
                        '=========='. "\r\n" .
                        'DBSM Uptime Script';
            $headers = 'From: noreply@'.$_SERVER['HTTP_HOST'] . "\r\n" .
                'Reply-To: noreply@'.$_SERVER['HTTP_HOST'] . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            
            mail($notifyEmail, $subject, $message, $headers);
        }
        else {
                echo "It did ping in the last hour - send NO email!<br>\n";
        }
    }
    
    }
}
$db->close();
