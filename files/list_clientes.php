<?php
if(!function_exists('include_if_exists')){include('../system/functions.php');};$nivMin = 5;
include('../system/verif_user.php');
// si se usa verificacion de usuario ya no se debe llamar a system/database.php
//include_if_exists('system/database.php');
if(!isset($_SESSION))session_start();
if(isset($_REQUEST['limit']))$_SESSION['la']['limit'][self()]=$_REQUEST['limit'];
$name='usuarios';
$view='_cli';
$tId='usuarios_id';
$tituloTabla='Clientes';
extract($_REQUEST);
//print_pre($_REQUEST);
$$name=new DataBase("$name$view");
$$name->limit=$_SESSION['la']['limit'][self()];
$format=$$name->q_desc;
$dh['add']=1;$dh['edit']=1;$dh['del']=0;$dh['xls']=0;
$$name->order="usuarios_nick";
switch($sUs_usuarios_nivel){
	case 7:$dh['xls']=1;
	break;
	case 6:
		$$name->where="$tId>'10'";$dh['xls']=1;
	break;
	case 5:
		$$name->where="$tId>'10'";$dh['xls']=0;
	break;
	case 4:
		$$name->where="$tId>'10'";$dh['xls']=0;
	break;
	case 3:
		$$name->where="$tId>'10'";$dh['xls']=0;
	break;
	case 2:
		$$name->where="$tId='".$sUs_usuarios_id."'";
	break;
	case 1:
		$$name->where="$tId='".$sUs_usuarios_id."'";
	break;
}
$$name->_query('SELECT');
//echo $$name->q_query;
$row=$$name->q_fetch_assoc;
//print_pre($format[nuevo]);
$format['titulo']['usuarios_nick']="Codigo/Nick";
$format['visible']['usuarios_mail']=0;
$format['visible']['usuarios_empresa']=1;
include("partial/tablaRejilla.php");
?>

