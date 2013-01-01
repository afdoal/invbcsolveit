<?php
require_once "../abspath.php";
require_once "pdocon.php";
require_once "function.php";

$req = $_REQUEST["req"];
$type = $_REQUEST["type"];

if ($req=='menu'){	
	$pilcari = $_REQUEST["pilcari"];
	$txtcari = $_REQUEST["txtcari"];
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 25;
	$offset = ($page-1)*$rows;
	$result = array();
	
	$q = "SELECT DISTINCT a.wh_id,wh_name,DATE_FORMAT(date,'%d/%m/%Y') AS date
		  FROM mat_stockcard a 
		  LEFT JOIN mat_warehouse b ON b.wh_id=a.wh_id 
		  WHERE type='$type' AND mat_type='11' ";
	if ($txtcari != ""){		  
		if ($pilcari == "date"){		  
			$q .= "AND $pilcari LIKE '%".dmys2ymd($txtcari)."%' ";	  
		} else {
			$q .= "AND $pilcari LIKE '%$txtcari%' ";	  
		}
	}
	$q .= "ORDER BY wh_name, date ASC";
	
	$runtot=$pdo->query($q);
	$rstot=$runtot->fetchAll(PDO::FETCH_ASSOC);

	$q .= " LIMIT $offset,$rows";
	$run=$pdo->query($q);
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);

	$result["total"] = count($rstot);
	$result["rows"] = $rs;

	echo json_encode($result);

} else if ($req=='dgDet') {
	$key = $_REQUEST["q"];
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 25;
	$offset = ($page-1)*$rows;
	$result = array();

	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2,NmBarang AS NmBarang2,Ket,Sat AS Sat2
		  FROM mst_barang a 
		  LEFT JOIN mst_jenisbarang b ON KdJnsBarang=TpBarang 
		  WHERE TpBarang='11' ";
	
	if ($key != ''){
		$q .= " AND (KdBarang LIKE '%$key%' OR NmBarang LIKE '%$key%') ";
	}	 
	 
	$q .= "ORDER BY KdBarang ASC";
	
	$runtot=$pdo->query($q);
	$rstot=$runtot->fetchAll(PDO::FETCH_ASSOC);

	$q .= " LIMIT $offset,$rows";
	$run=$pdo->query($q);
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);

	$result["total"] = count($rstot);
	$result["rows"] = $rs;

	echo json_encode($result);	  
		  
} else if ($req=='list') {	
	$wh_id = $_REQUEST["wh_id"];
	$date = dmys2ymd($_REQUEST["date"]);
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2,NmBarang AS NmBarang2,Ket,weight,Sat AS Sat2,FORMAT(qty, 2) AS qty,remark
		  FROM mst_barang a 
		  LEFT JOIN mat_stockcard b ON mat_id = KdBarang 
		  WHERE TpBarang='11' AND wh_id='$wh_id' AND date='$date' AND type='$type'
		  ORDER BY mat_id ASC";
		  
	$run=$pdo->query($q);	
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($rs);	  
}

?>