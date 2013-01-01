<?php
require_once "../abspath.php";
require_once "pdocon.php";
require_once "function.php";

$req = $_REQUEST["req"];

if ($req=='menu'){
	$pilcari = $_REQUEST["pilcari"];
	$txtcari = $_REQUEST["txtcari"];
	$q = "SELECT *,DATE_FORMAT(po_date,'%d/%m/%Y') AS po_date,DATE_FORMAT(dlv_date,'%d/%m/%Y') AS dlv_date
		  FROM pur_pohdr WHERE po_type='0' ";
	if ($pilcari != ""){		  
		if ($pilcari == "po_date" || $pilcari == "dlv_date"){		  
			$q .= "AND $pilcari LIKE '%".dmys2ymd($txtcari)."%' ";	  
		} else {
			$q .= "AND $pilcari LIKE '%$txtcari%' ";	  
		}
	} 	  
	$q .= "ORDER BY po_no, po_date ASC";
} else if ($req=='list') {	
	$po_id = $_REQUEST["po_id"];
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2, NmBarang AS NmBarang2,HsNo AS HsNo2,Sat AS Sat2,FORMAT(qty, 2) AS qty,
		 (SELECT IF(SUM(qty)>0,SUM(qty),0) FROM mat_incdet ia LEFT JOIN mat_inchdr ib ON ib.matin_id=ia.matin_id WHERE ib.po_id = a.po_id AND ia.mat_id = a.mat_id)
		  AS qty_in
		  FROM pur_podet a 		  
		  LEFT JOIN mst_barang b ON KdBarang = a.mat_id 
		  WHERE po_id='$po_id' 
		  ORDER BY child_no ASC";
} else if ($req=='dgDet') {
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2, NmBarang AS NmBarang2,HsNo AS HsNo2,Sat AS Sat2
		  FROM mst_barang a 
		  LEFT JOIN mst_jenisbarang b ON KdJnsBarang=TpBarang 
		  WHERE TpBarang='1'
		  ORDER BY TpBarang, KdBarang ASC";		  
}



$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rs);
?>