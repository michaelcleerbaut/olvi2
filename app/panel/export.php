<?php  
    $crums = array();

    array_push($crums,array("title" => "Exporteren van gegevens","url" => "/panel/export"));

    
    switch($_GET['action']){
        default:
            $html .= Export::menu();
    }

    

    Template::view("core/header");
    echo build_crums($crums);    
    echo $html;
    Template::view("core/footer");


?>