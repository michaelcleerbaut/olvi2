<div style="font-weight:bold;padding-bottom:10px;border-bottom:solid thin #000;">
    Onze-Lieve-Vrouwinstituut Boom VZW - Bassinstraat 15 - 2850 Boom
</div>

<div style="margin-top:30px;"><strong>OLVI-MIDDENSCHOOL BOOM</strong></div>

<table style="font-weight: bold;margin-top:10px;" cellspacing="0" cellpadding="0">
    <tr>
        <td style="width: 150px;">Brandstraat 44</td>
        <td style="width: 150px;">tel. 03 880 26 70</td>
        <td style="width: 150px;">fax. 03 880 26 79</td>
        <td style="color: #7399c4;">info.middenschool@olviboom.be</td>
    </tr>
</table>


<table style="width:100%;margin-top: 20px;">
    <tr>
        <td style="width: 120px;">Ondergetekende(n), </td>
        <td>
            <div style="width:100%;border-bottom:dotted thin #000;">&nbsp; <?=$leerling['vader_naam'] . " " . $leerling['vader_voornaam'] . ", " . $leerling['moeder_naam'] . " " . $leerling['moeder_voornaam']; ?></div>
        </td>
    </tr>
</table>


<table style="width:100%;margin-top: 20px;">
    <tr>
        <td style="width: 120px;">Ouder(s), voogd van </td>
        <td style="width: 250px;">
            <div style="border-bottom: dotted thin #000;"><?=$leerling['naam'] . " " . $leerling['voornaam']; ?></div>        
        </td>
        <td style="width: 100px;">
           inschrijvingsnummer
        </td>
        <td style="border-bottom: dotted thin #000;padding-left: 10px;">
            <strong><?=$leerling['volgnummer'];?></strong>
        </td>
    </tr>
</table>

<p>verklaren hierbij dat hun zoon / dochter tijdens de middagpauze</p>

<div style="text-align:center;font-weight: bold;">
    <?=$leerling['middag'];?>
</div>

<div style="margin-top: 40px;">
    adres waar de leerling tijdens de middagpauze verblijft (indien anders dan het thuisadres):
</div>

<div style="border-bottom: dotted thin #000;margin-top: 15px;">   &nbsp;
    <?
        $busnr = $leerling['middag_busnummer'] != "" ? "bus: " . $leerling['middag_busnummer'] . ", " : ""; 
        $adres = $leerling['middag_straat'] != "" ? $leerling['middag_straat'] . " " . $leerling['middag_huisnummer'] . $busnr . $leerling['middag_postcode'] . " " . $leerling['middag_plaats'] : $leerling['straat'] . " " . $leerling['huisnummer'] . ", " . $leerling['postcode'] . " " . $leerling['plaats'];
        echo substr($leerling['middag'],0,9) == "op school" ? "" : $adres; 
    ?>
</div>

<div style="margin-left: 400px;margin-top: 40px;">Handtekening(en)</div>

<div style="width:200px;margin-top:40px;border-bottom: dotted thin #000;margin-left:200px;float:left;">&nbsp;</div>
<div style="width:200px;margin-top:40px;border-bottom: dotted thin #000;margin-left:70px;float:left;">&nbsp;</div>