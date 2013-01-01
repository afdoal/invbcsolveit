<?php
require_once "../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";
require_once "toxls.php";

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 25;
$offset = ($page-1)*$rows;
$result = array();

$DokKdBc=$_REQUEST['DokKdBc'];
$dtdari=$_REQUEST['dtdari'];
$dtsampai=$_REQUEST['dtsampai'];

$q1 = "SELECT COUNT(*) AS jml1 FROM header WHERE DokKdBc='1' AND KdJnsTpbAsal='1' ";
$q2 = "SELECT COUNT(*) AS jml2 FROM header WHERE DokKdBc='6' AND KdJnsTpbAsal='2' ";
$q3 = "SELECT COUNT(*) AS jml3 FROM header WHERE DokKdBc='6' AND KdJnsTpbAsal!='2' ";
$q4 = "SELECT COUNT(*) AS jml4 FROM header a LEFT JOIN hdrjaminan b ON b.DokKdBc=a.DokKdBc AND b.CAR=a.CAR WHERE a.DokKdBc='5' AND KdTp='3' AND b.NoJaminan!='' ";
$q5 = "SELECT COUNT(*) AS jml5 FROM header a LEFT JOIN hdrjaminan b ON b.DokKdBc=a.DokKdBc AND b.CAR=a.CAR WHERE a.DokKdBc='5' AND KdTp IN ('6','7','8') AND NoJaminan!='' ";
$q6 = "SELECT COUNT(*) AS jml6 FROM header WHERE DokKdBc='6' AND KdTp='3' ";
$q7 = "SELECT COUNT(*) AS jml7 FROM header WHERE DokKdBc='6' AND KdJnsTpbAsal='1' AND KdTp IN ('6','7','8') ";
$q8 = "SELECT COUNT(*) AS jml8 FROM header WHERE DokKdBc='2' ";
$q9 = "SELECT COUNT(*) AS jml9 FROM header WHERE DokKdBc='8' ";
$q10 = "SELECT COUNT(*) AS jml10 FROM header WHERE DokKdBc='7' AND  KdJnsEkspor!='3' ";
$q11 = "SELECT COUNT(*) AS jml11 FROM header WHERE DokKdBc='7' AND  KdJnsEkspor='3' ";
$q12 = "SELECT COUNT(*) AS jml12 FROM header WHERE DokKdBc='6' AND KdJnsTpbTuj!='1' ";
$q13 = "SELECT COUNT(*) AS jml13 FROM header a LEFT JOIN hdrjaminan b ON b.DokKdBc=a.DokKdBc AND b.CAR=a.CAR  WHERE a.DokKdBc='4' AND KdTp='3' AND b.NoJaminan!='' ";
$q14 = "SELECT COUNT(*) AS jml14 FROM header a LEFT JOIN hdrjaminan b ON b.DokKdBc=a.DokKdBc AND b.CAR=a.CAR WHERE a.DokKdBc='4' AND KdTp IN ('6','7','8') AND NoJaminan!='' ";
$q15 = "SELECT COUNT(*) AS jml15 FROM header WHERE DokKdBc='6' AND KdTp='3' ";
$q16 = "SELECT COUNT(*) AS jml16 FROM header WHERE DokKdBc='6' AND KdJnsTpbAsal='1' AND KdTp IN ('6','7','8') ";
$q17 = "SELECT COUNT(*) AS jml17 FROM header WHERE DokKdBc='3' ";
$q18 = "SELECT COUNT(*) AS jml18 FROM header WHERE DokKdBc='9' ";
$q24 = "SELECT SUM(bayar) AS jml24 FROM header a LEFT JOIN hdrjaminan b ON b.DokKdBc=a.DokKdBc AND b.CAR=a.CAR WHERE a.DokKdBc='3' AND JnsJaminan='BM' ";

if($dtdari != '' && $dtsampai != ''):
	$wh = "AND TgDaf BETWEEN '".dmys2ymd($dtdari)."' AND '".dmys2ymd($dtsampai)."' ";
	$q1 .= $wh;
	$q2 .= $wh;
	$q4 .= $wh;
	$q5 .= $wh;
	$q6 .= $wh;
	$q7 .= $wh;
	$q8 .= $wh;
	$q9 .= $wh;
	$q10 .= $wh;
	$q11 .= $wh;
	$q12 .= $wh;
	$q13 .= $wh;
	$q14 .= $wh;
	$q15 .= $wh;
	$q16 .= $wh;
	$q17 .= $wh;
	$q18 .= $wh;
	$q24 .= $wh;
endif;

$run1=$pdo->query($q1);
$rs1=$run1->fetchAll(PDO::FETCH_ASSOC);

$run2=$pdo->query($q2);
$rs2=$run2->fetchAll(PDO::FETCH_ASSOC);

$run4=$pdo->query($q4);
$rs4=$run4->fetchAll(PDO::FETCH_ASSOC);

$run5=$pdo->query($q5);
$rs5=$run5->fetchAll(PDO::FETCH_ASSOC);

$run6=$pdo->query($q6);
$rs6=$run6->fetchAll(PDO::FETCH_ASSOC);

$run7=$pdo->query($q7);
$rs7=$run7->fetchAll(PDO::FETCH_ASSOC);

$run8=$pdo->query($q8);
$rs8=$run8->fetchAll(PDO::FETCH_ASSOC);

$run9=$pdo->query($q9);
$rs9=$run9->fetchAll(PDO::FETCH_ASSOC);

$run10=$pdo->query($q10);
$rs10=$run10->fetchAll(PDO::FETCH_ASSOC);

$run11=$pdo->query($q11);
$rs11=$run11->fetchAll(PDO::FETCH_ASSOC);

$run12=$pdo->query($q12);
$rs12=$run12->fetchAll(PDO::FETCH_ASSOC);

$run13=$pdo->query($q13);
$rs13=$run13->fetchAll(PDO::FETCH_ASSOC);

$run14=$pdo->query($q14);
$rs14=$run14->fetchAll(PDO::FETCH_ASSOC);

$run15=$pdo->query($q15);
$rs15=$run15->fetchAll(PDO::FETCH_ASSOC);

$run16=$pdo->query($q16);
$rs16=$run16->fetchAll(PDO::FETCH_ASSOC);

$run17=$pdo->query($q17);
$rs17=$run17->fetchAll(PDO::FETCH_ASSOC);

$run18=$pdo->query($q18);
$rs18=$run18->fetchAll(PDO::FETCH_ASSOC);

$run24=$pdo->query($q24);
$rs24=$run24->fetchAll(PDO::FETCH_ASSOC);

if ($_REQUEST['cetak'] == ""){
	echo '{"total":1,"rows":[{"c_name":"'.$_SESSION['c_name'].'","1":"'.$rs1[0]['jml1'].'","2":"","3":"","4":"'.$rs4[0]['jml4'].'","5":"'.$rs5[0]['jml5'].'","6":"","7":"","8":"'.$rs8[0]['jml8'].'","9":"'.$rs9[0]['jml9'].'","10":"'.$rs10[0]['jml10'].'","11":"'.$rs11[0]['jml11'].'","12":"'.$rs12[0]['jml12'].'","13":"'.$rs13[0]['jml13'].'","14":"'.$rs14[0]['jml14'].'","15":"'.$rs15[0]['jml15'].'","16":"'.$rs16[0]['jml16'].'","17":"'.$rs17[0]['jml17'].'","18":"'.$rs18[0]['jml18'].'","BAP":"","i1":"","e1":"","i2":"","e2":"","bm":"'.number_format($rs24[0]['jml24'],2).'"}]}';
} else {
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
table {
	font-size:12px;
}
table.tablereport {	
    border: 1px solid #000;	
    border-collapse:collapse;
    margin:5px 0pt 10px;		
    font-size: 12px;
	width:1120px;
    /*width: 8.27in;	
    height:11.69in;*/
	/*width:11.69in;*/
}
table.tablereport thead tr th{		
    border: 1px solid #000;		
    font-size: 9pt;		
    padding: 4px;
    vertical-align:middle;
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
.nobordertlr{
	border-top:hidden !important;
    border-left:hidden !important;
    border-right:hidden !important;    
	border-bottom:1px solid #000 !important;
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
<h5>REKAPITULASI KEGIATAN PERUSAHAAN YANG MENDAPAT FASILITAS KAWASAN BERIKAT DI BAWAH PENGAWASAN KPPBC <?php echo getKantor($_SESSION['KpbcPengawas']) ?><br>PERIODE <?php echo $dtdari." S.D ".$dtsampai ?></h5>
<table cellpadding="1" cellspacing="0" class="tablereport">
<thead>
<tr>
  <th width="26" rowspan="4">No.</th>
  <th rowspan="4">Nama Kawasan<br>Berikat dan Gudang<br>Berikat</th>
  <th colspan="19">JUMLAH DOKUMEN</th>
  <th colspan="2" rowspan="2">NILAI DEVISA / USD</th>
  <th colspan="2" rowspan="2">TONAGE / KG</th>
  <th rowspan="4">Nilai BM<br>( Rp )<br>Jual Ke DPIL</th>
</tr>
<tr>
  <th colspan="9">Pemasukan</th>
  <th colspan="9">Pengeluaran</th>
  <th rowspan="3">Berita<br>Acara<br>Pemusnahan</th>
</tr>
<tr>
  <th>BC 2.3</th>
  <th colspan="2">BC 2.7</th>
  <th colspan="2">BC 2.6.2</th>
  <th colspan="2">BC 2.7</th>
  <th>BC 2.4</th>
  <th>BC 4.0</th>
  <th colspan="2">BC 3.0</th>
  <th>BC 2.7</th>
  <th colspan="2">BC 2.6.1</th>
  <th colspan="2">BC 2.7</th>
  <th>BC 2.5</th>
  <th>BC 4.1</th>
  <th rowspan="2">IMPOR</th>
  <th rowspan="2">EKSPOR</th>
  <th rowspan="2">IMPOR</th>
  <th rowspan="2">EKSPOR</th>  
</tr>
<tr>
  <th>1</th>
  <th>2</th>
  <th>3</th>
  <th>4</th>
  <th>5</th>
  <th>6</th>
  <th>7</th>
  <th>8</th>
  <th>9</th>
  <th>10</th>
  <th>11</th>
  <th>12</th>
  <th>13</th>
  <th>14</th>
  <th>15</th>
  <th>16</th>
  <th>17</th>
  <th>18</th>
</tr>
</thead>
<tbody>
<tr>
  <td align="center"><?php echo 1 ?></td>
  <td><?php echo $_SESSION['c_name'] ?></td>
  <td align="center"><?php echo $rs1[0]['jml1'] ?></td>
  <td align="center"><?php //echo $rs2[0]['jml2'] ?></td>
  <td align="center"></td>
  <td align="center"><?php echo $rs4[0]['jml4'] ?></td>
  <td align="center"><?php echo $rs5[0]['jml5'] ?></td>
  <td align="center"><?php //echo $rs6[0]['jml6'] ?></td>
  <td align="center"><?php //echo $rs7[0]['jml7'] ?></td>
  <td align="center"><?php echo $rs8[0]['jml8'] ?></td>
  <td align="center"><?php echo $rs9[0]['jml9'] ?></td>
  <td align="center"><?php echo $rs10[0]['jml10'] ?></td>
  <td align="center"><?php echo $rs11[0]['jml11'] ?></td>
  <td align="center"><?php echo $rs12[0]['jml12'] ?></td>
  <td align="center"><?php echo $rs13[0]['jml13'] ?></td>
  <td align="center"><?php echo $rs14[0]['jml14'] ?></td>
  <td align="center"><?php echo $rs15[0]['jml15'] ?></td>
  <td align="center"><?php echo $rs16[0]['jml16'] ?></td>
  <td align="center"><?php echo $rs17[0]['jml17'] ?></td>
  <td align="center"><?php echo $rs18[0]['jml18'] ?></td>
  <td align="center"><?php //echo $rs19[0]['jml19'] ?></td>
  <td align="center"><?php //echo $rs20[0]['jml20'] ?></td>
  <td align="center"><?php //echo $rs21[0]['jml21'] ?></td>
  <td align="center"><?php //echo $rs22[0]['jml22'] ?></td>
  <td align="center"><?php //echo $rs23[0]['jml23'] ?></td>
  <td align="center"><?php echo number_format($rs24[0]['jml24'],2) ?></td>
</tr>
</tbody>
</table>
<table width="1120">
<tr>
  <td>
  	Keterangan :<br>
1.	Pemasukan dari Tempat Penimbunan Sementara<br>				
2.	Pemasukan dari Gudang Berikat<br>				
3.	Pemasukan dari PDKB Lain<br>				
4.	Pemasukan dalam rangka Subkontrak dengan jaminan<br>				
5.	Pemasukan kembali setelah diperbaiki/dipinjamkan/dipamerkan dengan jaminan<br>				
6.	Pemasukan dalam rangka Subkontrak dari KB<br>				
7.	Pemasukan kembali setelah diperbaiki/dipinjamkan/dipamerkan dari KB<br>				
8.	Pemasukan dari produsen Pengguna fasilitas Bapeksta Keuangan<br>				
9.	Pemasukan dari DPIL<br>
  </td>
  <td><br>
10.	Ekspor<br>
11.	Ekspor Kembali<br>
12.	Pengeluaran ke PDKB Lain<br>
13.	Pengeluaran dalam rangka Subkontrak dengan jaminan<br>
14.	Pengeluaran kembali setelah diperbaiki/dipinjamkan/dipamerkan dengan jaminan<br>
15.	Pengeluaran dalam rangka Subkontrak dari KB<br>
16.	Pengeluaran kembali setelah diperbaiki/dipinjamkan/dipamerkan dari KB<br>
17.	Pengeluaran dari DPIL<br>
18.	Pengeluaran kembali setelah salah kirim <br>
  </td>
  <td valign="top"><br>
19.  Jumlah Berita Acara Pemusnahan yang ditangani hanggar<br>
20.  Jumlah Nilai Devisa Impor dari BC 23<br>
21. Jumlah Nilai Devisa Ekspor dokumen BC 30<br>
22. Jumlah Tonage Impor dari Dokumen BC 2.3<br>
23. Jumlah Tonage Ekspor Dokumen BC 3.0<br>
24. Jumlah BM dari Dokumen BC 2.5<br>
  
  </td>
</tr>
</table>
</body>
</html>
<?php
} 
?>