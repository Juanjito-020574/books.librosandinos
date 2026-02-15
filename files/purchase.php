<?php
if(!function_exists('include_if_exists')){include('../system/functions.php');};$nivMin = 1;
include('../system/verif_user.php');
// si se usa verificacion de usuario ya no se debe llamar a system/database.php
//include_if_exists('system/database.php');
if(!isset($_SESSION))session_start();
if(isset($_REQUEST['limit']))$_SESSION['la']['limit'][self()]=$_REQUEST['limit'];
extract($_REQUEST);
if($sUs_usuarios_nivel<3){
//	echo "<script>window.location.replace('#purchase_orders.html');</script>";
//	exit;
}
$name='pedidos';
$view=(!isset($_REQUEST['view'])&&!isset($_REQUEST['findInto'])?'_pais':(!isset($_REQUEST['view'])?'_usuario':$_REQUEST['view']));
$using=(!isset($_REQUEST['view'])&&!isset($_REQUEST['findInto'])?'pedidos_pais':'usuarios_id');
$tId=$using;
//$tId=(!$tId?'pedidos_pais':$tId);
$tituloTabla='Pedidos';
			//								print_pre($_GET);
$$name=new DataBase("$name$view");
$$name->limit=$_SESSION['la']['limit'][self()];
if(isset($findInto)&&is_array($data)&&$data){
	foreach($data as $i=>$v){
		$where[]="$i REGEXP concat('^(\\\\(*(la|el|las|los|the|¿|¡|\\\\\"|[0-9])*\\\\)* )*',acentosRegexp('".str_replace('+',' ',$v)."'))";
	}
	$$name->columns="pedidos$view.*";
	$$name->join4="pedidos_cod USING($using)";
	$$name->where=implode(' AND ',$where);
	$$name->group="$using";
	$$name->order="`$tId` DESC";
}
$$name->_query('SELECT');
				//							echo $$name->q_query;
$row=$$name->q_fetch_assoc;
$format=$$name->q_desc;
extract($format);
$format['campo']['paises']='paises';
$format['campo']['pedidos_cant']='pedidos_cant';
$format['titulo']['paises']='Pais';
$format['titulo']['pedidos_cant']='Cantidad';
		//									print_pre($format);
$dh['add']=0;$dh['edit']=1;$dh['del']=0;$dh['xls']=0;
switch($sUs_usuarios_nivel){
	case 7:$dh['del']=1;$dh['xls']=1;$dh['add']=1;
	break;
	case 6:$dh['del']=1;$dh['xls']=0;$dh['add']=1;
	break;
	case 5:$dh['xls']=0;$dh['add']=1;
	break;
	case 4:$dh['xls']=0;
	break;
	case 3:$dh['xls']=0;
	break;
}
//print_pre($format);
//print_pre($row);
include("partial/tablaRejilla.php");
?>
