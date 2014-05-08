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
            $header_vars = array("panel_vak" => "panel_vak");
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
            $html .= Inschrijving::delete_leerling($_GET['param2']);
            header("Location: /panel/inschrijvingen/show_all/{$_GET['param1']}");
            exit;                        
        break;
        case "uitschrijven":
            $html .= Inschrijving::uitschrijven($_GET['param2']);
            header("Location: /panel/inschrijvingen/show_all/{$_GET['param1']}");            
        break;
        default:
            $html .= Inschrijving::menu();
    }
        

    Template::view("core/header",$header_vars);
    echo build_crums($crums);    
    echo $html;
    Template::view("core/footer");

?>