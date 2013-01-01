<script type="text/javascript">   
function setdg(){
	var bln = $('#bulan').val();
	var thn = $('#tahun').val();
	var wh_id = $('#wh_id ').val();
	$('#dg').datagrid({  	
		title:"Material List",
		width:700,
		height:280,	
		toolbar:"#toolbar2",
		fitColumns:"true",
		rownumbers:"true",
		columns:[[  
			{field:'KdBarang2',title:'Code',width:80},
			{field:'NmBarang2',title:'Name',width:150},
			{field:'Ket',title:'Specification',width:150},
			{field:'Sat2',title:'Unit',width:80},
			{field:'qty_bal',title:'Qty. Balance',width:100,align:'right'},
			{field:'qty',title:'Qty. Opname',width:100,align:'right'}
		]],
		url: '<?php echo $basedir; ?>models/material/stock_adjust_grid.php?req=list2&bln='+bln+'&thn='+thn+'&wh_id='+wh_id
	});
}

function loaddg(){
	var bln = $('#bulan').val();
	var thn = $('#tahun').val();
	var wh_id = $('#wh_id ').val();
	$('#dg').datagrid({  	
		title:"Material List",
		width:700,
		height:280,	
		toolbar:"#toolbar2",
		fitColumns:"true",
		rownumbers:"true",
		columns:[[  
			{field:'KdBarang2',title:'Code',width:80},
			{field:'NmBarang2',title:'Name',width:150},
			{field:'Ket',title:'Specification',width:150},
			{field:'Sat2',title:'Unit',width:80},
			{field:'qty_bal',title:'Qty. Balance',width:100,align:'right'},
			{field:'qty',title:'Qty. Opname',width:100,align:'right'}
		]],
		url: '<?php echo $basedir; ?>models/material/stock_adjust_grid.php?req=load&bln='+bln+'&thn='+thn+'&wh_id='+wh_id
	});
	<?php /*openurl('<?php echo $basedir; ?>models/material/stock_adjust_grid.php?req=load&bln='+bln+'&thn='+thn+'&wh_id='+wh_id);**/?>
}

function insert_menu(row){
	$('#opname_id').val(row.opname_id);
	$('#opname_date').datebox('setValue',row.opname_date);
	$('#wh_id').val(row.wh_id);
	$('#notes').val(row.notes);	
	setdg();
	$('#wCari').dialog('close');
	$('#tl1Ubh').show();
	$('#tl1Tbh').hide();	
	$('#tl1Hps').show();
}

function insert_det(row){
	//$('#PartNo').val(row.PartNo);
	$('#NmBarang2').val(row.NmBarang2);
	$('#Sat2').val(row.Sat2);
}

function simpan(){
	var rows = $('#dg').datagrid('getRows');
	
	try {
	if ($('#bulan').val() == ''){ 
		throw "bulan-Month Period";
	} else if ($('#tahun').val() == ''){	
		throw "tahun-Year Period";	
	} else if ($('#wh_id').val() == ''){	
		throw "wh_id-Warehouse";
	} else if (rows.length == 0){
		throw "opname_id-Material List";	
	} else {
		//FORM LIST BARANG
		nolist_val="";	
		KdBarang2_val="";
		qty_bal_val="";
		qty_val="";
		j=1;
		for(var i=0; i<rows.length; i++){
			nolist_val += j+i + "`";		
			KdBarang2_val += rows[i].KdBarang2 + "`";
			qty_bal_val += rows[i].qty_bal.replace(",","") + "`";
			qty_val += rows[i].qty.replace(",","") + "`";
		}	 	
		//AKHIR FORM LIST BARANG
				
		$.post("<?php echo $basedir ?>models/material/stock_adjust_tuh.php", { 
		aksi: $('#aksi').val(), 
		opname_id: $('#opname_id').val(),
		bulan: $('#bulan').val(),
		tahun: $('#tahun').val(),
		wh_id: $('#wh_id').val(),
				
		//FORM LIST DATA BARANG	
		nolist:nolist_val,KdBarang2:KdBarang2_val,
		qty_bal:qty_bal_val,qty:qty_val
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
</script>	