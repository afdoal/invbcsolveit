<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$MatGroup=$_REQUEST['MatGroup'];
$KdBarang0=$_REQUEST['KdBarang0'];
$KdBarang=$_REQUEST['KdBarang'];
$TpBarang=$_REQUEST['TpBarang'];
$NmBarang=$_REQUEST['NmBarang'];
$HsNo=$_REQUEST['HsNo'];
$DieNo=$_REQUEST['DieNo'];
$UWm=$_REQUEST['UWm'];
$LPc=$_REQUEST['LPc'];
$WPcs=$_REQUEST['WPcs'];
$LBar=$_REQUEST['LBar'];
$PcBar=$_REQUEST['PcBar'];
$WBar=$_REQUEST['WBar'];
$Finish=$_REQUEST['Finish'];
$twhmp=$_REQUEST['twhmp'];
$Sat=$_REQUEST['Sat'];
$Ket=$_REQUEST['Ket'];

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
					  KdBarang,TpBarang,MatGroup,NmBarang,HsNo,
					  DieNo,UWm,LPc,WPcs,LBar,PcBar,
					  WBar,Finish,twhmp,Sat,Ket
					) VALUES (
					  '$KdBarang','$TpBarang','$MatGroup','$NmBarang','$HsNo',
					  '$DieNo','$UWm','$LPc','$WPcs','$LBar','$PcBar',
					  '$WBar','$Finish','$twhmp','$Sat','$Ket'
					)";					
			
			$ketlog="add $JnsBarang $KdBarang";
			  					
			$msg = "Save Success.";
			$errmsg = "Save FAILED!";
		} else {
			throw new PDOException ("Simpan data FAILED!<br>Kode Barang sudah ada..");
		}		
	} else if ($aksi=='u'){
		//UBAH
		$sql[]="UPDATE mst_barang SET 
				MatGroup='$MatGroup',
				KdBarang='$KdBarang',TpBarang='$TpBarang',
				NmBarang='$NmBarang',HsNo='$HsNo',
				DieNo='$DieNo',
				UWm='$UWm',
				LPc='$LPc',
				WPcs='$WPcs',
				LBar='$LBar',
				PcBar='$PcBar',
				WBar='$WBar',
				Finish='$Finish',
				twhmp='$twhmp',
				Sat='$Sat',
				Ket='$Ket'
				WHERE KdBarang='$KdBarang0'";
				
		$ketlog="edit $JnsBarang $KdBarang0";
		
		$msg = "Update Success.";
		$errmsg = "Update FAILED!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM mst_barang WHERE KdBarang='$KdBarang0'";		
		
		$ketlog="delete $JnsBarang $KdBarang0";		
		
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