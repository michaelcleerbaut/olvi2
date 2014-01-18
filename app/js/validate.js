function validate_vak(){
    
    message = "";        
    index = $('.stappen .active').index() + 1;            
    validate = $('.vakken .vak:nth-child('+index+')').attr('validate');            
               
               
    switch(validate){
        
        case "volgnummer_b":
            if($('#volgnummer').val() == ""){
                message = "Gelieve een volgnummer in te vullen";                
            } else {
                show_loading("Even geduld");
                $.post('/ajax.php',{action : "check_volgnummer_exists_b", volgnummer : $('#volgnummer').val(), "stroom" : "B"}, function(result){                                                        
                   if(result.substring(0,2) == "id"){                       
                       $('#id_leerling').val(result.substring(2));
                   } else if(result == "1"){
                       message = "Gelieve het volgnummer te controleren.";
                   }              
                   hide_loading();
                   check_validation(message,"validate","volgnummer_b",result);     
                });
                
                return false;
            }                    
        break;
        
        
        case "gegevens_kind_a": 
            $('#naam').css('borderColor','#EEE');
            $('#voornaam').css('borderColor','#EEE');
            $('#straat').css('borderColor','#EEE');
            $('#huisnummer').css('borderColor','#EEE');
                        
            if($('#naam').val() == "" || $('#voornaam').val() == "" || $('#straat').val() == "" || $('#huisnummer').val() == ""){                
                message = "Gelieve de aangegeven velden te controleren.";
                if($('#naam').val() == ""){
                    $('#naam').css('borderColor','#d46363');
                }
                if($('#voornaam').val() == ""){
                    $('#voornaam').css('borderColor','#d46363');
                }
                if($('#straat').val() == ""){
                    $('#straat').css('borderColor','#d46363');
                }
                if($('#huisnummer').val() == ""){
                    $('#huisnummer').css('borderColor','#d46363');
                }
                check_validation(message,"validate","gegevens_kind_a","");
                return false;
            }
                           
            show_loading("Opslaan");
            fields = get_fields();
                                    
            $.post('/ajax.php',{action : "save_gegevens_kind_a", "fields" : fields},function(result){                                
                hide_loading();
                message = "";                
                if(result != 1){                    
                    message = "Er is iets fout gelopen!";                
                }
                check_validation(message,"validate","gegevens_kind_a",result);
            });
            return false;        
        break;


        case "gegevens_kind_b": 
            $('#naam').css('borderColor','#EEE');
            $('#voornaam').css('borderColor','#EEE');
            $('#straat').css('borderColor','#EEE');
            $('#huisnummer').css('borderColor','#EEE');
                        
            if($('#naam').val() == "" || $('#voornaam').val() == "" || $('#straat').val() == "" || $('#huisnummer').val() == ""){                
                message = "Gelieve de aangegeven velden te controleren.";
                if($('#naam').val() == ""){
                    $('#naam').css('borderColor','#d46363');
                }
                if($('#voornaam').val() == ""){
                    $('#voornaam').css('borderColor','#d46363');
                }
                if($('#straat').val() == ""){
                    $('#straat').css('borderColor','#d46363');
                }
                if($('#huisnummer').val() == ""){
                    $('#huisnummer').css('borderColor','#d46363');
                }
                check_validation(message,"validate","gegevens_kind_b","");
                return false;
            }
                           
            show_loading("Opslaan");
            fields = get_fields();
                                    
            $.post('/ajax.php',{action : "save_gegevens_kind_b", "fields" : fields},function(result){                
                hide_loading();
                message = "";                
                if(result != 1){                    
                    message = "Er is iets fout gelopen!";                
                }
                check_validation(message,"validate","gegevens_kind_b",result);
            });
            return false;        
        break;
        
        
        
        case "communicatie":
            show_loading("Opslaan");
            fields = get_fields();
            $.post('/ajax.php',{action : "save_communicatie", "fields" : fields}, function(result){
               hide_loading();               
               message = "";
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","communicatie",result);               
            });
            return false;                    
        break;
        
        
        
        case "ooka":
            if($("#ooka").val() == ""){
                message = "Gelieve een keuze te maken";
            } else if($('#ooka').val() == "YES"){
                if($('#ooka_alopgeslagen').val() == "NO"){
                    show_loading("Gegevens opslaan");
                    $.post('/ajax.php',{action : "save_ooka"}, function(result){
                        $('#ooka_alopgeslagen').val("YES");
                        hide_loading();
                        message = "";
                        if(result != ""){
                            messsage = "Er is iets fout gelopen!";
                        }                                        
                        check_validation(message,"validate","ooka",result);                   
                    });
                    return false;
                }
            } else if ($('#ooka').val() == "NO"){
                if($('#ooka_alopgeslagen').val() == "YES"){
                    show_loading("Aanpassen");
                    $.post("/ajax.php",{action : "delete_ooka"}, function(result){
                        hide_loading();
                        message = "";                        
                        if(result != ""){
                            message = "Er is iets fout gelopen!";
                        } else {
                            $('#ooka_alopgeslagen').val('NO');
                        }
                        check_validation(message,"validate","ooka",result);    
                    });
                    return false;                
                }
            }                
        break;
        
        
        case "afspraak_datum":
            if($('#afspraak_dag').val() == "" || $('#afspraak_uur').val() == ""){
                message = "Gelieve een datum te selecteren";
            }         
        break;
        
        
        case "volgnummer_toekennen_a":
            if($('#id_leerling').val() == ""){
                show_loading("Even geduld");                
                $.post("/ajax.php",{action : "volgnummer_toekennen_a"},function(result){                                    
                    message = "";                    
                    $('#id_leerling').val(result);
                    hide_loading();
                    check_validation(message,"validate","volgnummer_toekennen_a",result);                         
                });
                return false;
            }        
        break;
        
        
        case "stroomkeuze_inschrijving":
            if($('#stroomkeuze').val() != "A" && $('#stroomkeuze').val() != "B"){
                message = "Gelieve een stroom te kiezen";
            } else {
                show_loading("Even geduld");
                $.post("/ajax.php",{action : 'set_stroom_session', stroom : $('#stroomkeuze').val()},function(result){
                    hide_loading();
                    check_validation("","validate","stroomkeuze_inschrijving",result);                    
                });
                return false;
            }
        break;
        
        
        case "idleerling":
            
            if($('#volgnummer').val() == "" && $('#naam_kind').val() == "" && $('#nieuw_kind').val() == ""){
                message = "Gelieve een keuze te maken.";
            } else {
            
            if($('#volgnummer').val() != ""){    // controleren op volgnummer
                show_loading("Even geduld");
                $.post("/ajax.php",{action : "get_kind_via_volgnummer", volgnummer : $('#volgnummer').val(), stroom : $('#stroomkeuze').val()},function(result){
                    hide_loading();           
                    message = "";                    
                    if(result == 0){
                        message = "Gelieve het volgnummer te controleren";
                    } else {
                        if(result == $('#id_leerling').val()){
                            $('#kind_gegevens_laden').val("NO");
                        } else {
                            $('#id_leerling').val(result);
                            $('#kind_gegevens_laden').val("YES");
                            $('#nieuw_geklikt').val("NO");
                        }
                    }
                    check_validation(message,"validate","idleerling",result);
                });
                return false;                
            } else if($('#id_leerling').val() != ""){    // controleren op leerling_id (als naam ingevuld is bij inschrijving)
                show_loading("Even geduld");
                $.post("/ajax.php",{action : "get_kind_via_idleerling", idleerling : $('#id_leerling').val(), stroom : $('#stroomkeuze').val()},function(result){
                    hide_loading();           
                    message = "";                    
                    if(result == 0){
                        message = "Gelieve het volgnummer te controleren";
                    } else {
                        $('#kind_gegevens_laden').val("YES");
                        $('#nieuw_geklikt').val("NO");                      
                    }
                    check_validation(message,"validate","idleerling",result);
                });
                return false;                
            } else if ($('#nieuw_kind').val() == "YES"){
                if($('#nieuw_geklikt').val() == "NO"){
                    show_loading("Even geduld");
                    $.post("/ajax.php",{action : "get_nieuw_volgnummer", "stroom" : $('#stroomkeuze').val(),delete_vorig : $('#delete_vorig').val()}, function(result){                                                   hide_loading();
                        $('#id_leerling').val(result);                                   
                        check_validation("","validate","idleerling",result);
                        $('#nieuw_geklikt').val("YES");
                        $('#kind_gegevens_laden').val("YES");                
                        $('#delete_vorig').val("NO");
                    });
                    return false;                    
                } else {
                    $('#kind_gegevens_laden').val("NO");
                }
            }
            
            }
            
        
                                    
        break;
  
  
        case "idleerling_vip_leerproblemen":
                       
            if(($('#volgnummer').val() == "" && $('#naam_kind').val() == "") || ($('#volgnummer').val() == "" && $('#id_leerling').val() == "")){
                message = "Gelieve een keuze te maken.";
            } else {
            
                if($('#volgnummer').val() != ""){    // controleren op volgnummer
                    show_loading("Even geduld");
                    $.post("/ajax.php",{action : "get_kind_via_volgnummer_leerproblemen", volgnummer : $('#volgnummer').val(), stroom : $('#stroom_select').val()},function(result){
                        hide_loading();           
                        message = "";                    
                        if(result == 0){
                            message = "Gelieve het volgnummer te controleren, dit kind staat niet gekend voor een leerprobleem";
                        } else {
                            if(result == $('#id_leerling').val()){
                                $('#kind_gegevens_laden').val("NO");
                            } else {
                                $('#id_leerling').val(result);
                                $('#kind_gegevens_laden').val("YES");                                
                            }
                        }
                        check_validation(message,"validate","idleerling_vip_leerproblemen",result);
                    });
                    return false;                
                } else {                    
                    if($('#id_leerling').val() != ""){                    
                        $.post("/ajax.php",{action : "save_idleerling_session", id_leerling : $('#id_leerling').val()});
                    } else {                        
                        check_validation("Gelieve een geldige leerling te gebruiken","validate","idleerling_vip_andereproblemen","");
                    }
                    
                }
                
            }
            
        
                                    
        break;

        case "idleerling_vip_gedragsproblemen":
                       
            if(($('#volgnummer').val() == "" && $('#naam_kind').val() == "") || ($('#volgnummer').val() == "" && $('#id_leerling').val() == "")){
                message = "Gelieve een keuze te maken.";
            } else {
            
                if($('#volgnummer').val() != ""){    // controleren op volgnummer
                    show_loading("Even geduld");
                    $.post("/ajax.php",{action : "get_kind_via_volgnummer_gedragsproblemen", volgnummer : $('#volgnummer').val(), stroom : $('#stroom_select').val()},function(result){
                        hide_loading();           
                        message = "";                    
                        if(result == 0){
                            message = "Gelieve het volgnummer te controleren, dit kind staat niet gekend voor een gedragsprobleem";
                        } else {
                            if(result == $('#id_leerling').val()){
                                $('#kind_gegevens_laden').val("NO");
                            } else {
                                $('#id_leerling').val(result);
                                $('#kind_gegevens_laden').val("YES");                                
                            }
                        }
                        check_validation(message,"validate","idleerling_vip_gedragsproblemen",result);
                    });
                    return false;                
                } else {                                            
                    if($('#id_leerling').val() != ""){                    
                        $.post("/ajax.php",{action : "save_idleerling_session", id_leerling : $('#id_leerling').val()});
                    } else {                        
                        check_validation("Gelieve een geldige leerling te gebruiken","validate","idleerling_vip_andereproblemen","");
                    }
                    
                }
                
            }
            
        
                                    
        break;

        case "idleerling_vip_andereproblemen":
                       
            if(($('#volgnummer').val() == "" && $('#naam_kind').val() == "") || ($('#volgnummer').val() == "" && $('#id_leerling').val() == "")){
                message = "Gelieve een keuze te maken.";
            } else {
                
                if($('#volgnummer').val() != ""){    // controleren op volgnummer
                    show_loading("Even geduld");
                    $.post("/ajax.php",{action : "get_kind_via_volgnummer_andereproblemen", volgnummer : $('#volgnummer').val(), stroom : $('#stroom_select').val()},function(result){
                        hide_loading();           
                        message = "";                    
                        if(result == 0){
                            message = "Gelieve het volgnummer te controleren";
                        } else {
                            if(result == $('#id_leerling').val()){
                                $('#kind_gegevens_laden').val("NO");
                            } else {
                                $('#id_leerling').val(result);
                                $('#kind_gegevens_laden').val("YES");                                
                            }
                        }
                        check_validation(message,"validate","idleerling_vip_andereproblemen",result);
                    });
                    return false;                
                } else {
                    if($('#id_leerling').val() != ""){                    
                        $.post("/ajax.php",{action : "save_idleerling_session", id_leerling : $('#id_leerling').val()});
                    } else {                        
                        check_validation("Gelieve een geldige leerling te gebruiken","validate","idleerling_vip_andereproblemen","");
                    }
                }
                
            }
            
        
                                    
        break;
        

        case "idleerling_vip_gezondheidsproblemen":
                       
            if(($('#volgnummer').val() == "" && $('#naam_kind').val() == "") || ($('#volgnummer').val() == "" && $('#id_leerling').val() == "")){
                message = "Gelieve een keuze te maken.";
            } else {
            
                if($('#volgnummer').val() != ""){    // controleren op volgnummer
                    show_loading("Even geduld");
                    $.post("/ajax.php",{action : "get_kind_via_volgnummer_gezondheidsproblemen", volgnummer : $('#volgnummer').val(), stroom : $('#stroom_select').val()},function(result){
                        hide_loading();           
                        message = "";                    
                        if(result == 0){
                            message = "Gelieve het volgnummer te controleren, dit kind staat niet gekend voor een gezondheidsprobleem";
                        } else {
                            if(result == $('#id_leerling').val()){
                                $('#kind_gegevens_laden').val("NO");
                            } else {
                                $('#id_leerling').val(result);
                                $('#kind_gegevens_laden').val("YES");                                
                            }
                        }
                        check_validation(message,"validate","idleerling_vip_gezondheidsproblemen",result);
                    });
                    return false;                
                } else {                    
                    if($('#id_leerling').val() != ""){                    
                        $.post("/ajax.php",{action : "save_idleerling_session", id_leerling : $('#id_leerling').val()});
                    } else {                        
                        check_validation("Gelieve een geldige leerling te gebruiken","validate","idleerling_vip_andereproblemen","");
                    }
                    
                }
                
            }
            
        
                                    
        break;

        
        case "save_vip_leerproblemen":
        
            show_loading("Gegevens opslaan");
            fields = get_fields();
            $.post("/ajax.php",{action : "save_vip_leerproblemen", fields : fields}, function(result){
                                                      
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_leerproblemen",result);               

            });
            return false;                            
                
        break;

        case "save_vip_gedragsproblemen":
        
            show_loading("Gegevens opslaan");
            fields = get_fields();
            $.post("/ajax.php",{action : "save_vip_gedragsproblemen", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_gedragsproblemen",result);               

            });
            return false;                            
                
        break;
        

        case "save_vip_gezondheidsproblemen":
        
            show_loading("Gegevens opslaan");
            fields = get_fields();
            $.post("/ajax.php",{action : "save_vip_gezondheidsproblemen", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_gezondheidsproblemen",result);               

            });
            return false;                            
                
        break;
        
        case "save_vip_bijkomendeinformatie":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_bijkomendeinformatie", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_bijkomendeinformatie",result);               

            });
            return false;                            
        
        break;
        
        case "save_vip_signalen":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_signalen", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_signalen",result);               

            });
            return false;                            
        
        break;
        
        case "save_vip_watzekerdoen":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_watzekerdoen", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_watzekerdoen",result);               

            });
            return false;                            
        
        break;
        
        case "save_vip_watzekernietdoen":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_watzekernietdoen", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_watzekernietdoen",result);               

            });
            return false;                            
        
        break;
        
        case "save_vip_gezondheidsproblemen_attesten":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_gezondheidsproblemen_attesten", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_gezondheidsproblemen_attesten",result);               

            });
            return false;                            
        
        break;
        
        
        case "save_vip_gezondheidsproblemen_gesprekken":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_gezondheidsproblemen_gesprekken", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_gezondheidsproblemen_gesprekken",result);               

            });
            return false;                            
        
        break;
        

        case "save_vip_gedragsproblemen_thuis":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_gedragsproblemen_thuis", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_gedragsproblemen_thuis",result);               

            });
            return false;                            
        
        break;

        case "save_vip_gedragsproblemen_school":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_gedragsproblemen_school", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_gedragsproblemen_school",result);               

            });
            return false;                            
        
        break;
        
        
        case "save_vip_begeleiding_gedragsproblemen":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_begeleiding_gedragsproblemen", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_begeleiding_gedragsproblemen",result);               

            });
            return false;                            
        
        break;


        case "save_vip_attesten_gedragsproblemen":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_attesten_gedragsproblemen", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_attesten_gedragsproblemen",result);               

            });
            return false;                            
        
        break;
        

        case "save_vip_gesprekken_gedragsproblemen":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_gesprekken_gedragsproblemen", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_gesprekken_gedragsproblemen",result);               

            });
            return false;                            
        
        break;

        case "save_vip_gesprekken_andereproblemen":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_gesprekken_andereproblemen", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_gesprekken_andereproblemen",result);               

            });
            return false;                            
        
        break;
        
        
        case "save_vip_omgang_gedragsproblemen":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_omgang_gedragsproblemen", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_omgang_gedragsproblemen",result);               

            });
            return false;                            
        
        break;                 
        
        case "save_vip_gedragsproblemen_klassenraad":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_gedragsproblemen_klassenraad", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_gedragsproblemen_klassenraad",result);               

            });
            return false;                            
        
        break;                                                              
        
        case "save_vip_andereproblemen_klassenraad":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_andereproblemen_klassenraad", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_andereproblemen_klassenraad",result);               

            });
            return false;                            
        
        break;                                                                      

        case "save_vip_gedragsproblemen_omschrijving":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_gedragsproblemen_omschrijving", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_gedragsproblemen_omschrijving",result);               

            });
            return false;                            
        
        break;

        case "save_vip_andereproblemen_omschrijving":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_andereproblemen_omschrijving", fields : fields}, function(result){                                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_andereproblemen_omschrijving",result);               

            });
            return false;                            
        
        break;
        
        case "save_vip_leerproblemen_klassenraad":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_leerproblemen_klassenraad", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_leerproblemen_klassenraad",result);               

            });
            return false;                            
        
        break;                                                              
        
        
        case "save_vip_gezondheidsproblemen_klassenraad":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_gezondheidsproblemen_klassenraad", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_gezondheidsproblemen_klassenraad",result);               

            });
            return false;                            
        
        break;


        case "save_vip_gezondheidsproblemen_omschrijving":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_gezondheidsproblemen_omschrijving", fields : fields}, function(result){                                                          
               hide_loading();                
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_gezondheidsproblemen_omschrijving",result);               

            });
            return false;                            
        
        break;        
        
        
        
        case "save_vip_jaaroverdoen":

            show_loading("Gegevens opslaan");
            fields = get_fields();
            $.post("/ajax.php",{action : "save_vip_jaaroverdoen", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_jaaroverdoen",result);               

            });
            return false;                            
        
        break;


        case "save_vip_vakgebonden":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_vakgebonden", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_vakgebonden",result);               

            });
            return false;                            
        
        break;


        case "save_vip_gedragsproblemen_leerproblemen":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_gedragsproblemen_leerproblemen", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_gedragsproblemen_leerproblemen",result);               

            });
            return false;                            
        
        break;


        case "save_vip_taakleraar_lo":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_taakleraar_lo", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_taakleraar_lo",result);               

            });
            return false;                            
        
        break;
        
        
        case "save_vip_begeleiding":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_begeleiding", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_begeleiding",result);               

            });
            return false;                            
        
        break;


        case "save_vip_attesten":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_attesten", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_attesten",result);               

            });
            return false;                            
        
        break;
        
        
        case "save_vip_gesprekken":

            show_loading("Gegevens opslaan");
            fields = get_fields();            
            $.post("/ajax.php",{action : "save_vip_gesprekken", fields : fields}, function(result){                                          
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_vip_gesprekken",result);               

            });
            return false;                            
        
        break;
          
        
        case "save_gegevens_kind_inschrijving":
   
        
            $('#naam').css('borderColor','#EEE');
            $('#voornaam').css('borderColor','#EEE');
            $('#straat').css('borderColor','#EEE');
            $('#huisnummer').css('borderColor','#EEE');
            $('#geboortedatum').css('borderColor','#EEE');
            $('#geboorteplaats').css('borderColor','#EEE');
                        
            if($('#naam').val() == "" || $('#voornaam').val() == "" || $('#straat').val() == "" || $('#huisnummer').val() == "" || $('geboortedatum').val() == "" || $('#geboorteplaats').val() == ""){                
                message = "Gelieve de aangegeven velden te controleren.";
                if($('#naam').val() == ""){
                    $('#naam').css('borderColor','#d46363');
                }
                if($('#voornaam').val() == ""){
                    $('#voornaam').css('borderColor','#d46363');
                }
                if($('#straat').val() == ""){
                    $('#straat').css('borderColor','#d46363');
                }
                if($('#huisnummer').val() == ""){
                    $('#huisnummer').css('borderColor','#d46363');
                }
                if($('#geboortedatum').val() == ""){
                    $('#geboortedatum').css('borderColor','#d46363');
                }
                if($('#geboorteplaats').val() == ""){
                    $('#geboorteplaats').css('borderColor','#d46363');
                }
                check_validation(message,"validate","save_gegevens_kind_inschrijving","");
                return false;
            }
        
        
            show_loading("Gegevens opslaan");
            fields = get_fields();
            $.post("/ajax.php",{action : "save_gegevens_kind_inschrijving", fields : fields}, function(result){
                                        
               hide_loading(); 
               message = "";               
               if(result != 1){
                   message = "Er is iets fout gelopen!";
               }
               check_validation(message,"validate","save_gegevens_kind_inschrijving",result);               

            });
            return false;                            
        break;
        
        
        case "save_extra_gegevens_kind_inschrijving":
            show_loading("Gegevens opslaan");
            fields = get_fields();
            $.post("/ajax.php",{action : "save_extra_gegevens_kind_inschrijving", fields : fields}, function(result){
                        
               hide_loading();  
               message = "";
               if(result != 1){
                   message = "Er is iets fout gelopen!";
                   console.log(result);
               }
               check_validation(message,"validate","save_extra_gegevens_kind_inschrijving",result);               

            });
            return false;                            
        break;
        
        
        case "save_gegevens_moeder_inschrijving":
            show_loading("Gegevens opslaan");
            fields = get_fields();
            $.post("/ajax.php",{action : "save_gegevens_moeder_inschrijving", fields : fields}, function(result){            
               hide_loading();                                         
               message = "";
               check_validation(message,"validate","save_gegevens_moeder_inschrijving",result);               
            });
            return false;                            
        break;
        
        
        case "save_gegevens_vader_inschrijving":
            show_loading("Gegevens opslaan");
            fields = get_fields();
            $.post("/ajax.php",{action : "save_gegevens_vader_inschrijving", fields : fields}, function(result){            
               hide_loading();                                         
               message = "";
               check_validation(message,"validate","save_gegevens_vader_inschrijving",result);               
            });
            return false;                            
        break;
        
        
        case "save_studiekeuze_inschrijving":
            show_loading("Gegevens opslaan");
            fields = get_fields();
            $.post("/ajax.php",{action: "save_studiekeuze_inschrijving", fields : fields, studiekeuze : $('#studiekeuze').val(), schooljaar : $('#huidigschooljaar').val()}, function(result){
                hide_loading();
                
                message = "";
                if(result != 1){
                    message = "Er is iets fouts gelopen";
                }                
                check_validation(message,"validate","save_studiekeuze_inschrijving",result);
            });
            return false;        
        break;
        
        
        case "save_vipinformatie":
            show_loading("Gegevens opslaan");            
            fields = get_fields();
            $.post("/ajax.php",{action : "save_vipinformatie", fields : fields}, function(result){
                                            
               hide_loading();
               message = "";
               if(result != 1){
                   message = "Er is iets fouts gelopen";
               }                
               check_validation(message,"validate","save_vipinformatie",result);            
            });
            return false;                        
        break;
        
        
        case "save_gok":
            show_loading("Gegevens opslaan");
            fields = get_fields();
            $.post("/ajax.php",{action : "save_gok", fields : fields}, function(result){
               hide_loading();
               message = "";                              
               if(result != 1){
                   message = "Er is iets fouts gelopen";
               }                  
               check_validation(message,"validate","save_gok",result);
            });
            return false;                
        break;
        
        
        case "baso":
            if($('#baso').val() == ""){
                check_validation("U moet een keuze maken","validate","baso","");
                return false;
            }
            
            show_loading("Gegevens opslaan");            
            $.post("/ajax.php",{action : "save_baso", "baso" : $('#baso').val()}, function(result){
               hide_loading();
               message = "";
               if(result != 1){
                   message = "Er is iets fouts gelopen";
               }                  
               check_validation(message,"validate","baso",result);
            });
            return false;                
        break;    
                   
        
    }
                                  
        
    check_validation(message,"validate","algemene check_validation onderaan","");
                
        
        
    
}