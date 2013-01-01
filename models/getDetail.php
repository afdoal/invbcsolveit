<?php 
function getDetBarang($fno_peng){
require "dbInitialize.php";
	$ret = "";
	$sqlDet = "SELECT * FROM bc2_det WHERE no_peng ='".$fno_peng."' AND tipe_bc='1' ORDER BY nodet";
	$rec = $crudMysql->rawSelect($sqlDet);
	$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
	
	foreach ($rs as $r){	
		$ret .="<tr>";
		$ret .="<td style='text-align: center;' width='21px'>".$r['nodet']."</td><td width='323'>".$r['uraian_brng']."</td>";
		$ret .="<td width='120px'>".$r['negara']."</td>";
		$ret .="<td width='87px'>".mysql_real_escape_string($r['tarif'])."</td>";
		$ret .="<td width='111px'>".$r['jml_brng']."</td>";
		$ret .="<td  style='text-align: right;' width='79px'>".number_format($r['nilai_cif'],2)."</td>";
		$ret .="<td width='42px' style='text-align: center;'><img src='img/edit.gif' class='btnedits' border='0' onClick='ubhRowList(".$r['nodet'].")' style='cursor:pointer'> <img src=img/drop.gif class=btnedits border=0 onClick=hpsRowList('list',this) style=cursor:pointer;></td>";
		$ret .="</tr>";
	}	
	return $ret;
}

function getDetBarang2($fno_peng){
require "dbInitialize.php";
	$ret = "";
	$sqlDet = "SELECT * FROM bc2_det WHERE no_peng ='".$fno_peng."' AND tipe_bc='2' ORDER BY nodet";
	$rec = $crudMysql->rawSelect($sqlDet);
	$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
	
	foreach ($rs as $r){	
		$ret .="<tr>";
		$ret .="<td style='text-align: center;' width='21px'>".$r['nodet']."</td><td width='323'>".$r['uraian_brng']."</td>";
		$ret .="<td width='111px'>".$r['jml_brng']."</td>";
		$ret .="<td  style='text-align: right;' width='79px'>".number_format($r['nilai_cif'],2)."</td>";
		$ret .="<td width='42px' style='text-align: center;'><img src='img/edit.gif' class='btnedits' border='0' onClick='ubhRowList(".$r['nodet'].")' style='cursor:pointer'> <img src=img/drop.gif class=btnedits border=0 onClick=hpsRowList('list',this) style=cursor:pointer;></td>";
		$ret .="</tr>";
	}	
	return $ret;
}

function getDetDokPelengkap($fno_peng){
require_once "pdocon.php";
	$ret = "";
	$sqlDet = "SELECT * FROM dok_pelengkap WHERE no_peng ='".$fno_peng."' ORDER BY nourut_dok";
	$rec = $crudMysql->rawSelect($sqlDet);
	$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
	
	foreach ($rs as $r){	
		$ret .="<tr><td style='text-align: center;' width='21px'>".$r['nourut_dok']."</td><td width='298'>".$r['jns_dok']."</td><td width='146px'>".$r['no_dok']."</td><td width='147px'>".$r['tgl_dok']."</td><td width='41px' style='text-align: center;'><img src='img/edit.gif' class='btnedits' border='0' onClick='ubhRowList2(".$r['nourut_dok'].")' style='cursor:pointer'> <img src='img/drop.gif' class='btnedits' border='0' onClick=hpsRowList('list2',this) style='cursor:pointer'></td></tr>";
	}	
	return $ret;
}

function getDetBrngKembali($fno_peng){
require_once "pdocon.php";
	$ret = "";
	$sqlDet = "SELECT * FROM brng_kembali WHERE no_peng ='".$fno_peng."' ORDER BY nourut_brng";
	$rec = $crudMysql->rawSelect($sqlDet);
	$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
	
	foreach ($rs as $r){	
		$ret .="<tr><td style='text-align: center;' width='21px'>".$r['nourut_brng']."</td><td width='360'>".$r['uraian_brng']."</td><td width='161px'>".$r['jml_brng']."</td><td width='120px' style='text-align: right;'>".number_format($r['nilai_cif'])."</td><td width='41px' style='text-align: center;'><img src='img/edit.gif' class='btnedits' border='0' onClick='ubhRowList3(".$r['nourut_brng'].")' style='cursor:pointer'> <img src='img/drop.gif' class='btnedits' border='0' onClick=hpsRowList('list3',this) style='cursor:pointer'></td></tr>";
	}	
	return $ret;
}

function getDetSubKontrak($fno_peng){
require_once "pdocon.php";
	$ret = "";
	$sqlDet = "SELECT * FROM subkon_brngjd WHERE no_peng ='".$fno_peng."' ORDER BY nourut_brngjd";
	$rec = $crudMysql->rawSelect($sqlDet);
	$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
	
	foreach ($rs as $r){	
		$ret .="<tr><td style='text-align: center;' width='21px'>".$r['nourut_brngjd']."</td><td width='350'>".$r['uraian_brngjd']."</td><td width='150px'>".$r['jml_brngjd']."</td><td width='141px'>".$r['satuan']."</td><td width='41px' style='text-align: center;'><img src='img/edit.gif' class='btnedits' border='0' onClick='ubhRowList4(".$r['nourut_brngjd'].")' style='cursor:pointer'> <img src='img/drop.gif' class='btnedits' border='0' onClick=hpsRowList('list4',this) style='cursor:pointer'></td></tr>";
	}	
	return $ret;
}


?>