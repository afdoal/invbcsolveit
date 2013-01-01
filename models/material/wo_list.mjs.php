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
			{field:'wo_no',title:'WO No.',width:80},
			{field:'wo_date',title:'WO Date',width:80},
			{field:'so_no',title:'PO Cust. No.',width:80},
			{field:'expplan_date',title:'Export Plan Date',width:80},
			{field:'notes',title:'Notes',width:100},
			{field:'action',title:'Action',width:80,
				formatter:function(value,row,index){
					var det = '<a href="#" onclick="window.open(\'wo_pdf.php?NmMenu=Work Order&wo_id='+row.wo_id+'\', \'_blank\');"><img src="<?php echo $basedir ?>themes/icons/pdf.png"></a>';
					return det;					
				}
			}
		]],
		url: '<?php echo $basedir; ?>models/material/wo_grid.php?req=menu&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(),
		view: detailview,  
		detailFormatter:function(index,row){  
			return '<div style="padding:2px"><table id="ddv-' + index + '"></table></div>';  
		},  
		onExpandRow: function(index,row){  
			$('#ddv-'+index).datagrid({  
				url:'<?php echo $basedir; ?>models/material/wo_grid.php?req=list&wo_id='+row.wo_id,  
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

function showPrint(){
	pilcari=$("#pilcari").val();
	txtcari=$("#txtcari").val();
	openurl('wo_list_pdf.php?NmMenu=Work Order List&pilcari='+pilcari+'&txtcari='+txtcari);
}
</script>	