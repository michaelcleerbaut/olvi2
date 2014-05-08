<?php 
    $crums = array();

    array_push($crums,array("title" => "Uitschrijvingen","url" => "/panel/uitschrijvingen"));


    switch($_GET['action']){
        case "show":
            array_push($crums,array("title" => "Alles","url" => "/panel/uitschrijvingen/show_all/{$_GET['param1']}"));
            $html .= Uitschrijving::show_uitschrijving($_GET['param1']);            
        break;
        case "delete":
            $html .= Uitschrijving::delete_leerling($_GET['param1']);
            header("Location: /panel/uitschrijvingen/show_all/{$_GET['param2']}");
            exit;            
            break;                
        case "delete_leerling":
            $html .= Uitschrijving::delete_leerling($_GET['param1'],"leerling");
            header("Location: /panel/uitschrijvingen/show_all/{$_GET['param2']}");
            exit;            
            break;                
        default:
            $html .= Uitschrijving::show_uitschrijvingen();
            $html .= Uitschrijving::show_uitschrijvingen_zonder_inschrijving();
            $header_vars = array("panel_vak" => "panel_vak");
    }
    


    Template::view("core/header",$header_vars);
    echo build_crums($crums);    
    echo $html;
    Template::view("core/footer");

?>