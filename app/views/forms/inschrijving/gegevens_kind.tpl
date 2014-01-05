<div class="subtitelCenter">Persoonlijke gegevens</div>


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

<table class="formulierdubbel">
    <tr>
        <th>Geslacht</th>
        <td colspan="3"><label><input type="radio" name="geslacht" value="Man" style="width: 20px;" [CHECKGESLACHTMAN]> Man</label> <label><input style="width: 20px;margin-left: 50px;" type="radio" name="geslacht" value="Vrouw" [CHECKGESLACHTVROUW]> Vrouw</label></td>
    </tr>
    <tr>
        <th>Naam</th>
        <td><input type="text" id="naam" value="[NAAM]" tabindex="1"></td>
        
        <th>Rijksregister nr</th>
        <td><input type="text" id="belgisch_rijksregisternummer_of_bisnummer" value="[RIJKSREGISTERNR]" tabindex="5"></td>        
    </tr>
    <tr>
        <th>Voornaam</th>
        <td><input type="text" id="voornaam" value="[VOORNAAM]" tabindex="2"></td>        
            
        <th>Nationaliteit</th>
        <td>[NATIONALITEIT]</td>
    </tr>
    <tr>
        <th>Geboortedatum</th>
        <td><input type="text" id="geboortedatum" value="[GEBOORTEDATUM]" class="datepicker" tabindex="3"></td>

        <th>GSM v/d leerling</th>
        <td><input type="text" id="tel" value="[TELEFOON]" tabindex="7"></td>        
    </tr>
    <tr>
        <th>Geboorteplaats</th>
        <td><input type="text" id="geboorteplaats" value="[GEBOORTEPLAATS]" tabindex="4"></td>        

        <th>Email v/d leerling</th>
        <td><input type="text" id="email" value="[EMAIL]" tabindex="8"></td>        
    </tr>
    <tr>
        <td colspan="4" class="spacer"></td>
    </tr>
    <tr>
        <td></td><th colspan="3">Adres leerling</th>
    </tr>
    <tr>
        <th>Straat + nr</th>
        <td colspan="3">
            <input type="text" id="straat" value="[STRAAT]" style="width: 387px;" tabindex="9">
            Nr <input type="text" id="huisnummer" value="[HUISNUMMER]" style="width: 50px;" tabindex="10">
            Bus <input type="text" id="busnummer" value="[BUSNUMMER]" style="width:50px;" tabindex="11">
        </td>        
    </tr>
    <tr>
        <th>Postcode + Gemeente</th>
        <td colspan="3"><input type="text" id="postcode" value="[POSTCODE]" style="width:150px;" tabindex="12" autocomplete="off"> <input type="text" id="plaats" value="[PLAATS]" style="width:392px;" tabindex="13" autocomplete="off"></td>
    </tr>
    <tr>
        <td colspan="4" class="spacer"></td>
    </tr>    
    <tr>
        <th>Lagere school</th>
        <td colspan="3"><div class="link" id="search_lagere_school"><div class="search" style="float:left;"></div> <div style="float:left;line-height: 23px;cursor: pointer;"><strong>Zoek jouw lagere school</strong></div></div></td>
    </tr>
    <tr class="kind_vorigeschool_static [HIDE_VORIGESCHOOL_STATIC]">
        <th>Mijn lagere school</th>
        <td colspan="3"><span class="kind_vorigeschool_naam">[NAAMVORIGESCHOOL]</span></td>
    </tr>
    <tr class="kind_vorigeschool_static [HIDE_VORIGESCHOOL_STATIC]">
        <th></th>
        <td colspan="3"><span class="kind_vorigeschool_postcode">[POSTCODELAGERESCHOOL]</span> <span class="kind_vorigeschool_gemeente">[GEMEENTELAGERESCHOOL]</span></td>
    </tr>
    <tr  class="kind_vorigeschool_manual">
        <td colspan="4"><h4>Geen probleem, gelieve uw school handmatig in te vullen</h4></td>
    </tr>    
    <tr class="kind_vorigeschool_extra kind_vorigeschool_manual">
        <th>Naam lagere school</th>
        <td colspan="3"><input type="text" id="kind_vorigeschool_naam" value="[NAAMVORIGESCHOOL]" style="width:557px;" tabindex="14"></td>
    </tr>
    <tr class="kind_vorigeschool_extra kind_vorigeschool_manual">
        <th>Postcode + Gemeente lagere school</th>
        <td colspan="3"><input type="text" id="kind_vorigeschool_postcode" value="[POSTCODELAGERESCHOOL]" style="width: 150px;" tabindex="15" autocomplete="off"> <input type="text" id="kind_vorigeschool_gemeente" value="[GEMEENTELAGERESCHOOL]" style="width:392px;" tabindex="16" autocomplete="off"></td>
    </tr>   
</table>

<input type="hidden" id="kind_vorigeschool_id" value="[IDLAGERESCHOOL]">

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
      delimiter: /(,|;)\s*/, 
      maxHeight:400,
      width:500,
      zIndex: 9999,
      deferRequestBy: 0, 
      noCache: false, 
      onSelect: function(value, data){
                   
        pc = data.substr(0,4);
        gemeente = data.substr(7);

        $('#kind_vorigeschool_postcode').val(pc);
        $('#kind_vorigeschool_gemeente').val(gemeente);
        
      }
    });
        
        


</script>
