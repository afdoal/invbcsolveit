<?php
require_once "../models/abspath.php";
require_once "pdocon.php";

$TpBarang=$_REQUEST["TpBarang"];

$q = "SELECT KdBarang,Nmbarang,Ket AS UrBarang FROM mst_barang WHERE TpBarang='$TpBarang' ORDER BY KdBarang";
$run=$pdovb->query($q);
$rs=$run->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rs);
?>