<?php
require_once "../abspath.php";
require_once "pdocon.php";
require_once "function.php";

$req = $_REQUEST["req"];
$mat_type = $_REQUEST["mat_type"];	
$date1 = dmys2ymd($_REQUEST["date1"]);
$date2 = dmys2ymd($_REQUEST["date2"]);

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 25;
$offset = ($page-1)*$rows;
$result = array();

$q = "SELECT KdBarang, NmBarang,HsNo,Sat,
	  (
	  (SELECT IF(SUM(qty)>0,SUM(qty),0) FROM mat_stockcard s WHERE date < '".$date1."' AND s.mat_id = a.KdBarang AND type = 'B')
	  +
	  (SELECT IF(SUM(qty)>0,SUM(qty),0) FROM mat_incdet ia LEFT JOIN mat_inchdr ib ON ib.matin_id=ia.matin_id WHERE matin_date < '".$date1."' AND ia.mat_id = a.KdBarang)
	  -
	  (SELECT IF(SUM(qty)>0,SUM(qty),0) FROM mat_outdet oa LEFT JOIN mat_outhdr ob ON ob.matout_id=oa.matout_id WHERE matout_date < '".$date1."' AND oa.mat_id = a.KdBarang)
	  +
	  (SELECT IF(SUM(qty_in)>0,SUM(qty_in),0) FROM mat_opnamedet oa LEFT JOIN mat_opnamehdr ob ON ob.opname_id=oa.opname_id WHERE opname_date < '".$date1."' AND oa.mat_id = a.KdBarang)
	  -
	  (SELECT IF(SUM(qty_out)>0,SUM(qty_out),0) FROM mat_opnamedet oa LEFT JOIN mat_opnamehdr ob ON ob.opname_id=oa.opname_id WHERE opname_date < '".$date1."' AND oa.mat_id = a.KdBarang)
	  ) AS qty_beg, 
	  
	  (
	  (SELECT IF(SUM(qty)>0,SUM(qty),0) FROM mat_incdet ia LEFT JOIN mat_inchdr ib ON ib.matin_id=ia.matin_id WHERE  ia.mat_id = a.KdBarang AND matin_date BETWEEN '".$date1."' AND '".$date2."')
	  ) AS qty_in,
	  
	  (
	  (SELECT IF(SUM(qty)>0,SUM(qty),0) FROM mat_outdet oa LEFT JOIN mat_outhdr ob ON ob.matout_id=oa.matout_id WHERE oa.mat_id = a.KdBarang AND matout_date BETWEEN '".$date1."' AND '".$date2."')
	  ) AS qty_out,
	  
	  (
	  (SELECT IF(SUM(qty_in)>0,SUM(qty_in),0) FROM mat_opnamedet oa LEFT JOIN mat_opnamehdr ob ON ob.opname_id=oa.opname_id WHERE oa.mat_id = a.KdBarang AND opname_date BETWEEN '".$date1."' AND '".$date2."')
	  +
	  (SELECT IF(SUM(qty_out)>0,SUM(qty_out),0) FROM mat_opnamedet oa LEFT JOIN mat_opnamehdr ob ON ob.opname_id=oa.opname_id WHERE oa.mat_id = a.KdBarang AND opname_date BETWEEN '".$date1."' AND '".$date2."')
	  ) AS qty_bal,
	  
	  (
	  (SELECT IF(SUM(qty)>0,SUM(qty),0) FROM mat_opnamedet oa LEFT JOIN mat_opnamehdr ob ON ob.opname_id=oa.opname_id WHERE oa.mat_id = a.KdBarang AND opname_date BETWEEN '".$date1."' AND '".$date2."')
	  ) AS qty, 0 AS qty_end, FORMAT(0,2) AS qty_diff
	   ";
$q .= "FROM mst_barang a 
	  WHERE a.TpBarang='$mat_type' 
	  ORDER BY KdBarang ASC";
	  
$runtot=$pdo->query($q);
$rstot=$runtot->fetchAll(PDO::FETCH_ASSOC);

$q .= " LIMIT $offset,$rows";
$run=$pdo->query($q);
$rs=$run->fetchAll(PDO::FETCH_ASSOC);

$result["total"] = count($rstot);
$result["rows"] = $rs;

echo json_encode($result);
?>