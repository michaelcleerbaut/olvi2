<?php

    $execute = 1;

    ini_set('max_execution_time', 300);

    $dbh = MyPDO::getConnection();


    $sth = $dbh->query("SELECT * FROM scholen_all");        

    while($school = $sth->fetch(PDO::FETCH_ASSOC)){
        $scholen[$school['instellingsnummer']][] = $school;        
    }
    
    $scholen_new = remove_dubbles($scholen);
    echo count($scholen_new);
    
    print_r2($scholen_new);
    
    if($execute == 1) save_scholen($scholen_new);
    
    
    function remove_dubbles($scholen){
        
        foreach($scholen as $code => $potential_dubbles){

            // check if instellingsnummer has more schools            
            if(count($potential_dubbles) > 1){

                foreach($potential_dubbles as $key => $school){                    
                
                    if($school['type'] == "(vestiging)"){
                        $school['gemeente'] = clean_gemeente($school['gemeente']);
                        $return_schools[] = $school;                        
                    }                    
                }                
            } else {
                $potential_dubbles[0]['gemeente'] = clean_gemeente($potential_dubbles[0]['gemeente']);
                $return_schools[] = $potential_dubbles[0];
            }            
            
        }
        
        return $return_schools;        
    }


    function save_scholen($scholen){

        $dbh = MyPDO::getConnection();
        
        foreach($scholen as $key => $school){
            
            $sth = $dbh->prepare("INSERT INTO scholen (`code`,`soort`,`naam`,`naam_samengesteld`,`straat`,`postcode`,`gemeente`) VALUES (:CODE, :SOORT, :NAAM, :NAAM_SAMEN, :STRAAT, :POSTCODE, :GEMEENTE)");
            $sth->bindValue(":CODE",$school['instellingsnummer']);
            $sth->bindValue(":SOORT",$school['soort']);
            $sth->bindValue(":NAAM",$school['naam']);
            $sth->bindValue(":NAAM_SAMEN",$school['gemeente'] . " " . $school['naam']);
            $sth->bindValue(":STRAAT",$school['straat']);
            $sth->bindValue(":POSTCODE",$school['postcode']);
            $sth->bindValue(":GEMEENTE",$school['gemeente']);
            $sth->execute();
            
        }

    }



    function clean_gemeente($gemeente){
        $gemeenteS = explode("-",$gemeente);
        if(count($gemeenteS) > 0){
            $gemeente = "";
            foreach($gemeenteS as $deel){
                $gemeente .= ucfirst(strtolower($deel)) . " ";
            }                    
            $gemeente = substr($gemeente,0,-1);
        }

        $gemeenteS = explode(" ",$gemeente);
        if(count($gemeenteS) > 0){
            $gemeente = "";                    
            foreach($gemeenteS as $deel){
                $gemeente .= ucfirst(strtolower($deel)) . " ";
            }
            $gemeente = substr($gemeente,0,-1);
        }      
        return $gemeente;        

    }  
?>
