<script type="text/javascript">   
function setdg(){
	var po_id = $('#po_id').val();
	
	$('#dg').datagrid({  	
		title:"Material List",
		width:700,
		height:200,	
		toolbar:"#toolbar2",
		fitColumns:"true",
		rownumbers:"true",
		columns:[[  
			{field:'KdBarang2',title:'Mat. Code',width:80},
			{field:'NmBarang2',title:'Desc.',width:150},
			{field:'Sat2',title:'Unit',width:80},
			{field:'qty',title:'Qty.',width:100,align:'right'},
			{field:'price',title:'Price',width:100,align:'right'},
			{field:'amount',title:'Amount',width:100,align:'right'}
		]],
		url: '<?php echo $basedir; ?>models/material/po_return_grid.php?req=list&po_id='+po_id
	});
}

function setdgUrl(){
	var po_id = $('#ref_id').val();
	
	$('#dg').datagrid({  	
		url: '<?php echo $basedir; ?>models/material/po_return_grid.php?req=list&po_id='+po_id
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
			{field:'po_no',title:'PO No.',width:50},
			{field:'po_date',title:'PO Date',width:50},
			{field:'supplier',title:'Seller',width:80},
			{field:'dlv_date',title:'Dlv Date',width:50},
			{field:'currency',title:'Currency',width:50}
		]],
		url: '<?php echo $basedir ?>models/material/po_return_grid.php?req=menu&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(),
		onClickRow:function(index,row){
			$('#po_id').val(row.po_id);
			$('#po_no').val(row.po_no);
			$('#po_date').datebox('setValue',row.po_date);
			insert_menu(row);
			$('#ref_no').combogrid('setValue',row.ref_no);
			setdg();
		}
	});
}

function setComboGrid(){
	$('#KdBarang2').combogrid({  
		panelWidth:500,  	
		url: '<?php echo $basedir; ?>models/material/po_return_grid.php?req=dgDet&po_id='+$('#ref_id').val(), 
		idField:'KdBarang2',  
		textField:'KdBarang2',  
		mode:'remote',  
		fitColumns:true,  
		columns:[[  
			{field:'KdBarang2',title:'Mat. Code',width:60},
			{field:'NmBarang2',title:'Desc.',width:50},
			{field:'Sat2',title:'Unit',width:50},
			{field:'qty',title:'Unit',width:50}
		]],
		onClickRow:function(index,row){insert_det(row)}  
	});
	$('#KdBarang2').combogrid('enable');
}

function setcomboGridUbh(){
	$('#ref_no').combogrid({  		
		onClickRow:function(index,row){insert_refUbh(row);}  
	});
}

function insert_menu(row){		
	$('#currency').val(row.currency);
	$('#ref_id').val(row.ref_id);
	$('#supplier').val(row.supplier),
	$('#ppn').numberbox('setValue',row.ppn),
	$('#attn').val(row.attn),
	$('#terms').val(row.terms),
	$('#spec').val(row.spec),
	$('#width_tol').val(row.width_tol),
	$('#thick_tol').val(row.thick_tol),
	$('#Wrmax').val(row.Wrmax),		
	$('#notes').val(row.notes),
	$('#dlv_date').datebox('setValue',row.dlv_date),
	$('#wh_id').val(row.wh_id),		
	$('#remark').val(row.remark),
	$('#auth_sign').val(row.auth_sign),	
	
	$('#wCari').dialog('close');
	$('#tl1Ubh').show();
	$('#tl1Tbh').hide();	
	$('#tl1Hps').show();
}

function insert_ref(row){
	insert_menu(row);
	$('#ref_id').val(row.po_id);
	$('#po_id').val('<?php echo $newId ?>');
	setComboGrid();
	setdgUrl();
}

function insert_refUbh(row){
	insert_menu(row);
	$('#ref_id').val(row.po_id);	
	setComboGrid();
	setdgUrl();
}

function insert_det(row){
	$('#NmBarang2').val(row.NmBarang2);
	$('#Sat2').val(row.Sat2);
	$('#qty').numberbox('setValue',row.qty);
	$('#price').numberbox('setValue',row.price);
	$('#amount').numberbox('setValue',row.amount);
}
</script>	