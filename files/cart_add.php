<?PHP
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
include($ruta.'system/functions.php');
include($ruta.'system/database.php');
if(!isset($_SESSION))session_start();
$encontrado=false;
extract($_REQUEST);
				//								print_pre($_REQUEST);
$cart=new DataBase;
$cart->tabla="cepalall";
$cart->where="id='".$productId."'";
$cart->_query('SELECT');
$row=$cart->q_fetch_assoc;
if(!isset($_SESSION['la']['compras']['productos'])){
	$compras[$productId]=array('id'=>$row['id'],
	'codinca'=>$row["codinca"],
	'codweb'=>$row["codweb"],
	'autor'=>$row["autor"],
	'titulo'=>$row['titulo'],
	'precio'=>($row['oferta']>0?$row['oferta']:$row["p_venta"]),
	'cantidad'=>$cantidad,
	'estado'=>'vigente',
	'orden'=>'',
	'usuarios_id'=>(!isset($_SESSION['la']['usuarios'])?'0':$_SESSION['la']['usuarios']['usuarios_id']),
	'uniq_id'=>(!isset($_SESSION['la']['usuarios']['usuarios_id'])?"0_".$row['id']:$_SESSION['la']['usuarios']['usuarios_id'].'_'.$row['id']),
	'usuario'=>(isset($_SESSION['la']['usuarios']['usuarios_nick'])?$_SESSION['la']['usuarios']['usuarios_nick']:''));
	$_SESSION['la']['compras']['productos']=$compras;
}else{
	$compras=$_SESSION['la']['compras']['productos'];
//	$k=array_search($productId,array_column($compras,'id'));
//	echo $k;
	foreach($compras as $k => $v){
		if ($k==$productId){
			$compras[$k]['cantidad']+=$cantidad;
			$encontrado=true;
		}
	}
}
if (!$encontrado){
	$compras[$productId]=array('id'=>$row['id'],
	'codinca'=>$row["codinca"],
	'codweb'=>$row["codweb"],
	'autor'=>$row["autor"],
	'titulo'=>$row['titulo'],
	'precio'=>($row['oferta']>0?$row['oferta']:$row["p_venta"]),
	'cantidad'=>$cantidad,
	'estado'=>'vigente',
	'orden'=>'',
	'usuarios_id'=>(!$_SESSION['la']['usuarios'] ?'1':$_SESSION['la']['usuarios']['usuarios_id']),
	'uniq_id'=>(!isset($_SESSION['la']['usuarios']['usuarios_id'])?"0_".$row['id']:$_SESSION['la']['usuarios']['usuarios_id'].'_'.$row['id']),
	'usuario'=>(isset($_SESSION['la']['usuarios']['usuarios_nick'])?$_SESSION['la']['usuarios']['usuarios_nick']:''));
}
$tit_num=($row["no_vol"] ? "No. ".$row['no_vol'].". " : "").
		($row["no_serie"] ? "No. ".$row["no_serie"].". " : "").
		($row["vol_serie"] ? $row["vol_serie"].". " : "");
$_SESSION['la']['compras']['productos']=$compras;
header("Location:cart_p.php?".SID);
?>
