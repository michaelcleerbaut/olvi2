<?php  
    $crums = array();

    array_push($crums,array("title" => "Queries","url" => "/panel/queries"));
    
    $query_id = $_POST['query_id'] != "" ? $_POST['query_id'] : "";  

    /**  
    *  Query inladen
    */  
    if($_POST['load_query']){                 
        $query_id = $_POST['query_id'];
        $data = Query::load_query($query_id,"data");   
        $notis .= Query::query_form($data,$query_id);          

    }    
    /**
    *  Query opslaan of overschrijven      
    */  
    if($_POST['save_query']){             

        if($_POST['query_id'] != ""){ // update
            Query::update_query($query_id,$_POST);
            $notis .= "<div class=\"message_good\">Query is succesvol opgeslagen!</div>";
        } else {                      // save
            $query_id = Query::save_query($_POST);  
            $notis .= "<div class=\"message_good\">Query is succesvol opgeslagen!</div>";
        }
        $html .= Query::query_form($_POST,$query_id);


    }            



    /**
    *  Query Opslaan Als ..  
    */
    if($_POST['save_as']){

        $query_id = Query::save_query($_POST);      
        
        $notis .= "<div class=\"message_good\">Query is succesvol gemaakt en opgeslagen!</div>";
        $html .= Query::query_form($_POST,$query_id);     

    }




    /**
    *  Gevonden resultaten tonen  
    */  
    if($_POST['showresults']){                          

        $html .= Query::query_form($_POST,$query_id);  
        $html .= Query::build_query($_POST);            


    } 


    /**
    *  Aantal gevonden rijen tonen  
    */  
    else if($_POST['showamount']){       

        $html .= Query::query_form($_POST, $query_id);
        $html .= Query::build_query($_POST,"amount");

    }




    /**
    * Alle queries tonen + een query verwijderen       
    */  
    else if($_GET['action'] == "load_queries" && !$_POST){

        if($_GET['param1'] == "delete"){
            Query::delete_query($_GET['id']);
        }

        $html .= "<div class=\"subtitel\">Klik op een query om deze in te laden</div>";

        $queriesList = Query::get_all_queries('table');    
        $html .= "<form method=\"POST\" id=\"frm_loadquery\">
        $queriesList            
        <div style='display:none;text-align:center;'><input type=\"submit\" name=\"load_query\" id=\"submit_load_query\" value=\"Query Laden\"/></div>
        </form>";        



    }


    /**
    *  Nieuw query formulier tonen
    */  
    else if($_GET['action'] == "new_query" && !$_POST){  

        $html .= Query::query_form(array());               

    } 

    if(!$_GET['action']){
        $html .= Query::menu();
    }



    
    $header_vars = array(
        "js_includes" => "<script type=\"text/javascript\" src=\"/app/js/queries.js\"></script><script type=\"text/javascript\" src=\"/public/js/flexigrid.js\"></script>",
        "css_includes" => "<link href=\"/public/css/queries.css\" rel=\"stylesheet\"  media=\"screen\" type=\"text/css\" /><link href=\"/public/css/flexigrid.css\" rel=\"stylesheet\"  media=\"screen\" type=\"text/css\" />"
    );
    
    Template::view("core/header",$header_vars);
    echo build_crums($crums);    
    echo $notis;
    echo $html;
    Template::view("core/footer");


?>