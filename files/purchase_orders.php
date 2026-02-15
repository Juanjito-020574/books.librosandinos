<?php
if(!function_exists('include_if_exists')){include('../system/functions.php');};$nivMin = 1;
include('../system/verif_user.php');
// si se usa verificacion de usuario ya no se debe llamar a system/database.php
//include_if_exists('system/database.php');
if(!isset($_SESSION))session_start();
if(isset($_REQUEST['limit']))$_SESSION['la']['limit'][self()]=$_REQUEST['limit'];
$name='pedidos';$view='';
$tId='pedidos_id';
$tituloTabla='Compras - Pedidos';
extract($_REQUEST);
									//print_pre($_REQUEST);
									//echo $name;
$$name=new DataBase($name.$view);
$$name->limit=$_SESSION['la']['limit'][self()];
$format=$$name->q_desc;
									//print_pre($format);
$$name->order="`$tId` DESC";
$dh['add']=0;$dh['edit']=1;$dh['del']=1;$dh['xls']=0;
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
	break;
	case 1:
		$$name->where="usuarios_id=$sUs_usuarios_id";
	break;
}

$$name->_query('SELECT');
									//echo $$name->q_query;
	$row=$$name->q_fetch_assoc;
									//print_pre($row);
include("partial/tablaRejilla.php");
?>

