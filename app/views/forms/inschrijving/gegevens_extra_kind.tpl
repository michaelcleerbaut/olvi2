<div class="subtitelCenter">Persoonlijke gegevens</div>


<table class="formulier">
    <tr>
        <th>Digitale communicatie moeder</th>
        <td><select id="digitale_communicatie_moeder" tabindex="1"><option value=""></option><option value="email" [CHKDIGITALECOMMUNICATIEMOEDEREMAIL]>Email</option><option value="post" [CHKDIGITALECOMMUNICATIEMOEDERPOST]>Post</option></select></td>
    </tr>
    <tr>
        <th>Digitale communicatie vader</th>
        <td><select id="digitale_communicatie_vader"  tabindex="2"><option value=""></option><option value="email" [CHKDIGITALECOMMUNICATIEVADEREMAIL]>Email</option><option value="post" [CHKDIGITALECOMMUNICATIEVADERPOST]>Post</option></select></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>    
    <tr>
        <td colspan="2"><strong>Waar kan de school u of iemand van de familie bereiken tijdens de lesuren (noodnummer)</strong><input type="text" id="tel_noodnummer" value="[NOODNUMMER]" style="width: 184px;margin-left: 20px;" tabindex="3"></td>
    </tr>    
    <tr>
        <td colspan="2" class="spacer"><strong>Thuisadres indien niet bij ouders</strong></td>
    </tr>                
    <tr>
        <th>Straat + nr</th>
        <td>
            <input type="text" id="tweede_verblijf_straat" value="[TWEEDEVERBLIJFSTRAAT]" style="width: 387px;" tabindex="4">
            Nr <input type="text" id="tweede_verblijf_huis_nummer" value="[TWEEDEVERBLIJFNR]" style="width: 50px;" tabindex="5">
            Bus <input type="text" id="tweede_verblijf_bus_nummer" value="[TWEEDEVERBLIJFBUS]" style="width:50px;" tabindex="6">
        </td>        
    </tr>
    <tr>
        <th>Postcode + Gemeente</th>
        <td><input type="text" id="tweede_verblijf_postcode" value="[TWEEDEVERBLIJFPOSTCODE]" style="width:150px;" tabindex="7" autocomplete="off"> <input type="text" id="tweede_verblijf_plaats" value="[TWEEDEVERBLIJFGEMEENTE]" style="width:392px;" tabindex="8" autocomplete="off"></td>
    </tr>
</table>


<script type="text/javascript">
    $('#tweede_verblijf_postcode').autocomplete2({
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
          $('#tweede_verblijf_postcode').val(pc);
        $('#tweede_verblijf_plaats').val(gemeente);
      }
    });
</script>