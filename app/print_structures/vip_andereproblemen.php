<?php


    $pages = array(
        "1" => "app/views/prints/vip_andereproblemen/algemeen.tpl"
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
    LEFT JOIN vip_andereproblemen v ON i.id_leerling = v.id_leerling        
    WHERE i.id_leerling = '{$id_leerling}'
    ";
    $result = query($query);
    $leerling = mysql_fetch_assoc($result);


    $leerling['omschrijving'] = nl2br($leerling['omschrijving']);  

    $klassenraad_ja = $leerling['klassenraad'] == "Ja" ? "Ja" : "<span style=\"text-decoration: line-through;\">Ja</span>"; 
    $klassenraad_nee = $leerling['klassenraad'] == "Nee" ? "Nee" : "<span style=\"text-decoration: line-through;\">Nee</span>"; 

    $gesprek_clb_ja = $leerling['gesprek_clb'] == "Ja" ? "Ja" : "<span style=\"text-decoration: line-through;\">Ja</span>"; 
    $gesprek_clb_nee = $leerling['gesprek_clb'] == "Nee" ? "Nee" : "<span style=\"text-decoration: line-through;\">Nee</span>"; 

    $gesprek_titularis_ja = $leerling['gesprek_titularis'] == "Ja" ? "Ja" : "<span style=\"text-decoration: line-through;\">Ja</span>"; 
    $gesprek_titularis_nee = $leerling['gesprek_titularis'] == "Nee" ? "Nee" : "<span style=\"text-decoration: line-through;\">Nee</span>"; 


    $tpl = new Template("core/print_builder");

    $tpl->set("pages",$pages);
    $tpl->set("leerling",$leerling);
    
    $tpl->set("klassenraad_ja",$klassenraad_ja);
    $tpl->set("klassenraad_nee",$klassenraad_nee);
    $tpl->set("gesprek_clb_ja",$gesprek_clb_ja);
    $tpl->set("gesprek_clb_nee",$gesprek_clb_nee);
    $tpl->set("gesprek_titularis_ja",$gesprek_titularis_ja);
    $tpl->set("gesprek_titularis_nee",$gesprek_titularis_nee);
    
    $tpl->render();
    
    
     
?>