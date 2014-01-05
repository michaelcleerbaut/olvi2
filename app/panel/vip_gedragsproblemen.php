<?php  
    $crums = array();
    
    array_push($crums,array("title" => "VIP Gedragsproblemen","url" => "/panel/vip_gedragsproblemen"));
    

    switch($_POST['action']){
        case "save_edit_inschrijving":
        $html .= VipGedragsprobleem::save_edit_inschrijving($_POST);
        break;
    }

    switch($_GET['action']){
        case "show":
            $html .= VipGedragsprobleem::show_inschrijving($_GET['param1']);
            break;
        case "edit":
            $html .= VipGedragsprobleem::edit_inschrijving($_GET['param1']);
            break;
        case "delete":
            $html .= VipGedragsprobleem::delete_inschrijving($_GET['param1']);
            header("Location: /panel/vip_gedragsproblemen/");
            exit;            
            break;
        default:
            $html .= VipGedragsprobleem::show_inschrijvingen();
    }


    Template::view("core/header");
        echo build_crums($crums);    
        echo $html;
    Template::view("core/footer");

  
?>