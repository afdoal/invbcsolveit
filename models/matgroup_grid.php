<?php
require_once "pdocon.php";

$q = "SELECT *,matgroup_code AS matgroup_code0 FROM mat_group ORDER BY matgroup_name ASC";
$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rs);
?>