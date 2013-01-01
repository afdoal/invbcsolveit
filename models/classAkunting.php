<?php
/******************************************
Program 	: Class
File		: classAkunting.php
Function	: Pengaturan format angka
Description	: Kumpulan-kumpulan class yang berhubungan dengan angka
Author		: Kikin Kusumah (kk)
Environment	: Macromedia Dreamweaver 8
Notes		: _
Revisions	: 1.0 03/06/2010 (kk) First Release
			  
*******************************************/
class classAkunting
{
	protected $formatAngka;
	function angkaTitik($angka)
	{
		$strlength = strlen($angka);
		$format=""; 
		if ($strlength <= 3)
		{
			 $this->formatAngka = $angka;
			 return $this->formatAngka ;
		}
		else
		{
			$titik1 = ($strlength % 3);
			$titik2 = ($strlength / 3);
			$titik2 = floor($titik2);
			if ($titik1 == 0)	 
			{			   
				for ($i=0; $i<$titik2; $i++)
				{
					$arr2 = str_split($angka, 3);
					$format .='.'.$arr2[$i] ;
				}
				$this->formatAngka = substr_replace($format,"",0,1);
				return $this->formatAngka ;
			 }
			 else if ($titik1 == 1)
			 {
			  	$str2 = substr_replace($angka,"",0,1); 
			  	$arrAngka = str_split($angka,1);
			  	$format = $arrAngka[0];
				for ($i=0; $i<$titik2; $i++)
				{
					$arr2 = str_split($str2, 3);
					$format .='.'.$arr2[$i] ;
				 }
				 $this->formatAngka = $format;
				 return $this->formatAngka ;
			 }
			 else
			 {
				$str2 = substr_replace($angka,"",0,2);
				$arrAngka = str_split($angka, 2);
				$format=$arrAngka[0];
				for ($i=0; $i<$titik2; $i++)
				{
					$arr2 = str_split($str2, 3);
					$format=$format.'.'.$arr2[$i] ;
				 }
			     $this->formatAngka = $format;
				 return $this->formatAngka ;
			  }
		 } 
	}    
}	 
?>
