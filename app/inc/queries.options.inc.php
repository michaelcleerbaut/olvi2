<? 

$query = "SELECT id, naam FROM gebruikers";
$result = query($query);
while($row = mysql_fetch_assoc($result)){
    $gebruikers[$row['id']] = $row['naam'];
}


/**
* ==================== ZOEK VELDEN OM QUERY SAMEN TE STELLEN
**/

  $queryarray['afspraken']['dag'] = array(    
    'name' => "Dag",
    'req' => 0,
    'type' => 'BOOL',    
    'opt' => array("3" => "3 Mei", "4" => "4 Mei", "5" => "5 Mei")
  );      

  $queryarray['afspraken']['uur'] = array(
    'name' => 'Uur',
    'opm' => "notatie:  HH:MM",
    'req' => 0,
    'type' => 'TEXT',
    'opt'  => array("<" => "Vroeger dan", "<=" => "Vroeger of gelijk aan", "=" => "om", ">=" => "Later of gelijk aan" , ">" => "Later dan")
  );      

  $queryarray['inschrijving']['stroom'] = array(    
    'name' => 'Stroom',
    'req' => 0,
    'type' => 'SET',
    'opt'  => array("=" => "is"),
    'values' => array("A" => "A Stroom", "B" => "B Stroom")
  );      

 $queryarray['inschrijving']['voor_ingeschreven_door'] = array(
    'name' => 'Voor ingeschreven door',
    'req'  => 0,
    'type' => 'BOOL',
    'opt'  => $gebruikers
 );      

 $queryarray['inschrijving']['def_ingeschreven_door'] = array(
    'name' => 'Definitief ingeschreven door',
    'req'  => 0,
    'type' => 'BOOL',
    'opt'  => $gebruikers
 );      

 
 $queryarray['leerlingen']['geslacht'] = array(
    'name' => 'Geslacht',
    'req'  => 0,
    'type' => 'BOOL',
    'opt'  => array("Man" => "Man", "Vrouw" => "Vrouw")
 );
 
  $queryarray['leerlingen']['geboortedatum'] = array(
    'opm' => 'Notatie: YYY/MM/DD',
    'name' => 'Geboortedatum',
    'req'  => 0,
    'type' => 'TEXT',
    'opt'  => array("<" => "Vroeger dan", "<=" => "Vroeger of gelijk aan", "=" => "om", ">=" => "Later of gelijk aan" , ">" => "Later dan")
 ); 
 
  $queryarray['leerlingen']['geboorteplaats'] = array(
    'name' => 'Geboorteplaats',
    'req'  => 0,
    'type' => 'TEXT',
    'opt'  => array("=" => "is", "!=" => "is niet", "BEG" => "begint met", "END" => "eindigt met", "CONTAIN" => "Bevat")
 ); 

  $queryarray['leerlingen']['nationaliteit'] = array(
    'name' => 'Nationaliteit',
    'req'  => 0,
    'type' => 'TEXT',
    'opt'  => array("=" => "is", "!=" => "is niet", "BEG" => "begint met", "END" => "eindigt met", "CONTAIN" => "Bevat")
 );
 
   $queryarray['leerlingen']['postcode'] = array(
    'name' => 'Postcode',
    'req'  => 0,
    'type' => 'TEXT',
    'opt'  => array("=" => "is", "!=" => "is niet", "BEG" => "begint met", "END" => "eindigt met", "CONTAIN" => "Bevat", ">=" => "Is groter of gelijk aan ", "<=" => "Is kleiner of gelijk aan")
 ); 
   
   $queryarray['leerlingen']['email'] = array(
    'name' => 'Email',
    'req'  => 0,
    'type' => 'TEXT',
    'opt'  => array("=" => "is", "!=" => "is niet", "BEG" => "begint met", "END" => "eindigt met", "CONTAIN" => "Bevat")
 ); 
 
  $queryarray['leerlingen']['school_vorig_schooljaar'] = array(
    'name' => 'School vorig schooljaar',
    'req'  => 0,
    'type' => 'TEXT',
    'opt'  => array("CONTAIN" => "Bevat")
 ); 
 
  $queryarray['loopbaan']['studiekeuze'] = array(
    'name' => 'Studiekeuze',
    'req'  => 0,
    'type' => 'TEXT',
    'opt'  => array("CONTAIN" => "Bevat")
 );  
 
  $queryarray['loopbaan']['huidigschooljaar'] = array(
    'name' => 'Huidig schooljaar',
    'req'  => 0,
    'type' => 'TEXT',
    'opt'  => array("<" => "Vroeger dan", "<=" => "Vroeger of gelijk aan", "=" => "om", ">=" => "Later of gelijk aan" , ">" => "Later dan")
 );  
 
  $queryarray['loopbaan']['keuzevakken'] = array(
    'name' => 'Keuzevakken',
    'req'  => 0,
    'type' => 'TEXT',
    'opt'  => array("CONTAIN" => "Bevat")
 );   

 
 $queryarray['loopbaan']['dubbele_afdruk'] = array(
    'name' => 'Dubbele afdruk',
    'req'  => 0,
    'type' => 'BOOL',
    'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
 );

 $queryarray['loopbaan']['toestemming_baso_werking'] = array(
    'name' => 'Toestemming BASO werking',
    'req'  => 0,
    'type' => 'BOOL',
    'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
 );
 
 $queryarray['vip']['middag'] = array(
    'name' => 'Middageten',
    'req'  => 0,
    'type' => 'BOOL',
    'opt'  => array("School" => "op school blijft en zijn / haar lunch gebruikt in de leerlingenrefter", "Thuis" => "naar huis komt")
 );
  
 $queryarray['vip']['thuis_opgevoed'] = array(
    'name' => 'Thuis opgevoed',
    'req'  => 0,
    'type' => 'BOOL',
    'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
 );

 $queryarray['vip']['opgevoed_postcode'] = array(
    'name' => 'Opgevoed postcode',
    'req'  => 0,
    'type' => 'TEXT',
    'opt'  => array("=" => "is", "!=" => "is niet", "BEG" => "begint met", "END" => "eindigt met", "CONTAIN" => "Bevat", ">=" => "Is groter of gelijk aan ", "<=" => "Is kleiner of gelijk aan")
 );
  
  $queryarray['vip']['door_beide_ouders_opgevoed'] = array(
    'name' => 'Opgevoed door beide ouders',
    'req'  => 0,
    'type' => 'BOOL',
    'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
 );

  $queryarray['vip']['opgevoed_door_andere'] = array(
    'name' => 'Opgevoed door andere',
    'req'  => 0,
    'type' => 'BOOL',
    'opt'  => array("Niet van toepassing" => "Niet van toepassing", "Gescheiden" => "Gescheiden", "1 ouder overleden" => "1 ouder overleden", "2 ouders overleden", "co-ouderschap" => "CO-Ouderschap")
 );
 
 $queryarray['vip']['thuistaal'] = array(
    'name' => 'Thuistaal',
    'req'  => 0,
    'type' => 'TEXT',
    'opt'  => array("CONTAIN" => "Bevat")
 );
 
 $queryarray['vip']['heeft_jaar_moeten_overdoen'] = array(
    'name' => 'Heeft jaar moeten overdoen',
    'req'  => 0,
    'type' => 'BOOL',
    'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
 );


 $queryarray['vip']['leerproblemen'] = array(
    'name' => 'Heeft leerproblemen',
    'req'  => 0,
    'type' => 'BOOL',
    'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
 );

 $queryarray['vip']['gezondheidsproblemen'] = array(
    'name' => 'Heeft gezondheidsproblemen',
    'req'  => 0,
    'type' => 'BOOL',
    'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
 );


 $queryarray['vip']['gedragsproblemen'] = array(
    'name' => 'Heeft gedragsproblemen',
    'req'  => 0,
    'type' => 'BOOL',
    'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
 );
 
 
 

 
 
 
 
 
 
 
    /*    
    
    
  $queryarray['customers']['store_id']['req']     = 1;
  $queryarray['customers']['store_id']['type']    = 'SET';
  $queryarray['customers']['store_id']['opt']     = array("=" => "is", "!=" => "is niet");
  $queryarray['customers']['store_id']['values']  = array("0" => "Geen store_id","1" => "Zumbashop", "3" => "Sportordersshop", "4" => "Firstclass Shop", "5" => "MP3 Shop");

  $queryarray['customers']['country']['req']  = 0;
  $queryarray['customers']['country']['type'] = 'TEXT';
  $queryarray['customers']['country']['opt']  = array("=" => "is", "!=" => "is niet");

  $queryarray['customers']['postal_code'] = array('req'  => 0,
                                                  'type' => 'TEXT',
                                                  'opt'  => array("=" => "is", "!=" => "is niet", "BEG" => "begint met", "!BEG" => "begint niet met", "END" => "eindigt met", "CONTAIN" => "Bevat", ">=" => "Is groter of gelijk aan ", "<=" => "Is kleiner of gelijk aan"));

  $queryarray['customers']['city'] = array('req'  => 0,
                                                  'type' => 'TEXT',
                                                  'opt'  => array("=" => "is", "!=" => "is niet", "BEG" => "begint met", "END" => "eindigt met", "CONTAIN" => "Bevat", ">=" => "Is groter of gelijk aan ", "<=" => "Is kleiner of gelijk aan"));



  $queryarray['customers']['name'] = array('req'  => 0,
                                           'type' => 'TEXT',
                                           'opt'  => array("CONTAIN" => "Bevat", "BEG" => "begint met", "END" => "eindigt met"));

  $queryarray['customers']['company_name'] = array('req'  => 0,
                                                   'type' => 'TEXT',
                                                   'opt'  => array("CONTAIN" => "Bevat", "BEG" => "begint met", "END" => "eindigt met"));

  $queryarray['customers']['email']        = array('req'  => 0,
                                                   'type' => 'TEXT',
                                                   'opt'  => array("CONTAIN" => "Bevat", "!CONTAIN" => "bevat niet", "BEG" => "begint met", "END" => "eindigt met"));
  
  $queryarray['customers']['dealer']       = array('req'  => 0,
                                                   'type' => 'SET',
                                                   'opt'  => array("CONTAIN" => "is waar", "!CONTAIN" => "is niet waar"),
                                                   'values' => array("i:3;s:3" => "Heeft Sportoders Handelaarsprijzen",
                                                                     "i:1;s:3" => "Heeft Zumbashop Handelaarsprijzen"));
  $queryarray['customers']['distributor']  = array('req'  => 0,
                                                   'type' => 'SET',
                                                   'opt'  => array("CONTAIN" => "is waar", "!CONTAIN" => "is niet waar"),
                                                   'values' => array("i:3;s:3" => "kan Sportoders bestellen zonder betalen",
                                                                     "i:1;s:3" => "kan Zumbashop bestellen zonder betalen"));
  
  $queryarray['customers']['CTS_Code']    = array('req'  => 0,
                                                  'type' => 'TEXT',
                                                  'opt'  => array("=" => "is", "!=" => "is niet", "BEG" => "begint met", "END" => "eindigt met", "CONTAIN" => "Bevat"));

  $queryarray['customers']['vat_code']     = array('req'  => 0,
                                                   'type' => 'SET',
                                                   'opt'  => array("=" => "is", "!=" => "is niet"),
                                                   'values' => array('1' => 'Geldig BTW Nummer'));
                                                   
  $queryarray['customers']['vat_nr']       = array('req'  => 0,
                                                   'type' => 'TEXT',
                                                  'opt'  => array("=" => "is", "!=" => "is niet", "BEG" => "begint met", "END" => "eindigt met", "CONTAIN" => "Bevat"));

  $queryarray['customers']['zumba_status'] = array('req'  => 0,
                                                   'type' => 'SET',
                                                   'opt'  => array("=" => "is", "!=" => "is niet"),
                                                   'values' => array('4' => 'ZIN MEMBER'));
                                                   
 $queryarray['customers']['emailing']      = array('req'  => 0,
                                                   'type' => 'BOOL',
                                                   'opt'  => array("true" => "JA", "false" => "NEE"));
                                                   
 $queryarray['customers']['papermailing']  = array('req'  => 0,
                                                   'type' => 'BOOL',
                                                   'opt'  => array("true" => "JA", "false" => "NEE"));
                                                   
 $queryarray['customers']['invoicebymail'] = array('req'  => 0,
                                                   'type' => 'BOOL',
                                                   'opt'  => array("true" => "JA", "false" => "NEE"));
                                                   
 $queryarray['customers']['birth_date']    = array('req'  => 0,
                                                  'type' => 'TEXT',
                                                  'opt'  => array("=" => "is", "!=" => "is niet", "BEG" => "begint met", "END" => "eindigt met", "CONTAIN" => "Bevat"));

                                                   
  $queryarray['customers']['rating']       = array('req'  => 0,
                                                   'type' => 'TEXT',
                                                   'opt'  => array("=" => "Is", "<" => "< kleiner dan", ">" => "> groter dan", "!=" => "Is niet"));
                                                   

  $queryarray['customers']['branche']['type']    = 'SET';
  $queryarray['customers']['branche']['opt']     = array("CONTAIN" => "BEVAT", "!CONTAIN" => "bevat niet", "!=" => "is niet", "=" => "is", "!=N;" => "is niet N;");
  $queryarray['customers']['branche']['values']  = $branches;

  $queryarray['customers']['account_status']['type']    = 'SET';
  $queryarray['customers']['account_status']['opt']     = array("=" => "is", "!=" => "is niet");
  $queryarray['customers']['account_status']['values']  = $accountstatusses;

  $queryarray['customers']['discount_code']['req']     = 0;
  $queryarray['customers']['discount_code']['type']    = 'TEXT';
  $queryarray['customers']['discount_code']['opt']     = array("=" => "is", "!=" => "is niet", "CONTAIN" => "Bevat", "!CONTAIN" => "Bevat niet");

  $queryarray['customers']['representative']['type']    = 'SET';
  $queryarray['customers']['representative']['opt']     = array("=" => "is", "!=" => "is niet", "!=" => "is niet");
  $queryarray['customers']['representative']['values']  = $representatives;

  $queryarray['customers']['language'] = array('req'  => 0,
                                                   'type' => 'SET',
                                                   'opt'  => array("=" => "is", "!=" => "is niet"),
                                                   'values' => array('nl' => 'Nederlands','fr' => 'Frans', 'en' => 'Engels', 'it' => 'Italiaans', 'de' => 'Duits', 'es' => 'Spaans', 'cz' => 'Tsjechisch'));  
                                                   
  
  $queryarray['customers']['lyoness_cart_nr']   = array('req'  => 0,
                                                        'type' => 'TEXT',
                                                        'opt'  => array("=" => "is", "!=" => "is niet", "BEG" => "begint met", "END" => "eindigt met", "CONTAIN" => "Bevat"));                                                   

*/    


/**
* ==================== SELECTIE VELDEN VOOR IN RESULTATEN LIJST
**/
    
 $columnsarray['afspraken'] = array(
    "dag" => "Afspraakdag",
    "uur" => "Afspraakuur"
 );
    
 $columnsarray['communicatie'] = array(
    "telefoon" => "Communicatie telefoon",
    "email" => "Communicatie email"
 );
 
 $columnsarray['leerlingen'] = array(
     "naam" => "Naam",
     "voornaam" => "Voornaam",
     "geslacht" => "Geslacht",
     "geboortedatum" => "Geboortedatum",
     "geboorteplaats" => "Geboorteplaats",
     "nationaliteit" => "Nationaliteit",
     "belgisch_rijksregisternummer_of_bisnummer" => "Rijksregister nr",
     "straat" => "Straat",
     "huisnummer" => "Huisnummer",
     "busnummer" => "Busnummer",
     "postcode" => "Postcode",
     "plaats" => "Gemeente",
     "email" => "Email",
     "tel" => "Telefoon",
     "gsm" => "GSM",
     "tel_noodnummer" => "Noodnummer",
     "school_vorig_schooljaar" => "Vorige school"
 );
    
    
 $columnsarray['loopbaan'] = array(
    "studiekeuze" => "Studiekeuze",
    "huidigschooljaar" => "Huidigschooljaar",
    "keuzevakken" => "Keuzevakken",
    "dubbele_afdruk" => "Dubbele afdruk",
    "gok_moeder_edison_spreektaal" => "Spreektaal moeder",
    "gok_vader_edison_spreektaal" => "Spreektaal vader",
    "gok_broer_zus_edison_spreektaal" => "Spreektaal broer of zus",
    "gok_vrienden_edison_spreektaal" => "Spreektaal vrienden",
    "gok_edison_opleidingsniveau_moeder" => "Opleidingsniveau moeder",
    "toestemming_baso_werking" => "Toestemming BASO werking"
 );
    
 $columnsarray['moeder'] = array(
    "moeder_naam" => "Naam",
    "moeder_voornaam" => "Voornaam",
    "moeder_beroep" => "Beroep",
    "moeder_straat" => "Straat",
    "moeder_huisnummer" => "Huisnummer",
    "moeder_busnummer" => "Busnummer",
    "moeder_postcode" => "Postcode",
    "moeder_plaats" => "Gemeente",
    "moeder_gsm" => "GSM",
    "moeder_email" => "Email"
 );
 
 $columnsarray['vader'] = array(
    "vader_naam" => "Naam",
    "vader_voornaam" => "Voornaam",
    "vader_beroep" => "Beroep",
    "vader_straat" => "Straat",
    "vader_huisnummer" => "Huisnummer",
    "vader_busnummer" => "Busnummer",
    "vader_postcode" => "Postcode",
    "vader_plaats" => "Gemeente",
    "vader_gsm" => "GSM",
    "vader_email" => "Email"
 );
 
 $columnsarray['vip'] = array(
    "middag" => "Middag thuis",
    "middag_straat" => "Middag straat",
    "middag_huisnummer" => "Middag huisnummer",
    "middag_busnummer" => "Middag busnummer",
    "middag_postcode" => "Middag postcode",
    "middag_plaats" => "Middag plaats",
    "thuis_opgevoed" => "Thuis opgevoed",
    "opgevoed_straat" => "Opgevoed straat",
    "opgevoed_huisnummer" => "Opgevoed huisnummer",
    "opgevoed_busnummer" => "Opgevoed busnummer",
    "opgevoed_postcode" => "Opgevoed postcode",
    "opgevoed_plaats" => "Opgevoed plaats",
    "door_beide_ouders_opgevoed" => "Door beide ouders opgevoed",
    "opgevoed_door_andere" => "Opgevoed door andere",
    "andere_info" => "Andere info",
    "thuistaal" => "Thuistaal",
    "heeft_jaar_moeten_overdoen" => "Heef jaar moeten overdoen",
    "jaar_overdoen_welke" => "Jaar overdoen welke",
    "leerproblemen" => "Leerproblemen",
    "leerproblemen_extra" => "Leerproblemen extra",
    "gezondheidsproblemen" => "Gezondheidsproblemen",
    "gezondheidsproblemen_extra" => "Gezondheidsproblemen extra",
    "gedragsproblemen" => "Gedragsproblemen",
    "gedragsproblemen_extra" => "Gedragsprolemen extra"
 );
    

    
?>