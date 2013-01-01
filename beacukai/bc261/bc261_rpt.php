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

$DokKdBc=4;
$CAR=$_REQUEST['CAR'];

$q = "SELECT *,CONCAT('$KdPengguna-$NoReg1','-',DATE_FORMAT(TgDaf,'%Y%m%d'),'-',a.CAR) AS FCAR,CONCAT(LEFT(NoDaf,3),'.',RIGHT(NoDaf,3)) AS FNoDaf,DATE_FORMAT(TgDaf,'%d-%m-%Y') AS tgl_daf FROM header a 
		LEFT JOIN mst_perusahaan b ON b.NmPrshn=a.NmTuj
		LEFT JOIN hdrtransaksi c ON c.DokKdBc=a.DokKdBc AND c.CAR=a.CAR 
		LEFT JOIN hdrpengangkutan d ON d.DokKdBc=a.DokKdBc AND d.CAR=a.CAR		WHERE a.DokKdBc='$DokKdBc' AND a.CAR='".$CAR."' LIMIT 1";
$rec = $pdo->query($q);
$rs = $rec->fetchAll(PDO::FETCH_ASSOC);

$qDokPelengkap="SELECT *,DATE_FORMAT(DokTg,'%d-%b-%y') AS FDokTg FROM dokumen WHERE DokKdBc='$DokKdBc' AND CAR='".$CAR."' ORDER BY no";
$recDokPelengkap = $pdo->query($qDokPelengkap);
$rsDokPelengkap = $recDokPelengkap->fetchAll(PDO::FETCH_ASSOC);
$countDokPelengkap=count($rsDokPelengkap);

$qBarang = "SELECT * FROM barang a 
			INNER JOIN mst_barang b ON b.KdBarang=a.KdBarang 
			INNER JOIN mst_negara c ON c.KdNegara=a.Negara
			WHERE DokKdBc='$DokKdBc' AND CAR='".$CAR."' ORDER BY no";
$recBarang = $pdo->query($qBarang);
$rsBarang = $recBarang->fetchAll(PDO::FETCH_ASSOC);
$countBarang=count($rsBarang);

$qJaminan = "SELECT *,DATE_FORMAT(TgJaminan,'%d-%m-%Y') AS TgJaminan1,DATE_FORMAT(TgJatuhTempo,'%d/%m/%Y') AS TgJatuhTempo1,DATE_FORMAT(TglTandaBayar,'%d-%m-%Y') AS TglTandaBayar1 FROM hdrjaminan WHERE DokKdBc='$DokKdBc' AND CAR='$CAR'";
$run=$pdo->query($qJaminan);	
$rsJaminan=$run->fetchAll(PDO::FETCH_ASSOC);
foreach ($rsJaminan as $rJaminan){
	if ($rJaminan['JnsJaminan']=="BM"){				
		$BM=$rJaminan['bayar'];
	} else if ($rJaminan['JnsJaminan']=="Cukai"){
		$Cukai=$rJaminan['bayar'];
	} else if ($rJaminan['JnsJaminan']=="PPN"){	
		$PPN=$rJaminan['bayar'];
	} else if ($rJaminan['JnsJaminan']=="PPnBM"){
		$PPnBM=$rJaminan['bayar'];
	} else if ($rJaminan['JnsJaminan']=="PPh"){
		$PPh=$rJaminan['bayar'];
	}
	
	if ($rJaminan['NoJaminan']!=""){
		$NoJaminan=$rJaminan['NoJaminan'];
		$TgJaminan=$rJaminan['TgJaminan1'];
		$JnsJaminan=$rJaminan['JnsJaminan'];
		$NilaiJaminan=$rJaminan['bayar'];
		$JatuhTempo=$rJaminan['TgJatuhTempo1'];
		$Penjamin=$rJaminan['Penjamin'];
		$NoBukti=$rJaminan['NoTandaBayar'];
		$TgBukti=$rJaminan['TglTandaBayar1'];
	}
}


$qBarangk= "SELECT * FROM barangkembali a
			INNER JOIN mst_barang b ON b.KdBarang=a.KdBarang 
			WHERE DokKdBc='$DokKdBc' AND CAR='".$CAR."' ORDER BY no";
$recBarangk = $pdo->query($qBarangk);
$rsBarangk = $recBarangk->fetchAll(PDO::FETCH_ASSOC);
$countBarangk=count($rsBarangk);

$qSumBarang="SELECT SUM(qty) as totQty,SUM(CIF) as totCIF,SUM(HrgSerah) as totHrgSerah FROM barang WHERE DokKdBc='$DokKdBc' AND CAR='".$CAR."'";
$recSumBarang = $pdo->query($qSumBarang);
$rsSumBarang = $recSumBarang->fetchAll(PDO::FETCH_ASSOC);
$totQty=$rsSumBarang[0]['totQty'];
$totCIF=$rsSumBarang[0]['totCIF'];
$totHrgSerah=$rsSumBarang[0]['totHrgSerah'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="expires" content="0">
<meta name="Author" content="Kikin Kusumah" />
<style type="text/css" media="all">	
#borderAll {
    border: 1px solid #000;	  	    
}
.p_spacing{
    margin-top:4px;
    margin-bottom:4px;
}
table.tablereport {
	padding:0;
    page-break-after:always;
    border: 1px solid #000;	
    border-collapse:collapse;
    margin:5px 0pt 10px;		
    font-size: 13px;
    width: 8.27in;	
    /*height:11.69in;*/
    height:10.90in;
}
table.tablereport thead tr td{		
    border: 1px solid #000;		
    font-size: 13px;		
    padding: 4px;
    vertical-align:top;
}	
table.tablereport tbody tr td {
    border: 1px solid #000;		
    font-size: 13px;		
    padding: 4px;
    vertical-align:top;
}
table.tablereport tfoot tr td {
    border: 1px solid #000;		
    font-size: 13px;		
    padding: 4px;
    vertical-align:top;
}
.borderall{
    border:1px #000 solid !important;
}
.noborder{
    border:1px #FFF solid !important;
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
<table cellpadding="0" cellspacing="0" class="tablereport">
<tbody>
<tr>
  <td align="center" colspan="2" valign="middle"><h2>BC 2.6.1 </h2></td>
  <td class="noborderright">&nbsp;</td>
  <td align="center" colspan="14"><h3>PEMBERITAHUAN PENGELUARAN BARANG DARI <br>TEMPAT PENIMBUNAN BERIKAT DENGAN JAMINAN</h3></td>
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
  <td class="noborderrb" colspan="3">C. TUJUAN PENGIRIMAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo getTujKirim($rs[0]['KdTp']) ?></b></td>
  <td class="noborderright" colspan="2">Tanggal</td>
  <td class="noborderright">:</td>
  <td colspan="6"><span class="borderall">&nbsp;<?php echo $rs[0]['tgl_daf'] ?>&nbsp;</span></td>
</tr> 
<tr>
	<td class="nobordertr" width="30"></td>
    <td class="nobordertr" width="84"></td>
    <td class="nobordertr" width="45"></td>
    <td class="nobordertr" width="11"></td>
    <td class="nobordertr" width="41"></td>
    <td width="55" class="nobordertr"></td>
    <td class="nobordertr" width="60"></td>
    
    <td class="nobordert" width="51"></td>    
    <td class="nobordertr" width="50"></td>    
    <td class="nobordertr" width="67"></td>
    <td class="nobordertr" width="11"></td>
    <td width="34" class="nobordertr"></td>
    <td class="nobordertr" width="8"></td>
    <td class="nobordertr" width="83"></td>
    <td class="nobordertr" width="42"></td>
    <td class="nobordertr" width="57"></td>
    <td class="nobordert" width="29"></td>
</tr>
<tr>
  <td colspan="17"><b>D. DATA PEMBERITAHUAN</b></td>
</tr>
<tr>
  <td colspan="8"><strong>PENGUSAHA TPB</strong></td>  
  <td colspan="9"><strong>PENERIMA BARANG</strong></td>
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
  <td colspan="4"><?php echo $_SESSION['NoTpb'] ?> TGL <?php echo strToupper(ymd2dmy3($_SESSION['TgTpb'])) ?></td>
  <td colspan="9">&nbsp;</td>
</tr> 
<tr>
  <td colspan="17"><b>DOKUMEN PELENGKAP PABEAN</b></td>  
</tr>
<tr>
  <td class="noborderrb" colspan="2">8. Packing List</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="3"><?php echo getDokPelengkap(4,$rs[0]['CAR'],2,1) ?></td>
  <td class="noborderbtm" colspan="2">Tgl. <?php echo getDokPelengkap(4,$rs[0]['CAR'],2,2) ?></td>
  <td class="noborderbtm" colspan="9"><span class="noborderrb">12. Jenis Sarana Pengangkut Darat : <span class="noborderright"><?php echo $rs[0]['JnsAngkut'] ?></span></span></td>
</tr>
<tr>
  <td class="noborderrb" colspan="2">9. Kontrak</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="3"><?php echo getDokPelengkapAll(4,$rs[0]['CAR'],3,1) ?></td>
  <td class="noborderbtm" colspan="2"><?php echo getDokPelengkapAll(4,$rs[0]['CAR'],3,2) ?></td>
  <td class="noborderbtm" colspan="9">&nbsp;</td>
</tr> 
<tr>
  <td class="noborderbtm" colspan="8">10. Surat Keputusan/Persetujuan </td>
  <td class="noborderbtm" colspan="9">13. No. Polisi : <?php echo $rs[0]['NoPolisi'] ?></td>
</tr>
<tr>
  <td class="noborderbtm" colspan="8"> &nbsp; &nbsp; &nbsp; <?php echo getDokPelengkap(4,$rs[0]['CAR'],5,1) ?> &nbsp; Tgl. <?php echo getDokPelengkap(4,$rs[0]['CAR'],5,2) ?></td>
  <td class="noborderbtm" colspan="9">&nbsp; </td>
</tr>
<tr>
  <td class="noborderbtm" colspan="8">11. Jenis/Nomor/Tanggal dokumen lainnya : </td>
  <td class="noborderbtm" colspan="9">&nbsp;</td>
</tr>
<tr>
  <td class="noborderright" colspan="4"> &nbsp; &nbsp; &nbsp;<span class="noborderbtm"><?php echo getDokPelengkap(8,$rs[0]['CAR'],6,1) ?></span></td>
  <td colspan="4">Tgl. <?php echo getDokPelengkap(8,$rs[0]['CAR'],6,2) ?></td>
  <td colspan="9">&nbsp; </td>
</tr>
<tr>
  <td colspan="17"><b>DATA PERDAGANGAN</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">14. Jenis Valuta Asing</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4"><?php echo $rs[0]['KdVal'] ?></td>
  <td class="noborderrb" colspan="4">16. Nilai CIF</td>
  <td class="noborderbtm" colspan="5">: USD 
  <?php 
  $ndpbm=($rs[0]['NDPBM']>0)?$rs[0]['NDPBM']:1;
  echo number_format($rs[0]['CIF']/$ndpbm,2) ?></td>
</tr>
<tr>
  <td class="noborderright" colspan="3">15. NDPBM</td>
  <td class="noborderright">:</td>
  <td class="noborderright" colspan="4"><?php echo number_format($rs[0]['NDPBM'],2) ?></td>
  <td class="noborderright" colspan="4"></td>
  <td colspan="5">&nbsp; Rp <?php echo number_format($rs[0]['CIF'],2) ?></td>
</tr>
<tr>
  <td colspan="17"><b>DATA PENGEMAS</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">17. Jenis Kemasan</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4"><?php echo getKemasan($rs[0]['KdKemas']) ?></td>
  <td class="noborderbtm" colspan="9">19. Jumlah Kemasan : <?php echo number_format($rs[0]['JmlKemas'])." ".$rs[0]['KdKemas'] ?></td>
</tr>
<tr>
  <td class="noborderright" colspan="3">18. Merek Kemasan</td>
  <td class="noborderright">:</td>
  <td colspan="13"><?php echo $rs[0]['MerekKemas'] ?></td>
</tr>
<tr>
  <td colspan="17"><b>DATA BARANG</b></td>
</tr>
<tr>
  <td class="noborderright" colspan="5">20. Volume (m3) : <?php echo number_format($rs[0]['VOL']) ?></td>
  <td class="noborderright" colspan="3">21. Berat Kotor (kg) : <?php echo number_format($rs[0]['BRUTO']) ?></td>
  <td colspan="9">22. Berat Bersih (kg) : <?php echo number_format($rs[0]['NETTO']) ?></td>
</tr>
<tr>
  <td class="noborderbtm" width="30">23.</td>
  <td class="noborderrb">24.</td>
  <td class="noborderbtm" colspan="4">&nbsp;</td>
  <td class="noborderbtm" colspan="2">25.</td>
  <td class="noborderbtm" colspan="3">26.</td>
  <td class="noborderbtm" colspan="3">27.</td>
  <td class="noborderbtm" colspan="3">28.</td>
</tr>
<tr>
  <td>No. </td>
  <td colspan="5">Uraian Jumlah dan Jenis Barang secara Lengkap,<br>Kode Barang, Merk, Tipe, Ukuran, dan Spesifikasi Lain</td>
  <td align="center" colspan="2">Negara Asal Barang </td>
  <td colspan="3">- Skema Tarif <br> - Tarif </td>
  <td colspan="3">- Jumlah dan Jenis Satuan<br>- Berat Bersih (Kg)<br>- Volume (m3) </td>
  <td colspan="3">Nilai CIF</td>
</tr>
<?php
if ($countBarang==1){
$str = "";
for ($i=0;$i<$countBarang;$i++):
$UrBarang=($rsBarang[$i]['UrBarang']=="")?"-":$rsBarang[$i]['UrBarang'];
$KdBarang=($rsBarang[$i]['KdBarang']=="")?"-":$rsBarang[$i]['KdBarang'];
$qty=($rsBarang[$i]['qty']=="")?"-":$rsBarang[$i]['qty']." ".$rsBarang[$i]['Sat'];
$NmNegara=$rsBarang[$i]['NmNegara'];
$Tarif=$rsBarang[$i]['Tarif'];
$CIF=($rsBarang[$i]['CIF']<1)?"-":number_format($rsBarang[$i]['CIF'],2);
?>
<tr>
  <td align="center" class="noborderbtm"><?php echo $rsBarang[$i]['no'] ?></td>
  <td class="noborderbtm" colspan="5"><?php echo $UrBarang."<br>".$KdBarang ?></td>
  <td align="center" class="noborderbtm" colspan="2"><?php echo $NmNegara ?></td>
  <td class="noborderbtm" colspan="3"><?php echo $Tarif ?></td>
  <td align="right" class="noborderbtm" colspan="3"><?php echo $qty ?> &nbsp; &nbsp; &nbsp; </td>  
  <td align="right" class="noborderrb"><?php echo $rs[0]['KdVal'] ?></td>
  <td align="right" class="noborderbtm" colspan="2"><?php echo $CIF ?>&nbsp;&nbsp;</td>
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
<tr height="100%">
  <td></td>
  <td align="right" colspan="5" style="vertical-align:bottom">TOTAL =></td>
  <td align="center" colspan="2">&nbsp;</td>
  <td align="center" colspan="3" style="vertical-align:bottom"></td>
  <td align="right" colspan="3" style="vertical-align:bottom"><?php echo $totQty." ".$rsBarang[0]['Sat'] ?> &nbsp; &nbsp; &nbsp; </td>
  <td align="right" class="noborderright"><?php echo $rs[0]['KdVal'] ?></td>
  <td align="right" colspan="2" style="vertical-align:bottom"><?php echo number_format($totCIF,2) ?>&nbsp;&nbsp;</td>
</tr>
<tr>
  <td align="center" colspan="8"><b>DATA PERHITUNGAN JAMINAN</b></td>
  <td colspan="9"><b>DATA JAMINAN</b></td>
</tr>
<tr>
  <td align="center" colspan="5"><b>JENIS PUNGUTAN</b></td>
  <td align="center" colspan="3"><b>JUMLAH</b></td>
  <td colspan="9">&nbsp;</td>
</tr>
<tr>
  <td colspan="5">29. BM</td>
  <td align="right" class="noborderright">Rp</td>
  <td align="right" colspan="2"><?php echo number_format($BM,2) ?>&nbsp; </td>
  <td class="noborderrb" colspan="5">35. Jenis Jaminan</td>
  <td class="noborderbtm" colspan="4">: <?php echo $JnsJaminan ?></td>
</tr>
<tr>
  <td colspan="5">30. CUKAI</td>
  <td align="right" class="noborderright">Rp</td>
  <td align="right" colspan="2"><?php echo number_format($Cukai,2) ?>&nbsp; </td>
  <td class="noborderrb" colspan="5">36. Nomor Jaminan</td>
  <td class="noborderbtm" colspan="4">: <?php echo $NoJaminan ?> Tgl. <?php echo $TgJaminan ?></td>
</tr>
<tr>
  <td colspan="5">31. PPN</td>
  <td align="right" class="noborderright">Rp</td>
  <td align="right" colspan="2"><?php echo number_format($PPN,2) ?>&nbsp; </td>
  <td class="noborderrb" colspan="5">37. Nilai Jaminan</td>
  <td class="noborderbtm" colspan="4">: Rp <?php echo number_format($NilaiJaminan,2) ?></td>
</tr>
<tr>
  <td colspan="5">32. PPnBM</td>
  <td align="right" class="noborderright">Rp</td>
  <td align="right" colspan="2"><?php echo number_format($PPnBM,2) ?>&nbsp; </td>
  <td class="noborderrb" colspan="5">38. Jatuh Tempo Jaminan</td>
  <td class="noborderbtm" colspan="4">: <?php echo strToupper(ymd2dmy3($JatuhTempo)) ?></td>
</tr>
<tr>
  <td colspan="5">33. PPh</td>
  <td align="right" class="noborderright">Rp</td>
  <td align="right" colspan="2"><?php echo number_format($PPh,2) ?>&nbsp; </td>
  <td class="noborderrb" colspan="5">39. Penjamin</td>
  <td class="noborderbtm" colspan="4">: <?php echo $Penjamin ?></td>
</tr>
<tr>
  <td colspan="5">34. Total</td>
  <td align="right" class="noborderright">Rp</td>
  <td align="right" colspan="2"><?php echo number_format($rs[0]['Total'],2) ?>&nbsp; </td>
  <td class="noborderright" colspan="5">40. Bukti Penerimaan Jaminan</td>
  <td colspan="4">: <?php echo $NoBukti ?> TGL <?php echo strToupper(ymd2dmy3($TgBukti)) ?></td>
</tr>
<tr>
  <td colspan="8"><b>G. UNTUK PEJABAT BEA DAN CUKAI</b></td>
  <td colspan="9"><b>E. TANDA TANGAN PENGUSAHA TPB</b></td>
</tr>
<tr>
  <td align="center" colspan="8">&nbsp;<br><br><br><br><br>
    <?php echo $rs[0]['NmPejabat'] ?><br>NIP. <?php echo $rs[0]['NipPejabat'] ?></td>
  <td colspan="9">
  Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal<br>
  yang diberitahukan dalam pemberitahuan pabean ini.<br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; Subang, <?php echo $rs[0]['tgl_daf'] ?><br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<?php echo $rs[0]['NmPengusaha'] ?></td>
</tr> 
<tr>
  <td class="noborderlrb" colspan="17">Rangkap ke- 1/2/3 : Kantor Pabean / Pengusaha TPB / Pengirim Barang  </td>
</tr> 
</tbody>
</table>
<?php if($countBarang>1): ?>
<table cellpadding="1" cellspacing="0" class="tablereport">
<tbody>
<tr>
  <td align="center" colspan="2"><h2>BC 2.6.1</h2></td>
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
  <td class="noborderrb" colspan="3">C. TUJUAN PENGIRIMAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo getTujKirim($rs[0]['KdTp']) ?></td>
  <td class="noborderright" colspan="2">Tanggal</td>
  <td class="noborderright">:</td>
  <td colspan="6"><span class="borderall">&nbsp;<?php echo $rs[0]['tgl_daf'] ?>&nbsp;</span></td>
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
  <td class="noborderbtm" width="23">23.</td>
  <td class="noborderrb">24.</td>
  <td class="noborderbtm" colspan="4">&nbsp;</td>
  <td class="noborderbtm" colspan="2">25.</td>
  <td class="noborderbtm" colspan="3">26.</td>
  <td class="noborderbtm" colspan="3">27.</td>
  <td class="noborderbtm" colspan="3">28.</td>
</tr>
<tr>
  <td>No. </td>
  <td colspan="5">Uraian Jumlah dan Jenis Barang secara Lengkap,<br>Kode Barang, Merk, Tipe, Ukuran, dan Spesifikasi Lain</td>
  <td align="center" colspan="2">Negara Asal Barang </td>
  <td colspan="3">- Skema Tarif <br> - Tarif </td>
  <td colspan="3">- Jumlah dan Jenis Satuan<br>- Berat Bersih (Kg)<br>- Volume (m3) </td>
  <td colspan="3">Nilai CIF</td>
</tr>
<?php
$str = "";
for ($i=0;$i<$countBarang;$i++):
$UrBarang=($rsBarang[$i]['UrBarang']=="")?"-":$rsBarang[$i]['UrBarang'];
$KdBarang=($rsBarang[$i]['KdBarang']=="")?"-":$rsBarang[$i]['KdBarang'];
$qty=($rsBarang[$i]['qty']=="")?"-":$rsBarang[$i]['qty']." ".$rsBarang[$i]['Sat'];
$NmGuna=($rsBarang[$i]['NmGuna']=="")?"-":$rsBarang[$i]['NmGuna'];
$NmNegara=$rsBarang[$i]['NmNegara'];
$Tarif=$rsBarang[$i]['Tarif'];
$CIF=($rsBarang[$i]['CIF']<1)?"-":number_format($rsBarang[$i]['CIF'],2);
?>
<tr>
  <td align="center" class="noborderbtm"><?php echo $rsBarang[$i]['no'] ?></td>
  <td class="noborderbtm" colspan="5"><?php echo $UrBarang."<br>".$KdBarang ?></td>
  <td align="center" class="noborderbtm" colspan="2"><?php echo $NmNegara ?></td>
  <td class="noborderbtm" colspan="3"><?php echo $Tarif ?></td>
  <td align="right" class="noborderbtm" colspan="3"><?php echo $qty ?> &nbsp; &nbsp; &nbsp; </td>  
  <td align="right" class="noborderrb"><?php echo $rs[0]['KdVal'] ?></td>
  <td align="right" class="noborderbtm" colspan="2"><?php echo $CIF ?>&nbsp;&nbsp;</td>
</tr>
<?php endfor; ?>
<tr height="100%">
  <td></td>
  <td align="right" colspan="5" style="vertical-align:bottom"></td>
  <td align="center" colspan="2">&nbsp;</td>
  <td align="center" colspan="3" style="vertical-align:bottom"></td>
  <td align="right" colspan="3" style="vertical-align:bottom"><?php //echo $totQty." ".$rsBarang[0]['unit'] ?> &nbsp; &nbsp; &nbsp; </td>
  <td align="right" class="noborderright" style="vertical-align:bottom"><?php //echo $rs[0]['KdVal'] ?></td>
  <td align="right" class="noborderright" style="vertical-align:bottom"><?php //echo number_format($totCIF,2) ?></td>
  <td align="right">&nbsp;</td>
</tr>
<tr>
  <td class="noborderright" colspan="8">&nbsp;</td>
  <td colspan="9"><b>E. TANDA TANGAN PENGUSAHA TPB</b></td>
</tr>
<tr>
  <td align="center" class="noborderright" colspan="8">&nbsp;<br><br><br><br><br></td>
  <td colspan="9">
  Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal<br>
  yang diberitahukan dalam pemberitahuan pabean ini.<br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; Subang, Tgl. <?php echo $rs[0]['tgl_daf'] ?><br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;( <?php echo $rs[0]['NmPengusaha'] ?> )</td>
</tr> 
<tr>
  <td class="noborderlrb" colspan="17">Rangkap ke- 1/2/3 : Kantor Pabean / Pengusaha TPB / Pengirim Barang  </td>
</tr> 
</tbody>
</table>
<?php endif; if(count($rsDokPelengkap>0)): ?>
<table cellpadding="1" cellspacing="0" class="tablereport">
<tbody>
<tr>
  <td align="center" colspan="2"><h2>BC 2.6.1</h2></td>
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
  <td class="noborderrb" colspan="3">C. TUJUAN PENGIRIMAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo getTujKirim($rs[0]['KdTp']) ?></td>
  <td class="noborderright" colspan="2">Tanggal</td>
  <td class="noborderright">:</td>
  <td colspan="6"><span class="borderall">&nbsp;<?php echo $rs[0]['tgl_daf'] ?>&nbsp;</span></td>
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
  <td class="noborderright" colspan="9">&nbsp;</td>
  <td colspan="8"><b>E. TANDA TANGAN PENGUSAHA TPB</b></td>
</tr>
<tr>
  <td class="noborderright"></td>
  <td class="noborderright"></td>
  <td align="center" class="noborderright" colspan="7">&nbsp;<br><br><br><br><br></td>
  <td colspan="8">
  Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal 
  yang diberitahukan dalam pemberitahuan pabean ini.<br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; Subang, Tgl. <?php echo $rs[0]['tgl_daf'] ?><br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;( <?php echo $rs[0]['NmPengusaha'] ?> )</td>
</tr> 
<tr>
  <td class="noborderlrb" colspan="17">Rangkap ke- 1/2/3 : Kantor Pabean / Pengusaha TPB / Pengirim Barang  </td>
</tr> 
</tbody>
</table>
<?php endif; ?>
<?php if($countBarangk>0): ?>
<table cellpadding="1" cellspacing="0" class="tablereport">
<tbody>
<tr>
  <td align="center" colspan="2"><h2>BC 2.6.1</h2></td>
  <td class="noborderright">&nbsp;</td>
  <td align="center" colspan="14"><h3>LEMBAR LAMPIRAN<br>
BARANG YANG AKAN DIMASUKKAN KEMBALI KE TPB</h3></td>
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
  <td class="noborderrb" colspan="3">C. TUJUAN PENGIRIMAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo getTujKirim($rs[0]['KdTp']) ?></td>
  <td class="noborderright" colspan="2">Tanggal</td>
  <td class="noborderright">:</td>
  <td colspan="6"><span class="borderall">&nbsp;<?php echo $rs[0]['tgl_daf'] ?>&nbsp;</span></td>
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
  <td>No. </td>
  <td colspan="7">  Pos Tarif HS, Uraian Jumlah dan Jenis Barang secara Lengkap,<br>Kode Barang, Merk, Tipe, Ukuran, dan Spesifikasi Lain</td>
  <td colspan="5">- Jumlah & Jenis Satuan<br>- Berat bersih (Kg)<br> - Volume (m3)</td>
  <td align="center" colspan="4">Nilai CIF <br></td>
</tr>
<?php 
for($i=0;$i<$countBarangk;$i++):
$UrBarang=($rsBarangk[$i]['UrBarang']=="")?"-":$rsBarangk[$i]['UrBarang'];
$KdBarang=($rsBarangk[$i]['KdBarang']=="")?"-":$rsBarangk[$i]['KdBarang'];
$qty=($rsBarangk[$i]['qty']=="")?"-":$rsBarangk[$i]['qty']." ".$rsBarangk[$i]['Sat'];
$CIF=($rsBarangk[$i]['CIF']<1)?"-":number_format($rsBarangk[$i]['CIF'],2);
$CIF=($rsBarangk[$i]['CIF']<1)?"-":number_format($rsBarangk[$i]['CIF'],2);
$CIF=($rsBarangk[$i]['CIF']<1)?"-":number_format($rsBarangk[$i]['CIF'],2);
?>
<tr>
  <td align="center" class="noborderbtm"><?php echo $rsBarangk[$i]['no'] ?></td>
  <td class="noborderbtm" colspan="7"><?php echo $UrBarang."<br>".$KdBarang ?></td>
  <td align="right" class="noborderbtm" colspan="5"><?php echo $qty ?> &nbsp; &nbsp; &nbsp; </td>  
  <td align="right" class="noborderbtm" colspan="5"><?php echo $CIF ?>&nbsp;&nbsp;</td>
</tr>
<?php endfor; ?>
<tr height="100%">
  <td></td>
  <td colspan="7"></td>
  <td colspan="5"></td>
  <td colspan="4"></td>
</tr>
<tr>
  <td class="noborderright" colspan="8">&nbsp;</td>
  <td colspan="9"><b>E. TANDA TANGAN PENGUSAHA TPB</b></td>
</tr>
<tr>
  <td align="center" class="noborderright" colspan="8">&nbsp;<br><br><br><br><br></td>
  <td colspan="9">
  Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal<br>
  yang diberitahukan dalam pemberitahuan pabean ini.<br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; Subang, Tgl. <?php echo $rs[0]['tgl_daf'] ?><br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;( <?php echo $rs[0]['NmPengusaha'] ?> )</td>
</tr> 
<tr>
  <td class="noborderlrb" colspan="17">Rangkap ke- 1/2/3 : Kantor Pabean / Pengusaha TPB / Pengirim Barang  </td>
</tr> 
</tbody>
</table>
<?php endif; ?>
</body>
</html>