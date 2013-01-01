<script type="text/javascript">   
function setdg(){
	$('#dg').datagrid({  	
		title:"",
		width:736,
		height:515,	
		toolbar:"#toolCari",
		fitColumns:true,
		rownumbers:true,
		pagination:true,
		pageList:[25,50,75,100],
		columns:[[  
			{field:'KdBarang',title:'Kode Barang',width:80},  
			{field:'NmBarang',title:'Nama Barang',width:120},   
			{field:'Sat',title:'Sat.',width:50}, 
			{field:'qty_end',title:'Jumlah',width:90,align:'right',formatter: function(value,row,index){				
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
			{field:'ket',title:'Keterangan',width:150}
		]],
		url: '<?php echo $basedir; ?>models/material/mutasi_fg_grid.php?mat_type=11&date1='+$("#date1").datebox('getValue')+'&date2='+$("#date2").datebox('getValue'),
	});
}

function showPrint(){
	openurl('mutasi_wip_list_pdf.php?NmMenu=Laporan Posisi Barang Dalam Proses (WIP)&mat_type=0&date1='+$("#date1").datebox('getValue')+'&date2='+$("#date2").datebox('getValue'));
}

</script>	