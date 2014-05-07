<?php 
    $crums = array();

    array_push($crums,array("title" => "Uitschrijvingen","url" => "/panel/uitschrijvingen"));


    switch($_GET['action']){
        case "show":
            array_push($crums,array("title" => "Alles","url" => "/panel/uitschrijvingen/show_all/{$_GET['param1']}"));
            $html .= Uitschrijving::show_uitschrijving($_GET['param1']);
        break;        
        default:
            $html .= Uitschrijving::show_uitschrijvingen();
    }
    


    Template::view("core/header");
    echo build_crums($crums);    
    echo $html;
    Template::view("core/footer");

?>