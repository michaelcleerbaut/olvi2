<?php
    Class Export{


        static function menu(){

            $html = "<div class=\"subtitel\">Wat wil u doen?</div>";
            $html .= "<ul class=\"opties\">";
            $html .= $_SESSION['gebruiker']['rights']['export']['leerlingen'] == "YES" ? "<li><a href=\"/import_sol/xls_leerling.php\" target=\"_blank\">Leerlingen naar School Online (.xls)</a></li>" : "";
            $html .= "</ul>";

            return $html;      
        }
        
        

    }  
?>
