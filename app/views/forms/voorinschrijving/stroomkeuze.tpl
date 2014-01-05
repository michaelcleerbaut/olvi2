
<div class="subtitelCenter">U gaat uw kind inschrijven voor de <?=$stroomkeuze;?> Stroom</div>


<div style="margin-left: 300px;">
<?
    if($stroomkeuze == "A"){
?>
    <div class="btnBig btnBigActive" id="stroomA" style="float:left;">A Stroom</div>  
<?
    } else {
?>    
    <div class="btnBig btnBigActive" id="stroomB" style="float:left;">B Stroom</div>
<?
    }
?>
</div>


<input type="hidden" value="<?=$stroomkeuze;?>" id="stroomkeuze">
