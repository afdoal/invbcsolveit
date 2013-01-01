<script type="text/javascript">
$(function(){
	
$('#w').window({ 
	title:"FORM <?php echo strtoupper($NmMenu) ?>", 
    width:770,
	height:700,	
	top:0,
	left:0,	
	collapsible:false,
	minimizable:false,
	maximizable:false
}); 	
	

$('#wCari').window({ 
	title:"Cari <?php echo $NmMenu ?>", 
    width:600,
	height:350,
	closed:true,
	modal:true, 
	collapsible:false,
	minimizable:false,
	maximizable:false
}); 

$('.easyui-numberbox').css('text-align', 'right');
$('#CAR').mask("999.999");
$('#NoDaf').mask("999.999");
dsInput();
			  
$('#btnTbh').click(function(){	 	
	//$('#pilmatinoutdo').show();	
	$('#piltujuan').show();
	dsbtnTbh();
	enbtnSim();	
	enbtnBtl();	
	enInput();
	setdg();
	setdg2();
	setdgPetiKemas();	
	$('#KdKpbcTuj').focus();
	$('#ref_id').combogrid({disabled:false});	
	$('#KdBarang').attr("disabled",true);
});
 
$('#btnUbh').click(function(){
	enbtnSim();			
	dsbtnHps();
	
	enInput();	
	$('#ref').show();
	$('#KdBarang').attr("disabled",true);
});
  
$('#btnSim').click(function(){
	btnSim();
});

$('#btnBtl').click(function(){
	location.reload(true);
});

$('#btnHps').click(function () {
if ($('#fhidden').val() != '') {
	$.messager.confirm('Confirm','Are you sure you want to delete record?',function(r){  
		if (r){ 
			$.post("<?php echo $basedir ?>models/hps_bc.php", { 
			CAR: $('#fhidden').val(),
			DokKdBc: 1
			},function(data){
				$.messager.alert('Warning',data); 
				location.reload(true);
			});
		}
	}); 	
} else {
	$.messager.alert('Warning','Silahkan pilih data yang akan di hapus!');
}
});

$('#tl2Tbh').click(function(){
	$('#tl2Sim').show();
	$('#tl2Ubh2').hide();
	tl2Tbh();
});

$('#tl2Ubh').click(function(){
	$('#tl2Sim').hide();
	$('#tl2Ubh2').show();
	tl2Ubh();
});

$('#tl2Ubh2').click(function(){
	tl2Ubh2();
	$('#dlgBarang').dialog('close');
});

$('#tl2Hps').click(function(){
	tl2Hps();
});

$('#tl2Sim').click(function(){
	tl2Sim();
	$('#dlgBarang').dialog('close');
});

$('#BM').change(function(){
	totJaminan()
});

$('#Cukai').change(function(){
	totJaminan()
});

$('#PPN').change(function(){
	totJaminan()
});

$('#PPnBM').change(function(){
	totJaminan()
});

$('#PPh').change(function(){
	totJaminan()
});

$('#PNBP').change(function(){
	totJaminan()
});

$('#BM2').change(function(){
	totJaminanH()
});

$('#Cukai2').change(function(){
	totJaminanH()
});

$('#PPN2').change(function(){
	totJaminanH()
});

$('#PPnBM2').change(function(){
	totJaminanH()
});

$('#PPh2').change(function(){
	totJaminanH()
});

$('#PNBP2').change(function(){
	totJaminanH()
});

$('#btnCri').click(function(){
	$('#wCari').window('open');
	setdgCari();
});

$('#NmTuj').change(function(){
	$('#ref_id').combogrid({
		url: '<?php echo $basedir ?>models/bc23/bc23_grid.php?req=inhdr&NmTuj='+$('#NmTuj').val(),  
		disabled:false
	});
});

$('#KdBarang').change(function(){
	setUrBarang();
});


	$('#ref_id').combogrid({  
		panelWidth:500,  	
		width:150,
		idField:'matin_id',  
		textField:'matin_no',  
		url: '<?php echo $basedir ?>models/bc23/bc23_grid.php?req=inhdr',  
		mode:'remote',  
		rownumbers:true,
		fitColumns:true,
		pagination:true,
		pageList:[25,50,75,100],   
		columns:[[  
			{field:'matin_no',title:'Incoming No.',width:60},
			{field:'matin_date',title:'Incoming Date',width:50},
			{field:'supplier',title:'Supplier',width:50}
		]],
		onClickRow:function(index,row){setdg2Url(row)}  
	});

    
});//Akhir Document Ready
</script>