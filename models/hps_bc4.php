<?php 
require_once "../models/abspath.php";
require_once "pdocon.php";

$sql[] = "START TRANSACTION";
$sql[] = "DELETE FROM bc4 WHERE no_peng = '".$_POST['fno_peng']."' AND tipe_bc = '".$_POST['tipe_bc']."'";
$sql[] = "DELETE FROM bc4_det WHERE no_peng = '".$_POST['fno_peng']."' AND tipe_bc = '".$_POST['tipe_bc']."'";
$sql[] = "COMMIT";

$msg = "Data berhasil dihapus!";
$errmsg = "Terjadi Kesalahan, Data tidak dapat dihapus!";

try {
	foreach($sql as $q)
		$crudMysql->rawQuery($q);
	echo $msg; 
} catch( PDOException $Exception ){
	echo "$errmsg\r\n";
	echo $Exception->getMessage();
	exit(0);
}

?>
