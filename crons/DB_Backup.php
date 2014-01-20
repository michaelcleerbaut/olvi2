<?php
 
require_once('/app/inc/config.inc.php');
require_once('/app/inc/mysql.functions.inc.php');
require_once('/lib/MyPDO.php');
require_once('/app/lib/Backup_DB.php');

$db = new Backup_DB(array( 
    'driver' => DB_DRIVER, 
    'host' => DB_HOST, 
    'user' => DB_USER, 
    'password' => DB_PASS, 
    'database' => DB_DB 
));

$backup = $db->backup();
 
if(!$backup['error']){ 
    //echo nl2br($backup['msg']);
    file_put_contents(BACKUP_FOLDER.date("Ymd_Hi").".sql",$backup['msg']);
     
} else { 
    echo 'An error has ocurred.'; 
} 
?>