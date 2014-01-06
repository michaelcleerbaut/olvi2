<div class="subtitelCenter">Gegevens vader</div>


<table class="formulierdubbel">
    <tr>
        <th>Naam</th>
        <td><input type="text" id="vader_naam" value="[NAAM]" tabindex="1"></td>
        
        <th>GSM</th>
        <td><input type="text" id="vader_gsm" value="[GSM]" tabindex="3"></td>        
    </tr>
    <tr>
        <th>Voornaam</th>
        <td><input type="text" id="vader_voornaam" value="[VOORNAAM]" tabindex="2"></td>        
            
        <th>Email</th>
        <td><input type="text" id="vader_email" value="[EMAIL]" tabindex="4"></td>
    </tr>
    <tr>
        <td colspan="4" class="spacer"></td>
    </tr>    
    <tr>
        <th>Zelfde als leerling</th>
        <td><input type="checkbox" id="vader_zelfde_als_lln" style="width:20px;" tabindex="5"></td>
    </tr>    
    <tr>
        <th>Straat + nr</th>
        <td colspan="3">
            <input type="text" id="vader_straat" value="[STRAAT]" style="width: 387px;" tabindex="6">
            Nr <input type="text" id="vader_huisnummer" value="[NR]" style="width: 50px;" tabindex="7">
            Bus <input type="text" id="vader_busnummer" value="[BUS]" style="width:50px;" tabindex="8">
        </td>        
    </tr>
    <tr>
        <th>Postcode + Gemeente</th>
        <td colspan="3"><input type="text" id="vader_postcode" value="[POSTCODE]" style="width:150px;" tabindex="9" autocomplete="off"> <input type="text" id="vader_plaats" value="[GEMEENTE]" style="width:392px;" tabindex="10" autocomplete="off"></td>
    </tr>    
</table>

<script type="text/javascript">
    $('#vader_postcode').autocomplete2({
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
          $('#vader_gemeente').val(pc);
        $('#vader_plaats').val(gemeente);
      }
    });
</script>