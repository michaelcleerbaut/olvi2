<?php

    $pages = array(
        "1" => "app/views/prints/vip_gezondheidsproblemen/algemeen.tpl"
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
    LEFT JOIN vip_gezondheidsproblemen v ON i.id_leerling = v.id_leerling        
    WHERE i.id_leerling = '{$id_leerling}'
    ";
    $result = query($query);
    $leerling = mysql_fetch_assoc($result);



    $problemen = is_array(unserialize($leerling['soorten_problemen'])) && count(unserialize($leerling['soorten_problemen'])) > 0 ? unserialize($leerling['soorten_problemen']) : array();  

    $chk_hartkwaal = array_key_exists("hartkwaal",$problemen) ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $chk_kataplexie = array_key_exists("kataplexie",$problemen) ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $chk_gehoorsproblemen = array_key_exists("gehoorsproblemen",$problemen) ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $chk_longaandoening = array_key_exists("longaandoening",$problemen) ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $chk_narcolepsie = array_key_exists("narcolepsie",$problemen) ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $chk_spraakstoornis = array_key_exists("spraakstoornis",$problemen) ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $chk_epilepsie = array_key_exists("epilepsie",$problemen) ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $chk_gezichtsproblemen = array_key_exists("gezichtsproblemen",$problemen) ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";  
    $chk_andere = $problemen['andereleerproblemen'] != "" ? "<img src=\"/public/img/checkboxes_checked.png\" alt=\"V\">" : "<img src=\"/public/img/checkboxes_notchecked.png\" alt=\"V\">";
    $problemen_andere = $problemen['anderegezondheidsproblemen'] != "" ? $problemen['anderegezondheidsproblemen'] : "";



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
    $tpl->set("chk_hartkwaal",$chk_hartkwaal);
    $tpl->set("chk_kataplexie",$chk_kataplexie);
    $tpl->set("chk_gehoorsproblemen",$chk_gehoorsproblemen);
    $tpl->set("chk_longaandoening",$chk_longaandoening);
    $tpl->set("chk_narcolepsie",$chk_narcolepsie);
    $tpl->set("chk_spraakstoornis",$chk_spraakstoornis);
    $tpl->set("chk_epilepsie",$chk_epilepsie);
    $tpl->set("chk_gezichtsproblemen",$chk_gezichtsproblemen);
    $tpl->set("chk_andere",$chk_andere);
    $tpl->set("problemen_andere",$problemen_andere);
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
