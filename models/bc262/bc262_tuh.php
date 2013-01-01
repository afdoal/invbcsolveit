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
$CIF=$_POST['CIF'];

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
$CIF2=explode("`", $_POST['CIF2']);
//FORM JAMINAN
$BM=$_POST['BM'];
$Cukai=$_POST['Cukai'];
$PPN=$_POST['PPN'];
$PPnBM=$_POST['PPnBM'];
$PPh=$_POST['PPh'];
$Total=$_POST['Total'];

$JnsJaminan=$_POST['JnsJaminan'];
$NoJaminan=$_POST['NoJaminan'];
$TgJaminan=dmys2ymd($_POST['TgJaminan']);
$NilaiJaminan=$_POST['NilaiJaminan'];
$JatuhTempo=dmys2ymd($_POST['JatuhTempo']);
$Penjamin=$_POST['Penjamin'];
$NoBukti=$_POST['NoBukti'];
$TgBukti=dmys2ymd($_POST['TgBukti']);	
//FORM BARANG KEMBALI
$nolist3=explode("`", $_POST['nolist3']);
$KdBarang2=explode("`", $_POST['KdBarang2']);
$UrBarang2=explode("`", $_POST['UrBarang2']);
$qty2=explode("`", $_POST['qty2']);
$NETTO3=explode("`", $_POST['NETTO3']);
$VOL3=explode("`", $_POST['VOL3']);
$CIF3=explode("`", $_POST['CIF3']);

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];
$NmMenu="bc262";

try {
	
$sql[] = "START TRANSACTION";
//MANIPULASI TABEL PENJAMIN
$qpenjamin = "SELECT * FROM penjamin WHERE NmPenjamin = '".$Penjamin."' ";
$rec = $pdo->query($qpenjamin);
$rspenjamin = $rec->fetchAll(PDO::FETCH_ASSOC);
if (count($rspenjamin) == 0){
	$sql[]="INSERT INTO penjamin (NmPenjamin) VALUES ('$Penjamin')";
}

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
			NETTO='$NETTO',
			Total='$Total'

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
			ref_id,NmTuj,MerekKemas,KdKemas,
			JmlKemas,VOL,BRUTO,NETTO,
			Total,DokKdBc
			) VALUES (
			'$CAR','$KdTp','$KdKpbcAsal',
			'$KdJnsTpbAsal','$NoDaf','$TgDaf',
			'$NmPengusaha','$NipPengusaha','$NmPejabat','$NipPejabat',
			'$ref_id','$NmTuj','$MerekKemas','$KdKemas',
			'$JmlKemas','$VOL','$BRUTO','$NETTO',
			'$Total','$DokKdBc'	
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
		  DokKdBc,CAR,KdVal,CIF
		  ) VALUES (
		  '$DokKdBc','$CAR','$KdVal','$CIF'
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
			  NETTO,VOL,CIF
			  ) VALUES (
			  '$DokKdBc','$CAR','$nolist2[$i]','$KdBarang[$i]',
			  '$UrBarang[$i]','$qty[$i]',
			  '$NETTO2[$i]','$VOL2[$i]','$CIF2[$i]'
			  )";	
}//AKHIR MANIPULASI DATA BARANG	

//MANIPULASI DATA JAMINAN
$sql[]="DELETE FROM hdrjaminan WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar
		  ) VALUES (
		  '$DokKdBc','$CAR','BM','$BM'
		  )";
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar
		  ) VALUES (
		  '$DokKdBc','$CAR','Cukai','$Cukai'
		  )";		  
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar
		  ) VALUES (
		  '$DokKdBc','$CAR','PPN','$PPN'
		  )";		  
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar
		  ) VALUES (
		  '$DokKdBc','$CAR','PPnBM','$PPnBM'
		  )";		  
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar
		  ) VALUES (
		  '$DokKdBc','$CAR','PPh','$PPh'
		  )";
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,NoJaminan,TgJaminan,
		  bayar,TgJatuhTempo,Penjamin,NoTandaBayar,TglTandaBayar
		  ) VALUES (
		  '$DokKdBc','$CAR','$JnsJaminan','$NoJaminan','$TgJaminan',
		  '$NilaiJaminan','$JatuhTempo','$Penjamin','$NoBukti','$TgBukti'
		  )";		  		  

//MANIPULASI DATA UNTUK LIST BARANG KEMBALI (TABEL barangkembali)	
$jmlnodet=sizeof($nolist3)-1;
//SQL HAPUS DULU SEMUA barang
$sql[]="DELETE FROM barangkembali WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
for ($i=0; $i<$jmlnodet; $i++){			
	$sql[] = "INSERT INTO barangkembali (
			  DokKdBc,CAR,no,KdBarang,
			  UrBarang,qty,
			  NETTO,VOL,CIF
			  ) VALUES (
			  '$DokKdBc','$CAR','$nolist3[$i]','$KdBarang2[$i]',
			  '$UrBarang2[$i]','$qty2[$i]',
			  '$NETTO3[$i]','$VOL3[$i]','$CIF3[$i]'
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