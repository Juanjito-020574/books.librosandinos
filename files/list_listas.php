<?php
if(!function_exists('include_if_exists')){include('../system/functions.php');};$nivMin = 3;
include('../system/verif_user.php');
// si se usa verificacion de usuario ya no se debe llamar a system/database.php
//include_if_exists('system/database.php');
if(!isset($_SESSION))session_start();
if(isset($_REQUEST['limit']))$_SESSION['la']['limit'][self()]=$_REQUEST['limit'];
extract($_REQUEST);
$name='listas';$view='';
$tituloTabla='Listas';
			//								print_pre($_REQUEST);
$tId=$name.'_id';
$$name=new DataBase("$name");
$$name->limit=$_SESSION['la']['limit'][self()];
$$name->order="`$tId` DESC";
$$name->_query('SELECT');
			//								echo $$name->q_query;
$row=$$name->q_fetch_assoc;
$format=$$name->q_desc;
extract($format);
$format['titulo']['paises']='Pais';
$format['titulo']['pedidos_cant']='Cantidad';
$dh['add']=1;$dh['edit']=1;$dh['del']=1;$dh['xls']=1;
											print_pre($format);
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
}
//print_pre($format);
//print_pre($row);
include("partial/tablaRejilla.php");
?>
