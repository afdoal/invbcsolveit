<?php 
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$matgroup_code0=$_REQUEST['matgroup_code0'];
$matgroup_code=$_REQUEST['matgroup_code'];
$matgroup_name=$_REQUEST['matgroup_name'];
$HsNo=$_REQUEST['HsNo'];
$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];
$NmMenu="material group";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		//TAMBAH
		$qtuj = "SELECT * FROM mat_group WHERE matgroup_name='$matgroup_name'";
		$rec = $pdo->query($qtuj);
		$rstuj = $rec->fetchAll(PDO::FETCH_ASSOC);
		if (count($rstuj) == 0){
			$sql[]="INSERT INTO mat_group (	
					  matgroup_code,matgroup_name,HsNo
					) VALUES (
					  '$matgroup_code','$matgroup_name','$HsNo'
					)";
			
			$ketlog="tambah data $NmMenu $matgroup_name";
			
			$msg = "Save SUCCESS.";
			$errmsg = "Save FAILED!";
		} else {
			throw new PDOException ("Save Failed!<br>Same Name..");
		}		
	} else if ($aksi=='u'){
		//UBAH
		$sql[]="UPDATE mat_group SET 
				matgroup_code='$matgroup_code',matgroup_name='$matgroup_name',HsNo='$HsNo'
				WHERE matgroup_code='$matgroup_code0'";
		
		$ketlog="ubah data $NmMenu $matgroup_code";
				
		$msg = "Update SUCCESS.";
		$errmsg = "Update FAILED!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM mat_group WHERE matgroup_code='$matgroup_code0'";
		
		$ketlog="hapus data $NmMenu $matgroup_code";
		
		$msg = "Delete SUCCESS.";
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