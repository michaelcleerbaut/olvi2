<div class="subtitelCenter"></div>


<table class="formulier" style="width:700px;">
    <tr>
        <th colspan="2">Heeft de leerling gedragsproblemen op school?</th>
    </tr>
    <tr>
        <td colspan="2">
            <label><input type="radio" id="gedragsproblemen_school_ja" name="gedragsproblemen_school" style="width:20px;" value="Ja" [CHK_GEDRAGSPROBLEMEN_SCHOOL_JA]> Ja</label>
            <label><input type="radio" id="gedragsproblemen_school_nee" name="gedragsproblemen_school" style="width:20px;margin-left:50px;" value="Nee"  [CHK_GEDRAGSPROBLEMEN_SCHOOL_NEE]> Nee</label>
        </td>
    </tr>    
</table>


<div id="gedragsproblemen_container">
    
<table class="formulier [DISABLED]" id="gedragsproblemen_school_info">
    <tr>
        <th>Welke?</th>
        <td><input type="text" id="gedragsproblemen_school_welke" value="[WELKE]" tabindex="1"></td>
    </tr>    
</table>

<table class="formulier [DISABLED]" style="width:700px;" id="gedragsproblemen_extra_school_con">
    <tr>
        <th colspan="2">Extra info of vraag?    </th>
    </tr>
    <tr>
        <td colspan="2">
        <textarea id="gedragsproblemen_school_extra" style="width:764px;height:100px;" tabindex="3" class="no_enter_submit">[EXTRA]</textarea>
        </td>
    </tr>    
</table>


</div>

<script type="text/javascript">
    $('#gedragsproblemen_school_ja').click(function(){        
        $('#gedragsproblemen_school_info').removeClass('disabled');
        $('#gedragsproblemen_extra_school_con').removeClass('disabled');
        $('#gedragsproblemen_school_welke').removeAttr('readonly');        
        $('#gedragsproblemen_school_extra').removeAttr('readonly');
    });
    $('#gedragsproblemen_school_nee').click(function(){
        $('#gedragsproblemen_school_info').addClass('disabled');
        $('#gedragsproblemen_extra_school_con').addClass('disabled');
        $('#gedragsproblemen_school_welke').val('');        
        $('#gedragsproblemen_school_extra').val('');
        $('#gedragsproblemen_school_welke').attr('readonly','readonly');        
        $('#gedragsproblemen_school_extra').attr('readonly','readonly');        
    });
</script>