<div style="border-bottom: solid thin #000;height: 80px;position: relative;">
    <img src="/public/img/olvi_logo.png" width="80" style="position: absolute;margin-left:300px;" />
    
    <div style="float:left;">
        <span style="font-size:14px;">OLVI-MIDDENSCHOOL BOOM</span><br>
        Brandstraat 44<br>
        2850 Boom    
    </div>
            
    <table style="float:right;">
        <? if($volgnummerA != ""){ ?><tr><td style="width:150px;">Volgnummer A-Stroom:</td><td align="right"><strong><?=$volgnummerA;?></strong></td></tr><? } ?>
        <? if($volgnummerB != "" ){ ?><tr><td style="width:150px;">Volgnummer B-Stroom:</td><td align="right"><strong><?=$volgnummerB;?></strong></td></tr><? } ?>
    </table>
</div>


<h2 style="text-align:center;">Bewijs van voorinschrijving voor het schooljaar <?=$huidigschooljaar;?></h2>


<h4>Gegevens die u tijdens de voorinschrijvingsprocedure ingevuld heeft.</h4>
<h5 style="margin-top:30px;">Persoonlijke gegevens</h5>
<table style="border: solid thin #000;width:100%;" cellpadding="10">
    <tr><td style="width:250px;">Naam</td><td><?=$leerling['naam'] . " " . $leerling['voornaam'];?></td></tr>
    <tr><td>Straat + nr</td><td><?=$leerling['straat'] . " " . $leerling['huisnummer'] . " " . $busnummer;?></td></tr>
    <tr><td>Postcode + gemeente</td><td><?=$leerling['postcode'] . " " . $leerling['plaats'];?></td></tr>
    <tr><td>Lagere school</td><td><?=$leerling['school_vorig_schooljaar'];?></td></tr>
    <?=$studiekeuze;?>
</table>


<h5 style="margin-top:30px;">Communicatiegegevens</h5>
<table style="border: solid thin #000;width:100%;" cellpadding="10">
    <tr><td style="width:250px;">Telefoon</td><td><?=$leerling['telefoon'];?></td></tr>
    <tr><td>Email</td><td><?=$leerling['email'];?></td></tr>
</table>



<div style="border: solid thin #000;width:668px;margin-top: 50px;padding:20px 0px 20px 0px;text-align:center;">
    <?=$afspraak;?>
</div>


<div style="margin-top:50px;">
<strong>Wat mag u zeker niet vergeten mee te brengen naar uw afspraak?</strong><br>

<ul>
    <li>Dit document</li>
    <li>SIS-kaart en/of identiteitskaart van uw zoon/dochter</li>
</ul>
</div>


<div style="margin-top: 230px;border-top: solid thin #000;text-align:right;font-size:10px;">
<?=date("d/m/Y");?>
</div>