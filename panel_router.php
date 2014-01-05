<?php
  if((@include "app/panel/{$_GET['p']}.php") === false){
    include("/oops.php");   
  }   
?>
