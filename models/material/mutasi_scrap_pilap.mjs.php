<script type="text/javascript">   
function setdg(){
	$('#dg').datagrid({  	
		title:"",
		width:736,
		height:515,	
		toolbar:"#toolCari",
		fitColumns:false,
		rownumbers:"true",
		pagination:true,
		pageList:[25,50,75,100],
		frozenColumns:[[  
			{field:'KdBarang',title:'Kode Barang',width:80},
			{field:'NmBarang',title:'Nama Barang',width:100},   
			{field:'Sat',title:'Sat.',width:50}, 
		]],
		columns:[[  					
			{field:'qty_beg',title:'Saldo Awal',width:90,align:'right'},
			{field:'qty_in',title:'Pemasukan',width:90,align:'right'},
			{field:'qty_out',title:'Pengeluaran',width:90,align:'right'},
			{field:'qty_bal',title:'Penyesuaian (Adjustment)',width:90,align:'right'},
			{field:'qty_end',title:'Saldo Akhir',width:90,align:'right',formatter: function(value,row,index){				
				qty_beg=parseFloat(row.qty_beg);
				qty_in=parseFloat(row.qty_in);
				qty_out=parseFloat(row.qty_out);
				qty_akhir=qty_beg+qty_in-qty_out;
				qty_bal=parseFloat(row.qty_bal);
				qty=parseFloat(row.qty);
				if (qty_akhir>qty){
					qty_end=qty_akhir-qty_bal;
				} else {
					qty_end=qty_akhir+qty_bal;
				}
				return qty_end.toFixed(2);
			}},
			{field:'qty',title:'Stock Opname',width:90,align:'right'},
			{field:'qty_diff',title:'Selisih',width:90,align:'right'},
			{field:'ket',title:'Keterangan',width:80}
		]],
		url: '<?php echo $basedir; ?>models/material/mutasi_scrap_grid.php?mat_type=12&date1='+$("#date1").datebox('getValue')+'&date2='+$("#date2").datebox('getValue'),
	});
}

function showPrint(){
	openurl('mutasi_mat_list_pdf.php?NmMenu=Laporan Pertanggunjawaban<br>Mutasi Barang Sisa dan Scrap&mat_type=12&date1='+$("#date1").datebox('getValue')+'&date2='+$("#date2").datebox('getValue'));
}

</script>	