<?php
require_once "../models/abspath.php";
require_once "pdocon.php";
require_once "function.php";

//VARIABEL YANG DI POST
$tgldari=explode("/", $_POST['dtdari']);
$dtdari=$tgldari[2]."-".$tgldari[1]."-".$tgldari[0];
$tglsampai=explode("/", $_POST['dtsampai']);
$dtsampai=$tglsampai[2]."-".$tglsampai[1]."-".$tglsampai[0];

$q = "SELECT *,doh.Number AS dohno,c.Number AS cno FROM tbdelorder_hd doh LEFT JOIN tbcustomer c ON c.Customer_Code=doh.Buyer ";

if($_POST['dtdari'] != '' && $_POST['dtsampai'] != ''):
	$q .= "WHERE Tanggal BETWEEN '$dtdari' AND '$dtsampai' ";
endif;

$q .=  "ORDER BY Tanggal LIMIT 20";

$rec = $pdovb->query($q);
$rs = $rec->fetchAll(PDO::FETCH_ASSOC);

$hasil = "";
if ($rs){
	foreach ($rs as $r){
		$hasil .= $r['ID']."}".$r['Tanggal']."}".$r['Customer_Name']."}".number_format($r['Total_qty'])."}".$r['ID']."}".$r['cno']."}".$r['NPWP']."}".$r['Customer_Name']."}".$r['Address']."}".$r['TPB']."~";		
	}
} else {
	$hasil .= "}Maaf,}data}tidak ditemukan}}~";
}
echo $hasil;
?>