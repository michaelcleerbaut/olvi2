<?php
    Class School{

        static function menu(){
            $html = <<<HTML
    <div class="subtitel">Wat wil u doen?</div>

    <ul class="opties">
        <li><a href="/panel/scholen/show_all">Toon scholen</a></li>    
        <li><a href="/panel/scholen/add">Voeg een school toe</a></li>    
    </ul>
HTML;

            return $html;      
        }

        static function show_scholen(){

            $query = "SELECT * FROM scholen ORDER BY gemeente";
            $result = query($query);

            $html = "<div class=\"subtitel\">Scholen</div>";

            $html .= "<table class=\"opties\" cellspacing=\"2\" cellpadding=\"0\">";    
            while($row = mysql_fetch_assoc($result)){

                $naam = $row['naam'] != "" ? $row['naam'] : "<i>geen naam</i>";

                $html .= "<tr>";
                $html .= $_SESSION['gebruiker']['rights']['scholen']['edit'] == "YES" ? "<th class=\"left\"><a href=\"/panel/scholen/edit/{$row['id']}\">$naam</a></th>" : "<th class=\"left\">$naam</th>";
                $html .= "<td>{$row['straat']}</td>";
                $html .= "<td class=\"center\">{$row['postcode']}</td>";
                $html .= "<td class=\"center\">{$row['gemeente']}</td>";
                $html .= $_SESSION['gebruiker']['rights']['scholen']['edit'] == "YES" ? "<td class=\"center\"><a href=\"/panel/scholen/edit/{$row['id']}\">Edit</a></td>" : "";
                $html .= $_SESSION['gebruiker']['rights']['scholen']['delete'] == "YES" ? "<td class=\"center\"><a href=\"/panel/scholen/delete/{$row['id']}\" class=\"confirm\">Delete</a></td>": "";
                $html .= "</tr>";

            }
            $html .= "</table>";  
            return $html;

        }


        static function add_school(){      

            $html = <<<HTML
      
        <div class="subtitel">Voeg een nieuwe school toe</div>
        <form action="/panel/scholen" method="post">
        <input type="hidden" name="action" value="insert_school">
        <table class="formulier">
            <tr><th>Naam</th><td><input type="text" name="naam" value=""></td></tr>
            <tr><th>Straat + nr</th><td><input type="text" name="straat" value="" style="width:513px;"> <input type="text" name="nr" value="" style="width:40px;"></td></tr>
            <tr><th>Postcode + gemeente</th><td><input type="text" name="postcode" value="" style="width:80px;"> <input type="text" name="gemeente" value="" style="width:473px;"></td></tr>            
        </table>
        
HTML;

            $html .= "<div class=\"btnBig btnBigActive submit\">Opslaan</div>";
            $html .= "</form>";

            return $html;

        }

        static function edit_school($school_id){      

            $query = "SELECT * FROM scholen WHERE id = '{$school_id}'";
            $result = query($query);
            $school = mysql_fetch_object($result);

            $html = <<<HTML
      
        <div class="subtitel">Bewerk school {$school->naam}</div>
        <form action="/panel/scholen/show_all" method="post">
        <input type="hidden" name="action" value="update_school">
        <input type="hidden" name="school_id" value="{$school_id}">
        <table class="formulier">
            <tr><th>Naam</th><td><input type="text" name="naam" value="{$school->naam}"></td></tr>
            <tr><th>Straat + nr</th><td><input type="text" name="straat" value="{$school->straat}" style="width:513px;"> <input type="text" name="nr" value="{$school->nr}" style="width:40px;"></td></tr>
            <tr><th>Postcode + gemeente</th><td><input type="text" name="postcode" value="{$school->postcode}" style="width:80px;"> <input type="text" name="gemeente" value="{$school->gemeente}" style="width:473px;"></td></tr>            
        </table>
        
HTML;

            $html .= "<div class=\"btnBig btnBigActive submit\">Opslaan</div>";
            $html .= "</form>";

            return $html;

        }    


        static function insert_school($data){


            foreach($data as $key => $value){          
                $data[$key] = mysql_real_escape_string($value);          
            }

            $straat = $data['straat'] . " " . $data['nr'];      

            $query = "INSERT INTO scholen 
            (`naam`,`straat`,`postcode`,`gemeente`)
            VALUES
            ('{$data['naam']}','{$straat}','{$data['postcode']}','{$data['gemeente']}')
            ";
            query($query);

            return "<div class=\"succes\">School is succesvol aangemaakt</div>";      


        }

        static function update_school($data){


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

        static function delete_school($school_id){

            $query = "DELETE FROM scholen WHERE id = '{$school_id}'";
            query($query);

            Notification::set("success","School is succesvol verwijderd");      

        }  


    }  
?>
