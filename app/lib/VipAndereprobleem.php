<?php
    Class VipAndereprobleem{

        static function show_inschrijvingen(){

            $html = "<div class=\"subtitel\">VIP Andere problemen inschrijvingen</div>";

            $query = "SELECT v.*, v.id as v_id, l.naam, l.voornaam FROM vip_andereproblemen v                
            INNER JOIN leerlingen l ON v.id_leerling = l.id_leerling                
            WHERE l.deleted != 1
            ORDER BY l.naam 
            ";    
            $result = query($query);

            $html .= "<table class=\"opties\" cellpadding=\"0\"><tr><th class=\"top\">Naam</th></th><th class=\"top\">Opgemaakt door</th></tr>";

            while($row = mysql_fetch_assoc($result)){

                $naam = $row['voornaam'] != "" || $row['naam'] != "" ? $row['voornaam'] . " " . $row['naam'] : "<i>geen naam</i>";

                $html .= "<tr>";
                $html .= "<th class=\"left\"><a href=\"/panel/vip_andereproblemen/show/{$row['v_id']}\">$naam</a></th>";                        
                $html .= "<td class=\"center\">{$row['opgemaakt_door']}</td>";
                $html .= "<td class=\"center\"><a href=\"/prt/vip/vip_andereproblemen/{$row['id_leerling']}\" target=\"_blank\"><div class=\"print_icon\"></div></a></td>";
                $html .= $_SESSION['gebruiker']['rights']['vip_andereproblemen']['bewerken'] == "YES" ? "<td class=\"center\"><a href=\"/panel/vip_andereproblemen/edit/{$row['v_id']}\">Edit</a></td>" : "";
                $html .= $_SESSION['gebruiker']['rights']['vip_andereproblemen']['delete'] == "YES" ? "<td class=\"center\"><a href=\"/panel/vip_andereproblemen/delete/{$row['v_id']}\" class=\"confirm\">Verwijder</a></td>" : "";
                $html .= "</tr>";


            }


            $html .= "</table>";

            return $html;
        }

        static function show_inschrijving($id){

            $query = "
            SELECT l.*, v.* FROM vip_andereproblemen v
            INNER JOIN leerlingen l ON v.id_leerling = l.id_leerling        
            WHERE v.id = '{$id}'       
            ";    
            $result = query($query);    
            while($leerling = mysql_fetch_assoc($result)){





                $leerling['omschrijving'] = nl2br($leerling['omschrijving']);

                $html = <<<HTML
        
            <div style="float:right;">
                <a href="/panel/vip_andereproblemen/edit/{$id}" class="btnMedium">Edit</a>
            </div>
        
          <div class="subtitel">VIP Andere problemen fiche van {$leerling['naam']} {$leerling['voornaam']}</div>
          
                     
          <table class="formulier" cellspacing="2" cellpadding="0">                          
            <tr>
                <th class="left">Soorten</th>
                <td class="right">
                {$leerling['soort']}
                </td>
                <td></td>                
            </tr>
            <tr>
                <th class="left">Omschrijving</th>
                <td class="right">{$leerling['omschrijving']}</td>
            </tr>
            <tr>
                <th class="left">Kandidaat klassenraad</th>
                <td class="right" colspan="2">{$leerling['klassenraad']}</td>
            </tr>
            <tr>
                <th class="left">Gesprek CLB?</th>
                <td class="right" colspan="2">{$leerling['gesprek_clb']}</td>
            </tr>
            <tr>
                <th class="left">Gesprek titularis?</th>
                <td class="right" colspan="2">{$leerling['gesprek_titularis']}</td>
            </tr>
          </table>
          
          
          
          
          
          
      
           
        
HTML;




            }

            return $html;



        }

        static function edit_inschrijving($id){


            $query = "
            SELECT l.*, v.* FROM vip_andereproblemen v
            INNER JOIN leerlingen l ON v.id_leerling = l.id_leerling        
            WHERE v.id = '{$id}'       
            ";    
            $result = query($query);    
            while($leerling = mysql_fetch_assoc($result)){




                $chk_gesprek_clb_ja = $leerling['gesprek_clb'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_gesprek_clb_nee = $leerling['gesprek_clb'] == "Nee" ? " checked=\"checked\"" : "";

                $chk_klassenraad_ja = $leerling['klassenraad'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_klassenraad_nee = $leerling['klassenraad'] == "Nee" ? " checked=\"checked\"" : "";

                $chk_gesprek_titularis_ja = $leerling['gesprek_titularis'] == "Ja" ? " checked=\"checked\"" : "";
                $chk_gesprek_titularis_nee = $leerling['gesprek_titularis'] == "Nee" ? " checked=\"checked\"" : "";


                $html = <<<HTML
        
        
          <div class="subtitel">VIP Andere problemen fiche van {$leerling['naam']} {$leerling['voornaam']}</div>
          
          <form action="/panel/vip_andereproblemen/show/{$id}" method="post"> 
          <input type="hidden" name="action" value="save_edit_inschrijving">
          <input type="hidden" name="id_leerling" value="{$id}">                     
          <table class="formulier" cellspacing="2" cellpadding="0">                          
            <tr>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th class="left">Soorten</th>
                <td class="right">
                    <input type="text" name="soort" value="{$leerling['soort']}">
                </td>                
            </tr>            
            <tr>
                <th class="left" valign="top">Omschrijving</th>
                <td><textarea name="omschrijving" style="width:550px;height:200px;">{$leerling['omschrijving']}</textarea></td>
            </tr>
            <tr>
                <th class="left" valign="top">
                    Kandidaat klassenraad
                </th>
                <td class="right">
                    <label><input type="radio" name="klassenraad" value="Ja" style="width: 20px;" $chk_klassenraad_ja> Ja </label>
                    <label><input type="radio" name="klassenraad" value="Nee" style="width: 20px;" $chk_klassenraad_nee> Nee </label>                                
                </td> 
            </tr>
            <tr>
                <th class="left" valign="top">
                    Gesprek CLB?
                </th>
                <td class="right">
                    <label><input type="radio" name="gesprek_clb" value="Ja" style="width: 20px;" $chk_gesprek_clb_ja> Ja </label>
                    <label><input type="radio" name="gesprek_clb" value="Nee" style="width: 20px;" $chk_gesprek_clb_nee> Nee </label>                                
                </td> 
            </tr>
            <tr>
                <th class="left" valign="top">
                    Gesprek titularis?
                </th>
                <td class="right">
                    <label><input type="radio" name="gesprek_titularis" value="Ja" style="width: 20px;" $chk_gesprek_titularis_ja> Ja </label>
                    <label><input type="radio" name="gesprek_titularis" value="Nee" style="width: 20px;" $chk_gesprek_titularis_nee> Nee </label>                                
                </td> 
            </tr>
          </table>
                              
          <div class="btnBig btnBigActive submit">Opslaan</div>
          </form>
      
           
        
HTML;




            }

            return $html;

        }  

        static function save_edit_inschrijving($data){



            foreach($data as $key => $value){
                if(!is_array($value)){
                    $data[$key] = mysql_real_escape_string($value);
                }
            }

            $niet_automatisch = array("action","id_leerling");


            $query = "UPDATE vip_andereproblemen SET ";
            foreach($data as $key => $value){      
                if(!in_array($key,$niet_automatisch)){
                    $query .= " `$key` = '$value', ";          
                }
            }
            $query = substr($query,0,-2) .  " WHERE id = '{$data['id_leerling']}'";

            query($query);

            return "<div class=\"succes\">VIP inschrijving is succesvol gewijzigd</div>";

        }

        static function delete_inschrijving($id){

            $query = "DELETE FROM vip_andereproblemen WHERE id = '{$id}'";
            query($query);
         
            Notification::set("success","VIP Andere problemen formulier is succesvol verwijderd");
            
        }


    }
?>
