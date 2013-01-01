<?php
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";

$usr=$_SESSION['userName'];

$q = "SELECT *,nama_user AS nama_user0 FROM user ";
if ($usr != "admin"){
	$q .= "WHERE nama_user = '$usr' ";	
}
$q .= "ORDER BY nama_user ASC";
$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rs);
?>