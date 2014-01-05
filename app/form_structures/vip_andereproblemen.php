<?php    
    
    $titel = "VIP: Andere problemen";
               
    $steps = array(
        "1" => array(
            "titel" => "Zoek een leerling",
            "tpl" => "vip_andereproblemen/volgnummer.tpl",
            "validate" => "idleerling_vip_andereproblemen",
            "preload" => ""
        ),
        "2" => array(
            "titel" => "Soort en Omschrijving",
            "tpl" => "vip_andereproblemen/blanco.tpl", 
            "validate" => "save_vip_andereproblemen_omschrijving",
            "preload" => "load_vip_andereproblemen_omschrijving"
        ),
        "3" => array(
            "titel" => "Klassenraad",
            "tpl" => "vip_andereproblemen/blanco.tpl", 
            "validate" => "save_vip_andereproblemen_klassenraad",
            "preload" => "load_vip_andereproblemen_klassenraad"
        ),
        "4" => array(
            "titel" => "Gesprekken",
            "tpl" => "vip_andereproblemen/blanco.tpl", // gesprekken
            "validate" => "save_vip_gesprekken_andereproblemen",
            "preload" => "load_vip_gesprekken_andereproblemen"
        ),
        "5" => array(
            "titel" => "Einde",
            "tpl" => "vip_andereproblemen/eindwoord.tpl", 
            "validate" => "",
            "preload" => ""
        )
    );               

    
?>