<?php
require_once "../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";

$NmMenu=$_REQUEST["NmMenu"];
$TpBarang=$_REQUEST["TpBarang"];

$q="SELECT po_id FROM pur_pohdr ORDER BY po_id DESC";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
if ($rs){
	$newId=$rs[0]['po_id']+1;
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
	width:70px;	
}
.kolom2 {
	float:left;
	width:170px;	
}
.kolom3 {
	float:left;
	width:70px;	
}
.kolom4 {
	float:left;
	width:140px;	
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

.fkolom1 {
	float:left;
	width:130px;	
}
.fkolom2 {
	float:left;
	width:180px;
}
.fkolom3 {
	float:left;
	width:110px;	
}
.fkolom4 {
	float:left;
	width:200px;
}
.kolom21 {	float:left;
	width:200px;	
}
</style>

<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery-ui-1.8.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/jquery.grid.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/jquery.edatagrid.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/global.format.js">disableSelection(document.body); 
</script>
<?php 
require_once "po_frm.mjs.php";
require_once "po_frm.cjs.php";
?>
</head>
<body oncontextmenu="return false;" leftmargin="20" rightmargin="20" topmargin="15" bottommargin="20"> 
<div id="w" style="padding:10px">      
<form id="fm" method="post" onSubmit="return false">
	<input type="hidden" id="aksi" name="aksi">
    <div class="hdr">
      <span class="kolom1">PO No. </span><span class="kolom2">
      <input type="hidden" id="po_id" name="po_id">
      <input type="text" id="po_no" name="po_no" style="width:100px">    
      </span>
      <span class="kolom3">PO Date </span>
      <span class="kolom4">
        <input type="text" id="po_date" name="po_date" class="easyui-datebox" required maxlength="10" tabindex="10" style="width:100px">
      </span>
      <span class="kolom5">Currency</span>
      <span class="kolom6">
      <select name="currency" id="currency" style="width:80px">
        <option value=""></option>
        <?php
            $run = $pdo->query("SELECT * FROM valuta WHERE KdVal IN ('Rp','USD') ORDER BY KdVal");
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['KdVal']."\">".$r['KdVal']."</option>";
        ?>
      </select></span>
    </div>    
    <div class="hdr">
      <span class="kolom1">Seller </span><span class="kolom2">
      <select name="supplier" id="supplier" style="width:150px">
        <option value=""></option>
        <?php
            $run = $pdo->query("SELECT NmPrshn FROM mst_perusahaan WHERE TpPrshn='s' ORDER BY NmPrshn");
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['NmPrshn']."\">".$r['NmPrshn']."</option>";
        ?>
      </select>
      </span>
      <span class="kolom3">PPN (%)</span>
      <span class="kolom4"><input type="text" id="ppn" name="ppn" style="width:130px"></span>
      <span class="kolom5"></span>
      <span class="kolom6">
      
      </span>      
    </div>
    <div class="hdr">
      <span class="kolom1">Attn.</span><span class="kolom2">
      <input type="text" id="attn" name="attn" style="width:130px">
      </span>
      <span class="kolom3">Terms</span>
      <span class="kolom4"><input type="text" id="terms" name="terms" style="width:130px"></span>
      <span class="kolom5">&nbsp;</span>
      <span class="kolom6">
      
      </span>      
    </div>
    <!--
    <div class="hdr">
      <span class="kolom1">
        Total Qty.
      </span>
      <span class="kolom2">
      <input type="text" id="tot_qty" name="tot_qty" style="width:100px" readonly>
      </span>
      <span class="kolom3"> Total Amount</span>
      <span class="kolom4">
      <input type="text" id="tot_amount" name="tot_amount" style="width:100px" readonly></span>
    </div>-->

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
<div class="hdr" style="padding-top:10px">
 <span class="fkolom1">Conditions:</span><span class="fkolom2">&nbsp;</span><span class="fkolom3">Notes</span><span class="fkolom4"> <input type="text" id="notes" name="notes" style="width:150px;"></span>
</div>
<div class="hdr"> 
  <span class="fkolom1">Specification</span><span class="fkolom2"><input type="text" id="spec" name="spec" style="width:150px;"></span><span class="fkolom3">Delivery Date</span><span class="fkolom4"><input type="text" id="dlv_date" name="dlv_date" class="easyui-datebox" required style="width:100px"></span>
</div>
<div class="hdr">   
  <span class="fkolom1">Width Tolerance</span><span class="fkolom2"><input type="text" id="width_tol" name="width_tol" style="width:150px;"></span><span class="fkolom3">Delivery Place</span><span class="fkolom4">
  <select name="wh_id" id="wh_id" style="width:150px">
    <option value=""></option>
    <?php
            $run = $pdo->query("SELECT wh_id, wh_name FROM mat_warehouse ORDER BY wh_id ASC");
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['wh_id']."\">".$r['wh_name']."</option>";
        ?>
  </select>
  </span></div>
<div class="hdr">   
  <span class="fkolom1">Thickness Tolerance</span><span class="fkolom2"><input type="text" id="thick_tol" name="thick_tol" style="width:150px;">
  </span><span class="fkolom3">Remark</span><span class="fkolom4"><input type="text" id="remark" name="remark" style="width:150px;"></span>
</div>
<div class="hdr">   
  <span class="fkolom1">Weight/Roll Max. (kg)</span><span class="fkolom2">
  <input type="text" id="Wrmax" name="Wrmax" style="width:150px;"></span><span class="fkolom3">Auth. Signature</span><span class="fkolom4"><input type="text" id="auth_sign" name="auth_sign" style="width:150px;"></span>
</div>    
<input type="submit" id="btnSubmit1" name="btnSubmit1" style="display:none">
</form>     

<div id="dlg" style="padding:10px">	    
	<form name="fm2" id="fm2" method="post" onSubmit="return false">
 	<table>
    <tr>
      <td width="115">Mat. Code</td>
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
      <td><input name="qty" type="text" id="qty" value="" style="width:100px"></td>
    </tr>
    <tr>
      <td>Price</td>
      <td><input name="price" type="text" id="price" value="" style="width:100px"></td>
    </tr>
    <tr>
      <td>Amount</td>
      <td><input name="amount" type="text" id="amount" value="" style="width:100px" readonly></td>
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
    <select id="pilcari" name="pilcari">
    	<option value="po_no">PO No.</option>
        <option value="po_date">PO Date</option>
        <option value="supplier">Seller</option>
        <option value="dlv_date">Delivery Date</option>
    </select> 
    <input type="text" id="txtcari" name="txtcari" style="width:100px">
    <a href="#" id="dtlCri" class="easyui-linkbutton" iconCls="icon-search"></a>
</div>
           
</div> <!-- akhir div w -->
</body> 
</html>