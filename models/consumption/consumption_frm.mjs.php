<script type="text/javascript">   
function setdg(){
	var KdBarang0 = $('#KdBarang0').val();	
		
	$('#dg').datagrid({  	
		title:"Material Consumption List",
		width:710,
		height:300,	
		toolbar:"#toolbar2",
		fitColumns:"true",
		rownumbers:"true",
		columns:[[  
			{field:'KdBarang2',title:'Mat. Code',width:80},
			{field:'NmBarang2',title:'Desc.',width:150},
			{field:'Sat2',title:'Unit',width:80},
			{field:'qty',title:'Qty.',width:100,align:'right'},
		]],
		url: '<?php echo $basedir; ?>models/consumption/consumption_grid.php?req=list&KdBarang0='+KdBarang0,  
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
			{field:'KdBarang',title:'Name.',width:50},
			{field:'Sat',title:'Unit',width:25},			
			{field:'Treatment',title:'Support<br>Treatment',width:50},
			{field:'Ket',title:'Remarks',width:50},
			{field:'cust',title:'Customer',width:80}
		]],
		url: '<?php echo $basedir ?>models/consumption/consumption_grid.php?req=menu&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(), 
		saveUrl: '',  
		updateUrl: '',  
		destroyUrl: '',
		onClickRow:function(index,row){insert_menu(row)}
		
	});
}

function insert_menu(row){
	$('#KdBarang0').val(row.KdBarang);
	$('#KdBarang').combogrid('setValue',row.KdBarang);
	$('#PartNo').val(row.PartNo);
	$('#NmBarang').val(row.NmBarang);
	$('#cust').val(row.cust);
	$('#Sat').val(row.Sat);
	$('#Ket').val(row.Ket);	
	setdg();
	$('#toolbar2').hide();
	$('#wCari').dialog('close');
	$('#tl1Ubh').show();
	$('#tl1Tbh').hide();
	$('#tl1Hps').show();
	$('#btnPrint').show();	
}

function insert_mst(row){
	$('#PartNo').val(row.PartNo);
	$('#NmBarang').val(row.NmBarang);
	$('#Sat').val(row.Sat);
	$('#cust').val(row.cust);
	$('#Ket').val(row.Ket);
	$('#toolbar2').show();
}


function insert_det(row){
	$('#NmBarang2').val(row.NmBarang2);
	$('#Sat2').val(row.Sat2);
}

function topdf(){
	var KdBarang0 = $('#KdBarang0').val();	
	
	openurl('<?=$basedir?>masterdata/consumption_pdf.php?NmMenu=<?=$NmMenu?>&KdBarang0='+KdBarang0);
}

</script>	