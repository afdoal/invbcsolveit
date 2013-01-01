<?php
require_once "../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";

$NmMenu=$_REQUEST["NmMenu"];
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>themes/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>themes/icon.css">
<link type="text/css" href="<?php echo $basedir; ?>themes/redmond/jquery-ui-1.8.4.custom.css" rel="Stylesheet" />

<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery-ui-1.8.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/jquery.grid.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/jquery.edatagrid.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/global.format.js">disableSelection(document.body); 
</script>
<?php 
require_once "barang_frm.mjs.php";
require_once "mst_frm.cjs.php";
require_once "mat_frm.cjs.php";
?>
</head>
<body oncontextmenu="return false;" leftmargin="20" rightmargin="20" topmargin="15" bottommargin="20"> 
<div id="w">      
<table id="dg" singleSelect="true"></table>         
</div>       
<div id="toolbar">  
    <a href="javascript:void(0)" id="btnTbh" class="easyui-linkbutton" iconCls="icon-add" plain="true" title="Tambah">Tambah</a>  
    <a href="javascript:void(0)" id="btnUbh" class="easyui-linkbutton" iconCls="icon-edit" plain="true" title="Hapus">Ubah</a> 
    <a href="javascript:void(0)" id="btnHps" class="easyui-linkbutton" iconCls="icon-remove" plain="true" title="Hapus">Hapus</a>  
	<a href="javascript:void(0)" id="btnPrint" class="easyui-linkbutton" iconCls="icon-pdf" plain="true" title="Hapus">Printable</a>      
</div>

<div id="dlg" class="easyui-dialog" style="width:400px;height:300px;padding:10px" closed="true" buttons="#dlg-buttons">
	<form id="fm" method="post" onSubmit="return false">
 	<table>
    <tr>
      <td width="115">Kode Barang</td>
      <td width="319"><input name="KdBarang0" type="hidden" id="KdBarang0" class="easyui-validatebox" value="">        <input name="KdBarang" type="text" id="KdBarang" class="easyui-validatebox" value="" size="20" maxlength="20" required></td>
    </tr>
    <tr>
      <td>Jenis Barang</td>
      <td><select name="TpBarang" id="TpBarang" class="easyui-validatebox" required="true" style="width:150px">
        <option value=""></option>
        <?php
            $run = $pdo->query('SELECT * FROM mst_jenisbarang WHERE KdJnsBarang NOT IN (0,1,10,11) ORDER BY KdJnsBarang');
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['KdJnsBarang']."\">".$r['KdJnsBarang']." - ".$r['JnsBarang']."</option>";
        ?>
      </select></td>
    </tr>
    <tr>
      <td>Nama Barang</td>
      <td><input name="NmBarang" type="text" id="NmBarang" class="easyui-validatebox" value="" size="30" maxlength="30" required></td>
    </tr>
    <tr>
      <td>HS No.</td>
      <td><input name="HsNo" type="text" id="HsNo" class="easyui-validatebox" value="" size="20" maxlength="20" required></td>
    </tr>
    <tr>
      <td>Sat</td>
      <td>
        <select name="Sat" id="Sat" class="easyui-validatebox" required="true" style="width:50px">
          <option value=""></option>
          <?php
            $run = $pdo->query('SELECT KdSat,UrSat FROM satuan ORDER BY KdSat');
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['KdSat']."\">".$r['KdSat']." - ".$r['UrSat']."</option>";
        ?>
          </select>
      </td>
    </tr>
    <tr>
      <td>Harga</td>
      <td><input name="Harga" type="text" id="Harga" value="" size="12" maxlength="12"></td>
    </tr>
    <tr>
      <td valign="top">Keterangan</td>
      <td>
        <textarea name="Ket" cols="25" class="easyui-validatebox" id="Ket"></textarea></td>
    </tr>
    </table>
    <input type="submit" id="btnSubmit" name="btnSubmit" style="display:none">
    </form>            
</div>
<div id="dlg-buttons">
    <a href="#" id="btnSim" class="easyui-linkbutton" iconCls="icon-ok">Simpan</a>
    <a href="javascript:void(0)" id="btnReset" class="easyui-linkbutton" iconCls="icon-cancel">Kosongkan</a>
</div>            
</body> 
</html>