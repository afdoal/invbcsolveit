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

	$q = "SELECT *,DATE_FORMAT(matout_date,'%d/%m/%Y') AS matout_date, a.notes AS notes
		  FROM mat_outhdr a 
		  WHERE mat_type='0' ";
	if ($txtcari != ""){		  
		if ($pilcari == "matout_date"){		  
			$q .= "AND $pilcari LIKE '%".dmys2ymd($txtcari)."%' ";	  
		} else {
			$q .= "AND $pilcari LIKE '%$txtcari%' ";	  
		}
	}  
	$q .= "ORDER BY matout_no, matout_date ASC";
	
	$runtot=$pdo->query($q);
	$rstot=$runtot->fetchAll(PDO::FETCH_ASSOC);

	$q .= " LIMIT $offset,$rows";
	$run=$pdo->query($q);
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);

	$result["total"] = count($rstot);
	$result["rows"] = $rs;

	echo json_encode($result);
} else if ($req=='list') {	
	$do_id = $_REQUEST["do_id"];
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2,NmBarang AS NmBarang2,Ket,Sat AS Sat2,weight,FORMAT(a.qty, 2) AS qty,FORMAT(a.price, 4) AS price,FORMAT(a.qty*a.price, 4) AS amount
		  FROM mat_outdet a 
		  LEFT JOIN mat_outhdr b ON b.matout_id=a.matout_id
		  LEFT JOIN mst_barang c ON KdBarang = a.mat_id 		 
		  WHERE a.matout_id='$do_id' 
		  ORDER BY a.child_no ASC";
	
	$run=$pdo->query($q);	
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($rs);	  	  
} else if ($req=='so') {
	$KdBarang = $_REQUEST["KdBarang"];
	$q = "SELECT *,DATE_FORMAT(so_date,'%d/%m/%Y') AS so_date,DATE_FORMAT(due_date,'%d/%m/%Y') AS due_date
		  FROM mkt_sorderhdr a
		  INNER JOIN mkt_sorderdet b ON b.so_id=a.so_id
		  WHERE b.fg_id='$KdBarang'
		  ORDER BY so_no, so_date ASC";
	
	$run=$pdo->query($q);	
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($rs);	  	  
} else if ($req=='dgDet') {
	$so_id = $_REQUEST["so_id"];
	$do_id = $_REQUEST["do_id"];
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2,NmBarang AS NmBarang2,Ket,Sat AS Sat2,FORMAT(qty, 2) AS qty_so,FORMAT(price, 2) AS price,
		 (qty-
		 (SELECT IF(SUM(qty)>0,SUM(qty),0) FROM mkt_dodet da LEFT JOIN mkt_dohdr db ON db.do_id=da.do_id WHERE db.so_id = a.so_id AND da.fg_id = a.fg_id AND da.do_id NOT IN ('$do_id'))
		 ) AS qty_bal,
		 (qty-
		 (SELECT IF(SUM(qty)>0,SUM(qty),0) FROM mkt_dodet da LEFT JOIN mkt_dohdr db ON db.do_id=da.do_id WHERE db.so_id = a.so_id AND da.fg_id = a.fg_id AND da.do_id NOT IN ('$do_id'))
		 ) AS qty,
		 ((qty-
		 (SELECT IF(SUM(qty)>0,SUM(qty),0) FROM mkt_dodet da LEFT JOIN mkt_dohdr db ON db.do_id=da.do_id WHERE db.so_id = a.so_id AND da.fg_id = a.fg_id AND da.do_id NOT IN ('$do_id')))
		 *
		 price
		 ) AS amount
		  FROM mkt_sorderdet a 
		  LEFT JOIN mst_barang b ON KdBarang=a.fg_id
		  WHERE so_id='$so_id'
		  ORDER BY TpBarang, KdBarang ASC";
	
	$run=$pdo->query($q);	
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($rs);	  	  
} else if ($req=='dgRef') {	
	$q = "SELECT *,DATE_FORMAT(so_date,'%d/%m/%Y') AS so_date
		  FROM mkt_sorderhdr a
		  ORDER BY so_no, so_date ASC";		  
	
	$run=$pdo->query($q);	
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($rs);	  	  
} else if ($req=='dgDetFirst') {
	$key = $_REQUEST["q"];
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 25;
	$offset = ($page-1)*$rows;
	$result = array();
	
	$q = "SELECT KdBarang AS KdBarang3,KdBarang AS KdBarang2, NmBarang AS NmBarang2,Ket,Sat AS Sat2
		  FROM mst_barang  
		  WHERE TpBarang='0' ";		  
	
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
		  	  
} else if ($req=='fg'){
	$q = "SELECT *
		  FROM mst_barang WHERE TpBarang='0'
		  ORDER BY PartNo ASC";		  
		  
	$run=$pdo->query($q);	
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($rs);	  
}

?>