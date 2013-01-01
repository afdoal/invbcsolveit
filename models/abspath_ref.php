<?php

//OL
switch ($levelToRoot){
	case 2://< jika /folder_root/
		$basedir = "../";
		break;
	case 3://< jika /folder_root/sub1_root/ 
		$basedir = "../../";
		break;
	case 4;//< jika /folder_root/sub1_root/sub2_root/
		$basedir = "../../../";
		break;
	default://< jika /folder_root/
		$basedir = '';
		break;	
}

//LOKAL
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