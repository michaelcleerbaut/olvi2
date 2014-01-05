<?
    $stroomkeuze = "B";
    $titel = "Voorinschrijving: $stroomkeuze Stroom";
    
    $steps = array(
        "1" => array(
            "titel" => "Voorinschrijving {$stroomkeuze} Stroom",
            "tpl" => "voorinschrijving/intro.tpl",
            "validate" => "",
            "preload" => ""
        ),
        "2" => array(
            "titel" => "Korte briefing",
            "tpl" => "voorinschrijving/briefing-b.tpl",
            "validate" => "",
            "preload" => ""
        ),
        "3" => array(
            "titel" => "Volgnummer",
            "tpl" => "voorinschrijving/volgnummer.tpl",
            "validate" => "volgnummer_b",
            "preload" => ""
        ),        
        "4" => array(
            "titel" => "Persoonlijke gegevens kind",
            "tpl" => "voorinschrijving/gegevens_kind_b.tpl",
            "validate" => "gegevens_kind_b",
            "preload" => ""
        ),
        "5" => array(
            "titel" => " Contactgegevens communicatie",
            "tpl" => "voorinschrijving/gegevens_communicatie.tpl",
            "validate" => "communicatie",
            "preload" => ""
        ),
        "6" => array(
            "titel" => " Overzicht",
            "tpl" => "voorinschrijving/overzicht.tpl",
            "validate" => "",
            "preload" => "load_gegevens"
        ),
        "7" => array(
            "titel" => " Inschrijven A Stroom",
            "tpl" => "voorinschrijving/ookastroom.tpl",
            "validate" => "ooka",
            "preload" => ""
        ),        
        "8" => array(
            "titel" => "Afspraak maken",
            "tpl" => "voorinschrijving/blanco.tpl",
            "validate" => "afspraak_datum",
            "preload" => "controle_afspraak_maken"
        ),
        "9" => array(
            "titel" => "Eindwoord",
            "tpl" => "voorinschrijving/blanco.tpl",
            "validate" => "",
            "preload" => "eindwoord"
        )        
    );
    
?>