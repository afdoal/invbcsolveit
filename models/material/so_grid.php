<?php
require_once "../abspath.php";
require_once "pdocon.php";
require_once "function.php";

$req = $_REQUEST["req"];

if ($req=='menu'){
	$pilcari = $_REQUEST["pilcari"];
	$txtcari = $_REQUEST["txtcari"];
	$q = "SELECT *,DATE_FORMAT(so_date,'%d/%m/%Y') AS so_date,DATE_FORMAT(due_date,'%d/%m/%Y') AS due_date
		  FROM mkt_sorderhdr ";
	if ($txtcari != ""){		  
		if ($pilcari == "so_date" || $pilcari == "due_date"){		  
			$q .= "WHERE $pilcari LIKE '%".dmys2ymd($txtcari)."%' ";	  
		} else {
			$q .= "WHERE $pilcari LIKE '%$txtcari%' ";	  
		}
	}
	$q .= "ORDER BY so_no, so_date ASC";
} else if ($req=='list') {	
	$so_id = $_REQUEST["so_id"];
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2, PartNo, NmBarang AS NmBarang2,HsNo AS HsNo2,Sat AS Sat2,FORMAT(qty, 2) AS qty,FORMAT(price, 2) AS price,FORMAT(qty*price, 2) AS amount
		  FROM mkt_sorderdet a 
		  LEFT JOIN mst_barang b ON KdBarang = fg_id 
		  WHERE so_id='$so_id' 
		  ORDER BY child_no ASC";
} else if ($req=='dgDet') {
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2, PartNo, NmBarang AS NmBarang2,HsNo AS HsNo2,Sat AS Sat2
		  FROM mst_barang a 
		  LEFT JOIN mst_jenisbarang b ON KdJnsBarang=TpBarang 
		  WHERE TpBarang='0'
		  ORDER BY TpBarang, KdBarang ASC";
		  
}


$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rs);
?>