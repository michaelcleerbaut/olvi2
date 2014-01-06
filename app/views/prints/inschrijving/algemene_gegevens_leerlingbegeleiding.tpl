<?
    $busnrOpgevoed = $leerling['opgevoed_busnummer'] != "" ?  " bus: " . $leerling['opgevoed_busnummer'] : " ";
?>
<div style="height: 80px;position: relative;">
    
    <div style="float:left;">
        <span style="font-size:14px;">OLVI-MIDDENSCHOOL BOOM</span><br>
        Brandstraat 44<br>
        2850 Boom    
    </div>
    
    <div style="float:right;">
        Inschrijvingsnummer: &nbsp;&nbsp;&nbsp;&nbsp; <?=$leerling['volgnummer'];?>
    </div>

</div>

<div style="padding: 5px 5px 5px 5px;border-top: solid medium #000;border-bottom: solid medium #000;letter-spacing: 5px;font-size: 16px;font-weight:bold;text-align:center;">
    ALGEMENE GEGEVENS LEERLINGBEGELEIDING
</div>


<div style="margin-top:20px;">
    
    <table style="width:100%;">
        <tr>
            <td style="width: 50px;">NAAM:</td>
            <td style="width: 400px;border-bottom: dotted thin #000;"><?=$leerling['naam'] . " " . $leerling['voornaam'];?></td>
            <td style="width: 50px;">KLAS:</td>
            <td style="border-bottom: dotted thin #000;"></td>
        </tr>
    </table>    

    <table style="margin-top: 10px;">
        <tr>
            <td style="width: 110px;">Geboortedatum:</td>
            <td style="width: 200px;border-bottom: dotted thin #000;"><?=date("d-M-Y", strtotime($leerling['geboortedatum']));?></td> 
        </tr>
    </table>
    
</div>


<div style="border:solid thin #000;height:0px;margin-top: 15px;"> </div>


<!--
<table style="margin-top: 20px;">
    <tr>
        <td style="width: 300px;">Wordt de leerling thuis opgevoed?</td>
        <td><?=$leerling['thuis_opgevoed'];?></td>
    </tr>
</table>

<table style="width: 100%;margin-top: 10px;">
    <tr>
        <td style="padding-left: 50px;width: 150px;" valign="top">Zo nee: waar of bij wie?</td>
        <td>
            <div style="width:100%;border-bottom: dotted thin #000;">&nbsp;<?=$leerling['opgevoed_straat'] . " " . $leerling['opgevoed_huisnummer'] . $busnrOpgevoed;?></div>
            <div style="width:100%;border-bottom: dotted thin #000;margin-top: 20px;">&nbsp;<?=$leerling['opgevoed_postcode'] . " " . $leerling['opgevoed_plaats'];?></div>
        </td>
    </tr>
</table>
-->

<table style="margin-top: 20px;">
    <tr>
        <td style="width: 300px;">Wordt de leerling door beide ouders opgevoed?</td>
        <td><?=$leerling['door_beide_ouders_opgevoed'];?></td>
    </tr>
</table>


<table style="margin-top: 10px;margin-left: 50px;">
    <tr>
        <td style="width: 50px;" valign="top">Zo nee:</td><td style="padding-bottom:10px;">* <?=$leerling['opgevoed_door_andere'];?></td>
    </tr>
    <tr>
        <td></td>
        <td style="padding-bottom:10px;">
            <div style="float:left;">* Opgevoed door vader / moeder / voogd (= </div>
            <div style="padding-left: 10px;width:294px;height:15px;border-bottom: dotted thin #000;float:left;">
                <?=$leerling['opgevoed_door_naam'];?>
            </div> 
            <div style="float:left;">)</div>
            <div style="clear:both;"></div>        
        </td>
    </tr>
    <tr>
        <td></td>
        <td style="padding-bottom:10px;">
            * Andere nuttige info: 
            <span style="margin-left: 5px;border-bottom: dotted thin #000;"><?=$leerling['andere_info'];?></span>        
        </td>
    </tr>
</table>

<table style="margin-top: 20px;">
    <tr>
        <td style="width: 300px;">Heeft de leerling stiefouder(s)?</td>
        <td><?=$leerling['stiefouders'];?></td>
    </tr>
</table>

<table style="width: 100%;margin-top: 10px;">
    <tr>
        <td style="padding-left: 50px;width: 150px;" valign="top">Zo ja: wie?</td><td></td>
    </tr>
    <tr>
        <td style="padding-left: 70px;width: 150px;" valign="top">Partner mama:</td>
        <td>
            <div style="width:100%;border-bottom: dotted thin #000;">&nbsp;<?=$leerling['partnermama_naam'] . " " . $leerling['partnermama_voornaam']?></div>            
            <div style="width:100%;border-bottom: dotted thin #000;">&nbsp;<?=$leerling['partnermama_gsm'] . " " . $leerling['partnermama_email']?></div>            
        </td>
    </tr>
    <tr>
        <td style="padding-left: 70px;width: 150px;" valign="top">Partner papa:</td>
        <td>
            <div style="width:100%;border-bottom: dotted thin #000;">&nbsp;<?=$leerling['partnerpapa_naam'] . " " . $leerling['partnerpapa_voornaam']?></div>            
            <div style="width:100%;border-bottom: dotted thin #000;">&nbsp;<?=$leerling['partnerpapa_gsm'] . " " . $leerling['partnerpapa_email']?></div>            
        </td>
    </tr>
</table>


                           
<table style="margin-top: 30px;">
    <tr>
        <td style="width: 300px;">Is de thuistaal uitsluitend Nederlands?</td>
        <td><?=$thuistaal_ned;?></td>
    </tr>
</table>

<table style="width: 100%;margin-top: 10px;">
    <tr>
        <td style="padding-left: 50px;width: 150px;">Zo nee: thuistaal = </td>
        <td style="border-bottom: dotted thin #000;"><?=$thuistaal_andere;?></td>
    </tr>       
</table>


<table style="margin-top: 30px;">
    <tr>
        <td style="width: 300px;">Heeft de leerling ooit een jaar moeten overdoen?</td>
        <td><?=$leerling['heeft_jaar_moeten_overdoen'];?></td>
    </tr>
</table>

<table style="width: 100%;margin-top: 10px;">
    <tr>
        <td style="padding-left: 50px;width: 80px;">Zo ja: welk?</td>
        <td style="border-bottom: dotted thin #000;"><?=$leerling['jaar_overdoen_welke'];?></td>
    </tr>       
</table>


<table style="margin-top: 30px;">
    <tr>
        <td style="width: 300px;">Herneemt de leerling het eerste jaar?</td>
        <td><?=$leerling['herneemt_eerste_jaar'];?></td>
    </tr>
</table>

<table style="width: 100%;margin-top: 10px;">
    <tr>
        <td style="padding-left: 50px;width: 150px;">Zo ja: welke school? </td>
        <td>
            <div style="width:100%;border-bottom: dotted thin #000;">&nbsp;<?=$leerling['herneemt_eerste_jaar_school_naam'];?></div>            
            <div style="width:100%;border-bottom: dotted thin #000;">&nbsp;<?=$leerling['herneemt_eerste_jaar_school_postcode'] . " " . $leerling['herneemt_eerste_jaar_school_gemeente'];?></div>            
        </td>
    </tr>       
</table>



<table style="margin-top: 50px;">
    <tr>
        <td style="width: 300px;">(*) Heeft de leerling leerproblemen?</td>
        <td><?=$leerling['leerproblemen'];?></td>
    </tr>
</table>

<table style="width: 100%;margin-top: 10px;">
    <tr>
        <td style="padding-left: 50px;width: 80px;">Zo ja: welke ?</td>
        <td style="border-bottom: dotted thin #000;"><?=$leerling['leerproblemen_extra'];?></td>
    </tr>       
</table>


<table style="margin-top: 10px;">
    <tr>
        <td style="width: 300px;">(*) Heeft de leerling gezondheidsproblemen?</td>
        <td><?=$leerling['gezondheidsproblemen'];?></td>
    </tr>
</table>

<table style="width: 100%;margin-top: 10px;">
    <tr>
        <td style="padding-left: 50px;width: 80px;">Zo ja: welke ?</td>
        <td style="border-bottom: dotted thin #000;"><?=$leerling['gezondheidsproblemen_extra'];?></td>
    </tr>       
</table>

<table style="margin-top: 10px;">
    <tr>
        <td style="width: 300px;">(*) Heeft de leerling gedragsproblemen?</td>
        <td><?=$leerling['gedragsproblemen'];?></td>
    </tr>
</table>

<table style="width: 100%;margin-top: 10px;">
    <tr>
        <td style="padding-left: 50px;width: 80px;">Zo ja: welke ?</td>
        <td style="border-bottom: dotted thin #000;"><?=$leerling['gedragsproblemen_extra'];?></td>
    </tr>       
</table>

<div style="width: 200px;height:0px;border:solid thin #000;margin-top: 20px;margin-bottom:5px;"></div>

<strong>Bij JA stuurt u de ouders door naar de ViP-leerkracht.</strong>

