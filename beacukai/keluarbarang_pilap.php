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
		title:'LAPORAN PENGELUARAN BARANG PER DOKUMEN PABEAN',
		width:1000,
		height:500,
		singleSelect:true,
		idField:'CAR',
		url:'<?php echo $basedir ?>models/keluarbarang_listrpt.php',
		pagination:'true',
		pageList:[25,50,75,100],
		rownumbers:"true", 
		fitColumns:"true",
		columns:[[  
			{field:'UrJnsDok',title:'Jenis<br>Dokumen',rowspan:2,width:20},  			
			{title:'Dokumen Pabean',colspan:2,width:45},
			{title:'Bukti/Dokumen<br>Pengeluaran',colspan:2,width:55,align:"center",
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
			{field:'NmTuj',title:'Pembeli/Penerima',rowspan:2,width:40}, 
			{field:'KdBarang',title:'Kode<br>Barang',rowspan:2,width:25},
			{field:'UrBarang',title:'Nama<br>Barang',rowspan:2,width:40},
			{field:'unit',title:'Sat',rowspan:2,width:15},
			{field:'Fqty',title:'Jumlah',rowspan:2,width:20,align:"right"},
			{field:'FHrgSerah',title:'Nilai Barang',rowspan:2,width:30,align:"right"}
		],[						
			{field:'FNoDaf',title:'Nomor',width:20,align:"center"},
			{field:'tgl_daf',title:'Tanggal',width:25,align:'center'},
			{field:'DokNo',title:'Nomor',width:30,align:"center"},
			{field:'DokTg',title:'Tanggal',width:25,align:'center'}			
		]],
		onClickRow:function(index,row){}
	});
});	


function cari(){						
	$('#dg').datagrid({  
		url:"<?php echo $basedir ?>models/keluarbarang_listrpt.php?dtdari="+$('#dtdari').combo('getValue')+"&dtsampai="+$('#dtsampai').combo('getValue')+"&DokKdBc="+$('#DokKdBc').val()
	});
	$('#dg').datagrid('load');
}

function showPrint(){						
	dtdari=$('#dtdari').combo('getValue');
	dtsampai=$('#dtsampai').combo('getValue');
	DokKdBc=$('#DokKdBc').val();
	
	window.open("keluarbarang_rpt.php?dtdari="+dtdari+"&dtsampai="+dtsampai+"&DokKdBc="+DokKdBc);
}

function toExcel(){						
	dtdari=$('#dtdari').combo('getValue');
	dtsampai=$('#dtsampai').combo('getValue');
	DokKdBc=$('#DokKdBc').val();
	
	window.open("keluarbarang_rpt.php?dtdari="+dtdari+"&dtsampai="+dtsampai+"&DokKdBc="+DokKdBc+"&cetak="+3);
}
</script>
</head>
<body oncontextmenu="return false;">
	<table id="dg" class="easyui-datagrid" toolbar="#tb"></table>
	<div id="tb" style="padding:5px;height:auto">
		<div>
			Jenis Dokumen: <select id="DokKdBc" name="DokKdBc" style="width:80px;" tabindex="2">
                  <option value=""></option>
                  <?php 
					$q="SELECT * FROM jenis_dok WHERE KdJnsDok IN ('7','9','4','3') ORDER BY UrJnsDok";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdJnsDok']."'";						
						$str .= ">".$r['UrJnsDok']."</option>";
						echo $str;
					}
					?>
                </select> 
        
            Periode: 
            <input id="dtdari" class="easyui-datebox" style="width:80px">
			Sampai <input id="dtsampai" class="easyui-datebox" style="width:80px">
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" onClick="cari();">Cari</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-print" onClick="showPrint();">Printable</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-xls" onClick="toExcel();">Excel</a>
		</div>
	</div>
</body>
</html>