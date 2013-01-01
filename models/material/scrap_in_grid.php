<?php
require_once "../abspath.php";
require_once "pdocon.php";
require_once "function.php";

$req = $_REQUEST["req"];

if ($req=='menu'){
	$pilcari = $_REQUEST["pilcari"];
	$txtcari = $_REQUEST["txtcari"];
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 25;
	$offset = ($page-1)*$rows;
	$result = array();

	$q = "SELECT *,DATE_FORMAT(matin_date,'%d/%m/%Y') AS matin_date
		  FROM mat_inchdr a 
		  LEFT JOIN mst_in_type c ON c.matin_type=a.matin_type
		  WHERE a.mat_type='12' ";
	if ($txtcari != ""){		  
		if ($pilcari == "matin_date"){		  
			$q .= "AND $pilcari LIKE '%".dmys2ymd($txtcari)."%' ";	  
		} else {
			$q .= "AND $pilcari LIKE '%$txtcari%' ";	  
		}
	} 	  
	$q .= "ORDER BY matin_no, matin_date ASC";
	
	$runtot=$pdo->query($q);
	$rstot=$runtot->fetchAll(PDO::FETCH_ASSOC);

	$q .= " LIMIT $offset,$rows";
	$run=$pdo->query($q);
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);

	$result["total"] = count($rstot);
	$result["rows"] = $rs;

	echo json_encode($result);

} else if ($req=='list') {	
	$matin_id = $_REQUEST["matin_id"];
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2, NmBarang AS NmBarang2,twhmp,HsNo AS HsNo2,Sat AS Sat2,FORMAT(qty, 2) AS qty,FORMAT(price, 2) AS price,FORMAT(qty*price, 2) AS amount
		  FROM mat_incdet a 
		  LEFT JOIN mst_barang b ON KdBarang = mat_id 
		  WHERE matin_id='$matin_id' 
		  ORDER BY child_no ASC";
	
	$run=$pdo->query($q);	
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($rs);
} else if ($req=='dgDet') {
	$po_id = $_REQUEST["po_id"];
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2, NmBarang AS NmBarang2,HsNo AS HsNo2,Sat AS Sat2,FORMAT(qty, 2) AS qty,FORMAT(price, 2) AS price,FORMAT(qty*price, 2) AS amount
		  FROM pur_podet a 
		  LEFT JOIN mst_barang b ON KdBarang = mat_id 
		  WHERE po_id='$po_id' 
		  ORDER BY child_no ASC";
		  
	$run=$pdo->query($q);	
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($rs);	  
} else if ($req=='dgDetFirst') {
	$key = $_REQUEST["q"];
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 25;
	$offset = ($page-1)*$rows;
	$result = array();
	
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2, NmBarang AS NmBarang2,twhmp,HsNo AS HsNo2,Sat AS Sat2
		  FROM mst_barang  
		  WHERE TpBarang='12' ";		  
	
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
	
} else if ($req=='dgRef') {	
	$q = "SELECT *,DATE_FORMAT(po_date,'%d/%m/%Y') AS po_date,DATE_FORMAT(dlv_date,'%d/%m/%Y') AS dlv_date
		  FROM pur_pohdr WHERE po_type='0' ";
	$q .= "ORDER BY po_no, po_date ASC";		  
	
	$run=$pdo->query($q);	
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($rs);
}
?>