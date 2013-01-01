<script type="text/javascript">   
function setdg(){
	var mat_type = $('#mat_type0').val();	
	var date = $('#date').datebox('getValue');
	
	$('#dg').datagrid({  	
		title:"<?php echo $NmMenu ?> List",
		width:710,
		height:300,	
		toolbar:"#toolbar2",
		fitColumns:"true",
		rownumbers:"true",
		columns:[[  
			{field:'KdBarang2',title:'Mat. Code',width:80},
			{field:'NmBarang2',title:'Desc.',width:150},
			{field:'Sat2',title:'Unit',width:80},
			{field:'qty',title:'Qty.',width:100,align:'right'}
		]],
		url: '<?php echo $basedir; ?>models/initial_mac_grid.php?req=list&mat_type='+mat_type+'&date='+date		
	});
}

function setdgCari(){	
	$('#dgCari').datagrid({  
		width:586,
		height:315,	
		fitColumns:"true",
		rownumbers:"true", 
		toolbar:"#toolCari",
		columns:[[  
			{field:'mat_type',width:60,hidden:true},
			{field:'JnsBarang',title:'Mat. Type',width:50},
			{field:'date',title:'Date',width:50}
		]],
		url: '<?php echo $basedir ?>models/initial_mac_grid.php?req=menu&pilcari='+$("#pilcari").val(), 
		onClickRow:function(index,row){insert_menu(row)}
		
	});
	
}

function setBarang(){
	$('#KdBarang2').combogrid({  
	panelWidth:500,  	
	url: '<?php echo $basedir; ?>models/initial_mac_grid.php?req=dgDet&mat_type='+$("#mat_type").val(),  
	idField:'KdBarang2',  
	textField:'KdBarang2',  
	mode:'remote',  
	rownumbers:true,
	fitColumns:true,
	pagination:true,
	pageList:[25,50,75,100],    
	columns:[[  
		{field:'KdBarang2',title:'Mat. Code',width:60},
		{field:'NmBarang2',title:'Desc.',width:50},
		{field:'Sat2',title:'Unit',width:50}
	]],
	onSelect:function(index,row){insert_det(row)}  
}); 
}

function insert_menu(row){
	$('#wh_id0').val(row.wh_id);
	$('#wh_id').val(row.wh_id);
	$('#date0').val(row.date);
	$('#date').datebox('setValue',row.date);
	$('#mat_type0').val(row.mat_type);
	$('#mat_type').val(row.mat_type);
	setdg();
	setBarang();
	$('#toolbar2').hide();
	$('#wCari').dialog('close');
	$('#tl1Ubh').show();
	$('#tl1Tbh').hide();		
	$('#tl1Hps').show();
	$('#btnPrint').show();	
}

function insert_det(row){
	$('#NmBarang2').val(row.NmBarang2);
	$('#Sat2').val(row.Sat2);
}

function topdf(){
	var mat_type = $('#mat_type0').val();	
	var date = $('#date').datebox('getValue');
	
	openurl('<?=$basedir?>masterdata/initial_mac_pdf.php?NmMenu=<?=$NmMenu?>&mat_type='+mat_type+'&date='+date);
}

</script>	