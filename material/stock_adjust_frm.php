<?php
require_once "../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";

$NmMenu=$_REQUEST["NmMenu"];
$TpBarang=$_REQUEST["TpBarang"];

$q="SELECT opname_id FROM mat_opnamehdr ORDER BY opname_id DESC";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
if ($rs){
	$newId=$rs[0]['opname_id']+1;
} else {
	$newId="1";				
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>themes/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>themes/icon.css">
<link type="text/css" href="<?php echo $basedir; ?>themes/redmond/jquery-ui-1.8.4.custom.css" rel="Stylesheet" />
<style type="text/css">
.hdr {
	padding-bottom:28px;
}
.kolom1 {
	float:left;
	width:60px;	
}
.kolom2 {
	float:left;
	width:200px;	
}
.kolom3 {
	float:left;
	width:80px;	
}
.kolom4 {
	float:left;
	width:160px;	
}
.kolom5 {
	float:left;
	width:70px;	
}
.kolom6 {
	float:left;
	width:150px;	
	/*border:1px solid #000;*/
}
</style>

<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery-ui-1.8.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/jquery.grid.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/jquery.edatagrid.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/global.format.js">disableSelection(document.body); 
</script>
<?php 
require_once "stock_adjust_frm.mjs.php";
require_once "stock_adjust_frm.cjs.php";
?>
</head>
<body oncontextmenu="return false;" leftmargin="20" rightmargin="20" topmargin="15" bottommargin="20"> 
<div id="w" style="padding:10px">      
<form id="fm" method="post" onSubmit="return false">
	<input type="hidden" id="aksi" name="aksi">
    <div class="hdr">
      <span class="kolom1">Period </span>
      <span class="kolom2">
      <input type="hidden" id="opname_id" name="opname_id">
      <select name="bulan" id="bulan" class="easyui-validatebox" required="true">
    		<option value=""></option>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
      </select>
        <select name="tahun" id="tahun" class="easyui-validatebox" required="true">
        <option value=""></option>
        <?php for ($i=2012;$i<2021;$i++): ?>
            <option value="<?php echo $i?>"><?php echo $i?></option>
        <?php endfor;?>
        </select>	
	  </span>
      <span class="kolom3">Warehouse</span>
      <span class="kolom4">
      <select name="wh_id" id="wh_id" style="width:150px">
        <option value=""></option>
        <?php
            $run = $pdo->query("SELECT * FROM mat_warehouse WHERE wh_id='3' ORDER BY wh_name");
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['wh_id']."\">".$r['wh_name']."</option>";
        ?>
      </select>    
      </span>
    </div> 
<input type="submit" id="btnSubmit1" name="btnSubmit1" style="display:none">    
</form>    
<div id="toolbar1">  
    <a href="javascript:void(0)" id="tl1Tbh" class="easyui-linkbutton" iconCls="icon-add" plain="true" title="Add">Add</a>  
    <a href="javascript:void(0)" id="tl1Btl" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" title="Cancel">Cancel</a>  
    <a href="javascript:void(0)" id="tl1Sim" class="easyui-linkbutton" iconCls="icon-save" plain="true" title="Save">Save</a> 
</div>

<table id="dg" singleSelect="true"></table> 
<div class="hdr" style="padding-top:10px">
    <a href="#" id="tl2Load" class="easyui-linkbutton" iconCls="icon-ok">Load Data</a>
    <a href="javascript:void(0)" id="tl2Reset" class="easyui-linkbutton" iconCls="icon-cancel">Clear Data</a>
</div>

</div> <!-- akhir div w -->
</body> 
</html>