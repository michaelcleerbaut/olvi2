<?php
    Class VipLeerprobleem{


        static function show_inschrijvingen(){

            $html = "<div class=\"subtitel\">VIP Leerproblemen inschrijvingen</div>";

            $query = "SELECT v.*, v.id as v_id, l.id_leerling, l.naam, l.voornaam FROM vip_leerproblemen v                
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
                $html .= "<th class=\"left\"><a href=\"/panel/vip_leerproblemen/show/{$row['v_id']}\">$naam</a></th>";                        
                $html .= "<td class=\"center\">$stroom</td>";                        
                $html .= "<td class=\"center\">{$row['opgemaakt_door']}</td>";
                $html .= "<td class=\"center\"><a href=\"/prt/vip/vip_leerproblemen/{$row['id_leerling']}\" target=\"_blank\"><div class=\"print_icon\"></div></a></td>";
                $html .= $_SESSION['gebruiker']['rights']['vip_leerproblemen']['bewerken'] == "YES" ? "<td class=\"center\"><a href=\"/panel/vip_leerproblemen/edit/{$row['v_id']}\">Edit</a></td>" : "";
                $html .= $_SESSION['gebruiker']['rights']['vip_leerproblemen']['delete'] == "YES" ? "<td class=\"center\"><a href=\"/panel/vip_leerproblemen/delete/{$row['v_id']}\" class=\"confirm\">Verwijder</a></td>" : "";
                $html .= "</tr>";


            }


            $html .= "</table>";

            return $html;
        }

        static function show_inschrijving($id){

            $query = "
            SELECT l.*, v.* FROM vip_leerproblemen v
            INNER JOIN leerlingen l ON v.id_leerling = l.id_leerling        
            WHERE v.id = '{$id}'       
            ";    
            $result = query($query);    
            while($leerling = mysql_fetch_assoc($result)){


                $problemen = unserialize($leerling['soorten_problemen']);  

                $chk_dyslexie = array_key_exists("dyslexie",$problemen) ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $chk_dyscalculie = array_key_exists("dyscalculie",$problemen) ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $chk_dyspraxie = array_key_exists("dyspraxie",$problemen) ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $chk_nld = array_key_exists("NLD",$problemen) ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $chk_add = array_key_exists("ADD",$problemen) ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $chk_andere = $problemen['andereleerproblemen'] != "" ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $problemen_andere = $problemen['andereleerproblemen'] != "" ? $problemen['andereleerproblemen'] : "";


                if($leerling['jaar_overgedaan'] == "Ja"){
                    $jaarovergedaan = "
                    Ja
                    <table cellspacing=\"0\" cellpadding=\"0\">
                    <tr><td style=\"width:70px;\">Leerjaar? </td><td> {$leerling['jaar_overgedaan_leerjaar']}</td></tr>
                    <tr><td>Reden? </td><td> {$leerling['jaar_overgedaan_reden']}</td></tr>                    
                    </table>
                    ";
                } else {
                    $jaarovergedaan = "Nee";
                }

                if($leerling['vakgebonden'] == "Ja"){
                    $vakgebonden = "
                    Ja<br>
                    <table cellspacing=\"0\" cellpadding=\"0\">
                    <tr><td style=\"width:110px;\">Welke vakken?</td><td>{$leerling['vakgebonden_vakken']}</td></tr>
                    <tr><td>Soort problemen? </td><td>{$leerling['vakgebonden_soort']}</td></tr>
                    </table>                
                    ";
                } else {
                    $vakgevonden = "Nee";
                }


                if($leerling['gedragsproblemen'] == "Ja"){
                    $gedragsproblemen = "
                    Ja<br>
                    Welke? {$leerling['gedragsproblemen_welke']}<br>                
                    ";
                } else {
                    $gedragsproblemen = "Nee";
                }

                if($leerling['taakleraar_lo'] == "Ja"){
                    $taakleraar_lo = "
                    Ja<br>
                    Reden? {$leerling['taakleraar_lo_reden']} <br>                
                    ";
                } else {
                    $taakleraar_lo = "Nee";
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
                <a href="/panel/vip_leerproblemen/edit/{$id}" class="btnMedium">Edit</a>
            </div>


          <div class="subtitel">VIP Leerproblemen fiche van {$leerling['naam']} {$leerling['voornaam']}</div>
        
          <table class="formulier" cellspacing="2" cellpadding="0">                          
            <tr>
                <th></th>
                <th style="width:400px;"></th>
                <th>Extra info of vraag</th>
            </tr>
            <tr>
                <th class="left">Soorten</th>
                <td class="right">
                    $chk_dyslexie Dyslexie <div style="clear:both;"></div><br>
                    $chk_dyscalculie Dyscalculie <div style="clear:both;"></div><br>
                    $chk_dyspraxie Dyspraxie <div style="clear:both;"></div><br>
                    $chk_nld NLD  <div style="clear:both;"></div><br>
                    $chk_add ADD  <div style="clear:both;"></div><br>
                    $chk_andere Andere: $problemen_andere                
                </td>
                <td></td>                
            </tr>
            <tr>
                <th class="left">Ooit jaar overgedaan?</th>
                <td class="right">$jaarovergedaan</td>
                <td>{$leerling['jaar_overgedaan_extra']}</td>
            </tr>
            <tr>
                <th class="left">Vakgebonden problemen?</th>
                <td class="right">$vakgebonden</td>
                <td>{$leerling['vakgebonden_extra']}</td>
            </tr>
            <tr>
                <th class="left">Bijkomende gedragsproblemen?</th>
                <td class="right">$gedragsproblemen</td>
                <td>{$leerling['gedragsproblemen_extra']}</td>
            </tr>
            <tr>
                <th class="left">Taakleraar in L.O.?</th>
                <td class="right">$taakleraar_lo</td>
                <td>{$leerling['taakleraar_lo_extra']}</td>
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
                <th class="left">Kandidaat klassenraad</th>
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
          </table>
          
          
          
          
          
          
      
           
        
HTML;




            }

            return $html;



        }

        static function edit_inschrijving($id){


            $query = "
            SELECT l.*, v.* FROM vip_leerproblemen v
            INNER JOIN leerlingen l ON v.id_leerling = l.id_leerling        
            WHERE v.id = '{$id}'       
            ";    
            $result = query($query);    
            while($leerling = mysql_fetch_assoc($result)){


                $problemen = unserialize($leerling['soorten_problemen']);  

                $chk_dyslexie = array_key_exists("dyslexie",$problemen) ? " checked=\"checked\"" : "";
                $chk_dyscalculie = array_key_exists("dyscalculie",$problemen) ? " checked=\"checked\"" : "";
                $chk_dyspraxie = array_key_exists("dyspraxie",$problemen) ? " checked=\"checked\"" : "";
                $chk_nld = array_key_exists("NLD",$problemen) ? " checked=\"checked\"" : "";
                $chk_add = array_key_exists("ADD",$problemen) ? " checked=\"checked\"" : "";
                $chk_andere = $problemen['andereleerproblemen'] != "" ? " checked=\"checked\"" : "";
                $problemen_andere = $problemen['andereleerproblemen'] != "" ? $problemen['andereleerproblemen'] : "";



                $chk_jaarovergedaan_ja = $leerling['jaar_overgedaan'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_jaarovergedaan_nee = $leerling['jaar_overgedaan'] == "Nee" ? " checked=\"checked\"" : "";                    

                $chk_vakgebonden_ja = $leerling['vakgebonden'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_vakgebonden_nee = $leerling['vakgebonden'] == "Nee" ? " checked=\"checked\"" : "";      

                $chk_gedragsproblemen_ja = $leerling['gedragsproblemen'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_gedragsproblemen_nee = $leerling['gedragsproblemen'] == "Nee" ? " checked=\"checked\"" : "";

                $chk_taakleraar_lo_ja = $leerling['taakleraar_lo'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_taakleraar_lo_nee = $leerling['taakleraar_lo'] == "Nee" ? " checked=\"checked\"" : "";

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
        
        
          <div class="subtitel">VIP Leerproblemen fiche van {$leerling['naam']} {$leerling['voornaam']}</div>
          
          <form action="/panel/vip_leerproblemen/show/{$id}" method="post"> 
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
                    <label><input type="checkbox" name="soort[dyslexie]" value="YES" $chk_dyslexie style="width: 20px;"> Dyslexie</label> <br>
                    <label><input type="checkbox" name="soort[dyscalculie]" value="YES" $chk_dyscalculie style="width: 20px;"> Dyscalculie</label>  <br>
                    <label><input type="checkbox" name="soort[dyspraxie]" value="YES" $chk_dyspraxie style="width: 20px;"> Dyspraxie</label>  <br>
                    <label><input type="checkbox" name="soort[NLD]" value="YES" $chk_nld style="width: 20px;"> NLD</label> <br>
                    <label><input type="checkbox" name="soort[ADD]" value="YES" $chk_add style="width: 20px;"> ADD</label> <br>
                    <label><input type="checkbox" name="soort[andere]" value="YES" $chk_andere style="width: 20px;"> Andere: </label><input type="text" name="problemen_andere" value="$problemen_andere" style="width: 375px;">
                </td>                
            </tr>
            <tr>
                <th class="left" valign="top">
                    Ooit jaar overgedaan?<br><br><br>
                    <label><input type="radio" name="jaar_overgedaan" value="Ja" style="width: 20px;" $chk_jaarovergedaan_ja> Ja </label>
                    <label><input type="radio" name="jaar_overgedaan" value="Nee" style="width: 20px;" $chk_jaarovergedaan_nee> Nee</label>
                </th>
                <td class="right">
                    <table>
                        <tr><td>Leerjaar?</td><td><input type="text" name="jaar_overgedaan_leerjaar" value="{$leerling['jaar_overgedaan_leerjaar']}" style="width: 400px;"></td></tr>
                        <tr><td>Reden?</td><td><input type="text" name="jaar_overgedaan_reden" value="{$leerling['jaar_overgedaan_reden']}" style="width:400px;"></td></tr>
                        <tr><td>Extra info of vraag:</td><td><textarea name="jaar_overgedaan_extra" style="width:400px;">{$leerling['jaar_overgedaan_extra']}</textarea></td></tr>
                    </table>
                </td>                
            </tr>
            <tr>
                <th class="left" valign="top">
                    Vakgebonden problemen?<br><br><br>
                    <label><input type="radio" name="vakgebonden" value="Ja" style="width: 20px;" $chk_vakgebonden_ja> Ja </label>
                    <label><input type="radio" name="vakgebonden" value="Nee" style="width: 20px;" $chk_vakgebonden_nee> Nee </label>
                </th>
                <td class="right">
                    <table>
                        <tr><td>Vakken?</td><td><input type="text" name="vakgebonden_vakken" value="{$leerling['vakgebonden_vakken']}" style="width: 400px;"></td></tr>
                        <tr><td>Soort?</td><td><input type="text" name="vakgebonden_soort" value="{$leerling['vakgebonden_soort']}" style="width:400px;"></td></tr>
                        <tr><td>Extra info of vraag:</td><td><textarea name="vakgebonden_extra" style="width:400px;">{$leerling['vakgebonden_extra']}</textarea></td></tr>
                    </table>
                </td>                
            </tr>
            <tr>
                <th class="left" valign="top">
                    Bijkomende gedragsproblemen?<br><br><br>
                    <label><input type="radio" name="gedragsproblemen" value="Ja" style="width: 20px;" $chk_gedragsproblemen_ja> Ja </label>
                    <label><input type="radio" name="gedragsproblemen" value="Nee" style="width: 20px;" $chk_gedragsproblemen_nee> Nee </label>
                </th>
                <td class="right">
                    <table>
                        <tr><td>Welke?</td><td><input type="text" name="gedragsproblemen_welke" value="{$leerling['gedragsproblemen_welke']}" style="width: 400px;"></td></tr>
                        <tr><td>Extra info of vraag:</td><td><textarea name="gedragsproblemen_extra" style="width:400px;">{$leerling['jaar_overgedaan_extra']}</textarea></td></tr>
                    </table>                
                </td>                
            </tr>
            <tr>
                <th class="left" valign="top">
                    Taakleraar in L.O.?<br><br><br>
                    <label><input type="radio" name="taakleraar_lo" value="Ja" style="width: 20px;" $chk_taakleraar_lo_ja> Ja </label>
                    <label><input type="radio" name="taakleraar_lo" value="Nee" style="width: 20px;" $chk_taakleraar_lo_nee> Nee </label>                    
                </th>
                <td class="right">
                    <table>
                        <tr><td>Reden?</td><td><input type="text" name="taakleraar_lo_reden" value="{$leerling['taakleraar_lo_reden']}" style="width: 400px;"></td></tr>
                        <tr><td>Extra info of vraag:</td><td><textarea name="taakleraar_lo_extra" style="width:400px;">{$leerling['taakleraar_lo_extra']}</textarea></td></tr>                        
                    </table>                    
                </td> 
            </tr>
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
                    Kandidaat klassenraad
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
          </table>
                              
          <div class="btnBig btnBigActive submit">Opslaan</div>
          </form>
      
           
        
HTML;




            }

            return $html;

        }  

        static function save_edit_inschrijving($data){


            $data['soort']['andereleerproblemen'] = $data['problemen_andere'];
            $soorten_problemen = serialize($data['soort']);

            $attesten_extra = $data['attesten'] == "Ja" ? "Asap bezorgen, dan pas overleg rond compenserende maatregelen" : "Geen compenserende maatregelen";

            foreach($data as $key => $value){
                if(!is_array($value)){
                    $data[$key] = mysql_real_escape_string($value);
                }
            }

            $niet_automatisch = array("action","id_leerling","soort","problemen_andere");


            $query = "UPDATE vip_leerproblemen SET ";
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


            $query = "DELETE FROM vip_leerproblemen WHERE id = '{$id}'";
            query($query);

            Notification::set("success","VIP Leerproblemen formulier is succesvol verwijderd");

        }


    }
?>
