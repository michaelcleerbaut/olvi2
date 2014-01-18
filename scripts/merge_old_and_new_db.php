<?php

    $dbh = MyPDO::getConnection();

    $execute = 0;

    //fix_inschrijvingen($execute);
    
    //fix_leerlingen($execute);
    
    //fix_vip_leerproblemen($execute);
    
    
    
    
    
    function fix_inschrijvingen($execute = 0){
        global $dbh;
        

        // GET OLD INSCHRIJVINGEN  
        $sth = $dbh->prepare("SELECT id_inschrijving, id_leerling FROM inschrijving2");
        $sth->execute();  
        while($r = $sth->fetch(PDO::FETCH_ASSOC)){      
            $old[$r['id_inschrijving']] = $r;      
        }

        // GET NEW INSCHRIJVINGEN  
        $sth = $dbh->prepare("SELECT id_inschrijving, id_leerling FROM inschrijving");
        $sth->execute();  
        while($r = $sth->fetch(PDO::FETCH_ASSOC)){      
            $new[$r['id_inschrijving']] = $r;      
        }


        // GET LATEST INSCHRIJVING ID
        $sth = $dbh->prepare("SELECT id_inschrijving FROM inschrijving2 ORDER BY id_inschrijving DESC LIMIT 1");
        $sth->execute();

        $row = $sth->fetch(PDO::FETCH_ASSOC);
        $last_IID = $row['id_inschrijving'];
        $new_IID = $last_IID + 1;


        echo "LAST IID: $last_IID, NEW IID: $new_IID <hr>";


        $changes = array();
        // LOOP NEW TO SEE IF ID EXISTS IN OLD    
        foreach($new as $IID => $r){

            if(array_key_exists($IID,$old)){            

                $changes[$IID] = $new_IID;           

                $new_IID++;
            }

        }

        
        echo "OLD INSCHRIJVING ID WITH NEW INSCHRIJVING ID";
        print_r2($changes);
        echo json_encode($changes) . "<br>";
        foreach($changes as $old_id => $new_id){

            $queries[] = array(
                "query" => "UPDATE inschrijving2 SET id_inschrijving = :NEW_ID WHERE id_inschrijving = :OLD_ID",
                "values" => array(":NEW_ID" => $new_id, ":OLD_ID" => $old_id)
            );        

        }
        if($execute == 1){
            foreach($queries as $q){            
                $sth = $dbh->prepare($q['query']);
                $sth->execute($q['values']);                    
            } 
        }
    
    }
    
    function fix_leerlingen($execute = 0){
        global $dbh;
        

        // GET OLD LEERLINGEN
        $sth = $dbh->prepare("SELECT id_leerling FROM leerlingen2");
        $sth->execute();  
        while($r = $sth->fetch(PDO::FETCH_ASSOC)){      
            $old[$r['id_leerling']] = $r;      
        }
        
        // GET NEW LEERLINGEN
        $sth = $dbh->prepare("SELECT id_leerling FROM leerlingen");
        $sth->execute();  
        while($r = $sth->fetch(PDO::FETCH_ASSOC)){      
            $new[$r['id_leerling']] = $r;      
        }


        // GET LATEST LEERLING ID
        $sth = $dbh->prepare("SELECT id_leerling FROM leerlingen2 ORDER BY id_leerling DESC LIMIT 1");
        $sth->execute();

        $row = $sth->fetch(PDO::FETCH_ASSOC);
        $last_IID = $row['id_leerling'];
        $new_IID = $last_IID + 1;


        echo "LAST IID: $last_IID, NEW IID: $new_IID <hr>";


        $changes = array();
        // LOOP NEW TO SEE IF ID EXISTS IN OLD    
        foreach($new as $IID => $r){

            if(array_key_exists($IID,$old)){            

                $changes[$IID] = $new_IID;           

                $new_IID++;
            }

        }

        
        echo "OLD LEERLING ID WITH NEW LEERLING ID";
        print_r2($changes);
        echo json_encode($changes) . "<br>";
        foreach($changes as $old_id => $new_id){


            // UPDATE AFSPRAKEN        
            $queries[] = array(
                "query" => "UPDATE afspraken2 SET id_leerling = :NEW_ID WHERE id_leerling = :OLD_ID",
                "values" => array(":NEW_ID" => $new_id, ":OLD_ID" => $old_id)
            );        

            // UPDATE COMMUNICATIE
            $queries[] = array(
                "query" => "UPDATE communicatie2 SET id_leerling = :NEW_ID WHERE id_leerling = :OLD_ID",
                "values" => array(":NEW_ID" => $new_id, ":OLD_ID" => $old_id)
            );        

            // UPDATE INSCHRIJVING        
            $queries[] = array(
                "query" => "UPDATE inschrijving2 SET id_leerling = :NEW_ID WHERE id_leerling = :OLD_ID",
                "values" => array(":NEW_ID" => $new_id, ":OLD_ID" => $old_id)
            );        

            // UPDATE LEERLINGEN
            $queries[] = array(
                "query" => "UPDATE leerlingen2 SET id_leerling = :NEW_ID WHERE id_leerling = :OLD_ID",
                "values" => array(":NEW_ID" => $new_id, ":OLD_ID" => $old_id)
            );        

            // UPDATE LOOPBAAN
            $queries[] = array(
                "query" => "UPDATE loopbaan2 SET leerling_id = :NEW_ID WHERE leerling_id = :OLD_ID",
                "values" => array(":NEW_ID" => $new_id, ":OLD_ID" => $old_id)
            );        

            // UPDATE MOEDER
            $queries[] = array(
                "query" => "UPDATE moeder2 SET id_leerling = :NEW_ID WHERE id_leerling = :OLD_ID",
                "values" => array(":NEW_ID" => $new_id, ":OLD_ID" => $old_id)
            );        

            // UPDATE VADER
            $queries[] = array(
                "query" => "UPDATE vader2 SET id_leerling = :NEW_ID WHERE id_leerling = :OLD_ID",
                "values" => array(":NEW_ID" => $new_id, ":OLD_ID" => $old_id)
            );        

            // UPDATE VIP
            $queries[] = array(
                "query" => "UPDATE vip2 SET id_leerling = :NEW_ID WHERE id_leerling = :OLD_ID",
                "values" => array(":NEW_ID" => $new_id, ":OLD_ID" => $old_id)
            );        

            // UPDATE VIP ANDERE PROBLEMEN        
            $queries[] = array(
                "query" => "UPDATE vip_andereproblemen2 SET id_leerling = :NEW_ID WHERE id_leerling = :OLD_ID",
                "values" => array(":NEW_ID" => $new_id, ":OLD_ID" => $old_id)
            );        

            // UPDATE VIP GEDRAGS PROBLEMEN  
            $queries[] = array(
                "query" => "UPDATE vip_gedragsproblemen2 SET id_leerling = :NEW_ID WHERE id_leerling = :OLD_ID",
                "values" => array(":NEW_ID" => $new_id, ":OLD_ID" => $old_id)
            );        

            // UPDATE VIP GEZONDHEIDSPROBLEMEN 
            $queries[] = array(
                "query" => "UPDATE vip_gezondheidsproblemen2 SET id_leerling = :NEW_ID WHERE id_leerling = :OLD_ID",
                "values" => array(":NEW_ID" => $new_id, ":OLD_ID" => $old_id)
            );        

            // UPDATE VIP LEERPROBLEMEN
            $queries[] = array(
                "query" => "UPDATE vip_leerproblemen2 SET id_leerling = :NEW_ID WHERE id_leerling = :OLD_ID",
                "values" => array(":NEW_ID" => $new_id, ":OLD_ID" => $old_id)
            );        
            
            

        }
        
        if($execute == 1){
            foreach($queries as $q){            
                $sth = $dbh->prepare($q['query']);
                $sth->execute($q['values']);                    
            } 
        }
    
    }    
    
    function fix_vip_leerproblemen($execute = 0){
        global $dbh;
        

        // GET OLD VIP LEERPROBLEMEN  
        $sth = $dbh->prepare("SELECT id FROM vip_leerproblemen2");
        $sth->execute();  
        while($r = $sth->fetch(PDO::FETCH_ASSOC)){      
            $old[$r['id']] = $r;      
        }

        // GET NEW VIP LEERPROBLEMEN
        $sth = $dbh->prepare("SELECT id FROM vip_leerproblemen");
        $sth->execute();  
        while($r = $sth->fetch(PDO::FETCH_ASSOC)){      
            $new[$r['id']] = $r;      
        }


        // GET LATEST VIP LEERPROBLEMEN ID
        $sth = $dbh->prepare("SELECT id FROM vip_leerproblemen2 ORDER BY id DESC LIMIT 1");
        $sth->execute();

        if($sth->rowCount() > 0){
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            $last_IID = $row['id'];
            $new_IID = $last_IID + 1;            
        } else {
            echo "GEEN REGELS GEVONDEN IN NIEUWE TABEL";
            exit;
        }        


        echo "LAST IID: $last_IID, NEW IID: $new_IID <hr>";


        $changes = array();
        // LOOP NEW TO SEE IF ID EXISTS IN OLD
        if(count($new) > 0){    
            foreach($new as $IID => $r){

                if(array_key_exists($IID,$old)){            

                    $changes[$IID] = $new_IID;           

                    $new_IID++;
                }

            }
        }

                
        print_r2($changes);
        echo json_encode($changes) . "<br>";
        foreach($changes as $old_id => $new_id){

            $queries[] = array(
                "query" => "UPDATE vip_leerproblemen2 SET id = :NEW_ID WHERE id = :OLD_ID",
                "values" => array(":NEW_ID" => $new_id, ":OLD_ID" => $old_id)
            );        

        }
        if($execute == 1){
            foreach($queries as $q){                            
                $sth = $dbh->prepare($q['query']);
                $sth->execute($q['values']);                    
            } 
        }
    
    }    
    

    // -------------------------------------------
    
    /*

    TODO:  PDFS MEE OVERZETTEN NAAR NIEUWE SERVER --> BASE64 AAN TE PASSEN NAAR NIEUW INSCHRIJVINGS ID


    OVERZICHT AANGEPASTE INSCHRIJVING IDS:: KEY: OLD INSCHRIJVING ID, VALUE: NEW INSCHRIJVNG ID (FROM INSCHRIJVING2 -> middenschooltest.be)
    Array
    (
    [10] => 535
    [13] => 536
    [14] => 537
    [15] => 538
    [17] => 539
    [18] => 540
    [20] => 541
    [22] => 542
    [23] => 543
    [24] => 544
    [26] => 545
    [27] => 546
    [28] => 547
    [29] => 548
    [30] => 549
    [31] => 550
    [32] => 551
    [33] => 552
    [34] => 553
    [35] => 554
    [36] => 555
    )        
    $changes = {"10":535,"13":536,"14":537,"15":538,"17":539,"18":540,"20":541,"22":542,"23":543,"24":544,"26":545,"27":546,"28":547,"29":548,"30":549,"31":550,"32":551,"33":552,"34":553,"35":554,"36":555}


    OVERZICHT AANGEPASTE LEERLING IDS:: KEY: OLD LEERLING ID, VALUE: NEW LEERLING ID (FROM LEERLINGEN2 -> middenschooltest.be)
    Array
    (
        [9] => 523
        [10] => 524
        [13] => 525
        [14] => 526
        [15] => 527
        [16] => 528
        [17] => 529
        [18] => 530
        [20] => 531
        [21] => 532
        [22] => 533
        [23] => 534
        [24] => 535
        [26] => 536
        [27] => 537
        [28] => 538
        [29] => 539
        [30] => 540
        [31] => 541
        [32] => 542
        [33] => 543
    )
    $changes = {"9":523,"10":524,"13":525,"14":526,"15":527,"16":528,"17":529,"18":530,"20":531,"21":532,"22":533,"23":534,"24":535,"26":536,"27":537,"28":538,"29":539,"30":540,"31":541,"32":542,"33":543}    

    
    OVERZICHT AANGEPASTE VIP_LEERPROBLEMEN IDS:: KEY: OLD VIP_LEERPROBLEMEN ID, VALUE: NEW VIP_LEERPROBLEMEN ID (FROM VIP_LEERPROBLEMEN2 -> middenschooltest.be)    
    Array
    (
        [3] => 39
        [4] => 40
        [5] => 41
        [6] => 42
        [7] => 43
    )
    $changes = {"3":39,"4":40,"5":41,"6":42,"7":43}    
    
    */
?> 

