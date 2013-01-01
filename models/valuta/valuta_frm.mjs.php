<script type="text/javascript">   
function setdg(){
	$('#dg').datagrid({  	
		title:"",
		width:736,
		height:515,
		toolbar:"#toolbar",
		fitColumns:"true",
		rownumbers:"true",
		pagination:true,
		pageList:[25,50,75,100],
		columns:[[  
			{field:'KdVal0',title:'KdVal0',width:80,hidden:true},
			{field:'KdVal',title:'Kode Valuta',width:80},
			{field:'UrVal',title:'Nama Valuta',width:300}
		]],
		url: '<?php echo $basedir; ?>models/valuta/valuta_grid.php',  
		saveUrl: '',  
		updateUrl: '',  
		destroyUrl: ''		
	});
}

var url;
function tambah(){
	$('#dlg').dialog('open').dialog('setTitle','Tambah <?php echo $NmMenu ?>');
	$('#fm').form('clear');
	url = '<?php echo $basedir; ?>models/valuta/valuta_tuh.php?aksi=t';
}

function ubah(){
	var row = $('#dg').datagrid('getSelected');
	if (row){
		$('#dlg').dialog('open').dialog('setTitle','Ubah <?php echo $NmMenu ?>');
		$('#fm').form('load',row);
		url = '<?php echo $basedir; ?>models/valuta/valuta_tuh.php?aksi=u&KdVal0='+row.KdVal0;
	}
}

function simpan(){
	$('#fm').form('submit',{
		url: url,
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
			var result = eval('('+result+')');
			if (result.success){
				$('#dlg').dialog('close');		// close the dialog
				$('#dg').datagrid('reload');	// reload the user data
				$.messager.show({
					title: 'Info',
					msg: result.msg
				});
			} else {
				$.messager.show({
					title: 'Error',
					msg: result.msg
				});
			}
		}
	});
}

function hapus(){
	var row = $('#dg').datagrid('getSelected');
	if (row){
		$.messager.confirm('Confirm','Apakah anda yakin akan menghapus data ini?',function(r){
			if (r){
				$.post('<?php echo $basedir; ?>models/valuta/valuta_tuh.php',{aksi:'h',KdVal0:row.KdVal0},function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dg').datagrid('reload');	// reload the user data
						$.messager.show({
							title: 'Info',
							msg: result.msg
						});
					} else {
						$.messager.show({	// show error message
							title: 'Error',
							msg: result.msg
						});
					}
				});
			}
		});
	}
}

function topdf(){
	openurl("<?=$basedir?>masterdata/valuta_pdf.php?NmMenu=<?=$NmMenu?>");
}

</script>	