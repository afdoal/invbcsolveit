<?php 
require_once "../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$DokKdBc=$_POST['DokKdBc'];
$CAR=$_POST['CAR'];

$q="SELECT right(NoDaf,3)+1 AS auto_nodaf FROM header WHERE DokKdBc='$DokKdBc' ORDER BY right(NoDaf,3) DESC LIMIT 1";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
$autonodaf=($rs)?$rs[0]['auto_nodaf']:1;
$NoDaf = "000".str_pad($autonodaf, 3, "0", STR_PAD_LEFT);

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];
$NmMenu="Approve";

try {
	
$sql[] = "START TRANSACTION";

//UBAH DATA UNTUK TABEL HRMPARAMETER
$sql[] = "UPDATE header SET 		
		NoDaf='$NoDaf'
		WHERE DokKdBc = '$DokKdBc' AND CAR LIKE '$CAR'";	
		
$ketlog = "$NmMenu $DokKdBc $CAR";			

$sql[]= "INSERT INTO log VALUES (0,'$tgl','$usr','$ketlog')";

$sql[] = "COMMIT";	
		
$msg = "Data berhasil disimpan!";
$errmsg = "Terjadi Kesalahan, Data tidak dapat disimpan!";

	foreach($sql as $q){
		//echo $q."\r\n";
		$pdo->query($q);
	}
	  
	echo $msg; 
} catch( PDOException $Exception ){	
	$pdo->query("ROLLBACK");
	
	echo "$errmsg\r\n";
	echo $Exception->getMessage();
	exit(0);
}
?>