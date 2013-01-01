<script type="text/javascript">   
function setdg(){
	$('#dg').datagrid({  	
		title:"",
		width:736,
		height:515,	
		toolbar:"#toolCari",
		rownumbers:"true",
		columns:[[  
			{field:'po_no',title:'PO No.',width:80},
			{field:'po_date',title:'PO Date',width:80},			
		//]],
		//columns:[[  
			{field:'supplier',title:'Seller',width:100},
			{field:'attn',title:'Attn.',width:80},
			{field:'ppn',title:'PPN (%)',width:80},
			{field:'terms',title:'Terms',width:80},
			/*{field:'currency',title:'Currency',width:80},
			{field:'notes',title:'Notes',width:80},
			{field:'spec',title:'Spec.',width:80},
			{field:'width_tol',title:'Width Tol.',width:80},
			{field:'thick_tol',title:'Thick Tol.',width:80},
			{field:'Wrmax',title:'Weight/Roll Max.(kg)',width:80},
			{field:'dlv_date',title:'Delivery Date',width:80},
			{field:'wh_name',title:'Warehouse',width:80},
			{field:'remark',title:'Remark',width:80},
			{field:'auth_sign',title:'Auth. Sign.',width:80},*/
			{field:'action',title:'Action',width:80,
				formatter:function(value,row,index){
					var det = '<a href="#" onclick="window.open(\'po_balance_pdf.php?NmMenu=Purchase Order&po_id='+row.po_id+'\', \'_blank\');"><img src="<?php echo $basedir ?>themes/icons/pdf.png"></a>';
					return det;					
				}
			}
		]],
		url: '<?php echo $basedir; ?>models/material/po_balance_grid.php?req=menu&pilcari='+$("#pilcari").val()+'&txtcari='+$("#txtcari").val(),
		view: detailview,  
		detailFormatter:function(index,row){  
			return '<div style="padding:2px"><table id="ddv-' + index + '"></table></div>';  
		},  
		onExpandRow: function(index,row){  
			$('#ddv-'+index).datagrid({  
				url:'<?php echo $basedir; ?>models/material/po_balance_grid.php?req=list&po_id='+row.po_id,  
				fitColumns:true,  
				singleSelect:true,  
				rownumbers:true,  
				loadMsg:'',  
				height:'auto',  
				columns:[[  
					{field:'KdBarang2',title:'Mat. Code',width:80},  
					//{field:'PartNo',title:'Name.',width:80}, 
					{field:'NmBarang2',title:'Desc',width:100},   
					{field:'Sat2',title:'Unit',width:80}, 
					{field:'qty',title:'Qty. PO',width:100,align:'right'},  
					{field:'qty_in',title:'Qty. In',width:100,align:'right'},
					{field:'qty_bal',title:'Qty. Balance',width:100,align:'right',formatter: function(value,row,index){				
					qty=parseFloat(row.qty.replace(',',''));
					qty_in=parseFloat(row.qty_in.replace(',',''));
					qty_bal=qty-qty_in;
					
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

</script>	