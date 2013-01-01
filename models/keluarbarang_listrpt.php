<?php
require_once "../models/abspath.php";
require_once "pdocon.php";
require_once "function.php";

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 25;
$offset = ($page-1)*$rows;
$result = array();

$DokKdBc=$_REQUEST['DokKdBc'];
$dtdari=$_REQUEST['dtdari'];
$dtsampai=$_REQUEST['dtsampai'];

$q = "SELECT *,CONCAT(LEFT(h.CAR,8),'-',RIGHT(h.CAR,6)) AS FCAR,CONCAT(LEFT(NoDaf,3),'.',RIGHT(NoDaf,3)) AS FNoDaf,DATE_FORMAT(TgDaf,'%d/%m/%Y') AS tgl_daf,DATE_FORMAT(DokTg,'%d/%m/%Y') AS DokTg,FORMAT(qty,2) AS Fqty,FORMAT(b.HrgSerah,2) AS FHrgSerah 
	  FROM header h 
	  INNER JOIN jenis_dok jd ON jd.KdJnsDok=h.DokKdBc
	  LEFT JOIN dokumen d ON d.DokKdBc=h.DokKdBc AND d.CAR=h.CAR AND DokKd='1' 
	  LEFT JOIN barang b ON b.DokKdBc=h.DokKdBc AND b.CAR=h.CAR ";
if ($DokKdBc != ""){  
	$q .= "WHERE h.DokKdBc LIKE '%$DokKdBc%' ";
} else {
	$q .= "WHERE h.DokKdBc IN ('7','9','4','3') ";//BC 2.7.1 belum dimasukan
}

if($dtdari != '' && $dtsampai != ''):
	$q .= "AND TgDaf BETWEEN '".dmys2ymd($dtdari)."' AND '".dmys2ymd($dtsampai)."' ";
endif;

$q .= "ORDER BY h.DokKdBc,NoDaf, TgDaf";

$runtot=$pdo->query($q);
$rstot=$runtot->fetchAll(PDO::FETCH_ASSOC);

$q .= " LIMIT $offset,$rows";
$run=$pdo->query($q);
$rs=$run->fetchAll(PDO::FETCH_ASSOC);

$result["total"] = count($rstot);
$result["rows"] = $rs;

echo json_encode($result);
?>