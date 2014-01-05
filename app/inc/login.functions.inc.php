<?php
    function try_login($data){
        $gebruiker = strtolower($data['gebruiker']);
        $query = "SELECT * FROM gebruikers WHERE gebruiker = '{$gebruiker}' AND wachtwoord = '{$data['wachtwoord']}'";
        $result = query($query);
        if(mysql_num_rows($result) > 0){
            $user = mysql_fetch_object($result);

            login($user);        

        } else {
            $errorlogin = 1;
        }        
        return $errorlogin;      
    }

    function login_from_cookie(){
        $query = "SELECT * FROM gebruikers WHERE id = '{$_COOKIE['gebruiker']}'";
        $result = query($query);
        $user = mysql_fetch_object($result);        

        login($user);
    }


    function login($user){
        
        $expire = time()+60*60*24*30;
        setcookie("gebruiker", $user->id, $expire);

        $_SESSION['gebruiker']['id'] = $user->id;
        $_SESSION['gebruiker']['naam'] = $user->gebruiker;                                                                                                

        $rightsarray = json_decode($user->rights);

        foreach($rightsarray as $key => $rights){
            foreach($rights as $right => $value){
                $_SESSION['gebruiker']['rights'][$key][$right] = $value;
            }
        }


    }

?>
