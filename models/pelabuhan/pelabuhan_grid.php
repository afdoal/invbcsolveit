<?php
require_once "../abspath.php";
require_once "pdocon.php";

$q = "SELECT *,KdPelabuhan AS KdPelabuhan0 FROM mst_pelabuhan ORDER BY KdPelabuhan ASC";
$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rs);
?>