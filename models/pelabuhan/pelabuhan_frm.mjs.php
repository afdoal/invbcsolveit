<script type="text/javascript">   
function setdg(){
	$('#dg').datagrid({  	
		title:"",
		width:736,
		height:515,	
		toolbar:"#toolbar",
		fitColumns:"true",
		rownumbers:"true",
		columns:[[  
			{field:'KdPelabuhan0',title:'KdPelabuhan0',width:80,hidden:true},
			{field:'KdPelabuhan',title:'Kode Pelabuhan',width:80},
			{field:'NmPelabuhan',title:'Nama Pelabuhan',width:300}
		]],
		url: '<?php echo $basedir; ?>models/pelabuhan/pelabuhan_grid.php',  
		saveUrl: '',  
		updateUrl: '',  
		destroyUrl: ''		
	});
}

var url;
function tambah(){
	$('#dlg').dialog('open').dialog('setTitle','Tambah <?php echo $NmMenu ?>');
	$('#fm').form('clear');
	url = '<?php echo $basedir; ?>models/pelabuhan/pelabuhan_tuh.php?aksi=t';
}

function ubah(){
	var row = $('#dg').datagrid('getSelected');
	if (row){
		$('#dlg').dialog('open').dialog('setTitle','Ubah <?php echo $NmMenu ?>');
		$('#fm').form('load',row);
		url = '<?php echo $basedir; ?>models/pelabuhan/pelabuhan_tuh.php?aksi=u&KdPelabuhan0='+row.KdPelabuhan0;
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
				$.post('<?php echo $basedir; ?>models/pelabuhan/pelabuhan_tuh.php',{aksi:'h',KdPelabuhan0:row.KdPelabuhan0},function(result){
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
	openurl("<?=$basedir?>masterdata/pelabuhan_pdf.php?NmMenu=<?=$NmMenu?>");
}

</script>	