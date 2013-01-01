<?php
require_once "../models/abspath.php";
require_once "pdocon.php";

$DokKdBc = $_REQUEST["DokKdBc"];
?>
<select name="NoAju" id="NoAju" class="easyui-validatebox"  style="width:150px">
  <option value=""></option>
  <?php
    $run = $pdo->query("SELECT CAR FROM header WHERE DokKdBc='$DokKdBc' ORDER BY CAR");
    $rs = $run->fetchAll(PDO::FETCH_ASSOC);
    foreach($rs as $r)
        echo "<option value=\"".$r['CAR']."\">".$r['CAR']."</option>";
?>
</select>