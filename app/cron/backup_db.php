<?php
 
    $db = new Backup_DB(array( 
        'driver'    => DB_DRIVER,  
        'host'      => DB_HOST, 
        'user'      => DB_USER, 
        'password'  => DB_PASS, 
        'database'  => DB_DB 
    ));
    
                          
    $backup = $db->backup();
    
    if(!$backup['error']){
        $filename = "../../".BACKUP_FOLDER.date("Ymd_Hi").".sql";                 
        file_put_contents($filename,$backup['msg']);
    } else { 
        echo 'An error has ocurred.'; 
    } 
?>