<?php
if(!function_exists('include_if_exists')){include('../system/functions.php');};$nivMin = 5;
include('../system/verif_user.php');
//session_start();
$name='usuarios';$view='';
$tId=$name.'_id';
$tituloTabla='Usuarios';
extract($_REQUEST);
		//						print_pre($_SESSION);
if(isset($_REQUEST['limit']))$_SESSION['la']['limit'][self()]=$_REQUEST['limit'];
$$name=new DataBase($name);
$$name->limit=$_SESSION['la']['limit'][self()];
$format=$$name->q_desc;
$dh['add']=0;$dh['edit']=0;$dh['del']=0;$dh['xls']=0;
switch($sUs_usuarios_nivel){
	case 7:
		$$name->where="$tId='".$sUs_usuarios_id."'";
		$$name->whereOr="usuarios_nivel < '".$sUs_usuarios_nivel."'";
		$format['visible']['usuarios_nivel']='1';
		$dh['add']=1;$dh['edit']=1;$dh['del']=1;
	break;
	case 6:
		$$name->where="$tId='".$sUs_usuarios_id."'";
		$$name->where="($tId!='".$sUs_usuarios_id."' AND $tId >= '10' AND usuarios_nivel<'".$sUs_usuarios_nivel."')";
		$format['visible']['usuarios_nivel']='1';
		$dh['add']=1;$dh['edit']=1;$dh['del']=1;
	break;
	case 5:
//		$$name->where="($tId!='".$sUs_usuarios_id."' AND $tId >= '10' AND usuarios_nivel<'".$sUs_usuarios_nivel."')";
		$$name->where="$tId='".$sUs_usuarios_id."'";
		$dh['add']=0;$dh['edit']=1;$dh['del']=0;
	break;
	case 4:
		$$name->where="$tId='".$sUs_usuarios_id."'";
	break;
	case 3:
		$$name->where="$tId='".$sUs_usuarios_id."'";
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
//print_pre($$name->q_fetch_array);
include("partial/tablaRejilla.php");
?>
