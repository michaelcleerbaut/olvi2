<div class="subtitelCenter"></div>     


<table class="formulier" style="width:700px;">
    <tr>
        <th colspan="2">Heeft de leerling externe begeleiding?</th>
    </tr>
    <tr>
        <td colspan="2">
            <label><input type="radio" id="begeleiding_ja" name="begeleiding" style="width:20px;" value="Ja" [CHK_BEGELEIDING_JA]> Ja</label>
            <label><input type="radio" id="begeleiding_nee" name="begeleiding" style="width:20px;margin-left:50px;" value="Nee"  [CHK_BEGELEIDING_NEE]> Nee</label>
        </td>
    </tr>    
</table>


<div id="begeleiding_container">
    
<table class="formulier [DISABLED]" id="begeleiding_info">
    <tr>
        <th>Wanneer?</th>
        <td><input type="text" id="begeleiding_wanneer" value="[WANNEER]" tabindex="1"></td>
    </tr>    
    <tr>
        <th>Waar?</th>
        <td><input type="text" id="begeleiding_waar" value="[WAAR]" tabindex="1"></td>
    </tr>    
    <tr>
        <th>Nu nog?</th>
        <td>
            <label><input type="radio" id="begeleiding_nunog_ja" name="begeleiding_nunog" style="width:20px;" value="Ja" [CHK_BEGELEIDING_NUNOG_JA]> Ja</label>
            <label><input type="radio" id="begeleiding_nunog_nee" name="begeleiding_nunog" style="width:20px;margin-left:50px;" value="Nee"  [CHK_BEGELEIDING_NUNOG_NEE]> Nee</label>        
        </td>
    </tr>    
</table>

<table class="formulier [DISABLED]" style="width:700px;" id="begeleiding_extra_con">
    <tr>
        <th colspan="2">Extra info of vraag?    </th>
    </tr>
    <tr>
        <td colspan="2">
        <textarea id="begeleiding_extra" style="width:764px;height:100px;" tabindex="3" class="no_enter_submit">[EXTRA]</textarea>
        </td>
    </tr>    
</table>


</div>

<script type="text/javascript">
    $('#begeleiding_ja').click(function(){
        $('#begeleiding_info').removeClass('disabled');
        $('#begeleiding_extra_con').removeClass('disabled');
        $('#begeleiding_wanneer,').removeAttr('readonly');        
        $('#begeleiding_waar,').removeAttr('readonly');        
        $('#begeleiding_extra').removeAttr('readonly');
    });
    $('#begeleiding_nee').click(function(){
        $('#begeleiding_info').addClass('disabled');
        $('#begeleiding_extra_con').addClass('disabled');
        $('#begeleiding_wanneer').val('');        
        $('#begeleiding_waar').val('');        
        $('#begeleiding_extra').html('');
        $('#begeleiding_wanneer').attr('readonly','readonly');        
        $('#begeleiding_waar').attr('readonly','readonly');        
        $('#begeleiding_extra').attr('readonly','readonly');        
    });
</script>