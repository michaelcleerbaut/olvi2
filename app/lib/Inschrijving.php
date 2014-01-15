<?php
    Class Inschrijving{

        static function menu(){

            $aantalinschrijvingenA = self::get_aantal_inschrijvingen("A");
            $aantalinschrijvingenB = self::get_aantal_inschrijvingen("B");

            $html = <<<HTML
                <div class="subtitel">Wat wil u doen?</div>

                <ul class="opties">
                    <li><a href="/panel/inschrijvingen/show_all/A">Bekijk inschrijvingen Stroom A <strong>({$aantalinschrijvingenA})</strong></a></li>
                    <li><a href="/panel/inschrijvingen/show_all/B">Bekijk inschrijvingen Stroom B <strong>({$aantalinschrijvingenB})</strong></a></li>
                </ul>    
HTML;
            return $html; 
        }


        static function get_aantal_inschrijvingen($stroom){

            $query = "SELECT id_leerling FROM inschrijving WHERE stroom = '$stroom' AND definschrijving = '1'";
            $result = query($query);
            $aantal = mysql_num_rows($result);

            return $aantal;

        }

        static function show_inschrijvingen($stroom = ""){

            $anderestroom = $stroom == "A" ? "B" : "A";

            $html = "<div class=\"subtitel\">Inschrijvingen Stroom {$stroom}</div>";

            $query = "SELECT i.*, i.id_inschrijving as i_id, l.*, g.id, g.naam as gebruiker_naam FROM inschrijving i
            LEFT JOIN leerlingen l ON i.id_leerling = l.id_leerling
            LEFT JOIN gebruikers g ON i.def_ingeschreven_door = g.id
            WHERE i.stroom = '{$stroom}' AND i.definschrijving = '1'
            ORDER BY volgnummer
            ";    
            $result = query($query);


            $html .= "<table class=\"opties\" cellpadding=\"0\"><tr><th class=\"top\">Naam</th></th><th class=\"top\">V Nr $stroom</th><th class=\"top\">V Nr $anderestroom</th><th class=\"top\">Ingeschreven door</th></tr>";

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
                $html .= "<th class=\"left\"><a href=\"/panel/inschrijvingen/show/{$_GET['param1']}/{$row['i_id']}\">$naam</a></th>";
                $html .= "<td class=\"center\">{$row['volgnummer']} </td>";
                $html .= "<td class=\"center\">$volgnummerandere</td>";
                $html .= "<td class=\"center\">{$row['gebruiker_naam']}</td>";
                $html .= "<td class=\"center\"><a href=\"/prt/inschrijving/{$row['i_id']}/{$row['id_leerling']}\" target=\"_blank\"><div class=\"print_icon\"></div></a></td>";
                $html .= $_SESSION['gebruiker']['rights']['inschrijvingen']['invullen'] == "YES" ? "<td class=\"center\"><a href=\"/panel/inschrijvingen/edit/{$_GET['param1']}/{$row['i_id']}\">Edit</a></td>" : "";
                $html .= $_SESSION['gebruiker']['rights']['inschrijvingen']['delete'] == "YES" ? "<td class=\"center\"><a href=\"/panel/inschrijvingen/delete/{$_GET['param1']}/{$row['i_id']}\" class=\"confirm\">Verwijder</a></td>" : "";
                $html .= "</tr>";


            }


            $html .= "</table>";

            return $html;
        }

        static function show_inschrijving($inschrijving_id){

            $query = "SELECT i.*, l.*, a.*, m.*, b.*, v.*, p.* FROM inschrijving i
            LEFT JOIN leerlingen l ON i.id_leerling = l.id_leerling                
            LEFT JOIN loopbaan b ON i.id_leerling = b.leerling_id
            LEFT JOIN moeder m ON i.id_leerling = m.id_leerling
            LEFT JOIN vader v ON i.id_leerling = v.id_leerling
            LEFT JOIN vip p ON i.id_leerling = p.id_leerling
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
                        $afspraak_titel = "Afspraak (A Stroom) op";
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

                
                $adres_middag = $leerling['straat'] != "" ? $leerling['straat'] . " " . $leerling['huisnummer'] . " " . $leerling['busnummer'] . ", " . $leerling['postcode'] . " " . $leerling['plaats'] : $leerling['middag_straat'] . " " . $leerling['middag_huisnummer'] . " " . $leerling['middag_busnummer'] . ", " . $leerling['middag_postcode'] . " " . $leerling['middag_plaats'];                
                $thuistaal = $leerling['thuistaal'] == "Ja" ? "Ja" : "Nee: " . $leerling['thuistaal'];
                $toestemming_baso = $leerling['toestemming_baso_werking'] == "YES" ? "Ja" : "Nee";

                $studiekeuze = is_array(unserialize($leerling['studiekeuze'])) ? unserialize($leerling['studiekeuze']) : array();        

                if(array_key_exists("A",$studiekeuze)){
                    $trs_studiekeuze_stroomA = "
                    <tr><th class=\"left\">Interessedomein A Stroom</th><td class=\"right\"><span style=\"font-size: 16px;\">{$studiekeuze['A']}</span></td></tr>
                    <tr><th class=\"left\">Keuzevakken</th><td class=\"right\">{$keuzevakkenprint}</td></tr>            
                    ";
                }
                if(array_key_exists("B",$studiekeuze)){
                    $trs_studiekeuze_stroomB = "
                    <tr><th class=\"left\">Interessedomein B Stroom</th><td class=\"right\"><span style=\"font-size: 16px;\">{$studiekeuze['B']}</span></td></tr>              
                    ";
                }

                if(!array_key_exists('A',$studiekeuze) && !array_key_exists('B',$studiekeuze)){
                    $trs_studiekeuze_stroomA = "
                    <tr><th class=\"left\">Interessedomein A Stroom</th><td class=\"right\"><span style=\"font-size: 16px;\"></span></td></tr>
                    <tr><th class=\"left\">Keuzevakken</th><td class=\"right\"></td></tr>
                    ";
                    $trs_studiekeuze_stroomB = "";
                }

                if($leerling['stiefouders'] == "Ja"){
                    $stiefouders = "<div style=\"float:left;\">";
                        $stiefouders .= "<u>Partner mama</u><br>";
                        $stiefouders .= $leerling['partnermama_naam'] != "" || $leerling['partnermama_voornaam'] != "" ? $leerling['partnermama_naam'] . " " . $leerling['partnermama_voornaam'] . "<br>" : "";
                        $stiefouders .= $leerling['partnermama_gsm'] != "" ? $leerling['partnermama_gsm'] . "<br>" : "";
                        $stiefouders .= $leerling['partnermama_email'] != "" ? $leerling['partnermama_email'] : "";
                    $stiefouders .= "</div>";
                    $stiefouders .= "<div style=\"margin-left: 50px;float:left;\">";
                        $stiefouders .= "<u>Partner papa</u><br>";
                        $stiefouders .= $leerling['partnerpapa_naam'] != "" || $leerling['partnerpapa_voornaam'] != "" ? $leerling['partnerpapa_naam'] . " " . $leerling['partnerpapa_voornaam'] . "<br>" : "";
                        $stiefouders .= $leerling['partnerpapa_gsm'] != "" ? $leerling['partnerpapa_gsm'] . "<br>" : "";
                        $stiefouders .= $leerling['partnerpapa_email'] != "" ? $leerling['partnerpapa_email'] . "<br>" : "";
                    $stiefouders .= "</div>";
                    
                }


                $html = <<<HTML
        
        <div style="float:right;">
            <a href="/panel/inschrijvingen/edit/{$leerling['stroom']}/{$inschrijving_id}" class="btnMedium">Edit</a>
        </div>
        
          <div class="subtitel">Inschrijving {$leerling['naam']} {$leerling['voornaam']}</div>
          
          <ul class="opties">
            <li><div class="pointer"></div><a href="#persoonlijke_gegevens">Persoonlijke gegevens kind</a></li>
            <li><div class="pointer"></div><a href="#moeder">Pesoonlijke gegevens moeder</a></li>
            <li><div class="pointer"></div><a href="#vader">Pesoonlijke gegevens vader</a></li>
            <li><div class="pointer"></div><a href="#studiekeuze">Studiekeuze</a></li>
            <li><div class="pointer"></div><a href="#vip">VIP</a></li>
            <!--<li><div class="pointer"></div><a href="#gok">GOK</a></li>-->
          </ul>
          
           
          <h3 id="persoonlijke_gegevens">Persoonlijke gegevens kind</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">    
            $volgnummers
            <tr><th class="left">Naam</th><td class="right">{$leerling['naam']} {$leerling['voornaam']}</td></tr>
            <tr><th class="left">Geslacht</th><td class="right">{$leerling['geslacht']}</td></tr>
            <tr><th class="left">Rijksregisternummer</th><td class="right">{$leerling['belgisch_rijksregisternummer_of_bisnummer']}</td></tr>
            <tr><th class="left">Nationaliteit</th><td class="right">{$leerling['nationaliteit']}</td></tr>
            <tr><th class="left">Geboortedatum</th><td class="right">{$leerling['geboortedatum']}</td></tr>
            <tr><th class="left">Geboorteplaats</th><td class="right">{$leerling['geboorteplaats']}</td></tr>
            <tr><th class="left">Adres</th><td class="right">{$leerling['straat']} {$leerling['huisnummer']} {$leerling['busnummer']}, {$leerling['postcode']} {$leerling['plaats']}</td></tr>            
            <tr><th class="left">Telefoon</th><td class="right">{$leerling['tel']}</td></tr>
            <tr><th class="left">Email</th><td class="right">{$leerling['email']}</td></tr>
            <tr><th class="left">Noodnummer</th><td class="right">{$leerling['tel_noodnummer']}</td></tr>            
            <tr><th class="left">Lagere school</th><td class="right">{$leerling['school_vorig_schooljaar']}</td></tr>
            <tr><th class="left">Dubbele post</th><td class="right">{$leerling['dubbele_afdruk']}</td></tr>
            <tr><th class="left">Digitale communicatie moeder</th><td class="right">{$leerling['digitale_communicatie_moeder']}</td></tr>
            <tr><th class="left">Digitale communicatie vader</th><td class="right">{$leerling['digitale_communicatie_vader']}</td></tr>            
            <tr><th class="left">Deelt neem aan BaSO-werking</th><td class="right">{$toestemming_baso}</td></tr>
          </table>
          
          <h3 id="moeder">Persoonlijke gegevens moeder</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">
            <tr><th class="left">Naam</th><td class="right">{$leerling['moeder_naam']} {$leerling['moeder_voornaam']}</td></tr>
            <tr><th class="left">Adres</th><td class="right">{$leerling['moeder_straat']} {$leerling['moeder_huisnummer']} {$leerling['moeder_busnummer']}, {$leerling['moeder_postcode']} {$leerling['moeder_plaats']}</td></tr>
            <tr><th class="left">GSM</th><td class="right">{$leerling['moeder_gsm']}</td></tr>            
            <tr><th class="left">Email</th><td class="right">{$leerling['moeder_email']}</td></tr>
          </table>

          <h3 id="vader">Persoonlijke gegevens vader</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">
            <tr><th class="left">Naam</th><td class="right">{$leerling['vader_naam']} {$leerling['vader_voornaam']}</td></tr>
            <tr><th class="left">Adres</th><td class="right">{$leerling['vader_straat']} {$leerling['vader_huisnummer']} {$leerling['vader_busnummer']}, {$leerling['vader_postcode']} {$leerling['vader_plaats']}</td></tr>            
            <tr><th class="left">GSM</th><td class="right">{$leerling['vader_gsm']}</td></tr>            
            <tr><th class="left">Email</th><td class="right">{$leerling['vader_email']}</td></tr>            
          </table>


          <h3 id="studiekeuze">Studiekeuze</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">
            $trs_studiekeuze_stroomA            
            $trs_studiekeuze_stroomB            
          </table>


          <h3 id="vip">VIP</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">
            <tr><th class="left">Tijdens middag pauze</th><td class="right">{$leerling['middag']}</td></tr>            
            <tr><th class="left">Wordt de leerling door beide ouders opgevoed?</th><td class="right">{$leerling['door_beide_ouders_opgevoed']}</td></tr>
            <tr><th class="left">Zo nee: </th><td class="right">{$leerling['opgevoed_door_andere']}</td></tr>
            <tr><th class="left">Heeft stiefouders:</th><td class="right">{$leerling['stiefouders']}</td></tr>            
            <tr><th class="left">Zoja:</th><td class="right">$stiefouders</td></tr>            
            <tr><th class="left">Zo nee: Opgevoed door</th><td class="right">{$leerling['opgevoed_door_naam']}</td></tr>
            <tr><th class="left">Zo nee: Andere nuttige info</th><td class="right">{$leerling['andere_info']}</td></tr>
            <tr><th class="left">Thuistaal uitsluitend nederlands?</th><td class="right">$thuistaal</td></tr>
            <tr><th class="left">Jaren gedubbeld?</th><td class="right">{$leerling['heeft_jaar_moeten_overdoen']} {$leerling['jaar_overdoen_welke']}</td></tr>
            <tr><th class="left">Herneemt leerling het eerste jaar?</th><td class="right">{$leerling['herneemt_eerste_jaar']}</td></tr>
            <tr><th class="left">Zoja, welke school?</th><td class="right">{$leerling['herneemt_eerste_jaar_school_naam']}<br>{$leerling['herneemt_eerste_jaar_school_postcode']} {$leerling['herneemt_eerste_jaar_school_gemeente']}</td></tr>
            <tr><th class="left">Heeft de leerling leerproblemen?</th><td class="right">{$leerling['leerproblemen']} {$leerling['leerproblemen_extra']}</td></tr>
            <tr><th class="left">Heeft de leerling gezondheidsproblemen?</th><td class="right">{$leerling['gezondheidsproblemen']} {$leerling['gezondheidsproblemen_extra']}</td></tr>
            <tr><th class="left">Heeft de leerling gedragsproblemen?</th><td class="right">{$leerling['gedragsproblemen']} {$leerling['gedragsproblemen_extra']}</td></tr>
          </table>

          
          <!--
          <h3 id="gok">GOK</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">
            <tr><th class="left">Spreekt met moeder meestal</th><td class="right">{$leerling['gok_moeder_edison_spreektaal']}</td></tr>
            <tr><th class="left">Spreekt met vader meestal</th><td class="right">{$leerling['gok_vader_edison_spreektaal']}</td></tr>
            <tr><th class="left">Spreekt met broers of zussen meestal</th><td class="right">{$leerling['gok_broer_zus_edison_spreektaal']}</td></tr>
            <tr><th class="left">Spreekt met vrienden meestal</th><td class="right">{$leerling['gok_vrienden_edison_spreektaal']}</td></tr>          
            <tr><th class="left">Hoogst behaalde onderwijsdiploma of -getuigschrift moeder</th><td class="right">{$leerling['gok_edison_opleidingsniveau_moeder']}</td></tr>
          </table>
          -->
          
          
          
          
          
      
           
        
HTML;




            }

            return $html;



        }

        static function edit_inschrijving($inschrijving_id){

            $query = "SELECT i.*, l.*, a.*, m.*, b.*, v.*, p.* FROM inschrijving i
            LEFT JOIN leerlingen l ON i.id_leerling = l.id_leerling                
            LEFT JOIN loopbaan b ON i.id_leerling = b.leerling_id
            LEFT JOIN moeder m ON i.id_leerling = m.id_leerling
            LEFT JOIN vader v ON i.id_leerling = v.id_leerling
            LEFT JOIN vip p ON i.id_leerling = p.id_leerling
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
                        $afspraak_titel = "Afspraak (A Stroom) op";
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

                
                $adres_middag = $leerling['straat'] != "" ? $leerling['straat'] . " " . $leerling['huisnummer'] . " " . $leerling['busnummer'] . ", " . $leerling['postcode'] . " " . $leerling['plaats'] : $leerling['middag_straat'] . " " . $leerling['middag_huisnummer'] . " " . $leerling['middag_busnummer'] . ", " . $leerling['middag_postcode'] . " " . $leerling['middag_plaats'];
                $middag = substr($leerling['middag'],0,4) == "naar" ? "komt leerling naar huis. Adres: " . $adres_middag : "blijft leerling op school om zijn/haar lunch te gebruiken in de leerlingenrefter";
                $thuistaal = $leerling['thuistaal'] == "Ja" ? "Ja" : "Nee: " . $leerling['thuistaal'];



                $geslachtM_selected = $leerling['geslacht'] == "Man" ? " selected=\"selected\"" : "";
                $geslachtV_selected = $leerling['geslacht'] == "Vrouw" ? " selected=\"selected\"" : "";

                $dubbele_afdrukJa_selected = $leerling['dubbele_afdruk'] == "Ja" ? "selected=\"selected\"" : "";
                $dubbele_afdrukNee_selected = $leerling['dubbele_afdruk'] == "Nee" ? "selected=\"selected\"" : "";

                $toestemmingbasoJa_selected = $leerling['toestemming_baso_werking'] == "YES" ? "selected=\"selected\"" : "";
                $toestemmingbasoNee_selected = $leerling['toestemming_baso_werking'] == "NO" ? "selected=\"selected\"" : "";    


                $digitale_communicatie_moeder_post_selected = $leerling['digitale_communicatie_moeder'] == "post" ? " selected" : ""; 
                $digitale_communicatie_moeder_email_selected = $leerling['digitale_communicatie_moeder'] == "email" ? " selected" : ""; 
                
                $digitale_communicatie_vader_post_selected = $leerling['digitale_communicatie_vader'] == "post" ? " selected" : ""; 
                $digitale_communicatie_vader_email_selected = $leerling['digitale_communicatie_vader'] == "email" ? " selected" : ""; 
                
                
                $stiefouders = "";
                if($leerling['stiefouders'] == "Ja"){
                    $stiefouders = "<div style=\"float:left;\">";
                        $stiefouders .= "<u>Partner mama</u><br>";
                        $stiefouders .= $leerling['partnermama_naam'] != "" || $leerling['partnermama_voornaam'] != "" ? $leerling['partnermama_naam'] . " " . $leerling['partnermama_voornaam'] . "<br>" : "";
                        $stiefouders .= $leerling['partnermama_gsm'] != "" ? $leerling['partnermama_gsm'] . "<br>" : "";
                        $stiefouders .= $leerling['partnermama_email'] != "" ? $leerling['partnermama_email'] : "";
                    $stiefouders .= "</div>";
                    $stiefouders .= "<div style=\"margin-left: 50px;float:left;\">";
                        $stiefouders .= "<u>Partner papa</u><br>";
                        $stiefouders .= $leerling['partnerpapa_naam'] != "" || $leerling['partnerpapa_voornaam'] != "" ? $leerling['partnerpapa_naam'] . " " . $leerling['partnerpapa_voornaam'] . "<br>" : "";
                        $stiefouders .= $leerling['partnerpapa_gsm'] != "" ? $leerling['partnerpapa_gsm'] . "<br>" : "";
                        $stiefouders .= $leerling['partnerpapa_email'] != "" ? $leerling['partnerpapa_email'] . "<br>" : "";
                    $stiefouders .= "</div>";
                    
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
            <li><div class="pointer"></div><a href="#moeder">Pesoonlijke gegevens moeder</a></li>
            <li><div class="pointer"></div><a href="#vader">Pesoonlijke gegevens vader</a></li>
            <li><div class="pointer"></div><a href="#studiekeuze">Studiekeuze</a></li>
            <li><div class="pointer"></div><a href="#vip">VIP</a></li>
            <!--<li><div class="pointer"></div><a href="#gok">GOK</a></li>-->
          </ul>
                    
          <form action="/panel/inschrijvingen/show/{$_GET['param1']}/{$_GET['param2']}" method="post"> 
          <input type="hidden" name="action" value="update_inschrijving">
          <input type="hidden" name="id_leerling" value="{$leerling['id_leerling']}">
          <input type="hidden" name="huidigschooljaar" value="{$leerling['huidigschooljaar']}">
          <h3 id="persoonlijke_gegevens">Persoonlijke gegevens kind</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">    
            $volgnummers
            <tr><th class="left">Naam <div class="small">(achternaam - voornaam)</div></th><td class="right"><input type="text" name="naam" value="{$leerling['naam']}" style="width: 277px;"> <input type="text" name="voornaam" value="{$leerling['voornaam']}" style="width: 278px;"></td></tr>
            <tr><th class="left">Geslacht</th><td class="right"><select name="geslacht"><option value="Man" $geslachtM_selected>Man</option><option value="Vrouw" $geslachtV_selected>Vrouw</option></select></td></tr>
            <tr><th class="left">Rijksregisternummer</th><td class="right"><input type="text" name="belgisch_rijksregisternummer_of_bisnummer" value="{$leerling['belgisch_rijksregisternummer_of_bisnummer']}"></td></tr>
            <tr><th class="left">Nationaliteit</th><td class="right"><input type="text" name="nationaliteit" value="{$leerling['nationaliteit']}"></td></tr>
            <tr><th class="left">Geboortedatum</th><td class="right"><input type="text" name = "geboortedatum" class="datepicker" value="{$leerling['geboortedatum']}"></td></tr>
            <tr><th class="left">Geboorteplaats</th><td class="right"><input type="text" name="geboorteplaats" value="{$leerling['geboorteplaats']}"></td></tr>
            <tr><th class="left">Adres <div class="small">(straat, huisnr, busnr)<br>(postcode,gemeente)</div></th><td class="right"><input type="text" name="straat" value="{$leerling['straat']}" style="width: 478px;"> <input type="text" name="huisnummer" value="{$leerling['huisnummer']}" style="width:30px;"> <input type="text" name="busnummer" value="{$leerling['busnummer']}" style="width:30px;"><br><br> <input type="text" name="postcode" id="edit_inschr_postcode" value="{$leerling['postcode']}" style="width: 100px;">  <input type="text" name="plaats" id="edit_inschr_plaats" value="{$leerling['plaats']}" style="width: 455px;"></td></tr>            
            <tr><th class="left">Telefoon</th><td class="right"><input type="text" name="tel" value="{$leerling['tel']}"></td></tr>
            <tr><th class="left">Email</th><td class="right"><input type="text" name="email" value="{$leerling['email']}"></td></tr>
            <tr><th class="left">Tel Noodnummer</th><td class="right"><input type="text" name="tel" value="{$leerling['tel_noodnummer']}"></td></tr>
            <tr><th class="left">Lagere school</th><td class="right"><div style="float:left;" id="kind_vorige_school">{$leerling['school_vorig_schooljaar']}</div><input type="hidden" id="kind_vorige_school_input" name="school_vorig_schooljaar" value="{$leerling['school_vorig_schooljaar']}"><input type="hidden" id="vorige_school_id" name="school_id" value="{$leerling['school_id']}"><div style="float:left;text-decoration:underline;color:#b3df79;cursor:pointer;margin-left: 10px;" id="edit_inschr_search_lagere_school">Wijzig</div></td></tr>
            <tr><th class="left">Dubbele post</th><td class="right"><select name="dubbele_afdruk"><option value="Ja" $dubbele_afdrukJa_selected>Ja</option><option value="Nee" $dubbele_afdrukNee_selected>Nee</option></select></td></tr>
            <tr><th class="left">Digitale communicatie moeder</th><td class="right"><select name="digitale_communicatie_moeder"><option value=""></option><option value="email" $digitale_communicatie_moeder_email_selected>Email</option><option value="post" $digitale_communicatie_moeder_post_selected>Post</option></select></td></tr>
            <tr><th class="left">Digitale communicatie vader</th><td class="right"><select name="digitale_communicatie_vader"><option value=""></option><option value="email" $digitale_communicatie_vader_email_selected>Email</option><option value="post" $digitale_communicatie_vader_post_selected>Post</option></select></td></tr>
            <tr><th class="left">Deelt neem aan BaSO-werking</th><td class="right"><select name="toestemming_baso_werking"><option value="YES" $toestemmingbasoJa_selected">Ja</option><option value="NO" $toestemmingbasoNee_selected>Nee</option></select> </td></tr>
          </table>
          
          <h3 id="moeder">Persoonlijke gegevens moeder</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">
            <tr><th class="left">Naam <div class="small">(naam, voornaam)</div></th><td class="right"><input type="text" name="moeder_naam" value="{$leerling['moeder_naam']}" style="width:277px;"> <input type="text" name="moeder_voornaam" value="{$leerling['moeder_voornaam']}" style="width:278px;"></td></tr>
            <tr><th class="left">Adres <div class="small">(straat, huisnr, busnr) <br> (postcode, gemeente)</div></th><td class="right"><input type="text" name="moeder_straat" value="{$leerling['moeder_straat']}" style="width: 478px;"> <input type="text" name="moeder_huisnummer" value="{$leerling['moeder_huisnummer']}" style="width:30px;"> <input type="text" name="moeder_busnummer" value="{$leerling['moeder_busnummer']}" style="width:30px;"><br><br> <input type="text" name="moeder_postcode" id="edit_inschr_moeder_postcode" value="{$leerling['moeder_postcode']}" style="width: 100px;">  <input type="text" name="moeder_plaats" id="edit_inschr_moeder_plaats" value="{$leerling['moeder_plaats']}" style="width: 455px;"></td></tr>            
            <tr><th class="left">GSM</th><td class="right"><input type="text" name="moeder_gsm" value="{$leerling['moeder_gsm']}"></td></tr>            
            <tr><th class="left">Email</th><td class="right"><input type="text" name="moeder_email" value="{$leerling['moeder_email']}"></td></tr>
          </table>

          <h3 id="vader">Persoonlijke gegevens vader</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">
            <tr><th class="left">Naam <div class="small">(naam, voornaam)</div></th><td class="right"><input type="text" name="vader_naam" value="{$leerling['vader_naam']}" style="width:277px;"> <input type="text" name="vader_voornaam" value="{$leerling['vader_voornaam']}" style="width: 278px;"></td></tr>
            <tr><th class="left">Adres <div class="small">(straat, huisnr, busnr) <br> (postcode, gemeente)</div></th><td class="right"><input type="text" name="vader_straat" value="{$leerling['vader_straat']}" style="width: 478px;"> <input type="text" name="vader_huisnummer" value="{$leerling['vader_huisnummer']}" style="width:30px;"> <input type="text" name="vader_busnummer" value="{$leerling['vader_busnummer']}" style="width:30px;"><br><br> <input type="text" name="vader_postcode" id="edit_inschr_vader_postcode" value="{$leerling['vader_postcode']}" style="width: 100px;">  <input type="text" name="vader_plaats" id="edit_inschr_vader_plaats" value="{$leerling['vader_plaats']}" style="width: 455px;"></td></tr>
            <tr><th class="left">GSM</th><td class="right"><input type="text" name="vader_gsm" value="{$leerling['vader_gsm']}"></td></tr>            
            <tr><th class="left">Email</th><td class="right"><input type="text" name="vader_email" value="{$leerling['vader_email']}"></td></tr>            
          </table>


          <h3 id="studiekeuze">Studiekeuze</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">        
            $trs_studiekeuze_stroomA
            $trs_studiekeuze_stroomB
          </table>


          <h3 id="vip">VIP</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">
            <tr><th class="left">Tijdens middag pauze</th><td class="right">{$leerling['middag']}</td></tr>            
            <tr><th class="left">Wordt de leerling door beide ouders opgevoed?</th><td class="right">{$leerling['door_beide_ouders_opgevoed']}</td></tr>            
            <tr><th class="left">Zo nee: </th><td class="right">{$leerling['opgevoed_door_andere']}</td></tr>
            <tr><th class="left">Heeft stiefouders?</th><td class="right">{$leerling['stiefouders']}</td></tr>
            <tr><th class="left">Zoja:</th><td class="right">{$stiefouders}</td></tr>
            <tr><th class="left">Zo nee: Opgevoed door</th><td class="right">{$leerling['opgevoed_door_naam']}</td></tr>
            <tr><th class="left">Zo nee: Andere nuttige info</th><td class="right">{$leerling['andere_info']}</td></tr>
            <tr><th class="left">Thuistaal uitsluitend nederlands?</th><td class="right">$thuistaal</td></tr>
            <tr><th class="left">Jaren gedubbeld?</th><td class="right">{$leerling['heeft_jaar_moeten_overdoen']} {$leerling['jaar_overdoen_welke']}</td></tr>
            <tr><th class="left">Herneemt leerling het eerste jaar?</th><td class="right">{$leerling['herneemt_eerste_jaar']}</td></tr>
            <tr><th class="left">Zoja, welke school?</th><td class="right">{$leerling['herneemt_eerste_jaar_school_naam']}<br>{$leerling['herneemt_eerste_jaar_school_postcode']} {$leerling['herneemt_eerste_jaar_school_gemeente']}</td></tr>            
            <tr><th class="left">Heeft de leerling leerproblemen?</th><td class="right">{$leerling['leerproblemen']} {$leerling['leerproblemen_extra']}</td></tr>
            <tr><th class="left">Heeft de leerling gezondheidsproblemen?</th><td class="right">{$leerling['gezondheidsproblemen']} {$leerling['gezondheidsproblemen_extra']}</td></tr>
            <tr><th class="left">Heeft de leerling gedragsproblemen?</th><td class="right">{$leerling['gedragsproblemen']} {$leerling['gedragsproblemen_extra']}</td></tr>
          </table>


          <!--
          <h3 id="gok">GOK</h3>
          <table class="formulier" cellspacing="2" cellpadding="0">
            <tr><th class="left">Spreekt met moeder meestal</th><td class="right">{$leerling['gok_moeder_edison_spreektaal']}</td></tr>
            <tr><th class="left">Spreekt met vader meestal</th><td class="right">{$leerling['gok_vader_edison_spreektaal']}</td></tr>
            <tr><th class="left">Spreekt met broers of zussen meestal</th><td class="right">{$leerling['gok_broer_zus_edison_spreektaal']}</td></tr>
            <tr><th class="left">Spreekt met vrienden meestal</th><td class="right">{$leerling['gok_vrienden_edison_spreektaal']}</td></tr>          
            <tr><th class="left">Hoogst behaalde onderwijsdiploma of -getuigschrift moeder</th><td class="right">{$leerling['gok_edison_opleidingsniveau_moeder']}</td></tr>
          </table>
          -->          
          
          
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

        static function update_inschrijving($data){

            foreach($data as $key => $value){
                if(!is_array($value)){
                    $data[$key] = mysql_real_escape_string($value);
                }
            }

            $niet_automatisch = array("action","id_leerling");

            $leerlingen = array("naam","voornaam","geslacht","belgisch_rijksregisternummer_of_bisnummer","nationaliteit","geboortedatum","geboorteplaats","straat","huisnummer","busnummer","postcode","plaats","tel","email","school_vorig_schooljaar","school_id");
            $loopbaan = array("dubbele_afdruk","toestemming_baso_werking","digitale_communicatie_moeder","digitale_communicatie_vader");
            $moeder = array("moeder_naam","moeder_voornaam","moeder_straat","moeder_huisnummer","moeder_busnummer","moeder_postcode","moeder_plaats","moeder_gsm","moeder_tel","moeder_email");
            $vader = array("vader_naam","vader_voornaam","vader_straat","vader_huisnummer","vader_busnummer","vader_postcode","vader_plaats","vader_gsm","vader_tel","vader_email");


            $queryLeerlingen = "UPDATE leerlingen SET ";
            foreach($data as $key => $value){
                if(in_array($key,$leerlingen)){
                    if($key == "geboortedatum"){
                        $value = date("Y/m/d", strtotime($value));
                    }
                    $queryLeerlingen .= " `$key` = '$value', ";
                }          
            }
            $queryLeerlingen = substr($queryLeerlingen,0,-2) . " WHERE id_leerling = '{$data['id_leerling']}'";

            $queryLoopbaan = "UPDATE loopbaan SET ";
            foreach($data as $key => $value){
                if(in_array($key,$loopbaan)){
                    $queryLoopbaan .= " `$key` = '$value', ";
                }          
            }
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

            $queryLoopbaan = substr($queryLoopbaan,0,-2) . ", keuzevakken = '{$keuzevakken}', studiekeuze = '{$studiekeuze}', inschrijving_opmerking = '{$inschrijving_opmerking}' WHERE leerling_id = '{$data['id_leerling']}'";

            $queryMoeder = "UPDATE moeder SET ";
            foreach($data as $key => $value){
                if(in_array($key,$moeder)){
                    $queryMoeder .= " `$key` = '$value', ";
                }          
            }
            $queryMoeder = substr($queryMoeder,0,-2) . " WHERE id_leerling = '{$data['id_leerling']}'";


            $queryVader = "UPDATE vader SET ";
            foreach($data as $key => $value){
                if(in_array($key,$vader)){
                    $queryVader.= " `$key` = '$value', ";
                }          
            }
            $queryVader = substr($queryVader,0,-2) . " WHERE id_leerling = '{$data['id_leerling']}'";

            query($queryLeerlingen);
            query($queryLoopbaan);
            query($queryMoeder);
            query($queryVader);



            return "<div class=\"succes\">Leerling is succesvol gewijzigd</div>";

        }

        static function delete_inschrijving($inschrijving_id){

            $query = "SELECT id_leerling FROM inschrijving WHERE id_inschrijving = '{$inschrijving_id}'";
            $result = query($query);
            while($row = mysql_fetch_assoc($result)){
                $id_leerling = $row['id_leerling'];
            }

            $query = "DELETE FROM inschrijving WHERE id_inschrijving = '{$inschrijving_id}'";
            query($query);

            $query = "UPDATE leerlingen SET deleted = '1' WHERE id_leerling = '{$id_leerling}'";
            query($query);

            /*      

            $query = "DELETE FROM inschrijving WHERE id_leerling = '{$id_leerling}'";
            query($query);

            $query = "DELETE FROM communicatie WHERE id_leerling = '{$id_leerling}'";
            query($query);

            $query = "DELETE FROM leerlingen WHERE id_leerling = '{$id_leerling}'";
            query($query);

            $query = "DELETE FROM afspraken WHERE id_leerling = '{$id_leerling}'";
            query($query);

            $query = "DELETE FROM loopbaan WHERE leerling_id = '{$id_leerling}'";
            query($query);

            $query = "DELETE FROM vip WHERE id_leerling = '{$id_leerling}'";
            query($query);

            $query = "DELETE FROM vader WHERE id_leerling = '{$id_leerling}'";
            query($query);

            $query = "DELETE FROM moeder WHERE id_leerling = '{$id_leerling}'";
            query($query);
            */

            Notification::set("success","Inschrijving is succesvol verwijderd");       

        }




    }
?>
