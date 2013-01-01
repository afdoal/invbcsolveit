<?php 
require_once "models/abspath.php";
require_once "sessions.php";
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="themes/default/easyui.css">
<style type="text/css">
span a:link		{
					font-family:"Times New Roman", Times, serif;
					font-size:11px;
					font-weight:normal;
					text-decoration:none;
					color:000000
					}
			
span a:visited	{
					font-family:"Times New Roman", Times, serif;
					font-size:11px;
					font-weight:normal;
					text-decoration:none;
					color:000000
					}

span a:active	{
					font-family:"Times New Roman", Times, serif;
					font-size:11px;
					font-weight:normal;
					text-decoration:none;
					color:000000
					}

span:hover		{
					font-family:"Times New Roman", Times, serif;
					font-size:12px;
					text-decoration:none;
					color: #000000;
                    
					} 
</style>
<script type="text/javascript" src="models/js/jquery.min.js"></script>
<script type="text/javascript" src="models/js/jquery.grid.min.js"></script>
<script type="text/javascript" src="models/js/global.format.js">
disableSelection(document.body); 
</script>
<?php 
require_once "treemenu.cjs.php";
?>
</head>
<body oncontextmenu="return false;">       
<b style="font-size:14px; color:#003;"><a id="menuutama" class="easyui-linkbutton" plain="true">Menu Utama</a></b>
<ul id="tt"></ul>
</body>
</html>