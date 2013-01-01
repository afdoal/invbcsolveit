<script type="text/javascript">   
function setdg(){
	var so_id = $('#so_id').val();
	
	$('#dg').datagrid({  	
		title:"Finished Goods List",
		width:700,
		height:200,	
		toolbar:"#toolbar2",
		fitColumns:"true",
		rownumbers:"true",
		columns:[[  
			{field:'KdBarang2',title:'Code',width:80},
			{field:'PartNo',title:'Name.',width:100},
			{field:'NmBarang2',title:'Name',width:150},
			{field:'Sat2',title:'Unit',width:80},
			{field:'qty',title:'Qty.',width:100,align:'right'},
			{field:'price',title:'Price',width:100,align:'right'},
			{field:'amount',title:'Amount',width:100,align:'right'}
		]],
		url: '<?php echo $basedir; ?>models/material/so_grid.php?req=list&so_id='+so_id
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
			{field:'so_no',title:'PO No.',width:50},
			{field:'so_date',title:'PO Date',width:50},
			{field:'cust',title:'Customer',width:80},
			{field:'due_date',title:'Due Date',width:50},
			{field:'currency',title:'Currency',width:50}
		]],
		url: '<?php echo $basedir ?>models/material/so_grid.php?req=menu&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(),
		onClickRow:function(index,row){insert_menu(row)}
	});
}

function insert_menu(row){
	$('#so_id').val(row.so_id);
	$('#so_no').val(row.so_no);
	$('#so_date').datebox('setValue',row.so_date);
	$('#currency').val(row.currency);
	$('#cust').val(row.cust);	
	$('#due_date').datebox('setValue',row.due_date);
	$('#notes').val(row.notes);	
	setdg();
	$('#toolbar2').hide();
	$('#wCari').dialog('close');
	$('#tl1Ubh').show();
	$('#tl1Tbh').hide();	
	$('#tl1Hps').show();
	$('#btnPrint').show();		
}

function insert_det(row){
	$('#PartNo').val(row.PartNo);
	$('#NmBarang2').val(row.NmBarang2);
	$('#Sat2').val(row.Sat2);
}

function topdf(){
	var so_id = $('#so_id').val();	
	
	openurl('<?=$basedir?>material/so_pdf.php?NmMenu=<?=$NmMenu?>&so_id='+so_id);
}
</script>	