<?php


    function list_cronjobs(){

        $jobs = Cronjob::get_jobs();
        
        foreach($jobs as $jib => $job){
            $job_rows .= "
                <tr>
                <th class=\"left\" title=\"{$job['description']}\">{$job['name']}: {$job['description']}</th>
                <td class=\"center\">{$job['minute']}</td>
                <td class=\"center\">{$job['hour']}</td>
                <td class=\"center\">{$job['day_of_month']}</td>
                <td class=\"center\">{$job['month']}</td>
                <td class=\"center\">{$job['day_of_week']}</td>";
                $job_rows .= $_SESSION['gebruiker']['rights']['cron']['uitvoeren'] == "YES" ? "<td class=\"center\"><a href=\"/panel/cron/uitvoeren/{$job['id']}\" class=\"confirm\">Uitvoeren</a></td>" : "";
                $job_rows .= $_SESSION['gebruiker']['rights']['cron']['bewerken'] == "YES" ? "<td class=\"center\"><a href=\"/panel/cron/edit/{$job['id']}\">Edit</a></td>" : "";
                $job_rows .= $_SESSION['gebruiker']['rights']['cron']['delete'] == "YES" ? "<td class=\"center\"><a href=\"/panel/cron/delete/{$job['id']}\" class=\"confirm\">Delete</a></td>" : "";
            $job_rows .= "</tr>
            ";
        }

        $html = <<<html
                                
                                
                <div class="subtitel">Overzicht Cron jobs</div>
                
                <a href="/panel/cron/add/" class="btnSmall">Nieuwe cron</a>                

                <p style="font-size: 12px;">          
                    <strong>I</strong>: minute, 
                    <strong>H</strong>: uur, 
                    <strong>DM</strong>: dag van de maand,
                    <strong>M</strong>: maand, 
                    <strong>DW</strong>: dag van week                
                </p>
          
                <table class="opties" cellpadding="0" style="margin-top: 10px;">
                    <tr>
                        <th class="top">Cron job</th>                        
                        <th class="top">I</th>
                        <th class="top">H</th>
                        <th class="top">DM</th>
                        <th class="top">M</th>
                        <th class="top">DW</th>
                    </tr>
                    $job_rows          
                </table>

          
                
     
                $html
            
html;

        return $html;

    }
    
    function cronjob_form($CID = ""){
        
        $job = new Cronjob($CID);
        
        $action = $CID == "" ? "insert" : "update";
        
        $html = <<<html
        
        
          <div class="subtitel">Cronjob: {$job->name}</div>
          
          <form action="/panel/cron/" method="post"> 
          <input type="hidden" name="action" value="$action">
          <input type="hidden" name="CID" value="{$CID}">                     
          <table class="formulier" cellspacing="2" cellpadding="0">                          
            <tr>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th class="left">Naam</th>
                <td class="right">
                    <input type="text" name="name" value="{$job->name}">
                </td>                
            </tr>            
            <tr>
                <th class="left" valign="top">Omschrijving</th>
                <td><textarea name="description" style="width:570px;height:200px;margin-left:10px;">{$job->description}</textarea></td>
            </tr>
            <tr>
                <th class="left">Command</th>
                <td class="right">
                    <input type="text" name="command" value="{$job->command}">
                </td>                
            </tr>            
            <tr>
                <th class="left">Minuut</th>
                <td class="right">
                    <input type="text" name="minute" value="{$job->minute}">
                </td>                
            </tr>            
            <tr>
                <th class="left">Uur</th>
                <td class="right">
                    <input type="text" name="hour" value="{$job->hour}">
                </td>                
            </tr>            
            <tr>
                <th class="left">Dag van de maand</th>
                <td class="right">
                    <input type="text" name="day_of_month" value="{$job->day_of_month}">
                </td>                
            </tr>            
            <tr>
                <th class="left">Maand</th>
                <td class="right">
                    <input type="text" name="month" value="{$job->month}">
                </td>                
            </tr>            
            <tr>
                <th class="left">Dag van de week</th>
                <td class="right">
                    <input type="text" name="day_of_week" value="{$job->day_of_week}">
                </td>                
            </tr>            

          </table>
                              
          <div class="btnBig btnBigActive submit">Opslaan</div>
          </form>
                  
        
        
html;
        
        
        return $html;        
        
    }
    
    
    function update_cron($data){
        
        $cron = new Cronjob($data['CID']);
        
        $cron->name = $data['name'];
        $cron->description = $data['description'];
        $cron->command = $data['command'];
        $cron->minute = $data['minute'];
        $cron->hour = $data['hour'];
        $cron->day_of_month = $data['day_of_month'];
        $cron->month = $data['month'];
        $cron->day_of_week = $data['day_of_week'];
        
        $cron->update();
        
        
        return "<div class=\"succes\">Cronjob is succesvol gewijzigd</div>";
        
        
    }
    
    function insert_cron($data){
        
        $cron = new Cronjob();
        
        $cron->name = $data['name'];
        $cron->description = $data['description'];
        $cron->command = $data['command'];
        $cron->minute = $data['minute'];
        $cron->hour = $data['hour'];
        $cron->day_of_month = $data['day_of_month'];
        $cron->month = $data['month'];
        $cron->day_of_week = $data['day_of_week'];
        
        $cron->insert();
        
        
        return "<div class=\"succes\">Cronjob is succesvol toegevoegd</div>";
        
        
    }
    
    function delete_cron($CID){
    
        $cron = new Cronjob($CID);
        $cron->delete();
        
        Notification::set("success","Cronjob is succesvol verwijderd");
        
        
    }
    
    
    function execute_cron($CID){
        
        
        $cron = new Cronjob($CID);
        $cron->execute();
        
        Notification::set("success","Cronjob is succesvol uitgevoerd");
        
    }
    
    
?>
