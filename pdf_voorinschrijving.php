<?php

require_once('lib/tcpdf/config/lang/eng.php');
require_once('lib/tcpdf/tcpdf.php');

require_once('app/inc/mysql.functions.inc.php');
                                       
                      
  $query = "
    SELECT l.*, i.*, c.*, o.studiekeuze, a.uur, a.dag FROM inschrijving i
        INNER JOIN leerlingen l ON i.id_leerling = l.id_leerling
        LEFT JOIN communicatie c ON i.id_leerling = c.id_leerling
        LEFT JOIN afspraken a ON i.id_leerling = a.id_leerling
        LEFT JOIN loopbaan o ON i.id_leerling = o.leerling_id
    WHERE i.id_inschrijving = '{$id_inschrijving}'
  ";
  $result = query($query);
  $leerling = mysql_fetch_assoc($result);

  $huidigschooljaar = $leerling['schooljaar'];
  
/*
    $query = "SELECT * FROM settings WHERE name = 'huidigschooljaar'";
    $result = query($query);
    if(mysql_num_rows($result) == 0){
        $huidigschooljaar = date("m") > 7 ? date("Y") . " - " . (date("Y") + 1) : (date("Y") - 1) . " - " . date("Y");
    } else{
        while($row = mysql_fetch_assoc($result)){
            if($row['value'] == "nvp"){
                $huidigschooljaar = date("m") > 7 ? date("Y") . " - " . (date("Y") + 1) : (date("Y") - 1) . " - " . date("Y");
            } else {
                $huidigschooljaar = $row['value'];
            }
        }
    }
*/
           
    $busnummer = $leerling['busnummer'] != "" ? " bus {$leerling['busnummer']}" : "";
    
  $stroom_andere = $leerling['stroom'] == "A" ? "B" : "A";
  
  $query = "SELECT volgnummer, stroom FROM inschrijving WHERE id_leerling = '{$leerling['id_leerling']}' AND stroom = '{$stroom_andere}'";  
  $result = query($query);  
  if(mysql_num_rows($result) == 0){      
      $volgnummer_andere = "";      
  } else {
      while($row = mysql_fetch_assoc($result)){                
          $volgnummer_andere = $row['volgnummer'];          
      }
  }
  
  $volgnummerA = $leerling['stroom'] == "A" ? $leerling['volgnummer'] : $volgnummer_andere;
  $volgnummerB = $leerling['stroom'] == "B" ? $leerling['volgnummer'] : $volgnummer_andere;
  
  
  $volgnummerB = $leerling['stroom'] == "A" ? "" : $volgnummerB;
  
  if($leerling['dag'] == "tel"){
      $afspraak = "U wil graag telefonisch een afspraak maken";   
  } else if ($leerling['dag'] == "broerofzus"){
      $afspraak = "U heeft reeds een afspraak gemaakt (met een broer of zus)";   
  } else {
      $uur = str_replace(":",".",$leerling['uur']);
      $afspraak = "<table><tr><td>U heeft een afspraak op<br><br>{$leerling['dag']} mei 2013 om $uur u</td></tr></table>";   
  }
  
  $tr_volgnummer_a = $volgnummerA != "" ? "<tr><td style=\"width:150px;\">Volgnummer A-Stroom:</td><td align=\"right\"><strong>$volgnummerA</strong></td></tr>" : "";
  $title_volgnummerA = $volgnummerA != "" ? "Volgnummer A-Stroom" : "";
  
  $tr_volgnummer_b = $volgnummerB != "" ? "<tr><td style=\"width:150px;\">Volgnummer B-Stroom:</td><td align=\"right\"><strong>$volgnummerB</strong></td></tr>" : "";
  $title_volgnummerB = $volgnummerB != "" ? "Volgnummer B-Stroom" : "";
  

  $studiekeuze = "";
  if($leerling['stroom'] == "A"){
      $studiekeuze = unserialize($leerling['studiekeuze']);      
      $studiekeuze = $studiekeuze['A'];
      if($studiekeuze != ""){
        $studiekeuze = "<tr><td>Studiekeuze</td><td>$studiekeuze</td></tr>";
      }
  }  
  
                                                             
class MYPDF extends TCPDF {
    
    public function Header() {        
/*
        global $title_volgnummerA, $title_volgnummerB, $volgnummerA, $volgnummerB;
        
        $header = <<<HEADER
                
        <table width="100%" style="border-bottom: solid thin #000000;">
            <tr>
                <td width="300">
                    <table>
                        <tr><td>OLVI-MIDDENSCHOOL BOOM</td></tr>
                        <tr><td>Brandstraat 44</td></tr>
                        <tr><td>2850 Boom</td></tr>
                    </table>
                </td>
                <td width="150">                
                       <img src="/public/img/olvi_logo.png" width="60">
                </td>
                <td width="150">
                    $title_volgnummerA<br>
                    $title_volgnummerB
                </td>
                <td width="40" align="right">                    
                    $volgnummerA <br>
                    $volgnummerB
                </td>
            </tr>
            <tr>
             <td> </td>
             <td></td>
             <td></td>
             <td></td>
            </tr>
        </table>
                  
 */                 
      
        
HEADER;
        
//        $this->writeHTML($header, true, false, true, false, '');
    }

    //Page header
    public function Footer() {
        $footer = <<<FOOTER
        
            <div style="border-top-style: solid thin #000000;height:2px;text-align:right;">12/12/2012</div>
        
        
FOOTER;
        
        $this->writeHTML($footer, true, false, true, false, '');
    }
    
    
}                  
// create new PDF document
$pdf = new MYPDF('portait', PDF_UNIT, 'A4', true, 'UTF-8', false);

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, "3", PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();




// define some HTML content with style
$html = <<<EOF


        <table width="100%" style="border-bottom: solid thin #000000;">
            <tr>
                <td width="300">
                    <table>
                        <tr><td>OLVI-MIDDENSCHOOL BOOM</td></tr>
                        <tr><td>Brandstraat 44</td></tr>
                        <tr><td>2850 Boom</td></tr>
                    </table>
                </td>
                <td width="150">                
                       <img src="public/img/olvi_logo.jpg" width="60">
                </td>                
                <td width="150">
                    $title_volgnummerA<br>
                    $title_volgnummerB
                </td>
                <td width="40" align="right">                    
                    $volgnummerA <br>
                    $volgnummerB
                </td>
            </tr>
            <tr>
             <td> </td>
             <td></td>
             <td></td>
             <td></td>
            </tr>
        </table>
                  
<h2 style="text-align:center;">Bewijs van voorinschrijving voor het schooljaar <?=$huidigschooljaar;?></h2>


<h4>Gegevens die u tijdens de voorinschrijvingsprocedure ingevuld heeft.</h4>
<h5 style="margin-top:30px;">Persoonlijke gegevens</h5>

<div style="border: solid thin #000;width:668px;">
  <table cellpadding="10">
    <tr><td style="width:250px;">Naam</td><td>{$leerling['naam']} {$leerling['voornaam']}</td></tr>
    <tr><td>Straat + nr</td><td>{$leerling['straat']} {$leerling['huisnummer']}  {$busnummer}</td></tr>
    <tr><td>Postcode + gemeente</td><td>{$leerling['postcode']} {$leerling['plaats']}</td></tr>
    <tr><td>Lagere school</td><td>{$leerling['school_vorig_schooljaar']}</td></tr>
    $studiekeuze
  </table>
</div>



<h5>Communicatiegegevens</h5>
<div style="border: solid thin #000;width:668px;">
  <table cellpadding="10">
    <tr><td style="width:250px;">Telefoon</td><td>{$leerling['telefoon']}</td></tr>
    <tr><td>Email</td><td>{$leerling['email']}</td></tr>
  </table>
</div>


<div style="height:50px;"></div>

<div style="border: solid thin #000;width:668px;text-align:center;">
  <table cellpadding="20">
    <tr>
        <td>
            $afspraak
        </td>
    </tr>
  </table>
</div>

<div style="height:50px;"></div>

<div>
    <strong>Wat mag u zeker niet vergeten mee te brengen naar uw afspraak?</strong><br>

    <ul>
        <li>Dit document</li>
        <li>SIS-kaart en/of identiteitskaart van uw zoon/dochter</li>
    </ul>
</div>

                                             

EOF;


$pdf->writeHTML($html, true, false, true, false, '');

$pdf->lastPage();

$filename = "voorinschrijving_{$id_inschrijving}";
$filename = base64_encode($filename);
$pdf->Output("data/pdfs/{$filename}.pdf", 'F'); // E = email atttachment, F = save
