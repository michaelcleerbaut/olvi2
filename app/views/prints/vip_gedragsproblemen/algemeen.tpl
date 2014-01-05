<img src="/public/img/olvi_logo.png" width="80" style="position: absolute;top:10px;" />

<div style="border-bottom: solid thin #000;margin-bottom:10px;padding-bottom:10px;position: relative;">    
    <div style="text-align:center;font-size: 26px;font-weight: bold;margin-top:10px;">
        VIP: GEDRAGSPROBLEMEN
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
        <td style="width:20px;"><?=$chk_gedragsstoornis;?></td>
        <td style="width: 200px;">Gedragsstoornis</td>
        <td style="width:20px;"><?=$chk_adhd;?></td>
        <td style="width: 200px;">ADHD</td>
        <td style="width:20px;"><?=$chk_hsp;?></td>
        <td style="width: 200px;">HSP</td>
    </tr>
    <tr>
        <td><?=$chk_autismespectrumstoornis;?></td>
        <td colspan="3">Autismespectrumstoornis: <?=$autismespectrumstoornis;?></td>
        <td><?=$chk_andere;?></td>
        <td>Andere:<?=$problemen_andere;?></td>
    </tr>
</table>


<table class="vip_tabel vip_tabel_meerdere_kolommen" cellspacing="0" cellpadding="7" border="1">
    <tr>
        <td colspan="4" style="height:10px;border: none;"></td>
        <td style="height:10px;">Extra info of vraag</td>
    </tr>
    <!--
    <tr>
        <td valign="top">Gedragsproblemen<br>thuis?</td>
        <td valign="top"><?=$gedragsproblemen_thuis_ja;?></td>
        <td valign="top"><?=$gedragsproblemen_thuis_nee;?></td>
        <td valign="top">
            Welke? <?=$leerling['gedragsproblemen_thuis_welke'];?><br>            
        </td>
        <td valign="top"><?=$leerling['gedragsproblemen_thuis_extra'];?></td>
    </tr>
    <tr>
        <td valign="top">Gedragsproblemen<br>school?</td>
        <td valign="top"><?=$gedragsproblemen_school_ja;?></td>
        <td valign="top"><?=$gedragsproblemen_school_nee;?></td>
        <td valign="top">
            Welke? <?=$leerling['gedragsproblemen_school_welke'];?><br>            
        </td>
        <td valign="top"><?=$leerling['gedragsproblemen_school_extra'];?></td>
    </tr>
    -->
    <tr>
        <td colspan="5" valign="top" style="height:400px;"><strong>Omschrijving:</strong> <?=$leerling['omschrijving'];?></td>
    </tr>    
    <tr>
        <td valign="top">Externe begeleiding? <br><br>Zo ja, nu nog?</td>
        <td valign="top"><?=$begeleiding_ja;?><br><br><?=$begeleiding_nunog_ja;?></td>
        <td valign="top"><?=$begeleiding_nee;?><br><br><?=$begeleiding_nunog_nee;?></td>
        <td valign="top">
            Wanneer? <?=$leerling['begeleiding_wanneer'];?><br>
            Waar? <?=$leerling['begeleiding_waar'];?>        
        </td>
        <td valign="top"><?=$leerling['begeleiding_extra'];?></td>
    </tr>
    <tr>
        <td valign="top" style="height:40px;">Attesten / verslagen?</td>
        <td valign="top" style="height:40px;"><?=$attesten_ja;?></td>
        <td valign="top" style="height:40px;"><?=$attesten_nee;?></td>
        <td valign="top" style="height:40px;">
            <?=$leerling['attesten_extra'];?>
        </td>
        <td valign="top" style="height:40px;"><i>NOTEREN op geheugensteuntje ouders</i></td>
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