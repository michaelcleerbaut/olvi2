<?php
 
$prefix = $prefix != "" ? $prefix : "../";
$prefix = $prefix == "NONE" ? "" : $prefix;
 
require_once($prefix.'app/inc/config.inc.php');
require_once($prefix.'app/inc/mysql.functions.inc.php');
require_once($prefix.'lib/MyPDO.php');
require_once($prefix.'app/lib/Backup_DB.php');

$db = new Backup_DB(array( 
    'driver' => DB_DRIVER, 
    'host' => DB_HOST, 
    'user' => DB_USER, 
    'password' => DB_PASS, 
    'database' => DB_DB 
));

$backup = $db->backup();
 
if(!$backup['error']){     
    file_put_contents($prefix.BACKUP_FOLDER.date("Ymd_Hi").".sql",$backup['msg']);
} else { 
    mail("michael@mcreations.pro","Olvi: Error backup",$backup['error']); 
} 
?>