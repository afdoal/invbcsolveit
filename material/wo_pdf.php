<?php
require_once('../models/tcpdf/config/lang/eng.php');
require_once('../models/tcpdf/tcpdf.php');
require_once "../models/abspath.php";
require_once "pdocon.php";
require_once "function.php";


$NmMenu=$_REQUEST["NmMenu"];
$title=$NmMenu." List Report";

// extend TCPF with custom functions
class MYPDF extends TCPDF {
	// create custom Header and Footer
	//Page header
	public function Header() {
		// Logo
		$image_file = K_PATH_IMAGES.'logo.png';
		$this->Image($image_file, 15, 5, 180, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B', 20);
		// Title
		//$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	}
	
	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}

	// Load table data from file
	public function LoadData($file) {
		// Read file lines
		$lines = file($file);
		$data = array();
		foreach($lines as $line) {
			$data[] = explode(';', chop($line));
		}
		return $data;
	}

	// Colored table
	public function ColoredTable($header,$data) {
		// Colors, line width and bold font
		$this->SetFillColor(255);
		$this->SetTextColor(0);
		$this->SetDrawColor(0);
		$this->SetLineWidth(0.3);
		$this->SetFont('', 'B');
		// Header
		$w = array(40, 35, 40, 45);
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
		}
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = 0;
		foreach($data as $row) {
			$this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
			$this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
			$this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
			$this->Ln();
			$fill=!$fill;
		}
		$this->Cell(array_sum($w), 0, '', 'T');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kikin Kusumah (022-7353 7575)');
$pdf->SetTitle($title);
$pdf->SetSubject($subject);
$pdf->SetKeywords($keywords);

$pdf->setPrintHeader(true);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 8);

// add a page
$pdf->AddPage();

//Data loading
$wo_id = $_REQUEST["wo_id"];

$q = "SELECT *,DATE_FORMAT(wo_date,'%d/%m/%Y') AS wo_date,DATE_FORMAT(expplan_date,'%d/%m/%Y') AS expplan_date, a.notes AS notes
	  FROM ppic_wohdr a 
	  LEFT JOIN mkt_sorderhdr b ON b.so_id=a.so_id ";
$q .= "WHERE wo_id LIKE '$wo_id' ";	  
$q .= "ORDER BY wo_no, wo_date ASC";
$runh=$pdo->query($q);	
$rsh=$runh->fetchAll(PDO::FETCH_ASSOC);


$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2,PartNo,NmBarang AS NmBarang2,HsNo AS HsNo2,Sat AS Sat2,FORMAT(qty_plan, 2) AS qty
	  FROM ppic_wodet a 
	  LEFT JOIN mst_barang b ON KdBarang = fg_id 
	  WHERE wo_id='$wo_id' 
	  ORDER BY child_no ASC";
$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);

// create some HTML content
$html = '<h2 align="center">'.$NmMenu.'</h2>'.		
		'<table>
		<tr>
		  <td width="70"><b>WO No.</b></td>
		  <td width="10"><b>:</b></td>
		  <td width="150"><b>'.$rsh[0]['wo_no'].'</b></td>
		  <td width="90"><b>WO Date</b></td>
		  <td width="10"><b>:</b></td>
		  <td width="80"><b>'.$rsh[0]['wo_date'].'</b></td>
		  <td width="60"><b></b></td>
		  <td width="10"><b></b></td>
		  <td width="100"><b></b></td>
		</tr>
		<tr>
		  <td width="70"><b>PO Cust. No.</b></td>
		  <td width="10"><b>:</b></td>
		  <td width="150"><b>'.$rsh[0]['so_no'].'</b></td>
		  <td width="90"><b>Export Plan Date</b></td>
		  <td width="10"><b>:</b></td>
		  <td width="80"><b>'.$rsh[0]['expplan_date'].'</b></td>
		  <td width="60"><b></b></td>
		  <td width="10"><b></b></td>
		  <td width="100"><b></b></td>
		</tr>
		<tr><td colspan="3"></td></tr>
		</table>'.
		'<table cellspacing="0" cellpadding="2" border="1">
		<thead>
		<tr>
		  <th align="center" width="25"><b>No.</b></th>
		  <th width="80"><b>Code</b></th>
		  <th width="80"><b>Name.</b></th>
		  <th width="150"><b>Name</b></th>
		  <th width="30"><b>Unit</b></th>
		  <th align="right"><b>Qty. Plan</b></th>
		</tr>
		</thead>
		<tbody>';
$no=1;
foreach ($rs as $r){
$html .= '<tr>'.
	  	 '<td align="center" width="25">'.$no.'</td>'.
		 '<td width="80">'.$r['KdBarang2'].'</td>'.
		 '<td width="80">'.$r['PartNo'].'</td>'.
		 '<td width="150">'.$r['NmBarang2'].'</td>'.
		 '<td width="30">'.$r['Sat2'].'</td>'.
		 '<td align="right">'.$r['qty'].'</td>'.
		 '</tr>';
$no+=1;	
}

$html .= '</tbody></table><br>&nbsp;<br>Notes : '.$rsh[0]['notes'];

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($NmMenu.'.pdf', 'I');