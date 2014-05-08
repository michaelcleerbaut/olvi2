<?
    Class voorinschrijving{

        static function menu(){
        
            $aantalinschrijvingenA = self::get_aantal_inschrijvingen("A");
            $aantalinschrijvingenB = self::get_aantal_inschrijvingen("B");

            $html = <<<HTML
    <div class="subtitel">Wat wil u doen?</div>

    <ul class="opties">
        <li><a href="/panel/voorinschrijvingen/show_all/A">Bekijk voorinschrijvingen Stroom A <strong>({$aantalinschrijvingenA})</strong></a></li>
        <li><a href="/panel/voorinschrijvingen/show_all/B">Bekijk voorinschrijvingen Stroom B <strong>({$aantalinschrijvingenB})</strong></a></li>
    </ul>    
HTML;
            return $html; 
        }

        static function get_aantal_inschrijvingen($stroom){

            $query = "SELECT id_inschrijving, definschrijving FROM inschrijving WHERE stroom = '$stroom' AND voorinschrijving = '1' AND schooljaar LIKE '{$_SESSION['schooljaar']}'";            
            $result = query($query);
            
            $def = 0;
            $voor = 0;
            while($row = mysql_fetch_assoc($result)){
                if($row['definschrijving'] == 1){
                    $def += 1;
                } else {
                    $voor += 1;                   
                }
                $totaal += 1;
            }
            

            return "$totaal: $def definitief, $voor nog niet definitief";

        }

        static function show_voorinschrijvingen($stroom = ""){

            $anderestroom = $stroom == "A" ? "B" : "A";

            $html = "<div class=\"subtitel\">Voorinschrijvingen Stroom {$stroom}</div>";

            $query = "SELECT i.*, i.id_inschrijving as i_id, l.* FROM inschrijving i
            INNER JOIN leerlingen l ON i.id_leerling = l.id_leerling
            WHERE i.stroom = '{$stroom}' AND i.voorinschrijving = '1' AND i.definschrijving = '0' AND i.schooljaar LIKE '{$_SESSION['schooljaar']}'
            ORDER BY volgnummer
            ";                
            $result = query($query);


            $html .= "<table class=\"opties\" cellpadding=\"0\"><tr><th class=\"top\">Naam</th></th><th class=\"top\">V Nr $stroom</th><th class=\"top\">V Nr $anderestroom</th><th>Print</th></tr>";

            while($row = mysql_fetch_assoc($result)){

                $ookandere = "Nee";
                $volgnummerandere = "";
                $query2 = "SELECT volgnummer FROM inschrijving WHERE id_leerling = '{$row['id_leerling']}' AND stroom = '$anderestroom'";
                $result2 = query($query2);
                while($row2 = mysql_fetch_assoc($result2)){            
                    $volgnummerandere = $row2['volgnummer'];
                }

                $naam = $row['voornaam'] != "" || $row['naam'] != "" ? $row['voornaam'] . " " . $row['naam'] : "<i>geen naam</i>";

                $html .= "<tr>";
                $html .= "<th class=\"left\"><a href=\"/panel/voorinschrijvingen/show/{$stroom}/{$row['i_id']}\">$naam</a></th>";
                $html .= "<td class=\"center\">{$row['volgnummer']} </td>";
                $html .= "<td class=\"center\">$volgnummerandere</td>";
                $html .= "<td class=\"center\"><a href=\"/prt/voorinschrijving/{$row['i_id']}/{$row['id_leerling']}\" target=\"_blank\"><div class=\"print_icon\"></div></a></td>";
                $html .= $_SESSION['gebruiker']['rights']['voorinschrijvingen']['invullen'] == "YES" ? "<td class=\"center\"><a href=\"/panel/voorinschrijvingen/edit/{$_GET['param1']}/{$row['i_id']}\">Edit</a></td>" : "";
                $html .= $_SESSION['gebruiker']['rights']['voorinschrijvingen']['uitschrijven'] == "YES" ? "<td class=\"center\"><a href=\"/panel/voorinschrijvingen/uitschrijven/{$row['i_id']}/{$_GET['param1']}\" class=\"confirm\">Uitschrijven</a></td>" : "";
                $html .= $_SESSION['gebruiker']['rights']['voorinschrijvingen']['delete'] == "YES" ? "<td class=\"center\"><a href=\"/panel/voorinschrijvingen/delete/{$row['i_id']}/{$_GET['param1']}\" class=\"confirm\">Verwijder leerling</a></td>" : "";
                $html .= "</tr>";


            }


            $html .= "</table>";

            return $html;
        }

        static function edit_inschrijving($inschrijving_id){

            $query = "SELECT i.*, l.*, a.*, b.*, c.* FROM inschrijving i
            LEFT JOIN leerlingen l ON i.id_leerling = l.id_leerling                
            LEFT JOIN loopbaan b ON i.id_leerling = b.leerling_id
            LEFT JOIN communicatie c ON i.id_leerling = c.id_leerling
            LEFT JOIN afspraken a ON i.id_leerling = a.id_leerling
            WHERE i.id_inschrijving = '{$inschrijving_id}'              
            ";    
            $result = query($query);
            while($leerling = mysql_fetch_assoc($result)){


                if($leerling['stroom'] == "A"){
                    $stroomandere = "B";
                    $volgnummerA = $leerling['volgnummer'];
                    $volgnummerB = "";
                } else {
                    $stroomandere = "A";
                    $volgnummerB = $leerling['volgnummer']; 
                    $volgnummerA = "";
                }

                $volgnummerandere = "";
                $query2 = "SELECT volgnummer FROM inschrijving WHERE id_leerling = '{$leerling['id_leerling']}' AND stroom = '$stroomandere'";        
                $result2 = query($query2);
                while($row2 = mysql_fetch_assoc($result2)){            
                    $volgnummerandere = $row2['volgnummer'];
                }        



                $ookanderestroom = $volgnummerandere == "" ? 0 : 1;

                if($leerling['stroom'] == "A"){
                    $volgnummers = "<tr><th class=\"left\">Volgnummer stroom A</th><td class=\"right\">{$volgnummerA}</td></tr>";
                    if($ookanderestroom == 1){
                        $volgnummers .= "<tr><th class=\"left\">Volgnummer stroom B</th><td class=\"right\">{$volgnummerandere}</td></tr>";
                    }
                } else if ($leerling['stroom'] == "B"){
                    $volgnummers = "<tr><th class=\"left\">Volgnummer stroom B</th><td class=\"right\">{$volgnummerB}</td></tr>";
                    if($ookanderestroom == 1){
                        $volgnummers .= "<tr><th class=\"left\">Volgnummer stroom A</th><td class=\"right\">{$volgnummerandere}</td></tr>";
                    }            
                }


                $afspraak_titel = "Afspraak op";
                if($leerling['dag'] == "tel"){
                    $afspraak = "Deze persoon had graag telefonisch een afspraak gemaakt.";            
                } else {
                    $afspraak = $leerling['dag'] . " Mei, om " . $leerling['uur'];
                    if(($volgnummerB >= 25 && $volgnummerandere != "" ) || ($volgnummerA != "" && $volgnummerandere >= 25)){
                        $afspraak_titel = "Afspraak op";
                    }
                }

                $leerling['geboortedatum'] = date("d M Y", strtotime($leerling['geboortedatum']));


                $query = "SELECT * FROM studiekeuzes";
                $result = query($query);
                while($row = mysql_fetch_assoc($result)){
                    $vakken[$row['afkorting']] = $row['studiekeuze'];
                }  


                $keuzevakken = unserialize($leerling['keuzevakken']);
                if(is_array($keuzevakken) && count($keuzevakken) > 0){
                    asort($keuzevakken);
                }


                $keuzevakkenprint = "";  
                if(is_array($keuzevakken)){
                    foreach($keuzevakken as $afkorting => $order){
                        $keuzevakkenprint .= $order . ": " . $vakken[$afkorting] . "<br>";
                    }        
                }





                $stroom_andere = $leerling['stroom'] == "A" ? "B" : "A";
                $queryS = "SELECT stroom FROM inschrijving WHERE id_leerling = '{$leerling['id_leerling']}' AND stroom = '$stroom_andere'";
                $resultS = query($queryS);
                $andereS = mysql_fetch_assoc($resultS);

                $interessedomeinen_a = array("A-Stroom: Klassieke vorming","A-Stroom: Algemene vorming","Nog niet bepaald");
                $interessedomeinen_b = array("1B","Nog niet bepaald");

                $studiekeuze = is_array(unserialize($leerling['studiekeuze'])) ? unserialize($leerling['studiekeuze']) : array();                        


                $keuzevak_show = $studiekeuze['A'] == "A-Stroom: Algemene vorming" ? "": "style=\"display:none;\"";      

                $querySK = "SELECT * FROM studiekeuzes";
                $resultSK = query($querySK);
                $studiekeuzes = "<div id=\"keuzevakken\" $keuzevak_show>";
                while($sk = mysql_fetch_assoc($resultSK)){            
                    $keuzevak_order = $keuzevakken[$sk['afkorting']];
                    $studiekeuzes .= "<input type=\"text\" style=\"width:20px;\" name=\"studiekeuze[{$sk['afkorting']}]\" value=\"$keuzevak_order\" class=\"keuzevak\"> {$sk['afkorting']} - {$sk['studiekeuze']}<br><br>";
                }        
                $studiekeuzes .= "</div>";

                if($leerling['stroom'] == "A" || ($leerling['stroom'] == "B" && $andereS['stroom'] == "A")){                    
                    $domeinen_select = "<select name=\"interessedomein_a\" id=\"interessedomein_a\"><option value=\"\">Maak een keuze</option>";
                    foreach($interessedomeinen_a as $domein){
                        $select = $domein == $studiekeuze['A'] ? " selected=\"selected\"" : "";
                        $domeinen_select .= "<option value=\"$domein\" $select>$domein</option>";
                    }
                    $domeinen_select .= "</select>";

                    $trs_studiekeuze_stroomA = "
                    <tr><th class=\"left\">Interessedomein A Stroom</th><td class=\"right\"><span style=\"font-size: 16px;\">$domeinen_select</span></td></tr>
                    <tr><th class=\"left\">Keuzevakken</th><td class=\"right\">{$studiekeuzes}</td></tr>            
                    ";
                }

                if($leerling['stroom'] == "B" || ($leerling['stroom'] == "A" && $andereS['stroom'] == "B")){
                    $domeinen_select = "<select name=\"interessedomein_b\"><option value=\"\">Maak een keuze</option>";
                    foreach($interessedomeinen_b as $domein){
                        $select = $domein == $studiekeuze['B'] ? " selected=\"selected\"" : "";
                        $domeinen_select .= "<option value=\"$domein\" $select>$domein</option>";
                    }
                    $domeinen_select .= "</select>";

                    $trs_studiekeuze_stroomB = "
                    <tr><th class=\"left\">Interessedomein B Stroom</th><td class=\"right\"><span style=\"font-size: 16px;\">$domeinen_select</span></td></tr>              
                    ";
                }

                if(!array_key_exists('A',$studiekeuze) && !array_key_exists('B',$studiekeuze)){
                    $trs_studiekeuze_stroomA = "
                    <tr><th class=\"left\">Interessedomein A Stroom</th><td class=\"right\"><span style=\"font-size: 16px;\"></span></td></tr>
                    <tr><th class=\"left\">Keuzevakken</th><td class=\"right\"></td></tr>
                    ";
                    $trs_studiekeuze_stroomB = "";
                }


                $html = <<<HTML
        
            <div id="search_lagere_school_con" style="position: fixed;">
                <h3>Zoek jouw lagere school</h3>
                
                <table class="formulier">
                    <tr>
                        <td>Postcode of gemeente</td>
                        <td><input type="text" id="edit_inschr_search_lagere_school_pg" value=""></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="edit_inschrresult_lagere_scholen"></td>
                    </tr>
                </table>
                
                <div id="edit_inschr_result_lagere_scholen"></div>
                
                <div class="btnMedium" id="edit_inschr_annuleer_search_lagereschool" style="float:right;">Annuleer</div>
                
            </div>

          <div class="subtitel">Inschrijving {$leerling['naam']} {$leerling['voornaam']}</div>
          
          <ul class="opties">
            <li><div class="pointer"></div><a href="#persoonlijke_gegevens">Persoonlijke gegevens kind</a></li>
            <li><div class="pointer"></div><a href="#communicatie">Communicatie gegevens</a></li>
            <li><div class="pointer"></div><a href="#studiekeuze">Studiekeuze</a></li>
            <li><div class="pointer"></div><a href="#afspraak">Afspraak</a></li>
          </ul>
                    
          <form action="/panel/voorinschrijvingen/show/{$_GET['param1']}/$inschrijving_id" method="post"> 
          <input type="hidden" name="action" value="update_inschrijving">
          <input type="hidden" name="id_leerling" value="{$leerling['id_leerling']}">
          <input type="hidden" name="huidigschooljaar" value="{$leerling['huidigschooljaar']}">
          <h3 id="persoonlijke_gegevens">Persoonlijke gegevens kind</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">    
            $volgnummers
            <tr><th class="left">Naam <div class="small">(achternaam - voornaam)</div></th><td class="right"><input type="text" name="naam" value="{$leerling['naam']}" style="width: 277px;"> <input type="text" name="voornaam" value="{$leerling['voornaam']}" style="width: 278px;"></td></tr>
            <tr><th class="left">Adres <div class="small">(straat, huisnr, busnr)<br>(postcode,gemeente)</div></th><td class="right"><input type="text" name="straat" value="{$leerling['straat']}" style="width: 478px;"> <input type="text" name="huisnummer" value="{$leerling['huisnummer']}" style="width:30px;"> <input type="text" name="busnummer" value="{$leerling['busnummer']}" style="width:30px;"><br><br> <input type="text" name="postcode" id="edit_inschr_postcode" value="{$leerling['postcode']}" style="width: 100px;">  <input type="text" name="plaats" id="edit_inschr_plaats" value="{$leerling['plaats']}" style="width: 455px;"></td></tr>            
            <tr><th class="left">Lagere school</th><td class="right"><div style="float:left;" id="kind_vorige_school">{$leerling['school_vorig_schooljaar']}</div><input type="hidden" id="kind_vorige_school_input" name="school_vorig_schooljaar" value="{$leerling['school_vorig_schooljaar']}"><input type="hidden" id="vorige_school_id" name="school_id" value="{$leerling['school_id']}"><div style="float:left;text-decoration:underline;color:#b3df79;cursor:pointer;margin-left: 10px;" id="edit_inschr_search_lagere_school">Wijzig</div></td></tr>
          </table>


          <h3 id="communicatie">Communicatie</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">        
            <tr><th class="left">Telefoon</th><td class="right"><input type="text" name="telefoon" value="{$leerling['telefoon']}"></td></tr>
            <tr><th class="left">Email</th><td class="right"><input type="text" name="email" value="{$leerling['email']}"></td></tr>
          </table>

                   

          <h3 id="studiekeuze">Studiekeuze</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">        
            $trs_studiekeuze_stroomA
            $trs_studiekeuze_stroomB
          </table>
          
          <h3 id="afspraak">Afspraak gegevens</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">      
            <tr><th class="left">$afspraak_titel</th><td class="right">$afspraak</td></tr>
          </table>          
          
          
          <div class="btnBig btnBigActive submit">Opslaan</div>
          </form>
      
           
           <script type="text/javascript">
           $('#interessedomein_a').change(function(){           
            if($(this).val() == "A-Stroom: Algemene vorming"){
                $('#keuzevakken').show();
            } else {
                $('#keuzevakken').hide();
            }
           });
           </script>
        
HTML;




            }

            return $html;

        } 

        static function show_inschrijving($inschrijving_id){

            $query = "SELECT i.*, l.*, c.email as email_c, c.telefoon as tel_c, a.*, b.studiekeuze, b.keuzevakken FROM inschrijving i
            INNER JOIN leerlingen l ON i.id_leerling = l.id_leerling
            LEFT JOIN loopbaan b ON i.id_leerling = b.leerling_id
            LEFT JOIN communicatie c ON i.id_leerling = c.id_leerling
            LEFT JOIN afspraken a ON i.id_leerling = a.id_leerling
            WHERE i.id_inschrijving = '{$inschrijving_id}'              
            ";    
            $result = query($query);
            while($row = mysql_fetch_assoc($result)){

                if($row['stroom'] == "A"){
                    $stroomandere = "B";
                    $volgnummerA = $row['volgnummer'];
                    $volgnummerB = "";
                } else {
                    $stroomandere = "A";
                    $volgnummerB = $row['volgnummer']; 
                    $volgnummerA = "";
                }

                $volgnummerandere = "";
                $query2 = "SELECT volgnummer FROM inschrijving WHERE id_leerling = '{$row['id_leerling']}' AND stroom = '$stroomandere'";        
                $result2 = query($query2);
                while($row2 = mysql_fetch_assoc($result2)){            
                    $volgnummerandere = $row2['volgnummer'];
                }        



                $ookanderestroom = $volgnummerandere == "" ? 0 : 1;

                if($row['stroom'] == "A"){
                    $volgnummers = "<tr><th class=\"left\">Volgnummer stroom A</th><td class=\"right\">{$volgnummerA}</td></tr>";
                    if($ookanderestroom == 1){
                        $volgnummers .= "<tr><th class=\"left\">Volgnummer stroom B</th><td class=\"right\">{$volgnummerandere}</td></tr>";
                    }
                } else if ($row['stroom'] == "B"){
                    $volgnummers = "<tr><th class=\"left\">Volgnummer stroom B</th><td class=\"right\">{$volgnummerB}</td></tr>";
                    if($ookanderestroom == 1){
                        $volgnummers .= "<tr><th class=\"left\">Volgnummer stroom A</th><td class=\"right\">{$volgnummerandere}</td></tr>";
                    }            
                }


                $afspraak_titel = "Afspraak op";
                if($row['dag'] == "tel"){
                    $afspraak = "Deze persoon had graag telefonisch een afspraak gemaakt.";            
                } else {
                    $afspraak = $row['dag'] . " Mei, om " . $row['uur'];
                    if(($volgnummerB >= 25 && $volgnummerandere != "" ) || ($volgnummerA != "" && $volgnummerandere >= 25)){
                        $afspraak_titel = "Afspraak (A Stroom) op";
                    }
                }

                $studiekeuze = is_array(unserialize($row['studiekeuze'])) ? unserialize($row['studiekeuze']) : array();;

                if(array_key_exists("A",$studiekeuze)){
                    $keuzevakken = is_array(unserialize($row['keuzevakken'])) ? unserialize($row['keuzevakken']) : array();
                    $keuzeA = "<tr><th class=\"left\">A Stroom</th><td class=\"right\">{$studiekeuze['A']}</td></tr>";
                    $studiekeuzevakken = "";
                    if(is_array($keuzevakken) && count($keuzevakken) > 0){                
                        asort($keuzevakken);

                        foreach($keuzevakken as $vak => $prio){
                            if($prio == "aalgemeen" || $prio == "aklassiek" || $prio == "nb") continue;
                            $studiekeuzevakken .= $prio . ": " . $vak . "<br>";
                        }
                    }
                    $keuzeA .= "<tr><th class=\"left\">Keuzevakken</th><td class=\"right\">$studiekeuzevakken</td></tr>";
                } else {
                    $keuzeA = "";
                }

                if(array_key_exists("B",$studiekeuze)){
                    $keuzeB = "<tr><th class=\"left\">B Stroom</th><td class=\"right\">{$studiekeuze['B']}</td></tr>";
                } else {
                    $keuzeB = "";
                }


                $html = <<<HTML
        
          <div class="subtitel">Inschrijving {$row['naam']} {$row['voornaam']}</div>
           
          <h3>Persoonlijke gegevens kind</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">    
            $volgnummers
            <tr><th class="left">Naam</th><td class="right">{$row['naam']}</td></tr>
            <tr><th class="left">Voornaam</th><td class="right">{$row['voornaam']}</td></tr>
            <tr><th class="left">Straat + nr</th><td class="right">{$row['straat']} {$row['huisnummer']} {$row['busnummer']}</td></tr>
            <tr><th class="left">Postcode + gemeente</th><td class="right">{$row['postcode']} {$row['plaats']}</td></tr>
            <tr><th class="left">Lagere school</th><td class="right">{$row['school_vorig_schooljaar']}</td></tr>
          </table>
          
          <h3>Communicatie gegevens</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">    
            <tr><th class="left">Telefoon</th><td class="right">{$row['tel_c']}</td></tr>
            <tr><th class="left">Email</th><td class="right">{$row['email_c']}</td></tr>
          </table>
          
          <h3>Afspraak gegevens</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">      
            <tr><th class="left">$afspraak_titel</th><td class="right">$afspraak</td></tr>
          </table>

          <h3>Studiekeuze</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">      
            $keuzeA
            $keuzeB
          </table>
          
          
          
          
      
           
        
HTML;




            }

            return $html;



        }
        

        static function update_inschrijving($data){

            foreach($data as $key => $value){
                if(!is_array($value)){
                    $data[$key] = mysql_real_escape_string($value);
                }
            }

            $niet_automatisch = array("action","id_leerling");

            $leerlingen = array("naam","voornaam","straat","huisnummer","busnummer","postcode","plaats","school_vorig_schooljaar","school_id");
            $loopbaan = array("dubbele_afdruk","toestemming_baso_werking");
            $communicatie = array("telefoon","email");


            $queryLeerlingen = "UPDATE leerlingen SET ";
            foreach($data as $key => $value){
                if(in_array($key,$leerlingen)){
                    $queryLeerlingen .= " `$key` = '$value', ";
                }          
            }
            $queryLeerlingen = substr($queryLeerlingen,0,-2) . " WHERE id_leerling = '{$data['id_leerling']}'";

            if($data['interessedomein_a'] != ""){
                $studiekeuze['A'] = $data['interessedomein_a'];
                $inschrijving_opmerking['A'] = $data['interessedomein_a'] . " " . $data['huidigschooljaar'];
            }
            if($data['interessedomein_b'] != ""){
                $studiekeuze['B'] = $data['interessedomein_b'];
                $inschrijving_opmerking['B'] = $data['interessedomein_b'] . " " . $data['huidigschooljaar'];
            }
            if($data['interessedomein_a'] == "A-Stroom: Algemene vorming"){
                foreach($data['studiekeuze'] as $afk => $order){
                    if($order != ""){
                        $keuzevakken[$afk] = $order;
                    }
                }
            }
            $keuzevakken = serialize($keuzevakken);
            $studiekeuze = serialize($studiekeuze);
            $inschrijving_opmerking = serialize($inschrijving_opmerking);

            $queryLoopbaan = "UPDATE loopbaan SET keuzevakken = '{$keuzevakken}', studiekeuze = '{$studiekeuze}', inschrijving_opmerking = '{$inschrijving_opmerking}' WHERE leerling_id = '{$data['id_leerling']}'";

            $queryCommunicatie = "UPDATE communicatie SET ";
            foreach($data as $key => $value){
                if(in_array($key,$communicatie)){
                    $queryCommunicatie.= " `$key` = '$value', ";
                }          
            }
            $queryCommunicatie = substr($queryCommunicatie,0,-2) . " WHERE id_leerling = '{$data['id_leerling']}'";


            query($queryLeerlingen);
            query($queryLoopbaan);
            query($queryCommunicatie);



            return "<div class=\"succes\">Leerling is succesvol gewijzigd</div>";

        }

        static function delete_leerling($inschrijving_id){

            $query = "SELECT id_leerling FROM inschrijving WHERE id_inschrijving = '{$inschrijving_id}'";
            $result = query($query);
            while($row = mysql_fetch_assoc($result)){
                $id_leerling = $row['id_leerling'];
            }

            $query = "DELETE FROM inschrijving WHERE id_inschrijving = '{$inschrijving_id}'";
            query($query);

            $query = "DELETE FROM uitschrijving WHERE id_leerling = '{$id_leerling}'";
            query($query);

            $query = "DELETE FROM leerlingen WHERE id_leerling = '{$id_leerling}'";
            query($query);

            $query = "DELETE FROM afspraken WHERE id_leerling = '{$id_leerling}'";
            query($query);
                     
            $query = "DELETE FROM communicatie WHERE id_leerling = '{$id_leerling}'";
            query($query);

            $query = "DELETE FROM leerlingen WHERE id_leerling = '{$id_leerling}'";
            query($query);

            $query = "DELETE FROM loopbaan WHERE leerling_id = '{$id_leerling}'";
            query($query);

            $query = "DELETE FROM vip WHERE id_leerling = '{$id_leerling}'";
            query($query);

            $query = "DELETE FROM vader WHERE id_leerling = '{$id_leerling}'";
            query($query);

            $query = "DELETE FROM moeder WHERE id_leerling = '{$id_leerling}'";
            query($query);            
            
            Notification::set("success","Leerling is succesvol verwijderd");       


        }
        

        static function uitschrijven($inschrijving_id){

            $query = "SELECT * FROM inschrijving WHERE id_inschrijving = '{$inschrijving_id}'";
            $result = query($query);
            while($row = mysql_fetch_assoc($result)){
                $inschrijving = $row;
            }
            
            $date = date("Y-m-d H:i");

            $query = "INSERT INTO uitschrijving 
                (                
                    `id_inschrijving`,
                    `id_leerling`,
                    `stroom`,
                    `volgnummer`,
                    `voorinschrijving`,
                    `definschrijving`,
                    `def_ingeschreven_door`,
                    `voor_ingeschreven_door`,
                    `datum_voorinschrijving`,
                    `datum_inschrijving`,
                    `schooljaar`,
                    `datum_uitschrijving`,
                    `uitgeschreven_door`
                )
                    VALUES
                (
                    '{$inschrijving['id_inschrijving']}',
                    '{$inschrijving['id_leerling']}',
                    '{$inschrijving['stroom']}',
                    '{$inschrijving['volgnummer']}',
                    '{$inschrijving['voorinschrijving']}',
                    '{$inschrijving['definschrijving']}',
                    '{$inschrijving['def_ingeschreven_door']}',
                    '{$inschrijving['voor_ingeschreven_door']}',
                    '{$inschrijving['datum_voorinschrijving']}',
                    '{$inschrijving['datum_inschrijving']}',
                    '{$inschrijving['schooljaar']}',                    
                    '$date',
                    '{$_SESSION['gebruiker']['id']}'
                )
            ";
            query($query);
            
            $query = "DELETE FROM inschrijving WHERE id_inschrijving = '{$inschrijving_id}'";
            query($query);

            $query = "DELETE FROM afspraken WHERE id_leerling = '{$id_leerling}'";
            query($query);


            Notification::set("success","Inschrijving is succesvol uitgeschreven");       

        }
        
        

    }
?>