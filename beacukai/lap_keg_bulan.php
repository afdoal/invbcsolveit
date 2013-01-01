<?php
require_once "../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "class_tgl.php" ;
$objAngka = new classAkunting();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
	<meta name="Author" content="Kikin Kusumah" />
	<link href="<?php echo $basedir ?>css/cssBeaCukai.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="950">
<tr>
  <td>
    <form name="fLapKegBln" method="post" action="#" target="basefrm">
    <table width="300" border="1" align="left">
	  <tr>
	    <td width="0" bgcolor="#EBEBEB"></td>
	    <td width="290">&nbsp;
		  Periode :
		  <select name = "fBulan">
<?php 
	$blnPHP=date("m");	
	$classBln = new tanggal();		  
?>
<option value =<?php echo "$blnPHP"; ?>><?php echo $classBln->bln_indo($blnPHP); ?></option>        
<?php
$blnArray= array ("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
$bulanArray= array (Januari, Februari, Maret, April, Mei, Juni, Juli, Agustus, September,
Oktober, November, Desember);
for ($i=0; $i<12;$i++){

?>
          <option value =<?php echo "$blnArray[$i]"; ?>>
          <?php 
	echo "$bulanArray[$i]"; 
  ?>
          </option>
          <?php
}
?>
        </select>
		
		  <select name = "fTahun">
	   
	   		<option value =<?php $thnPHP=date("Y"); echo "$thnPHP" ?>> <?php echo "$thnPHP"; ?></option>
<?php
$thnPHPStart=$thnPHP-10;
$thnPHPEnd=$thnPHP+10;		  
for ($i=$thnPHPStart; $i<$thnPHPEnd;$i++){

?>
          <option value =<?php echo "$i" ?>> <?php echo "$i"; ?></option>
          <?php
}
?>
          </select>
		  <input type="submit" name="fLihat" value="Lihat">
		  </td>		  
	  </tr>
	</table>
	</form>
  </td>
</tr>
<tr>
  <td align="center"><table align="left">
	  <tr>
	    <td>DEPARTEMEN KEUANGAN REPUBLIK INDONESIA</td>
	  </tr>
	  <tr>
	    <td>DIREKTORAT JENDERAL BEA CUKAI</td>
	  </tr>
	  <tr>
	    <td>KANTOR WILAYAH V BANDUNG</td>
	  </tr>
	  <tr>
	    <td>KANTOR PELAYANAN TIPE A BEKASI</td>
	  </tr>
	</table>
  </td>	
</tr>
<tr>
  <td align="left">  
  
<?php
if (!isset($_POST['fLihat'])){
$periodPHP=date("Y.m.");
$vPeriodStart=$periodPHP."01";

$classBlnEnd = new tanggal();
$vPeriodEnd=$periodPHP.$classBlnEnd->GetLastDayofMonth($thnPHP, $blnPHP);

?>  
<div align="center">
	<b>REKAPITULASI<br>
	LAPORAN KEGIATAN BULANAN KB<br>
	BULAN <?php echo strtoupper($classBln->bln_indo($blnPHP))." ".$thnPHP ; ?></b><hr size="3" style="border-bottom-style:double;" />
</div>
<div align="left">
	<table width="950" border="1" align="left">
	<tr>
	    <td width="26" rowspan="4" align="center"><strong>NO</strong></td>
		<td width="136" rowspan="4" align="center"><strong>NAMA PDKB</strong></td>
		<td colspan="14" align="center"><strong>JUMLAH DOKUMEN (LEMBAR)</strong></td>
		<td colspan="2" width="150" align="center" ><strong>NILAI DEVISA (US$)</strong></td>
		<td colspan="2" width="150" align="center" ><strong>TONAGE (KG)</strong></td>
	  </tr>	
	  <tr>
		<td colspan="7" align="center"><strong>PEMASUKAN</strong></td>
		<td colspan="7" align="center"><strong>PENGELUARAN</strong></td>
		<td width="75" rowspan="3" align="center"><strong>IMPOR</strong></td>
		<td width="75" rowspan="3" align="center"><strong>EKSPOR</strong></td>
		<td width="75" rowspan="3" align="center"><strong>IMPOR</strong></td>
		<td width="75" rowspan="3" align="center"><strong>EKSPOR</strong></td>
	  </tr>	
	  <tr>
	    <td colspan="5" align="center"><strong>BC-2.3</strong></td>
	    <td colspan="2" align="center"><strong>BC4.0</strong></td>
	    <td colspan="2" align="center"><strong>PEB/PEBT</strong></td>
	    <td colspan="3" align="center"><strong>BC-2.3</strong></td>
	    <td width="21" align="center"><strong>PIB</strong></td>
	    <td width="45" align="center"><strong>BC-4.0</strong></td>
	  </tr> 
	  <tr>
	    <td width="21" align="center"><strong>1</strong></td>
	    <td width="21" align="center"><strong>2</strong></td>
	    <td width="21" align="center"><strong>3</strong></td>
	    <td width="21" align="center"><strong>4</strong></td>
	    <td width="21" align="center"><strong>5</strong></td>
	    <td width="21" align="center"><strong>6</strong></td>
	    <td width="21" align="center"><strong>7</strong></td>
	    <td width="34" align="center"><strong>8</strong></td>
	    <td width="22" align="center"><strong>9</strong></td>
		<td width="21" align="center"><strong>10</strong></td>
		<td width="21" align="center"><strong>11</strong></td>
	    <td width="21" align="center"><strong>12</strong></td>
	    <td width="21" align="center"><strong>13</strong></td>
		<td width="45" align="center"><strong>14</strong></td>
	  </tr> 
	   <tr>
	    <td align="center"></td>
	    <td align="center">PT. Derma International</td>
	    <td align="center">
<?php 
$bc231 = $crudMysql->rawSelect('SELECT COUNT(no_peng) As bc231 FROM bc2 a WHERE tipe_bc=31 AND matoutdo = "do" AND a.tgl_pend >= "'.$vPeriodStart.'" AND a.tgl_pend <= "'.$vPeriodEnd.'"');
   $rowsbc231 = $bc231->fetchAll(PDO::FETCH_ASSOC);
   		if ($rowsbc231){
			foreach($rowsbc231 as $rowbc231){
			  $fieldbc231= $rowbc231['bc231'];
			  echo $objAngka->angkaTitik($fieldbc231);
			}	
		} else {
			$rowbc231['bc231']=0;
			echo $rowbc231['bc231'];
		}
?>		
		</td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
		<td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center">
<?php 

$nil_pabean = $crudMysql->rawSelect('SELECT total AS nil_pabean FROM bc2 a WHERE tipe_bc=31 AND matoutdo = "do" AND a.tgl_pend >= "'.$vPeriodStart.'" AND a.tgl_pend <= "'.$vPeriodEnd.'"');
   $rowsnil_pabean = $nil_pabean->fetchAll(PDO::FETCH_ASSOC);
   		if ($rowsnil_pabean){
			foreach($rowsnil_pabean as $rownil_pabean){
			  $fieldnil_pabean= $rownil_pabean['nil_pabean'];
			  echo $objAngka->angkaTitik($fieldnil_pabean);
			}	
		} else {
			$rownil_pabean['nil_pabean']=0;
			echo $rownil_pabean['nil_pabean'];
		}
?>		
		</td>
		<td align="center"></td>
		<td align="center">
<?php 

$net_w = $crudMysql->rawSelect('SELECT berat_kotor AS net_w FROM bc2 a WHERE tipe_bc=31 AND matoutdo = "do" AND a.tgl_pend >= "'.$vPeriodStart.'" AND a.tgl_pend <= "'.$vPeriodEnd.'"');
   $net_w = $net_w->fetchAll(PDO::FETCH_ASSOC);
   		if ($rowsnet_w){
			foreach($rowsnet_w as $rownet_w){
			  $fieldnet_w= $rownet_w['net_w'];
			  echo $objAngka->angkaTitik($fieldnet_w);
			}	
		} else {
			$rownet_w['net_w']=0;
			echo $rownet_w['net_w'];
		}
?>				
		</td>
		<td align="center">&nbsp;</td>
	  </tr>
	</table>
</div><br>	
<?php
}//penutup !isset
else
{
$vBulan=$_POST['fBulan'];
$vTahun=$_POST['fTahun'];
$vPeriodStart=$vTahun.".".$vBulan.".01";

$classBlnEnd = new tanggal();
$vPeriodEnd=$vTahun.".".$vBulan.".".$classBlnEnd->GetLastDayofMonth($vTahun, $vBulan);
 
?>	  	<div align="center"><b>REKAPITULASI<br>
	LAPORAN KEGIATAN BULANAN KB<br>
	BULAN <?php echo strtoupper($classBln->bln_indo($vBulan))." ".$vTahun ; ?></b><hr size="3" style="border-bottom-style:double;" /></div>
<div align="left">
	<table width="950" border="1" align="left">
	<tr>
	    <td width="26" rowspan="4" align="center"><strong>NO</strong></td>
		<td width="136" rowspan="4" align="center"><strong>NAMA PDKB</strong></td>
		<td colspan="14" align="center"><strong>JUMLAH DOKUMEN (LEMBAR)</strong></td>
		<td colspan="2" width="150" align="center" ><strong>NILAI DEVISA (US$)</strong></td>
		<td colspan="2" width="150" align="center" ><strong>TONAGE (KG)</strong></td>
	  </tr>	
	  <tr>
		<td colspan="7" align="center"><strong>PEMASUKAN</strong></td>
		<td colspan="7" align="center"><strong>PENGELUARAN</strong></td>
		<td width="75" rowspan="3" align="center"><strong>IMPOR</strong></td>
		<td width="75" rowspan="3" align="center"><strong>EKSPOR</strong></td>
		<td width="75" rowspan="3" align="center"><strong>IMPOR</strong></td>
		<td width="75" rowspan="3" align="center"><strong>EKSPOR</strong></td>
	  </tr>	
	  <tr>
	    <td colspan="5" align="center"><strong>BC-2.3</strong></td>
	    <td colspan="2" align="center"><strong>BC4.0</strong></td>
	    <td colspan="2" align="center"><strong>PEB/PEBT</strong></td>
	    <td colspan="3" align="center"><strong>BC-2.3</strong></td>
	    <td width="21" align="center"><strong>PIB</strong></td>
	    <td width="46" align="center"><strong>BC-4.0</strong></td>
	  </tr> 
	  <tr>
	    <td width="21" align="center"><strong>1</strong></td>
	    <td width="21" align="center"><strong>2</strong></td>
	    <td width="21" align="center"><strong>3</strong></td>
	    <td width="21" align="center"><strong>4</strong></td>
	    <td width="21" align="center"><strong>5</strong></td>
	    <td width="21" align="center"><strong>6</strong></td>
	    <td width="21" align="center"><strong>7</strong></td>
	    <td width="34" align="center"><strong>8</strong></td>
	    <td width="22" align="center"><strong>9</strong></td>
		<td width="21" align="center"><strong>10</strong></td>
		<td width="21" align="center"><strong>11</strong></td>
	    <td width="21" align="center"><strong>12</strong></td>
	    <td width="21" align="center"><strong>13</strong></td>
		<td width="45" align="center"><strong>14</strong></td>
	  </tr> 
	   <tr>
	    <td align="center"></td>
	    <td align="center">PT. Derma International</td>
	    <td align="center">
<?php 

$bc231 = $crudMysql->rawSelect('SELECT COUNT(no_peng) As bc231 FROM bc2 a WHERE tipe_bc=31 AND matoutdo = "do" AND a.tgl_pend >= "'.$vPeriodStart.'" AND a.tgl_pend <= "'.$vPeriodEnd.'"');
   $rowsbc231 = $bc231->fetchAll(PDO::FETCH_ASSOC);
   		if ($rowsbc231){
			foreach($rowsbc231 as $rowbc231){
			  $fieldbc231= $rowbc231['bc231'];
			  echo $objAngka->angkaTitik($fieldbc231);
			}	
		} else {
			$rowbc231['bc231']=0;
			echo $rowbc231['bc231'];
		}
?>		
		</td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
		<td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center"></td>
	    <td align="center">
<?php 

$nil_pabean = $crudMysql->rawSelect('SELECT total AS nil_pabean FROM bc2 a WHERE tipe_bc=31 AND matoutdo = "do" AND a.tgl_pend >= "'.$vPeriodStart.'" AND a.tgl_pend <= "'.$vPeriodEnd.'"');
   $rowsnil_pabean = $nil_pabean->fetchAll(PDO::FETCH_ASSOC);
   		if ($rowsnil_pabean){
			foreach($rowsnil_pabean as $rownil_pabean){
			  $fieldnil_pabean= $rownil_pabean['nil_pabean'];
			  echo $objAngka->angkaTitik($fieldnil_pabean);
			}	
		} else {
			$rownil_pabean['nil_pabean']=0;
			echo $rownil_pabean['nil_pabean'];
		}
?>		
		</td>
		<td align="center"></td>
		<td align="center">
<?php 

$net_w = $crudMysql->rawSelect('SELECT berat_kotor AS net_w FROM bc2 a WHERE tipe_bc=31 AND matoutdo = "do" AND a.tgl_pend >= "'.$vPeriodStart.'" AND a.tgl_pend <= "'.$vPeriodEnd.'"');
   $net_w = $net_w->fetchAll(PDO::FETCH_ASSOC);
   		if ($rowsnet_w){
			foreach($rowsnet_w as $rownet_w){
			  $fieldnet_w= $rownet_w['net_w'];
			  echo $objAngka->angkaTitik($fieldnet_w);
			}	
		} else {
			$rownet_w['net_w']=0;
			echo $rownet_w['net_w'];
		}
?>				
		</td>
		<td align="center">&nbsp;</td>
	  </tr>
	</table>
</div>	
<?php
} //penutup else !isset
?>	
  </td>
</tr>
<tr>
  <td>
    <table align="left">
	  <tr>
	    <td>Keterangan 
		<ol type="1">
			<li>Pemasukan dari Tempat Penimbunan Sementara</li>
			<li>Pemasukan dari Gudang Berikat</li>
			<li>Pemasukan dari PDKB lain</li>
			<li>Pemasukan dari Subkontrak</li>
			<li>Pemasukan kembali setelah diperbaiki/ dipinjamkan/ dipamerkan</li>
			<li>Pemasukan dari Bapeksta</li>
			<li>Pemasukan dari DPIL</li>
		</ol>
		</td>
		<td>
		<ol type="1" start="8">
			<li>Ekspor</li>
			<li>Ekspor Kembali</li>
			<li>Pengeluaran ke PDKB lain</li>
			<li>Pengeluaran dalam rangka Subkontrak</li>
			<li>Pengeluaran kembali setelah diperbaiki/ dipinjamkan/ dipamerkan</li>
			<li>Pengeluaran ke DPIL</li>
			<li>Pemasukan kembali karena salah kirim</li>
		</ol>
		</td>
	  </tr>
	</table>
  </td>
</tr>
</table>
</body>
</html>
