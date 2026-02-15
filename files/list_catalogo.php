<?php
extract($_REQUEST);
if(!function_exists('include_if_exists')){include('../system/functions.php');};$nivMin=5;
include('../system/verif_user.php');
if(!isset($_SESSION))session_start();
if(isset($_REQUEST['limit']))$_SESSION['la']['limit'][self()]=$_REQUEST['limit'];
$name='catalogo';
if(!isset($view))$view='';
$tId='cat';
$tituloTabla='Catalogos';
				//			print_pre($_REQUEST);
$$name=new DataBase($name);
$$name->limit=$_SESSION['la']['limit'][self()];
$format=$$name->q_desc;
$$name->where="";//estado!='cerrado' OR gestion>='".(date('Y')-2)."'"
$$name->order="catalogo_id DESC";
$dh['add']=1;$dh['edit']=1;$dh['del']=0;$dh['xls']=0;
switch($sUs_usuarios_nivel){
	case 7: $dh['xls']=1;
	break;
	case 6: $dh['xls']=1;
	break;
	case 5: $dh['edit']=0; $dh['add']=0;
	break;
	case 4: $dh['add']=0;
	break;
	case 3:
	break;
	case 2:
	break;
	case 1:
	break;
}
$$name->_query('SELECT');
			//				echo $$name->q_query;
$row=$$name->q_fetch_assoc;
include("partial/tablaRejilla.php");
?>
