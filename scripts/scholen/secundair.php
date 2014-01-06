<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script type="text/javascript">

</script>

<?php
  $txt = file_get_contents("secundair.txt");

  $trs = explode("</tr>",$txt);  
  
  foreach($trs as $tr){
      $a++;
      
      $tr = str_replace("<tr>","",$tr);
      
      $tds = explode("</td>",$tr);
      
      $i = 0;
      foreach($tds as $td){
          
          $td = str_replace("<td>","",$td);
          $td = str_replace("<td class=\"blauwelijn\" colspan=\"2\">","",$td);
          $td = str_replace("<td class=\"blauwelijn\">","",$td);
          
          
          switch($i){
              case 0:
                
                preg_match("/sn=([\d]+)/",$td,$matches_nr);
                $nr = $matches_nr[1];
                
                preg_match("/\">([A-Za-z0-9\s-_.!]+)/",$td,$matches_naam);                
                $naam = $matches_naam[1];
                
                preg_match("/\(([A-Za-z]+)\)/",$td,$matches_vest);
                $vestiging = $matches_vest[1];                
                
              break;
              case 1:
              
                $straat = $td;               
                                
              break;
              case 2:
              
                preg_match("/([0-9]+)/",$td,$matches_postcode);
                $postcode = $matches_postcode[1];
                
                $gemeente = trim(str_replace($postcode,"",$td)); 
                
              
              break;              
          }
          
          $scholen[$a]['nr'] = $nr;
          $scholen[$a]['naam'] = $naam;
          $scholen[$a]['vestiging'] = "($vestiging)";
          $scholen[$a]['straat'] = $straat;
          $scholen[$a]['postcode'] = $postcode;
          $scholen[$a]['gemeente'] = $gemeente;
          
          
          $i++; 
          
      }
      
  }
  
  
  echo "<pre>";
    print_r($scholen);
  echo "</pre>";
  
  
  $dbh = MyPDO::getConnection();
  
  foreach($scholen as $nr => $school){
      
      $sth = $dbh->prepare("INSERT INTO scholen_all (`instellingsnummer`,`soort`,`naam`,`type`,`straat`,`postcode`,`gemeente`) VALUES (:INR, :SOORT, :NAAM, :TYPE, :STRAAT, :POSTCODE, :GEMEENTE)");
      $sth->bindValue(":INR",$school['nr'],PDO::PARAM_STR);
      $sth->bindValue(":SOORT","secundair",PDO::PARAM_STR);
      $sth->bindValue(":NAAM",$school['naam'],PDO::PARAM_STR);
      $sth->bindValue(":TYPE",$school['vestiging'],PDO::PARAM_STR);
      $sth->bindValue(":STRAAT",$school['straat'],PDO::PARAM_STR);
      $sth->bindValue(":POSTCODE",$school['postcode'],PDO::PARAM_STR);
      $sth->bindValue(":GEMEENTE",$school['gemeente'],PDO::PARAM_STR);
      $sth->execute();
      
  }
  
  
  
  
?>

