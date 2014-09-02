<?php

    // get data functions
    function get_leerlingen_data(){
    
        $dbh = MyPDO::getConnection();
        
        // GET SCHOOLJAAR        
        /*
        $sth = $dbh->query("SELECT * FROM settings WHERE name = 'huidigschooljaar'");
        while($r = $sth->fetch(PDO::FETCH_ASSOC)){
            $settings[$r['name']]['value'] = $r['value'];    
            $settings[$r['name']]['value2'] = $r['value2'];    
        }
        */

        // GET DATA
        $sth = $dbh->query("
            SELECT l.*, b.*, m.*, v.*, p.*, i.* FROM leerlingen l 
            LEFT JOIN loopbaan b ON l.id_leerling = b.leerling_id
            LEFT JOIN moeder m ON l.id_leerling = m.id_leerling
            LEFT JOIN vader v ON l.id_leerling = v.id_leerling
            LEFT JOIN vip p ON l.id_leerling = p.id_leerling
            LEFT JOIN inschrijving i ON l.id_leerling = i.id_leerling            
            WHERE l.deleted != '1' AND i.schooljaar LIKE '{$_SESSION['schooljaar']}'
        ");
        $leerlingen = array();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){         
            $row['schooljaar'] = $_SESSION['schooljaar'];
            //$row['schooljaar'] = $settings['huidigschooljaar']['value'];
            $leerlingen[$row['id_leerling']] = $row;
            if($row['stroom'] == "A"){
                $leerlingen[$row['id_leerling']]['volgnummer_a'] = $row['volgnummer'];
            } else if ($row['stroom'] == "B"){
                $leerlingen[$row['id_leerling']]['volgnummer_b'] = $row['volgnummer'];
            }
        }

        return $leerlingen;      

    }

    function get_vip_gedragsproblemen_data(){
        
        $dbh = MyPDO::getConnection();
        
        // GET DATA
        $sth = $dbh->query("
            SELECT l.id_leerling, l.naam, l.voornaam, l.geboortedatum, i.*, g.* FROM leerlingen l
            INNER JOIN vip_gedragsproblemen g ON l.id_leerling = g.id_leerling            
            INNER JOIN inschrijving i ON l.id_leerling = i.id_leerling            
            WHERE l.deleted != '1' AND i.schooljaar LIKE '{$_SESSION['schooljaar']}'
        ");
        $leerlingen = array();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){         
            
            // init needed keys and values
            $row['schooljaar'] = str_replace(" ","",$_SESSION['schooljaar']);
            $row['dossier schooljaar'] = str_replace(" ","",$_SESSION['schooljaar']);
            $row['naam_volledig'] = htmlspecialchars_decode($row['naam']) . " " . htmlspecialchars_decode($row['voornaam']);            
            $row['categorie'] = "Gedragsproblemen";
            $row['datum'] = date("Y-m-d");
            $row['geboortedatum'] = date("Y-m-d", strtotime($row['geboortedatum']));

            // build omschrijving
            
                // problemen                                     
                $problemen = unserialize(htmlspecialchars_decode($row['soorten_problemen']));            
                $problemen_html = "";    
                if(is_array($problemen) && count($problemen) > 0){
                    $omschrijving = "Soorten problemen ";
                    $omschrijving .= "\n---------------------------------------\n";
                    foreach($problemen as $probleem => $value){
                        $probleem = str_replace("anderegedragsproblemen","andere gedragsproblemen",$probleem); 
                        if($value == "YES"){
                            $omschrijving .= $probleem . "\n";
                        } else if ($value != "" && $value != "NO"){
                            $omschrijving .= $probleem . ": ". $value . "\n";
                        }
                    }
                }
                 
                $omschrijving .= "\nGedragsproblemen thuis ";                
                $omschrijving .= "\n---------------------------------------\n";
                $omschrijving .= $row['gedragsproblemen_thuis'] == "Ja" ? "Ja\n" : "Nee\n";                 
                if($row['gedragsproblemen_thuis'] == "Ja"){                    
                    $omschrijving .= "Welke: " . $row['gedragsproblemen_thuis_welke'] . "\n";
                    $omschrijving .= "Extra: ".$row['gedragsproblemen_thuis_extra'] ; "\n";                    
                }
                
                $omschrijving .= "\nGedragsproblemen school ";
                $omschrijving .= "\n---------------------------------------\n";
                $omschrijving .= $row['gedragsproblemen_school'] == "Ja" ? "Ja\n" : "Nee\n";                 
                if($row['gedragsproblemen_school'] == "Ja"){                    
                    $omschrijving .= "Welke: " . $row['gedragsproblemen_school_welke'] . "\n";
                    $omschrijving .= "Extra: ".$row['gedragsproblemen_school_extra'] ; "\n";                    
                }

                $omschrijving .= "\nBegeleiding ";                
                $omschrijving .= "\n---------------------------------------\n";
                $omschrijving .= $row['begeleiding'] == "Ja" ? "Ja\n" : "Nee\n";
                if($row['begeleiding'] == "Ja"){                    
                    $omschrijving .= "Wanneer? " . $row['begeleiding_wanneer'] . "\n";
                    $omschrijving .= "Waar? " . $row['begeleiding_waar'] . "\n";
                    $omschrijving .= "Nu nog? " . $row['begeleiding_nunog'] . "\n";
                    $omschrijving .= "Extra: " . $row['begeleiding_extra'] . "\n";
                }
                
                $omschrijving .= "\nAlgemene omschrijving ";
                $omschrijving .= "\n---------------------------------------\n";
                $omschrijving .= $row['omschrijving'] . "\n";
                
                $omschrijving .= "\nAttesten ";
                $omschrijving .= "\n---------------------------------------\n";
                $omschrijving .= $row['attesten'] == "Ja" ? "Ja\n" : "Nee\n";                 
                if($row['attesten'] == "Ja"){            
                    $omschrijving .= "Extra: ".$row['attesten_extra'] . "\n";                    
                }                
                
                if($row['omgang'] != ""){
                    $omschrijving .= "\nOmgang ";
                    $omschrijving .= "\n---------------------------------------\n";
                    $omschrijving .= $row['omgang'];
                }                                   
            
            
            $row['omschrijving'] = $omschrijving; 
            
                                    
            $leerlingen[$row['id_leerling']] = $row;                        
        }

        return $leerlingen;     
        
        
    }    
    
    function get_vip_gezondheidsproblemen_data(){
        
        $dbh = MyPDO::getConnection();
        
        // GET DATA
        $sth = $dbh->query("
            SELECT l.id_leerling, l.naam, l.voornaam, l.geboortedatum, i.*, g.* FROM leerlingen l
            INNER JOIN vip_gezondheidsproblemen g ON l.id_leerling = g.id_leerling            
            INNER JOIN inschrijving i ON l.id_leerling = i.id_leerling            
            WHERE l.deleted != '1' AND i.schooljaar LIKE '{$_SESSION['schooljaar']}'
        ");
        $leerlingen = array();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        
            // init needed keys and values         
            $row['schooljaar'] = str_replace(" ","",$_SESSION['schooljaar']);
            $row['dossier schooljaar'] = str_replace(" ","",$_SESSION['schooljaar']);
            $row['naam_volledig'] = htmlspecialchars_decode($row['naam']) . " " . htmlspecialchars_decode($row['voornaam']);            
            $row['categorie'] = "Gezondheidsproblemen";
            $row['datum'] = date("Y-m-d");
            $row['geboortedatum'] = date("Y-m-d", strtotime($row['geboortedatum']));
            

            // build omschrijving
            
                // problemen                
                $problemen = unserialize(htmlspecialchars_decode($row['soorten_problemen']));            
                $problemen_html = "";    
                if(is_array($problemen) && count($problemen) > 0){
                    $omschrijving = "Soorten problemen ";
                    $omschrijving .= "\n---------------------------------------\n";
                    foreach($problemen as $probleem => $value){
                        $probleem = str_replace("anderegezondheidsproblemen","andere gezondheidsproblemen",$probleem);                    
                        if($value == "YES"){
                            $omschrijving .= $probleem . "\n";
                        } else if ($value != "" && $value != "NO"){
                            $omschrijving .= $probleem . ": ". $value . "\n";
                        }
                    }
                }    
                                
                $omschrijving .= "\nAlgemene omschrijving ";
                $omschrijving .= "\n---------------------------------------\n";
                $omschrijving .= $row['omschrijving'] . "\n";
                
                $omschrijving .= "\nAttesten ";
                $omschrijving .= "\n---------------------------------------\n";
                $omschrijving .= $row['attesten'] == "Ja" ? "Ja\n" : "Nee\n";                 
                if($row['attesten'] == "Ja"){            
                    $omschrijving .= "Extra: ".$row['attesten_extra'] . "\n";                    
                }  
            
            
            $row['omschrijving'] = $omschrijving;            
                        
            $leerlingen[$row['id_leerling']] = $row;                        
        }
        
        return $leerlingen;     
        
        
    }
    
    function get_vip_leerproblemen_data(){
        
        $dbh = MyPDO::getConnection();
        
        // GET DATA
        $sth = $dbh->query("
            SELECT l.id_leerling, l.naam, l.voornaam, l.geboortedatum, i.*, g.* FROM leerlingen l
            INNER JOIN vip_leerproblemen g ON l.id_leerling = g.id_leerling            
            INNER JOIN inschrijving i ON l.id_leerling = i.id_leerling            
            WHERE l.deleted != '1' AND i.schooljaar LIKE '{$_SESSION['schooljaar']}'
        ");
        $leerlingen = array();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        
            // init needed keys and values         
            $row['schooljaar'] = str_replace(" ","",$_SESSION['schooljaar']);
            $row['dossier schooljaar'] = str_replace(" ","",$_SESSION['schooljaar']);
            $row['naam_volledig'] = htmlspecialchars_decode($row['naam']) . " " . htmlspecialchars_decode($row['voornaam']);            
            $row['categorie'] = "Leerproblemen";
            $row['datum'] = date("Y-m-d");
            $row['geboortedatum'] = date("Y-m-d", strtotime($row['geboortedatum']));
            

            // build omschrijving
            
                // problemen                
                $problemen = unserialize(htmlspecialchars_decode($row['soorten_problemen']));            
                $problemen_html = "";    
                if(is_array($problemen) && count($problemen) > 0){
                    $omschrijving = "Soorten problemen ";
                    $omschrijving .= "\n---------------------------------------\n";
                    foreach($problemen as $probleem => $value){
                        $probleem = str_replace("andereleerproblemen","andere leerproblemen",$probleem);                    
                        if($value == "YES"){
                            $omschrijving .= $probleem . "\n";
                        } else if ($value != "" && $value != "NO"){
                            $omschrijving .= $probleem . ": ". $value . "\n";
                        }
                    }
                }
                
                $omschrijving .= "\nJaar over gedaan?";
                $omschrijving .= "\n---------------------------------------\n";
                $omschrijving .= $row['jaar_overgedaan'] == "Ja" ? "Ja\n" : "Nee\n";                 
                if($row['jaar_overgedaan'] == "Ja"){            
                    $omschrijving .= "Leerjaar: ".$row['jaar_overgedaan_leerjaar'] . "\n";                    
                    $omschrijving .= "Reden: ".$row['jaar_overgedaan_reden'] . "\n";                    
                    $omschrijving .= "Extra: ".$row['jaar_overgedaan_extra'] . "\n";                    
                }
                
                $omschrijving .= "\nVakgebonden?";
                $omschrijving .= "\n---------------------------------------\n";
                $omschrijving .= $row['vakgebonden'] == "Ja" ? "Ja\n" : "Nee\n";                 
                if($row['vakgebonden'] == "Ja"){            
                    $omschrijving .= "Vakken: ".$row['vakgebonden_vakken'] . "\n";                    
                    $omschrijving .= "Soort: ".$row['vakgebonden_soort'] . "\n";                    
                    $omschrijving .= "Extra: ".$row['vakgebonden_extra'] . "\n";                    
                }
                
                $omschrijving .= "\nMaakt gebruik van pc?";
                $omschrijving .= "\n---------------------------------------\n";
                $omschrijving .= $row['maakt_gebruik_van_pc'] == "Ja" ? "Ja\n" : "Nee\n";                 
                if($row['maakt_gebruik_van_pc'] == "Ja"){            
                    $omschrijving .= "Programmas: ".$row['maakt_gebruik_van_pc_programmas'] . "\n";                                                            
                }                

                $omschrijving .= "\nBijkomende gedragsproblemen?";
                $omschrijving .= "\n---------------------------------------\n";
                $omschrijving .= $row['gedragsproblemen'] == "Ja" ? "Ja\n" : "Nee\n";                 
                if($row['gedragsproblemen'] == "Ja"){            
                    $omschrijving .= "Welke: ".$row['gedragsproblemen_welke'] . "\n";                                                            
                    $omschrijving .= "Extra: ".$row['gedragsproblemen_extra'] . "\n";                                                            
                }
                
                $omschrijving .= "\nTaakleraar in L.O.?";
                $omschrijving .= "\n---------------------------------------\n";
                $omschrijving .= $row['taakleraar_lo'] == "Ja" ? "Ja\n" : "Nee\n";                 
                if($row['taakleraar_lo'] == "Ja"){            
                    $omschrijving .= "Reden: ".$row['taakleraar_lo_reden'] . "\n";                                                            
                    $omschrijving .= "Extra: ".$row['taakleraar_lo_extra'] . "\n";                                                            
                }                
                
                $omschrijving .= "\nBegeleiding ";                
                $omschrijving .= "\n---------------------------------------\n";
                $omschrijving .= $row['begeleiding'] == "Ja" ? "Ja\n" : "Nee\n";
                if($row['begeleiding'] == "Ja"){                    
                    $omschrijving .= "Wanneer? " . $row['begeleiding_wanneer'] . "\n";
                    $omschrijving .= "Waar? " . $row['begeleiding_waar'] . "\n";
                    $omschrijving .= "Nu nog? " . $row['begeleiding_nunog'] . "\n";
                    $omschrijving .= "Extra: " . $row['begeleiding_extra'] . "\n";
                }
                
                
                $omschrijving .= "\nAttesten ";
                $omschrijving .= "\n---------------------------------------\n";
                $omschrijving .= $row['attesten'] == "Ja" ? "Ja\n" : "Nee\n";                 
                if($row['attesten'] == "Ja"){            
                    $omschrijving .= "Extra: ".$row['attesten_extra'] . "\n";                    
                }  
            
            
            $row['omschrijving'] = $omschrijving;            
                        
            $leerlingen[$row['id_leerling']] = $row;                        
        }
        
        return $leerlingen;     
        
        
    }
    
    function get_vip_andereproblemen_data(){
        
        $dbh = MyPDO::getConnection();
        
        // GET DATA
        $sth = $dbh->query("
            SELECT l.id_leerling, l.naam, l.voornaam, l.geboortedatum, i.*, g.* FROM leerlingen l
            INNER JOIN vip_andereproblemen g ON l.id_leerling = g.id_leerling            
            INNER JOIN inschrijving i ON l.id_leerling = i.id_leerling            
            WHERE l.deleted != '1' AND i.schooljaar LIKE '{$_SESSION['schooljaar']}'
        ");
        $leerlingen = array();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){         
            $row['schooljaar'] = str_replace(" ","",$_SESSION['schooljaar']);
            $row['naam_volledig'] = htmlspecialchars_decode($row['naam']) . " " . htmlspecialchars_decode($row['voornaam']);            
            $row['categorie'] = "VIP andere problemen";
            $row['datum'] = date("Y-m-d");
                                     
            $row['omschrijving'] = $row['soort'] . " " . $row['omschrijving'];            
                        
            $leerlingen[$row['id_leerling']] = $row;                        
        }

        return $leerlingen;     
        
        
    }
    
    function get_thuistaal_verschillend_van_nederlands_data(){
        
        $dbh = MyPDO::getConnection();
        
        // GET DATA
        $sth = $dbh->query("
            SELECT l.id_leerling, l.naam, l.voornaam, l.geboortedatum, i.*, v.* FROM leerlingen l
            INNER JOIN vip v ON l.id_leerling = v.id_leerling            
            INNER JOIN inschrijving i ON l.id_leerling = i.id_leerling            
            WHERE l.deleted != '1' AND i.schooljaar LIKE '{$_SESSION['schooljaar']}'
            AND v.thuistaal != 'Ja' AND v.thuistaal != ''
        ");
        $leerlingen = array();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){         
            $row['schooljaar'] = str_replace(" ","",$_SESSION['schooljaar']);
            $row['naam_volledig'] = htmlspecialchars_decode($row['naam']) . " " . htmlspecialchars_decode($row['voornaam']);            
            $row['categorie'] = "Thuistaal";
            $row['datum'] = date("Y-m-d");                        
            $row['geboortedatum'] = date("Y-m-d", strtotime($row['geboortedatum']));

                                     
            $row['omschrijving'] = $row['thuistaal'];
                        
            $leerlingen[$row['id_leerling']] = $row;                        
        }
                                                                                
        return $leerlingen;     
        
    }
    
    function get_maakt_gebruik_van_pc_data(){
        
        $dbh = MyPDO::getConnection();
        
        // GET DATA
        $sth = $dbh->query("
            SELECT l.id_leerling, l.naam, l.voornaam, l.geboortedatum, i.*, v.* FROM leerlingen l
            INNER JOIN vip_leerproblemen v ON l.id_leerling = v.id_leerling            
            INNER JOIN inschrijving i ON l.id_leerling = i.id_leerling            
            WHERE l.deleted != '1' AND i.schooljaar LIKE '{$_SESSION['schooljaar']}'
            AND v.maakt_gebruik_van_pc = 'Ja' 
        ");
        $leerlingen = array();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){         
            $row['schooljaar'] = str_replace(" ","",$_SESSION['schooljaar']);
            $row['naam_volledig'] = htmlspecialchars_decode($row['naam']) . " " . htmlspecialchars_decode($row['voornaam']);            
            $row['categorie'] = "PC in de klas";
            $row['datum'] = date("Y-m-d");                        
            $row['geboortedatum'] = date("Y-m-d", strtotime($row['geboortedatum']));

                                     
            $row['omschrijving'] = $row['maakt_gebruik_van_pc_programmas'];
                        
            $leerlingen[$row['id_leerling']] = $row;                        
        }

        
        return $leerlingen;     
        
    } 
    

    // parse functions    
    function get_adaption_value($leerling,$key){

        $value = "";

        switch($key){
            case "inschrijving_opmerking":
                $r = is_array(unserialize($leerling['inschrijving_opmerking'])) ? unserialize($leerling['inschrijving_opmerking']) : array();
                $value = "";
                if(array_key_exists("A",$r)){
                    $value .= $r['A'];
                }
                if(array_key_exists("B",$r)){
                    $value .= $r['B'];
                }                        
                break;


            case "maaltijdtype":
            switch(substr($leerling['middag'],0,4)){
                case "op sc":
                    $value = "Intern";
                    break;
                case "naar":
                    $value = "Extern";
                    break;
                case "soms":
                    $value ="Half intern";
                    break;
            }                           
            break;

            case "middag":
            switch(substr($leerling['middag'],0,4)){
                case "op sc":
                    $value = "Intern";
                    break;
                case "naar":
                    $value = "Extern";
                    break;
                case "soms":
                    $value ="Half intern, dagen thuis: " . trim(substr($leerling['middag'],21));
                    break;
            }                           
            break;
            
            case "leerling_id":
                $value = array_key_exists('volgnummer_a',$leerling) ? "A: " . $leerling['volgnummer_a'] : "";
                if(array_key_exists('volgnummer_b',$leerling)){
                    $value .= $value != "" ? ", " : "";
                    $value .= "B: " . $leerling['volgnummer_b'];
                }                
            break; 
            
            case "datum_inschrijving":
                $value = date("d/m/Y", strtotime($leerling['datum_inschrijving']));
            break;
        }    
        

        
        return $value;
    }

    function parse_results($leerlingen, $import_kols,$show_table = 0){
        

        $table_rows = "";
        
        foreach($leerlingen as $id_leerling => $leerling){
     

            foreach($import_kols as $sol => $ons){
                $ons = trim($ons);

                if($ons != "[SKIP]"){


                    if(substr($ons,0,7) != "[ADAPT]"){                
                        $value = array_key_exists($ons,$leerling) ? $leerling[$ons] : "KOLOM NIET GEVONDEN";
                    } else {                
                        $adapt_key = trim(substr($ons,7));                         
                        $value = $adapt_key != "" ? get_adaption_value($leerling,$adapt_key) : "";
                    }



                    if($show_table == 1){
                        $value = strlen($value) == "0" ? "" : $value;    
                    }

                    $rows[$id_leerling][$sol] = $value;

                    $table_rows .= "
                    <tr>
                    <td>$sol</td>
                    <td>$ons</td>
                    <td>$value</td>
                    </tr>";

                }
            }

        }
    

        $table = "<table border=\"1\"><tr><th>KOL SOL</th><th>ONS</th><th>VALUE</th></tr>";
        $table .= $table_rows;
        $table .= "</table>";

        return array(
            "rows" => $rows,
            "table" => $table
        );        

    }

    function initialize_kols(){

        $count = 1;
        $letters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
        for($i = 0;$i <= 25; $i++){
            $kols[$count] = $letters[$i];
            $count++;
        }
        for($a = 0; $a <= 3; $a++){
            for($i = 0;$i <= 25; $i++){
                $kols[$count] = $letters[$a].$letters[$i];
                $count++;
            }
        }

        return $kols;        

    }
?>
