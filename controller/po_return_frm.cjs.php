<script type="text/javascript">
$(function(){	

$('#w').dialog({ 
	title:"<?php echo strtoupper($NmMenu) ?>", 
    width:750,
	height:525,
	left:0,  
	top:0, 
	collapsible:false,
	minimizable:false,
	maximizable:false,
	toolbar:"#toolbar1"
}); 

/*$('#tot_qty').numberbox({  
    min:0, 
	precision:2, 
	groupSeparator:',',
	decimalSeparator:'.',
});

$('#tot_amount').numberbox({  
    min:0, 
	precision:2, 
	groupSeparator:',',
	decimalSeparator:'.',
});*/

$('#ppn').numberbox({  
    min:0, 
	precision:2, 
	groupSeparator:',',
	decimalSeparator:'.',
});

$('#qty').numberbox({  
    min:0, 
	precision:2, 
	groupSeparator:',',
	decimalSeparator:'.',
	onChange:function(newValue,oldValue){
		price=$('#price').numberbox('getValue');
		amount = newValue*price;
		$('#amount').numberbox('setValue',amount);
	}
});

$('#price').numberbox({  
    min:0, 
	precision:2, 
	groupSeparator:',',
	decimalSeparator:'.',
	onChange:function(newValue,oldValue){
		qty=$('#qty').numberbox('getValue');
		amount = newValue*qty;
		$('#amount').numberbox('setValue',amount);
	}
});

$('#amount').numberbox({  
    min:0, 
	precision:2, 
	groupSeparator:',',
	decimalSeparator:'.',
});

$('#ref_no').combogrid({  
	panelWidth:500,  	
	url: '<?php echo $basedir; ?>models/material/po_return_grid.php?req=dgRef',  
	idField:'po_no',  
	textField:'po_no',  
	mode:'remote',  
	fitColumns:true,  
	columns:[[  
		{field:'po_no',title:'PO No.',width:50},
		{field:'po_date',title:'PO Date',width:50},
		{field:'supplier',title:'Seller',width:80},
		{field:'dlv_date',title:'Dlv Date',width:50}
	]],
	onClickRow:function(index,row){insert_ref(row);}  
}); 
	
setdg();
dsInput();
$('#date').combo('disable');
$('#pilcari').attr('disabled',false);
$('#txtcari').attr('disabled',false);
$('#toolbar2').hide();
$('#toolCari').hide();
$('#tl1Ubh').hide();
$('#tl1Hps').hide();
$('#tl1Sim').hide();
$('#tl1Btl').hide();  

$('#dlg').dialog({ 
	title:"<?php echo strtoupper($NmMenu) ?>", 
    width:400,
	height:300,
	closed:true,
	buttons:"#dlg-buttons"
}); 

$('#wCari').dialog({ 
	title:"Cari <?php echo $NmMenu ?>", 
    width:600,
	height:350,
	closed:true,
	modal:true, 
	collapsible:false,
	minimizable:false,
	maximizable:false,
	toolbar:"#dlgtool"
}); 
 
//START TOOLBAR1 
$('#tl1Tbh').click(function(){
	$('#aksi').val('t');	
	$('#tl1Tbh').hide();
	$('#tl1Sim').show();
	$('#tl1Btl').show();
	$('#tl1Cri').hide();
	
	$('#toolbar2').show();
	
	enInput();
	$('#date').datebox('enable');
	$('#ref_no').combogrid('enable');
	$('#Sat2').attr('disabled',true);
});

$('#tl1Ubh').click(function(){
	$('#aksi').val('u');
	$('#tl1Ubh').hide();
	$('#tl1Sim').show();
	$('#tl1Btl').show();
	$('#tl1Cri').hide();
	
	enInput();
	$('#date').datebox('enable');
	setcomboGridUbh()
	setComboGrid();
	$('#Sat2').attr('disabled',true);	
});

$('#tl1Sim').click(function(){
	var rows = $('#dg').datagrid('getRows');
	
	try {
	if ($('#po_no').val() == ''){	
		throw "po_no-PO No.";
	} else if ($('#po_date').datebox('getValue') == ''){ 
		throw "po_date-PO Date";
	} else if ($('#currency').val() == ''){	
		throw "currency-Currency";
	} else if ($('#ref_id').val() == ''){	
		throw "ref_no-Ref No";
	} else if ($('#supplier').val() == ''){	
		throw "supplier-Seller";
	} else if ($('#dlv_date').datebox('getValue') == ''){ 
		throw "dlv_date-Delivery Date";	
	} else if (rows.length == 0){
		throw "po_no-Finished Goods List";	
	} else {
		//FORM LIST BARANG
		nolist_val="";	
		KdBarang2_val="";
		qty_val="";
		price_val="";
		j=1;
		for(var i=0; i<rows.length; i++){
			nolist_val += j+i + "`";		
			KdBarang2_val += rows[i].KdBarang2 + "`";
			qty_val += rows[i].qty.replace(",","") + "`";
			price_val += rows[i].price.replace(",","") + "`";
		}	 	
		//AKHIR FORM LIST BARANG
				
		$.post("<?php echo $basedir ?>models/material/po_return_tuh.php", { 
		aksi: $('#aksi').val(), 
		po_id: $('#po_id').val(),
		po_no: $('#po_no').val(),
		po_date: $('#po_date').datebox('getValue'),
		currency: $('#currency').val(),
		ref_id: $('#ref_id').val(),
		ref_no: $('#ref_no').combogrid('getValue'),
		supplier: $('#supplier').val(),
		ppn: $('#ppn').numberbox('getValue'),
		attn: $('#attn').val(),
		terms: $('#terms').val(),
		spec: $('#spec').val(),
		width_tol: $('#width_tol').val(),
		thick_tol: $('#thick_tol').val(),
		Wrmax: $('#Wrmax').val(),		
		notes: $('#notes').val(),
		dlv_date: $('#dlv_date').datebox('getValue'),
		wh_id: $('#wh_id').val(),		
		remark: $('#remark').val(),
		auth_sign: $('#auth_sign').val(),		
		
		//FORM LIST DATA BARANG	
		nolist:nolist_val,KdBarang2:KdBarang2_val,
		qty:qty_val,price:price_val
		},
		function(result){
			var result = eval('('+result+')');
			if (result.success){
				$('#dg').datagrid('reload');	// reload the user data
				$.messager.alert('Info',result.msg); 
				location.reload(true);		
			} else {
				$.messager.alert('Error',result.msg); 
			}			
			
		});
	}//Akhir If Validasi
	} catch(err) {	
		if (err.toSource().indexOf("-") == -1){
			alert(err);
		} else {
			str = err.split("-");
			
			alert("Please input "+str[1]+" first!");
			$('#'+str[0]).focus();
		}
	}
	
});

$('#tl1Hps').click(function(){
	$('#aksi').val('h');
	$.messager.confirm('Confirm','Are you sure you want to delete this data?',function(r){  
		if (r){
			$.post("<?php echo $basedir ?>models/material/po_return_tuh.php", { 
			aksi: $('#aksi').val(), 
			po_id: $('#po_id').val()
			},
			function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#dg').datagrid('reload');	// reload the user data
					$.messager.alert('Info',result.msg); 
					location.reload(true);		
				} else {
					$.messager.alert('Error',result.msg); 
				}			
			});//Akhir If Post
		}
	});//Akhir If yakin?
});

$('#tl1Cri').click(function(){	
	$('#wCari').dialog('open');
	setdgCari();
});

$('#tl1Btl').click(function(){
	location.reload(true);
});


$('#btnSubmit1').click(function(){
	simpan();
});
//END TOOLBAR1

//START TOOLBAR2
$('#tl2Tbh').click(function(){
	$('#tl2Sim').show();
	$('#tl2Ubh2').hide();
	
	$('#dlg').dialog('open').dialog('setTitle','Tambah <?php echo $NmMenu ?>');
	$('#fm2').form('clear');
});

$('#tl2Ubh').click(function(){
	$('#tl2Sim').hide();
	$('#tl2Ubh2').show();
	
	var row = $('#dg').datagrid('getSelected');
	if (row){
		$('#dlg').dialog('open').dialog('setTitle','Ubah <?php echo $NmMenu ?>');
		$('#fm2').form('load',row);
	}
});

$('#tl2Ubh2').click(function(){
	$('#dlg').dialog('close');
	var row = $('#dg').datagrid('getSelected');
	if (row){
		var index = $('#dg').datagrid('getRowIndex', row);
		$('#dg').datagrid('updateRow',{
			index: index, 
			row: { 
				KdBarang2: $('#KdBarang2').combogrid('getValue'),
				NmBarang2: $('#NmBarang2').val(),	
				Sat2: $('#Sat2').val(),
				qty: nformat2($('#qty').numberbox('getValue'),2),
				price: nformat2($('#price').numberbox('getValue'),2),
				amount: nformat2($('#amount').numberbox('getValue'),2)
				}
		});
	}
});

$('#tl2Sim').click(function(){
	$('#dlg').dialog('close');
	$('#dg').datagrid('appendRow',{		
		KdBarang2: $('#KdBarang2').combogrid('getValue'),
		NmBarang2: $('#NmBarang2').val(),
		Sat2: $('#Sat2').val(),
		qty: nformat2($('#qty').numberbox('getValue'),2),
		price: nformat2($('#price').numberbox('getValue'),2),
		amount: nformat2($('#amount').numberbox('getValue'),2)
	});
});

$('#tl2Hps').click(function(){
	var row = $('#dg').datagrid('getSelected');
	if (row){
		var index = $('#dg').datagrid('getRowIndex', row);
		$('#dg').datagrid('deleteRow', index);
	}
});

$('#btnSubmit2').click(function(){
	tl2Sim();
});

$('#tl2Reset').click(function(){
	$('#fm2').form('clear');
});
//END TOOLBAR2

//START DLGTOOL
$('#dtlCri').click(function(){
	setdgCari();
});
//END DLGTOOL

});//Akhir Document Ready
</script>