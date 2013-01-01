<script type="text/javascript">   

<?php 
$q="SELECT * FROM kode_jenis_dok ORDER BY KdKdJnsDok ";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
?>
jenis_dok = <?php echo json_encode($rs) ?>;

function dokFormat(value){
	for(var i=0; i<jenis_dok.length; i++){
		if (jenis_dok[i].KdKdJnsDok == value) return jenis_dok[i].UrKdJnsDok;
	}
	return value;
}

<?php 
$q="SELECT * FROM tujuan_pengiriman ORDER BY KdTp ";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
?>
jenis_tp = <?php echo json_encode($rs) ?>;

function tpFormat(value){
	for(var i=0; i<jenis_tp.length; i++){
		if (jenis_tp[i].KdTp == value) return jenis_tp[i].UrTp;
	}
	return value;
}
    
function dsTgl(){
	$('#TgDaf').datebox('disable');
	$('#TgBcAsal').datebox('disable');	
}
function enTgl(){
	$('#TgDaf').datebox('enable');
	$('#TgBcAsal').datebox('enable');		
}

function dsbtnHps(){ //Disable Button Hapus
	$('#btnHps').hide();
}

function dsbtnSim(){ //Disable Button Simpan
	$('#btnSim').hide();
}

function dsbtnTbh(){ //Disable Button Tambah
	$('#btnTbh').hide();
}

function dsbtnUbh(){ //Disable Button Ubah
	$('#btnUbh').hide();
}

function dsbtnBtl(){ //Disable Button Ubah
	$('#btnBtl').hide();
}

function dsbtnCri(){ //Disable Button Cari
	$('#btnCri').hide();
}


function enbtnHps(){ //Enable Button Hapus
	$('#btnHps').show();
}

function enbtnSim(){ //Enable Button Simpan
	$('#btnSim').show();
}

function enbtnTbh(){ //Enable Button Tambah
	$('#btnTbh').show();
}

function enbtnUbh(){ //Enable Button Ubah
	$('#btnUbh').show();
}

function enbtnBtl(){ //Enable Button Ubah
	$('#btnBtl').show();
}

function enbtnCri(){ //Enable Button Cari
	$('#btnCri').show();
}

function enbtnList(){ //Enable Button Hapus
	$('#btnTbhList').attr('disabled','');
	$('#btnTbhList').css('background','url(../img/mw_menu_active_bg_blue.png)');	
	$('#btnTbhList').css('cursor','default');
	$('#btnBtlList').attr('disabled','');
	$('#btnBtlList').css('background','url(../img/mw_menu_active_bg_blue.png)');	
	$('#btnBtlList').css('cursor','default');
}


function dsInput() { //Disable Input			
	$(":input").attr('disabled',true);
	$('#TgDaf').combo('disable');
	$('#TgJaminan').combo('disable');
	$('#JatuhTempo').combo('disable');
	$('#TgBukti').combo('disable');
	$('#toolbar').hide();
	$('#toolbar2').hide();
	$('#toolbar3').hide();
}

function enInput() { // Enable Input
	$(":input").attr('disabled',false);		
	$('#TgDaf').combo('enable');
	$('#TgJaminan').combo('enable');
	$('#JatuhTempo').combo('enable');
	$('#TgBukti').combo('enable');
	$('#toolbar').show();
	$('#toolbar2').show();	
	$('#toolbar3').show();	
}


function insert_bc(row){
	$('#wCari').window('close');
	$("#fhidden").val(row.CAR);
	$("#CAR").val(row.FCAR);
	$("#KdTp").val(row.KdTp);
	$("#KdKpbcAsal").val(row.KdKpbcAsal);
	$("#KdJnsTpbAsal").val(row.KdJnsTpbAsal);
	
	$("#NoDaf").val(row.FNoDaf);
	$("#TgDaf").datebox('setValue',row.FTgDaf);
		
	$("#NmPengusaha").val(row.NmPengusaha);
	$("#NipPengusaha").val(row.NipPengusaha);
	$("#NmPejabat").val(row.NmPejabat);
	$("#NipPejabat").val(row.NipPejabat);
	$("#ref_id").combogrid('setValue',row.ref_id);
	
	$("#NmTuj").val(row.NmTuj);
	
	$("#JnsAngkut").val(row.JnsAngkut);
	$("#NoPolisi").val(row.NoPolisi);
	
	$("#KdVal").val(row.KdVal);	
	$('#NDPBM').numberbox('setValue',row.NDPBM);
	$('#CIF').numberbox('setValue',row.CIF/row.NDPBM);
	
	$("#MerekKemas").val(row.MerekKemas);
	$("#KdKemas").val(row.KdKemas);	
	$('#JmlKemas').numberbox('setValue',row.JmlKemas);
	
	$('#VOL').numberbox('setValue',row.VOL);
	$('#BRUTO').numberbox('setValue',row.BRUTO);
	$('#NETTO').numberbox('setValue',row.NETTO);
	
	$('#BM').numberbox('setValue',row.BM);
	$('#Cukai').numberbox('setValue',row.Cukai);
	$('#PPN').numberbox('setValue',row.PPN);
	$('#PPnBM').numberbox('setValue',row.PPnBM);	
	$('#PPh').numberbox('setValue',row.PPh);		
	$('#Total').numberbox('setValue',row.Total);		
	
	$("#JnsJaminan").val(row.JnsJaminan);
	$("#NoJaminan").val(row.NoJaminan);
	$("#TgJaminan").datebox('setValue',row.TgJaminan);
	$('#NilaiJaminan').numberbox('setValue',row.NilaiJaminan);		
	$("#JatuhTempo").datebox('setValue',row.JatuhTempo);
	$("#Penjamin").val(row.Penjamin);
	$("#NoBukti").val(row.NoBukti);
	$("#TgBukti").datebox('setValue',row.TgBukti);
		
	//Untuk Datagrid	
	setdg();
	setdg2();
	setdg3();
	insert_jaminan(row.CAR);
	
	dsbtnTbh();
	enbtnUbh();
	dsbtnSim();
	enbtnHps();
	enbtnBtl();
}

function insert_jaminan(CAR){
	$.getJSON("<?php echo $basedir ?>models/getJaminan.php",{
		DokKdBc:4,
		CAR:CAR
	},function(data){		
        $.each(data, function(index) {
			var NoJaminan=data[index].NoJaminan
			var TgJaminan=data[index].TgJaminan1
			var JnsJaminan=data[index].JnsJaminan
			var bayar=data[index].bayar;
			var TgJatuhTempo=data[index].TgJatuhTempo1
			var Penjamin=data[index].Penjamin;
			var NoTandaBayar=data[index].NoTandaBayar;
			var TglTandaBayar=data[index].TglTandaBayar1;
				
			if (JnsJaminan=="BM"){				
				$('#BM').numberbox('setValue',bayar);
			} else if (JnsJaminan=="Cukai"){
				$('#Cukai').numberbox('setValue',bayar);
			} else if (JnsJaminan=="PPN"){	
				$('#PPN').numberbox('setValue',bayar);
			} else if (JnsJaminan=="PPnBM"){
				$('#PPnBM').numberbox('setValue',bayar);
			} else if (JnsJaminan=="PPh"){
				$('#PPh').numberbox('setValue',bayar);
			}
			
			if (NoJaminan!=""){
				$('#NoJaminan').val(NoJaminan);
				$('#TgJaminan').datebox('setValue',TgJaminan);
				$('#JnsJaminan').val(JnsJaminan);
				$('#NilaiJaminan').numberbox('setValue',bayar);
				$('#JatuhTempo').datebox('setValue',TgJatuhTempo);
				$('#Penjamin').val(Penjamin);
				$('#NoBukti').val(NoTandaBayar);
				$('#TgBukti').datebox('setValue',TglTandaBayar);
			}
        });			
	})	
}

function insert_penjamin(Penjamin){
	$("#Penjamin").val(Penjamin);	
	tb_remove();
}

function setdg(){
	if ($('#fhidden').val()!=''){		
		var CAR = $('#fhidden').val();	
	} else {
		var CAR = $('#CAR').val();	
	}
	
	$('#dg').edatagrid({  
		title:"Dokumen Pelengkap Pabean", 
		width:550,
		height:200,
		fitColumns:"true",
		rownumbers:"true",		
		toolbar:"#toolbar",  
		columns:[[  
			{field:'DokKd',title:'Jenis Dokumen',width:100,formatter:function(value){
				for(var i=0; i<jenis_dok.length; i++){
					if (jenis_dok[i].KdKdJnsDok == value) return jenis_dok[i].UrKdJnsDok;
				}
				return value;				
			},editor:{type:'combobox',  
					options:{                          
						valueField:'KdKdJnsDok',
						textField:'UrKdJnsDok',
						data:jenis_dok,
						required:true		  
					}
			}},  
			{field:'DokNo',title:'Nomor',width:50,editor:{type:'validatebox',options:{required:true}}},  
			{field:'DokTgDmy',title:'Tanggal',width:50,align:'center',editor:{type:'datebox'}}
		]],
		url: '<?php echo $basedir ?>models/bc261/bc261_grid.php?req=dg&CAR='+CAR,  
		saveUrl: '',  
		updateUrl: '',  
		destroyUrl: '',
		onAdd:function(index,row){rowIndex=index;},
		onDblClickRow:function(index,row){rowIndex=index;}
		
	});
}

function setdg2(){
	if ($('#fhidden').val()!=''){		
		var CAR = $('#fhidden').val();	
	} else {
		var CAR = $('#CAR').val();	
	}
			
	$('#dg2').datagrid({  
		title:"Data Barang", 
		width:690,
		height:200,
		rownumbers:true,
		toolbar:"#toolbar2",  
		frozenColumns:[[  
			{field:'KdBarang',title:'Kode<br>Barang',width:75},  
			{field:'UrBarang',title:'Uraian',width:150},
		]],
		columns:[[  			  			
			{field:'Negara',title:'Negara Asal<br>Barang',width:75},
			{field:'Tarif',title:'Tarif<br>BM, Cukai, PPN,<br>PPnBM, PPh',width:100},
			{field:'qty',title:'Jumlah',width:50,align:"right"},
			{field:'NETTO',title:'Berat<br>Bersih<br>(kg)',width:50,align:"right"},
			{field:'VOL',title:'Volume<br>(m3)',width:50,align:"right"},
			{field:'CIF',title:'CIF',width:50,align:"right"}
		]],
		url: '<?php echo $basedir ?>models/bc261/bc261_grid.php?req=dg2&CAR='+CAR,  
		saveUrl: '',  
		updateUrl: '',  
		destroyUrl: '',
		onAdd:function(index,row){rowIndex=index;setEditing(rowIndex);},			
		onDblClickRow:function(index,row){rowIndex=index;setEditing(rowIndex);}		
	});	
}

function setdg2Url(row){
	$('#HrgSerah').numberbox('setValue',row.tot_amount);
	$('#NETTO').numberbox('setValue',row.tot_qty);
	$('#dg2').datagrid({  
		url: '<?php echo $basedir ?>models/bc261/bc261_grid.php?req=outdet&matout_id='+row.matout_id
	});
}

function setUrBarang(id1,id2){
	$.post("<?php echo $basedir ?>models/getField.php",{
		NmTabel: 'mst_barang',
		NmKolom1: 'Ket',
		NmKolom2: 'KdBarang',
		field: $('#'+id1).val()
	},function(result){
		$('#'+id2).val(result);	
	});
}

function setdg3(){		
	if ($('#fhidden').val()!=''){		
		var CAR = $('#fhidden').val();	
	} else {
		var CAR = $('#CAR').val();	
	}
			
	$('#dg3').edatagrid({ 
		title:"Barang Yang Akan Dimasukan Kembali Ke TPB", 
		width:690,
		height:200,
		fitColumns:"true",
		rownumbers:"true",		
		toolbar:"#toolbar3",  
		columns:[[  
			{field:'KdBarang',title:'Kode Barang',width:60},  
			{field:'UrBarang',title:'Nama Barang',width:100},
			{field:'qty',title:'Qty',width:30,align:'right'},			
			{field:'NETTO',title:'Berat bersih (Kg)',width:55,align:'right',editor:'text'},
			{field:'VOL',title:'Volume<br>(m3)',width:35,align:'right',hidden:'true',editor:'text'},  
			{field:'CIF',title:'Nilai CIF',width:40,align:'right',editor:'text'}  
		]],
		url: '<?php echo $basedir ?>models/bc261/bc261_grid.php?req=dg3&CAR='+CAR,  
		saveUrl: '',  
		updateUrl: '',  
		destroyUrl: '',
		onAdd:function(index,row){rowIndex=index;},								
		onDblClickRow:function(index,row){rowIndex=index;}
	});
}

function setdgCari(){	
	$('#dgCari').datagrid({  
		width:586,
		height:315,	
		fitColumns:"true",
		rownumbers:"true", 
		toolbar:"#toolCari",
		columns:[[  
			{field:'FCAR',title:'No. Pengajuan',width:60,editor:{type:'validatebox',options:{required:true}}},
			{field:'FNoDaf',title:'No. Pendaftaran',width:50,editor:{type:'validatebox',options:{required:true}}},
			{field:'FTgDaf',title:'Tgl. Pendaftaran',width:50,editor:{type:'validatebox',options:{required:true}}},
			{field:'KdTp',title:'Tuj. Pengiriman',width:60,formatter:function(value){				
				return tpFormat(value);				
			},editor:{type:'combobox',  
					options:{                          
						valueField:'KdTp',
						textField:'UrTp',
						data:jenis_tp,
						required:true		  
					}
			}},
			{field:'NmTuj',title:'Pemasok',width:100,editor:{type:'validatebox',options:{required:true}}}
		]],
		url: '<?php echo $basedir ?>models/bc261/bc261_grid.php?req=dgCari', 
		saveUrl: '',  
		updateUrl: '',  
		destroyUrl: '',
		onClickRow:function(index,row){insert_bc(row)}
		
	});
}

function setEditing(rowIndex){
	/*var editors = $('#dg2').datagrid('getEditors', rowIndex);
	var fqty = editors[5];
	var fprice = editors[7];
	var fkurs = editors[8];
	var fharga = editors[12];
		
	fqty.target.bind('change', function(){
		calculate();
	});
	fprice.target.bind('change', function(){
		calculate();
	});
	fkurs.target.bind('change', function(){
		calculate();
	});
	function calculate(){		
		qty=Number(fqty.target.val());
		price=Number(fprice.target.val());
		kurs=Number(fkurs.target.val());
		setTimeout(function(){
			var harga = qty*price*kurs;
			fharga.target.val(harga);
		}, 100);
	}*/
}

function total(){
	var tvol = 0;
	var tnetto = 0;
	var tcif = 0;
	var thrgserah = 0;
	
	var rows = $('#dg2').datagrid('getRows');
	for(var i=0; i<rows.length; i++){
		tvol += Number(rows[i].VOL);
		tnetto += Number(rows[i].NETTO);
		tcif += Number(rows[i].CIF);
		thrgserah += Number(rows[i].HrgSerah);
	}
	
	$('#VOL').numberbox('setValue',tvol);
	$('#NETTO').numberbox('setValue',tnetto);
	$('#CIF').numberbox('setValue',tcif);
	$('#HrgSerah').numberbox('setValue',thrgserah);
}

function totJaminan(){		
	var BM = Number($('#BM').numberbox('getValue'));
	var Cukai = Number($('#Cukai').numberbox('getValue'));
	var PPN = Number($('#PPN').numberbox('getValue'));
	var PPnBM = Number($('#PPnBM').numberbox('getValue'));
	var PPh = Number($('#PPh').numberbox('getValue'));

	tot = BM+Cukai+PPN+PPnBM+PPh;
	//$('#CIF').numberbox('setValue',tot);
	$('#Total').numberbox('setValue',tot);
}

function tl2Tbh(){
	$('#dlgBarang').dialog('open').dialog('setTitle','Tambah Data Barang');
}

function tl2Ubh(){
	var row = $('#dg2').datagrid('getSelected');	
	if (row){
		$('#dlgBarang').dialog('open').dialog('setTitle','Ubah Data Barang');
		$('#KdBarang').val(row.KdBarang);
		$('#UrBarang').val(row.UrBarang);
		$('#Negara').val(row.Negara);
		$('#Tarif').val(row.Tarif);
		$('#qty').numberbox('setValue',row.qty);
		$('#NETTO2').numberbox('setValue',row.NETTO);
		$('#VOL2').numberbox('setValue',row.VOL);
		$('#CIF2').numberbox('setValue',row.CIF);
	}
}

function tl2Ubh2(){
	var row = $('#dg2').datagrid('getSelected');
	if (row){
		var index = $('#dg2').datagrid('getRowIndex', row);
		$('#dg2').datagrid('updateRow',{
			index: index, 
			row: { 
				KdBarang: $('#KdBarang').val(),
				UrBarang: $('#UrBarang').val(),
				Negara: $('#Negara').val(),
				Tarif: $('#Tarif').val(),
				qty: $('#qty').numberbox('getValue'),
				NETTO: $('#NETTO2').numberbox('getValue'),
				VOL: $('#VOL2').numberbox('getValue'),
				CIF: $('#CIF2').numberbox('getValue')
			}
		});
	}
}

function tl2Hps(){
	var row = $('#dg2').datagrid('getSelected');
	if (row){
			var index = $('#dg2').datagrid('getRowIndex', row);
			$('#dg2').datagrid('deleteRow', index);
	}
}

function tl2Sim(){
	$('#dg2').datagrid('appendRow',{
		KdBarang: $('#KdBarang').val(),
		UrBarang: $('#UrBarang').val(),
		Negara: $('#Negara').val(),
		Tarif: $('#Tarif').val(),
		qty: $('#qty').numberbox('getValue'),
		NETTO: $('#NETTO2').numberbox('getValue'),
		VOL: $('#VOL2').numberbox('getValue'),
		CIF: $('#CIF2').numberbox('getValue')
	});
}

function tl3Tbh(){
	$('#dlgBarang2').dialog('open').dialog('setTitle','Tambah Data Penggunaan Barang');
}

function tl3Ubh(){
	var row = $('#dg3').datagrid('getSelected');	
	if (row){
		$('#dlgBarang2').dialog('open').dialog('setTitle','Ubah Data Penggunaan Barang');
		$('#KdBarang2').val(row.KdBarang);
		$('#UrBarang2').val(row.UrBarang);
		$('#qty2').numberbox('setValue',row.qty);
		$('#NETTO3').numberbox('setValue',row.NETTO);
		$('#VOL3').numberbox('setValue',row.VOL);
		$('#CIF3').numberbox('setValue',row.CIF);
	}
}

function tl3Ubh2(){
	var row = $('#dg3').datagrid('getSelected');
	if (row){
		var index = $('#dg3').datagrid('getRowIndex', row);
		$('#dg3').datagrid('updateRow',{
			index: index, 
			row: { 
				KdBarang: $('#KdBarang2').val(),
				UrBarang: $('#UrBarang2').val(),
				qty: $('#qty2').numberbox('getValue'),
				NETTO: $('#NETTO3').numberbox('getValue'),
				VOL: $('#VOL3').numberbox('getValue'),
				CIF: $('#CIF3').numberbox('getValue')
			}
		});
	}
}

function tl3Hps(){
	var row = $('#dg3').datagrid('getSelected');
	if (row){
			var index = $('#dg3').datagrid('getRowIndex', row);
			$('#dg3').datagrid('deleteRow', index);
	}
}

function tl3Sim(){
	//alert("tes");
	$('#dg3').datagrid('appendRow',{
		KdBarang: $('#KdBarang2').val(),
		UrBarang: $('#UrBarang2').val(),
		qty: $('#qty2').numberbox('getValue'),
		NETTO: $('#NETTO3').numberbox('getValue'),
		VOL: $('#VOL3').numberbox('getValue'),
		CIF: $('#CIF3').numberbox('getValue')
	});
}

function btnSim(){
	var rows = $('#dg').datagrid('getRows');
	var rows2 = $('#dg2').datagrid('getRows');
	
	try {
	if ($('#CAR').val() == ''){	
		throw "CAR-Nomor Pengajuan";	
	} else if ($('#NoDaf').val() == ''){
		throw "NoDaf-Nomor Pendaftaran";
	} else if ($('#TgDaf').val() == ''){
		throw "TgDaf-Tanggal Pendaftaran";								
	} else if (rows.length == 0){
		throw "CAR-Dokumen Pelengkap";									
	} else if (rows2.length == 0){
		throw "CAR-Detail Barang";										
	} else {	
		frm = document.forms['input'];
		
		//LIST DOK PELENGKAP
		nolist_val="";
		DokKd_val="";
		DokNo_val="";
		DokTgDmy_val="";
		j=1;
		var rows = $('#dg').datagrid('getRows');
		for(var i=0; i<rows.length; i++){
			nolist_val += j+i + "`";
			DokKd_val += rows[i].DokKd + "`";
			DokNo_val += rows[i].DokNo + "`";
			DokTgDmy_val += rows[i].DokTgDmy + "`";
		}
		//tes=$('#CAR').val().replace("-","");
		//$.messager.alert('tes//',tes);
		//AHIR LIST DOK PELENGKAP
		
		//FORM LIST BARANG
		nolist2_val="";	
		KdBarang_val="";
		UrBarang_val="";
		Negara_val="";
		Tarif_val="";
		qty_val="";
		NETTO_val="";
		VOL_val="";
		CIF_val="";
		j=1;
		var rows = $('#dg2').datagrid('getRows');
		for(var i=0; i<rows.length; i++){
			nolist2_val += j+i + "`";		
			KdBarang_val += rows[i].KdBarang + "`";
			UrBarang_val += rows[i].UrBarang + "`";
			Negara_val += rows[i].Negara + "`";
			Tarif_val += rows[i].Tarif + "`";
			qty_val += rows[i].qty + "`";
			NETTO_val += rows[i].NETTO + "`";
			VOL_val += rows[i].VOL + "`";
			CIF_val += rows[i].CIF + "`";			
		}	 	
		//AKHIR FORM LIST BARANG
		
		//FORM LIST BARANG KEMBALI
		nolist3_val="";	
		KdBarang2_val="";
		UrBarang2_val="";
		qty2_val="";
		NETTO3_val="";
		VOL3_val="";
		CIF3_val="";
		j=1;
		var rows = $('#dg3').datagrid('getRows');
		for(var i=0; i<rows.length; i++){
			nolist3_val += j+i + "`";		
			KdBarang2_val += rows[i].KdBarang + "`";
			UrBarang2_val += rows[i].UrBarang + "`";
			qty2_val += rows[i].qty + "`";
			NETTO3_val += rows[i].NETTO + "`";
			VOL3_val += rows[i].VOL + "`";
			CIF3_val += rows[i].CIF + "`";			
		}	 	
		//AKHIR FORM LIST BARANG
			
		$.post("<?php echo $basedir ?>models/bc261/bc261_tuh.php", { 
		DokKdBc: 4,
		fhidden: $('#fhidden').val(),
		CAR: $('#CAR').val().replace(".",""),
		KdTp: $('#KdTp').val(),
		KdKpbcAsal: $('#KdKpbcAsal').val(),
		KdJnsTpbAsal: $('#KdJnsTpbAsal').val(),
		
		NoDaf: $('#NoDaf').val().replace(".",""),
		TgDaf: $('#TgDaf').combo('getValue'),
				
		NmPengusaha: $('#NmPengusaha').val(),
		NipPengusaha: $('#NipPengusaha').val(),
		NmPejabat: $('#NmPejabat').val(),
		NipPejabat: $('#NipPejabat').val(),
		ref_id: $('#ref_id').combo('getValue'),
		
		NmTuj: $('#NmTuj').val(),
		
		KdVal: $('#KdVal').val(),
		NDPBM: $('#NDPBM').numberbox('getValue'),
		CIF: $('#CIF').numberbox('getValue')*$('#NDPBM').numberbox('getValue'),		
		
		JnsAngkut: $('#JnsAngkut').val(),
		NoPolisi: $('#NoPolisi').val(),
		
		MerekKemas: $('#MerekKemas').val(),
		KdKemas: $('#KdKemas').val(),
		JmlKemas: $('#JmlKemas').numberbox('getValue'),
		VOL: $('#VOL').numberbox('getValue'),
		BRUTO: $('#BRUTO').numberbox('getValue'),
		NETTO: $('#NETTO').numberbox('getValue'),
		
		BM: $('#BM').numberbox('getValue'),
		Cukai: $('#Cukai').numberbox('getValue'),
		PPN: $('#PPN').numberbox('getValue'),
		PPnBM: $('#PPnBM').numberbox('getValue'),
		PPh: $('#PPh').numberbox('getValue'),
		Total: $('#Total').numberbox('getValue'),
		
		JnsJaminan: $('#JnsJaminan').val(),
		NoJaminan: $('#NoJaminan').val(),
		TgJaminan: $('#TgJaminan').combo('getValue'),
		NilaiJaminan: $('#NilaiJaminan').numberbox('getValue'),
		JatuhTempo: $('#JatuhTempo').combo('getValue'),
		Penjamin: $('#Penjamin').val(),
		NoBukti: $('#NoBukti').val(),
		TgBukti: $('#TgBukti').combo('getValue'),	
		
		nolist:nolist_val,DokKd:DokKd_val,DokNo:DokNo_val,
		DokTgDmy:DokTgDmy_val,
		//FORM LIST DATA BARANG	
		nolist2:nolist2_val,KdBarang:KdBarang_val,
		UrBarang:UrBarang_val,Negara:Negara_val,
		Tarif:Tarif_val,qty:qty_val,NETTO2:NETTO_val,VOL2:VOL_val,
		CIF2:CIF_val,
		
		nolist3:nolist3_val,KdBarang2:KdBarang2_val,
		UrBarang2:UrBarang2_val,qty2:qty2_val,NETTO3:NETTO3_val,
		VOL3:VOL3_val,CIF3:CIF3_val
		},
		function(data){
			$.messager.alert('Info',data);
			//alert(data);
			location.reload(true);		
		});
	}//Akhir If Validasi
	} catch(err) {	
		if (err.toSource().indexOf("-") == -1){
			alert(err);
		} else {
			str = err.split("-");
			
			alert(str[1]+" Harus Diisi!");
			$('#'+str[0]).focus();
		}
	}
}

function cari(){					
	$('#dgCari').datagrid({  
		url:"<?php echo $basedir ?>models/bc261/bc261_grid.php?req=dgCari&dtdari="+$('#dtdari').datebox('getValue')+"&dtsampai="+$('#dtsampai').datebox('getValue')
	});
	$('#dgCari').datagrid('load');
}
</script>	