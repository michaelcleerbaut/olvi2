<div class="subtitelCenter">VIP Informatie</div>



<div class="search_school_con">
    <h3>Zoek school</h3>
    
    <table class="formulier">
        <tr>
            <td>Postcode of gemeente</td>
            <td><input type="text" class="school_pg" value="" autocomplete="off"></td>
        </tr>
        <tr>
            <td colspan="2" id="result_scholen"></td>
        </tr>
    </table>
    
    <div class="btnMedium annuleer_school_search" style="float:right;">Annuleer</div>
    
</div>

<table class="formulier">
    <tr>
        <th style="width: 400px;">Is de thuistaal uitsluitend het Nederlands?</th>        
        <td>
            <label><input type="radio" name="thuistaal_ned" id="thuistaal_ned_ja" style="width:20px;" value="Ja" [CHECKTHUISTAALJA]> Ja</label>
            <label><input type="radio" name="thuistaal_ned" id="thuistaal_ned_nee" style="width:20px;margin-left: 50px;" value="Nee" [CHECKTHUISTAALNEE]> Nee</label>        
        </td>
    </tr>
</table>

<table class="formulier [DISABLETHUISTAAL]" id="tbl_thuistaal_andere">
    <tr>
        <th style="width: 700px;">Welke dan?</th>        
        <td>
            <input type="text" id="thuistaal_andere" value="[THUISTAALANDERE]">
        </td>
    </tr>
</table>


<table class="formulier">
    <tr>
        <th style="width: 400px;">Heeft de leerling een jaar moeten overdoen?</th>        
        <td>
            <label><input type="radio" name="heeft_jaar_moeten_overdoen" id="jaaroverdoen_ja" style="width:20px;" value="Ja" [CHECKJAAROVERDOENJA]> Ja</label>
            <label><input type="radio" name="heeft_jaar_moeten_overdoen" id="jaaroverdoen_nee" style="width:20px;margin-left: 50px;" value="Nee" [CHECKJAAROVERDOENNEE]> Nee</label>        
        </td>
    </tr>
</table>

<table class="formulier [DISABLEJAAROVERDOEN]" id="tbl_jaaroverdoen">
    <tr>
        <th style="width: 700px;">Welke jaren?</th>        
        <td>
            <input type="text" id="jaar_overdoen_welke" value="[OVERDOENWELKE]">
        </td>
    </tr>
</table>


<table class="formulier">
    <tr>
        <th style="width: 400px;">Herneemt de leerling het eerste jaar?</th>        
        <td>
            <label><input type="radio" name="herneemt_eerste_jaar" id="herneemteerstejaar_ja" style="width:20px;" value="Ja" [CHECKHERNEEMTEERSTEJAARJA]> Ja</label>
            <label><input type="radio" name="herneemt_eerste_jaar" id="herneemteerstejaar_nee" style="width:20px;margin-left: 50px;" value="Nee" [CHECKHERNEEMTEERSTEJAARNEE]> Nee</label>        
        </td>
    </tr>
</table>

<table class="formulier [HIDEHERNEEMTEERSTEJAAR]" id="tbl_herneemteerstejaar">
    <tr>
        <th style="width: 120px;">Welke school?</th>        
        <td colspan="2">
            <div class="link search_school_trigger">
                <div class="search" style="float:left;"></div>
                <div style="float:left;line-height: 23px;cursor: pointer;"><strong>Zoek school op een eenvoudige manier</strong></div>
            </div>
        </td>
    </tr>
    
    <tr class="herneemteerstejaar_school_static [HIDE_HERNEEMTEERSTEJAARSCHOOLSTATIC]">
        <th></th>
        <th>School</th>
        <td colspan="3"><span class="herneemteerstejaar_school_naam">[HERNEEMTEERSTEJAARSCHOOLNAAM]</span></td>
    </tr>
    <tr class="herneemteerstejaar_school_static [HIDE_HERNEEMTEERSTEJAARSCHOOLSTATIC]">
        <th></th>
        <th></th>
        <td><span class="herneemteerstejaar_school_postcode">[HERNEEMTEERSTEJAARSCHOOLPOSTCODE]</span> <span class="herneemteerstejaar_school_gemeente">[HERNEEMTEERSTEJAARSCHOOLGEMEENTE]</span></td>
    </tr>
    
    <tr class="herneemteerstejaar_school_manual">
        <td colspan="4"><h4>Geen probleem, gelieve uw school handmatig in te vullen</h4></td>
    </tr>    
    <tr class="herneemteerstejaar_extra herneemteerstejaar_school_manual">
        <th style="width: 120px;"></th>
        <th>Naam school</th>
        <td><input type="text" id="herneemt_eerste_jaar_school_naam" value="[HERNEEMTEERSTEJAARSCHOOLNAAM]" style="width:448px;"></td>
    </tr>
    <tr class="herneemteerstejaar_extra herneemteerstejaar_school_manual">
        <th style="width: 120px;"></th>
        <th>Postcode + Gemeente</th>
        <td>
            <input type="text" id="herneemt_eerste_jaar_school_postcode" value="[HERNEEMTEERSTEJAARSCHOOLPOSTCODE]" style="width: 100px;" autocomplete="off"> <input type="text" id="herneemt_eerste_jaar_school_gemeente" value="[HERNEEMTEERSTEJAARSCHOOLGEMEENTE]" style="width:332px;" autocomplete="off">
        </td>
    </tr>                
</table>



<table class="formulier">
    <tr>
        <th style="width: 400px;">Heeft de leerling leerproblemen?</th>        
        <td>
            <label><input type="radio" name="leerproblemen" id="leerproblemen_ja" style="width:20px;" value="Ja" [CHECKLEERPROBLEMENJA]> Ja</label>
            <label><input type="radio" name="leerproblemen" id="leerproblemen_nee" style="width:20px;margin-left: 50px;" value="Nee" [CHECKLEERPROBLEMENNEE]> Nee</label>        
        </td>
    </tr>
</table>

<table class="formulier [DISABLELEERPROBLEMEN]" id="tbl_leerproblemen">
    <tr>
        <th style="width: 700px;">Welke dan?</th>        
        <td>
            <input type="text" id="leerproblemen_extra" value="[LEERPROBLEMENEXTRA]">
        </td>
    </tr>
</table>



<table class="formulier">
    <tr>
        <th style="width: 400px;">Heeft de leerling gezondheidsproblemen?</th>        
        <td>
            <label><input type="radio" name="gezondheidsproblemen" id="gezondheidsproblemen_ja" style="width:20px;" value="Ja" [CHECKGEZONDHEIDSPROBLEMENJA]> Ja</label>
            <label><input type="radio" name="gezondheidsproblemen" id="gezondheidsproblemen_nee" style="width:20px;margin-left: 50px;" value="Nee" [CHECKGEZONDHEIDSPROBLEMENNEE]> Nee</label>        
        </td>
    </tr>
</table>

<table class="formulier [DISABLEGEZONDHEIDSPROBLEMEN]" id="tbl_gezondheidsproblemen">
    <tr>
        <th style="width: 700px;">Welke dan?</th>        
        <td>
            <input type="text" id="gezondheidsproblemen_extra" value="[GEZONDHEIDSPROBLEMENEXTRA]">
        </td>
    </tr>
</table>




<table class="formulier">
    <tr>
        <th style="width: 400px;">Heeft de leerling gedragsproblemen?</th>        
        <td>
            <label><input type="radio" name="gedragsproblemen" id="gedragsproblemen_ja" style="width:20px;" value="Ja" [CHECKGEDRAGSPROBLEMENJA]> Ja</label>
            <label><input type="radio" name="gedragsproblemen" id="gedragsproblemen_nee" style="width:20px;margin-left: 50px;" value="Nee" [CHECKGEDRAGSPROBLEMENNEE]> Nee</label>        
        </td>
    </tr>
</table>

<table class="formulier [DISABLEGEDRAGSPROBLEMEN]" id="tbl_gedragsproblemen">
    <tr>
        <th style="width: 700px;">Welke dan?</th>        
        <td>
            <input type="text" id="gedragsproblemen_extra" value="[GEDRAGSPROBLEMENEXTRA]">
        </td>
    </tr>
</table>


<input type="hidden" id="herneemt_eerste_jaar_school_id" value="[HERNEEMTEERSTEJAARSCHOOLID]">


<script type="text/javascript">

    search_school_herneemteerstejaar_functions();
    
 
    
    $('#herneemt_eerste_jaar_school_postcode').autocomplete2({
      serviceUrl:'/ajax.php?action=get_cities',
      minChars:2,
      delimiter: /(,|;)\s*/, 
      maxHeight:400,
      width:500,
      zIndex: 9999,
      deferRequestBy: 0, 
      noCache: false, 
      onSelect: function(value, data){
                   
        pc = data.substr(0,4);
        gemeente = data.substr(7);

        $('#herneemt_eerste_jaar_school_postcode').val(pc);
        $('#herneemt_eerste_jaar_school_gemeente').val(gemeente);
        
      }
    });
        
        


</script>