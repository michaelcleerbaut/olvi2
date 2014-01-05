<?php  
    $crums = array();

    array_push($crums,array("title" => "Gebruikers","url" => "/panel/gebruikers"));

    
    switch($_POST['action']){
        case "insert_gebruiker":
            $html .= Gebruiker::insert_gebruiker($_POST);
            break;
        case "update_gebruiker":
        $html .= Gebruiker::update_gebruiker($_POST);
        break;
    }



    switch($_GET['action']){
        case "show_all":
            $html .= Gebruiker::show_gebruikers();
            break;
        case "show":
            $html .= Gebruiker::show_gebruiker($_GET['param1']);
            break;
        case "add":
            $html .= Gebruiker::add_gebruiker();
            break;
        case "edit":
            $html .= Gebruiker::edit_gebruiker($_GET['param1']);
            break;
        case "delete":
            $html .= Gebruiker::delete_gebruiker($_GET['param1']);
            header("Location: /panel/gebruikers/show_all");
            exit;            
            break;
        default:
            $html .= Gebruiker::menu();
    }

    

    Template::view("core/header");
    echo build_crums($crums);    
    echo $html;
    Template::view("core/footer");


?>