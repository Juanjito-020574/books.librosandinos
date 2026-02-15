<?PHP
if(!isset($_SESSION))session_start();
extract($_REQUEST);
$compras=$_SESSION['la']['compras']['productos'];
foreach($compras as $k => $v){
	if ($v['id']==$productId){
		if($v['cantidad']>1){
			$compras[$k]['cantidad']-=$cantidad;
			$encontrado=1;
		}else{
			unset($compras[$productId]);
		}
	}
}

if(count($compras)>0){
	$_SESSION['la']['compras']['productos']=$compras;
}else{
	unset($_SESSION['la']['compras']['productos']);
	if(count($_SESSION['la'])==0)unset($_SESSION['la']);
}
header("Location:cart_p.php?".SID);
?>