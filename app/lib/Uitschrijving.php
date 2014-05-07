<?php
    Class Uitschrijving{

        static function menu(){

            $aantaluitschrijvingenA = self::get_aantal_uitschrijvingen("A");
            $aantaluitschrijvingenB = self::get_aantal_uitschrijvingen("B");

            $html = <<<HTML
                <div class="subtitel">Wat wil u doen?</div>

                <ul class="opties">
                    <li><a href="/panel/uitschrijvingen/show_all/A">Bekijk uitschrijvingen Stroom A <strong>({$aantaluitschrijvingenA})</strong></a></li>
                    <li><a href="/panel/uitschrijvingen/show_all/B">Bekijk uitschrijvingen Stroom B <strong>({$aantaluitschrijvingenB})</strong></a></li>
                </ul>    
HTML;
            return $html; 
        }


        static function show_uitschrijvingen(){

            $query = "SELECT * FROM leerlingen WHERE deleted = 1 ORDER BY naam";    
            $result = query($query);                        
                        

            $html = "<div class=\"subtitel\">Uitschrijvingen (" . mysql_num_rows($result) . " resultaten gevonden)</div>";

            $html .= "<table class=\"opties\" cellpadding=\"2\"><tr><th class=\"top\">Naam</th></th></tr>";

            while($row = mysql_fetch_assoc($result)){


                $naam = $row['voornaam'] != "" || $row['naam'] != "" ? $row['voornaam'] . " " . $row['naam'] : "<i>geen naam</i>";
                
                $html .= "<tr>";
                $html .= "<th class=\"left\"><a href=\"/panel/uitschrijvingen/show/{$row['id_leerling']}\">$naam</a></th>";                
                $html .= "</tr>";


            }


            $html .= "</table>";

            return $html;
        }

        static function show_uitschrijving($leerling_id){

            $query = "SELECT l.*, a.*, m.*, b.*, v.*, p.* FROM leerlingen l            
            LEFT JOIN loopbaan b ON l.id_leerling = b.leerling_id
            LEFT JOIN moeder m ON l.id_leerling = m.id_leerling
            LEFT JOIN vader v ON l.id_leerling = v.id_leerling
            LEFT JOIN vip p ON l.id_leerling = p.id_leerling
            LEFT JOIN afspraken a ON l.id_leerling = a.id_leerling
            WHERE l.id_leerling= '{$leerling_id}'              
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
                        if($order == "aalgemeen" || $order == "aklassiek" || $order == "nb") continue;
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



    }
?>
