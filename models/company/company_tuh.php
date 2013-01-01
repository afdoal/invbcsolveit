<?php 
require_once "../abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$NmPrshn0=mysql_real_escape_string($_REQUEST['NmPrshn0']);
$NmPrshn=mysql_real_escape_string($_REQUEST['NmPrshn']);
$TpPrshn=$_REQUEST['TpPrshn'];
$NpwpPrshn=$_REQUEST['NpwpPrshn'];
$AlmtPrshn=$_REQUEST['AlmtPrshn'];
$Kota=$_REQUEST['Kota'];
$Prov=$_REQUEST['Prov'];
$Negara=$_REQUEST['Negara'];
$fax=$_REQUEST['fax'];
$tlp=$_REQUEST['tlp'];
$Status=$_REQUEST['Status'];
$StatusKB=$_REQUEST['StatusKB'];
$NoTpb=$_REQUEST['NoTpb'];
$Niper=$_REQUEST['Niper'];
$Cp=$_REQUEST['Cp'];
$Valuta=$_REQUEST['Valuta'];
$NoPokokPpjk=$_REQUEST['NoPokokPpjk'];
$TgPokokPpjk=dmys2ymd($_REQUEST['TgPokokPpjk']);
$aksi=$_REQUEST['aksi'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];
$NmMenu="company";

try {	
	$sql[] = "START TRANSACTION";
	if ($aksi=='t'){
		//TAMBAH
		$qtuj = "SELECT * FROM mst_perusahaan WHERE NmPrshn='$NmPrshn'";
		$rec = $pdo->query($qtuj);
		$rstuj = $rec->fetchAll(PDO::FETCH_ASSOC);
		if (count($rstuj) == 0){
			$sql[]="INSERT INTO mst_perusahaan (	
					  NmPrshn,TpPrshn,NpwpPrshn,AlmtPrshn,Kota,Prov,Negara,fax,tlp,Status,StatusKB,NoTpb,Niper,Cp,Valuta,NoPokokPpjk,TgPokokPpjk
					) VALUES (
					  '$NmPrshn','$TpPrshn','$NpwpPrshn','$AlmtPrshn','$Kota','$Prov','$Negara','$fax','$tlp','$Status','$StatusKB','$NoTpb','$Niper','$Cp','$Valuta','$NoPokokPpjk','$TgPokokPpjk'
					)";
					
			$ketlog="tambah data $NmMenu $NmPrshn";
					
			$msg = "Simpan data BERHASIL.";
			$errmsg = "Simpan data GAGAL!";
		} else {
			throw new PDOException ("Simpan data GAGAL!<br>Nama Perusahaan sudah ada..");
		}		
	} else if ($aksi=='u'){
		//UBAH
		$sql[]="UPDATE mst_perusahaan SET 
				NmPrshn='$NmPrshn',NpwpPrshn='$NpwpPrshn',TpPrshn='$TpPrshn',
				AlmtPrshn='$AlmtPrshn',Kota='$Kota',
				Prov='$Prov',Negara='$Negara',fax='$fax',tlp='$tlp',Status='$Status',StatusKB='$StatusKB',NoTpb='$NoTpb',
				Niper='$Niper',Cp='$Cp',Valuta='$Valuta',NoPokokPpjk='$NoPokokPpjk',
				TgPokokPpjk='$TgPokokPpjk'									
				WHERE NmPrshn='$NmPrshn0'";
		
		$ketlog="ubah data $NmMenu $NmPrshn0";
				
		$msg = "Simpan data BERHASIL.";
		$errmsg = "Simpan data GAGAL!";
	} else {
		//HAPUS
		$sql[]="DELETE FROM mst_perusahaan WHERE NmPrshn='$NmPrshn0'";
		
		$ketlog="tambah data $NmMenu $NmPrshn0";
		
		$msg = "Hapus data BERHASIL.";
		$errmsg = "Hapus data GAGAL!";
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