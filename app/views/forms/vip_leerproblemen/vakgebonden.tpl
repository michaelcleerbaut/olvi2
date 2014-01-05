<div class="subtitelCenter"></div>



<table class="formulier" style="width:700px;">
    <tr>
        <th colspan="2">Maakt de leerling gebruik van een pc in de klas?</th>
    </tr>
    <tr>
        <td colspan="2">
            <label><input type="radio" id="maakt_gebruik_van_pc_ja" name="maakt_gebruik_van_pc" style="width:20px;" value="Ja" [CHK_MAAKTGEBRUIKVANPC_JA]> Ja</label>
            <label><input type="radio" id="maakt_gebruik_van_pc_nee" name="maakt_gebruik_van_pc" style="width:20px;margin-left:50px;" value="Nee"  [CHK_MAAKTGEBRUIKVANPC_NEE]> Nee</label>
        </td>
    </tr>    
</table>

<div id="maakt_gebruik_van_pc_container">
    
<table class="formulier [DISABLED_MAAKTGEBRUIKVANPC]" id="maaktgebruikvanpc_info">
    <tr>
        <th>Welke programma(s)?</th>
        <td><input type="text" id="maakt_gebruik_van_pc_programmas" value="[MAAKTGEBRUIKVANPC_PROGRAMMAS]" tabindex="1"></td>
    </tr>    
</table>

</div>


<table class="formulier" style="width:700px;">
    <tr>
        <th colspan="2">Heeft de leerling vakgebonden problemen?</th>
    </tr>
    <tr>
        <td colspan="2">
            <label><input type="radio" id="vakgebonden_ja" name="vakgebonden" style="width:20px;" value="Ja" [CHK_VAKGEBONDEN_JA]> Ja</label>
            <label><input type="radio" id="vakgebonden_nee" name="vakgebonden" style="width:20px;margin-left:50px;" value="Nee"  [CHK_VAKGEBONDEN_NEE]> Nee</label>
        </td>
    </tr>    
</table>


<div id="vakgebonden_container">
    
<table class="formulier [DISABLED]" id="vakgebonden_info">
    <tr>
        <th>Welke vakken?</th>
        <td><input type="text" id="vakgebonden_vakken" value="[VAKKEN]" tabindex="1"></td>
    </tr>    
    <tr>
        <th>Soort probleem?</th>
        <td><input type="text" id="vakgebonden_soort" value="[SOORT]" tabindex="2"></td>
    </tr>    
</table>

<table class="formulier [DISABLED]" style="width:700px;" id="vakgebonden_extra_con">
    <tr>
        <th colspan="2">Extra info of vraag?    </th>
    </tr>
    <tr>
        <td colspan="2">
        <textarea id="vakgebonden_extra" style="width:764px;height:100px;" tabindex="3" class="no_enter_submit">[EXTRA]</textarea>
        </td>
    </tr>    
</table>


</div>

<script type="text/javascript">
    $('#vakgebonden_ja').click(function(){
        $('#vakgebonden_info').removeClass('disabled');
        $('#vakgebonden_extra_con').removeClass('disabled');
        $('#vakgebonden_vakken').removeAttr('readonly');
        $('#vakgebonden_soort').removeAttr('readonly');
        $('#vakgebonden_extra').removeAttr('readonly');
    });
    $('#vakgebonden_nee').click(function(){
        $('#vakgebonden_info').addClass('disabled');
        $('#vakgebonden_extra_con').addClass('disabled');
        $('#vakgebonden_vakken').val('');
        $('#vakgebonden_soort').val('');
        $('#vakgebonden_extra').html('');
        $('#vakgebonden_vakken').attr('readonly','readonly');
        $('#vakgebonden_soort').attr('readonly','readonly');        
        $('#vakgebonden_extra').attr('readonly','readonly');        
    });
    
    $('#maakt_gebruik_van_pc_ja').click(function(){
        $('#maaktgebruikvanpc_info').removeClass('disabled');        
        $('#maakt_gebruik_van_pc_programmas').removeAttr('readonly');        
    });
    $('#maakt_gebruik_van_pc_nee').click(function(){
        $('#maaktgebruikvanpc_info').addClass('disabled');                
        $('#maakt_gebruik_van_pc_programmas').addClass('readonly');
        $('#maaktgebruikvanpc_info').attr('readonly','readonly');        
        $('#maakt_gebruik_van_pc_programmas').attr('readonly','readonly');        
    });
</script>