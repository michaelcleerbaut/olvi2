<?php
    Class VipGedragsprobleem{

        static function show_inschrijvingen(){

            $html = "<div class=\"subtitel\">VIP Gedragsproblemen inschrijvingen</div>";

            $query = "SELECT v.*, v.id as v_id, l.id_leerling, l.naam, l.voornaam FROM vip_gedragsproblemen v                
            INNER JOIN leerlingen l ON v.id_leerling = l.id_leerling
            LEFT JOIN inschrijving i ON v.id_leerling = i.id_leerling            
            WHERE l.deleted != 1 AND i.schooljaar LIKE '{$_SESSION['schooljaar']}'
            ORDER BY l.naam 
            ";    
            $result = query($query);


            $html .= "<table class=\"opties\" cellpadding=\"0\"><tr><th class=\"top\">Naam</th><th class=\"top\">Stroom</th><th class=\"top\">Opgemaakt door</th></tr>";

            while($row = mysql_fetch_assoc($result)){
                
                $query2 = "SELECT stroom FROM inschrijving WHERE id_leerling = '{$row['id_leerling']}'";
                $result2 = query($query2);
                $stroom = "";
                while($row2 = mysql_fetch_assoc($result2)){
                    $stroom .= $row2['stroom'] . " ";
                }
                
                $naam = $row['voornaam'] != "" || $row['naam'] != "" ? $row['voornaam'] . " " . $row['naam'] : "<i>geen naam</i>";

                $html .= "<tr>";
                $html .= "<th class=\"left\"><a href=\"/panel/vip_gedragsproblemen/show/{$row['v_id']}\">$naam</a></th>";
                $html .= "<td class=\"center\">$stroom</td>";                        
                $html .= "<td class=\"center\">{$row['opgemaakt_door']}</td>";
                $html .= "<td class=\"center\"><a href=\"/prt/vip/vip_gedragsproblemen/{$row['id_leerling']}\" target=\"_blank\"><div class=\"print_icon\"></div></a></td>";
                $html .= $_SESSION['gebruiker']['rights']['vip_gedragsproblemen']['bewerken'] == "YES" ? "<td class=\"center\"><a href=\"/panel/vip_gedragsproblemen/edit/{$row['v_id']}\">Edit</a></td>" : "";
                $html .= $_SESSION['gebruiker']['rights']['vip_gedragsproblemen']['delete'] == "YES" ? "<td class=\"center\"><a href=\"/panel/vip_gedragsproblemen/delete/{$row['v_id']}\" class=\"confirm\">Verwijder</a></td>" : "";
                $html .= "</tr>";


            }


            $html .= "</table>";

            return $html;
        }

        static function show_inschrijving($id){

            $query = "
            SELECT l.*, v.* FROM vip_gedragsproblemen v
            INNER JOIN leerlingen l ON v.id_leerling = l.id_leerling        
            WHERE v.id = '{$id}'       
            ";    
            $result = query($query);    
            while($leerling = mysql_fetch_assoc($result)){


                $problemen = unserialize($leerling['soorten_problemen']);  

                $chk_gedragsstoornis = array_key_exists("gedragsstoornis",$problemen) ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $chk_adhd = array_key_exists("adhd",$problemen) ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $chk_hsp = array_key_exists("hsp",$problemen) ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $chk_autismespectrumstoornis = $problemen['autismespectrumstoornis'] != "" ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $autismespectrumstoornis = $problemen['autismespectrumstoornis'] != "" ? $problemen['autismespectrumstoornis'] : "";
                $chk_andere = $problemen['anderegedragsproblemen'] != "" ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $problemen_andere = $problemen['anderegedragsproblemen'] != "" ? $problemen['anderegedragsproblemen'] : "";


                if($leerling['gedragsproblemen_thuis'] == "Ja"){
                    $gedragsproblemen_thuis = "
                    Ja
                    <table cellspacing=\"0\" cellpadding=\"0\">                    
                    <tr><td>Welke? </td><td> {$leerling['gedragsproblemen_thuis_welke']}</td></tr>                    
                    </table>
                    ";
                } else {
                    $gedragsproblemen_thuis = "Nee";
                }

                if($leerling['gedragsproblemen_school'] == "Ja"){
                    $gedragsproblemen_school = "
                    Ja
                    <table cellspacing=\"0\" cellpadding=\"0\">                    
                    <tr><td>Welke? </td><td> {$leerling['gedragsproblemen_school_welke']}</td></tr>                    
                    </table>
                    ";
                } else {
                    $gedragsproblemen_school = "Nee";
                }

                if($leerling['begeleiding'] == "Ja"){
                    $begeleiding = "
                    Ja<br>
                    <table cellspacing=\"0\" cellpadding=\"0\">
                    <tr><td style=\"width:70px;\">Wanneer?</td><td>{$leerling['begeleiding_wanneer']}</td></tr>
                    <tr><td>Waar?</td><td>{$leerling['begeleiding_waar']}</td></tr>
                    <tr><td>Nu nog?</td><td>{$leerling['begeleiding_nunog']}</td></tr>
                    </table>
                    ";
                } else {
                    $begeleiding = "Nee";
                }

                if($leerling['attesten'] == "Ja"){
                    $attesten = "Ja <br> {$leerling['attesten_extra']}";
                } else {
                    $attesten = "Nee <br> {$leerling['attesten_extra']}";
                }


                $html = <<<HTML

            <div style="float:right;">
                <a href="/panel/vip_gedragsproblemen/edit/{$id}" class="btnMedium">Edit</a>
            </div>
        
          <div class="subtitel">VIP Gedragsproblemen fiche van {$leerling['naam']} {$leerling['voornaam']}</div>
          
                     
          <table class="formulier" cellspacing="2" cellpadding="0">                          
            <tr>
                <th></th>
                <th style="width:400px;"></th>
                <th>Extra info of vraag</th>
            </tr>
            <tr>
                <th class="left">Soorten</th>
                <td class="right">
                    $chk_gedragsstoornis Gedragsstoornis<div style="clear:both;"></div><br>
                    $chk_adhd ADHD<div style="clear:both;"></div><br>
                    $chk_hsp HSP<div style="clear:both;"></div><br>
                    $chk_autismespectrumstoornis Autismespectrumstoornis: $autismespectrumstoornis<div style="clear:both;"></div><br>
                    $chk_andere Andere: $problemen_andere                
                </td>
                <td></td>                
            </tr>
            <!--
            <tr>
                <th class="left">Gedragsproblemen thuis?</th>
                <td class="right">$gedragsproblemen_thuis</td>
                <td>{$leerling['gedragsproblemen_thuis_extra']}</td>
            </tr>
            <tr>
                <th class="left">Gedragsproblemen school?</th>
                <td class="right">$gedragsproblemen_school</td>
                <td>{$leerling['gedragsproblemen_school_extra']}</td>
            </tr>
            -->
            <tr>
                <th class="left">Omschrijving</th>
                <td colspan="2" class="right">{$leerling['omschrijving']}</td>                
            </tr>
            <tr>
                <th class="left">Externe begeleiding?</th>
                <td class="right">$begeleiding</td>
                <td>{$leerling['begeleiding_extra']}</td>
            </tr>
            <tr>
                <th class="left">Attesten / verslagen?</th>
                <td class="right" colspan="2">$attesten</td>
            </tr>
            <tr>
                <th class="left">Kandidaat klassenraad?</th>
                <td class="right" colspan="2">{$leerling['klassenraad']}</td>
            </tr>
            <tr>
                <th class="left">Gesprek CLB?</th>
                <td class="right" colspan="2">{$leerling['gesprek_clb']}</td>
            </tr>
            <tr>
                <th class="left">Gesprek titularis?</th>
                <td class="right" colspan="2">{$leerling['gesprek_titularis']}</td>
            </tr>
            <!--
            <tr>
                <th class="left">Hoe het best met gedragsprobleem omgaan? Wat wel doen? Wat niet?</th>
                <td class="right" colspan="2">{$leerling['omgang']}</td>
            </tr>
            -->
          </table>
          
          
          
          
          
          
      
           
        
HTML;




            }

            return $html;



        }

        static function edit_inschrijving($id){


            $query = "
            SELECT l.*, v.* FROM vip_gedragsproblemen v
            INNER JOIN leerlingen l ON v.id_leerling = l.id_leerling        
            WHERE v.id = '{$id}'       
            ";    
            $result = query($query);    
            while($leerling = mysql_fetch_assoc($result)){


                $problemen = unserialize($leerling['soorten_problemen']);  

                $chk_gedragsstoornis = array_key_exists("gedragsstoornis",$problemen) ? " checked=\"checked\"" : "";
                $chk_adhd = array_key_exists("adhd",$problemen) ? " checked=\"checked\"" : "";
                $chk_hsp = array_key_exists("hsp",$problemen) ? " checked=\"checked\"" : "";
                $chk_autismespectrumstoornis = $problemen['autismespectrumstoornis'] != "" ? " checked=\"checked\"" : "";
                $autismespectrumstoornis = $problemen['autismespectrumstoornis'] != "" ? $problemen['autismespectrumstoornis'] : "";
                $chk_andere = $problemen['anderegedragsproblemen'] != "" ? " checked=\"checked\"" : "";
                $problemen_andere = $problemen['anderegedragsproblemen'] != "" ? $problemen['anderegedragsproblemen'] : "";



                $chk_gedragsproblemen_thuis_ja = $leerling['gedragsproblemen_thuis'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_gedragsproblemen_thuis_nee = $leerling['gedragsproblemen_thuis'] == "Nee" ? " checked=\"checked\"" : "";                    

                $chk_gedragsproblemen_school_ja = $leerling['gedragsproblemen_school'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_gedragsproblemen_school_nee = $leerling['gedragsproblemen_school'] == "Nee" ? " checked=\"checked\"" : "";                    

                $chk_begeleiding_ja = $leerling['begeleiding'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_begeleiding_nee = $leerling['begeleiding'] == "Nee" ? " checked=\"checked\"" : "";

                $chk_attesten_ja = $leerling['attesten'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_attesten_nee = $leerling['attesten'] == "Nee" ? " checked=\"checked\"" : "";

                $chk_klassenraad_ja = $leerling['klassenraad'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_klassenraad_nee = $leerling['klassenraad'] == "Nee" ? " checked=\"checked\"" : "";

                $chk_gesprek_clb_ja = $leerling['gesprek_clb'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_gesprek_clb_nee = $leerling['gesprek_clb'] == "Nee" ? " checked=\"checked\"" : "";


                $chk_gesprek_titularis_ja = $leerling['gesprek_titularis'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_gesprek_titularis_nee = $leerling['gesprek_titularis'] == "Nee" ? " checked=\"checked\"" : "";

                $chk_begeleiding_nunog_ja = $leerling['begeleiding_nunog'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_begeleiding_nunog_nee = $leerling['begeleiding_nunog'] == "Nee" ? " checked=\"checked\"" : "";



                $html = <<<HTML
        
        
          <div class="subtitel">VIP Gedragsproblemen fiche van {$leerling['naam']} {$leerling['voornaam']}</div>
          
          <form action="/panel/vip_gedragsproblemen/show/{$id}" method="post"> 
          <input type="hidden" name="action" value="save_edit_inschrijving">
          <input type="hidden" name="id_leerling" value="{$id}">                     
          <table class="formulier" cellspacing="2" cellpadding="0">                          
            <tr>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th class="left">Soorten</th>
                <td class="right">
                    <label><input type="checkbox" name="soort[gedragsstoornis]" value="YES" $chk_gedragsstoornis style="width: 20px;"> Gedragsstoornis</label> <br>
                    <label><input type="checkbox" name="soort[adhd]" value="YES" $chk_adhd style="width: 20px;"> ADHD</label>  <br>
                    <label><input type="checkbox" name="soort[hsp]" value="YES" $chk_hsp style="width: 20px;"> HSP</label>  <br>                    
                    <label><input type="checkbox" name="soort[autismespectrumstoornis]" value="YES" $chk_autismespectrumstoornis style="width: 20px;"> Autismespectrumstoornis: </label><input type="text" name="autismespectrumstoornis" value="$autismespectrumstoornis" style="width: 280px;"><br><br>
                    <label><input type="checkbox" name="soort[andere]" value="YES" $chk_andere style="width: 20px;"> Andere: </label><input type="text" name="problemen_andere" value="$problemen_andere" style="width: 377px;">
                </td>                
            </tr>
            <tr>
                 <th class="left">Omschrijving</th>
                 <td class="right">
                    <textarea name="omschrijving" style="width:460px;height:200px;">{$leerling['omschrijving']}</textarea>
                 </td>
            </tr>
            <!--
            <tr>
                <th class="left" valign="top">
                    Gedragsproblemen thuis?<br><br><br>
                    <label><input type="radio" name="gedragsproblemen_thuis" value="Ja" style="width: 20px;" $chk_gedragsproblemen_thuis_ja> Ja </label>
                    <label><input type="radio" name="gedragsproblemen_thuis" value="Nee" style="width: 20px;" $chk_gedragsproblemen_thuis_nee> Nee</label>
                </th>
                <td class="right">
                    <table>
                        <tr><td>Welke?</td><td><input type="text" name="gedragsproblemen_thuis_welke" value="{$leerling['gedragsproblemen_thuis_welke']}" style="width:400px;"></td></tr>
                        <tr><td>Extra info of vraag:</td><td><textarea name="gedragsproblemen_thuis_extra" style="width:400px;">{$leerling['gedragsproblemen_thuis_extra']}</textarea></td></tr>
                    </table>
                </td>                
            </tr>
            <tr>
                <th class="left" valign="top">
                    Gedragsproblemen op school?<br><br><br>
                    <label><input type="radio" name="gedragsproblemen_school" value="Ja" style="width: 20px;" $chk_gedragsproblemen_school_ja> Ja </label>
                    <label><input type="radio" name="gedragsproblemen_school" value="Nee" style="width: 20px;" $chk_gedragsproblemen_school_nee> Nee</label>
                </th>
                <td class="right">
                    <table>
                        <tr><td>Welke?</td><td><input type="text" name="gedragsproblemen_school_welke" value="{$leerling['gedragsproblemen_school_welke']}" style="width:400px;"></td></tr>
                        <tr><td>Extra info of vraag:</td><td><textarea name="gedragsproblemen_school_extra" style="width:400px;">{$leerling['gedragsproblemen_school_extra']}</textarea></td></tr>
                    </table>
                </td>                
            </tr>
            -->
            <tr>
                <th class="left" valign="top">
                    Externe begeleiding?<br><br><br>
                    <label><input type="radio" name="begeleiding" value="Ja" style="width: 20px;" $chk_begeleiding_ja> Ja </label>
                    <label><input type="radio" name="begeleiding" value="Nee" style="width: 20px;" $chk_begeleiding_nee> Nee </label>                    

                    <br><br>Nu nog?<br><br><br>
                    <label><input type="radio" name="begeleiding_nunog" value="Ja" style="width: 20px;" $chk_begeleiding_nunog_ja> Ja </label>
                    <label><input type="radio" name="begeleiding_nunog" value="Nee" style="width: 20px;" $chk_begeleiding_nunog_nee> Nee </label>                    
                </th>
                <td class="right">
                    <table>
                        <tr><td>Wanneer?</td><td><input type="text" name="begeleiding_wanneer" value="{$leerling['begeleiding_wanneer']}" style="width: 400px;"></td></tr>
                        <tr><td>Waar?</td><td><input type="text" name="begeleiding_waar" value="{$leerling['begeleiding_waar']}" style="width: 400px;"></td></tr>
                        <tr><td>Extra info of vraag:</td><td><textarea name="begeleiding_extra" style="width:400px;">{$leerling['begeleiding_extra']}</textarea></td></tr>                        
                    </table>                    
                </td> 
            </tr>
            <tr>
                <th class="left" valign="top">
                    Attesten / verslagen?
                </th>
                <td class="right">
                    <label><input type="radio" name="attesten" value="Ja" style="width: 20px;" $chk_attesten_ja> Ja </label>
                    <label><input type="radio" name="attesten" value="Nee" style="width: 20px;" $chk_attesten_nee> Nee </label>                                
                </td> 
            </tr>
            <tr>
                <th class="left" valign="top">
                    Kandidaat klassenraad?
                </th>
                <td class="right">
                    <label><input type="radio" name="klassenraad" value="Ja" style="width: 20px;" $chk_klassenraad_ja> Ja </label>
                    <label><input type="radio" name="klassenraad" value="Nee" style="width: 20px;" $chk_klassenraad_nee> Nee </label>                                
                </td> 
            </tr>
            <tr>
                <th class="left" valign="top">
                    Gesprek CLB?
                </th>
                <td class="right">
                    <label><input type="radio" name="gesprek_clb" value="Ja" style="width: 20px;" $chk_gesprek_clb_ja> Ja </label>
                    <label><input type="radio" name="gesprek_clb" value="Nee" style="width: 20px;" $chk_gesprek_clb_nee> Nee </label>                                
                </td> 
            </tr>
            <tr>
                <th class="left" valign="top">
                    Gesprek titularis?
                </th>
                <td class="right">
                    <label><input type="radio" name="gesprek_titularis" value="Ja" style="width: 20px;" $chk_gesprek_titularis_ja> Ja </label>
                    <label><input type="radio" name="gesprek_titularis" value="Nee" style="width: 20px;" $chk_gesprek_titularis_nee> Nee </label>                                
                </td> 
            </tr>
            <!--
            <tr>
                <th class="left" valign="top">
                    Hoe best met gedragsprobleem omgaan? Wat wel doen? Wat niet?
                </th>
                <td class="right">
                    <textarea name="omgang" style="width:400px;">{$leerling['omgang']}</textarea>                    
                </td> 
            </tr>
            -->
          </table>
                              
          <div class="btnBig btnBigActive submit">Opslaan</div>
          </form>
      
           
        
HTML;




            }

            return $html;

        }  

        static function save_edit_inschrijving($data){


            $data['soort']['autismespectrumstoornis'] = $data['autismespectrumstoornis'];
            $data['soort']['anderegedragsproblemen'] = $data['problemen_andere'];
            $soorten_problemen = serialize($data['soort']);

            $attesten_extra = $data['attesten'] == "Ja" ? "Asap bezorgen, aan de hand daarvan worden leerkrachten op de hoogte gebracht en kan begeleiding afgesproken worden" : "Leerkrachten krijgen slechts algemene info";

            foreach($data as $key => $value){
                if(!is_array($value)){
                    $data[$key] = mysql_real_escape_string($value);
                }
            }

            $niet_automatisch = array("action","id_leerling","soort","problemen_andere","autismespectrumstoornis");


            $query = "UPDATE vip_gedragsproblemen SET ";
            foreach($data as $key => $value){      
                if(!in_array($key,$niet_automatisch)){
                    $query .= " `$key` = '$value', ";          
                }
            }
            $query .= "`soorten_problemen` = '{$soorten_problemen}', `attesten_extra` = '{$attesten_extra}'";
            $query .= " WHERE id = '{$data['id_leerling']}'";

            query($query);

            return "<div class=\"succes\">VIP inschrijving is succesvol gewijzigd</div>";

        }

        static function delete_inschrijving($id){

            $query = "DELETE FROM vip_gedragsproblemen WHERE id = '{$id}'";
            query($query);

            Notification::set("success","VIP Gedragsproblemen formulier is succesvol verwijderd");

        }

    }  
?>
