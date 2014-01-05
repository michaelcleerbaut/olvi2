<?php

    unset($_SESSION['gebruiker']);
    unset($_SESSION);
    setcookie("gebruiker", "", time()-3600);

    header("Location: index.php");
    
?>
