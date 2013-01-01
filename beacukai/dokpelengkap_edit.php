<?php
require_once 'models/absolute_path.php';
require_once 'dbcon.php';
require_once 'function.php';

try{
	$id = intval($_REQUEST['id']);
	$nama = $_REQUEST['nama'];
	$tempat_lhr = $_REQUEST['tempat_lhr'];
	$tgl_lhr = dmys2ymd($_REQUEST['tgl_lhr_dmysl']);
	$alamat_rmh = $_REQUEST['alamat_rmh'];
	$kota = $_REQUEST['kota'];
	$kode_pos = $_REQUEST['kode_pos'];
	$tlp_rmh = $_REQUEST['tlp_rmh'];
	$hp = $_REQUEST['hp'];
	$email = $_REQUEST['email'];
	$instansi = $_REQUEST['instansi'];
	$alamat_kntr = $_REQUEST['alamat_kntr'];
	$tlp_kntr = $_REQUEST['tlp_kntr'];

	$q = "UPDATE alumni SET
			nama='$nama',
			tempat_lhr='$tempat_lhr',
			tgl_lhr='$tgl_lhr',
			alamat_rmh='$alamat_rmh',
			kota = '$kota',
			kode_pos = '$kode_pos',
			tlp_rmh = '$tlp_rmh',
			hp = '$hp',
			email = '$email',
			instansi = '$instansi',
			alamat_kntr = '$alamat_kntr',
			tlp_kntr = '$tlp_kntr' 
		  WHERE id=$id";
	
	//$run=$pdo->prepare($q);	  
	$run=$pdo->query($q);

	if ($run){ 	
		echo json_encode(array('success'=>true,'msg'=>$q));
	} else {
		//$msg = "$q <br>";
		foreach($pdo->errorInfo() as $error){
		    $msg = $msg.$error.'<br>';
    	}		
		echo json_encode(array('msg'=>$msg));
	}	
	
	
} catch(PDOException $e){
	$msg="Terjadi Kesalahan <br>".$e->getMessage();
	echo json_encode(array('msg'=>$msg));
}
?>