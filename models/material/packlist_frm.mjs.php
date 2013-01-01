<script type="text/javascript">   
function setdg(){
	var pack_id = $('#pack_id').val();

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
			{field:'fromct',title:'From',width:80,align:'right'},
			{field:'toct',title:'To',width:80,align:'right'},
			{field:'qty',title:'Qty.',width:100,align:'right'},
			{field:'amount',title:'Amount',width:100,align:'right'},
			{field:'remark',title:'Remark',width:100}
		]],
		url: '<?php echo $basedir; ?>models/material/packlist_grid.php?req=list&pack_id='+pack_id
	});
}

function setdgUrl(){
	var comm_id = $('#comm_id').val();
	
	$('#dg').datagrid({ 
		url: '<?php echo $basedir; ?>models/material/packlist_grid.php?req=dgDet&comm_id='+comm_id	
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
			{field:'pack_no',title:'Pack. List No.',width:60},
			{field:'pack_date',title:'Pack. List Date',width:50},
			{field:'comm_no',title:'Comm. Inv. No.',width:50},
			{field:'cust',title:'Customer',width:50}
		]],
		url: '<?php echo $basedir ?>models/material/packlist_grid.php?req=menu&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(),
		onClickRow:function(index,row){insert_menu(row)}
	});
}

function insert_menu(row){
	$('#pack_id').val(row.pack_id);
	$('#pack_no').val(row.pack_no);
	$('#pack_date').datebox('setValue',row.pack_date);
	$('#comm_id').val(row.comm_id);
	$('#comm_no').combogrid('setValue',row.comm_no);
	$('#size').val(row.size);
	$('#notes').val(row.notes);
	setdg();
	$('#wCari').dialog('close');
	$('#tl1Ubh').show();
	$('#tl1Tbh').hide();	
	$('#tl1Hps').show();	
}

function setComboGrid(){	
	var comm_id = $('#comm_id').val();
	
	$('#KdBarang2').combogrid({  
		panelWidth:500,  	
		url: '<?php echo $basedir; ?>models/material/packlist_grid.php?req=dgDet&comm_id='+comm_id,  
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
	$('#comm_id').val(row.comm_id);	
	setdgUrl();
	setComboGrid();
}

function insert_det(row){
	$('#HsNo2').val(row.HsNo2);
	$('#Sat2').val(row.Sat2);
	$('#qty').numberbox('setValue',row.qty);
}

function setAmount(from,to,qty){
	amount = (Number(from)+Number(to)-1)*Number(qty);
	//alert(from+' '+to+' '+qty+' '+amount);
	$('#amount').numberbox('setValue',amount);
}
</script>	