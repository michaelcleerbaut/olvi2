<?php
    Class VipGezondheidsprobleem{


        static function show_inschrijvingen(){

            $html = "<div class=\"subtitel\">VIP Gezondheidsproblemen inschrijvingen</div>";

            $query = "SELECT v.*, v.id as v_id, l.naam, l.voornaam FROM vip_gezondheidsproblemen v                
            INNER JOIN leerlingen l ON v.id_leerling = l.id_leerling
            LEFT JOIN inschrijving i ON v.id_leerling = i.id_leerling                
            WHERE l.deleted != 1 AND i.schooljaar LIKE '{$_SESSION['schooljaar']}'
            ORDER BY l.naam 
            ";    
            $result = query($query);

            $html .= "<table class=\"opties\" cellpadding=\"0\"><tr><th class=\"top\">Naam</th></th><th class=\"top\">Opgemaakt door</th></tr>";

            while($row = mysql_fetch_assoc($result)){

                $naam = $row['voornaam'] != "" || $row['naam'] != "" ? $row['voornaam'] . " " . $row['naam'] : "<i>geen naam</i>";

                $html .= "<tr>";
                $html .= "<th class=\"left\"><a href=\"/panel/vip_gezondheidsproblemen/show/{$row['v_id']}\">$naam</a></th>";                        
                $html .= "<td class=\"center\">{$row['opgemaakt_door']}</td>";
                $html .= "<td class=\"center\"><a href=\"/prt/vip/vip_gezondheidsproblemen/{$row['id_leerling']}\" target=\"_blank\"><div class=\"print_icon\"></div></a></td>";
                $html .= $_SESSION['gebruiker']['rights']['vip_gezondheidsproblemen']['bewerken'] == "YES" ? "<td class=\"center\"><a href=\"/panel/vip_gezondheidsproblemen/edit/{$row['v_id']}\">Edit</a></td>" : "";
                $html .= $_SESSION['gebruiker']['rights']['vip_gezondheidsproblemen']['delete'] == "YES" ? "<td class=\"center\"><a href=\"/panel/vip_gezondheidsproblemen/delete/{$row['v_id']}\" class=\"confirm\">Verwijder</a></td>" : "";
                $html .= "</tr>";


            }


            $html .= "</table>";

            return $html;
        }

        static function show_inschrijving($id){

            $query = "
            SELECT l.*, v.* FROM vip_gezondheidsproblemen v
            INNER JOIN leerlingen l ON v.id_leerling = l.id_leerling        
            WHERE v.id = '{$id}'       
            ";    
            $result = query($query);    
            while($leerling = mysql_fetch_assoc($result)){


                $problemen = unserialize($leerling['soorten_problemen']);  

                $chk_hartkwaal = array_key_exists("hartkwaal",$problemen) ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $chk_kataplexie = array_key_exists("kataplexie",$problemen) ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $chk_gehoorsproblemen = array_key_exists("gehoorsproblemen",$problemen) ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $chk_longaandoening = array_key_exists("longaandoening",$problemen) ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $chk_narcolepsie = array_key_exists("narcolepsie",$problemen) ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $chk_spraakstoornis = array_key_exists("spraakstoornis",$problemen) ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $chk_epilepsie = array_key_exists("epilepsie",$problemen) ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $chk_gezichtsproblemen = array_key_exists("gezichtsproblemen",$problemen) ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $chk_andere = $problemen['anderegezondheidsproblemen'] != "" ? "<div class=\"checkbox_checked\"></div>" : "<div class=\"checkbox_notchecked\"></div>";
                $problemen_andere = $problemen['anderegezondheidsproblemen'] != "" ? $problemen['anderegezondheidsproblemen'] : "";


                if($leerling['attesten'] == "Ja"){
                    $attesten = "Ja <br> {$leerling['attesten_extra']}";
                } else {
                    $attesten = "Nee <br> {$leerling['attesten_extra']}";
                }

                $leerling['omschrijving'] = nl2br($leerling['omschrijving']);

                $html = <<<HTML
        
            <div style="float:right;">
                <a href="/panel/vip_gezondheidsproblemen/edit/{$id}" class="btnMedium">Edit</a>
            </div>        
        
          <div class="subtitel">VIP Gezondheidsproblemen fiche van {$leerling['naam']} {$leerling['voornaam']}</div>
          
                     
          <table class="formulier" cellspacing="2" cellpadding="0">                          
            <tr>
                <th class="left">Soorten</th>
                <td class="right">
                    $chk_hartkwaal Hartkwaal<div style="clear:both;"></div><br>
                    $chk_kataplexie Kataplexie <div style="clear:both;"></div><br>
                    $chk_gehoorsproblemen Gehoorsproblemen <div style="clear:both;"></div><br>
                    $chk_longaandoening Longaandoening<div style="clear:both;"></div><br>
                    $chk_narcolepsie Narcolepsie<div style="clear:both;"></div><br>
                    $chk_spraakstoornis Spraakstoornis<div style="clear:both;"></div><br>
                    $chk_epilepsie Epilepsie<div style="clear:both;"></div><br>
                    $chk_gezichtsproblemen Gezichtsprolemen<div style="clear:both;"></div><br>
                    $chk_andere Andere: $problemen_andere                
                </td>
                <td></td>                
            </tr>
            <!--
            <tr>
                <th class="left">Bijkomende informatie</th>
                <td class="right">{$leerling['bijkomende_informatie']}</td>
            </tr>
            <tr>
                <th class="left">Signalen</th>
                <td class="right">{$leerling['signalen']}</td>
            </tr>
            <tr>
                <th class="left">Wat zeker doen?</th>
                <td class="right">{$leerling['wat_zeker_doen']}/td>
            </tr>
            <tr>
                <th class="left">Wat zeker niet doen?</th>
                <td class="right">{$leerling['wat_zeker_niet_doen']}</td>
            </tr>
            -->
            <tr>
                <th class="left">Omschrijving</th>
                <td class="right">{$leerling['omschrijving']}</td>
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
            SELECT l.*, v.* FROM vip_gezondheidsproblemen v
            INNER JOIN leerlingen l ON v.id_leerling = l.id_leerling        
            WHERE v.id = '{$id}'       
            ";    
            $result = query($query);    
            while($leerling = mysql_fetch_assoc($result)){


                $problemen = unserialize($leerling['soorten_problemen']);  

                $chk_hartkwaal = array_key_exists("hartkwaal",$problemen) ? " checked=\"checked\"" : "";
                $chk_kataplexie = array_key_exists("kataplexie",$problemen) ? " checked=\"checked\"" : "";
                $chk_gehoorsproblemen = array_key_exists("gehoorsproblemen",$problemen) ? " checked=\"checked\"" : "";
                $chk_longaandoening = array_key_exists("longaandoening",$problemen) ? " checked=\"checked\"" : "";
                $chk_narcolepsie = array_key_exists("narcolepsie",$problemen) ? " checked=\"checked\"" : "";
                $chk_epilepsie = array_key_exists("eplepsie",$problemen) ? " checked=\"checked\"" : "";
                $chk_spraakstoornis = array_key_exists("spraakstoornis",$problemen) ? " checked=\"checked\"" : "";
                $chk_gezichtsproblemen = array_key_exists("gezichtsproblemen",$problemen) ? " checked=\"checked\"" : "";
                $chk_andere = $problemen['anderegezondheidsproblemen'] != "" ? " checked=\"checked\"" : "";
                $problemen_andere = $problemen['anderegezondheidsproblemen'] != "" ? $problemen['anderegezondheidsproblemen'] : "";




                $chk_attesten_ja = $leerling['attesten'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_attesten_nee = $leerling['attesten'] == "Nee" ? " checked=\"checked\"" : "";

                $chk_gesprek_clb_ja = $leerling['gesprek_clb'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_gesprek_clb_nee = $leerling['gesprek_clb'] == "Nee" ? " checked=\"checked\"" : "";

                $chk_klassenraad_ja = $leerling['klassenraad'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_klassenraad_nee = $leerling['klassenraad'] == "Nee" ? " checked=\"checked\"" : "";

                $chk_gesprek_titularis_ja = $leerling['gesprek_titularis'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_gesprek_titularis_nee = $leerling['gesprek_titularis'] == "Nee" ? " checked=\"checked\"" : "";

                $chk_begeleiding_nunog_ja = $leerling['begeleiding_nunog'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_begeleiding_nunog_nee = $leerling['begeleiding_nunog'] == "Nee" ? " checked=\"checked\"" : "";



                $html = <<<HTML
        
        
          <div class="subtitel">VIP Gezondheidsproblemen fiche van {$leerling['naam']} {$leerling['voornaam']}</div>
          
          <form action="/panel/vip_gezondheidsproblemen/show/{$id}" method="post"> 
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
                    <label><input type="checkbox" name="soort[hartkwaal]" value="YES" $chk_hartkwaal style="width: 20px;"> Hartkwaal</label> <br>
                    <label><input type="checkbox" name="soort[kataplexie]" value="YES" $chk_kataplexie style="width: 20px;"> Kataplexie</label>  <br>
                    <label><input type="checkbox" name="soort[gehoorsproblemen]" value="YES" $chk_gehoorsproblemen style="width: 20px;"> Gehoorsproblemen</label>  <br>
                    <label><input type="checkbox" name="soort[longaandoening]" value="YES" $chk_longaandoening style="width: 20px;"> Longaandoening</label> <br>
                    <label><input type="checkbox" name="soort[narcolepsie]" value="YES" $chk_narcolepsie style="width: 20px;"> Narcolepsie</label> <br>
                    <label><input type="checkbox" name="soort[spraakstoornis]" value="YES" $chk_spraakstoornis style="width: 20px;"> Spraakstoornis</label> <br>
                    <label><input type="checkbox" name="soort[epilepsie]" value="YES" $chk_epilepsie style="width: 20px;"> Epilepsie</label> <br>
                    <label><input type="checkbox" name="soort[gezichtsproblemen]" value="YES" $chk_gezichtsproblemen style="width: 20px;"> Gezichtsproblemen</label> <br>
                    <label><input type="checkbox" name="soort[andere]" value="YES" $chk_andere style="width: 20px;"> Andere: </label><input type="text" name="problemen_andere" value="$problemen_andere" style="width: 375px;">
                </td>                
            </tr>
            <!--
            <tr>
                <th class="left" valign="top">
                    Bijkomende<br> informatie
                </th>
                <td class="right">                    
                        <textarea name="bijkomende_informatie" style="width:550px;">{$leerling['bijkomende_informatie']}</textarea>                    
                </td>                
            </tr>
            <tr>
                <th class="left" valign="top">
                    Signalen
                </th>
                <td class="right">                    
                        <textarea name="signalen" style="width:550px;">{$leerling['signalen']}</textarea>                    
                </td>                
            </tr>
            <tr>
                <th class="left" valign="top">
                    Wat zeker doen?
                </th>
                <td class="right">                    
                        <textarea name="wat_zeker_doen" style="width:550px;">{$leerling['wat_zeker_doen']}</textarea>                    
                </td>                
            </tr>
            <tr>
                <th class="left" valign="top">
                    Wat zeker niet doen
                </th>
                <td class="right">                    
                        <textarea name="wat_zeker_niet_doen" style="width:550px;">{$leerling['wat_zeker_niet_doen']}</textarea>                    
                </td>                
            </tr>
            -->
            <tr>
                <th class="left" valign="top">Omschrijving</th>
                <td><textarea name="omschrijving" style="width:550px;height:200px;">{$leerling['omschrijving']}</textarea></td>
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


            $data['soort']['anderegezondheidsproblemen'] = $data['problemen_andere'];
            $soorten_problemen = serialize($data['soort']);

            $attesten_extra = $data['attesten'] == "Ja" ? "Asap bezorgen" : "Leerkrachten krijgen algemene info";

            foreach($data as $key => $value){
                if(!is_array($value)){
                    $data[$key] = mysql_real_escape_string($value);
                }
            }

            $niet_automatisch = array("action","id_leerling","soort","problemen_andere");


            $query = "UPDATE vip_gezondheidsproblemen SET ";
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

            $query = "DELETE FROM vip_gezondheidsproblemen WHERE id = '{$id}'";
            query($query);

            Notification::set("success","VIP Gezondheidsproblemen formulier is succesvol verwijderd");

        }


    }
?>
