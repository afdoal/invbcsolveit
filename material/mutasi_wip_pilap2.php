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
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/datagrid-detailview.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/global.format.js">disableSelection(document.body); 
</script>
<?php 
require_once "mutasi_wip_pilap2.mjs.php";
require_once "mst_list.cjs.php";

$date1="01/".date("m/Y");
$date2=date("d/m/Y");
?>
<style type="text/css">
.kolom2 {	float:left;
	width:170px;	
}
</style>
</head>
<body oncontextmenu="return false;" leftmargin="20" rightmargin="20" topmargin="15" bottommargin="20"> 
<div id="w">      
<table id="dg" singleSelect="true"></table>         
</div>       
<div id="toolCari">  
    Search Date: From     
    <input type="text" class="easyui-datebox" id="date1" name="date1" style="width:100px" value="<?php echo $date1?>"> to
    <input type="text" class="easyui-datebox" id="date2" name="date2" style="width:100px" value="<?php echo $date2?>">
    <a href="#" id="dtlCri" class="easyui-linkbutton" iconCls="icon-search"></a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-pdf" onClick="showPrint();">Printable</a>    
</div>
</body> 
</html>