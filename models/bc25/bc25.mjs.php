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
$q="SELECT * FROM jenis_dok ORDER BY KdJnsDok ";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
?>
jenis_bc = <?php echo json_encode($rs) ?>;

function bcFormat(value){
	for(var i=0; i<jenis_bc.length; i++){
		if (jenis_bc[i].KdJnsDok == value) return jenis_bc[i].UrJnsDok;
	}
	return value;
}

<?php 
$q="SELECT * FROM jenis_tpb ORDER BY KdJnsTpb ";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
?>
jenis_tpb = <?php echo json_encode($rs) ?>;

function tpbFormat(value){
	for(var i=0; i<jenis_tpb.length; i++){
		if (jenis_tpb[i].KdJnsTpb == value) return jenis_tpb[i].UrJnsTpb;
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
	$('#TgSSCP').combo('disable');
	$('#TgNTB').combo('disable');
	$('#TgNTPN').combo('disable');
	$('#TgSSP').combo('disable');
	$('#TgNTB2').combo('disable');
	$('#TgNTPN2').combo('disable');
	
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
	$('#TgSSCP').combo('enable');
	$('#TgNTB').combo('enable');
	$('#TgNTPN').combo('enable');
	$('#TgSSP').combo('enable');
	$('#TgNTB2').combo('enable');
	$('#TgNTPN2').combo('enable');
	
	$('#toolbar').show();
	$('#toolbar2').show();	
	$('#toolbar3').show();	
}

function insert_bc(row){
	$('#wCari').window('close');
	$("#fhidden").val(row.CAR);
	$("#CAR").val(row.FCAR);
	$("#KdKpbcAsal").val(row.KdKpbcAsal);	
	$("#KdJnsTpbAsal").val(row.KdJnsTpbAsal);
	$("#JnsBc25").val(row.JnsBc25);
	$("#kondisibrg").val(row.KondisiBrg);
	
	$("#NoDaf").val(row.NoDaf);
	$("#TgDaf").datebox('setValue',row.FTgDaf);
		
	$("#NmPengusaha").val(row.NmPengusaha);
	$("#NipPengusaha").val(row.NipPengusaha);
	$("#NmPejabat").val(row.NmPejabat);
	$("#NipPejabat").val(row.NipPejabat);
	$("#ref_id").combogrid('setValue',row.ref_id);
	
	$("#NmTuj").val(row.NmTuj);
	
	$("#JnsAngkut").val(row.JnsAngkut);
	$("#NoPolisi").val(row.NoPolisi);
	$("#NoSegel").val(row.NoSegel);
	$("#JnsSegel").val(row.JnsSegel);
	$("#CatBcTuj").val(row.CatBcTuj);
	
	$("#NoBcAsal").combobox('setValue',row.NoBcAsal);
	$("#TgBcAsal").datebox('setValue',row.TgBcAsal);
	$("#KdVal").val(row.KdVal);	
	$('#NDPBM').numberbox('setValue',row.NDPBM);
	$('#HrgSerah').numberbox('setValue',row.HrgSerah);
	
	$("#MerekKemas").val(row.MerekKemas);
	$("#KdKemas").val(row.KdKemas);
	
	$('#JmlKemas').numberbox('setValue',row.JmlKemas);
	$('#VOL').numberbox('setValue',row.VOL);
	$('#BRUTO').numberbox('setValue',row.BRUTO);
	$('#NETTO').numberbox('setValue',row.NETTO);
	$('#CIF').numberbox('setValue',row.CIF);	
	
	$('#BM').numberbox('setValue',row.BM);
	$('#Cukai').numberbox('setValue',row.Cukai);
	$('#PPN').numberbox('setValue',row.PPN);
	$('#PPnBM').numberbox('setValue',row.PPnBM);	
	$('#PPh22').numberbox('setValue',row.PPh22);		
	$('#Total').numberbox('setValue',row.Total);		
	
	$("#JnsJaminan").val(row.JnsJaminan);
	$("#NoJaminan").val(row.NoJaminan);
	$("#TgJaminan").datebox('setValue',row.TgJaminan);
	$('#NilaiJaminan').numberbox('setValue',row.NilaiJaminan);		
	$("#JatuhTempo").datebox('setValue',row.JatuhTempo);
	$("#Penjamin").val(row.Penjamin);
	$("#NoBukti").val(row.NoBukti);
	$("#TgBukti").datebox('setValue',row.TgBukti);
	
	$("#Niper").val(row.Niper);
	$("#NmCPTuj").val(row.NmCPTuj);	
	$("#PNBP").numberbox("setValue",row.PNBP);
	$("#DBBMCukai").numberbox("setValue",row.DBBMCukai);
	$("#BungaPPNPPnBM").numberbox("setValue",row.BungaPPNPPnBM);
	$("#Total").numberbox("setValue",row.Total);
	$("#TotalH").numberbox("setValue",row.TotalH);
	$("#NoSSCP").val(row.NoSSCP);
	$("#NoNTB").val(row.NoNTB);
	$("#NoNTPN").val(row.NoNTPN);
	$("#NoSSP").val(row.NoSSP);
	$("#NoNTB2").val(row.NoNTB2);
	$("#NoNTPN2").val(row.NoNTPN2);
	$("#TgSSCP").datebox('setValue',row.TgSSCP);
	$("#TgNTB").datebox('setValue',row.TgNTB);
	$("#TgNTPN").datebox('setValue',row.TgNTPN);
	$("#TgSSP").datebox('setValue',row.TgSSP);
	$("#TgNTB2").datebox('setValue',row.TgNTB2);
	$("#TgNTPN2").datebox('setValue',row.TgNTPN2);
		
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
		DokKdBc:3,
		CAR:CAR
	},function(data){		
        $.each(data, function(index) {
			var JnsJaminan=data[index].JnsJaminan
			var bayar=data[index].bayar;
			var hutang=data[index].hutang;
			var KodeAkun=data[index].KodeAkun;
			var NoTandaBayar=data[index].NoTandaBayar;
			var TglTandaBayar=data[index].TglTandaBayar1;
				
			if (JnsJaminan=="BM"){				
				$('#BM').numberbox('setValue',bayar);
				$('#BM2').numberbox('setValue',hutang);
			} else if (JnsJaminan=="Cukai"){
				$('#Cukai').numberbox('setValue',bayar);
				$('#Cukai2').numberbox('setValue',hutang);
			} else if (JnsJaminan=="PPN"){	
				$('#PPN').numberbox('setValue',bayar);
				$('#PPN2').numberbox('setValue',hutang);
			} else if (JnsJaminan=="PPnBM"){
				$('#PPnBM').numberbox('setValue',bayar);
				$('#PPnBM2').numberbox('setValue',hutang);
			} else if (JnsJaminan=="PPh"){
				$('#PPh').numberbox('setValue',bayar);
				$('#PPh2').numberbox('setValue',hutang);
			} else if (JnsJaminan=="PNBP"){
				$('#PNBP').numberbox('setValue',bayar);
				$('#PNBP2').numberbox('setValue',hutang);
			} else if (JnsJaminan=="DBBMCukai"){
				$('#DBBMCukai').numberbox('setValue',bayar);
				$('#DBBMCukai2').numberbox('setValue',hutang);
			} else if (JnsJaminan=="BungaPPNPPnBM"){
				$('#BungaPPNPPnBM').numberbox('setValue',bayar);
				$('#BungaPPNPPnBM2').numberbox('setValue',hutang);	
			} else if (JnsJaminan=="SSCP"){
				$('#NoSSCP').val(NoTandaBayar);
				$('#TgSSCP').datebox('setValue',TglTandaBayar);
			} else if (JnsJaminan=="SSP"){
				$('#NoSSP').val(NoTandaBayar);
				$('#TgSSP').datebox('setValue',TglTandaBayar);
			}
			
			if (JnsJaminan=="NTB" && KodeAkun=="SSCP"){
				$('#NoNTB').val(NoTandaBayar);
				$('#TgNTB').datebox('setValue',TglTandaBayar);
			} else if (JnsJaminan=="NTB" && KodeAkun=="SSP"){
				$('#NoNTB2').val(NoTandaBayar);
				$('#TgNTB2').datebox('setValue',TglTandaBayar);
			}
			
			if (JnsJaminan=="NTPN" && KodeAkun=="SSCP"){
				$('#NoNTPN').val(NoTandaBayar);
				$('#TgNTPN').datebox('setValue',TglTandaBayar);
			} else if (JnsJaminan=="NTPN" && KodeAkun=="SSP"){
				$('#NoNTPN2').val(NoTandaBayar);
				$('#TgNTPN2').datebox('setValue',TglTandaBayar);	
			}
        });			
	})	
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
		url: '<?php echo $basedir ?>models/bc25/bc25_grid.php?req=dg&CAR='+CAR,  
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
			{field:'KdGunaBarang',title:'Kode Peng<br>Barang',width:100},
			{field:'Negara',title:'Negara Asal<br>Barang',width:75},
			{field:'Tarif',title:'Tarif<br>BM, Cukai, PPN,<br>PPnBM, PPh',width:100},
			{field:'qty',title:'Jumlah',width:50,align:"right"},
			{field:'NETTO',title:'Berat<br>Bersih<br>(kg)',width:50,align:"right"},
			{field:'VOL',title:'Volume<br>(m3)',width:50,align:"right"},
			{field:'CIF',title:'CIF',width:50,align:"right"},
			{field:'HrgSerah',title:'Harga Serah',width:75,align:"right"}
		]],
		url: '<?php echo $basedir ?>models/bc25/bc25_grid.php?req=dg2&CAR='+CAR,  
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
		url: '<?php echo $basedir ?>models/bc25/bc25_grid.php?req=outdet&matout_id='+row.matout_id
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
			
	$('#dg3').datagrid({  
		title:"Data Penggunaan Barang", 
		width:690,
		height:200,
		toolbar:"#toolbar3",  
		frozenColumns:[[  
			{field:'KdJnsDok',title:'Jenis<br>BC',width:50,formatter:function(value){				
				return bcFormat(value);				
			},editor:{type:'combobox',  
					options:{                          
						valueField:'KdJnsDok',
						textField:'UrJnsDok',
						data:jenis_bc,
						required:true		  
					}
			}},  
			{field:'NoAju',title:'No. Aju',width:75},
			{field:'NoUrut',title:'No. Urut<br>dlm BC',width:50},
			{field:'KdBarang',title:'Kode<br>Barang',width:75},  
			{field:'UrBarang',title:'Uraian',width:150},
		]],
		columns:[[  			  
			{field:'qty',title:'Jumlah',width:50,align:"right"},
			{field:'CIF',title:'CIF',width:50,align:"right"},
			{field:'BM',title:'BM',width:75,align:"right"},
			{field:'Cukai',title:'Cukai',width:75,align:"right"},
			{field:'PPN',title:'PPN',width:75,align:"right"},
			{field:'PPnBM',title:'PPnBM',width:75,align:"right"},
			{field:'PPh',title:'PPh',width:75,align:"right"}
		]],
		url: '<?php echo $basedir ?>models/bc25/bc25_grid.php?req=dg3&CAR='+CAR,  
		saveUrl: '',  
		updateUrl: '',  
		destroyUrl: '',
		onAdd:function(index,row){rowIndex=index;setEditing(rowIndex);},			
		onDblClickRow:function(index,row){rowIndex=index;setEditing(rowIndex);}		
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
			{field:'FCAR',title:'No. Pengajuan',width:60},
			{field:'FNoDaf',title:'No. Pendaftaran',width:50},
			{field:'FTgDaf',title:'Tgl. Pendaftaran',width:50},
			{field:'KdJnsTpbAsal',title:'Jenis TPB',width:60,formatter:function(value){				
				return tpbFormat(value);				
			},editor:{type:'combobox',  
					options:{                          
						valueField:'KdJnsTpb',
						textField:'UrJnsTpb',
						data:jenis_tpb,
						required:true		  
					}
			}},
			{field:'NmTuj',title:'Pembeli',width:100}
		]],
		url: '<?php echo $basedir ?>models/bc25/bc25_grid.php?req=dgCari', 
		saveUrl: '',  
		updateUrl: '',  
		destroyUrl: '',
		onClickRow:function(index,row){insert_bc(row)}
		
	});
}

function setEditing(rowIndex){
	var editors = $('#dg2').datagrid('getEditors', rowIndex);
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
	}
}

function setEditing2(rowIndex){
	var editors = $('#dg4').datagrid('getEditors', rowIndex);
	var fCIF = editors[12];
	var fBM = editors[13];
	var fPPN = editors[14];
	var fPPh = editors[15];
		
	fCIF.target.bind('change', function(){
		calculate2();
	});
	function calculate2(){		
		CIF=Number(fCIF.target.val());		
		setTimeout(function(){			
			BM=CIF*0.15;
			PPN=CIF*0.10;
			PPh=CIF*0.025;
			fBM.target.val(BM);
			fPPN.target.val(PPN);
			fPPh.target.val(PPh);
		}, 100);
	}
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
	var PNBP = Number($('#PNBP').numberbox('getValue'));
	var DBBMCukai = Number($('#DBBMCukai').numberbox('getValue'));
	var BungaPPNPPnBM = Number($('#BungaPPNPPnBM').numberbox('getValue'));
	
	var tot = BM+Cukai+PPN+PPnBM+PPh+PNBP+DBBMCukai+BungaPPNPPnBM;
	
	//$('#CIF').numberbox('setValue',tot);
	$('#Total').numberbox('setValue',tot);
}

function totJaminanH(){		
	var BM = Number($('#BM2').numberbox('getValue'));
	var Cukai = Number($('#Cukai2').numberbox('getValue'));
	var PPN = Number($('#PPN2').numberbox('getValue'));
	var PPnBM = Number($('#PPnBM2').numberbox('getValue'));
	var PPh = Number($('#PPh2').numberbox('getValue'));
	var PNBP = Number($('#PNBP2').numberbox('getValue'));
	var DBBMCukai = Number($('#DBBMCukai').numberbox('getValue'));
	var BungaPPNPPnBM = Number($('#BungaPPNPPnBM').numberbox('getValue'));

	tot = BM+Cukai+PPN+PPnBM+PPh+PNBP+DBBMCukai+BungaPPNPPnBM;
	//$('#CIF').numberbox('setValue',tot);
	$('#TotalH').numberbox('setValue',tot);
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
		$('#KdGunaBarang').val(row.KdGunaBarang);
		$('#Tarif').val(row.Tarif);
		$('#qty').numberbox('setValue',row.qty);
		$('#NETTO2').numberbox('setValue',row.NETTO);
		$('#VOL2').numberbox('setValue',row.VOL);
		$('#CIF2').numberbox('setValue',row.CIF);
		$('#HrgSerah2').numberbox('setValue',row.HrgSerah);
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
				KdGunaBarang: $('#KdGunaBarang').val(),
				Tarif: $('#Tarif').val(),
				qty: $('#qty').numberbox('getValue'),
				NETTO: $('#NETTO2').numberbox('getValue'),
				VOL: $('#VOL2').numberbox('getValue'),
				CIF: $('#CIF2').numberbox('getValue'),
				HrgSerah: $('#HrgSerah2').numberbox('getValue')
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
		KdGunaBarang: $('#KdGunaBarang').val(),
		Tarif: $('#Tarif').val(),
		qty: $('#qty').numberbox('getValue'),
		NETTO: $('#NETTO2').numberbox('getValue'),
		VOL: $('#VOL2').numberbox('getValue'),
		CIF: $('#CIF2').numberbox('getValue'),
		HrgSerah: $('#HrgSerah2').numberbox('getValue')
	});
}

function tl3Tbh(){
	$('#dlgBarang2').dialog('open').dialog('setTitle','Tambah Data Penggunaan Barang');
}

function tl3Ubh(){
	var row = $('#dg3').datagrid('getSelected');	
	if (row){
		$('#dlgBarang2').dialog('open').dialog('setTitle','Ubah Data Penggunaan Barang');
		$('#KdJnsDok').val(row.KdJnsDok);
		$('#NoAju').val(row.NoAju);
		$('#NoUrut').val(row.NoUrut);
		$('#KdBarang2').val(row.KdBarang);
		$('#UrBarang2').val(row.UrBarang);
		$('#qty2').numberbox('setValue',row.qty);
		$('#CIF3').numberbox('setValue',row.CIF);
		$('#BM3').numberbox('setValue',row.BM);
		$('#Cukai3').numberbox('setValue',row.Cukai);
		$('#PPN3').numberbox('setValue',row.PPN);
		$('#PPnBM3').numberbox('setValue',row.PPnBM);
		$('#PPh3').numberbox('setValue',row.PPh);
	}
}

function tl3Ubh2(){
	var row = $('#dg3').datagrid('getSelected');
	if (row){
		var index = $('#dg3').datagrid('getRowIndex', row);
		$('#dg3').datagrid('updateRow',{
			index: index, 
			row: { 
				KdJnsDok: $('#KdJnsDok').val(),
				NoAju: $('#NoAju').val(),
				NoUrut: $('#NoUrut').val(),
				KdBarang: $('#KdBarang2').val(),
				UrBarang: $('#UrBarang2').val(),				
				qty: $('#qty2').numberbox('getValue'),				
				CIF: $('#CIF3').numberbox('getValue'),
				BM: $('#BM3').numberbox('getValue'),
				Cukai: $('#Cukai3').numberbox('getValue'),
				PPN: $('#PPN3').numberbox('getValue'),
				PPnBM: $('#PPnBM3').numberbox('getValue'),
				PPh: $('#PPh3').numberbox('getValue')
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
		KdJnsDok: $('#KdJnsDok').val(),
		NoAju: $('#NoAju').val(),
		NoUrut: $('#NoUrut').val(),
		KdBarang: $('#KdBarang2').val(),
		UrBarang: $('#UrBarang2').val(),				
		qty: $('#qty2').numberbox('getValue'),				
		CIF: $('#CIF3').numberbox('getValue'),
		BM: $('#BM3').numberbox('getValue'),
		Cukai: $('#Cukai3').numberbox('getValue'),
		PPN: $('#PPN3').numberbox('getValue'),
		PPnBM: $('#PPnBM3').numberbox('getValue'),
		PPh: $('#PPh3').numberbox('getValue')
	});
}

function setNoAju(){
	$("#noaju_load").load('<?php echo $basedir ?>models/getNoAju.php',{
		DokKdBc:$("#KdJnsDok").val()
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
		KdGunaBarang_val="";
		Tarif_val="";
		qty_val="";
		NETTO_val="";
		VOL_val="";
		CIF_val="";
		HrgSerah_val="";
		j=1;
		var rows = $('#dg2').datagrid('getRows');
		for(var i=0; i<rows.length; i++){
			nolist2_val += j+i + "`";		
			KdBarang_val += rows[i].KdBarang + "`";
			UrBarang_val += rows[i].UrBarang + "`";
			Negara_val += rows[i].Negara + "`";
			KdGunaBarang_val += rows[i].KdGunaBarang + "`";
			Tarif_val += rows[i].Tarif + "`";
			qty_val += rows[i].qty + "`";
			NETTO_val += rows[i].NETTO + "`";
			CIF_val += rows[i].CIF + "`";
			VOL_val += rows[i].VOL + "`";
			HrgSerah_val += rows[i].HrgSerah + "`";
		}	 	
		//AKHIR FORM LIST BARANG
		
		//FORM LIST  PENGGUNAAN BARANG		
		nolist3_val="";	
		KdJnsDok_val="";
		NoAju_val="";
		NoUrut_val="";
		KdBarang2_val="";
		UrBarang2_val="";
		qty2_val="";
		CIF3_val="";
		BM3_val="";
		Cukai3_val="";
		PPN3_val="";
		PPnBM3_val="";
		PPh3_val="";
		j=1;
		var rows = $('#dg3').datagrid('getRows');
		for(var i=0; i<rows.length; i++){
			nolist3_val += j+i + "`";
			KdJnsDok_val += rows[i].KdJnsDok + "`";
			NoAju_val += rows[i].NoAju + "`";
			NoUrut_val += rows[i].NoUrut + "`";
			KdBarang2_val += rows[i].KdBarang + "`";
			UrBarang2_val += rows[i].UrBarang + "`";
			qty2_val += rows[i].qty + "`";
			CIF3_val += rows[i].CIF + "`";
			BM3_val += rows[i].BM + "`";
			Cukai3_val += rows[i].Cukai + "`";
			PPN3_val += rows[i].PPN + "`";
			PPnBM3_val += rows[i].PPnBM + "`";
			PPh3_val += rows[i].PPh + "`";
		}	 	
		//AKHIR FORM LIST PENGGUNAAN BARANG
			
		$.post("<?php echo $basedir ?>models/bc25/bc25_tuh.php", { 
		DokKdBc: 3,
		fhidden: $('#fhidden').val(),
		CAR: $('#CAR').val().replace(".",""),
		KdKpbcAsal: $('#KdKpbcAsal').val(),
		KdJnsTpbAsal: $('#KdJnsTpbAsal').val(),
		JnsBc25: $('#JnsBc25').val(),
		kondisibrg: $('#kondisibrg').val(),
		
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
		CIF: $('#CIF').numberbox('getValue'),
		HrgSerah: $('#HrgSerah').numberbox('getValue'),
				
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
		PNBP: $('#PNBP').numberbox('getValue'),
		DBBMCukai: $('#DBBMCukai').numberbox('getValue'),
		BungaPPNPPnBM: $('#BungaPPNPPnBM').numberbox('getValue'),
		Total: $('#Total').numberbox('getValue'),
		
		BM2: $('#BM2').numberbox('getValue'),
		Cukai2: $('#Cukai2').numberbox('getValue'),
		PPN2: $('#PPN2').numberbox('getValue'),
		PPnBM2: $('#PPnBM2').numberbox('getValue'),
		PPh2: $('#PPh2').numberbox('getValue'),
		PNBP2: $('#PNBP2').numberbox('getValue'),
		DBBMCukai2: $('#DBBMCukai2').numberbox('getValue'),
		BungaPPNPPnBM2: $('#BungaPPNPPnBM2').numberbox('getValue'),
		TotalH: $('#TotalH').numberbox('getValue'),

		NoSSCP: $('#NoSSCP').val(),
		NoNTB: $('#NoNTB').val(),
		NoNTPN: $('#NoNTPN').val(),
		NoSSP: $('#NoSSP').val(),
		NoNTB2: $('#NoNTB2').val(),
		NoNTPN2: $('#NoNTPN2').val(),
		
		TgSSCP: $('#TgSSCP').combo('getValue'),
		TgNTB: $('#TgNTB').combo('getValue'),
		TgNTPN: $('#TgNTPN').combo('getValue'),
		TgSSP: $('#TgSSP').combo('getValue'),
		TgNTB2: $('#TgNTB2').combo('getValue'),
		TgNTPN2: $('#TgNTPN2').combo('getValue'),
		
		nolist:nolist_val,DokKd:DokKd_val,DokNo:DokNo_val,
		DokTgDmy:DokTgDmy_val,
		//FORM LIST DATA BARANG	
		nolist2:nolist2_val,KdBarang:KdBarang_val,
		UrBarang:UrBarang_val,Negara:Negara_val,KdGunaBarang:KdGunaBarang_val,
		Tarif:Tarif_val,qty:qty_val,NETTO2:NETTO_val,VOL2:VOL_val,
		CIF2:CIF_val,HrgSerah2:HrgSerah_val,		
		
		nolist3:nolist3_val,KdJnsDok:KdJnsDok_val,NoAju:NoAju_val,NoUrut:NoUrut_val,
		KdBarang2:KdBarang2_val,UrBarang2:UrBarang2_val,qty2:qty2_val,
		CIF3:CIF3_val,BM3:BM3_val,Cukai3:Cukai3_val,PPN3:PPN3_val,PPnBM3:PPnBM3_val,PPh3:PPh3_val
		},
		function(data){
			$.messager.alert('Info',data);
			//alert(data);
			location.reload(true);		
		});
	}//Akhir Validasi
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
		url:"<?php echo $basedir ?>models/bc25/bc25_grid.php?req=dgCari&dtdari="+$('#dtdari').datebox('getValue')+"&dtsampai="+$('#dtsampai').datebox('getValue')
	});
	$('#dgCari').datagrid('load');
}
</script>	