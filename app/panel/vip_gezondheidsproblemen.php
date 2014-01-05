<?php  
    $crums = array();
    
    array_push($crums,array("title" => "VIP Gezondheidsproblemen","url" => "/panel/vip_gezondheidsproblemen"));
    

    switch($_POST['action']){
        case "save_edit_inschrijving":
        $html .= VipGezondheidsprobleem::save_edit_inschrijving($_POST);
        break;
    }

    switch($_GET['action']){
        case "show":
            $html .= VipGezondheidsprobleem::show_inschrijving($_GET['param1']);
            break;
        case "edit":
            $html .= VipGezondheidsprobleem::edit_inschrijving($_GET['param1']);
            break;
        case "delete":
            $html .= VipGezondheidsprobleem::delete_inschrijving($_GET['param1']);
            header("Location: /panel/vip_gezondheidsproblemen/");
            exit;            
            break;
        default:
            $html .= VipGezondheidsprobleem::show_inschrijvingen();
    }


    Template::view("core/header");
        echo build_crums($crums);    
        echo $html;
    Template::view("core/footer");

  
?>