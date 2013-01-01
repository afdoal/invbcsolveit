<?php
require_once '../inc/abspath.php';
require_once 'pdocon.php';
require_once 'function.php';

$DokKdBc = "6";
$CAR = $_REQUEST['CAR'];
$no = $_REQUEST['no']; 
$DokKd = $_REQUEST['DokKd'];  
$DokNo = $_REQUEST['DokNo'];  
$DokTg = dmys2ymd($_REQUEST['DokTgDmy']);  
  
/*$q = "INSERT INTO dokumen(
			DokKdBc,CAR,no,DokKd,DokNo,DokTg
		) values(
			'$DokKdBc','$CAR','$no','$DokKd','$DokNo','$DokTg'
		)"; 
@mysql_query($q);  
echo json_encode(array(  
    'no' => $no,  
    'DokKd' => $DokKd,  
    'DokNo' => $DokNo,  
    'DokTg' => $DokTg  
)); */

try {	
	$q = "INSERT INTO dokumen(
			DokKdBc,CAR,no,DokKd,DokNo,DokTg
		) values(
			'$DokKdBc','$CAR','$no','$DokKd','$DokNo','$DokTg'
		)";
		
	/*** INSERT data ***/
	$run=$pdo->exec($q);
	
	//echo json_encode(array('success'=>true));
	
} catch(PDOException $e){
	$msg="Terjadi Kesalahan \n".$e->getMessage();
	echo json_encode(array('msg'=>$msg));
}
?>