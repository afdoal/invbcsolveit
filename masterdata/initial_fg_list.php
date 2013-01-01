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
require_once "initial_fg_list.mjs.php";
require_once "mst_list.cjs.php";
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
    Search
     <select id="pilcari" name="pilcari">
    	<option value="wh_name">Warehouse</option>
        <option value="date">Date</option>
    </select> 
    <input type="text" id="txtcari" name="txtcari" style="width:100px">
    <a href="#" id="dtlCri" class="easyui-linkbutton" iconCls="icon-search"></a>
</div>
</body> 
</html>