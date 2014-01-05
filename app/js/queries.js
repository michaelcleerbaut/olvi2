function toggleChecked(status,table) {    
    tbl = $('#'+table);
    $(".checkbox_table", tbl).each( function() {
        $(this).attr("checked",status);
    })
}     

$(document).ready(function(){
    selectactions();
    
    $('.opties li').click(function(){
       $('#query_id').val($(this).attr('queryid')); 
       $('#submit_load_query').click(); 
    });
    
    $('#resulttable').flexigrid({
        height: 400,
        width: 780
    });
    
    $('.toggle_table').click(function(){
        id = $(this).attr('table');
        $('#'+id).toggle();
        if($('#icon_'+id).html() == "[+]"){
            $('#icon_'+id).html("[-]"); 
        } else {
            $('#icon_'+id).html("[+]"); 
        }
    });
    
 
 
    $('#add_query').click(function(){
      var html = $('#querydiv').html();
      $('.queryform').append(html);
      selectactions();
      return false;
    });
    
    $('.show_contacts').click(function(){
       id = $(this).attr('id');
       if($('.list_'+id).css('display') == "block"){
        $('.list_'+id).fadeOut(100);    
       } else {
        $('.list_'+id).fadeIn(100); 
       }
    });

  function selectactions(){ // query page
    $('.queryselect').change(function(){
      var div = $(this);
      
      $.get('/ajax.php', { action: 'get_query_operators', select: $(this).val(), table : $(':selected',this).attr('table') }, function(data){          
        div.parent().children('.queryoperator').html(data);
        autosave_actions_new();
      });
    });
    $('.remove_query').click(function(){
        $(this).parent().remove();
    });
  }
  
                            
        $('#change_query_name').click(function(){           
           name = $('h2.query_name .titel').html();                   
           inputtxt = "<input type=\"text\" value=\"" + name + "\">";        
           $('h2').hide();
           $('#tmp_change_name').show();        
        });
        
        
        $('#tmp_change_name input').keypress(function(e){
            if(event.which == 13){
                change_query_name();    
            }      
        });
        
        $('#ready_name').click(function(){
            change_query_name();
        });

        
        $('#add_query').click(function(){
           save_inits(); 
        });
        
        save_inits();       
        
           // button save as        
        $('.save_as').click(function(){       
            $('#bgOverlay').fadeIn(100);
            $('.saveasdiv').fadeIn(100);   
            /*
            $('.send_to_ymlp').attr('disabled','disabled');
            $('.export_to_csv').attr('disabled','disabled');
            $(this).attr('disabled','disabled');             
            $('.extra_buttons').slideDown("fast",function(){
                $('.action_buttons').animate({height: 80}, 200, function(){                
                    $('.saveasdiv').fadeIn(100);   
                });
            });       
            */
        });
        
        $('.cancel_save_as').click(function(){
            $('.saveasdiv').fadeOut(100, function(){
                $('#bgOverlay').fadeOut();
                /*
                $('.extra_buttons').slideUp("fast",function(){
                    $('.action_buttons').animate({height: 40},200);
                });
                */
            });
            $('.saveasdiv input[type=text]').val('');
            $('.save_as').removeAttr('disabled');  
            $('.send_to_ymlp').removeAttr('disabled');
            $('.export_to_csv').removeAttr('disabled');
        });
        

        // button send to ymlp
        $('.send_to_ymlp').click(function(){       
            $(this).attr('disabled','disabled');             
            $('.save_as').attr('disabled','disabled');
            $('.export_to_csv').attr('disabled','disabled');
            $('.extra_buttons').slideDown("fast",function(){
                $('.action_buttons').animate({height: 80}, 200, function(){
                    $('.ymlpdiv').fadeIn(100);   
                });
            });       
        });
        
        $('.cancel_send_to_ymlp').click(function(){
            $('.ymlpdiv').fadeOut(100, function(){
                $('.extra_buttons').slideUp("fast", function(){
                    $('.action_buttons').animate({height: 40},200);                    
                });
            });
            $('.ymlpdiv input[type=text]').val('');
            $('.send_to_ymlp').removeAttr('disabled');  
            $('.save_as').removeAttr('disabled');
            $('.export_to_csv').removeAttr('disabled');
        });   
        
        
        // button export to csv
        $('.export_to_csv').click(function(){       
            $(this).attr('disabled','disabled');             
            $('.save_as').attr('disabled','disabled');
            $('.send_to_ymlp').attr('disabled','disabled');            
            $('.extra_buttons').slideDown("fast",function(){
                h = $('.csvdiv').height() + 100;                
                $('.action_buttons').animate({height: h}, 200, function(){
                    $('.csvdiv').fadeIn(100);   
                });
            });       
        });
        
        $('.cancel_export_to_csv').click(function(){
            $('.csvdiv').fadeOut(100, function(){                
                $('.extra_buttons').slideUp("fast",function(){
                    $('.action_buttons').animate({height: 40},200);
                });
            });
            $('.csvdiv input[type=text]').val('');            
            $('.save_as').removeAttr('disabled');
            $('.send_to_ymlp').removeAttr('disabled');
            $('.export_to_csv').removeAttr('disabled');
        });   
        
        
        $('.message_good').delay(2000).fadeOut();
        
                
        
        $("#queryform [type=submit]").bind("click", function(e){                    
            $(this).attr("clicked","YES");            
        });

        $("#queryform").submit(function(){
            var triggered = $("[clicked=YES]", this).attr('name');
            $('#queryform [type=submit]').removeAttr('clicked');
            
            if(triggered == "send_to_ymlp"){
                if($('.ymlpdiv input').val() == ""){
                    alert("U have to fill in a group name");
                    return false;
                }
            } else if (triggered == "save_as"){
                if($('.saveasdiv input').val() == ""){
                    alert("U have to fill in a query name");
                    return false;
                }
            } else if (triggered == "save_query"){
                lijnen = $('.queryrule').length - 1;
                if(lijnen == 0){
                    alert("U have to add minimal 1 condition line");                
                    return false;
                } else {                    
                    operatorsN = $('.operatorselectN').length;                
                    operators = operatorsN + $('.operatorselect').length;
                    if(operators != lijnen){                        
                        alert("U have to be sure all condition lines are filled in properly");
                        return false;
                    }                    
                }                
            } else if (triggered == "export_to_csv"){
                
                if($('.csvdiv input').val() == ""){
                    alert("U have to fill in a document name");
                    return false;
                }                
            }
                                    
        });        
        
});

function save_inits(){
        $('.queryselect').change(function(){
           must_save("YES"); 
        });
        
        $('.operatorselect').change(function(){
            must_save("YES");
        });
        
        $('.queryvalue').keyup(function(){
           must_save("YES"); 
        });
        
        $('.remove_query').click(function(){
            must_save("YES");
        });
    
}
    
    
function change_query_name(){
    name = $('#tmp_change_name input').val();                     
    $('h2 .titel').html(name);
    $('#query_name').val(name);
    $('h2').show();
    $('#tmp_change_name').hide();  
    must_save("YES");
}    


function must_save(manner){
    
    if(manner == "YES"){       
        $('.save_query').addClass('glow');           
        $('#must_save').val('YES');   
    } else if (manner == "NO"){
        $('.save_query').removeClass('glow');           
        $('#must_save').val('NO');           
    }
    
}
