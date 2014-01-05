<?php


    $pages = array(
        "1" => "app/views/prints/vip_leerproblemen/algemeen.tpl"
    );

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
    LEFT JOIN vip_leerproblemen v ON i.id_leerling = v.id_leerling        
    WHERE i.id_leerling = '{$id_leerling}'
    ";
    $result = query($query);
    $leerling = mysql_fetch_assoc($result);



    $problemen = is_array(unserialize($leerling['soorten_problemen'])) && count(unserialize($leerling['soorten_problemen'])) > 0 ? unserialize($leerling['soorten_problemen']) : array();  

    $chk_dyslexie = array_key_exists("dyslexie",$problemen) ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $chk_dyscalculie = array_key_exists("dyscalculie",$problemen) ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $chk_dyspraxie = array_key_exists("dyspraxie",$problemen) ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $chk_nld = array_key_exists("NLD",$problemen) ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $chk_add = array_key_exists("ADD",$problemen) ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $chk_andere = $problemen['andereleerproblemen'] != "" ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $problemen_andere = $problemen['andereleerproblemen'] != "" ? $problemen['andereleerproblemen'] : "";


    $jaar_overgedaan_ja = $leerling['jaar_overgedaan'] == "Ja" ? "Ja" : "<span style=\"text-decoration: line-through;\">Ja</span>"; 
    $jaar_overgedaan_nee = $leerling['jaar_overgedaan'] == "Nee" ? "Nee" : "<span style=\"text-decoration: line-through;\">Nee</span>"; 

    $vakgebonden_ja = $leerling['vakgebonden'] == "Ja" ? "Ja" : "<span style=\"text-decoration: line-through;\">Ja</span>"; 
    $vakgebonden_nee = $leerling['vakgebonden'] == "Nee" ? "Nee" : "<span style=\"text-decoration: line-through;\">Nee</span>"; 

    $gedragsproblemen_ja = $leerling['gedragsproblemen'] == "Ja" ? "Ja" : "<span style=\"text-decoration: line-through;\">Ja</span>"; 
    $gedragsproblemen_nee = $leerling['gedragsproblemen'] == "Nee" ? "Nee" : "<span style=\"text-decoration: line-through;\">Nee</span>"; 

    $taakleraar_lo_ja = $leerling['taakleraar_lo'] == "Ja" ? "Ja" : "<span style=\"text-decoration: line-through;\">Ja</span>"; 
    $taakleraar_lo_nee = $leerling['taakleraar_lo'] == "Nee" ? "Nee" : "<span style=\"text-decoration: line-through;\">Nee</span>"; 

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
    $tpl->set("chk_dyslexie",$chk_dyslexie);
    $tpl->set("chk_dyscalculie",$chk_dyscalculie);
    $tpl->set("chk_dyspraxie",$chk_dyspraxie);
    $tpl->set("chk_nld",$chk_nld);
    $tpl->set("chk_add",$chk_add);
    $tpl->set("chk_andere",$chk_andere);
    $tpl->set("problemen_andere",$problemen_andere);
    $tpl->set("jaar_overgedaan_ja",$jaar_overgedaan_ja);
    $tpl->set("jaar_overgedaan_nee",$jaar_overgedaan_nee);
    $tpl->set("vakgebonden_ja",$vakgebonden_ja);
    $tpl->set("vakgebonden_nee",$vakgebonden_nee);
    $tpl->set("gedragsproblemen_ja",$gedragsproblemen_ja);
    $tpl->set("gedragsproblemen_nee",$gedragsproblemen_nee);
    $tpl->set("taakleraar_lo_ja",$taakleraar_lo_ja);
    $tpl->set("taakleraar_lo_nee",$taakleraar_lo_nee);
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
