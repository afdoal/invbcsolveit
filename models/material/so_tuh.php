<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$so_id=$_REQUEST['so_id'];
$so_no=$_REQUEST['so_no'];
$so_date=dmys2ymd($_REQUEST['so_date']);
$currency=$_REQUEST['currency'];
$cust=mysql_real_escape_string($_REQUEST['cust']);
$due_date=dmys2ymd($_REQUEST['due_date']);
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
	$tot_amount += $qty[$i]*$price[$i];
}

$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];

$NmMenu="po customer";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		
		//TAMBAH HEADER
		$sql[] = "INSERT INTO mkt_sorderhdr (
				  so_id,so_no,so_date,currency,cust,
				  due_date,tot_qty,tot_amount,notes
				  ) VALUES (
				  '$so_id','$so_no','$so_date','$currency','$cust',
				  '$due_date','$tot_qty','$tot_amount','$notes'
				  )";	
		//AKHIR TAMBAH HEADER
		
		//TAMBAH DETAIL		
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO mkt_sorderdet (
				  so_id,child_no,fg_id,qty,price
				  ) VALUES (
				  '$so_id','$nolist[$i]','$KdBarang2[$i]','$qty[$i]','$price[$i]'
				  )";	
		}//AKHIR TAMBAH DETAIL
		
		$ketlog="Add $NmMenu $so_id";
				
		$msg = "Save Success.";
		$errmsg = "Save FAILED!";
				
	} else if ($aksi=='u'){
		//HAPUS DULU SEMUA
		$sql[]="DELETE FROM mkt_sorderhdr WHERE so_id='$so_id'";
		//$sql[]="DELETE FROM mkt_sorderdet WHERE so_id='$so_id'";
		//UBAH HEADER
		$sql[] = "INSERT INTO mkt_sorderhdr (
				  so_id,so_no,so_date,currency,cust,
				  due_date,tot_qty,tot_amount,notes
				  ) VALUES (
				  '$so_id','$so_no','$so_date','$currency','$cust',
				  '$due_date','$tot_qty','$tot_amount','$notes'
				  )";	
		//AKHIR UBAH HEADER		
		//UBAH DETAIL	
		$jmlnodet=sizeof($nolist)-1;		
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO mkt_sorderdet (
				  so_id,child_no,fg_id,qty,price
				  ) VALUES (
				  '$so_id','$nolist[$i]','$KdBarang2[$i]','$qty[$i]','$price[$i]'
				  )";	
		}//AKHIR UBAH DETAIL
		
		$ketlog="Edit $NmMenu $so_id";
		
		$msg = "Update Success.";
		$errmsg = "Update FAILED!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM mkt_sorderhdr WHERE so_id='$so_id'";
		//$sql[]="DELETE FROM mkt_sorderdet WHERE so_id='$so_id'";
		
		$ketlog="Delete $NmMenu $so_id";  
		
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