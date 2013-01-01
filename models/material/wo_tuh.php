<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$wo_id=$_REQUEST['wo_id'];
$wo_no=$_REQUEST['wo_no'];
$wo_date=dmys2ymd($_REQUEST['wo_date']);
$so_id=$_REQUEST['so_id'];
$expplan_date=dmys2ymd($_REQUEST['expplan_date']);
$notes=$_REQUEST['notes'];

//FORM LIST DATA MATERIAL
$nolist=explode("`", $_REQUEST['nolist']);
$KdBarang2=explode("`", $_REQUEST['KdBarang2']);
$qty=explode("`", $_REQUEST['qty']);
$tot_qty=0;
$tot_amount=0;
$jmlnodet=sizeof($nolist)-1;
for ($i=0; $i<$jmlnodet; $i++){
	$tot_qty += $qty[$i];
}

$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];

$NmMenu="work order";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		
		//TAMBAH HEADER
		$sql[] = "INSERT INTO ppic_wohdr (
				  wo_id,wo_no,wo_date,so_id,
				  expplan_date,tot_qty,notes
				  ) VALUES (
				  '$wo_id','$wo_no','$wo_date','$so_id',
				  '$expplan_date','$tot_qty','$notes'
				  )";	
		//AKHIR TAMBAH HEADER
		
		//TAMBAH DETAIL		
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO ppic_wodet (
				  wo_id,child_no,fg_id,qty_plan
				  ) VALUES (
				  '$wo_id','$nolist[$i]','$KdBarang2[$i]','$qty[$i]'
				  )";	
		}//AKHIR TAMBAH DETAIL
		
		$ketlog="Add $NmMenu $wo_id";
				
		$msg = "Save Success.";
		$errmsg = "Save FAILED!";
				
	} else if ($aksi=='u'){
		//HAPUS DULU SEMUA
		$sql[]="DELETE FROM ppic_wohdr WHERE wo_id='$wo_id'";
		//$sql[]="DELETE FROM ppic_wodet WHERE wo_id='$wo_id'";
		//UBAH HEADER
		$sql[] = "INSERT INTO ppic_wohdr (
				  wo_id,wo_no,wo_date,so_id,
				  expplan_date,tot_qty,notes
				  ) VALUES (
				  '$wo_id','$wo_no','$wo_date','$so_id',
				  '$expplan_date','$tot_qty','$notes'
				  )";	
		//AKHIR UBAH HEADER		
		//UBAH DETAIL	
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO ppic_wodet (
				  wo_id,child_no,fg_id,qty_plan
				  ) VALUES (
				  '$wo_id','$nolist[$i]','$KdBarang2[$i]','$qty[$i]'
				  )";	
		}//AKHIR UBAH DETAIL
		
		$ketlog="Edit $NmMenu $wo_id";
		
		$msg = "Update Success.";
		$errmsg = "Update FAILED!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM ppic_wohdr WHERE wo_id='$wo_id'";
		//$sql[]="DELETE FROM ppic_wohdr WHERE wo_id='$wo_id'";
		
		$ketlog="Delete $NmMenu $wo_id";  
		
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