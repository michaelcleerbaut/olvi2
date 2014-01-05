<?php  
    $crums = array();
    
    array_push($crums,array("title" => "VIP Andere problemen","url" => "/panel/vip_andereproblemen"));
    

    switch($_POST['action']){
        case "save_edit_inschrijving":
        $html .= VipAndereprobleem::save_edit_inschrijving($_POST);
        break;
    }

    switch($_GET['action']){
        case "show":
            $html .= VipAndereprobleem::show_inschrijving($_GET['param1']);
            break;
        case "edit":
            $html .= VipAndereprobleem::edit_inschrijving($_GET['param1']);
            break;
        case "delete":
            $html .= VipAndereprobleem::delete_inschrijving($_GET['param1']);
            header("Location: /panel/vip_andereproblemen/");
            exit;            
            break;
        default:
            $html .= VipAndereprobleem::show_inschrijvingen();
    }


    Template::view("core/header");
        echo build_crums($crums);    
        echo $html;
    Template::view("core/footer");

  
?>