<script type="text/javascript">   
function setdg(){
	$('#dg').datagrid({  	
		title:"",
		width:736,
		height:515,	
		toolbar:"#toolCari",
		fitColumns:"true",
		rownumbers:"true",
		columns:[[  
			{field:'KdBarang',title:'Code',width:80},
			{field:'PartNo',title:'Name.',width:80},
			{field:'NmBarang',title:'Name',width:100},
			{field:'Sat',title:'Unit',width:80},
			{field:'cust',title:'Customer',width:100},
			{field:'Ket',title:'Remark',width:80},
			{field:'action',title:'Action',width:80,
				formatter:function(value,row,index){
					var det = '<a href="#" onclick="window.open(\'consumption_pdf.php?KdBarang0='+row.KdBarang+'\', \'_blank\');"><img src="<?php echo $basedir ?>themes/icons/pdf.png"></a>';
					return det;					
				}
			}
		]],
		url: '<?php echo $basedir; ?>models/consumption/consumption_grid.php?req=menu&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(),
		view: detailview,  
		detailFormatter:function(index,row){  
			return '<div style="padding:2px"><table id="ddv-' + index + '"></table></div>';  
		},  
		onExpandRow: function(index,row){  
			$('#ddv-'+index).datagrid({  
				url:'<?php echo $basedir; ?>models/consumption/consumption_grid.php?req=list&KdBarang0='+row.KdBarang,  
				fitColumns:true,  
				singleSelect:true,  
				rownumbers:true,  
				loadMsg:'',  
				height:'auto',  
				columns:[[  
					{field:'KdBarang2',title:'Mat Code',width:80},  
					//{field:'PartNo',title:'Name.',width:80}, 
					{field:'NmBarang2',title:'Desc.',width:100},   
					{field:'qty',title:'Qty.',width:100,align:'right'} 
				]],  
				onResize:function(){  
					$('#dg').datagrid('fixDetailRowHeight',index);  
				},  
				onLoadSuccess:function(){  
					setTimeout(function(){  
						$('#dg').datagrid('fixDetailRowHeight',index);  
					},0);  
				} 
			});
			$('#dg').datagrid('fixDetailRowHeight',index);
		}
	});
	
}
</script>	