<?php
    Class InschrijvingsAfspraak{

        static function menu(){
            $html = <<<HTML
    <div class="subtitel">Wat wil u doen?</div>

    <ul class="opties">
        <li><a href="/panel/inschrijvingsafspraken/show">Toon afspraken</a></li>    
        <li><a href="/panel/inschrijvingsafspraken/add">Voeg een afspraak toe</a></li>    
    </ul>
HTML;

            return $html;      
        }

        static function show_afspraken(){

            $query = "SELECT a.*, l.naam, l.voornaam FROM afspraken a
            INNER JOIN leerlingen l ON a.id_leerling = l.id_leerling ORDER BY dag, uur";
            $result = query($query);
            while($row = mysql_fetch_assoc($result)){
                if($row['dag'] != "broerofzus" && $row['dag'] != "tel"){
                    $afspraken[$row['dag']][$row['uur']][$row['id_leerling']] = $row['naam'] . " " . $row['voornaam'];
                } else if ($row['dag'] == "tel"){
                    $afsprakentel[$row['id_leerling']] = $row['naam'] . " " . $row['voornaam'];
                } else if($row['dag'] == "broerofzus"){
                    $afsprakenbroerofzus[$row['id_leerling']] = $row['naam'] . " " . $row['voornaam'];
                }
            }              

            $blokken = array(
                "1" => array("start" => "09:00", "eind" => "12:00"),
                "2" => array("start" => "13:00", "eind" => "20:00"),        
            );


            $html = "<div class=\"subtitel\">Afspraken overzicht</div>";

            $html .= "<table class=\"opties\">";
            $html .= "<tr><th class=\"top\">Uur</th><th class=\"top\">3 Mei</th><th class=\"top\">4 Mei</th><th class=\"top\">5 Mei</th></tr>";
            foreach($blokken as $blok => $arr){
                $start = strtotime($arr['start']);
                $eind = strtotime($arr['eind']);                
                for($i = $start;$i < $eind; $i += 30 * 60){            
                    $uur = date("H:i",$i);

                    $dis3 = strtotime($uur) < strtotime("17:00") ? " style=\"background-color: #CCC;\" " : " style=\"background-color: #f2f2f2;\" ";
                    $dis4 = strtotime($uur) < strtotime("13:00") || strtotime($uur) > strtotime("17:30") ? "style=\"background-color: #CCC;\" " : " style=\"background-color: #f2f2f2;\" ";
                    $dis5 = strtotime($uur) > strtotime("11:30") ? " style=\"background-color: #CCC;\" " : " style=\"background-color: #f2f2f2;\" ";

                    $html .= "<tr>
                    <th class=\"top\">{$uur}</th>
                    <td $dis3 valign=\"top\">";
                    if(is_array($afspraken['3'][$uur]) && count($afspraken['3'][$uur]) > 0){
                        foreach($afspraken['3'][$uur] as $id => $leerling){                                    
                            $delete = $_SESSION['gebruiker']['rights']['afspraken']['delete'] == "YES" ? "<a href=\"/panel/inschrijvingsafspraken/delete/{$id}\" class=\"regular confirm\">[annuleer]</a>" : "";
                            $html .= $leerling . " $delete<br>";                                    
                        }
                    }
                    $html .= "  </td>
                    <td $dis4 valign=\"top\">";
                    if(is_array($afspraken['4'][$uur]) && count($afspraken['4'][$uur]) > 0){
                        foreach($afspraken['4'][$uur] as $id => $leerling){                                    
                            $delete = $_SESSION['gebruiker']['rights']['afspraken']['delete'] == "YES" ? "<a href=\"/panel/inschrijvingsafspraken/delete/{$id}\" class=\"regular confirm\">[annuleer]</a>" : "";
                            $html .= $leerling . " $delete<br>";                                    
                        }
                    }
                    $html .= "  </td>
                    <td $dis5 valign=\"top\">";
                    if(is_array($afspraken['5'][$uur]) && count($afspraken['5'][$uur]) > 0){
                        foreach($afspraken['5'][$uur] as $id => $leerling){                                    
                            $deletebtn = $_SESSION['gebruiker']['rights']['afspraken']['delete'] == "YES" ? "<a href=\"/panel/inschrijvingsafspraken/delete/{$id}\" class=\"regular confirm\">[annuleer]</a>" : "";
                            $html .= $leerling  . " $deletebtn<br>";                                    
                        }
                    }
                    $html .= "  </td>
                    </tr>";
                }
            }


            $html .= "</table>";


            return $html;        

        }


        static function add_afspraak(){      

            $html = <<<HTML
      
        <div class="subtitel">Voeg een afspraak toe</div>
        <form action="/panel/inschrijvingsafspraken" method="post">
        <input type="hidden" name="action" value="insert_afspraak">
        <input type="hidden" id="id_leerling" name="id_leerling" value="">
        <input type="hidden" id="dag" name="dag" value="">
        <input type="hidden" id="uur" name="uur" value="">
        <table class="formulier">
            <tr><th>Naam leerling</th><td> <input type="text" name="naam" value="" id="search_leerling"></td></tr>
        </table>
                
HTML;

            $max = array(
                "3" => array("start" => "17:00", "eind" => "20:00"),
                "4" => array("start" => "13:00", "eind" => "18:00"),
                "5" => array("start" => "9:00", "eind" => "12:00")
            );

            $query = "SELECT * FROM afspraken WHERE dag NOT LIKE 'tel'";
            $result = query($query);
            while($row = mysql_fetch_assoc($result)){            
                $bezet[$row['dag']][$row['uur']] += 1;                
            }

            $tbl = "<div class=\"afspraak-container\">";            
            foreach($max as $dag => $arr){            
                $tbl .= "<div class=\"dag\">{$dag} Mei</div>";                
                $start = strtotime($arr['start']);
                $eind = strtotime($arr['eind']);                
                for($i = $start;$i < $eind; $i += 30 * 60){            
                    $uur = date("H:i",$i);
                    $bezette = $bezet[$dag][$uur];                    
                    $disabled = $bezette >= 10 ? "bezet" : "";                    
                    $clickable = $bezette >= 10 ? "NO" : "YES";
                    $select  = $_SESSION['afspraak_dag'] == $dag && $_SESSION['afspraak_uur'] == $uur ? "select" : "";
                    $tbl .= "<div class=\"uur $disabled $select\" clickable=\"$clickable\" dag=\"$dag\">" . $uur . "</div>";                    
                }
                $tbl .= "<div style=\"clear:both;\"></div>";                                            
            }
            $tbl .= "</div>";  

            $html .= $tbl;

            $html .= "<div class=\"btnBig btnBigActive submit\">Opslaan</div>";
            $html .= "</form>";

            $html .= <<<HTML
      <script type="text/javascript">
      $(document).ready(function(){            
          $('#search_leerling').autocomplete2({
            serviceUrl:'/ajax.php?action=search_kind_via_naam&stroom=NO',
            minChars:2,
            delimiter: /(,|;)\s*/, // regex or character
            maxHeight:400,
            width:500,
            zIndex: 9999,
            deferRequestBy: 0, //miliseconds
            noCache: false, //default is false, set to true to disable caching
            onSelect: function(value, data){                     
                $('#id_leerling').val(data);
            }
          });      

            $('.afspraak-container .uur').click(function(){                                
                if($(this).attr('clickable') == "YES"){
                    $('#dag').val($(this).attr('dag'));
                    $('#uur').val($(this).html());                
                    $('.afspraak-container .uur').removeClass('select');
                    $(this).addClass('select');
                }
            });                    
            
          
          
        });
      </script>
HTML;

            return $html;

        }


        static function insert_afspraak($data){

            if($data['id_leerling'] != "" && $data['uur'] != "" && $data['dag'] != ""){

                foreach($data as $key => $value){          
                    $data[$key] = mysql_real_escape_string($value);          
                }

                $query = "INSERT INTO afspraken
                (`id_leerling`,`dag`,`uur`)
                VALUES
                ('{$data['id_leerling']}','{$data['dag']}','{$data['uur']}')
                ";
                query($query);

                $dagen = array("3" => "Vrijdag 3 mei", "4" => "Zaterdag 4 mei", "Zondag 5 mei");

                $mailsent = "";

                $query  = "SELECT email FROM communicatie WHERE id_leerling = '{$data['id_leerling']}'";
                $result = query($query);
                while($leerling = mysql_fetch_assoc($result)){         
                    if($leerling['email'] != ""){

                        $subject = 'Uw afspraak gegevens voor een definitieve inschrijving van uw kind bij OLVI Boom';
                        $headers = 'From: Olvi Boom Middenschool <coordinatie@olviboom.be>' . "\r\n" .
                        'Reply-To: Olvi Boom Middenschool <coordinatie@olviboom.be>' . "\r\n" .
                        'Content-Type: text/html';
                        $message = <<<MSG
            
                <img src="http://www.olviboom.be/middenschooltest/afb/logo_jpg.jpg" alt="Olvi Boom Middenschool">
            
                <p>Beste, </p>
            
                <p>U heeft een afspraak om uw kind definitief in te schrijven op volgende datum:</p>
                        
                <p style="font-size:14px;font-weight:bold;"><br><br>{$dagen[$data['dag']]} om {$data['uur']}<br><br></p>            
            
                <p>
                    Met vriendelijke groeten,<br><br><br><br><br><br>
                    Sharon Sluyts
                </p>            
                
                <img src="http://www.olviboom.be/middenschooltest/afb/handtekening.jpg" alt="Olvi Boom">                        
MSG;

                        mail($leerling['email'],$subject, $message, $headers);
                        mail("coordinatie@olviboom.be", $subject, $message, $headers);
                        mail("michael.cleerbaut@hotmail.com", $subject, $message, $headers);


                        $mailsent = " + bevestiging mail verstuurd naar de leerling";
                    }
                }

                return "<div class=\"succes\">Afspraak is succesvol aangemaakt $mailsent</div>";      

            } else {
                return "<div class=\"error_msg\">U heeft niet alle velden ingevuld</div>";      
            }

        }

        static function update_afspraak($data){


            $data['naam'] = ucfirst(strtolower($data['naam']));

            foreach($data as $key => $value){
                $data[$key] = mysql_real_escape_string($value);
            }

            $straat = $data['straat'] . " " . $data['nr'];

            $query = "UPDATE scholen SET
            `naam` = '{$data['naam']}',
            `straat` = '{$straat}',
            `postcode` = '{$data['postcode']}',
            `gemeente` = '{$data['gemeente']}'
            WHERE id = '{$data['school_id']}'                
            ";
            query($query);

            return "<div class=\"succes\">School is succesvol aangepast</div>";

        }

        static function delete_afspraak($id_leerling){

            $query = "DELETE FROM afspraken WHERE id_leerling = '{$id_leerling}'";
            query($query);

            Notification::set("success","Afspraak is succesvol verwijderd");
            
        }        


    }
?>
