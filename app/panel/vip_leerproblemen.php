<?php  
    $crums = array();
    
    array_push($crums,array("title" => "VIP Leerproblemen","url" => "/panel/vip_leerproblemen"));
    

    switch($_POST['action']){
        case "save_edit_inschrijving":
        $html .= VipLeerprobleem::save_edit_inschrijving($_POST);
        break;
    }

    switch($_GET['action']){
        case "show":
            $html .= VipLeerprobleem::show_inschrijving($_GET['param1']);
            break;
        case "edit":
            $html .= VipLeerprobleem::edit_inschrijving($_GET['param1']);
            break;
        case "delete":
            $html .= VipLeerprobleem::delete_inschrijving($_GET['param1']);
            header("Location: /panel/vip_leerproblemen/");
            exit;            
            break;
        default:
            $html .= VipLeerprobleem::show_inschrijvingen();
    }


    Template::view("core/header");
        echo build_crums($crums);    
        echo $html;
    Template::view("core/footer");

  
?>