<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$KdCrAngkut0=$_REQUEST['KdCrAngkut0'];
$KdCrAngkut=$_REQUEST['KdCrAngkut'];
$NmCrAngkut=$_REQUEST['NmCrAngkut'];
$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];
$NmMenu="cara pengangkutan";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		//TAMBAH
		$qtuj = "SELECT * FROM mst_caraangkut WHERE KdCrAngkut='$KdCrAngkut'";
		$rec = $pdo->query($qtuj);
		$rstuj = $rec->fetchAll(PDO::FETCH_ASSOC);
		if (count($rstuj) == 0){
			$sql[]="INSERT INTO mst_caraangkut (	
					  KdCrAngkut,NmCrAngkut
					) VALUES (
					  '$KdCrAngkut','$NmCrAngkut'
					)";
					
			$ketlog="tambah data $NmMenu $KdCrAngkut";
				
			$msg = "Simpan data BERHASIL.";
			$errmsg = "Simpan data GAGAL!";
		} else {
			throw new PDOException ("Simpan data GAGAL!<br>Kode sudah ada..");
		}		
	} else if ($aksi=='u'){
		//UBAH
		$sql[]="UPDATE mst_caraangkut SET 
				KdCrAngkut='$KdCrAngkut',NmCrAngkut='$NmCrAngkut'
				WHERE KdCrAngkut='$KdCrAngkut0'";
		
		$ketlog="ubah data $NmMenu $KdCrAngkut0";
					
		$msg = "Simpan data BERHASIL.";
		$errmsg = "Simpan data GAGAL!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM mst_caraangkut WHERE KdCrAngkut='$KdCrAngkut0'";
		
		$ketlog="hapus data $NmMenu $KdCrAngkut0";
		
		$msg = "Hapus data BERHASIL.";
		$errmsg = "Hapus data GAGAL!";
	}
	
	$sql[]= "INSERT INTO log VALUES (0,'$tgl','$usr','$ketlog')";
	
	$sql[] = "COMMIT";	
	
	foreach($sql as $q){
		//echo $q."\r\n";
		$pdo->query($q);
	}
	  
	echo json_encode(array('success'=>true,'msg'=>$msg)); 
} catch( PDOException $Exception ){	
	$pdo->query("ROLLBACK");	
	echo json_encode(array('msg'=>$errmsg."\r\n".$Exception->getMessage()));
	exit(0);
}
?>