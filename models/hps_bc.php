<?php 
require_once "../models/abspath.php";
require_once "pdocon.php";

$CAR=$_REQUEST['CAR'];
$DokKdBc=$_REQUEST['DokKdBc'];

$sql[] = "START TRANSACTION";
$sql[] = "DELETE FROM header WHERE DokKdBc = '$DokKdBc' AND CAR = '$CAR'";
$sql[] = "DELETE FROM dokumen WHERE DokKdBc = '$DokKdBc' AND CAR = '$CAR'";
$sql[] = "DELETE FROM barang WHERE DokKdBc = '$DokKdBc' AND CAR = '$CAR'";

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];
$NmMenu="bc";
$ketlog="hapus data $NmMenu $DokKdBc $CAR";	

$sql[]= "INSERT INTO log VALUES (0,'$tgl','$usr','$ketlog')";
$sql[] = "COMMIT";

$msg = "Data berhasil dihapus!";
$errmsg = "Terjadi Kesalahan, Data tidak dapat dihapus!";

try {
	foreach($sql as $q)
		$pdo->query($q);
	echo $msg; 
} catch( PDOException $Exception ){
	$pdo->query("ROLLBACK");
	
	echo "$errmsg\r\n";
	echo $Exception->getMessage();
	exit(0);
}

?>
