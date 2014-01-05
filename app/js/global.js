$(document).ready(function(){


    // initializes datepicker
    $('.datepicker').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat : 'yy/mm/dd',
        yearRange: '1990:2012',
        
    });    
    
    // submits form
    $('.submit').click(function(){        
       frm = $(this).parents('form');
       frm.submit(); 
    });
    
    // submits form on enter
    $('form input').keyup(function(e){
        if(e.keyCode == "13"){
            frm = $(this).parents('form');   
            frm.submit();
        }
    });
    
    // show green pointer at each li of .opties list
    $('ul.opties li').each(function(){    
       $(this).prepend("<div class='pointer'></div>");       
    });
    $('table.opties tr th.left').each(function(){
        $(this).prepend("<div class='pointer'></div>");
    });
    
    
    // fade's out succes container after 2 seconds
    $('.succes, .notification').delay(2000).fadeOut();


    // gives a confirm box    
    $('.confirm').click(function(){
       if(confirm("Bent u zeker?")){
           
       } else {
           return false;
       }
    });

    
    // when dechecked right group, decheck all inner rights
    $('.rightname input').change(function(){
       if($(this).is(':checked')){
           
       } else {
           group = $(this).attr('rightgroup');
           $('.right input[childright='+group+']').each(function(){
            $(this).removeAttr('checked');    
           });
           
       } 
    });
    
    // select all rights
    $('#select_all_rights').click(function(){
       $('.rights input[type=checkbox]').attr('checked','checked');
    });
    
    // remove background overlay + hide all upper containers
    $('#bgOverlay').click(function(){
        $(this).fadeOut(100);        
        $('#search_lagere_school_con').fadeOut(50);
        $('#studiekeuzes_ooka').fadeOut(50);
        $('.saveasdiv').fadeOut(50);
    });

});


