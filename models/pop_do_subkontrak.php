<?php
require_once "../models/abspath.php";
require_once "pdocon.php";

require_once "function.php";
require_once "getDetail.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style>
	input {
		font: 12px "Lucida Grande", Verdana, Arial, "Bitstream Vera Sans", sans-serif; 
		padding:2px;
		-moz-box-sizing: border-box;
		-webkit-box-sizing: border-box;
		-ms-box-sizing: border-box; /* ie8 only */
		box-sizing: border-box; 
		border:solid 1px #ddd;	
		height:20px;
	}
	input[type="submit"] { 
		border: solid 1px #ddd; 
		padding:2px;
		background:url(img/white-grad.png) scroll left top; 
		height:20px;
	}
	table.detaillist {
		border-spacing: 0px;
		border: 3px solid #ddd;
		color: #333; margin-top:10px;
		font: 11px "Lucida Grande", Verdana, Arial, "Bitstream Vera Sans", sans-serif;
	}
	
	table.detaillist td{
		text-align: left;
		border-top: 0px solid #ddd;
		border-right: 0px solid #ddd;
		border-bottom: 2px solid #ddd;
		border-left: 0px solid #ddd;
		padding:5px 15px;
		background: #fff;
		font: 11px "Lucida Grande", Verdana, Arial, "Bitstream Vera Sans", sans-serif;
		line-height:1.5em;
		vertical-align:top;
	}
	table.detaillist th {
		text-align: center;
		border: 0px solid #ddd;
		padding:5px 5px;
		background: url(img/gray-grad.png);
		color: #333; font-weight:bold;
		border-bottom: 0x solid #ddd;		
		width:25%;
	}
</style>
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
			
			$("#listing").load('pop_bc261_load.php',obj,function (){
									
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
					var f=x.insertCell(5);
					var g=x.insertCell(6);
					
					f.style.textAlign='center';
										
					
					barangmu = listbrg[i];
					
					barangku = listbrg[i].split("}");
					var hml = new String(barangku[32]);
					hml = hml.replace(new RegExp('"', 'g'), "&quot;");
					var hml2 = new String(barangku[45]);
					hml2 = hml2.replace(new RegExp('"', 'g'), "&quot;");
					var hml3 = new String(barangku[46]);
					hml3 = hml3.replace(new RegExp('"', 'g'), "&quot;");
					var hml4 = new String(barangku[47]);
					hml4 = hml4.replace(new RegExp('"', 'g'), "&quot;");
					
													
					a.innerHTML = barangku[0];
					b.innerHTML = barangku[1];
					c.innerHTML = barangku[2];
					d.innerHTML = barangku[3];					
					
					e.innerHTML = barangku[4];
					f.innerHTML = barangku[5];
					g.innerHTML = "<input border=\"0\" type=\"image\" src=\"img/expander.gif\" onClick=\"insert_bc261(\'"+barangku[0]+"\',\'" + barangku[1] + "\',\'" + barangku[2] + "\',\'" + barangku[3] + "\',\'" + barangku[4] + "\',\'" + barangku[5] + "\',\'" + barangku[6] + "\',\'" + barangku[7] + "\',\'" + barangku[8] + "\',\'" + barangku[9] + "\',\'" + barangku[10] + "\',\'" + barangku[11] + "\',\'" + barangku[12] + "\',\'" + barangku[13] + "\',\'" + barangku[14] + "\',\'" + barangku[15] + "\',\'" + barangku[16] + "\',\'" + barangku[17] + "\',\'" + barangku[18] + "\',\'" + barangku[19] + "\',\'" + barangku[20] + "\',\'" + barangku[21] + "\',\'" + barangku[22] + "\',\'" + barangku[23] + "\',\'" + barangku[24] + "\',\'" + barangku[25] + "\',\'" + barangku[26] + "\',\'" + barangku[27] + "\',\'" + barangku[28] + "\',\'" + barangku[29] + "\',\'" + barangku[30] + "\',\'" + barangku[31] + "\',\'" + hml + "\',\'" + barangku[33] + "\',\'" + barangku[34] + "\',\'" + barangku[35] + "\',\'" + barangku[36] + "\',\'" + barangku[37] + "\',\'" + barangku[38] + "\',\'" + barangku[39] + "\',\'" + barangku[40] + "\',\'" + barangku[41] + "\',\'" + barangku[42] + "\',\'" + barangku[43] + "\',\'" + barangku[44] + "\',\'" + hml2 + "\',\'" + hml3 + "\',\'" + hml4 + "\')\" />";		
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
	<h2>Material Out Detail</h2>
	<table id="TableBrg" class="detaillist" border="0">
  		<tr>
			<th colspan="7">
				<div style="" align="left">
					  <form id="fcari" name="fcari" onsubmit="return false" >
                      Dari 
					  <input type="text" name="dtdari" id="dtdari" size="10" >
					  Sampai
					  <input type="text" name="dtsampai" id="dtsampai" size="10" >				  
                      <input id="cari" name="cari" type="submit" value="Cari Material" />
					  </form>
				</div>
			</th>
		</tr>
		<tr>
			<th>Kode</th>
			<th>Nama</th>
            <th>Unit</th>
            <th>Size</th>
            <th>Qty</th>
			<th>Price</th>
            <th>&nbsp;</th>
		</tr>
	<?php  
		$q = "SELECT * FROM dlvorderd dod
			  WHERE dorder_id=".$_GET['dorder_id'];
		//$q = "SELECT * FROM matoutd mod";
		//echo $q;
		$rec = $pdo1->query($q);
		$rs = $rec->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($rs as $r){
			if (!empty($r['style_no'])){
            	$uraian=trim($r['style_no'])." - ".$r['style_name'];
            } else {
            	$uraian=$r['style_name'];
            }
			$unit=trim($r['unit']);
			$qty=number_format($r['dlv_qty'],0);
			$price=number_format($r['price'],2);
	?>
		<tr>	
			<td><?php echo $r['style_no'] ?></td>
            <td><?php echo $r['style_name'] ?></td>
            <td><?php echo $unit ?></td>
            <td><?php echo $r['size'] ?></td>
			<td><?php echo $qty ?></td>
            <td><?php echo $price ?></td>																					
			<td style="text-align:center;"><input border='0' type='image' src="img/expander.gif" onClick="insert_subkontrak('<?php echo $uraian ?>','<?php echo $qty ?>','<?php echo $unit ?>')" /></td>
		</tr>
	<?php } ?>
    
	</table>
</body>
</html>
