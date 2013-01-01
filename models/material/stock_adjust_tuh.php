<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$opname_id=$_REQUEST['opname_id'];
$opname_date=$_REQUEST['tahun']."-".$_REQUEST['bulan'];
$wh_id=$_REQUEST['wh_id'];

//FORM LIST DATA MATERIAL
$nolist=explode("`", $_REQUEST['nolist']);
$KdBarang2=explode("`", $_REQUEST['KdBarang2']);
$qty_bal=explode("`", $_REQUEST['qty_bal']);
$qty=explode("`", $_REQUEST['qty']);

$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];

$NmMenu="stock adjustment";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		$update = "UPDATE mat_opnamedet opn_d
					INNER JOIN mat_opnamehdr opn_h ON opn_h.opname_id=opn_d.opname_id ";
		
		$jmlnodet=sizeof($nolist)-1;		
		for ($i=0; $i<$jmlnodet; $i++){			
			$where = "WHERE opn_d.mat_id ='".$KdBarang2[$i]."' 
						AND opn_h.wh_id = '".$wh_id."' 
						AND opn_h.opname_date LIKE '".$opname_date."%' ";
			  
			if ($qty[$i] > $qty_bal[$i]){
				$selqty = $qty[$i] -  $qty_bal[$i];				
				$sql[] = $update."SET opn_h.status='1', opn_d.qty_bal = '".$qty_bal[$i]."', opn_d.qty_diff = '".$selqty."', opn_d.qty_in = '".$selqty."', opn_d.qty_out = '0' ".$where;
			} else {
				$selqty = $qty_bal[$i] - $qty[$i];				
				$sql[] = $update."SET opn_h.status='1', opn_d.qty_bal = '".$qty_bal[$i]."', opn_d.qty_diff = '".$selqty."', opn_d.qty_in = '0', opn_d.qty_out = '".$selqty."' ".$where;
			}
		}
		
		$ketlog="Add $NmMenu $opname_id";
				
		$msg = "Save Success.";
		$errmsg = "Save FAILED!";
		
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