<script type="text/javascript">   
function setdg(){
	if ($("#type").val()=='I'){
		str="In";
	} else {
		str="Out";
	}
	
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
			{field:'wh_name',title:'Warehouse',width:80},
			{field:'date',title:'Date',width:80},
			{field:'action',title:'Action',width:80,
				formatter:function(value,row,index){
					var det = '<a href="#" onclick="window.open(\'wip_inout_list_pdf.php?NmMenu=Work In Process (WIP) '+str+'&wh_id='+row.wh_id+'&type='+$("#type").val()+'&date='+row.date+'\', \'_blank\');"><img src="<?php echo $basedir ?>themes/icons/pdf.png"></a>';
					return det;					
				}
			}
		]],
		url: '<?php echo $basedir; ?>models/material/wip_grid.php?req=menu&type='+$("#type").val()+'&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(),
		view: detailview,  
		detailFormatter:function(index,row){  
			return '<div style="padding:2px"><table id="ddv-' + index + '"></table></div>';  
		},  
		onExpandRow: function(index,row){  
			$('#ddv-'+index).datagrid({  
				url:'<?php echo $basedir; ?>models/material/wip_grid.php?req=list&type='+$("#type").val()+'&wh_id='+row.wh_id+'&date='+row.date,  
				fitColumns:true,  
				singleSelect:true,  
				rownumbers:true,  
				loadMsg:'',  
				height:'auto',  
				columns:[[  
					{field:'KdBarang2',title:'Code',width:80}, 
					{field:'NmBarang2',title:'Name.',width:100},
					{field:'Ket',title:'Specification',width:100},   
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