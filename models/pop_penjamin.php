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
<h2>Penjamin</h2>
<table class="initiallist">
    <tr>
        <th width="30">No</th>
        <th width="250">Nama</th>
        <th width="50">Pilih</th>
    </tr>
<?php 		
    $q = "SELECT * FROM penjamin ORDER BY NmPenjamin";
    $rec = $pdo->query($q);
    $rs = $rec->fetchAll(PDO::FETCH_ASSOC);		
    foreach ($rs as $r){
?>
    <tr>	
        <td style="text-align:center"><?php echo $r['ID'] ?></td>
        <td><?php echo $r['NmPenjamin'] ?></td>
        <td style="text-align:center;"><input border='0' type='image' src="<?php echo $basedir ?>img/expander.gif" onClick="insert_penjamin('<?php echo $r['NmPenjamin'] ?>')" /></td>
    </tr>
<?php }?>
</table>
</body>
</html>
