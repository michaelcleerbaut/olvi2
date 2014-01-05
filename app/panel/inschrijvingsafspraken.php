<?php 
    $crums = array();

    array_push($crums,array("title" => "Inschrijvingsafspraken","url" => "/panel/inschrijvingsafspraken"));

    switch($_POST['action']){
        case "insert_afspraak":
            $html .= InschrijvingsAfspraak::insert_afspraak($_POST);
        break;
        case "update_afspraak":
            $html .= InschrijvingsAfspraak::update_afspraak($_POST);
        break;
    }


    
    switch($_GET['action']){
        case "show":
            $html .= InschrijvingsAfspraak::show_afspraken();
        break;
        case "add":
            array_push($crums,array("title" => "Stroom {$_GET['param1']}","url" => "/panel/inschrijvingsafspraken/show_all/{$_GET['param1']}"));
            $html .= InschrijvingsAfspraak::add_afspraak($_GET['param1']);
        break;
        case "delete":
            $html .= InschrijvingsAfspraak::delete_afspraak($_GET['param1']);
            header("Location: /panel/inschrijvingsafspraken/show");
            exit;                        
        break;
        default:
            $html .= InschrijvingsAfspraak::menu();
    }
    


    Template::view("core/header");
    echo build_crums($crums);    
    echo $html;
    Template::view("core/footer");

?>