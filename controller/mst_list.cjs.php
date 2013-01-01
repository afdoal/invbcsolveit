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

$('#dtlCri').click(function(){
	setdg();
});

$('#btnPrint').click(function(){
	topdf();
});

});//Akhir Document Ready
</script>