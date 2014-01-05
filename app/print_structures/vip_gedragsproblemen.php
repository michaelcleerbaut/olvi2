<?php



    $pages = array(
        "1" => "app/views/prints/vip_gedragsproblemen/algemeen.tpl"
    );

    $id_leerling = "";
    $id_inschrijving = "";
    
    if($_GET['id_leerling'] != ""){    
        $id_leerling = $_GET['id_leerling'];    
    } else if($_SESSION['id_leerling'] != ""){
        $id_leerling = $_SESSION['id_leerling'];
    } else {
        echo "Er is iets fout gelopen.";
        exit;
    }

    $query = "
    SELECT l.*, i.*, v.* FROM inschrijving i
    INNER JOIN leerlingen l ON i.id_leerling = l.id_leerling
    LEFT JOIN vip_gedragsproblemen v ON i.id_leerling = v.id_leerling        
    WHERE i.id_leerling = '{$id_leerling}'
    ";
    $result = query($query);
        
    $leerling = mysql_fetch_assoc($result);
    

    $problemen = is_array(unserialize($leerling['soorten_problemen'])) && count(unserialize($leerling['soorten_problemen'])) > 0 ? unserialize($leerling['soorten_problemen']) : array();  

    $chk_gedragsstoornis = array_key_exists("gedragsstoornis",$problemen) ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $chk_adhd = array_key_exists("adhd",$problemen) ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $chk_hsp = array_key_exists("hsp",$problemen) ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";  
    $chk_autismespectrumstoornis = $problemen['autismespectrumstoornis'] != "" ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $autismespectrumstoornis = $problemen['autismespectrumstoornis'] != "" ? $problemen['autismespectrumstoornis'] : "";
    $chk_andere = $problemen['anderegedragsproblemen'] != "" ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $problemen_andere = $problemen['anderegedragsproblemen'] != "" ? $problemen['anderegedragsproblemen'] : "";


    $gedragsproblemen_thuis_ja = $leerling['gedragsproblemen_thuis'] == "Ja" ? "Ja" : "<span style=\"text-decoration: line-through;\">Ja</span>"; 
    $gedragsproblemen_thuis_nee  = $leerling['gedragsproblemen_thuis'] == "Nee" ? "Nee" : "<span style=\"text-decoration: line-through;\">Nee</span>"; 

    $gedragsproblemen_school_ja = $leerling['gedragsproblemen_school'] == "Ja" ? "Ja" : "<span style=\"text-decoration: line-through;\">Ja</span>"; 
    $gedragsproblemen_school_nee = $leerling['gedragsproblemen_school'] == "Nee" ? "Nee" : "<span style=\"text-decoration: line-through;\">Nee</span>"; 


    $begeleiding_ja = $leerling['begeleiding'] == "Ja" ? "Ja" : "<span style=\"text-decoration: line-through;\">Ja</span>"; 
    $begeleiding_nee = $leerling['begeleiding'] == "Nee" ? "Nee" : "<span style=\"text-decoration: line-through;\">Nee</span>"; 

    $begeleiding_nunog_ja = $leerling['begeleiding_nunog'] == "Ja" ? "Ja" : "<span style=\"text-decoration: line-through;\">Ja</span>"; 
    $begeleiding_nunog_nee = $leerling['begeleiding_nunog'] == "Nee" ? "Nee" : "<span style=\"text-decoration: line-through;\">Nee</span>"; 

    $attesten_ja = $leerling['attesten'] == "Ja" ? "Ja" : "<span style=\"text-decoration: line-through;\">Ja</span>"; 
    $attesten_nee = $leerling['attesten'] == "Nee" ? "Nee" : "<span style=\"text-decoration: line-through;\">Nee</span>"; 

    $klassenraad_ja = $leerling['klassenraad'] == "Ja" ? "Ja" : "<span style=\"text-decoration: line-through;\">Ja</span>"; 
    $klassenraad_nee = $leerling['klassenraad'] == "Nee" ? "Nee" : "<span style=\"text-decoration: line-through;\">Nee</span>"; 

    $gesprek_clb_ja = $leerling['gesprek_clb'] == "Ja" ? "Ja" : "<span style=\"text-decoration: line-through;\">Ja</span>"; 
    $gesprek_clb_nee = $leerling['gesprek_clb'] == "Nee" ? "Nee" : "<span style=\"text-decoration: line-through;\">Nee</span>"; 

    $gesprek_titularis_ja = $leerling['gesprek_titularis'] == "Ja" ? "Ja" : "<span style=\"text-decoration: line-through;\">Ja</span>"; 
    $gesprek_titularis_nee = $leerling['gesprek_titularis'] == "Nee" ? "Nee" : "<span style=\"text-decoration: line-through;\">Nee</span>"; 



    $tpl = new Template("core/print_builder");

    $tpl->set("pages",$pages);
    $tpl->set("leerling",$leerling);
    $tpl->set("problemen",$problemen);
    $tpl->set("chk_gedragsstoornis",$chk_gedragsstoornis);
    $tpl->set("chk_adhd",$chk_adhd);
    $tpl->set("chk_hsp",$chk_hsp);
    $tpl->set("chk_autismespectrumstoornis",$chk_autismespectrumstoornis);
    $tpl->set("autismespectrumstoornis",$autismespectrumstoornis);
    $tpl->set("chk_andere",$chk_andere);
    $tpl->set("problemen_andere",$problemen_andere);
    $tpl->set("gedragsproblemen_thuis_ja",$gedragsproblemen_thuis_ja);
    $tpl->set("gedragsproblemen_thuis_nee",$gedragsproblemen_thuis_nee);
    $tpl->set("gedragsproblemen_school_ja",$gedragsproblemen_school_ja);
    $tpl->set("gedragsproblemen_school_nee",$gedragsproblemen_school_nee);
    $tpl->set("begeleiding_ja",$begeleiding_ja);
    $tpl->set("begeleiding_nee",$begeleiding_nee);
    $tpl->set("begeleiding_nunog_ja",$begeleiding_nunog_ja);
    $tpl->set("begeleiding_nunog_nee",$begeleiding_nunog_nee);
    $tpl->set("attesten_ja",$attesten_ja);
    $tpl->set("attesten_nee",$attesten_nee);
    $tpl->set("klassenraad_ja",$klassenraad_ja);
    $tpl->set("klassenraad_nee",$klassenraad_nee);
    $tpl->set("gesprek_clb_ja",$gesprek_clb_ja);
    $tpl->set("gesprek_clb_nee",$gesprek_clb_nee);
    $tpl->set("gesprek_titularis_ja",$gesprek_titularis_ja);
    $tpl->set("gesprek_titularis_nee",$gesprek_titularis_nee);

    $tpl->render();

?>
