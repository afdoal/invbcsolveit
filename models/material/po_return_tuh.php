<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$po_id=$_REQUEST['po_id'];
$po_no=$_REQUEST['po_no'];
$po_date=dmys2ymd($_REQUEST['po_date']);
$currency=$_REQUEST['currency'];
$ref_id=$_REQUEST['ref_id'];
$ref_no=$_REQUEST['ref_no'];
$supplier=$_REQUEST['supplier'];
$ppn=$_REQUEST['ppn'];
$attn=$_REQUEST['attn'];
$terms=$_REQUEST['terms'];
$spec=$_REQUEST['spec'];
$width_tol=$_REQUEST['width_tol'];
$thick_tol=$_REQUEST['thick_tol'];
$Wrmax=$_REQUEST['Wrmax'];		
$notes=$_REQUEST['notes'];
$dlv_date=dmys2ymd($_REQUEST['dlv_date']);
$wh_id=$_REQUEST['wh_id'];		
$remark=$_REQUEST['remark'];
$auth_sign=$_REQUEST['auth_sign'];

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
	$tot_amount += $qty[$i]*$price[$i];
}
$tot_amount = $tot_amount*($ppn/100);

$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];

$NmMenu="po";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		
		//TAMBAH HEADER
		$sql[] = "INSERT INTO pur_pohdr (
				  po_id,po_type,po_no,po_date,currency,ref_id,ref_no,
				  supplier,ppn,attn,terms,
				  spec,width_tol,thick_tol,
				  Wrmax,notes,dlv_date,
				  wh_id,remark,auth_sign
				  ) VALUES (
				  '$po_id','1','$po_no','$po_date','$currency','$ref_id','$ref_no',
				  '$supplier','$ppn','$attn','$terms',
				  '$spec','$width_tol','$thick_tol',
				  '$Wrmax','$notes','$dlv_date',
				  '$wh_id','$remark','$auth_sign' 
				  )";	
		//AKHIR TAMBAH HEADER
		
		//TAMBAH DETAIL		
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO pur_podet (
				  po_id,child_no,mat_id,qty,price
				  ) VALUES (
				  '$po_id','$nolist[$i]','$KdBarang2[$i]','$qty[$i]','$price[$i]'
				  )";	
		}//AKHIR TAMBAH DETAIL
		
		$ketlog="Add $NmMenu $po_id";
				
		$msg = "Save Success.";
		$errmsg = "Save FAILED!";
				
	} else if ($aksi=='u'){
		//HAPUS DULU SEMUA
		$sql[]="DELETE FROM pur_pohdr WHERE po_id='$po_id'";
		//$sql[]="DELETE FROM pur_podet WHERE po_id='$po_id'";
		//UBAH HEADER
		$sql[] = "INSERT INTO pur_pohdr (
				  po_id,po_type,po_no,po_date,currency,ref_id,ref_no,
				  supplier,ppn,attn,terms,
				  spec,width_tol,thick_tol,
				  Wrmax,notes,dlv_date,
				  wh_id,remark,auth_sign
				  ) VALUES (
				  '$po_id','1','$po_no','$po_date','$currency','$ref_id','$ref_no',
				  '$supplier','$ppn','$attn','$terms',
				  '$spec','$width_tol','$thick_tol',
				  '$Wrmax','$notes','$dlv_date',
				  '$wh_id','$remark','$auth_sign' 
				  )";	
		//AKHIR UBAH HEADER		
		//UBAH DETAIL	
		$jmlnodet=sizeof($nolist)-1;		
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO pur_podet (
				  po_id,child_no,mat_id,qty,price
				  ) VALUES (
				  '$po_id','$nolist[$i]','$KdBarang2[$i]','$qty[$i]','$price[$i]'
				  )";	
		}//AKHIR UBAH DETAIL
		
		$ketlog="Edit $NmMenu $po_id";
		
		$msg = "Update Success.";
		$errmsg = "Update FAILED!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM pur_pohdr WHERE po_id='$po_id'";
		//$sql[]="DELETE FROM pur_podet WHERE po_id='$po_id'";
		
		$ketlog="Delete $NmMenu $po_id";  
		
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