<?php
require_once "../abspath.php";
require_once "pdocon.php";

$req = $_REQUEST["req"];

if ($req=='menu'){
	$pilcari = $_REQUEST["pilcari"];
	$txtcari = $_REQUEST["txtcari"];
	$q = "SELECT matcon_id AS KdBarang,PartNo,NmBarang,HsNo,Sat,Treatment,Ket,cust
		  FROM ppic_fgmatcon a
		  LEFT JOIN mst_barang b ON KdBarang=matcon_id ";
	if ($txtcari != "")		  
		$q .= "WHERE $pilcari LIKE '%$txtcari%' ";	  
	$q .= "ORDER BY KdBarang ASC";
} else if ($req=='dgMst'){
	$q = "SELECT *
		  FROM mst_barang a 
		  LEFT JOIN mst_jenisbarang b ON KdJnsBarang=TpBarang 
		  WHERE TpBarang='0' ";
	if ($txtcari2 != "")		  
		$q .= "AND $pilcari2 LIKE '%$txtcari2%' ";	  
	$q .= "ORDER BY TpBarang, KdBarang ASC";
} else if ($req=='dgDet') {
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2, NmBarang AS NmBarang2,HsNo AS HsNo2,Sat AS Sat2
		  FROM mst_barang a 
		  LEFT JOIN mst_jenisbarang b ON KdJnsBarang=TpBarang 
		  WHERE TpBarang='1'
		  ORDER BY TpBarang, KdBarang ASC";
} else if ($req=='list') {	
	$KdBarang0 = $_REQUEST["KdBarang0"];
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2, NmBarang AS NmBarang2,HsNo AS HsNo2,Sat AS Sat2,FORMAT(qty, 2) AS qty
		  FROM ppic_fgmatcon a 
		  LEFT JOIN mst_barang b ON KdBarang = mat_id
		  WHERE matcon_id='$KdBarang0'
		  ORDER BY child_no ASC";
}



$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rs);
?>