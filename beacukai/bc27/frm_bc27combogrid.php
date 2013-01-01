<?php
require_once "../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
require_once "class_tgl.php" ;
$objAngka = new classAkunting();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
	<meta name="Author" content="Kikin Kusumah" />
    <link type="text/css" href="<?php echo $basedir ?>themes/main.css" rel="Stylesheet" />
    
    <link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>themes/icon.css">
    <link type="text/css" href="<?php echo $basedir; ?>themes/redmond/jquery-ui-1.8.4.custom.css" rel="Stylesheet" />
     
	<script type="text/javascript" src="<?php echo $basedir ?>models/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $basedir ?>models/jquery-ui-1.8.4.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo $basedir ?>models/jquery.metadata.js"></script>    
    <script type="text/javascript" src="<?php echo $basedir ?>models/autoNumeric-1.7.1.js"></script>
    <script type="text/javascript" src="<?php echo $basedir ?>models/masked.js"></script>
	<script type="text/javascript" src="<?php echo $basedir ?>models/frm_bc27.js"></script>   
    <script src="<?php echo $basedir ?>js/thickbox.js"></script> 
    <script type="text/javascript" src="<?php echo $basedir; ?>models/jquery.grid.min.js"></script>
    <script type="text/javascript" src="<?php echo $basedir; ?>models/jquery.edatagrid.js"></script>
    <script type="text/javascript">   
		$.extend($.fn.datagrid.defaults.editors, {
			numberspinner: {
				init: function(container, options){
					var input = $('<input type="text">').appendTo(container);
					return input.numberspinner(options);
				},
				destroy: function(target){
					$(target).numberspinner('destroy');
				},
				getValue: function(target){
					return $(target).numberspinner('getValue');
				},
				setValue: function(target, value){
					$(target).numberspinner('setValue',value);
				},
				resize: function(target, width){
					$(target).numberspinner('resize',width);
				}
			},
			combogrid:{
				init:function(container, options){
					var input=$("<input type=\"text\">").appendTo(container);
						input.combogrid(options||{});
					return input.combogrid(options);;
				},
				destroy:function(target){
					$(target).combogrid("destroy");
				},
				getValue:function(target){
					return $(target).combogrid("getValue");
				},
				setValue:function(target,value){
					$(target).combogrid("setValue",value);
				},
				resize:function(value,width){
					$(value).combogrid("resize",width);
			}}
		}); 
		
	<?php 
		$q="SELECT * FROM kode_jenis_dok ORDER BY KdKdJnsDok ";
		$run = $pdo->query($q);
		$rs = $run->fetchAll(PDO::FETCH_ASSOC);
	?>
		var jenis_dok = <?php echo json_encode($rs) ?>;
    </script>	
<body>
<div class="demo-c">
<form id="frm" name="frm" action="" method="post">
<?php //<input type="button" onClick="tes()" src="../themes/icons/cancel.png"> ?>
<h2>FORM BC 2.7 </h2>    
    <div class="easyui-tabs" tools="#tab-tools" style="width:750px;height:600px;">               
        <div title="Data Umum" style="padding:10px;">
        <table>        
        <tr>        
          <td>  
            <div id="pilmatin" class="demo-info">
                <div class="demo-tip icon-tip"></div>
                Pilih Material Out terlebih dahulu : 
                <input type="hidden" name="matoutdo_id" id="matoutdo_id">
                <a href="pop_matouth.php" class="thickbox"><img src="<?php echo $basedir ?>img/search.png" border="0" style="cursor:pointer"></a>            	
            </div>        	        	        
            <fieldset class="borderblue">
            <legend><b>HEADER</b></legend>
              <table cellspacing="0">
              <tr>
                <td width="147">NOMOR PENGAJUAN</td>
                <td width="7" id="noBorderBR">:</td>
                <td colspan="4"><input type="hidden" id="fhidden" name="fhidden" maxlength="6" size="6" tabindex="1"> <input type="text" id="CAR" name="CAR" class="easyui-validatebox" size="26" tabindex="1" required="true"></td>
              </tr>
              <tr>
                <td>A. KANTOR PABEAN</td>
                <td width="7"></td>
                <td width="198">&nbsp;</td>
                <td colspan="3"><b style="color:gray;">KOLOM KHUSUS BEA DAN CUKAI</b></td>
              </tr>
              <tr>
                <td> &nbsp; &nbsp; 1. Kantor Asal</td>
                <td>:</td>
                <td>
                	<select id="KdKpbcAsal" name="KdKpbcAsal" style="width:150px;">
                    	<option value=""></option>
					<?php 
					$q="SELECT * FROM kantor ORDER BY KdKpbc";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						echo "<option value='".$r['KdKpbc']."'>".$r['KdKpbc']." - ".$r['UrKdKpbc']."</option>";
					}
					?>
                    </select>                
                </td>
                <td width="197">Nomor Pendaftaran</td>
                <td width="3">:</td>
                <td width="153"><input type="text" id="NoDaf" name="NoDaf" maxlength="6" size="6" tabindex="5"></td>
              </tr>
              <tr>
                <td> &nbsp; &nbsp; 2. Kantor Tujuan</td>
                <td>:</td>
                <td>
                	<select id="KdKpbcTuj" name="KdKpbcTuj" style="width:150px;">
                    	<option value=""></option>
					<?php 
					$q="SELECT * FROM kantor ORDER BY KdKpbc";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						echo "<option value='".$r['KdKpbc']."'>".$r['KdKpbc']." - ".$r['UrKdKpbc']."</option>";
					}
					?>
                    </select>
                </td>
                <td width="197">&nbsp;</td>
                <td width="3"></td>
                <td width="153">&nbsp;</td>
              </tr>
              <tr>
                <td>B. JENIS TPB ASAL</td>
                <td>:</td>
                <td>
                	<select id="KdJnsTpbAsal" name="KdJnsTpbAsal" style="width:150px;">
                    	<option value=""></option>
					<?php 
					$q="SELECT * FROM jenis_tpb ORDER BY UrJnsTpb";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						echo "<option value='".$r['KdJnsTpb']."'>".$r['KdJnsTpb']." - ".$r['UrJnsTpb']."</option>";
					}
					?>
                    </select>
                </td>
                <td align="right">Tanggal</td>
                <td width="3">:</td>
                <td width="153"><input type="text" id="TgDaf" name="TgDaf" class="easyui-datebox" required="true" maxlength="10" size="10" tabindex="6"></td>
              </tr>               
              <tr>
                <td>C. JENIS TPB TUJUAN</td>
                <td width="7">:</td>
                <td>
                	<select id="KdJnsTpbTuj" name="KdJnsTpbTuj" style="width:150px;">
                    	<option value=""></option>
                    <?php 
					$q="SELECT * FROM jenis_tpb ORDER BY UrJnsTpb";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						echo "<option value='".$r['KdJnsTpb']."'>".$r['KdJnsTpb']." - ".$r['UrJnsTpb']."</option>";
					}
					?>
                    </select>
                </td>
                <td align="right"></td>
                <td width="3"></td>
                <td width="153">&nbsp;</td>
              </tr>                  
              </table>
            </fieldset class="borderblue">          
          </td>
        </tr>        
        <tr>
          <td>
            <fieldset class="borderblue">
            <legend><b>D. DATA PEMBERITAHUAN</b></legend>
            <table cellspacing="0" class="sub_table" width="100%">
            <tr>
              <td colspan="3"><b style="color:gray;">TPB ASAL BARANG</b></td>  
              <td colspan="3"><b style="color:gray;">TPB TUJUAN  BARANG</b></td>
            </tr>
            <tr>
              <td width="21%">1. NPWP</td>
              <td width="1%">:</td>
              <td width="28%"><input type="text" id="fnpwp_pngsh" name="fnpwp_pngsh" alt="npwp" maxlength="16" size="20" tabindex="7" value="<?php echo $_SESSION['npwp'] ?>"></td>
              <td width="17%">5. NPWP</td>
              <td width="1%">:</td>
              <td width="32%"><input type="hidden" id="KdTujKirim" name="KdTujKirim">                <input type="text" id="fnpwp_pngrm" name="fnpwp_pngrm" alt="npwp" maxlength="16" size="20" tabindex="12"></td>
            </tr> 
            <tr>
              <td>2. Nama</td>
              <td>:</td>
              <td><input type="text" id="fnm_pngsh" name="fnm_pngsh" maxlength="20" size="20" tabindex="8" value="<?php echo $_SESSION['c_name'] ?>"></td>
              <td>6. NAMA</td>
              <td>:</td>
              <td><input type="text" id="fnm_pngrm" name="fnm_pngrm" maxlength="20" size="20" tabindex="13"></td>
            </tr> 
            <tr>
              <td valign="top">3. Alamat</td>
              <td valign="top">:</td>
              <td valign="top"><input type="text" id="falmt_pngsh" name="falmt_pngsh" maxlength="30" size="30" tabindex="9" value="<?php echo $_SESSION['c_address'] ?>"><br><input type="text" id="fkota_pngsh" name="fkota_pngsh" maxlength="30" size="30" tabindex="10" value="<?php //echo $address1 ?>"></td>
              <td valign="top">7. ALAMAT</td>
              <td valign="top">:</td>
              <td valign="top"><input type="text" id="falmt_pngrm" name="falmt_pngrm" maxlength="30" size="30" tabindex="14"><br><input type="text" id="fkota_pngrm" name="fkota_pngrm" maxlength="30" size="30" tabindex="15"></td>
            </tr>
            <tr>
              <td>4. No. Izin TPB</td>
              <td>:</td>
              <td><input type="text" id="fno_itpb" name="fno_itpb" maxlength="15" size="16" tabindex="11" value="<?php echo $_SESSION['NoIjinTpb'] ?>"></td>
              <td>8. No. Izin TPB</td>
              <td>:</td>
              <td><input type="text" id="fno_itpb_tuj" name="fno_itpb_tuj" maxlength="15" size="16" tabindex="11" value=""></td>
            </tr>
            </table>
            </fieldset class="borderblue">
          </td>
        </tr>         
        <!--<tr>
          <td>
          <fieldset class="borderblue">
          <legend><b>DOKUMEN PELENGKAP PABEAN</b></legend>
          <table cellspacing="0" class="sub_table">
          <tr>
            <td width="21%">9. Invoice</td>
            <td width="1%">:</td>
            <td width="28%"><input type="text" id="fpacklist" name="fpacklist" maxlength="20" size="20" tabindex="16"></td>
            <td width="28%">12. Surat Jalan</td>
            <td width="1%">:</td>
            <td width="21%"><input type="text" id="fsk" name="fsk" maxlength="20" size="20" tabindex="19"></td>
          </tr>
          <tr>
            <td align="right">Tanggal</td>
            <td>:</td>
            <td><input type="text" id="ftgl_packlist" name="ftgl_packlist" alt="tgl" maxlength="10" size="12" tabindex="17"></td>
            <td align="right">Tanggal</td>                
            <td>:</td>
            <td><input type="text" id="ftgl_sk" name="ftgl_sk" alt="tgl" maxlength="10" size="12" tabindex="20"></td>
          </tr>
          <tr>
            <td width="21%">10. Packing List</td>
            <td width="1%">:</td>
            <td width="28%"><input type="text" id="fpacklist" name="fpacklist" maxlength="20" size="20" tabindex="16"></td>
            <td width="28%">10. Surat Keputusan / Persetujuan</td>
            <td width="1%">:</td>
            <td width="21%"><input type="text" id="fsk" name="fsk" maxlength="20" size="20" tabindex="19"></td>
          </tr>
          <tr>
            <td align="right">Tanggal</td>
            <td>:</td>
            <td><input type="text" id="ftgl_packlist" name="ftgl_packlist" alt="tgl" maxlength="10" size="12" tabindex="17"></td>
            <td align="right">Tanggal</td>                
            <td>:</td>
            <td><input type="text" id="ftgl_sk" name="ftgl_sk" alt="tgl" maxlength="10" size="12" tabindex="20"></td>
          </tr> 
          <tr>
            <td>9. Kontrak</td>
            <td>:</td>
            <td><input type="text" id="fkontrak" name="fkontrak" maxlength="10" size="20" tabindex="18"></td>
            <td colspan="3">11. Jenis / Nomor / Tanggal Dokumen Lainnya : <br> &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" id="fjns_doklain" name="fjns_doklain" maxlength="40" size="40" tabindex="21"></td>
          </tr>
          </table>
          </fieldset class="borderblue">
          </td>  
        </tr>     -->           
        <tr>
          <td>
            <fieldset class="borderblue">          
            <legend><b>DATA PENGANGKUTAN</b></legend>
            <table cellspacing="0" class="sub_table" width="100%">
            <tr>
              <td width="50%">19. Jenis Sarana Pengangkut Darat :
                <input type="text" id="JnsAngkut" name="JnsAngkut" maxlength="18" size="18" tabindex="22"></td>
              <td width="18%">20. Nomor Polisi</td> 
              <td width="1%">:</td>
              <td width="31%">
              <input type="text" id="NoPolisi" name="NoPolisi" maxlength="10" size="10" tabindex="23"></td>
            </tr>
            </table>
            </fieldset class="borderblue">
          </td>
        </tr>
        <tr>
          <td>
            <fieldset class="borderblue">          
            <legend><b>SEGEL (DIISI OLEH BEA DAN CUKAI)</b></legend>
            <table cellspacing="0" class="sub_table" width="100%">
            <tr>
              <td>21. No Segel</td>
              <td>: <input type="text" id="NoSegel" name="NoSegel" maxlength="10" size="10" tabindex="23"></td>
              <td width="50%">23. Catatan BC Tujuan : <input type="text" id="CatBcTuj" name="CatBcTuj" size="30"></td> 
            </tr>
            <tr>
              <td>22. Jenis </td>
              <td colspan="3">: <input type="text" id="JnsSegel" name="JnsSegel" maxlength="10" size="10" tabindex="23"></td> 
            </tr>
            </table>
            </fieldset class="borderblue">
          </td>
        </tr>                        
        </table> 
       </div><!-- Akhir Div umum -->
       <div title="Dokumen Pelengkap Pabean" style="padding:10px;">
       	<table id="dg" class="easyui-datagrid" style="width:550px;height:250px"
			toolbar="" pagination="false"
			rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th editor="{type:'combobox',  
                    options:{  
                        valueField:'KdKdJnsDok',  
                        textField:'UrKdJnsDok',  
                        data:jenis_dok,  
                        required:true  
                    } }" field="DokKd" width="100">Jenis Dokumen</th>
                    <th editor="{type:'validatebox',options:{required:true}}" field="DokNo" width="50">Nomor</th>
                    <th align="center" editor="{type:'datebox'}" field="DokTgDmy" width="50">Tanggal</th>
                </tr>
            </thead>
        </table>
        <div id="toolbar">  
            <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')"></a>  
            <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')"></a>  
            <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')"></a>  
            <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')"></a>  
        </div>
       </div><!-- Akhir Div dokPelengkap -->
       <div title="Data Barang" style="padding:10px;">
            <fieldset class="borderblue">          
            <legend><b>RIWAYAT BARANG</b></legend>
            <table cellspacing="0" class="sub_table" width="100%">
            <tr>
              <td width="50%">Nomor dan Tanggal BC 2.7 asal :
                <input type="text" id="NoBcAsal" name="NoBcAsal" maxlength="18" size="18" tabindex="22"></td>
              <td colspan="3" width="50%">tgl
              <input type="text" id="TgBcAsal" name="TgBcAsal" class="easyui-datebox" required="true" maxlength="10" size="10" tabindex="23"></td>
            </tr>
            </table>
            </fieldset class="borderblue">
          <br>
            <fieldset class="borderblue">
            <legend><b>DATA PERDAGANGAN</b></legend>
            <table cellspacing="0" class="sub_table" width="100%">
            <tr>
              <td width="20%"> Jenis Valuta Asing</td>     
              <td width="1%">:</td>
              <td width="29%">
              	<select id="KdVal" name="KdVal" style="width:80px;">
                    	<option value=""></option>
                    <?php 
					$q="SELECT * FROM valuta ORDER BY KdVal";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						echo "<option value='".$r['KdVal']."'>".$r['KdVal']." - ".$r['UrVal']."</option>";
					}
					?>
                    </select>
              </td>
              <td width="18%"> Harga Penyerahan</td>
              <td width="32%">:  
                <input type="text" id="HrgSerah" name="HrgSerah" alt="mtuang" maxlength="10" size="12" tabindex="25"></td>
            </tr>
            <tr>
              <td width="20%">CIF</td>              
              <td width="1%">:</td>
              <td><input type="text" id="CIF" name="CIF" alt="mtuang" maxlength="10" size="12" tabindex="24"></td>
              <td colspan="2">&nbsp;</td>
            </tr>
            </table>
        </fieldset class="borderblue">          
        <br>
        <fieldset class="borderblue">
            <legend><b>DATA PETI KEMAS DAN PENGEMAS</b></legend>
 			<table cellspacing="0" class="sub_table">
            <tr>
              <td width="151"> Merek Kemasan</td>
              <td width="8">:</td>
              <td width="197"><input type="text" id="MerekKemas" name="MerekKemas" maxlength="10" size="12" tabindex="27"></td>
              <td>Volume (m3)</td>
              <td>: 
              <input type="text" id="VOL" name="VOL" alt="decimal-us" maxlength="10" size="12" tabindex="29"></td>
              <td width="25">&nbsp;</td>
            </tr>  
            <tr>
              <td>Jenis Kemasan</td>
              <td>:</td>
              <td><select id="KdKemas" name="KdKemas" style="width:80px;">
                <option value=""></option>
                  <?php 
					$q="SELECT * FROM kemasan ORDER BY KdKemas";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						echo "<option value='".$r['KdKemas']."'>".$r['KdKemas']." - ".$r['UrKemas']."</option>";
					}
					?>
              </select></td>
              <td width="134">Berat Kotor (kg)</td>
              <td width="200">:
              <input type="text" id="BRUTO" name="BRUTO" alt="decimal-us" maxlength="10" size="12" tabindex="30"></td>
              <td>&nbsp;</td>
            </tr>
        <tr>
          <td width="151"> Jumlah Kemasan</td>
          <td width="8">:</td>
          <td><input type="text" id="JmlKemas" name="JmlKemas" alt="int" maxlength="5" size="5" tabindex="28"></td>
          <td width="134">Berat Bersih (kg) </td>
          <td>: <input type="text" id="NETTO" name="NETTO" alt="decimal-us" maxlength="10" size="12" tabindex="31">KG</td>
        </tr>
        </table>    
        </fieldset class="borderblue">
        <br>  
        <table id="dg2" style="width:725px;height:250px"  
        toolbar=""  
        rownumbers="true" fitColumns="true" singleSelect="true">  
            <thead>  
                <tr>  
                    <th editor="{type:'combogrid',  
                    options:{  
                    	panelWidth:450,

                        idField:'productid',
                        textField:'listprice',
                        url:'datagrid_data.json',
                        mode:'remote',
                        fitColumns:true, 
                        columns:[[
                            {field:'productid',title:'productid',width:60},
                            {field:'unitcost',title:'unitcost',width:100},
                            {field:'status',title:'status',width:120},
                            {field:'listprice',title:'listprice',width:100}
                        ]] 
                    } }" field="UrBarang2" width="150">Pos Tarif HS, uraian jumlah dan jenis barang<br>secara lengkap kode barang, merk, tipe, ukuran<br>dan spesifikasi lain</th>  
                    <th align="right" editor="{type:'numberbox',options:{groupSeparator:',', decimalSeparator:'.',precision:2}}" field="VOL" width="50">Volume (m3)</th>  
                    <th align="right" editor="{type:'numberbox',options:{groupSeparator:',', decimalSeparator:'.',precision:2}}" field="NETTO" width="55">Berat bersih (Kg)</th>  
                    <th align="right" editor="{type:'numberbox',options:{groupSeparator:',', decimalSeparator:'.',precision:2}}" field="CIF" width="40">Nilai CIF</th>
                    <th align="right" editor="{type:'numberbox',options:{groupSeparator:',', decimalSeparator:'.',precision:2}}" field="HrgSerah" width="60">Harga Penyerahan</th>  
                </tr>  
            </thead>  
        </table>  
        <div id="toolbar2">  
            <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg2').edatagrid('addRow')"></a>  
            <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg2').edatagrid('destroyRow')"></a>  
            <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg2').edatagrid('saveRow')"></a>  
            <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg2').edatagrid('cancelRow')"></a>  
        </div> 
        
        </div><!--Akhir DIV dataBarang-->
        </div>         
</form>
</div><!--Akhir DIV TAB-->
<div id="tab-tools">
        <a id="btnTbh" name="btnTbh" href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add"></a>
        <a id="btnUbh" name="btnUbh" href="#" class="easyui-linkbutton" plain="true" iconCls="icon-edit" style="display:none"></a>
        <a id="btnSim" name="btnSim" href="#" class="easyui-linkbutton" plain="true" iconCls="icon-save" style="display:none"></a>
        <a id="btnHps" name="btnHps" href="#" class="easyui-linkbutton" plain="true" iconCls="icon-remove" style="display:none"></a> 
        <a id="btnBtl" name="btnBtl" href="#" class="easyui-linkbutton" plain="true" iconCls="icon-undo" style="display:none"></a>
        <a id="btnCri" href="pop_bc27.php" class="thickbox"><img class="btnCri" src="<?php echo $basedir ?>themes/icons/search.png" style="float:right;padding-top:4px;padding-left:6px;padding-right:6px;padding-bottom:4px"></a>               
    </div>
</body>
</html>
