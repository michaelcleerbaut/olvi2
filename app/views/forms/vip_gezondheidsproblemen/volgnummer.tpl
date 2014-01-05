<div class="subtitelCenter">Haal bestaande gegevens op van het kind</div>



<table style="margin-left: 80px;">
    <tr>
        <th align="center"><div class="btnBig" id="via_volgnummer" style="width: 150px;">via volgnummer</div></th>        
        <th><div class="btnBig" id="via_naam">via naam</div></th>
    </tr>
    <tr>
        <td style="width: 300px;text-align:center;"><select id="stroom_select" style="padding:5px;" disabled="disabled"><option value="A">A</option><option value="B">B</option></select><input type="text" id="volgnummer" value="" style="width: 40px;text-align:center;padding: 5px;" disabled="disabled"></td>        
        <td style="width:300px;text-align:center;"><input type="text" id="naam_kind" value="" class="search_kind_via_naam" style="padding: 5px;" disabled="disabled"></td>
    </tr>                
</table>


<input type="hidden" id="kind_gegevens_laden" value="YES">

<script type="text/javascript">
     
    $('.search_kind_via_naam').autocomplete2({
      serviceUrl:'/ajax.php?action=search_kind_via_naam_vip_gezondheidsproblemen',
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
            $('#id_leerling').val(data);
            $('#kind_gegevens_laden').val("YES");                                
        }
        
      }
    });
        


</script>