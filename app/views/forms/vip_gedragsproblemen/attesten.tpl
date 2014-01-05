<div class="subtitelCenter"></div>     


<table class="formulier" style="width:700px;">
    <tr>
        <th colspan="2">Heeft de leerling attesten/verslagen?</th>
    </tr>
    <tr>
        <td colspan="2">
            <label><input type="radio" id="attesten_ja" name="attesten" style="width:20px;" value="Ja" [CHK_ATTESTEN_JA]> Ja</label>
            <label><input type="radio" id="attesten_nee" name="attesten" style="width:20px;margin-left:50px;" value="Nee"  [CHK_ATTESTEN_NEE]> Nee</label>
        </td>
    </tr>    
</table>
                                   
<div style="margin-top: 30px;text-align:center;">
                                   
    <div id="attesten_nee_con" [DISABLED_ATTTESTEN_NEE_CON]>
        <strong>Leerkrachten krijgen slechts algemene info</strong>
        <input type="hidden" id="attesten_extra_nee" value="Leerkrachten krijgen slechts algemene info">    
    </div>

    <div id="attesten_ja_con" [DISABLED_ATTTESTEN_JA_CON]>
        <strong>Asap bezorgen, aan de hand daarvan worden leerkrachten op de hoogte gebracht en kan begeleiding afsproken worden</strong>
        <input type="hidden" id="attesten_extra_ja" value="Asap bezorgen, aan de hand daarvan worden leerkrachten op de hoogte gebracht en kan begeleiding afsproken worden">
    </div>
</div>


<script type="text/javascript">
    $('#attesten_ja').click(function(){
        $('#attesten_nee_con').hide();
        $('#attesten_ja_con').show();
    });
    $('#attesten_nee').click(function(){
        $('#attesten_nee_con').show();
        $('#attesten_ja_con').hide();
    });
</script>