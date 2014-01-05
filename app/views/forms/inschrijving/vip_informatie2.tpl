<div class="subtitelCenter">VIP Informatie</div>

<table class="formulier">
    <tr>
        <th>Dubbele post</th>
        <td><label><input type="radio" name="dubbele_afdruk" value="Ja" style="width: 20px;" [CHECKDUBBELEPOSTJA]> Ja</label> <label><input style="width: 20px;margin-left: 50px;" type="radio" name="dubbele_afdruk" value="Nee" [CHECKDUBBELEPOSTNEE]> Nee</label></td>
    </tr>    
</table>


<table class="formulier">
    <tr>
        <th style="width:400px;">Wordt de leerling door beide ouders opgevoed?</th>        
        <td>
            <label><input type="radio" name="door_beide_ouders_opgevoed" id="opvoeding_ouders_ja" style="width:20px;" value="Ja" [CHECKBEIDEJA]> Ja</label> <label><input type="radio" name="door_beide_ouders_opgevoed" id="opvoeding_ouders_nee" style="width:20px;margin-left:50px;" value="Nee" [CHECKBEIDENEE]> Nee</label>
        </td>
    </tr>
</table>

<table class="formulier [DISABLEDSITUATIE]" id="opvoeding_ouders">
    <tr>
        <th colspan="2">Selecteer een gepaste situatie</th>
    </tr>
    <tr>
        <td colspan="2">
            <label><input type="radio" name="opgevoed_door_andere" style="width:20px;" value="Niet van toepassing" [RADIONVP]> Niet van toepassing</label>
            <label><input type="radio" name="opgevoed_door_andere" style="width:20px;margin-left: 10px;" value="Gescheiden" [RADIOGESCHEIDEN]> Gescheiden</label>
            <label><input type="radio" name="opgevoed_door_andere" style="width:20px;margin-left: 10px;" value="1 ouder overleden" [RADIO1OVERLEDEN]> 1 ouder overleden</label>
            <label><input type="radio" name="opgevoed_door_andere" style="width:20px;margin-left: 10px;" value="2 ouders overleden" [RADIO2OVERLEDEN]> 2 ouders overleden</label>
            <label><input type="radio" name="opgevoed_door_andere" style="width:20px;margin-left: 10px;" value="co-ouderschap" [RADIOCO]> co-ouderschap</label>
            <label><input type="radio" name="opgevoed_door_andere" style="width:20px;margin-left: 10px;" value="stiefouders" [RADIOSTIEF]> Stiefouder(s)</label>
        </td>
    </tr>
</table>

<table class="formulier [HIDEGEGEVENSSTIEFOUDERS]" id="gegevens_stiefouders">
    <tr>
        <th style="width: 50px;"></th>
        <th>Gegevens partner mama</th>
        <th>Gegevens partner papa</th>
    </tr>
    <tr>
        <th style="width: 50px;">Naam</th>
        <th><input type="text" id="partnermama_naam" value="[PARTNERMAMANAAM]" style="width: 200px;"></th>
        <th><input type="text" id="partnerpapa_naam" value="[PARTNERPAPANAAM]" style="width: 200px;"></th>        
    </tr>
    <tr>
        <th style="width: 50px;">GSM</th>
        <th><input type="text" id="partnermama_gsm" value="[PARTNERMAMAGSM]" style="width: 200px;"></th>
        <th><input type="text" id="partnerpapa_gsm" value="[PARTNERPAPAGSM]" style="width: 200px;"></th>        
    </tr>
    <tr>
        <th style="width: 50px;">Email</th>
        <th><input type="text" id="partnermama_email" value="[PARTNERMAMAEMAIL]" style="width: 200px;"></th>
        <th><input type="text" id="partnerpapa_email" value="[PARTNERPAPAEMAIL]" style="width: 200px;"></th>        
    </tr>
</table>

<table class="formulier">
    <tr>
        <th style="width: 350px;">Opgevoed door vader / moeder / voogd (naam)</th><td><input type="text" id="opgevoed_door_naam" value="[OPGEVOEDANDERE]" style="width: 410px;" tabindex="6"></td>
    </tr>
    <tr>
        <th colspan="2">Andere nuttige info betreffende de gezinssituatie</th>
    </tr>
    <tr>
        <td colspan="2"><textarea id="andere_info" style="width: 765px;height:50px;min-width:765px;max-width:765px;min-height:50px;max-height:50px;">[INFO]</textarea></td>
    </tr> 
</table>