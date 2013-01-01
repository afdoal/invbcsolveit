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

$DokKdBc=6;
$CAR=$_REQUEST['CAR'];

$q = "SELECT *,CONCAT('$KdPengguna-$NoReg1','-',DATE_FORMAT(TgDaf,'%Y%m%d'),'-',a.CAR) AS FCAR,CONCAT(LEFT(NoDaf,3),'.',RIGHT(NoDaf,3)) AS FNoDaf,CONCAT(LEFT(NoSegel,3),'.',RIGHT(NoSegel,3)) AS FNoSegel,DATE_FORMAT(TgDaf,'%d-%m-%Y') AS tgl_daf 
		FROM header a 
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
			WHERE DokKdBc='$DokKdBc' AND CAR='".$CAR."' ORDER BY no";
$recBarang = $pdo->query($qBarang);
$rsBarang = $recBarang->fetchAll(PDO::FETCH_ASSOC);
$countBarang=count($rsBarang);

$qSumBarang="SELECT SUM(qty) as totQty,SUM(CIF) as totCIF,SUM(HrgSerah) as totHrgSerah FROM barang WHERE DokKdBc='$DokKdBc' AND CAR='".$CAR."'";
$recSumBarang = $pdo->query($qSumBarang);
$rsSumBarang = $recSumBarang->fetchAll(PDO::FETCH_ASSOC);
$totQty=$rsSumBarang[0]['totQty'];
$totCIF=($rsSumBarang[0]['totCIF']<1)?"-":number_format($rsSumBarang[0]['totCIF'],2);
$totHrgSerah=($rsSumBarang[0]['totHrgSerah']<1)?"-":number_format($rsSumBarang[0]['totHrgSerah'],2);

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
    page-break-after:always;
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
  <td align="center" colspan="2" valign="middle"><h2>BC 2.7 </h2></td>
  <td class="noborderright">&nbsp;</td>
  <td align="center" colspan="14"><h3>PEMBERITAHUAN PENGELUARAN BARANG UNTUK DIANGKUT DARI TEMPAT<br>PENIMBUNAN BERIKAT KE TEMPAT PENIMBUNAN BERIKAT LAINNYA</h3></td>
</tr>
<tr>
  <td colspan="17"><b>HEADER</b></td>
</tr>
<tr>
  <td align="right" class="noborderbtm" colspan="17">Halaman 1 Dari ...<?php //if($countBarang > 1 && $countDokPelengkap >= 1){echo "3";}else if($countBarang > 1 || $countDokPelengkap > 0){echo "2";} else { echo "1";} ?> &nbsp; &nbsp; </td>
</tr>
<tr>
  <td class="noborderrb" colspan="3"><b>NOMOR PENGAJUAN</b></td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4"><?php echo $rs[0]['FCAR'] ?></td>
  <td class="noborderbtm" colspan="9"><b>D. TUJUAN PENGIRIMAN : &nbsp; &nbsp; &nbsp;<?php echo strtoupper(getTujKirim($rs[0]['KdTp'])) ?></b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3"><b>A. KANTOR PABEAN</b></td>
  <td class="noborderrb"></td>
  <td class="noborderrb" colspan="4"></td>
  <td colspan="9"></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3"> &nbsp; &nbsp; 1. Kantor Asal</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo getKantor($rs[0]['KdKpbcAsal']) ?></td>
  <td class="noborderbtm" colspan="9"></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3"> &nbsp; &nbsp; 2. Kantor Tujuan</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo getKantor($rs[0]['KdKpbcTuj']) ?></td>
  <td class="noborderbtm" colspan="9"><b>G. KOLOM KHUSUS BEA DAN CUKAI</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3"><b>B. JENIS TPB ASAL</b></td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo getJnsTpb($rs[0]['KdJnsTpbAsal']) ?></td>
  <td class="noborderrb" colspan="2">Nomor Pendaftaran</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6"><?php echo $rs[0]['FNoDaf'] ?></td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3"><b>C. JENIS TPB TUJUAN</b></td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo getJnsTpb($rs[0]['KdJnsTpbTuj']) ?></td>
  <td class="noborderright" colspan="2">Tanggal</td>
  <td class="noborderright">:</td>
  <td colspan="6"><?php echo $rs[0]['tgl_daf'] ?></td>
</tr> 
<tr>
	<td class="nobordertr" width="40"></td>
    <td class="nobordertr" width="78"></td>
    <td class="nobordertr" width="31"></td>
    <td class="nobordertr" width="17"></td>
    <td class="nobordertr" width="50"></td>
    <td width="13" class="nobordertr"></td>
    <td class="nobordertr" width="60"></td>
    
    <td class="nobordert" width="50"></td>    
    <td class="nobordertr" width="52"></td>    
    <td class="nobordertr" width="55"></td>
    <td class="nobordertr" width="11"></td>
    <td width="30" class="nobordertr"></td>
    <td class="nobordertr" width="39"></td>
    <td class="nobordertr" width="32"></td>
    <td class="nobordertr" width="26"></td>
    <td class="nobordertr" width="29"></td>
    <td class="nobordert" width="69"></td>
</tr>
<tr>
  <td colspan="17"><b>E. DATA PEMBERITAHUAN</b></td>
</tr>
<tr>
  <td colspan="8"><b>TPB ASAL BARANG</b></td>  
  <td colspan="9"><b>TPB TUJUAN BARANG</b></td>
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
  <td class="noborderrb" colspan="3">2. Nama</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo $_SESSION['c_name'] ?></td>
  <td class="noborderrb" colspan="2">6. Nama</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6"><?php echo $rs[0]['NmTuj'] ?></td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3" valign="top">3. Alamat</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo $_SESSION['c_address'] ?></td>
  <td class="noborderrb" colspan="2">7. Alamat</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6"><?php echo $rs[0]['AlmtPrshn']." - ".$rs[0]['Kota'] ?></td>
</tr>
<tr>
  <td class="noborderright" colspan="3" valign="top">4. No. Izin TPB</td>
  <td class="noborderright">:</td>
  <td colspan="4"><?php echo $_SESSION['NoTpb'] ?> TGL <?php echo strToupper(ymd2dmy3($_SESSION['TgTpb'])) ?></td>
  <td class="noborderright" colspan="2">8. <span class="noborderright">No. Izin TPB</span></td>
  <td class="noborderright">:</td>
  <td colspan="6"><?php echo $rs[0]['NoTpb'] ?></td>
</tr> 
<tr>
  <td colspan="17"><b>DOKUMEN PELENGKAP PABEAN</b></td>  
</tr>
<tr>
  <td class="noborderrb" colspan="3">9. Invoice</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb"><?php echo getDokPelengkap(6,$rs[0]['CAR'],1,1) ?></td>
  <td class="noborderbtm" colspan="3">Tgl. <?php echo getDokPelengkap(6,$rs[0]['CAR'],1,2) ?></td>
  <td class="noborderrb" colspan="5">12. Surat Jalan : <?php echo getDokPelengkap(6,$rs[0]['CAR'],4,1) ?></td>
  <td class="noborderbtm" colspan="4">Tgl. <?php echo getDokPelengkap(6,$rs[0]['CAR'],4,2) ?></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">10. Packing List</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb"><?php echo getDokPelengkap(6,$rs[0]['CAR'],2,1) ?></td>
  <td class="noborderbtm" colspan="3">Tgl. <?php echo getDokPelengkap(6,$rs[0]['CAR'],2,2) ?></td>
  <td class="noborderrb" colspan="6">13. Surat Keputusan/Persetujuan : <?php echo getDokPelengkap(6,$rs[0]['CAR'],5,1) ?></td>
  <td class="noborderbtm" colspan="3">Tgl. <?php echo getDokPelengkap(6,$rs[0]['CAR'],5,2) ?></td>
</tr>
<tr>
  <td class="noborderright" colspan="3">11. Kontrak</td>
  <td class="noborderright">:</td>
  <td class="noborderright"><?php echo getDokPelengkap(6,$rs[0]['CAR'],3,1) ?></td>
  <td colspan="3">Tgl. <?php echo getDokPelengkap(6,$rs[0]['CAR'],3,2) ?></td>
  <td class="noborderright" colspan="5">14. Lainnya : <?php echo getDokPelengkap(6,$rs[0]['CAR'],6,1) ?></td>
  <td colspan="4">Tgl. <?php echo getDokPelengkap(6,$rs[0]['CAR'],6,2) ?></td>
</tr> 
<tr>
  <td colspan="17"><b>RIWAYAT BARANG</b></td>
</tr>
<tr>
  <td class="noborderright" colspan="8">15. Nomor dan tanggal BC 2.7 Asal :  EX BC 2.7 AKB No, <?php echo getDokPelengkap(6,$rs[0]['CAR'],12,1) ?></td>
  <td colspan="9">Tgl, <?php echo getDokPelengkap(6,$rs[0]['CAR'],12,2) ?></td>
</tr>
<tr>
  <td colspan="17"><b>DATA PERDAGANGAN</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">16. Jenis Valuta Asing</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4"><?php echo $rs[0]['KdVal'] ?></td>
  <td class="noborderrb" colspan="4">18. Harga Penyerahan</td>
  <td class="noborderbtm" colspan="5">: <?php echo $rs[0]['KdVal'] ?> <?php echo number_format($rs[0]['HrgSerah']) ?></td>
</tr>
<tr>
  <td class="noborderright" colspan="3">17. CIF</td>
  <td class="noborderright">:</td>
  <td class="noborderright" colspan="4"><?php echo $rs[0]['CIF'] ?></td>
  <td class="noborderright" colspan="4"></td>
  <td colspan="5"></td>
</tr>
<tr>
  <td colspan="11"><b>DATA PENGANGKUTAN</b></td>
  <td colspan="6"><b>SEGEL (DIISI OLEH BEA DAN CUKAI)</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="8">19. Jenis Sarana Pengangkut Darat : </td>
  <td class="noborderbtm" colspan="3">20. No. Polisi : </td>
  <td align="center" colspan="4">BC Asal</td>
  <td align="center" colspan="2" rowspan="2">23. Catatan BC Tujuan</td>
</tr>
<tr>
  <td class="noborderright" colspan="8"> &nbsp; &nbsp; &nbsp; <?php echo $rs[0]['JnsAngkut'] ?></td>
  <td colspan="3"> &nbsp; &nbsp; &nbsp; <?php echo $rs[0]['NoPolisi'] ?></td>
  <td colspan="2">21. No. Segel</td>
  <td colspan="2">22. Jenis</td>  
</tr>
<tr>
  <td colspan="11"><b>DATA PETI KEMAS DAN PENGEMAS</b></td>
  <td align="center" colspan="2" rowspan="3" valign="middle"><?php echo $rs[0]['FNoSegel'] ?></td>
  <td align="center" colspan="2" rowspan="3" valign="middle"><?php echo $rs[0]['JnsSegel'] ?></td>
  <td align="center" colspan="2" rowspan="3" valign="middle"><?php echo $rs[0]['CatBcTuj'] ?></td>  
</tr>
<tr>
  <td class="noborderrb" colspan="8">24. Merek dan No. Kemasan/ Peti Kemas dan Jumlah petikemas</td>
  <td class="noborderbtm" colspan="3">25. Jml dan Jns Kemasan</td>
</tr>
<tr>
  <td class="noborderright" colspan="8"> &nbsp; &nbsp; &nbsp; <?php echo $rs[0]['MerekKemas'] ?></td>
  <td colspan="3"> &nbsp; &nbsp; &nbsp; <?php echo number_format($rs[0]['JmlKemas']) ?> <?php echo getKemasan($rs[0]['KdKemas']) ?></td>
</tr>
<tr>
  <td colspan="17"><b>DATA BARANG</b></td>
</tr>
<tr>
  <td class="noborderright" colspan="5">26. Volume (m3) : <?php echo number_format($rs[0]['VOL']) ?></td>
  <td class="noborderright" colspan="5">27. Berat Kotor (kg) : <?php echo number_format($rs[0]['BRUTO']) ?></td>
  <td colspan="7">28. Berat Bersih (kg) : <?php echo number_format($rs[0]['NETTO']) ?></td>
</tr>
<tr>
  <td class="noborderbtm" width="40">29.</td>
  <td class="noborderrb">30.</td>
  <td class="noborderbtm" colspan="7">&nbsp;</td>
  <td class="noborderbtm" colspan="4">31.</td>
  <td class="noborderbtm" colspan="4">32.</td>
</tr>
<tr>
  <td>No. </td>
  <td colspan="8">  Pos Tarif HS, Uraian Jumlah dan Jenis Barang secara Lengkap,<br>Kode Barang, Merk, Tipe, Ukuran, dan Spesifikasi Lain</td>
  <td colspan="4">- Jumlah & Jenis Satuan<br>- Berat bersih (Kg)<br> - Volume (m3)</td>
  <td colspan="4">- Nilai CIF <br>- Harga Penyerahan </td>
</tr>
<?php
if ($countBarang<3){
$str = "";
for ($i=0;$i<$countBarang;$i++):
$UrBarang=($rsBarang[$i]['UrBarang']=="")?"-":$rsBarang[$i]['UrBarang'];
$KdBarang=($rsBarang[$i]['KdBarang']=="")?"-":$rsBarang[$i]['KdBarang'];
$qty=($rsBarang[$i]['qty']=="")?"-":$rsBarang[$i]['qty']." ".$rsBarang[$i]['Sat'];
$CIF=($rsBarang[$i]['CIF']<1)?"-":number_format($rsBarang[$i]['CIF'],2);
$HrgSerah=($rsBarang[$i]['HrgSerah']<1)?"-":number_format($rsBarang[$i]['HrgSerah'],2);
?>
<tr>
  <td align="center" class="noborderbtm"><?php echo $rsBarang[$i]['no'] ?></td>
  <td class="noborderbtm" colspan="8"><?php echo $UrBarang."<br>".$KdBarang ?></td>
  <td align="right" class="noborderbtm" colspan="4"><?php echo $qty ?> &nbsp; &nbsp; &nbsp; </td>
  <td align="right" class="noborderrb" colspan="2"><?php echo $rs[0]['KdVal']."<br>".$rs[0]['KdVal'] ?></td>
  <td align="right" class="noborderbtm" colspan="2"><?php echo $CIF."&nbsp;&nbsp;<br>".$HrgSerah ?>&nbsp;&nbsp;</td>
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
  <td style="vertical-align:bottom"></td>
  <td align="right" colspan="8" style="vertical-align:top">TOTAL =></td>
  <td align="right" colspan="4" style="vertical-align:top"><?php echo $totQty." ".$rsBarang[0]['unit'] ?> &nbsp; &nbsp; &nbsp; </td>  
  <td align="right" class="noborderright" colspan="2"><?php echo $rs[0]['KdVal']."<br>".$rs[0]['KdVal'] ?></td>
  <td align="right" colspan="2" width="29" style="vertical-align:bottom"><?php echo $totCIF."&nbsp;&nbsp;<br>".$totHrgSerah;?>&nbsp;&nbsp;</td>
</tr>
<tr>
  <td colspan="9"><b>F. TANDA TANGAN PENGUSAHA TPB</b></td>
  <td colspan="8"><b>H. UNTUK PEJABAT BEA DAN CUKAI</b></td>
</tr>
<tr>
  <td colspan="9" rowspan="2">Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal
  yang diberitahukan dalam pemberitahuan pabean ini.
  <br><br>
   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Subang, Tgl. <?php echo $rs[0]['tgl_daf'] ?><br><br><br><br><br>
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
  ( <?php echo $rs[0]['NmPengusaha'] ?> )&nbsp;</td>
  <td align="center" colspan="4">Kantor Pabean Asal</td>
  <td align="center" colspan="4">Kantor Pabean Tujuan</td>
</tr>
<tr>
  <td colspan="4"><br><br><br><br><br>Nama : <?php echo $rs[0]['NmPejabat'] ?><br>NIP &nbsp; &nbsp;: <?php echo $rs[0]['NipPejabat'] ?><br></td>
  <td colspan="4"><br><br><br><br><br>Nama : <br>NIP &nbsp; &nbsp;: <br></td>
</tr> 
<tr>
  <td class="noborderlrb" colspan="17">Rangkap ke- 1/2/3 : Kantor Pabean / Pengusaha TPB / Pengirim Barang  </td>
</tr> 
</tbody>
</table>
<?php if($countBarang>2): ?>
<table cellpadding="1" cellspacing="0" class="tablereport">
<tbody>
<tr>
  <td align="center" colspan="2"><h2>BC 2.7 </h2></td>
  <td class="noborderright">&nbsp;</td>
  <td align="center" colspan="14"><h3>LEMBAR LANJUTAN<br>DATA BARANG</h3></td>
</tr>
<tr>
  <td colspan="17"><b>HEADER</b></td>
</tr>
<tr>
  <td align="right" class="noborderbtm" colspan="17">Halaman 2 Dari ... <?php //if ($countDokPelengkap > 0){echo "2 Dari 3";}else{echo "2 Dari 2";}?> &nbsp; &nbsp; </td>
</tr>
<tr>
  <td class="noborderrb" colspan="3"><b>NOMOR PENGAJUAN</b></td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4"><?php echo $rs[0]['FCAR'] ?></td>
  <td class="noborderbtm" colspan="9"><b>D. TUJUAN PENGIRIMAN : &nbsp; &nbsp; &nbsp;<?php echo strtoupper(getTujKirim($rs[0]['KdTp'])) ?></b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3"><b>A. KANTOR PABEAN</b></td>
  <td class="noborderrb"></td>
  <td class="noborderrb" colspan="4"></td>
  <td colspan="9"></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3"> &nbsp; &nbsp; 1. Kantor Asal</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo $rs[0]['KdKpbcAsal'] ?></td>
  <td class="noborderbtm" colspan="9"></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3"> &nbsp; &nbsp; 2. Kantor Tujuan</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo $rs[0]['KdKpbcTuj'] ?></td>
  <td class="noborderbtm" colspan="9"><b>G. KOLOM KHUSUS BEA DAN CUKAI</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3"><b>B. JENIS TPB ASAL</b></td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo getJnsTpb($rs[0]['KdJnsTpbAsal']) ?></td>
  <td class="noborderrb" colspan="2">Nomor Pendaftaran</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6"><?php echo $rs[0]['FNoDaf'] ?></td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3"><b>C. JENIS TPB TUJUAN</b></td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo getJnsTpb($rs[0]['KdJnsTpbTuj']) ?></td>
  <td class="noborderright" colspan="2">Tanggal</td>
  <td class="noborderright">:</td>
  <td colspan="6"><?php echo $rs[0]['tgl_daf'] ?></td>
</tr>
<tr>
	<td class="nobordertr" width="38"></td>
    <td class="nobordertr" width="88"></td>
    <td class="nobordertr" width="38"></td>
    <td class="nobordertr" width="13"></td>
    <td class="nobordertr" width="58"></td>
    <td width="9" class="nobordertr"></td>
    <td class="nobordertr" width="68"></td>
    
    <td class="nobordert" width="58"></td>    
    <td class="nobordertr" width="58"></td>    
    <td class="nobordertr" width="58"></td>
    <td class="nobordertr" width="13"></td>
    <td width="9" class="nobordertr"></td>
    <td class="nobordertr" width="48"></td>
    <td class="nobordertr" width="38"></td>
    <td class="nobordertr" width="25"></td>
    <td class="nobordertr" width="95"></td>
    <td class="nobordert" width="44"></td>
</tr>
<tr>
  <td class="noborderbtm" width="38">29.</td>
  <td class="noborderrb">30.</td>
  <td class="noborderbtm" colspan="6">&nbsp;</td>
  <td class="noborderbtm" colspan="5">31.</td>
  <td class="noborderbtm" colspan="4">32.</td>
</tr>
<tr>
  <td>No. </td>
  <td colspan="7">  Pos Tarif HS, Uraian Jumlah dan Jenis Barang secara Lengkap,<br>Kode Barang, Merk, Tipe, Ukuran, dan Spesifikasi Lain</td>
  <td colspan="5">- Jumlah & Jenis Satuan<br>- Berat bersih (Kg)<br> - Volume (m3)</td>
  <td colspan="4">- Nilai CIF <br>- Harga Penyerahan </td>
</tr>
<?php 
for($i=0;$i<$countBarang;$i++):
$UrBarang=($rsBarang[$i]['UrBarang']=="")?"-":$rsBarang[$i]['UrBarang'];
$KdBarang=($rsBarang[$i]['KdBarang']=="")?"-":$rsBarang[$i]['KdBarang'];
$qty=($rsBarang[$i]['qty']=="")?"-":$rsBarang[$i]['qty']." ".$rsBarang[$i]['Sat'];
$CIF=($rsBarang[$i]['CIF']<1)?"-":number_format($rsBarang[$i]['CIF'],2);
$HrgSerah=($rsBarang[$i]['HrgSerah']<1)?"-":number_format($rsBarang[$i]['HrgSerah'],2);
?>
<tr>
  <td align="center" class="noborderbtm"><?php echo $rsBarang[$i]['no'] ?></td>
  <td class="noborderbtm" colspan="7"><?php echo $UrBarang."<br>".$KdBarang ?></td>
  <td align="right" class="noborderbtm" colspan="5"><?php echo $qty ?> &nbsp; &nbsp; &nbsp; </td>
  <td align="right" class="noborderrb" colspan="2"><?php echo $rs[0]['KdVal']."<br>".$rs[0]['KdVal'] ?></td>
  <td align="right" class="noborderbtm" colspan="2"><?php echo $CIF."&nbsp;&nbsp;<br>".$HrgSerah ?>&nbsp;&nbsp;</td>
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
<?php endif; if(count($rsDokPelengkap>0)): ?>
<table cellpadding="1" cellspacing="0" class="tablereport">
<tbody>
<tr>
  <td align="center" colspan="2"><h2>BC 2.7 </h2></td>
  <td class="noborderright">&nbsp;</td>
  <td align="center" colspan="14"><h3>LEMBAR LAMPIRAN<br>DOKUMEN PELENGKAP PABEAN</h3></td>
</tr>
<tr>
  <td colspan="17"><b>HEADER</b></td>
</tr>
<tr>
  <td align="right" class="noborderbtm" colspan="17">Halaman ... Dari ...
    <?php //if ($countBarang > 1){echo "3 Dari 3";}else{echo "2 Dari 2";}?>&nbsp; &nbsp; </td>
</tr>
<tr>
  <td class="noborderrb" colspan="3"><b>NOMOR PENGAJUAN</b></td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4"><?php echo $rs[0]['FCAR'] ?></td>
  <td class="noborderbtm" colspan="9"><b>D. TUJUAN PENGIRIMAN : &nbsp; &nbsp; &nbsp;<?php echo strtoupper(getTujKirim($rs[0]['KdTp'])) ?></b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3"><b>A. KANTOR PABEAN</b></td>
  <td class="noborderrb"></td>
  <td class="noborderrb" colspan="4"></td>
  <td colspan="9"></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3"> &nbsp; &nbsp; 1. Kantor Asal</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo $rs[0]['KdKpbcAsal'] ?></td>
  <td class="noborderbtm" colspan="9"></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3"> &nbsp; &nbsp; 2. Kantor Tujuan</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo $rs[0]['KdKpbcTuj'] ?></td>
  <td class="noborderbtm" colspan="9"><b>G. KOLOM KHUSUS BEA DAN CUKAI</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3"><b>B. JENIS TPB ASAL</b></td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo getJnsTpb($rs[0]['KdJnsTpbAsal']) ?></td>
  <td class="noborderrb" colspan="2">Nomor Pendaftaran</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6"><?php echo $rs[0]['FNoDaf'] ?></td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3"><b>C. JENIS TPB TUJUAN</b></td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"><?php echo getJnsTpb($rs[0]['KdJnsTpbTuj']) ?></td>
  <td class="noborderright" colspan="2">Tanggal</td>
  <td class="noborderright">:</td>
  <td colspan="6"><?php echo $rs[0]['tgl_daf'] ?></td>
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
</body>
</html>