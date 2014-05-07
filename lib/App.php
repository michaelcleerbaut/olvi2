<?php
    Class App{

        public static function UserFormsMenu(){

            
            $menu_items = array(
                "voorinschrijving_a" => array(
                    "title" => "Voorinschrijvingsformulier Stroom A",
                    "right"  => "voorinschrijving-a@@@invullen"
                ),
                "voorinschrijving_b" => array(
                    "title" => "Voorinschrijvingsformulier Stroom B",
                    "right" => "voorinschrijving-b@@@invullen"
                ),
                "inschrijving" => array(
                    "title" => "Definitief inschrijvingsformulier",
                    "right" => "inschrijvingen@@@invullen"
                ),
                "vip_leerproblemen" => array(
                    "title" => "VIP Leerproblemen inschrijvingsformulier",
                    "right" => "vip_leerproblemen@@@inschrijven"
                ),
                "vip_gedragsproblemen" => array(
                    "title" => "VIP Gedragsproblemen inschrijvingsformulier",
                    "right" => "vip_gedragsproblemen@@@inschrijven"
                ),
                "vip_gezondheidsproblemen" => array(
                    "title" => "VIP Gezondsheidsproblemen inschrijvingsformulier",
                    "right" => "vip_gezondheidsproblemen@@@inschrijven"
                ),
                "vip_andereproblemen" => array(
                    "title" => "VIP Andere problemen inschrijvingsformulier",
                    "right" => "vip_andereproblemen@@@inschrijven"
                )            
            );
                
            
            foreach($menu_items as $page => $data){                
                $right = explode("@@@",$data['right']);                                
                $menu .= $_SESSION['gebruiker']['rights'][$right[0]][$right[1]] == "YES" ? "<li><a href=\"frm/$page\">{$data['title']}</a></li>" : "";               
            }
             
            $html = "";           
            if($menu != ""){        
                $html = "            
                    <div class=\"subtitel\">Wat wil u doen?</div>
                    <ul class=\"opties\">
                        $menu
                    </ul>                
                ";
            }
            
            return $html;

        }
        
        public static function UserActionsMenu(){
            
            $menu_items = array(
                "voorinschrijvingen" => array(
                    "title" => "Voorinschrijvingen",
                    "right"  => "voorinschrijvingen@@@default"
                ),
                "inschrijvingen" => array(
                    "title" => "Definitieve Inschrijvingen",
                    "right"  => "inschrijvingen@@@default"
                ),
                "uitschrijvingen" => array(
                    "title" => "Uitschrijvingen",
                    "right"  => "uitschrijvingen@@@default"
                ),
                "inschrijvingsafspraken" => array(
                    "title" => "Inschrijvings afspraken",
                    "right"  => "inschrijvingsafspraken@@@default"
                ),
                "vip_leerproblemen" => array(
                    "title" => "VIP Leerproblemen inschrijvingen",
                    "right"  => "vip_leerproblemen@@@bekijken"
                ),
                "vip_gedragsproblemen" => array(
                    "title" => "VIP Gedragsproblemen inschrijvingen",
                    "right"  => "vip_gedragsproblemen@@@bekijken"
                ),
                "vip_gezondheidsproblemen" => array(
                    "title" => "VIP Gezondheidsproblemen inschrijvingen",
                    "right"  => "vip_gezondheidsproblemen@@@bekijken"
                ),
                "vip_andereproblemen" => array(
                    "title" => "VIP Andere problemen inschrijvingen",
                    "right"  => "vip_andereproblemen@@@bekijken"
                ),
                "scholen" => array(
                    "title" => "Scholen",
                    "right"  => "scholen@@@default"
                ),
                "studiekeuzes" => array(
                    "title" => "Studiekeuzes",
                    "right"  => "studiekeuzes@@@default"
                ),
                "gebruikers" => array(
                    "title" => "Gebruikers",
                    "right"  => "gebruikers@@@default"
                ),
                "export" => array(
                    "title" => " Exporteren van gegevens",
                    "right"  => "export@@@default"
                ),
                "queries" => array(
                    "title" => "Queries",
                    "right"  => "queries@@@default"
                )
            );       
            
            
            foreach($menu_items as $page => $data){                
                $right = explode("@@@",$data['right']);                
                $menu .= $_SESSION['gebruiker']['rights'][$right[0]][$right[1]] == "YES" ? "<li><a href=\"panel/$page\">{$data['title']}</a></li>" : "";               
            }
            
            
            $html = "";

            if($menu != ""){
                $html = "
                    <div class=\"subtitel\" style=\"margin-top: 30px;\">Of waar wil u naartoe?</div>
                    <ul class=\"opties\">
                        $menu
                    </ul>                
                ";
            }
            
            return $html;

        }
        
        public static function AppMenu(){
            
            $menu_items = array(
                "cron" => array(
                    "title" => "Cron jobs",
                    "right"  => "cron@@@bekijken"
                )
            );       
            
            
            foreach($menu_items as $page => $data){                
                $right = explode("@@@",$data['right']);                
                $menu .= $_SESSION['gebruiker']['rights'][$right[0]][$right[1]] == "YES" ? "<li><a href=\"panel/$page\">{$data['title']}</a></li>" : "";               
            }
            
            
            $html = "";
            
            if($menu != ""){
                $html = "
                    <div class=\"subtitel\" style=\"margin-top: 30px;\">Systeem</div>
                    <ul class=\"opties\">
                        $menu
                    </ul>                
                ";
            }
            
            return $html;

        }
        
        
        

    }
?>
