<?php
require_once "../models/abspath.php";
require_once "pdocon.php";
require_once "function.php";

//VARIABEL YANG DI POST
$tgldari=explode("/", $_POST['dtdari']);
$dtdari=$tgldari[2]."-".$tgldari[1]."-".$tgldari[0];
$tglsampai=explode("/", $_POST['dtsampai']);
$dtsampai=$tglsampai[2]."-".$tglsampai[1]."-".$tglsampai[0];

$q = "SELECT * FROM tbmatin_hd mh LEFT JOIN tbsupplier sh ON mh.suppcd=sh.Kode_Supplier ";

if($_POST['dtdari'] != '' && $_POST['dtsampai'] != ''):
	$q .= "WHERE Date BETWEEN '$dtdari' AND '$dtsampai' ";
endif;

$sq .=  " ORDER BY Date LIMIT 20";

$rec = $pdo1->query($sql);
$rs = $rec->fetchAll(PDO::FETCH_ASSOC);

$hasil = "";
if ($rs){
	foreach ($rs as $r){
		$hasil .= $r['No']."}".ymd2dmy($r['Date'])."}".$r['Nama']."}".getWarehouse($r['Warehouse_rec'])."}".$r['ID']."}".trim($r['npwp'])."}".trim($r['Nama'])."}".mysql_real_escape_string($r['Alamat'])."}".$r['No_TPB']."~";		
	}
} else {
	$hasil .= "}Maaf,}data}tidak ditemukan}}~";
}
echo $hasil;
?>