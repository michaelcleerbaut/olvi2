<img src="/public/img/olvi_logo.png" width="80" style="position: absolute;top:10px;" />

<div style="border-bottom: solid thin #000;margin-bottom:10px;padding-bottom:10px;position: relative;">    
    <div style="text-align:center;font-size: 26px;font-weight: bold;margin-top:10px;">
        VIP: ANDERE PROBLEMEN
    </div>
    
    <table style="width: 100%;margin-top:20px;">
     <tr>
      <td style="width:270px;">
        <table>
            <tr>
                <td>Naam:</td>
                <td><?=$leerling['naam'] . " " . $leerling['voornaam'];?></td>
            </tr>
            <tr>
                <td>Keuze:</td>
                <td></td>
            </tr>
            <tr>
                <td>Klas:</td>
                <td></td>
            </tr>
        </table>
      </td>
      <td>
        <table>
            <tr>
                <td style="width:130px;">Inschrijvingsnummer:</td>
                <td><?=$leerling['volgnummer'];?></td>
            </tr>
            <tr>
                <td>Geboortedatum:</td>
                <td><?=date("d M Y", strtotime($leerling['geboortedatum']));?></td>
            </tr>
        </table>            
      </td>
     </tr>
    </table>    
</div>



<table class="vip_tabel vip_tabel_meerdere_kolommen" cellspacing="0" cellpadding="7" border="1" style="width:100%;">
    <tr>
        <td valign="top" style="height:600px;">
            <strong>Soort:</strong> <?=$leerling['soort'];?><br><br>
            <strong>Omschrijving:</strong> <?=$leerling['omschrijving'];?>
        </td>
    </tr>    
</table>


<table style="margin-top:10px;" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <table cellspacing="0" cellpadding="7" border="1">
                <tr>
                    <td style="width:170px;">Kandidaat klassenraad?</td>
                    <td style="width: 20px;"><?=$klassenraad_ja;?></td>
                    <td style="width: 20px;"><?=$klassenraad_nee;?></td>
                    <td style="width:170px;border-left: solid medium #000;">Gesprek CLB?</td>
                    <td style="width: 20px;"><?=$gesprek_clb_ja;?></td>
                    <td style="width: 20px;"><?=$gesprek_clb_nee;?></td>
                    <td style="width:170px;border-left: solid medium #000;">Gesprek Titularis?</td>
                    <td style="width: 20px;"><?=$gesprek_titularis_ja;?></td>
                    <td style="width: 20px;"><?=$gesprek_titularis_nee;?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<hr style="height:2px;margin-top:10px;border:none;background-color:#000;" />

<div style="margin-top:20px;font-size:10px;">
    <table>
        <tr>
            <td style="width:250px;">Gesprek gevoerd door: <?=$leerling['opgemaakt_door'];?></td>
            <td>op <?=date("d M Y");?></td>
        </tr>
    </table>
</div>