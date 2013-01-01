<?php 
require_once "../../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";


//VARIABEL YANG DI POST
$DokKdBc=$_POST['DokKdBc'];
$fhidden=$_POST['fhidden'];
$KdKpbcAsal=$_POST['KdKpbcAsal'];
$CAR=$_POST['CAR'];
$KdJnsTpbAsal=$_POST['KdJnsTpbAsal'];
$KdJnsBarang=$_POST['KdJnsBarang'];
$KdTp=$_POST['KdTp'];

$NoDaf=$_POST['NoDaf'];
$TgDaf=dmys2ymd($_POST['TgDaf']);
$KdKpBongkar=$_POST['KdKpBongkar'];
$KdKpPengawas=$_POST['KdKpPengawas'];

$NmPengusaha=$_POST['NmPengusaha'];
$NipPengusaha=$_POST['NipPengusaha'];
$NmPejabat=$_POST['NmPejabat'];
$NipPejabat=$_POST['NipPejabat'];
$ref_id=$_POST['ref_id'];

$NmTuj=$_POST['NmTuj'];
$NmPpjk=$_POST['NmPpjk'];
//Form Pengangkutan
$CaraAngkut=$_POST['CaraAngkut'];
$NmAngkut=$_POST['NmAngkut'];
$NoPolisi=$_POST['NoPolisi'];
//Form Pelabuhan
$KdMuatAsal=$_POST['KdMuatAsal'];
$KdTransit=$_POST['KdTransit'];
$KdBongkar=$_POST['KdBongkar'];
$KdTimbun=$_POST['KdTimbun'];
//Form Data Perdagangan/Atau Transaksi
$KdVal=$_POST['KdVal'];
$NDPBM=$_POST['NDPBM'];
$FOB=$_POST['FOB'];
$Freight=$_POST['Freight'];
$CIF=$_POST['CIF'];
$AsLNDN=$_POST['AsLNDN'];
//FORM DOKUMEN PELENGKAP
$nolist=explode("`", $_POST['nolist']);
$DokKd=explode("`", $_POST['DokKd']);
$DokNo=explode("`", $_POST['DokNo']);
$DokTg=explode("`", $_POST['DokTgDmy']);
//FORM PENGEMAS
$nolistPK=explode("`", $_POST['nolistPK']);
$Merk=explode("`", $_POST['Merk']);
$Nomor=explode("`", $_POST['Nomor']);
$Ukuran=explode("`", $_POST['Ukuran']);
$Tipe=explode("`", $_POST['Tipe']);	

$KdKemas=$_POST['KdKemas'];
$JmlKemas=$_POST['JmlKemas'];
$MerekKemas=$_POST['MerekKemas'];
//FORM BARANG
$BRUTO=$_POST['BRUTO'];
$NETTO=$_POST['NETTO'];
//FORM LIST DATA BARANG	
$nolist2=explode("`", $_POST['nolist2']);
$KdBarang=explode("`", $_POST['KdBarang']);
$UrBarang=explode("`", $_POST['UrBarang']);
$KdGunaBarang=explode("`", $_POST['KdGunaBarang']);
$Tarif=explode("`", $_POST['Tarif']);
$qty=explode("`", $_POST['qty']);
$NETTO2=explode("`", $_POST['NETTO2']);
$CIF2=explode("`", $_POST['CIF2']);
//FORM DATA JAMINAN
$BM=$_POST['BM'];
$BM2=$_POST['BM2'];
$BM3=$_POST['BM3'];
$BM4=$_POST['BM4'];
$BM5=dmys2ymd($_POST['BM5']);
$Cukai=$_POST['Cukai'];
$Cukai2=$_POST['Cukai2'];
$Cukai3=$_POST['Cukai3'];
$Cukai4=$_POST['Cukai4'];
$Cukai5=dmys2ymd($_POST['Cukai5']);
$PPN=$_POST['PPN'];
$PPN2=$_POST['PPN2'];
$PPN3=$_POST['PPN3'];
$PPN4=$_POST['PPN4'];
$PPN5=dmys2ymd($_POST['PPN5']);
$PPnBM=$_POST['PPnBM'];
$PPnBM2=$_POST['PPnBM2'];
$PPnBM3=$_POST['PPnBM3'];
$PPnBM4=$_POST['PPnBM4'];
$PPnBM5=dmys2ymd($_POST['PPnBM5']);
$PPh=$_POST['PPh'];
$PPh2=$_POST['PPh2'];
$PPh3=$_POST['PPh3'];
$PPh4=$_POST['PPh4'];
$PPh5=dmys2ymd($_POST['PPh5']);
$PNBP=$_POST['PNBP'];
$PNBP2=$_POST['PNBP2'];
$PNBP3=$_POST['PNBP3'];
$PNBP4=$_POST['PNBP4'];
$PNBP5=dmys2ymd($_POST['PNBP5']);
$Total=$_POST['Total'];
$TotalH=$_POST['TotalH'];

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];
$NmMenu="bc23";

try {
	
$sql[] = "START TRANSACTION";
if ($fhidden != ""){	
	//UBAH DATA UNTUK TABEL HRMPARAMETER
	$sql[] = "UPDATE header SET 				
			KdKpbcAsal='$KdKpbcAsal',
			CAR='$CAR',		
			KdJnsTpbAsal='$KdJnsTpbAsal',
			KdJnsBarang='$KdJnsBarang',
			KdTp='$KdTp',
			
			NoDaf='$NoDaf',
			TgDaf='$TgDaf',
			KdKpBongkar='$KdKpBongkar',
			KdKpPengawas='$KdKpPengawas',
						
			NmPengusaha='$NmPengusaha',
			NipPengusaha='$NipPengusaha',
			NmPejabat='$NmPejabat',
			NipPejabat='$NipPejabat',
			ref_id='$ref_id',
			
			NmTuj='$NmTuj',
			NmPpjk='$NmPpjk',
			
			KdTimbun='$KdTimbun',			
			
			KdKemas='$KdKemas',
			JmlKemas='$JmlKemas',
			MerekKemas='$MerekKemas',
			
			BRUTO='$BRUTO',
			NETTO='$NETTO',
			Total='$Total',
			TotalH='$TotalH'
			WHERE DokKdBc = '$DokKdBc' AND CAR LIKE '".$fhidden."'";	
	
	$ketlog="ubah data $NmMenu $DokKdBc $fhidden";		
} else {
	//Validasi Data
	echo validasi($DokKdBc,$CAR,$NoDaf) . "\n";
				
	// TAMBAH DATA KE TABEL HEADER	
	$sql[] = "INSERT INTO header (
			KdKpbcAsal,
			CAR,		
			KdJnsTpbAsal,
			KdJnsBarang,
			KdTp,
			
			NoDaf,
			TgDaf,
			KdKpBongkar,
			KdKpPengawas,
						
			NmPengusaha,
			NipPengusaha,
			NmPejabat,
			NipPejabat,
			ref_id,
			
			NmTuj,
			NmPpjk,
			
			KdTimbun,
						
			KdKemas,
			JmlKemas,
			MerekKemas,
			
			BRUTO,
			NETTO,
			Total,
			TotalH,
			DokKdBc
			) VALUES (
			'$KdKpbcAsal',
			'$CAR',		
			'$KdJnsTpbAsal',
			'$KdJnsBarang',
			'$KdTp',
			
			'$NoDaf',
			'$TgDaf',
			'$KdKpBongkar',
			'$KdKpPengawas',
						
			'$NmPengusaha',
			'$NipPengusaha',
			'$NmPejabat',
			'$NipPejabat',
			'$ref_id',
			
			'$NmTuj',
			'$NmPpjk',
						
			'$KdTimbun',
						
			'$KdKemas',
			'$JmlKemas',
			'$MerekKemas',
			
			'$BRUTO',
			'$NETTO',
			'$Total',
			'$TotalH',
			'$DokKdBc'
			)";
		
		$ketlog="tambah data $NmMenu $DokKdBc $CAR";	
}

//MANIPULASI DATA HDRPENGANGKUTAN
$sql[]="DELETE FROM hdrpengangkutan WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
$sql[] = "INSERT INTO hdrpengangkutan (
		  DokKdBc,CAR,CaraAngkut,NmAngkut,NoPolisi
		  ) VALUES (
		  '$DokKdBc','$CAR','$CaraAngkut','$NmAngkut','$NoPolisi'
		  )";	

//MANIPULASI DATA HDRPELABUHAN
$sql[]="DELETE FROM hdrpelabuhan WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
$sql[] = "INSERT INTO hdrpelabuhan (
		  DokKdBc,CAR,MuatAsal,MuatEkspor,Transit,Bongkar
		  ) VALUES (
		  '$DokKdBc','$CAR','$KdMuatAsal','$KdMuatEkspor','$KdTransit','$KdBongkar'
		  )";	

//MANIPULASI DATA HDRTRANSAKSI
$sql[]="DELETE FROM hdrtransaksi WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
$sql[] = "INSERT INTO hdrtransaksi (
		  DokKdBc,CAR,KdVal,NDPBM,Freight,AsLNDN,
		  FOB,CIF,HrgSerah
		  ) VALUES (
		  '$DokKdBc','$CAR','$KdVal','$NDPBM','$Freight','$AsLNDN',
		  '$FOB','$CIF','$HrgSerah'
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

//MANIPULASI DATA UNTUK LIST PETI KEMAS
$jmlnodet=sizeof($nolistPK)-1;
//SQL HAPUS DULU SEMUA DATA
$sql[]="DELETE FROM hdrpetikemas WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
for ($i=0; $i<$jmlnodet; $i++){			
	$sql[] = "INSERT INTO hdrpetikemas (
			  DokKdBc,CAR,NoUrut,Merk,
			  Nomor,Ukuran,Tipe
			  ) VALUES (
			  '$DokKdBc','$CAR','$nolistPK[$i]','$Merk[$i]',
			  '$Nomor[$i]','$Ukuran[$i]','$Tipe[$i]'
			  )";					
}//AKHIR MANIPULASI DATA LIST PETI KEMAS

//MANIPULASI DATA UNTUK LIST BARANG (TABEL barang)	
$jmlnodet=sizeof($nolist2)-1;
//SQL HAPUS DULU SEMUA barang
$sql[]="DELETE FROM barang WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
for ($i=0; $i<$jmlnodet; $i++){			
	$sql[] = "INSERT INTO barang (
			  DokKdBc,CAR,no,KdBarang,
			  UrBarang,KdGunaBarang,Tarif,qty,NETTO,CIF
			  ) VALUES (
			  '$DokKdBc','$CAR','$nolist2[$i]','$KdBarang[$i]',
			  '$UrBarang[$i]','$KdGunaBarang[$i]','$Tarif[$i]','$qty[$i]','$NETTO2[$i]','$CIF2[$i]'
			  )";	
}//AKHIR MANIPULASI DATA BARANG	

//MANIPULASI DATA JAMINAN
$sql[]="DELETE FROM hdrjaminan WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar,
		  hutang,KodeAkun,NoTandaBayar,TglTandaBayar
		  ) VALUES (
		  '$DokKdBc','$CAR','BM','$BM',
		  '$BM2','$BM3','$BM4','$BM5'
		  )";	
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar,
		  hutang,KodeAkun,NoTandaBayar,TglTandaBayar
		  ) VALUES (
		  '$DokKdBc','$CAR','Cukai','$Cukai',
		  '$Cukai2','$Cukai3','$Cukai4','$Cukai5'
		  )";	
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar,
		  hutang,KodeAkun,NoTandaBayar,TglTandaBayar
		  ) VALUES (
		  '$DokKdBc','$CAR','PPN','$PPN',
		  '$PPN2','$PPN3','$PPN4','$PPN5'
		  )";	
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar,
		  hutang,KodeAkun,NoTandaBayar,TglTandaBayar
		  ) VALUES (
		  '$DokKdBc','$CAR','PPnBM','$PPnBM',
		  '$PPnBM2','$PPnBM3','$PPnBM4','$PPnBM5'
		  )";	
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar,
		  hutang,KodeAkun,NoTandaBayar,TglTandaBayar
		  ) VALUES (
		  '$DokKdBc','$CAR','PPh','$PPh',
		  '$PPh2','$PPh3','$PPh4','$PPh5'
		  )";
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar,
		  hutang,KodeAkun,NoTandaBayar,TglTandaBayar
		  ) VALUES (
		  '$DokKdBc','$CAR','PNBP','$PNBP',
		  '$PNBP2','$PNBP3','$PNBP4','$PNBP5'
		  )";		  			  
//AKHIR MANIPULASI DATA JAMINAN

$sql[]= "INSERT INTO log VALUES (0,'$tgl','$usr','$ketlog')";

$sql[] = "COMMIT";			
		
$msg = "Data berhasil disimpan!";
$errmsg = "Terjadi Kesalahan, Data tidak dapat disimpan!";

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