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
			{field:'wh_name',title:'Warehouse.',width:100},
			{field:'opname_date',title:'Date',width:100},
			{field:'action',title:'Action',width:80,
				formatter:function(value,row,index){
					var det = '<a href="#" onclick="window.open(\'stock_opname_pdf.php?NmMenu=Stock Opname&opname_id='+row.opname_id+'\', \'_blank\');"><img src="<?php echo $basedir ?>themes/icons/pdf.png"></a>';
					return det;					
				}
			}
		]],
		url: '<?php echo $basedir; ?>models/material/stock_opname_grid.php?req=menu&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(),
		view: detailview,  
		detailFormatter:function(index,row){  
			return '<div style="padding:2px"><table id="ddv-' + index + '"></table></div>';  
		},  
		onExpandRow: function(index,row){  
			$('#ddv-'+index).datagrid({  
				url:'<?php echo $basedir; ?>models/material/stock_opname_grid.php?req=list&opname_id='+row.opname_id,  
				fitColumns:true,  
				singleSelect:true,  
				rownumbers:true,  
				pagination:true,
				pageList:[25,50,75,100],
				loadMsg:'',  
				height:'auto',  
				columns:[[  
					{field:'KdBarang2',title:'Code',width:80},  
					{field:'NmBarang2',title:'Name',width:100},   
					{field:'Ket',title:'Specification',width:100},   
					{field:'Sat2',title:'Unit',width:80}, 
					{field:'qty',title:'Quantity',width:100,align:'right'}
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