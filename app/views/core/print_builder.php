<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Olvi Boom Inschrijving</title>


<link href='/public/css/print.css' rel='stylesheet'  media="print" type='text/css' />
<link href='/public/css/print.css' rel='stylesheet'  media="screen" type='text/css' />
<link href='/public/css/print_onscreen.css' rel='stylesheet'  media="screen" type='text/css' />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>


<script type="text/javascript">
    $(document).ready(function(){
       window.print(); 
       window.setTimeout("close()",250)       
    });
</script>


</head>
<body>


<?php
    foreach($pages as $page){
        echo "<div class=\"page\">";            
            include("/".$page);
        echo "</div>";        
    }
?>


</body>
</html>