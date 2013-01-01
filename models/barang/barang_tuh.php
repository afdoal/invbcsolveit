<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$KdBarang0=$_REQUEST['KdBarang0'];
$KdBarang=$_REQUEST['KdBarang'];
$TpBarang=$_REQUEST['TpBarang'];
$NmBarang=$_REQUEST['NmBarang'];
$HsNo=$_REQUEST['HsNo'];
$Sat=$_REQUEST['Sat'];
$Harga=$_REQUEST['Harga'];
$Ket=$_REQUEST['Ket'];
$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];
$NmMenu="barang";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		//TAMBAH
		$qtuj = "SELECT * FROM mst_barang WHERE KdBarang='$KdBarang'";
		$rec = $pdo->query($qtuj);
		$rstuj = $rec->fetchAll(PDO::FETCH_ASSOC);
		if (count($rstuj) == 0){
			$sql[]="INSERT INTO mst_barang (	
					  KdBarang,TpBarang,NmBarang,HsNo,Sat,Harga,Ket
					) VALUES (
					  '$KdBarang','$TpBarang','$NmBarang','$HsNo','$Sat','$Harga','$Ket'
					)";
			
			$ketlog="tambah data $NmMenu $KdBarang";
					
			$msg = "Simpan data BERHASIL.";
			$errmsg = "Simpan data GAGAL!";
		} else {
			throw new PDOException ("Simpan data GAGAL!<br>Kode Barang sudah ada..");
		}		
	} else if ($aksi=='u'){
		//UBAH
		$sql[]="UPDATE mst_barang SET 
				KdBarang='$KdBarang',TpBarang='$TpBarang',
				NmBarang='$NmBarang',HsNo='$HsNo',
				Sat='$Sat',Harga='$Harga',Ket='$Ket'									
				WHERE KdBarang='$KdBarang0'";
		
		$ketlog="ubah data $NmMenu $KdBarang0";
				
		$msg = "Simpan data BERHASIL.";
		$errmsg = "Simpan data GAGAL!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM mst_barang WHERE KdBarang='$KdBarang0'";
		
		$ketlog="hapus data $NmMenu $KdBarang0";  
		
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