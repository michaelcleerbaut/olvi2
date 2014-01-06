<div class="subtitelCenter">VIP Informatie</div>


<table class="formulier" style="width:700px;">
    <tr>
        <th colspan="3">Ouders verklaren hierbij dat hun zoon / dochter tijdens de middagpauze</th>        
    </tr>
    <tr>
        <td><label><input type="radio" id="middag_school" name="middag" style="width:20px;" value="op school blijft en zijn / haar lunch gebruikt in de leerlingenrefter" [MIDDAGSCHOOL]> intern</label></td>
        <td><label><input type="radio" id="middag_thuis" name="middag" style="width:20px;margin-left:50px;" value="naar huis komt" [MIDDAGTHUIS]> extern</label></td>
        <td><label><input type="radio" id="middag_half" name="middag" style="width:20px;margin-left:50px;" value="soms naar huis komt" [MIDDAGHALF]>half extern</label></td>
    </tr>    
</table>

<table class="formulier [DISPLAYTHUISDAGEN]" id="thuis_dagen">
    <tr>
        <td colspan="5"><strong>Welke dagen komt de leerling naar huis?</strong></td>
    </tr>    
    <tr>
        <td><label><input type="checkbox" name="thuis_ma" value="YES" style="width: 20px;" [CHKTHUISMA]> Maandag</label></td>
        <td><label><input type="checkbox" name="thuis_di" value="YES" style="width: 20px;margin-left:40px;" [CHKTHUISDI]> Dinsdag</label></td>        
        <td><label><input type="checkbox" name="thuis_do" value="YES" style="width: 20px;margin-left:40px;" [CHKTHUISDO]> Donderdag</label></td>
        <td><label><input type="checkbox" name="thuis_vr" value="YES" style="width: 20px;margin-left:40px;" [CHKTHUISVR]> Vrijdag</label></td>
    </tr>
</table>

<table class="formulier [DISABLED]" id="vip_middag">
    <tr>
        <td colspan="2"><strong>Adres waar de leerling tijdens de middagpauze verblijft (indien anders dan thuisadres)</strong></td>
    </tr>
    <tr>
        <th>Straat + nr</th>
        <td colspan="3">
            <input type="text" id="middag_straat" value="[STRAAT]" style="width: 387px;" tabindex="1" >
            Nr <input type="text" id="middag_huisnummer" value="[NR]" style="width: 50px;" tabindex="2" >
            Bus <input type="text" id="middag_busnummer" value="[BUS]" style="width:50px;" tabindex="3" >
        </td>        
    </tr>
    <tr>
        <th>Postcode + Gemeente</th>
        <td colspan="2"><input type="text" id="middag_postcode" value="[POSTCODE]" style="width:150px;" tabindex="4" > <input type="text" id="middag_plaats" value="[GEMEENTE]" style="width:392px;" tabindex="5" ></td>
    </tr>

    <tr><td colspan="2" class="spacer"></td></tr>    
</table>


<script type="text/javascript">
    $('#middag_postcode').autocomplete2({
      serviceUrl:'/ajax.php?action=get_cities',
      minChars:2,
      delimiter: /(,|;)\s*/, // regex or character
      maxHeight:400,
      width:500,
      zIndex: 9999,
      deferRequestBy: 0, //miliseconds
      noCache: false, //default is false, set to true to disable caching
      onSelect: function(value, data){                     
          pc = data.substr(0,4);
          gemeente = data.substr(7);
          $('#middag_postcode').val(pc);
        $('#middag_plaats').val(gemeente);
      }
    });
</script>
