<?php
require_once "models/sessions.php";
require_once "models/pdocon.php";

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];
$ket="logout";
$qlog= "INSERT INTO log VALUES (0,'$tgl','$usr','$ket')";
$runqlog = $pdo->query($qlog);

unset($_SESSION['idFac']);
unset($_SESSION['factory']);
unset($_SESSION['userName']);
unset($_SESSION['pass']);
session_destroy();
?>
<SCRIPT>parent.location='login.php'</SCRIPT>