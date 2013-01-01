<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$KdKpbc0=$_REQUEST['KdKpbc0'];
$KdKpbc=$_REQUEST['KdKpbc'];
$UrKdKpbc=$_REQUEST['UrKdKpbc'];
$Kota=$_REQUEST['Kota'];
$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];
$NmMenu="KPBC";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		//TAMBAH
		$qtuj = "SELECT * FROM kantor WHERE KdKpbc='$KdKpbc'";
		$rec = $pdo->query($qtuj);
		$rstuj = $rec->fetchAll(PDO::FETCH_ASSOC);
		if (count($rstuj) == 0){
			$sql[]="INSERT INTO kantor (	
					  KdKpbc,UrKdKpbc,Kota
					) VALUES (
					  '$KdKpbc','$UrKdKpbc','$Kota'
					)";
			
			$ketlog="tambah data $NmMenu $KdKpbc";
					
			$msg = "Simpan data BERHASIL.";
			$errmsg = "Simpan data GAGAL!";
		} else {
			throw new PDOException ("Simpan data GAGAL!<br>Kode KPBC sudah ada..");
		}		
	} else if ($aksi=='u'){
		//UBAH
		$sql[]="UPDATE kantor SET 
				KdKpbc='$KdKpbc',UrKdKpbc='$UrKdKpbc',
				Kota='$Kota'
				WHERE KdKpbc='$KdKpbc0'";
				
		$ketlog="ubah data $NmMenu $KdKpbc0";
		
		$msg = "Simpan data BERHASIL.";
		$errmsg = "Simpan data GAGAL!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM kantor WHERE KdKpbc='$KdKpbc0'";
		
		$ketlog="hapus data $NmMenu $KdKpbc0";
		
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