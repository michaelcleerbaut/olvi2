<?

    $pages = array(
        "1" => "app/views/prints/inschrijving/algemene_gegevens.tpl",
        "2" => "app/views/prints/inschrijving/algemene_gegevens.tpl",
        "3" => "app/views/prints/inschrijving/algemene_gegevens_leerlingbegeleiding.tpl",
        "4" => "app/views/prints/inschrijving/middag.tpl",
        //"5" => "app/views/prints/inschrijving/achtergrond_kind.tpl",
        "5" => "app/views/prints/inschrijving/basowerking.tpl"
    );


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
    SELECT l.*, i.*, m.*, v.*, b.*, vip.* FROM inschrijving i
    INNER JOIN leerlingen l ON i.id_leerling = l.id_leerling
    LEFT JOIN moeder m ON i.id_leerling = m.id_leerling
    LEFT JOIN vader v ON i.id_leerling = v.id_leerling
    LEFT JOIN loopbaan b ON i.id_leerling = b.leerling_id
    LEFT JOIN vip ON i.id_leerling = vip.id_leerling
    WHERE i.id_inschrijving = '{$id_inschrijving}'
    ";
    $result = query($query);
    $leerling = mysql_fetch_assoc($result);

    $query = "SELECT * FROM inschrijving WHERE id_leerling = '{$id_leerling}'";
    $result = query($query);


    $volgnummer_a = "";
    $volgnummer_b = "";
    while($inschrijving = mysql_fetch_assoc($result)){
        $volgnummer_a = $inschrijving['stroom'] == "A" ? $inschrijving['volgnummer'] : $volgnummer_a;
        $volgnummer_b = $inschrijving['stroom'] == "B" ? $inschrijving['volgnummer'] : $volgnummer_b;
    }

    if($volgnummer_a != "" || ($volgnummer_b != "" && $volgnummer_b *1 <= 24)){  
        $studiekeuze = is_array(unserialize($leerling['studiekeuze'])) ? unserialize($leerling['studiekeuze']) : array();


        if(in_array("A-Stroom: Algemene vorming",$studiekeuze)){
            array_push($pages,"app/views/prints/inschrijving/kostenraming_algemenevorming.tpl");
        }
        if (in_array("A-Stroom: Klassieke vorming",$studiekeuze)){
            array_push($pages,"app/views/prints/inschrijving/kostenraming_klassiekevorming.tpl");
        }
        if (in_array("1B",$studiekeuze)){
            array_push($pages,"app/views/prints/inschrijving/kostenraming_b.tpl");
        }
        if (in_array("Nog niet bepaald",$studiekeuze)){
            if(!in_array("app/views/prints/inschrijving/kostenraming_algemenevorming.tpl",$pages)){
                array_push($pages,"app/views/prints/inschrijving/kostenraming_algemenevorming.tpl");
            }
            if(!in_array("app/views/prints/inschrijving/kostenraming_klassiekevorming.tpl",$pages)){
                array_push($pages,"app/views/prints/inschrijving/kostenraming_klassiekevorming.tpl");
            }
            if(!in_array("app/views/prints/inschrijving/kostenraming_b.tpl",$pages)){
                array_push($pages,"app/views/prints/inschrijving/kostenraming_b.tpl");
            }
        }  
    } else {
        $pages = array();
    }



    if($volgnummer_b != ""){
        if($volgnummer_b <= 24){
            $leerling['volgnummer'] = "B" . $volgnummer_b;
            $leerling['volgnummer'] .= $volgnummer_a != "" ? " A$volgnummer_a" : "";
            $leerling['stroom'] = "B";
        } else {
            array_push($pages,"app/views/prints/inschrijving/niet_gerealiseerde_inschrijving.tpl");
            $leerling['volgnummer'] = "B$volgnummer_b";        
            $leerling['volgnummer'] .= $volgnummer_a != "" ? " A$volgnummer_a" : "";
            $leerling['stroom'] = "A";
        }
    } else if ($volgnummer_a != ""){
        $leerling['volgnummer'] = "A" . $volgnummer_a;
        $leerling['stroom'] = "A";      
    } else {
        echo "Er is iets fout gelopen.";
        exit;
    }



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
    if(is_array($keuzevakken) && count($keuzevakken) > 0){
        foreach($keuzevakken as $afkorting => $order){
            if(array_key_exists($afkorting,$vakken)){                
                $keuzevakkenprint .= $order . ": " . $vakken[$afkorting] . "<br>";
            }
        }
    }

    $thuistaal_ned = $leerling['thuistaal'] == "Ja" ? "Ja" : "Nee";
    $thuistaal_andere = $leerling['thuistaal'] == "Ja" ? "" : $leerling['thuistaal'];


    $tpl = new Template("core/print_builder");

    $tpl->set("pages",$pages);
    $tpl->set("huidigschooljaar",$huidigschooljaar);
    $tpl->set("leerling",$leerling);
    $tpl->set("studiekeuze",$studiekeuze);
    $tpl->set("keuzevakkenprint",$keuzevakkenprint);
    $tpl->set("stroom",$stroom);
    $tpl->set("keuze",$keuze);
    $tpl->set("thuistaal_ned",$thuistaal_ned);
    $tpl->set("thuistaal_andere",$thuistaal_andere);
    
    $tpl->render();
    
    
    
    

?>