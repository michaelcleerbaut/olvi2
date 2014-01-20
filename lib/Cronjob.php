<?php
    Class Cronjob{

        var $name = "";

        var $system = SYSTEM;
        var $php_windows_location = PHP_WINDOWS_LOCATION;
        var $root_path = ROOT_PATH;
        var $crons_location = CRONS_LOCATION; 






        public function __construct($cronname = ""){

            if($cronname != ""){

                $this->name = $cronname;
                $this->get_cron_values();

            }

        }

        public function __destruct(){

        }


        public function get_cron_values(){

            $dbh = MyPDO::getConnection();

            $sth = $dbh->prepare("SELECT * FROM cronjobs WHERE name = :NAME");
            $sth->bindValue(':NAME',$this->name,PDO::PARAM_STR);
            $sth->execute();

            $c = $sth->fetch(PDO::FETCH_ASSOC);

            foreach($c as $key => $value){
                $this->$key = $value;
            }


        }     


        public function execute(){

            if($this->system == "WINDOWS"){            
                $php_location = $this->php_windows_location;
                $cron_file = $this->root_path.$this->crons_location.$this->name.".php";
                $command = "$php_location -f \"$cron_file\"";             
            } else if($this->system = "LINUX"){                
                $command = "/usr/local/bin/php " . $this->root_path.$this->crons_location.$this->name.".php";
            }
                        
            $result = shell_exec($command);
            echo $result;


        } 


        static public function find_possible_cron(){


            $cur_minute = date("i");
            $cur_hour = date("H");      
            $cur_dayofmonth = date("j");
            $cur_month = date("n");
            $cur_dayofweek = date('w');

            $cur_minute = strlen($cur_minute) == 2 && substr($cur_minute,0,1) == "0" ? substr($cur_minute,1) : $cur_minute;          
            $cur_hour = strlen($cur_hour) == 2 && substr($cur_hour,0,1) == "0" ? substr($cur_hour,1) : $cur_hour;          

            $dbh = MyPDO::getConnection();

            $query = "
            SELECT name FROM cronjobs WHERE
            (minute = :CUR_MINUTE OR minute = '*') AND
            (hour = :CUR_HOUR OR hour = '*') AND
            (day_of_month = :CUR_DAYOFMONTH OR day_of_month = '*') AND
            (month = :CUR_MONTH OR month = '*') AND
            (day_of_week = :CUR_DAYOFWEEK OR day_of_week = '*')

            ";
            $pdo_values = array(
                ":CUR_MINUTE" => $cur_minute,
                ":CUR_HOUR" => $cur_hour,
                ":CUR_DAYOFMONTH" => $cur_dayofmonth,
                ":CUR_MONTH" => $cur_month,
                ":CUR_DAYOFWEEK" => $cur_dayofweek
            );          
            $sth = $dbh->prepare($query);            
            $sth->execute($pdo_values);

            if($sth->rowCount() > 0){

                while($cron_row = $sth->fetch(PDO::FETCH_ASSOC)){

                    $cron = new Cronjob($cron_row['name']);
                    $cron->execute();

                }


            }


        }





    }
?>
