<?php
    
    require_once('app/inc/preload.inc.php');
    
    $cron = new Cronjob();
    $cron->root_path = ROOT_PATH;
    $cron->find_and_execute_next_possible_cron();
    
?>
