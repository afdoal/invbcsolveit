<?php
require_once "../../models/abspath.php";
require_once "pdocon.php";
require_once "function.php";

$kpbc=str_pad($_SESSION["KpbcPengawas"], 6, "0", STR_PAD_LEFT);
$KdPengguna=str_pad($_SESSION["KdPengguna"], 6, "0", STR_PAD_LEFT);
$NoReg1=str_pad($_SESSION["NoReg1"], 6, "0", STR_PAD_LEFT);
$NoReg2=str_pad($_SESSION["NoReg2"], 6, "0", STR_PAD_LEFT);

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 25;
$offset = ($page-1)*$rows;
$result = array();

$dtdari=$_REQUEST['dtdari'];
$dtsampai=$_REQUEST['dtsampai'];

$q = "SELECT *,CONCAT('$KdPengguna-$NoReg1','-',DATE_FORMAT(TgDaf,'%Y%m%d'),'-',CAR) AS FCAR,CONCAT(LEFT(NoDaf,3),'.',RIGHT(NoDaf,3)) AS FNoDaf,DATE_FORMAT(TgDaf,'%d/%m/%Y') AS tgl_daf FROM header WHERE DokKdBc='9' ";

if($dtdari != '' && $dtsampai != ''):
	$q .= "AND TgDaf BETWEEN '".dmys2ymd($dtdari)."' AND '".dmys2ymd($dtsampai)."' ";
endif;

$q .= "ORDER BY TgDaf";

$runtot=$pdo->query($q);
$rstot=$runtot->fetchAll(PDO::FETCH_ASSOC);

$q .= " LIMIT $offset,$rows";
$run=$pdo->query($q);
$rs=$run->fetchAll(PDO::FETCH_ASSOC);

$result["total"] = count($rstot);
$result["rows"] = $rs;

echo json_encode($result);
?>