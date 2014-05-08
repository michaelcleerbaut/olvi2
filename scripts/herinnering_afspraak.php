<?php
exit;
    require_once('../app/inc/ajax.functions.inc.php');
    $dbh = MyPDO::getConnection();

    $query = "SELECT * FROM afspraken a 
                LEFT JOIN inschrijving i ON a.id_leerling = i.id_leerling
                LEFT JOIN communicatie c ON a.id_leerling = c.id_leerling 
                WHERE a.schooljaar LIKE '2014 - 2015' AND a.dag != 'tel' AND a.dag != 'broerofzus'                
    ";
    $result = query($query);    
    while($afspraak = mysql_fetch_assoc($result)){
        
        echo herinnering_email($afspraak['id_inschrijving'],$afspraak['dag'],$afspraak['uur'],$afspraak['email']);       
        
    }
    
?> 

