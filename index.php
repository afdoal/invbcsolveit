<?php 
require_once "models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";

$nama_user=$_SESSION['userName'];
?>
<html>
<head>
<title>INVENTORY & BEA CUKAI  SYSTEM</title>  
<link rel="shortcut icon" href="themes/icons/favicon.png" >
<link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>themes/default/easyui.css">
<style type="text/css">
body{
	margin:0px;
	padding:0px;	
}
#mainpage{
	width:100%;
	height:100%;
	background-color:#333;
	border-collapse:collapse;
	font-size:12px;
}
#isi{
	background-color:#fafafa;
}
#content, #treemenu{
	width:98%;
	height:98%;
	border:0px solid #999;
	background-color:transparent;
	-webkit-border-top-right-radius: 5px;
	-webkit-border-bottom-right-radius: 5px;
	-moz-border-radius-topright: 5px;
	-moz-border-radius-bottomright: 5px;
	border-top-right-radius: 5px;
	border-bottom-right-radius: 5px;
}

#menu{
width:175px;

background: rgb(240,249,255); /* Old browsers */
background: -moz-linear-gradient(top, rgba(240,249,255,1) 0%, rgba(203,235,255,1) 47%, rgba(161,219,255,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(240,249,255,1)), color-stop(47%,rgba(203,235,255,1)), color-stop(100%,rgba(161,219,255,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(240,249,255,1) 0%,rgba(203,235,255,1) 47%,rgba(161,219,255,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(240,249,255,1) 0%,rgba(203,235,255,1) 47%,rgba(161,219,255,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(240,249,255,1) 0%,rgba(203,235,255,1) 47%,rgba(161,219,255,1) 100%); /* IE10+ */
background: linear-gradient(top, rgba(240,249,255,1) 0%,rgba(203,235,255,1) 47%,rgba(161,219,255,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f0f9ff', endColorstr='#a1dbff',GradientType=0 ); /* IE6-9 */
}
.header{
background: rgb(179,220,237); /* Old browsers */
background: -moz-linear-gradient(top, rgba(179,220,237,1) 0%, rgba(41,184,229,1) 50%, rgba(188,224,238,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(179,220,237,1)), color-stop(50%,rgba(41,184,229,1)), color-stop(100%,rgba(188,224,238,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(179,220,237,1) 0%,rgba(41,184,229,1) 50%,rgba(188,224,238,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(179,220,237,1) 0%,rgba(41,184,229,1) 50%,rgba(188,224,238,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(179,220,237,1) 0%,rgba(41,184,229,1) 50%,rgba(188,224,238,1) 100%); /* IE10+ */
background: linear-gradient(top, rgba(179,220,237,1) 0%,rgba(41,184,229,1) 50%,rgba(188,224,238,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b3dced', endColorstr='#bce0ee',GradientType=0 ); /* IE6-9 */
}
.footer{
background: rgb(235,241,246); /* Old browsers */
background: -moz-linear-gradient(top, rgba(235,241,246,1) 0%, rgba(171,211,238,1) 50%, rgba(137,195,235,1) 51%, rgba(213,235,251,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(235,241,246,1)), color-stop(50%,rgba(171,211,238,1)), color-stop(51%,rgba(137,195,235,1)), color-stop(100%,rgba(213,235,251,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(235,241,246,1) 0%,rgba(171,211,238,1) 50%,rgba(137,195,235,1) 51%,rgba(213,235,251,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(235,241,246,1) 0%,rgba(171,211,238,1) 50%,rgba(137,195,235,1) 51%,rgba(213,235,251,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(235,241,246,1) 0%,rgba(171,211,238,1) 50%,rgba(137,195,235,1) 51%,rgba(213,235,251,1) 100%); /* IE10+ */
background: linear-gradient(top, rgba(235,241,246,1) 0%,rgba(171,211,238,1) 50%,rgba(137,195,235,1) 51%,rgba(213,235,251,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ebf1f6', endColorstr='#d5ebfb',GradientType=0 ); /* IE6-9 */
}
.welcome{
background: rgb(59,103,158); /* Old browsers */
background: -moz-linear-gradient(top, rgba(59,103,158,1) 0%, rgba(43,136,217,1) 50%, rgba(32,124,202,1) 51%, rgba(125,185,232,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(59,103,158,1)), color-stop(50%,rgba(43,136,217,1)), color-stop(51%,rgba(32,124,202,1)), color-stop(100%,rgba(125,185,232,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(59,103,158,1) 0%,rgba(43,136,217,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(59,103,158,1) 0%,rgba(43,136,217,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(59,103,158,1) 0%,rgba(43,136,217,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%); /* IE10+ */
background: linear-gradient(top, rgba(59,103,158,1) 0%,rgba(43,136,217,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3b679e', endColorstr='#7db9e8',GradientType=0 ); /* IE6-9 */
color:#003;
}
</style>
<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery.min.js"></script>
</head>
<body>
<table id="mainpage" cellpadding="0" cellspacing="0">
<tr class="header" height="10">
  <th class="welcome"><a class="easyui-linkbutton" plain="true"><?php echo strtoupper($nama_user) ?></a></th>
  <th><a class="easyui-linkbutton" plain="true">INVENTORY & BEA CUKAI  SYSTEM <?php echo strtoupper($_SESSION['c_name']) ?></a></th>
  <th align="right" style="width:150px; padding-right:10px;">
  <a class="easyui-linkbutton" plain="true">
  <?php echo date('d/m/Y') ?>&nbsp;
  
<div id="jam" style="float:right">
<script language="javascript">
function jam(){
var waktu = new Date();
var jam = waktu.getHours();
var menit = waktu.getMinutes();
var detik = waktu.getSeconds();

if (jam < 10){
jam = "0" + jam;
}
if (menit < 10){
menit = "0" + menit;
}
if (detik < 10){
detik = "0" + detik;
}
var jam_div = document.getElementById('jam');
jam_div.innerHTML = jam + ":" + menit + ":" + detik;
setTimeout("jam()", 1000);
}
jam();
</script>
</div></a>
  </th>
</tr>
<tr>
  <td id="menu" valign="top">
  <iframe name="treemenu" id="treemenu" scrolling="auto" src="treemenu.php"></iframe>
  </td>
  <td id="isi" colspan="2" valign="top"><iframe name="content" id="content" scrolling="auto" src="content.php" style="padding:5px"></iframe></td>
</tr>
<tr height="10" class="footer">
  <th align="center" class="welcome"><a class="easyui-linkbutton" plain="true">Versi 3.0</a></th>
  <th align="center"><a class="easyui-linkbutton" plain="true">&copy; 2012 WEB CIKARANG.COM</a> </th>
  <th align="right" style="width:150px; padding-right:10px;"><a class="easyui-linkbutton" plain="true">Bandung</a></th>
</tr>
</table>
</body>