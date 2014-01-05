<div class="subtitelCenter"></div>     


<table class="formulier" style="width:700px;">
    <tr>
        <th colspan="2">Taakleraar in L.O.?</th>
    </tr>
    <tr>
        <td colspan="2">
            <label><input type="radio" id="taakleraar_lo_ja" name="taakleraar_lo" style="width:20px;" value="Ja" [CHK_TAAKLERAAR_LO_JA]> Ja</label>
            <label><input type="radio" id="taakleraar_lo_nee" name="taakleraar_lo" style="width:20px;margin-left:50px;" value="Nee"  [CHK_TAAKLERAAR_LO_NEE]> Nee</label>
        </td>
    </tr>    
</table>


<div id="taakleraar_lo_container">
    
<table class="formulier [DISABLED]" id="taakleraar_lo_info">
    <tr>
        <th>Reden?</th>
        <td><input type="text" id="taakleraar_lo_reden" value="[REDEN]" tabindex="1"></td>
    </tr>    
</table>

<table class="formulier [DISABLED]" style="width:700px;" id="taakleraar_lo_extra_con">
    <tr>
        <th colspan="2">Extra info of vraag?    </th>
    </tr>
    <tr>
        <td colspan="2">
        <textarea id="taakleraar_lo_extra" style="width:764px;height:100px;" tabindex="3" class="no_enter_submit">[EXTRA]</textarea>
        </td>
    </tr>    
</table>


</div>

<script type="text/javascript">
    $('#taakleraar_lo_ja').click(function(){
        $('#taakleraar_lo_info').removeClass('disabled');
        $('#taakleraar_lo_extra_con').removeClass('disabled');
        $('#taakleraar_lo_reden').removeAttr('readonly');        
        $('#gedragsproblemen_extra').removeAttr('readonly');
    });
    $('#taakleraar_lo_nee').click(function(){
        $('#taakleraar_lo_info').addClass('disabled');
        $('#taakleraar_lo_extra_con').addClass('disabled');
        $('#taakleraar_lo_reden').val('');        
        $('#taakleraar_lo_extra').html('');
        $('#taakleraar_lo_reden').attr('readonly','readonly');        
        $('#taakleraar_lo_extra').attr('readonly','readonly');        
    });
</script>