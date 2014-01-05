<div class="subtitelCenter"></div>


<table class="formulier" style="width:700px;">
    <tr>
        <th colspan="2">Heeft de leerling bijkomende gedragsproblemen?</th>
    </tr>
    <tr>
        <td colspan="2">
            <label><input type="radio" id="gedragsproblemen_ja" name="gedragsproblemen" style="width:20px;" value="Ja" [CHK_GEDRAGSPROBLEMEN_JA]> Ja</label>
            <label><input type="radio" id="gedragsproblemen_nee" name="gedragsproblemen" style="width:20px;margin-left:50px;" value="Nee"  [CHK_GEDRAGSPROBLEMEN_NEE]> Nee</label>
        </td>
    </tr>    
</table>


<div id="gedragsproblemen_container">
    
<table class="formulier [DISABLED]" id="gedragsproblemen_info">
    <tr>
        <th>Welke?</th>
        <td><input type="text" id="gedragsproblemen_welke" value="[WELKE]" tabindex="1"></td>
    </tr>    
</table>

<table class="formulier [DISABLED]" style="width:700px;" id="gedragsproblemen_extra_con">
    <tr>
        <th colspan="2">Extra info of vraag?    </th>
    </tr>
    <tr>
        <td colspan="2">
        <textarea id="gedragsproblemen_extra" style="width:764px;height:100px;" tabindex="3" class="no_enter_submit">[EXTRA]</textarea>
        </td>
    </tr>    
</table>


</div>

<script type="text/javascript">
    $('#gedragsproblemen_ja').click(function(){
        $('#gedragsproblemen_info').removeClass('disabled');
        $('#gedragsproblemen_extra_con').removeClass('disabled');
        $('#gedragsproblemen_welke').removeAttr('readonly');        
        $('#gedragsproblemen_extra').removeAttr('readonly');
    });
    $('#gedragsproblemen_nee').click(function(){
        $('#gedragsproblemen_info').addClass('disabled');
        $('#gedragsproblemen_extra_con').addClass('disabled');
        $('#gedragsproblemen_welke').val('');        
        $('#gedragsproblemen_extra').html('');
        $('#gedragsproblemen_welke').attr('readonly','readonly');        
        $('#gedragsproblemen_extra').attr('readonly','readonly');        
    });
</script>