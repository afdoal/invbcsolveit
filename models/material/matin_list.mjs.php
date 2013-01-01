<script type="text/javascript">   
function setdg(){
	$('#dg').datagrid({  	
		title:"",
		width:736,
		height:515,
		toolbar:"#toolCari",
		rownumbers:"true",
		pagination:true,
		pageList:[25,50,75,100],
		frozenColumns:[[  
			{field:'matin_no',title:'Incoming No.',width:80},
			{field:'matin_date',title:'Incoming Date',width:80},
		]],
		columns:[[  			
			{field:'matin_name',title:'Incoming Type',width:80},
			{field:'po_no',title:'PO No.',width:80},
			{field:'supplier',title:'Seller',width:80},
			{field:'supl_do',title:'Seller DO No.',width:80},
			{field:'supl_inv',title:'Seller Inv. No.',width:80},
			{field:'currency',title:'Currency',width:80},
			{field:'notes',title:'Notes',width:80},
			{field:'action',title:'Action',width:80,
				formatter:function(value,row,index){
					var det = '<a href="#" onclick="window.open(\'matin_pdf.php?NmMenu=Incoming Material&matin_id='+row.matin_id+'\', \'_blank\');"><img src="<?php echo $basedir ?>themes/icons/pdf.png"></a>';
					return det;					
				}
			}
		]],
		url: '<?php echo $basedir; ?>models/material/matin_grid.php?req=menu&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(),
		view: detailview,  
		detailFormatter:function(index,row){  
			return '<div style="padding:2px"><table id="ddv-' + index + '"></table></div>';  
		},  
		onExpandRow: function(index,row){  
			$('#ddv-'+index).datagrid({  
				url:'<?php echo $basedir; ?>models/material/matin_grid.php?req=list&matin_id='+row.matin_id,  
				fitColumns:true,  
				singleSelect:true,  
				rownumbers:true,  
				loadMsg:'',  
				height:'auto',  
				columns:[[  
					{field:'KdBarang2',title:'Mat. Code',width:80},  
					{field:'NmBarang2',title:'Mat. Name',width:100},   
					{field:'Ket',title:'Specification',width:100},   
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
	openurl('matin_list_pdf.php?NmMenu=Incoming Material List&pilcari='+pilcari+'&txtcari='+txtcari);
}
</script>	