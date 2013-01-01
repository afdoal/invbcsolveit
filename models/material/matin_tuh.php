<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$matin_id=$_REQUEST['matin_id'];
$matin_type=$_REQUEST['matin_type'];
$matin_no=$_REQUEST['matin_no'];
$matin_date=dmys2ymd($_REQUEST['matin_date']);
$currency=$_REQUEST['currency'];

$po_id=$_REQUEST['po_id'];
$po_no=$_REQUEST['po_no'];
$supplier=$_REQUEST['supplier'];
$supl_do=$_REQUEST['supl_do'];
$supl_inv=$_REQUEST['supl_inv'];
$KdJnsDok=$_REQUEST['KdJnsDok'];
$notes=$_REQUEST['notes'];

//FORM LIST DATA MATERIAL
$nolist=explode("`", $_REQUEST['nolist']);
$KdBarang2=explode("`", $_REQUEST['KdBarang2']);
$qty=explode("`", $_REQUEST['qty']);
$price=explode("`", $_REQUEST['price']);
$tot_qty=0;
$tot_amount=0;
$jmlnodet=sizeof($nolist)-1;
for ($i=0; $i<$jmlnodet; $i++){
	$tot_qty += $qty[$i];
	$tot_amount += $amount[$i];
}

$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];

$NmMenu="matin";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		
		//TAMBAH HEADER
		$sql[] = "INSERT INTO mat_inchdr (
				  matin_id,matin_type,matin_no,matin_date,currency,
				  po_id,po_no,supplier,supl_do,supl_inv,KdJnsDok,notes				  
				  ) VALUES (
				  '$matin_id','$matin_type','$matin_no','$matin_date','$currency',
				  '$po_id','$po_no','$supplier','$supl_do','$supl_inv','$KdJnsDok','$notes'
				  )";	
		//AKHIR TAMBAH HEADER
		
		//TAMBAH DETAIL		
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO mat_incdet (
				  matin_id,child_no,mat_id,qty,price
				  ) VALUES (
				  '$matin_id','$nolist[$i]','$KdBarang2[$i]','$qty[$i]','$price[$i]'
				  )";	
		}//AKHIR TAMBAH DETAIL
		
		$ketlog="Add $NmMenu $matin_id";
				
		$msg = "Save Success.";
		$errmsg = "Save FAILED!";
				
	} else if ($aksi=='u'){
		//HAPUS DULU SEMUA
		$sql[]="DELETE FROM mat_inchdr WHERE matin_id='$matin_id'";
		//$sql[]="DELETE FROM mat_incdet WHERE matin_id='$matin_id'";
		//UBAH HEADER
		$sql[] = "INSERT INTO mat_inchdr (
				  matin_id,matin_type,matin_no,matin_date,currency,
				  po_id,po_no,supplier,supl_do,supl_inv,KdJnsDok,notes				  
				  ) VALUES (
				  '$matin_id','$matin_type','$matin_no','$matin_date','$currency',
				  '$po_id','$po_no','$supplier','$supl_do','$supl_inv','$KdJnsDok','$notes'
				  )";	
		//AKHIR UBAH HEADER		
		//UBAH DETAIL	
		$jmlnodet=sizeof($nolist)-1;		
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO mat_incdet (
				  matin_id,child_no,mat_id,qty,price
				  ) VALUES (
				  '$matin_id','$nolist[$i]','$KdBarang2[$i]','$qty[$i]','$price[$i]'
				  )";	
		}//AKHIR UBAH DETAIL
		
		$ketlog="Edit $NmMenu $matin_id";
		
		$msg = "Update Success.";
		$errmsg = "Update FAILED!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM mat_inchdr WHERE matin_id='$matin_id'";
		//$sql[]="DELETE FROM mat_incdet WHERE matin_id='$matin_id'";
		
		$ketlog="Delete $NmMenu $matin_id";  
		
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