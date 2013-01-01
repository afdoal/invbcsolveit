<?php
require_once "../models/abspath.php";
require_once "pdocon.php";
require_once "controller/class_tgl.php" ;
$objAngka = new classAkunting();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
	<meta name="Author" content="Kikin Kusumah" />
	<style type="text/css" media="all">	
	#A4P {
		border:0px #000 solid;
		font-family:arial;
		font-size:9pt;
		height:11.69in;
		width:8.27in;				
	}
	#borderAll {
		border: 1px solid #000;	  	    
	}
	.p_spacing{
		margin-top:4px;
		margin-bottom:4px;
	}
	table.tablereport {
		border: 1px solid #000;	
		border-collapse:collapse;
		margin:5px 0pt 10px;		
		font-size: 9pt;
		width: 100%;		
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
	.noborderltr{
		border-left:hidden !important;
		border-top:hidden !important;
		border-right:hidden !important;
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
	
	.cetak {
		page-break-after:always;
		height:60px;
	}
	</style>
<body>
<div id="A4P" style="display:block">
<table cellpadding="1" cellspacing="0" class="tablereport">
<thead>
<tr>
  <td align="center" colspan="2" valign="middle"><h2>BC 2.6.2 </h2></td>
  <td class="noborderright">&nbsp;</td>
  <td align="center" colspan="14"><h3>PEMBERITAHUAN PEMASUKAN BARANG ASAL TEMPAT LAIN DALAM<br>DAERAH PABEAN KE TEMPAT PENIMBUNAN BERIKAT</h3></td>
</tr>
<tr>
  <td colspan="17"><b>HEADER</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">NOMOR PENGAJUAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4">002237</td>
  <td align="center" colspan="9">Halaman 1 Dari 1</td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">A. KANTOR PABEAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">KPPBC Tipe A Bandung</td>
  <td class="noborderbtm" colspan="9"><b>F. KOLOM KHUSUS BEA DAN CUKAI</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">B. JENIS TPB</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">Kawasan Berikat</td>
  <td class="noborderrb" colspan="2">Nomor Pendaftaran</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6">002237</td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3">C. TUJUAN PENGIRIMAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">Proses</td>
  <td class="noborderbtm" colspan="9">&nbsp;</td>
</tr> 
 <tr>
  <td colspan="8">&nbsp;</td>
  <td class="noborderright" colspan="2">Tanggal</td>
  <td class="noborderright">:</td>
  <td colspan="6">28/12/2010</td>
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
  <td colspan="17"><b>D. DATA PEMBERITAHUAN</b></td>
</tr>
<tr>
  <td colspan="8">PENGUSAHA TPB</td>  
  <td colspan="9">PENGIRIM BARANG</td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">1. NPWP</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">01.824.697.5-445.000</td>
  <td class="noborderrb" colspan="2">5. NPWP</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6">&nbsp;</td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3">2. NAMA</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">PT. Forever Garmindo</td>
  <td class="noborderrb" colspan="2">6. NAMA</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6">PT. CRYSTAL GEMILANG INDONESIA</td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3" valign="top">3. ALAMAT</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">Jl. Raya Banjaran Km.12,8 No.389<br>Kab. Bandung - Jawa Barat</td>
  <td class="noborderrb" colspan="2">7. ALAMAT</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6">JAKARTA</td>
</tr>
<tr>
  <td class="noborderright" colspan="3" valign="top">4. NO IZIN TPB</td>
  <td class="noborderright">:</td>
  <td colspan="4">881/KM.4/2010</td>
  <td colspan="9">&nbsp;</td>
</tr> 
<tr>
  <td colspan="17"><b>DOKUMEN PELENGKAP PABEAN</b></td>  
</tr>
<tr>
  <td class="noborderrb" colspan="3">8. Packing List</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb"></td>
  <td class="noborderbtm" colspan="3">Tanggal</td>
  <td class="noborderbtm" colspan="9">11. Jenis/Nomor/Tanggal dokumen lainnya :</td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">Kontrak</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4"></td>
  <td class="noborderbtm" colspan="9">12. Jenis sarana pengangkut darat :</td>
</tr> 
<tr>
  <td class="noborderrb" colspan="4"></td>
  <td class="noborderbtm" colspan="4">Tanggal</td>
  <td class="noborderbtm" colspan="9">13. Nomor Polisi :</td>
</tr>
<tr>
  <td colspan="8">10. Surat Keputusan/Persetujuan :</td>
  <td colspan="9">&nbsp;</td>
</tr>
<tr>
  <td colspan="17"><b>DATA PERDAGANGAN</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">14. Jenis Valuta Asing</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4"></td>
  <td class="noborderrb" colspan="2">16. Nilai CIF </td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6">&nbsp;</td>
</tr>
<tr>
  <td class="noborderright" colspan="3">15. NPDBM</td>
  <td class="noborderright">:</td>
  <td colspan="13"></td>
</tr>
<tr>
  <td colspan="17"><b>DATA PENGEMAS</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">17. Jenis Kemasan</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4">BOX</td>
  <td class="noborderbtm" colspan="9">19. Jumlah Kemasan :</td>
</tr>
<tr>
  <td class="noborderright" colspan="3">18. Merek Kemasan</td>
  <td class="noborderright">:</td>
  <td colspan="13">&nbsp;</td>
</tr>
<tr>
  <td colspan="17"><b>DATA BARANG</b></td>
</tr>
<tr>
  <td class="noborderright" colspan="5">20. Volume (m3) :</td>
  <td class="noborderright" colspan="3">21. Berat Kotor (kg) : </td>
  <td colspan="9">22. Berat Bersih (kg) : </td>
</tr>
</thead>
<tbody>
<tr>
  <td class="noborderbtm" width="20">23.</td>
  <td class="noborderrb">24.</td>
  <td class="noborderbtm" colspan="6">&nbsp;</td>
  <td class="noborderbtm" colspan="2">25.</td>
  <td class="noborderbtm" colspan="3">26.</td>
  <td class="noborderbtm" colspan="2">27.</td>
  <td class="noborderbtm" colspan="2">28.</td>
</tr>
<tr>
  <td>No. </td>
  <td colspan="7">Uraian Jumlah dan Jenis Barang secara Lengkap,<br>Kode Barang, Merk, Tipe, Ukuran, dan Spesifikasi Lain</td>
  <td colspan="2">Negara Asal Barang </td>
  <td colspan="3">- Skema Tarif <br> - Tarif </td>
  <td colspan="2">- Jumlah dan Jenis Satuan<br>- Berat Bersih (Kg)<br>- Volume (m3) </td>
  <td colspan="2">Nilai CIF</td>
</tr>
<tr>
  <td class="noborderbtm">1 </td>
  <td class="noborderbtm" colspan="7">CVC 24/1 Hoslery </td>
  <td class="noborderbtm" colspan="2">TAIWAN</td>
  <td class="noborderbtm" colspan="3">PPn 10% </td>
  <td class="noborderbtm" colspan="2">10.856 balls </td>
  <td class="noborderbtm" colspan="2">68.866.990,08 </td>
</tr>
<tr style="height:100%">
  <td></td>
  <td colspan="7"></td>
  <td colspan="2"></td>
  <td colspan="3"></td>
  <td colspan="2"></td>
  <td colspan="2"></td>
</tr>
<tr>
  <td> </td>
  <td align="center" colspan="16"><b>" LIHAT LEMBAR LANJUTAN "</b></td>
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
  <td colspan="3"></td>
  <td colspan="5">35. Jenis Jaminan</td>
  <td colspan="4">: </td>
</tr>
<tr>
  <td colspan="5">30. CUKAI</td>
  <td colspan="3"></td>
  <td colspan="5">36. Nomor Jaminan</td>
  <td colspan="4">: </td>
</tr>
<tr>
  <td colspan="5">31. PPN</td>
  <td colspan="3"></td>
  <td colspan="5">37. Nilai Jaminan</td>
  <td colspan="4">: </td>
</tr>
<tr>
  <td colspan="5">32. PPnBM</td>
  <td colspan="3"></td>
  <td colspan="5">38. Jatuh Tempo Jaminan</td>
  <td colspan="4">: </td>
</tr>
<tr>
  <td colspan="5">33. PPh</td>
  <td colspan="3"></td>
  <td colspan="5">39. Penjamin</td>
  <td colspan="4">: </td>
</tr>
<tr>
  <td colspan="5">34. Total</td>
  <td colspan="3"></td>
  <td colspan="5">40. Bukti Penerimaan Jaminan</td>
  <td colspan="4">: </td>
</tr>
</tbody>
<tfoot>
<tr>
  <td colspan="8"><b>G. UNTUK PEJABAT BEA DAN CUKAI</b></td>
  <td colspan="9"><b>E. TANDA TANGAN PENGUSAHA TPB</b></td>
</tr>
<tr>
  <td align="center" colspan="8">&nbsp;<br><br><br><br><br>AGUS W<br>NIP. 19571015.197810.1.001</td>
  <td colspan="9">
  Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal<br>
  yang diberitahukan dalam pemberitahuan pabean ini.<br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; Subang, Tanggal 01/12/2010<br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Kikin</td>
</tr> 
</tfoot>
</table>
Rangkap ke- 1/2/3 : Kantor Pabean / Pengusaha TPB / Pengirim Barang  
</div>
<div class="cetak">&nbsp;</div>
<div id="A4P" style="display:block">
<table cellpadding="1" cellspacing="0" class="tablereport">
<thead>
<tr>
  <td align="center" colspan="2"><h2>BC 2.6.1 </h2></td>
  <td class="noborderright">&nbsp;</td>
  <td align="center" colspan="14"><h3>LEMBAR LANJUTAN<br>DATA BARANG</h3></td>
</tr>
<tr>
  <td colspan="17"><b>HEADER</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">NOMOR PENGAJUAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4" width="75">002237</td>
  <td align="center" colspan="9">Halaman 1 Dari 1</td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">A. KANTOR PABEAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">KPPBC Tipe A Bandung</td>
  <td class="noborderbtm" colspan="9"><b>F. KOLOM KHUSUS BEA DAN CUKAI</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">B. JENIS TPB</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">Kawasan Berikat</td>
  <td class="noborderrb" colspan="2">Nomor Pendaftaran</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6">002237</td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3">C. TUJUAN PENGIRIMAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">Proses</td>
  <td class="noborderbtm" colspan="9">&nbsp;</td>
</tr> 
 <tr>
  <td colspan="8">&nbsp;</td>
  <td class="noborderright" colspan="2">Tanggal</td>
  <td class="noborderright">:</td>
  <td colspan="6">28/12/2010</td>
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
</thead>
<tbody style="height:650px">
<tr>
  <td class="noborderbtm" width="20">23.</td>
  <td class="noborderrb">24.</td>
  <td class="noborderbtm" colspan="6">&nbsp;</td>
  <td class="noborderbtm" colspan="2">25.</td>
  <td class="noborderbtm" colspan="3">26.</td>
  <td class="noborderbtm" colspan="2">27.</td>
  <td class="noborderbtm" colspan="2">28.</td>
</tr>
<tr>
  <td>No. </td>
  <td colspan="7">Uraian Jumlah dan Jenis Barang secara Lengkap,<br>Kode Barang, Merk, Tipe, Ukuran, dan Spesifikasi Lain</td>
  <td colspan="2">Negara Asal Barang </td>
  <td colspan="3">- Skema Tarif <br> - Tarif </td>
  <td colspan="2">- Jumlah dan Jenis Satuan<br>- Berat Bersih (Kg)<br>- Volume (m3) </td>
  <td colspan="2">Nilai CIF</td>
</tr>
<tr>
  <td class="noborderbtm">1 </td>
  <td class="noborderbtm" colspan="7">CVC 24/1 Hoslery </td>
  <td class="noborderbtm" colspan="2">TAIWAN</td>
  <td class="noborderbtm" colspan="3">PPn 10% </td>
  <td class="noborderbtm" colspan="2">10.856 balls </td>
  <td class="noborderbtm" colspan="2">68.866.990,08 </td>
</tr>
<tr style="height:100%">
  <td></td>
  <td colspan="7"></td>
  <td colspan="2"></td>
  <td colspan="3"></td>
  <td colspan="2"></td>
  <td colspan="2"></td>
</tr>
</tbody>
<tfoot>
<tr>
  <td class="noborderright" colspan="9">&nbsp;</td>
  <td colspan="8"><b>E. TANDA TANGAN PENGUSAHA TPB</b></td>
</tr>
<tr>
  <td class="noborderright"></td>
  <td class="noborderright"></td>
  <td align="center" class="noborderright" colspan="7">&nbsp;<br><br><br><br><br></td>
  <td colspan="8">
  Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal<br>
  yang diberitahukan dalam pemberitahuan pabean ini.<br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; Subang, Tanggal 01/12/2010<br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Kikin</td>
</tr> 
</tfoot>
</table>
Rangkap ke- 1/2/3 : Kantor Pabean / Pengusaha TPB / Pengirim Barang  
</div>
<div class="cetak">&nbsp;</div>
<div id="A4P" style="display:block">
<table cellpadding="1" cellspacing="0" class="tablereport">
<thead>
<tr>
  <td align="center" colspan="2"><h2>BC 2.6.1 </h2></td>
  <td class="noborderright">&nbsp;</td>
  <td align="center" colspan="14"><h3>LEMBAR LAMPIRAN<br>DOKUMEN PELENGKAP PABEAN</h3></td>
</tr>
<tr>
  <td colspan="17"><b>HEADER</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">NOMOR PENGAJUAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="4" width="75">002237</td>
  <td align="center" colspan="9">Halaman 1 Dari 1</td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">A. KANTOR PABEAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">KPPBC Tipe A Bandung</td>
  <td class="noborderbtm" colspan="9"><b>F. KOLOM KHUSUS BEA DAN CUKAI</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">B. JENIS TPB</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">Kawasan Berikat</td>
  <td class="noborderrb" colspan="2">Nomor Pendaftaran</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6">002237</td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3">C. TUJUAN PENGIRIMAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="4">Proses</td>
  <td class="noborderbtm" colspan="9">&nbsp;</td>
</tr> 
 <tr>
  <td colspan="8">&nbsp;</td>
  <td class="noborderright" colspan="2">Tanggal</td>
  <td class="noborderright">:</td>
  <td colspan="6">28/12/2010</td>
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
</thead>
<tbody style="height:650px">
<tr>
  <td align="center" width="20">NO.</td>
  <td class="noborderright"></td>
  <td colspan="6">JENIS DOKUMEN</td>
  <td align="center" colspan="5">NOMOR</td>
  <td align="center" colspan="4">TANGGAL</td>
</tr>
<tr>
  <td class="noborderbtm">1 </td>
  <td class="noborderbtm" colspan="7">CVC 24/1 Hoslery </td>
  <td class="noborderbtm" colspan="5">10.856 balls </td>
  <td class="noborderbtm" colspan="4">68.866.990,08 </td>
</tr>
<tr height="100%">
  <td></td>
  <td colspan="7"></td>
  <td colspan="5"></td>
  <td colspan="4"></td>
</tr>
</tbody>
<tfoot>
<tr>
  <td class="noborderright" colspan="9">&nbsp;</td>
  <td colspan="8"><b>E. TANDA TANGAN PENGUSAHA TPB</b></td>
</tr>
<tr>
  <td class="noborderright"></td>
  <td class="noborderright"></td>
  <td align="center" class="noborderright" colspan="7">&nbsp;<br><br><br><br><br></td>
  <td colspan="8">
  Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal<br>
  yang diberitahukan dalam pemberitahuan pabean ini.<br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; Subang, Tanggal 01/12/2010<br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Kikin</td>
</tr> 
</tfoot>
</table>
Rangkap ke- 1/2/3 : Kantor Pabean / Pengusaha TPB / Pengirim Barang  
</div>
<div class="cetak">&nbsp;</div>
<div id="A4P" style="display:block">
<table cellpadding="1" cellspacing="0" class="tablereport">
<thead>
<tr>
  <td align="center" colspan="2"><h2>BC 2.6.1 </h2></td>
  <td class="noborderright">&nbsp;</td>
  <td align="center" colspan="14"><h3>LEMBAR LAMPIRAN<br>BARANG YANG AKAN DIMASUKKAN KEMBALI KE TPB</h3></td>
</tr>
<tr>
  <td colspan="17"><b>HEADER</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">NOMOR PENGAJUAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="5" width="75">002237</td>
  <td align="center" colspan="8">Halaman 1 Dari 1</td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">A. KANTOR PABEAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="5">KPPBC Tipe A Bandung</td>
  <td class="noborderbtm" colspan="8"><b>F. KOLOM KHUSUS BEA DAN CUKAI</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">B. JENIS TPB</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="5">Kawasan Berikat</td>
  <td class="noborderrb" colspan="2">Nomor Pendaftaran</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="6">002237</td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3">C. TUJUAN PENGIRIMAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="5">Proses</td>
  <td class="noborderbtm" colspan="8">&nbsp;</td>
</tr> 
 <tr>
  <td colspan="9">&nbsp;</td>
  <td class="noborderright" colspan="2">Tanggal</td>
  <td class="noborderright">:</td>
  <td colspan="5">28/12/2010</td>
</tr>
<tr>
	<td class="nobordertr" width="10"></td>
    <td class="nobordertr" width="80"></td>
    <td class="nobordertr" width="30"></td>
    <td class="nobordertr" width="5"></td>
    <td class="nobordertr"></td>
    <td class="nobordertr"></td>
    <td class="nobordertr"></td>
    <td class="nobordertr"></td>
	<td class="nobordert"></td>
    <td class="nobordertr" width="50"></td>
    <td class="nobordertr" width="50"></td>
    <td class="nobordertr" width="5"></td>
    <td class="nobordertr" width="50"></td>
    <td class="nobordertr" width="30"></td>
    <td class="nobordertr" width="40"></td>
    <td class="nobordertr" width="40"></td>
    <td class="nobordertr" width="40"></td>
</tr>

</thead>
<tbody style="height:650px">
<tr>
  <td width="20">No. </td>
  <td colspan="8">Uraian Jumlah dan Jenis Barang secara Lengkap,<br>Kode Barang, Merk, Tipe, Ukuran, dan Spesifikasi Lain</td>
  <td colspan="4">- Jumlah dan Jenis Satuan<br>- Berat Bersih (Kg)<br>- Volume (m3) </td>
  <td colspan="4">Nilai CIF </td>
</tr>
<tr>
  <td class="noborderbtm">1 </td>
  <td class="noborderbtm" colspan="8">CVC 24/1 Hoslery </td>
  <td class="noborderbtm" colspan="4">10.856 balls </td>
  <td class="noborderbtm" colspan="4">68.866.990,08 </td>
</tr>
<tr height="100%">
  <td>&nbsp;</td>
  <td colspan="8">&nbsp;</td>
  <td colspan="4">&nbsp;</td>
  <td colspan="4">&nbsp;</td>
</tr>
</tbody>
<tfoot>
<tr>
  <td class="noborderright" colspan="9">&nbsp;</td>
  <td colspan="8"><b>E. TANDA TANGAN PENGUSAHA TPB</b></td>
</tr>
<tr>
  <td class="noborderright"></td>
  <td class="noborderright"></td>
  <td align="center" class="noborderright" colspan="7">&nbsp;<br><br><br><br><br></td>
  <td colspan="8">
  Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal<br>
  yang diberitahukan dalam pemberitahuan pabean ini.<br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; Subang, Tanggal 01/12/2010<br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Kikin</td>
</tr> 
</tfoot>

</table>
Rangkap ke- 1/2/3 : Kantor Pabean / Pengusaha TPB / Pengirim Barang  
</div>
<div class="cetak">&nbsp;</div>
<div id="A4P" style="display:block">
<table cellpadding="1" cellspacing="0" class="tablereport">
<thead>
<tr>
  <td align="center" colspan="2"><h2>BC 2.6.1 </h2></td>
  <td class="noborderright">&nbsp;</td>
  <td align="center" colspan="14"><h3>LEMBAR LAMPIRAN<br>KONVERSI PEMAKAIAN BAHAN (SUB KONTRAK)</h3></td>
</tr>
<tr>
  <td colspan="17"><b>HEADER</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">NOMOR PENGAJUAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderrb" colspan="5">002237</td>
  <td align="center" colspan="8">Halaman 1 Dari 1</td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">A. KANTOR PABEAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="5">KPPBC Tipe A Bandung</td>
  <td class="noborderbtm" colspan="8"><b>F. KOLOM KHUSUS BEA DAN CUKAI</b></td>
</tr>
<tr>
  <td class="noborderrb" colspan="3">B. JENIS TPB</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="5">Kawasan Berikat</td>
  <td class="noborderrb" colspan="2">Nomor Pendaftaran</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="5">002237</td>
</tr> 
<tr>
  <td class="noborderrb" colspan="3">C. TUJUAN PENGIRIMAN</td>
  <td class="noborderrb">:</td>
  <td class="noborderbtm" colspan="5">Proses</td>
  <td class="noborderbtm" colspan="8">&nbsp;</td>
</tr> 
 <tr>
  <td colspan="9">&nbsp;</td>
  <td class="noborderright" colspan="2">Tanggal</td>
  <td class="noborderright">:</td>
  <td colspan="5">28/12/2010</td>
</tr>
<tr>
	<td class="nobordertr" width="10"></td>
    <td class="nobordertr" width="80"></td>
    <td class="nobordertr" width="30"></td>
    <td class="nobordertr" width="5"></td>
    <td class="nobordertr"></td>
    <td class="nobordertr"></td>
    <td class="nobordertr"></td>
    <td class="nobordertr" width="50"></td>
	<td class="nobordert" width="50"></td>
    
    <td class="nobordertr" width="50"></td>
    <td class="nobordertr" width="50"></td>
    <td class="nobordertr" width="5"></td>
    <td class="nobordertr" width="130"></td>
    <td class="nobordertr" width="30"></td>
    <td class="nobordertr" width="20"></td>
    <td class="nobordertr" width="30"></td>
    <td class="nobordert" width="20"></td>
</tr>
</thead>
<tbody style="height:650px">
<tr>
  <td width="20">No. </td>
  <td colspan="6">Pos Tarif/HS, Uraian Jumlah dan Jenis Barang secara Lengkap, Kode Barang, Merk, Tipe, Ukuran, dan Spesifikasi Lain</td>
  <td>Jumlah</td>
  <td>Satuan</td>
  <td colspan="4">Pos Tarif/HS, Uraian Jumlah dan Jenis Barang secara Lengkap, Kode Barang, Merk, Tipe, Ukuran, dan Spesifikasi Lain</td>
  <td colspan="2">Jumlah</td>
  <td colspan="2">Satuan</td>
</tr>
<tr>
  <td class="noborderbtm">1 </td>
  <td class="noborderbtm" colspan="6">CVC 24/1 Hoslery </td>
  <td class="noborderbtm"></td>
  <td class="noborderbtm"></td>
  <td class="noborderbtm" colspan="4">10.856 balls </td>
  <td class="noborderbtm" colspan="2"></td>
  <td class="noborderbtm" colspan="2"></td>
</tr>
<tr height="100%">
  <td></td>
  <td colspan="6"></td>
  <td></td>
  <td></td>
  <td colspan="4"></td>
  <td colspan="2"></td>
  <td colspan="2"></td>
</tr>
</tbody>
<tfoot>
<tr>
  <td class="noborderright" colspan="9">&nbsp;</td>
  <td colspan="8"><b>E. TANDA TANGAN PENGUSAHA TPB</b></td>
</tr>
<tr>
  <td align="center" class="noborderright" colspan="9">&nbsp;<br><br><br><br><br></td>
  <td colspan="8">
  Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal<br>
  yang diberitahukan dalam pemberitahuan pabean ini.<br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; Subang, Tanggal 01/12/2010<br><br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Kikin</td>
</tr> 
</tfoot>
</table>
Rangkap ke- 1/2/3 : Kantor Pabean / Pengusaha TPB / Pengirim Barang  
</div>
</body>
</html>