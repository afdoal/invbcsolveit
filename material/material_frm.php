<?php
require_once "../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";

$NmMenu=$_REQUEST["NmMenu"];
$TpBarang=$_REQUEST["TpBarang"];
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
require_once "material_frm.mjs.php";
require_once "mst_frm.cjs.php";
?>
</head>
<body oncontextmenu="return false;" leftmargin="20" rightmargin="20" topmargin="15" bottommargin="20"> 
<div id="w">      
<table id="dg" singleSelect="true"></table>         
</div>       
<div id="toolbar">  
    <a href="javascript:void(0)" id="btnTbh" class="easyui-linkbutton" iconCls="icon-add" plain="true" title="Tambah">Add</a>  
    <a href="javascript:void(0)" id="btnUbh" class="easyui-linkbutton" iconCls="icon-edit" plain="true" title="Hapus">Edit</a> 
    <a href="javascript:void(0)" id="btnHps" class="easyui-linkbutton" iconCls="icon-remove" plain="true" title="Hapus">Delete</a>  
	<a href="javascript:void(0)" id="btnPrint" class="easyui-linkbutton" iconCls="icon-pdf" plain="true" title="Hapus">Printable</a>              
</div>

<div id="dlg" class="easyui-dialog" style="width:400px;height:240px;padding:10px" closed="true" buttons="#dlg-buttons">
	<form id="fm" method="post" onSubmit="return false">
    <input type="hidden" name="TpBarang" id="TpBarang" value="">
 	<table>
    <tr>
      <td width="114">Mat. Group</td>
      <td width="254">
      <select name="MatGroup" id="MatGroup" class="easyui-validatebox" style="width:150px" required="true">
   		<option value=""></option>
		  <?php 
            $run = $pdo->query("SELECT * FROM mat_group ORDER BY matgroup_code");
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r){
                echo "<option value=\"".$r['matgroup_code']."\">".$r['matgroup_code']." - ".$r['matgroup_name']."</option>";
            }
        ?>
      </select></td>
    </tr>
    <tr>
      <td width="114">Mat. Code.</td>
      <td width="254"><input name="KdBarang0" type="hidden" id="KdBarang0" class="easyui-validatebox" value="">        <input name="KdBarang" type="text" id="KdBarang" class="easyui-validatebox" value="" size="20" maxlength="20" required></td>
    </tr>
    <tr>
      <td>Mat. Name</td>
      <td><input name="NmBarang" type="text" id="NmBarang" class="easyui-validatebox" value="" size="30" maxlength="30" required></td>
    </tr>
	<tr>
      <td>Description</td>
      <td><input name="Ket" type="text" id="Ket" class="easyui-validatebox" value="" size="30" maxlength="30" required></td>
    </tr>
    <tr style="display:none">
      <td>Section</td>
      <td><input name="twhmp" type="text" id="twhmp" class="easyui-validatebox" value="" size="25"></td>
    </tr>
    <tr style="display:none">
      <td>Hs No.</td>
      <td><input name="HsNo" type="text" id="HsNo" class="easyui-validatebox" size="20"></td>
    </tr>
    <tr style="display:none">
      <td>Die No.</td>
      <td><input name="DieNo" type="text" id="DieNo" class="easyui-validatebox" value="" size="20"></td>
    </tr>
    <tr style="display:none">
      <td>UW/m</td>
      <td><input name="UWm" type="text" id="UWm" class="easyui-numberbox" groupSeparator="," decimalSeparator="." precision="4" value="" size="20"></td>
    </tr>
    <tr style="display:none">
      <td>L/Pc</td>
      <td><input name="LPc" type="text" id="LPc" class="easyui-numberbox" groupSeparator="," decimalSeparator="." precision="4" value="" size="20"></td>
    </tr>
    <tr style="display:none">
      <td>W/Pcs</td>
      <td><input name="WPcs" type="text" id="WPcs" class="easyui-numberbox" groupSeparator="," decimalSeparator="." precision="4" value="" size="20"></td>
    </tr>
    <tr style="display:none">
      <td>L/Bar</td>
      <td><input name="LBar" type="text" id="LBar" class="easyui-numberbox" groupSeparator="," decimalSeparator="." value="" size="20"></td>
    </tr>
    <tr style="display:none">
      <td>Pc/Bar</td>
      <td><input name="PcBar" type="text" id="PcBar" class="easyui-numberbox" groupSeparator="," decimalSeparator="." value="" size="20"></td>
    </tr>
    <tr style="display:none">
      <td>W/Bar</td>
      <td><input name="WBar" type="text" id="WBar" class="easyui-numberbox" groupSeparator="," decimalSeparator="." precision="4" value="" size="20"></td>
    </tr>
    <tr style="display:none">
      <td>Finish</td>
      <td><input name="Finish" type="text" id="Finish" class="easyui-validatebox" value="" size="20"></td>
    </tr>        
    <tr>
      <td>Unit</td>
      <td>
        <select name="Sat" id="Sat" class="easyui-validatebox" required="true" style="width:50px">
          <option value=""></option>
          <?php 
            $run = $pdo->query("SELECT KdSat,UrSat FROM satuan ORDER BY KdSat");
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r){
				echo "<option value=\"".$r['KdSat']."\">".$r['KdSat']." - ".$r['UrSat']."</option>";
			}
        ?>
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