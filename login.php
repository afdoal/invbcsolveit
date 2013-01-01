<?php 
require_once "models/abspath.php";
require_once "pdocon.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>INVENTORY & BEA CUKAI SYSTEM</title>
<link rel="stylesheet" type="text/css" href="<?php echo $basedir ?>themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo $basedir ?>themes/icon.css">
<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery.grid.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/global.format.js">disableSelection(document.body); 
</script>
<script>
$(function(){
	
	$("h2").fadeIn(3000);
	$('#frm').form({
		url:'models/loginpass.php',
		onSubmit: function(){  
			return $(this).form('validate');	 
		},  
		success:function(result){			
			var result = eval('('+result+')');
			if (result.success){
				window.open('index.php','_self');
				//alert(result.msg);
			} else {
				$.messager.show({
					title: 'Error',
					msg: result.msg
				});
			}
		}
	});//AKHIR FORM
	
	$("#fUserName").focus();
	
});//AKHIR DOCUMENT READY
</script>
<style type="text/css">
body{
	padding:0px;
	margin:0px
}
.bg{
	padding:0px;
	margin-top:-20px;
	height:100%;
background: rgb(240,249,255); /* Old browsers */
background: -moz-linear-gradient(top, rgba(240,249,255,1) 0%, rgba(203,235,255,1) 47%, rgba(161,219,255,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(240,249,255,1)), color-stop(47%,rgba(203,235,255,1)), color-stop(100%,rgba(161,219,255,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(240,249,255,1) 0%,rgba(203,235,255,1) 47%,rgba(161,219,255,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(240,249,255,1) 0%,rgba(203,235,255,1) 47%,rgba(161,219,255,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(240,249,255,1) 0%,rgba(203,235,255,1) 47%,rgba(161,219,255,1) 100%); /* IE10+ */
background: linear-gradient(top, rgba(240,249,255,1) 0%,rgba(203,235,255,1) 47%,rgba(161,219,255,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f0f9ff', endColorstr='#a1dbff',GradientType=0 ); /* IE6-9 */
}
</style>
</head>
<body oncontextmenu="return false;">
<div class="bg">
<h2 align="center" style="display:none"><br>INVENTORY & BEA CUKAI SYSTEM <br>PT. SOLVE IT </h2>
<div id="w" class="easyui-dialog" iconCls="icon-login"  buttons="#dlg-buttons" closable="false" collapsible="false" minimizable="false" maximizable="false" title=" &nbsp;LOGIN" style="width:300px;height1250px; padding:10px;">
<form id="frm" method="post" target="_blank">
<table align="center" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td>Username</td>
	<td><input class="easyui-validatebox" id="fUserName" type="text" name="fUserName" size="23" required></td>
  </tr>
  <tr>
    <td>Password</td>
	<td><input name="fpass" type="password" class="easyui-validatebox" id="fpass" size="23" required></td>
  </tr>
</table>
<input name="login" type="submit" value="Import" style="display:none" />
</form>
</div>
<div id="dlg-buttons">  
    <a href="#" class="easyui-linkbutton" iconCls="icon-key" onClick="$('#frm').submit()">Login</a>  
</div>
</div><!--Akhir class bg-->
</body>
</html>