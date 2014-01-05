<?php
    if(isset($_SESSION['gebruiker']['id'])){
        
        Template::view("core/header");
        Template::view("main/home");
        Template::view("core/footer");
                
    } else {
    
        Template::view("core/header");
        Template::view("main/login",$login_vars);
        Template::view("core/footer");
        
    }
?>