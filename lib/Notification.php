<?php
    Class Notification{

        
        static public function set($kind,$msg){
            $_SESSION['notifications'][] = array("kind" => $kind,"msg" => $msg);
        }

        static public function show(){

            $html = "";
            
            if(count($_SESSION['notifications']) > 0){                
                foreach($_SESSION['notifications'] as $key => $data){
                    $html .= "<div class=\"notification noti_{$data['kind']}\">{$data['msg']}</div>";                    
                }
                unset($_SESSION['notifications']);
            }
            
            return $html;

        }


    }
?>
