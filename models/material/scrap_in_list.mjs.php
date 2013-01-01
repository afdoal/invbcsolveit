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
			{field:'matin_date',title:'Scrap In Date',width:100},
			{field:'action',title:'Action',width:60,
				formatter:function(value,row,index){
					var det = '<a href="#" onclick="window.open(\'scrap_in_pdf.php?NmMenu=Scrap In&matin_id='+row.matin_id+'\', \'_blank\');"><img src="<?php echo $basedir ?>themes/icons/pdf.png"></a>';
					return det;					
				}
			}
		]],
		url: '<?php echo $basedir; ?>models/material/scrap_in_grid.php?req=menu&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(),
		view: detailview,  
		detailFormatter:function(index,row){  
			return '<div style="padding:2px"><table id="ddv-' + index + '"></table></div>';  
		},  
		onExpandRow: function(index,row){  
			$('#ddv-'+index).datagrid({  
				url:'<?php echo $basedir; ?>models/material/scrap_in_grid.php?req=list&matin_id='+row.matin_id,  
				fitColumns:true,  
				singleSelect:true,  
				rownumbers:true,  				
				loadMsg:'',  
				height:'auto',  
				columns:[[  
					{field:'KdBarang2',title:'Scrap Code',width:80},  
					//{field:'PartNo',title:'Name.',width:80}, 
					{field:'NmBarang2',title:'Desc',width:100},   
					{field:'qty',title:'Quantity',width:100,align:'right'}
					//{field:'price',title:'Price',width:100}  
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

function showPrint(){
	pilcari=$("#pilcari").val();
	txtcari=$("#txtcari").val();
	openurl('scrap_in_list_pdf.php?NmMenu=Scrap In List&pilcari='+pilcari+'&txtcari='+txtcari);
}

</script>	