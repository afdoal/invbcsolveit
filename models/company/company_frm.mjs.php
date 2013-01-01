<script type="text/javascript">   
function setdg(){
	$('#dg').datagrid({  	
		title:"",
		width:736,
		height:515,
		toolbar:"#toolbar",
		fitColumns:false,
		rownumbers:"true",
		pagination:true,
		pageList:[25,50,75,100],
		frozenColumns:[[  
			{field:'NmPrshn0',title:'NmPrshn0',width:80,hidden:true},
			{field:'NmPrshn',title:'Nama',width:170},
		]],
		columns:[[			
			{field:'TpPrshn',title:'TpPrshn',width:100,hidden:true},
			{field:'NpwpPrshn',title:'NPWP',width:130},
			{field:'AlmtPrshn',title:'Alamat',width:200},
			/*{field:'Kota',title:'Kota',width:100},
			{field:'Prov',title:'Provinsi',width:100},*/
			{field:'Negara',title:'Negara',width:100},
			{field:'fax',title:'Faks.',width:100},
			{field:'tlp',title:'Telp.',width:100},
			{field:'Status',title:'Status',width:100},
			{field:'StatusKB',title:'Status KB',width:80},
			{field:'Niper',title:'Skep. KB',width:100},
			{field:'Cp',title:'Contact Person',width:100},
			{field:'Valuta',title:'Valuta',width:100}
			<?php if ($TpPrshn=='p'){ ?>,
			{field:'NoPokokPpjk',title:'No. Pokok',width:100},
			{field:'TgPokokPpjk',title:'Tgl. Pokok',width:100}
			<?php } ?>
			
		]],
		url: '<?php echo $basedir; ?>models/company/company_grid.php?TpPrshn=<?php echo $TpPrshn; ?>',  
		saveUrl: '',  
		updateUrl: '',  
		destroyUrl: '',
		onAdd:function(index,row){rowIndex=index;},
		onDblClickRow:function(index,row){rowIndex=index;}
		
	});
}

var url;
function tambah(){
	$('#dlg').dialog('open').dialog('setTitle','Tambah <?php echo $NmMenu ?>');
	$('#fm').form('clear');
	$('#TpPrshn').val('<?php echo $TpPrshn ?>');
	url = '<?php echo $basedir; ?>models/company/company_tuh.php?aksi=t';
}

function ubah(){
	var row = $('#dg').datagrid('getSelected');
	if (row){
		$('#dlg').dialog('open').dialog('setTitle','Ubah <?php echo $NmMenu ?>');
		$('#fm').form('load',row);
		url = '<?php echo $basedir; ?>models/company/company_tuh.php?aksi=u&NmPrshn0='+row.NmPrshn0;
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
				$.post('<?php echo $basedir; ?>models/company/company_tuh.php',{aksi:'h',NmPrshn0:row.NmPrshn0},function(result){
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
	openurl("<?=$basedir?>masterdata/company_pdf.php?TpPrshn=<?=$TpPrshn?>&NmMenu=<?=$NmMenu?>");
}
</script>	