<div style="border-bottom: solid thin #000;height: 80px;position: relative;">
    <img src="/public/img/olvi_logo.png" width="80" style="position: absolute;margin-left:300px;" />
    
    <div style="float:left;">
        <span style="font-size:14px;">OLVI-MIDDENSCHOOL BOOM</span><br>
        Brandstraat 44<br>
        2850 Boom    
    </div>
            
    <table style="float:right;">
        <tr><td style="width:120px;">Inschrijvingsnummer:</td><td><strong><?=$leerling['volgnummer'];?></strong></td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td>Datum:</td><td><?=date("d-M-Y");?></td></tr>
    </table>
</div>

<h2 style="text-align:center;">BaSO-werking</h2>


<table style="margin-top:80px;width:100%;">
    <tr>
        <td style="width: 50px;" valign="top">Naam:</td>
        <td style="border-bottom: dotted thin #000;padding-bottom: 3px;"><?=$leerling['naam'] . " " . $leerling['voornaam']; ?></td>
    </tr>
</table>

<div style="margin-top: 30px;">
    Onze school werkt nauw samen met de collega's van verschillende lagere scholen om de overgang
    van het basisonderwijs naar het secundair onderwijs voor de leerlingen zo goed mogelijk te begeleiden.
</div>

<div style="margin-top: 20px;">
    Om dat mogelijk te maken, geven de leerling en zijn / haar ouders (of voogd) aan de leerlingenbegeleiding 
    van de secundaire school de toestemming om gedurende het 1ste en het 2de jaar van het secundair onderwijs
    aan de lagere school mee te delen:
</div>

<ul style="margin-top: 20px;margin-left: 80px;">
    <li style="margin-top:10px;">De resultaten van het 1ste trimester in het 1ste en het 2de jaar.</li>
    <li style="margin-top:10px;">De resultaten op het einde van het 1ste en het 2de jaar.</li>
    <li style="margin-top:10px;">Het attest dat de leerling op het einde van het 1ste en het 2de jaar heeft behaald.</li>
</ul>


<div style="text-align:center;">
<?=$leerling['toestemming_baso_werking'] == "NO" ? "<span style=\"text-decoration:line-through;\">JA</span>" : "JA"; ?> / 
<?=$leerling['toestemming_baso_werking'] == "YES" ? "<span style=\"text-decoration:line-through;\">NEEN</span>" : "NEEN"; ?><br><br>
(Schrappen wat niet past)
</div>


<div style="margin-top: 150px;">

    <div style="float:left;">
        Handtekening leerling,
        <div style="margin-top: 50px;height:0px;border: solid thin #000;width: 150px;"></div>
    </div>

    <div style="float:left;margin-left:350px;">
        Handtekening ouder of voogd
        <div style="margin-top: 50px;height:0px;border: solid thin #000;width: 150px;"></div>
    </div>


</div>