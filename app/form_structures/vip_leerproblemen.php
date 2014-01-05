<?php    
    $titel = "VIP: Leerproblemen";
                
    $steps = array(
        "1" => array(
            "titel" => "Zoek een leerling",
            "tpl" => "vip_leerproblemen/volgnummer.tpl",
            "validate" => "idleerling_vip_leerproblemen",
            "preload" => ""
        ),
        "2" => array(
            "titel" => "Leerproblemen",
            "tpl" => "vip_leerproblemen/blanco.tpl", // leerproblemen.tpl
            "validate" => "save_vip_leerproblemen",
            "preload" => "load_vip_leerproblemen"
        ),
        "3" => array(
            "titel" => "Jaar overdoen",
            "tpl" => "vip_leerproblemen/blanco.tpl",  // jaaroverdoen
            "validate" => "save_vip_jaaroverdoen",
            "preload" => "load_vip_jaaroverdoen"
        ),
        "4" => array(
            "titel" => "Vakgebonden problemen",
            "tpl" => "vip_leerproblemen/blanco.tpl", // vakgebonden
            "validate" => "save_vip_vakgebonden",
            "preload" => "load_vip_vakgebonden"
        ),
        "5" => array(
            "titel" => "Bijkomende gedragsproblemen",
            "tpl" => "vip_leerproblemen/blanco.tpl", // gedragsproblemen
            "validate" => "save_vip_gedragsproblemen_leerproblemen",
            "preload" => "load_vip_gedragsproblemen_leerproblemen"
        ),
        "6" => array(
            "titel" => "Taakleraar in L.O.",
            "tpl" => "vip_leerproblemen/blanco.tpl", // taakleraar_lo
            "validate" => "save_vip_taakleraar_lo",
            "preload" => "load_vip_taakleraar_lo"
        ),
        "7" => array(
            "titel" => "Externe begeleiding",
            "tpl" => "vip_leerproblemen/blanco.tpl", // begeleiding
            "validate" => "save_vip_begeleiding",
            "preload" => "load_vip_begeleiding"
        ),
        "8" => array(
            "titel" => "Attesten / Verslagen",
            "tpl" => "vip_leerproblemen/blanco.tpl", // attesten
            "validate" => "save_vip_attesten",
            "preload" => "load_vip_attesten"
        ),
        "9" => array(
            "titel" => "Klassenraad",
            "tpl" => "vip_leerproblemen/blanco.tpl", 
            "validate" => "save_vip_leerproblemen_klassenraad",
            "preload" => "load_vip_leerproblemen_klassenraad"
        ),        
        "10" => array(
            "titel" => "Gesprekken",
            "tpl" => "vip_leerproblemen/blanco.tpl", // gesprekken
            "validate" => "save_vip_gesprekken",
            "preload" => "load_vip_gesprekken"
        ),
        "11" => array(
            "titel" => "Einde",
            "tpl" => "vip_leerproblemen/eindwoord.tpl", 
            "validate" => "",
            "preload" => ""
        )
    );
    
?>