<?php
require_once "../../models/abspath.php";
require_once "pdocon.php";
require_once "function.php";

$req = $_REQUEST["req"];
$CAR = $_REQUEST["CAR"];
$matoutdo_id = "RMO-00013";

if ($req=='dg'){
	$q = "SELECT *,DATE_FORMAT(DokTg,'%d/%m/%Y') AS DokTgDmy FROM dokumen ";
	$q .= "WHERE DokKdBc='5' AND CAR='$CAR' ORDER BY no";		
	
	$run=$pdo->query($q);
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($rs);
} else if ($req=='dg2'){
	$q = "SELECT * FROM barang ";
	$q .= "WHERE DokKdBc='5' AND CAR='$CAR' ORDER BY no";
	
	$run=$pdo->query($q);
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($rs);
	
} else if ($req=='inhdr'){
	$NmTuj = $_REQUEST["NmTuj"];
	
	$key = $_REQUEST["q"];
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 25;
	$offset = ($page-1)*$rows;
	$result = array();
		  
	$q = "SELECT a.*,c.*,DATE_FORMAT(matin_date,'%d/%m/%Y') AS matin_date
		  FROM mat_inchdr a 
		  LEFT JOIN mst_in_type c ON c.matin_type=a.matin_type 
		  WHERE KdJnsDok='5' AND supplier='$NmTuj'  ";	  
	
	if ($key != ''){
		$q .= "AND matin_no LIKE '%$key%' ";
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
	
} else if ($req=='indet'){	
	$matin_id = $_REQUEST["matin_id"];
	$q = "SELECT KdBarang, NmBarang AS UrBarang, FORMAT(qty, 2) AS qty,FORMAT((qty*price), 2) AS HrgSerah
		  FROM mat_incdet a 
		  LEFT JOIN mst_barang b ON KdBarang = mat_id 
		  WHERE matin_id='$matin_id' 
		  ORDER BY child_no ASC";
		  
	$run=$pdo->query($q);
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($rs);
	
} else if ($req=='dg3'){
	$q = "SELECT * FROM barangkembali ";
	$q .= "WHERE DokKdBc='5' AND CAR='$CAR' ORDER BY no";
	
	$run=$pdo->query($q);
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($rs);
	
} else if ($req=='dgCari'){
	$dtdari = $_REQUEST["dtdari"];
	$dtsampai = $_REQUEST["dtsampai"];
	$q = "SELECT *,
		CONCAT(LEFT(a.CAR,3),'.',RIGHT(a.CAR,3)) AS FCAR,
		CONCAT(LEFT(NoDaf,3),'.',RIGHT(NoDaf,3)) AS FNoDaf,
		DATE_FORMAT(TgDaf,'%d/%m/%Y') AS FTgDaf
		FROM header a 
		LEFT JOIN hdrpengangkutan b ON b.DokKdBc=a.DokKdBc AND b.CAR=a.CAR
		LEFT JOIN hdrtransaksi c ON c.DokKdBc=a.DokKdBc AND c.CAR=a.CAR
		WHERE a.DokKdBc='5'
		";
	if($dtdari != '' && $dtsampai != ''):
		$q .= "AND TgDaf BETWEEN '".dmys2ymd($dtdari)."' AND '".dmys2ymd($dtsampai)."' ";
	endif;
	$q .= "ORDER BY a.CAR DESC";	
	
	$run=$pdo->query($q);
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($rs);
}

?>