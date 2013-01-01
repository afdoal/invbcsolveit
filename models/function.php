<?php
require_once "abspath.php";
require_once "pdocon.php";
require_once "class_tgl.php";

function getField($NmTabel,$NmKolom1,$NmKolom2,$field){
	require "pdocon.php";
	$q = "SELECT $NmKolom1 FROM $NmTabel WHERE $NmKolom2='$field'";
	$run=$pdo->query($q);	
	$rs=$run->fetchAll(PDO::FETCH_ASSOC);
	return $rs[0][$NmKolom1];
}

function bulanInd(){
	$bulan = array ('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus', 'September','Oktober','November','Desember'); 
	return $bulan;
}

function bulanEng(){
	$bulan = array ('January','February','March','April','May','June','July','August', 'September','October','November','December'); 
	return $bulan;
}

function GetNameTpPeriod($tp) {	
		switch($tp) {
			case '1': $name="S/D PERIODE"; break;
			case '2': $name="Triwulan"; break;
			case '3': $name="Semesteran"; break;
			case '4': $name="Tahunan"; break;
		}
		return $name;
}

function GetNameTpPeriodEng($tp) {	
		switch($tp) {
			case '1': $name="AS OF PERIOD"; break;
			case '2': $name="Quarterly"; break;
			case '3': $name="Semester"; break;
			case '4': $name="Yearly"; break;
		}
		return $name;
}

function GetNameMonth($sDate) {
	
	if(!empty($sDate)) {
		switch($sDate) {
			case '01': $monthName="Januari"; break;
			case '02': $monthName="Febuari"; break;
			case '03': $monthName="Maret"; break;
			case '04': $monthName="April"; break;
			case '05': $monthName="Mei"; break;
			case '06': $monthName="Juni"; break;
			case '07': $monthName="Juli"; break;
			case '08': $monthName="Agustus"; break;
			case '09': $monthName="September"; break;
			case '10': $monthName="Oktober"; break;
			case '11': $monthName="Nopember"; break;
			case '12': $monthName="Desember"; break;
		}
		return $monthName;
	} else {
		return false;	
	}

}

function NumberFormat($nNumber){
	$format_number = number_format($nNumber, 0, '.', ',');
	return $format_number;
}

function nformat($nNumber,$dec){
	$format_number = number_format($nNumber, $dec, ',', '.');
	return $format_number;
}

function nformatr($nNumber){
	$format_number = str_replace(",",".",str_replace(".","",$nNumber));
	return $format_number;
}

function GetDay($tanggal) {

		list($d,$m,$y) = explode("/",$tanggal);
		
		$tanggal = $y.'-'.$m.'-'.$d;
		$sqlDay = "SELECT DATEDIFF('$tanggal', CURDATE()) AS selisih";
		$hasil = mysql_query($sqlDay);
		$data  = mysql_fetch_array($hasil);
		$selisih = $data['selisih'];
		$x  = mktime(0, 0, 0, date("m"), date("d")+$selisih, date("Y"));
		$cDay = date("l", $x);
		return $cDay;
		
}

function GetDayCode($tanggal) {

		list($d,$m,$y) = explode("/",$tanggal);
		
		$tanggal = $y.'-'.$m.'-'.$d;
		$sqlDay = "SELECT DATEDIFF('$tanggal', CURDATE()) AS selisih";
		$hasil = mysql_query($sqlDay);
		$data  = mysql_fetch_array($hasil);
		$selisih = $data['selisih'];
		$x  = mktime(0, 0, 0, date("m"), date("d")+$selisih, date("Y"));
		$cDay = date("w", $x);
		return $cDay;
		
}

function GetNameDay($hari) {
	
		switch($hari) {
			case "Monday": $dayName="Senin"; break;
			case "Tuesday": $dayName="Selasa"; break;
			case "Wednesday": $dayName="Rabu"; break;
			case "Thursday": $dayName="Kamis"; break;
			case "Friday": $dayName="Jumat"; break;
			case "Saturday": $dayName="Sabtu"; break;
			case "Sunday": $dayName="Minggu"; break;
		}
		return $dayName;
}

function kategori($cat){
	require "dbInitialize.php";
	$sql = "SELECT fgcat_name FROM mkt_fgcat WHERE fgcat_id='$cat' LIMIT 1";
	$rec = $crud->rawSelect($sql);
	$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
	return $rs[0]['fgcat_name'];
}

function getWarehouse($id){
	require "pdocon.php";
	$sql = "SELECT wh_name FROM tbwarehouse WHERE wh_code='$id'";
	$rec = $pdovb->query($sql);
	$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
	return $rs[0]['wh_name'];	
}

function getKantor($id){
	require "pdocon.php";
	$q = "SELECT UrKdKpbc FROM kantor WHERE KdKpbc='$id'";
	$rec = $pdo->query($q);
	$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
	return $rs[0]['UrKdKpbc'];	
}

function getJnsTpb($id){
	require "pdocon.php";
	$q = "SELECT UrJnsTpb FROM jenis_tpb WHERE KdJnsTpb='$id'";
	$rec = $pdo->query($q);
	$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
	return $rs[0]['UrJnsTpb'];	
}

function getTujKirim($id){
	if ($id!= 0){
		require "pdocon.php";
		$q = "SELECT * FROM tujuan_pengiriman WHERE KdTp='$id'";
		$rec = $pdo->query($q);
		$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
		return $rs[0]['UrTp'];	
	}
}

function getDokPelengkap($bc,$car,$jnsdok,$pil){
	require "pdocon.php";
	$q = "SELECT *,DATE_FORMAT(DokTg, '%d-%m-%Y') AS tgl_dmy FROM dokumen d INNER JOIN kode_jenis_dok kjd ON kjd.KdKdJnsDok=d.DokKd WHERE DokKdBc='$bc' AND CAR ='$car' AND DokKd='$jnsdok' LIMIT 1";
	$rec = $pdo->query($q);
	$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
	//return $q; 
	if ($pil==1){
		return $rs[0]['DokNo'];	
	} else {
		return $rs[0]['tgl_dmy'];	
	}
}

function getDokPelengkapAll($bc,$car,$jnsdok,$pil){
	require "pdocon.php";
	$q = "SELECT *,DATE_FORMAT(DokTg, '%d-%b-%y') AS tgl_dmy FROM dokumen d INNER JOIN kode_jenis_dok kjd ON kjd.KdKdJnsDok=d.DokKd WHERE DokKdBc='$bc' AND CAR ='$car' AND DokKd='$jnsdok'";
	$rec = $pdo->query($q);
	$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
	$j=(count($rs)>4)?4:count($rs);
	//return $q; 
	$str = "";
	for ($i=0;$i<$j;$i++){
		if ($pil==1){
			$str .= $rs[$i]['DokNo'];			
		} else {
			$str .= "Tgl. ".$rs[$i]['tgl_dmy'];	
		}
		if ($i<3){ $str .= "<br>"; };	
	}
	
	return $str;
}

function getValuta($id){
	require "pdocon.php";
	$q = "SELECT * FROM valuta WHERE KdVal='$id'";
	$rec = $pdo->query($q);
	$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
	return $rs[0]['UrVal'];	
}

function getUrJnsDok($id){
	require "pdocon.php";
	$q = "SELECT * FROM  jenis_dok WHERE KdJnsDok='$id' LIMIT 1";
	$rec = $pdo->query($q);
	$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
	//return $q; 
	return $rs[0]['UrJnsDok'];	
	
}

function getUrKdJnsDok($id){
	require "pdocon.php";
	$q = "SELECT * FROM  kode_jenis_dok WHERE KdKdJnsDok='$id' LIMIT 1";
	$rec = $pdo->query($q);
	$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
	//return $q; 
	return $rs[0]['UrKdJnsDok'];	
	
}

function getKemasan($id){
	require "pdocon.php";
	$q = "SELECT * FROM kemasan WHERE KdKemas='$id' LIMIT 1";
	$rec = $pdo->query($q);
	$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
	//return $q; 
	return $rs[0]['UrKemas'];	
	
}

function formatAngka($angka){
	if($angka<0){
		//tanpa "$nbsp;", tanda kurung buka&tutup tdk muncul dan akan muncul tanda - (minus)
		$AfterFormat=sprintf("(%10s)",   number_format(($angka*-1),2));
		//$AfterFormat=number_format($angka,2);

	}
	else{	
		$AfterFormat=number_format($angka,2);
	}		
	return $AfterFormat;
}
//----------------------FUNGSI-FUNGSI UNTUK AKUNTING---------------------------------------

function dmyToUnixtime($ddmmyy) {
    list($tanggal, $jam) = explode(" ",$ddmmyy);
	list($thn,$bln,$tgl) = explode("-",$tanggal);
    return mktime(0, 0, 0, $bln, $tgl, $thn);
}

function dmyToUnixtime2($ddmmyy) {
    list($tgl,$bln,$thn) = explode("/",$ddmmyy);
    return mktime(0, 0, 0, $bln, $tgl, $thn);
}

function firstdmyOfTheYearToUnixtime($ddmmyy) {
    list($tanggal, $jam) = explode(" ",$ddmmyy);
	list($thn,$bln,$tgl) = explode("-",$tanggal);
    return mktime(0, 0, 0, 1, 1, $thn);
}

function dmyToUnixtimeEndLastMonth($ddmmyy) {
    list($tanggal, $jam) = explode(" ",$ddmmyy);
	list($thn,$bln,$tgl) = explode("-",$tanggal);
    return mktime(23, 59, 59, $bln, 0, $thn);
}

function dmyToUnixtimeEndLastMonth2($ddmmyy) {
	list($thn,$bln,$tgl) = explode("-",$ddmmyy);
    return mktime(23, 59, 59, $bln, 0, $thn);
}

function dmyToUnixtimeEnd($ddmmyy) {
    list($tanggal, $jam) = explode(" ",$ddmmyy);
	list($thn,$bln,$tgl) = explode("-",$tanggal);
    return mktime(23, 59, 59, $bln, $tgl, $thn);
}

function dmyToUnixtimeEnd2($ddmmyy) {
    list($tgl,$bln,$thn) = explode("/",$ddmmyy);
    return mktime(23, 59, 59, $bln, $tgl, $thn);
}

function GetLastDayofMonth($year, $month){
	for ($day=31; $day>=28; $day--){
		if (checkdate($month, $day, $year)){
			return $day;
		}
	}    
}	

function dmys2ymd($date){
	if ($date!=""){
		list($day, $month, $year) = explode('/', $date);		
		return $year."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".str_pad($day, 2, "0", STR_PAD_LEFT);
	} else {
		return "0000-00-00";
	}
}

function dmy_st2dmy_sl($date){
	return str_replace('-','/',$date);
}

function dmy_sl2dmy_st($date){
	return str_replace('-','/',$date);
}

function ymd2dmy($date){
	list($year, $month, $day) = explode('-', $date);	
	return $day . "/" . $month . "/" . $year;
}

function ymd2dmy_st($date){
	list($year, $month, $day) = explode('-', $date);	
	return $day . "-" . $month . "-" . $year;
}

function ymd2dmy3($date){
	list($year, $month, $day) = explode('-', $date);	
	return $day . " " . GetNameMonth($month) . " " . $year;
}

function formatPrice($num, $curr){
	if (strtoupper($curr)=='USD'){
		return number_format($num,3);
	} else {
		return number_format($num,0);
	}
}

function type($id){
	if($id == "P"){
		$ret = "Produksi";
	}elseif($id == "T"){
		$ret = "Transfer";	
	}else{
		$ret = "General";		
	}	
	return $ret;
}

function ucwords2($str){
	return ucwords(strtolower($str));
}

function lessthan0($dec){
	$result = ($dec<0)?0:$dec;
	return $result;
} 

function akun_induk(){
	global $crud;
	
	$sql="SELECT DISTINCT SUBSTR(acctnum,1,4) AS acctnum FROM accaccounts WHERE LENGTH(acctnum)>4";
	$rec=$crud->rawSelect($sql);
	$rs=$rec->fetchAll(PDO::FETCH_ASSOC);
	$acctnum="";
	$pemisah=",";	
	if ($rs){
		foreach ($rs as $r){
			$acctnum .= $r['acctnum'].$pemisah;
		}
		$acctnum = substr($acctnum,0,-1);
	} 
	
	return $acctnum;
}

function cek_akun_induk($acctnum){
	global $crud;
	
	$sql="SELECT DISTINCT SUBSTR(acctnum,1,4) AS acctnum FROM accaccounts WHERE LENGTH(acctnum)>4";
	$rec=$crud->rawSelect($sql);
	$rs=$rec->fetchAll(PDO::FETCH_ASSOC);
	$bool = false;
	if ($rs){
		foreach ($rs as $r){
			if ($acctnum == $r['acctnum']){
				$bool = true;
				break;		
			}
		}
	} 
	
	return $bool;
}

function out_type($type) { 
 if($type=="P"){
	return 'Purchase';
 } else if($type=="T")	{
		return 'Transfer';
 } else if ($type == "R") {
		return 'Retur PO';
  } else { return 'Outside'; }
}

function sup_type($type) { 
 if ($type=="I"){
	return 'Import';
 } else if($type=="L")	{
	return 'Local';
 } else { 
 	return $type; }
}

function save_image($inPath,$outPath){ //Download images from remote server
    $in=    fopen($inPath, "rb");
    //$out=   fopen($outPath, "wb");
    while ($chunk = fread($in,8192)){
        fwrite($out, $chunk, 8192);
    }
    fclose($in);
    fclose($out);
}

function sl2html($str){
	return nl2br(str_replace(" ", "&nbsp;", $str));
}

function ctword($x) {
$x = abs($x);
$number = array("", "satu", "dua", "tiga", "empat", "lima",
"enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
$temp = "";

if ($x <12) {
$temp = " ". $number[$x];
} else if ($x <20) {
$temp = ctword($x - 10). " belas";
} else if ($x <100) {
$temp = ctword($x/10)." puluh". ctword($x % 10);
} else if ($x <200) {
$temp = " seratus" . ctword($x - 100);
} else if ($x <1000) {
$temp = ctword($x/100) . " ratus" . ctword($x % 100);
} else if ($x <2000) {
$temp = " seribu" . ctword($x - 1000);
} else if ($x <1000000) {
$temp = ctword($x/1000) . " ribu" . ctword($x % 1000);
} else if ($x <1000000000) {
$temp = ctword($x/1000000) . " juta" . ctword($x % 1000000);
} else if ($x <1000000000000) {
$temp = ctword($x/1000000000) . " milyar" . ctword(fmod($x,1000000000));
} else if ($x <1000000000000000) {
$temp = ctword($x/1000000000000) . " trilyun" . ctword(fmod($x,1000000000000));
}
return $temp;
}

function terbilang($x,$style=4,$strcomma=",") {
if($x<0) {
$result = "minus ". trim(ctword($x));
} else {
$arrnum=explode("$strcomma",$x);
$arrcount=count($arrnum);
if ($arrcount==1){
$result = trim(ctword($x));
}else if ($arrcount>1){
$result = trim(ctword($arrnum[0])) . " koma " . trim(ctword($arrnum[1]));
}
}
switch ($style) {
case 1: //1=uppercase  dan
$result = strtoupper($result);
break;
case 2: //2= lowercase
$result = strtolower($result);
break;
case 3: //3= uppercase on first letter for each word
$result = ucwords($result);
break;
default: //4= uppercase on first letter
$result = ucfirst($result);
break;
}
return $result;
}
/*
<form  method="post">
Masukkan Angka <input name="input" type="text" id="input" value="<? //=$_POST['input']?>"/>
<input name="Show" type="submit" id="Show" value="Show" />
</form> !-->

if (isset($_POST['Show']))
{
$input = trim($_POST['input']);

$hasil = terbilang($input,$style=4,$strcomma=",");
echo "Terbilang : ". $hasil;
}
*/ 
//By    : Xhanch Studio
//URL   : http://xhanch.com/
function get_num_name($num){ 
switch($num){ 
case 1:return 'one'; 
case 2:return 'two'; 
case 3:return 'three'; 
case 4:return 'four'; 
case 5:return 'five'; 
case 6:return 'six'; 
case 7:return 'seven'; 
case 8:return 'eight'; 
case 9:return 'nine'; 
        } 
    }
    
function num_to_words($number, $real_name, $decimal_digit, $decimal_name){ 
$res = ''; 
$real = 0; 
$decimal = 0; 
if($number == 0) 
return 'Zero'.(($real_name == '')?'':' '.$real_name); 
if($number >= 0){ 
$real = floor($number); 
$decimal = number_format($number - $real, $decimal_digit, '.', ','); 
        }else{ 
$real = ceil($number) * (-1); 
$number = abs($number); 
$decimal = number_format($number - $real, $decimal_digit, '.', ','); 
        } 
$decimal = substr($decimal, strpos($decimal, '.') +1); 
$unit_name[1] = 'thousand'; 
$unit_name[2] = 'million'; 
$unit_name[3] = 'billion'; 
$unit_name[4] = 'trillion'; 
$packet = array();   
$number = strrev($real); 
$packet = str_split($number,3); 
for($i=0;$i<count($packet);$i++){ 
$tmp = strrev($packet[$i]); 
$unit = $unit_name[$i]; 
if((int)$tmp == 0) 
continue; 
$tmp_res = ''; 
if(strlen($tmp) >= 2){ 
$tmp_proc = substr($tmp,-2); 
switch($tmp_proc){ 
case '10': 
$tmp_res = 'ten'; 
break; 
case '11': 
$tmp_res = 'eleven'; 
break; 
case '12': 
$tmp_res = 'twelve'; 
break; 
case '13': 
$tmp_res = 'thirteen'; 
break; 
case '15': 
$tmp_res = 'fifteen'; 
break; 
case '20': 
$tmp_res = 'twenty'; 
break; 
case '30': 
$tmp_res = 'thirty'; 
break; 
case '40': 
$tmp_res = 'forty'; 
break; 
case '50': 
$tmp_res = 'fifty'; 
break; 
case '70': 
$tmp_res = 'seventy'; 
break; 
case '80': 
$tmp_res = 'eighty'; 
break; 
default: 
$tmp_begin = substr($tmp_proc,0,1); 
$tmp_end = substr($tmp_proc,1,1); 
if($tmp_begin == '1') 
$tmp_res = get_num_name($tmp_end).'teen'; 
elseif($tmp_begin == '0') 
$tmp_res = get_num_name($tmp_end); 
elseif($tmp_end == '0') 
$tmp_res = get_num_name($tmp_begin).'ty'; 
else{ 
if($tmp_begin == '2') 
$tmp_res = 'twenty'; 
elseif($tmp_begin == '3') 
$tmp_res = 'thirty'; 
elseif($tmp_begin == '4') 
$tmp_res = 'forty'; 
elseif($tmp_begin == '5') 
$tmp_res = 'fifty'; 
elseif($tmp_begin == '6') 
$tmp_res = 'sixty'; 
elseif($tmp_begin == '7') 
$tmp_res = 'seventy'; 
elseif($tmp_begin == '8') 
$tmp_res = 'eighty'; 
elseif($tmp_begin == '9') 
$tmp_res = 'ninety'; 
$tmp_res = $tmp_res.' '.get_num_name($tmp_end); 
                        } 
break; 
                } 
if(strlen($tmp) == 3){ 
$tmp_begin = substr($tmp,0,1); 
$space = ''; 
if(substr($tmp_res,0,1) != ' ' && $tmp_res != '') 
$space = ' '; 
if($tmp_begin != 0){ 
if($tmp_begin != '0'){ 
if($tmp_res != '') 
$tmp_res = 'and'.$space.$tmp_res; 
                        } 
$tmp_res = get_num_name($tmp_begin).' hundred'.$space.$tmp_res; 
                    } 
                } 
            }else
$tmp_res = get_num_name($tmp); 
$space = ''; 
if(substr($res,0,1) != ' ' && $res != '') 
$space = ' '; 
$res = $tmp_res.' '.$unit.$space.$res; 
        } 
$space = ''; 
if(substr($res,-1) != ' ' && $res != '') 
$space = ' '; 
if($res) 
$res .= $space.$real_name.(($real > 1 && $real_name != '')?'s':''); 
if($decimal > 0) 
$res .= ' '.num_to_words($decimal, '', 0, '').' '.$decimal_name.(($decimal > 1 && $decimal_name != '')?'s':''); 
return ucfirst($res); 
}

function validasi($DokKdBc,$CAR,$NoDaf){
	require "pdocon.php";
	$q = "SELECT CAR FROM header WHERE DokKdBc = '$DokKdBc' AND CAR = '$CAR' ";
	$rec = $pdo->query($q);
	$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
	if ($rs){
		throw new PDOException('No. Pengajuan '.$CAR.' Sudah Ada.');
	} else {
		$q = "SELECT CAR FROM header WHERE DokKdBc = '$DokKdBc' AND NoDaf = '$NoDaf' ";
		$rec = $pdo->query($q);
		$rs = $rec->fetchAll(PDO::FETCH_ASSOC);	
		if ($rs){
			throw new PDOException('No. Pendaftaran '.$NoDaf.' Sudah Ada.');
		}
	}
}
?>