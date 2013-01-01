<?php
require_once "../abspath.php";
require_once "pdocon.php";

$q = "SELECT *,KdNegara AS KdNegara0 FROM mst_negara ORDER BY KdNegara ASC";
$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rs);
?>