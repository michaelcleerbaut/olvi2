<?php
    include('app/inc/ajax.functions.inc.php');
    include('app/inc/queries.functions.inc.php');
    switch($_GET['action']){
        case "get_cities":
            echo get_cities($_GET['query']);
        break;
        case "search_kind_via_naam":
            echo search_kind_via_naam($_GET['query'],$_GET['stroom']);
        break;
        case "search_kind_via_naam_vip_leerproblemen":
            echo search_kind_via_naam_vip_leerproblemen($_GET['query']);
        break;
        case "search_kind_via_naam_vip_gedragsproblemen":
            echo search_kind_via_naam_vip_gedragsproblemen($_GET['query']);
        break;
        case "search_kind_via_naam_vip_andereproblemen":
            echo search_kind_via_naam_vip_andereproblemen($_GET['query']);
        break;
        case "search_kind_via_naam_vip_gezondheidsproblemen":
            echo search_kind_via_naam_vip_gezondheidsproblemen($_GET['query']);
        break;
    }

                 
    switch($_POST['action']){
        case "log_action":        
            log_action($_POST['sort'],$_POST['func'],$_POST['message'],$_POST['data']);
        break;
        case "check_volgnummer_exists_b":
            echo check_volgnummer_exists_b($_POST['volgnummer'],$_POST['stroom']);
        break;                        
        case "save_gegevens_kind_a":
            echo save_gegevens_kind_a($_POST['fields']);
        break;
        case "save_gegevens_kind_b":
            echo save_gegevens_kind_b($_POST['fields']);
        break;
        case "save_communicatie":
            echo save_communicatie($_POST['fields']);
        break;
        case "load_gegevens":
            echo load_gegevens($_POST['id_leerling']);
        break;
        case "save_ooka":
            echo save_ooka();
        break;
        case "delete_ooka":
            echo delete_ooka();
        break;
        case "load_studiekeuze_inschrijving":        
            echo load_studiekeuze_inschrijving($_POST['id_leerling']);
        break;
        case "controle_afspraak_maken":
            echo controle_afspraak_maken($_POST['ooka']);
        break;
        case "save_afspraak_datum":
            echo save_afspraak_datum($_POST['dag'],$_POST['uur']);            
        break;
        case "eindwoord":        
            echo eindwoord($_POST['afspraak']);
        break;
        case "set_stroom_session":
            echo set_stroom_session($_POST['stroom']);
        break;
        case "volgnummer_toekennen_a":            
            echo volgnummer_toekennen_a();
        break;
        case "get_kind_via_volgnummer":
            echo get_kind_via_volgnummer($_POST['volgnummer'],$_POST['stroom']);
        break;
        case "get_kind_via_idleerling":
            echo get_kind_via_idleerling($_POST['idleerling'],$_POST['stroom']);
        break;
        case "get_kind_via_volgnummer_leerproblemen":
            echo get_kind_via_volgnummer_leerproblemen($_POST['volgnummer'],$_POST['stroom']);
        break;
        case "get_kind_via_volgnummer_gedragsproblemen":
            echo get_kind_via_volgnummer_gedragsproblemen($_POST['volgnummer'],$_POST['stroom']);
        break;
        case "get_kind_via_volgnummer_andereproblemen":
            echo get_kind_via_volgnummer_andereproblemen($_POST['volgnummer'],$_POST['stroom']);
        break;
        case "get_kind_via_volgnummer_gezondheidsproblemen":
            echo get_kind_via_volgnummer_gezondheidsproblemen($_POST['volgnummer'],$_POST['stroom']);
        break;
        case "load_gegevens_kind_inschrijving":
            echo load_gegevens_kind_inschrijving($_POST['id_leerling'],$_POST['nieuw']);
        break;
        case "load_extra_gegevens_kind_inschrijving":
            echo load_extra_gegevens_kind_inschrijving($_POST['id_leerling']);
        break;
        case "load_gegevens_moeder_inschrijving":
            echo load_gegevens_moeder_inschrijving($_POST['id_leerling']);
        break;
        case "load_gegevens_vader_inschrijving":
            echo load_gegevens_vader_inschrijving($_POST['id_leerling']);
        break;
        case "load_vipinformatie_1":
            echo load_vipinformatie_1($_POST['id_leerling']);
        break;
        case "load_vipinformatie_2":
            echo load_vipinformatie_2($_POST['id_leerling']);
        break;
        case "load_vipinformatie_3":
            echo load_vipinformatie_3($_POST['id_leerling']);
        break;
        case "load_gok":
            echo load_gok($_POST['id_leerling']);
        break;
        case "load_gok2":
            echo load_gok2($_POST['id_leerling']);
        break;
        case "load_baso":
            echo load_baso($_POST['id_leerling']);
        break;
        case "check_ookastroom_inschrijven":
            echo check_ookastroom_inschrijven($_POST['id_leerling'],$_POST['stroom']);
        break;
        case "save_gegevens_kind_inschrijving";
            echo save_gegevens_kind_inschrijving($_POST['fields']);
        break;
        case "save_extra_gegevens_kind_inschrijving";
            echo save_extra_gegevens_kind_inschrijving($_POST['fields']);
        break;
        case "save_gegevens_moeder_inschrijving":
            echo save_gegevens_moeder_inschrijving($_POST['fields']);
        break;
        case "save_gegevens_vader_inschrijving":
            echo save_gegevens_vader_inschrijving($_POST['fields']);
        break;
        case "save_studiekeuze_inschrijving":
            echo save_studiekeuze_inschrijving($_POST['fields'],$_POST['studiekeuze'],$_POST['schooljaar']);
        break;
        case "save_vipinformatie":
            echo save_vipinformatie($_POST['fields']);
        break;
        case "save_gok":
            echo save_gok($_POST['fields']);
        break;
        case "save_baso":
            echo save_baso($_POST['baso']);
        break;
        case "get_nieuw_volgnummer":
            echo get_nieuw_volgnummer($_POST['stroom'],$_POST['delete_vorig']);
        break;
        case "search_lagere_scholen":
            echo search_lagere_scholen($_POST['postcode']);
        break;
        case "search_secundaire_scholen":
            echo search_secundaire_scholen($_POST['postcode']);
        break;
        case "save_idleerling_session":
            save_idleerling_session($_POST['id_leerling']);
        break;
        case "load_vip_leerproblemen":
            echo load_vip_leerproblemen($_POST['id_leerling']);
        break;
        case "load_vip_gedragsproblemen":
            echo load_vip_gedragsproblemen($_POST['id_leerling']);
        break;
        case "load_vip_gezondheidsproblemen":
            echo load_vip_gezondheidsproblemen($_POST['id_leerling']);
        break;
        case "save_vip_leerproblemen":
            echo save_vip_leerproblemen($_POST['fields']);
        break;
        case "save_vip_gedragsproblemen":
            echo save_vip_gedragsproblemen($_POST['fields']);
        break;
        case "save_vip_gezondheidsproblemen":
            echo save_vip_gezondheidsproblemen($_POST['fields']);
        break;
        case "save_vip_jaaroverdoen":
            echo save_vip_jaaroverdoen($_POST['fields']);
        break;
        case "save_vip_bijkomendeinformatie":
            echo save_vip_bijkomendeinformatie($_POST['fields']);
        break;
        case "load_vip_bijkomendeinformatie":
            echo load_vip_bijkomendeinformatie();
        break;
        case "save_vip_signalen":
            echo save_vip_signalen($_POST['fields']);
        break;
        case "load_vip_signalen":
            echo load_vip_signalen();
        break;
        case "save_vip_watzekerdoen":
            echo save_vip_watzekerdoen($_POST['fields']);
        break;
        case "load_vip_watzekerdoen":
            echo load_vip_watzekerdoen();
        break;
        case "save_vip_watzekernietdoen":
            echo save_vip_watzekernietdoen($_POST['fields']);
        break;
        case "load_vip_watzekernietdoen":
            echo load_vip_watzekernietdoen();
        break;
        case "save_vip_gedragsproblemen_thuis":
            echo save_vip_gedragsproblemen_thuis($_POST['fields']);
        break;
        case "load_vip_gedragsproblemen_thuis":
            echo load_vip_gedragsproblemen_thuis();
        break;
        case "save_vip_gedragsproblemen_school":
            echo save_vip_gedragsproblemen_school($_POST['fields']);
        break;
        case "load_vip_gedragsproblemen_school":
            echo load_vip_gedragsproblemen_school();
        break;
        case "save_vip_begeleiding_gedragsproblemen":
            echo save_vip_begeleiding_gedragsproblemen($_POST['fields']);
        break;
        case "load_vip_begeleiding_gedragsproblemen";
            echo load_vip_begeleiding_gedragsproblemen();
        break;
        case "save_vip_attesten_gedragsproblemen":
            echo save_vip_attesten_gedragsproblemen($_POST['fields']);
        break;
        case "save_vip_attesten_andereproblemen":
            echo save_vip_attesten_andereproblemen($_POST['fields']);
        break;
        case "load_vip_gesprekken_andereproblemen":
            echo load_vip_gesprekken_andereproblemen();
        break;
        case "save_vip_gesprekken_andereproblemen":
            echo save_vip_gesprekken_andereproblemen($_POST['fields']);
        break;
        case "load_vip_andereproblemen_klassenraad":
            echo load_vip_andereproblemen_klassenraad();
        break;
        case "save_vip_andereproblemen_klassenraad":
            echo save_vip_andereproblemen_klassenraad($_POST['fields']);
        break;
        case "load_vip_attesten_gedragsproblemen";
            echo load_vip_attesten_gedragsproblemen();
        break;
        case "save_vip_gesprekken_gedragsproblemen":
            echo save_vip_gesprekken_gedragsproblemen($_POST['fields']);
        break;
        case "load_vip_gesprekken_gedragsproblemen";
            echo load_vip_gesprekken_gedragsproblemen();
        break;        
        case "save_vip_omgang_gedragsproblemen":
            echo save_vip_omgang_gedragsproblemen($_POST['fields']);
        break;
        case "load_vip_omgang_gedragsproblemen";
            echo load_vip_omgang_gedragsproblemen();
        break;        
        case "save_vip_gezondheidsproblemen_attesten":
            echo save_vip_gezondheidsproblemen_attesten($_POST['fields']);
        break;
        case "load_vip_gezondheidsproblemen_attesten":
            echo load_vip_gezondheidsproblemen_attesten();
        break;
        case "save_vip_gezondheidsproblemen_gesprekken":
            echo save_vip_gezondheidsproblemen_gesprekken($_POST['fields']);
        break;        
        case "load_vip_gezondheidsproblemen_gesprekken":
            echo load_vip_gezondheidsproblemen_gesprekken();
        break;
        case "load_vip_jaaroverdoen";
            echo load_vip_jaaroverdoen();
        break;
        case "save_vip_vakgebonden":
            echo save_vip_vakgebonden($_POST['fields']);
        break;
        case "load_vip_vakgebonden";
            echo load_vip_vakgebonden();
        break;
        case "save_vip_gedragsproblemen_omschrijving":
            echo save_vip_gedragsproblemen_omschrijving($_POST['fields']);
        break;
        case "save_vip_andereproblemen_omschrijving":
            echo save_vip_andereproblemen_omschrijving($_POST['fields']);
        break;
        case "load_vip_attesten_andereproblemen":
            echo load_vip_attesten_andereproblemen();
        break;
        case "load_vip_gedragsproblemen_omschrijving":
            echo load_vip_gedragsproblemen_omschrijving();
        break;        
        case "load_vip_andereproblemen_omschrijving":
            echo load_vip_andereproblemen_omschrijving();
        break;        
        case "save_vip_gedragsproblemen_klassenraad":
            echo save_vip_gedragsproblemen_klassenraad($_POST['fields']);
        break;
        case "load_vip_gedragsproblemen_klassenraad":
            echo load_vip_gedragsproblemen_klassenraad();
        break;        
        case "save_vip_leerproblemen_klassenraad":
            echo save_vip_leerproblemen_klassenraad($_POST['fields']);
        break;
        case "load_vip_leerproblemen_klassenraad":
            echo load_vip_leerproblemen_klassenraad();
        break;        
        case "save_vip_gezondheidsproblemen_omschrijving":
            echo save_vip_gezondheidsproblemen_omschrijving($_POST['fields']);
        break;
        case "load_vip_gezondheidsproblemen_omschrijving":
            echo load_vip_gezondheidsproblemen_omschrijving();
        break;        
        case "save_vip_gezondheidsproblemen_klassenraad":
            echo save_vip_gezondheidsproblemen_klassenraad($_POST['fields']);
        break;
        case "load_vip_gezondheidsproblemen_klassenraad":
            echo load_vip_gezondheidsproblemen_klassenraad();
        break;                                
        case "save_vip_gedragsproblemen_leerproblemen":
            echo save_vip_gedragsproblemen_leerproblemen($_POST['fields']);
        break;
        case "load_vip_gedragsproblemen_leerproblemen";
            echo load_vip_gedragsproblemen_leerproblemen();
        break;
        case "save_vip_taakleraar_lo":
            echo save_vip_taakleraar_lo($_POST['fields']);
        break;
        case "load_vip_taakleraar_lo";
            echo load_vip_taakleraar_lo();
        break;
        case "save_vip_begeleiding":
            echo save_vip_begeleiding($_POST['fields']);
        break;
        case "load_vip_begeleiding";
            echo load_vip_begeleiding();
        break;
        case "save_vip_attesten":
            echo save_vip_attesten($_POST['fields']);
        break;
        case "load_vip_attesten";
            echo load_vip_attesten();
        break;
        case "save_vip_gesprekken":
            echo save_vip_gesprekken($_POST['fields']);
        break;
        case "load_vip_gesprekken";
            echo load_vip_gesprekken();
        break;
        case "save_ooka_inschrijving":
            echo save_ooka_inschrijving($_POST['fields'],$_POST['studiekeuze']);
        break;
        case "delete_ooka_inschrijving":
            echo delete_ooka_inschrijving();
        break;
        case "voorinschrijving_email":
            echo voorinschrijving_email($_POST['id_inschrijving']);
        break;        
    }

    if(isset($_GET['action'])){    
        switch($_GET['action']){
            case "get_query_operators":
                echo get_query_operators($_GET['select'],$_GET['table']);
            break;        
        }
    }


?>