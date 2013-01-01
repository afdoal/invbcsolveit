<script type="text/javascript">
$(function(){	
	

setdg();
$('#w').window({ 
	title:"<?php echo strtoupper($NmMenu) ?>", 
    width:750,
	height:550,
	left:0,  
	top:0, 
	collapsible:false,
	minimizable:false,
	maximizable:false
}); 
 
	
$('#btnTbh').click(function(){
	tambah();
});

$('#btnUbh').click(function(){
	ubah();
});

$('#btnHps').click(function(){
	hapus();
});

$('#btnSim').click(function(){
	simpan();
});

$('#btnPrint').click(function(){
	topdf();
});

$('#btnSubmit').click(function(){
	simpan();
});

$('#btnReset').click(function(){
	$('#fm').form('clear');
});



});//Akhir Document Ready
</script>