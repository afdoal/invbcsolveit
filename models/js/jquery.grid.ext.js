//Array Nama-Nama Form Input
var frmUmum = new Array("CAR","KdTp","KdKpbcAsal","KdKpbcTuj","KdJnsTpbAsal","KdJnsTpbTuj","NoDaf","TgDaf","fnpwp_pngsh","fnm_pngsh","falmt_pngsh","fkota_pngsh","fno_itpb","NpwpTuj","NmTuj","AlamatTuj","NoTpbTuj","NoBcAsal","TgBcAsal","KdVal","CIF","HrgSerah","JnsAngkut","NoPolisi","NoSegel","JnsSegel","CatBcTuj","MerekKemas","KdKemas","JmlKemas","VOL","BRUTO","NETTO","NmPengusaha","NipPengusaha","NmPejabat","NipPejabat");

$(function(){
$('#pilmatin').hide();
$('#popmatin').hide();

$('.easyui-numberbox').css('text-align', 'right');
$('#CAR').mask("999.999");
$('#NoDaf').mask("999.999");
dsInput();
			
//Untuk Loading awal menu tab
$(".tab_content").hide(); //Hide all content
$("ul.tabs li:first").addClass("active").show(); //Activate first tab
$(".tab_content:first").show(); //Show first tab content

//Aksi menu tab ketika diklik
$("ul.tabs li").click(function() {
	$("ul.tabs li").removeClass("active"); //Remove any "active" class
	$(this).addClass("active"); //Add "active" class to selected tab
	$(".tab_content").hide(); //Hide all tab content
	var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
	$(activeTab).fadeIn(); //Fade in the active content
	return false;
});

$('#NoBcAsal').combobox({	
	valueField:'CAR',
	textField:'CAR',
	data:bcasal,
	onSelect:function(record){								
		$('#TgBcAsal').datebox('setValue',record.TgDaf_dmy);
	}
});

  
$('#btnTbh').click(function(){	 	
	$('#pilmatin').show();	
	enbtnBtl();	
});
 
$('#btnUbh').click(function(){
		$('#pilmatin').show();
		$('#popmatin').show();
		enbtnSim();			
		dsbtnHps();
		
		enInput();	
		enTgl();	
});
  
$('#btnSim').click(function(){
if ($('#CAR').val() == ''){
	$.messager.alert('Warning','Nomor pengajuan harus diisi!','warning');
	$('#CAR').focus();
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
		nolist_val += j+i + ",";
		DokKd_val += rows[i].DokKd + ",";
		DokNo_val += rows[i].DokNo + ",";
		DokTgDmy_val += rows[i].DokTgDmy + ",";
	}
	//tes=$('#NoBcAsal').combo('getValue');
	//$.messager.alert('tes//',tes);
	//AHIR LIST DOK PELENGKAP
	
	//FORM LIST BARANG
	nolist2_val="";
	UrBarang_val="";
	fgmat_id_val="";
	VOL_val="";
	NETTO_val="";
	CIF_val="";
	HrgSerah_val=""
	j=1;
	var rows = $('#dg2').datagrid('getRows');
	for(var i=0; i<rows.length; i++){
		nolist2_val += j+i + ",";
		fgmat_id_val += rows[i].fgmat_id + ",";
		UrBarang_val += rows[i].UrBarang + ",";
		VOL_val += rows[i].VOL + ",";
		NETTO_val += rows[i].NETTO + ",";
		CIF_val += rows[i].CIF + ",";
		HrgSerah_val += rows[i].HrgSerah + ",";
	}	 	
	//AKHIR FORM LIST BARANG
		
	$.post("sim_bc27.php", { 
	fhidden: $('#fhidden').val(),
	matoutdo_id: $('#matoutdo_id').val(),
	CAR: $('#CAR').val(),
	KdTp: $('#KdTp').val(),
	KdKpbcAsal: $('#KdKpbcAsal').val(),
	KdKpbcTuj: $('#KdKpbcTuj').val(),
	KdJnsTpbAsal: $('#KdJnsTpbAsal').val(),
	KdJnsTpbTuj: $('#KdJnsTpbTuj').val(),
	NoDaf: $('#NoDaf').val(),
	TgDaf: $('#TgDaf').combo('getValue'),
	
	KdTujKirim: $('#KdTujKirim').val(),
	NpwpTuj: $('#NpwpTuj').val(),
	NmTuj: $('#NmTuj').val(),
	AlamatTuj: $('#AlamatTuj').val(),
	NoTpbTuj: $('#NoTpbTuj').val(),
	
	NoBcAsal: $('#NoBcAsal').combo('getValue'),
	TgBcAsal: $('#TgBcAsal').combo('getValue'),
	KdVal: $('#KdVal').val(),
	CIF: $('#CIF').numberbox('getValue'),
	HrgSerah: $('#HrgSerah').numberbox('getValue'),
	JnsAngkut: $('#JnsAngkut').val(),
	NoPolisi: $('#NoPolisi').val(),
	NoSegel: $('#NoSegel').val(),
	JnsSegel: $('#JnsSegel').val(),
	CatBcTuj: $('#CatBcTuj').val(),
	MerekKemas: $('#MerekKemas').val(),
	KdKemas: $('#KdKemas').val(),
	JmlKemas: $('#JmlKemas').numberbox('getValue'),
	VOL: $('#VOL').numberbox('getValue'),
	BRUTO: $('#BRUTO').numberbox('getValue'),
	NETTO: $('#NETTO').numberbox('getValue'),
	nolist:nolist_val,DokKd:DokKd_val,DokNo:DokNo_val,
	DokTgDmy:DokTgDmy_val,
	nolist2:nolist2_val,fgmat_id:fgmat_id_val,UrBarang:UrBarang_val,VOL2:VOL_val,
	NETTO2:NETTO_val,CIF2:CIF_val,HrgSerah2:HrgSerah_val
	},
	function(data){
		$.messager.alert('Info',data);
		location.reload(true);		
	});
}//Akhir If Validasi
});

$('#btnBtl').click(function(){
	location.reload(true);
});

$('#btnTbhList').click(function(){				
	fnodet = $('#fnodet').val();	
	furaian_brng = $('#furaian_brng').val();		
	fjml_brng = $('#fjml_brng').val();
	fhrg_serah_det = $('#fhrg_serah_det').val();
		
	try{					
	
		/*if($("#btnTbhList").val() != "Ubah List"){
			valid = duplikasiList();
			
			if(valid == true){
				throw "err";
			}
		}*/
		
		if (($('#furaian_brng').val()=='') || ($('#fjml_brng').val() == '') || ($('#fhrg_serah_det').val() == '')){
			throw "err2";
		}
				
		if ($("#btnTbhList").val() != "Ubah List"){				
			//$.messager.alert('Warning',"tes "+cnt);	
			cnt = countaList();
			fnodet = cnt+1											
			x=document.getElementById('list').insertRow(cnt);		
			a = x.insertCell(0);			
			b = x.insertCell(1);
			c = x.insertCell(2);			
			d = x.insertCell(3);
			e = x.insertCell(4);
						
			a.width = '21px';		
			b.width = '342px';
			c.width = '169px';
			d.width = '151px';
			e.width = '42px';
							
			a.style.textAlign='center';	
			c.style.textAlign='right';
			d.style.textAlign='right';		
			e.style.textAlign='center';	
							
			a.innerHTML = fnodet;
			b.innerHTML = furaian_brng;
			c.innerHTML = fjml_brng;			
			d.innerHTML = fhrg_serah_det;
			tes = "COBA";
			e.innerHTML="<img src='img/edit.gif' border='0' class='btnedits' onClick='ubhRowList(no)' style='cursor:pointer' /> <img src='img/drop.gif' border='0' class='btnedits' onClick='hpsRowList(this)' style='cursor:pointer' />";
		}else{
			//$.messager.alert('Warning',"tes ="+cnt);
			n=0;
			var bool = false;
			while (document.getElementById('list').rows[n] !=null &&  bool == false){
				var x=document.getElementById('list').rows[n].cells;
				if(x[0].innerHTML == fnodet){						
					x[1].innerHTML = furaian_brng;
					x[2].innerHTML = fjml_brng;	
					x[3].innerHTML = fhrg_serah_det;	
					bool = true;
				}
				n++;
			}
		}
		clearDetList();
		renumberList();
		$("#btnTbhList").val("Tambah List");	
			
	} catch(err) {
		if (err == "err"){
			$.messager.alert('Warning',"Uraian sudah ada dalam list!");
		} else if(err == "err2") {
			$.messager.alert('Warning',"Data List harus diisi semua!");
		} else { $.messager.alert('Warning',"Terjadi kesalahan!\r\n" + err.message);}
		
	}//AKHIR try
});

$('#btnBtlList').click(function(){
	$("#btnTbhList").val("Tambah List");
	clearDetList();
});

$('#btnHps').click(function () {
if ($('#fhidden').val() != '') {
	$.messager.confirm('Confirm','Are you sure you want to delete record?',function(r){  
		if (r){ 
			$.post("hps_bc.php", { 
			CAR: $('#fhidden').val(),
			DokKdBc: 6
			},function(data){
				$.messager.alert('Warning',data); 
				location.reload(true);
			});
		}
	}); 	
} else {
	$.messager.alert('Warning','Silahkan pilih data yang akan di hapus!');
}
});


    
});//Akhir Document Ready

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
	l = frmUmum.length;
	for (i = 0; i < l; i++) {
		$('#'+frmUmum[i]).attr('disabled',true);
	}
	
	$('#toolbar').hide();
	$('#toolbar2').hide();
}

function enInput() { // Enable Input
	l = frmUmum.length;
	for (i = 0; i < l; i++) {
		$('#'+frmUmum[i]).attr('disabled',false);
	}		
	$('#NoBcAsal').combobox('enable');
	$('#toolbar').show();
	$('#toolbar2').show();	
}


function insert_bc(matoutdo_id,CAR,KdTp,KdKpbcAsal,KdKpbcTuj,KdJnsTpbAsal,KdJnsTpbTuj,NoDaf,TgDaf,KdTujKirim,npwp,cust_name,address,fno_itpb_tuj,NoBcAsal,TgBcAsal,KdVal,CIF,HrgSerah,JnsAngkut,NoPolisi,NoSegel,JnsSegel,CatBcTuj,MerekKemas,KdKemas,JmlKemas,VOL,BRUTO,NETTO){
	$("#matoutdo_id").val(matoutdo_id);
	$("#fhidden").val(CAR);
	$("#CAR").val(CAR);
	$("#KdTp").val(KdTp);
	$("#KdKpbcAsal").val(KdKpbcAsal);
	$("#KdKpbcTuj").val(KdKpbcTuj);
	$("#KdJnsTpbAsal").val(KdJnsTpbAsal);
	$("#KdJnsTpbTuj").val(KdJnsTpbTuj);
	$("#NoDaf").val(NoDaf);
	$("#TgDaf").datebox('setValue',TgDaf);
		
	$("#KdTujKirim").val(KdTujKirim);	
	$("#fnpwp_pngrm").val(npwp);
	$("#fnm_pngrm").val(cust_name);
	$("#falmt_pngrm").val(address);
	$("#fno_itpb_tuj").val(fno_itpb_tuj);
	
	$("#NoBcAsal").val(NoBcAsal);
	$("#TgBcAsal").datebox('setValue',TgBcAsal);
	$("#KdVal").val(KdVal);	
	$("#HrgSerah").val(HrgSerah);
	$("#JnsAngkut").val(JnsAngkut);
	$("#NoPolisi").val(NoPolisi);
	$("#NoSegel").val(NoSegel);
	$("#JnsSegel").val(JnsSegel);
	$("#CatBcTuj").val(CatBcTuj);
	$("#MerekKemas").val(MerekKemas);
	$("#KdKemas").val(KdKemas);
	
	$('#JmlKemas').numberbox('setValue',JmlKemas);
	$('#VOL').numberbox('setValue',VOL);
	$('#BRUTO').numberbox('setValue',BRUTO);
	$('#NETTO').numberbox('setValue',NETTO);
	$('#CIF').numberbox('setValue',CIF);
	$('#HrgSerah').numberbox('setValue',HrgSerah);
	
	//Untuk Datagrid
	setdg2();
	setdg();
	
	dsbtnTbh();
	enbtnUbh();
	dsbtnSim();
	enbtnHps();
	enbtnBtl();
	
	tb_remove();
}

function insert_matouth(matoutdo_id,KdTujKirim,npwp,cust_name,address,fno_itpb_tuj){
	$("#matoutdo_id").val(matoutdo_id);
	$("#KdTujKirim").val(KdTujKirim);	
	$("#fnpwp_pngrm").val(npwp);
	$("#fnm_pngrm").val(cust_name);
	$("#falmt_pngrm").val(address);
	$("#fno_itpb_tuj").val(fno_itpb_tuj);	
	
	$('#popmatoutdo').show();	
		
	dsbtnTbh();	
	enbtnSim();	
	
	enInput();	
	enTgl();
	
	setdg();
	setdg2();	
	tb_remove();
}

function setdg(){		
	var CAR = $('#CAR').val();	
	
	$('#dg').edatagrid({  
		fitColumns:"true",
		rownumbers:"true",
		singleSelect:"true",  
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
		url: 'bc27grid.php?req=dg&CAR='+CAR,  
		saveUrl: '',  
		updateUrl: '',  
		destroyUrl: '',
		onAdd:function(index,row){rowIndex=index;},
		onDblClickRow:function(index,row){rowIndex=index;}
		
	});
}

function setdg2(){	
	var matoutdo_id = $('#matoutdo_id').val();	
	var CAR = $('#CAR').val();	
	
	$.post("databarang.php", { matoutdo_id:matoutdo_id },function(data){
		dtbarang = jQuery.parseJSON(data);			
		
		//$.messager.alert('Warning',dtbarang);
	
		$('#dg2').edatagrid({  
			fitColumns:"true",
			rownumbers:"true",
			singleSelect:"true",  
			columns:[[  
				{field:'fgmat_id',title:'ID',width:50,editor:'text',hidden:'true'},
				{field:'UrBarang',title:'Pos Tarif HS, uraian jumlah dan jenis barang<br>secara lengkap kode barang, merk, tipe, ukuran<br>dan spesifikasi lain',width:150,formatter:function(value){
					for(var i=0; i<dtbarang.length; i++){
						if (dtbarang[i].Material_Code == value) return dtbarang[i].UrBarang;
					}
					return value;				
				},editor:{type:'combobox',  
						options:{                          
							valueField:'UrBarang',
							textField:'UrBarang',
							data:dtbarang,
							required:true,
							onSelect:function(record){								
								var editors = $('#dg2').datagrid('getEditors', rowIndex);
								var fgmat_id = editors[0];
								fgmat_id.target.val(record.Material_Code);
							}					  
						}
				}},  
				{field:'VOL',title:'Volume (m3)',width:50,align:'right',editor:{type:'numberbox',options:{groupSeparator:',', decimalSeparator:'.',precision:2}}},  
				{field:'NETTO',title:'Berat bersih (Kg)',width:55,align:'right',editor:{type:'numberbox',options:{groupSeparator:',', decimalSeparator:'.',precision:2}}},
				{field:'CIF',title:'Nilai CIF',width:40,align:'right',editor:{type:'numberbox',options:{groupSeparator:',', decimalSeparator:'.',precision:2}}},
				{field:'HrgSerah',title:'Harga Penyerahan',width:60,align:'right',editor:{type:'numberbox',options:{groupSeparator:',', decimalSeparator:'.',precision:2}}}   
			]],
			url: 'bc27grid.php?req=dg2&CAR='+CAR,  
			saveUrl: '',  
			updateUrl: '',  
			destroyUrl: '',
			onAdd:function(index,row){rowIndex=index;},
			onDblClickRow:function(index,row){rowIndex=index;}
			
		});
	});		
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