<?php
require_once "../models/abspath.php";
require_once "sessions.php";
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo $basedir ?>themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo $basedir ?>themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo $basedir ?>themes/main.css">
<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery.grid.min.js">
</script>
<script type="text/javascript">
$(function(){
	$("#w").dialog({
		title:"<?php echo $_REQUEST['NmMenu'] ?>",
		width:400,
		height:150,
		top:0,
		left:0,
		buttons:"#dlg-buttons",
		collapsible:false,
		minimizable:false,
		maximizable:false
	});
});
</script>
</head>
<body>
<div id="w" style="padding:10px;">
<form id="frm" action="proses.php" method="post" enctype="multipart/form-data">
<br>
Silahkan pilih file excel : <input name="userfile" type="file" />
<br><br>
<input name="upload" type="submit" value="Import" style="display:none" />
</form>
</div>
<div id="dlg-buttons">  
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onClick="$('#frm').submit()">Import</a>  
</div> 
</body>
</html>