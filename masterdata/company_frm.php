<?php
require_once "../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";

$NmMenu=$_REQUEST["NmMenu"];
$TpPrshn=$_REQUEST["TpPrshn"];
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
require_once "company_frm.mjs.php";
require_once "mst_frm.cjs.php";
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

<div id="dlg" class="easyui-dialog" style="width:450px;height:450px;padding:10px" closed="true" buttons="#dlg-buttons">
	<form id="fm" method="post" onSubmit="return false">
 	<table>
    <tr>
      <td width="113">Nama Perusahaan</td>
      <td width="248"><input name="NmPrshn0" type="hidden" id="NmPrshn0" class="easyui-validatebox" value="">        <input name="NmPrshn" type="text" id="NmPrshn" class="easyui-validatebox" value="" style="width:250px" required></td>
    </tr>
    <tr style="display:none">
      <td>TpPrshn</td>
      <td><input name="TpPrshn" type="text" id="TpPrshn" class="easyui-validatebox" value="" ></td>
    </tr>
    <tr>
      <td>NPWP</td>
      <td><input name="NpwpPrshn" type="text" id="NpwpPrshn" class="easyui-validatebox" value=""></td>
    </tr>
    <tr>
      <td valign="top">Alamat</td>
      <td><textarea name="AlmtPrshn" cols="30" required class="easyui-validatebox" id="AlmtPrshn"></textarea></td>
    </tr>
    <tr style="display:none">
      <td>Kota</td>
      <td><input name="Kota" type="text" id="Kota" class="easyui-validatebox" value="" size="20" maxlength="20"></td>
    </tr>
    <tr style="display:none">
      <td>Provinsi</td>
      <td><input name="Prov" type="text" id="Prov" class="easyui-validatebox" value="" size="30" maxlength="30">
      </td>
    </tr>
    <tr>
      <td>Negara</td>
      <td><select name="Negara" id="Negara" class="easyui-validatebox" required="true" style="width:200px">
          <option value=""></option>
          <?php
            $run = $pdo->query('SELECT KdNegara,NmNegara FROM mst_negara ORDER BY KdNegara');
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['KdNegara']."\">".$r['KdNegara']." - ".$r['NmNegara']."</option>";
        ?>
          </select></td>
    </tr>
    <tr>
      <td>Faks.</td>
      <td><input name="fax" type="text" id="fax" class="easyui-validatebox" value="" size="30" maxlength="30">
      </td>
    </tr>
    <tr>
      <td>Telepon</td>
      <td><input name="tlp" type="text" id="tlp" class="easyui-validatebox" value="" size="30" maxlength="30">
      </td>
    </tr>
    <tr>
      <td>Status</td>
      <td><select name="Status" id="Status" class="easyui-validatebox" style="width:200px">
          <option value=""></option>
          <?php
            $run = $pdo->query('SELECT KdStatus,NmStatus FROM mst_status ORDER BY KdStatus');
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['KdStatus']."\">".$r['KdStatus']." - ".$r['NmStatus']."</option>";
        ?>
          </select></td>
    </tr>
    <tr>
      <td>Status KB</td>
      <td><select name="StatusKB" id="StatusKB" class="easyui-validatebox" style="width:200px">
          <option value=""></option>
          <option value="KB">KB</option>
          <option value="Non KB">Non KB</option>
          </select></td>
    </tr>
    <tr>
      <td valign="top">No. TPB</td>
      <td><input name="NoTpb" type="text" id="NoTpb" value="" size="30" maxlength="30"></td>
    </tr>
    <tr>
      <td valign="top">Niper</td>
      <td><input name="Niper" type="text" id="Niper" value="" size="20" maxlength="20"></td>
    </tr>
    <tr>
      <td valign="top">Contact Person</td>
      <td><input name="Cp" type="text" id="Cp" value="" size="20" maxlength="20"></td>
    </tr>
    <tr>
      <td valign="top">Valuta</td>
      <td><select name="Valuta" id="Valuta" class="easyui-validatebox" style="width:200px">
          <option value=""></option>
          <?php
            $run = $pdo->query('SELECT * FROM valuta ORDER BY KdVal');
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['KdVal']."\">".$r['KdVal']." - ".$r['UrVal']."</option>";
        ?>
          </select></td>
    </tr>
    <?php if ($TpPrshn=='p'){ ?>
    <tr>
      <td valign="top">No. Pokok PPJK</td>
      <td><input name="NoPokokPpjk" type="text" id="NoPokokPpjk" value="" size="20" maxlength="20"></td>
    </tr>
    <tr>
      <td valign="top">Tgl. Pokok PPJK</td>
      <td><input name="TgPokokPpjk" type="text" class="easyui-datebox" id="TgPokokPpjk" value="" size="20" maxlength="20"></td>
    </tr>
    <?php } ?>
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