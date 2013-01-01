<?php 
require_once "abspath.php";
require_once "pdocon.php";

if(isset($_REQUEST['fUserName'])){
	function login_validate(){
		$timeout = 30*60; 
		$_SESSION["expires_by"] = time() + $timeout;
	}
	
	function login_check(){
		$exp_time = $_SESSION["expires_by"];
		if (time() < $exp_time){
			login_validate();
			return true; 
		} else {
			unset($_SESSION["expires_by"]);
			return false; 
		}
	}
	
	$userName=$_REQUEST['fUserName'];
	$vPwd=$_REQUEST['fpass'];
	 
	$q= "SELECT * FROM user WHERE nama_user='".$userName."'";
	$run = $pdo->query($q);
	$rs = $run->fetchAll(PDO::FETCH_ASSOC);
	
	$pengacak  = "K1234I4321K5678I8765N5891";
		 
	// cek kesesuaian password terenkripsi dari form login
	// dengan password terenkripsi dari database
	
	$vPwd1 = md5(md5($vPwd) . $pengacak .  md5($pengacak) . $vPwd);
	if ($rs){
		foreach($rs as $row){
			if ($row['pass']==$vPwd1){
			  session_start();		
			  login_validate();
					  
			  $_SESSION["userName"]= $row['nama_user'];
			  $_SESSION["pass"]= $row['pass'];	
			  $_SESSION["grup"]= $row['grup'];
			  
			  $qc= "SELECT * FROM mst_perusahaan WHERE TpPrshn='o' LIMIT 1";
			  $runc = $pdo->query($qc);
			  $rsc = $runc->fetchAll(PDO::FETCH_ASSOC);
			  $_SESSION["c_name"]= "PT. SOLVE IT";
			  $_SESSION["c_address"]= $rsc[0]['AlmtPrshn'];
			  $_SESSION["c_kota"]= $rsc[0]['Kota'];
			  $_SESSION["npwp"] = $rsc[0]['NpwpPrshn'];
			  //$_SESSION["status"] = $rsc[0]['StatusUsaha']." (".$rsc[0]['KdbidUsaha'].")";
			  $_SESSION["NoTpb"] = $rsc[0]['NoTpb'];
			  $_SESSION["TgTpb"] = $rsc[0]['TgTpb'];
			  //$_SESSION["JnsTpb"] = $rsc[0]['JnsTpb'];
			  //$_SESSION["apit"] = $rsc[0]['ApiNo'];
			  $_SESSION["KpbcPengawas"] = $rsc[0]['KpbcPengawas'];
			  $_SESSION["KdPengguna"] = $rsc[0]['KdPengguna'];
			  $_SESSION["NoReg1"] = $rsc[0]['NoReg1'];
			  $_SESSION["NoReg2"] = $rsc[0]['NoReg2'];
			  $_SESSION["NmPengusaha"] = $rsc[0]['Cp'];
			  $_SESSION["NipPengusaha"] = $rsc[0]['Niper'];
			  $_SESSION["NmPejabat"] = $rsc[0]['NmPejabat'];
			  $_SESSION["NipPejabat"] = $rsc[0]['NipPejabat'];
			  
			  $tgl=date('Y-m-d H:i:s');
			  $usr=$row['nama_user'];
			  $ket="login";
			  $qlog= "INSERT INTO log VALUES (0,'$tgl','$usr','$ket')";
			  $runqlog = $pdo->query($qlog);
			  echo json_encode(array('success'=>true,'msg'=>'Login Berhasil!'));
			  exit;
			} else {
			  $errmsg="Login Gagal, Password yang anda masukan salah!";	
			  echo json_encode(array('msg'=>$errmsg));
			}
		}		
	} else {
	  $errmsg="Login Gagal, Username yang anda masukan salah!";	
	  echo json_encode(array('msg'=>$errmsg));
	}
}// <--penutup isset 

?>