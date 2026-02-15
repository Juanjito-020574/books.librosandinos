<?php
if(!function_exists('include_if_exists')){include('../system/functions.php');};$nivMin=3;
include('../system/verif_user.php');
// si se usa verificacion de usuario ya no se debe llamar a system/database.php
//include_if_exists('system/database.php');
if(!isset($_SESSION))session_start();
if(isset($_REQUEST['limit']))$_SESSION['la']['limit'][self()]=$_REQUEST['limit'];
$name='pais_cli';$view='';
$tId='pais_cli_id';
$tituloTabla='Clientes por Pais';
extract($_REQUEST);
//print_pre($_REQUEST);
$$name=new DataBase("$name");
$$name->limit=$_SESSION['la']['limit'][self()];
$format=$$name->q_desc;
$dh['add']=0;$dh['edit']=0;$dh['del']=0;$dh['xls']=0;
switch($sUs_usuarios_nivel){
	case 7:$dh['edit']=1;$dh['del']=1;
	break;
	case 6:$dh['edit']=1;$dh['del']=1;
	break;
	case 5:$dh['edit']=1;$dh['del']=1;
	break;
	case 4:
	break;
	case 3:
	break;
	case 2:
	break;
	case 1:
	break;
}
$$name->_query('SELECT');
//echo $$name->q_query;
$row=$$name->q_fetch_assoc;
//print_pre($format[nuevo]);
include("partial/tablaRejilla.php");
?>
