<?php
require_once "../models/abspath.php";
require_once "pdocon.php";

$DokKdBc = $_REQUEST["DokKdBc"];
$CAR = $_REQUEST["CAR"];
$q = "SELECT *,DATE_FORMAT(TgJaminan,'%d/%m/%Y') AS TgJaminan1,DATE_FORMAT(TgJatuhTempo,'%d/%m/%Y') AS TgJatuhTempo1,DATE_FORMAT(TglTandaBayar,'%d/%m/%Y') AS TglTandaBayar1 FROM hdrjaminan WHERE DokKdBc='$DokKdBc' AND CAR='$CAR'";
$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rs);
?>