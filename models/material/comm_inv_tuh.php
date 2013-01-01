<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";

//VARIABEL YANG DI POST
$comm_id=$_REQUEST['comm_id'];
$comm_no=$_REQUEST['comm_no'];
$comm_date=dmys2ymd($_REQUEST['comm_date']);
$do_id=$_REQUEST['do_id'];
$payment=$_REQUEST['payment'];
$pol=$_REQUEST['pol'];
$pod=$_REQUEST['pod'];
$container=$_REQUEST['container'];
$sail_date=dmys2ymd($_REQUEST['sail_date']);
$currency=$_REQUEST['currency'];
$vessel=$_REQUEST['vessel'];
$voy_no=$_REQUEST['voy_no'];
$fob=$_REQUEST['fob'];
$freight=$_REQUEST['freight'];
$insurance=$_REQUEST['insurance'];
$cnf=$_REQUEST['cnf'];
$notify=$_REQUEST['notify'];
$auth_sign=$_REQUEST['auth_sign'];
$notes=$_REQUEST['notes'];

//FORM LIST DATA BARANG
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

$NmMenu="commercial invoice";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		
		//TAMBAH HEADER
		$sql[] = "INSERT INTO mkt_comminvhdr (
				  comm_id,comm_no,comm_date,do_id,
				  payment,pol,pod,container,sail_date,
				  currency,vessel,voy_no,fob,
				  freight,insurance,cnf,				    
				  tot_qty,tot_amount,
				  notify,auth_sign,notes
				  ) VALUES (
				  '$comm_id','$comm_no','$comm_date','$do_id',
				  '$payment','$pol','$pod','$container','$sail_date',
				  '$currency','$vessel','$voy_no','$fob',
				  '$freight','$insurance','$cnf',
				  '$tot_qty','$tot_amount',
				  '$notify','$auth_sign','$notes'
				  )";	
		//AKHIR TAMBAH HEADER
		
		//TAMBAH DETAIL		
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO mkt_comminvdet (
				  comm_id,child_no,fg_id,qty,price
				  ) VALUES (
				  '$comm_id','$nolist[$i]','$KdBarang2[$i]','$qty[$i]','$price[$i]'
				  )";	
		}//AKHIR TAMBAH DETAIL
		
		$ketlog="Add $NmMenu $comm_id";
				
		$msg = "Save Success.";
		$errmsg = "Save FAILED!";
				
	} else if ($aksi=='u'){
		//HAPUS DULU SEMUA
		$sql[]="DELETE FROM mkt_comminvhdr WHERE comm_id='$comm_id'";
		//$sql[]="DELETE FROM mkt_comminvdet WHERE comm_id='$comm_id'";
		//UBAH HEADER
		$sql[] = "INSERT INTO mkt_comminvhdr (
				  comm_id,comm_no,comm_date,do_id,
				  payment,pol,pod,container,sail_date,
				  currency,vessel,voy_no,fob,
				  freight,insurance,cnf,				    
				  tot_qty,tot_amount,
				  notify,auth_sign,notes
				  ) VALUES (
				  '$comm_id','$comm_no','$comm_date','$do_id',
				  '$payment','$pol','$pod','$container','$sail_date',
				  '$currency','$vessel','$voy_no','$fob',
				  '$freight','$insurance','$cnf',
				  '$tot_qty','$tot_amount',
				  '$notify','$auth_sign','$notes'
				  )";		
		//AKHIR UBAH HEADER		
		//UBAH DETAIL	
		for ($i=0; $i<$jmlnodet; $i++){			
		$sql[] = "INSERT INTO mkt_comminvdet (
				  comm_id,child_no,fg_id,qty,price
				  ) VALUES (
				  '$comm_id','$nolist[$i]','$KdBarang2[$i]','$qty[$i]','$price[$i]'
				  )";	
		}//AKHIR UBAH DETAIL
		
		$ketlog="Edit $NmMenu $comm_id";
		
		$msg = "Update Success.";
		$errmsg = "Update FAILED!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM mkt_comminvhdr WHERE comm_id='$comm_id'";
		//$sql[]="DELETE FROM mkt_comminvhdr WHERE comm_id='$comm_id'";
		
		$ketlog="Delete $NmMenu $comm_id";  
		
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