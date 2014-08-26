<?php
    Class Export{


        static function menu(){

            $html = "<div class=\"subtitel\">Wat wil u doen?</div>";
            $html .= "<ul class=\"opties\">";
            $html .= $_SESSION['gebruiker']['rights']['export']['leerlingen'] == "YES" ? "<li><a href=\"/import_sol/xls_leerling.php\" target=\"_blank\">Leerlingen naar School Online (.xls)</a></li>" : "";
            $html .= $_SESSION['gebruiker']['rights']['export']['dossierlijnen'] == "YES" ? "<li><a href=\"/import_sol/xls_dossierlijn_vip_gedragsproblemen.php\" target=\"_blank\">Dossierlijnen: VIP Gedragsproblemen naar School Online (.xls)</a></li>" : "";
            $html .= $_SESSION['gebruiker']['rights']['export']['dossierlijnen'] == "YES" ? "<li><a href=\"/import_sol/xls_dossierlijn_vip_gezondheidsproblemen.php\" target=\"_blank\">Dossierlijnen: VIP Gezondheidsproblemen naar School Online (.xls)</a></li>" : "";
            $html .= $_SESSION['gebruiker']['rights']['export']['dossierlijnen'] == "YES" ? "<li><a href=\"/import_sol/xls_dossierlijn_vip_leerproblemen.php\" target=\"_blank\">Dossierlijnen: VIP Leerproblemen naar School Online (.xls)</a></li>" : "";
            $html .= $_SESSION['gebruiker']['rights']['export']['dossierlijnen'] == "YES" ? "<li><a href=\"/import_sol/xls_dossierlijn_vip_andereproblemen.php\" target=\"_blank\">Dossierlijnen: VIP Andere problemen naar School Online (.xls)</a></li>" : "";
            $html .= $_SESSION['gebruiker']['rights']['export']['dossierlijnen'] == "YES" ? "<li><a href=\"/import_sol/xls_dossierlijn_thuistaal_verschillend_van_nederlands.php\" target=\"_blank\">Dossierlijnen: Thuistaal verschillend van Nederlands naar School Online (.xls)</a></li>" : "";
            $html .= $_SESSION['gebruiker']['rights']['export']['dossierlijnen'] == "YES" ? "<li><a href=\"/import_sol/xls_dossierlijn_maakt_gebruik_van_pc.php\" target=\"_blank\">Dossierlijnen: Maakt gebruik van PC naar School Online (.xls)</a></li>" : "";
            $html .= "</ul>";

            return $html;      
        }
        
        

    }  
?>
