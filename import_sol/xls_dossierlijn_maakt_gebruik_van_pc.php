<?    
    $show_table = 0;

    ini_set('memory_limit', '512M');

    session_start();
    if($_SESSION['gebruiker']['rights']['export']['dossierlijnen'] != "YES"){
        header("Location: ../oops.php");
        exit;
    }

    // INCLUDE IMPORT FUNCTIONS
    require_once('importfunctions.inc.php');
    
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
    ->setTitle("Dossierlijnen import SOL")
    ->setSubject("Dossierlijnen import SOL")
    ->setDescription("Dossierlijnen import SOL")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("SOL");


    // INCLUDE IMPORT ARRAY $kols:
    // KEY:  db hoofding in SOL
    // VALUE: 
    //      - [SKIP] -> overslaan
    //      - [ADAPT] -> nog aan te passen ([ADAPT] gevolgd met onze db hoofding)
    //      - anders gewoon onze db hoofding 
    include('importarrays/dossierlijnen.php');


    // GET DATA
    $leerlingen = get_maakt_gebruik_van_pc_data();

    
    // PARSE DATA TO XLS ARRAY
    $results = parse_results($leerlingen,$import_kols,$show_table);
    $rows = $results['rows'];
    $table = $results['table'];
    
    
    // SHOW RESULT DATA IN TABLE
    if($show_table == 1){        
        echo $table;
        exit;
    }

    // INITIALIZE KOLS
    $kols = initialize_kols();


    
    // PARSE DATA INTO EXCEL
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

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cel, utf8_encode($value));

        }
        $kol_nr = 0;

    }


    // Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle('Leerlingen');


    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);


    // Redirect output to a client’s web browser (Excel5)
    if($_GET['type'] == "CSV"){
        header('Content-Type: text/csv; charset=utf-8');
        $filename = "dossierlijnen_maakt_gebruik_van_pc_" . date("Ymd_Hi") . ".csv";
    } else {
        header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');    
        $filename = "dossierlijnen_maakt_gebruik_van_pc_" . date("Ymd_Hi") . ".xls";
    }    
    header("Content-Disposition: attachment;filename='$filename'");
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
?>