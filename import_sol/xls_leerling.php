<?
$debug = "NO";
$show_table = 0;

ini_set('memory_limit', '512M');

session_start();
if($_SESSION['gebruiker']['rights']['export']['leerlingen'] != "YES"){
    header("Location: ../oops.php");
    exit;
}

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
    die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once '../app/inc/config.inc.php';
require_once '../lib/MyPDO.php';
require_once '../lib/PHPExcel/Classes/PHPExcel.php';


$dbh = new MyPDO();

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Olvi Boom")
                             ->setLastModifiedBy("Olvi Boom XLS Generator")
                             ->setTitle("Leerlingen import SOL")
                             ->setSubject("Leerlingen import SOL")
                             ->setDescription("Leerlingen import SOL")
                             ->setKeywords("office 2007 openxml php")
                             ->setCategory("SOL");


                             
include('importarrays/leerlingen.php'); // $kols_leerlingen


$sth = $dbh->query("SELECT * FROM settings WHERE name = 'huidigschooljaar'");

while($r = $sth->fetch(PDO::FETCH_ASSOC)){
    $settings[$r['name']]['value'] = $r['value'];    
    $settings[$r['name']]['value2'] = $r['value2'];    
}

      
      
$sth = $dbh->query("
    SELECT l.*, b.*, m.*, v.*, p.* FROM leerlingen l 
        LEFT JOIN loopbaan b ON l.id_leerling = b.leerling_id
        LEFT JOIN moeder m ON l.id_leerling = m.id_leerling
        LEFT JOIN vader v ON l.id_leerling = v.id_leerling
        LEFT JOIN vip p ON l.id_leerling = p.id_leerling            
        WHERE l.deleted != '1'
");
$leerlingen = array();
while($row = $sth->fetch(PDO::FETCH_ASSOC)){
    $row['schooljaar'] = $settings['huidigschooljaar']['value'];
    $leerlingen[$row['id_leerling']] = $row;
}


$table = "<table border=\"1\"><tr><th>KOL SOL</th><th>ONS</th><th>VALUE</th></tr>";

foreach($leerlingen as $id_leerling => $leerling){
    
    foreach($kols_leerlingen as $sol => $ons){
        $ons = trim($ons);
    
        if($ons != "[SKIP]"){
    
            
            if($ons != "[ADAPT]"){
                $value = $leerling[$ons];
            } else {
                $value = "";
            }

            if($ons == "inschrijving_opmerking"){
                $r = is_array(unserialize($leerling['inschrijving_opmerking'])) ? unserialize($leerling['inschrijving_opmerking']) : array();
                $value = "";
                if(array_key_exists("A",$r)){
                    $value .= $r['A'];
                }
                if(array_key_exists("B",$r)){
                    $value .= $r['B'];
                }                
            }

                
            if($show_table == 1){
                $value = strlen($value) == "0" ? "LEEEEEEEEEEEEEG" : $value;    
            }
            
            $rows[$id_leerling][$sol] = $value;
            
            $table .= "
            <tr>
                <td>$sol</td>
                <td>$ons</td>
                <td>$value</td>
            </tr>";
    
        }
    }
    
}
$table .= "</table>";


if($show_table == 1){
    echo "<pre>";
        print_r($leerlingen);    
        print_r($rows);
    echo "</pre>";
    echo $table;
    exit;
}


// kolom nummers voorbereiden
$count = 1;
$letters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
for($i = 0;$i <= 25; $i++){
    $kols[$count] = $letters[$i];
    $count++;
}
for($a = 0; $a <= 3; $a++){
    for($i = 0;$i <= 25; $i++){
        $kols[$count] = $letters[$a].$letters[$i];
        $count++;
    }
}


$row_nr = 1;
$kol_nr = 0;
foreach($rows as $id_leerling => $row){
    if($row_nr == 1){
        foreach($row as $key => $value){
            $kol_nr++;
            $cel = $kols[$kol_nr] . $row_nr;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cel, $key);            
        }        
        $kol_nr = 0;
    }
    $row_nr++;
    foreach($row as $key => $value){
        $kol_nr++;
        $cel = $kols[$kol_nr] . $row_nr;
        if(is_numeric($value)){
            $value = $value . " ";
        }
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cel, $value);
            
    }
    $kol_nr = 0;
    
}
                             

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Leerlingen');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
$filename = "leerlingen_" . date("Ymd_Hi") . ".xls";
header("Content-Disposition: attachment;filename='$filename'");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?> 