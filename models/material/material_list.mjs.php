<script type="text/javascript">   
function setdg(){
	$('#dg').datagrid({  	
		title:"",
		width:736,
		height:515,
		toolbar:"#toolCari",
		rownumbers:"true",
		fitColumns:true,
		pagination:true,
		pageList:[25,50,75,100],
		columns:[[  
			{field:'KdBarang0',title:'Kode Barang0',width:80,hidden:true},
			{field:'matgroup_name',title:'Mat. Group',width:80},
			{field:'KdBarang',title:'Mat. Code',width:80},
			{field:'NmBarang',title:'Mat. Name',width:100},
			{field:'Ket',title:'Specification',width:100},
			{field:'HsNo',title:'HS No.',width:100},
			{field:'Sat',title:'Unit',width:40}
		]],
		url: '<?php echo $basedir; ?>models/material/material_grid.php?TpBarang=<?php echo $TpBarang; ?>&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val()
	});
}

function topdf(){
	openurl('<?=$basedir?>material/material_pdf.php?NmMenu=<?=$NmMenu?>&TpBarang=<?=$TpBarang?>&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val());
}

</script>	