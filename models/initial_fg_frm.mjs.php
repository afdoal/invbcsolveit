<script type="text/javascript">   
function setdg(){
	var wh_id = $('#wh_id0').val();	
	var date = $('#date').datebox('getValue');
	
	$('#dg').datagrid({  	
		title:"<?php echo $NmMenu ?> List",
		width:710,
		height:300,	
		toolbar:"#toolbar2",
		fitColumns:"true",
		rownumbers:"true",
		columns:[[  
			{field:'KdBarang2',title:'Code',width:80},
			{field:'NmBarang2',title:'Name',width:150},
			{field:'Ket',title:'Specification',width:150},
			{field:'Sat2',title:'Unit',width:80},
			{field:'qty',title:'Qty.',width:100,align:'right'}
		]],
		url: '<?php echo $basedir; ?>models/initial_fg_grid.php?req=list2&wh_id='+wh_id+'&date='+date,  
		onAdd:function(index,row){rowIndex=index;},
		onDblClickRow:function(index,row){rowIndex=index;}
		
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
			{field:'wh_id',title:'wh_id',width:60,hidden:true},
			{field:'wh_name',title:'Warehouse',width:50},
			{field:'date',title:'Date',width:50}
		]],
		url: '<?php echo $basedir ?>models/initial_fg_grid.php?req=menu&pilcari='+$("#pilcari").val(), 
		onClickRow:function(index,row){insert_menu(row)}
		
	});
}

function insert_menu(row){
	$('#wh_id0').val(row.wh_id);
	$('#wh_id').val(row.wh_id);
	$('#date0').val(row.date);
	$('#date').datebox('setValue',row.date);
	setdg();
	$('#toolbar2').hide();
	$('#wCari').dialog('close');
	$('#tl1Ubh').show();
	$('#tl1Tbh').hide();	
	$('#tl1Hps').show();
	$('#btnPrint').show();
}

function insert_det(row){
	$('#NmBarang2').val(row.NmBarang2);
	$('#Ket').val(row.Ket);
	$('#Sat2').val(row.Sat2);
}

function topdf(){
	var wh_id = $('#wh_id0').val();	
	var date = $('#date').datebox('getValue');
	
	openurl('<?=$basedir?>masterdata/initial_fg_pdf.php?NmMenu=<?=$NmMenu?>&wh_id='+wh_id+'&date='+date);
}

</script>	