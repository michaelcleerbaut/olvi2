<?php

    $execute = 0;

    if($execute == 0) exit;

    $dbh = MyPDO::getConnection();

    $sth = $dbh->prepare("SELECT * FROM scholen_bijzonder");
    $sth->execute();

    while($row = $sth->fetch(PDO::FETCH_ASSOC)){

        $a++;

        $nr = $matches_nr[1];
        $naam = $matches_naam[1];
        $vestiging = $matches_vest[1];                
        $straat = $td;               
        $postcode = $matches_postcode[1];
        $gemeente = trim(str_replace($postcode,"",$td)); 

        $scholen[$a]['nr'] = $row['code'];
        $scholen[$a]['naam'] = $row['naam'];
        $scholen[$a]['vestiging'] = "{$row['type']}";
        $scholen[$a]['straat'] = $row['straat'];
        $scholen[$a]['postcode'] = $row['postcode'];
        $scholen[$a]['gemeente'] = $row['gemeente'];


        $i++; 

    }


    echo "<pre>";
    print_r($scholen);
    echo "</pre>";


    foreach($scholen as $nr => $school){

        $sth = $dbh->prepare("INSERT INTO scholen_all (`instellingsnummer`,`soort`,`bijzonder`,`naam`,`type`,`straat`,`postcode`,`gemeente`) VALUES (:INR, :SOORT, :BIJZONDER, :NAAM, :TYPE, :STRAAT, :POSTCODE, :GEMEENTE)");
        $sth->bindValue(":INR",$school['nr'],PDO::PARAM_STR);
        $sth->bindValue(":SOORT","lager",PDO::PARAM_STR);
        $sth->bindValue(":BIJZONDER",1,PDO::PARAM_STR);
        $sth->bindValue(":NAAM",$school['naam'],PDO::PARAM_STR);
        $sth->bindValue(":TYPE",$school['vestiging'],PDO::PARAM_STR);
        $sth->bindValue(":STRAAT",$school['straat'],PDO::PARAM_STR);
        $sth->bindValue(":POSTCODE",$school['postcode'],PDO::PARAM_STR);
        $sth->bindValue(":GEMEENTE",$school['gemeente'],PDO::PARAM_STR);
        $sth->execute();

    }




?>

