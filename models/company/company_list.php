<?php
require_once "../abspath.php";
require_once "pdocon.php";

$TpPrshn=$_REQUEST["TpPrshn"];

$q = "SELECT *,NmPrshn AS NmPrshn0,DATE_FORMAT(TgPokokPpjk,'%d/%m/%Y') AS TgPokokPpjk FROM mst_perusahaan WHERE TpPrshn='$TpPrshn' ORDER BY NmPrshn ASC";
$run=$pdo->query($q);	
$rs=$run->fetchAll(PDO::FETCH_ASSOC);
?>
<table>
<thead>
<tr>
  <th>No.</th>
  <th>Nama</th>
  <th>NPWP</th>
  <th>Alamat</th>
  <th>No. TPB</th>
  <th>Niper</th>
  <th>Contact Person</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
foreach ($rs as $r){
?>
<tr>
  <th><?=$no?></th>
  <th><?=$r['NmPrshn']?></th>
  <th><?=$r['NpwpPrshn']?></th>
  <th><?=$r['AlmtPrshn']." ".$r['Kota'].", ".$r['Provinsi'].", ".$r['Negara']?></th>
  <th><?=$r['NoTpb']?></th>
  <th><?=$r['Niper']?></th>
  <th><?=$r['Cp']?></th>
</tr>
    
<?php
}
?>
</tbody>
</table>