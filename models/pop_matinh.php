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
			
			$("#listing").load('pop_matinh_load.php',obj,function (){
									
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
					e.innerHTML = "<input border=\"0\" type=\"image\" src=\"img/expander.gif\" onClick=\"insert_matinoutdoh(\'"+barangku[4]+"\',\'" + barangku[5] + "\',\'" + barangku[6] + "\',\'" + barangku[7] + "\',\'" + barangku[8] + "\')\" />";		
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
	<h2>Material Receive</h2>
	<table id="TableBrg" class="initiallist">
  		<tr>
			<th colspan="7">
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
            <th>Supplier</th>
            <th>Ke Gudang</th>
            <th>&nbsp;</th>
		</tr>
	<?php 		
		$q = "SELECT * FROM tbmatin_hd mh LEFT JOIN tbsupplier sh ON mh.suppcd=sh.Kode_Supplier  ORDER BY Date LIMIT 0,20";
		$rec = $pdovb->query($q);
		$rs = $rec->fetchAll(PDO::FETCH_ASSOC);		
		foreach ($rs as $r){
	?>
		<tr>	
			<td><?php echo $r['No'] ?></td>
            <td><?php echo ymd2dmy($r['Date']) ?></td>
            <td><?php echo $r['Nama'] ?></td>
            <td><?php echo getWarehouse($r['Warehouse_rec']) ?></td>																			
			<td style="text-align:center;"><input border='0' type='image' src="<?php echo $basedir ?>img/expander.gif" onClick="insert_matinoutdoh('<?php echo $r['ID'] ?>','<?php echo trim($r['npwp']) ?>','<?php echo trim($r['Nama']) ?>','<?php echo mysql_real_escape_string($r['Alamat']) ?>','<?php echo $r['No_TPB'] ?>')" /></td>
		</tr>
	<?php }?>
	</table>
</body>
</html>
