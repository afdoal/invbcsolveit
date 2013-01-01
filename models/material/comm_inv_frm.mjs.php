<script type="text/javascript">   
function setdg(){
	var comm_id = $('#comm_id').val();

	$('#dg').datagrid({  	
		title:"Finished Goods List",
		width:700,
		height:200,	
		toolbar:"#toolbar2",
		fitColumns:"true",
		rownumbers:"true",
		columns:[[  
			{field:'KdBarang2',title:'Name.',width:80},
			{field:'HsNo2',title:'HS No.',width:150},
			{field:'Sat2',title:'Unit',width:80},
			{field:'qty',title:'Qty.',width:100,align:'right'},
			{field:'price',title:'Price',width:100,align:'right'},
			{field:'amount',title:'Amount',width:100,align:'right'}
		]],
		url: '<?php echo $basedir; ?>models/material/comm_inv_grid.php?req=list&comm_id='+comm_id
	});
}

function setdgUrl(){
	var do_id = $('#do_id').val();
	
	$('#dg').datagrid({ 
		url: '<?php echo $basedir; ?>models/material/comm_inv_grid.php?req=dgDet&do_id='+do_id	
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
			{field:'comm_no',title:'Comm. Inv. No.',width:60},
			{field:'comm_date',title:'Comm. Inv. Date',width:50},
			{field:'do_no',title:'DO No.',width:50},
			{field:'cust',title:'Customer',width:50}
		]],
		url: '<?php echo $basedir ?>models/material/comm_inv_grid.php?req=menu&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(),
		onClickRow:function(index,row){insert_menu(row)}
	});
}

function insert_menu(row){
	$('#comm_id').val(row.comm_id);
	$('#comm_no').val(row.comm_no);
	$('#comm_date').datebox('setValue',row.comm_date);
	$('#do_id').val(row.do_id);
	$('#do_no').combogrid('setValue',row.do_no);
	$('#payment').val(row.payment);
	$('#pol').val(row.pol);
	$('#pod').val(row.pod);
	$('#container').val(row.container);
	$('#sail_date').datebox('setValue',row.sail_date);
	$('#currency').val(row.currency);
	$('#vessel').val(row.vessel);
	$('#voy_no').val(row.voy_no);
	$('#fob').numberbox('setValue',row.fob);
	$('#freight').numberbox('setValue',row.freight);
	$('#insurance').numberbox('setValue',row.insurance);
	$('#cnf').numberbox('setValue',row.cnf);	
	$('#notify').val(row.notify);
	$('#auth_sign').val(row.auth_sign);
	$('#notes').val(row.notes);
	setdg();
	$('#wCari').dialog('close');
	$('#tl1Ubh').show();
	$('#tl1Tbh').hide();	
	$('#tl1Hps').show();	
}

function setComboGrid(){	
	var do_id = $('#do_id').val();
	
	$('#KdBarang2').combogrid({  
		panelWidth:500,  	
		url: '<?php echo $basedir; ?>models/material/comm_inv_grid.php?req=dgDet&do_id='+do_id,  
		idField:'KdBarang2',  
		textField:'KdBarang2',  
		mode:'remote',  
		fitColumns:true,  
		columns:[[  
			{field:'KdBarang2',title:'Name.',width:60},
			{field:'HsNo2',title:'HS No.',width:50},
			{field:'Sat2',title:'Unit',width:50},
			{field:'qty',title:'Qty',width:50}
		]],
		onClickRow:function(index,row){insert_det(row)}  
	}); 
}


function insert_ref(row){
	$('#do_id').val(row.do_id);	
	setdgUrl();
	setComboGrid();
}

function insert_det(row){
	$('#HsNo2').val(row.HsNo2);
	$('#Sat2').val(row.Sat2);
	$('#qty').numberbox('setValue',row.qty);
}
</script>	