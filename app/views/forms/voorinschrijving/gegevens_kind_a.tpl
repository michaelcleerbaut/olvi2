<div class="subtitelCenter">Vul het formulier in met de gegevens van uw kind</div>

<div id="search_lagere_school_con">
    <h3>Zoek jouw lagere school</h3>
    
    <table class="formulier">
        <tr>
            <td>Postcode of gemeente</td>
            <td><input type="text" id="search_lagere_school_pg" value="" autocomplete="off"></td>
        </tr>
        <tr>
            <td colspan="2" id="result_lagere_scholen"></td>
        </tr>
    </table>
    
    <div class="btnMedium" id="annuleer_search_lagereschool" style="float:right;">Annuleer</div>
    
</div>



<table class="formulier">
    <tr>
        <th>Naam *</th>
        <td><input type="text" id="naam" value="" tabindex="1">
    </tr>
    <tr>
        <th>Voornaam *</th>
        <td><input type="text" id="voornaam" value="" tabindex="2"></td>
    </tr>
    <tr>
        <th>Straat + nr *</th>
        <td>
            <input type="text" id="straat" value="" style="width: 399px;"  tabindex="3">
            Nr <input type="text" id="huisnummer" value="" style="width: 50px;" tabindex="4">
            Bus <input type="text" id="busnummer" value="" style="width:50px;" tabindex="5"></td>        
    </tr>
   <tr>
        <th>Postcode + Gemeente</th>
        <td><input type="text" id="postcode" value="" style="width:150px;" tabindex="6"> <input type="text" id="plaats" style="width:403px;" tabindex="7"></td>
    </tr>
    <tr>
        <td colspan="4" class="spacer"></td>
    </tr>        
    
    <tr>
        <th></th>
        <td colspan="3"><div class="link" id="search_lagere_school"><div class="search" style="float:left;"></div> <div style="float:left;line-height: 23px;cursor: pointer;"><strong>Zoek jouw lagere school op een eenvoudige manier</strong></div></div></td>
    </tr>
    <tr class="kind_vorigeschool_extra">
        <th>Naam lagere school</th>
        <td colspan="3"><input type="text" id="kind_vorigeschool_naam" value="" style="width:557px;"></td>
    </tr>
    <tr class="kind_vorigeschool_extra">
        <th>Postcode + Gemeente lagere school</th>
        <td colspan="3"><input type="text" id="kind_vorigeschool_postcode" value="" style="width: 150px;" autocomplete="off"> <input type="text" id="kind_vorigeschool_gemeente" value="" style="width:392px;" autocomplete="off"></td>
    </tr> 
    <tr>
        <td colspan="4" class="spacer"></td>
    </tr>  
    <tr>
        <th>Studiekeuze</th>
        <td colspan="3">
            <div style="float:left;width:210px;"><label><input type="radio" name="studiekeuze" value="Algemene vorming" style="width:10px;">Algemene vorming (zonder latijn)</label></div>
            <div style="float:left;width:210px;"><label><input type="radio" name="studiekeuze" value="Klassieke vorming" style="width:10px;">Klassieke vorming (met latijn)</label></div>
            <div style="float:left;width:160px;"><label><input type="radio" name="studiekeuze" value="Nog niet bepaald" style="width:10px;">Nog niet bepaald</label></div>
        </td>
    </tr>
</table>

<input type="hidden" id="kind_vorigeschool_id" value="">

<script type="text/javascript">
    search_lagereschool_functions();

    $('#postcode').autocomplete2({
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
          $('#postcode').val(pc);
        $('#plaats').val(gemeente);
      }
    });

    $('#kind_vorigeschool_postcode').autocomplete2({
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
          $('#kind_vorigeschool_postcode').val(pc);
        $('#kind_vorigeschool_gemeente').val(gemeente);
      }
    });
    
    
</script>