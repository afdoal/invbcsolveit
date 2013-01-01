<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$KdBarang0=$_REQUEST['KdBarang0'];
$KdBarang=$_REQUEST['KdBarang'];
//FORM LIST DATA MATERIAL
$nolist=explode("`", $_REQUEST['nolist']);
$KdBarang2=explode("`", $_REQUEST['KdBarang2']);
$qty=explode("`", $_REQUEST['qty']);

$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];

$NmMenu="consumption list";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		//TAMBAH
		//MANIPULASI DATA UNTUK LIST BARANG (TABEL barang)	
		$jmlnodet=sizeof($nolist)-1;
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO ppic_fgmatcon (
				  matcon_id,child_no,mat_id,qty
				  ) VALUES (
				  '$KdBarang','$nolist[$i]','$KdBarang2[$i]',
				  '$qty[$i]'
				  )";	
		}//AKHIR MANIPULASI DATA BARANG		
		
		$ketlog="Add $NmMenu $KdBarang";
				
		$msg = "Save Success.";
		$errmsg = "Save FAILED!";
				
	} else if ($aksi=='u'){
		//UBAH
		//MANIPULASI DATA UNTUK LIST BARANG (TABEL barang)	
		$jmlnodet=sizeof($nolist)-1;
		//SQL HAPUS DULU SEMUA barang
		$sql[]="DELETE FROM ppic_fgmatcon WHERE matcon_id = '$KdBarang0'";
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO ppic_fgmatcon (
				  matcon_id,child_no,mat_id,qty
				  ) VALUES (
				  '$KdBarang','$nolist[$i]','$KdBarang2[$i]',
				  '$qty[$i]'
				  )";	
		}//AKHIR MANIPULASI DATA BARANG
		
		$ketlog="Edit $NmMenu $KdBarang0";
		
		$msg = "Save Success.";
		$errmsg = "Save FAILED!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM ppic_fgmatcon WHERE matcon_id='$KdBarang0'";
		
		$ketlog="Delete $NmMenu $KdBarang0";  
		
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