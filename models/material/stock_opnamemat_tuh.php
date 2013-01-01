<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$opname_id=$_REQUEST['opname_id'];
$opname_date=dmys2ymd($_REQUEST['opname_date']);
$wh_id=$_REQUEST['wh_id'];
$notes=$_REQUEST['notes'];

//FORM LIST DATA MATERIAL
$nolist=explode("`", $_REQUEST['nolist']);
$KdBarang2=explode("`", $_REQUEST['KdBarang2']);
$qty=explode("`", $_REQUEST['qty']);
$tot_qty=0;
$jmlnodet=sizeof($nolist)-1;
for ($i=0; $i<$jmlnodet; $i++){
	$tot_qty += $qty[$i];
}

$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];

$NmMenu="stock opname";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		
		//TAMBAH HEADER
		$sql[] = "INSERT INTO mat_opnamehdr (
				  opname_id,opname_date,mat_type,wh_id,
				  tot_qty,notes
				  ) VALUES (
				  '$opname_id','$opname_date','1','$wh_id',
				  '$tot_qty','$notes'
				  )";	
		//AKHIR TAMBAH HEADER
		
		//TAMBAH DETAIL		
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO mat_opnamedet (
				  opname_id,child_no,mat_id,qty
				  ) VALUES (
				  '$opname_id','$nolist[$i]','$KdBarang2[$i]','$qty[$i]'
				  )";	
		}//AKHIR TAMBAH DETAIL
		
		$ketlog="Add $NmMenu $opname_id";
				
		$msg = "Save Success.";
		$errmsg = "Save FAILED!";
				
	} else if ($aksi=='u'){
		//HAPUS DULU SEMUA
		$sql[]="DELETE FROM mat_opnamehdr WHERE opname_id='$opname_id'";
		//$sql[]="DELETE FROM mat_opnamedet WHERE opname_id='$opname_id'";
		//UBAH HEADER
		$sql[] = "INSERT INTO mat_opnamehdr (
				  opname_id,opname_date,mat_type,wh_id,
				  tot_qty,notes
				  ) VALUES (
				  '$opname_id','$opname_date','1','$wh_id',
				  '$tot_qty','$notes'
				  )";	
		//AKHIR UBAH HEADER		
		//UBAH DETAIL	
		$jmlnodet=sizeof($nolist)-1;		
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO mat_opnamedet (
				  opname_id,child_no,mat_id,qty
				  ) VALUES (
				  '$opname_id','$nolist[$i]','$KdBarang2[$i]','$qty[$i]'
				  )";	
		}//AKHIR UBAH DETAIL
		
		$ketlog="Edit $NmMenu $opname_id";
		
		$msg = "Update Success.";
		$errmsg = "Update FAILED!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM mat_opnamehdr WHERE opname_id='$opname_id'";
		//$sql[]="DELETE FROM mat_opnamedet WHERE opname_id='$opname_id'";
		
		$ketlog="Delete $NmMenu $opname_id";  
		
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