<?php 
$date = date("d/m/Y");
if($_REQUEST['cetak'] == 3){
	$file_type = "vnd.ms-excel";
	//$file_name= "somename.xls";
	header("Content-Type: application/$file_type");	
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment; filename=Laporan".$date.".xls");
	header("Expires: 0");
	header("Pragma: no-cache");
	header("Content-Transfer-Encoding: binary"); 
	
}
?>