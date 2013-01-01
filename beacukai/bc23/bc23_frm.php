<?php
require_once "../../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";
$NmMenu=$_REQUEST["NmMenu"];

$q="SELECT right(CAR,6)+1 as auto_no  FROM header WHERE DokKdBc='1' ORDER BY right(CAR,6) DESC LIMIT 1";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
$autono=($rs)?$rs[0]['auto_no']:1;
$carno = str_pad($autono, 6, "0", STR_PAD_LEFT);

/*$q="SELECT right(NoDaf,3)+1 as auto_nodaf FROM header WHERE DokKdBc='1' ORDER BY right(NoDaf,3) DESC LIMIT 1";
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
require_once "bc23.mjs.php";
require_once "bc23.cjs.php";
?>
<body oncontextmenu="return false;">
<div id="w" style="padding:5px;">
<form id="frm" name="frm" action="" method="post">
    <div class="easyui-tabs" tools="#tab-tools" style="width:720px;height:655px;">               
        <div title="Data Umum" style="padding:10px;">
        <div class="demo-info" style="margin-bottom:10px">
            <div class="demo-tip icon-tip">&nbsp;</div>
            <div>
            Klik/pilih Pemasok Terlebih dahulu..
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
						if ($r['KdKpbc']==$_SESSION['KpbcPengawas']){
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
                <td width="152">No. &amp; Tgl. Pendaftaran</td>
                <td width="183"><input type="text" id="NoDaf" name="NoDaf" maxlength="7" size="7" value="<?php echo $NoDaf ?>" tabindex="9">
                  <input type="text" id="TgDaf" name="TgDaf" class="easyui-datebox" required="true" maxlength="10" tabindex="10" value="<?php echo date('d/m/Y') ?>" style="width:100px"></td>
              </tr>
              <tr>
                <td>A. Tujuan</td>
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
                  <select id="KdJnsTpbAsal" name="KdJnsTpbAsal" style="width:160px;" tabindex="4">
                    <option value=""></option>
                    <?php 
					$q="SELECT * FROM jenis_tpb ORDER BY KdJnsTpb";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdJnsTpb']."' ";
						if ($r['KdJnsTpb']==$_SESSION['JnsTpb']){
							$str .= "selected";
						}
						$str .= ">".$r['KdJnsTpb']." - ".$r['UrJnsTpb']."</option>";
						echo $str;
					}
					?>
                  </select></td> 
                <td width="152">Kantor Pabean Bongkar</td>
                <td width="183"><select id="KdKpBongkar" name="KdKpBongkar" style="width:160px;" tabindex="2">
                  <option value=""></option>
                  <?php 
					$q="SELECT * FROM kantor ORDER BY KdKpbc";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdKpbc']."'";
						if ($r['KdKpbc']==$_SESSION['KpbcPengawas']){
							$str .= "selected";
						}
						$str .= ">".$r['KdKpbc']." - ".$r['UrKdKpbc']."</option>";
						echo $str;
					}
					?>
                </select></td>               
              </tr>
              <tr>
                <td>B. Jenis Barang</td>
                <td><select id="KdJnsBarang" name="KdJnsBarang" style="width:160px;" tabindex="4">
                  <option value=""></option>
                  <?php 
					$q="SELECT * FROM jenis_barang ORDER BY KdJnsBarang";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdJnsBarang']."' ";
						/*if ($r['KdJnsbarang']==$_SESSION['JnsBarang']){
							$str .= "selected";
						}*/
						$str .= ">".$r['KdJnsBarang']." - ".$r['UrJnsBarang']."</option>";
						echo $str;
					}
					?>
                </select></td>
                <td>Kantor Pabean Pengawas</td>
                <td width="183"><select id="KdKpPengawas" name="KdKpPengawas" style="width:160px;" tabindex="2">
                  <option value=""></option>
                  <?php 
					$q="SELECT * FROM kantor ORDER BY KdKpbc";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdKpbc']."'";
						if ($r['KdKpbc']==$_SESSION['KpbcPengawas']){
							$str .= "selected";
						}
						$str .= ">".$r['KdKpbc']." - ".$r['UrKdKpbc']."</option>";
						echo $str;
					}
					?>
                </select></td>
              </tr>
              <tr>
                <td>C. Tujuan Pengiriman</td>
                <td><select id="KdTp" name="KdTp" tabindex="6" style="width:160px;">
                  <option value=""></option>
                  <?php 
					$q="SELECT * FROM tujuan_pengiriman ORDER BY KdTp";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						echo "<option value='".$r['KdTp']."'>".$r['KdTp']." - ".$r['UrTp']."</option>";
					}
					?>
                </select></td>    
                <td>&nbsp;</td>
                <td width="183"></td>
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
              <td colspan="2"><b>PEMASOK</b></td>  
              <td colspan="3"><b>PPJK</b></td>
            </tr>
            <tr>
              <td width="10%">Nama</td>
              <td width="40%">
              <select id="NmTuj" name="NmTuj" style="width:200px;">
              <option value=""></option>
              <?php 
					$q="SELECT * FROM mst_perusahaan WHERE TpPrshn='s' ORDER BY NmPrshn";
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
                <td>Ref No. </td>
                <td colspan="2">
                  <select id="ref_id" name="ref_id"></select>
                </td>
              </tr>
            </table>
            </fieldset>
          </td>
        </tr>                    
        <tr>
          <td>
            <fieldset class="borderblue">          
            <legend><b>DATA PENGANGKUTAN</b></legend>
            <table cellspacing="0" class="sub_table" width="100%">
              <tr>
              <td width="23%">Cara Pengangkutan </td>
              <td width="27%">
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
              <td width="12%">Nomor Polisi</td>
              <td width="38%"><input type="text" id="NoPolisi" name="NoPolisi" maxlength="10" size="10" tabindex="22"></td>
            </tr>
            <tr>
              <td width="23%">Nama Sarana Pengangkut </td>
              <td width="27%"><input type="text" id="NmAngkut" name="NmAngkut" maxlength="18" size="18" tabindex="21"></td> 
              <td width="12%"></td>
              <td width="38%">&nbsp;</td>
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
              <td width="21%">Pelabuhan Muat</td>
              <td>
                <select id="KdMuatAsal" name="KdMuatAsal" style="width:150px;">
                  <option value=""></option>
                  <?php 
					$q="SELECT * FROM mst_pelabuhan ORDER BY KdPelabuhan";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdPelabuhan']."'";
						$str .= ">".$r['KdPelabuhan']." - ".$r['NmPelabuhan']."</option>";
						echo $str;
					}
					?>
                </select></td>
              <td width="18%">Pelabuhan Bongkar</td> 
              <td width="32%">
                <select id="KdBongkar" name="KdBongkar" style="width:150px;">
                  <option value=""></option>
                  <?php 
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
            </tr>
            <tr>
              <td width="21%">Pelabuhan Transit</td>
              <td width="29%">
                <select id="KdTransit" name="KdTransit" style="width:150px;">
                  <option value=""></option>
                  <?php 
					foreach ($rs as $r){
						$str = "<option value='".$r['KdPelabuhan']."'";
						$str .= ">".$r['KdPelabuhan']." - ".$r['NmPelabuhan']."</option>";
						echo $str;
					}
					?>
                </select></td> 
              <td width="18%">Tempat Penimbunan</td>
              <td width="32%">
                <select id="KdTimbun" name="KdTimbun" style="width:150px;">
                  <option value=""></option>
                  <?php 
					$q="SELECT * FROM mst_penimbunan ORDER BY KdTimbun";
					$run = $pdo->query($q);
		  		    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
					foreach ($rs as $r){
						$str = "<option value='".$r['KdTimbun']."'";
						$str .= ">".$r['KdTimbun']." - ".$r['NmTimbun']."</option>";
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
            <legend><b>DATA PERDAGANGAN</b></legend>
            <table cellspacing="0" class="sub_table" width="100%">
            <tr>
              <td width="20%">Valuta</td>     
              <td width="29%">
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
              <td width="18%">NDPBM</td>
              <td width="32%"><input type="text" id="NDPBM" name="NDPBM" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." maxlength="10" size="15" tabindex="29"></td>
            </tr>
            <tr>
              <td width="20%">FOB</td>              
              <td><input type="text" id="FOB" name="FOB" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." maxlength="10" size="15" tabindex="29"></td>
              <td>CIF (Rp.)</td>
              <td><input type="text" id="CIF" name="CIF" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." maxlength="10" size="15" tabindex="29"></td>
            </tr>
            <tr>
              <td width="20%">Freight</td>              
              <td><input type="text" id="Freight" name="Freight" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." maxlength="10" size="15" tabindex="29"></td>
              <td>Asuransi LN/DN</td>
              <td><input type="text" id="AsLNDN" name="AsLNDN" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." maxlength="10" size="15" tabindex="29"></td>
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
        
        </div><!--Akhir DIV dataBarang-->
        <div title="Data Jaminan" style="padding:10px;">
        <table>
        <tr>
          <td>
            <fieldset class="borderblue">
 			<table width="700" cellspacing="0" class="sub_table">
            <tr>
              <th align="left">Jenis</th>  
              <th>Dibayar (Rp)</th>  
              <th>Ditangguhkan (Rp)</th>  
              <th>Kode Akun</th>  
              <th>No. Tanda Pembayaran</th>
              <th>Tgl.</th>  
            </tr>
            <tr>
              <td width="50">BM</td>
              <td align="center" width="80"><input type="text" id="BM" name="BM" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="12" tabindex="35" style="width:100%"></td>
              <td width="80" align="center"><input type="text" id="BM2" name="BM2" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="12" tabindex="35" style="width:100%"></td>
              <td width="100" align="center"><input type="text" id="BM3" name="BM3" tabindex="35" style="width:100%"></td>
              <td width="120" align="center"><input type="text" id="BM4" name="BM4" tabindex="35" style="width:100%"></td>
              <td width="80" align="center"><input type="text" id="BM5" name="BM5" class="easyui-datebox" size="12" tabindex="35" style="width:100%"></td>
            </tr> 
            <tr>
              <td>Cukai</td>
              <td align="center"><input type="text" id="Cukai" name="Cukai" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="12" tabindex="36" style="width:100%"></td>
              <td align="center"><input type="text" id="Cukai2" name="Cukai2" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="12" tabindex="36" style="width:100%"></td>
              <td align="center"><input type="text" id="Cukai3" name="Cukai3" size="12" tabindex="36" style="width:100%"></td>
              <td align="center"><input type="text" id="Cukai4" name="Cukai4" size="25" tabindex="36" style="width:100%"></td>
              <td align="center"><input type="text" id="Cukai5" name="Cukai5" class="easyui-datebox" size="12" tabindex="36" style="width:100%"></td>
            </tr> 
            <tr>
              <td valign="top"> PPN</td>
              <td align="center" valign="top"><input type="text" id="PPN" name="PPN" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="12" tabindex="37" style="width:100%"><br></td>
              <td align="center" valign="top"><input type="text" id="PPN2" name="PPN2" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="12" tabindex="37" style="width:100%"></td>
              <td align="center" valign="top"><input type="text" id="PPN3" name="PPN3" size="12" tabindex="37" style="width:100%"></td>
              <td align="center" valign="top"><input type="text" id="PPN4" name="PPN4" size="25" tabindex="37" style="width:100%"></td>
              <td align="center" valign="top"><input type="text" id="PPN5" name="PPN5" class="easyui-datebox" size="12" tabindex="37" style="width:100%"></td>
            </tr>
            <tr>
              <td> PPnBM</td>
              <td align="center"><input type="text" id="PPnBM" name="PPnBM" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="12" tabindex="38" style="width:100%"></td>
              <td align="center"><input type="text" id="PPnBM2" name="PPnBM2" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="12" tabindex="38" style="width:100%"></td>
              <td align="center"><input type="text" id="PPnBM3" name="PPnBM3" size="12" tabindex="38" style="width:100%"></td>
              <td align="center"><input type="text" id="PPnBM4" name="PPnBM4" size="25" tabindex="38" style="width:100%"></td>
              <td align="center"><input type="text" id="PPnBM5" name="PPnBM5" class="easyui-datebox" size="12" tabindex="38" style="width:100%"></td>
            </tr>
            <tr>
              <td class="brdr_btm"> PPh 22</td>
              <td align="center" class="brdr_btm"><input type="text" id="PPh" name="PPh" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="12" tabindex="39" style="width:100%"></td>
              <td align="center"><span class="brdr_btm">
                <input type="text" id="PPh2" name="PPh2" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="12" tabindex="39" style="width:100%">
              </span></td>
              <td align="center"><span class="brdr_btm">
                <input type="text" id="PPh3" name="PPh3" size="12" tabindex="39" style="width:100%">
              </span></td>
              <td align="center"><span class="brdr_btm">
                <input type="text" id="PPh4" name="PPh4" size="25" tabindex="39" style="width:100%">
              </span></td>
              <td align="center"><span class="brdr_btm">
                <input type="text" id="PPh5" name="PPh5" class="easyui-datebox" size="12" tabindex="39" style="width:100%">
              </span></td>
            </tr>
            <tr>
              <td class="brdr_btm"> PNBP</td>
              <td align="center" class="brdr_btm"><input type="text" id="PNBP" name="PNBP" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="12" tabindex="39" style="width:100%"></td>
              <td align="center"><span class="brdr_btm">
                <input type="text" id="PNBP2" name="PNBP2" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="12" tabindex="39" style="width:100%">
              </span></td>
              <td align="center"><span class="brdr_btm">
                <input type="text" id="PNBP3" name="PNBP3" size="12" tabindex="39" style="width:100%">
              </span></td>
              <td align="center"><span class="brdr_btm">
                <input type="text" id="PNBP4" name="PNBP4" size="25" tabindex="39" style="width:100%">
              </span></td>
              <td align="center"><span class="brdr_btm">
                <input type="text" id="PNBP5" name="PNBP5" class="easyui-datebox" size="12" tabindex="39" style="width:100%">
              </span></td>
            </tr>
            <tr>
              <td> Total</td>
              <td align="center"><input type="text" id="Total" name="Total" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="12" tabindex="49" style="width:100%"></td>
              <td align="center"><input type="text" id="TotalH" name="TotalH" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." size="12" tabindex="49" style="width:100%"></td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
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
  <td>Kode Penggunaan Barang</td>
  <td><select name="KdGunaBarang" id="KdGunaBarang" class="easyui-validatebox"  style="width:150px">
      <option value=""></option>
      <?php
        $run = $pdo->query('SELECT * FROM mst_penggunaanbarang ORDER BY KdGuna');
        $rs = $run->fetchAll(PDO::FETCH_ASSOC);
        foreach($rs as $r)
            echo "<option value=\"".$r['KdGuna']."\">".$r['KdGuna']." - ".$r['NmGuna']."</option>";
    ?>
      </select></td>
</tr>
<tr>
  <td valign="top">Tarif</td>
  <td><textarea name="Tarif" cols="20" class="easyui-validatebox" id="Tarif"></textarea></td>
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
  <td>Jumlah Nilai CIF</td>
  <td><input name="CIF2" type="text" id="CIF2" class="easyui-numberbox" precision="2" groupSeparator="," decimalSeparator="." value="" size="12" maxlength="12"></td>
</tr>
</table>
<input type="submit" id="btnSubmit" name="btnSubmit" style="display:none">
</form>            
</div>
<div id="dlgBarang-buttons">
<a href="#" id="tl2Sim" class="easyui-linkbutton" iconCls="icon-save">Simpan</a>
<a href="#" id="tl2Ubh2" class="easyui-linkbutton" iconCls="icon-edit">Ubah</a>
</div>  
        
</body>
</html>