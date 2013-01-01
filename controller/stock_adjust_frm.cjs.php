<script type="text/javascript">
$(function(){	



$('#w').dialog({ 
	title:"<?php echo strtoupper($NmMenu) ?>", 
    width:750,
	height:475,
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

$('#qty').numberbox({  
    min:0, 
	precision:2, 
	groupSeparator:',',
	decimalSeparator:'.'/*,
	onChange:function(newValue,oldValue){
		price=$('#price').numberbox('getValue');
		amount = newValue*price;
		$('#amount').numberbox('setValue',amount);
	}*/
});
/*
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
});*/
	
setdg();
dsInput();
$('#tl1Sim').hide();
$('#tl1Btl').hide(); 

$('#bulan').change(function(){
	setdg();
});

$('#tahun').change(function(){
	setdg();
});

$('#wh_id').change(function(){
	setdg();
});
 
//START TOOLBAR1 
$('#tl1Tbh').click(function(){
	$('#aksi').val('t');
	$('#opname_id').val('<?php echo $newId ?>');
	$('#tl1Tbh').hide();
	$('#tl1Sim').show();
	$('#tl1Btl').show();
	$('#tl1Cri').hide();
	
	$('#toolbar2').show();
	
	enInput();
	$('#date').datebox('enable');
	$('#KdBarang2').combogrid('enable');
	$('#Sat2').attr('disabled',true);
});

$('#tl1Sim').click(function(){
	simpan();	
});

$('#tl1Btl').click(function(){
	location.reload(true);
});


$('#btnSubmit1').click(function(){
	simpan();
});
//END TOOLBAR1

//START TOOLBAR2
$('#tl2Load').click(function(){
	loaddg();
});

$('#tl2Reset').click(function(){
	$('#dg').datagrid('selectAll');
	var rows = $('#dg').datagrid('getSelections');
	if (rows){
		for(var i=0; i<rows.length; i++){
			var index = $('#dg').datagrid('getRowIndex', rows[i]);
			$('#dg').datagrid('deleteRow', index);
		}
	}
});
//END TOOLBAR2

});//Akhir Document Ready
</script>