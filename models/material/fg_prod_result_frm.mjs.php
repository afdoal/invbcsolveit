<script type="text/javascript">   
function setdg(){
	var wh_id = $('#wh_id0').val();	
	var date = $('#date').datebox('getValue');
	
	$('#dg').datagrid({  	
		title:"Finished Goods List",
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
			{field:'weight',title:'Weight',width:100,align:'right'},
			{field:'qty',title:'Qty.',width:100,align:'right'},
			{field:'remark',title:'Remark',width:100}
		]],
		url: '<?php echo $basedir; ?>models/material/fg_prod_result_grid.php?req=list&wh_id='+wh_id+'&date='+date,  
		saveUrl: '',  
		updateUrl: '',  
		destroyUrl: '',
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
		url: '<?php echo $basedir ?>models/material/fg_prod_result_grid.php?req=menu&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(), 
		saveUrl: '',  
		updateUrl: '',  
		destroyUrl: '',
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
	
	openurl('<?=$basedir?>material/fg_prod_result_pdf.php?NmMenu=<?=$NmMenu?>&wh_id='+wh_id+'&date='+date);
}
</script>	