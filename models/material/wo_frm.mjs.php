<script type="text/javascript">   
function setdg(){
	var wo_id = $('#wo_id').val();
	
	$('#dg').datagrid({  	
		title:"Finished Goods List",
		width:700,
		height:200,	
		toolbar:"#toolbar2",
		fitColumns:"true",
		rownumbers:"true",
		columns:[[  
			{field:'KdBarang2',title:'Code',width:80},
			{field:'PartNo',title:'Name.',width:150},
			{field:'NmBarang2',title:'Name',width:150},
			{field:'Sat2',title:'Unit',width:80},
			{field:'qty',title:'Qty. Plan',width:100,align:'right'}
		]],
		url: '<?php echo $basedir; ?>models/material/wo_grid.php?req=list&wo_id='+wo_id
	});
}

function setdgUrl(){
	var so_id = $('#so_id').val();
	
	$('#dg').datagrid({  	
		url: '<?php echo $basedir; ?>models/material/wo_grid.php?req=dgDet&so_id='+so_id
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
			{field:'wo_no',title:'WO No.',width:60},
			{field:'wo_date',title:'WO Date',width:50},
			{field:'so_no',title:'PO Cust. No.',width:50},
			{field:'expplan_date',title:'Export Plan Date',width:50}
		]],
		url: '<?php echo $basedir ?>models/material/wo_grid.php?req=menu&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(),
		onClickRow:function(index,row){insert_menu(row)}
	});
}

function insert_menu(row){
	$('#wo_id').val(row.wo_id);
	$('#wo_no').val(row.wo_no);
	$('#wo_date').datebox('setValue',row.wo_date);
	$('#so_id').val(row.so_id);
	$('#so_no').combogrid('setValue',row.so_no);	
	$('#expplan_date').datebox('setValue',row.expplan_date);
	$('#notes').val(row.notes);	
	setdg();
	$('#toolbar2').hide();	
	$('#wCari').dialog('close');
	$('#tl1Ubh').show();
	$('#tl1Tbh').hide();	
	$('#tl1Hps').show();
	$('#btnPrint').show();		
}

function setComboGrid(){
	so_id = $('#so_id').val();
	$('#KdBarang2').combogrid({  
		panelWidth:500,  	
		url: '<?php echo $basedir; ?>models/material/wo_grid.php?req=dgDet&so_id='+so_id,  
		idField:'KdBarang2',  
		textField:'KdBarang2',  
		mode:'remote',  
		fitColumns:true,  
		columns:[[  
			{field:'KdBarang2',title:'Code',width:60},
			{field:'PartNo',title:'Name.',width:50},
			{field:'NmBarang2',title:'Name',width:50},
			{field:'Sat2',title:'Unit',width:50},
			{field:'qty',title:'Qty',width:50}
		]],
		onClickRow:function(index,row){insert_det(row)}  
	}); 
}


function insert_ref(row){
	$('#so_id').val(row.so_id);	
	setdgUrl();
}

function insert_det(row){
	$('#PartNo').val(row.PartNo);
	$('#NmBarang2').val(row.NmBarang2);
	$('#Sat2').val(row.Sat2);
	$('#qty').numberbox('setValue',row.qty);
}

function topdf(){
	var wo_id = $('#wo_id').val();	
	
	openurl('<?=$basedir?>material/wo_pdf.php?NmMenu=<?=$NmMenu?>&wo_id='+wo_id);
}

</script>	