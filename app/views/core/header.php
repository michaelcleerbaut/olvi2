<?php
if(!isset($isForm)){
    $uitloglink = $_SESSION['gebruiker'] ? "<a href=\"/logout.php\">Uitloggen</a>" : "";
    $titel = "Welkom {$_SESSION['gebruiker']['naam']}<br><div style=\"font-size:12px;text-align:right;\">$uitloglink</div>";                
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Olvi Boom Home </title>



<link href='/public/css/opmaak.css' rel='stylesheet' media="screen" type='text/css' />
<link href='/public/css/global.css' rel='stylesheet'  media="screen" type='text/css' />
<link href="/public/css/jquery-ui-1.8.19.custom.css" rel="stylesheet" type="text/css"/>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="/public/js/jquery-ui-1.8.19.custom.min.js"></script>
<script src="/public/js/jquery.autocomplete.js"></script>
<script src="/app/js/global.js"></script>
<script src="/app/js/admin.js"></script>
<?=$css_includes?>
<?=$js_includes?>




</head>
<body>



<div id="bgOverlay"></div>

<div class="header">    
    <a href="/" style="display:block-inline;width:100%;height:100%;"><div class="logo"></div></a>
    <div class="titel"><?=$titel;?></div>
</div>



<? if(!isset($isForm)){ ?>


<table cellspacing="0" cellpadding="0" class="tbl-content" style="margin-top: 20px;">
    <tr>
        <td><img src="/public/img/shadow-left.png" alt="" /></td>
        <td class="tdForm">
            <div class="content-container">
                <div class="vakken">
                    <div class="vak" style="margin-top: 50px;">

<? } ?>

<?=Notification::show()?>