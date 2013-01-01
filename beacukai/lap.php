<html>
<head>
<meta name="Author" content="Kikin Kusumah" />
<title>Laporan</title>
<link href="css/cssBeaCukai.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
	require_once "../models/abspath.php";
	require_once "pdocon.php";
	
	require_once "class_tgl.php" ;
	require_once "classAkunting.php" ;
	$classBlnStart = new tanggal();
	$classBlnEnd = new tanggal();
	$objAngka = new classAkunting();
	
	
	$vKB=$_POST['fKB'];
	$vTahun=$_POST['fTahun'];
	$vRange=$_POST['fRange'];
	
	$tglPHP=date("d");
	$blnPHP=date("m");
	$thnPHP=date("Y");
	
	$cvKB=(int)$vKB;

	switch($vRange){
		case "1" : $blnStart = "01";
				 $blnEnd = "03";
				 break;
		case "2" : $blnStart = "04";
				 $blnEnd = "06";
				 break;
		case "3" : $blnStart = "07";
				 $blnEnd = "09";
				 break;
		case "4" : $blnStart = "10";
				 $blnEnd = "12";
				 break;
    }
	
?>
<div align="center">
<table width="900" align="center">
<tr>
  <td>
    <table align="right">
	  <tr>
	    <td>Lampiran IV B </td>
	  </tr>
	  <tr>
	    <td>Keputusan Menteri Keuangan</td>
	  </tr>
	  <tr>
	    <td>Nomor :</td>
	  </tr>
	  <tr>
	    <td>Tanggal :</td>
	  </tr>
	</table>
  </td>
</tr>
<tr>
  <td align="center"><b>MENTERI KEUANGAN<br>LAPORAN PEMAKAIAN BARANG DAN ATAU BAHAN DALAM PROSES<br>(Periode 3 Bulan)</b><hr size="3" style="border-bottom-style:double;" />
  </td>	
</tr>
<tr>
  <td>  
	<table align="left">
	  <tr>
	    <td>Nomor</td>
		<td>:</td>
		<td></td>
	  </tr>
  	  <tr>
	    <td>Nama P D K B</td>
		<td>:</td>
		<td>
<?php   	
/*** ambil single record ***/
    $res2 = $pdo2->query('SELECT * FROM company WHERE head_code="1-001"');
    foreach($res2 as $row2){
 	 	echo $row2['com_name']; 		
	}  
/*** ambil single record ***/
   $records = $pdo1->query('SELECT wh_name, address FROM warehouse WHERE wh_id ='.$cvKB);
   $rows = $records->fetchAll(PDO::FETCH_ASSOC);
	foreach($rows as $row){
 	 	echo $row['wh_name']; 	
	
?>		
		</td>
	  </tr>
	  <tr>
	    <td>Alamat</td>
		<td>:</td>
		<td><?php echo $row['address'] ; }	?></td>
	  </tr>
	  <tr>
	    <td>Periode Pelaporan</td>
		<td>:</td>
		<td>
<?php
 echo "1 ".$classBlnStart->bln_indo($blnStart)." ".$vTahun." s/d ".$classBlnEnd->GetLastDayofMonth($vTahun, $blnEnd)." ".$classBlnEnd->bln_indo($blnEnd)." ".$vTahun;
 $pdStart=$vTahun.".".$blnStart.".01";
 $pdEnd=$vTahun.".".$blnEnd.".".$classBlnEnd->GetLastDayofMonth($vTahun, $blnEnd);
 ?>
 		</td>
	  </tr>
	</table>
  </td>
</tr>
<tr>
  <td>  
	<table border="1" align="left">
	  <tr>
	    <td width="50" align="center"><strong>NO</strong></td>
		<td width="150" align="center"><strong>Jenis Barang</strong></td>
		<td width="70" align="center"><strong>Kode Barang</strong></td>
		<td width="70" align="center"><strong>Satuan</strong></td>
		<td width="85" align="center"><strong>Persediaan Awal</strong></td>
		<td width="85" align="center"><strong>Pemasukan<br>
		  (3 Bulan)</strong></td>
		<td width="85" align="center"><strong>Jumlah (5+6)</strong></td>
		<td width="85" align="center"><strong>Pengeluaran<br>
		  (3 Bulan)</strong></td>
		<td width="85" align="center"><strong>Pers. Akhir<br>
		  (7+8)</strong></td>
		<td width="113" align="center"><strong>Keterangan</strong></td>
	  </tr>	
	  <tr>
	    <td align="center"><strong>1</strong></td>
	    <td align="center"><strong>2</strong></td>
	    <td align="center"><strong>3</strong></td>
	    <td align="center"><strong>4</strong></td>
	    <td align="center"><strong>5</strong></td>
	    <td align="center"><strong>6</strong></td>
	    <td align="center"><strong>7</strong></td>
	    <td align="center"><strong>8</strong></td>
	    <td align="center"><strong>9</strong></td>
		<td align="center"><strong>10</strong></td>
	  </tr> 
<?php
   $qGg='SELECT DISTINCT b.gg_id, b.gg_name FROM fg a, goodgrp b WHERE a.fg_id=b.gg_id AND b.gg_id IN (SELECT a.fg_id FROM fg a, goodgrp b, WIPd c, WIPH d WHERE a.fg_id=b.gg_id AND c.WIP_id=d.WIP_id AND a.fg_code=c.good_code AND d.Date >= {^'.$pdStart.'} And d.Date <= {^'.$pdEnd.'} AND d.wh_id='.$vKB.') ORDER by b.gg_name ASC';
   $recordsGg = $pdo1->query($qGg);
   //echo $qGg;
   $rowsGg = $recordsGg->fetchAll(PDO::FETCH_ASSOC);
   $no=1;
	foreach($rowsGg as $rowGg){
?>
	  <tr>
	    <td colspan="10" align="left"><b><?php $grpId=$rowGg['gg_id']; echo $rowGg['gg_name']; ?></b></td>
	  </tr>
<?php	  
		$recordsGoods = $pdo1->query('SELECT a.fg_code, a.fg_name, a.unit FROM fg a, goodgrp b, WIPd c, WIPH d WHERE a.gg_id=b.gg_id AND c.WIP_id=d.WIP_id AND a.fg_code=c.good_code AND d.Date >= {^'.$pdStart.'} And d.Date <= {^'.$pdEnd.'} AND d.wh_id='.$vKB.' AND b.gg_id='.$grpId.' ORDER by a.fg_name ASC');
	   	$rowsGoods = $recordsGoods->fetchAll(PDO::FETCH_ASSOC);
   		foreach($rowsGoods as $rowGoods){
?>
		   <tr>
			<td align="center"><?php echo $no ;?></td>
			<td align="left"><?php echo $rowGoods['fg_name']; ?></td>
			<td align="left"><?php $goodId=$rowGoods['fg_code']; echo $rowGoods['fg_code']; ?></td>
			<td align="left"><?php echo $rowGoods['unit']; ?></td>
			<td align="right">
<?php 

$cPrevSaldo[$no] = $pdo1->query('SELECT Sum(a.qty) As qty_PSaldo FROM WIPd a, WIPH b WHERE a.WIP_id=b.WIP_id AND b.Date < {^2004.01.01} AND b.wh_id=2 GROUP By a.Good_Code UNION ALL SELECT 0 - SUM(a.qty) As qty_PSaldo FROM BCFGCL a, BCFGINH b WHERE Val(Left(a.parent_id,7))=b.fgin_id AND b.Date < {^2004.01.01} AND b.wh_id=2 GROUP By a.Good_Code');
   $rowscPrevSaldo[$no] = $cPrevSaldo[$no]->fetchAll(PDO::FETCH_ASSOC);
   		if ($rowscPrevSaldo[$no]){
			foreach($rowscPrevSaldo[$no] as $rowcPrevSaldo[$no]){
			  $fieldcPrevSaldo[$no]= $rowcPrevSaldo[$no]['qty_PSaldo'];
			  echo $objAngka->angkaTitik($fieldcPrevSaldo[$no]);
			}	
		} else { 
		  $rowcPrevSaldo[$no]['qty_PSaldo']=0;
		  echo $rowcPrevSaldo[$no]['qty_PSaldo'];
		}
?>			</td>
			<td align="right">
<?php 
$recordscIn[$no] = $pdo1->rawSelect('SELECT Sum(a.qty) As qty_in FROM WIPd a, WIPH b WHERE a.WIP_id=b.WIP_id AND b.Date >= {^'.$pdStart.'} And b.Date <= {^'.$pdEnd.'} AND a.good_code="'.$goodId.'"');
   $rowscIn[$no] = $recordscIn[$no]->fetchAll(PDO::FETCH_ASSOC);
   		if ($rowscIn[$no]){
			foreach($rowscIn[$no] as $rowcIn[$no]){
			  $fieldcIn[$no]= $rowcIn[$no]['qty_in'];
			  echo $objAngka->angkaTitik($fieldcIn[$no]);
			}	
		} else {
			$rowcIn[$no]['qty_in']=0;
			echo $rowcIn[$no]['qty_in'];
		}
?>			</td>
			<td align="right">
<?php 
$Jumlah56=$rowcPrevSaldo[$no]['qty_PSaldo']+$rowcIn[$no]['qty_in']; 
echo $objAngka->angkaTitik($Jumlah56);
?>			</td>
			<td align="right">
<?php 
$recordscOut[$no] = $pdo1->query('SELECT Sum(a.qty) As qty_out FROM BCFGCL a, BCFGINH b WHERE Val(Left(a.parent_id,7))=b.fgin_id AND b.Date >= {^'.$pdStart.'} And b.Date <= {^'.$pdEnd.'} AND a.good_code="'.$goodId.'"');
   $rowsccOut[$no] = $recordscOut[$no]->fetchAll(PDO::FETCH_ASSOC);
 	//var_dump($rowscOut[$no]);
   		if ($rowsccOut[$no]){ 
			foreach($rowscOut[$no] as $rowcOut[$no]){			  
			  $fieldcOut[$no]= $rowcOut[$no]['qty_out'];
			  echo $objAngka->angkaTitik($fieldcOut[$no]);
			}	
		} else { 
		  $rowcOut[$no]['qty_out']=0;
		  echo $rowcOut[$no]['qty_out'];
		}
?>
			</td>
			<td align="right">
<?php 
$persAkhir78=$Jumlah56+$rowcOut[$no]['qty_out']; 
echo $objAngka->angkaTitik($persAkhir78);
?>			</td>
			<td align="center"></td>
		  </tr>
<?php 	 $no=$no+1;
		}		 	
	}
?>		
	</table>
  </td>
</tr>
<tr>
  <td>
    <table align="right">
	  <tr>
	    <td>Kami Bertanggung jawab atas<br>Kebenaran Laporan ini</td>
	  </tr>
	  <tr>
	    <td>Subang, 
<?php 
$classBln = new tanggal(); 
$tanggal=$tglPHP." ".$classBln->bln_indo($blnPHP)." ".$thnPHP; echo $tanggal ;?></td>
	  </tr>
	  <tr>
	    <td height="60">&nbsp;</td>
	  </tr>
	  <tr>
	    <td>EXIM MANAGER</td>
	  </tr>
	</table>
  </td>
</tr>
</table>
</div>
</body>
</html>