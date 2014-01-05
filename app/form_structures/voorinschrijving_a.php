<?php

    $stroomkeuze = "A";
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
            "tpl" => "voorinschrijving/briefing-a.tpl",
            "validate" => "volgnummer_toekennen_a",
            "preload" => ""
        ),
        "3" => array(
            "titel" => "Persoonlijke gegevens kind",
            "tpl" => "voorinschrijving/gegevens_kind_a.tpl",
            "validate" => "gegevens_kind_a",
            "preload" => ""
        ),
        "4" => array(
            "titel" => " Contactgegevens communicatie",
            "tpl" => "voorinschrijving/gegevens_communicatie.tpl",
            "validate" => "communicatie",
            "preload" => ""
        ),
        "5" => array(
            "titel" => " Overzicht",
            "tpl" => "voorinschrijving/overzicht.tpl",
            "validate" => "",
            "preload" => "load_gegevens"
        ),
        "6" => array(
            "titel" => "Afspraak maken",
            "tpl" => "voorinschrijving/blanco.tpl",
            "validate" => "afspraak_datum",
            "preload" => "controle_afspraak_maken"
        ),
        "7" => array(
            "titel" => "Eindwoord",
            "tpl" => "voorinschrijving/blanco.tpl",
            "validate" => "",
            "preload" => "eindwoord"
        )        
    );
  
?>
