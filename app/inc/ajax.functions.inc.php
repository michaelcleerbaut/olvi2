<?php
    function get_cities($postcode = ""){
    
        $query = "SELECT Naam, Postcode FROM postcodes WHERE postcode LIKE '{$postcode}%' OR Naam LIKE '%{$postcode}%' ORDER BY Postcode";
        $result = query($query);
        $query = $postcode;
        
        
        while ($row = mysql_fetch_assoc($result)) {
            $suggestions .= "'{$row['Postcode']} - {$row['Naam']}',";
            $data .= "'{$row['Postcode']} - {$row['Naam']}',";
        }

        $html = "{
                query:'$query',
                suggestions:[$suggestions''],
                data:[$data'']
            }
        ";
        
        return $html;
  
    }
    
    function save_idleerling_session($id_leerling){
        $_SESSION['id_leerling'] = $id_leerling;
        echo $_SESSION['id_leerling'];
    }
  
    function search_kind_via_naam($naamsuggest = "",$stroom = "YES"){
        
        $stroomQuery = $stroom == "YES" ? " AND i.stroom = '{$_SESSION['stroom']}' " : "";
        
        $query  = "SELECT l.id_leerling, l.naam, l.voornaam, i.* FROM leerlingen l
                    LEFT JOIN inschrijving i ON i.id_leerling = l.id_leerling 
                     WHERE (l.naam LIKE '%{$naamsuggest}%' OR l.voornaam LIKE '%{$naamsuggest}%') $stroomQuery ORDER BY l.naam";
        
        $result = query($query);
        $query = $naamsuggest;
                    
        while ($row = mysql_fetch_assoc($result)) {

            $suggestions .= "'{$row['voornaam']} {$row['naam']}',";
            $data .= "'{$row['id_leerling']}',";
        }

        $html = "{
                query:'$query',
                suggestions:[$suggestions''],
                data:[$data'']
            }
        ";            
                        
        return $html;
    }    

    function search_kind_via_naam_vip_leerproblemen($naamsuggest = ""){
        
        $query  = "SELECT l.id_leerling, l.naam, l.voornaam, i.*, v.leerproblemen FROM leerlingen l
                    INNER JOIN inschrijving i ON i.id_leerling = l.id_leerling 
                    INNER JOIN vip v ON i.id_leerling = v.id_leerling
                     WHERE (l.naam LIKE '%{$naamsuggest}%' OR l.voornaam LIKE '%{$naamsuggest}%') AND v.leerproblemen = 'Ja' AND l.deleted != 1 ORDER BY l.naam";
        $result = query($query);
        $query = $naamsuggest;
                    
        while ($row = mysql_fetch_assoc($result)) {

            $suggestions .= "'{$row['voornaam']} {$row['naam']}',";
            $data .= "'{$row['id_leerling']}',";
        }

        $html = "{
                query:'$query',
                suggestions:[$suggestions''],
                data:[$data'']
            }
        ";            
                        
        return $html;        
    }

    
    function search_kind_via_naam_vip_gedragsproblemen($naamsuggest = ""){
        
        $query  = "SELECT l.id_leerling, l.naam, l.voornaam, i.*, v.gedragsproblemen FROM leerlingen l
                    INNER JOIN inschrijving i ON i.id_leerling = l.id_leerling 
                    INNER JOIN vip v ON i.id_leerling = v.id_leerling
                     WHERE (l.naam LIKE '%{$naamsuggest}%' OR l.voornaam LIKE '%{$naamsuggest}%') AND v.gedragsproblemen = 'Ja' AND l.deleted != 1 ORDER BY l.naam";
        $result = query($query);
        $query = $naamsuggest;
                    
        while ($row = mysql_fetch_assoc($result)) {

            $suggestions .= "'{$row['voornaam']} {$row['naam']}',";
            $data .= "'{$row['id_leerling']}',";
        }

        $html = "{
                query:'$query',
                suggestions:[$suggestions''],
                data:[$data'']
            }
        ";            
                        
        return $html;        
    }

    
    function search_kind_via_naam_vip_andereproblemen($naamsuggest = ""){
        
        $query  = "SELECT l.id_leerling, l.naam, l.voornaam, i.* FROM leerlingen l
                    INNER JOIN inschrijving i ON i.id_leerling = l.id_leerling                     
                     WHERE (l.naam LIKE '%{$naamsuggest}%' OR l.voornaam LIKE '%{$naamsuggest}%') AND l.deleted != 1 ORDER BY l.naam";
        $result = query($query);
        $query = $naamsuggest;
                    
        while ($row = mysql_fetch_assoc($result)) {

            $suggestions .= "'{$row['voornaam']} {$row['naam']}',";
            $data .= "'{$row['id_leerling']}',";
        }

        $html = "{
                query:'$query',
                suggestions:[$suggestions''],
                data:[$data'']
            }
        ";            
                        
        return $html;        
    }
    

    function search_kind_via_naam_vip_gezondheidsproblemen($naamsuggest = ""){
        
        $query  = "SELECT l.id_leerling, l.naam, l.voornaam, i.*, v.leerproblemen FROM leerlingen l
                    INNER JOIN inschrijving i ON i.id_leerling = l.id_leerling 
                    INNER JOIN vip v ON i.id_leerling = v.id_leerling
                     WHERE (l.naam LIKE '%{$naamsuggest}%' OR l.voornaam LIKE '%{$naamsuggest}%') AND v.gezondheidsproblemen = 'Ja' AND l.deleted != 1 ORDER BY l.naam";
        $result = query($query);
        $query = $naamsuggest;
                    
        while ($row = mysql_fetch_assoc($result)) {

            $suggestions .= "'{$row['voornaam']} {$row['naam']}',";
            $data .= "'{$row['id_leerling']}',";
        }

        $html = "{
                query:'$query',
                suggestions:[$suggestions''],
                data:[$data'']
            }
        ";            
                        
        return $html;        
    }


    
    function get_kind_via_volgnummer($volgnummer, $stroom){
        
        $query = "SELECT id_leerling, id_inschrijving FROM inschrijving WHERE volgnummer = '{$volgnummer}' AND stroom = '{$stroom}'";
        $result = query($query);
        if(mysql_num_rows($result) == 0){
            return "0";
        } else{
            while($row = mysql_fetch_assoc($result)){
                $_SESSION['id_leerling'] = $row['id_leerling'];   
                $_SESSION['id_inschrijving'] = $row['id_inschrijving'];
                
                $query = "SELECT definschrijving, id_inschrijving FROM inschrijving WHERE id_inschrijving = '{$row['id_inschrijving']}'";
                $result = query($query);
                $row = mysql_fetch_assoc($result);
                if($row['definschrijving'] == 0){            
                    $query = "UPDATE inschrijving SET `definschrijving` = '1', `def_ingeschreven_door` = '{$_SESSION['gebruiker']['id']}' WHERE id_inschrijving = '{$row['id_inschrijving']}'";                            
                    query($query);
                }
            }
            return $_SESSION['id_leerling'];
        }                
    }


    function get_kind_via_idleerling($idleerling, $stroom){
        
        $query = "SELECT id_leerling, id_inschrijving FROM inschrijving WHERE id_leerling = '{$idleerling}' AND stroom = '{$stroom}'";
        $result = query($query);
        if(mysql_num_rows($result) == 0){
            return "0";
        } else{
            while($row = mysql_fetch_assoc($result)){
                $_SESSION['id_leerling'] = $row['id_leerling'];   
                $_SESSION['id_inschrijving'] = $row['id_inschrijving'];

                $query = "SELECT definschrijving FROM inschrijving WHERE id_inschrijving = '{$row['id_inschrijving']}'";
                $result = query($query);
                $row = mysql_fetch_assoc($result);
                if($row['definschrijving'] == 0){                            
                    $query = "UPDATE inschrijving SET `definschrijving` = '1', `def_ingeschreven_door` = '{$_SESSION['gebruiker']['id']}' WHERE id_inschrijving = '{$row['id_inschrijving']}'";                
                    query($query);
                }
            }
            return $_SESSION['id_leerling'];
        }                
    }

    
    function get_kind_via_volgnummer_leerproblemen($volgnummer,$stroom){
        
        $query = "SELECT i.id_leerling FROM inschrijving i INNER JOIN vip v ON i.id_leerling = v.id_leerling WHERE v.leerproblemen = 'Ja' AND i.volgnummer = '{$volgnummer}' AND i.stroom = '{$stroom}'";
        $result = query($query);
        if(mysql_num_rows($result) == 0){
            return "0";
        } else{
            while($row = mysql_fetch_assoc($result)){
                $_SESSION['id_leerling'] = $row['id_leerling'];                   
            }
            return $_SESSION['id_leerling'];
        }                
        
    }

    function get_kind_via_volgnummer_gedragsproblemen($volgnummer,$stroom){
        
        $query = "SELECT i.id_leerling FROM inschrijving i INNER JOIN vip v ON i.id_leerling = v.id_leerling WHERE v.gedragsproblemen = 'Ja' AND i.volgnummer = '{$volgnummer}' AND i.stroom = '{$stroom}'";
        $result = query($query);
        if(mysql_num_rows($result) == 0){
            return "0";
        } else{
            while($row = mysql_fetch_assoc($result)){
                $_SESSION['id_leerling'] = $row['id_leerling'];                   
            }
            return $_SESSION['id_leerling'];
        }                
        
    }
    
    function get_kind_via_volgnummer_andereproblemen($volgnummer, $stroom){
        
        $query = "SELECT id_leerling FROM inschrijving WHERE volgnummer = '{$volgnummer}' AND stroom = '{$stroom}'";
        $result = query($query);
        if(mysql_num_rows($result) == 0){
            return "0";
        } else{
            while($row = mysql_fetch_assoc($result)){
                $_SESSION['id_leerling'] = $row['id_leerling'];                   
            }
            return $_SESSION['id_leerling'];
        }                
        
    }

    function get_kind_via_volgnummer_gezondheidsproblemen($volgnummer,$stroom){
        
        $query = "SELECT i.id_leerling FROM inschrijving i INNER JOIN vip v ON i.id_leerling = v.id_leerling WHERE v.gezondheidsproblemen = 'Ja' AND i.volgnummer = '{$volgnummer}' AND i.stroom = '{$stroom}'";
        $result = query($query);
        if(mysql_num_rows($result) == 0){
            return "0";
        } else{
            while($row = mysql_fetch_assoc($result)){
                $_SESSION['id_leerling'] = $row['id_leerling'];                   
            }
            return $_SESSION['id_leerling'];
        }                
        
    }

    
    function check_volgnummer_exists_b($volgnummer){
        //return 0;
        
        if(isset($_SESSION['volgnummer_b'])){
            if($volgnummer == $_SESSION['volgnummer_b']){
                return 0;
            }
        }
        
        $return = 0;
        $query = "SELECT id_leerling FROM inschrijving WHERE volgnummer = '$volgnummer' AND stroom = 'B'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            $return = 1;
        }
        
        if($return == 0){
            
            $query = "INSERT INTO leerlingen (`naam`) VALUES ('')";
            query($query);
                        
            $_SESSION['volgnummer_b'] = $volgnummer;
            $_SESSION['id_leerling'] = mysql_insert_id();            
            
            $date = date("Y-m-d H:i");
            
            $query = "INSERT INTO inschrijving (`id_leerling`,`volgnummer`,`stroom`,`voorinschrijving`,`voor_ingeschreven_door`,`datum`) VALUES ('{$_SESSION['id_leerling']}','{$volgnummer}','B','1','{$_SESSION['gebruiker']['id']}','{$date}')";
            query($query);
            
            $_SESSION['id_inschrijving'] = mysql_insert_id();
                    
            $return = "id" . $_SESSION['id_leerling'];
        }
        
        return $return;
        
    }
    
    function save_gegevens_kind_a($fields){
        
        $data = convert_fields_to_array($fields);
                        
        $lagereschool = "";
        if($data['kind_vorigeschool_naam'] != "" && $data['kind_vorigeschool_postcode'] != "" && $data['kind_vorigeschool_gemeente'] != ""){
            $lagereschool = $data['kind_vorigeschool_gemeente'] . " " . $data['kind_vorigeschool_naam'] . " ". $data['kind_vorigeschool_postcode'] . " " . $data['kind_vorigeschool_gemeente'];
        }        
        
        if($data['studiekeuze'] != ""){
            $studiekeuze_arr['A'] = "A-Stroom: " . $data['studiekeuze'];
            $studiekeuze_arr = serialize($studiekeuze_arr);
            $query = "INSERT INTO loopbaan SET leerling_id = '{$_SESSION['id_leerling']}', studiekeuze = '{$studiekeuze_arr}'";
            query($query);
        }
        
        
        $not_automatic = array("studiekeuze","kind_vorigeschool_naam","kind_vorigeschool_postcode","kind_vorigeschool_gemeente","kind_vorigeschool_id","geslachtM","geslachtV","search_lagere_school_pg");

                                     
        $query = "UPDATE leerlingen SET ";
        foreach($data as $column => $value){
          if(!in_array($column,$not_automatic) && $column != ""){              
            $value = mysql_real_escape_string($value);
            $query .= " `$column` = '$value',";
          }          
        }      
        $query = substr($query,0,-1);
        if($lagereschool != ""){
            $lagereschool = mysql_real_escape_string($lagereschool);
            $query .=  ", `school_vorig_schooljaar` = '{$lagereschool}' ";   
        }
        if($data['kind_vorigeschool_id'] != ""){
            $query .=  ", `school_id` = '{$data['kind_vorigeschool_id']}' ";   
        }        
        $query .= " WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        
        $result = query($query);                        
        return $result;
    }
    
    
    function save_gegevens_kind_b($fields){
        
        $data = convert_fields_to_array($fields);
                        
        $lagereschool = "";
        if($data['kind_vorigeschool_naam'] != "" && $data['kind_vorigeschool_postcode'] != "" && $data['kind_vorigeschool_gemeente'] != ""){
            $lagereschool = $data['kind_vorigeschool_gemeente'] . " " . $data['kind_vorigeschool_naam'] . " ". $data['kind_vorigeschool_postcode'] . " " . $data['kind_vorigeschool_gemeente'];
        }        
        
        
        $not_automatic = array("kind_vorigeschool_naam","kind_vorigeschool_postcode","kind_vorigeschool_gemeente","kind_vorigeschool_id","geslachtM","geslachtV","search_lagere_school_pg");

                                     
        $query = "UPDATE leerlingen SET ";
        foreach($data as $column => $value){
          if(!in_array($column,$not_automatic) && $column != ""){              
            $value = mysql_real_escape_string($value);
            $query .= " `$column` = '$value',";
          }          
        }      
        $query = substr($query,0,-1);
        if($lagereschool != ""){
            $lagereschool = mysql_real_escape_string($lagereschool);
            $query .=  ", `school_vorig_schooljaar` = '{$lagereschool}' ";   
        }
        if($data['kind_vorigeschool_id'] != ""){
            $query .=  ", `school_id` = '{$data['kind_vorigeschool_id']}' ";   
        }        
        $query .= " WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        
        $result = query($query);                
        return $result;
    }

    function load_studiekeuze_inschrijving($id_leerling){
        
        $query = "SELECT studiekeuze, keuzevakken FROM loopbaan WHERE leerling_id = '{$id_leerling}'";
        $result = query($query);
        $row = mysql_fetch_assoc($result);
        $studiekeuze = is_array(unserialize($row['studiekeuze'])) ? unserialize($row['studiekeuze']) : array();
        $keuzevakken = is_array(unserialize($row['keuzevakken'])) ? unserialize($row['keuzevakken']) : array();
                
        $query = "SELECT * FROM settings WHERE name = 'huidigschooljaar'";
        $result = query($query);
        if(mysql_num_rows($result) == 0){
            $huidigschooljaar = date("m") > 7 ? date("Y") . " - " . (date("Y") + 1) : (date("Y") - 1) . " - " . date("Y");
        } else{
            while($row = mysql_fetch_assoc($result)){
                if($row['value'] == "nvp"){
                    $huidigschooljaar = date("m") > 7 ? date("Y") . " - " . (date("Y") + 1) : (date("Y") - 1) . " - " . date("Y");
                } else {
                    $huidigschooljaar = $row['value'];
                }
            }
        }            
        
    
        $query = "SELECT * FROM studiekeuzes ORDER BY studiekeuze";
        $result = query($query);
        $i = 1;    
        $tab = 2;
        while($row = mysql_fetch_assoc($result)){        
            
            if(array_key_exists($row['afkorting'],$keuzevakken)){
                $nr = $keuzevakken[$row['afkorting']];
            } else {
                $nr = "";
            }
            
            
            $tab += 1;    
            if($i == 1){
                $studiekeuzes .= "<tr><th>{$row['studiekeuze']}</th><td style=\"width:200px;\"><input type=\"text\" id=\"{$row['afkorting']}\" value=\"$nr\" style=\"width:20px;\" maxlength=\"1\" tabindex=\"$tab\"></td>";
                $i = 2;
            } else if ($i == 2){
                $studiekeuzes .= "<th>{$row['studiekeuze']}</th><td style=\"width:200px;\"><input type=\"text\" id=\"{$row['afkorting']}\" value=\"$nr\" style=\"width:20px;\" maxlength=\"1\" tabindex=\"$tab\"></td></tr>";
                $i = 1;
            }            
        }
        
        $studiekeuzes = $_SESSION['stroom'] == "A" ? $studiekeuzes : "";
        $extrastudiekeuzeinfo = $_SESSION['stroom'] == "A" ? "Interessedomein ALGEMENE VORMING<br>Keuze voor 2 x 1 lesuur + 1 reserveuur<br> (Keuzes nummeren in volgorde van voorkeur 1 tot 3!)" : "";
        
        if($_SESSION['stroom'] == "A" && array_key_exists("A",$studiekeuze)){
            $extrastudiekeuzesdisable = $studiekeuze['A'] == "A-Stroom: Algemene vorming" ? "" : " disabled";
            $keuzes = array("aklassiek" => "A-Stroom: Klassieke vorming","aalgemeen" => "A-Stroom: Algemene vorming","nb" => "Nog niet bepaald");
            $studiekeuzeopties = "";
            foreach($keuzes as $value => $omschr){
                $selected = $omschr == $studiekeuze['A'] ? " selected=\"selected\"" : "";
                $studiekeuzeopties .= "<option value=\"$value\" class=\"studie_strooma\" $selected>$omschr</option>";
            }        
        } else if($_SESSION['stroom'] == "B" && array_key_exists("B",$studiekeuze)){
                $eenbselected = $studiekeuze['B'] == "1B" ? " selected=\"selected\"" : "";
                $nbselected = $studiekeuze['B'] == "Nog niet bepaald" ? " selected=\"selected\"" : "";
                $studiekeuzeopties = <<<tt
                    <option value="1b" class="studie_stroomb" $eenbselected>1B</option>
                    <option value="nb" $nbselected>Nog niet bepaald</option>                
tt;
        } else {
            $extrastudiekeuzesdisable = " disabled";
            if($_SESSION['stroom'] == "A"){
                $studiekeuzeopties = <<<tt
                    <option value="aklassiek" class="studie_strooma">A-Stroom: Klassieke vorming</option>
                    <option value="aalgemeen" class="studie_strooma">A-Stroom: Algemene vorming</option>                    
                    <option value="nb">Nog niet bepaald</option>                
tt;
            } else {
                $studiekeuzeopties = <<<tt
                    <option value="1b" class="studie_stroomb">1B</option>
                    <option value="nb">Nog niet bepaald</option>                
tt;
            }
        }
        
        
        
        
        $return = file_get_contents("app/views/forms/inschrijving/studiekeuze.tpl");        
        
        $return = str_replace("[HUIDIGSCHOOLJAAR]",$huidigschooljaar,$return);
        $return = str_replace("[STUDIEKEUZES]",$studiekeuzes,$return);
        $return = str_replace("[STUDIEKEUZEOPTIES]",$studiekeuzeopties,$return);
        $return = str_replace("[EXTRASTUDIEKEUZESDISABLE]",$extrastudiekeuzesdisable,$return);
        $return = str_replace("[EXTRASTUDIEKEUZEINFO]",$extrastudiekeuzeinfo,$return);
        
        return $return;
        
        
    }
    
    function save_communicatie($fields){
    
        $data = convert_fields_to_array($fields);
        
        $return = 1;
        
        $query = "SELECT * FROM communicatie WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        
        $tel = str_replace(" ","",str_replace("/","",str_replace("(","",str_replace(")","",str_replace(".","",str_replace("+","",$data['communicatie_telefoon']))))));
        
        if($data['communicatie_email'] != "" || $data['communicatie_telefoon'] != ""){
            if(mysql_num_rows($result) == 0){
                $query = "INSERT INTO communicatie (`id_leerling`,`telefoon`,`email`) VALUES ('{$_SESSION['id_leerling']}','$tel','{$data['communicatie_email']}')";
            } else {
                $query = "UPDATE communicatie SET email = '{$data['communicatie_email']}', telefoon = '$tel' WHERE id_leerling = '{$_SESSION['id_leerling']}'";
            }
            $return = query($query);
        }
        
        return $return;
        
        
    }
        
    function load_gegevens($id_leerling){    
        
        $html = "";
        $query = "SELECT naam, voornaam, straat, huisnummer, busnummer, postcode, plaats, school_vorig_schooljaar FROM leerlingen WHERE id_leerling = '{$id_leerling}'";        
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){            
            
            $busnr = $row['busnummer'] != "" ? " bus {$row['busnummer']}" : "";
            
            $html .= <<<HTML
                <h3>Algemene gegevens kind</h3>
                <table class="formulier">
                    <tr><th>Naam</th><td>{$row['naam']}</td></tr>
                    <tr><th>Voornaam</th><td>{$row['voornaam']}</td></tr>
                    <tr><th>Adres</th><td>{$row['straat']} {$row['huisnummer']} $busnr</td></tr>
                    <tr><th>Plaats</th><td>{$row['postcode']} {$row['plaats']}</td></tr>
                    <tr><th>School vorig schooljaar</th><td>{$row['school_vorig_schooljaar']}</td></tr>                    
                </table>
HTML;
        
        }
        
        $tel = "";
        $email = "";
        
        $query = "SELECT email, telefoon FROM communicatie WHERE id_leerling = '{$id_leerling}'";
        dbg($query);
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            $tel = $row['telefoon'];
            $email = $row['email'];
        }
        
        $html .= <<<HTML
            <h3>Communicatie gegevens voor afspraak</h3>
            <table class="formulier">
                <tr><th>Telefoon</th><td>{$tel}</td></tr>
                <tr><th>Email</th><td>{$email}</td><tr>
            </table>       
HTML;
        
        
        return $html;
        
    }
    
    function save_ooka(){
        
        $query = "SELECT volgnummer FROM inschrijving WHERE stroom = 'A' AND id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        if(mysql_num_rows($result) > 0){
            return 0;
        }
        
        $query = "SELECT volgnummer FROM inschrijving WHERE stroom = 'A' ORDER BY volgnummer ASC";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){            
            $volgnummers[$row['volgnummer']] = "YES";            
        }
        
        $query = "SELECT volgnummer FROM inschrijving WHERE stroom = 'A' ORDER BY volgnummer DESC LIMIT 0,1";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){            
            $maxNummer = $row['volgnummer'];
        }
        
        $volgnummer_a = 0;
        $continue = 1;
        for($i=1;$i<=$maxNummer;$i++){
            if($continue == 0) continue;
            if(!array_key_exists($i,$volgnummers)){
             $volgnummer_a = $i;
             $continue = 0;
            }
        }
        
        $volgnummer_a = $volgnummer_a == 0 ? $maxNummer + 1 : $volgnummer_a; 
        
        $date = date("Y-m-d H:i");
        
        $query = "INSERT INTO inschrijving (`id_leerling`,`stroom`,`volgnummer`,`voorinschrijving`,`voor_ingeschreven_door`,`datum`) VALUES ('{$_SESSION['id_leerling']}','A','{$volgnummer_a}','1','{$_SESSION['gebruiker']['id']}','{$date}')";
        $return = query($query);
        

        $_SESSION['volgnummer_a'] = $volgnummer_a;
        
        return $return;
        
        
    }
    
    
    function delete_ooka(){
        
        $query = "DELETE FROM inschrijving WHERE id_leerling = '{$_SESSION['id_leerling']}' AND stroom = 'A'";
        $result = query($query);
        
        unset($_SESSION['volgnummer_a']);
        
        return $return;
        
    }
    
    function controle_afspraak_maken($ooka){
               
        if($_SESSION['volgnummer_b'] > 24 && $ooka == "YES"){

            $return = file_get_contents("app/views/forms/voorinschrijving/geen_afspraak_wela.tpl");
            $tel = "<i>Niets ingevuld</li>";
            $email = "<i>Niets ingevuld</li>";
            $query = "SELECT email, telefoon FROM communicatie WHERE id_leerling = '{$_SESSION['id_leerling']}'";
            $result = query($query);
            while($row = mysql_fetch_assoc($result)){
                $tel = $row['telefoon'];
                $email = $row['email'];
            }
            
            $return = str_replace("[TELEFOON]",$tel,$return);
            $return = str_replace("[EMAIL]",$email,$return);
            
            $max = array(
                "3" => array("start" => "17:00", "eind" => "20:00"),
                "4" => array("start" => "13:00", "eind" => "18:00"),
                "5" => array("start" => "9:00", "eind" => "12:00")
            );
                
            $query = "SELECT * FROM afspraken WHERE dag NOT LIKE 'tel'";
            $result = query($query);
            while($row = mysql_fetch_assoc($result)){            
                $bezet[$row['dag']][$row['uur']] += 1;                
            }
                    
            $tbl = "<div class=\"afspraak-container\">";            
            foreach($max as $dag => $arr){            
                $tbl .= "<div class=\"dag\">{$dag} Mei</div>";                
                $start = strtotime($arr['start']);
                $eind = strtotime($arr['eind']);                
                for($i = $start;$i < $eind; $i += 30 * 60){            
                    $uur = date("H:i",$i);
                    $bezette = $bezet[$dag][$uur];                    
                    $disabled = $bezette >= 10 ? "bezet" : "";                    
                    $clickable = $bezette >= 10 ? "NO" : "YES";
                    $select  = $_SESSION['afspraak_dag'] == $dag && $_SESSION['afspraak_uur'] == $uur ? "select" : "";
                    $tbl .= "<div class=\"uur $disabled $select\" clickable=\"$clickable\" dag=\"$dag\">" . $uur . "</div>";                    
                }
                $tbl .= "<div style=\"clear:both;\"></div>";                                            
            }
            $selecttel = $_SESSION['afspraak_dag'] == "tel" && $_SESSION['afspraak_uur'] == "geen" ? "select" : "";
            $tbl .= "<div class=\"telefonisch $selecttel\" id=\"telefonisch\" style=\"width: 400px;margin:auto;margin-top: 20px;\">Ik wil graag telefonisch een afspraak maken</div>";
            $tbl .= "</div>";            
            
            
            
            $return = str_replace("[AFSPRAAKTABEL]",$tbl,$return);                    
            $return = $_SESSION['afspraak_uur'] != "" && $_SESSION['afspraak_dag'] != "" ? str_replace("[AFSPRAAKDAG]",$_SESSION['afspraak_dag'],$return) : str_replace("[AFSPRAAKDAG]","",$return);
            $return = $_SESSION['afspraak_uur'] != "" && $_SESSION['afspraak_dag'] != "" ? str_replace("[AFSPRAAKUUR]",$_SESSION['afspraak_uur'],$return) : str_replace("[AFSPRAAKUUR]","",$return);
            
            
        
        } else if($_SESSION['volgnummer_b'] > 24 && $ooka == "NO"){
            $return = file_get_contents("app/views/forms/voorinschrijving/geen_afspraak.tpl");
            $tel = "<i>Niets ingevuld</li>";
            $email = "<i>Niets ingevuld</li>";
            $query = "SELECT email, telefoon FROM communicatie WHERE id_leerling = '{$_SESSION['id_leerling']}'";
            $result = query($query);
            while($row = mysql_fetch_assoc($result)){
                $tel = $row['telefoon'];
                $email = $row['email'];
            }
            
            $return = str_replace("[TELEFOON]",$tel,$return);
            $return = str_replace("[EMAIL]",$email,$return);
            
            
        } else {
            $max = array(
                "3" => array("start" => "17:00", "eind" => "20:00"),
                "4" => array("start" => "13:00", "eind" => "18:00"),
                "5" => array("start" => "9:00", "eind" => "12:00")
            );
                
            $return = file_get_contents("app/views/forms/voorinschrijving/afspraak_maken.tpl");
            
            $query = "SELECT * FROM afspraken WHERE dag NOT LIKE 'tel'";
            $result = query($query);
            while($row = mysql_fetch_assoc($result)){            
                $bezet[$row['dag']][$row['uur']] += 1;                
            }
            
            
            $tbl = "<div class=\"afspraak-container\">";            
            foreach($max as $dag => $arr){            
                $tbl .= "<div class=\"dag\">{$dag} Mei</div>";                
                $start = strtotime($arr['start']);
                $eind = strtotime($arr['eind']);                
                for($i = $start;$i < $eind; $i += 30 * 60){            
                    $uur = date("H:i",$i);
                    $bezette = $bezet[$dag][$uur];                    
                    $disabled = $bezette >= 10 ? "bezet" : "";                    
                    $clickable = $bezette >= 10 ? "NO" : "YES";                    
                    $select  = $_SESSION['afspraak_dag'] == $dag && $_SESSION['afspraak_uur'] == $uur ? "select" : "";
                    $tbl .= "<div class=\"uur $disabled $select\" clickable=\"$clickable\" dag=\"$dag\">" . $uur . "</div>";                    
                }
                $tbl .= "<div style=\"clear:both;\"></div>";                                            
            }
            $selecttel = $_SESSION['afspraak_dag'] == "tel" && $_SESSION['afspraak_uur'] == "geen" ? "select" : "";
            $selectgeen = $_SESSION['afspraak_dag'] == "broerofzus" && $_SESSION['afspraak_uur'] == "geen" ? "select" : "";
            $tbl .= "<div class=\"telefonisch $selecttel\" id=\"telefonisch\" style=\"width: 400px;margin:auto;margin-top: 20px;\">Ik wil graag telefonisch een afspraak maken</div>";
            $tbl .= "<div class=\"telefonisch $selectgeen\" id=\"reedsafspraak\" style=\"width: 400px;margin:auto;margin-top: 20px;\">Ik heb reeds een afspraak gemaakt (broer of zus)</div>";
            $tbl .= "</div>";            
            
            
            
            $return = str_replace("[AFSPRAAKTABEL]",$tbl,$return);                    
            $return = $_SESSION['afspraak_uur'] != "" && $_SESSION['afspraak_dag'] != "" ? str_replace("[AFSPRAAKDAG]",$_SESSION['afspraak_dag'],$return) : str_replace("[AFSPRAAKDAG]","",$return);
            $return = $_SESSION['afspraak_uur'] != "" && $_SESSION['afspraak_dag'] != "" ? str_replace("[AFSPRAAKUUR]",$_SESSION['afspraak_uur'],$return) : str_replace("[AFSPRAAKUUR]","",$return);
            
                            
        }
        
        return $return;
        
    }
    
    function save_afspraak_datum($dag,$uur){
        
        $query = "SELECT * FROM afspraken WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        if(mysql_num_rows($result) == 0){
            $query = "INSERT INTO afspraken (`id_leerling`,`dag`,`uur`) VALUES ('{$_SESSION['id_leerling']}','{$dag}','{$uur}')";
            query($query);
        } else {
            $query = "UPDATE afspraken SET dag = '{$dag}', uur = '{$uur}' WHERE id_leerling = '{$_SESSION['id_leerling']}'";
            query($query);
        }
        
        $_SESSION['afspraak_dag'] = $dag;
        $_SESSION['afspraak_uur'] = $uur;             
    }
    
    function eindwoord($afspraak){        
                
        if(trim($afspraak) == "NO"){
            
            $query = "SELECT stroom FROM inschrijving WHERE id_inschrijving = '{$_SESSION['id_inschrijving']}'";
            $result = query($query);
            $row = mysql_fetch_assoc($result);
            $row['stroom'] = strtolower($row['stroom']);            
            
            $return = file_get_contents("app/views/forms/voorinschrijving/eindwoord_zonderafspraak.tpl");            
            
            $text = "<input type=\"hidden\" id=\"stroom\" value=\"{$row['stroom']}\">";
            $return = str_replace("[STROOM]",$text,$return);
            $return = str_replace("[LINK]","voorinschrijving-{$row['stroom']}.php",$return);
                        
        } else {
            
            $return = file_get_contents("app/views/forms/voorinschrijving/eindwoord_metafspraak.tpl");
            
            /*
            if($_SESSION['afspraak_dag'] == "tel"){
                $text = "<strong>U heeft gekozen om telefonisch een afspraak te maken.</strong>";
            } else if($_SESSION['afspraak_dag'] == "broerofzus"){
                $text = "<strong>U heeft reeds een afspraak gemaakt (met een broer of zus)</strong>";
            } else {
                $text = "<strong>U hebt een afspraak op {$_SESSION['afspraak_dag']} Mei om {$_SESSION['afspraak_uur']} u.</strong>";            
            }
            */
            
            $query = "SELECT stroom FROM inschrijving WHERE id_inschrijving = '{$_SESSION['id_inschrijving']}'";
            $result = query($query);
            $row = mysql_fetch_assoc($result);
            $row['stroom'] = strtolower($row['stroom']);
            
            $text .= "<input type=\"hidden\" id=\"id_inschrijving\" value=\"{$_SESSION['id_inschrijving']}\">";
            $text .= "<input type=\"hidden\" id=\"stroom\" value=\"{$row['stroom']}\">";
            
            
            $return = str_replace("[AFSPRAAKTEXT]",$text,$return);            
            
        }        
        
        return $return;
        
    }
    
    function set_stroom_session($stroom){
        $_SESSION['stroom'] = $stroom;
        return $_SESSION['stroom']; 
    }
    
    function load_gegevens_kind_inschrijving($id_leerling,$nieuw){
    
        $_SESSION['id_leerling'] = $id_leerling;
        
        
        $query = "SELECT l.*, s.naam as schoolnaam, s.straat as schoolstraat, s.postcode as schoolpostcode, s.gemeente as schoolgemeente 
                    FROM leerlingen l LEFT JOIN scholen s ON l.school_id = s.id WHERE l.id_leerling = '{$id_leerling}'";
        $result = query($query);        
        if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){            
                
                $checkgeslachtman = $row['geslacht'] == "Man" ? " checked=\"checked\"" : "";
                $checkgeslachtvrouw = $row['geslacht'] == "Vrouw" ? " checked=\"checked\"" : "";
                
                $hide_vorigeschool_static = $row['schoolnaam'] != "" || $row['schoolpostcode'] != "" || $row['schoolgemeente'] != "" || $row['schoolgemeente'] != "" ? "" : " hide";
                
                $nationaliteit_html = "<select id=\"nationaliteit\" tabindex=\"6\">" . list_nationaliteiten($row['nationaliteit']) . "</select>";                
                
                $replacements = array(
                  "[CHECKGESLACHTMAN]" => $checkgeslachtman,
                  "[CHECKGESLACHTVROUW]" => $checkgeslachtvrouw,
                  "[GEBOORTEDATUM]" => $row['geboortedatum'],
                  "[GEBOORTEPLAATS]" => $row['geboorteplaats'],
                  "[RIJKSREGISTERNR]" => $row['belgisch_rijksregisternummer_of_bisnummer'],
                  "[NATIONALITEIT]" => $nationaliteit_html,
                  "[TELEFOON]" => $row['tel'],
                  "[GSM]" => $row['gsm'],
                  "[EMAIL]" => $row['email'],
                  "[NAAM]" => $row['naam'],
                  "[VOORNAAM]" => $row['voornaam'],
                  "[STRAAT]" => $row['straat'],
                  "[HUISNUMMER]" => $row['huisnummer'],
                  "[BUSNUMMER]" => $row['busnummer'],
                  "[POSTCODE]" => $row['postcode'],
                  "[PLAATS]" => $row['plaats'],
                  "[NAAMVORIGESCHOOL]" => $row['schoolnaam'],
                  "[POSTCODELAGERESCHOOL]" => $row['schoolpostcode'],
                  "[GEMEENTELAGERESCHOOL]" => $row['schoolgemeente'],
                  "[IDLAGERESCHOOL]" => $row['school_id'],
                  "[HIDE_VORIGESCHOOL_STATIC]" => $hide_vorigeschool_static
                ); 
                
                
                
                $return = file_get_contents("app/views/forms/inschrijving/gegevens_kind.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }            
                    
            
            }
        } else {
            
            if($nieuw == "NO"){
                $return = "error";
            } else {
                
                $replacements = array(
                  "[NAAM]" => "",
                  "[VOORNAAM]" => "",
                  "[STRAAT]" => "",
                  "[HUISNUMMER]" => "",
                  "[BUSNUMMER]" => "",
                  "[POSTCODE]" => "",
                  "[PLAATS]" => "",
                  "[NAAMVORIGESCHOOL]" => "",
                  "[POSTCODELAGERESCHOOL]" => "",
                  "[GEMEENTELAGERESCHOOL]" => "",
                  "[IDLAGERESCHOOL]" => $row['id_school']
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/gegevens_kind.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
                                
            }
           
        }
        
        return $return;
        
        
    }
    
    
    function load_extra_gegevens_kind_inschrijving($id_leerling){
    
        $_SESSION['id_leerling'] = $id_leerling;
        
        
        $query = "SELECT l.*, o.*
                    FROM leerlingen l LEFT JOIN loopbaan o ON l.id_leerling = o.leerling_id WHERE l.id_leerling = '{$id_leerling}'";
        $result = query($query);        
        if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){            
        
                $checkdigitalecommunicatiemoederemail = $row['digitale_communicatie_moeder'] == "email" ? " selected=\"selected\"" : "";
                $checkdigitalecommunicatiemoederpost = $row['digitale_communicatie_moeder'] == "post" ? " selected=\"selected\"" : "";
                $checkdigitalecommunicatievaderemail = $row['digitale_communicatie_vader'] == "email" ? " selected=\"selected\"" : "";
                $checkdigitalecommunicatievaderpost = $row['digitale_communicatie_vader'] == "post" ? " selected=\"selected\"" : "";
                
                $replacements = array(
                  "[CHKDIGITALECOMMUNICATIEMOEDEREMAIL]" => $checkdigitalecommunicatiemoederemail,
                  "[CHKDIGITALECOMMUNICATIEMOEDERPOST]" => $checkdigitalecommunicatiemoederpost,
                  "[CHKDIGITALECOMMUNICATIEVADEREMAIL]" => $checkdigitalecommunicatievaderemail,
                  "[CHKDIGITALECOMMUNICATIEVADERPOST]" => $checkdigitalecommunicatievaderpost,
                  "[NOODNUMMER]" => $row['tel_noodnummer'],
                  "[TWEEDEVERBLIJFSTRAAT]" => $row['tweede_verblijf_straat'],
                  "[TWEEDEVERBLIJFNR]" => $row['tweede_verblijf_huis_nummer'],
                  "[TWEEDEVERBLIJFBUS]" => $row['tweede_verblijf_bus_nummer'],
                  "[TWEEDEVERBLIJFPOSTCODE]" => $row['tweede_verblijf_postcode'],
                  "[TWEEDEVERBLIJFGEMEENTE]" => $row['tweede_verblijf_plaats']
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/gegevens_extra_kind.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
            
            }
        } else {
            if($nieuw == "NO"){
                $return = "error";
            } else {
                
                $replacements = array(
                  "[CHKDIGITALECOMMUNICATIEMOEDEREMAIL]" => "",
                  "[CHKDIGITALECOMMUNICATIEMOEDERPOST]" => "",
                  "[CHKDIGITALECOMMUNICATIEVADEREMAIL]" => "",
                  "[CHKDIGITALECOMMUNICATIEVADERPOST]" => "",
                  "[NOODNUMMER]" => "",
                  "[TWEEDEVERBLIJFSTRAAT]" => "",
                  "[TWEEDEVERBLIJFNR]" => "",
                  "[TWEEDEVERBLIJFBUS]" => "",
                  "[TWEEDEVERBLIJFPOSTCODE]" => "",
                  "[TWEEDEVERBLIJFGEMEENTE]" => ""
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/gegevens_extra_kind.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
                                
            }
        }
        
        return $return;
        
        
    }
    
    function load_gegevens_moeder_inschrijving($id_leerling){
    
        $_SESSION['id_leerling'] = $id_leerling;
        
        
        $query = "SELECT l.*, m.*
                    FROM leerlingen l LEFT JOIN moeder m ON l.id_leerling = m.id_leerling WHERE l.id_leerling = '{$id_leerling}'";
        $result = query($query);        
        if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){            
        
                
                $replacements = array(
                  "[NAAM]" => $row['moeder_naam'],
                  "[VOORNAAM]" => $row['moeder_voornaam'],
                  "[GSM]" => $row['moeder_gsm'],
                  "[EMAIL]" => $row['moeder_email'],
                  "[BEROEP]" => $row['moeder_beroep'],
                  "[STRAAT]" => $row['moeder_straat'],
                  "[NR]" => $row['moeder_huisnummer'],
                  "[BUS]" => $row['moeder_busnummer'],
                  "[POSTCODE]" => $row['moeder_postcode'],
                  "[GEMEENTE]" => $row['moeder_plaats']
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/gegevens_moeder.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
            
            }
        } else {
            if($nieuw == "NO"){
                $return = "error";
            } else {
                
                $replacements = array(
                  "[NAAM]" => "",
                  "[VOORNAAM]" => "",
                  "[GSM]" => "",
                  "[EMAIL]" => "",
                  "[BEROEP]" => "",
                  "[STRAAT]" => "",
                  "[NR]" => "",
                  "[BUS]" => "",
                  "[POSTCODE]" => "",
                  "[GEMEENTE]" => ""
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/gegevens_moeder.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
                                
            }
        }
        
        return $return;
        
        
    }
    
    function load_gegevens_vader_inschrijving($id_leerling){
    
        $_SESSION['id_leerling'] = $id_leerling;
        
        
        $query = "SELECT l.*, v.*
                    FROM leerlingen l LEFT JOIN vader v ON l.id_leerling = v.id_leerling WHERE l.id_leerling = '{$id_leerling}'";
        $result = query($query);        
        if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){            
        
                
                $replacements = array(
                  "[NAAM]" => $row['vader_naam'],
                  "[VOORNAAM]" => $row['vader_voornaam'],
                  "[GSM]" => $row['vader_gsm'],
                  "[EMAIL]" => $row['vader_email'],
                  "[BEROEP]" => $row['vader_beroep'],
                  "[STRAAT]" => $row['vader_straat'],
                  "[NR]" => $row['vader_huisnummer'],
                  "[BUS]" => $row['vader_busnummer'],
                  "[POSTCODE]" => $row['vader_postcode'],
                  "[GEMEENTE]" => $row['vader_plaats']
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/gegevens_vader.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
            
            }
        } else {
            if($nieuw == "NO"){
                $return = "error";
            } else {
                
                $replacements = array(
                  "[NAAM]" => "",
                  "[VOORNAAM]" => "",
                  "[GSM]" => "",
                  "[EMAIL]" => "",
                  "[BEROEP]" => "",
                  "[STRAAT]" => "",
                  "[NR]" => "",
                  "[BUS]" => "",
                  "[POSTCODE]" => "",
                  "[GEMEENTE]" => ""
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/gegevens_vader.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
                                
            }
        }
        
        return $return;
        
        
    }
    
    function load_vipinformatie_1($id_leerling){
    
        $_SESSION['id_leerling'] = $id_leerling;
        
        
        $query = "SELECT l.*, v.*
                    FROM leerlingen l LEFT JOIN vip v ON l.id_leerling = v.id_leerling WHERE l.id_leerling = '{$id_leerling}'";
        $result = query($query);        
        if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){            
        
                $checkmiddagschool = $row['middag'] == "op school blijft en zijn / haar lunch gebruikt in de leerlingenrefter" ? " checked=\"checked\"" : ""; 
                $checkmiddagthuis = $row['middag'] == "naar huis komt" ? " checked=\"checked\"" : "";
                $checkmiddaghalf = substr($row['middag'],0,4) == "soms" ? " checked=\"checked\"" : "";
                
                $disabled_address = $row['middag'] != "naar huis komt" ? " disabled" : "";
                $displaythuisdagen = substr($row['middag'],0,4) == "soms" ? "" : " hide";
                
                $chkthuisma = "";
                $chkthuisdi = "";
                $chkthuiswo = "";
                $chkthuisdo = "";
                $chkthuisvr = "";
                
                if(substr($row['middag'],0,4) == "soms"){

                    $middag = str_replace("soms naar huis komt:","",$row['middag']);
                    $middag = explode(",",$middag);
                    
                    foreach($middag as $key => $dag){
                        $middag[$key] = trim($dag);
                    }                    
                    
                    
                    $chkthuisma = in_array("Maandag",$middag) ? " checked=\"checked\"" : "";
                    $chkthuisdi = in_array("Dinsdag",$middag) ? " checked=\"checked\"" : "";
                    $chkthuiswo = in_array("Woensdag",$middag) ? " checked=\"checked\"" : "";
                    $chkthuisdo = in_array("Donderdag",$middag) ? " checked=\"checked\"" : "";
                    $chkthuisvr = in_array("Vrijdag",$middag) ? " checked=\"checked\"" : "";
                    
                    $disabled_address = "";
                    
                    
                }
                                                      
                $replacements = array(
                  "[MIDDAGSCHOOL]" => $checkmiddagschool,
                  "[MIDDAGTHUIS]" => $checkmiddagthuis,
                  "[MIDDAGHALF]" => $checkmiddaghalf,
                  "[DISPLAYTHUISDAGEN]" => $displaythuisdagen,
                  "[CHKTHUISMA]" => $chkthuisma,
                  "[CHKTHUISDI]" => $chkthuisdi,
                  "[CHKTHUISWO]" => $chkthuiswo,
                  "[CHKTHUISDO]" => $chkthuisdo,
                  "[CHKTHUISVR]" => $chkthuisvr,                  
                  "[STRAAT]" => $row['middag_straat'],
                  "[NR]" => $row['middag_huisnummer'],
                  "[BUS]" => $row['middag_busnummer'],
                  "[POSTCODE]" => $row['middag_postcode'],
                  "[GEMEENTE]" => $row['middag_plaats'],
                  "[DISABLED]" => $disabled_address
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/vip_informatie1.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
            
            }
        } else {
            if($nieuw == "NO"){
                $return = "error";
            } else {
                
                $replacements = array(
                  "[MIDDAGSCHOOL]" => "",
                  "[MIDDAGTHUIS]" => "",
                  "[STRAAT]" => "",
                  "[NR]" => "",
                  "[BUS]" => "",
                  "[POSTCODE]" => "",
                  "[GEMEENTE]" => "",
                  "[DISABLED]" => " disabled"
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/vip_informatie1.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
                                
            }
        }
        
        return $return;
        
        
    }
    
    function load_vipinformatie_2($id_leerling){
    
        $_SESSION['id_leerling'] = $id_leerling;
        
        
        $query = "SELECT l.*, v.*, b.*
                    FROM leerlingen l 
                    LEFT JOIN vip v ON l.id_leerling = v.id_leerling 
                    LEFT JOIN loopbaan b ON l.id_leerling = b.leerling_id 
                    WHERE l.id_leerling = '{$id_leerling}'";
        $result = query($query);        
        if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){

            
                $checkdubbelepostja = $row['dubbele_afdruk'] == "Ja" ? " checked=\"checked\"" : "";
                $checkdubbelepostnee = $row['dubbele_afdruk'] == "Nee" ? " checked=\"checked\"" : "";

                $checkbeideja = $row['door_beide_ouders_opgevoed'] == "Ja" ? " checked=\"checked\"" : ""; 
                $checkbeidenee = $row['door_beide_ouders_opgevoed'] == "Nee" ? " checked=\"checked\"" : ""; 
                
                  
                $radionvp = $row['opgevoed_door_andere'] == "Niet van toepassing" ? " checked=\"checked\"" : "";
                $radionvp = $row['door_beide_ouders_opgevoed'] != "Nee" ? " disabled" : $radionvp;
                
                $radioco = $row['opgevoed_door_andere'] == "co-ouderschap" ? " checked=\"checked\"" : "";
                $radioco = $row['door_beide_ouders_opgevoed'] != "Nee" ? " disabled" : $radioco;
                
                $radiogescheiden = $row['opgevoed_door_andere'] == "Gescheiden" ? " checked=\"checked\"" : "";
                $radiogescheiden = $row['door_beide_ouders_opgevoed'] != "Nee" ? " disabled" : $radiogescheiden; 
                
                $radio1overleden = $row['opgevoed_door_andere'] == "1 ouder overleden" ? " checked=\"checked\"" : "";
                $radio1overleden = $row['door_beide_ouders_opgevoed'] != "Nee" ? " disabled" : $radio1overleden;
                
                $radio2overleden = $row['opgevoed_door_andere'] == "2 ouders overleden" ? " checked=\"checked\"" : "";
                $radio2overleden = $row['door_beide_ouders_opgevoed'] != "Nee" ? " disabled" : $radio2overleden;

                $radiostief = $row['opgevoed_door_andere'] == "stiefouders" ? " checked=\"checked\"" : "";                
                $radiostief = $row['door_beide_ouders_opgevoed'] != "Nee" ? " disabled" : $radiostief ;
                
                
                  
                                                      
                $replacements = array(
                  "[CHECKDUBBELEPOSTJA]" => $checkdubbelepostja,
                  "[CHECKDUBBELEPOSTNEE]" => $checkdubbelepostnee,
                  "[CHECKBEIDEJA]" => $checkbeideja,
                  "[CHECKBEIDENEE]" => $checkbeidenee,
                  "[DISABLEDSITUATIE]" => $row['door_beide_ouders_opgevoed'] != "Nee" ? " disabled" : "",
                  "[RADIONVP]" => $radionvp,
                  "[RADIOCO]" => $radioco,
                  "[RADIOGESCHEIDEN]" => $radiogescheiden,
                  "[RADIO1OVERLEDEN]" => $radio1overleden,
                  "[RADIO2OVERLEDEN]" => $radio2overleden,
                  "[RADIOSTIEF]" => $radiostief,
                  "[HIDEGEGEVENSSTIEFOUDERS]" => $row['opgevoed_door_andere'] == "stiefouders" ? "" : " hide",
                  "[PARTNERMAMANAAM]" => $row['opgevoed_door_andere'] == "stiefouders" ? $row['partnermama_naam'] : "",
                  "[PARTNERMAMAGSM]" => $row['opgevoed_door_andere'] == "stiefouders" ? $row['partnermama_gsm'] : "",
                  "[PARTNERMAMAEMAIL]" => $row['opgevoed_door_andere'] == "stiefouders" ? $row['partnermama_email'] : "",
                  "[PARTNERPAPANAAM]" => $row['opgevoed_door_andere'] == "stiefouders" ? $row['partnerpapa_naam'] : "",
                  "[PARTNERPAPAGSM]" => $row['opgevoed_door_andere'] == "stiefouders" ? $row['partnerpapa_gsm'] : "",
                  "[PARTNERPAPAEMAIL]" => $row['opgevoed_door_andere'] == "stiefouders" ? $row['partnerpapa_email'] : "",
                  "[OPGEVOEDANDERE]" => $row['opgevoed_door_naam'],
                  "[INFO]" => $row['andere_info']
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/vip_informatie2.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
            
            }
        } else {
            if($nieuw == "NO"){
                $return = "error";
            } else {
                
                $replacements = array(
                  "[CHECKDUBBELEPOSTJA]" => "",
                  "[CHECKDUBBELEPOSTNEE]" => "",
                  "[CHECKTHUISJA]" => "",
                  "[CHECKTHUISNEE]" =>  "",
                  "[DISABLEDTHUIS]" =>  " disabled",
                  "[OPGEVOEDSTRAAT]" =>  "",
                  "[OPGEVOEDNR]" =>  "",
                  "[OPGEVOEDBUS]" =>  "",
                  "[OPGEVOEDPOSTCODE]" =>  "",
                  "[OPGEVOEDGEMEENTE]" =>  "",
                  "[CHECKBEIDEJA]" =>  "",
                  "[CHECKBEIDENEE]" =>  "",
                  "[DISABLEDSITUATIE]" =>  " disabled",
                  "[RADIONVP]" =>  "",
                  "[RADIOCO]" =>  "",
                  "[RADIOGESCHEIDEN]" =>  "",
                  "[RADIO1OVERLEDEN]" =>  "",
                  "[RADIO2OVERLEDEN]" =>  "",
                  "[OPGEVOEDANDERE]" =>  "",
                  "[INFO]" =>  ""
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/vip_informatie2.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
                                
            }
        }
        
        return $return;
        
        
    }        

    function load_vipinformatie_3($id_leerling){
    
        $_SESSION['id_leerling'] = $id_leerling;
        
        
        $query = "SELECT l.*, v.*
                    FROM leerlingen l LEFT JOIN vip v ON l.id_leerling = v.id_leerling WHERE l.id_leerling = '{$id_leerling}'";
        $result = query($query);        
        if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){            
        
                $checkthuistaalja = $row['thuistaal'] == "Ja" ? " checked=\"checked\"" : ""; 
                $checkthuistaalnee = $row['thuistaal'] == "Nee" || ($row['thuistaal'] != "Ja" && $row['thuistaal'] != "") ? " checked=\"checked\"" : ""; 
                       
                $checkjaaroverdoenja = $row['heeft_jaar_moeten_overdoen'] == "Ja" ? " checked=\"checked\"" : "";                
                $checkjaaroverdoennee = $row['heeft_jaar_moeten_overdoen'] == "Nee" ? " checked=\"checked\"" : "";                
                
                $checkleerproblemenja = $row['leerproblemen'] == "Ja" ? " checked=\"checked\"" : "";                
                $checkleerproblemennee = $row['leerproblemen'] == "Nee" ? " checked=\"checked\"" : "";                

                $checkgezondheidsproblemenja = $row['gezondheidsproblemen'] == "Ja" ? " checked=\"checked\"" : "";                
                $checkgezondheidsproblemennee = $row['gezondheidsproblemen'] == "Nee" ? " checked=\"checked\"" : "";                

                $checkgedragsproblemenja = $row['gedragsproblemen'] == "Ja" ? " checked=\"checked\"" : "";                
                $checkgedragsproblemennee = $row['gedragsproblemen'] == "Nee" ? " checked=\"checked\"" : "";                
                                
                                    
                $replacements = array(
                  "[CHECKTHUISTAALJA]" => $checkthuistaalja,
                  "[CHECKTHUISTAALNEE]" => $checkthuistaalnee,
                  "[DISABLETHUISTAAL]" => $row['thuistaal'] == "Ja" || $row['thuistaal'] == ""  ? " disabled" : "",
                  "[THUISTAALANDERE]" => $row['thuistaal'],
                  "[CHECKJAAROVERDOENJA]" => $checkjaaroverdoenja,
                  "[CHECKJAAROVERDOENNEE]" => $checkjaaroverdoennee,
                  "[DISABLEJAAROVERDOEN]" => $row['heeft_jaar_moeten_overdoen'] != "Ja" ? " disabled" : "",
                  "[OVERDOENWELKE]" => $row['jaar_overdoen_welke'],
                  "[CHECKHERNEEMTEERSTEJAARJA]" => $row['herneemt_eerste_jaar'] == "Ja" ? " checked=\"checked\"" : "", 
                  "[CHECKHERNEEMTEERSTEJAARNEE]" => $row['herneemt_eerste_jaar'] == "Nee" ? " checked=\"checked\"" : "",
                  "[HIDEHERNEEMTEERSTEJAAR]" => $row['herneemt_eerste_jaar'] == "Ja" ? "" : " hide",
                  "[HIDE_HERNEEMTEERSTEJAARSCHOOLSTATIC]" => $row['herneemt_eerste_jaar_school_naam'] != "" && $row['herneemt_eerste_jaar_school_postcode'] != "" &&  $row['herneemt_eerste_jaar_school_gemeente'] != "" ? "" : " hide",   
                  "[HERNEEMTEERSTEJAARSCHOOLNAAM]" => $row['herneemt_eerste_jaar_school_naam'],                   
                  "[HERNEEMTEERSTEJAARSCHOOLPOSTCODE]" => $row['herneemt_eerste_jaar_school_postcode'], 
                  "[HERNEEMTEERSTEJAARSCHOOLGEMEENTE]" => $row['herneemt_eerste_jaar_school_gemeente'],                   
                  "[HERNEEMTEERSTEJAARSCHOOLID]" => $row['herneemt_eerste_jaar_school_id'], 
                  "[CHECKLEERPROBLEMENJA]" => $checkleerproblemenja,
                  "[CHECKLEERPROBLEMENNEE]" => $checkleerproblemennee,
                  "[DISABLELEERPROBLEMEN]" => $row['leerproblemen'] != "Ja" ? " disabled" : "",
                  "[LEERPROBLEMENEXTRA]" => $row['leerproblemen_extra'],
                  "[CHECKGEZONDHEIDSPROBLEMENJA]" => $checkgezondheidsproblemenja,
                  "[CHECKGEZONDHEIDSPROBLEMENNEE]" => $checkgezondheidsproblemennee,
                  "[DISABLEGEZONDHEIDSPROBLEMEN]" => $row['gezondheidsproblemen'] != "Ja" ? " disabled" : "",
                  "[GEZONDHEIDSPROBLEMENEXTRA]" => $row['gezondheidsproblemen_extra'],
                  "[CHECKGEDRAGSPROBLEMENJA]" => $checkgedragsproblemenja,
                  "[CHECKGEDRAGSPROBLEMENNEE]" => $checkgedragsproblemennee,
                  "[DISABLEGEDRAGSPROBLEMEN]" => $row['gedragsproblemen'] != "Ja" ? " disabled" : "",
                  "[GEDRAGSPROBLEMENEXTRA]" => $row['gedragsproblemen_extra']
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/vip_informatie3.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
            
            }
        } else {
            if($nieuw == "NO"){
                $return = "error";
            } else {
                
                $replacements = array(
                  "[CHECKTHUISTAALJA]" => "",
                  "[CHECKTHUISTAALNEE]" => "",
                  "[DISABLETHUISTAAL]" => " disabled",
                  "[THUISTAALANDERE]" => "",
                  "[CHECKJAAROVERDOENJA]" => "",
                  "[CHECKJAAROVERDOENNEE]" => "",
                  "[DISABLEJAAROVERDOEN]" => " disabled",
                  "[OVERDOENWELKE]" => "",
                  "[CHECKLEERPROBLEMENJA]" => "",
                  "[CHECKLEERPROBLEMENNEE]" => "",
                  "[DISABLELEERPROBLEMEN]" => " disabled",
                  "[LEERPROBLEMENEXTRA]" => "",
                  "[CHECKGEZONDHEIDSPROBLEMENJA]" => "",
                  "[CHECKGEZONDHEIDSPROBLEMENNEE]" => "",
                  "[DISABLEGEZONDHEIDSPROBLEMEN]" => " disabled",
                  "[GEZONDHEIDSPROBLEMENEXTRA]" => "",
                  "[CHECKGEDRAGSPROBLEMENJA]" => "",
                  "[CHECKGEDRAGSPROBLEMENNEE]" => "",
                  "[DISABLEGEDRAGSPROBLEMEN]" => " disabled",
                  "[GEDRAGSPROBLEMENEXTRA]" => ""
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/vip_informatie3.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
                                
            }
        }
        
        return $return;
        
        
    } 
    
    function load_gok($id_leerling){
    
        $_SESSION['id_leerling'] = $id_leerling;
        
        
        $query = "SELECT l.*, o.*
                    FROM leerlingen l LEFT JOIN loopbaan o ON l.id_leerling = o.leerling_id WHERE l.id_leerling = '{$id_leerling}'";
        $result = query($query);        
        if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){            
            
                $radiomoederned = $row['gok_moeder_edison_spreektaal'] == "Nederlands" ? " checked=\"checked\"" : "";
                $radiomoederfrans = $row['gok_moeder_edison_spreektaal'] == "Frans" ? " checked=\"checked\"" : "";                
                $radiomoedernvp = $row['gok_moeder_edison_spreektaal'] == "Ik kan hierop niet antwoorden omdat de moeder geen contact heeft met het kind of overleden is" ? " checked=\"checked\"" : "";
                $radiomoederandere = $row['gok_moeder_edison_spreektaal'] != "" && ($radiomoederned == "" && $radiomoederfrans == "" && $radiomoedernvp == "") ? " checked=\"checked\"" : "";                
                $disablemoeder = $radiomoederned != "" || $radiomoederfrans != "" || $radiomoedernvp != ""  ? " disabled" : "";
                $moederandere = $radiomoederned != "" || $radiomoederfrans != "" || $radiomoedernvp  != "" ? "" : $row['gok_moeder_edison_spreektaal'];

                $radiovaderned = $row['gok_vader_edison_spreektaal'] == "Nederlands" ? " checked=\"checked\"" : "";
                $radiovaderfrans = $row['gok_vader_edison_spreektaal'] == "Frans" ? " checked=\"checked\"" : "";
                $radiovadernvp = $row['gok_vader_edison_spreektaal'] == "Ik kan hierop niet antwoorden omdat de vader geen contact heeft met het kind of overleden is" ? " checked=\"checked\"" : "";
                $radiovaderandere = $row['gok_vader_edison_spreektaal'] != "" && ($radiovaderned == "" && $radiovaderfrans == "" && $radiovadernvp  == "") ? " checked=\"checked\"" : "";                
                $disablevader = $radiovaderned != "" || $radiovaderfrans != "" || $radiovadernvp  != ""  ? " disabled" : "";
                $vaderandere = $radiovaderned != "" || $radiovaderfrans != "" || $radiovadernvp != "" ? "" : $row['gok_vader_edison_spreektaal'];

                $radiozusned = $row['gok_broer_zus_edison_spreektaal'] == "Nederlands" ? " checked=\"checked\"" : "";
                $radiozusfrans = $row['gok_broer_zus_edison_spreektaal'] == "Frans" ? " checked=\"checked\"" : "";
                $radiozusnvp = $row['gok_broer_zus_edison_spreektaal'] == "Ik kan hierop niet antwoorden omdat het kind geen contact heeft met broers of zussen of geen broers of zussen heeft" ? " checked=\"checked\"" : "";                
                $radiozusandere = $row['gok_broer_zus_edison_spreektaal'] != "" && ($radiozusned == "" && $radiozusfrans == "" && $radiozusnvp == "") ? " checked=\"checked\"" : "";
                $disablezus = $radiozusned != "" || $radiozusfrans != "" || $radiozusnvp  != ""  ? " disabled" : "";
                $zusandere = $radiozusned != "" || $radiozusfrans != "" || $radiozusnvp  != ""  ? "" : $row['gok_broer_zus_edison_spreektaal'];

                $radiovriendenned = $row['gok_vrienden_edison_spreektaal'] == "Nederlands" ? " checked=\"checked\"" : "";
                $radiovriendenfrans = $row['gok_vrienden_edison_spreektaal'] == "Frans" ? " checked=\"checked\"" : "";
                $radiovriendennvp = $row['gok_vrienden_edison_spreektaal'] == "Ik weet het niet" ? " checked=\"checked\"" : "";                
                $radiovriendenandere = $row['gok_vrienden_edison_spreektaal'] != "" && ($radiovriendenned == "" && $radiovriendenfrans == "" && $radiovriendennvp == "") ? " checked=\"checked\"" : "";                
                $disablevrienden = $radiovriendenned != "" || $radiovriendenfrans != "" || $radiovriendennvp != "" ? " disabled" : "";
                $vriendenandere = $radiovriendenned != "" || $radiovriendenfrans != "" || $radiovriendennvp  != "" ? "" : $row['gok_vrienden_edison_spreektaal'];
                
                
                $replacements = array(
                  "[RADIOMOEDERNED]" => $radiomoederned,
                  "[RADIOMOEDERFRANS]" => $radiomoederfrans,
                  "[RADIOMOEDERANDERE]" => $radiomoederandere,
                  "[RADIOMOEDERNVP]" => $radiomoedernvp,
                  "[DISABLEMOEDER]" => $disablemoeder,
                  "[MOEDERANDERE]" => $moederandere,
                  "[RADIOVADERNED]" => $radiovaderned,
                  "[RADIOVADERFRANS]" => $radiovaderfrans,
                  "[RADIOVADERANDERE]" => $radiovaderandere,
                  "[RADIOVADERNVP]" => $radiovadernvp,
                  "[DISABLEVADER]" => $disablevader,
                  "[VADERANDERE]" => $vaderandere,
                  "[RADIOZUSNED]" => $radiozusned,
                  "[RADIOZUSFRANS]" => $radiozusfrans,
                  "[RADIOZUSANDERE]" => $radiozusandere,
                  "[RADIOZUSNVP]" => $radiozusnvp,
                  "[DISABLEZUS]" => $disablezus,
                  "[ZUSANDERE]" => $zusandere,
                  "[RADIOVRIENDENNED]" => $radiovriendenned,
                  "[RADIOVRIENDENFRANS]" => $radiovriendenfrans,
                  "[RADIOVRIENDENANDERE]" => $radiovriendenandere,
                  "[RADIOVRIENDENNVP]" => $radiovriendennvp,
                  "[DISABLEVRIENDEN]" => $disablevrienden,
                  "[VRIENDENANDERE]" => $vriendenandere                  
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/gok.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
            
            }
        } else {
            if($nieuw == "NO"){
                $return = "error";
            } else {
                
                $replacements = array(
                  "[RADIOMOEDERNED]" => "",
                  "[RADIOMOEDERFRANS]" => "",
                  "[RADIOMOEDERANDERE]" => "",
                  "[RADIOMOEDERNVP]" => "",
                  "[DISABLEMOEDER]" => " disabled",
                  "[MOEDERANDERE]" => "",
                  "[RADIOVADERNED]" => "",
                  "[RADIOVADERFRANS]" => "",
                  "[RADIOVADERANDERE]" => "",
                  "[RADIOVADERNVP]" => "",
                  "[DISABLEVADER]" => " disabled",
                  "[VADERANDERE]" => "",
                  "[RADIOZUSNED]" => "",
                  "[RADIOZUSFRANS]" => "",
                  "[RADIOZUSANDERE]" => "",
                  "[RADIOZUSNVP]" => "",
                  "[DISABLEZUS]" => " disabled",
                  "[ZUSANDERE]" => "",
                  "[RADIOVRIENDENNED]" => "",
                  "[RADIOVRIENDENFRANS]" => "",
                  "[RADIOVRIENDENANDERE]" => "",
                  "[RADIOVRIENDENNVP]" => "",
                  "[DISABLEVRIENDEN]" => " disabled",
                  "[VRIENDENANDERE]" => "",
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/gok.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
                                
            }
        }
        
        return $return;
        
        
    }
    
    
    function load_gok2($id_leerling){
    
        $_SESSION['id_leerling'] = $id_leerling;
        
        
        $query = "SELECT l.*, o.*
                    FROM leerlingen l LEFT JOIN loopbaan o ON l.id_leerling = o.leerling_id WHERE l.id_leerling = '{$id_leerling}'";
        $result = query($query);        
        if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){            
            
                            
                $replacements = array(                  
                  "[RADIOLANI]" => $row['gok_edison_opleidingsniveau_moeder'] == "lager onderwijs niet afgemaakt." ? " checked=\"checked\"" : "",                  
                  "[RADIOLAWE]" => $row['gok_edison_opleidingsniveau_moeder'] == "lager onderwijs afgewerkt. Zowel gewoon als buitengewoon lager onderwijs komen hiervoor in aanmerking" ? " checked=\"checked\"" : "",
                  "[RADIOLASE]" => $row['gok_edison_opleidingsniveau_moeder'] == "lager secundair onderwijs afgewerkt. Dit is een diploma, getuigschrift of attest van slagen van de eerste 3 jaren van het gewoon of buitengewoon onderwijs (bijvoorbeeld A3,A4 of B3) of een getuigschrift van het deeltijds beroepssecundair onderwijs of van de leertijd (leercontract VIZO/Syntra)." ? " checked=\"checked\"" : "",
                  "[RADIOHOSE]" => $row['gok_edison_opleidingsniveau_moeder'] == "hoger secundair onderwijs afgewerkt. Dit is een diploma of getuigschrift van het hoger secundair onderwijs ASO, TSO, KSO, BSO, A2, B2, HSTL, of een diploma van de vierde graad BSO. Buitengewoon secundair onderwijs komt hiervoor niet in aanmerking." ? " checked=\"checked\"" : "",
                  "[RADIOHO]" => $row['gok_edison_opleidingsniveau_moeder'] == "hoger onderwijs afgewerkt. Dit is een diploma van een hogeschool of van een universiteit, bijvoorbeeld A1, B1, gegradueerde, licentraat, ingenieur, doctor, master, bachelor." ? " checked=\"checked\"" : ""
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/gok2.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
            
            }
        } else {
            if($nieuw == "NO"){
                $return = "error";
            } else {
                
                $replacements = array(
                  "[RADIOLANI]" => "",
                  "[RADIOLAWE]" => "",
                  "[RADIOLASE]" => "",
                  "[RADIOHOSE]" => "",
                  "[RADIOHO]" => ""
                ); 
                                
                $return = file_get_contents("app/views/forms/inschrijving/gok2.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
                                
            }
        }
        
        return $return;
        
        
    }
    
    
    function load_baso($id_leerling){
    
        $_SESSION['id_leerling'] = $id_leerling;
        
        
        $query = "SELECT l.*, o.*
                    FROM leerlingen l LEFT JOIN loopbaan o ON l.id_leerling = o.leerling_id WHERE l.id_leerling = '{$id_leerling}'";
        $result = query($query);        
        if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){            
            
                            
                $replacements = array(                  
                  "[ACTIVEBASOJA]" => $row['toestemming_baso_werking'] == "YES" ? " btnBigActive" : "",
                  "[ACTIVEBASONEE]" => $row['toestemming_baso_werking'] == "NO" ? " btnBigActive" : "",
                  "[BASO]" => $row['toestemming_baso_werking']
                ); 
                
                $return = file_get_contents("app/views/forms/inschrijving/baso.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
            
            }
        } else {
            if($nieuw == "NO"){
                $return = "error";
            } else {
                
                $replacements = array(
                  "[ACTIVEBASOJA]" => "",
                  "[ACTIVEBASONEE]" => "",
                  "[BASO]" => ""
                ); 
                                
                $return = file_get_contents("app/views/forms/inschrijving/baso.tpl");
                foreach($replacements as $search => $replace){
                     $return = str_replace($search,$replace,$return);
                }                
                                
            }
        }
        
        return $return;
        
        
    }


    function check_ookastroom_inschrijven($id_leerling,$stroom){
    
        $_SESSION['id_leerling'] = $id_leerling;
                
                
        $query = "SELECT * FROM studiekeuzes ORDER BY studiekeuze";
        $result = query($query);
        $i = 1;    
        $tab = 2;
        while($row = mysql_fetch_assoc($result)){        
            $tab += 1;    
            if($i == 1){
                $studiekeuzes .= "<tr><th>{$row['studiekeuze']}</th><td style=\"width:200px;\"><input type=\"text\" id=\"{$row['afkorting']}\" value=\"\" style=\"width:20px;\" maxlength=\"1\" tabindex=\"$tab\"></td>";
                $i = 2;
            } else if ($i == 2){
                $studiekeuzes .= "<th>{$row['studiekeuze']}</th><td style=\"width:200px;\"><input type=\"text\" id=\"{$row['afkorting']}\" value=\"\" style=\"width:20px;\" maxlength=\"1\" tabindex=\"$tab\"></td></tr>";
                $i = 1;
            }            
        }

        $keuzes = array("A-Stroom: Klassieke vorming","A-Stroom: Algemene vorming","Nog niet bepaald");
                
        if($stroom == "A"){
                $replacements = array(                  
                  "[DISPLAYOOKA]" => "display:none;",
                  "[STUDIEKEUZES]" => ""
                ); 
                                        
        } else {

            $query = "SELECT stroom FROM inschrijving WHERE id_leerling = '$id_leerling' AND stroom = 'A'";
            $result = query($query);
            if(mysql_num_rows($result) > 0){
                $replacements = array(                  
                  "[DISPLAYOOKA]" => "display:none;",
                  "[STUDIEKEUZES]" => ""
                ); 
                                
            } else {
                $replacements = array(                  
                  "[DISPLAYOOKA]" => "",
                  "[STUDIEKEUZES]" => $studiekeuzes
                ); 
                
                
            }
        }
        
        $return = file_get_contents("app/views/forms/inschrijving/eindwoord.tpl");
        foreach($replacements as $search => $replace){
            $return = str_replace($search,$replace,$return);
        }                
        
        
        return $return;
        
        
    }
    
    
    function save_gegevens_kind_inschrijving($fields){
                                                    
        $data = convert_fields_to_array($fields);

        $lagereschool = "";
        if($data['kind_vorigeschool_naam'] != "" && $data['kind_vorigeschool_postcode'] != "" && $data['kind_vorigeschool_gemeente'] != ""){
            $lagereschool = $data['kind_vorigeschool_gemeente'] . " " . $data['kind_vorigeschool_naam'] . " " .  $data['kind_vorigeschool_postcode'] . " " . $data['kind_vorigeschool_gemeente'];
        }          
        
        $data['nationaliteit'] = strtoupper($data['nationaliteit']);
        
        $not_automatic = array("kind_vorigeschool_naam","kind_vorigeschool_postcode","kind_vorigeschool_gemeente","kind_vorigeschool_id","search_lagere_school_pg");
                                             
        $query = "UPDATE leerlingen SET ";
        foreach($data as $column => $value){
          if(!in_array($column,$not_automatic) && $column != ""){
            $value = mysql_real_escape_string($value);
            $query .= " `$column` = '$value',";
          }          
        }      
        $query = substr($query,0,-1);
        if($lagereschool != ""){
            $lagereschool = mysql_real_escape_string($lagereschool);
            $query .=  ", `school_vorig_schooljaar` = '{$lagereschool}' ";   
        }
        if($data['kind_vorigeschool_id'] != ""){
            $query .=  ", `school_id` = '{$data['kind_vorigeschool_id']}' ";   
        }
        $query .= " WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        
        $result = query($query);                
        return $result;

        
    }
    
    function save_extra_gegevens_kind_inschrijving($fields){

        $data = convert_fields_to_array($fields);        
        
        foreach($data as $key => $value){
            $data[$key] = mysql_real_escape_string($value);
        }
        
        $query = "SELECT leerling_id FROM loopbaan WHERE leerling_id = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        if(mysql_num_rows($result) == 0){
            $queryInsert = "INSERT INTO loopbaan (`leerling_id`,`digitale_communicatie_moeder`,`digitale_communicatie_vader`) VALUES ('{$_SESSION['id_leerling']}','{$data['digitale_communicatie_moeder']}','{$data['digitale_communicatie_vader']}')";
            query($queryInsert);            
        } else {
            $queryUpdate = "UPDATE loopbaan SET `digitale_communicatie_moeder` = '{$data['digitale_communicatie_moeder']}', `digitale_communicatie_vader` = '{$data['digitale_communicatie_vader']}' WHERE leerling_id = '{$_SESSION['id_leerling']}'";
            query($queryUpdate);            
        }
        
        $not_automatic = array("digitale_communicatie_moeder","digitale_communicatie_vader");
        
        $query = "UPDATE leerlingen SET ";
        foreach($data as $column => $value){
          if(!in_array($column,$not_automatic) && $column != ""){
            $value = mysql_real_escape_string($value);
            $query .= " `$column` = '$value',";
          }          
        }      
        $query = substr($query,0,-1);
        $query .= " WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        query($query);
        
        return 1;
        
    }
    
    function save_gegevens_moeder_inschrijving($fields){
        

        $data = convert_fields_to_array($fields);        
        
        foreach($data as $key => $value){
            $data[$key] = mysql_real_escape_string($value);
        }
        
        $query =  "SELECT id_leerling FROM moeder WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        if(mysql_num_rows($result) == 0){
            $queryInsert = "INSERT INTO moeder (`id_leerling`,`moeder_naam`,`moeder_voornaam`,`moeder_beroep`,`moeder_gsm`,`moeder_email`,`moeder_straat`,`moeder_huisnummer`,`moeder_busnummer`,`moeder_postcode`,`moeder_plaats`) VALUES ('{$_SESSION['id_leerling']}','{$data['moeder_naam']}','{$data['moeder_voornaam']}','{$data['moeder_beroep']}','{$data['moeder_gsm']}','{$data['moeder_email']}','{$data['moeder_straat']}','{$data['moeder_huisnummer']}','{$data['moeder_busnummer']}','{$data['moeder_postcode']}','{$data['moeder_plaats']}')";
            query($queryInsert);
        } else {
            $queryUpdate = "UPDATE moeder SET `moeder_naam` = '{$data['moeder_naam']}',`moeder_voornaam` = '{$data['moeder_voornaam']}',`moeder_beroep` = '{$data['moeder_beroep']}',`moeder_gsm` = '{$data['moeder_gsm']}',`moeder_email` = '{$data['moeder_email']}',`moeder_straat` = '{$data['moeder_straat']}',`moeder_huisnummer` = '{$data['moeder_huisnummer']}',`moeder_busnummer` = '{$data['moeder_busnummer']}',`moeder_postcode` = '{$data['moeder_postcode']}', `moeder_plaats` = '{$data['moeder_plaats']}' WHERE id_leerling = '{$_SESSION['id_leerling']}'";
            query($queryUpdate);
        }
        


        
        
        
    }
    
    function save_gegevens_vader_inschrijving($fields){
        
        $data = convert_fields_to_array($fields);        
        
        foreach($data as $key => $value){
            $data[$key] = mysql_real_escape_string($value);
        }        
        
        $query =  "SELECT id_leerling FROM vader WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        if(mysql_num_rows($result) == 0){
            $queryInsert = "INSERT INTO vader (`id_leerling`,`vader_naam`,`vader_voornaam`,`vader_beroep`,`vader_gsm`,`vader_email`,`vader_straat`,`vader_huisnummer`,`vader_busnummer`,`vader_postcode`,`vader_plaats`) VALUES ('{$_SESSION['id_leerling']}','{$data['vader_naam']}','{$data['vader_voornaam']}','{$data['vader_beroep']}','{$data['vader_gsm']}','{$data['vader_email']}','{$data['vader_straat']}','{$data['vader_huisnummer']}','{$data['vader_busnummer']}','{$data['vader_postcode']}','{$data['vader_plaats']}')";
            query($queryInsert);
        } else {
            $queryUpdate = "UPDATE vader SET `vader_naam` = '{$data['vader_naam']}',`vader_voornaam` = '{$data['vader_voornaam']}',`vader_beroep` = '{$data['vader_beroep']}',`vader_gsm` = '{$data['vader_gsm']}',`vader_email` = '{$data['vader_email']}',`vader_straat` = '{$data['vader_straat']}',`vader_huisnummer` = '{$data['vader_huisnummer']}',`vader_busnummer` = '{$data['vader_busnummer']}',`vader_postcode` = '{$data['vader_postcode']}', `vader_plaats` = '{$data['vader_plaats']}' WHERE id_leerling = '{$_SESSION['id_leerling']}'";
            query($queryUpdate);
        }        
                   
    }
    
    function save_studiekeuze_inschrijving($fields, $studiekeuze, $huidigschooljaar){
                
        if($studiekeuze == ""){
            return 0;
        }
        
        $query = "SELECT * FROM studiekeuzes";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            $studiekeuzes[$row['afkorting']] = $row['studiekeuze'];
        }
        
                
        $vakken = convert_fields_to_array($fields);
        
        $keuzevakken = array();
        if($studiekeuze == "aalgemeen"){
            foreach($vakken as $vak => $nr){
                if($nr != "" && $nr <= 3){
                    $keuzevakken[$vak] = $nr;
                }
            }
        }        
        
        switch($studiekeuze){
            case "aklassiek"; $studiekeuze = "A-Stroom: Klassieke vorming"; break;
            case "aalgemeen"; $studiekeuze = "A-Stroom: Algemene vorming"; break;
            case "1b"; $studiekeuze = "1B"; break;
            case "nb"; $studiekeuze = "Nog niet bepaald"; break;
        }
        
        $inschrijving_opmerking = "$studiekeuze $huidigschooljaar \n";
        asort($keuzevakken);
        foreach($keuzevakken as $vak => $nr){
            $inschrijving_opmerking .= "$vak: $nr \n";        
        }
        
        $keuzevakken = serialize($keuzevakken);
        
        $query = "SELECT studiekeuze, inschrijving_opmerking FROM loopbaan WHERE leerling_id = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        $leerling = mysql_fetch_assoc($result);
        
        $studiekeuze_db = is_array(unserialize($leerling['studiekeuze'])) ? unserialize($leerling['studiekeuze']) : array();
        $inschrijving_opmerking_db = is_array(unserialize($leerling['inschrijving_opmerking'])) ? unserialize($leerling['inschrijving_opmerking']) : array();
        
        $studiekeuze_db[$_SESSION['stroom']] = $studiekeuze;
        $inschrijving_opmerking_db[$_SESSION['stroom']] = $inschrijving_opmerking;
        
        $studiekeuze = serialize($studiekeuze_db);
        $inschrijving_opmerking = serialize($inschrijving_opmerking_db);
        
        $query = "UPDATE loopbaan SET `huidigschooljaar` = '{$huidigschooljaar}', `studiekeuze` = '{$studiekeuze}', `keuzevakken` = '{$keuzevakken}', `inschrijving_opmerking` = '{$inschrijving_opmerking}' WHERE leerling_id = '{$_SESSION['id_leerling']}'";
        query($query);
        
        return 1;
    }
        
    function save_vipinformatie($fields){
        
        $data = convert_fields_to_array($fields);


        if(array_key_exists("thuistaal_ned",$data)){
            $data['thuistaal'] = $data['thuistaal_ned'] == "Nee" ? $data['thuistaal_andere'] : "Ja";
        }

        if(array_key_exists("dubbele_afdruk",$data)){
            $query = "SELECT leerling_id FROM loopbaan WHERE leerling_id = '{$_SESSION['id_leerling']}'";
            $result = query($query);
            if(mysql_num_rows($result) == 0){
                $queryInsert = "INSERT INTO loopbaan (`leerling_id`,`dubbele_afdruk`) VALUES ('{$_SESSION['id_leerling']}','{$data['dubbele_afdruk']}')";                
                query($queryInsert);
            } else {
                $queryUpdate = "UPDATE loopbaan SET `dubbele_afdruk` = '{$data['dubbele_afdruk']}' WHERE leerling_id = '{$_SESSION['id_leerling']}'";
                query($queryUpdate);                
            }
        }

        if(array_key_exists("middag",$data)){
            
            if($data['middag'] == "soms naar huis komt"){
                $data['middag'] .= ":";
                $data['middag'] .= $data['thuis_ma'] == "YES" ? " Maandag," : "";
                $data['middag'] .= $data['thuis_di'] == "YES" ? " Dinsdag," : "";
                $data['middag'] .= $data['thuis_wo'] == "YES" ? " Woensdag," : "";
                $data['middag'] .= $data['thuis_do'] == "YES" ? " Donderdag," : "";
                $data['middag'] .= $data['thuis_vr'] == "YES" ? " Vrijdag," : "";
                $data['middag'] = substr($data['middag'],0,-1);
            }
                        
        }
        
        $not_automatic = array("undefined","dubbele_afdruk","thuis_ma","thuis_di","thuis_wo","thuis_do","thuis_vr");
        
        foreach($data as $key => $value){
            $data[$key] = mysql_real_escape_string($value);
        }
        
        $query = "SELECT id_leerling FROM vip WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        if(mysql_num_rows($result) == 0){    
            $query = "INSERT INTO vip (`id_leerling`,";
            foreach($data as $key => $val){
                if(in_array($key,$not_automatic)) continue;
                if($key != "thuistaal_andere" && $key != "thuistaal_ned" && $key != "")
                    $query .= "`{$key}`, ";        
            }
            $query = substr($query,0,-2) . ") VALUES ('{$_SESSION['id_leerling']}',";
            foreach($data as $key => $val){
                if(in_array($key,$not_automatic)) continue;
                if($key != "thuistaal_andere" && $key != "thuistaal_ned" && $key != "")
                    $query .= "'{$val}', ";
            }
            $query = substr($query,0,-2) . ")";
        } else {
            $query = "UPDATE vip SET ";
            foreach($data as $key => $val){
                if(in_array($key,$not_automatic)) continue;
                if($key != "thuistaal_andere" && $key != "thuistaal_ned" && $key != "")
                    $query .= " `{$key}` = '{$val}', ";
            }
            $query =  substr($query,0,-2) . " WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        }
        
        return query($query);
        
        
        
    }
    
    function save_gok($fields){
        
        $data = convert_fields_to_array($fields);
        
        
        $opleidingsniveaus = array(
            "1" => "lager onderwijs niet afgemaakt.",
            "2" => "lager onderwijs afgewerkt. Zowel gewoon als buitengewoon lager onderwijs komen hiervoor in aanmerking",
            "3" => "lager secundair onderwijs afgewerkt. Dit is een diploma, getuigschrift of attest van slagen van de eerste 3 jaren van het gewoon of buitengewoon onderwijs (bijvoorbeeld A3,A4 of B3) of een getuigschrift van het deeltijds beroepssecundair onderwijs of van de leertijd (leercontract VIZO/Syntra).",
            "4" => "hoger secundair onderwijs afgewerkt. Dit is een diploma of getuigschrift van het hoger secundair onderwijs ASO, TSO, KSO, BSO, A2, B2, HSTL, of een diploma van de vierde graad BSO. Buitengewoon secundair onderwijs komt hiervoor niet in aanmerking.",
            "5" => "hoger onderwijs afgewerkt. Dit is een diploma van een hogeschool of van een universiteit, bijvoorbeeld A1, B1, gegradueerde, licentraat, ingenieur, doctor, master, bachelor."        
        );
        
        
        $data['gok_moeder_edison_spreektaal'] = $data['gok_moeder_edison_spreektaal'] == "Een andere taal" ? $data['taal_moeder_andere'] : $data['gok_moeder_edison_spreektaal'];
        $data['gok_vader_edison_spreektaal'] = $data['gok_vader_edison_spreektaal'] == "Een andere taal" ? $data['taal_vader_andere'] : $data['gok_vader_edison_spreektaal'];
        $data['gok_broer_zus_edison_spreektaal'] = $data['gok_broer_zus_edison_spreektaal'] == "Een andere taal" ? $data['taal_broer_zus_andere'] : $data['gok_broer_zus_edison_spreektaal'];
        $data['gok_vrienden_edison_spreektaal'] = $data['gok_vrienden_edison_spreektaal'] == "Een andere taal" ? $data['taal_vrienden_andere'] : $data['gok_vrienden_edison_spreektaal'];
        
        if(array_key_exists('gok_edison_opleidingsniveau_moeder',$data)){
            $query = "UPDATE loopbaan SET
                `gok_edison_opleidingsniveau_moeder` = '{$opleidingsniveaus[$data['gok_edison_opleidingsniveau_moeder']]}'
                    WHERE leerling_id = '{$_SESSION['id_leerling']}'";            
        } else {
            $query = "UPDATE loopbaan SET
                `gok_moeder_edison_spreektaal` = '{$data['gok_moeder_edison_spreektaal']}',
                `gok_vader_edison_spreektaal` = '{$data['gok_vader_edison_spreektaal']}',
                `gok_broer_zus_edison_spreektaal` = '{$data['gok_broer_zus_edison_spreektaal']}',
                `gok_vrienden_edison_spreektaal` = '{$data['gok_vrienden_edison_spreektaal']}'
                    WHERE leerling_id = '{$_SESSION['id_leerling']}'";            
        }                  
        
        return query($query);        
    }
    
    function save_baso($baso){
        
        $query = "UPDATE loopbaan SET `toestemming_baso_werking` = '{$baso}' WHERE leerling_id = '{$_SESSION['id_leerling']}'";
        echo query($query);
        
    }
    
    function volgnummer_toekennen_a(){
        
        $query = "INSERT INTO leerlingen (`naam`) VALUES ('')";
        query($query);
        $_SESSION['id_leerling'] = mysql_insert_id();
                                    
        $query = "SELECT volgnummer FROM inschrijving WHERE stroom = 'A' ORDER BY volgnummer ASC";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){            
            $volgnummers[$row['volgnummer']] = "YES";            
        }
        
        $query = "SELECT volgnummer FROM inschrijving WHERE stroom = 'A' ORDER BY volgnummer DESC LIMIT 0,1";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){            
            $maxNummer = $row['volgnummer'];
        }
        
        $volgnummer = 0;
        $continue = 1;
        for($i=1;$i<=$maxNummer;$i++){
            if($continue == 0) continue;
            if(!array_key_exists($i,$volgnummers)){
             $volgnummer = $i;
             $continue = 0;
            }
        }
        
        $volgnummer = $volgnummer == 0 ? $maxNummer + 1 : $volgnummer; 

        $date = date("Y-m-d H:i");
        $query = "INSERT INTO inschrijving (`id_leerling`,`volgnummer`,`stroom`,`voorinschrijving`,`voor_ingeschreven_door`,`datum`) VALUES ('{$_SESSION['id_leerling']}','{$volgnummer}','A','1','{$_SESSION['gebruiker']['id']}','{$date}')";
        query($query);
        
        $_SESSION['id_inschrijving'] = mysql_insert_id();
        
        $_SESSION['volgnummer_a'] = $volgnummer;
        
        return $_SESSION['id_leerling'];

        
        
    }
    
    function get_nieuw_volgnummer($stroom,$deletevorig){

        if($deletevorig == "YES" && isset($_SESSION['id_inschrijving'])){
            $query = "DELETE FROM inschrijving WHERE id_inschrijving = '{$_SESSION['id_inschrijving']}' AND stroom = '$stroom'";
            $query = "DELETE FROM leerlingen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
            $query = "DELETE FROM loopbaan WHERE leerling_id = '{$_SESSION['id_leerling']}'";
            $query = "DELETE FROM moeder WHERE id_leerling = '{$_SESSION['id_leerling']}'";
            $query = "DELETE FROM vader WHERE id_leerling = '{$_SESSION['id_leerling']}'";
            $query = "DELETE FROM vip WHERE id_leerling = '{$_SESSION['id_leerling']}'";
            query($query);           
        }
        
        $query = "INSERT INTO leerlingen (`naam`) VALUES ('')";
        query($query);
        $_SESSION['id_leerling'] = mysql_insert_id();
                         
        $query = "SELECT volgnummer FROM inschrijving WHERE stroom = '{$stroom}' ORDER BY volgnummer ASC";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){            
            $volgnummers[$row['volgnummer']] = "YES";            
        }
        
        $query = "SELECT volgnummer FROM inschrijving WHERE stroom = '{$stroom}' ORDER BY volgnummer DESC LIMIT 0,1";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){            
            $maxNummer = $row['volgnummer'];
        }
        
        
        $volgnummer = 0;
        $continue = 1;
        for($i=1;$i<=$maxNummer;$i++){
            if($continue == 0) continue;
            if(!array_key_exists($i,$volgnummers)){
             $volgnummer = $i;
             $continue = 0;
            }
        }
        
        $volgnummer = $volgnummer == 0 ? $maxNummer + 1 : $volgnummer; 
                
        $date = date("Y-m-d H:i");
        
        $query = "INSERT INTO inschrijving (`id_leerling`,`volgnummer`,`stroom`,`definschrijving`,`def_ingeschreven_door`,`datum`) VALUES ('{$_SESSION['id_leerling']}','{$volgnummer}','{$stroom}','1','{$_SESSION['gebruiker']['id']}','{$date}')";
        query($query);
        
        $_SESSION['id_inschrijving'] = mysql_insert_id();
        
        $_SESSION['volgnummer'] = $volgnummer;
                
        return  $_SESSION['id_leerling'];
        
        
    }
    
    function convert_fields_to_array($fields){
        $data = array();
        
        $lijnen = explode("@@@",$fields);        
        foreach($lijnen as $lijn){            
            $a = explode("###",$lijn);                        
            $data[$a[0]] = $a[1];            
        }
        
        return $data;
    }
    
    function search_lagere_scholen($postcode){

        $query = "SELECT * FROM scholen WHERE postcode = '{$postcode}'";
        $result = query($query);
    
        $return = "<div style=\"margin-top: 20px;\">";
        $return .= "<p>Volgende scholen zijn gevonden met postcode <strong> $postcode </strong></p>";
        
        $return .= "<div style=\"overflow-y:scroll;height:200px;\">";
        $return .= "<table class=\"opties\">";    
        while($row = mysql_fetch_assoc($result)){
            
            $return .= "<tr style=\"cursor: pointer;\" class=\"school_suggestie\" pc=\"{$postcode}\" gemeente=\"{$row['gemeente']}\" naam=\"{$row['naam']}\" id=\"{$row['id']}\"><td>{$row['naam']}</td><td>{$row['straat']}</td></tr>";            
        }
        $return .= "</table>";
        $return .= "</div>";
        $return .= "</div>";
    
        return $return;    
    }
    
    function check_if_session_leerling_exists(){        
        return $_SESSION['id_leerling'];
    }
    

    
    
    function save_vip_gezondheidsproblemen_omschrijving($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_gezondheidsproblemen SET 
                    `omschrijving` = '{$fields['omschrijving']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }        
    function load_vip_gezondheidsproblemen_omschrijving(){
                
        $query2 = "SELECT omschrijving FROM vip_gezondheidsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result2 = query($query2);
        while($row2 = mysql_fetch_assoc($result2)){
                    
            $replacements = array(
                "[OMSCHRIJVING]" => $row2['omschrijving']
            );                
                                    
        }
        
        $return = file_get_contents("app/views/forms/vip_gezondheidsproblemen/omschrijving.tpl");
        foreach($replacements as $search => $replace){
            $return = str_replace($search,$replace,$return);
        }                        
        
        
        return $return;               
        
    }    
    
    function save_vip_gezondheidsproblemen_klassenraad($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_gezondheidsproblemen SET 
                    `klassenraad` = '{$fields['klassenraad']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }        
    function load_vip_gezondheidsproblemen_klassenraad(){
                
        $query2 = "SELECT klassenraad FROM vip_gezondheidsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result2 = query($query2);
        while($row2 = mysql_fetch_assoc($result2)){
                    
            $replacements = array(
              "[CHK_KLASSENRAAD_JA]" => $row2['klassenraad'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_KLASSENRAAD_NEE]" => $row2['klassenraad'] == "Nee" ? " checked=\"checked\"" : ""
            );                
                                                
        }
        
        $return = file_get_contents("app/views/forms/vip_gezondheidsproblemen/klassenraad.tpl");
        foreach($replacements as $search => $replace){
            $return = str_replace($search,$replace,$return);
        }                        
        
        
        return $return;               
        
    }        


    function save_vip_gedragsproblemen_omschrijving($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_gedragsproblemen SET 
                    `omschrijving` = '{$fields['omschrijving']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }    

    function save_vip_andereproblemen_omschrijving($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "SELECT id FROM vip_andereproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        if(mysql_num_rows($result) > 0){
            
            $row = mysql_fetch_assoc($result);
            $opgemaakt_door = $row['opgemaakt_door'] == "" ? ", `opgemaakt_door` = '{$_SESSION['gebruiker']['naam']}'" : "";            
            
            $query = "UPDATE vip_andereproblemen SET 
                        `soort` = '{$fields['soort']}',
                        `omschrijving` = '{$fields['omschrijving']}'
                        $opgemaakt_door
                     WHERE id_leerling = '{$_SESSION['id_leerling']}'   
            ";        
        } else {
            $query = "INSERT INTO vip_andereproblemen (`id_leerling`,`soort`,`omschrijving`) VALUES ('{$_SESSION['id_leerling']}','{$fields['soort']}','{$fields['omschrijving']}')";            
        }
        $result = query($query);
        
        return $result;
        
    }    
    
    function load_vip_gedragsproblemen_omschrijving(){
                
        $query2 = "SELECT omschrijving FROM vip_gedragsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result2 = query($query2);
        while($row2 = mysql_fetch_assoc($result2)){
                    
            $replacements = array(
                "[OMSCHRIJVING]" => $row2['omschrijving']
            );                
                                    
        }
        
        $return = file_get_contents("app/views/forms/vip_gedragsproblemen/omschrijving.tpl");
        foreach($replacements as $search => $replace){
            $return = str_replace($search,$replace,$return);
        }                        
        
        
        return $return;               
        
    }    

    function load_vip_andereproblemen_omschrijving(){
                
        $query2 = "SELECT omschrijving, soort FROM vip_andereproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result2 = query($query2);
        if(mysql_num_rows($result2) > 0){
            while($row2 = mysql_fetch_assoc($result2)){
                    
                $replacements = array(
                    "[SOORT]" => $row2['soort'],
                    "[OMSCHRIJVING]" => $row2['omschrijving']
                );                
                                    
            }
        } else {
            $replacements = array(
                "[SOORT]" => "",
                "[OMSCHRIJVING]" => ""
            );                            
        }
        
        $return = file_get_contents("app/views/forms/vip_andereproblemen/omschrijving.tpl");
        foreach($replacements as $search => $replace){
            $return = str_replace($search,$replace,$return);
        }                        
        
        
        return $return;               
        
    }    
    
    function save_vip_gedragsproblemen_klassenraad($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_gedragsproblemen SET 
                    `klassenraad` = '{$fields['klassenraad']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }        

    function save_vip_andereproblemen_klassenraad($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_andereproblemen SET 
                    `klassenraad` = '{$fields['klassenraad']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }        

    function load_vip_gedragsproblemen_klassenraad(){
                
        $query2 = "SELECT klassenraad FROM vip_gedragsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result2 = query($query2);
        while($row2 = mysql_fetch_assoc($result2)){
                    
            $replacements = array(
              "[CHK_KLASSENRAAD_JA]" => $row2['klassenraad'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_KLASSENRAAD_NEE]" => $row2['klassenraad'] == "Nee" ? " checked=\"checked\"" : ""
            );                
                                                
        }
        
        $return = file_get_contents("app/views/forms/vip_gedragsproblemen/klassenraad.tpl");
        foreach($replacements as $search => $replace){
            $return = str_replace($search,$replace,$return);
        }                        
        
        
        return $return;               
        
    }        
    
    function load_vip_andereproblemen_klassenraad(){
                
        $query2 = "SELECT klassenraad FROM vip_andereproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result2 = query($query2);
        if(mysql_num_rows($result2) > 0){
            while($row2 = mysql_fetch_assoc($result2)){
                        
                $replacements = array(
                  "[CHK_KLASSENRAAD_JA]" => $row2['klassenraad'] == "Ja" ? " checked=\"checked\"" : "",
                  "[CHK_KLASSENRAAD_NEE]" => $row2['klassenraad'] == "Nee" ? " checked=\"checked\"" : ""
                );                
                                                    
            }
            
            $return = file_get_contents("app/views/forms/vip_andereproblemen/klassenraad.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
        } else {
            
            $replacements = array(
                "[CHK_KLASSENRAAD_JA]" => "",
                "[CHK_KLASSENRAAD_NEE]" => ""
            );                
            
            $return = file_get_contents("app/views/forms/vip_andereproblemen/klassenraad.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
            
        }
        
        
        return $return;               
        
    }            

    
    function save_vip_leerproblemen_klassenraad($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_leerproblemen SET 
                    `klassenraad` = '{$fields['klassenraad']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }        
    function load_vip_leerproblemen_klassenraad(){
                
        $query2 = "SELECT klassenraad FROM vip_leerproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result2 = query($query2);
        while($row2 = mysql_fetch_assoc($result2)){
                    
            $replacements = array(
              "[CHK_KLASSENRAAD_JA]" => $row2['klassenraad'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_KLASSENRAAD_NEE]" => $row2['klassenraad'] == "Nee" ? " checked=\"checked\"" : ""
            );                
                                                
        }        
        
        $return = file_get_contents("app/views/forms/vip_leerproblemen/klassenraad.tpl");
        foreach($replacements as $search => $replace){
            $return = str_replace($search,$replace,$return);
        }                        
        
        
        return $return;               
        
    }        
    
    
    
    function load_vip_leerproblemen($id_leerling){
                        
        $query = "SELECT soorten_problemen FROM vip_leerproblemen WHERE id_leerling = '{$id_leerling}'";        
        $result = query($query);
        if(mysql_num_rows($result) > 0){
            while($r = mysql_fetch_assoc($result)){
                $problemen = unserialize($r['soorten_problemen']);
                    
                $replacements = array(
                    "[chk_dyslexie]"      => array_key_exists("dyslexie",$problemen) ? " checked=\"checked\"" : "",
                    "[chk_dyscalculie]"   => array_key_exists("dyscalculie",$problemen) ? " checked=\"checked\"" : "",
                    "[chk_nld]"           => array_key_exists("NLD",$problemen) ? " checked=\"checked\"" : "",
                    "[chk_add]"           => array_key_exists("ADD",$problemen) ? " checked=\"checked\"" : "",
                    "[chk_dyspraxie]"     => array_key_exists("dyspraxie",$problemen) ? " checked=\"checked\"" : "",
                    "[andereleerproblemen_val]"            => array_key_exists("andereleerproblemen",$problemen) ? $problemen['andereleerproblemen'] : ""
                );                
            }            
        }  else {
                $replacements = array(
                    "[chk_dyslexie]"      => "",
                    "[chk_dyscalculie]"   => "",
                    "[chk_nld]"           => "",
                    "[chk_add]"           => "",
                    "[chk_dyspraxie]"     => "",
                    "[andereleerproblemen_val]"            => ""
                );            
        }
                
        $return = file_get_contents("app/views/forms/vip_leerproblemen/leerproblemen.tpl");
        foreach($replacements as $search => $replace){
            $return = str_replace($search,$replace,$return);
        }                

        return $return;
        
    }

    function load_vip_gedragsproblemen($id_leerling){
                        
        $query = "SELECT soorten_problemen FROM vip_gedragsproblemen WHERE id_leerling = '{$id_leerling}'";        
        $result = query($query);
        if(mysql_num_rows($result) > 0){
            while($r = mysql_fetch_assoc($result)){
                $problemen = unserialize($r['soorten_problemen']);
                    
                $replacements = array(
                    "[chk_gedragsstoornis]"      => array_key_exists("gedragsstoornis",$problemen) ? " checked=\"checked\"" : "",
                    "[chk_adhd]"   => array_key_exists("adhd",$problemen) ? " checked=\"checked\"" : "",
                    "[chk_hsp]"           => array_key_exists("hsp",$problemen) ? " checked=\"checked\"" : "",                    
                    "[autismespectrumstoornis_val]"            => array_key_exists("autismespectrumstoornis",$problemen) ? $problemen['autismespectrumstoornis'] : "",
                    "[anderegedragsproblemen_val]"            => array_key_exists("anderegedragsproblemen",$problemen) ? $problemen['anderegedragsproblemen'] : ""
                );                
            }            
        }  else {
                $replacements = array(
                    "[chk_gedragsstoornis]"      => "",
                    "[chk_adhd]"   => "",
                    "[chk_hsp]"           => "",                    
                    "[autismespectrumstoornis_val]"     => "",
                    "[anderegedragsproblemen_val]"            => ""
                );            
        }
                
        $return = file_get_contents("app/views/forms/vip_gedragsproblemen/gedragsproblemen.tpl");
        foreach($replacements as $search => $replace){
            $return = str_replace($search,$replace,$return);
        }                

        return $return;
        
    }
    
    
    function load_vip_gezondheidsproblemen($id_leerling){
                        
        $query = "SELECT soorten_problemen FROM vip_gezondheidsproblemen WHERE id_leerling = '{$id_leerling}'";                
        $result = query($query);
        if(mysql_num_rows($result) > 0){
            while($r = mysql_fetch_assoc($result)){
                $problemen = unserialize($r['soorten_problemen']);
                    
                $replacements = array(
                    "[chk_hartkwaal]"      => array_key_exists("hartkwaal",$problemen) ? " checked=\"checked\"" : "",
                    "[chk_kataplexie]"   => array_key_exists("kataplexie",$problemen) ? " checked=\"checked\"" : "",
                    "[chk_gehoorsproblemen]"           => array_key_exists("gehoorsproblemen",$problemen) ? " checked=\"checked\"" : "",
                    "[chk_longaandoening]"           => array_key_exists("longaandoening",$problemen) ? " checked=\"checked\"" : "",
                    "[chk_narcolepsie]"           => array_key_exists("narcolepsie",$problemen) ? " checked=\"checked\"" : "",
                    "[chk_spraakstoornis]"           => array_key_exists("spraakstoornis",$problemen) ? " checked=\"checked\"" : "",
                    "[chk_epilepsie]"           => array_key_exists("epilepsie",$problemen) ? " checked=\"checked\"" : "",
                    "[chk_gezichtsproblemen]"           => array_key_exists("gezichtsproblemen",$problemen) ? " checked=\"checked\"" : "",                    
                    "[anderegezondheidsproblemen_val]" => array_key_exists("anderegezondheidsproblemen",$problemen) ? $problemen['anderegezondheidsproblemen'] : ""
                );                
            }            
        }  else {
                $replacements = array(
                    "[chk_hartkwaal]"      => "",
                    "[chk_kataplexie]"   => "",
                    "[chk_gehoorsproblemen]"           => "",
                    "[chk_longaandoening]"           => "",
                    "[chk_narcolepsie]"     => "",
                    "[chk_spraakstoornis]"     => "",
                    "[chk_epilepsie]"     => "",
                    "[chk_gezichtsproblemen]"     => "",
                    "[anderegezondheidsproblemen_val]"            => ""
                );            
        }
                
        $return = file_get_contents("app/views/forms/vip_gezondheidsproblemen/gezondheidsproblemen.tpl");
        foreach($replacements as $search => $replace){
            $return = str_replace($search,$replace,$return);
        }                

        return $return;
        
    }    
    
    function save_vip_leerproblemen($fields){
    
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            if($key != ""){
                $leerproblemen[$key] = $val;
            }            
        }
        
        $leerproblemen = serialize($leerproblemen);
        
        $query = "SELECT id, opgemaakt_door FROM vip_leerproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        if(mysql_num_rows($result) > 0){
            $row = mysql_fetch_assoc($result);
            $opgemaakt_door = $row['opgemaakt_door'] == "" ? ", `opgemaakt_door` = '{$_SESSION['gebruiker']['naam']}'" : "";
            $query = "UPDATE vip_leerproblemen SET soorten_problemen = '{$leerproblemen}' $opgemaakt_door WHERE id_leerling = '{$_SESSION['id_leerling']}'";
            query($query);
        } else {
            $query = "INSERT INTO vip_leerproblemen (`id_leerling`,`soorten_problemen`,`opgemaakt_door`) VALUES ('{$_SESSION['id_leerling']}','{$leerproblemen}','{$_SESSION['gebruiker']['naam']}')";
            query($query);                   
        }
        
        return 1;
        
        
    }

    function save_vip_gedragsproblemen($fields){
    
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            if($key != ""){
                $leerproblemen[$key] = $val;
            }            
        }
        
        $leerproblemen = serialize($leerproblemen);
        
        $query = "SELECT id FROM vip_gedragsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        if(mysql_num_rows($result) > 0){
            $row = mysql_fetch_assoc($result);
            $opgemaakt_door = $row['opgemaakt_door'] == "" ? ", `opgemaakt_door` = '{$_SESSION['gebruiker']['naam']}'" : "";            
            $query = "UPDATE vip_gedragsproblemen SET soorten_problemen = '{$leerproblemen}' $opgemaakt_door WHERE id_leerling = '{$_SESSION['id_leerling']}'";
            query($query);
        } else {
            $query = "INSERT INTO vip_gedragsproblemen (`id_leerling`,`soorten_problemen`,`opgemaakt_door`) VALUES ('{$_SESSION['id_leerling']}','{$leerproblemen}','{$_SESSION['gebruiker']['naam']}')";
            query($query);                   
        }
        
        return 1;
        
        
    }


    function save_vip_gezondheidsproblemen($fields){
    
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            if($key != ""){
                $gezondheidsproblemen[$key] = $val;
            }            
        }
        
        $gezondheidsproblemen = serialize($gezondheidsproblemen);
        
        $query = "SELECT id FROM vip_gezondheidsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        if(mysql_num_rows($result) > 0){
            $row = mysql_fetch_assoc($result);
            $opgemaakt_door = $row['opgemaakt_door'] == "" ? ", `opgemaakt_door` = '{$_SESSION['gebruiker']['naam']}'" : "";
            $query = "UPDATE vip_gezondheidsproblemen SET soorten_problemen = '{$gezondheidsproblemen}' $opgemaakt_door WHERE id_leerling = '{$_SESSION['id_leerling']}'";
            query($query);
        } else {
            $query = "INSERT INTO vip_gezondheidsproblemen (`id_leerling`,`soorten_problemen`,`opgemaakt_door`) VALUES ('{$_SESSION['id_leerling']}','{$gezondheidsproblemen}','{$_SESSION['gebruiker']['naam']}')";
            query($query);                   
        }
        
        return 1;
        
        
    }
    
    
    function save_vip_gedragsproblemen_thuis($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_gedragsproblemen SET 
                    `gedragsproblemen_thuis` = '{$fields['gedragsproblemen_thuis']}',
                    `gedragsproblemen_thuis_welke` = '{$fields['gedragsproblemen_thuis_welke']}',                    
                    `gedragsproblemen_thuis_extra` = '{$fields['gedragsproblemen_thuis_extra']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }    
    
    function load_vip_gedragsproblemen_thuis(){
                
        $query2 = "SELECT gedragsproblemen_thuis, gedragsproblemen_thuis_welke , gedragsproblemen_thuis_extra FROM vip_gedragsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result2 = query($query2);
        while($row2 = mysql_fetch_assoc($result2)){
                    
            $replacements = array(
                "[CHK_GEDRAGSPROBLEMEN_THUIS_JA]" => $row2['gedragsproblemen_thuis'] == "Ja" ? " checked=\"checked\"" : "",
                "[CHK_GEDRAGSPROBLEMEN_THUIS_NEE]" => $row2['gedragsproblemen_thuis'] == "Nee" ? " checked=\"checked\"" : "",
                "[WELKE]" => $row2['gedragsproblemen_thuis_welke'],
                "[DISABLED]" => $row2['gedragsproblemen_thuis'] == "Ja" ? "" : " disabled",            
                "[EXTRA]" => $row2['gedragsproblemen_thuis_extra']
            );                
                                    
        }
        
    
        $return = file_get_contents("app/views/forms/vip_gedragsproblemen/gedragsproblemen_thuis.tpl");
        foreach($replacements as $search => $replace){
            $return = str_replace($search,$replace,$return);
        }                        
        
        
        return $return;               
        
    }


    function save_vip_gedragsproblemen_school($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_gedragsproblemen SET 
                    `gedragsproblemen_school` = '{$fields['gedragsproblemen_school']}',
                    `gedragsproblemen_school_welke` = '{$fields['gedragsproblemen_school_welke']}',                    
                    `gedragsproblemen_school_extra` = '{$fields['gedragsproblemen_school_extra']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }    
    
    function load_vip_gedragsproblemen_school(){
                
        $query2 = "SELECT gedragsproblemen_school, gedragsproblemen_school_welke , gedragsproblemen_school_extra FROM vip_gedragsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result2 = query($query2);
        while($row2 = mysql_fetch_assoc($result2)){
                    
            $replacements = array(
                "[CHK_GEDRAGSPROBLEMEN_SCHOOL_JA]" => $row2['gedragsproblemen_school'] == "Ja" ? " checked=\"checked\"" : "",
                "[CHK_GEDRAGSPROBLEMEN_SCHOOL_NEE]" => $row2['gedragsproblemen_school'] == "Nee" ? " checked=\"checked\"" : "",
                "[WELKE]" => $row2['gedragsproblemen_school_welke'],
                "[DISABLED]" => $row2['gedragsproblemen_school'] == "Ja" ? "" : " disabled",            
                "[EXTRA]" => $row2['gedragsproblemen_school_extra']
            );                
                                    
        }
        
    
        $return = file_get_contents("app/views/forms/vip_gedragsproblemen/gedragsproblemen_school.tpl");
        foreach($replacements as $search => $replace){
            $return = str_replace($search,$replace,$return);
        }                        
        
        
        return $return;               
        
    }
    
    
    function load_vip_begeleiding_gedragsproblemen(){
        
        $query = "SELECT begeleiding, begeleiding_wanneer, begeleiding_waar, begeleiding_nunog, begeleiding_extra FROM vip_gedragsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            $replacements = array(
              "[CHK_BEGELEIDING_JA]" => $row['begeleiding'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_BEGELEIDING_NEE]" => $row['begeleiding'] == "Nee" ? " checked=\"checked\"" : "",
              "[WANNEER]" => $row['begeleiding_wanneer'],
              "[WAAR]" => $row['begeleiding_waar'],
              "[CHK_BEGELEIDING_NUNOG_JA]" => $row['begeleiding_nunog'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_BEGELEIDING_NUNOG_NEE]" => $row['begeleiding_nunog'] == "Nee" ? " checked=\"checked\"" : "",
              "[DISABLED]" => $row['begeleiding'] == "Ja" ? "" : " disabled",              
              "[EXTRA]" => $row['begeleiding_extra']
            );                
            
            $return = file_get_contents("app/views/forms/vip_gedragsproblemen/begeleiding.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;               
        
    }
    
    function save_vip_begeleiding_gedragsproblemen($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_gedragsproblemen SET 
                    `begeleiding` = '{$fields['begeleiding']}',
                    `begeleiding_wanneer` = '{$fields['begeleiding_wanneer']}',                    
                    `begeleiding_waar` = '{$fields['begeleiding_waar']}',                    
                    `begeleiding_nunog` = '{$fields['begeleiding_nunog']}',                    
                    `begeleiding_extra` = '{$fields['begeleiding_extra']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }

    function load_vip_attesten_gedragsproblemen(){
        
        $query = "SELECT attesten, attesten_extra FROM vip_gedragsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            $replacements = array(
              "[CHK_ATTESTEN_JA]" => $row['attesten'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_ATTESTEN_NEE]" => $row['attesten'] == "Nee" ? " checked=\"checked\"" : "",
              "[DISABLED_ATTTESTEN_JA_CON]" => $row['attesten'] == "Ja" ? "" : " style=\"display:none;\"",              
              "[DISABLED_ATTTESTEN_NEE_CON]" => $row['attesten'] == "Nee" ? "" : " style=\"display:none;\""
            );                
            
            $return = file_get_contents("app/views/forms/vip_gedragsproblemen/attesten.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;               
        
    }

    function load_vip_attesten_andereproblemen(){
        
        $query = "SELECT attesten, attesten_extra FROM vip_andereproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        if(mysql_num_rows($result) > 0 ){
            while($row = mysql_fetch_assoc($result)){
                
                $replacements = array(
                  "[CHK_ATTESTEN_JA]" => $row['attesten'] == "Ja" ? " checked=\"checked\"" : "",
                  "[CHK_ATTESTEN_NEE]" => $row['attesten'] == "Nee" ? " checked=\"checked\"" : "",
                  "[DISABLED_ATTTESTEN_JA_CON]" => $row['attesten'] == "Ja" ? "" : " style=\"display:none;\"",              
                  "[DISABLED_ATTTESTEN_NEE_CON]" => $row['attesten'] == "Nee" ? "" : " style=\"display:none;\""
                );                
                
                $return = file_get_contents("app/views/forms/vip_andereproblemen/attesten.tpl");
                foreach($replacements as $search => $replace){
                    $return = str_replace($search,$replace,$return);
                }                        
                
            }
        } else {
                $replacements = array(
                  "[CHK_ATTESTEN_JA]" => "",
                  "[CHK_ATTESTEN_NEE]" => "",
                  "[DISABLED_ATTTESTEN_JA_CON]" => "",
                  "[DISABLED_ATTTESTEN_NEE_CON]" => ""
                );                
                
                $return = file_get_contents("app/views/forms/vip_andereproblemen/attesten.tpl");
                foreach($replacements as $search => $replace){
                    $return = str_replace($search,$replace,$return);
                }                                    
        }
        
        return $return;               
        
    }

    
    function save_vip_attesten_gedragsproblemen($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $extra = "";
        if($fields['attesten'] != ""){
            $extra = $fields['attesten'] == "Nee" ? $fields['attesten_extra_nee'] : $fields['attesten_extra_ja'];
        }
        
        $query = "UPDATE vip_gedragsproblemen SET 
                    `attesten` = '{$fields['attesten']}',
                    `attesten_extra` = '{$extra}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }
    
    function save_vip_attesten_andereproblemen($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $extra = "";
        if($fields['attesten'] != ""){
            $extra = $fields['attesten'] == "Nee" ? $fields['attesten_extra_nee'] : $fields['attesten_extra_ja'];
        }
        
        $query = "UPDATE vip_andereproblemen SET 
                    `attesten` = '{$fields['attesten']}',
                    `attesten_extra` = '{$extra}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }
    
    function load_vip_gesprekken_gedragsproblemen(){
        
        $query = "SELECT gesprek_clb, gesprek_titularis FROM vip_gedragsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            $replacements = array(
              "[CHK_CLB_JA]" => $row['gesprek_clb'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_CLB_NEE]" => $row['gesprek_clb'] == "Nee" ? " checked=\"checked\"" : "",
              "[CHK_TITULARIS_JA]" => $row['gesprek_titularis'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_TITULARIS_NEE]" => $row['gesprek_titularis'] == "Nee" ? " checked=\"checked\"" : "",
            );                
            
            $return = file_get_contents("app/views/forms/vip_gedragsproblemen/gesprekken.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;               
        
    }
    
    function load_vip_gesprekken_andereproblemen(){
        
        $query = "SELECT gesprek_clb, gesprek_titularis FROM vip_andereproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){
            
                $replacements = array(
                  "[CHK_CLB_JA]" => $row['gesprek_clb'] == "Ja" ? " checked=\"checked\"" : "",
                  "[CHK_CLB_NEE]" => $row['gesprek_clb'] == "Nee" ? " checked=\"checked\"" : "",
                  "[CHK_TITULARIS_JA]" => $row['gesprek_titularis'] == "Ja" ? " checked=\"checked\"" : "",
                  "[CHK_TITULARIS_NEE]" => $row['gesprek_titularis'] == "Nee" ? " checked=\"checked\"" : "",
                );                
                
                $return = file_get_contents("app/views/forms/vip_andereproblemen/gesprekken.tpl");
                foreach($replacements as $search => $replace){
                    $return = str_replace($search,$replace,$return);
                }                        
            }
            
        } else {
            
            $replacements = array(
              "[CHK_CLB_JA]" => "",
              "[CHK_CLB_NEE]" => "",
              "[CHK_TITULARIS_JA]" => "",
              "[CHK_TITULARIS_NEE]" => ""
            );                
            
            $return = file_get_contents("app/views/forms/vip_andereproblemen/gesprekken.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;               
        
    }    
    
    function save_vip_gesprekken_gedragsproblemen($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_gedragsproblemen SET 
                    `gesprek_clb` = '{$fields['gesprekken_clb']}',
                    `gesprek_titularis` = '{$fields['gesprekken_titularis']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }    
    

    function save_vip_gesprekken_andereproblemen($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_andereproblemen SET 
                    `gesprek_clb` = '{$fields['gesprekken_clb']}',
                    `gesprek_titularis` = '{$fields['gesprekken_titularis']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }        

    function load_vip_omgang_gedragsproblemen(){
        
        $query = "SELECT omgang FROM vip_gedragsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            $replacements = array(
              "[OMGANG]" => $row['omgang']
            );                
            
            $return = file_get_contents("app/views/forms/vip_gedragsproblemen/omgang.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;               
        
    }
    
    function save_vip_omgang_gedragsproblemen($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_gedragsproblemen SET                     
                    `omgang` = '{$fields['omgang']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }


  
    function save_vip_jaaroverdoen($fields){
        
        $fields = convert_fields_to_array($fields);

        $query = "UPDATE vip_leerproblemen SET 
                    `jaar_overgedaan` = '{$fields['jaaroverdoen']}',
                    `jaar_overgedaan_leerjaar` = '{$fields['jaaroverdoen_leerjaar']}',
                    `jaar_overgedaan_reden` = '{$fields['jaaroverdoen_reden']}',
                    `jaar_overgedaan_extra` = '{$fields['jaaroverdoen_extra']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }        
    
    function load_vip_jaaroverdoen(){
        
        $query = "SELECT jaar_overgedaan, jaar_overgedaan_leerjaar, jaar_overgedaan_reden, jaar_overgedaan_extra FROM vip_leerproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            if($row['jaar_overgedaan'] == ""){
                $query2 = "SELECT heeft_jaar_moeten_overdoen, jaar_overdoen_welke FROM vip WHERE id_leerling = '{$_SESSION['id_leerling']}'";                
                $result2 = query($query2);
                while($row2 = mysql_fetch_assoc($result2)){
                    $replacements = array(
                      "[CHK_OVERDOEN_JA]" => $row2['heeft_jaar_moeten_overdoen'] == "Ja" ? " checked=\"checked\"" : "",
                      "[CHK_OVERDOEN_NEE]" => $row2['heeft_jaar_moeten_overdoen'] == "Nee" ? " checked=\"checked\"" : "",
                      "[LEERJAAR]" => $row2['jaar_overdoen_welke'] != "" ? $row2['jaar_overdoen_welke'] : "",
                      "[DISABLED]" => $row2['heeft_jaar_moeten_overdoen'] == "Ja" ? "" : " disabled",
                      "[REDEN]" => "",                   
                      "[EXTRA]" => ""
                    );
                }
            } else {
                    $replacements = array(
                      "[CHK_OVERDOEN_JA]" => $row['jaar_overgedaan'] == "Ja" ? " checked=\"checked\"" : "",
                      "[CHK_OVERDOEN_NEE]" => $row['jaar_overgedaan'] == "Nee" ? " checked=\"checked\"" : "",
                      "[LEERJAAR]" => $row['jaar_overgedaan_leerjaar'],
                      "[DISABLED]" => $row['jaar_overgedaan'] == "Ja" ? "" : " disabled",
                      "[REDEN]" => $row['jaar_overgedaan_reden'],
                      "[EXTRA]" => $row['jaar_overgedaan_extra']
                    );                
            }
            
            $return = file_get_contents("app/views/forms/vip_leerproblemen/jaaroverdoen.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;        
    }
    
    function save_vip_bijkomendeinformatie($fields){
        
        $fields = convert_fields_to_array($fields);

        $query = "UPDATE vip_gezondheidsproblemen SET 
                    `bijkomende_informatie` = '{$fields['bijkomende_informatie']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }

    function load_vip_bijkomendeinformatie(){
        
        $query = "SELECT bijkomende_informatie FROM vip_gezondheidsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            $replacements = array(
                "[BIJKOMENDE_INFORMATIE]" => $row['bijkomende_informatie']
            );                
            
            $return = file_get_contents("app/views/forms/vip_gezondheidsproblemen/bijkomendeinformatie.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;        
    }
    
    function save_vip_signalen($fields){
        
        $fields = convert_fields_to_array($fields);

        $query = "UPDATE vip_gezondheidsproblemen SET 
                    `signalen` = '{$fields['signalen']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }

    function load_vip_signalen(){
        
        $query = "SELECT signalen FROM vip_gezondheidsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            $replacements = array(
                "[SIGNALEN]" => $row['signalen']
            );                
            
            $return = file_get_contents("app/views/forms/vip_gezondheidsproblemen/signalen.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;        
    }


    function save_vip_watzekerdoen($fields){
        
        $fields = convert_fields_to_array($fields);

        $query = "UPDATE vip_gezondheidsproblemen SET 
                    `wat_zeker_doen` = '{$fields['watzekerdoen']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }

    function load_vip_watzekerdoen(){
        
        $query = "SELECT wat_zeker_doen FROM vip_gezondheidsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            $replacements = array(
                "[WATZEKERDOEN]" => $row['wat_zeker_doen']
            );                
            
            $return = file_get_contents("app/views/forms/vip_gezondheidsproblemen/watzekerdoen.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;        
    }


    function save_vip_watzekernietdoen($fields){
        
        $fields = convert_fields_to_array($fields);

        $query = "UPDATE vip_gezondheidsproblemen SET 
                    `wat_zeker_niet_doen` = '{$fields['watzekernietdoen']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }

    function load_vip_watzekernietdoen(){
        
        $query = "SELECT wat_zeker_niet_doen FROM vip_gezondheidsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            $replacements = array(
                "[WATZEKERNIETDOEN]" => $row['wat_zeker_niet_doen']
            );                
            
            $return = file_get_contents("app/views/forms/vip_gezondheidsproblemen/watzekernietdoen.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;        
    }
    
    function load_vip_gezondheidsproblemen_attesten(){
        
        $query = "SELECT attesten, attesten_extra FROM vip_gezondheidsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            $replacements = array(
              "[CHK_ATTESTEN_JA]" => $row['attesten'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_ATTESTEN_NEE]" => $row['attesten'] == "Nee" ? " checked=\"checked\"" : "",
              "[DISABLED_ATTTESTEN_JA_CON]" => $row['attesten'] == "Ja" ? "" : " style=\"display:none;\"",              
              "[DISABLED_ATTTESTEN_NEE_CON]" => $row['attesten'] == "Nee" ? "" : " style=\"display:none;\""
            );                
            
            $return = file_get_contents("app/views/forms/vip_gezondheidsproblemen/attesten.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;               
        
    }
    
    function save_vip_gezondheidsproblemen_attesten($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $extra = "";
        if($fields['attesten'] != ""){
            $extra = $fields['attesten'] == "Nee" ? $fields['attesten_extra_nee'] : $fields['attesten_extra_ja'];
        }
        
        $query = "UPDATE vip_gezondheidsproblemen SET 
                    `attesten` = '{$fields['attesten']}',
                    `attesten_extra` = '{$extra}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }
    
    function load_vip_gezondheidsproblemen_gesprekken(){
        
        $query = "SELECT gesprek_clb, gesprek_titularis FROM vip_gezondheidsproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            $replacements = array(
              "[CHK_CLB_JA]" => $row['gesprek_clb'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_CLB_NEE]" => $row['gesprek_clb'] == "Nee" ? " checked=\"checked\"" : "",
              "[CHK_TITULARIS_JA]" => $row['gesprek_titularis'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_TITULARIS_NEE]" => $row['gesprek_titularis'] == "Nee" ? " checked=\"checked\"" : "",
            );                
            
            $return = file_get_contents("app/views/forms/vip_gezondheidsproblemen/gesprekken.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;               
        
    }
    
    function save_vip_gezondheidsproblemen_gesprekken($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_gezondheidsproblemen SET 
                    `gesprek_clb` = '{$fields['gesprekken_clb']}',
                    `gesprek_titularis` = '{$fields['gesprekken_titularis']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }
    
    
    
    function load_vip_vakgebonden(){
        
        $query = "SELECT vakgebonden, vakgebonden_vakken, vakgebonden_soort, vakgebonden_extra, maakt_gebruik_van_pc, maakt_gebruik_van_pc_programmas FROM vip_leerproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            $replacements = array(            
              "[CHK_MAAKTGEBRUIKVANPC_JA]" => $row['maakt_gebruik_van_pc'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_MAAKTGEBRUIKVANPC_NEE]" => $row['maakt_gebruik_van_pc'] == "Nee" ? " checked=\"checked\"" : "",
              "[DISABLED_MAAKTGEBRUIKVANPC]" => $row['maakt_gebruik_van_pc'] != "Ja" ? " disabled" : "",
              "[MAAKTGEBRUIKVANPC_PROGRAMMAS]" => $row['maakt_gebruik_van_pc_programmas'],
              
              "[CHK_VAKGEBONDEN_JA]" => $row['vakgebonden'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_VAKGEBONDEN_NEE]" => $row['vakgebonden'] == "Nee" ? " checked=\"checked\"" : "",
              "[VAKKEN]" => $row['vakgebonden_vakken'],
              "[DISABLED]" => $row['vakgebonden'] == "Ja" ? "" : " disabled",
              "[SOORT]" => $row['vakgebonden_soort'],
              "[EXTRA]" => $row['vakgebonden_extra']
            );                
            
            $return = file_get_contents("app/views/forms/vip_leerproblemen/vakgebonden.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;               
        
    }
    
    function save_vip_vakgebonden($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_leerproblemen SET 
                    `vakgebonden` = '{$fields['vakgebonden']}',
                    `vakgebonden_vakken` = '{$fields['vakgebonden_vakken']}',
                    `vakgebonden_soort` = '{$fields['vakgebonden_soort']}',
                    `vakgebonden_extra` = '{$fields['vakgebonden_extra']}',
                    `maakt_gebruik_van_pc` = '{$fields['maakt_gebruik_van_pc']}',
                    `maakt_gebruik_van_pc_programmas` = '{$fields['maakt_gebruik_van_pc_programmas']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }
    
    function load_vip_gedragsproblemen_leerproblemen(){
        
        $query = "SELECT gedragsproblemen, gedragsproblemen_extra FROM vip WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            if($row['gedragsproblemen'] == "Ja"){        

                $replacements = array(
                  "[CHK_GEDRAGSPROBLEMEN_JA]" => $row['gedragsproblemen'] == "Ja" ? " checked=\"checked\"" : "",
                  "[CHK_GEDRAGSPROBLEMEN_NEE]" => $row['gedragsproblemen'] == "Nee" ? " checked=\"checked\"" : "",
                  "[WELKE]" => $row['gedragsproblemen_extra'],
                  "[DISABLED]" => $row['gedragsproblemen'] == "Ja" ? "" : " disabled",            
                  "[EXTRA]" => ""
                );                

                
            } else {        

                $query2 = "SELECT gedragsproblemen, gedragsproblemen_welke , gedragsproblemen_extra FROM vip_leerproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
                $result2 = query($query2);
                while($row2 = mysql_fetch_assoc($result2)){
                    
                    $replacements = array(
                      "[CHK_GEDRAGSPROBLEMEN_JA]" => $row2['gedragsproblemen'] == "Ja" ? " checked=\"checked\"" : "",
                      "[CHK_GEDRAGSPROBLEMEN_NEE]" => $row2['gedragsproblemen'] == "Nee" ? " checked=\"checked\"" : "",
                      "[WELKE]" => $row2['gedragsproblemen_welke'],
                      "[DISABLED]" => $row2['gedragsproblemen'] == "Ja" ? "" : " disabled",            
                      "[EXTRA]" => $row2['gedragsproblemen_extra']
                    );                
                                    
                }

                
            }
        }
                
        $return = file_get_contents("app/views/forms/vip_leerproblemen/gedragsproblemen.tpl");
        foreach($replacements as $search => $replace){
            $return = str_replace($search,$replace,$return);
        }                        
        
        
        return $return;               
        
    }
    
    function save_vip_gedragsproblemen_leerproblemen($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_leerproblemen SET 
                    `gedragsproblemen` = '{$fields['gedragsproblemen']}',
                    `gedragsproblemen_welke` = '{$fields['gedragsproblemen_welke']}',                    
                    `gedragsproblemen_extra` = '{$fields['gedragsproblemen_extra']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }    

    function load_vip_taakleraar_lo(){
        
        $query = "SELECT taakleraar_lo, taakleraar_lo_reden, taakleraar_lo_extra FROM vip_leerproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            $replacements = array(
              "[CHK_TAAKLERAAR_LO_JA]" => $row['taakleraar_lo'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_TAAKLERAAR_LO_NEE]" => $row['taakleraar_lo'] == "Nee" ? " checked=\"checked\"" : "",
              "[REDEN]" => $row['taakleraar_lo_reden'],
              "[DISABLED]" => $row['taakleraar_lo'] == "Ja" ? "" : " disabled",              
              "[EXTRA]" => $row['taakleraar_lo_extra']
            );                
            
            $return = file_get_contents("app/views/forms/vip_leerproblemen/taakleraar_lo.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;               
        
    }
    
    function save_vip_taakleraar_lo($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_leerproblemen SET 
                    `taakleraar_lo` = '{$fields['taakleraar_lo']}',
                    `taakleraar_lo_reden` = '{$fields['taakleraar_lo_reden']}',                    
                    `taakleraar_lo_extra` = '{$fields['taakleraar_lo_extra']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }
        
    function load_vip_begeleiding(){
        
        $query = "SELECT begeleiding, begeleiding_wanneer, begeleiding_waar, begeleiding_nunog, begeleiding_extra FROM vip_leerproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            $replacements = array(
              "[CHK_BEGELEIDING_JA]" => $row['begeleiding'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_BEGELEIDING_NEE]" => $row['begeleiding'] == "Nee" ? " checked=\"checked\"" : "",
              "[WANNEER]" => $row['begeleiding_wanneer'],
              "[WAAR]" => $row['begeleiding_waar'],
              "[CHK_BEGELEIDING_NUNOG_JA]" => $row['begeleiding_nunog'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_BEGELEIDING_NUNOG_NEE]" => $row['begeleiding_nunog'] == "Nee" ? " checked=\"checked\"" : "",
              "[DISABLED]" => $row['begeleiding'] == "Ja" ? "" : " disabled",              
              "[EXTRA]" => $row['begeleiding_extra']
            );                
            
            $return = file_get_contents("app/views/forms/vip_leerproblemen/begeleiding.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;               
        
    }
    
    function save_vip_begeleiding($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_leerproblemen SET 
                    `begeleiding` = '{$fields['begeleiding']}',
                    `begeleiding_wanneer` = '{$fields['begeleiding_wanneer']}',                    
                    `begeleiding_waar` = '{$fields['begeleiding_waar']}',                    
                    `begeleiding_nunog` = '{$fields['begeleiding_nunog']}',                    
                    `begeleiding_extra` = '{$fields['begeleiding_extra']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }

    function load_vip_attesten(){
        
        $query = "SELECT attesten, attesten_extra FROM vip_leerproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            $replacements = array(
              "[CHK_ATTESTEN_JA]" => $row['attesten'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_ATTESTEN_NEE]" => $row['attesten'] == "Nee" ? " checked=\"checked\"" : "",
              "[DISABLED_ATTTESTEN_JA_CON]" => $row['attesten'] == "Ja" ? "" : " style=\"display:none;\"",              
              "[DISABLED_ATTTESTEN_NEE_CON]" => $row['attesten'] == "Nee" ? "" : " style=\"display:none;\""
            );                
            
            $return = file_get_contents("app/views/forms/vip_leerproblemen/attesten.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;               
        
    }
    
    function save_vip_attesten($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $extra = "";
        if($fields['attesten'] != ""){
            $extra = $fields['attesten'] == "Nee" ? $fields['attesten_extra_nee'] : $fields['attesten_extra_ja'];
        }
        
        $query = "UPDATE vip_leerproblemen SET 
                    `attesten` = '{$fields['attesten']}',
                    `attesten_extra` = '{$extra}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }
    
    function load_vip_gesprekken(){
        
        $query = "SELECT gesprek_clb, gesprek_titularis FROM vip_leerproblemen WHERE id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            $replacements = array(
              "[CHK_CLB_JA]" => $row['gesprek_clb'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_CLB_NEE]" => $row['gesprek_clb'] == "Nee" ? " checked=\"checked\"" : "",
              "[CHK_TITULARIS_JA]" => $row['gesprek_titularis'] == "Ja" ? " checked=\"checked\"" : "",
              "[CHK_TITULARIS_NEE]" => $row['gesprek_titularis'] == "Nee" ? " checked=\"checked\"" : "",
            );                
            
            $return = file_get_contents("app/views/forms/vip_leerproblemen/gesprekken.tpl");
            foreach($replacements as $search => $replace){
                $return = str_replace($search,$replace,$return);
            }                        
            
        }
        
        return $return;               
        
    }
    
    function save_vip_gesprekken($fields){
        $fields = convert_fields_to_array($fields);
        
        foreach($fields as $key => $val){
            $fields[$key] = mysql_real_escape_string($val);
        }
        
        $query = "UPDATE vip_leerproblemen SET 
                    `gesprek_clb` = '{$fields['gesprekken_clb']}',
                    `gesprek_titularis` = '{$fields['gesprekken_titularis']}'
                 WHERE id_leerling = '{$_SESSION['id_leerling']}'   
        ";        
        $result = query($query);
        
        return $result;
        
    }
    
    function save_ooka_inschrijving($keuzevakken,$studiekeuze){
        
        $keuzevakken = convert_fields_to_array($keuzevakken);
        
        $query = "SELECT volgnummer FROM inschrijving WHERE stroom = 'A' AND id_leerling = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        if(mysql_num_rows($result) > 0){ // als er al een a stroom bestaat voor de leerling
            $leerling = mysql_fetch_assoc($result);
            
            $query = "UPDATE inschrijving SET definschrijving = '1', def_ingeschreven_door = '{$_SESSION['gebruiker']['id']}' WHERE id_leerling = '{$_SESSION['id_leerling']}' AND stroom = 'A'";
            $return = query($query);
            
            $_SESSION['volgnummer_a'] = $leerling['volgnummer'];
        } else { // anders volgend volgnummer voor a stroom zoeken en nieuwe maken
            
            $query = "SELECT volgnummer FROM inschrijving WHERE stroom = 'A' ORDER BY volgnummer ASC";
            $result = query($query);
            while($row = mysql_fetch_assoc($result)){            
                $volgnummers[$row['volgnummer']] = "YES";            
            }
        
            $query = "SELECT volgnummer FROM inschrijving WHERE stroom = 'A' ORDER BY volgnummer DESC LIMIT 0,1";
            $result = query($query);
            while($row = mysql_fetch_assoc($result)){            
                $maxNummer = $row['volgnummer'];
            }
        
            $volgnummer_a = 0;
            $continue = 1;
            for($i=1;$i<=$maxNummer;$i++){
                if($continue == 0) continue;
                if(!array_key_exists($i,$volgnummers)){
                 $volgnummer_a = $i;
                 $continue = 0;
                }
            }
            
            $volgnummer_a = $volgnummer_a == 0 ? $maxNummer + 1 : $volgnummer_a; 
                    
            $date = date("Y-m-d H:i");
            
            $query = "INSERT INTO inschrijving (`id_leerling`,`stroom`,`volgnummer`,`definschrijving`,`def_ingeschreven_door`,`datum`) VALUES ('{$_SESSION['id_leerling']}','A','{$volgnummer_a}','1','{$_SESSION['gebruiker']['id']}','{$date}')";
            $return = query($query);
            
            $_SESSION['volgnummer_a'] = $volgnummer_a;
        }
        
        $query = "SELECT studiekeuze, keuzevakken, huidigschooljaar, inschrijving_opmerking FROM loopbaan WHERE leerling_id = '{$_SESSION['id_leerling']}'";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){
            
            $studiekeuze_db = unserialize($row['studiekeuze']);
            $inschrijving_opmerking_db = unserialize($row['inschrijving_opmerking']);            
            
            $studiekeuze_db['A'] = $studiekeuze;
            $inschrijving_opmerking_db['A'] = $studiekeuze . " " . $row['huidigschooljaar'];
            foreach($keuzevakken as $vak => $prio){
                if($vak != "" && $prio != ""){
                    $keuzevakken_db[$vak] = $prio;
                }
            }
            
            $keuzevakken_db = serialize($keuzevakken_db);
            $studiekeuze_db = serialize($studiekeuze_db);
            $inschrijving_opmerking_db = serialize($inschrijving_opmerking_db);
            
            $query = "UPDATE loopbaan SET studiekeuze = '{$studiekeuze_db}', keuzevakken = '{$keuzevakken_db}', inschrijving_opmerking = '{$inschrijving_opmerking_db}' WHERE leerling_id = '{$_SESSION['id_leerling']}'";
            $return = query($query);
            
        }
        
        return $return;
        
        
    }
    
    function delete_ooka_inschrijving(){
        
        $query = "DELETE FROM inschrijving WHERE id_leerling = '{$_SESSION['id_leerling']}' AND stroom = 'A'";
        $result = query($query);
        
        unset($_SESSION['volgnummer_a']);
        
        return $return;
        
    }
        
    function voorinschrijving_email($id_inschrijving){
                                                    
                
        include('/pdf_voorinschrijving.php');        

                
        $subject = 'Bevestiging voorinschrijving';
        $headers = 'From: Olvi Boom Middenschool <coordinatie@olviboom.be>' . "\r\n" .
            'Reply-To: Olvi Boom Middenschool <coordinatie@olviboom.be>' . "\r\n" .
            'Content-Type: text/html';
            
        $web_domain = WEB_DOMAIN;
            
        $message = <<<MSG
            
            <img src="{$web_domain}/public/img/logo_jpg.jpg" alt="Olvi Boom Middenschool">
            
            <p>Beste, </p>
            
            <p>U heeft zonet uw kind vooringeschreven bij ons.</p>
                        
            
            <p>
                <a href="{$web_domain}/data/pdfs/{$filename}.pdf">Klik op deze link om het voorinschrijving overzicht te downloaden.</a>
            </p>
            
            <p>
                Met vriendelijke groeten,<br><br><br><br><br><br>
                Sharon Sluyts
            </p>
            

            <img src="{$web_domain}/public/img/handtekening.jpg" alt="Olvi Boom">
                        
MSG;
        
        //mail("coordinatie@olviboom.be", $subject, $message, $headers);
        
        
        if($leerling['email'] != ""){
            mail($leerling['email'], $subject, $message, $headers);
            mail("michael@mcreations.pro", $subject . " - [KOPIE] - Verstuurd naar: {$leerling['email']}", $message, $headers);   
        }        


        
    }
 
    
?>