<?php

    function get_leerlingen_data(){
    
        $dbh = MyPDO::getConnection();
        
        // GET SCHOOLJAAR
        $sth = $dbh->query("SELECT * FROM settings WHERE name = 'huidigschooljaar'");
        while($r = $sth->fetch(PDO::FETCH_ASSOC)){
            $settings[$r['name']]['value'] = $r['value'];    
            $settings[$r['name']]['value2'] = $r['value2'];    
        }

        // GET DATA
        $sth = $dbh->query("
            SELECT l.*, b.*, m.*, v.*, p.* FROM leerlingen l 
            LEFT JOIN loopbaan b ON l.id_leerling = b.leerling_id
            LEFT JOIN moeder m ON l.id_leerling = m.id_leerling
            LEFT JOIN vader v ON l.id_leerling = v.id_leerling
            LEFT JOIN vip p ON l.id_leerling = p.id_leerling            
            WHERE l.deleted != '1'
        ");
        $leerlingen = array();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            $row['schooljaar'] = $settings['huidigschooljaar']['value'];
            $leerlingen[$row['id_leerling']] = $row;
        }

        return $leerlingen;      

    }
    
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
