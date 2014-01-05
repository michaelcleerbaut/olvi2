<?php
  class MyPDO extends PDO
  {
      protected static $db;

      public function __construct(){
          parent::__construct(DB_DRIVER.':dbname='.DB_DB.';host='.DB_HOST, DB_USER, DB_PASS);
      }

      public static function getConnection(){
          if(!self::$db){
              self::$db = new MyPDO;
          }
          return self::$db;
      }
  }
?>
