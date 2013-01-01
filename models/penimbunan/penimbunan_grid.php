<?php
require_once "../abspath.php";
require_once "pdocon.php";

$q = "SELECT *,KdTimbun AS KdTimbun0 FROM mst_penimbunan ORDER BY KdTimbun ASC";
$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rs);
?>