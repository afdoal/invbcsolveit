<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$nama_user0=$_REQUEST['nama_user0'];
$nama_user=$_REQUEST['nama_user'];
$pass=$_REQUEST['pass'];
$grup=$_REQUEST['grup'];
// perlu dibuat sebarang pengacak
$pengacak  = "K1234I4321K5678I8765N5891";

// mengenkripsi password dengan md5() dan pengacak
$pass = md5(md5($pass) . $pengacak .  md5($pengacak) . $pass);

$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];
$NmMenu="user administration";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		//TAMBAH
		$qtuj = "SELECT * FROM user WHERE nama_user='$nama_user'";
		$rec = $pdo->query($qtuj);
		$rstuj = $rec->fetchAll(PDO::FETCH_ASSOC);
		if (count($rstuj) == 0){
			$sql[]="INSERT INTO user (	
					  nama_user,pass,grup
					) VALUES (
					  '$nama_user','$pass','$grup'
					)";
			
			$ketlog="tambah data $NmMenu $nama_user";
			
			$msg = "Simpan data BERHASIL.";
			$errmsg = "Simpan data GAGAL!";
		} else {
			throw new PDOException ("Simpan data GAGAL!<br>Nama User sudah ada..");
		}		
	} else if ($aksi=='u'){
		//UBAH
		$sql[]="UPDATE user SET 
				nama_user='$nama_user',
				pass='$pass',
				grup='$grup'
				WHERE nama_user='$nama_user0'";
		
		$ketlog="ubah data $NmMenu $nama_user0";
				
		$msg = "Simpan data BERHASIL.";
		$errmsg = "Simpan data GAGAL!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM user WHERE nama_user='$nama_user0'";
		
		$ketlog="hapus data $NmMenu $nama_user0";
		
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