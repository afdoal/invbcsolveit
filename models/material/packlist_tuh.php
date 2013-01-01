<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";

//VARIABEL YANG DI POST
$pack_id=$_REQUEST['pack_id'];
$pack_no=$_REQUEST['pack_no'];
$pack_date=dmys2ymd($_REQUEST['pack_date']);
$comm_id=$_REQUEST['comm_id'];
$size=$_REQUEST['size'];
$notes=$_REQUEST['notes'];

//FORM LIST DATA BARANG
$nolist=explode("`", $_REQUEST['nolist']);
$KdBarang2=explode("`", $_REQUEST['KdBarang2']);
$fromct=explode("`", $_REQUEST['fromct']);
$toct=explode("`", $_REQUEST['toct']);
$qty=explode("`", $_REQUEST['qty']);
$amount=explode("`", $_REQUEST['amount']);
$remark=explode("`", $_REQUEST['remark']);
$tot_amount=0;
$jmlnodet=sizeof($nolist)-1;
for ($i=0; $i<$jmlnodet; $i++){
	$tot_amount += $amount[$i];
}

$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];

$NmMenu="packing list";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		
		//TAMBAH HEADER
		$sql[] = "INSERT INTO mkt_packinghdr (
				  pack_id,pack_no,pack_date,comm_id,
				  size,notes,tot_amount
				  ) VALUES (
				  '$pack_id','$pack_no','$pack_date','$comm_id',
				  '$size','$notes','$tot_amount'
				  )";	
		//AKHIR TAMBAH HEADER
		
		//TAMBAH DETAIL		
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO mkt_packingdet (
				  pack_id,child_no,fg_id,
				  fromct,toct,qty,amount,remark
				  ) VALUES (
				  '$pack_id','$nolist[$i]','$KdBarang2[$i]',
				  '$fromct[$i]','$toct[$i]','$qty[$i]','$amount[$i]','$remark[$i]'
				  )";	
		}//AKHIR TAMBAH DETAIL
		
		$ketlog="Add $NmMenu $pack_id";
				
		$msg = "Save Success.";
		$errmsg = "Save FAILED!";
				
	} else if ($aksi=='u'){
		//HAPUS DULU SEMUA
		$sql[]="DELETE FROM mkt_packinghdr WHERE pack_id='$pack_id'";
		//$sql[]="DELETE FROM mkt_packingdet WHERE pack_id='$pack_id'";
		//UBAH HEADER
		$sql[] = "INSERT INTO mkt_packinghdr (
				  pack_id,pack_no,pack_date,comm_id,
				  size,notes,tot_amount
				  ) VALUES (
				  '$pack_id','$pack_no','$pack_date','$comm_id',
				  '$size','$notes','$tot_amount'
				  )";				
		//AKHIR UBAH HEADER		
		//UBAH DETAIL	
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO mkt_packingdet (
				  pack_id,child_no,fg_id,
				  fromct,toct,qty,amount,remark
				  ) VALUES (
				  '$pack_id','$nolist[$i]','$KdBarang2[$i]',
				  '$fromct[$i]','$toct[$i]','$qty[$i]','$amount[$i]','$remark[$i]'
				  )";	
		}//AKHIR TAMBAH DETAIL
		
		$ketlog="Edit $NmMenu $pack_id";
		
		$msg = "Update Success.";
		$errmsg = "Update FAILED!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM mkt_packinghdr WHERE pack_id='$pack_id'";
		//$sql[]="DELETE FROM mkt_packinghdr WHERE pack_id='$pack_id'";
		
		$ketlog="Delete $NmMenu $pack_id";  
		
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