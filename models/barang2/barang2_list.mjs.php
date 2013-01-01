<script type="text/javascript">   
function setdg(){
	$('#dg').datagrid({  	
		title:"",
		width:736,
		height:515,
		toolbar:"#toolCari",
		fitColumns:"true",
		rownumbers:"true",
		pagination:true,
		pageList:[25,50,75,100],
		columns:[[  
			{field:'KdBarang0',title:'Kode Barang0',width:80,hidden:true},
			{field:'KdBarang',title:'Code',width:80},
			{field:'NmBarang',title:'Name',width:80},
			{field:'Ket',title:'Specification',width:100},			
			{field:'HsNo',title:'HS No.',width:100},
			{field:'Sat',title:'Unit',width:80},
			{field:'cust',title:'Customer',width:100}
		]],
		url: '<?php echo $basedir; ?>models/barang2/barang2_grid.php?TpBarang=<?php echo $TpBarang; ?>&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val()
	});
	
}

function topdf(){
	openurl('<?=$basedir?>masterdata/barang2_pdf.php?NmMenu=<?=$NmMenu?>&TpBarang=<?=$TpBarang?>&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val());
}

</script>	