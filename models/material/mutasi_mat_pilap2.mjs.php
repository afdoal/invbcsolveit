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
			{field:'KdBarang',title:'Mat. Code',width:80,rowspan:2},  
			{field:'NmBarang',title:'Mat. Name',width:100,rowspan:2},   
			{field:'Ket',title:'Specification',width:100,rowspan:2},   
			{field:'Sat',title:'Unit',width:50,rowspan:2}, 
		]],
		columns:[[  					
			{field:'qty_beg',title:'Beginning Balance',width:90,align:'right',rowspan:2},
			{field:'',title:'Incoming',width:90,align:'right',colspan:3},
			{field:'',title:'Outgoing',width:90,align:'right',colspan:3},
			{field:'qty_end',title:'Ending Balance',width:90,align:'right',rowspan:2,formatter: function(value,row,index){				
				qty_beg=parseFloat(row.qty_beg);
				qty_in0=parseFloat(row.qty_in0);
				qty_in1=parseFloat(row.qty_in1);
				qty_in2=parseFloat(row.qty_in2);
				qty_out0=parseFloat(row.qty_out0);
				qty_out1=parseFloat(row.qty_out1);
				qty_out2=parseFloat(row.qty_out2);
				qty_akhir=qty_beg+qty_in0+qty_in1+qty_in2-qty_out0-qty_out1-qty_out2;
				return qty_akhir.toFixed(2);
			}},
			{field:'ket',title:'Remarks',width:80,rowspan:2}
		],[						
			{field:'qty_in0',title:'Purchase',width:80,align:"right"},
			{field:'qty_in1',title:'Replacement',width:80,align:'right'},
			{field:'qty_in2',title:'From Production',width:80,align:"right"},
			{field:'qty_out0',title:'Consumption',width:80,align:'right'},
			{field:'qty_out1',title:'Return',width:80,align:"right"},
			{field:'qty_out2',title:'From Production',width:80,align:'right'}		
		]],
		url: '<?php echo $basedir; ?>models/material/mutasi_mat_grid2.php?mat_type=1&date1='+$("#date1").datebox('getValue')+'&date2='+$("#date2").datebox('getValue'),
	});
}

function showPrint(){
	openurl('mutasi_mat_list2_pdf.php?NmMenu=Stock Raw Material&mat_type=1&date1='+$("#date1").datebox('getValue')+'&date2='+$("#date2").datebox('getValue'));
}
</script>	