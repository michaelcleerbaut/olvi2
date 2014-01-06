
// INIT FIRST TAB
var tab = 0;
focus_click_functions(1);
focus_functions();

$(document).ready(function(){

    // INITIALIZE FIRST FORM STEP     
    vak_height_functions("1");    


    // PREVIOUS SLIDE
    $('.prev').click(function(){     
        slide_prev();    
    });

    // NEXT SLIDE
    $('.next').click(function(){    
        if($(this).hasClass('navigatorDisable') || $(this).hasClass('navigatorNoClick')){
            return false;
        } else {
            $('.next').addClass('navigatorNoClick');
        }        
        validate_vak();
    });


    // LOAD FUNCTIONS
    global_form_functions();
    print_triggers();
    kindvorigeschool_functions();
    ookastroom_functions();
    stroomkeuze_functions();
    gegevens_ophalen_functions();
    gegevens_ouders_functions();
    studiekeuze_functions();
    vipinformatie_functions();
    gok_functions();
    baso_functions();

    // VARIA
    if($('#nieuwe_inschrijving_beginnen').length > 0){    
        $('#nieuwe_inschrijving_beginnen').click(function(){
            window.location = "/frm/inschrijving"; 
        });
    }

    // DEBUGGING FORM
    /*
    var hash = window.location.hash.substr(1)
    if(hash != ""){
    change_slider(hash);        
    change_active_slider(hash);
    vak_height_functions(hash);    
    focus_click_functions(hash);
    } else {
    window.location.hash = 1;
    change_slider(1);        
    change_active_slider(1);        
    vak_height_functions("1");  
    focus_click_functions(1);
    }
    */


});



// FORM FUNCTIONS
function print_triggers(){

    // PRINT BUTTONS
    if($('#print_inschrijving').length > 0){
        $('#print_inschrijving').click(function(){
            window.open("/prt/inschrijving"); 
        });
    }    

    if($('#print_vip_leerproblemen').length > 0){
        $('#print_vip_leerproblemen').click(function(){
            window.open("/prt/vip_leerproblemen");
        });
    }

    if($('#print_vip_gedragsproblemen').length > 0){
        $('#print_vip_gedragsproblemen').click(function(){
            window.open("/prt/vip_gedragsproblemen");
        });
    }

    if($('#print_vip_gezondheidsproblemen').length > 0){
        $('#print_vip_gezondheidsproblemen').click(function(){
            window.open("/prt/vip_gezondheidsproblemen");
        });
    }

    if($('#print_voorinschrijving').length > 0){
        $('#print_voorinschrijving').click(function(){        
            window.open("/prt/voorinschrijving");
        });
    }

}

function eindwoord_inschrijving_functions(){

    $('#nieuwe_inschrijving_beginnen').click(function(){
        window.location = "/frm/inschrijving"; 
    });


    $('#print_inschrijving').click(function(){
        window.open("/prt/inschrijving"); 
    });        

    $('#ookastroom_inschrijving').click(function(){
        $('#bgOverlay').fadeIn();
        $('#studiekeuzes_ooka').fadeIn();
    });

    $('#annuleer_studiekeuzes_ooka').click(function(){
        $('#bgOverlay').fadeIn();
        $('#studiekeuzes_ooka').fadeIn();           
    });

    $('#studiekeuze_select').change(function(){
        if($(this).val() == "A-Stroom: Algemene vorming"){
            $('#studiekeuzes').show();
        } else {
            $('#studiekeuzes').hide();
        }
    });

    $('#save_studiekeuzes_ooka').click(function(){       
        show_loading("Gegevens opslaan");
        fields = get_fields();                      
        $.post('/ajax.php',{action : "save_ooka_inschrijving", fields : fields, studiekeuze : $('#studiekeuze_select').val()}, function(result){               
            $('#ookastroom_inschrijving').addClass('disabled');            
            hide_loading();
            $('#bgOverlay').fadeOut();
            $('#studiekeuzes_ooka').fadeOut(function(){
                alert("Succesvol opgeslagen in A stroom");             
                $('#ookastroom_inschrijving').fadeOut(200);
            });

        });
        return false;
    });     
}

function search_lagereschool_functions(){
    
    
    $('#search_lagere_school').click(function(){
        $('#bgOverlay').fadeIn(50);
        $('#search_lagere_school_con').fadeIn(100); 
    });

    $('#annuleer_search_lagereschool').click(function(){
        $('#bgOverlay').fadeOut(100);
        $('#search_lagere_school_con').fadeOut(50);                 
    });


    $('#search_lagere_school_pg').keyup(function(e){
        if(e.keyCode == 13){                    
            return false;        
        }
    });    

    $('#search_lagere_school_pg').autocomplete2({
        serviceUrl:'/ajax.php?action=get_cities',
        minChars:2,
        delimiter: /(,|;)\s*/, // regex or character
        maxHeight:400,
        width:500,
        zIndex: 9999,
        deferRequestBy: 0, //miliseconds
        noCache: false, //default is false, set to true to disable caching
        onSelect: function(value, data){                     
            pc = data.substr(0,4);
            gemeente = data.substr(7);



            $.post("/ajax.php",{action: "search_lagere_scholen", postcode : pc}, function(result){

                result += "<div class=\"btnSmall\" style=\"margin-top: 20px;font-weight: normal;padding: 10px;\" id=\"trigger_manual_lagere_school\">Mijn vorige school staat hier niet tussen</div>";
                
                $('#result_lagere_scholen').html(result);

                $('.school_suggestie').click(function(){

                    $('#kind_vorigeschool_id').val($(this).attr('id'));
                    $('#kind_vorigeschool_naam').val($(this).attr('naam'));                    
                    $('#kind_vorigeschool_postcode').val($(this).attr('pc'));
                    $('#kind_vorigeschool_gemeente').val($(this).attr('gemeente'));
                    
                    $('.kind_vorigeschool_naam').html($(this).attr('naam'));
                    $('.kind_vorigeschool_postcode').html($(this).attr('pc'));
                    $('.kind_vorigeschool_gemeente').html($(this).attr('gemeente'));
                    $('.kind_vorigeschool_static').removeClass('hide');
                    
                    $('#bgOverlay').fadeOut(100);
                    $('#search_lagere_school_con').fadeOut(50);
                });
                
                $('#trigger_manual_lagere_school').click(function(){
                    $('#search_lagere_school_con').fadeOut(50);
                    $('#bgOverlay').fadeOut(100);
                    $('.kind_vorigeschool_manual').fadeIn(50);
                    
                    index = $('.stappen .active').index() + 1;
                    vak_height_functions(index);
                    
                    
                    $('.kind_vorigeschool_static').addClass('hide');
                    
                    $('#kind_vorigeschool_naam').focus();
                    $('html,body').animate({scrollTop: $("#kind_vorigeschool_naam").offset().top},200);                    
                });

            });
        }
    });

}


function search_school_herneemteerstejaar_functions(){
    
    
    $('.search_school_trigger').click(function(){        
        $('#bgOverlay').fadeIn(50);
        $('.search_school_con').fadeIn(100); 
    });

    $('.annuleer_school_search').click(function(){
        $('#bgOverlay').fadeOut(100);
        $('.search_school_con').fadeOut(50);                 
    });


    $('.school_pg').keyup(function(e){
        if(e.keyCode == 13){                    
            return false;        
        }
    });    

    $('.school_pg').autocomplete2({
        serviceUrl:'/ajax.php?action=get_cities',
        minChars:2,
        delimiter: /(,|;)\s*/, // regex or character
        maxHeight:400,
        width:500,
        zIndex: 9999,
        deferRequestBy: 0, //miliseconds
        noCache: false, //default is false, set to true to disable caching
        onSelect: function(value, data){                     
            pc = data.substr(0,4);
            gemeente = data.substr(7);



            $.post("/ajax.php",{action: "search_secundaire_scholen", postcode : pc}, function(result){

                result += "<div class=\"btnSmall\" style=\"margin-top: 20px;font-weight: normal;padding: 10px;\" id=\"trigger_manual_lagere_school\">De school die ik zoek staat hier niet tussen</div>";
                
                $('#result_scholen').html(result);

                $('.search_school_con .school_suggestie').click(function(){

                    $('#herneemt_eerste_jaar_school_id').val($(this).attr('id'));
                    $('#herneemt_eerste_jaar_school_naam').val($(this).attr('naam'));                    
                    $('#herneemt_eerste_jaar_school_postcode').val($(this).attr('pc'));
                    $('#herneemt_eerste_jaar_school_gemeente').val($(this).attr('gemeente'));
                    
                    $('span.herneemteerstejaar_school_naam').html($(this).attr('naam'));                    
                    $('span.herneemteerstejaar_school_postcode').html($(this).attr('pc'));
                    $('span.herneemteerstejaar_school_gemeente').html($(this).attr('gemeente'));
                    
                    $('.herneemteerstejaar_school_static').removeClass('hide');
                    
                    $('#bgOverlay').fadeOut(100);
                    $('.search_school_con').fadeOut(50);
                });
                
                $('.search_school_con #trigger_manual_lagere_school').click(function(){
                    $('.search_school_con').fadeOut(50);
                    $('#bgOverlay').fadeOut(100);
                    $('.herneemteerstejaar_school_manual').fadeIn(50);
                    
                    index = $('.stappen .active').index() + 1;
                    vak_height_functions(index);
                    
                    
                    $('.herneemteerstejaar_school_static').addClass('hide');
                    
                    $('input.herneemteerstejaar_school_naam').focus();
                    $('html,body').animate({scrollTop: $("input.herneemteerstejaar_school_naam").offset().top},200);                    
                });

            });
        }
    });

}

function baso_functions(){

    $('#basoJa').click(function(){
        $('#baso').val("YES");       
        $(this).addClass('btnBigActive'); 
        $('#basoNee').removeClass('btnBigActive');
    });

    $('#basoNee').click(function(){
        $('#baso').val("NO");       
        $(this).addClass('btnBigActive'); 
        $('#basoJa').removeClass('btnBigActive');
    });    
}

function gok_functions(){

    $('input[type=radio][name=gok_moeder_edison_spreektaal]').click(function(){
        if($(this).val() == "Een andere taal"){
            $('#taal_moeder_extra').removeClass('disabled');
            $('#taal_moeder_extra input').removeAttr('readonly');               
        } else {           
            $('#taal_moeder_extra').addClass('disabled');
            $('#taal_moeder_extra input').attr('readonly','readonly');   
        }
    });

    $('input[type=radio][name=gok_vader_edison_spreektaal]').click(function(){
        if($(this).val() == "Een andere taal"){
            $('#taal_vader_extra').removeClass('disabled');
            $('#taal_vader_extra input').removeAttr('readonly');               
        } else {           
            $('#taal_vader_extra').addClass('disabled');
            $('#taal_vader_extra input').attr('readonly','readonly');   
        }
    });

    $('input[type=radio][name=gok_broer_zus_edison_spreektaal]').click(function(){
        if($(this).val() == "Een andere taal"){
            $('#taal_broer_zus_extra').removeClass('disabled');
            $('#taal_broer_zus_extra input').removeAttr('readonly');               
        } else {           
            $('#taal_broer_zus_extra').addClass('disabled');
            $('#taal_broer_zus_extra input').attr('readonly','readonly');   
        }
    });


    $('input[type=radio][name=gok_vrienden_edison_spreektaal]').click(function(){
        if($(this).val() == "Een andere taal"){
            $('#taal_vrienden_extra').removeClass('disabled');
            $('#taal_vrienden_extra input').removeAttr('readonly');               
        } else {           
            $('#taal_vrienden_extra').addClass('disabled');
            $('#taal_vrienden_extra input').attr('readonly','readonly');   
        }
    });

}

function vipinformatie_functions(){

    $('input[type=radio][name=middag]').click(function(){
        if($(this).attr('id') == "middag_thuis" || $(this).attr('id') == "middag_half"){
            if($(this).attr('id') == "middag_half"){
                $('#thuis_dagen').show();
            } else {
                $('#thuis_dagen').hide();
                $('#thuis_dagen input[type=checkbox]').removeAttr('checked');
            }            
            $('#vip_middag').removeClass('disabled');
            $('#vip_middag input').removeAttr('readonly');               
        } else {           
            $('#vip_middag').addClass('disabled');
            $('#vip_middag input').attr('readonly','readonly');
            $('#thuis_dagen').hide();   
            $('#thuis_dagen input[type=checkbox]').removeAttr('checked');}
    });



    $('input[type=radio][name=door_beide_ouders_opgevoed]').click(function(){
        if($(this).attr('id') == "opvoeding_ouders_nee"){
            $('#opvoeding_ouders').removeClass('disabled');
            $('#opvoeding_ouders input').removeAttr('readonly');                          
            $('#opvoeding_ouders input').removeAttr('disabled');                          
            $('input[type=checkbox][name=stiefouders]').removeAttr('disabled');                          
        } else {            
            $('#opvoeding_ouders').addClass('disabled');
            $('#opvoeding_ouders input').attr('readonly','readonly');
            $('#opvoeding_ouders input[type=radio]').attr('disabled','disabled').removeAttr('checked');            
            $('input[type=checkbox][name=stiefouders]').removeAttr('checked').attr('disabled','disabled');
            $('#gegevens_stiefouders input').val('');
            $('#gegevens_stiefouders').hide();                          
        }
    });
    
    $('input[type=radio][name=opgevoed_door_andere]').click(function(){
        $('#checkbox_stiefouders').show();
    });
    
    
    $('input[type=checkbox][name=stiefouders]').click(function(){
       if($(this).is(':checked')){
           $('#gegevens_stiefouders').show();
           auto_adapt_current_vak_height();
       } else {
           $('#gegevens_stiefouders').hide();
           $('#gegevens_stiefouders input').val('');
       } 
    });
    

    $('input[type=radio][name=thuistaal_ned]').click(function(){
        if($(this).attr('id') == "thuistaal_ned_nee"){
            $('#tbl_thuistaal_andere').removeClass('disabled');
            $('#tbl_thuistaal_andere input').removeAttr('readonly');                                     
        } else {
            $('#tbl_thuistaal_andere').addClass('disabled');
            $('#tbl_thuistaal_andere input').attr('readonly','readonly');                                     
        }
    });

    $('input[type=radio][name=leerproblemen]').click(function(){
        if($(this).attr('id') == "leerproblemen_ja"){
            $('#tbl_leerproblemen').removeClass('disabled');
            $('#tbl_leerproblemen input').removeAttr('readonly');                                     
        } else {
            $('#tbl_leerproblemen').addClass('disabled');
            $('#tbl_leerproblemen input').attr('readonly','readonly');                                     
        }
    });

    $('input[type=radio][name=gezondheidsproblemen]').click(function(){
        if($(this).attr('id') == "gezondheidsproblemen_ja"){
            $('#tbl_gezondheidsproblemen').removeClass('disabled');
            $('#tbl_gezondheidsproblemen input').removeAttr('readonly');                                     
        } else {
            $('#tbl_gezondheidsproblemen').addClass('disabled');
            $('#tbl_gezondheidsproblemen input').attr('readonly','readonly');                                     
        }
    }); 


    $('input[type=radio][name=gedragsproblemen]').click(function(){
        if($(this).attr('id') == "gedragsproblemen_ja"){
            $('#tbl_gedragsproblemen').removeClass('disabled');
            $('#tbl_gedragsproblemen input').removeAttr('readonly');                                     
        } else {
            $('#tbl_gedragsproblemen').addClass('disabled');
            $('#tbl_gedragsproblemen input').attr('readonly','readonly');                                     
        }
    }); 


    $('input[type=radio][name=heeft_jaar_moeten_overdoen]').click(function(){
        if($(this).attr('id') == "jaaroverdoen_ja"){
            $('#tbl_jaaroverdoen').removeClass('disabled');
            $('#tbl_jaaroverdoen input').removeAttr('readonly');                                     
        } else {
            $('#tbl_jaaroverdoen').addClass('disabled');
            $('#tbl_jaaroverdoen input').attr('readonly','readonly');                                     
        }
    });
                
    $('input[type=radio][name=herneemt_eerste_jaar]').click(function(){
        if($(this).attr('id') == "herneemteerstejaar_ja"){
            $('#tbl_herneemteerstejaar').removeClass('hide');
            auto_adapt_current_vak_height();            
        } else {
            $('#tbl_herneemteerstejaar').addClass('hide');            
        }
    });                



}


function auto_adapt_current_vak_height(){
    index = $('.stappen .active').index() + 1;
    vak_height_functions(index);
}


function studiekeuze_functions(){

    $('#studiekeuze').change(function(){
        if($(this).val() == "aalgemeen"){            
            $('#extra_studiekeuzes').removeClass('disabled');
            $('#extra_studiekeuzes input').removeAttr('readonly');   
        } else {
            $('#extra_studiekeuzes').addClass('disabled');
            $('#extra_studiekeuzes input').attr('readonly','readonly');               
        }
    });


    $('table.disabled input').each(function(){
        $(this).attr('readonly','readonly');
    });



}

function gegevens_ouders_functions(){

    $('#moeder_zelfde_als_lln').change(function(){
        if($(this).is(':checked')){
            $('#moeder_straat').val($('#straat').val());
            $('#moeder_huisnummer').val($('#huisnummer').val());
            $('#moeder_busnummer').val($('#busnummer').val());
            $('#moeder_postcode').val($('#postcode').val());
            $('#moeder_plaats').val($('#plaats').val());            
        } else {
            $('#moeder_straat').val('');
            $('#moeder_huisnummer').val('');
            $('#moeder_busnummer').val('');
            $('#moeder_postcode').val('');
            $('#moeder_plaats').val('');
        }
    });

    $('#vader_zelfde_als_lln').change(function(){
        if($(this).is(':checked')){
            $('#vader_straat').val($('#straat').val());
            $('#vader_huisnummer').val($('#huisnummer').val());
            $('#vader_busnummer').val($('#busnummer').val());
            $('#vader_postcode').val($('#postcode').val());
            $('#vader_plaats').val($('#plaats').val());            
        } else {
            $('#vader_straat').val('');
            $('#vader_huisnummer').val('');
            $('#vader_busnummer').val('');
            $('#vader_postcode').val('');
            $('#vader_plaats').val('');
        }
    });    


}

function vak_height_functions(index){

    currentvak = $('.vakken .vak:nth-child('+index+')');      
    $(currentvak).css('height','auto');          
    h = $(currentvak).css('height').replace('px','') * 1;    
    $('.vakken .vak').css('height','300px');    
    if(h <= "300"){        
        $(currentvak).css('height','300px');    
    } else {
        $(currentvak).css('height',h);
    }

    
    $('input[type=text]').attr('autocomplete','off');
}

function ookastroom_functions(){

    $('#ooka_ja').click(function(){
        $('#ooka').val("YES");       
        $(this).addClass('btnBigActive'); 
        $('#ooka_nee').removeClass('btnBigActive');
    });

    $('#ooka_nee').click(function(){
        $('#ooka').val("NO");       
        $(this).addClass('btnBigActive'); 
        $('#ooka_ja').removeClass('btnBigActive');
    });

}


function kindvorigeschool_functions(){
    $('#kind_vorigeschool_other').click(function(){
        if($(this).is(':checked')){
            $('#kind_vorigeschool option:first').attr('selected','selected');
            $('.kind_vorigeschool_extra').removeClass('disabled');
            $('.kind_vorigeschool_extra input').removeClass('readonly');            
            $('.kind_vorigeschool_extra input').removeAttr('readonly');
            $('#kind_vorigeschool').attr('disabled','disabled');
            $('#kind_vorigeschool_naam').val('').focus();
            $('#kind_vorigeschool_postcode').val('');
            $('#kind_vorigeschool_gemeente').val('');
        } else {            
            $('.kind_vorigeschool_extra').addClass('disabled');
            $('.kind_vorigeschool_extra input').addClass('readonly');
            $('.kind_vorigeschool_extra input').attr('readonly','readonly');
            $('#kind_vorigeschool').removeAttr('disabled');            
        }
    });

    $('#kind_vorigeschool').change(function(){        
        $('#kind_vorigeschool_naam').val($(':selected',this).html());                
        $('#kind_vorigeschool_postcode').val($(':selected', this).attr('pc'));        
        $('#kind_vorigeschool_gemeente').val($(':selected', this).attr('gemeente'));        
    });    
}

function stroomkeuze_functions(){

    $('#stroomA').click(function(){
        $('#stroomkeuze').val("A"); 
        $(this).addClass('btnBigActive');
        $('#stroomB').removeClass('btnBigActive');
        if($('#nieuw_geklikt').val() == "YES"){
            $('#nieuw_geklikt').val('NO');
            $('#delete_vorig').val("YES");
            $('#kind_gegevens_laden').val("YES");
        } else if ($('#naam_kind').val != "" || $('#volgnummer').val() != ""){
            $('#kind_gegevens_laden').val("YES");
        }
        $('.studie_strooma').show();
        $('.studie_stroomb').hide();
    });

    $('#stroomB').click(function(){
        $('#stroomkeuze').val("B"); 
        $(this).addClass('btnBigActive');
        $('#stroomA').removeClass('btnBigActive');
        if($('#nieuw_geklikt').val() == "YES"){
            $('#nieuw_geklikt').val('NO');
            $('#delete_vorig').val("YES");
            $('#kind_gegevens_laden').val("YES");
        }
        $('.studie_stroomb').show();
        $('.studie_strooma').hide();       
    });


}

function gegevens_ophalen_functions(){

    $('#via_volgnummer').click(function(){    
        $(this).addClass('btnBigActive');
        $('#via_naam').removeClass('btnBigActive');
        $('#nieuw_kind_selector').removeClass('btnBigActive');

        $('#volgnummer').removeAttr('disabled').focus();
        $('#stroom_select').removeAttr('disabled');

        $('#naam_kind').val('').attr('disabled','disabled');    
        $('#nieuw_kind').val('');
    });

    $('#via_naam').click(function(){
        $(this).addClass('btnBigActive');
        $('#via_volgnummer').removeClass('btnBigActive');
        $('#naam_kind').removeAttr('disabled').focus();
        $('#nieuw_kind_selector').removeClass('btnBigActive');
        $('#volgnummer').val('').attr('disabled','disabled');            
        $('#stroom_select').attr('disabled','disabled');            
        $('#nieuw_kind').val('');
    });

    $('#nieuw_kind_selector').click(function(){
        $(this).addClass('btnBigActive');
        $('#via_volgnummer').removeClass('btnBigActive');
        $('#via_naam').removeClass('btnBigActive');        
        $('#volgnummer').val('').attr('disabled','disabled');            
        $('#naam_kind').val('').attr('disabled','disabled');            
        $('#nieuw_kind').val('YES');     
        if($('#nieuw_geklikt').val() != "YES"){
            $('#kind_gegevens_laden').val("YES");
        }   
    });     


}


// FORM CORE FUNCTIONS
function global_form_functions(){

    $('.datepicker').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat : 'yy/mm/dd',
        yearRange: '1990:2012',

    });      

    // change focus
    $('input').focus(function(){
        $('.focus').removeClass('focus');
        $(this).addClass('focus'); 
    });

    // calculate width between steps (1 - 2 - 3 - 4 ..)
    aantalStappen = $('.stappen div').size();    
    marginStappen = (((1000 / aantalStappen) - 41) / 2);
    $('.stappen div').css('marginLeft',marginStappen).css('marginRight',marginStappen);


}


function focus_click_functions(index){

    currentvak = $('.vakken .vak:nth-child('+index+')');      

    $('input[tabindex], select[tabindex]', currentvak).click(function(){        
        $('.focus',currentvak).removeClass('focus');
        $(this).addClass('focus').focus();
        tab = $(this).attr('tabindex');                
    });

}

function focus_functions(){                                  

    $(document).keydown(function(objEvent) {
        if (objEvent.keyCode == 9) {  //tab pressed    

            index = $('.stappen .active').index() +1;
            currentvak = $('.vakken div:nth-child('+index+')');        

            // get last tab
            tabEnd = 0;
            $('input[tabindex], select[tabindex], textarea[tabindex]',currentvak).each(function(){                
                if($(this).attr('tabindex') > tabEnd){
                    tabEnd = $(this).attr('tabindex');
                }
            });
            console.log("aantal tabs: " + tabEnd);

            // check if field is focused (jquery), if not: set tab to 1 + remove .focused field (class)
            if($('input, select, textarea', currentvak).is(":focus")){
                
            } else {
                $('.focus', currentvak).removeClass('focus');
                tab = 1;
            }
            
            // check if current vak has a field focused, if not, focus on first tabindex field
            console.log("focus field gevonden: " + $('.focus', currentvak).size());
            console.log("focus tabindex: " + $('.focus', currentvak).attr("tabindex"));
            if($('.focus', currentvak).size() == 0){
                console.log("geen focus class gevonden, gaat naar tab1");                                        
                $('input[tabindex=1], select[tabindex=1], textarea[tabindex=1]', currentvak).addClass('focus').focus();             
                tab = 1;
            } else {                            
                tab += 1;
                if(tab > tabEnd){                               
                    console.log("gaat naar tab 1, tab: " + tab + ", tabEnd: " + tabEnd);                          
                    $('.focus', currentvak).removeClass('focus');
                    $('input[tabindex=1], select[tabindex=1], textarea[tabindex=1]',currentvak).addClass('focus').focus();            
                    tab = 1;
                } else {
                    console.log("gaat naar tab:" + tab);                    
                    $('.focus', currentvak).removeClass('focus');
                    $('input[tabindex='+tab+'], select[tabindex='+tab+'], textarea[tabindex='+tab+']',currentvak).addClass('focus').focus();            
                }                
            }

            objEvent.preventDefault(); // stops its action
        }
    });

    $(document).keyup(function(e){    
        if(e.keyCode == 13){
            if($(':focus').hasClass("no_enter_submit")){

            } else {
                $('.next').click();
            }
        }
    });


}


function get_fields(){
    fields = "";
    index = $('.stappen .active').index() + 1;
    vak = $('.vakken div:nth-child('+index+')');
    $('input[type=hidden]',vak).each(function(){    
        fields += $(this).attr('id') + "###" + $(this).val() + "@@@"; 
    });    

    $('input[type=text]',vak).each(function(){    
        fields += $(this).attr('id') + "###" + $(this).val() + "@@@"; 
    });    

    $('select',vak).each(function(){    
        fields += $(this).attr('id') + "###" + $(this).val() + "@@@"; 
    });    

    $('input[type=radio]',vak).each(function(){            
        if($(this).attr('checked') == "checked"){
            fields += $(this).attr('name') + "###" + $(this).val() + "@@@"; 
        }
    });    
    $('input[type=checkbox]',vak).each(function(){            
        if($(this).attr('checked') == "checked"){
            fields += $(this).attr('name') + "###" + $(this).val() + "@@@"; 
        }
    });    
    $('textarea', vak).each(function(){
        fields += $(this).attr('id') + "###" + $(this).val() + "@@@";         
    });
    return fields;
}


function show_loading(message){
    $('#loading').html(message);
    $('#loading').fadeIn(100);
}

function hide_loading(){
    $('#loading').fadeOut(200);
}


function check_validation(message, sort, func, data){    
    if(message != ""){
        $('.error').html(message).fadeIn(200);
        $('.next').removeClass('navigatorNoClick');
        
        $.post("/ajax.php",{"action" : "log_action", "sort" : sort, "func" : func, "message" : message, "data" : data});
        
        return false;
    } else {
        $('.error').fadeOut(200).html('');
        slide_next();
    }
        
}


function slide_next(){

    aantalVakken = $('.vakken .vak').length;              
    mLeft = ($('.vakken').css('marginLeft').replace("px","") * 1) - 1000;

    if(mLeft < 0){
        $('.prev').removeClass('navigatorDisable');
    }    
    if((((aantalVakken - 1) * 1000) * -1) == mLeft){
        $('.next').addClass('navigatorDisable');
    }

    $('.vakken').animate({marginLeft: mLeft+"px"},200);     
    //window.location.hash = window.location.hash.substr(1) * 1 + 1;

    active = $('.stappen .active');       
    $('.stappen .active').removeClass('active');       


    $(active).next().addClass('active');       
    $('.vak-titel').html($(active).next().attr('titel'));


    index = $(active).next().index() + 1;                  
    change_active_slider(index);                  


    preload_key = $('.vakken .vak:nth-child('+index+')').attr('preload');       
    if(preload_key != ""){
        preload(preload_key);        
    }

    vak_height_functions(index);
    focus_click_functions(index);
    var tab = 0;
    $('.next').removeClass('navigatorNoClick');
}

function slide_prev(){

    $('.error').fadeOut(200).html('');

    mLeft = ($('.vakken').css('marginLeft').replace("px","") * 1) + 1000;       
    if(mLeft <= 0){       
        //window.location.hash = window.location.hash.substr(1) * 1 - 1;
        $('.vakken').animate({marginLeft: mLeft+"px"},200);        
        active = $('.stappen .active');
        $('.stappen .active').removeClass('active');       
        $(active).prev().addClass('active');
        $('.vak-titel').html($(active).prev().attr('titel'));    
        index = $(active).prev().index() + 1;    
        change_active_slider(index);            
        vak_height_functions(index);
        focus_click_functions(index);
    }    

    aantalVakken = $('.vakken .vak').length;
    if((aantalVakken * 1000) >= mLeft){
        $('.next').removeClass('navigatorDisable');
    }

    if(mLeft == 0){
        $('.prev').addClass('navigatorDisable');
    }

    var tab = 0; 

}



function change_active_slider(index){        
    w = 0;                  
    $('.stappen div').removeClass('passed');
    for(i=1;i<=index;i++){            
        l = $('.stappen div:nth-child('+i+')').css('marginLeft').replace('px','') * 1;            
        if(i < index){        
            $('.stappen div:nth-child('+i+')').addClass('passed');
            r = $('.stappen div:nth-child('+i+')').css('marginRight').replace('px','') * 1;        
            a = 40;
        } else {
            r = 0;
            a = 20;
        }                    
        w += l + r + a;        
    }              
    $('.progressbar-active').css('width',w+'px');              


}

function change_slider(nr){

    aantalVakken = $('.vakken .vak').length;
    if(nr > aantalVakken){
        return false;
    } else if(nr == 1){
        $('.next').removeClass('navigatorDisable');
        $('.prev').addClass('navigatorDisable');
    } else if(nr == aantalVakken){
        $('.next').addClass('navigatorDisable');
        $('.prev').removeClass('navigatorDisable');        
    } else {
        $('.next').removeClass('navigatorDisable');
        $('.prev').removeClass('navigatorDisable');                
    }



    startLeft = (nr - 1)  * -1000;
    $('.vakken').animate({marginLeft: startLeft+"px"},200);
    $('.stappen .active').removeClass('active');
    $('.stappen div:nth-child('+nr+')').addClass('active');             



}