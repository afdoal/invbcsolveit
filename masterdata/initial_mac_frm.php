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
<style type="text/css">
.hdr {
	padding-bottom:30px;
}
.kolom1 {
	float:left;
	width:80px;	
	display:none;
}
.kolom2 {
	float:left;
	width:200px;
	display:none;	
}
.kolom3 {
	float:left;
	width:70px;	
}
.kolom4 {
	float:left;
	width:200px;	
/*	border:1px solid #000;*/
}
.kolom5 {
	float:left;
	width:90px;	
}
.kolom6 {
	float:left;
	width:300px;	
/*	border:1px solid #000;*/
}
</style>

<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery-ui-1.8.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/jquery.grid.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/jquery.edatagrid.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/global.format.js">disableSelection(document.body); 
</script>
<?php 
require_once "initial_mac_frm.mjs.php";
require_once "initial_mac_frm.cjs.php";
?>
</head>
<body oncontextmenu="return false;" leftmargin="20" rightmargin="20" topmargin="15" bottommargin="20"> 
<div id="w" style="padding:10px">      
<form id="fm" method="post" onSubmit="return false">
	<input type="hidden" id="aksi" name="aksi">
    <input type="hidden" id="wh_id0" name="wh_id0" value="5">
    <input type="hidden" id="wh_id" name="wh_id" value="5">
    <div class="hdr">
      <span class="kolom1">Warehouse </span><span class="kolom2"><input type="hidden" id="wh_id0" name="wh_id0">
      <select name="wh_id" id="wh_id" style="width:150px">
          <?php
            $run = $pdo->query("SELECT wh_id, wh_name FROM mat_warehouse WHERE wh_id='1' ORDER BY wh_id ASC");
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['wh_id']."\">".$r['wh_name']."</option>";
        ?>        
      </select>      
      </span>
      <span class="kolom3">Date</span>
      <span class="kolom4">
      	<input type="hidden" id="date0" name="date0">
        <input type="text" id="date" name="date" class="easyui-datebox" required maxlength="10" tabindex="10" style="width:100px">
      </span>
      <span class="kolom5">Mat. Type </span><span class="kolom6"><input type="hidden" id="mat_type0" name="mat_type0">
      <select name="mat_type" id="mat_type" style="width:150px">
        <option value=""></option>
          <?php
            $run = $pdo->query("SELECT KdJnsBarang, JnsBarang FROM mst_jenisbarang WHERE KdJnsBarang IN ('3','5','12') ORDER BY KdJnsBarang ASC");
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['KdJnsBarang']."\">".$r['JnsBarang']."</option>";
        ?>        
      </select>      
      </span>
    </div>

<div id="toolbar1">  
    <a href="javascript:void(0)" id="tl1Tbh" class="easyui-linkbutton" iconCls="icon-add" plain="true" title="Add">Add</a>  
    <a href="javascript:void(0)" id="tl1Ubh" class="easyui-linkbutton" iconCls="icon-edit" plain="true" title="Edit">Edit</a> 
    <a href="javascript:void(0)" id="tl1Hps" class="easyui-linkbutton" iconCls="icon-remove" plain="true" title="Delete">Delete</a>
    <a href="javascript:void(0)" id="tl1Btl" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" title="Cancel">Cancel</a>  
    <a href="javascript:void(0)" id="tl1Sim" class="easyui-linkbutton" iconCls="icon-save" plain="true" title="Save">Save</a> 
    <a href="javascript:void(0)" id="tl1Cri" class="easyui-linkbutton" iconCls="icon-search" plain="true" title="Search">Search</a>  
	<a href="javascript:void(0)" id="btnPrint" class="easyui-linkbutton" iconCls="icon-pdf" plain="true" title="Hapus">Printable</a>                  
</div>

<table id="dg" singleSelect="true"></table> 
<div id="toolbar2">  
    <a href="javascript:void(0)" id="tl2Tbh" class="easyui-linkbutton" iconCls="icon-add" plain="true" title="Tambah">Add</a>  
    <a href="javascript:void(0)" id="tl2Ubh" class="easyui-linkbutton" iconCls="icon-edit" plain="true" title="Hapus">Edit</a> 
    <a href="javascript:void(0)" id="tl2Hps" class="easyui-linkbutton" iconCls="icon-remove" plain="true" title="Hapus">Delete</a>  
</div>            
<input type="submit" id="btnSubmit1" name="btnSubmit1" style="display:none">
</form>     

<div id="dlg" style="padding:10px">	    
	<form name="fm2" id="fm2" method="post" onSubmit="return false">
 	<table>
    <tr>
      <td width="115">Material Code</td>
      <td width="319"><input name="KdBarang3" type="hidden" id="KdBarang3" class="easyui-validatebox" value=""><input id="KdBarang2" name="KdBarang2" type="text" style="width:100px"></td>
    </tr>
    <tr>
      <td>Desc.</td>
      <td><input name="NmBarang2" type="text" id="NmBarang2" style="width:150px" readonly></td>
    </tr>
    <tr>
      <td>Unit</td>
      <td>
        <select name="Sat2" id="Sat2" style="width:50px">
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
      <td>Quantity</td>
      <td><input name="qty" type="text" id="qty" value="" style="width:50px"></td>
    </tr>
    </table>
    <input type="submit" id="btnSubmit2" name="btnSubmit2" style="display:none">
    </form>
    <div id="dlg-buttons">
        <a href="#" id="tl2Sim" class="easyui-linkbutton" iconCls="icon-ok">Save</a>
        <a href="#" id="tl2Ubh2" class="easyui-linkbutton" iconCls="icon-ok">Update</a>
        <a href="javascript:void(0)" id="tl2Reset" class="easyui-linkbutton" iconCls="icon-cancel">Reset</a>
    </div>
</div>

<div id="wCari"><table id="dgCari" singleSelect="true"></table></div>
<div id="toolCari">  
    Search
    <select id="txtcari" name="txtcari">
    	<option value=""></option>
          <?php
            $run = $pdo->query("SELECT KdJnsBarang, JnsBarang FROM mst_jenisbarang WHERE KdJnsBarang IN ('3','5') ORDER BY KdJnsBarang ASC");
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['KdJnsBarang']."\">".$r['JnsBarang']."</option>";
        ?>
    </select>
    <a href="#" id="dtlCri" class="easyui-linkbutton" iconCls="icon-search"></a>
</div>

           
</div> <!-- akhir div w -->
</body> 
</html>