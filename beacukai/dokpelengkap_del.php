<?php
require_once '../inc/abspath.php';
require_once 'pdocon.php';

$DokKdBc = $_REQUEST['DokKdBc'];
$CAR = $_REQUEST['CAR'];
$no = $_REQUEST['no'];

try{	
	//$q = "DELETE FROM dokumen WHERE DokKdBc='$DokKdBc' AND CAR='$CAR' AND no='$no'";
	$q = "DELETE FROM dokumen WHERE no='9'";
	
	$run=$pdo->exec($q);

	echo json_encode(array('success'=>true));
	
} catch(PDOException $e){
	$msg="Terjadi Kesalahan \n".$e->getMessage();
	echo json_encode(array('msg'=>$msg));
}	
/*$sql = "delete from dokumen where DokKdBc='$DokKdBc' AND CAR='$CAR' AND no='$no'";
@mysql_query($sql);
echo json_encode(array('success'=>false));*/
?>