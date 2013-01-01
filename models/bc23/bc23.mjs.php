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
$q="SELECT * FROM mst_status_petikemas ORDER BY KdStPetiKemas ";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
?>
status_petikemas = <?php echo json_encode($rs) ?>;

<?php 
$q="SELECT CONCAT(LEFT(NoDaf,3),'.',RIGHT(NoDaf,3)) AS nobcasal,DATE_FORMAT(TgDaf,'%d/%m/%Y') AS TgDaf_dmy FROM header WHERE DokKdBC='6' ORDER BY CAR";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
?>
bcasal = <?php echo json_encode($rs) ?>;

function bcasalFormat(value){
	for(var i=0; i<bcasal.length; i++){
		if (bcasal[i].nobcasal == value) return bcasal[i].nobcasal;
	}
	return value;
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
	$('#NoBcAsal').combobox('disable');
	$('#TgBcAsal').combo('disable');
	$('#toolbar').hide();
	$('#toolbar2').hide();
	$('#toolPetiKemas').hide();
	$('#dtdari').combo('enable');
	$('#dtsampai').combo('enable');
}

function enInput() { // Enable Input
	$(":input").attr('disabled',false);
	$('#TgDaf').combo('enable');
	$('#NoBcAsal').combobox('enable');
	$('#TgBcAsal').combo('enable');
}


function insert_bc(row){
	$('#wCari').window('close');
	$("#fhidden").val(row.CAR);
	$("#KdKpbcAsal").val(row.KdKpbcAsal);	
	$("#CAR").val(row.FCAR);
	$("#KdJnsTpbAsal").val(row.KdJnsTpbAsal);
	$('#KdJnsBarang').val(row.KdJnsBarang);
	$("#KdTp").val(row.KdTp);
	
	$("#NoDaf").val(row.NoDaf);
	$("#TgDaf").datebox('setValue',row.FTgDaf);
	$('#KdKpBongkar').val(row.KdKpBongkar);
	$('#KdKpPengawas').val(row.KdKpPengawas);
	//Form Penanggung Jawab dan Pejabat BC	
	$("#NmPengusaha").val(row.NmPengusaha);
	$("#NipPengusaha").val(row.NipPengusaha);
	$("#NmPejabat").val(row.NmPejabat);
	$("#NipPejabat").val(row.NipPejabat);
	$("#ref_id").combogrid('setValue',row.ref_id);
	//Form Pemasok	
	$("#NmTuj").val(row.NmTuj);
	//Form PPJK
	$('#NmPpjk').val(row.NmPpjk);	
	//Form Pengangkutan
	$('#CaraAngkut').val(row.CaraAngkut);
	$('#NmAngkut').val(row.NmAngkut);
	$('#NoPolisi').val(row.NoPolisi);
	//Form Pelabuhan
	$('#KdMuatAsal').val(row.MuatAsal);
	$('#KdTransit').val(row.Transit);
	$('#KdBongkar').val(row.Bongkar);
	$('#KdTimbun').val(row.KdTimbun);
	//Form Data Perdagangan/Atau Transaksi
	$('#KdVal').val(row.KdVal);
	$('#NDPBM').numberbox('setValue',row.NDPBM);
	$('#FOB').numberbox('setValue',row.FOB);
	$('#Freight').numberbox('setValue',row.Freight);
	$('#CIF').numberbox('setValue',row.CIF);
	$('#AsLNDN').numberbox('setValue',row.AsLNDN);
	//FORM PENGEMAS
	$('#KdKemas').val(row.KdKemas);	
	$('#JmlKemas').numberbox('setValue',row.JmlKemas);
	$('#MerekKemas').val(row.MerekKemas);	
	//FORM DATA BARANG
	$('#BRUTO').numberbox('setValue',row.BRUTO);
	$('#NETTO').numberbox('setValue',row.NETTO);	
	$('#Total').numberbox('setValue',row.Total);
	$('#TotalH').numberbox('setValue',row.TotalH);
		
	//Untuk Datagrid
	setdg();
	setdgPetiKemas();
	setdg2();
	insert_jaminan(row.CAR);
	
	dsbtnTbh();
	enbtnUbh();
	dsbtnSim();
	enbtnHps();
	enbtnBtl();
}

function insert_jaminan(CAR){
	$.getJSON("<?php echo $basedir ?>models/getJaminan.php",{
		DokKdBc:1,
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
				$('#BM3').val(KodeAkun);
				$('#BM4').val(NoTandaBayar);
				$('#BM5').datebox('setValue',TglTandaBayar);         
			} else if (JnsJaminan=="Cukai"){
				$('#Cukai').numberbox('setValue',bayar);
				$('#Cukai2').numberbox('setValue',hutang);
				$('#Cukai3').val(KodeAkun);
				$('#Cukai4').val(NoTandaBayar);
				$('#Cukai5').datebox('setValue',TglTandaBayar);
			} else if (JnsJaminan=="PPN"){	
				$('#PPN').numberbox('setValue',bayar);
				$('#PPN2').numberbox('setValue',hutang);
				$('#PPN3').val(KodeAkun);
				$('#PPN4').val(NoTandaBayar);
				$('#PPN5').datebox('setValue',TglTandaBayar);	
			} else if (JnsJaminan=="PPnBM"){
				$('#PPnBM').numberbox('setValue',bayar);
				$('#PPnBM2').numberbox('setValue',hutang);
				$('#PPnBM3').val(KodeAkun);
				$('#PPnBM4').val(NoTandaBayar);
				$('#PPnBM5').datebox('setValue',TglTandaBayar);
			} else if (JnsJaminan=="PPh"){
				$('#PPh').numberbox('setValue',bayar);
				$('#PPh2').numberbox('setValue',hutang);
				$('#PPh3').val(KodeAkun);
				$('#PPh4').val(NoTandaBayar);
				$('#PPh5').datebox('setValue',TglTandaBayar);
			} else if (JnsJaminan=="PNBP"){
				$('#PNBP').numberbox('setValue',bayar);
				$('#PNBP2').numberbox('setValue',hutang);
				$('#PNBP3').val(KodeAkun);
				$('#PNBP4').val(NoTandaBayar);
				$('#PNBP5').datebox('setValue',TglTandaBayar);
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
			{field:'DokKd',title:'Jenis Dokumen',width:50,formatter:function(value){
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
			{field:'DokNo',title:'Nomor',width:100,editor:{type:'validatebox',options:{required:true}}},  
			{field:'DokTgDmy',title:'Tanggal',width:50,align:'center',editor:{type:'datebox'}}
		]],
		url: '<?php echo $basedir ?>models/bc23/bc23_grid.php?req=dg&CAR='+CAR,  
		saveUrl: '',  
		updateUrl: '',  
		destroyUrl: '',
		onAdd:function(index,row){rowIndex=index;},
		onDblClickRow:function(index,row){rowIndex=index;}
		
	});
}

function setdgPetiKemas(){
	if ($('#fhidden').val()!=''){		
		var CAR = $('#fhidden').val();	
	} else {
		var CAR = $('#CAR').val();	
	}
	
	$('#dgPetiKemas').edatagrid({ 
	    title:"Peti Kemas", 
		width:550,
		height:150,
		fitColumns:"true",
		rownumbers:"true",
		toolbar:"#toolPetiKemas",  
		columns:[[  
			{field:'Merk',title:'Merek',width:100,editor:{type:'validatebox',options:{required:true}}},  
			{field:'Nomor',title:'Nomor',width:50,editor:{type:'validatebox',options:{required:true}}},  
			{field:'Ukuran',title:'Ukuran',width:50,editor:{type:'validatebox'}},
			{field:'Tipe',title:'Tipe',width:50,editor:{type:'validatebox'}}
		]],
		url: '<?php echo $basedir ?>models/bc23/bc23_grid.php?req=dgPetiKemas&CAR='+CAR,  
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
		fitColumns:"true",
		rownumbers:"true",
		toolbar:"#toolbar2",  
		columns:[[  
			{field:'KdBarang',title:'Kode<br>Barang',width:50},  
			{field:'UrBarang',title:'Uraian',width:100},  
			{field:'KdGunaBarang',title:'Kode Peng<br>Barang',width:50},
			{field:'Tarif',title:'Tarif<br>BM, Cukai, PPN,<br>PPnBM, PPh',width:100},
			{field:'qty',title:'Jumlah',width:50,align:"right"},
			{field:'NETTO',title:'Berat<br>Bersih (kg)',width:50,align:"right"},
			{field:'CIF',title:'CIF',width:50,align:"right"}
		]],
			url: '<?php echo $basedir ?>models/bc23/bc23_grid.php?req=dg2&CAR='+CAR,  
			saveUrl: '',  
			updateUrl: '',  
			destroyUrl: '',
			onAdd:function(index,row){rowIndex=index;setEditing(rowIndex);},			
			onDblClickRow:function(index,row){rowIndex=index;setEditing(rowIndex);}		
	});	
}

function setdg2Url(row){
	$('#HrgSerah').numberbox('setValue',row.tot_amount);
	$('#dg2').datagrid({  
		url: '<?php echo $basedir ?>models/bc23/bc23_grid.php?req=indet&matin_id='+row.matin_id
	});
}

function setUrBarang(){
	$.post("<?php echo $basedir ?>models/getField.php",{
		NmTabel: 'mst_barang',
		NmKolom1: 'Ket',
		NmKolom2: 'KdBarang',
		field: $('#KdBarang').val()
	},function(result){
		$('#UrBarang').val(result);	
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
			{field:'JnsBarang',title:'Jenis Barang',width:60,editor:{type:'validatebox',options:{required:true}}},
			{field:'NmTuj',title:'Pemasok',width:100,editor:{type:'validatebox',options:{required:true}}}
		]],
		url: '<?php echo $basedir ?>models/bc23/bc23_grid.php?req=dgCari', 
		saveUrl: '',  
		updateUrl: '',  
		destroyUrl: '',
		onClickRow:function(index,row){insert_bc(row)}
		
	});
}

function setEditing(rowIndex){
	/*var editors = $('#dg2').datagrid('getEditors', rowIndex);
	var fqty = editors[3];
	var fprice = editors[5];
	var fkurs = editors[6];
	var fharga = editors[10];
		
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

function tl2Tbh(){
	$('#dlgBarang').dialog('open').dialog('setTitle','Tambah Data Barang');
}

function tl2Ubh(){
	var row = $('#dg2').datagrid('getSelected');	
	if (row){
		$('#dlgBarang').dialog('open').dialog('setTitle','Ubah Data Barang');
		$('#fm').form('load',row);
	}
}

function tl2Ubh2(){
	var row = $('#dg2').datagrid('getSelected');
	if (row){
		var index = $('#dg2').datagrid('getRowIndex', row);
		$('#dg2').datagrid('updateRow',{
			index: index, 
			row: { KdBarang: $('#KdBarang').val(),UrBarang: $('#UrBarang').val(),	KdGunaBarang: $('#KdGunaBarang').val(),Tarif: $('#Tarif').val(),qty: $('#qty').numberbox('getValue'),NETTO: $('#NETTO').numberbox('getValue'),CIF: $('#CIF2').numberbox('getValue')}
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
		KdGunaBarang: $('#KdGunaBarang').val(),
		Tarif: $('#Tarif').val(),
		qty: $('#qty').numberbox('getValue'),
		NETTO: $('#NETTO2').numberbox('getValue'),
		CIF: $('#CIF2').numberbox('getValue')
	});
}

function totJaminan(){		
	var BM = Number($('#BM').numberbox('getValue'));
	var Cukai = Number($('#Cukai').numberbox('getValue'));
	var PPN = Number($('#PPN').numberbox('getValue'));
	var PPnBM = Number($('#PPnBM').numberbox('getValue'));
	var PPh = Number($('#PPh').numberbox('getValue'));
	var PNBP = Number($('#PNBP').numberbox('getValue'));

	tot = BM+Cukai+PPN+PPnBM+PPh+PNBP;
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

	tot = BM+Cukai+PPN+PPnBM+PPh+PNBP;
	//$('#CIF').numberbox('setValue',tot);
	$('#TotalH').numberbox('setValue',tot);
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
		//AKHIR LIST DOK PELENGKAP
		
		//LIST PETI KEMAS
		nolistPK_val="";
		Merk_val="";
		Nomor_val="";
		Ukuran_val="";
		Tipe_val="";
		j=1;
		var rows = $('#dgPetiKemas').datagrid('getRows');
		for(var i=0; i<rows.length; i++){
			nolistPK_val += j+i + "`";
			Merk_val += rows[i].Merk + "`";
			Nomor_val += rows[i].Nomor + "`";
			Ukuran_val += rows[i].Ukuran + "`";
			Tipe_val += rows[i].Tipe + "`";
		}
		//AKHIR LIST PETI KEMAS
		
		//FORM LIST BARANG
		nolist2_val="";	
		KdBarang_val="";
		UrBarang_val="";
		KdGunaBarang_val="";
		Tarif_val="";
		qty_val="";
		NETTO_val="";
		CIF_val="";
		j=1;
		var rows = $('#dg2').datagrid('getRows');
		for(var i=0; i<rows.length; i++){
			nolist2_val += j+i + "`";		
			KdBarang_val += rows[i].KdBarang + "`";
			UrBarang_val += rows[i].UrBarang + "`";
			KdGunaBarang_val += rows[i].KdGunaBarang + "`";
			Tarif_val += rows[i].Tarif + "`";
			qty_val += rows[i].qty + "`";
			NETTO_val += rows[i].NETTO + "`";
			CIF_val += rows[i].CIF + "`";
		}	 	
		//AKHIR FORM LIST BARANG
			
		$.post("<?php echo $basedir ?>models/bc23/bc23_tuh.php", { 
		//Form Header
		DokKdBc: 1,
		fhidden: $('#fhidden').val(),
		KdKpbcAsal: $('#KdKpbcAsal').val(),
		CAR: $('#CAR').val().replace(".",""),	
		KdJnsTpbAsal: $('#KdJnsTpbAsal').val(),
		KdJnsBarang: $('#KdJnsBarang').val(),
		KdTp: $('#KdTp').val(),
		
		NoDaf: $('#NoDaf').val().replace(".",""),
		TgDaf: $('#TgDaf').combo('getValue'),
		KdKpBongkar: $('#KdKpBongkar').val(),
		KdKpPengawas: $('#KdKpPengawas').val(),
		//Form Penanggung Jawab dan Pejabat BC
		NmPengusaha: $('#NmPengusaha').val(),
		NipPengusaha: $('#NipPengusaha').val(),
		NmPejabat: $('#NmPejabat').val(),
		NipPejabat: $('#NipPejabat').val(),
		ref_id: $('#ref_id').combo('getValue'),
		//Form Pemasok	
		NmTuj: $('#NmTuj').val(),
		//Form PPJK
		NmPpjk: $('#NmPpjk').val(),	
		//Form Pengangkutan
		CaraAngkut: $('#CaraAngkut').val(),
		NmAngkut: $('#NmAngkut').val(),
		NoPolisi: $('#NoPolisi').val(),
		//Form Pelabuhan
		KdMuatAsal: $('#KdMuatAsal').val(),
		KdTransit: $('#KdTransit').val(),
		KdBongkar: $('#KdBongkar').val(),
		KdTimbun: $('#KdTimbun').val(),
		//Form Data Perdagangan/Atau Transaksi
		KdVal: $('#KdVal').val(),
		NDPBM: $('#NDPBM').numberbox('getValue'),
		FOB: $('#FOB').numberbox('getValue'),
		Freight: $('#Freight').numberbox('getValue'),
		CIF: $('#CIF').numberbox('getValue'),
		AsLNDN: $('#AsLNDN').numberbox('getValue'),
		//Form Dokumen Pelengkap Pabean
		nolist:nolist_val,
		DokKd:DokKd_val,DokNo:DokNo_val,
		DokTgDmy:DokTgDmy_val,		
		//FORM PENGEMAS
		nolistPK:nolistPK_val,Merk:Merk_val,
		Nomor:Nomor_val,Ukuran:Ukuran_val,Tipe:Tipe_val,	
		KdKemas: $('#KdKemas').val(),	
		JmlKemas: $('#JmlKemas').numberbox('getValue'),
		MerekKemas: $('#MerekKemas').val(),	
		//FORM DATA BARANG
		BRUTO: $('#BRUTO').numberbox('getValue'),
		NETTO: $('#NETTO').numberbox('getValue'),
		//FORM LIST DATA BARANG	
		nolist2:nolist2_val,KdBarang:KdBarang_val,
		UrBarang:UrBarang_val,KdGunaBarang:KdGunaBarang_val,
		Tarif:Tarif_val,qty:qty_val,NETTO2:NETTO_val,CIF2:CIF_val,
		//FORM DATA JAMINAN
		BM: $('#BM').numberbox('getValue'),
		BM2: $('#BM2').numberbox('getValue'),
		BM3: $('#BM3').val(),
		BM4: $('#BM4').val(),
		BM5: $('#BM5').combo('getValue'),
		Cukai: $('#Cukai').numberbox('getValue'),
		Cukai2: $('#Cukai2').numberbox('getValue'),
		Cukai3: $('#Cukai3').val(),
		Cukai4: $('#Cukai4').val(),
		Cukai5: $('#Cukai5').combo('getValue'),
		PPN: $('#PPN').numberbox('getValue'),
		PPN2: $('#PPN2').numberbox('getValue'),
		PPN3: $('#PPN3').val(),
		PPN4: $('#PPN4').val(),
		PPN5: $('#PPN5').combo('getValue'),
		PPnBM: $('#PPnBM').numberbox('getValue'),
		PPnBM2: $('#PPnBM2').numberbox('getValue'),
		PPnBM3: $('#PPnBM3').val(),
		PPnBM4: $('#PPnBM4').val(),
		PPnBM5: $('#PPnBM5').combo('getValue'),
		PPh: $('#PPh').numberbox('getValue'),
		PPh2: $('#PPh2').numberbox('getValue'),
		PPh3: $('#PPh3').val(),
		PPh4: $('#PPh4').val(),
		PPh5: $('#PPh5').combo('getValue'),
		PNBP: $('#PNBP').numberbox('getValue'),
		PNBP2: $('#PNBP2').numberbox('getValue'),
		PNBP3: $('#PNBP3').val(),
		PNBP4: $('#PNBP4').val(),
		PNBP5: $('#PNBP5').combo('getValue'),
		Total: $('#Total').numberbox('getValue'),
		TotalH: $('#TotalH').numberbox('getValue')
		},
		function(result){
			var result = eval('('+result+')');
			if (result.success){
				$.messager.alert('Info',result.msg); 
				location.reload(true);
			} else {
				$.messager.show({
					title: 'Error',
					msg: result.msg
				});
			}	
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
		url:"<?php echo $basedir ?>models/bc23/bc23_grid.php?req=dgCari&dtdari="+$('#dtdari').combo('getValue')+"&dtsampai="+$('#dtsampai').combo('getValue')
	});
	$('#dgCari').datagrid('load');
}
</script>	