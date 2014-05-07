<?php
    Class Gebruiker{


        static function get_rights_array(){

            $rightsarray = array(
                "gebruikers" => array(
                    "name" => "Gebruikers",
                    "default" => 0,
                    "options" => array(
                        "add" => 0,
                        "edit" => 0,
                        "delete" => 0
                    )
                ),
                "scholen" => array(
                    "name" => "Scholen",
                    "default" => 0,
                    "options" => array(
                        "add" => 0,
                        "edit" => 0,
                        "delete" => 0
                    )
                ),
                "studiekeuzes" => array(
                    "name" => "Studiekeuzes",
                    "default" => 0,
                    "options" => array(
                        "add" => 0,
                        "edit" => 0,
                        "delete" => 0
                    )
                ),
                "voorinschrijving-a" => array(
                    "name" => "Voorinschrijvingen A Stroom",
                    "default" => 0,
                    "options" => array(
                        "invullen" => 0,
                        "bekijken" => 0,
                        "delete" => 0
                    )
                ),
                "voorinschrijving-b" => array(
                    "name" => "Voorinschrijvingen B Stroom",
                    "default" => 0,
                    "options" => array(
                        "invullen" => 0,
                        "bekijken" => 0,
                        "delete" => 0
                    )
                ),
                "voorinschrijvingen" => array(
                    "name" => "Voorinschrijvingen",
                    "default" => 0,
                    "options" => array(
                        "invullen" => 0,
                        "bekijken" => 0,
                        "delete" => 0
                    )
                ),
                "inschrijvingen" => array(
                    "name" => "Inschrijvingen",
                    "default" => 0,
                    "options" => array(
                        "invullen" => 0,
                        "bekijken" => 0,
                        "delete" => 0
                    )
                ),
                "uitschrijvingen" => array(
                    "name" => "Uitschrijvingen",
                    "default" => 0,
                    "options" => array(                        
                        "bekijken" => 0                        
                    )
                ),
                "inschrijvingsafspraken" => array(
                    "name" => "Inschrijvings afspraken",
                    "default" => 0,
                    "options" => array(
                        "bekijken" => 0,
                        "bewerken" => 0,
                        "add" => 0,
                        "delete" => 0
                    )
                ),
                "vip_leerproblemen" => array(
                    "name" => "VIP Leerproblemen",
                    "default" => 0,
                    "options" => array(
                        "inschrijven" => 0,
                        "bekijken" => 0,
                        "delete" => 0,
                        "bewerken" => 0
                    )
                ),
                "vip_gedragsproblemen" => array(
                    "name" => "VIP Gedragsproblemen",
                    "default" => 0,
                    "options" => array(
                        "inschrijven" => 0,
                        "bekijken" => 0,
                        "delete" => 0,
                        "bewerken" => 0            
                    )
                ),
                "vip_gezondheidsproblemen" => array(
                    "name" => "VIP Gezondheidsproblemen",
                    "default" => 0,
                    "options" => array(
                        "inschrijven" => 0,
                        "bekijken" => 0,
                        "delete" => 0,
                        "bewerken" => 0            
                    )
                ),
                "vip_andereproblemen" => array(
                    "name" => "VIP Andere problemen",
                    "default" => 0,
                    "options" => array(
                        "inschrijven" => 0,
                        "bekijken" => 0,
                        "delete" => 0,
                        "bewerken" => 0            
                    )
                ),
                "export" => array(
                    "name" => "Exporteren naar Excel",
                    "default" => 0,
                    "options" => array(
                        "leerlingen" => 0            
                    )
                ),
                "afspraken" => array(
                    "name" => "Inschrijvings afspraken",
                    "default" => 0,
                    "options" => array(
                        "delete" => 0            
                    )
                ),
                "queries" => array(
                    "name" => "Queries",
                    "default" => 0,
                    "options" => array(
                        "gebruiken" => 0,
                        "maken" => 0,
                        "delete" => 0
                    )
                ),
                "cron" => array(
                    "name" => "Cron jobs",
                    "default" => 0,
                    "options" => array(
                        "bekijken" => 0,
                        "bewerken" => 0,
                        "delete" => 0,
                        "uitvoeren" => 0
                    )
                )
            );

            return $rightsarray;            

        }
        

        static function menu(){
            $html = <<<HTML
        <div class="subtitel">Wat wil u doen?</div>

        <ul class="opties">
            <li><a href="/panel/gebruikers/show_all">Toon gebruikers</a></li>    
            <li><a href="/panel/gebruikers/add">Voeg een gebruiker toe</a></li>    
        </ul>           
HTML;
            return $html;
        }


        static function show_gebruikers(){

            $query = "SELECT * FROM gebruikers";
            $result = query($query);


            $html = "<div class=\"subtitel\">Gebruikers</div>";

            $html .= "<table class=\"opties\" cellspacing=\"2\" cellpadding=\"0\">";

            while($row = mysql_fetch_assoc($result)){
                $naam = $row['naam'] != "" ? $row['naam'] : $row['gebruiker'];
                $html .= "<tr>";
                $html .= "<th class=\"left\"><a href=\"/panel/gebruikers/show/{$row['id']}\">$naam</a></th>";
                $html .= $_SESSION['gebruiker']['rights']['gebruikers']['edit'] == "YES" ? "<td class=\"center\"><a href=\"/panel/gebruikers/edit/{$row['id']}\">Edit</a></td>" : "";
                $html .= $_SESSION['gebruiker']['rights']['gebruikers']['delete'] == "YES" ? "<td class=\"center\"><a href=\"/panel/gebruikers/delete/{$row['id']}\" class=\"confirm\">Delete</a></td>": "";
                $html .= "</tr>";

            }
            $html .= "</table>";


            return $html;

        }

        static function show_gebruiker($gebruiker_id){

            $query = "SELECT * FROM gebruikers WHERE id = '{$gebruiker_id}'";
            $result = query($query);
            $gebruiker = mysql_fetch_object($result);

            $gebruikersrechten = json_decode($gebruiker->rights, true);

            $html = <<<HTML
      
        <div class="subtitel">Gebruiker {$gebruiker->naam}</div>
        <table class="formulier">
            <tr><th>Gebruikersnaam</th><td>{$gebruiker->gebruiker}</td></tr>
            <tr><th>Wachtwoord</th><td>{$gebruiker->wachtwoord}</td></tr>
            <tr><th>Naam</th><td>{$gebruiker->naam}</td></tr>
            <tr><th>Email</th><td>{$gebruiker->email}</td></tr>        
        </table>
        
        <h3>Rechten</h3>        
HTML;


            $html .= "<div class=\"rights\">";
            foreach(self::get_rights_array() as $key => $rights){
                $rightgroup = $rights['name'];
                $html .= "<div class=\"rightname\">$rightgroup</div>";
                foreach($rights['options'] as $right => $default){

                    if(array_key_exists($key,$gebruikersrechten)){
                        $r = array_key_exists($right,$gebruikersrechten[$key]) ? "Ja" : "Nee";
                    } else {
                        $r = "Nee";
                    }
                    $rightname = ucfirst(str_replace("_"," ",$right));  

                    $html .= "<div class=\"right\">$rightname: $r</div>";
                }
                $html .= "<div style=\"clear:both;\"></div>";
            }
            $html .= "</div>";

            return $html;      

        }



        static function edit_gebruiker($gebruiker_id){

            $query = "SELECT * FROM gebruikers WHERE id = '{$gebruiker_id}'";
            $result = query($query);
            $gebruiker = mysql_fetch_object($result);

            $gebruikersrechten = json_decode($gebruiker->rights, true);


            $html = <<<HTML
      
        <div class="subtitel">Bewerk gebruiker {$gebruiker->naam}</div>
        <form action="/panel/gebruikers/show/{$gebruiker_id}" method="post">
        <input type="hidden" name="action" value="update_gebruiker">
        <input type="hidden" name="gebruiker_id" value="{$gebruiker_id}">
        <table class="formulier">
            <tr><th>Gebruikersnaam</th><td><input type="text" name="gebruiker" value="{$gebruiker->gebruiker}"></td></tr>
            <tr><th>Wachtwoord</th><td><input type="text" name="wachtwoord" value="{$gebruiker->wachtwoord}"></td></tr>
            <tr><th>Naam</th><td><input type="text" name="naam" value="{$gebruiker->naam}"></td></tr>
            <tr><th>Email</th><td><input type="text" name="email" value="{$gebruiker->email}"></td></tr>        
        </table>
        
        <h3>Rechten</h3>      
        
        <div class="btnMedium btnBigMedium" style="width:120px;margin-left:0px;" id="select_all_rights">Selecteer alles</div>  
HTML;

            $html .= "<div class=\"rights\">";
            foreach(self::get_rights_array() as $key => $rights){
                $rightgroup = $rights['name'];
                $checked = $gebruikersrechten[$key]['default'] == "YES" ? "checked=\"checked\"" : "";
                $html .= "<div class=\"rightname\"><label><input type=\"checkbox\" rightgroup=\"$key\" name=\"rights[{$key}][default]\" $checked value=\"YES\"> $rightgroup</label></div>";
                foreach($rights['options'] as $right => $default){
                    if(array_key_exists($key,$gebruikersrechten)){
                        $checked = array_key_exists($right,$gebruikersrechten[$key]) ? "checked=\"checked\"" : "";
                    } else {
                        $checked = "";
                    }
                    $rightname = ucfirst(str_replace("_"," ",$right));  
                    $html .= "<div class=\"right\"><label><input type=\"checkbox\" childright=\"$key\" name=\"rights[{$key}][{$right}]\" $checked value=\"YES\"> $rightname</label></div>";
                }
                $html .= "<div class=\"clear\"></div>";
            }
            $html .= "</div>";

            $html .= "<div class=\"btnBig btnBigActive submit\">Opslaan</div>";
            $html .= "</form>";

            return $html;      

        }

        static function add_gebruiker(){

            $html = <<<HTML
      
        <div class="subtitel">Voeg een nieuwe gebruiker toe</div>
        <form action="/panel/gebruikers/show_all" method="post">
        <input type="hidden" name="action" value="insert_gebruiker">
        <table class="formulier">
            <tr><th>Gebruikersnaam</th><td><input type="text" name="gebruiker" value=""></td></tr>
            <tr><th>Wachtwoord</th><td><input type="text" name="wachtwoord" value=""></td></tr>
            <tr><th>Naam</th><td><input type="text" name="naam" value=""></td></tr>
            <tr><th>Email</th><td><input type="text" name="email" value=""></td></tr>        
        </table>
        
        <h3>Rechten</h3>        
HTML;

            $html .= "<div class=\"rights\">";
            foreach(self::get_rights_array() as $key => $rights){
                $rightgroup = $rights['name'];
                $checked = $rights['default'] == 1 ? "checked=\"checked\"" : "";
                $html .= "<div class=\"rightname\"><label><input type=\"checkbox\" rightgroup=\"$key\" name=\"rights[{$key}][default]\" $checked value=\"YES\"> $rightgroup</div>";
                foreach($rights['options'] as $right => $default){
                    $checked = $default == 1 ? "checked=\"checked\"" : "";
                    $rightname = ucfirst(str_replace("_"," ",$right));  
                    $html .= "<div class=\"right\"><label><input type=\"checkbox\" childright=\"$key\" name=\"rights[{$key}][{$right}]\" $checked value=\"YES\"> $rightname</label></div>";
                }
                $html .= "<div class=\"clear\"></div>";
            }
            $html .= "</div>";

            $html .= "<div class=\"btnBig btnBigActive submit\">Opslaan</div>";
            $html .= "</form>";

            return $html;

        }


        static function insert_gebruiker($data){

            foreach($data as $key => $value){
                if($key != "rights"){
                    $data[$key] = mysql_real_escape_string($value);
                }
            }

            $rights = json_encode($data['rights']);

            $query = "INSERT INTO gebruikers 
            (`gebruiker`,`wachtwoord`,`naam`,`email`,`rights`)
            VALUES
            ('{$data['gebruiker']}','{$data['wachtwoord']}','{$data['naam']}','{$data['email']}','{$rights}')
            ";
            query($query);

            return "<div class=\"succes\">Gebruiker is succesvol aangemaakt</div>";      

        }

        static function update_gebruiker($data){

            foreach($data as $key => $value){
                if($key != "rights"){
                    $data[$key] = mysql_real_escape_string($value);
                }
            }

            if($_SESSION['gebruiker']['id'] == $data['gebruiker_id']){
                unset($_SESSION['gebruiker']['rights']);
                foreach($data['rights'] as $key => $rights){
                    foreach($rights as $right => $value){
                        $_SESSION['gebruiker']['rights'][$key][$right] = $value;
                    }
                }
            }


            $rights = json_encode($data['rights']);

            $query = "UPDATE gebruikers SET
            `gebruiker` = '{$data['gebruiker']}',
            `wachtwoord` = '{$data['wachtwoord']}',
            `naam` = '{$data['naam']}',
            `email` = '{$data['email']}',
            `rights` = '{$rights}'
            WHERE id = '{$data['gebruiker_id']}'                
            ";
            query($query);

            return "<div class=\"succes\">Gebruiker is succesvol aangepast</div>";

        }

        static function delete_gebruiker($gebruiker_id){

            $query = "DELETE FROM gebruikers WHERE id = '{$gebruiker_id}'";
            query($query);

            Notification::set("success","Gebruiker is succesvol verwijderd");      

        }



    }  
?>
