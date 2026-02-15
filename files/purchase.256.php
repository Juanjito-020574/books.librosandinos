<?PHP 
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
include($ruta.'system/functions.php');$nivMin=1;
include($ruta.'system/verif_user.php');
if(!isset($_SESSION))session_start();
if($sUs_usuarios_nivel>2){
	echo "<script>window.location.replace('#list_pedidos.html');</script>";
	exit;
}
$name='pedidos';$view='';
$tId='pedidos_id';
$tituloTabla='Compras - Pedidos';
extract($_REQUEST);
//print_pre($_REQUEST);
$$name=new DataBase($name.$view);
$format=$$name->q_desc;
//print_pre($format);
$$name->order="`$tId` DESC";
$dh['add']=1;$dh['edit']=1;$dh['del']=1;
switch($sUs_usuarios_nivel){
	case 7:
	break;
	case 6:
	break;
	case 5:
	break;
	case 4:
	break;
	case 3:
	break;
	case 2:
		$$name->where="usuarios_id=$sUs_usuarios_id";
		$dh['add']=0;
	break;
	case 1:
		$$name->where="usuarios_id=$sUs_usuarios_id";
		$dh['add']=0;
	break;
}

$$name->_query('SELECT');
//echo $$name->q_query;
	$row=$$name->q_fetch_assoc;
//print_pre($row);
include("partial/tablaRejilla.php");
?>
