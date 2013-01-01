<?php
require_once "../../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
$NmMenu=$_REQUEST["NmMenu"];

$q="SELECT right(CAR,6)+1 as auto_no  FROM header WHERE DokKdBc='7' ORDER BY right(CAR,6) DESC LIMIT 1";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
$autono=($rs)?$rs[0]['auto_no']:1;
//$carno = str_pad($autono, 6, "0", STR_PAD_LEFT);
$carno = str_pad($autono, 6, "0", STR_PAD_LEFT);

/*$q="SELECT right(NoDaf,3)+1 as auto_nodaf FROM header WHERE DokKdBc='7' ORDER BY right(NoDaf,3) DESC LIMIT 1";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
$autonodaf=($rs)?$rs[0]['auto_nodaf']:1;
$NoDaf = "000.".str_pad($autonodaf, 3, "0", STR_PAD_LEFT);
*/
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
<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery-ui-1.8.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/jquery.grid.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/jquery.edatagrid.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/date.format.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/jquery.maskedinput-1.3.js"></script>  
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/global.format.js">disableSelection(document.body); 
</script>
<?php 
require_once "bc30.mjs.php";
require_once "bc30.cjs.php";
?>
<body oncontextmenu="return false;">
<div id="w" style="padding:5px;">
<form id="frm" name="frm" action="" method="post">
    <div class="easyui-tabs" tools="#tab-tools" style="width:710px;height:850px;">               
        <div title="Data Umum" style="padding:10px;">
        <div class="demo-info" style="margin-bottom:10px">
            <div class="demo-tip icon-tip">&nbsp;</div>
            <div>
            Klik/pilih Penerima Terlebih dahulu..
            Setelah itu pilih Ref. No..
            Lengkapi data-data lainnya.
            </div>
        </div>        
        
        <table>        
        <tr>        
          <td>  
            <fieldset class="borderblue">
            <legend><b>HEADER</b></legend>
              <table cellspacing="0">
              <tr>
                <td width="135">Kantor Pabean</td>
                <td><input type="hidden" id="fhidden" name="fhidden"> <select id="KdKpbcAsal" name="KdKpbcAsal" style="width:160px;" tabindex="2">
                  <option value=""></option>
                  <?php 
					$q="SELECT * FROM kantor ORDER BY KdKpbc";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdKpbc']."'";
						if ($r['KdKpbc']=="040300"){
							$str .= "selected";
						}
						$str .= ">".$r['KdKpbc']." - ".$r['UrKdKpbc']."</option>";
						echo $str;
					}
					?>
                </select></td>
                <td colspan="3"><b style="color:gray;">G. KOLOM KHUSUS BEA DAN CUKAI</b></td>
              </tr>
              <tr>
                <td>Nomor Pengajuan</td>
                <td width="195"><input type="text" id="CAR" name="CAR" size="7" tabindex="1" value="<?php echo $carno ?>">
                  <select id="KdKpbcTuj" name="KdKpbcTuj" style="width:150px; display:none" tabindex="3">
                    <option value=""></option>
                    <?php 
					$q="SELECT * FROM kantor ORDER BY KdKpbc";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						echo "<option value='".$r['KdKpbc']."'>".$r['KdKpbc']." - ".$r['UrKdKpbc']."</option>";
					}
					?>
                  </select></td>
                <td width="152">Nomor Pendaftaran</td>
                <td width="183"><input type="text" id="NoDaf" name="NoDaf" maxlength="7" size="7" value="<?php echo $NoDaf ?>" tabindex="9"></td>
              </tr>
              <tr>
                <td>Jenis Ekspor</td>
                <td><select id="KdJnsTpbTuj" name="KdJnsTpbTuj" style="width:150px; display:none" tabindex="5">
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
                  <select id="KdJnsEkspor" name="KdJnsEkspor" style="width:160px;" tabindex="4">
                    <option value=""></option>
                    <?php 
					$q="SELECT * FROM mst_jenisekspor ORDER BY KdJnsEkspor";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdJnsEkspor']."' ";						
						$str .= ">".$r['JnsEkspor']."</option>";
						echo $str;
					}
					?>
                  </select></td> 
                <td width="152">Tanggal</td>
                <td width="183"><input type="text" id="TgDaf" name="TgDaf" class="easyui-datebox" required="true" maxlength="10" tabindex="10" value="<?php echo date('d/m/Y') ?>" style="width:100px"></td>               
              </tr>
              <tr>
                <td>Kategori Ekspor</td>
                <td><select id="KdKatEkspor" name="KdKatEkspor" style="width:160px;" tabindex="4">
                  <option value=""></option>
                  <?php 
					$q="SELECT * FROM mst_kategoriekspor ORDER BY KdKatEkspor";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdKatEkspor']."' ";
						$str .= ">".$r['KatEkspor']."</option>";
						echo $str;
					}
					?>
                </select></td>
                <td>&nbsp;</td>
                <td width="3">&nbsp;</td>
              </tr>
              <tr>
                <td>Cara Perdagangan</td>
                <td><select id="KdCrDagang" name="KdCrDagang" tabindex="6" style="width:160px;">
                  <option value=""></option>
                  <?php 
					$q="SELECT * FROM mst_caradagang ORDER BY KdCrDagang";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						echo "<option value='".$r['KdCrDagang']."'>".$r['CrDagang']."</option>";
					}
					?>
                </select></td>    
                <td>&nbsp;</td>
                <td width="3"></td>
              </tr>  
              <tr>
                <td>Cara Pembayaran</td>
                <td><select id="KdCrBayar" name="KdCrBayar" tabindex="6" style="width:160px;">
                  <option value=""></option>
                  <?php 
					$q="SELECT * FROM mst_carabayar ORDER BY KdCrBayar";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						echo "<option value='".$r['KdCrBayar']."'>".$r['CrBayar']."</option>";
					}
					?>
                </select></td>    
                <td>&nbsp;</td>
                <td width="3"></td>           
              </tr>             
              </table>
            </fieldset class="borderblue">          
          </td>
        </tr>        
        <tr>
          <td>
            <fieldset class="borderblue">
            <table cellspacing="0" class="sub_table" width="100%">
            <tr>
              <td colspan="2"><b>PENANGGUNG JAWAB PERUSAHAAN</b></td>  
              <td colspan="2"><b>PEJABAT BC</b></td>
            </tr>
            <tr>
              <td width="19%">Nama</td>
              <td width="31%"><input type="text" id="NmPengusaha" name="NmPengusaha" size="22" tabindex="15" value="<?php echo $_SESSION['NmPengusaha'] ?>"></td>
              <td width="22%">Nama</td>
              <td width="28%"><input type="text" id="NmPejabat" name="NmPejabat" size="22" value="<?php echo $_SESSION['NmPejabat'] ?>" tabindex="7"></td>
              </tr>
            <tr>
              <td valign="top">NIP</td>
              <td valign="top"><input type="text" id="NipPengusaha" name="NipPengusaha" size="22" tabindex="16" value="<?php echo $_SESSION['NipPengusaha'] ?>"></td>
              <td valign="top">NIP</td>
              <td valign="top"><input type="text" id="NipPejabat" name="NipPejabat" size="22" value="<?php echo $_SESSION['NipPejabat'] ?>" tabindex="8"></td>
            </tr>
            </table>
            </fieldset>
          </td>
        </tr>  
        <tr>
          <td>
            <fieldset class="borderblue">            
            <table cellspacing="0" class="sub_table" width="100%">
            <tr>
              <td colspan="2"><b>PENERIMA</b></td>  
              <td colspan="3"><b>PPJK</b></td>
            </tr>
            <tr>
              <td width="10%">Nama</td>
              <td width="40%">
              <select id="NmTuj" name="NmTuj" style="width:200px;">
              <option value=""></option>
              <?php 
					$q="SELECT * FROM mst_perusahaan WHERE TpPrshn='c' ORDER BY NmPrshn";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['NmPrshn']."'";
						$str .= ">".$r['NmPrshn']."</option>";
						echo $str;
					}
					?>
              </select>
              </td>
              <td width="12%">Nama</td>
              <td width="38%"><select id="NmPpjk" name="NmPpjk" style="width:200px;">
                <option value=""></option>
                <?php 
					$q="SELECT * FROM mst_perusahaan WHERE TpPrshn='p' ORDER BY NmPrshn";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['NmPrshn']."'";
						$str .= ">".$r['NmPrshn']."</option>";
						echo $str;
					}
					?>
              </select></td>
              </tr>
              <tr>
                <td>Ref No.</td>
                <td colspan="3">
           			<select id="ref_id" name="ref_id"></select>
                </td>
              </tr>
            </table>
            </fieldset class="borderblue">
          </td>
        </tr>                    
        <tr>
          <td>
            <fieldset class="borderblue">          
            <legend><b>DATA PENGANGKUTAN</b></legend>
            <table cellspacing="0" class="sub_table" width="100%">
              <tr>
              <td width="32%">Cara Pengangkutan </td>
              <td width="18%">
                <select id="CaraAngkut" name="CaraAngkut" style="width:115px;">
                  <option value=""></option>
                  <?php 
					$q="SELECT * FROM mst_caraangkut ORDER BY KdCrAngkut";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdCrAngkut']."'";
						$str .= ">".$r['KdCrAngkut']." - ".$r['NmCrAngkut']."</option>";
						echo $str;
					}
					?>
                </select></td> 
              <td width="31%">Bendera Sarana Pengangkut</td>
              <td width="19%"><select id="KdNegara" name="KdNegara" style="width:115px;">
                <option value=""></option>
                <?php 
					$q="SELECT * FROM mst_negara ORDER BY KdNegara";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdNegara']."'";
						$str .= ">".$r['KdNegara']." - ".$r['NmNegara']."</option>";
						echo $str;
					}
					?>
              </select></td>
            </tr>
            <tr>
              <td width="32%">Nama Sarana Pengangkut </td>
              <td width="18%"><input type="text" id="NmAngkut" name="NmAngkut" maxlength="18" size="18" tabindex="21"></td> 
              <td width="31%">Tanggal Perkiraan Ekspor</td>
              <td width="19%"><input type="text" id="TgKiraEkspor" name="TgKiraEkspor" class="easyui-datebox" required="true" maxlength="10" tabindex="10" value="<?php echo date('d/m/Y') ?>" style="width:100px"></td>
            </tr>
            <tr>
              <td width="32%">Nomor Pengankut (Voy / Flight)</td>
              <td width="18%"><input type="text" id="NoPolisi" name="NoPolisi" maxlength="10" size="10" tabindex="22"></td> 
              <td width="31%">&nbsp;</td>
              <td width="19%">&nbsp;</td>
            </tr>
        </table>
            </fieldset class="borderblue">
          </td>
        </tr>
        <tr>
          <td>
            <fieldset class="borderblue">          
            <legend><b>DATA PELABUHAN</b></legend>
            <table cellspacing="0" class="sub_table" width="100%">
            <tr>
              <td width="21%">Pelabuhan Muat Asal</td>
              <td>
                <select id="KdMuatAsal" name="KdMuatAsal" style="width:150px;">
                  <option value=""></option>
                  <?php 
					$q="SELECT * FROM mst_pelabuhan ORDER BY KdPelabuhan";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdPelabuhan']."'";
						if ($r['KdPelabuhan']=='IDTPP'){
							$str .= "selected";
						}
						$str .= ">".$r['KdPelabuhan']." - ".$r['NmPelabuhan']."</option>";
						echo $str;
					}
					?>
                </select></td>
              <td width="21%">Pelabuhan Transit LN</td> 
              <td width="29%"><select id="KdTransit" name="KdTransit" style="width:150px;">
                <option value=""></option>
                <?php 
					foreach ($rs as $r){
						$str = "<option value='".$r['KdPelabuhan']."'";
						$str .= ">".$r['KdPelabuhan']." - ".$r['NmPelabuhan']."</option>";
						echo $str;
					}
					?>
              </select></td>
            </tr>
            <tr>
              <td width="21%">Pelabuhan Muat Ekspor</td>
              <td width="29%"><select id="KdMuatEkspor" name="KdMuatEkspor" style="width:150px;">
                <option value=""></option>
                <?php 
					$q="SELECT * FROM mst_pelabuhan ORDER BY KdPelabuhan";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdPelabuhan']."'";
						if ($r['KdPelabuhan']=='IDTPP'){
							$str .= "selected";
						}
						$str .= ">".$r['KdPelabuhan']." - ".$r['NmPelabuhan']."</option>";
						echo $str;
					}
					?>
              </select></td> 
              <td width="21%">Pelabuhan Bongkar</td>
              <td width="29%"><select id="KdBongkar" name="KdBongkar" style="width:150px;">
                <option value=""></option>
                <?php 
					foreach ($rs as $r){
						$str = "<option value='".$r['KdPelabuhan']."'";						
						$str .= ">".$r['KdPelabuhan']." - ".$r['NmPelabuhan']."</option>";
						echo $str;
					}
					?>
              </select></td>
            </tr>
            </table>
            </fieldset>
          </td>
        </tr>
        <tr>
          <td>
            <fieldset class="borderblue">          
            <legend><b>DATA TEMPAT PEMERIKSAAN</b>
            </legend>
            <table cellspacing="0" class="sub_table" width="100%">
            <tr>
              <td width="21%">Lokasi Pemeriksaan</td>
              <td width="29%"><select id="KdLokPeriksa" name="KdLokPeriksa" style="width:150px;">
                <option value=""></option>
                <?php 
					$q="SELECT * FROM mst_lokasiperiksa ORDER BY KdLokPeriksa";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdLokPeriksa']."'";
						$str .= ">".$r['LokPeriksa']."</option>";
						echo $str;
					}
					?>
              </select></td>
              <td width="27%">Kantor Pabean Pemeriksaan</td> 
              <td width="23%"><select id="KdKpPeriksa" name="KdKpPeriksa" style="width:150px;">
                <option value=""></option>
                  <?php 
					$q="SELECT * FROM kantor ORDER BY KdKpbc";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdKpbc']."'";
						$str .= ">".$r['KdKpbc']." - ".$r['UrKdKpbc']."</option>";
						echo $str;
					}
					?>
                </select>
              </select></td>
            </tr>
            </table>
            </fieldset>
          </td>
        </tr>
        <tr>
          <td>
            <fieldset class="borderblue">          
            <legend><b>DATA PERDAGANGAN</b>
            </legend>
            <table cellspacing="0" class="sub_table" width="100%">
            <tr>
              <td width="21%">Daerah Asal Brg.</td>
              <td>
                <select id="KdDaerah" name="KdDaerah" style="width:150px;">
                  <option value=""></option>
                  <?php 
					$q="SELECT * FROM mst_daerah ORDER BY KdDaerah";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdDaerah']."'";
						$str .= ">".$r['KdDaerah']." - ".$r['NmDaerah']."</option>";
						echo $str;
					}
					?>
                </select></td>
              <td width="25%">Cara Penyerahan Barang</td> 
              <td width="25%"><select id="KdCrSerahBrg" name="KdCrSerahBrg" style="width:150px;">
                <option value=""></option>
                <?php 
					$q="SELECT * FROM mst_caraserah_barang ORDER BY KdCrSerahBrg";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdCrSerahBrg']."'";
						$str .= ">".$r['KdCrSerahBrg']." - ".$r['NmCrSerahBrg']."</option>";
						echo $str;
					}
					?>
              </select></td>
            </tr>
            <tr>
              <td width="21%">Negara Tujuan Ekspor</td>
              <td width="29%"><select id="KdNegaraEkspor" name="KdNegaraEkspor" style="width:150px;">
                <option value=""></option>
                <?php 
					$q="SELECT * FROM mst_negara ORDER BY KdNegara";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdNegara']."'";
						$str .= ">".$r['KdNegara']." - ".$r['NmNegara']."</option>";
						echo $str;
					}
					?>
              </select></td> 
              <td width="25%">&nbsp;</td>
              <td width="25%">&nbsp;</td>
            </tr>
            </table>
            </fieldset>
          </td>
        </tr>
        <tr>
          <td>
            <fieldset class="borderblue">
            <legend><b>DATA TRANSAKSI EKSPOR</b>
            </legend><table cellspacing="0" class="sub_table" width="100%">
            <tr>
              <td width="20%">Valuta</td>     
              <td width="30%">
              	<select id="KdVal" name="KdVal" style="width:150px;" tabindex="28">
                    	<option value=""></option>
                    <?php 
					$q="SELECT * FROM valuta ORDER BY KdVal";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdVal']."'";
						if ($r['KdVal']=="USD"){
							$str .= "selected";
						}
						$str .= ">".$r['KdVal']." - ".$r['UrVal']."</option>";
						echo $str;
					}
					?>
                    </select></td>
              <td width="25%">Nilai Tukar Mata Uang</td>
              <td width="25%"><input type="text" id="NDPBM" name="NDPBM" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." maxlength="10" size="15" tabindex="29"></td>
            </tr>
            <tr>
              <td width="20%">FOB</td>              
              <td><input type="text" id="FOB" name="FOB" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." maxlength="10" size="15" tabindex="29"></td>
              <td>Asuransi LN/DN</td>
              <td><input type="text" id="AsLNDN" name="AsLNDN" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." maxlength="10" size="15" tabindex="29"></td>
            </tr>
            <tr>
              <td width="20%">Freight</td>              
              <td><input type="text" id="Freight" name="Freight" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." maxlength="10" size="15" tabindex="29"></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            </table>
        </fieldset>
          </td>
        </tr>   
        </table> 
      </div><!-- Akhir Div umum -->
      
      <div title="Dok. Pelengkap & Pengemas" style="padding:10px;">        
       	<table id="dg" singleSelect="true"></table>
        <div id="toolbar">  
            <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" title="Tambah" onclick="javascript:$('#dg').edatagrid('addRow')">Tambah</a>  
            <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" title="Hapus" onclick="javascript:$('#dg').edatagrid('destroyRow')">Hapus</a>  
            <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" title="Simpan" onclick="javascript:$('#dg').edatagrid('saveRow')">Simpan</a>  
            <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" title="Batal" onclick="javascript:$('#dg').edatagrid('cancelRow')">Batal</a>  
        </div>
        <br>
        <table id="dgPetiKemas" singleSelect="true"></table>
        <div id="toolPetiKemas">  
            <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" title="Tambah" onclick="javascript:$('#dgPetiKemas').edatagrid('addRow')">Tambah</a>  
            <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" title="Hapus" onclick="javascript:$('#dgPetiKemas').edatagrid('destroyRow')">Hapus</a>  
            <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" title="Simpan" onclick="javascript:$('#dgPetiKemas').edatagrid('saveRow')">Simpan</a>  
            <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" title="Batal" onclick="javascript:$('#dgPetiKemas').edatagrid('cancelRow')">Batal</a>  
        </div>
        <br>
        <fieldset class="borderblue">            
        <table cellspacing="0" class="sub_table" width="100%">
        <tr>
          <td colspan="2"><b>DATA KEMASAN </b></td>  
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td width="170">Jumlah Kemasan 
            <input type="text" id="JmlKemas" name="JmlKemas" class="easyui-numberbox" groupSeparator="." maxlength="5" size="5" tabindex="33"></td>
          <td width="201">Jenis Kemasan 
            <select id="KdKemas" name="KdKemas" style="width:80px;" tabindex="32">
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
          <td width="309">Merek Kemasan 
            <input type="text" id="MerekKemas" name="MerekKemas" maxlength="10" size="20" tabindex="31"></td>
        </tr>
        </table>    
        </fieldset>
       </div><!-- Akhir Div dokPelengkap -->
       
       <div title="Data Barang" style="padding:10px;">                    
        <fieldset class="borderblue">            
          <legend><b>DATA BARANG IMPOR</b></legend>
            <table cellspacing="0" class="sub_table" width="100%">            
            <tr>
              <td width="174">Volume (m3)</td>
              <td width="184"><input type="text" id="VOL" name="VOL" class="easyui-numberbox" precision="4" groupSeparator="," decimalSeparator="." maxlength="10" size="12" tabindex="35"></td>
              <td width="174">Berat Kotor (kg)</td>
              <td width="184"><input type="text" id="BRUTO" name="BRUTO" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." maxlength="10" size="12" tabindex="35"></td>
              <td width="127">Berat Bersih (kg) </td>
              <td width="233"><input type="text" id="NETTO" name="NETTO" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." maxlength="10" size="12" tabindex="36" readonly></td>
            </tr>
        </table>    
        </fieldset>
        <br>  
        <table id="dg2" singleSelect="true"></table>  
        <div id="toolbar2">  
            <a href="#" class="easyui-linkbutton" id="tl2Tbh" iconCls="icon-add" plain="true" title="Tambah">Tambah</a>  
            <a href="#" class="easyui-linkbutton" id="tl2Ubh" iconCls="icon-edit" plain="true" title="Ubah">Ubah</a>  
            <a href="#" class="easyui-linkbutton" id="tl2Hps" iconCls="icon-remove" plain="true" title="Hapus">Hapus</a>        
        </div> 
        
        <div id="dlgBarang" class="easyui-dialog" style="width:400px;height:350px;padding:10px" closed="true" buttons="#dlgBarang-buttons">
            <form id="fm" method="post" onSubmit="return false">
            <table>
            <tr>
              <td width="209">Kode Barang</td>
              <td id="barang" width="268"><select name="KdBarang" id="KdBarang" class="easyui-validatebox" required="true" style="width:150px">
                <option value="" selected></option>
                <?php
                    $run = $pdo->query("SELECT * FROM mst_barang ORDER BY KdBarang");
                    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
                    foreach($rs as $r)
                        echo "<option value=\"".$r['KdBarang']."\">".$r['KdBarang']." - ".$r['NmBarang']."</option>";
                ?>
              </select></td>
            </tr>
            <tr>
              <td valign="top">Uraian Barang</td>
              <td><textarea name="UrBarang" cols="20" class="easyui-validatebox" id="UrBarang" required="true"></textarea></td>
            </tr>
            <tr>
              <td>HE Barang</td>
              <td><input name="HE" type="text" id="HE" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." value="" size="12" maxlength="12"></td>
            </tr>
            <tr>
              <td valign="top">Tarif BK</td>
              <td><input name="Tarif" type="text" class="easyui-validatebox" id="Tarif" value="" size="20"></td>
            </tr>
            <tr>
              <td>Jumlah</td>
              <td><input name="qty" type="text" id="qty" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." value="" size="12" maxlength="12"></td>
            </tr>
            <tr>
              <td>Berat (kg)</td>
              <td><input name="NETTO2" type="text" id="NETTO2" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." value="" size="12" maxlength="12"></td>
            </tr>
            <tr>
              <td>Vol. (m3)</td>
              <td><input name="VOL2" type="text" id="VOL2" class="easyui-numberbox" precision="4" groupSeparator="," decimalSeparator="." value="" size="12" maxlength="12"></td>
            </tr>
            <tr>
              <td>Jumlah Nilai FOB</td>
              <td><input name="FOB2" type="text" id="FOB2" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." value="" size="12" maxlength="12"></td>
            </tr>
            </table>
            <input type="submit" id="btnSubmit" name="btnSubmit" style="display:none">
            </form>            
        </div>
        <div id="dlgBarang-buttons">
            <a href="#" id="tl2Sim" class="easyui-linkbutton" iconCls="icon-save">Simpan</a>
            <a href="#" id="tl2Ubh2" class="easyui-linkbutton" iconCls="icon-edit">Ubah</a>
        </div>  
        
        
        
        </div><!--Akhir DIV dataBarang-->
        <div title="Penerimaan & Bukti Pembayaran" style="padding:10px;">
        <table>
        <tr>
          <td>
            <fieldset class="borderblue">           
 			<table width="650" cellspacing="0" class="sub_table">
            <tr>
              <td colspan="2">No. & Tgl. SSPCP</td>
              <td colspan="4"><input type="text" id="SSPCP" name="SSPCP" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="15" tabindex="35">
              <input type="text" id="TgSSPCP" name="TgSSPCP" class="easyui-datebox" required="true" maxlength="10" tabindex="10" value="<?php echo date('d/m/Y') ?>" style="width:100px"></td>
            </tr>
            <tr bgcolor="#CCCCCC">
              <th rowspan="2"  style="border:1px solid #fff;">Jen. Pen</th>  
              <th rowspan="2" style="border:1px solid #fff;">Dibayar (Rp)</th>
              <th colspan="2" style="border:1px solid #fff;">NTB/NTP</th>  
              <th colspan="2" style="border:1px solid #fff;">NTPN</th>
              </tr>
            <tr bgcolor="#CCCCCC" style="border:1px solid #fff;">
              <th style="border:1px solid #fff;">Nomor</th>  
              <th style="border:1px solid #fff;">Tanggal</th>  
              <th style="border:1px solid #fff;">Nomor</th>
              <th style="border:1px solid #fff;">Tanggal</th>  
            </tr>
            <tr>
              <td width="60">BK</td>
              <td align="center" width="93"><input type="text" id="BK" name="BK" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="12" tabindex="35" style="width:100%"></td>
              <td width="147" align="center"><input type="text" id="BK2" name="BK2" tabindex="35" style="width:100%"></td>
              <td width="144" align="center"><input type="text" id="BK3" name="BK3" class="easyui-datebox" size="12" tabindex="35" style="width:100%"></td>
              <td width="150" align="center"><input type="text" id="BK4" name="BK4" tabindex="35" style="width:99%"></td>
              <td width="92" align="center"><input type="text" id="BK5" name="BK5" class="easyui-datebox" size="12" tabindex="35" style="width:100%"></td>
            </tr> 
            <tr>
              <td>PNBP</td>
              <td align="center"><input type="text" id="PNBP" name="PNBP" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="12" tabindex="36" style="width:100%"></td>
              <td align="center"><input type="text" id="PNBP2" name="PNBP2" tabindex="35" style="width:100%"></td>
              <td align="center"><input type="text" id="PNBP3" name="PNBP3" class="easyui-datebox" size="12" tabindex="36" style="width:100%"></td>
              <td align="center"><input type="text" id="PNBP4" name="PNBP4" size="25" tabindex="36" style="width:99%"></td>
              <td align="center"><input type="text" id="PNBP5" name="PNBP5" class="easyui-datebox" size="12" tabindex="36" style="width:100%"></td>
            </tr>            
            </table>         
            </fieldset>            
          </td>
        </tr>                        
        </table> 
        </div><!--Akhir Data Jaminan-->                 
</div><!--Akhir DIV TAB-->
<div id="tab-tools">
        <a id="btnTbh" name="btnTbh" href="#" class="easyui-linkbutton" plain="true" title="Tambah" iconCls="icon-add"></a>
        <a id="btnUbh" name="btnUbh" href="#" class="easyui-linkbutton" plain="true" title="Ubah" iconCls="icon-edit" style="display:none"></a>
        <a id="btnSim" name="btnSim" href="#" class="easyui-linkbutton" plain="true" title="Simpan" iconCls="icon-save" style="display:none"></a>
        <a id="btnHps" name="btnHps" href="#" class="easyui-linkbutton" plain="true" title="Hapus" iconCls="icon-remove" style="display:none"></a> 
        <a id="btnBtl" name="btnBtl" href="#" class="easyui-linkbutton" plain="true" title="Batal" iconCls="icon-undo" style="display:none"></a>
        <a id="btnCri" name="btnCri" href="#" class="easyui-linkbutton" plain="true" title="Cari" iconCls="icon-search"></a>               
    </div>
</form>
</div>  <!--Akhir DIV Window--> 
<div id="wCari"><table id="dgCari" singleSelect="true"></table></div>
<div id="toolCari" style="padding:5px;height:auto">
    <div>
        Tanggal Pendaftaran Dari: <input id="dtdari" class="easyui-datebox" style="width:100px">
        Sampai <input id="dtsampai" class="easyui-datebox" style="width:100px">
        <a href="#" class="easyui-linkbutton" iconCls="icon-search" onClick="cari();">Cari</a>
    </div>
</div>
</body>
</html>