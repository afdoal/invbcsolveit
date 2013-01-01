<?php
require_once "../abspath.php";
require_once "pdocon.php";
require_once "function.php";

$req = $_REQUEST["req"];

if ($req=='menu'){
	$pilcari = $_REQUEST["pilcari"];
	$txtcari = $_REQUEST["txtcari"];
	$q = "SELECT *,DATE_FORMAT(po_date,'%d/%m/%Y') AS po_date,DATE_FORMAT(dlv_date,'%d/%m/%Y') AS dlv_date
		  FROM pur_pohdr WHERE po_type='1' ";
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
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2, NmBarang AS NmBarang2,HsNo AS HsNo2,Sat AS Sat2,FORMAT(qty, 2) AS qty,FORMAT(price, 2) AS price,FORMAT(qty*price, 2) AS amount
		  FROM pur_podet a 
		  LEFT JOIN mst_barang b ON KdBarang = mat_id 
		  WHERE po_id='$po_id' 
		  ORDER BY child_no ASC";
} else if ($req=='dgDet') {
	$po_id = $_REQUEST["po_id"];
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2, NmBarang AS NmBarang2,HsNo AS HsNo2,Sat AS Sat2,FORMAT(qty, 2) AS qty,FORMAT(price, 2) AS price,FORMAT(qty*price, 2) AS amount
		  FROM pur_podet a 
		  LEFT JOIN mst_barang b ON KdBarang = mat_id 
		  WHERE po_id='$po_id' 
		  ORDER BY child_no ASC";
} else if ($req=='dgRef') {	
	$q = "SELECT *,DATE_FORMAT(po_date,'%d/%m/%Y') AS po_date,DATE_FORMAT(dlv_date,'%d/%m/%Y') AS dlv_date
		  FROM pur_pohdr WHERE po_type='0' ";
	$q .= "ORDER BY po_no, po_date ASC";		  
}



$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rs);
?>