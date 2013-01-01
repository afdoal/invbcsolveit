<?php
/******************************************
Program 	: Class
File		: class_tgl.php
Function	: Sebagai Perpustakaan Tanggal 
Description	: Kumpulan-kumpulan class yang berhubungan dengan tanggal
Author		: Kikin Kusumah (kk)
Environment	: Macromedia Dreamweaver 8
Notes		: _
Revisions	: 1.00 07/05/2010 (kk) First Release
*******************************************/

class tanggal
	  {
       protected $fullTanggal;
	   protected $namaBln;	
	   protected $angkaBln;	
	   protected $namaHari;
	   protected $hari; 	

  	   function GetLastDayofMonth($year, $month){
    		for ($day=31; $day>=28; $day--){
        		if (checkdate($month, $day, $year)){
            		$this->hari = $day;
					return $this->hari;
        		}
    		}    
		  }				

	   function tgl_indo($tgl){				
				 list($thn, $angkaBln, $tggl) = explode("-", $tgl);
			
				 switch($angkaBln){
						case 1 : $namaBln = "Januari";
								 break;
						case 2 : $namaBln = "Februari";
								 break;
						case 3 : $namaBln = "Maret";
								 break;
						case 4 : $namaBln = "April";
								 break;
						case 5 : $namaBln = "Mei";
								 break;
						case 6 : $namaBln = "Juni";
						 		 break;
						case 7 : $namaBln = "Juli";
								 break;
						case 8 : $namaBln = "Agustus";
								 break;
						case 9 : $namaBln = "September";
								 break;
						case 10: $namaBln = "Oktober";
								 break;
						case 11: $namaBln = "Nopember";
								 break;
						case 12: $namaBln = "Desember";
								 break;
					   }						
				 $this->fullTanggal = $tggl." ".$namaBln." ".$thn;
				 return $this->fullTanggal;
	   			}
				
	   function bln_indo($angkaBln){		
			     switch($angkaBln){
						case 1 : $this->namaBln = "Januari";
								 break;
						case 2 : $this->namaBln = "Februari";
								 break;
						case 3 : $this->namaBln = "Maret";
								 break;
						case 4 : $this->namaBln = "April";
								 break;
						case 5 : $this->namaBln = "Mei";
								 break;
						case 6 : $this->namaBln = "Juni";
								 break;
						case 7 : $this->namaBln = "Juli";
								 break;
						case 8 : $this->namaBln = "Agustus";
								 break;
						case 9 : $this->namaBln = "September";
								 break;
						case 10: $this->namaBln = "Oktober";
								 break;
						case 11: $this->namaBln = "Nopember";
								 break;
						case 12: $this->namaBln = "Desember";
								 break;
					   }
					   return $this->namaBln;
			    }
	   function bln_indo2($angkaBln){		
			     switch($angkaBln){
						case "01" : $this->namaBln = "Januari";
								 break;
						case "02" : $this->namaBln = "Februari";
								 break;
						case "03" : $this->namaBln = "Maret";
								 break;
						case "04" : $this->namaBln = "April";
								 break;
						case "05" : $this->namaBln = "Mei";
								 break;
						case "06" : $this->namaBln = "Juni";
								 break;
						case "07" : $this->namaBln = "Juli";
								 break;
						case "08" : $this->namaBln = "Agustus";
								 break;
						case "09" : $this->namaBln = "September";
								 break;
						case "10": $this->namaBln = "Oktober";
								 break;
						case "11": $this->namaBln = "Nopember";
								 break;
						case "12": $this->namaBln = "Desember";
								 break;
					   }
					   return $this->namaBln;
			    }
	   function bln_eng($angkaBln){		
			     switch($angkaBln){
						case 1 : $this->namaBln = "January";
								 break;
						case 2 : $this->namaBln = "February";
								 break;
						case 3 : $this->namaBln = "March";
								 break;
						case 4 : $this->namaBln = "April";
								 break;
						case 5 : $this->namaBln = "May";
								 break;
						case 6 : $this->namaBln = "June";
								 break;
						case 7 : $this->namaBln = "July";
								 break;
						case 8 : $this->namaBln = "August";
								 break;
						case 9 : $this->namaBln = "September";
								 break;
						case 10: $this->namaBln = "October";
								 break;
						case 11: $this->namaBln = "November";
								 break;
						case 12: $this->namaBln = "December";
								 break;
					   }
					   return $this->namaBln;
			    }
		function BlnEngIndo($namaBln){		
			     switch($namaBln){
						case "January" : $this->BlnIndo = "Januari";
								 break;
						case "February" : $this->BlnIndo = "Februari";
								 break;
						case "March" : $this->BlnIndo = "Maret";
								 break;
						case "April" : $this->BlnIndo = "April";
								 break;
						case "May" : $this->BlnIndo = "Mei";
								 break;
						case "June" : $this->BlnIndo = "Juni";
								 break;
						case "July" : $this->BlnIndo = "Juli";
								 break;
						case "August" : $this->BlnIndo = "Agustus";
								 break;
						case "September" : $this->BlnIndo = "September";
								 break;
						case "October": $this->BlnIndo = "Oktober";
								 break;
						case "November": $this->BlnIndo = "November";
								 break;
						case "December": $this->BlnIndo = "Desember";
								 break;
					   }
					   return $this->BlnIndo;
			    }
				
	   function anka_bln_eng($namaBln){		
			     switch($namaBln){
						case "January" : $this->angkaBln = "01";
								 break;
						case "February" : $this->angkaBln = "02";
								 break;
						case "March" : $this->angkaBln = "03";
								 break;
						case "April" : $this->angkaBln = "04";
								 break;
						case "May" : $this->angkaBln = "05";
								 break;
						case "June" : $this->angkaBln = "06";
								 break;
						case "July" : $this->angkaBln = "07";
								 break;
						case "August" : $this->angkaBln = "08";
								 break;
						case "September" : $this->angkaBln = "09";
								 break;
						case "October": $this->angkaBln = "10";
								 break;
						case "November": $this->angkaBln = "11";
								 break;
						case "December": $this->angkaBln = "12";
								 break;
					   }
					   return $this->angkaBln;
			    }								
			   
	   function hari($namaHariEng){				  
				 switch($namaHariEng){
						case "Sunday" 	: $this->namaHari = "Minggu";
										  break;
						case "Monday" 	: $this->namaHari = "Senin";
										  break;
						case "Tuesday" 	: $this->namaHari = "Selasa";
										  break;
						case "Wednesday": $this->namaHari = "Rabu";
										  break;
						case "Thursday" : $this->namaHari = "Kamis";
										  break;
						case "Friday" 	: $this->namaHari = "Jumat";
										  break;
						case "Saturday" : $this->namaHari = "Sabtu";
										  break;
						}
						return $this->namaHari;
				}
				
	  } 
?>
