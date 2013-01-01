<?php 
require_once "../models/abspath.php"; 
require_once "sessions.php";
require_once "pdocon.php";
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
		title:'DAFTAR APPROVAL PENGELUARAN BARANG PER DOKUMEN PABEAN',
		width:700,
		height:450,
		singleSelect:true,
		idField:'CAR',
		url:'<?php echo $basedir ?>models/keluarbarang_applist.php',
		pagination:'true',
		pageList:[25,50,75,100],
		rownumbers:"true", 
		fitColumns:"true",
		columns:[[  
			{field:'UrJnsDok',title:'Jenis<br>Dokumen',rowspan:2,width:20},
			{field:'FCAR',title:'No. Pengajuan',rowspan:2,width:25, align:'center'},    			
			{title:'Dokumen Pabean',colspan:2,width:45},			
			{field:'NmTuj',title:'Pembeli/Penerima',rowspan:2,width:50},
			{field:'detail',title:'Detail',rowspan:2,width:15,align:'center',
				formatter:function(value,row,index){
					var det = '<a href="#" onclick="detail(\''+row.DokKdBc+'\',\''+row.CAR+'\')"><img src="<?php echo $basedir ?>themes/icons/txt.png"></a>';
					return det;					
				}
			},
			{field:'approval',title:'Approval',rowspan:2,width:15,align:'center',
				formatter:function(value,row,index){
					var det = '<a href="#" onclick="approve(\''+row.DokKdBc+'\',\''+row.CAR+'\');"><img src="<?php echo $basedir ?>themes/icons/ok.png"></a>';
					
					return det;					
				}
			},
		],[						
			{field:'FNoDaf',title:'Nomor',width:20,align:"center"},
			{field:'tgl_daf',title:'Tanggal',width:25,align:'center'}		
		]],
		onClickRow:function(index,row){}
	});
});	

function detail(jenis_bc,car){							
	if (jenis_bc=='3'){
		openurl("bc25/bc25_rpt.php?CAR="+car);
	} else if (jenis_bc=='4'){
		openurl("bc261/bc261_rpt.php?CAR="+car);
	} else if (jenis_bc=='5'){
		openurl("bc262/bc262_rpt.php?CAR="+car);
	} else if (jenis_bc=='6'){
		openurl("bc27/bc27_rpt.php?CAR="+car);
	} else if (jenis_bc=='8'){
		openurl("bc40/bc40_rpt.php?CAR="+car);	
	} else if (jenis_bc=='9'){
		openurl("bc41/bc41_rpt.php?CAR="+car);	
	}
}


function approve(jenis_bc,car){;
	$.post('approve.php',{DokKdBc:jenis_bc,CAR:car},function(){});
	location.reload(true);
}


</script>
</head>
<body oncontextmenu="return false;">
	<table id="dg" class="easyui-datagrid"></table>
</body>
</html>