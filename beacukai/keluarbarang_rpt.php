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
$UrJnsDok=getUrJnsDok($DokKdBc);
$dtdari=$_REQUEST['dtdari'];
$dtsampai=$_REQUEST['dtsampai'];

$q = "SELECT *,CONCAT(LEFT(h.CAR,8),'-',RIGHT(h.CAR,6)) AS FCAR,CONCAT(LEFT(NoDaf,3),'.',RIGHT(NoDaf,3)) AS FNoDaf,DATE_FORMAT(TgDaf,'%d/%m/%Y') AS FTgDaf,DATE_FORMAT(DokTg,'%d/%m/%Y') AS FDokTg,FORMAT(qty,2) AS Fqty,FORMAT(b.HrgSerah,2) AS FHrgSerah 
	  FROM header h 
	  INNER JOIN jenis_dok jd ON jd.KdJnsDok=h.DokKdBc
	  LEFT JOIN dokumen d ON d.DokKdBc=h.DokKdBc AND d.CAR=h.CAR AND DokKd='1' 
	  LEFT JOIN barang b ON b.DokKdBc=h.DokKdBc AND b.CAR=h.CAR ";

if ($DokKdBc != ""){  
	$q .= "WHERE h.DokKdBc LIKE '%$DokKdBc%' ";
} else {
	$q .= "WHERE h.DokKdBc IN ('7','9','4','3') ";//BC 2.7.1 belum dimasukan
}

if($dtdari != '' && $dtsampai != ''):
	$q .= "AND TgDaf BETWEEN '".dmys2ymd($dtdari)."' AND '".dmys2ymd($dtsampai)."' ";
endif;
$q .= "ORDER BY h.DokKdBc,NoDaf, TgDaf";
$rec = $pdo->query($q);
$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
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
    border: 1px solid #000;	
    border-collapse:collapse;
    margin:5px 0pt 10px;		
    font-size: 9pt;
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
<h5>LAPORAN PENGELUARAN BARANG PER DOKUMEN <?php echo $UrJnsDok ?><br>KAWASAN BERIKAT <?php echo $_SESSION['c_name'] ?><br>LAPORAN PENGELUARAN BARANG PER DOKUMEN <?php echo $UrJnsDok ?><br>PERIODE <?php echo $dtdari." S.D ".$dtsampai ?></h5>
<table cellpadding="1" cellspacing="0" class="tablereport">
<thead>
<tr>
  <th width="26" rowspan="2">No.</th>
  <th width="69" rowspan="2">Jenis<br>Dokumen</th>
  <th colspan="2">Dokumen Pabean</th>
  <th colspan="2">Bukti Penerimaan Barang</th>
  <th width="189" rowspan="2">Pemasok/Pengirim</th>
  <th width="79" rowspan="2">Kode Barang</th>
  <th width="260" rowspan="2">Nama Barang</th>
  <th width="41" rowspan="2">Sat</th>
  <th width="64" rowspan="2">Jumlah</th>
  <th width="111" rowspan="2">Nilai Barang</th>
</tr>
<tr>
  <th width="62">Nomor</th>
  <th width="65">Tanggal</th>
  <th width="63">Nomor</th>
  <th width="65">Tanggal</th>
</tr>
</thead>
<tbody>
<?php $i=1; foreach ($rs as $r): ?>
<tr>
  <td align="center"><?php echo $i ?></td>
  <td><?php echo $r['UrJnsDok'] ?></td>
  <td align="center"><?php echo $r['FNoDaf'] ?></td>
  <td align="center"><?php echo $r['FTgDaf'] ?></td>
  <td align="center"><?php echo $r['DokNo'] ?></td>
  <td align="center"><?php echo $r['FDokTg'] ?></td>
  <td valign="top"><?php echo $r['NmTuj'] ?></td>
  <td><?php echo $r['KdBarang'] ?></td>
  <td valign="top"><?php echo $r['UrBarang'] ?></td>
  <td align="center"><?php echo $r['unit'] ?></td>
  <td align="right"><?php echo $r['Fqty'] ?></td>
  <td align="right"><?php echo $r['FHrgSerah'] ?></td>
</tr>
<?php $i++; endforeach; ?>
</tbody>
</table>
</body>
</html>