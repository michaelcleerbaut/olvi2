function preload(preload_key){

    switch(preload_key){

        case "load_gegevens":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_gegevens", id_leerling : $('#id_leerling').val()},function(result){            
                hide_loading();        
                index = $('.stappen .active').index() + 1;                
                $('#overzicht_gegevens_kind').html(result);
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);            
            });

            break;
            
            
        case "load_vip_leerproblemen":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_leerproblemen", id_leerling : $('#id_leerling').val()},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;
            

        case "load_vip_gedragsproblemen_klassenraad":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_gedragsproblemen_klassenraad", id_leerling : $('#id_leerling').val()},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_andereproblemen_klassenraad":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_andereproblemen_klassenraad", id_leerling : $('#id_leerling').val()},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_leerproblemen_klassenraad":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_leerproblemen_klassenraad", id_leerling : $('#id_leerling').val()},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_gedragsproblemen_omschrijving":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_gedragsproblemen_omschrijving", id_leerling : $('#id_leerling').val()},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;
            

        case "load_vip_andereproblemen_omschrijving":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_andereproblemen_omschrijving", id_leerling : $('#id_leerling').val()},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_gezondheidsproblemen_klassenraad":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_gezondheidsproblemen_klassenraad", id_leerling : $('#id_leerling').val()},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;
            

        case "load_vip_gezondheidsproblemen_omschrijving":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_gezondheidsproblemen_omschrijving", id_leerling : $('#id_leerling').val()},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_gedragsproblemen":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_gedragsproblemen", id_leerling : $('#id_leerling').val()},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_gezondheidsproblemen":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_gezondheidsproblemen", id_leerling : $('#id_leerling').val()},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_jaaroverdoen":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_jaaroverdoen"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;
            

        case "load_vip_bijkomendeinformatie":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_bijkomendeinformatie"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;
            

        case "load_vip_signalen":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_signalen"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;
            

        case  "load_vip_watzekerdoen":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_watzekerdoen"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_watzekernietdoen":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_watzekernietdoen"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_gezondheidsproblemen_attesten":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_gezondheidsproblemen_attesten"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_gezondheidsproblemen_gesprekken":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_gezondheidsproblemen_gesprekken"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break; 


        case "load_vip_gedragsproblemen_thuis":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_gedragsproblemen_thuis"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_gedragsproblemen_school":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_gedragsproblemen_school"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_begeleiding_gedragsproblemen":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_begeleiding_gedragsproblemen"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_attesten_gedragsproblemen":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_attesten_gedragsproblemen"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_gesprekken_gedragsproblemen":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_gesprekken_gedragsproblemen"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_gesprekken_andereproblemen":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_gesprekken_andereproblemen"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_omgang_gedragsproblemen":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_omgang_gedragsproblemen"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_vakgebonden":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_vakgebonden"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_gedragsproblemen_leerproblemen":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_gedragsproblemen_leerproblemen"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_taakleraar_lo":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_taakleraar_lo"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "load_vip_begeleiding":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_begeleiding"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break; 

            
        case "load_vip_attesten":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_attesten"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;
            
            
        case "load_vip_gesprekken":

            show_loading("Gegevens opvragen");
            $.post('/ajax.php',{action : "load_vip_gesprekken"},function(result){
                hide_loading();
                index = $('.stappen .active').index() + 1;                
                $('.vakken .vak:nth-child('+index+')').html(result);                                                                                   
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);
            });

            break;

            
        case "check_ookastroom_inschrijven":

            show_loading("Even geduld");            
            $.post("/ajax.php",{action : "check_ookastroom_inschrijven", id_leerling : $('#id_leerling').val(), stroom : $('#stroomkeuze').val()}, function(result){            
                hide_loading();                    
                if(result == "error"){
                    check_validation("Problemen met gegevens op te vragen.","preload","check_ookastroom_inschrijven",result);
                } else {

                    index = $('.stappen .active').index() + 1;                
                    $('.vakken .vak:nth-child('+index+')').html(result);

                    eindwoord_inschrijving_functions();
                    focus_click_functions(index);
                    global_form_functions();                    
                    vak_height_functions(index);

                }
            }); 

            break;

            
        case "controle_afspraak_maken":           

            show_loading("Even geduld");
            ooka = $('#ooka').val();
            $.post("/ajax.php",{action : "controle_afspraak_maken", ooka : ooka}, function(result){
                hide_loading();

                index = $('.stappen .active').index() + 1;
                $('.vakken .vak:nth-child('+index+')').html(result);
                focus_click_functions(index);
                global_form_functions();
                vak_height_functions(index);


                $('.afspraak-container .uur').click(function(){                                
                    if($(this).attr('clickable') == "YES"){
                        show_loading("Afspraak opslaan");
                        $('#afspraak_dag').val($(this).attr('dag'));
                        $('#afspraak_uur').val($(this).html());                
                        $('.afspraak-container .uur').removeClass('select');
                        $('#reedsafspraak').removeClass('select');
                        $('#telefonisch').removeClass('select');
                        $(this).addClass('select');
                        $.post("/ajax.php",{action : "save_afspraak_datum", dag : $(this).attr('dag'), uur : $(this).html()}, function(result){
                            hide_loading();
                            if(result.trim() != ""){
                                check_validation("Er is iets fout gelopen!","preload","controle_afspraak_maken",result);
                            }
                        });
                    }
                });                    

                $('.afspraak-container #telefonisch').click(function(){
                    show_loading("Afspraak opslaan");
                    $('#afspraak_dag').val('tel');
                    $('#afspraak_uur').val('geen');                
                    $('.afspraak-container .uur').removeClass('select');                
                    $('#reedsafspraak').removeClass('select');
                    $(this).addClass('select');
                    $.post("/ajax.php",{action : "save_afspraak_datum", dag : 'tel', uur : 'geen'}, function(result){
                        hide_loading();
                        if(result.trim() != ""){
                            check_validation("Er is iets fout gelopen!","preload","controle_afspraak_maken",result);
                        }
                    });                
                });

                $('.afspraak-container #reedsafspraak').click(function(){
                    show_loading("Afspraak opslaan");
                    $('#afspraak_dag').val('broerofzus');
                    $('#afspraak_uur').val('geen');                
                    $('.afspraak-container .uur').removeClass('select');                
                    $('#telefonisch').removeClass('select');
                    $(this).addClass('select');
                    $.post("/ajax.php",{action : "save_afspraak_datum", dag : 'broerofzus', uur : 'geen'}, function(result){
                        hide_loading();
                        if(result != ""){
                            check_validation("Er is iets fout gelopen!","preload","controle_afspraak_maken",result);
                        }
                    });                
                });


            });

            break;
            

        case "eindwoord":

            show_loading("Even geduld");        
            $.post("/ajax.php",{action : "eindwoord", afspraak : $('#afspraak').val()}, function(result){
                hide_loading();        
                index = $('.stappen .active').index() + 1;
                $('.vakken .vak:nth-child('+index+')').html(result);                                                           


                $.post("/ajax.php",{action : "voorinschrijving_email", id_inschrijving : $('#id_inschrijving').val()}, function(result){
                    $('#afspraak').show();
                });



                var count = 30;
                var counter=setInterval(timer, 1000);


                function timer(){
                    count=count-1;
                    if (count <= 0){
                        window.location = "/frm/voorinschrijving_" + $('#stroom').val();
                        clearInterval(counter);                                               
                        return;
                    }
                    $('#timer').html(count);

                }            

                $('#print_voorinschrijving').click(function(){        
                    window.open("/prt/voorinschrijving");
                    $('#print_voorinschrijving').fadeOut(100);
                });
            });

            break;

            
        case "load_studiekeuze_inschrijving":

            show_loading("Even geduld");
            $.post("/ajax.php",{action : "load_studiekeuze_inschrijving", id_leerling : $('#id_leerling').val()}, function(result){            
                hide_loading();                    
                if(result == "error"){
                    check_validation("Problemen met gegevens op te vragen.","preload","load_studiekeuze_inschrijving",result);
                } else {

                    index = $('.stappen .active').index() + 1;                
                    $('.vakken .vak:nth-child('+index+')').html(result);
                    focus_click_functions(index);
                    global_form_functions();                    
                    vak_height_functions(index);
                    studiekeuze_functions();
                }
            }); 

            break;

            
        case "load_gegevens_kind_inschrijving":

            if($('#kind_gegevens_laden').val() == "YES"){

                if($('#naam_kind').val() != ""){
                    $('#kind_gegevens_laden').val('NO');
                } else if ($('#nieuw_kind').val() == "YES" && $('#nieuw_geklikt').val() == "NO"){                
                    $('#kind_gegevens_laden').val("NO");
                }

                show_loading("Even geduld");
                nieuw = $('#nieuw_kind').val();
                $.post("/ajax.php",{action : "load_gegevens_kind_inschrijving", id_leerling : $('#id_leerling').val(), "nieuw" : nieuw}, function(result){
                
                            
                    hide_loading();                    
                    if(result == "error"){
                        check_validation("Problemen met gegevens op te vragen.","preload","load_gegevens_kind_inschrijving",result);
                    } else {

                        index = $('.stappen .active').index() + 1;                
                        $('.vakken .vak:nth-child('+index+')').html(result);
                        focus_click_functions(index);
                        global_form_functions();                    
                        vak_height_functions(index);
                                                
                    }
                }); 

            }

            break;
            

        case "load_extra_gegevens_kind_inschrijving":

            show_loading("Even geduld");            
            $.post("/ajax.php",{action : "load_extra_gegevens_kind_inschrijving", id_leerling : $('#id_leerling').val()}, function(result){            
                hide_loading();                    
                if(result == "error"){
                    check_validation("Problemen met gegevens op te vragen.","preload","load_extra_gegevens_kind_inschrijving",result);
                } else {

                    index = $('.stappen .active').index() + 1;                
                    $('.vakken .vak:nth-child('+index+')').html(result);
                    focus_click_functions(index);
                    global_form_functions();                    
                    vak_height_functions(index);
                }
            }); 

            break;
            

        case "load_gegevens_moeder_inschrijving":

            show_loading("Even geduld");
            $.post("/ajax.php",{action : "load_gegevens_moeder_inschrijving", id_leerling : $('#id_leerling').val()}, function(result){            
                hide_loading();                    
                if(result == "error"){
                    check_validation("Problemen met gegevens op te vragen.","preload","load_gegevens_moeder_inschrijving",result);
                } else {

                    index = $('.stappen .active').index() + 1;                
                    $('.vakken .vak:nth-child('+index+')').html(result);
                    gegevens_ouders_functions();
                    focus_click_functions(index);
                    global_form_functions();                    
                    vak_height_functions(index);
                }
            }); 

            break;
            

        case "load_gegevens_vader_inschrijving":

            show_loading("Even geduld");
            $.post("/ajax.php",{action : "load_gegevens_vader_inschrijving", id_leerling : $('#id_leerling').val()}, function(result){            
                hide_loading();                    
                if(result == "error"){
                    check_validation("Problemen met gegevens op te vragen.","preload","load_gegevens_vader_inschrijving",result);
                } else {

                    index = $('.stappen .active').index() + 1;                
                    $('.vakken .vak:nth-child('+index+')').html(result);
                    gegevens_ouders_functions();
                    focus_click_functions(index);
                    global_form_functions();                    
                    vak_height_functions(index);
                }
            }); 

            break;
            

        case "load_vipinformatie_1":


            show_loading("Even geduld");
            $.post("/ajax.php",{action : "load_vipinformatie_1", id_leerling : $('#id_leerling').val()}, function(result){
            
                hide_loading();                    
                if(result == "error"){
                    check_validation("Problemen met gegevens op te vragen.","preload","load_vipinformatie_1",result);
                } else {

                    index = $('.stappen .active').index() + 1;                
                    $('.vakken .vak:nth-child('+index+')').html(result);
                    vipinformatie_functions();
                    focus_click_functions(index);
                    global_form_functions();                    
                    vak_height_functions(index);
                }
            }); 

            break;
            

        case "load_vipinformatie_2":

            show_loading("Even geduld");
            $.post("/ajax.php",{action : "load_vipinformatie_2", id_leerling : $('#id_leerling').val()}, function(result){            
                hide_loading();                    
                if(result == "error"){
                    check_validation("Problemen met gegevens op te vragen.","preload","load_vipinformatie_2",result);
                } else {

                    index = $('.stappen .active').index() + 1;                
                    $('.vakken .vak:nth-child('+index+')').html(result);
                    vipinformatie_functions();
                    focus_click_functions(index);
                    global_form_functions();                    
                    vak_height_functions(index);
                }
            }); 

            break;
            

        case "load_vipinformatie_3":

            show_loading("Even geduld");
            $.post("/ajax.php",{action : "load_vipinformatie_3", id_leerling : $('#id_leerling').val()}, function(result){            
                hide_loading();                    
                if(result == "error"){
                    check_validation("Problemen met gegevens op te vragen.","preload","load_vipinformatie_3",result);
                } else {

                    index = $('.stappen .active').index() + 1;                
                    $('.vakken .vak:nth-child('+index+')').html(result);
                    vipinformatie_functions();
                    focus_click_functions(index);
                    global_form_functions();                    
                    vak_height_functions(index);
                }
            }); 

            break;
            

        case "load_gok":

            show_loading("Even geduld");
            $.post("/ajax.php",{action : "load_gok", id_leerling : $('#id_leerling').val()}, function(result){            
                hide_loading();                    
                if(result == "error"){
                    check_validation("Problemen met gegevens op te vragen.","preload","load_gok",result);
                } else {

                    index = $('.stappen .active').index() + 1;                
                    $('.vakken .vak:nth-child('+index+')').html(result);
                    gok_functions();
                    focus_click_functions(index);
                    global_form_functions();                    
                    vak_height_functions(index);
                }
            }); 

            break;
            

        case "load_gok2":

            show_loading("Even geduld");
            $.post("/ajax.php",{action : "load_gok2", id_leerling : $('#id_leerling').val()}, function(result){            
                hide_loading();                    
                if(result == "error"){
                    check_validation("Problemen met gegevens op te vragen.","preload","load_gok2",result);
                } else {

                    index = $('.stappen .active').index() + 1;                
                    $('.vakken .vak:nth-child('+index+')').html(result);
                    gok_functions();
                    focus_click_functions(index);
                    global_form_functions();                    
                    vak_height_functions(index);
                }
            }); 

            break;
            

        case "load_baso":

            show_loading("Even geduld");
            $.post("/ajax.php",{action : "load_baso", id_leerling : $('#id_leerling').val()}, function(result){            
                                    
                if(result == "error"){
                    check_validation("Problemen met gegevens op te vragen.","preload","load_baso",result);
                } else {

                    index = $('.stappen .active').index() + 1;                    
                    $('.vakken .vak:nth-child('+index+')').html(result);
                    baso_functions();
                    focus_click_functions(index);
                    global_form_functions();                    
                    vak_height_functions(index);
                }
                hide_loading();
            }); 

            break;

    }
    
}