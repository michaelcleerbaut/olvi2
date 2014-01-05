<div class="subtitelCenter"></div>


<table class="formulier" style="width:700px;">
    <tr>
        <th colspan="2">Heeft de leerling ooit een jaar moeten overdoen?</th>
    </tr>
    <tr>
        <td colspan="2">
            <label><input type="radio" id="jaaroverdoen_ja" name="jaaroverdoen" style="width:20px;" value="Ja" [CHK_OVERDOEN_JA]> Ja</label>
            <label><input type="radio" id="jaaroverdoen_nee" name="jaaroverdoen" style="width:20px;margin-left:50px;" value="Nee"  [CHK_OVERDOEN_NEE]> Nee</label>
        </td>
    </tr>    
</table>


<div id="jaaroverdoen_container">
    
<table class="formulier [DISABLED]" id="jaaroverdoen_info">
    <tr>
        <th>Leerjaar?</th>
        <td><input type="text" id="jaaroverdoen_leerjaar" value="[LEERJAAR]" tabindex="1"></td>
    </tr>    
    <tr>
        <th>Reden?</th>
        <td><input type="text" id="jaaroverdoen_reden" value="[REDEN]" tabindex="2"></td>
    </tr>    
</table>

<table class="formulier [DISABLED]" style="width:700px;" id="jaaroverdoen_extra_con">
    <tr>
        <th colspan="2">Extra info of vraag?    </th>
    </tr>
    <tr>
        <td colspan="2">
        <textarea id="jaaroverdoen_extra" style="width:764px;height:100px;" tabindex="3" class="no_enter_submit">[EXTRA]</textarea>
        </td>
    </tr>    
</table>


</div>

<script type="text/javascript">
    $('#jaaroverdoen_ja').click(function(){
        $('#jaaroverdoen_info').removeClass('disabled');
        $('#jaaroverdoen_extra_con').removeClass('disabled');
        $('#jaaroverdoen_leerjaar').removeAttr('readonly');
        $('#jaaroverdoen_reden').removeAttr('readonly');
        $('#jaaroverdoen_extra').removeAttr('readonly');
    });
    $('#jaaroverdoen_nee').click(function(){
        $('#jaaroverdoen_info').addClass('disabled');
        $('#jaaroverdoen_extra_con').addClass('disabled');
        $('#jaaroverdoen_leerjaar').val('');
        $('#jaaroverdoen_reden').val('');
        $('#jaaroverdoen_extra').val('');        
        $('#jaaroverdoen_leerjaar').attr('readonly','readonly');
        $('#jaaroverdoen_reden').attr('readonly','readonly');        
        $('#jaaroverdoen_extra').attr('readonly','readonly');        
    });
</script>