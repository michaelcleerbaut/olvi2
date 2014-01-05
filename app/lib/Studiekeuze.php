<?php
    Class Studiekeuze{

        static function menu(){
            $html = <<<HTML
        <div class="subtitel">Wat wil u doen?</div>

        <ul class="opties">
            <li><a href="/panel/studiekeuzes/show_all">Toon Studiekeuzes</a></li>    
            <li><a href="/panel/studiekeuzes/add">Voeg een studiekeuze toe</a></li>    
        </ul>
HTML;
            return $html;
        }

        static function show_studiekeuzes(){

            $query = "SELECT * FROM studiekeuzes ORDER BY afkorting";
            $result = query($query);

            $html = "<div class=\"subtitel\">Studiekeuzes</div>";

            $html .= "<table class=\"opties\" cellspacing=\"2\" cellpadding=\"0\">";    
            while($row = mysql_fetch_assoc($result)){

                $html .= "<tr>";
                $html .= $_SESSION['gebruiker']['rights']['studiekeuzes']['edit'] == "YES" ? "<th class=\"left\"><a href=\"/panel/studiekeuzes/edit/{$row['id_studiekeuze']}\">{$row['afkorting']} - {$row['studiekeuze']}</a></th>" : "<th class=\"left\">{$row['afkorting']} - {$row['studiekeuze']}</th>";                        
                $html .= $_SESSION['gebruiker']['rights']['studiekeuzes']['edit'] == "YES" ? "<td class=\"center\"><a href=\"/panel/studiekeuzes/edit/{$row['id_studiekeuze']}\">Edit</a></td>" : "";
                $html .= $_SESSION['gebruiker']['rights']['studiekeuzes']['delete'] == "YES" ? "<td class=\"center\"><a href=\"/panel/studiekeuzes/delete/{$row['id_studiekeuze']}\" class=\"confirm\">Delete</a></td>": "";
                $html .= "</tr>";

            }
            $html .= "</table>";  
            return $html;

        }


        static function add_studiekeuze(){      

            $html = <<<HTML
      
        <div class="subtitel">Voeg een nieuwe studiekeuze toe</div>
        <form action="/panel/studiekeuzes/show_all" method="post">
        <input type="hidden" name="action" value="insert_studiekeuze">
        <table class="formulier">
            <tr><th>Studiekeuze</th><td><input type="text" name="studiekeuze" value=""></td></tr>
            <tr><th>Afkorting</th><td><input type="text" name="afkorting" value=""></td></tr>            
        </table>
        
HTML;

            $html .= "<div class=\"btnBig btnBigActive submit\">Opslaan</div>";
            $html .= "</form>";

            return $html;

        }

        static function edit_studiekeuze($studiekeuze_id){      

            $query = "SELECT * FROM studiekeuzes WHERE id_studiekeuze = '{$studiekeuze_id}'";
            $result = query($query);
            $studiekeuze = mysql_fetch_object($result);

            $html = <<<HTML
      
        <div class="subtitel">Bewerk studiekeuze {$studiekeuze->naam}</div>
        <form action="/panel/studiekeuzes/show_all" method="post">
        <input type="hidden" name="action" value="update_studiekeuze">
        <input type="hidden" name="studiekeuze_id" value="{$studiekeuze_id}">
        <table class="formulier">
            <tr><th>Studiekeuze</th><td><input type="text" name="studiekeuze" value="{$studiekeuze->studiekeuze}"></td></tr>            
            <tr><th>Afkorting</th><td><input type="text" name="afkorting" value="{$studiekeuze->afkorting}"></td></tr>            
        </table>
        
HTML;

            $html .= "<div class=\"btnBig btnBigActive submit\">Opslaan</div>";
            $html .= "</form>";

            return $html;

        }    


        static function insert_studiekeuze($data){


            foreach($data as $key => $value){          
                $data[$key] = mysql_real_escape_string($value);          
            }

            $query = "INSERT INTO studiekeuzes 
            (`studiekeuze`,`afkorting`)
            VALUES
            ('{$data['studiekeuze']}','{$data['afkorting']}')
            ";
            query($query);

            return "<div class=\"succes\">Studiekeuze is succesvol aangemaakt</div>";      


        }

        static function update_studiekeuze($data){


            foreach($data as $key => $value){
                $data[$key] = mysql_real_escape_string($value);
            }

            $query = "UPDATE studiekeuzes SET
            `studiekeuze` = '{$data['studiekeuze']}',                                
            `afkorting` = '{$data['afkorting']}'
            WHERE id_studiekeuze = '{$data['studiekeuze_id']}'                
            ";
            query($query);

            return "<div class=\"succes\">Studiekeuze is succesvol aangepast</div>";

        }


        static function delete_studiekeuze($id_studiekeuze){

            $query = "DELETE FROM studiekeuzes WHERE id_studiekeuze = '{$id_studiekeuze}'";
            query($query);
            
            Notification::set("success","Studiekeuze is succesvol verwijderd");      

        }  


    }  
?>
