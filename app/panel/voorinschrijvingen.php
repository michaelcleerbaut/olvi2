<?php  
    $crums = array();
    
    array_push($crums,array("title" => "Voorinschrijvingen","url" => "/panel/voorinschrijvingen"));
    

    switch($_POST['action']){
        case "update_inschrijving":
        $html .= Voorinschrijving::update_inschrijving($_POST);
        break;
    }

    switch($_GET['action']){
        case "show_all":
            $html .= Voorinschrijving::show_voorinschrijvingen($_GET['param1']);
            break;
        case "show":
            array_push($crums,array("title" => "Stroom {$_GET['param1']}","url" => "/panel/voorinschrijvingen/show_all/{$_GET['param1']}"));            
            $html .= Voorinschrijving::show_inschrijving($_GET['param2']);
            break;
        case "edit":
            array_push($crums,array("title" => "Stroom {$_GET['param1']}","url" => "/panel/voorinschrijvingen/show_all/{$_GET['param1']}"));            
            $html .= Voorinschrijving::edit_inschrijving($_GET['param2']);
            break;
        case "delete":
            $html .= Voorinschrijving::delete_leerling($_GET['param1']);
            header("Location: /panel/voorinschrijvingen/show_all/{$_GET['param2']}");
            exit;            
            break;
        case "uitschrijven":
            $html .= Voorinschrijving::uitschrijven($_GET['param1']);
            header("Location: /panel/voorinschrijvingen/show_all/{$_GET['param2']}");            
            break;            
        default:
            $html .= Voorinschrijving::menu();
    }


    Template::view("core/header");
        echo build_crums($crums);    
        echo $html;
    Template::view("core/footer");


?>