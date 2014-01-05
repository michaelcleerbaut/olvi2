<?php 
    $crums = array();

    array_push($crums,array("title" => "Inschrijvingen","url" => "/panel/inschrijvingen"));

    switch($_POST['action']){
        case "update_inschrijving":
            $html .= Inschrijving::update_inschrijving($_POST);
        break;
    }


    switch($_GET['action']){
        case "show_all":
            $html .= Inschrijving::show_inschrijvingen($_GET['param1']);
        break;
        case "show":
            array_push($crums,array("title" => "Stroom {$_GET['param1']}","url" => "/panel/inschrijvingen/show_all/{$_GET['param1']}"));
            $html .= Inschrijving::show_inschrijving($_GET['param2']);
        break;
        case "edit":
            array_push($crums,array("title" => "Stroom {$_GET['param1']}","url" => "/panel/inschrijvingen/show_all/{$_GET['param1']}"));
            $html .= Inschrijving::edit_inschrijving($_GET['param2']);
        break;
        case "delete":
            $html .= Inschrijving::delete_inschrijving($_GET['param2']);
            header("Location: /panel/inschrijvingen/show_all/{$_GET['param1']}");
            exit;                        
        break;
        default:
            $html .= Inschrijving::menu();
    }
    


    Template::view("core/header");
    echo build_crums($crums);    
    echo $html;
    Template::view("core/footer");

?>