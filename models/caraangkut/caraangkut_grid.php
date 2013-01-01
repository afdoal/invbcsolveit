<?php
require_once "../abspath.php";
require_once "pdocon.php";

$q = "SELECT *,KdCrAngkut AS KdCrAngkut0 FROM mst_caraangkut ORDER BY KdCrAngkut ASC";
$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rs);
?>