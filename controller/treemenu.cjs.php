<?php 
$grp=$_SESSION['grup']; 
switch ($grp){
	case "admin"://< jika /folder_root/
		$tm = "tree_data";
		break;
	case "gudang"://< jika /folder_root/sub1_root/
		$tm = "tree_data_gudang";
		break;
	case "exim":
		$tm = "tree_data_exim";
		break;
	case "bc":
		$tm = "tree_data_bc";
		break;		
	default://case "eksekutif":
		$tm = "tree_data_eks";
		break;	
}

?>
<script type="text/javascript">
$(function(){


$('#tt').tree({  
    url:'models/<?php echo $tm?>.json',
	onClick:function(node){
		$(this).tree('toggle', node.target);
	}
});

$('#menuutama').click(function(){
	$('#tt').tree('collapseAll');
});

});
</script>
