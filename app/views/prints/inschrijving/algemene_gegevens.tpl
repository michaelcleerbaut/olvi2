<?
  $busnr = $leerling['busnummer'] != "" ? " bus:" . $leerling['busnummer'] . " " : " ";
  $busnrMoeder = $leerling['moeder_busnummer'] != "" ? " bus: " . $leerling['moeder_busnummer'] . ", " : " "; 
  $busnrVader = $leerling['vader_busnummer'] != "" ? " bus: " . $leerling['vader_busnummer'] . ", " : " "; 
  $busnrTweedeVerblijf = $leerling['tweede_verblijf_bus_nummer'] != "" ? " bus: " . $leerling['tweede_verblijf_bus_nummer'] . ", " : " "; 
?>

<div style="border-bottom: solid thin #000;height: 80px;position: relative;">
    <img src="/public/img/olvi_logo.png" width="80" style="position: absolute;margin-left:300px;" />
    
    <div style="float:left;">
        <span style="font-size:14px;">OLVI-MIDDENSCHOOL BOOM</span><br>
        Brandstraat 44<br>
        2850 Boom    
    </div>
            
    <table style="float:right;">
        <tr><td style="width:120px;">Inschrijvingsnummer:</td><td><strong><?=$leerling['volgnummer'];?></strong></td></tr>
        <tr><td>Datum:</td><td><?=date("d-M-Y");?></td></tr>
        <tr><td>Uur:</td><td><?=date("H:i");?></td></tr>
    </table>
</div>


<h2 style="text-align:center;">INSCHRIJVING voor het schooljaar <?=$huidigschooljaar;?></h2>
<h3 style="text-align:center;">EERSTE JAAR <?=$leerling['stroom'];?> -stroom</h3>

<table cellspacing="10">
    <tr>
        <td style="width: 100px;">Naam:</td><td style="width: 250px;"><?=$leerling['naam'];?></td>
        <td style="width: 100px;">Geslacht:</td><td><?=$leerling['geslacht'];?></td>    
    </tr>
    <tr>
        <td>Voornaam:</td><td><?=$leerling['voornaam'];?></td>
        <td>Geboorteplaats:</td><td><?=$leerling['geboorteplaats'];?></td>
    </tr>
    <tr>
        <td>Geboortedatum:</td><td><?=date("d-M-Y", strtotime($leerling['geboortedatum']));?></td>
        <td>Rijksregisternummer:</td><td><?=$leerling['belgisch_rijksregisternummer_of_bisnummer'];?></td>
    </tr>
    <tr>
        <td>Adres leerling:</td><td><?=$leerling['straat'] . " " . $leerling['huisnummer'] . $busnr . ", " . $leerling['postcode'] . " " . $leerling['plaats']; ?></td>
        <td>Nationaliteit:</td><td><?=$leerling['nationaliteit'];?></td>
    </tr>
    <tr>
        <td>Telefoon leerling:</td><td><?=$leerling['tel'];?></td>
        <td>Adres niet bij ouders:</td><td><?=$leerling['tweede_verblijf_straat'] . " " . $leerling['tweede_verblijf_huisnummer'] . $busnrTweedeVerblijf . $leerling['tweede_verblijf_postcode'] . " " . $leerling['tweede_verblijf_plaats'];?></td>
    </tr>
    <tr>
        <td>Email leerling:</td><td><?=$leerling['email'];?></td>
        <td>Telefoon noodnr:</td><td><?=$leerling['tel_noodnummer'];?></td>
    </tr>
    <tr>
        <td>Naam moeder:</td><td><?=$leerling['moeder_voornaam'] . " " . $leerling['moeder_naam'];?></td>
        <td>Naam vader:</td><td><?=$leerling['vader_voornaam'] . " " . $leerling['vader_naam'];?></td>
    </tr>
    <tr>
        <td colspan="2">Indien verschillend, adres moeder:</td>
        <td colspan="2">Indien verschillend, adres vader:</td>
    </tr>
    <tr>
        <td>Straat + Nummer:</td><td><?=$leerling['moeder_straat'] . " " . $leerling['moeder_huisnummer'] . $busnrMoeder; ?></td>
        <td>Straat + Nummer:</td><td><?=$leerling['vader_straat'] . " " . $leerling['vader_huisnummer'] . $busnrVader; ?></td>
    </tr>
    <tr>
        <td>Postcode:</td><td><?=$leerling['moeder_postcode'];?></td>
        <td>Postcode:</td><td><?=$leerling['vader_postcode'];?></td>
    </tr>
    <tr>
        <td>Plaats:</td><td><?=$leerling['moeder_plaats'];?></td>
        <td>Plaats:</td><td><?=$leerling['vader_plaats'];?></td>
    </tr>
    <tr>
        <td>Tel moeder:</td><td><?=$leerling['moeder_gsm'];?></td>
        <td>Tel vader:</td><td><?=$leerling['vader_gsm'];?></td>
    </tr>
    <tr>
        <td>Email moeder:</td><td><?=$leerling['moeder_email'];?></td>
        <td>Email vader:</td><td><?=$leerling['vader_email'];?></td>
    </tr>
    <tr>
        <td>Dubbele post:</td>
        <td colspan="3"><?=$leerling['dubbele_afdruk'];?></td>
    </tr>
</table>

<div style="border: solid thin #000;padding: 5px 30px 5px 30px;min-height:100px;">
<?
    $studiekeuze = is_array(unserialize($leerling['studiekeuze'])) ? unserialize($leerling['studiekeuze']) : array();
    if(array_key_exists("A",$studiekeuze) && array_key_exists("B",$studiekeuze)){
?>
    <table><tr><td style="width:300px;" valign="top">
    <strong><u>Interessedomein A-Stroom:</u></strong><br>
    <span style="font-size: 16px;"><?=strtoupper($studiekeuze['A']);?></span>
    <p><?=$keuzevakkenprint;?></p>
    </td><td valign="top">
    <strong><u>Interessedomein B-Stroom:</u></strong><br>
    <span style="font-size: 16px;"><?=strtoupper($studiekeuze['B']);?></span>
    </td></tr></table>
<?
    } else {
        foreach($studiekeuze as $stroom => $keuze){
?>
    <strong><u>Interessedomein <?=$stroom;?>-Stroom:</u></strong><br>
    <span style="font-size: 16px;"><?=strtoupper($keuze);?></span>
    <p><?=$keuzevakkenprint;?></p>
<?    
        }
    }
?>
</div>

Laatst bezochte school: <?=$leerling['school_vorig_schooljaar'];?>

<table style="margin-top: 30px;" cellspacing="10">
    <tr>
        <td valign="top"><div style="width: 10px;height:10px;border: solid thin #000;"></div></td>
        <td>Ik heb mijn zoon/dochter reeds ingeschreven in een andere school en zal de inschrijving in OLVI-middenschool voor 1-jul-2013 bevestigen of annuleren.</td>
    </tr>
    <tr>
        <td valign="top"><div style="width: 10px;height:10px;border: solid thin #000;"></div></td>    
        <td>Ik zal mijn zoon/dochter ook nog in een andere school inschrijven en zal de inschrijving in OLVI-middenschool voor 01-jul-2013 bevestigen of annuleren.</td>
    </tr>
</table>

<strong>Handtekening en naam ouder(s)/voogd</strong>:



<div style="border-bottom:solid thin #000;height:1px;width:300px;margin-top: 50px;"></div>

<div style="margin-top:10px;">
    Deze inschrijving wordt pas definitief nadat aan de wettelijke verplichten is voldaan (correct getuigschrift basisonderwijs, akkoord met schoolreglement en de
    opvoedingsproject - pag. 2 schoolreglement).
</div>

<div style="margin-top: 10px;font-size:10px;" class="fontlicht">
    De Wet Verwerking Persoonsgegevens (08.12.1992) is van toepassing op de persoonsgegevens die met dit formulier opgevraagd worden. Je hebt het recht deze gegevens
    op te vragen en zo nodig te laten verbeteren. De verwerking van deze gegevens is ingeschreven in het openbaar register. <br>Je kan dit register raadplegen bij
    de commissie van de bescherming van de persoonlijke levenssfeer (Regentschapstraat 61, 1000 Brussel).
</div>
