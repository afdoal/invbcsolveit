<?php
require_once "../models/abspath.php";
require_once "pdocon.php";

//$matinoutdo_id = $_REQUEST["matinoutdo_id"];

//$q = "SELECT *,CONCAT_WS (' - ',matcode,matname) AS UrBarang FROM tbmatin_det ";
//$q .= "WHERE ID = '".$matinoutdo_id."' ORDER BY matcode";
$q = "SELECT * FROM tbmaterial ORDER BY Matname";
$run=$pdovb->query($q);
$rs=$run->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rs);
?>