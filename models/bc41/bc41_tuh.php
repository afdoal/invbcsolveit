<?php 
require_once "../../models/abspath.php";
require_once "pdocon.php";
require_once "function.php";

//VARIABEL YANG DI POST
$DokKdBc=$_POST['DokKdBc'];
$fhidden=$_POST['fhidden'];
$CAR=$_POST['CAR'];
$KdTp=$_POST['KdTp'];
$KdKpbcAsal=$_POST['KdKpbcAsal'];
$KdJnsTpbAsal=$_POST['KdJnsTpbAsal'];

$NoDaf=$_POST['NoDaf'];
$TgDaf=dmys2ymd($_POST['TgDaf']);

$NmPengusaha=$_POST['NmPengusaha'];
$NipPengusaha=$_POST['NipPengusaha'];
$NmPejabat=$_POST['NmPejabat'];
$NipPejabat=$_POST['NipPejabat'];
$ref_id=$_POST['ref_id'];

$NmTuj=$_POST['NmTuj'];

$KdVal=$_POST['KdVal'];
$HrgSerah=$_POST['HrgSerah'];

$JnsAngkut=$_POST['JnsAngkut'];
$NoPolisi=$_POST['NoPolisi'];

$MerekKemas=$_POST['MerekKemas'];
$KdKemas=$_POST['KdKemas'];
$JmlKemas=$_POST['JmlKemas'];

$VOL=$_POST['VOL'];
$BRUTO=$_POST['BRUTO'];
$NETTO=$_POST['NETTO'];

//FORM DOKUMEN PELENGKAP
$nolist=explode("`", $_POST['nolist']);
$DokKd=explode("`", $_POST['DokKd']);
$DokNo=explode("`", $_POST['DokNo']);
$DokTg=explode("`", $_POST['DokTgDmy']);
//FORM BARANG
$nolist2=explode("`", $_POST['nolist2']);
$KdBarang=explode("`", $_POST['KdBarang']);
$UrBarang=explode("`", $_POST['UrBarang']);
$qty=explode("`", $_POST['qty']);
$NETTO2=explode("`", $_POST['NETTO2']);
$VOL2=explode("`", $_POST['VOL2']);
$HrgSerah2=explode(",", $_POST['HrgSerah2']);

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];
$NmMenu="bc41";

try {
	
$sql[] = "START TRANSACTION";

if ($fhidden != ""){	
	//UBAH DATA UNTUK TABEL HEADER
	$sql[] = "UPDATE header SET 
			CAR='$CAR',
			KdTp='$KdTp',
			KdKpbcAsal='$KdKpbcAsal',
			KdJnsTpbAsal='$KdJnsTpbAsal',
			
			NoDaf='$NoDaf',
			TgDaf='$TgDaf',
			
			NmPengusaha='$NmPengusaha',
			NipPengusaha='$NipPengusaha',
			NmPejabat='$NmPejabat',
			NipPejabat='$NipPejabat',
			ref_id='$ref_id',
			
			NmTuj='$NmTuj',
			
			MerekKemas='$MerekKemas',
			KdKemas='$KdKemas',
			JmlKemas='$JmlKemas',
			
			VOL='$VOL',
			BRUTO='$BRUTO',
			NETTO='$NETTO'
			WHERE DokKdBc = '$DokKdBc' AND CAR LIKE '".$fhidden."'";	
			
	$ketlog="ubah data $NmMenu $DokKdBc $CAR";			
} else {
	//Validasi Data
	echo validasi($DokKdBc,$CAR,$NoDaf) . "\n";
				
	// TAMBAH DATA KE TABEL HEADER	
	$sql[] = "INSERT INTO header (
			CAR,KdTp,KdKpbcAsal,
			KdJnsTpbAsal,NoDaf,TgDaf,
			NmPengusaha,NipPengusaha,NmPejabat,NipPejabat,
			ref_id,NmTuj,		
			MerekKemas,KdKemas,
			JmlKemas,VOL,BRUTO,NETTO,DokKdBc
			) VALUES (
			'$CAR','$KdTp','$KdKpbcAsal',
			'$KdJnsTpbAsal','$NoDaf','$TgDaf',
			'$NmPengusaha','$NipPengusaha','$NmPejabat','$NipPejabat',
			'$ref_id','$NmTuj',
			'$MerekKemas','$KdKemas',
			'$JmlKemas','$VOL','$BRUTO','$NETTO','$DokKdBc'	
			)";
			
	$ketlog="tambah data $NmMenu $DokKdBc $CAR";			
}

//MANIPULASI DATA HDRPENGANGKUTAN
$sql[]="DELETE FROM hdrpengangkutan WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
$sql[] = "INSERT INTO hdrpengangkutan (
		  DokKdBc,CAR,JnsAngkut,NoPolisi
		  ) VALUES (
		  '$DokKdBc','$CAR','$JnsAngkut','$NoPolisi'
		  )";	

//MANIPULASI DATA HDRTRANSAKSI
$sql[]="DELETE FROM hdrtransaksi WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
$sql[] = "INSERT INTO hdrtransaksi (
		  DokKdBc,CAR,KdVal,HrgSerah
		  ) VALUES (
		  '$DokKdBc','$CAR','Rp','$HrgSerah'
		  )";	

//MANIPULASI DATA UNTUK LIST DOKUMEN PELENGKAP (TABEL dokumen)	
$jmlnodet=sizeof($nolist)-1;

//SQL HAPUS DULU SEMUA dokumen
$sql[]="DELETE FROM dokumen WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
for ($i=0; $i<$jmlnodet; $i++){			
	$sql[] = "INSERT INTO dokumen (
			  DokKdBc,CAR,no,DokKd,
			  DokNo,DokTg
			  ) VALUES (
			  '$DokKdBc','$CAR','$nolist[$i]','$DokKd[$i]',
			  '$DokNo[$i]','".dmys2ymd($DokTg[$i])."'
			  )";					
}//AKHIR MANIPULASI DATA DOKUMEN PELENGKAP

//MANIPULASI DATA UNTUK LIST BARANG (TABEL barang)	
$jmlnodet=sizeof($nolist2)-1;
//SQL HAPUS DULU SEMUA barang
$sql[]="DELETE FROM barang WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
for ($i=0; $i<$jmlnodet; $i++){			
	$sql[] = "INSERT INTO barang (
			  DokKdBc,CAR,no,KdBarang,
			  UrBarang,qty,
			  NETTO,VOL,HrgSerah
			  ) VALUES (
			  '$DokKdBc','$CAR','$nolist2[$i]','$KdBarang[$i]',
			  '$UrBarang[$i]','$qty[$i]',
			  '$NETTO2[$i]','$VOL2[$i]','$HrgSerah2[$i]'
			  )";	
}//AKHIR MANIPULASI DATA BARANG	

$sql[]= "INSERT INTO log VALUES (0,'$tgl','$usr','$ketlog')";

$sql[] = "COMMIT";	
		
$msg = "Data berhasil disimpan!";
$errmsg = "Terjadi Kesalahan, Data tidak dapat disimpan!";

	foreach($sql as $q){
		//echo $q."\r\n";
		$pdo->query($q);
	}
	
	echo $msg; 
} catch( PDOException $Exception ){	
	$pdo->query("ROLLBACK");
	
	echo "$errmsg\r\n";
	echo $Exception->getMessage();
	exit(0);
}
		
?>