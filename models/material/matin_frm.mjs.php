<script type="text/javascript">   
function setdg(){
	var matin_id = $('#matin_id').val();
	
	$('#dg').datagrid({  	
		title:"Material List",
		width:700,
		height:200,	
		toolbar:"#toolbar2",
		fitColumns:"true",
		rownumbers:"true",
		columns:[[  
			{field:'KdBarang2',title:'Mat. Code',width:80},
			{field:'NmBarang2',title:'Mat. Name',width:150},
			{field:'Ket',title:'Specification',width:150},
			{field:'Sat2',title:'Unit',width:80},
			{field:'qty',title:'Qty.',width:100,align:'right'},
			{field:'price',title:'Price',width:100,align:'right'},
			{field:'amount',title:'Amount',width:100,align:'right'}
		]],
		url: '<?php echo $basedir; ?>models/material/matin_grid.php?req=list&matin_id='+matin_id
	});
}

function setdgUrl(){
	var po_id = $('#po_id').val();
	
	$('#dg').datagrid({  	
		url: '<?php echo $basedir; ?>models/material/matin_grid.php?req=dgDet&po_id='+po_id
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
			{field:'matin_no',title:'Incoming No.',width:50},
			{field:'matin_date',title:'Incoming Date',width:50},
			{field:'matin_name',title:'Incoming Type',width:50},
			{field:'supplier',title:'Supplier',width:80},
			
		]],
		url: '<?php echo $basedir ?>models/material/matin_grid.php?req=menu&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(),
		onClickRow:function(index,row){
			$('#matin_id').val(row.matin_id);
			$('#matin_type').val(row.matin_type);	
			$('#matin_no').val(row.matin_no);
			$('#matin_date').datebox('setValue',row.matin_date);
			insert_menu(row);			
			setdg();
			$('#toolbar2').hide();
		}	
			
	});
}

function setComboGrid(){
	$('#KdBarang2').combogrid({  
		panelWidth:500,  	
		url: '<?php echo $basedir; ?>models/material/matin_grid.php?req=dgDetFirst',  
		idField:'KdBarang2',  
		textField:'KdBarang2',  
		mode:'remote',  
		rownumbers:true,
		fitColumns:true,
		pagination:true,
		pageList:[25,50,75,100],    
		columns:[[  
			{field:'KdBarang2',title:'Mat. Code',width:60},
			{field:'NmBarang2',title:'Mat. Name',width:50},
			{field:'Ket',title:'Specification',width:50},
			{field:'Sat2',title:'Unit',width:50}
		]],
		onClickRow:function(index,row){insert_det(row)}  
	}); 	
	$('#KdBarang2').combogrid('enable');
}

function setcomboGridUbh(){
	$('#po_no').combogrid({  		
		onClickRow:function(index,row){insert_refUbh(row);}  
	});
}

function insert_menu(row){	
	$('#currency').val(row.currency);		
	$('#po_id').val(row.po_id);	
	$('#po_no').val(row.po_no);			
	$('#supplier').combogrid('setValue',row.supplier);
	$('#supl_do').val(row.supl_do);
	$('#supl_inv').val(row.supl_inv);
	$('#KdJnsDok').val(row.KdJnsDok);
	$('#notes').val(row.notes);
	
	$('#wCari').dialog('close');
	$('#tl1Ubh').show();
	$('#tl1Tbh').hide();	
	$('#tl1Hps').show();
	$('#btnPrint').show();
}

function insert_ref(row){
	insert_menu(row);
	$('#matin_id').val('<?php echo $newId ?>');
	setComboGrid();
	setdgUrl();
}

function insert_refUbh(row){
	insert_menu(row);
	setComboGrid();
	setdgUrl();	
}

function insert_det(row){
	$('#NmBarang2').val(row.NmBarang2);
	$('#Ket').val(row.Ket);
	$('#Sat2').val(row.Sat2);
	$('#qty').numberbox('setValue',row.qty);
	$('#price').numberbox('setValue',row.price);
	$('#amount').numberbox('setValue',row.amount);
}

function simpan(){
	var rows = $('#dg').datagrid('getRows');
	
	try {
	if ($('#matin_no').val() == ''){	
		throw "matin_no-Incoming No.";
	} else if ($('#matin_type').val() == ''){	
		throw "matin_type-Incoming Type";
	} else if ($('#matin_date').datebox('getValue') == ''){ 
		throw "matin_date-Incoming Date";
	/*} else if ($('#currency').val() == ''){	
		throw "currency-Currency";
	} else if ($('#supplier').val() == ''){	
		throw "supplier-Seller";*/
	} else if (rows.length == 0){
		throw "matin_no-Finished Goods List";	
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
				
		$.post("<?php echo $basedir ?>models/material/matin_tuh.php", { 
		aksi: $('#aksi').val(), 
		matin_id: $('#matin_id').val(),
		matin_type: $('#matin_type').val(),
		matin_no: $('#matin_no').val(),
		matin_date: $('#matin_date').datebox('getValue'),
		currency: $('#currency').val(),
		
		po_id: $('#po_id').val(),
		po_no: $('#po_no').val(),
		supplier: $('#supplier').combogrid('getValue'),
		supl_do: $('#supl_do').val(),
		supl_inv: $('#supl_inv').val(),
		KdJnsDok: $('#KdJnsDok').val(),
		notes: $('#notes').val(),	
		
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
}

function topdf(){
	var matin_id = $('#matin_id').val();	
	
	openurl('<?=$basedir?>material/matin_pdf.php?NmMenu=<?=$NmMenu?>&matin_id='+matin_id);
}

</script>	