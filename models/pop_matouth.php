<?php
require_once "../models/abspath.php";
require_once "pdocon.php";
require_once "function.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="../themes/initialtable.css" type="text/css" media="all">
<title>Lookup</title>
<script type="text/javascript">
$(document).ready(function(){	

$('#dtdari').datepicker({ dateFormat: 'dd/mm/yy' });
$('#dtsampai').datepicker({ dateFormat: 'dd/mm/yy' });
										
	$("#fcari").submit(function(){
		$("#listing").hide();
		
		try{
			
			
			var  mulai = new Date(xdate($("#dtdari").val()));
			var  akhir = new Date(xdate($("#dtsampai").val()));
								
			var jml =  parseInt((akhir.getTime() - mulai.getTime())/(24*3600*1000));
			
			if(jml < 0 ){
				throw "Periode Pencarian Salah !";
			}
			
			obj = new Object();
			obj.dtdari = $("#dtdari").val();
			obj.dtsampai = $("#dtsampai").val();
			
			$("#listing").load('pop_matouth_load.php',obj,function (){
									
				temp = $("#listing").html();
				
				listbrg = temp.split("~");
				
				num =  listbrg.length;
				
				clear();
				
				for(i=0;i<num-1;i++){
					var x=document.getElementById('TableBrg').insertRow(2);
					
					var a=x.insertCell(0);
					var b=x.insertCell(1);
					var c=x.insertCell(2);
					var d=x.insertCell(3);
					var e=x.insertCell(4);
										
					e.style.textAlign='center';
										
					barangmu = listbrg[i];
					
					barangku = listbrg[i].split("}");					
													
					a.innerHTML = barangku[0];
					b.innerHTML = barangku[1];
					c.innerHTML = barangku[2];
					d.innerHTML = barangku[3];	
					e.innerHTML = "<input border=\"0\" type=\"image\" src=\"<?php echo $basedir ?>img/expander.gif\" onClick=\"insert_matinoutdoh(\'"+barangku[4]+"\',\'\',\'" + barangku[5] + "\',\'" + barangku[6] + "\',\'" + barangku[7] + "\',\'" + barangku[8] + "\',\'" + barangku[9] + "\')\" />";		
				}
				
			});
		}catch(err){
			alert(err);
		}
	});

});

function xdate(str){
 var xOx =  new String(str);
	var xIx = xOx.split("-");
	return xIx[2] + "-" + xIx[1] + "-" + xIx[0];
}

function clear(){
	while (document.getElementById('TableBrg').rows[2] !=null ){
		document.getElementById('TableBrg').deleteRow(2);
	}

}
		
</script>

</head>
<body>
<div id="listing"></div>
	<h2>Material Out</h2>
	<table id="TableBrg" class="initiallist">
  		<tr>
			<th colspan="5">
				<div style="" align="left">
					  <form id="fcari" name="fcari" onsubmit="return false" >
                      Dari 
					  <input type="text" name="dtdari" id="dtdari" size="10" >
					  Sampai
					  <input type="text" name="dtsampai" id="dtsampai" size="10" >				  
                      <input id="cari" name="cari" type="submit" value="Cari" />
					  </form>
				</div>
			</th>
		</tr>
		<tr>
			<th>Nomor</th>
			<th>Tanggal</th>
            <th>Dari Gudang</th>
            <th>Ke Gudang</th>
            <th>&nbsp;</th>
		</tr>
	<?php 
		//$q = "SELECT * FROM tbmatout_hd ORDER BY nomor";
		$q = "SELECT *,moh.Number AS mohno,c.Number AS cno FROM tbmatout_hd moh LEFT JOIN tbcustomer c ON c.Customer_Code=moh.Buyer ORDER BY date";
		$rec = $pdovb->query($q);
		$rs = $rec->fetchAll(PDO::FETCH_ASSOC);		
		foreach ($rs as $r){
	?>
		<tr>	
			<td><?php echo $r['Nomor']//." ".$rsSup[0]['sup_name'] ?></td>
            <td><?php echo ymd2dmy($r['Date']) ?></td>
            <td><?php echo getWarehouse($r['wh']) ?></td>
            <td><?php echo getWarehouse($r['To_wh']) ?></td>																			
			<td style="text-align:center;"><input border='0' type='image' src="<?php echo $basedir ?>img/expander.gif" onClick="insert_matinoutdoh('<?php echo $r['ID'] ?>','<?php echo $r['cno'] ?>','<?php echo $r['NPWP'] ?>','<?php echo $r['Customer_Name'] ?>','<?php echo $r['Address'] ?>','<?php echo $r['TPB'] ?>')" /></td>
		</tr>
	<?php } ?>
	</table>
</body>
</html>
