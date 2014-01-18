<?php
    
    // debug
    //$_SESSION['id_inschrijving'] = 547;
    //$_SESSION['id_leerling'] = 535;


    // PRINT PAGES
    $pages = array(
        "1" => "app/views/prints/voorinschrijving/algemeen.tpl"
    );

    // check if id_inschrijving or id_leerling is known
    if($_GET['id_inschrijving'] != "" && $_GET['id_leerling'] != ""){
        $id_inschrijving = $_GET['id_inschrijving'];
        $id_leerling = $_GET['id_leerling'];    
    } else if($_SESSION['id_leerling'] != "" && $_SESSION['id_inschrijving'] != ""){
        $id_inschrijving = $_SESSION['id_inschrijving'];
        $id_leerling = $_SESSION['id_leerling'];
    } else {
        echo "Er is iets fout gelopen.";
        exit;
    }

    
    $query = "
    SELECT l.*, i.*, c.*, o.studiekeuze, a.uur, a.dag FROM inschrijving i
        INNER JOIN leerlingen l ON i.id_leerling = l.id_leerling
        LEFT JOIN communicatie c ON i.id_leerling = c.id_leerling
        LEFT JOIN afspraken a ON i.id_leerling = a.id_leerling
        LEFT JOIN loopbaan o ON i.id_leerling = o.leerling_id
    WHERE i.id_inschrijving = '{$id_inschrijving}'
    ";
    $result = query($query);
    $leerling = mysql_fetch_assoc($result);

    
    /*
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
    */
    $huidigschooljaar = $_SESSION['schooljaar'];  

    $busnummer = $leerling['busnummer'] != "" ? " bus {$leerling['busnummer']}" : "";
    $stroom_andere = $leerling['stroom'] == "A" ? "B" : "A";

    $query = "SELECT volgnummer, stroom FROM inschrijving WHERE id_leerling = '{$leerling['id_leerling']}' AND stroom = '{$stroom_andere}'";
    $result = query($query);  
    if(mysql_num_rows($result) == 0){      
        $volgnummer_andere = "";
    } else {
        while($row = mysql_fetch_assoc($result)){                
            $volgnummer_andere = $row['volgnummer'];
        }
    }

    $volgnummerA = $leerling['stroom'] == "A" ? $leerling['volgnummer'] : $volgnummer_andere;
    $volgnummerB = $leerling['stroom'] == "B" ? $leerling['volgnummer'] : $volgnummer_andere;

    $volgnummerB = $leerling['stroom'] == "A" ? "" : $volgnummerB;

    if($leerling['dag'] == "tel"){
        $afspraak = "<span style=\"font-size:16px;font-weight:bold;\">U wil graag telefonisch een afspraak maken</span>";   
    } else if ($leerling['dag'] == "broerofzus"){
        $afspraak = "<span style=\"font-size:16px;font-weight:bold;\">U heeft reeds een afspraak gemaakt (met een broer of zus)</span>";   
    } else {
        $uur = str_replace(":",".",$leerling['uur']);
        $afspraak = "<p>U heeft een afspraak op</p><p><span style=\"font-size:16px;font-weight:bold;\">{$leerling['dag']} mei 2013 om $uur u</p>";   
    }



    $studiekeuze = "";
    if($leerling['stroom'] == "A"){
        $studiekeuze = unserialize($leerling['studiekeuze']);      
        $studiekeuze = $studiekeuze['A'];
        if($studiekeuze != ""){
            $studiekeuze = "<tr><td>Studiekeuze</td><td>$studiekeuze</td></tr>";
        }
    }

    
    
    
    $tpl = new Template("core/print_builder");

    $tpl->set("pages",$pages);
    $tpl->set("volgnummerA",$volgnummerA);
    $tpl->set("volgnummerB",$volgnummerB);
    $tpl->set("huidigschooljaar",$huidigschooljaar);
    $tpl->set("afspraak",$afspraak);
    $tpl->set("leerling",$leerling);

    $tpl->render();

?>
