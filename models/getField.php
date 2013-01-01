<?php
require_once "../models/abspath.php";
require_once "pdocon.php";

$NmTabel = $_REQUEST["NmTabel"];
$NmKolom1 = $_REQUEST["NmKolom1"];
$NmKolom2 = $_REQUEST["NmKolom2"];
$field = $_REQUEST["field"];
$q = "SELECT $NmKolom1 FROM $NmTabel WHERE $NmKolom2='$field'";
$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);
echo $rs[0][$NmKolom1];
?>