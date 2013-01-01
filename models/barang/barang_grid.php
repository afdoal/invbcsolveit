<?php
require_once "../abspath.php";
require_once "pdocon.php";

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 25;
$offset = ($page-1)*$rows;
$result = array();

$q = "SELECT *,KdBarang AS KdBarang0,FORMAT(Harga, 2) AS Harga FROM mst_barang a LEFT JOIN mst_jenisbarang b ON KdJnsBarang=TpBarang WHERE TpBarang NOT IN ('0','1','11') ORDER BY TpBarang, KdBarang ASC";

$runtot=$pdo->query($q);
$rstot=$runtot->fetchAll(PDO::FETCH_ASSOC);

$q .= " LIMIT $offset,$rows";
$run=$pdo->query($q);
$rs=$run->fetchAll(PDO::FETCH_ASSOC);

$result["total"] = count($rstot);
$result["rows"] = $rs;

echo json_encode($result);
?>