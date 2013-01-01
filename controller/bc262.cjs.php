<script type="text/javascript">
$(function(){

$('#w').window({ 
	title:"FORM <?php echo strtoupper($NmMenu) ?>", 
    width:770,
	height:515,	
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
			  
$('#btnTbh').click(function(){	 	
	//$('#pilmatinoutdo').show();	
	$('#piltujuan').show();
	dsbtnTbh();
	enbtnSim();	
	enbtnBtl();				
	
	enInput();
	setdg();
	setdg2();
	setdg3();
	
	$('#NmTuj').focus();
	$('#KdBarang').attr("disabled",true);	
});
 
$('#btnUbh').click(function(){
	$('#pilmatinoutdo').show();
	$('#piltujuan').show();
	enbtnSim();			
	dsbtnHps();
	
	enInput();	
	enTgl();
	$('#ref_id').combogrid({disabled:false});
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
				DokKdBc: 5
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

$('#BM').numberbox({ 
	onChange:function(a,b){ totJaminan();}
});

$('#Cukai').numberbox({ 
	onChange:function(a,b){ totJaminan();}
});

$('#PPN').numberbox({ 
	onChange:function(a,b){ totJaminan();}
});

$('#PPnBM').numberbox({ 
	onChange:function(a,b){ totJaminan();}
});

$('#PPh').numberbox({ 
	onChange:function(a,b){ totJaminan();}
});  

$('#tl3Tbh').click(function(){
	$('#tl3Sim').show();
	$('#tl3Ubh2').hide();
	tl3Tbh();
});

$('#tl3Ubh').click(function(){
	$('#tl3Sim').hide();
	$('#tl3Ubh2').show();
	tl3Ubh();
});

$('#tl3Ubh2').click(function(){
	tl3Ubh2();
	$('#dlgBarang2').dialog('close');
});

$('#tl3Hps').click(function(){
	tl3Hps();
});

$('#tl3Sim').click(function(){
	tl3Sim();
	$('#dlgBarang2').dialog('close');
});

$('#btnCri').click(function(){
	$('#wCari').window('open');
	setdgCari();
});

$('#NmTuj').change(function(){
	$('#ref_id').combogrid({
		url: '<?php echo $basedir ?>models/bc262/bc262_grid.php?req=inhdr&NmTuj='+$('#NmTuj').val(),  
		disabled:false
	});	
});

$('#KdBarang').change(function(){
	setUrBarang("KdBarang","UrBarang");
});

$('#KdBarang2').change(function(){
	setUrBarang("KdBarang2","UrBarang2");
});

$('.easyui-numberbox').css('text-align', 'right');
$('#CAR').mask("999.999");
$('#NoDaf').mask("999.999");
dsInput();
$('#dtdari').datebox({disabled:false});
$('#dtsampai').datebox({disabled:false});


		$('#ref_id').combogrid({  
		panelWidth:500, 
		width:150, 	
		idField:'matin_id',  
		textField:'matin_no',  
		url: '<?php echo $basedir ?>models/bc262/bc262_grid.php?req=inhdr',  
		mode:'remote',  
		rownumbers:true,
		fitColumns:true,
		pagination:true,
		pageList:[25,50,75,100],   
		columns:[[ 
			{field:'matin_no',title:'Incoming No.',width:50},
			{field:'matin_date',title:'Incoming Date',width:50},
			{field:'supplier',title:'Supplier',width:80},
		]],
		onClickRow:function(index,row){setdg2Url(row)}  
	});


    
});//Akhir Document Ready
</script>