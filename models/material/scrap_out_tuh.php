<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$matout_id=$_REQUEST['matout_id'];
$matout_no=$_REQUEST['matout_no'];
$matout_date=dmys2ymd($_REQUEST['matout_date']);
$cust=$_REQUEST['cust'];
$vehicle_no=$_REQUEST['vehicle_no'];
$driver=$_REQUEST['driver'];
$KdJnsDok=$_REQUEST['KdJnsDok'];
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

$NmMenu="scrap out";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		
		//TAMBAH HEADER
		$sql[] = "INSERT INTO mat_outhdr (
				  matout_id,mat_type,matout_no,matout_date,
				  ref_id,ref_no,tot_qty,notes,cust,vehicle_no,driver,KdJnsDok
				  ) VALUES (
				  '$matout_id','12','$matout_no','$matout_date',
				  '','','$tot_qty','$notes','$cust','$vehicle_no','$driver','$KdJnsDok'
				  )";	
		//AKHIR TAMBAH HEADER
		
		//TAMBAH DETAIL		
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO mat_outdet (
				  matout_id,child_no,mat_id,qty
				  ) VALUES (
				  '$matout_id','$nolist[$i]','$KdBarang2[$i]','$qty[$i]'
				  )";	
		}//AKHIR TAMBAH DETAIL
		
		$ketlog="Add $NmMenu $matout_id";
				
		$msg = "Save Success.";
		$errmsg = "Save FAILED!";
				
	} else if ($aksi=='u'){
		//HAPUS DULU SEMUA
		$sql[]="DELETE FROM mat_outhdr WHERE matout_id='$matout_id'";
		//$sql[]="DELETE FROM mat_outdet WHERE matout_id='$matout_id'";
		//UBAH HEADER
		$sql[] = "INSERT INTO mat_outhdr (
				  matout_id,mat_type,matout_no,matout_date,
				  ref_id,ref_no,tot_qty,notes,cust,vehicle_no,driver,KdJnsDok
				  ) VALUES (
				  '$matout_id','12','$matout_no','$matout_date',
				  '','','$tot_qty','$notes','$cust','$vehicle_no','$driver','$KdJnsDok'
				  )";
		//AKHIR UBAH HEADER		
		//UBAH DETAIL	
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO mat_outdet (
				  matout_id,child_no,mat_id,qty
				  ) VALUES (
				  '$matout_id','$nolist[$i]','$KdBarang2[$i]','$qty[$i]'
				  )";	
		}//AKHIR UBAH DETAIL
		
		$ketlog="Edit $NmMenu $matout_id";
		
		$msg = "Update Success.";
		$errmsg = "Update FAILED!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM mat_outhdr WHERE matout_id='$matout_id'";
		//$sql[]="DELETE FROM mat_outhdr WHERE matout_id='$matout_id'";
		
		$ketlog="Delete $NmMenu $matout_id";  
		
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