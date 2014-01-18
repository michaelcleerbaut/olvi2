<?php

    require_once('config.inc.php');

    function __autoload($ClassName){
        if((@include "../../lib/$ClassName.php") === false){
            if((@include "../lib/$ClassName.php") === false){            
                echo "Class $ClassName not found!";                
                exit;
            }
        }
    }

?>
