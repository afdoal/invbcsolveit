<?php
require_once "../abspath.php";
require_once "pdocon.php";
require_once "function.php";

$req = $_REQUEST["req"];

if ($req=='menu'){
	$pilcari = $_REQUEST["pilcari"];
	$txtcari = $_REQUEST["txtcari"];
	$q = "SELECT *,DATE_FORMAT(comm_date,'%d/%m/%Y') AS comm_date
		  FROM mkt_comminvhdr a 
		  LEFT JOIN mkt_dohdr b ON b.do_id=a.do_id
		  LEFT JOIN mkt_sorderhdr c ON c.so_id=b.so_id ";
	if ($pilcari != ""){		  
		if ($pilcari == "comm_date"){		  
			$q .= "WHERE $pilcari LIKE '%".dmys2ymd($txtcari)."%' ";	  
		} else {
			$q .= "WHERE $pilcari LIKE '%$txtcari%' ";	  
		}
	}  
	$q .= "ORDER BY comm_no, comm_date ASC";
} else if ($req=='list') {	
	$comm_id = $_REQUEST["comm_id"];
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2, NmBarang AS NmBarang2,HsNo AS HsNo2,Sat AS Sat2,FORMAT(qty, 2) AS qty,FORMAT(price, 2) AS price,FORMAT(qty*price, 2) AS amount
		  FROM mkt_comminvdet a 
		  LEFT JOIN mst_barang b ON KdBarang = fg_id 
		  WHERE comm_id='$comm_id' 
		  ORDER BY child_no ASC";
} else if ($req=='do') {
	$q = "SELECT *,DATE_FORMAT(do_date,'%d/%m/%Y') AS do_date,cust
		  FROM mkt_dohdr a
		  LEFT JOIN mkt_sorderhdr b ON b.so_id = a.so_id
		  ORDER BY do_no, do_date ASC";
} else if ($req=='dgDet') {
	$do_id = $_REQUEST["do_id"];
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2, NmBarang AS NmBarang2,HsNo AS HsNo2,Sat AS Sat2, qty
		  FROM mkt_dodet a 
		  LEFT JOIN mst_barang b ON KdBarang=fg_id
		  WHERE do_id='$do_id'
		  ORDER BY TpBarang, KdBarang ASC";
} else if ($req=='dgRef') {	
	$q = "SELECT *,DATE_FORMAT(do_date,'%d/%m/%Y') AS do_date
		  FROM mkt_dohdr a
		  ORDER BY do_no, do_date ASC";		  
}



$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rs);
?>