<?php 
/*** mysql hostname ***/
$hostname = 'localhost';
/*** mysql username ***/
$username = 't16186_kikinbc';
/*** mysql password ***/
$password = '10101985kikinbc';
$dbname='t16186_bc';

try {
    /*** connect to MYSQL database ***/
    $pdo=new PDO("mysql:dbname=$dbname;host=$hostname",$username,$password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo 'Connected to database';
} catch(PDOException $e){
    echo $e->getMessage();
}

?>
