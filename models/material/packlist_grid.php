<?php
require_once "../abspath.php";
require_once "pdocon.php";
require_once "function.php";

$req = $_REQUEST["req"];

if ($req=='menu'){
	$pilcari = $_REQUEST["pilcari"];
	$txtcari = $_REQUEST["txtcari"];
	$q = "SELECT *,DATE_FORMAT(pack_date,'%d/%m/%Y') AS pack_date, a.notes AS notes
		  FROM mkt_packinghdr a 
		  LEFT JOIN mkt_comminvhdr b ON b.comm_id=a.comm_id
		  LEFT JOIN mkt_dohdr c ON c.do_id=b.do_id
		  LEFT JOIN mkt_sorderhdr d ON d.so_id=c.so_id ";
	if ($pilcari != ""){		  
		if ($pilcari == "pack_date"){		  
			$q .= "WHERE $pilcari LIKE '%".dmys2ymd($txtcari)."%' ";	  
		} else {
			$q .= "WHERE $pilcari LIKE '%$txtcari%' ";	  
		}
	}  
	$q .= "ORDER BY pack_no, pack_date ASC";
} else if ($req=='list') {	
	$pack_id = $_REQUEST["pack_id"];
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2, NmBarang AS NmBarang2,HsNo AS HsNo2,Sat AS Sat2,fromct,toct,FORMAT(qty, 2) AS qty,FORMAT(amount, 2) AS amount,remark
		  FROM mkt_packingdet a 
		  LEFT JOIN mst_barang b ON KdBarang = fg_id 
		  WHERE pack_id='$pack_id' 
		  ORDER BY child_no ASC";
} else if ($req=='comm') {
	$q = "SELECT *,DATE_FORMAT(comm_date,'%d/%m/%Y') AS comm_date,cust
		  FROM mkt_comminvhdr a
		  LEFT JOIN mkt_dohdr b ON b.do_id = a.do_id
		  LEFT JOIN mkt_sorderhdr c ON c.so_id = b.so_id
		  ORDER BY comm_no, comm_date ASC";
} else if ($req=='dgDet') {
	$comm_id = $_REQUEST["comm_id"];
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2, NmBarang AS NmBarang2,HsNo AS HsNo2,Sat AS Sat2, qty
		  FROM mkt_comminvdet a 
		  LEFT JOIN mst_barang b ON KdBarang=fg_id
		  WHERE comm_id='$comm_id'
		  ORDER BY TpBarang, KdBarang ASC";
} else if ($req=='dgRef') {	
	$q = "SELECT *,DATE_FORMAT(comm_date,'%d/%m/%Y') AS comm_date
		  FROM mkt_comminvhdr a
		  ORDER BY comm_no, comm_date ASC";		  
}



$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rs);
?>