<div class="subtitelCenter">Haal bestaande gegevens op van het kind</div>



<table style="margin-left: 30px;">
    <tr>
        <th><div class="btnBig" id="via_volgnummer" style="width: 150px;">via volgnummer</div></th>
        <th style="width: 50px;"></th>
        <th><div class="btnBig" id="via_naam">via naam</div></th>
        <th style="width: 50px;"></th>
        <th><div class="btnBig" id="nieuw_kind_selector" style="width:200px;">nieuwe inschrijving</div></th>        
    </tr>
    <tr>
        <td style="width: 300px;text-align:center;"><input type="text" id="volgnummer" value="" style="width: 40px;text-align:center;padding: 5px;" disabled="disabled"></td>
        <td></td>
        <td style="width:300px;text-align:center;"><input type="text" id="naam_kind" value="" class="search_kind_via_naam" style="padding: 5px;" disabled="disabled"></td>
        <td></td>
        <td></td>
    </tr>                
</table>

<p>
<input type="hidden" id="kind_gegevens_laden" value="YES">
<input type="hidden" id="nieuw_geklikt" value="NO">
<input type="hidden" id="nieuw_kind" value=""> 
<input type="hidden" id="delete_vorig" value="NO"> 

</p>


<script type="text/javascript">
     
    $('.search_kind_via_naam').autocomplete2({
      serviceUrl:'/ajax.php?action=search_kind_via_naam&stroom=YES',
      minChars:2,
      delimiter: /(,|;)\s*/, // regex or character
      maxHeight:400,
      width:500,
      zIndex: 9999,
      deferRequestBy: 0, //miliseconds
      noCache: false, //default is false, set to true to disable caching
      onSelect: function(value, data){     
          if(data == $('#id_leerling').val()){
              $('#kind_gegevens_laden').val("NO");
          } else {
              $('#kind_gegevens_laden').val("YES");
              $('#nieuw_geklikt').val("NO");
              $('#id_leerling').val(data);
          }
      }
    });
        


</script>