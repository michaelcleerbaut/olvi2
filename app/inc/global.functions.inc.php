<?php

    function build_crums($crums = array()){

        $html .= "<div class=\"nav\">
        <div class=\"btn\"><a href=\"/\">Home</a></div>";

        if(is_array($crums) && count($crums) > 0){
            foreach($crums as $key => $data){
                $html .= "<div class=\"btn\"><a href=\"{$data['url']}\">{$data['title']}</a></div>";
            }
        }
        $html .= "</div>";

        return $html;        

    }

    function get_lagere_scholen(){

        $query = "SELECT * FROM scholen ORDER BY naam";
        $result = query($query);
        while($row = mysql_fetch_assoc($result)){            
            $scholen[$row['id']] = array("naam" => $row['naam'], "pc" => $row['postcode'], "gemeente" => $row['gemeente']);            
        }        

        return $scholen;
    }


    function checkEmail($email) {
        if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email)){
            list($username,$domain)=split('@',$email);
            if(!checkdnsrr($domain,'MX')) {
                return false;
            }
            return true;
        }
        return false;    
    }


    function print_r2($arr){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    function list_nationaliteiten($nationaliteit = ""){

        $dbh = MyPDO::getConnection();

        $sth = $dbh->prepare("SELECT * FROM nationaliteiten");
        $sth->execute();
        $html = "<option value=\"\"></option>";
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){

            $selected = strtoupper($row['nationaliteit']) == $nationaliteit ? " selected" : "";
            $html .= "<option value=\"{$row['nationaliteit']}\" $selected>{$row['nationaliteit']}</option>";

        } 

        return $html;

    }

    function log_action($sort, $func, $message, $data){

        $filename = LOG_FOLDER.date("Y-m-d").".txt";
        $output = date("H:i:s") . "[$sort] - {User: " . $_SESSION['gebruiker']['id'] . "}  $func -> [$message] , Data: $data \n";

        if(!is_dir(LOG_FOLDER)){
            mkdir(LOG_FOLDER, 0777);
        }

        file_put_contents($filename,$output,FILE_APPEND);        

    }

    function get_schooljaren($value_as_key = 0){
        
        $start_year = "2013";
        
        $end_year = date("m") == "12" ? date("Y") + 1 : date("Y");
        
        for($year = $start_year ; $year <= $end_year ; $year++){            
            
            $year_value = $year . " - " . ($year+1);
             
            if($value_as_key == 1){
                $years[$year_value] = $year_value;
            } else {
                $years[] = $year_value;
            }
        }
        
        return $years;
        
    }


?>
