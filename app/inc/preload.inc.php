<?php
    ini_set('session.gc_maxlifetime', 7200);
            
    require_once('config.inc.php');
    require_once('global.functions.inc.php');    
    require_once('mysql.functions.inc.php');    
    require_once('login.functions.inc.php');
                

    session_start();

    $nologin_needed = array("/waaier/waaier.php","/index.php","/oops.php","/scripts/test.php","/cronjobs.php");
    
                                          
    if(!$_SESSION['gebruiker']){
        preg_match("/^\/crons\//",$_SERVER['PHP_SELF'],$dirs);
        if(count($dirs) == 0){    
            if(!in_array($_SERVER['PHP_SELF'],$nologin_needed)){        
                header("location: /oops.php");
            }
        }
    }
    
    
    
    function __autoload($ClassName){
        if((@include ROOT_PATH."lib/$ClassName.php") === false){
            if((@include ROOT_PATH."app/lib/$ClassName.php") === false){
                echo "Oops, Class $ClassName not found!";                
                exit;
            }
        }
    }
    

    $errorLogin = 0;
    if(isset($_POST['action']) && $_POST['action'] == "login"){ // LOGIN FORM INGEVULD
        $errorLogin = try_login($_POST);        
    }

    
    if($_SESSION['gebruiker']['id'] != "" || isset($_COOKIE['gebruiker'])){ // CONTROLEREN MET COOKIE, => "INLOGGEN"
        if(isset($_COOKIE['gebruiker']) && !isset($_SESSION['gebruiker']['id'])){
            login_from_cookie();
        }
    }
    
    /*
   // CONTROLEREN OF GEBRUIKER RECHT HEEFT OM DEZE PAGINA TE ZIEN
    if($_SESSION['gebruiker']['id'] != ""){    
        $recht = str_replace(".php","",str_replace(INDEX_URL,"",$_SERVER['PHP_SELF']));            

        $recht = $recht == "inschrijving" ? "inschrijvingen" : $recht;
        $recht = $recht == "vip_leerprobleem_frm" ? "vip_leerproblemen" : $recht;
        $recht = $recht == "vip_gezondheidsprobleem_frm" ? "vip_gezondheidsproblemen" : $recht;
        $recht = $recht == "vip_gedragsproblemen_frm" ? "vip_gedragsproblemen" : $recht;
        $recht = $recht == "vip_andereprobleem_frm" ? "vip_andereproblemen" : $recht;


        if(!isset($exclude_right)){
            if($recht != "index" && $recht != "geentoegang" && $recht != "" && $recht != "ajax"){
                if($_SESSION['gebruiker']['rights'][$recht]['default'] != "YES"){                                
                    header('Location: geentoegang.php');
                }
            }
        }


    }
*/

    if($errorLogin == 1){        
        $login_vars['login_error'] = "<div class=\"error_form\">Gebruiker en/of wachtwoord is foutief</div>";        
        $login_vars['username'] = $_POST['gebruiker'];        
    }
    
    if(!$_SESSION['schooljaar']){                                                                                                
        $_SESSION['schooljaar'] = date("Y") . " - " . (date("Y") + 1);
        //$_SESSION['schooljaar'] = date("Y") . " - " . date("Y", strtotime("+1 year",strtotime(date("Y-m-d"))));
    }            
            
    if(isset($_POST['schooljaar'])){
        if($_POST['schooljaar'] != ""){
            $_SESSION['schooljaar'] = $_POST['schooljaar'];
        }
    }

?>