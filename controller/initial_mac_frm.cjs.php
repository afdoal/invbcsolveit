<script type="text/javascript">
$(function(){	

$('#qty').numberbox({  
    min:0, 
	precision:2, 
	groupSeparator:',',
	decimalSeparator:'.',
});
	
setdg();
dsInput();
$('#date').combo('disable');
$('#pilcari').attr('disabled',false);
$('#toolbar2').hide();
$('#toolCari').hide();
$('#tl1Ubh').hide();
$('#tl1Hps').hide();
$('#tl1Sim').hide();
$('#tl1Btl').hide();
$('#btnPrint').hide();

$('#w').dialog({ 
	title:"<?php echo strtoupper($NmMenu) ?>", 
    width:750,
	height:450,
	left:0,  
	top:0, 
	collapsible:false,
	minimizable:false,
	maximizable:false,
	toolbar:"#toolbar1"
});  

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
	//$('#KdBarang2').combogrid('enable');
	$('#Sat2').attr('disabled',true);
});

$('#tl1Ubh').click(function(){
	$('#aksi').val('u');
	$('#tl1Ubh').hide();
	$('#tl1Sim').show();
	$('#tl1Btl').show();
	$('#tl1Cri').hide();
	
	$('#toolbar2').show();
	
	enInput();
	$('#date').datebox('enable');
	$('#KdBarang2').combogrid('enable');
	$('#Sat2').attr('disabled',true);
	$('#btnPrint').hide();
});

$('#tl1Sim').click(function(){
	var rows = $('#dg').datagrid('getRows');
	
	try {
	if ($('#mat_type').val() == ''){	
		throw "mat_type-Mat. Type";
	} else if ($('#date').datebox('getValue') == ''){ 
		throw "date-Date";
	} else if (rows.length == 0){
		throw "mat_type-Initial Balance Machine & Office Equipment List";			
	} else {
		//FORM LIST BARANG
		nolist_val="";	
		KdBarang2_val="";
		qty_val="";
		j=1;		
		for(var i=0; i<rows.length; i++){
			nolist_val += j+i + "`";		
			KdBarang2_val += rows[i].KdBarang2 + "`";
			qty_val += rows[i].qty.replace(",","") + "`";
		}	 	
		//AKHIR FORM LIST BARANG
				
		$.post("<?php echo $basedir ?>models/initial_mac_tuh.php", { 
		aksi: $('#aksi').val(), 
		wh_id0: $('#wh_id0').val(),
		wh_id: $('#wh_id').val(),
		date0: $('#date0').val(),
		date: $('#date').datebox('getValue'),
		mat_type0: $('#mat_type0').val(),
		mat_type: $('#mat_type').val(),
		
		
		//FORM LIST DATA BARANG	
		nolist:nolist_val,KdBarang2:KdBarang2_val,
		qty:qty_val
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
			$.post("<?php echo $basedir ?>models/initial_mac_tuh.php", { 
			aksi: $('#aksi').val(), 
			wh_id0: $('#wh_id0').val(),
			date0: $('#date0').val(),
			mat_type0: $('#mat_type0').val()
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

$('#btnPrint').click(function(){
	topdf();
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
				qty: nformat2($('#qty').numberbox('getValue'),2)
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
		qty: nformat2($('#qty').numberbox('getValue'),2)
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

$('#mat_type').change(function(){
	setBarang();
});

});//Akhir Document Ready
</script>