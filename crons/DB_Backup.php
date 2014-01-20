<?php

require_once(ROOT_PATH.'app/inc/config.inc.php');


$db = new Backup_DB(array( 
    'driver' => DB_DRIVER, 
    'host' => DB_HOST, 
    'user' => DB_USER, 
    'password' => DB_PASS, 
    'database' => DB_DB 
));

$backup = $db->backup();
 
if(!$backup['error']){     
    file_put_contents(ROOT_PATH.BACKUP_FOLDER.date("Ymd_Hi").".sql",$backup['msg']);
} else { 
    mail("michael@mcreations.pro","Olvi: Error backup",$backup['error']); 
} 
?>
