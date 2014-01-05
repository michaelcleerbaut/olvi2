<img src="/public/img/olvi_logo.png" width="80" style="position: absolute;top:10px;" />

<div style="border-bottom: solid thin #000;margin-bottom:10px;padding-bottom:10px;position: relative;">    
    <div style="text-align:center;font-size: 26px;font-weight: bold;margin-top:10px;">
        VIP: ERNSTIGE<br> GEZONDHEIDSPROBLEMEN
    </div>
    
    <table style="width: 100%;margin-top:0px;">
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
            <tr>
                <td valign="top">Laatst bezochte school:</td>
                <td><?=$leerling['school_vorig_schooljaar'];?></td>
            </tr>
        </table>            
      </td>
     </tr>
    </table>    
</div>



<table>
    <tr>
        <td style="width:20px;"><?=$chk_hartkwaal;?></td>
        <td style="width: 200px;">Hartkwaal</td>
        <td style="width:20px;"><?=$chk_longaandoening;?></td>
        <td style="width: 200px;">Longaandoening</td>
        <td style="width:20px;"><?=$chk_epilepsie;?></td>
        <td style="width: 200px;">Epilepsie</td>
    </tr>
    <tr>
        <td style="width:20px;"><?=$chk_kataplexie;?></td>
        <td style="width: 200px;">Kataplexie</td>
        <td style="width:20px;"><?=$chk_narcolepsie;?></td>
        <td style="width: 200px;">Narcolepsie</td>
        <td style="width:20px;"><?=$chk_gezichtsproblemen;?></td>
        <td style="width: 200px;">Gezichtsproblemen</td>
    </tr>
    <tr>
        <td style="width:20px;"><?=$chk_gehoorsproblemen;?></td>
        <td style="width: 200px;">Gehoorsproblemen</td>
        <td style="width:20px;"><?=$chk_spraakstoornis;?></td>
        <td style="width: 200px;">Spraakstoornis</td>
        <td style="width:20px;"><?=$chk_andere;?></td>
        <td style="width: 200px;">Andere: <?=$problemen_andere;?></td>
    </tr>
       
</table>


<table class="vip_tabel vip_tabel_meerdere_kolommen" cellspacing="0" cellpadding="7" border="1">
<!--
    <tr>
        <td valign="top">Bijkomende<br>informatie?</td>
        <td valign="top" colspan="4"><?=$leerling['bijkomende_informatie'];?></td>        
    </tr>
    <tr>
        <td valign="top">Signalen:</td>
        <td valign="top" colspan="4"><?=$leerling['signalen'];?></td>        
    </tr>
    <tr>
        <td valign="top">Wat zeker doen?</td>
        <td valign="top" colspan="4"><?=$leerling['wat_zeker_doen'];?></td>        
    </tr>
    <tr>
        <td valign="top">Wat zeker niet doen??</td>
        <td valign="top" colspan="4"><?=$leerling['wat_zeker_niet_doen'];?></td>        
    </tr>
    <tr>
-->
    <tr>
        <td colspan="5" valign="top" style="height:500px;"><strong>Omschrijving:</strong> <?=$leerling['omschrijving'];?></td>
    </tr>    

        <td valign="top" style="height:40px;">Attesten / verslagen?</td>
        <td valign="top" style="height:40px;"><?=$attesten_ja;?></td>
        <td valign="top" style="height:40px;"><?=$attesten_nee;?></td>
        <td valign="top" style="height:40px;">
            <?=$leerling['attesten_extra'];?>
        </td>
        <td valign="top" style="height:40px;"><i>NOTEREN op geheugensteuntje ouders</i></td>
    </tr>
</table>


<table style="margin-top:20px;" border="0" cellspacing="0" cellpadding="0">
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

<hr style="height:2px;margin-top:20px;border:none;background-color:#000;" />

<div style="margin-top:20px;font-size:10px;">
    <table>
        <tr>
            <td style="width:250px;">Gesprek gevoerd door: <?=$leerling['opgemaakt_door'];?></td>
            <td>op <?=date("d M Y");?></td>
        </tr>
    </table>
</div>