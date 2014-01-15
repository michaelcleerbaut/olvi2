<?php
    Class Query{


        static function get_queryarray(){

            $query = "SELECT id, naam FROM gebruikers";
            $result = query($query);
            while($row = mysql_fetch_assoc($result)){
                $gebruikers[$row['id']] = $row['naam'];
            }


            /**
            * ==================== ZOEK VELDEN OM QUERY SAMEN TE STELLEN
            **/

            $queryarray['afspraken']['dag'] = array(    
                'name' => "Dag",
                'req' => 0,
                'type' => 'BOOL',    
                'opt' => array("3" => "3 Mei", "4" => "4 Mei", "5" => "5 Mei")
            );      

            $queryarray['afspraken']['uur'] = array(
                'name' => 'Uur',
                'opm' => "notatie:  HH:MM",
                'req' => 0,
                'type' => 'TEXT',
                'opt'  => array("<" => "Vroeger dan", "<=" => "Vroeger of gelijk aan", "=" => "om", ">=" => "Later of gelijk aan" , ">" => "Later dan")
            );      

            $queryarray['inschrijving']['stroom'] = array(    
                'name' => 'Stroom',
                'req' => 0,
                'type' => 'SET',
                'opt'  => array("=" => "is"),
                'values' => array("A" => "A Stroom", "B" => "B Stroom")
            );      

            $queryarray['inschrijving']['voor_ingeschreven_door'] = array(
                'name' => 'Voor ingeschreven door',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => $gebruikers
            );      

            $queryarray['inschrijving']['def_ingeschreven_door'] = array(
                'name' => 'Definitief ingeschreven door',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => $gebruikers
            );      


            $queryarray['leerlingen']['geslacht'] = array(
                'name' => 'Geslacht',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => array("Man" => "Man", "Vrouw" => "Vrouw")
            );

            $queryarray['leerlingen']['geboortedatum'] = array(
                'opm' => 'Notatie: YYY/MM/DD',
                'name' => 'Geboortedatum',
                'req'  => 0,
                'type' => 'TEXT',
                'opt'  => array("<" => "Vroeger dan", "<=" => "Vroeger of gelijk aan", "=" => "om", ">=" => "Later of gelijk aan" , ">" => "Later dan")
            ); 

            $queryarray['leerlingen']['geboorteplaats'] = array(
                'name' => 'Geboorteplaats',
                'req'  => 0,
                'type' => 'TEXT',
                'opt'  => array("=" => "is", "!=" => "is niet", "BEG" => "begint met", "END" => "eindigt met", "CONTAIN" => "Bevat")
            ); 

            $queryarray['leerlingen']['nationaliteit'] = array(
                'name' => 'Nationaliteit',
                'req'  => 0,
                'type' => 'TEXT',
                'opt'  => array("=" => "is", "!=" => "is niet", "BEG" => "begint met", "END" => "eindigt met", "CONTAIN" => "Bevat")
            );

            $queryarray['leerlingen']['postcode'] = array(
                'name' => 'Postcode',
                'req'  => 0,
                'type' => 'TEXT',
                'opt'  => array("=" => "is", "!=" => "is niet", "BEG" => "begint met", "END" => "eindigt met", "CONTAIN" => "Bevat", ">=" => "Is groter of gelijk aan ", "<=" => "Is kleiner of gelijk aan")
            ); 

            $queryarray['leerlingen']['email'] = array(
                'name' => 'Email',
                'req'  => 0,
                'type' => 'TEXT',
                'opt'  => array("=" => "is", "!=" => "is niet", "BEG" => "begint met", "END" => "eindigt met", "CONTAIN" => "Bevat")
            ); 

            $queryarray['leerlingen']['school_vorig_schooljaar'] = array(
                'name' => 'School vorig schooljaar',
                'req'  => 0,
                'type' => 'TEXT',
                'opt'  => array("CONTAIN" => "Bevat")
            ); 

            $queryarray['loopbaan']['studiekeuze'] = array(
                'name' => 'Studiekeuze',
                'req'  => 0,
                'type' => 'TEXT',
                'opt'  => array("CONTAIN" => "Bevat")
            );  

            $queryarray['loopbaan']['huidigschooljaar'] = array(
                'name' => 'Huidig schooljaar',
                'req'  => 0,
                'type' => 'TEXT',
                'opt'  => array("<" => "Vroeger dan", "<=" => "Vroeger of gelijk aan", "=" => "om", ">=" => "Later of gelijk aan" , ">" => "Later dan")
            );  

            $queryarray['loopbaan']['keuzevakken'] = array(
                'name' => 'Keuzevakken',
                'req'  => 0,
                'type' => 'TEXT',
                'opt'  => array("CONTAIN" => "Bevat")
            );   
            

            $queryarray['loopbaan']['dubbele_afdruk'] = array(
                'name' => 'Dubbele afdruk',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
            );
            

            $queryarray['loopbaan']['toestemming_baso_werking'] = array(
                'name' => 'Toestemming BASO werking',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
            );

            $queryarray['loopbaan']['digitale_communicatie_moeder'] = array(
                'name' => 'Digitale communicatie moeder',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => array("" => "Leeg", "post" => "Post", "email" => "Email")
            );
            
            $queryarray['loopbaan']['digitale_communicatie_vader'] = array(
                'name' => 'Digitale communicatie vader',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => array("" => "Leeg", "post" => "Post", "email" => "Email")
            );            
            
            
            $queryarray['vip']['middag'] = array(
                'name' => 'Middageten',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => array("School" => "op school blijft en zijn / haar lunch gebruikt in de leerlingenrefter", "Thuis" => "naar huis komt")
            );

            $queryarray['vip']['thuis_opgevoed'] = array(
                'name' => 'Thuis opgevoed',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
            );

            $queryarray['vip']['opgevoed_postcode'] = array(
                'name' => 'Opgevoed postcode',
                'req'  => 0,
                'type' => 'TEXT',
                'opt'  => array("=" => "is", "!=" => "is niet", "BEG" => "begint met", "END" => "eindigt met", "CONTAIN" => "Bevat", ">=" => "Is groter of gelijk aan ", "<=" => "Is kleiner of gelijk aan")
            );
            
            
            $queryarray['vip']['door_beide_ouders_opgevoed'] = array(
                'name' => 'Opgevoed door beide ouders',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
            );

            $queryarray['vip']['opgevoed_door_andere'] = array(
                'name' => 'Opgevoed door andere',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => array("Niet van toepassing" => "Niet van toepassing", "Gescheiden" => "Gescheiden", "1 ouder overleden" => "1 ouder overleden", "2 ouders overleden", "co-ouderschap" => "CO-Ouderschap")
            );
            
            $queryarray['vip']['stiefouders'] = array(
                'name' => 'Heeft stiefouders',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => array("Ja" => "Ja", "Nee" => "Nee")
            );
            

            $queryarray['vip']['thuistaal'] = array(
                'name' => 'Thuistaal',
                'req'  => 0,
                'type' => 'TEXT',
                'opt'  => array("CONTAIN" => "Bevat")
            );

            $queryarray['vip']['heeft_jaar_moeten_overdoen'] = array(
                'name' => 'Heeft jaar moeten overdoen',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
            );

            $queryarray['vip']['herneemt_eerste_jaar'] = array(
                'name' => 'Herneemt eerste jaar',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
            );               

            $queryarray['vip']['maakt_gebruik_van_pc'] = array(
                'name' => 'Maakt van gebruik van pc in de klas',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
            );               
            
            

            $queryarray['vip']['leerproblemen'] = array(
                'name' => 'Heeft leerproblemen',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
            );

            $queryarray['vip']['gezondheidsproblemen'] = array(
                'name' => 'Heeft gezondheidsproblemen',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
            );


            $queryarray['vip']['gedragsproblemen'] = array(
                'name' => 'Heeft gedragsproblemen',
                'req'  => 0,
                'type' => 'BOOL',
                'opt'  => array("Nee" => "Nee", "Ja" => "Ja")
            );

            return $queryarray;

        }

        static function get_columnsarray(){

            /**
            * ==================== SELECTIE VELDEN VOOR IN RESULTATEN LIJST
            **/

            $columnsarray['afspraken'] = array(
                "dag" => "Afspraakdag",
                "uur" => "Afspraakuur"
            );

            $columnsarray['communicatie'] = array(
                "telefoon" => "Communicatie telefoon",
                "email" => "Communicatie email"
            );

            $columnsarray['leerlingen'] = array(
                "naam" => "Naam",
                "voornaam" => "Voornaam",
                "geslacht" => "Geslacht",
                "geboortedatum" => "Geboortedatum",
                "geboorteplaats" => "Geboorteplaats",
                "nationaliteit" => "Nationaliteit",
                "belgisch_rijksregisternummer_of_bisnummer" => "Rijksregister nr",
                "straat" => "Straat",
                "huisnummer" => "Huisnummer",
                "busnummer" => "Busnummer",
                "postcode" => "Postcode",
                "plaats" => "Gemeente",
                "email" => "Email",
                "tel" => "Telefoon",
                "gsm" => "GSM",
                "tel_noodnummer" => "Noodnummer",
                "school_vorig_schooljaar" => "Vorige school"
            );


            $columnsarray['loopbaan'] = array(
                "studiekeuze" => "Studiekeuze",
                "huidigschooljaar" => "Huidigschooljaar",
                "keuzevakken" => "Keuzevakken",
                "dubbele_afdruk" => "Dubbele afdruk",
                "gok_moeder_edison_spreektaal" => "Spreektaal moeder",
                "gok_vader_edison_spreektaal" => "Spreektaal vader",
                "gok_broer_zus_edison_spreektaal" => "Spreektaal broer of zus",
                "gok_vrienden_edison_spreektaal" => "Spreektaal vrienden",
                "gok_edison_opleidingsniveau_moeder" => "Opleidingsniveau moeder",
                "toestemming_baso_werking" => "Toestemming BASO werking",
                "digitale_communicatie_moeder" => "Digitale communicatie moeder",
                "digitale_communicatie_vader" => "Digitale communicatie vader"
            );

            $columnsarray['moeder'] = array(
                "moeder_naam" => "Naam",
                "moeder_voornaam" => "Voornaam",
                "moeder_beroep" => "Beroep",
                "moeder_straat" => "Straat",
                "moeder_huisnummer" => "Huisnummer",
                "moeder_busnummer" => "Busnummer",
                "moeder_postcode" => "Postcode",
                "moeder_plaats" => "Gemeente",
                "moeder_gsm" => "GSM",
                "moeder_email" => "Email"
            );

            $columnsarray['vader'] = array(
                "vader_naam" => "Naam",
                "vader_voornaam" => "Voornaam",
                "vader_beroep" => "Beroep",
                "vader_straat" => "Straat",
                "vader_huisnummer" => "Huisnummer",
                "vader_busnummer" => "Busnummer",
                "vader_postcode" => "Postcode",
                "vader_plaats" => "Gemeente",
                "vader_gsm" => "GSM",
                "vader_email" => "Email"
            );

            $columnsarray['vip'] = array(
                "middag" => "Middag thuis",
                "middag_straat" => "Middag straat",
                "middag_huisnummer" => "Middag huisnummer",
                "middag_busnummer" => "Middag busnummer",
                "middag_postcode" => "Middag postcode",
                "middag_plaats" => "Middag plaats",
                "thuis_opgevoed" => "Thuis opgevoed",
                "opgevoed_straat" => "Opgevoed straat",
                "opgevoed_huisnummer" => "Opgevoed huisnummer",
                "opgevoed_busnummer" => "Opgevoed busnummer",
                "opgevoed_postcode" => "Opgevoed postcode",
                "opgevoed_plaats" => "Opgevoed plaats",
                "door_beide_ouders_opgevoed" => "Door beide ouders opgevoed",
                "opgevoed_door_andere" => "Opgevoed door andere",
                "stiefouders" => "Heeft stiefouders?",
                "partnermama_naam" => "Partner mama naam",
                "partnermama_voornaam" => "Partner mama voornaam",
                "partnermama_gsm" => "Partner mama gsm",
                "partnermama_email" => "Partner mama email",
                "partnerpapa_naam" => "Partner papa naam",
                "partnerpapa_voornaam" => "Partner papa voornaam",
                "partnerpapa_gsm" => "Partner papa gsm",
                "partnerpapa_email" => "Partner papa email",
                "andere_info" => "Andere info",
                "thuistaal" => "Thuistaal",
                "heeft_jaar_moeten_overdoen" => "Heef jaar moeten overdoen",
                "jaar_overdoen_welke" => "Jaar overdoen welke",
                "herneemt_eerste_jaar" => "Herneemt eerste jaar",
                "herneemt_eerste_jaar_school_naam" => "Herneemt eerste jaar school naam",
                "herneemt_eerste_jaar_school_postcode" => "Herneemt eerste jaar school postcode",
                "herneemt_eerste_jaar_school_gemeente" => "Herneemt eerste jaar school gemeente",                
                "leerproblemen" => "Leerproblemen",
                "leerproblemen_extra" => "Leerproblemen extra",
                "gezondheidsproblemen" => "Gezondheidsproblemen",
                "gezondheidsproblemen_extra" => "Gezondheidsproblemen extra",
                "gedragsproblemen" => "Gedragsproblemen",
                "gedragsproblemen_extra" => "Gedragsprolemen extra"
            );
            
            $columnsarray['vip_leerproblemen'] = array(
                "maakt_gebruik_van_pc" => "Maakt gebruik van pc in de klas",                
                "maakt_gebruik_van_pc_programmas" => "Welke programmas gebruikt de leerling"            
            );

            return $columnsarray;

        }

        static function menu(){

            $html = <<<HTML
    <div class="subtitel">Wat wil u doen?</div>

    <ul class="opties">
        <li><a href="/panel/queries/new_query">Nieuwe query maken</a></li>    
        <li><a href="/panel/queries/load_queries">Queries tonen</a></li>    
    </ul>
HTML;

            return $html; 
        }



        static function get_all_queries($type){

            $queries = "<select name=\"query_id\"><option>Kies een query</option>";
            $queriestable .= "<input type=\"hidden\" name=\"query_id\" id=\"query_id\" value=\"\">";
            $queriestable .= "<ul class='opties'>";
            $query = "SELECT * FROM queries WHERE tmp = 0 ORDER BY name";
            $result = query($query);
            while($row = mysql_fetch_assoc($result)){          

                $queries .= "<option value=\"{$row['id']}\">{$row['name']}</option>";          
                $queriestable .= "<li queryid=\"{$row['id']}\">{$row['name']}</li>";
                //<td style='width: 20px;'><a href=\"querypage.php?action=load_queries&action2=delete&id={$row['id']}\" class=\"regular\" onclick=\"return confirm('Klik op ok om de query \'{$row['name']}\' te verwijderen');\">Delete</a></td></td>

            }
            $queries .= "</select>";      
            $queriestable .= "</ul>";

            $return = $type == "list" ? $queries : $queriestable;
            return $return;
        }


        static function query_form($data = array(),$query_id = ""){


            $columns_form = self::build_columns_form($data);
            $query_form = self::build_query_form($data); // if existing query get lines      
            $queryselect = self::query_select(); // initialize new line
            $change_query_name = "<span style=\"font-size: 12px;font-weight:normal;cursor: pointer;\" id=\"change_query_name\">[ verander naam ]</span>";


            if($_POST['save_as_name'] != ""){
                $titel = $_POST['save_as_name'];
            } else {
                $titel = $query_id != "" ? self::load_query($query_id,"titel")  : "New Query";          
                $titel = $_POST['query_name'] != "" ? $_POST['query_name'] : $titel;
            }

            if($_POST['save_query'] != ""){
                $classSave = "";
                $must_save = "NO";   
            } else {
                $classSave = $_POST['must_save'] == "YES" ? "glow" : "";
                $must_save = $_POST['must_save'] != "" ? $_POST['must_save'] : "NO";
            }




            $content = <<<CONTENT
        
      
          <h2 class="query_name"><span class="titel">$titel</span> $change_query_name</h2>
          <div id="tmp_change_name" style="display:none;"><input type="text" value="$titel" style="font-size: 24px;font-weight:bold;"><button id="ready_name">Klaar</button></div>
                    
      
          <!-- hidden div => initialized new line -->
          <div id="querydiv" style="display: none">     
           <div class="queryrule">
            $queryselect
            <span class="queryoperator"></span>
            <span class="queryinput"></span>
            <button class="remove_query">&nbsp; - &nbsp;</button>
           </div>
          </div>      
          <!-- END hidden div => initialized new line -->
              
              
          <form id="queryform" method="POST">
            <input type="hidden" name="query_id" id="query_id" value="{$query_id}">          
            <input type="hidden" name="query_name" id="query_name" value="$titel">
            <input type="hidden" name="must_save" id="must_save" value="$must_save">
            
            <div class="title">1. Selecteer kolommen voor de resultaten lijst</div>
            <div class="columnsform" style="top: -20px;">
                $columns_form
            </div>
            
            <!-- query form lines -->
            <div class="title">2. Stel je zoek actie samen</div>
            <div class='queryform' style="top: -20px;">                              
                <div class="btnMedium" id="add_query">+ Add Line</div>        
                <br />    
                $query_form    
            </div>
            <!-- END query form lines -->
            
                      
            <!-- action buttons -->
            <div style="min-height: 40px;border-bottom: solid thin #a5a5a5;" class="action_buttons">
              <div style="position: relative;float:left;">
                <input type="submit" name="save_query" value="Opslaan" class='btnSmall save_query $classSave'>
                <input type="button" class="btnSmall save_as" value="Opslaan als...">
              </div>
            
              <!--
              <div style="position: relative; float:left;margin-left: 20px;padding-left:20px;border-left:solid thin #a5a5a5;">                
                <input type="button" class="btnSmall export_to_csv" value="Exporteer naar CSV">
              </div>
              -->
            
              <div style="float:right;">      
                <input type="submit" name="showamount" class="btnSmall toonaantal" value="Toon resultaten aantal">
                <input type="submit" name="showresults" class="btnSmall" value="Toon resultaten">    
              </div>
                            
              
              <div style="clear:both;"></div>
              

              <div class="saveasdiv">
                Save as: <input type="text" name="save_as_name" value="" size="40"> <input type="submit" name="save_as" value="Save As"> <input type="button" class="cancel_save_as" value="Cancel">
              </div>

              
              <div style="height:60px;display:none;" class="extra_buttons">
                
                <span style="display: inline-block;">
                  <div style="margin: 0px 0px 10px 245px;display:none;position: absolute;padding: 5px;background-color: #cfdbe4;" class="csvdiv">
                    File name: <input type="text" name="export_to_csv_name" value="" size="40"> <input type="submit" name="export_to_csv" value="Export to CSV"> <input type="button" class="cancel_export_to_csv" value="Cancel"><br>
                  </div>
                </span>
                
              </div>
           
                
            </div>
            <!-- END action buttons -->
            
          </form>      
CONTENT;

            return $content;


        }  


        static function build_columns_form($columnsform = array()){

            $columnsarray = self::get_columnsarray();

            if(!array_key_exists('columns',$columnsform)){
                $columnsform['columns'] = array();
            }      

            $tableS = "";
            $s = 1;
            foreach($columnsarray as $table => $values){          

                if($tableS != $table){              
                    $showdiv = 1;
                    $tableS = $table;
                } else {
                    $showdiv = 0;
                }

                $checkbox = "";
                $i = 0;
                $checkbox = "<label><input type=\"checkbox\"  onclick=\"toggleChecked(this.checked,'$table')\" table=\"$table\" style=\"width: 20px;\"> Selecteer alles / Deselecteer alles</label><br>";
                foreach($values as $key => $value){                
                    $i++;
                    $tablekey = $i."__".$key;
                    $checked = in_array($tablekey,$columnsform['columns']) ? " checked=\"checked\"" : "";
                    $checkbox .= "<label><input type=\"checkbox\" name=\"columns[]\" style=\"width: 20px;min-width:0px;\" class=\"checkbox_table\" value=\"$tablekey\" $checked> $value</label><br>";
                    $checkbox .= "<input type=\"hidden\" name=\"tablecolumn[$tablekey]\" value=\"$table\">";
                }

                if($showdiv == 1){
                    $html .= $s == 0 ? "</div>" : "";
                    $html .= "<div class=\"toggle_table\" table=\"$table\"><span class=\"icon_toggle\" id=\"icon_$table\">[+]</span> " . ucfirst(str_replace("_"," ",$table)) . "</div><div style=\"display: none;\" class=\"column_table\" id=\"$table\">";
                }

                $html .= $checkbox;

                $s = 0;
            }
            $html .= "</div><div style=\"clear:both;\"></div>";

            return $html;      

        }

        static function build_query_form($queryform = array()){

            if(array_key_exists("query",$queryform) && is_array($queryform['query'])){        

                foreach($queryform['query'] as $key => $value){        
                    $queryselect   = self::query_select($value);                        
                    $queryoperator = self::get_query_operators($value,$queryform['table'][$key], $queryform['operator'][$key], $queryform['value'][$key]);            
                    $form .= "
                    <div class=\"queryrule\">
                    $queryselect
                    <span class=\"queryoperator\">$queryoperator</span>
                    <button class=\"remove_query\">&nbsp;&nbsp;-&nbsp;&nbsp;</button>
                    </div>";

                }
                return $form;
            }

        }                                                          

        static function query_select($selected = ''){

            $queryarray = self::get_queryarray();

            $html = "
            <select name=\"query[]\" class=\"queryselect\">
            <option value=\"\">Maak een keuze</option>";
            $tableS = "";
            foreach($queryarray as $table => $values){
                foreach($values as $name => $options){
                    $isselected = $name == $selected ? " selected" : "";
                    if($tableS != $table){
                        $html .= "<option value=\"\" style=\"font-weight: bold;\">=== $table ===</option>"; 
                        $tableS = $table;
                    }
                    $html .= "<option table=\"$table\" style=\"padding-left: 10px;\" value=\"$name\"$isselected>{$options['name']}</option>"; 
                };
            }
            $html .= "</select>";

            return $html;
        }                                                        

        static function load_query($query_id,$return = "data"){

            $query = "SELECT * FROM queries WHERE id = '{$query_id}'";
            $result = query($query);
            while($row = mysql_fetch_array($result)){

                $data['query'] = unserialize($row['query']);
                $data['operator'] = unserialize($row['operator']);
                $data['value'] = unserialize($row['value']);          
                $data['tablecolumn'] = unserialize($row['tablecolunm']);
                $data['table'] = unserialize($row['table']);
                $data['columns'] = unserialize($row['columns']);
                $titel = $row['name'];          
            }

            switch($return){
                case "data": return $data;
                case "titel": return $titel;
                default:
            }

        }                                                        

        static function get_query_operators($select, $table = '', $operator = '', $inputvalue = ''){

            $queryarray = self::get_queryarray();

            $n = $operator == "" && $inputvalue == "" ? "N" : "";

            if($table != ""){

                $html .= "<select name=\"operator[]\" class=\"operatorselect$n\">";
                foreach($queryarray[$table][$select]['opt'] as $value => $name){
                    $isselected = $value == $operator ? " selected" : "";
                    $html .= "<option value=\"$value\"$isselected>$name</option>"; 
                }
                $html .= "</select>";   

                if($queryarray[$table][$select]['type'] == "TEXT"){
                    $value = $inputvalue != "" ? "value=\"$inputvalue\"" : "";
                    $html .= "<input type=\"text\" name=\"value[]\" $value class=\"queryvalue$n\">";
                } elseif($queryarray[$table][$select]['type'] == "SET"){
                    $html .= "<select name=\"value[]\" class=\"queryvalue$n\">";
                    foreach($queryarray[$table][$select]['values'] as $value => $name){
                        $isselected = $value == $inputvalue ? " selected" : "";
                        $html .= "<option value=\"$value\" $isselected>$name</option>"; 
                    }
                    $html .= "</select>";      
                } else {
                    $html .= "<input type=\"hidden\" name=\"value[]\" value=\"$inputvalue\">";
                }    

                $html .= "<input type=\"hidden\" name=\"table[]\" value=\"$table\">";

                if($queryarray[$table][$select]['opm'] != ""){
                    $html .=  "<div style=\"font-size: 12px;margin-left: 20px;font-style: italic;float:right;\">Opmerking: {$queryarray[$table][$select]['opm']}</div>";
                }
            }


            return $html;

        }                                                        


        static function build_query($data,$return = "default"){


            foreach($data['table'] as $key => $table){
                $tables[$table] = $table;
            }
            foreach($data['columns'] as $key => $table){
                $tables[$data['tablecolumn'][$table]] = $data['tablecolumn'][$table];
            }


            $query = "SELECT leerlingen.id_leerling, inschrijving.id_inschrijving, inschrijving.stroom, .inschrijving.volgnummer, ";
            foreach($data['columns'] as $key => $column){ 
                $column_ex = explode("__",$column);                             
                if($column != "" && $column_ex[1] != ""){              
                    $query .= " {$data['tablecolumn'][$column]}.{$column_ex[1]} AS {$data['tablecolumn'][$key]}{$data['tablecolumn'][$column]}_{$column_ex[1]}, ";
                }          
            }
            $query = substr($query,0,-2) . " FROM leerlingen";
            foreach($tables as $table){
                if($table != ""){
                    if($table == "leerlingen" || $table == "inschrijving") continue;
                    $idkey = $table == "loopbaan" ? "leerling_id": "id_leerling";
                    $query .= " LEFT JOIN $table ON leerlingen.id_leerling = $table.$idkey ";
                }
            }
            $query .= " LEFT JOIN inschrijving ON leerlingen.id_leerling = inschrijving.id_leerling";
            $query .= " WHERE leerlingen.id_leerling != '' AND leerlingen.deleted != '1' ";      

            if(is_array($data['query'])){
                foreach($data['query'] as $id => $queryname){
                    if($queryname != ""){
                        $value = mysql_real_escape_string($data['value'][$id]);


                        switch($data['operator'][$id]){
                            case '=':
                                $query .= " AND $queryname {$data['operator'][$id]} '{$value}'";
                                break;   
                            case '!=':
                                $query .= " AND $queryname {$data['operator'][$id]} '{$value}'";
                                break;
                            case '!=N;':
                                $query .= " AND $queryname != 'N;'";
                                break;
                            case 'BEG':
                                $query .= " AND $queryname LIKE '{$value}%'";
                                break;
                            case '!BEG':
                                $query .= " AND $queryname NOT LIKE '{$value}%'";
                                break;
                            case 'END':
                                $query .= " AND $queryname LIKE '%{$value}'";
                                break;
                            case 'CONTAIN':
                                $query .= " AND $queryname LIKE '%{$value}%'";
                                break;
                            case '!CONTAIN':
                                $query .= " AND $queryname NOT LIKE '%{$value}%'";
                                break;
                            case '<':
                                $query .= " AND $queryname < '{$value}'";
                                break;
                            case '>':
                                $query .= " AND $queryname > '{$value}'";
                                break;
                            case '>=':            
                                $query .= " AND $queryname >= '{$value}'";
                                break;
                            case '<=':
                                $query .= " AND $queryname <= '{$value}'";
                                break;
                            case 'true':
                                $query .= " AND $queryname  = 1";
                                break;
                            case 'false':
                                $query .= " AND $queryname  = 0";
                                break;
                            default: 
                                $query .= " AND $queryname = '{$data['operator'][$id]}'";
                        }
                    }
                }                                     
                $result = query($query);

                $leerlingen = array();
                while($row = mysql_fetch_assoc($result)){        
                    if(!array_key_exists($row['id_leerling'],$leerlingen)){
                        $leerlingen[$row['id_leerling']] = $row;
                    }            
                    if($row['stroom'] == "A"){
                        $leerlingen[$row['id_leerling']]['volgnummer_a'] = $row['volgnummer'];
                    } else if($row['stroom'] == "B"){
                        $leerlingen[$row['id_leerling']]['volgnummer_b'] = $row['volgnummer'];
                    }            
                }        

                switch($return){
                    case "query": return $query;
                        break;

                    case "array": 
                        return $leerlingen;
                        break;

                    case "amount" : return "<div class=\"results_found\" style=\"background-color: #E0E0E0;\"><strong>Leerlingen gevonden: " . count($leerlingen) . "</strong></div>";
                        break;

                    case "default":

                        $info .= "<div class=\"results_found\" style=\"background-color: #E0E0E0;\"><strong>Leerlingen gevonden: " . count($leerlingen) . "</strong></div>";
                        $info .= $_SESSION['gebruiker']['id'] == "2" || $_SESSION['gebruiker']['id'] == "1" ? "<div class=\"results_found\">$query</div>" : "";

                        if($data['showresults'] != ''){                                                            

                            $thead = "<thead><tr><th width=\"100\">id leerling</th><th width=\"100\">Volgnummer A Stroom</th><th width=\"100\">Volgnummer B Stroom</th>";
                            foreach($data['columns'] as $key => $column){                        
                                $column_ex = explode("__",$column);                                 
                                $column = $data['tablecolumn'][$column]."_".$column_ex[1];
                                $thead .= "<th width=\"100\">$column</th>";
                            }                    
                            $thead .= "</tr></thead>";

                            $tbody ="<tbody>";
                            foreach($leerlingen as $id_leerling => $row){
                                $tbody .= "<tr><td width=\"100\">{$row['id_leerling']}</td><td width=\"100\">{$row['volgnummer_a']}</td><td width=\"100\">{$row['volgnummer_b']}</td>";
                                foreach($data['columns'] as $key => $column){
                                    $column_ex = explode("__",$column);                                
                                    $tbody .= "<td width=\"100\">{$row[$data['tablecolumn'][$column]."_".$column_ex[1]]}</td>";
                                }
                                $tbody .= "</tr>";
                            }                    
                            $tbody .= "</tbody>";

                            $resulttbl .= "<table id=\"resulttable\">";    
                            $resulttbl .= $thead;
                            $resulttbl .= $tbody;
                            $resulttbl .= "</table>";                                  

                            return $info.$resulttbl;
                        }            
                        break;
                }  
            }
        }                                                        


        static function save_query($post, $tmp = "NO"){  

            if($post['save_as_name'] != ""){
                $query_name = $post['save_as_name'];
            } else {
                $query_name = $tmp == "YES" ? $post['send_to_ymlp_name'] : $post['query_name'];
            }


            foreach($post['value'] as $val){
                $values[] = mysql_real_escape_string($val);      
            }


            $query = serialize($post['query']);
            $operator = serialize($post['operator']);
            $columns = serialize($post['columns']);
            $tablecolumn = serialize($post['tablecolumn']);
            $table = serialize($post['table']);
            $value = serialize($values);

            $tmp = $tmp == "NO" ? "0" : "1";

            $queryInsert = "INSERT INTO queries (`name`,`query`,`operator`,`value`,`columns`,`tablecolumn`,`table`,`tmp`) VALUES ('{$query_name}','{$query}','{$operator}','{$value}','{$columns}','{$tablecolumn}','{$table}','{$tmp}')";      
            query($queryInsert);      


            return mysql_insert_id();

        }     

        static function update_query($query_id, $post){

            $query_name = $_POST['query_name'];      

            $query = serialize($post['query']);
            $operator = serialize($post['operator']);     
            $columns = serialize($post['columns']);
            $tablecolumn = serialize($post['tablecolumn']);
            $table = serialize($post['table']);
            foreach($post['value'] as $val){
                $values[] = mysql_real_escape_string($val);      
            }                

            $values = serialize($values);              


            $queryUpdate = "UPDATE queries SET       
            `name` = '{$query_name}',
            `query` = '{$query}',
            `operator` = '{$operator}',
            `value` = '{$values}',
            `columns` = '{$columns}',
            `table` = '{$table}',
            `tablecolumn` = '{$tablecolumn}'
            WHERE id = '{$query_id}'";      
            query($queryUpdate);        


        }

        static function delete_query($query_id){  
            $query = "DELETE FROM queries WHERE id = '{$query_id}'";
            query($query);  
        }       




    }  
?>
