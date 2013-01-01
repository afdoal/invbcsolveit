<?php
require_once('../models/tcpdf/config/lang/eng.php');
require_once('../models/tcpdf/tcpdf.php');
require_once "../models/abspath.php";
require_once "pdocon.php";


$NmMenu=$_REQUEST["NmMenu"];
$title=$NmMenu." List Report";

// extend TCPF with custom functions
class MYPDF extends TCPDF {
	
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

$pdf->setPrintHeader(false);

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
$pdf->SetTopMargin(15);

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
$q = "SELECT *,KdBarang AS KdBarang0,FORMAT(Harga, 2) AS Harga FROM mst_barang a LEFT JOIN mst_jenisbarang b ON KdJnsBarang=TpBarang ORDER BY TpBarang, KdBarang ASC";
$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);

// create some HTML content
$html = '<h2>'.$NmMenu.'</h2>
		<table cellspacing="0" cellpadding="2" border="1" width="600">
		<thead>
		<tr>
		  <th align="center" width="25"><b>No.</b></th>
		  <th><b>Jenis Barang</b></th>
		  <th><b>Kode Barang</b></th>
		  <th width="100"><b>Nama Barang</b></th>
		  <th><b>HS No.</b></th>
		  <th width="40"><b>Satuan</b></th>
		  <th align="right"><b>Harga</b></th>
		  <th width="150"><b>Keterangan</b></th>
		</tr>
		</thead>
		<tbody>';
$no=1;
foreach ($rs as $r){
$html .= '<tr>'.
	  	 '<td align="center" width="25">'.$no.'</td>'.
		 '<td>'.$r['JnsBarang'].'</td>'.
		 '<td>'.$r['KdBarang'].'</td>'.
		 '<td width="100">'.$r['NmBarang'].'</td>'.
		 '<td>'.$r['HsNo'].'</td>'.
		 '<td width="40">'.$r['Sat'].'</td>'.
		 '<td align="right">'.$r['Harga'].'</td>'.
		 '<td width="150">'.$r['Ket'].'</td>'.
		 '</tr>';
$no+=1;	
}

$html .= '</tbody></table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($NmMenu.'.pdf', 'I');