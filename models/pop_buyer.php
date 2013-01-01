<?php
require_once "../models/abspath.php";
require_once "pdocon.php";
require_once "function.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="../themes/initialtable.css" type="text/css" media="all">
<title>Lookup</title>
</head>
<body>
<div id="listing"></div>
	<h2>Buyer</h2>
	<table id="TableBrg" class="initiallist">
		<tr>
			<th>ID</th>
            <th>Kode</th>
			<th>Nama</th>
            <th>Status KB</th>
            <th>Area</th>
            <th>&nbsp;</th>
		</tr>
	<?php 		
		$q = "SELECT * FROM tbcustomer ORDER BY Customer_Code";
		$rec = $pdovb->query($q);
		$rs = $rec->fetchAll(PDO::FETCH_ASSOC);		
		foreach ($rs as $r){
	?>
		<tr>	
			<td><?php echo $r['Number'] ?></td>
            <td><?php echo $r['Customer_Code'] ?></td>
            <td><?php echo $r['Customer_Name'] ?></td>
            <td><?php echo $r['KB'] ?></td>
            <td><?php echo $r['Customer_Area'] ?></td>																			
			<td style="text-align:center;"><input border='0' type='image' src="<?php echo $basedir ?>img/expander.gif" onClick="insert_tujuan('<?php echo $r['Number'] ?>','<?php echo trim($r['NPWP']) ?>','<?php echo trim($r['Customer_Name']) ?>','<?php echo mysql_real_escape_string($r['Address']) ?>','<?php echo $r['TPB'] ?>')" /></td>
		</tr>
	<?php }?>
	</table>
</body>
</html>
