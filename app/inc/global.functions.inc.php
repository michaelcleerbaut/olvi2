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

    function write_to_queryfile($title,$query){

        $msg = date("Y-m-d H:i") . " - " . $title . " ### " . $query . "\n";

        file_put_contents("log/queryfile.txt",$msg,FILE_APPEND);

    }      

    function print_r2($arr){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    function dbg($txt){
        file_put_contents("debug/debug.txt",$txt."\n",FILE_APPEND);    
    }
    
    function list_nationaliteiten($nationaliteit = ""){
        
        $dbh = MyPDO::getConnection();
        
        $sth = $dbh->query("SELECT * FROM nationaliteiten");
        $sth->execute();
        $html = "<option value=\"\"></option>";
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            
            $selected = strtoupper($row['nationaliteit']) == $nationaliteit ? " selected" : "";
            $html .= "<option value=\"{$row['nationaliteit']}\" $selected>{$row['nationaliteit']}</option>";
            
        } 
        
        return $html;
        
    }
    
function log_action($sort, $func, $message, $data){

        $filename = "log/$sort/".date("Y-m-d").".txt";
        $output = date("H:i:s") . " - {User: " . $_SESSION['gebruiker']['id'] . "}  $func -> [$message] || $data \n";
         
        file_put_contents($filename,$output,FILE_APPEND);        
            
    }
    
          
        

?>
