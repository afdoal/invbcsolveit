<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";

//VARIABEL YANG DI POST
$wh_id0=$_REQUEST['wh_id0'];
$wh_id=$_REQUEST['wh_id'];
$date0=dmys2ymd($_REQUEST['date0']);
$date=dmys2ymd($_REQUEST['date']);
//FORM LIST DATA MATERIAL
$nolist=explode("`", $_REQUEST['nolist']);
$KdBarang2=explode("`", $_REQUEST['KdBarang2']);
$qty=explode("`", $_REQUEST['qty']);
$remark=explode("`", $_REQUEST['remark']);

$aksi=$_REQUEST['aksi'];
$type=$_REQUEST['type'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];

$NmMenu="wip";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		//TAMBAH
		//MANIPULASI DATA UNTUK LIST BARANG (TABEL barang)	
		$jmlnodet=sizeof($nolist)-1;
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO mat_stockcard (
				  kd_fac,wh_id,date,mat_type,mat_id,
				  type,qty,qty_bal,remark
				  ) VALUES (
				  '01','$wh_id','$date','11','$KdBarang2[$i]',
				  '$type','$qty[$i]','$qty[$i]','$remark[$i]'
				  )";	
		}//AKHIR MANIPULASI DATA BARANG		
		
		$ketlog="Add $NmMenu $wh_id $date";
				
		$msg = "Save Success.";
		$errmsg = "Save FAILED!";
				
	} else if ($aksi=='u'){
		//UBAH
		//MANIPULASI DATA UNTUK LIST BARANG (TABEL barang)	
		$jmlnodet=sizeof($nolist)-1;
		//SQL HAPUS DULU SEMUA barang
		$sql[]="DELETE FROM mat_stockcard WHERE kd_fac='01' AND wh_id='$wh_id0' AND date='$date0' AND mat_type='11' AND type='$type'";
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO mat_stockcard (
				  kd_fac,wh_id,date,mat_type,mat_id,
				  type,qty,qty_bal,remark
				  ) VALUES (
				  '01','$wh_id','$date','11','$KdBarang2[$i]',
				  '$type','$qty[$i]','$qty[$i]','$remark[$i]'
				  )";
		}//AKHIR MANIPULASI DATA BARANG
		
		$ketlog="Edit $NmMenu $wh_id0 $date0";
		
		$msg = "Save Success.";
		$errmsg = "Save FAILED!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM mat_stockcard WHERE kd_fac='01' AND wh_id='$wh_id0' AND date='$date0' AND mat_type='11' AND type='$type'";
		
		$ketlog="Delete $NmMenu $wh_id0 $date0";  
		
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