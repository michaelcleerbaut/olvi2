<?php
    if($_GET['c'] != ""){
        $cron = new Cronjob($_GET['c']);
        $cron->execute();
    } else {
        Cronjob::find_and_execute_next_possible_cron();
    }
?>
