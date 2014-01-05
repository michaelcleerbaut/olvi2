<?php  
    $crums = array();

    array_push($crums,array("title" => "Studiekeuzes","url" => "/panel/studiekeuzes"));


    switch($_POST['action']){
        case "insert_studiekeuze":
            $html .= Studiekeuze::insert_studiekeuze($_POST);
            break;
        case "update_studiekeuze":
        $html .= Studiekeuze::update_studiekeuze($_POST);
        break;
    }




    switch($_GET['action']){
        case "show_all":
            $html .= Studiekeuze::show_studiekeuzes();
            break;
        case "show":
            $html .= Studiekeuzes::show_studiekeuze();
            break;
        case "add":
            $html .= Studiekeuze::add_studiekeuze();
            break;
        case "edit":
            $html .= Studiekeuze::edit_studiekeuze($_GET['param1']);
            break;
        case "delete":
            $html .= Studiekeuze::delete_studiekeuze($_GET['param1']);
            header("Location: /panel/studiekeuzes/show_all");
            exit;            
            break;
        default:
            $html .= Studiekeuze::menu();
    }



    Template::view("core/header");
    echo build_crums($crums);    
    echo $html;
    Template::view("core/footer");


?>