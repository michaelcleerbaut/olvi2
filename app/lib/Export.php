<?php
    Class Export{


        static function menu(){

            $html = "<div class=\"subtitel\">Wat wil u doen?</div>";

            $html .= "<table class=\"opties\" cellpadding=\"0\">";            
                $html .= $_SESSION['gebruiker']['rights']['export']['leerlingen'] == "YES" ?  "<tr><th class=\"left\">Leerlingen naar School Online</th><td class=\"center\"><a href=\"/import_sol/xls_leerling.php?type=XLS\">(.XLS)</a></td><td class=\"center\"><a href=\"/import_sol/xls_leerling.php?type=CSV\">(.CSV)</a></td></tr>" : "";
                $html .= $_SESSION['gebruiker']['rights']['export']['dossierlijnen'] == "YES" ? "<tr><th class=\"left\">Dossierlijnen: VIP Gedragsproblemen naar School Online</th><td class=\"center\"><a href=\"/import_sol/xls_dossierlijn_vip_gedragsproblemen.php?type=XLS\" target=\"_blank\">(.XLS)</a></td><td class=\"center\"><a href=\"/import_sol/xls_dossierlijn_vip_gedragsproblemen.php?type=CSV\" target=\"_blank\">(.CSV)</a></td></tr>" : "";
                $html .= $_SESSION['gebruiker']['rights']['export']['dossierlijnen'] == "YES" ? "<tr><th class=\"left\">Dossierlijnen: VIP Gezondheidsproblemen naar School Online</th><td class=\"center\"><a href=\"/import_sol/xls_dossierlijn_vip_gezondheidsproblemen.php?type=XLS\" target=\"_blank\">(.XLS)</a></td><td class=\"center\"><a href=\"/import_sol/xls_dossierlijn_vip_gezondheidsproblemen.php?type=CSV\" target=\"_blank\">(.CSV)</a></td></tr>" : "";
                $html .= $_SESSION['gebruiker']['rights']['export']['dossierlijnen'] == "YES" ? "<tr><th class=\"left\">Dossierlijnen: VIP Leerproblemen naar School Online</th><td class=\"center\"><a href=\"/import_sol/xls_dossierlijn_vip_leerproblemen.php?type=XLS\" target=\"_blank\">(.XLS)</a></td><td class=\"center\"><a href=\"/import_sol/xls_dossierlijn_vip_leerproblemen.php?type=CSV\" target=\"_blank\">(.CSV)</a></td></tr>" : "";
                $html .= $_SESSION['gebruiker']['rights']['export']['dossierlijnen'] == "YES" ? "<tr><th class=\"left\">Dossierlijnen: VIP Andere problemen naar School Online</th><td class=\"center\"><a href=\"/import_sol/xls_dossierlijn_vip_andereproblemen.php?type=XLS\" target=\"_blank\">(.XLS)</a></td><td class=\"center\"><a href=\"/import_sol/xls_dossierlijn_vip_andereproblemen.php?type=CSV\" target=\"_blank\">(.CSV)</a></td></tr>" : "";
                $html .= $_SESSION['gebruiker']['rights']['export']['dossierlijnen'] == "YES" ? "<tr><th class=\"left\">Dossierlijnen: Thuistaal verschillend van Nederlands naar School Online</th><td class=\"center\"><a href=\"/import_sol/xls_dossierlijn_thuistaal_verschillend_van_nederlands.php?type=XLS\" target=\"_blank\">(.XLS)</a></td><td class=\"center\"><a href=\"/import_sol/xls_dossierlijn_thuistaal_verschillend_van_nederlands.php?type=CSV\" target=\"_blank\">(.CSV)</a></td></tr>" : "";
                $html .= $_SESSION['gebruiker']['rights']['export']['dossierlijnen'] == "YES" ? "<tr><th class=\"left\">Dossierlijnen: Maakt gebruik van PC naar School Online</th><td class=\"center\"><a href=\"/import_sol/xls_dossierlijn_maakt_gebruik_van_pc.php?type=XLS\" target=\"_blank\">(.XLS)</a></td><td class=\"center\"><a href=\"/import_sol/xls_dossierlijn_maakt_gebruik_van_pc.php?type=CSV\" target=\"_blank\">(.CSV)</a></td></tr>" : "";                        
            $html .= "</table>";
            
            return $html;      
        }
        
        

    }  
?>
