<script type="text/javascript">   
function setdg(){
	var do_id = $('#do_id').val();

	$('#dg').datagrid({  	
		title:"Finished Goods List",
		width:700,
		height:200,	
		toolbar:"#toolbar2",
		fitColumns:"true",
		rownumbers:"true",
		columns:[[  		
			{field:'KdBarang2',title:'Code',width:80},
			{field:'NmBarang2',title:'Name',width:150},
			{field:'Ket',title:'Specification',width:150},
			{field:'Sat2',title:'Unit',width:60},
			{field:'weight',title:'Weight',width:100,align:'right'},
			{field:'qty',title:'Qty.',width:100,align:'right'},
			{field:'price',title:'Price',width:100,align:'right'},
			{field:'amount',title:'Amount',width:100,align:'right',formatter:function(value){
				amount=parseFloat(value);
				amount=amount.toFixed(4);
				return amount;
			}}
		]],
		url: '<?php echo $basedir; ?>models/material/do_grid.php?req=list&do_id='+do_id
	});
}

function setdgUrl(){
	var so_id = $('#so_id').val();
	var do_id = $('#do_id').val();
	$('#dg').datagrid({ 		
		url: '<?php echo $basedir; ?>models/material/do_grid.php?req=dgDet&so_id='+so_id+'&do_id='+do_id	
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
			{field:'matout_no',title:'DO No.',width:60},
			{field:'matout_date',title:'DO Date',width:50},
			{field:'ref_no',title:'PO Cust. No.',width:50},
			{field:'cust',title:'Customer',width:50}
		]],
		url: '<?php echo $basedir ?>models/material/do_grid.php?req=menu&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(),
		onClickRow:function(index,row){insert_menu(row)}
	});
}

function insert_menu(row){
	$('#do_id').val(row.matout_id);
	$('#do_no').val(row.matout_no);
	$('#do_date').datebox('setValue',row.matout_date);
	$('#cust').val(row.cust);	
	$('#so_id').val(row.ref_id);
	$('#so_no').val(row.ref_no);	
	$('#vehicle_no').val(row.vehicle_no);
	$('#driver').val(row.driver);
	$('#KdJnsDok').val(row.KdJnsDok);
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
	
	$('#KdBarang2').combogrid({  
		panelWidth:500,  	
		url: '<?php echo $basedir; ?>models/material/do_grid.php?req=dgDetFirst',  
		idField:'KdBarang2',  
		textField:'KdBarang2',  
		mode:'remote',  
		rownumbers:true,
		fitColumns:true,
		pagination:true,
		pageList:[25,50,75,100],
		columns:[[  
			{field:'KdBarang2',title:'Code',width:60},
			{field:'NmBarang2',title:'Name',width:80},
			{field:'Ket',title:'Specification',width:80},
			{field:'Sat2',title:'Unit',width:50}
		]],
		onClickRow:function(index,row){insert_det(row)}  
	}); 
}


function insert_ref(row){
	$('#so_id').val(row.so_id);	
	setdgUrl();
	setComboGrid();
}

function insert_det(row){	
	$('#NmBarang2').val(row.NmBarang2);
	$('#Ket').val(row.Ket);
	$('#Sat2').val(row.Sat2);
	$('#qty').numberbox('setValue',row.qty);
	$('#price').numberbox('setValue',row.price);
}

function simpan(){
	var rows = $('#dg').datagrid('getRows');
	
	try {
	if ($('#do_no').val() == ''){	
		throw "do_no-DO No.";
	} else if ($('#do_date').datebox('getValue') == ''){ 
		throw "do_date-DO Date";
	//} else if ($('#so_id').val() == ''){	
		//throw "so_no-PO Cust. No.";
	} else if (rows.length == 0){
		throw "do_no-Finished Goods List";	
	} else {
		//FORM LIST BARANG
		nolist_val="";	
		KdBarang2_val="";
		weight_val="";
		qty_val="";
		price_val="";
		j=1;
		
		for(var i=0; i<rows.length; i++){
			nolist_val += j+i + "`";		
			KdBarang2_val += rows[i].KdBarang2 + "`";
			weight_val += rows[i].weight.replace(",","") + "`";
			qty_val += rows[i].qty.replace(",","") + "`";
			price_val += rows[i].price.replace(",","") + "`";
		}	 	
		//AKHIR FORM LIST BARANG
				
		$.post("<?php echo $basedir ?>models/material/do_tuh.php", { 
		aksi: $('#aksi').val(), 
		do_id: $('#do_id').val(),
		do_no: $('#do_no').val(),
		do_date: $('#do_date').datebox('getValue'),
		cust: $('#cust').val(),
		so_id: $('#so_id').val(),
		so_no: $('#so_no').val(),
		vehicle_no: $('#vehicle_no').val(),
		driver: $('#driver').val(),
		KdJnsDok: $('#KdJnsDok').val(),
		notes: $('#notes').val(),
		
		//FORM LIST DATA BARANG	
		nolist:nolist_val,KdBarang2:KdBarang2_val,
		weight:weight_val,qty:qty_val,price:price_val
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
	var do_id = $('#do_id').val();	
	
	openurl('<?=$basedir?>material/do_pdf.php?NmMenu=<?=$NmMenu?>&do_id='+do_id);
}

</script>	