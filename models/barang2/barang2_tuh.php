<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$KdBarang0=$_REQUEST['KdBarang0'];
//$PartNo=$_REQUEST['PartNo'];
$KdBarang=$_REQUEST['KdBarang'];
$NmBarang=$_REQUEST['NmBarang'];
$TpBarang=$_REQUEST['TpBarang'];
$HsNo=$_REQUEST['HsNo'];
$Sat=$_REQUEST['Sat'];
$Treatment=$_REQUEST['Treatment'];
$Ket=$_REQUEST['Ket'];
$cust=$_REQUEST['cust'];

$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];
if ($TpBarang == '1'){
	$JnsBarang="material";
} else {
	$JnsBarang="finished goods";
}

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		//TAMBAH
		$qtuj = "SELECT * FROM mst_barang WHERE KdBarang='$KdBarang'";
		$rec = $pdo->query($qtuj);
		$rstuj = $rec->fetchAll(PDO::FETCH_ASSOC);
		if (count($rstuj) == 0){
			$sql[]="INSERT INTO mst_barang (	
					  KdBarang,NmBarang,TpBarang,
					  HsNo,Sat,Treatment,Ket,cust
					) VALUES (
					  '$KdBarang','$NmBarang','$TpBarang',
					  '$HsNo','$Sat',
					  '$Treatment','$Ket','$cust'
					)";					
			
			$ketlog="add $JnsBarang $KdBarang";
			  					
			$msg = "Save Success.";
			$errmsg = "Save FAILED!";
		} else {
			throw new PDOException ("Simpan data GAGAL!<br>Kode Barang sudah ada..");
		}		
	} else if ($aksi=='u'){
		//UBAH
		$sql[]="UPDATE mst_barang SET 
				KdBarang='$KdBarang',
				NmBarang='$NmBarang',TpBarang='$TpBarang',
				HsNo='$HsNo',Sat='$Sat',
				Treatment='$Treatment',Ket='$Ket',
				cust='$cust'									
				WHERE KdBarang='$KdBarang0'";
				
		$ketlog="edit $JnsBarang $KdBarang0";
		
		$msg = "Update Success.";
		$errmsg = "Update FAILED!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM mst_barang WHERE KdBarang='$KdBarang0'";		
		
		$ketlog="delete data $JnsBarang $KdBarang0";		
		
		$msg = "Delete Success.";
		$errmsg = "Delete FAILED!";
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