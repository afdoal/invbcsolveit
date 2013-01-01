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
					var det = '<a href="#" onclick="window.open(\'so_balance_pdf.php?NmMenu=PO Balance Customer&so_id='+row.so_id+'\', \'_blank\');"><img src="<?php echo $basedir ?>themes/icons/pdf.png"></a>';
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
				url:'<?php echo $basedir; ?>models/material/so_balance_grid.php?req=list&so_id='+row.so_id,  
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
					{field:'qty',title:'Qty. PO Cust.',width:100,align:'right'},  
					{field:'qty_do',title:'Qty. DO',width:100,align:'right'},
					{field:'qty_bal',title:'Qty. Balance',width:100,align:'right',formatter: function(value,row,index){				
					qty=parseFloat(row.qty.replace(',',''));
					qty_do=parseFloat(row.qty_do.replace(',',''));
					qty_bal=qty-qty_do;
					
					return qty_bal.toFixed(2);
				}}      
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
	openurl('so_balance_list_pdf.php?NmMenu=PO Balance Customer&pilcari='+pilcari+'&txtcari='+txtcari);
}
</script>	