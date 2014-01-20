<?php

    require_once(ROOT_PATH.'/app/inc/cronjobs.functions.inc.php');
  
    $crums = array();

    array_push($crums,array("title" => "Cron jobs","url" => "/panel/cron"));

    
    switch($_POST['action']){
        case "insert":        
            $html .= insert_cron($_POST);
            break;
        case "update":        
            $html .= update_cron($_POST);
            break;
        case "update_gebruiker":
        $html .= Gebruiker::update_gebruiker($_POST);
        break;
    }



    switch($_GET['action']){
        case "uitvoeren":
            execute_cron($_GET['param1']);
            header("Location: /panel/cron/");
            exit;             
        break;
        case "add":
            $html .= cronjob_form();
        break;
        case "edit":        
            $html .= cronjob_form($_GET['param1']);
        break;
        case "delete":
            $html .= delete_cron($_GET['param1']);
            header("Location: /panel/cron/");
            exit;
        break;
        default:
            $html .= list_cronjobs();
    }

    

    Template::view("core/header");
    echo build_crums($crums);    
    echo $html;
    Template::view("core/footer");


?>