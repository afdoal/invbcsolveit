<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$KdPelabuhan0=$_REQUEST['KdPelabuhan0'];
$KdPelabuhan=$_REQUEST['KdPelabuhan'];
$NmPelabuhan=$_REQUEST['NmPelabuhan'];
$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];
$NmMenu="pelabuhan";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		//TAMBAH
		$qtuj = "SELECT * FROM mst_pelabuhan WHERE KdPelabuhan='$KdPelabuhan'";
		$rec = $pdo->query($qtuj);
		$rstuj = $rec->fetchAll(PDO::FETCH_ASSOC);
		if (count($rstuj) == 0){
			$sql[]="INSERT INTO mst_pelabuhan (	
					  KdPelabuhan,NmPelabuhan
					) VALUES (
					  '$KdPelabuhan','$NmPelabuhan'
					)";
			
			$ketlog="tambah data $NmMenu $KdPelabuhan0";
			
			$msg = "Simpan data BERHASIL.";
			$errmsg = "Simpan data GAGAL!";
		} else {
			throw new PDOException ("Simpan data GAGAL!<br>Kode Pelabuhan sudah ada..");
		}		
	} else if ($aksi=='u'){
		//UBAH
		$sql[]="UPDATE mst_pelabuhan SET 
				KdPelabuhan='$KdPelabuhan',NmPelabuhan='$NmPelabuhan'
				WHERE KdPelabuhan='$KdPelabuhan0'";
		
		$ketlog="ubah data $NmMenu $KdPelabuhan0";
				
		$msg = "Simpan data BERHASIL.";
		$errmsg = "Simpan data GAGAL!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM mst_pelabuhan WHERE KdPelabuhan='$KdPelabuhan0'";
		
		$ketlog="hapus data $NmMenu $KdPelabuhan0";
		
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