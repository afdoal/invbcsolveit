<?php
require_once "../models/abspath.php";
// menggunakan class phpExcelReader
include "excel_reader2.php";
// koneksi ke mysql
mysql_connect("localhost", "root", "");
mysql_select_db("bc_dada");
 
// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo $basedir ?>themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo $basedir ?>themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo $basedir ?>themes/main.css">
<script type="text/javascript" src="<?php echo $basedir ?>models/jquery.min.js"></script>
</head>
<body> 
<?php 
// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);
 
// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;

// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
for ($i=2; $i<=$baris; $i++)
{
//TABEL HEADER	
// membaca data DokKdBc (kolom A)
$DokKdBc = $data->val($i, 1);
// membaca data CAR (kolom B)
$CAR = $data->val($i, 2);
// membaca data NoDaf (kolom C)
$NoDaf = $data->val($i, 3);
// membaca data TgDaf(kolom D)
$TgDaf = $data->val($i, 4);
// membaca data KdTp (kolom E)
$KdTp = $data->val($i, 5);
// membaca data KdKpbcAsal (kolom F)
$KdKpbcAsal = $data->val($i, 6);
// membaca data KdKpbcTuj (kolom G)
$KdKpbcTuj = $data->val($i, 7);
// membaca data KdJnsTpbAsal (kolom H)
$KdJnsTpbAsal = $data->val($i, 7);
// membaca data KdJnsTpbTuj (kolom I)
$KdJnsTpbTuj = $data->val($i, 8);
// membaca data JnsBc25 (kolom J)
$JnsBc25 = $data->val($i, 9);
// membaca data KondisiBrg (kolom K)
$KondisiBrg = $data->val($i, 10);
// membaca data KdTujKirim (kolom L)
$KdTujKirim = $data->val($i, 11);
// membaca data NpwpTuj (kolom M)
$NpwpTuj = $data->val($i, 12);
// membaca data NmTuj (kolom N)
$NmTuj = $data->val($i, 13);
// membaca data AlamatTuj (kolom O)
$AlamatTuj = $data->val($i, 14);
// membaca data NoTpbTuj (kolom P)
$NoTpbTuj = $data->val($i, 15);
// membaca data Niper(kolom Q)
$Niper = $data->val($i, 16);
// membaca data NmCPTuj (kolom R)
$NmCPTuj = $data->val($i, 17);
// membaca data NoBcAsal (kolom S)
$NoBcAsal = $data->val($i, 18);
// membaca data TgBcAsal (kolom T)
$TgBcAsal = $data->val($i, 19);
// membaca data KdVal (kolom U)
$KdVal = $data->val($i, 20);
// membaca data NDPBM (kolom V)
$NDPBM = $data->val($i, 21);
// membaca data CIF (kolom W)
$CIF= $data->val($i, 22);
// membaca data HrgSerah (kolom X)
$HrgSerah = $data->val($i, 23);
// membaca data JnsAngkut (kolom Y)
$JnsAngkut = $data->val($i, 24);
// membaca data NoPolisi (kolom Z)
$NoPolisi = $data->val($i, 25);
// membaca data NoSegel (kolom AA)
$NoSegel = $data->val($i, 26);
// membaca data JnsSegel (kolom AB)
$JnsSegel = $data->val($i, 27);
// membaca data CatBcTuj (kolom AC)
$CatBcTuj = $data->val($i, 28);
// membaca data MerekKemas(kolom AD)
$MerekKemas = $data->val($i, 29);
// membaca data KdKemas (kolom AE)
$KdKemas = $data->val($i, 30);
// membaca data JmlKemas (kolom AF)
$JmlKemas = $data->val($i, 31);
// membaca data VOL (kolom AG)
$VOL = $data->val($i, 32);
// membaca data BRUTO (kolom AH)
$BRUTO = $data->val($i, 33);
// membaca data NETTO (kolom AI)
$NETTO = $data->val($i, 34);
// membaca data BM (kolom AJ)
$BM = $data->val($i, 35);
// membaca data Cukai (kolom AK)
$Cukai = $data->val($i, 36);
// membaca data PPN (kolom AL)
$PPN = $data->val($i, 37);
// membaca data PPnBM (kolom AM)
$PPnBM = $data->val($i, 38);
// membaca data PPh22 (kolom AN)
$PPh22 = $data->val($i, 39);
// membaca data PNBP(kolom AO)
$PNBP = $data->val($i, 40);
// membaca data DBBMCukai (kolom AP)
$DBBMCukai = $data->val($i, 41);
// membaca data BungaPPNPPnBM (kolom AQ)
$BungaPPNPPnBM = $data->val($i, 42);
// membaca data Total (kolom AR)
$Total = $data->val($i, 43);
// membaca data JnsJaminan (kolom AS)
$JnsJaminan = $data->val($i, 44);
// membaca data NoJaminan (kolom AT)
$NoJaminan = $data->val($i, 45);
// membaca data TgJaminan (kolom AU)
$TgJaminan = $data->val($i, 46);
// membaca data NilaiJaminan (kolom AV)
$NilaiJaminan = $data->val($i, 47);
// membaca data JatuhTempo (kolom AW)
$JatuhTempo = $data->val($i, 48);
// membaca data Penjamin (kolom AX)
$Penjamin = $data->val($i, 49);
// membaca data NoBukti (kolom AY)
$NoBukti = $data->val($i, 50);
// membaca data TgBukti(kolom AZ)
$TgBukti = $data->val($i, 51);
// membaca data NoSSCP (kolom BA)
$NoSSCP = $data->val($i, 52);
// membaca data TgSSCP (kolom BB)
$TgSSCP = $data->val($i, 53);
// membaca data NoNTB (kolom BC)
$NoNTB = $data->val($i, 54);
// membaca data TgNTB (kolom BD)
$TgNTB = $data->val($i, 55);
// membaca data NoNTPN (kolom BE)
$NoNTPN = $data->val($i, 56);
// membaca data TgNTPN (kolom BF)
$TgNTPN = $data->val($i, 57);
// membaca data NoSSP (kolom BG)
$NoSSP = $data->val($i, 58);
// membaca data TgSSP (kolom BH)
$TgSSP = $data->val($i, 59);
// membaca data NoNTB2 (kolom BI)
$NoNTB2 = $data->val($i, 60);
// membaca data TgNTB2 (kolom BJ)
$TgNTB2 = $data->val($i, 61);
// membaca data NoNTPN2 (kolom BK)
$NoNTPN2 = $data->val($i, 62);
// membaca data TgNTPN2(kolom BL)
$TgNTPN2 = $data->val($i, 63);
// membaca data matinoutdo_id (kolom BM)
$matinoutdo_id = $data->val($i, 64);
// membaca data NmPengusaha (kolom BN)
$NmPengusaha = $data->val($i, 65);
// membaca data NipPengusaha (kolom BO)
$NipPengusaha = $data->val($i, 66);
// membaca data NmPejabat (kolom BP)
$NmPejabat = $data->val($i, 67);
// membaca data NipPejabat (kolom BQ)
$NipPejabat = $data->val($i, 68);
// membaca data pilmatinoutdo_id (kolom BR)
$pilmatinoutdo_id = $data->val($i, 69);

//TABEL DOKUMEN
// membaca data noDok (kolom BS)
$noDok = $data->val($i, 70);
// membaca data DokKd (kolom BT)
$DokKd = $data->val($i, 71);
// membaca data DokNo (kolom BU)
$DokNo = $data->val($i, 72);
// membaca data DokTg (kolom BV)
$DokTg = $data->val($i, 73);

//TABEL BARANG
// membaca data noBrg (kolom BW)
$noBrg = $data->val($i, 74);
// membaca data fgmat_id (kolom BX)
$fgmat_id = $data->val($i, 75);
// membaca data KdBarang (kolom BY)
$KdBarang = $data->val($i, 76);
// membaca data UrBarang (kolom BZ)
$UrBarang = $data->val($i, 77);
// membaca data KdGunaBarang (kolom CA)
$KdGunaBarang = $data->val($i, 78);
// membaca data Negara (kolom CB)
$Negara = $data->val($i, 79);
// membaca data Tarif (kolom CC)
$Tarif = $data->val($i, 80);
// membaca data qty (kolom CD)
$qty = $data->val($i, 81);
// membaca data unit (kolom CE)
$unit = $data->val($i, 82);
// membaca data price (kolom CF)
$price = $data->val($i, 83);
// membaca data kurs (kolom CG)
$kurs = $data->val($i, 84);
// membaca data VOLBrg (kolom CH)
$VOLBrg = $data->val($i, 85);
// membaca data NETTOBrg (kolom CI)
$NETTOBrg = $data->val($i, 86);
// membaca data CIFBrg (kolom CJ)
$CIFBrg = $data->val($i, 87);
// membaca data HrgSerah (kolom CK)
$HrgSerah = $data->val($i, 88);
// membaca data Ket (kolom CL)
$Ket = $data->val($i, 89);

//TABEL PENGGUNAAN BARANG
// membaca data noGunaBrg (kolom CM)
$noGunaBrg = $data->val($i, 90);
// membaca data NoUrut (kolom CN)
$NoUrut = $data->val($i, 91);
// membaca data NoAju (kolom CO)
$NoAju = $data->val($i, 92);
// membaca data TgAju (kolom CP)
$TgAju = $data->val($i, 93);
// membaca data NoUrutAju (kolom CQ)
$NoUrutAju = $data->val($i, 94);
// membaca data NoDafGunaBrg (kolom CR)
$NoDafGunaBrg = $data->val($i, 95);
// membaca data TgDafGunaBrg (kolom CS)
$TgDafGunaBrg = $data->val($i, 96);
// membaca data NoUrutDaf (kolom CT)
$NoUrutDaf = $data->val($i, 97);
// membaca data fgmat_id (kolom CU)
$fgmat_id = $data->val($i, 98);
// membaca data HS (kolom CV)
$HS = $data->val($i, 99);
// membaca data UrGunaBrg (kolom CW)
$UrGunaBrg = $data->val($i, 100);
// membaca data qtyGunaBrg (kolom CX)
$qtyGunaBrg = $data->val($i, 101);
// membaca data unitGunaBrg (kolom CY)
$unitGunaBrg = $data->val($i, 102);
// membaca data CIFGunaBrg (kolom CZ)
$CIFGunaBrg = $data->val($i, 103);
// membaca data BMGunaBrg (kolom DA)
$BMGunaBrg = $data->val($i, 104);
// membaca data PPNGunaBrg (kolom DB)
$PPNGunaBrg = $data->val($i, 105);
// membaca data PPhGunaBrg (kolom DC)
$PPhGunaBrg = $data->val($i, 106);

//TABEL BARANG KEMBALI
// membaca data noBrgKem (kolom DD)
$noBrgKem = $data->val($i, 107);
// membaca data fgmat_id (kolom DE)
$fgmat_id = $data->val($i, 108);
// membaca data KdBrgKem (kolom DF)
$KdBrgKem = $data->val($i, 109);
// membaca data UrBrgKem (kolom DG)
$UrBrgKem = $data->val($i, 110);
// membaca data NegaraBrgKem (kolom DH)
$NegaraBrgKem = $data->val($i, 111);
// membaca data TarifBrgKem (kolom DI)
$TarifBrgKem = $data->val($i, 112);
// membaca data qtyBrgKem (kolom DJ)
$qtyBrgKem = $data->val($i, 113);
// membaca data unitBrgKem (kolom DK)
$unitBrgKem = $data->val($i, 114);
// membaca data priceBrgKem (kolom DL)
$priceBrgKem = $data->val($i, 115);
// membaca data kursBrgKem (kolom DM)
$kursBrgKem = $data->val($i, 116);
// membaca data VOLBrgKem (kolom DN)
$VOLBrgKem = $data->val($i, 117);
// membaca data NETTOBrgKem (kolom DO)
$NETTOBrgKem = $data->val($i, 118);
// membaca data CIFBrgKem (kolom DP)
$CIFBrgKem = $data->val($i, 119);
// membaca data HrgSerahBrgKem (kolom DQ)
$HrgSerahBrgKem = $data->val($i, 120);


// setelah data dibaca, sisipkan ke dalam tabel header
$query = "INSERT INTO header VALUES ('$DokKdBc','$CAR','$NoDaf','$TgDaf','$KdTp','$KdKpbcAsal','$KdKpbcTuj','$KdJnsTpbAsal','$KdJnsTpbTuj','$JnsBc25','$KondisiBrg','$KdTujKirim','$NpwpTuj','$NmTuj','$AlamatTuj','$NoTpbTuj','$Niper','$NmCPTuj','$NoBcAsal','$TgBcAsal','$KdVal','$NDPBM','$CIF','$HrgSerah','$JnsAngkut','$NoPolisi','$NoSegel','$JnsSegel','$CatBcTuj','$MerekKemas','$KdKemas','$JmlKemas','$VOL','$BRUTO','$NETTO','$BM','$Cukai','$PPN','$PPnBM','$PPh22','$PNBP','$DBBMCukai','$BungaPPNPPnBM','$Total','$JnsJaminan','$NoJaminan','$TgJaminan','$NilaiJaminan','$JatuhTempo','$Penjamin','$NoBukti','$TgBukti','$NoSSCP','$TgSSCP','$NoNTB','$TgNTB','$NoNTPN','$TgNTPN','$NoSSP','$TgSSP','$NoNTB2','$TgNTB2','$NoNTPN2','$TgNTPN2','$matinoutdo_id','$NmPengusaha','$NipPengusaha','$NmPejabat','$NipPejabat','$pilmatinoutdo_id'
)
		  ON DUPLICATE KEY UPDATE NoDaf='$NoDaf',TgDaf='$TgDaf',KdTp='$KdTp',KdKpbcAsal='$KdKpbcAsal',KdKpbcTuj='$KdKpbcTuj',KdJnsTpbAsal='$KdJnsTpbAsal',KdJnsTpbTuj='$KdJnsTpbTuj',JnsBc25='$JnsBc25',KondisiBrg='$KondisiBrg',KdTujKirim='$KdTujKirim',NpwpTuj='$NpwpTuj',NmTuj='$NmTuj',AlamatTuj='$AlamatTuj',NoTpbTuj='$NoTpbTuj',Niper='$Niper',NmCPTuj='$NmCPTuj',NoBcAsal='$NoBcAsal',TgBcAsal='$TgBcAsal',KdVal='$KdVal',NDPBM='$NDPBM',CIF='$CIF',HrgSerah='$HrgSerah',JnsAngkut='$JnsAngkut',NoPolisi='$NoPolisi',NoSegel='$NoSegel',JnsSegel='$JnsSegel',CatBcTuj='$CatBcTuj',MerekKemas='$MerekKemas',KdKemas='$KdKemas',JmlKemas='$JmlKemas',VOL='$VOL',BRUTO='$BRUTO',NETTO='$NETTO',BM='$BM',Cukai='$Cukai',PPN='$PPN',PPnBM='$PPnBM',PPh22='$PPh22',PNBP='$PNBP',DBBMCukai='$DBBMCukai',BungaPPNPPnBM='$BungaPPNPPnBM',Total='$Total',JnsJaminan='$JnsJaminan',NoJaminan='$NoJaminan',TgJaminan='$TgJaminan',NilaiJaminan='$NilaiJaminan',JatuhTempo='$JatuhTempo',Penjamin='$Penjamin',NoBukti='$NoBukti',TgBukti='$TgBukti',NoSSCP='$NoSSCP',TgSSCP='$TgSSCP',NoNTB='$NoNTB',TgNTB='$TgNTB',NoNTPN='$NoNTPN',TgNTPN='$TgNTPN',NoSSP='$NoSSP',TgSSP='$TgSSP',NoNTB2='$NoNTB2',TgNTB2='$TgNTB2',NoNTPN2='$NoNTPN2',TgNTPN2='$TgNTPN2',matinoutdo_id='$matinoutdo_id',NmPengusaha='$NmPengusaha',NipPengusaha='$NipPengusaha',NmPejabat='$NmPejabat',NipPejabat='$NipPejabat',pilmatinoutdo_id='$pilmatinoutdo_id' ";
$hasil = mysql_query($query);

// setelah data dibaca, sisipkan ke dalam tabel dokumen
$q2= "INSERT INTO dokumen VALUES ('$DokKdBc','$CAR','$noDok','$DokKd','$DokNo','$DokTg'
)
		  ON DUPLICATE KEY UPDATE no='$noDok',DokKd='$DokKd',DokNo='$DokNo',DokTg='$DokTg' ";
$hasil2 = mysql_query($q2);

// setelah data dibaca, sisipkan ke dalam tabel barang
$q3= "INSERT INTO barang VALUES ('$DokKdBc','$CAR','$noBrg','$fgmat_id','$KdBarang','$UrBarang','$KdGunaBarang','$Negara','$Tarif','$qty','$unit','$price','$kurs','$VOLBrg','$NETTOBrg','$CIFBrg','$HrgSerah','$Ket'

)
		  ON DUPLICATE KEY UPDATE no='$noBrg',fgmat_id='$fgmat_id',KdBarang='$KdBarang',UrBarang='$UrBarang',KdGunaBarang='$KdGunaBarang',Negara='$Negara',Tarif='$Tarif',qty='$qty',unit='$unit',price='$price',kurs='$kurs',VOL='$VOLBrg',NETTO='$NETTOBrg',CIF='$CIFBrg',HrgSerah='$HrgSerah',Ket='$Ket' ";
$hasil3 = mysql_query($q3);

// setelah data dibaca, sisipkan ke dalam tabel penggunaanbarang
$q4= "INSERT INTO penggunaanbarang VALUES ('$DokKdBc','$CAR','$noGunaBrg','$NoUrut','$NoAju','$TgAju','$NoUrutAju','$NoDafGunaBrg','$TgDafGunaBrg','$NoUrutDaf','$fgmat_id','$HS','$UrGunaBrg','$qtyGunaBrg','$unitGunaBrg','$CIFGunaBrg','$BMGunaBrg','$PPNGunaBrg','$PPhGunaBrg'


)
		  ON DUPLICATE KEY UPDATE no='$noGunaBrg',NoUrut='$NoUrut',NoAju='$NoAju',TgAju='$TgAju',NoUrutAju='$NoUrutAju',NoDaf='$NoDafGunaBrg',TgDaf='$TgDafGunaBrg',NoUrutDaf='$NoUrutDaf',fgmat_id='$fgmat_id',HS='$HS',UrBarang='$UrGunaBrg',qty='$qtyGunaBrg',unit='$unitGunaBrg',CIF='$CIFGunaBrg',BM='$BMGunaBrg',PPN='$PPNGunaBrg',PPh='$PPhGunaBrg' ";
$hasil4 = mysql_query($q4);

// setelah data dibaca, sisipkan ke dalam tabel barangkembali
$q5= "INSERT INTO barangkembali VALUES ('$DokKdBc','$CAR','$noBrgKem','$fgmat_id','$KdBrgKem','$UrBrgKem','$NegaraBrgKem','$TarifBrgKem','$qtyBrgKem','$unitBrgKem','$priceBrgKem','$kursBrgKem','$VOLBrgKem','$NETTOBrgKem','$CIFBrgKem','$HrgSerahBrgKem'
)
		  ON DUPLICATE KEY UPDATE no='$noBrgKem',fgmat_id='$fgmat_id',KdBarang='$KdBrgKem',UrBarang='$UrBrgKem',Negara='$NegaraBrgKem',Tarif='$TarifBrgKem',qty='$qtyBrgKem',unit='$unitBrgKem',price='$priceBrgKem',kurs='$kursBrgKem',VOL='$VOLBrgKem',NETTO='$NETTOBrgKem',CIF='$CIFBrgKem',HrgSerah='$HrgSerahBrgKem'
 ";
$hasil5 = mysql_query($q5);

// jika proses insert data sukses, maka counter $sukses bertambah
// jika gagal, maka counter $gagal yang bertambah
if ($hasil) $sukses++;
else $gagal++;
}
?>
<div id="w" class="easyui-window"  collapsible="false" minimizable="false" maximizable="false" title="RESULT" style="width:400px;height:150px; padding:10px;"> 
<?php 
// tampilan status sukses dan gagal
echo "<h3>Proses import data selesai.</h3>";
echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
echo "Jumlah data yang gagal diimport : ".$gagal."</p>";
?>
</div>
</body>
</html>