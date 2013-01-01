<?php 
require_once "../../models/abspath.php"; 
require_once "sessions.php";
require_once "pdocon.php";

$NmMenu=$_REQUEST["NmMenu"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="expires" content="0">
<meta name="Author" content="Kikin Kusumah" />
<link type="text/css" href="<?php echo $basedir ?>themes/main.css" rel="Stylesheet" />

<link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>themes/icon.css">
<link type="text/css" href="<?php echo $basedir; ?>themes/redmond/jquery-ui-1.8.4.custom.css" rel="Stylesheet" />
 
<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery-ui-1.8.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/jquery.grid.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/global.format.js">disableSelection(document.body);
</script>
<script type="text/javascript">
<?php 
$q="SELECT * FROM tujuan_pengiriman ORDER BY KdTp";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
?>

tuj_kirim = <?php echo json_encode($rs) ?>;

<?php 
$q="SELECT * FROM kantor ORDER BY KdKpbc ";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
?>
kantor = <?php echo json_encode($rs) ?>;

<?php 
$q="SELECT * FROM jenis_tpb ORDER BY KdJnsTpb";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
?>
jenis_tpb = <?php echo json_encode($rs) ?>;

$(function(){
	$('#dg').datagrid({
		title:'<?php echo $NmMenu ?>',
		width:800,
		height:500,
		singleSelect:true,
		idField:'CAR',
		url:'<?php echo $basedir ?>models/bc40/bc40_listrpt.php',
		columns:[[  
			{field:'FCAR',title:'No. Pengajuan',rowspan:2,width:75,align:"center"},  			
			{title:'Dokumen Pabean',colspan:2,width:50},
			{field:'KdTp',title:'Tuj. Pengiriman',rowspan:2,width:50,
				formatter:function(value){
					for(var i=0; i<tuj_kirim.length; i++){
						if (tuj_kirim[i].KdTp == value) return tuj_kirim[i].UrTp;
					}
					return value;
				},
			 	editor:{
					valueField:'KdTp',  
					textField:'UrTp',  
					data:tuj_kirim
				}},
			{field:'NmTuj',title:'Pemasok/Pengirim',rowspan:2,width:75}, 
			{field:'detail',title:'Detail',rowspan:2,width:25,align:'center',
				formatter:function(value,row,index){
					var det = '<a href="#" onclick="window.open(\'bc40_rpt.php?CAR='+row.CAR+'\', \'_blank\');"><img src="<?php echo $basedir ?>themes/icons/txt.png"></a> <a href="#" onclick="window.open(\'bc40_rpt.php?CAR='+row.CAR+'&cetak=3\', \'_blank\');"><img src="<?php echo $basedir ?>themes/icons/xls.png"></a>';
					return det;					
				}
			}
		],[						
			{field:'FNoDaf',title:'Nomor',width:25,align:"center"},
			{field:'tgl_daf',title:'Tanggal',width:25,align:'center'}		
		]],
		onClickRow:function(index,row){}
	});
});	


function cari(){						
	$('#dg').datagrid({  
		url:"<?php echo $basedir ?>models/bc40/bc40_listrpt.php?dtdari="+$('#dtdari').combo('getValue')+"&dtsampai="+$('#dtsampai').combo('getValue')
	});
	$('#dg').datagrid('load');
}
</script>
</head>
<body oncontextmenu="return false;">
	<table id="dg" class="easyui-datagrid" style="width:1000;height:500px"
			toolbar="#tb" pagination="true" pageList="[25,50,75,100]"
			rownumbers="true" fitColumns="true" singleSelect="true">
	</table>
	<div id="tb" style="padding:5px;height:auto">
		<div>
			Tanggal Dokumen Pabean Dari: <input id="dtdari" class="easyui-datebox" style="width:80px">
			Sampai <input id="dtsampai" class="easyui-datebox" style="width:80px">
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" onClick="cari();">Cari</a>
		</div>
	</div>
</body>
</html>