<?php
require_once "../../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";
require_once "toxls.php";

$kpbc=str_pad($_SESSION["KpbcPengawas"], 6, "0", STR_PAD_LEFT);
$KdPengguna=str_pad($_SESSION["KdPengguna"], 6, "0", STR_PAD_LEFT);
$NoReg1=str_pad($_SESSION["NoReg1"], 6, "0", STR_PAD_LEFT);
$NoReg2=str_pad($_SESSION["NoReg2"], 6, "0", STR_PAD_LEFT);

$DokKdBc=3;
$CAR=$_REQUEST['CAR'];

$q = "SELECT *,CONCAT('$KdPengguna-$NoReg1','-',DATE_FORMAT(TgDaf,'%Y%m%d'),'-',a.CAR) AS FCAR,CONCAT(LEFT(NoDaf,3),'.',RIGHT(NoDaf,3)) AS FNoDaf,DATE_FORMAT(TgDaf,'%d-%m-%Y') AS tgl_daf FROM header a 
		LEFT JOIN mst_perusahaan b ON b.NmPrshn=a.NmTuj
		LEFT JOIN hdrtransaksi c ON c.DokKdBc=a.DokKdBc AND c.CAR=a.CAR 
		
		WHERE a.DokKdBc='$DokKdBc' AND a.CAR='".$CAR."' LIMIT 1";
$rec = $pdo->query($q);
$rs = $rec->fetchAll(PDO::FETCH_ASSOC);

$qDokPelengkap="SELECT *,DATE_FORMAT(DokTg,'%d-%m-%Y') AS FDokTg FROM dokumen WHERE DokKdBc='$DokKdBc' AND CAR='".$CAR."' ORDER BY no";
$recDokPelengkap = $pdo->query($qDokPelengkap);
$rsDokPelengkap = $recDokPelengkap->fetchAll(PDO::FETCH_ASSOC);
$countDokPelengkap=count($rsDokPelengkap);

$qBarang = "SELECT * FROM barang a 
			INNER JOIN mst_barang b ON b.KdBarang=a.KdBarang 
			INNER JOIN mst_penggunaanbarang c ON c.KdGuna=a.KdGunaBarang
			INNER JOIN mst_negara d ON d.KdNegara=a.Negara
			WHERE DokKdBc='$DokKdBc' AND CAR='".$CAR."' ORDER BY no";
$recBarang = $pdo->query($qBarang);
$rsBarang = $recBarang->fetchAll(PDO::FETCH_ASSOC);
$countBarang=count($rsBarang);

$qSumBarang="SELECT SUM(qty) as totQty,SUM(CIF) as totCIF,SUM(HrgSerah) as totHrgSerah FROM barang WHERE DokKdBc='$DokKdBc' AND CAR='".$CAR."'";
$recSumBarang = $pdo->query($qSumBarang);
$rsSumBarang = $recSumBarang->fetchAll(PDO::FETCH_ASSOC);
$totQty=$rsSumBarang[0]['totQty'];
$totCIF=$rsSumBarang[0]['totCIF'];
$totHrgSerah=$rsSumBarang[0]['totHrgSerah'];

$qJaminan = "SELECT *,DATE_FORMAT(TglTandaBayar,'%d-%m-%Y') AS TglTandaBayar1 FROM hdrjaminan WHERE DokKdBc='$DokKdBc' AND CAR='$CAR'";
$run=$pdo->query($qJaminan);	
$rsJaminan=$run->fetchAll(PDO::FETCH_ASSOC);
foreach ($rsJaminan as $rJaminan){
	if ($rJaminan['JnsJaminan']=="BM"){				
		$BM=$rJaminan['bayar'];
		$BM2=$rJaminan['hutang'];
	} else if ($rJaminan['JnsJaminan']=="Cukai"){
		$Cukai=$rJaminan['bayar'];
		$Cukai2=$rJaminan['hutang'];
	} else if ($rJaminan['JnsJaminan']=="PPN"){	
		$PPN=$rJaminan['bayar'];
		$PPN2=$rJaminan['hutang'];
	} else if ($rJaminan['JnsJaminan']=="PPnBM"){
		$PPnBM=$rJaminan['bayar'];
		$PPnBM2=$rJaminan['hutang'];
	} else if ($rJaminan['JnsJaminan']=="PPh"){
		$PPh=$rJaminan['bayar'];
		$PPh2=$rJaminan['hutang'];
	} else if ($rJaminan['JnsJaminan']=="PNBP"){
		$PNBP=$rJaminan['bayar'];
		$PNBP2=$rJaminan['hutang'];
	} else if ($rJaminan['JnsJaminan']=="DBBMCukai"){
		$DBBMCukai=$rJaminan['bayar'];
		$DBBMCukai2=$rJaminan['hutang'];
	} else if ($rJaminan['JnsJaminan']=="BungaPPNPPnBM"){
		$BungaPPNPPnBM=$rJaminan['bayar'];
		$BungaPPNPPnBM2=$rJaminan['hutang'];	
	} else if ($rJaminan['JnsJaminan']=="SSCP"){
		$NoSSCP=$rJaminan['NoTandaBayar'];
		$TgSSCP=$rJaminan['TglTandaBayar1'];
	} else if ($rJaminan['JnsJaminan']=="SSP"){
		$NoSSP=$rJaminan['NoTandaBayar'];
		$TgSSP=$rJaminan['TglTandaBayar1'];
	}
	
	if ($rJaminan['JnsJaminan']=="NTB" && $rJaminan['KodeAkun']=="SSCP"){
		$NoNTB=$rJaminan['NoTandaBayar'];
		$TgNTB=$rJaminan['TglTandaBayar1'];
	} else if ($rJaminan['JnsJaminan']=="NTB" && $rJaminan['KodeAkun']=="SSP"){
		$NoNTB2=$rJaminan['NoTandaBayar'];
		$TgNTB2=$rJaminan['TglTandaBayar1'];
	}
	
	if ($rJaminan['JnsJaminan']=="NTPN" && $rJaminan['KodeAkun']=="SSCP"){
		$NoNTPN=$rJaminan['NoTandaBayar'];
		$TgNTPN=$rJaminan['TglTandaBayar1'];
	} else if ($rJaminan['JnsJaminan']=="NTPN" && $rJaminan['KodeAkun']=="SSP"){
		$NoNTPN2=$rJaminan['NoTandaBayar'];
		$TgNTPN2=$rJaminan['TglTandaBayar1'];	
	}
}

$qBarangG= "SELECT *,CONCAT('$KdPengguna-$NoReg1','-',DATE_FORMAT(TgDaf,'%Y%m%d'),'-',a.NoAju) AS FCAR 
			FROM penggunaanbarang a 
			LEFT JOIN header b ON b.DokKdBc=a.KdJnsDok AND b.CAR=a.NoAju
			LEFT JOIN mst_barang c ON c.KdBarang=a.KdBarang
			INNER JOIN jenis_dok d ON d.KdJnsDok=a.KdJnsDok
			WHERE a.DokKdBc='$DokKdBc' AND a.CAR='".$CAR."' 
			ORDER BY no";
$recBarangG = $pdo->query($qBarangG);
$rsBarangG = $recBarangG->fetchAll(PDO::FETCH_ASSOC);
$countBarangG=count($rsBarangG);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="expires" content="0">
<meta name="Author" content="Kikin Kusumah" />
<TITLE>APLIKASI BEA CUKAI</TITLE>
<style type="text/css" media="all">	
#borderAll {
    border: 1px solid #000;	  	    
}
.p_spacing{
    margin-top:4px;
    margin-bottom:4px;
}
table.tablereport {
    /*page-break-after:always;*/
    border: 1px solid #000;	
    border-collapse:collapse;
    margin:5px 0pt 10px;		
    font-size: 9pt;
    width: 8.27in;	
    /*height:11.69in;*/
    height:10.90in;
}
table.tablereport thead tr td{		
    border: 1px solid #000;		
    font-size: 9pt;		
    padding: 4px;
    vertical-align:top;
}	
table.tablereport tbody tr td {
    border: 1px solid #000;		
    font-size: 9pt;		
    padding: 4px;
    vertical-align:top;
}
table.tablereport tfoot tr td {
    border: 1px solid #000;		
    font-size: 9pt;		
    padding: 4px;
    vertical-align:top;
}
.borderall{
    border:1px #000 solid !important;
}
.noborder{
    border:1px #FFF solid !important;
}
.noborderlbr{
	border-left:hidden !important; 
    border-bottom:hidden !important;
	border-right:hidden !important;
}
.noborderlrb{		
	border-left:hidden !important;     
	border-right:hidden !important;	
	border-bottom:hidden !important;
}
.nobordertr{
    border-top:hidden !important;
    border-right:hidden !important;
}
.nobordert{
    border-top:hidden !important;	
}
.noborderright{
    border-right:hidden !important;
}
.noborderbtm{
    border-bottom:hidden !important;
}
.noborderrb{
    border-right:hidden !important;
    border-bottom:hidden !important;
}	
</style>
<body>
<table cellpadding="1" cellspacing="0" class="tablereport">
<tbody>
<tr>
  <td align="center" colspan="2" valign="middle"><h2>BC 2.5 </h2></td>
  <td class="noborderright">&nbsp;</td>
  <td align="center" colspan="14"><h3>PEMBERITAHUAN IMPOR BARANG DARI TEMPAT PENIMBUNAN BERIKAT</h3></td>
</tr>
<tr>
  <td colspan="17"><b>HEADER</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">NOMOR PENGAJUAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4"><?php echo $rs[0]['FCAR'] ?></td>
  <td align="right" colspan="9">Halaman 1 Dari ...
    <?php //if($countBarang > 1 && $countDokPelengkap > 0){echo "3";}else if($countBarang > 1 || $countDokPelengkap > 0){echo "2";} else { echo "1";} ?>
  &nbsp; &nbsp; </td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">A. KANTOR PABEAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo getKantor($rs[0]['KdKpbcAsal']) ?></td>
  <td class="noborderbtm" colspan="9"><b>H. KOLOM KHUSUS BEA DAN CUKAI</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">B. JENIS TPB</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo getJnsTpb($rs[0]['KdJnsTpbAsal']) ?></td>
  <td class="noborderrb" colspan="2">Nomor Pendaftaran</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6"><span class="borderall">&nbsp;<?php echo $rs[0]['FNoDaf'] ?>&nbsp;</span></td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3">C. JENIS BC 2.5</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">1. Biasa &nbsp; &nbsp; 2. Berkala &nbsp; <span class="borderall" style="padding-left:5px; padding-right:5px;"><?php echo $rs[0]['JnsBc25'] ?></span></b></td>
  <td class="noborderrb" colspan="2">Tanggal</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6"><span class="borderall">&nbsp;<?php echo $rs[0]['tgl_daf'] ?>&nbsp;</span></td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3">D. KONDISI BARANG</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">1. Baik &nbsp; &nbsp; &nbsp;2. Rusak &nbsp; &nbsp; <span class="borderall" style="padding-left:5px; padding-right:5px;"><?php echo $rs[0]['KondisiBrg'] ?></span></b></td>
  <td class="noborderright" colspan="2"></td>
  <td class="noborderright"></td>
  <td colspan="6"></td>
</tr> 
<tr>
	<td class="nobordertr" width="30"></td>
    <td class="nobordertr" width="71"></td>
    <td class="nobordertr" width="30"></td>
    <td class="nobordertr" width="11"></td>
    <td class="nobordertr" width="53"></td>
    <td width="33" class="nobordertr"></td>
    <td class="nobordertr" width="52"></td>
    
    <td class="nobordert" width="95"></td>    
    <td class="nobordertr" width="74"></td>    
    <td class="nobordertr" width="62"></td>
    <td class="nobordertr" width="11"></td>
    <td width="39" class="nobordertr"></td>
    <td class="nobordertr" width="8"></td>
    <td class="nobordertr" width="86"></td>
    <td class="nobordertr" width="25"></td>
    <td class="nobordertr" width="51"></td>
    <td class="nobordert" width="27"></td>
</tr>
<tr>
  <td colspan="17"><b>E. DATA PEMBERITAHUAN</b></td>
</tr>
<tr>
  <td colspan="8">PENGUSAHA TPB</td>  
  <td colspan="9">PENERIMA BARANG</td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">1. NPWP</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo $_SESSION['npwp'] ?></td>
  <td class="noborderrb" colspan="2">5. NPWP</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6"><?php echo $rs[0]['NpwpPrshn'] ?></td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3">2. NAMA</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo $_SESSION['c_name'] ?></td>
  <td class="noborderrb" colspan="2">6. NAMA</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6"><?php echo $rs[0]['NmTuj'] ?></td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3" valign="top">3. ALAMAT</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo $_SESSION['c_address'] ?></td>
  <td class="noborderrb" colspan="2">7. ALAMAT</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6"><?php echo $rs[0]['AlmtPrshn']." ".$rs[0]['Kota'] ?></td>
</tr>
<tr>
  <td class="noborderright" colspan="3" valign="top">4. NO IZIN TPB</td>
  <td class="noborderright">:</td>
  <td colspan="4"><?php echo $_SESSION['NoTpb'] ?></td>
  <td class="noborderright" colspan="2">8. NIPER</td>
  <td class="noborderright">:</td>
  <td colspan="6"><?php echo $rs[0]['Niper'] ?></td>
</tr> 
<tr>
  <td colspan="17"><b>DOKUMEN PELENGKAP PABEAN</b></td>  
</tr>
<tr>
  <td class="noborderrb" colspan="2">9. Invoice</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="3"><?php echo getDokPelengkap(3,$rs[0]['CAR'],1,1) ?></td>
  <td class="noborderbtm" colspan="2">Tgl. <?php echo getDokPelengkap(3,$rs[0]['CAR'],1,2) ?></td>
  <td class="noborderbtm" colspan="9"><span class="noborderrb">12. Surat Keputusan/Persetujuan  :</span></td>
</tr>
<tr>
  <td class="noborderrb" colspan="2">10. Packing List</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="3"><?php echo getDokPelengkap(3,$rs[0]['CAR'],2,1) ?></td>
  <td class="noborderbtm" colspan="2">Tgl. <?php echo getDokPelengkap(3,$rs[0]['CAR'],2,2) ?></td>
  <td class="noborderrb" colspan="4"> &nbsp; &nbsp; &nbsp; <?php echo getDokPelengkap(3,$rs[0]['CAR'],5,1) ?></td>
  <td class="noborderbtm" colspan="5">Tgl. <?php echo getDokPelengkap(3,$rs[0]['CAR'],5,2) ?></td>
</tr> 
<tr>
  <td class="noborderrb" colspan="2">11. Kontrak</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="3"><?php echo getDokPelengkapAll(3,$rs[0]['CAR'],3,1) ?></td>
  <td class="noborderbtm" colspan="2"><?php echo getDokPelengkapAll(3,$rs[0]['CAR'],3,2) ?></td>
  <td class="noborderbtm" colspan="9">13. Jenis / nomor / tanggal dokumen lainnya : </td>
</tr>
<tr>
  <td class="noborderright" colspan="4"> &nbsp; &nbsp;</td>
  <td colspan="4">&nbsp;</td>
  <td class="noborderright" colspan="4"> &nbsp; &nbsp; &nbsp; <?php echo getDokPelengkap(3,$rs[0]['CAR'],6,1) ?></td>
  <td colspan="5">Tgl. <?php echo getDokPelengkap(3,$rs[0]['CAR'],6,2) ?></td>
</tr>
<tr>
  <td colspan="17"><b>DATA PERDAGANGAN</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">14. Jenis Valuta Asing</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4"><?php echo $rs[0]['KdVal'] ?></td>
  <td class="noborderrb" colspan="2">16. Nilai CIF</td>
  <td class="noborderrb" align="right" colspan="2">:</td>
  <td class="noborderrb" colspan="2" align="right"><?php echo number_format($rs[0]['CIF']/$rs[0]['NDPBM'],2) ?></td>
  <td class="noborderbtm" colspan="4"></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">15. NDPPBM</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4"><?php echo number_format($rs[0]['NDPBM'],2) ?></td>
  <td class="noborderrb" colspan="2"></td>
  <td class="noborderrb" align="right" colspan="2">Rp :</td>
  <td class="noborderrb" colspan="2" align="right"><?php echo number_format($rs[0]['CIF'],2) ?></td>
  <td class="noborderbtm" colspan="4"></td>
</tr>
<tr>
  <td class="noborderright" colspan="3"></td>
  <td class="noborderright"></td>
  <td class="noborderright" colspan="4"></td>
  <td class="noborderright" colspan="2">17. Harga Penyerahan </td>
  <td class="noborderright" align="right" colspan="2">Rp :</td>  
  <td  class="noborderright" colspan="2" align="right" ><?php echo number_format($rs[0]['HrgSerah'],2) ?></td>
  <td colspan="4"></td>
</tr>
<tr>
  <td colspan="17"><b>DATA PENGEMAS</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">18. Jenis Kemasan</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4"><?php echo $rs[0]['KdKemas']." (".getKemasan($rs[0]['KdKemas']).")" ?></td>
  <td class="noborderbtm" colspan="9">20. Jumlah Kemasan : <?php echo number_format($rs[0]['JmlKemas']) ?></td>
</tr>
<tr>
  <td class="noborderright" colspan="3">19. Merek Kemasan</td>
  <td class="noborderright">:</td>
  <td colspan="13"><?php echo $rs[0]['MerekKemas'] ?></td>
</tr>
<tr>
  <td colspan="17"><b>DATA BARANG</b></td>
</tr>
<tr>
  <td class="noborderright" colspan="5">21. Volume (m3) : <?php echo number_format($rs[0]['VOL'],4) ?></td>
  <td class="noborderright" colspan="3">22. Berat Kotor (kg) : <?php echo number_format($rs[0]['BRUTO'],2) ?></td>
  <td colspan="9">23. Berat Bersih (kg) : <?php echo number_format($rs[0]['NETTO'],2) ?></td>
</tr>
<tr>
  <td class="noborderbtm" width="30">24.</td>
  <td class="noborderrb">25.</td>
  <td class="noborderbtm" colspan="5">&nbsp;</td>
  <td class="noborderbtm">26.</td>
  <td class="noborderbtm">27.</td>
  <td class="noborderbtm" colspan="2">28.</td>
  <td class="noborderbtm" colspan="3">29.</td>
  <td class="noborderbtm" colspan="3">30.</td>
</tr>
<tr>
  <td>No. </td>
  <td colspan="6">Uraian Jumlah dan Jenis Barang secara Lengkap,<br>Kode Barang, Merk, Tipe, Ukuran, dan Spesifikasi Lain</td>
  <td>Kode Penggunaan Barang </td>
  <td>Negara Asal Barang </td>
  <td colspan="2">- Skema Tarif <br> - Tarif </td>
  <td colspan="3">- Jumlah dan Jenis Satuan<br>- Berat Bersih (Kg)<br>- Volume (m3) </td>
  <td colspan="3">- Nilai CIF<br>- Harga Penyerahan</td>
</tr>
<?php
if ($countBarang==1){
$str = "";
for ($i=0;$i<$countBarang;$i++):
$HsNo=($rsBarang[$i]['HsNo']=="")?"-":$rsBarang[$i]['HsNo'];
$UrBarang=($rsBarang[$i]['UrBarang']=="")?"-":$rsBarang[$i]['UrBarang'];
$qty=($rsBarang[$i]['qty']=="")?"-":$rsBarang[$i]['qty']." ".$rsBarang[$i]['Sat'];
$KdBarang=($rsBarang[$i]['KdBarang']=="")?"-":$rsBarang[$i]['KdBarang'];
$NmGuna=($rsBarang[$i]['NmGuna']=="")?"-":$rsBarang[$i]['NmGuna'];
$NmNegara=$rsBarang[$i]['NmNegara'];
$Tarif=$rsBarang[$i]['Tarif'];
$CIF=($rsBarang[$i]['CIF']/$rs[0]['NDPBM']<1)?"-":number_format($rsBarang[$i]['CIF']/$rs[0]['NDPBM'],2);
$HrgSerah=($rsBarang[$i]['HrgSerah']<1)?"-":number_format($rsBarang[$i]['HrgSerah'],2);

if ($i+1==$countBarang){
	$borderBrg="class=\"borderAll\"";
	$borderBrg2="class=\"noborderright\"";
} else {
	$borderBrg="class=\"noborderbtm\"";
	$borderBrg2="class=\"noborderrb\"";
}
?>
<tr>
  <td align="center" <?php echo $borderBrg ?>><?php echo $rsBarang[$i]['no'] ?></td>
  <td <?php echo $borderBrg ?> colspan="6"><?php echo $HsNo."<br>".$UrBarang."<br>".$qty." ".$Sat."<br>Kode barang :".$KdBarang; ?></td>
  <td align="center" <?php echo $borderBrg ?>><?php echo $NmGuna ?></td>
  <td align="center" <?php echo $borderBrg ?>><?php echo $NmNegara ?></td>
  <td <?php echo $borderBrg ?> colspan="2"><?php echo $Tarif ?></td>
  <td align="right" <?php echo $borderBrg ?> colspan="3"><?php echo $qty ?> &nbsp; &nbsp; &nbsp; </td>  
  <td align="right" <?php echo $borderBrg2 ?>><?php //echo $rs[0]['KdVal'] ?></td>
  <td align="right" colspan="2" <?php echo $borderBrg2 ?>><?php echo $CIF."&nbsp;&nbsp;<br>-&nbsp;&nbsp;<br>".$HrgSerah; ?>&nbsp;&nbsp;</td>
</tr>
<?php 
endfor; 
} else {
?>
<tr>
  <td> </td>
  <td align="center" colspan="16"><b>" LIHAT LEMBAR LANJUTAN "</b></td>
</tr> 
<?php
}
?>
<tr>
  <td align="center" colspan="8" style=""><b>DATA PENERIMAAN NEGARA</b></td>
  <td align="center" colspan="9"><b>BUKTI PEMBAYARAN</b></td>
</tr>
<tr>
  <td align="center" colspan="5">Jenis Pungutan</td>
  <td align="center" colspan="2">Dibayar (Rp)</td>
  <td align="center">Dibebaskan (Rp)</td>
  <td align="center" class="noborderrb"> SSCP </td>
  <td class="noborderrb" colspan="4">No. <?php echo $NoSSCP ?></td>
  <td class="noborderbtm" colspan="4">Tgl. : <?php echo $TgSSCP ?></td>
</tr>
<tr>
  <td colspan="5">31. BM</td>
  <td align="right" colspan="2"><?php echo number_format($BM,2) ?>&nbsp; </td>
  <td align="right"><?php echo number_format($BM2,2) ?>&nbsp; </td>
  <td align="center" class="noborderrb">NTB</td>
  <td class="noborderrb" colspan="4">No. <?php echo $NoNTB ?></td>
  <td class="noborderbtm" colspan="4">Tgl. : <?php echo $TgNTB ?></td>
</tr>
<tr>
  <td colspan="5">32. CUKAI</td>
  <td align="right" colspan="2"><?php echo number_format($Cukai,2) ?>&nbsp; </td>
  <td align="right"><?php echo number_format($Cukai2,2) ?>&nbsp; </td>
  <td align="center" class="noborderrb">NTPN</td>
  <td class="noborderrb" colspan="4">No. <?php echo $NoNTPN ?></td>
  <td class="noborderbtm" colspan="4">Tgl. : <?php echo $TgNTPN ?></td>
</tr>
<tr>
  <td colspan="5">33. PPN</td>
  <td align="right" colspan="2"><?php echo number_format($PPN,2) ?>&nbsp;</td>
  <td align="right"><?php echo number_format($PPN2,2) ?>&nbsp;</td>
  <td align="center" class="noborderrb">SSP</td>
  <td class="noborderrb" colspan="4">No. <?php echo $NoSSP ?></td>
  <td class="noborderbtm" colspan="4">Tgl. : <?php echo $TgSSP ?></td>
</tr>
<tr>
  <td colspan="5">34. PPnBM</td>
  <td align="right" colspan="2"><?php echo number_format($PPnBM,2) ?>&nbsp; </td>
  <td align="right"><?php echo number_format($PPnBM,2) ?>&nbsp; </td>
  <td align="center" class="noborderrb">NTB</td>
  <td class="noborderrb" colspan="4">No. <?php echo $NoNTB2 ?></td>
  <td class="noborderbtm" colspan="4">Tgl. : <?php echo $TgNTB2 ?></td>
</tr>
<tr>
  <td colspan="5">35. PPh</td>
  <td align="right" colspan="2"><?php echo number_format($PPh,2) ?>&nbsp; </td>
  <td align="right"><?php echo number_format($PPh2,2) ?>&nbsp; </td>
  <td align="center" class="noborderrb">NTPN No.</td>
  <td class="noborderrb" colspan="4">No. <?php echo $NoNTPN2 ?></td>
  <td class="noborderbtm" colspan="4">Tgl. : <?php echo $TgNTPN2 ?></td>
</tr>
<tr>
  <td colspan="5">36. PNBP</td>
  <td align="right" colspan="2"><?php echo number_format($PNBP,2) ?>&nbsp; </td>
  <td align="right"><?php echo number_format($PNBP2,2) ?>&nbsp; </td>
  <td class="noborderrb">&nbsp;</td>
  <td align="center" class="noborderbtm" colspan="12">Nama / Stempel Instansi</td>
</tr>
<tr>
  <td colspan="5">37. Denda/bunga BM dan Cukai (D/B)</td>
  <td align="right" colspan="2"><?php echo number_format($DBBMCukai,2) ?>&nbsp; </td>
  <td align="right"><?php echo number_format($DBBMCukai2,2) ?>&nbsp; </td>
  <td class="noborderrb">&nbsp;</td>
  <td align="center" class="noborderbtm" colspan="12">ttd</td>
</tr>
<tr>
  <td colspan="5">38. Bunga PPN dan PPnBM</td>
  <td align="right" colspan="2"><?php echo number_format($BungaPPNPPnBM,2) ?>&nbsp; </td>
  <td align="right"><?php echo number_format($BungaPPNPPnBM2,2) ?>&nbsp; </td>
  <td class="noborderrb">&nbsp;</td>
  <td align="center" class="noborderbtm" colspan="12">( &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; )</td>
</tr>
<tr>
  <td colspan="5">39. Total</td>
  <td align="right" colspan="2"><?php echo number_format($rs[0]['Total'],2) ?>&nbsp; </td>
  <td align="right"><?php echo number_format($rs[0]['TotalH'],2) ?>&nbsp; </td>
  <td class="noborderright">&nbsp;</td>
  <td align="center" colspan="12">Pejabat Penerima</td>
</tr>
<tr>
  <td colspan="6"><b>I. CATATAN PEJABAT BEA DAN CUKAI</b></td>
  <td colspan="5"><b>F. TANDA TANGAN PENGUSAHA TPB</b></td>
  <td colspan="6"><b>G. PENERIMA BARANG</b></td>
</tr>
<tr>
  <td align="center" colspan="6">&nbsp;<br><br><br><br><br></td>
  <td colspan="5">
  Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal 
  yang diberitahukan dalam pemberitahuan pabean ini.<br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Subang, <?php echo $rs[0]['tgl_daf'] ?><br><br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b>( <?php echo $rs[0]['NmPengusaha'] ?> )</b></td>
  <td align="center" colspan="6"><br><br>
  Subang, <?php echo $rs[0]['tgl_daf'] ?><br><br><br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>
  <b>( <?php echo $rs[0]['NmCPTuj'] ?> )</td>
</tr> 
</tbody>
</table>
<div style="page-break-after:always;font-size: 9pt; margin-top:-2px;">
Rangkap ke- 1/2/3/4 : Pengusaha TPB / Penerima Barang / Kantor Pabean / Pejabat BC di TPB
</div>
<?php if($countBarang>1): ?>
<table cellpadding="1" cellspacing="0" class="tablereport">
<tbody>
<tr>
  <td align="center" colspan="2"><h2>BC 2.5</h2></td>
  <td class="noborderright">&nbsp;</td>
  <td align="center" colspan="14"><h3>LEMBAR LANJUTAN<br>DATA BARANG</h3></td>
</tr>
<tr>
  <td colspan="17"><b>HEADER</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">NOMOR PENGAJUAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4"><?php echo $rs[0]['FCAR'] ?></td>
  <td align="right" colspan="9">Halaman 2 Dari ...
    <?php //if ($countDokPelengkap > 0){echo "2 Dari 3";}else{echo "2 Dari 2";}?>&nbsp; &nbsp; </td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">A. KANTOR PABEAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo $rs[0]['KdKpbcAsal'] ?></td>
  <td class="noborderbtm" colspan="9"><b>F. KOLOM KHUSUS BEA DAN CUKAI</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">B. JENIS TPB</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo getJnsTpb($rs[0]['KdJnsTpbAsal']) ?></td>
  <td class="noborderrb" colspan="2">Nomor Pendaftaran</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6"><span class="borderall">&nbsp;<?php echo $rs[0]['FNoDaf'] ?>&nbsp;</span></td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3">C. JENIS BC 2.5</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">1. Biasa &nbsp; &nbsp; 2. Berkala &nbsp; <span class="borderall" style="padding-left:5px; padding-right:5px;"><?php echo $rs[0]['JnsBc25'] ?></span></td>
  <td class="noborderrb" colspan="2">Tanggal</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6"><span class="borderall">&nbsp;<?php echo $rs[0]['tgl_daf'] ?>&nbsp;</span></td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3">D. KONDISI BARANG</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">1. Baik &nbsp; &nbsp; &nbsp;2. Rusak &nbsp; &nbsp; <span class="borderall" style="padding-left:5px; padding-right:5px;"><?php echo $rs[0]['KondisiBrg'] ?></span></td>
  <td class="noborderright" colspan="2"></td>
  <td class="noborderright"></td>
  <td colspan="6"></td>
</tr>  
<tr>
	<td class="nobordertr" width="32"></td>
    <td class="nobordertr" width="80"></td>
    <td class="nobordertr" width="30"></td>
    <td class="nobordertr" width="11"></td>
    <td class="nobordertr" width="50"></td>
    <td width="8" class="nobordertr"></td>
    <td class="nobordertr" width="48"></td>
    
    <td class="nobordert" width="101"></td>    
    <td class="nobordertr" width="70"></td>    
    <td class="nobordertr" width="37"></td>
    <td class="nobordertr" width="31"></td>
    <td width="50" class="nobordertr"></td>
    <td class="nobordertr" width="40"></td>
    <td class="nobordertr" width="70"></td>
    <td class="nobordertr" width="50"></td>
    <td class="nobordertr" width="30"></td>
    <td class="nobordert" width="20"></td>
</tr>
<tr>
  <td class="noborderbtm" width="32">24.</td>
  <td class="noborderrb">25.</td>
  <td class="noborderbtm" colspan="5">&nbsp;</td>
  <td class="noborderbtm">26.</td>
  <td class="noborderbtm">27.</td>
  <td class="noborderbtm" colspan="2">28.</td>
  <td class="noborderbtm" colspan="3">29.</td>
  <td class="noborderbtm" colspan="3">30.</td>
</tr>
<tr>
  <td>No. </td>
  <td colspan="6">Uraian Jumlah dan Jenis Barang secara Lengkap, Kode Barang, Merk, Tipe, Ukuran, dan Spesifikasi Lain</td>
  <td>Kode Penggunaan Barang </td>
  <td>Negara Asal Barang </td>
  <td colspan="2">- Skema Tarif <br> - Tarif </td>
  <td colspan="3">- Jumlah dan Jenis Satuan<br>- Berat Bersih (Kg)<br>- Volume (m3) </td>
  <td colspan="3">- Nilai CIF<br>- Harga Penyerahan</td>
</tr>
<?php
$str = "";
for ($i=0;$i<$countBarang;$i++):
$HsNo=($rsBarang[$i]['HsNo']=="")?"-":$rsBarang[$i]['HsNo'];
$UrBarang=($rsBarang[$i]['UrBarang']=="")?"-":$rsBarang[$i]['UrBarang'];
$qty=($rsBarang[$i]['qty']=="")?"-":$rsBarang[$i]['qty']." ".$rsBarang[$i]['Sat'];
$KdBarang=($rsBarang[$i]['KdBarang']=="")?"-":$rsBarang[$i]['KdBarang'];
$NmGuna=($rsBarang[$i]['NmGuna']=="")?"-":$rsBarang[$i]['NmGuna'];
$NmNegara=$rsBarang[$i]['NmNegara'];
$Tarif=$rsBarang[$i]['Tarif'];
$CIF=($rsBarang[$i]['CIF']/$rs[0]['NDPBM']<1)?"-":number_format($rsBarang[$i]['CIF']/$rs[0]['NDPBM'],2);
$HrgSerah=($rsBarang[$i]['HrgSerah']<1)?"-":number_format($rsBarang[$i]['HrgSerah'],2);

?>
<tr>
  <td align="center" class="noborderbtm"><?php echo $rsBarang[$i]['no'] ?></td>
  <td class="noborderbtm" colspan="6">><?php echo $HsNo."<br>".$UrBarang."<br>".$qty." ".$Sat."<br>Kode barang :".$KdBarang; ?></td>
  <td align="center" class="noborderbtm"><?php echo $Nm ?></td>
  <td align="center" class="noborderbtm"><?php echo $NmNegara ?></td>
  <td class="noborderbtm" colspan="2"><?php echo $Tarif ?></td>
  <td align="right" class="noborderbtm" colspan="3"><?php echo $qty ?> &nbsp; &nbsp; &nbsp; </td>  
  <td align="right" class="noborderrb"><?php echo $rs[0]['KdVal'] ?></td>
  <td align="right" class="noborderbtm" colspan="2"><?php echo $CIF."&nbsp;&nbsp;<br>-&nbsp;&nbsp;<br>".$HrgSerah; ?>&nbsp;&nbsp;</td>
</tr>
<?php endfor; ?>
<tr height="100%">
  <td></td>
  <td align="right" colspan="6" style="vertical-align:bottom"></td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center" colspan="2" style="vertical-align:bottom"></td>
  <td align="right" colspan="3" style="vertical-align:bottom"><?php //echo $totQty." ".$rsBarang[0]['unit'] ?> &nbsp; &nbsp; &nbsp; </td>
  <td align="right" class="noborderright" style="vertical-align:bottom"><?php //echo $rs[0]['KdVal'] ?></td>
  <td align="right" class="noborderright" style="vertical-align:bottom"><?php //echo number_format($totCIF,2) ?></td>
  <td align="right">&nbsp;</td>
</tr>
<tr>
  <td colspan="8"><b>F. TANDA TANGAN PENGUSAHA TPB</b></td>
  <td colspan="9"><b>G. PENERIMA BARANG</b></td>
</tr>
<tr>
  <td colspan="8">&nbsp;Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal<br>
yang diberitahukan dalam pemberitahuan pabean ini.<br>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Subang, Tgl. <?php echo $rs[0]['tgl_daf'] ?><br>
<br>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>( <?php echo $rs[0]['NmPengusaha'] ?> )</b><br></td>
  <td align="center" colspan="9">
  <br>
  <br>
  Subang, Tgl. <?php echo $rs[0]['tgl_daf'] ?><br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>
  <b>( <?php echo $rs[0]['NmCPTuj'] ?> )</b><br>&nbsp;</td>
</tr> 
</tbody>
</table>
<div style="page-break-after:always;font-size: 9pt; margin-top:-2px;">
Rangkap ke- 1/2/3/4 : Pengusaha TPB / Penerima Barang / Kantor Pabean / Pejabat BC di TPB
</div>
<?php endif; if(count($rsDokPelengkap>0)): ?>
<table cellpadding="1" cellspacing="0" class="tablereport">
<tbody>
<tr>
  <td align="center" colspan="2"><h2>BC 2.5</h2></td>
  <td class="noborderright">&nbsp;</td>
  <td align="center" colspan="14"><h3>LEMBAR LAMPIRAN<br>DOKUMEN PELENGKAP PABEAN</h3></td>
</tr>
<tr>
  <td colspan="17"><b>HEADER</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">NOMOR PENGAJUAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4"><?php echo $rs[0]['FCAR'] ?></td>
  <td align="right" colspan="9">Halaman ... Dari ... <?php //if ($countBarang > 1){echo "3 Dari 3";}else{echo "2 Dari 2";}?>&nbsp; &nbsp; </td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">A. KANTOR PABEAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo $rs[0]['KdKpbcAsal'] ?></td>
  <td class="noborderbtm" colspan="9"><b>F. KOLOM KHUSUS BEA DAN CUKAI</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">B. JENIS TPB</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo getJnsTpb($rs[0]['KdJnsTpbAsal']) ?></td>
  <td class="noborderrb" colspan="2">Nomor Pendaftaran</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6"><span class="borderall">&nbsp;<?php echo $rs[0]['FNoDaf'] ?>&nbsp;</span></td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3">C. JENIS BC 2.5</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">1. Biasa &nbsp; &nbsp; 2. Berkala &nbsp; <span class="borderall" style="padding-left:5px; padding-right:5px;"><?php echo $rs[0]['JnsBc25'] ?></span></td>
  <td class="noborderrb" colspan="2">Tanggal</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6"><span class="borderall">&nbsp;<?php echo $rs[0]['tgl_daf'] ?>&nbsp;</span></td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3">D. KONDISI BARANG</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">1. Baik &nbsp; &nbsp; &nbsp;2. Rusak &nbsp; &nbsp; <span class="borderall" style="padding-left:5px; padding-right:5px;"><?php echo $rs[0]['KondisiBrg'] ?></span></td>
  <td class="noborderright" colspan="2"></td>
  <td class="noborderright"></td>
  <td colspan="6"></td>
</tr>  
<tr>
	<td class="nobordertr" width="10"></td>
    <td class="nobordertr" width="80"></td>
    <td class="nobordertr" width="30"></td>
    <td class="nobordertr" width="5"></td>
    <td class="nobordertr" width="50"></td>
    <td class="nobordertr"></td>
    <td class="nobordertr" width="60"></td>    
    <td class="nobordert" width="50"></td> 
       
    <td class="nobordertr" width="50"></td>        
    <td class="nobordertr" width="50"></td>
    <td class="nobordertr" width="5"></td>
    <td class="nobordertr"></td>
    <td class="nobordertr" width="40"></td>
    <td class="nobordertr" width="70"></td>
    <td class="nobordertr" width="50"></td>
    <td class="nobordertr" width="30"></td>
    <td class="nobordert" width="20"></td>
</tr>
<tr>
  <td align="center" width="20">NO.</td>
  <td class="noborderright"></td>
  <td colspan="6">JENIS DOKUMEN</td>
  <td align="center" colspan="5">NOMOR</td>
  <td align="center" colspan="4">TANGGAL</td>
</tr>
<?php for($i=0;$i<$countDokPelengkap;$i++):?>
<tr>
  <td align="center" class="noborderbtm"><?php echo $rsDokPelengkap[$i]['no'] ?></td>
  <td class="noborderbtm" colspan="7"><?php echo getUrKdJnsDok($rsDokPelengkap[$i]['DokKd'])?></td>
  <td align="center" class="noborderbtm" colspan="5"><?php echo $rsDokPelengkap[$i]['DokNo']?></td>
  <td align="center" class="noborderbtm" colspan="4"><?php echo $rsDokPelengkap[$i]['FDokTg']?></td>
</tr>
<?php endfor; ?>
<tr height="100%">
  <td></td>
  <td colspan="7"></td>
  <td colspan="5"></td>
  <td colspan="4"></td>
</tr>
<tr>
  <td class="noborderright" colspan="9"><b>F. TANDA TANGAN PENGUSAHA TPB</b></td>
  <td colspan="8">&nbsp;</td>
</tr>
<tr>
  <td class="noborderright" colspan="9">
    Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal 
  yang diberitahukan dalam pemberitahuan pabean ini.<br>
  <br>
&nbsp; &nbsp; &nbsp; &nbsp; Subang, Tgl. <?php echo $rs[0]['tgl_daf'] ?><br>
<br>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;( <?php echo $rs[0]['NmPengusaha'] ?> )<br><br></td>
  <td colspan="8">&nbsp;</td>
</tr> 
</tbody>
</table>
<div style="page-break-after:always;font-size: 9pt; margin-top:-2px;">
Rangkap ke- 1/2/3/4 : Pengusaha TPB / Penerima Barang / Kantor Pabean / Pejabat BC di TPB
</div>
<?php endif; ?>
<?php if($countBarangG>0): ?>
<table cellpadding="1" cellspacing="0" class="tablereport">
<tbody>
<tr>
  <td align="center" colspan="2"><h2>BC 2.5</h2></td>
  <td class="noborderright">&nbsp;</td>
  <td align="center" colspan="14"><h3>LEMBAR LAMPIRAN<br>
DATA PENGGUNAAN BARANG DAN/ATAU BAHAN IMPOR</h3></td>
</tr>
<tr>
  <td colspan="17"><b>HEADER</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">NOMOR PENGAJUAN</td>
  <td class="noborderrb" colspan="5">: <?php echo $rs[0]['FCAR'] ?></td>
  <td align="right" colspan="9">Halaman 2 Dari ...
    <?php //if ($countDokPelengkap > 0){echo "2 Dari 3";}else{echo "2 Dari 2";}?>&nbsp; &nbsp; </td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">A. KANTOR PABEAN</td>
  <td class="noborderbtm" colspan="5">: <?php echo $rs[0]['KdKpbcAsal'] ?></td>
  <td class="noborderbtm" colspan="9"><b>F. KOLOM KHUSUS BEA DAN CUKAI</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">B. JENIS TPB</td>
  <td class="noborderbtm" colspan="5">: <?php echo getJnsTpb($rs[0]['KdJnsTpbAsal']) ?></td>
  <td class="noborderrb" colspan="2">Nomor Pendaftaran</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6"><span class="borderall">&nbsp;<?php echo $rs[0]['FNoDaf'] ?>&nbsp;</span></td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3">C. JENIS BC 2.5</td>
  <td class="noborderbtm" colspan="5">: 1. Biasa &nbsp; &nbsp; 2. Berkala &nbsp; <span class="borderall" style="padding-left:5px; padding-right:5px;"><?php echo $rs[0]['JnsBc25'] ?></span></td>
  <td class="noborderrb" colspan="2">Tanggal</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6"><span class="borderall">&nbsp;<?php echo $rs[0]['tgl_daf'] ?>&nbsp;</span></td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3">D. KONDISI BARANG</td>
  <td class="noborderbtm" colspan="5">: 1. Baik &nbsp; &nbsp; &nbsp;2. Rusak &nbsp; &nbsp; <span class="borderall" style="padding-left:5px; padding-right:5px;"><?php echo $rs[0]['KondisiBrg'] ?></span></td>
  <td class="noborderright" colspan="2"></td>
  <td class="noborderright"></td>
  <td colspan="6"></td>
</tr> 
<tr>
	<td class="nobordertr" width="68"></td>
    <td class="nobordertr" width="74"></td>
    <td class="nobordertr" width="22"></td>
    <td class="nobordertr" width="103"></td>
    <td class="nobordertr" width="38"></td>
    <td width="16" class="nobordertr"></td>
    <td class="nobordertr" width="40"></td>
    
    <td class="nobordert" width="34"></td>    
    <td class="nobordertr" width="47"></td>    
    <td class="nobordertr" width="46"></td>
    <td class="nobordertr" width="18"></td>
    <td width="69" class="nobordertr"></td>
    <td class="nobordertr" width="31"></td>
    <td class="nobordertr" width="60"></td>
    <td class="nobordertr" width="25"></td>
    <td class="nobordertr" width="33"></td>
    <td class="nobordert" width="34"></td>
</tr>
<tr>
  <td align="center">No. Urut Barang</td>
  <td colspan="2">- No / Tgl Aju <br>- No / Tgl Daftar <br>
  - Kantor Pabean *)<br> 
  &nbsp; BC 2.3 *)<br> &nbsp; BC 2.4,<br> &nbsp; BC 2.7.</td>
  <td>- No. Urut Dalam<br> 
  &nbsp; BC 2.3 *)<br> &nbsp; BC 2.4,<br> &nbsp; BC 2.7.</td>
  <td colspan="6">  Pos Tarif HS, Uraian Jumlah dan Jenis Barang secara Lengkap,<br>Kode Barang, Merk, Tipe, Ukuran, dan Spesifikasi Lain</td>
  <td colspan="2">- Jumlah <br>- Satuan</td>
  <td colspan="2">Nilai <br>- CIF <br>- (Rp)</td>
  <td colspan="3">Nilai (Rp) <br>- BM, Cukai <br>- PPN, PPnBM</td>
</tr>
<tr>
  <td align="center"><b>1</b></td>
  <td align="center" colspan="2"><b>2</b></td>
  <td align="center"><b>3</b></td>
  <td align="center" colspan="6"><b>4</b></td>
  <td align="center" colspan="2"><b>5</b></td>
  <td align="center" colspan="2"><b>6</b></td>
  <td align="center" colspan="3"><b>7</b></td>
</tr>
<?php 
$temp=""; 
for($i=0;$i<$countBarangG;$i++): 
$FCAR=($rsBarangG[$i]['FCAR']=="")?"-":$rsBarangG[$i]['FCAR'];
$NoDaf=($rsBarangG[$i]['NoDaf']=="")?"-":$rsBarangG[$i]['NoDaf'];
$TgDaf=($rsBarangG[$i]['TgDaf']=="")?"-":$rsBarangG[$i]['TgDaf'];

$HsNo=($rsBarangG[$i]['HsNo']=="")?"-":$rsBarangG[$i]['HsNo'];
$UrBarang=($rsBarangG[$i]['UrBarang']=="")?"-":$rsBarangG[$i]['UrBarang'];
$KdBarang=($rsBarangG[$i]['KdBarang']=="")?"-":$rsBarangG[$i]['KdBarang'];
$qty=($rsBarangG[$i]['qty']=="")?"-":$rsBarangG[$i]['qty']." ".$rsBarangG[$i]['Sat'];
$CIF=($rsBarangG[$i]['CIF']/$rs[0]['NDPBM']<1)?"-":number_format($rsBarangG[$i]['CIF']/$rs[0]['NDPBM'],2);
$CIFRP=($rsBarangG[$i]['CIF']<1)?"-":number_format($rsBarangG[$i]['CIF'],2);

$BM=($rsBarangG[$i]['BM']<1)?"-":number_format($rsBarangG[$i]['BM'],2);
$Cukai=($rsBarangG[$i]['Cukai']<1)?"-":number_format($rsBarangG[$i]['Cukai'],2);
$PPN=($rsBarangG[$i]['PPN']<1)?"-":number_format($rsBarangG[$i]['PPN'],2);
$PPnBM=($rsBarangG[$i]['PPnBM']<1)?"-":number_format($rsBarangG[$i]['PPnBM'],2);
$PPh=($rsBarangG[$i]['PPh']<1)?"-":number_format($rsBarangG[$i]['PPh'],2);
?>
<tr>
  <td align="center" class="noborderbtm"><?php echo $rsBarangG[$i]['no'] ?> </td>
  <td class="noborderbtm" colspan="2"><?php echo $FCAR."<br>".$rsBarangG[$i]['UrJnsDok']."No. ".$NoDaf."/".$TgDaf."<br>"; ?></td>
  <td align="center" class="noborderbtm"><?php echo $rsBarangG[$i]['NoUrut']."<br><br>"; ?></td>
  <td class="noborderbtm" colspan="6"><?php echo $HsNo."<br>".$UrBarang."<br>Kode barang: ".$KdBarang ?></td>
  <td align="right" class="noborderbtm" colspan="2"><?php echo $qty ?> &nbsp; &nbsp; &nbsp; </td>
  <td align="right" class="noborderbtm" colspan="2"><?php echo $CIF."&nbsp;&nbsp;<br>Rp. ".$CIFRP."&nbsp;&nbsp;";?></td>
  <td align="right" class="noborderbtm" colspan="3"><?php echo $BM."&nbsp;&nbsp;<br>".$Cukai."&nbsp;&nbsp;<br>".$PPN."&nbsp;&nbsp;<br>".$PPnBM."&nbsp;&nbsp;<br>".$PPh."&nbsp;&nbsp;";?></td>
</tr>
<?php $temp=$rsBarangG[$i]['NoUrut']; endfor; ?>
<tr height="100%">
  <td></td>
  <td colspan="2"></td>
  <td></td>
  <td colspan="6"></td>
  <td colspan="2"></td>
  <td colspan="2"></td>
  <td colspan="3"></td>
</tr>
<tr>
  <td class="noborderright" colspan="8"><b>F. TANDA TANGAN PENGUSAHA TPB</b></td>
  <td colspan="9">&nbsp;</td>
</tr>
<tr>
  <td class="noborderright" colspan="8">
    Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal
yang<br>diberitahukan dalam pemberitahuan pabean ini.<br>
<br>
&nbsp; &nbsp; &nbsp; &nbsp; Subang, Tgl. <?php echo $rs[0]['tgl_daf'] ?><br>
<br>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;( <?php echo $rs[0]['NmPengusaha'] ?> )<br><br><br><br></td>
  <td colspan="9">&nbsp;</td>
</tr> 
</tbody>
</table>
<div style="page-break-after:always;font-size: 9pt; margin-top:-2px;">
Rangkap ke- 1/2/3/4 : Pengusaha TPB / Penerima Barang / Kantor Pabean / Pejabat BC di TPB
</div>
<?php endif; ?>
</body>
</html>