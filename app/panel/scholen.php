<?php  
    $crums = array();

    array_push($crums,array("title" => "Scholen","url" => "/panel/vip_gezondheidsproblemen"));


    switch($_POST['action']){
        case "insert_school":
            $html .= School::insert_school($_POST);
            break;
        case "update_school":
        $html .= School::update_school($_POST);
        break;
    }



    switch($_GET['action']){
        case "show_all":
            $html .= School::show_scholen();
            break;
        case "add":
            $html .= School::add_school();
            break;
        case "edit":
            $html .= School::edit_school($_GET['param1']);
            break;
        case "delete":
            $html .= School::delete_school($_GET['param1']);
            header("Location: /panel/scholen/");
            exit;            
            break;
        default:
            $html .= School::menu();
    }


    Template::view("core/header");
    echo build_crums($crums);    
    echo $html;
    Template::view("core/footer");


?>