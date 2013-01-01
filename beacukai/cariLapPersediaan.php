<?php 
require_once "../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
?>
<html>
<head>
<meta name="Author" content="Kikin Kusumah" />
<meta name="Email" content="kikintea@gmail.com" />
<title>Laporan Persediaan Barang dan/atau Jasa</title>
<link href="<?php echo $basedir ?>css/cssBeaCukai.css" rel="stylesheet" type="text/css">
</head>

<body>
<form name="fLapPBJ" action="lap.php" method="post" target="_blank">
<table border="1">
<tr>
  <td width="41">KB</td>
  <td width="103">
  	<select name="fKB">  
<?php

/*** menampilkan record pada tabel ***/
    $records = $pdo1->query('SELECT wh_id, wh_name FROM warehouse ORDER BY wh_Name ASC');

    /*** hanya mengambil nilai array asosiatif ***/
    $rows = $records->fetchAll(PDO::FETCH_ASSOC);

    /*** menampilkan records ***/
    foreach($rows as $row){
?>       	
		<option value="<?php echo $row['wh_id']; ?>"><?php echo $row['wh_name']; ?></option>
<?php
    }   
?> 	  
	</select>  
  </td>
  <td colspan="3" align="center" bgcolor="#408080">Good Group</td>
</tr>
<tr>
  <td>Tahun</td>
  <td>
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
  </td>
  <td colspan="2" rowspan="3" valign="top"><iframe name="lihat" src="materialGroup.php" marginheight="0" marginwidth="0" frameborder="0" height="100%" width="400"></iframe></td>
</tr>
<tr>
  <td colspan="2" align="center" bgcolor="#408080">Laporan</td>  
</tr>
<tr>
  <td colspan="2" valign="top">
   <select name="fRange" size="8">
		<option value="1">TRIWULAN I   (Jan - Mar)</option>
		<option value="2">TRIWULAN II  (Apr - Jun)</option>
		<option value="3">TRIWULAN III (Jul - Sept)</option>
		<option value="4">TRIWULAN IV (Okt - Des)</option>
	</select>
  </td>
</tr>
<tr>
  <td colspan="5"><input type="submit" name="fCari" size="50" /></td>
</tr>
</table>
</form>
</body>
</html>
