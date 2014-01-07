<?
   
$link = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_errno() . ": " . mysql_error());
mysql_select_db(DB_DB,$link);
mysql_set_charset('utf8',$link); 


                   
if ($debug == "YES") {
  $_SESSION['debug'] = "YES";
} elseif ($debug == "NO") {
  $_SESSION['debug'] = "NO";
} else {
  $_SESSION['debug'] = "NO";
}


function query($query){
  
  mysql_query("SET SQL_BIG_SELECTS=1");
  $result = mysql_query($query) or sql_die(mysql_errno(),mysql_error(),$query);
 
  if ($_SESSION['debug'] == "YES") {
   echo "<hr>" . $query . "<hr>";
  }
    
  return $result;
}


function sql_die($erno = "", $error = "", $q = 0){

    
    if($erno != "" || $error != ""){
        echo "<p><hr>";
        echo "Error message: $erno : $error";
        echo "<hr></p>";
    
        $messageMail =  $q . "\n\n";
        $messageMail .= "FOUTMELDING: " . $message . "\n\n";
        $messageMail .= "SERVER: " . json_encode($_SERVER) . "\n\n";
        $messageMail .= "POST: " . json_encode($_POST ) . "\n\n";
        $messageMail .= "GET: " . json_encode($_GET);
        
        $headers = "From: Mysql Error - Olviboom <coordinatie@olviboom.be>";
    
        mail("michael@mcreations.pro","MYSQL ERROR - OLVIBOOM",$messageMail,$headers);
        
        $message = "POST: " . json_encode($_POST) . ", GET: " . json_encode($_GET) . ", SERVER: " . json_encode($_SERVER);
        log_action("MYSQL", "mysql error","$erno : $error QUERY: $q",$message);
    }
    
}
?>