<?php           
    $titel = "Inschrijving";
               
    $steps = array(
        "1" => array(
            "titel" => "Inschrijving nieuwe leerling",
            "tpl" => "inschrijving/stroomkeuze.tpl",
            "validate" => "stroomkeuze_inschrijving",
            "preload" => ""
        ),        
        "2" => array(
            "titel" => "Gegevens ophalen",
            "tpl" => "inschrijving/volgnummer.tpl",
            "validate" => "idleerling",
            "preload" => ""
        ),        
        "3" => array(
            "titel" => "Persoonlijke gegevens van het kind",
            "tpl" => "inschrijving/blanco.tpl",
            "validate" => "save_gegevens_kind_inschrijving",
            "preload" => "load_gegevens_kind_inschrijving"
        ),
        "4" => array(
            "titel" => "Persoonlijke gegevens van het kind",
            "tpl" => "inschrijving/blanco.tpl",
            "validate" => "save_extra_gegevens_kind_inschrijving",
            "preload" => "load_extra_gegevens_kind_inschrijving"
        ),        
        "5" => array(
            "titel" => "Gegevens moeder",
            "tpl" => "inschrijving/blanco.tpl",
            "validate" => "save_gegevens_moeder_inschrijving",
            "preload" => "load_gegevens_moeder_inschrijving"
        ),
        "6" => array(
            "titel" => "Gegevens vader",
            "tpl" => "inschrijving/blanco.tpl",
            "validate" => "save_gegevens_vader_inschrijving",
            "preload" => "load_gegevens_vader_inschrijving"
        ),        
        "7" => array(
            "titel" => "Studiekeuze",
            "tpl" => "inschrijving/blanco.tpl",
            "validate" => "save_studiekeuze_inschrijving",
            "preload" => "load_studiekeuze_inschrijving"
        ),
        "8" => array(
            "titel" => "VIP Informatie",
            "tpl" => "inschrijving/blanco.tpl",
            "validate" => "save_vipinformatie",
            "preload" => "load_vipinformatie_1"
        ),        
        "9" => array(
            "titel" => "VIP Informatie",
            "tpl" => "inschrijving/blanco.tpl",
            "validate" => "save_vipinformatie",
            "preload" => "load_vipinformatie_2"
        ),         
        "10" => array(
            "titel" => "VIP Informatie",
            "tpl" => "inschrijving/blanco.tpl",
            "validate" => "save_vipinformatie",
            "preload" => "load_vipinformatie_3"
        ),
        /*        
        "11" => array(
            "titel" => "GOK",
            "tpl" => "inschrijving/blanco.tpl",
            "validate" => "save_gok",
            "preload" => "load_gok"
        ),
        "12" => array(
            "titel" => "GOK",
            "tpl" => "inschrijving/blanco.tpl",
            "validate" => "save_gok",
            "preload" => "load_gok2"
        ),
        */
        "11" => array(
            "titel" => "BaSO-werking",
            "tpl" => "inschrijving/blanco.tpl",
            "validate" => "baso",
            "preload" => "load_baso"
        ),
        "12" => array(
            "titel" => "Einde inschrijving",
            "tpl" => "inschrijving/blanco.tpl",
            "validate" => "baso",
            "preload" => "check_ookastroom_inschrijven"
        )
        
    );

?>