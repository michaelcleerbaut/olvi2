<?php

    $titel = "VIP: Gedragsproblemen";
               
    $steps = array(
        "1" => array(
            "titel" => "Zoek een leerling",
            "tpl" => "vip_gedragsproblemen/volgnummer.tpl",
            "validate" => "idleerling_vip_gedragsproblemen",
            "preload" => ""
        ),
        "2" => array(
            "titel" => "Gedragsproblemen",
            "tpl" => "vip_gedragsproblemen/blanco.tpl", // leerproblemen.tpl
            "validate" => "save_vip_gedragsproblemen",
            "preload" => "load_vip_gedragsproblemen"
        ),
        "3" => array(
            "titel" => "Omschrijving",
            "tpl" => "vip_gedragsproblemen/blanco.tpl", 
            "validate" => "save_vip_gedragsproblemen_omschrijving",
            "preload" => "load_vip_gedragsproblemen_omschrijving"
        ),
        "4" => array(
            "titel" => "Externe begeleiding",
            "tpl" => "vip_gedragsproblemen/blanco.tpl", // begeleiding
            "validate" => "save_vip_begeleiding_gedragsproblemen",
            "preload" => "load_vip_begeleiding_gedragsproblemen"
        ),
        "5" => array(
            "titel" => "Attesten / Verslagen",
            "tpl" => "vip_gedragsproblemen/blanco.tpl", // attesten
            "validate" => "save_vip_attesten_gedragsproblemen",
            "preload" => "load_vip_attesten_gedragsproblemen"
        ),
        "6" => array(
            "titel" => "Klassenraad",
            "tpl" => "vip_gedragsproblemen/blanco.tpl", 
            "validate" => "save_vip_gedragsproblemen_klassenraad",
            "preload" => "load_vip_gedragsproblemen_klassenraad"
        ),
        "7" => array(
            "titel" => "Gesprekken",
            "tpl" => "vip_gedragsproblemen/blanco.tpl", // gesprekken
            "validate" => "save_vip_gesprekken_gedragsproblemen",
            "preload" => "load_vip_gesprekken_gedragsproblemen"
        ),
        "8" => array(
            "titel" => "Einde",
            "tpl" => "vip_gedragsproblemen/eindwoord.tpl", 
            "validate" => "",
            "preload" => ""
        )
    );               


    
?>