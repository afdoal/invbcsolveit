<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";

//VARIABEL YANG DI POST
$do_id=$_REQUEST['do_id'];
$do_no=$_REQUEST['do_no'];
$do_date=dmys2ymd($_REQUEST['do_date']);
$cust=$_REQUEST['cust'];
$so_id=$_REQUEST['so_id'];
$so_no=$_REQUEST['so_no'];
$vehicle_no=$_REQUEST['vehicle_no'];
$driver=$_REQUEST['driver'];
$KdJnsDok=$_REQUEST['KdJnsDok'];
$notes=$_REQUEST['notes'];

//FORM LIST DATA MATERIAL
$nolist=explode("`", $_REQUEST['nolist']);
$KdBarang2=explode("`", $_REQUEST['KdBarang2']);
$weight=explode("`", $_REQUEST['weight']);
$qty=explode("`", $_REQUEST['qty']);
$price=explode("`", $_REQUEST['price']);
$tot_qty=0;
$tot_amount=0;
$jmlnodet=sizeof($nolist)-1;
for ($i=0; $i<$jmlnodet; $i++){
	$tot_qty += $qty[$i];
	$tot_amount += $qty[$i]*$price[$i];
}

$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];

$NmMenu="delivery order";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		
		//TAMBAH HEADER
		$sql[] = "INSERT INTO mat_outhdr (
				  matout_id,matout_no,matout_date,mat_type,cust,ref_id,ref_no,
				  tot_qty,tot_amount,vehicle_no,driver,notes,KdJnsDok
				  ) VALUES (
				  '$do_id','$do_no','$do_date','0','$cust','$so_id','$so_no',
				  '$tot_qty','$tot_amount','$vehicle_no','$driver','$notes','$KdJnsDok'
				  )";	
		//AKHIR TAMBAH HEADER
		
		//TAMBAH DETAIL		
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO mat_outdet (
				  matout_id,child_no,mat_id,weight,qty,price
				  ) VALUES (
				  '$do_id','$nolist[$i]','$KdBarang2[$i]','$weight[$i]','$qty[$i]','$price[$i]'
				  )";	
		}//AKHIR TAMBAH DETAIL
		
		$ketlog="Add $NmMenu $do_id";
				
		$msg = "Save Success.";
		$errmsg = "Save FAILED!";
				
	} else if ($aksi=='u'){
		//HAPUS DULU SEMUA
		$sql[]="DELETE FROM mat_outhdr WHERE matout_id='$do_id'";
		//$sql[]="DELETE FROM mkt_dodet WHERE do_id='$do_id'";
		//UBAH HEADER
		$sql[] = "INSERT INTO mat_outhdr (
				  matout_id,matout_no,matout_date,mat_type,cust,ref_id,ref_no,
				  tot_qty,tot_amount,vehicle_no,driver,notes,KdJnsDok
				  ) VALUES (
				  '$do_id','$do_no','$do_date','0','$cust','$so_id','$so_no',
				  '$tot_qty','$tot_amount','$vehicle_no','$driver','$notes','$KdJnsDok'
				  )";	
		//AKHIR UBAH HEADER		
		//UBAH DETAIL	
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO mat_outdet (
				  matout_id,child_no,mat_id,weight,qty,price
				  ) VALUES (
				  '$do_id','$nolist[$i]','$KdBarang2[$i]','$weight[$i]','$qty[$i]','$price[$i]'
				  )";	
		}//AKHIR UBAH DETAIL
		
		$ketlog="Edit $NmMenu $do_id";
		
		$msg = "Update Success.";
		$errmsg = "Update FAILED!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM mat_outhdr WHERE matout_id='$do_id'";
		//$sql[]="DELETE FROM mkt_dohdr WHERE do_id='$do_id'";
		
		$ketlog="Delete $NmMenu $do_id";  
		
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