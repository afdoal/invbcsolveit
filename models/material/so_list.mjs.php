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
			{field:'so_no',title:'PO No.',width:80},
			{field:'so_date',title:'PO Date',width:80},
			{field:'cust',title:'Customer',width:80},
			{field:'due_date',title:'Due Date',width:100},
			{field:'currency',title:'Currency',width:80},
			{field:'notes',title:'Notes',width:100},
			{field:'action',title:'Action',width:80,
				formatter:function(value,row,index){
					var det = '<a href="#" onclick="window.open(\'so_pdf.php?NmMenu=PO Customer&so_id='+row.so_id+'\', \'_blank\');"><img src="<?php echo $basedir ?>themes/icons/pdf.png"></a>';
					return det;					
				}
			}
		]],
		url: '<?php echo $basedir; ?>models/material/so_grid.php?req=menu&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(),
		view: detailview,  
		detailFormatter:function(index,row){  
			return '<div style="padding:2px"><table id="ddv-' + index + '"></table></div>';  
		},  
		onExpandRow: function(index,row){  
			$('#ddv-'+index).datagrid({  
				url:'<?php echo $basedir; ?>models/material/so_grid.php?req=list&so_id='+row.so_id,  
				fitColumns:true,  
				singleSelect:true,  
				rownumbers:true,  
				loadMsg:'',  
				height:'auto',  
				columns:[[  
					{field:'KdBarang2',title:'Code',width:80},  
					{field:'PartNo',title:'Name.',width:80}, 
					{field:'NmBarang2',title:'Name',width:100}, 
					{field:'Sat2',title:'Unit',width:80},   
					{field:'qty',title:'Quantity',width:100,align:'right'},  
					{field:'price',title:'Price',width:100,align:'right'},
					{field:'amount',title:'Amount',width:100,align:'right'}  
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
	openurl('so_list_pdf.php?NmMenu=PO Customer List&pilcari='+pilcari+'&txtcari='+txtcari);
}
</script>	