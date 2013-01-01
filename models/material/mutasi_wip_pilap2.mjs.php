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
			{field:'KdBarang',title:'Code',width:80},
			{field:'NmBarang',title:'Name',width:100},   
			{field:'Ket',title:'Specification',width:100},   
			{field:'Sat',title:'Unit',width:50}, 
		]],
		columns:[[  					
			{field:'qty_beg',title:'Previous Balance',width:90,align:'right'},
			{field:'qty_in',title:'Incoming',width:90,align:'right'},
			{field:'qty_out',title:'Outgoing',width:90,align:'right'},
			{field:'qty_end',title:'Ending Balance',width:90,align:'right',formatter: function(value,row,index){				
				qty_beg=parseFloat(row.qty_beg);
				qty_in=parseFloat(row.qty_in);
				qty_out=parseFloat(row.qty_out);
				qty_akhir=qty_beg+qty_in-qty_out;
				return qty_akhir.toFixed(2);
			}},
			{field:'ket',title:'Remarks',width:80}
		]],
		url: '<?php echo $basedir; ?>models/material/mutasi_wip_grid2.php?mat_type=11&date1='+$("#date1").datebox('getValue')+'&date2='+$("#date2").datebox('getValue'),
	});
}

function showPrint(){
	openurl('mutasi_wip_list2_pdf.php?NmMenu=Stock WIP&mat_type=0&date1='+$("#date1").datebox('getValue')+'&date2='+$("#date2").datebox('getValue'));
}
</script>	