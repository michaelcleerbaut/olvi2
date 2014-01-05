<input type="hidden" id="id_leerling" value=""> 

<div class="stappenContainer">

    <div class="progressbar-bg"></div>
    <div class="progressbar-active"></div>
    
    <div class="stappen">        
        <?=$steps_overview?>
    </div>
    <div class="clear"></div>  
</div>



<table cellspacing="0" cellpadding="0" class="tbl-content">
    <tr>
        <td></td><td class="vak-titel"><?=$step_start_title?></td><td></td>
    </tr>
    <tr>
        <td><img src="/public/img/shadow-left.png" alt="" /></td>
        <td class="tdForm">
            <div class="content-container">
            
                <div id="loading"></div>
            
                <div class="prev navigatorDisable">Vorige</div>                
                <div class="next">Volgende</div>
                <div class="error"></div>    
    
                <div class="vakken" id="voorinschrijving">
                    <?=$steps_containers?>        
                </div>
                
           </div>
        </td>
        <td><img src="/public/img/shadow-right.png" alt="" /></td>
    </tr>
</table>