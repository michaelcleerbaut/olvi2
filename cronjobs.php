<?php
    if($_GET['c'] != ""){
        $cron = new Cronjob($_GET['c']);
        $cron->execute();
    } else {
        Cronjob::find_possible_cron();
    }
?>
