<?php 
require_once "../../models/abspath.php";
require_once "pdocon.php";
require_once "function.php";

//VARIABEL YANG DI POST
$DokKdBc=$_POST['DokKdBc'];
$fhidden=$_POST['fhidden'];
$CAR=$_POST['CAR'];
$KdKpbcAsal=$_POST['KdKpbcAsal'];
$KdJnsTpbAsal=$_POST['KdJnsTpbAsal'];
$JnsBc25=$_POST['JnsBc25'];
$kondisibrg=$_POST['kondisibrg'];

$NoDaf=$_POST['NoDaf'];
$TgDaf=dmys2ymd($_POST['TgDaf']);

$NmPengusaha=$_POST['NmPengusaha'];
$NipPengusaha=$_POST['NipPengusaha'];
$NmPejabat=$_POST['NmPejabat'];
$NipPejabat=$_POST['NipPejabat'];
$ref_id=$_POST['ref_id'];

$NmTuj=$_POST['NmTuj'];

$KdVal=$_POST['KdVal'];
$NDPBM=$_POST['NDPBM'];
$CIF=$_POST['CIF'];
$HrgSerah=$_POST['HrgSerah'];

$MerekKemas=$_POST['MerekKemas'];
$KdKemas=$_POST['KdKemas'];
$JmlKemas=$_POST['JmlKemas'];
$VOL=$_POST['VOL'];
$BRUTO=$_POST['BRUTO'];
$NETTO=$_POST['NETTO'];

$BM=$_POST['BM'];
$Cukai=$_POST['Cukai'];
$PPN=$_POST['PPN'];
$PPnBM=$_POST['PPnBM'];
$PPh=$_POST['PPh'];
$PNBP=$_POST['PNBP'];
$DBBMCukai=$_POST['DBBMCukai'];
$BungaPPNPPnBM=$_POST['BungaPPNPPnBM'];
$Total=$_POST['Total'];

$BM2=$_POST['BM2'];
$Cukai2=$_POST['Cukai2'];
$PPN2=$_POST['PPN2'];
$PPnBM2=$_POST['PPnBM2'];
$PPh2=$_POST['PPh2'];
$PNBP2=$_POST['PNBP2'];
$DBBMCukai2=$_POST['DBBMCukai2'];
$BungaPPNPPnBM2=$_POST['BungaPPNPPnBM2'];
$TotalH=$_POST['TotalH'];

$NoSSCP=$_POST['NoSSCP'];
$NoNTB=$_POST['NoNTB'];
$NoNTPN=$_POST['NoNTPN'];
$NoSSP=$_POST['NoSSP'];
$NoNTB2=$_POST['NoNTB2'];
$NoNTPN2=$_POST['NoNTPN2'];

$TgSSCP=dmys2ymd($_POST['TgSSCP']);
$TgNTB=dmys2ymd($_POST['TgNTB']);
$TgNTPN=dmys2ymd($_POST['TgNTPN']);
$TgSSP=dmys2ymd($_POST['TgSSP']);
$TgNTB2=dmys2ymd($_POST['TgNTB2']);
$TgNTPN2=dmys2ymd($_POST['TgNTPN2']);

//FORM DOKUMEN PELENGKAP
$nolist=explode("`", $_POST['nolist']);
$DokKd=explode("`", $_POST['DokKd']);
$DokNo=explode("`", $_POST['DokNo']);
$DokTg=explode("`", $_POST['DokTgDmy']);
//FORM BARANG
$nolist2=explode("`", $_POST['nolist2']);
$KdBarang=explode("`", $_POST['KdBarang']);
$UrBarang=explode("`", $_POST['UrBarang']);
$KdGunaBarang=explode("`", $_POST['KdGunaBarang']);
$Negara=explode("`", $_POST['Negara']);
$Tarif=explode("`", $_POST['Tarif']);
$qty=explode("`", $_POST['qty']);
$NETTO2=explode("`", $_POST['NETTO2']);
$VOL2=explode("`", $_POST['VOL2']);
$CIF2=explode("`", $_POST['CIF2']);
$HrgSerah2=explode("`", $_POST['HrgSerah2']);
//FORM PENGGUNAAN BARANG
$nolist3=explode("`", $_POST['nolist3']);
$KdJnsDok=explode("`", $_POST['KdJnsDok']);
$NoAju=explode("`", $_POST['NoAju']);
$NoUrut=explode("`", $_POST['NoUrut']);
$KdBarang2=explode("`", $_POST['KdBarang2']);
$UrBarang2=explode("`", $_POST['UrBarang2']);
$qty2=explode("`", $_POST['qty2']);
$CIF3=explode("`", $_POST['CIF3']);
$BM3=explode("`", $_POST['BM3']);
$Cukai3=explode("`", $_POST['Cukai3']);
$PPN3=explode("`", $_POST['PPN3']);
$PPnBM3=explode("`", $_POST['PPnBM3']);
$PPh3=explode("`", $_POST['PPh3']);

$tgl=date('Y-m-d H:i:s');
$usr=$_SESSION['userName'];
$NmMenu="bc25";

try {
	
$sql[] = "START TRANSACTION";

if ($fhidden != ""){	
	//UBAH DATA UNTUK TABEL HEADER
	$sql[] = "UPDATE header SET 
			CAR='$CAR',
			KdKpbcAsal='$KdKpbcAsal',
			KdJnsTpbAsal='$KdJnsTpbAsal',
			JnsBc25='$JnsBc25',
			KondisiBrg='$kondisibrg',
			
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
			Total='$Total',
			TotalH='$TotalH'
			WHERE DokKdBc = '$DokKdBc' AND CAR LIKE '".$fhidden."'";	
			
	$ketlog="ubah data $NmMenu $DokKdBc $CAR";			
} else {
	//Validasi Data
	echo validasi($DokKdBc,$CAR,$NoDaf) . "\n";
				
	// TAMBAH DATA KE TABEL HEADER
	$sql[] = "INSERT INTO header (
			CAR,KdTp,KdKpbcAsal,
			KdKpbcTuj,KdJnsTpbAsal,KdJnsTpbTuj,NoDaf,TgDaf,
			NmPengusaha,NipPengusaha,NmPejabat,NipPejabat,
			ref_id,NmTuj,
			NoSegel,JnsSegel,CatBcTuj,MerekKemas,KdKemas,
			JmlKemas,VOL,BRUTO,NETTO,
			Total,TotalH,			
			JnsBc25,KondisiBrg,DokKdBc
			) VALUES (
			'$CAR','$KdTp','$KdKpbcAsal',
			'$KdKpbcTuj','$KdJnsTpbAsal','$KdJnsTpbTuj','$NoDaf','$TgDaf',
			'$NmPengusaha','$NipPengusaha','$NmPejabat','$NipPejabat',
			'$ref_id','$NmTuj',
			'$NoSegel','$JnsSegel','$CatBcTuj','$MerekKemas','$KdKemas',
			'$JmlKemas','$VOL','$BRUTO','$NETTO',
			'$Total','$TotalH',
			'$JnsBc25','$kondisibrg','$DokKdBc'	
			)";
	
	$ketlog="tambah data $NmMenu $DokKdBc $CAR";			
}

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


//MANIPULASI DATA UNTUK LIST BARANG (TABEL barang)	
$jmlnodet=sizeof($nolist2)-1;
//SQL HAPUS DULU SEMUA barang
$sql[]="DELETE FROM barang WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
for ($i=0; $i<$jmlnodet; $i++){			
	$sql[] = "INSERT INTO barang (
			  DokKdBc,CAR,no,KdBarang,
			  UrBarang,KdGunaBarang,Negara,Tarif,qty,
			  NETTO,VOL,CIF,HrgSerah
			  ) VALUES (
			  '$DokKdBc','$CAR','$nolist2[$i]','$KdBarang[$i]',
			  '$UrBarang[$i]','$KdGunaBarang[$i]','$Negara[$i]','$Tarif[$i]','$qty[$i]',
			  '$NETTO2[$i]','$VOL2[$i]','$CIF2[$i]','$HrgSerah2[$i]'
			  )";	
}//AKHIR MANIPULASI DATA BARANG	

//MANIPULASI DATA JAMINAN
$sql[]="DELETE FROM hdrjaminan WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar,
		  hutang
		  ) VALUES (
		  '$DokKdBc','$CAR','BM','$BM',
		  '$BM2'
		  )";	
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar,
		  hutang
		  ) VALUES (
		  '$DokKdBc','$CAR','Cukai','$Cukai',
		  '$Cukai2'
		  )";	
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar,
		  hutang
		  ) VALUES (
		  '$DokKdBc','$CAR','PPN','$PPN',
		  '$PPN2'
		  )";	
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar,
		  hutang
		  ) VALUES (
		  '$DokKdBc','$CAR','PPnBM','$PPnBM',
		  '$PPnBM2'
		  )";	
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar,
		  hutang
		  ) VALUES (
		  '$DokKdBc','$CAR','PPh','$PPh',
		  '$PPh2'
		  )";
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar,
		  hutang
		  ) VALUES (
		  '$DokKdBc','$CAR','PNBP','$PNBP',
		  '$PNBP2'
		  )";
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar,
		  hutang
		  ) VALUES (
		  '$DokKdBc','$CAR','DBBMCukai','$DBBMCukai',
		  '$DBBMCukai2'
		  )";
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,bayar,
		  hutang
		  ) VALUES (
		  '$DokKdBc','$CAR','BungaPPNPPnBM','$BungaPPNPPnBM',
		  '$BungaPPNPPnBM2'
		  )";		  		  		  			  
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,NoTandaBayar,TglTandaBayar
		  ) VALUES (
		  '$DokKdBc','$CAR','SSCP','$NoSSCP','$TgSSCP'
		  )";
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,NoTandaBayar,TglTandaBayar
		  ) VALUES (
		  '$DokKdBc','$CAR','SSP','$NoSSP','$TgSSP'
		  )";		  
if ($NoNTB != ""){			  
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,KodeAkun,NoTandaBayar,TglTandaBayar
		  ) VALUES (
		  '$DokKdBc','$CAR','NTB','SSCP','$NoNTB','$TgNTB'
		  )";
} else {		  
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,KodeAkun,NoTandaBayar,TglTandaBayar
		  ) VALUES (
		  '$DokKdBc','$CAR','NTPN','SSCP','$NoNTPN','$TgNTPN'
		  )";
}

if ($NoNTB2 != ""){	
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,KodeAkun,NoTandaBayar,TglTandaBayar
		  ) VALUES (
		  '$DokKdBc','$CAR','NTB','SSP','$NoNTB2','$TgNTB2'
		  )";
} else {
$sql[] = "INSERT INTO hdrjaminan (
		  DokKdBc,CAR,JnsJaminan,KodeAkun,NoTandaBayar,TglTandaBayar
		  ) VALUES (
		  '$DokKdBc','$CAR','NTPN','SSP','$NoNTPN2','$TgNTPN2'
		  )";	
}
//AKHIR MANIPULASI DATA JAMINAN


//MANIPULASI DATA UNTUK LIST PENGGUNAAN BARANG (TABEL penggunaanbarang)	
$jmlnodet=sizeof($nolist3)-1;
//SQL HAPUS DULU SEMUA barang kembali
$sql[]="DELETE FROM penggunaanbarang WHERE DokKdBc = '$DokKdBc' AND CAR = '".$CAR."'";
for ($i=0; $i<$jmlnodet; $i++){			
	$sql[] = "INSERT INTO penggunaanbarang (
			  DokKdBc,CAR,no,KdJnsDok,NoAju,
			  NoUrut,KdBarang,UrBarang,
			  qty,CIF,BM,Cukai,
			  PPN,PPnBM,PPh
			  ) VALUES (
			  '$DokKdBc','$CAR','$nolist3[$i]','$KdJnsDok[$i]','$NoAju[$i]',
			  '$NoUrut[$i]','$KdBarang2[$i]','$UrBarang2[$i]',
			  '$qty2[$i]','$CIF3[$i]','$BM3[$i]','$Cukai3[$i]',
			  '$PPN3[$i]','$PPnBM3[$i]','$PPh3[$i]'
			  )";	
		
}//AKHIR MANIPULASI PENGGUNAAN BARANG

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