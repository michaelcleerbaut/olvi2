<?php
  Class Template{
      
      public $tpl = "";
      
      
      public function __construct($tpl){
          $this->tpl = $tpl;
      }
      
      
      public static function view($tpl,$vars = array()){          
          
          if(is_array($vars) && count($vars) > 0){
              foreach($vars as $key => $value){
                  $$key = $value;
              }
          }
          
          include(VIEW_PATH."/".$tpl.".php");
          
      }
      
      public function render(){
          self::view($this->tpl, $this->vars);
      }
      
      public function set($var,$value){
          $this->vars[$var] = $value;
      }
            
  }
?>
