$(document).ready(function(){

    $('#edit_inschr_postcode').autocomplete2({
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
          $('#edit_inschr_postcode').val(pc);
        $('#edit_inschr_plaats').val(gemeente);
      }
    });
    
    
    $('#edit_inschr_moeder_postcode').autocomplete2({
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
          $('#edit_inschr_moeder_postcode').val(pc);
        $('#edit_inschr_moeder_plaats').val(gemeente);
      }
    });    
    
    
    $('#edit_inschr_vader_postcode').autocomplete2({
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
          $('#edit_inschr_vader_postcode').val(pc);
        $('#edit_inschr_vader_plaats').val(gemeente);
      }
    });    
    
    
    
    
    $('#edit_inschr_search_lagere_school').click(function(){
       $('#bgOverlay').fadeIn(50);
       $('#search_lagere_school_con').fadeIn(100); 
    });
    
    $('#edit_inschr_annuleer_search_lagereschool').click(function(){
        $('#bgOverlay').fadeOut(100);
        $('#search_lagere_school_con').fadeOut(50);                 
    });
    
    
    $('#edit_inschr_search_lagere_school_pg').keyup(function(e){    
        if(e.keyCode == 13){                    
            return false;        
        }
    });
        
    $('#edit_inschr_search_lagere_school_pg').autocomplete2({
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

             $('#edit_inschr_result_lagere_scholen').html(result);
              
             $('.school_suggestie').click(function(){
                $('#vorige_school_id').val($(this).attr('id'));
                school = $(this).attr('gemeente') + " " + $(this).attr('naam') + " " + $(this).attr('pc') + " " + $(this).attr('gemeente');
                $('#kind_vorige_school').html(school);
                $('#kind_vorige_school_input').val(school);
                $('#bgOverlay').fadeOut(100);
                $('#search_lagere_school_con').fadeOut(50);
             });
                           
          });
      }
    });    

});