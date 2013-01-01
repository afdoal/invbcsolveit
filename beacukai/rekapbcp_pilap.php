<?php 
require_once "../models/abspath.php"; 
require_once "sessions.php";
require_once "pdocon.php";
require_once "function.php";
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
		title:'REKAPITULASI KEGIATAN PERUSAHAAN YANG MENDAPAT FASILITAS KAWASAN BERIKAT DI BAWAH PENGAWASAN KPPBC <?php echo getKantor($_SESSION['KpbcPengawas']) ?>',
		width:1500,
		height:300,
		singleSelect:true,
		idField:'c_name',
		url:'<?php echo $basedir ?>models/rekapbcp_listrpt.php',
		rownumbers:"true", 
		fitColumns:"true",
		columns:[[  
			{field:'c_name',title:'Nama Kawasan<br>Berikat dan Gudang<br>Berikat',rowspan:4,width:70,align:"center"},  			
			{title:'JUMLAH DOKUMEN',colspan:19,width:1000,align:"center"},
			{title:'NILAI DEVISA / USD ',rowspan:2,colspan:2,width:55,align:"center"},
			{title:'TONAGE / KG',rowspan:2,colspan:2,width:40,align:"center"}, 
			{field:'bm',title:'Nilai BM<br>( Rp )<br>Jual Ke DPIL',rowspan:4,width:25,align:"center"}
		],[						
			{title:'Pemasukan',colspan:9,width:20,align:"center"},
			{title:'Pengeluaran',colspan:9,width:25,align:'center'},
			{field:'BAP',title:'Berita<br>Acara<br>Pemusnahan',rowspan:3,width:30,align:"center"}	
		],[						
			{title:'BC 2.3',width:20,align:"center"},
			{title:'BC 2.7',colspan:2,width:20,align:"center"},
			{title:'BC 2.6.2',colspan:2,width:20,align:"center"},
			{title:'BC 2.7',colspan:2,width:20,align:"center"},
			{title:'BC 2.4',width:20,align:"center"},
			{title:'BC 4.0',width:20,align:"center"},
			{title:'BC 3.0',colspan:2,width:20,align:"center"},
			{title:'BC 2.7',width:20,align:"center"},
			{title:'BC 2.6.1',colspan:2,width:20,align:"center"},
			{title:'BC 2.7',colspan:2,width:20,align:"center"},
			{title:'BC 2.5',width:20,align:"center"},
			{title:'BC 4.1',width:20,align:"center"},
			{field:'i1',title:'Impor',rowspan:2,width:30,align:"center"},
			{field:'e1',title:'Ekspor',rowspan:2,width:30,align:"center"},
			{field:'i2',title:'Impor',rowspan:2,width:30,align:"center"},
			{field:'e2',title:'Ekspor',rowspan:2,width:30,align:"center"}
		],[						
			{field:'1',title:'1',width:20,align:"center"},
			{field:'2',title:'2',width:20,align:'center'},
			{field:'3',title:'3',width:20,align:"center"},
			{field:'4',title:'4',width:20,align:'center'},
			{field:'5',title:'5',width:20,align:"center"},
			{field:'6',title:'6',width:20,align:'center'},
			{field:'7',title:'7',width:20,align:"center"},
			{field:'8',title:'8',width:20,align:'center'},
			{field:'9',title:'9',width:20,align:"center"},
			{field:'10',title:'10',width:20,align:'center'},
			{field:'11',title:'11',width:20,align:"center"},
			{field:'12',title:'12',width:20,align:'center'},
			{field:'13',title:'13',width:20,align:"center"},
			{field:'14',title:'14',width:20,align:'center'},
			{field:'15',title:'15',width:20,align:"center"},
			{field:'16',title:'16',width:20,align:'center'},
			{field:'17',title:'17',width:20,align:"center"},
			{field:'18',title:'18',width:20,align:'center'}			
		]]
	});
});	


function cari(){						
	dtdari=$('#dtdari').combo('getValue');
	dtsampai=$('#dtsampai').combo('getValue');
	$('#dg').datagrid({  
		url:"<?php echo $basedir ?>models/rekapbcp_listrpt.php?dtdari="+dtdari+"&dtsampai="+dtsampai
	});
	$('#dg').datagrid('load');
}

function showPrint(){						
	dtdari=$('#dtdari').combo('getValue');
	dtsampai=$('#dtsampai').combo('getValue');
	
	window.open("<?php echo $basedir ?>models/rekapbcp_listrpt.php?dtdari="+dtdari+"&dtsampai="+dtsampai+"&cetak="+1);
}

function toExcel(){						
	dtdari=$('#dtdari').combo('getValue');
	dtsampai=$('#dtsampai').combo('getValue');
	
	window.open("<?php echo $basedir ?>models/rekapbcp_listrpt.php?dtdari="+dtdari+"&dtsampai="+dtsampai+"&cetak="+3);
}
</script>
</head>
<body oncontextmenu="return false;">
<table id="dg" class="easyui-datagrid" toolbar="#tb"></table>
<br>
<table width="1300">
<tr>
  <td>
  	Keterangan :<br>
1.	Pemasukan dari Tempat Penimbunan Sementara<br>				
2.	Pemasukan dari Gudang Berikat<br>				
3.	Pemasukan dari PDKB Lain<br>				
4.	Pemasukan dalam rangka Subkontrak dengan jaminan<br>				
5.	Pemasukan kembali setelah diperbaiki/dipinjamkan/dipamerkan dengan jaminan<br>				
6.	Pemasukan dalam rangka Subkontrak dari KB<br>				
7.	Pemasukan kembali setelah diperbaiki/dipinjamkan/dipamerkan dari KB<br>				
8.	Pemasukan dari produsen Pengguna fasilitas Bapeksta Keuangan<br>				
9.	Pemasukan dari DPIL<br>
  </td>
  <td><br>
10.	Ekspor<br>
11.	Ekspor Kembali<br>
12.	Pengeluaran ke PDKB Lain<br>
13.	Pengeluaran dalam rangka Subkontrak dengan jaminan<br>
14.	Pengeluaran kembali setelah diperbaiki/dipinjamkan/dipamerkan dengan jaminan<br>
15.	Pengeluaran dalam rangka Subkontrak dari KB<br>
16.	Pengeluaran kembali setelah diperbaiki/dipinjamkan/dipamerkan dari KB<br>
17.	Pengeluaran dari DPIL<br>
18.	Pengeluaran kembali setelah salah kirim <br>
  </td>
  <td valign="top"><br>
19.  Jumlah Berita Acara Pemusnahan yang ditangani hanggar<br>
20.  Jumlah Nilai Devisa Impor dari BC 23<br>
21. Jumlah Nilai Devisa Ekspor dokumen BC 30<br>
22. Jumlah Tonage Impor dari Dokumen BC 2.3<br>
23. Jumlah Tonage Ekspor Dokumen BC 3.0<br>
24. Jumlah BM dari Dokumen BC 2.5<br>
  
  </td>
</tr>
</table>
<div id="tb" style="padding:5px;height:auto">
    <div>
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