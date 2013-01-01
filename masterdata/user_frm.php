<?php
require_once "../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";

$NmMenu=$_REQUEST["NmMenu"];
$usr=$_SESSION['userName'];
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
require_once "user_frm.mjs.php";
require_once "mst_frm.cjs.php";
?>
</head>
<body oncontextmenu="return false;" leftmargin="20" rightmargin="20" topmargin="15" bottommargin="20"> 
<div id="w">
<table id="dg" singleSelect="true"></table>              
</div>
<div id="toolbar">  
<?php  if ($usr == "admin"){ ?>
    <a href="javascript:void(0)" id="btnTbh" class="easyui-linkbutton" iconCls="icon-add" plain="true" title="Tambah">Tambah</a>  
<?php  } ?>   
    <a href="javascript:void(0)" id="btnUbh" class="easyui-linkbutton" iconCls="icon-edit" plain="true" title="Hapus">Ubah</a> 
<?php  if ($usr == "admin"){ ?>
    <a href="javascript:void(0)" id="btnHps" class="easyui-linkbutton" iconCls="icon-remove" plain="true" title="Hapus">Hapus</a>  
<?php  } ?>
	<a href="javascript:void(0)" id="btnPrint" class="easyui-linkbutton" iconCls="icon-pdf" plain="true" title="Hapus">Printable</a>  
</div>

<div id="dlg" class="easyui-dialog" style="width:500px;height:300px;padding:10px" closed="true" buttons="#dlg-buttons">
	<form id="fm" method="post" onSubmit="return false">
 	<table>
    <tr>
      <td width="115">Nama User</td>
      <td width="319"><input name="nama_user0" type="hidden" id="nama_user0" class="easyui-validatebox" value="">        <input name="nama_user" type="text" id="nama_user" class="easyui-validatebox" value="" size="20" required></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input name="pass" type="password" class="easyui-validatebox" id="pass" value="" size="50"></td>
    </tr>
    <tr>
      <td>Level</td>
      <td>
      <select name="grup" id="grup">
        <option value=""></option>
        <option value="admin">Admin</option>
        <option value="gudang">Gudang</option>
        <option value="exim">Exim</option>
        <option value="bc">BC</option>
        <option value="eksekutif">Eksekutif</option>
      </select>
      </td>
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