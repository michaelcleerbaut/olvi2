<?php    
    
    $titel = "VIP: Gezondheidsproblemen";
  
    $steps = array(
        "1" => array(
            "titel" => "Zoek een leerling",
            "tpl" => "vip_gezondheidsproblemen/volgnummer.tpl",
            "validate" => "idleerling_vip_gezondheidsproblemen",
            "preload" => ""
        ),
        "2" => array(
            "titel" => "Gezondheidsproblemen",
            "tpl" => "vip_gezondheidsproblemen/blanco.tpl",
            "validate" => "save_vip_gezondheidsproblemen",
            "preload" => "load_vip_gezondheidsproblemen"
        ),
        "3" => array(
            "titel" => "Omschrijving",
            "tpl" => "vip_gezondheidsproblemen/blanco.tpl",  
            "validate" => "save_vip_gezondheidsproblemen_omschrijving",
            "preload" => "load_vip_gezondheidsproblemen_omschrijving"
        ),
        "4" => array(
            "titel" => "Attesten / Verslagen",
            "tpl" => "vip_gezondheidsproblemen/blanco.tpl",
            "validate" => "save_vip_gezondheidsproblemen_attesten",
            "preload" => "load_vip_gezondheidsproblemen_attesten"
        ),
        "5" => array(
            "titel" => "Klassenraad",
            "tpl" => "vip_gezondheidsproblemen/blanco.tpl",
            "validate" => "save_vip_gezondheidsproblemen_klassenraad",
            "preload" => "load_vip_gezondheidsproblemen_klassenraad"
        ),        
        "6" => array(
            "titel" => "Gesprekken",
            "tpl" => "vip_gezondheidsproblemen/blanco.tpl",
            "validate" => "save_vip_gezondheidsproblemen_gesprekken",
            "preload" => "load_vip_gezondheidsproblemen_gesprekken"
        ),
        "7" => array(
            "titel" => "Einde",
            "tpl" => "vip_gezondheidsproblemen/eindwoord.tpl", 
            "validate" => "",
            "preload" => ""
        )
    );  
               
  
?>