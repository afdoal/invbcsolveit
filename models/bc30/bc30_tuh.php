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
$KdJnsEkspor=$_POST['KdJnsEkspor'];
$KdKatEkspor=$_POST['KdKatEkspor'];
$KdCrDagang=$_POST['KdCrDagang'];
$KdCrBayar=$_POST['KdCrBayar'];

$NoDaf=$_POST['NoDaf'];
$TgDaf=dmys2ymd($_POST['TgDaf']);

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
$KdNegara=$_POST['KdNegara'];
$TgKiraEkspor=$_POST['TgKiraEkspor'];
//Form Pelabuhan
$KdMuatAsal=$_POST['KdMuatAsal'];
$KdTransit=$_POST['KdTransit'];
$KdBongkar=$_POST['KdBongkar'];
$KdMuatEkspor=$_POST['KdMuatEkspor'];
//FORM TEMPAT PEMERIKSAAN
$KdLokPeriksa=$_POST['KdLokPeriksa'];
$KdKpPeriksa=$_POST['KdKpPeriksa'];
//FORM PERDAGANGAN
$KdDaerah=$_POST['KdDaerah'];
$KdNegaraEkspor=$_POST['KdNegaraEkspor'];
$KdCrSerahBrg=$_POST['KdCrSerahBrg'];
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
$VOL=$_POST['VOL'];
$BRUTO=$_POST['BRUTO'];
$NETTO=$_POST['NETTO'];
//FORM LIST DATA BARANG	
$nolist2=explode("`", $_POST['nolist2']);
$KdBarang=explode("`", $_POST['KdBarang']);
$UrBarang=explode("`", $_POST['UrBarang']);
$HE=explode("`", $_POST['HE']);
$Tarif=explode("`", $_POST['Tarif']);
$qty=explode("`", $_POST['qty']);
$NETTO2=explode("`", $_POST['NETTO2']);
$FOB2=explode("`", $_POST['FOB2']);
//FORM DATA JAMINAN
$SSPCP=$_POST['SSPCP'];
$TgSSPCP=dmys2ymd($_POST['TgSSPCP']);
$BK=$_POST['BK'];
$BK2=$_POST['BK2'];
$BK3=dmys2ymd($_POST['BK3']);
$BK4=$_POST['BK4'];
$BK5=dmys2ymd($_POST['BK5']);
$PNBP=$_POST['PNBP'];
$PNBP2=$_POST['PNBP2'];
$PNBP3=dmys2ymd($_POST['PNBP3']);
$PNBP4=$_POST['PNBP4'];
$PNBP5=dmys2ymd($_POST['PNBP5']);

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];
$NmMenu="bc30";

try {
	
$sql[] = "START TRANSACTION";
if ($fhidden != ""){	
	//UBAH DATA UNTUK TABEL HRMPARAMETER
	$sql[] = "UPDATE header SET 				
			KdKpbcAsal='$KdKpbcAsal',
			CAR='$CAR',		
			KdJnsEkspor='$KdJnsEkspor',
			KdKatEkspor='$KdKatEkspor',
			KdCrDagang='$KdCrDagang',
			KdCrBayar='$KdCrBayar',
			
			NoDaf='$NoDaf',
			TgDaf='$TgDaf',
			
			KdKpPengawas='$KdKpPengawas',
						
			NmPengusaha='$NmPengusaha',
			NipPengusaha='$NipPengusaha',
			NmPejabat='$NmPejabat',
			NipPejabat='$NipPejabat',
			ref_id='$ref_id',
			
			NmTuj='$NmTuj',
			NmPpjk='$NmPpjk',
			
			KdLokPeriksa='$KdLokPeriksa',
			KdKpPeriksa='$KdKpPeriksa',
			
			KdKemas='$KdKemas',
			JmlKemas='$JmlKemas',
			MerekKemas='$MerekKemas',
			
			VOL='$VOL',
			BRUTO='$BRUTO',
			NETTO='$NETTO',
			Total='$Total',
			TotalH='$TotalH'
			WHERE DokKdBc = '$DokKdBc' AND CAR LIKE '".$fhidden."'";	
			
	$ketlog="ubah data $NmMenu $DokKdBc $CAR";			
} else {
	//Validasi Data
	echo validasi(1,$CAR,$NoDaf) . "\n";
				
	// TAMBAH DATA KE TABEL HEADER	
	$sql[] = "INSERT INTO header (
			KdKpbcAsal,
			CAR,		
			KdJnsEkspor,
			KdKatEkspor,
			KdCrDagang,
			KdCrBayar,
			
			NoDaf,
			TgDaf,
			KdKpPengawas,
						
			NmPengusaha,
			NipPengusaha,
			NmPejabat,
			NipPejabat,
			ref_id,
			
			NmTuj,
			NmPpjk,
			
			KdLokPeriksa,
			KdKpPeriksa,
						
			KdKemas,
			JmlKemas,
			MerekKemas,
			
			VOL,
			BRUTO,
			NETTO,
			DokKdBc
			) VALUES (
			'$KdKpbcAsal',
			'$CAR',		
			'$KdJnsEkspor',
			'$KdKatEkspor',
			'$KdCrDagang',
			'$KdCrBayar',
			
			'$NoDaf',
			'$TgDaf',
			'$KdKpPengawas',
						
			'$NmPengusaha',
			'$NipPengusaha',
			'$NmPejabat',
			'$NipPejabat',
			'$ref_id',
			
			'$NmTuj',
			'$NmPpjk',
			
			'$KdLokPeriksa',
			'$KdKpPeriksa',
						
			'$KdKemas',
			'$JmlKemas',
			'$MerekKemas',
			
			'$VOL',
			'$BRUTO',
			'$NETTO',
			'$DokKdBc'
			)";
			
	$ketlog="tambah data $NmMenu $DokKdBc $CAR";			
}

//MANIPULASI DATA HDRPENGANGKUTAN
$sql[]="DELETE FROM hdrpengangkutan WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
$sql[] = "INSERT INTO hdrpengangkutan (
		  DokKdBc,CAR,CaraAngkut,NmAngkut,NoPolisi,KdNegara,TgKiraEkspor
		  ) VALUES (
		  '$DokKdBc','$CAR','$CaraAngkut','$NmAngkut','$NoPolisi','$KdNegara',
		  '$TgKiraEkspor'
		  )";	

//MANIPULASI DATA HDRPELABUHAN
$sql[]="DELETE FROM hdrpelabuhan WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
$sql[] = "INSERT INTO hdrpelabuhan (
		  DokKdBc,CAR,MuatAsal,MuatEkspor,Transit,Bongkar
		  ) VALUES (
		  '$DokKdBc','$CAR','$KdMuatAsal','$KdMuatEkspor','$KdTransit','$KdBongkar'
		  )";	
		  
//MANIPULASI DATA PERDAGANGAN		  
$sql[]="DELETE FROM hdrperdagangan WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
$sql[] = "INSERT INTO hdrperdagangan (
		  DokKdBc,CAR,KdDaerah,KdNegaraEkspor,KdCrSerahBrg
		  ) VALUES (
		  '$DokKdBc','$CAR','$KdDaerah','$KdNegaraEkspor','$KdCrSerahBrg'
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
			  UrBarang,HE,Tarif,qty,NETTO,FOB
			  ) VALUES (
			  '$DokKdBc','$CAR','$nolist2[$i]','$KdBarang[$i]',
			  '$UrBarang[$i]','$HE[$i]','$Tarif[$i]','$qty[$i]','$NETTO2[$i]','$FOB2[$i]'
			  )";	
}//AKHIR MANIPULASI DATA BARANG	

//MANIPULASI DATA JAMINAN
$sql[]="DELETE FROM hdrjaminan WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,NoTandaBayar,TglTandaBayar
		  ) VALUES (
		  '$DokKdBc','$CAR','SSPCP','$SSPCP','$TgSSPCP'
		  )";	
		  
if ($BK2 != ""){		  
	$sql[] = "INSERT INTO hdrjaminan (
			  DokKdBc,CAR,JnsJaminan,bayar,
			  KodeAkun,NoTandaBayar,TglTandaBayar
			  ) VALUES (
			  '$DokKdBc','$CAR','BK','$BK',
			  'NTB','$BK2','$BK3'
			  )";	
} else {
	$sql[] = "INSERT INTO hdrjaminan (
			  DokKdBc,CAR,JnsJaminan,bayar,
			  KodeAkun,NoTandaBayar,TglTandaBayar
			  ) VALUES (
			  '$DokKdBc','$CAR','BK','$BK',
			  'NTPN','$BK4','$BK5'
			  )";	
}

if ($PNBP2 != ""){		  
	$sql[] = "INSERT INTO hdrjaminan (
			  DokKdBc,CAR,JnsJaminan,bayar,
			  KodeAkun,NoTandaBayar,TglTandaBayar
			  ) VALUES (
			  '$DokKdBc','$CAR','PNBP','$PNBP',
			  'NTB','$PNBP2','$PNBP3'
			  )";	
} else {
	$sql[] = "INSERT INTO hdrjaminan (
			  DokKdBc,CAR,JnsJaminan,bayar,
			  KodeAkun,NoTandaBayar,TglTandaBayar
			  ) VALUES (
			  '$DokKdBc','$CAR','PNBP','$PNBP',
			  'NTPN','$PNBP4','$PNBP5'
			  )";	
}
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
	//echo json_encode(array('msg'=>$errmsg."\r\n".$Exception->getMessage()));
	echo $Exception->getMessage();
	exit(0);
}
?>