<?
    include('inc/_preload.inc');
    
    /*
    header("Content-type: application/csv");
    header("Content-Disposition: attachment; filename=\"_mp3labels.csv\"");
    header("Pragma: no-cache");
    header("Expires: 0");
    */
    
$hoofding = array(
"naam",
"voornaam",
"geslacht",
"geboortedatum",
"geboorteplaats",
"nationaliteit",
"rijksregisternummer",
"straat",
"huisnummer",
"busnummer",
"postcode",
"plaats",
"email",
"gsm",
"Lagere school",
"tweede verblijf?",
"tweede verblijf straat",
"tweede verblijf huis nummer",
"tweede verblijf bus nummer",
"tweede verblijf postcode",
"tweede verblijf plaats",
"tweede verblijf tel",
"Dubbele Post",
"dubbele afdruk?",
"tel noodnummer",
"moeder naam",
"moeder voornaam",
"beroep",
"moeder straat",
"moeder huisnummer",
"moeder busnummer",
"moeder postcode",
"moeder plaats",
"moeder gsm",
"moeder email",
"vader naam",
"vader voornaam",
"vader beroep",
"vader straat",
"vader huisnummer",
"vader busnummer",
"vader postcode",
"vader plaats",
"vader tel",
"vader gsm",
"vader email",
"schooljaar",
"studiekeuze 1e jaar",
"Indien Algemene keuze: Keuzevak 1",
"Indien Algemene keuze: Keuzevak 2",
"Middagpauze",
"Leerling door beide ouders opgevoed?",
"Opgevoed door vader / moeder / voogd (naam)",
"Andere nuttige info",
"ooit een jaar moeten overdoen?",
"Zo ja, welk jaar?",
"Leerproblemen?",
"Gezondheidsproblemen?",
"Gedragsproblemen?",
"gok moeder edison spreektaal",
"gok vader edison spreektaal",
"gok broer zus edison spreektaal",
"gok vrienden edison spreektaal",
"gok edison opleidingsniveau moeder",
"BaSo-werking");
    
    $query = "SELECT l.*, l.id_leerling as L_ID, c.* FROM leerlingen l
        LEFT JOIN communicatie c ON l.id_leerling = c.id_leerling
        ORDER BY l.id_leerling LIMIT 0,2
    ";
    $result = query($query);
    
    while($leerling = mysql_fetch_assoc($result)){                        
        foreach($leerling as $key => $value){
            $key = str_replace("_"," ",$key);
            $leerlingen[$leerling['L_ID']][$key] = $value;
        }
    }


    
    echo "<pre>";
        print_r($leerlingen);
    echo "</pre>";


    /*
    $handle = fopen('php://output', 'w');

    fputcsv($handle,$hoofding);
    
    foreach($leerlingen as $leerling_id => $leerling){    
        fputcsv($handle, array(
            $p['name'],
            $p['barcode']
        ));
    }
    
    fclose($handle);
    */

?>