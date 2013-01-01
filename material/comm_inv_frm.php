<?php
require_once "../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";

$NmMenu=$_REQUEST["NmMenu"];
$TpBarang=$_REQUEST["TpBarang"];

$q="SELECT comm_id FROM mkt_comminvhdr ORDER BY comm_id DESC";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
if ($rs){
	$newId=$rs[0]['comm_id']+1;
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
	width:90px;	
}
.kolom2 {
	float:left;
	width:120px;	
}
.kolom3 {
	float:left;
	width:100px;	
}
.kolom4 {
	float:left;
	width:120px;	
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
require_once "comm_inv_frm.mjs.php";
require_once "comm_inv_frm.cjs.php";
?>
</head>
<body oncontextmenu="return false;" leftmargin="20" rightmargin="20" topmargin="15" bottommargin="20"> 
<div id="w" style="padding:10px">      
<form id="fm" method="post" onSubmit="return false">
	<input type="hidden" id="aksi" name="aksi">
    <div class="hdr">
      <span class="kolom1">Comm. Inv. No. </span><span class="kolom2">
      <input type="hidden" id="comm_id" name="comm_id">
      <input type="text" id="comm_no" name="comm_no" style="width:100px">    
      </span>
      <span class="kolom3">Comm. Inv. Date </span>
      <span class="kolom4">
        <input type="text" id="comm_date" name="comm_date" class="easyui-datebox" required="true" maxlength="10" tabindex="10" style="width:100px">
      </span>
      <span class="kolom5">DO No. </span>
      <span class="kolom6">
      <input type="hidden" id="do_id" name="do_id" style="width:100px">
      <select name="do_no" id="do_no" style="width:150px"></select></span>
    </div>        
    <div class="hdr">
      <span class="kolom1">Payment</span>
      <span class="kolom2"><input type="text" name="payment" id="payment" style="width:100px">
      
      </span>
      <span class="kolom3">POL</span>
      <span class="kolom4">
      <input type="text" name="pol" id="pol" style="width:100px"></span>
      <span class="kolom5">POD</span>
      <span class="kolom6"><input type="text" name="pod" id="pod" style="width:100px"></span>
    </div>  
    <div class="hdr">
      <span class="kolom1">Container</span>
      <span class="kolom2">
      <input type="text" name="container" id="container" style="width:100px">
      </span>
      <span class="kolom3">On Board date</span>
      <span class="kolom4"><input type="text" id="sail_date" name="sail_date" class="easyui-datebox" required="true" maxlength="10" tabindex="10" style="width:100px"></span>
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
      </select>
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
</div>

<table id="dg" singleSelect="true"></table> 
<div id="toolbar2">  
    <a href="javascript:void(0)" id="tl2Tbh" class="easyui-linkbutton" iconCls="icon-add" plain="true" title="Tambah">Add</a>  
    <a href="javascript:void(0)" id="tl2Ubh" class="easyui-linkbutton" iconCls="icon-edit" plain="true" title="Hapus">Edit</a> 
    <a href="javascript:void(0)" id="tl2Hps" class="easyui-linkbutton" iconCls="icon-remove" plain="true" title="Hapus">Delete</a>  
</div>        
<div class="hdr" style="padding-top:10px">
  <span class="kolom1">Vessel</span>
  <span class="kolom2">
  <input type="text" name="vessel" id="vessel" style="width:100px">
  </span>
  <span class="kolom3">Voy. No.</span>
  <span class="kolom4">
  <input type="text" name="voy_no" id="voy_no" style="width:100px">
  </span>
  <span class="kolom5">FOB</span>
  <span class="kolom6">
  <input type="text" name="fob" id="fob" style="width:100px">
  
  </span>
</div>   
<div class="hdr">
  <span class="kolom1">Freight</span>
  <span class="kolom2">
  <input type="text" name="freight" id="freight" style="width:100px">
  </span>
  <span class="kolom3">Insurance</span>
  <span class="kolom4">
  <input type="text" name="insurance" id="insurance" style="width:100px">
  </span>
  <span class="kolom5">CNF</span>
  <span class="kolom6">
  <input type="text" name="cnf" id="cnf" style="width:100px">
  </span>
</div> 
<div class="hdr">
  <span class="kolom1">Notify Party</span>
  <span class="kolom2">
  <input type="text" name="notify" id="notify" style="width:100px">
  </span>
  <span class="kolom3">Auth. Signature</span>
  <span class="kolom4">
  <input type="text" name="auth_sign" id="auth_sign" style="width:100px">
  </span>
  <span class="kolom5">Notes</span>
  <span class="kolom6">
  <input type="text" name="notes" id="notes" style="width:100px">
  </span>
</div> 
<input type="submit" id="btnSubmit1" name="btnSubmit1" style="display:none">
</form>     

<div id="dlg" style="padding:10px">	    
	<form name="fm2" id="fm2" method="post" onSubmit="return false">
 	<table>
    <tr>
      <td width="115">Name.</td>
      <td width="319"><input name="KdBarang3" type="hidden" id="KdBarang3" class="easyui-validatebox" value=""><input id="KdBarang2" name="KdBarang2" type="text" style="width:100px"></td>
    </tr>
    <tr>
      <td>HS No.</td>
      <td><input name="HsNo2" type="text" id="HsNo2" style="width:150px" readonly></td>
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
      <td><input name="amount" type="text" id="amount" value="" style="width:100px"></td>
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
    	<option value="comm_no">Comm. Inv. No.</option>
        <option value="comm_date">Comm. Inv. Date</option>
        <option value="do_no">DO No.</option>
    </select> 
    <input type="text" id="txtcari" name="txtcari" style="width:100px">
    <a href="#" id="dtlCri" class="easyui-linkbutton" iconCls="icon-search"></a>
</div>
           
</div> <!-- akhir div w -->
</body> 
</html>