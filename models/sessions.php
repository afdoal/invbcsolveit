<?php
session_start();

function login_validate(){
    $timeout = 30*60; 
    $_SESSION["expires_by"] = time() + $timeout;
}

function login_check(){
    $exp_time = $_SESSION["expires_by"];
	$exp_date = "10/10/2013";
	$this_date = date("d/m/Y");
    if ($exp_date == $this_date){
		unset($_SESSION["expires_by"]);
		return false;
	} else {
		if (time() < $exp_time){
			login_validate();
			return true; 
		} else {
			unset($_SESSION["expires_by"]);
			return false; 
		}
	}	
}

// mengecek ada tidaknya session untuk username
if (login_check() == 0){
	echo "<SCRIPT>parent.location='$basedir"."login.php'</SCRIPT>";
	exit;
}

?>