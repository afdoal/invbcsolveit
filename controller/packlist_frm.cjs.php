<script type="text/javascript">
$(function(){	


$('#w').dialog({ 
	title:"<?php echo strtoupper($NmMenu) ?>", 
    width:750,
	height:400,
	left:0,  
	top:0, 
	collapsible:false,
	minimizable:false,
	maximizable:false,
	toolbar:"#toolbar1"
}); 

$('#fromct').numberbox({  
    min:0, 
	precision:2, 
	groupSeparator:',',
	decimalSeparator:'.',
	onChange:function(newValue,oldValue){
		toct=Number($('#toct').numberbox('getValue'));
		qty=Number($('#qty').numberbox('getValue'));
		setAmount(newValue,toct,qty);
	}
});

$('#toct').numberbox({  
    min:0, 
	precision:2, 
	groupSeparator:',',
	decimalSeparator:'.',
	onChange:function(newValue,oldValue){
		fromct=$('#fromct').numberbox('getValue');
		qty=$('#qty').numberbox('getValue');
		setAmount(fromct,newValue,qty);
	}
});

$('#qty').numberbox({  
    min:0, 
	precision:2, 
	groupSeparator:',',
	decimalSeparator:'.',
	onChange:function(newValue,oldValue){
		fromct=$('#fromct').numberbox('getValue');
		toct=$('#toct').numberbox('getValue');
		setAmount(fromct,toct,newValue);
	}
});

$('#amount').numberbox({  
    min:0, 
	precision:2, 
	groupSeparator:',',
	decimalSeparator:'.'
});

$('#comm_no').combogrid({  
	panelWidth:500,  	
	url: '<?php echo $basedir; ?>models/material/packlist_grid.php?req=comm',  
	idField:'comm_no',  
	textField:'comm_no',  
	mode:'remote',  
	fitColumns:true,  
	columns:[[  
		{field:'comm_no',title:'Comm. Inv. No.',width:50},
		{field:'comm_date',title:'Comm. Inv. Date',width:50},
		{field:'cust',title:'Customer',width:50}
	]],
	onClickRow:function(index,row){insert_ref(row)}  
}); 
	
setdg();
dsInput();
$('#pack_date').combo('disable');
$('#due_date').combo('disable');
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
	$('#pack_id').val('<?php echo $newId ?>');
	$('#tl1Tbh').hide();
	$('#tl1Sim').show();
	$('#tl1Btl').show();
	$('#tl1Cri').hide();
	
	$('#toolbar2').show();
	
	enInput();
	$('#pack_date').datebox('enable');
	$('#comm_no').combogrid('enable');
	$('#due_date').datebox('enable');
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
	setComboGrid();
	$('#Sat2').attr('disabled',true);
	
});

$('#tl1Sim').click(function(){	
	var rows = $('#dg').datagrid('getRows');
	
	try {
	if ($('#pack_no').val() == ''){	
		throw "pack_no-Pack. List No.";
	} else if ($('#pack_date').datebox('getValue') == ''){ 
		throw "pack_date-Pack. List Date";
	} else if ($('#comm_id').val() == ''){	
		throw "comm_no-Comm. Inv. No.";
	} else if (rows.length == 0){
		throw "pack_no-Finished Goods List";	
	} else {
		//FORM LIST BARANG
		nolist_val="";	
		KdBarang2_val="";
		fromct_val="";
		toct_val="";
		qty_val="";
		amount_val="";
		remark_val="";
		j=1;
		
		for(var i=0; i<rows.length; i++){
			nolist_val += j+i + "`";		
			KdBarang2_val += rows[i].KdBarang2 + "`";
			fromct_val += rows[i].fromct + "`";
			toct_val += rows[i].toct + "`";
			qty_val += rows[i].qty.replace(",","") + "`";
			amount_val += rows[i].amount.replace(",","") + "`";
			remark_val += rows[i].remark + "`";
		}	 	
		//AKHIR FORM LIST BARANG
				
		$.post("<?php echo $basedir ?>models/material/packlist_tuh.php", { 
		aksi: $('#aksi').val(), 
		pack_id: $('#pack_id').val(),
		pack_no: $('#pack_no').val(),
		pack_date: $('#pack_date').datebox('getValue'),
		comm_id: $('#comm_id').val(),
		size: $('#size').val(),
		notes: $('#notes').val(),
		
		//FORM LIST DATA BARANG	
		nolist:nolist_val,KdBarang2:KdBarang2_val,
		fromct:fromct_val,toct:toct_val,qty:qty_val,
		amount:amount_val,remark:remark_val
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
			$.post("<?php echo $basedir ?>models/material/packlist_tuh.php", { 
			aksi: $('#aksi').val(), 
			pack_id: $('#pack_id').val()
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
				HsNo2: $('#HsNo2').val(),	
				Sat2: $('#Sat2').val(),
				fromct: nformat2($('#fromct').numberbox('getValue'),2),
				toct: nformat2($('#toct').numberbox('getValue'),2),
				qty: nformat2($('#qty').numberbox('getValue'),2),
				amount: nformat2($('#amount').numberbox('getValue'),2),
				remark: $('#remark').val()
				}
		});
	}
});

$('#tl2Sim').click(function(){
	$('#dlg').dialog('close');
	$('#dg').datagrid('appendRow',{		
		KdBarang2: $('#KdBarang2').combogrid('getValue'),
		HsNo2: $('#HsNo2').val(),
		Sat2: $('#Sat2').val(),
		fromct: nformat2($('#fromct').numberbox('getValue'),2),
		toct: nformat2($('#toct').numberbox('getValue'),2),
		qty: nformat2($('#qty').numberbox('getValue'),2),
		amount: nformat2($('#amount').numberbox('getValue'),2),
		remark: $('#remark').val()
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