<?php

define('APPLICATION_PATH', dirname(dirname(__FILE__)));
$paths = array(
		 APPLICATION_PATH,		 
		 APPLICATION_PATH.'/beacukai',
		 APPLICATION_PATH.'/controller',
		 APPLICATION_PATH.'/controller/bc23',
		 APPLICATION_PATH.'/controller/bc25',		 
		 APPLICATION_PATH.'/controller/bc261',
		 APPLICATION_PATH.'/controller/bc262',
		 APPLICATION_PATH.'/controller/bc27',
		 APPLICATION_PATH.'/controller/bc30',
		 APPLICATION_PATH.'/controller/bc40',
		 APPLICATION_PATH.'/controller/bc41',
		 APPLICATION_PATH.'/models',
		 APPLICATION_PATH.'/models/user',		 
		 APPLICATION_PATH.'/models/barang',
		 APPLICATION_PATH.'/models/barang2',
		 APPLICATION_PATH.'/models/company',
		 APPLICATION_PATH.'/models/kpbc',
		 APPLICATION_PATH.'/models/caraangkut',
		 APPLICATION_PATH.'/models/pelabuhan',
		 APPLICATION_PATH.'/models/penimbunan',
		 APPLICATION_PATH.'/models/satuan',
		 APPLICATION_PATH.'/models/valuta',
		 APPLICATION_PATH.'/models/negara',
		 APPLICATION_PATH.'/models/bc23',
		 APPLICATION_PATH.'/models/bc25',		 
		 APPLICATION_PATH.'/models/bc261',
		 APPLICATION_PATH.'/models/bc262',
		 APPLICATION_PATH.'/models/bc27',
		 APPLICATION_PATH.'/models/bc30',
		 APPLICATION_PATH.'/models/bc40',
		 APPLICATION_PATH.'/models/bc41',
		 APPLICATION_PATH.'/models/consumption',
		 APPLICATION_PATH.'/models/material',
		 get_include_path()
		 );

set_include_path(implode(PATH_SEPARATOR, $paths));
date_default_timezone_set("Asia/Jakarta");
		 
function __autoload($className) {
   $fileName=str_replace('\\','/',$className). '.php';
   require_once $fileName;
}

$url=basename($_SERVER['REQUEST_URI']);
$dir = str_replace($url,'',$_SERVER['REQUEST_URI']); 
$levelToRoot = substr_count($dir, '/'); 
switch ($levelToRoot){
	case 3://< jika /folder_root/
		$basedir = "../";
		break;
	case 4;//< jika /folder_root/sub1_root/
		$basedir = "../../";
		break;
	default:
		$basedir = '';
		break;	
}

?>