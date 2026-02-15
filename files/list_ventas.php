<?php
if(!function_exists('include_if_exists')){include('../system/functions.php');};$nivMin = 4;
include('../system/verif_user.php');
if(!isset($_SESSION))session_start();
$name='ventas';
$view='';
$columns='ventas_id,ventas_fact,ventas_fecha,ventas_cliente,ventas_approval,ventas_cantidad,ventas_total,ventas_mark';
$tId=$name.'_id';
$tituloTabla='Ventas';
extract($_REQUEST);
				//										print_pre($_REQUEST);
if(isset($_REQUEST['limit']))$_SESSION['la']['limit'][self()]=$_REQUEST['limit'];
$$name=new DataBase("$name$view",$columns);
$$name->limit=$_SESSION['la']['limit'][self()];
				//										print_pre($format[predet]);
$$name->order="`$tId` DESC";
$format=$$name->q_desc;
$dh['add']=1;$dh['edit']=1;$dh['del']=0;$dh['xls']=0;
switch($sUs_usuarios_nivel){
	case 7:$dh['del']=0;$dh['xls']=1;
	break;
	case 6:$dh['xls']=1;
	break;
	case 5:$dh['xls']=0;
	break;
	case 4:$dh['xls']=0;
	break;
	case 3:
	break;
	case 2:
	break;
	case 1:
	break;
}
if(isset($findInto)&&isset($data)){
	$$name->group='ventas_cliente';
	print_pre($data);
	foreach($data as $i=>$v){
//	print_pre(substr($i,0,7).'-'.$data);
		if($i=='ventas_fecha'||$i=='ventas_cliente'){
		if(preg_match("/[\"\']/",$v)==0){$v="='$v'";}
			$where[]="$i ".preg_replace('/\\\\/','',$v);
		}else{
			$where[]="$i REGEXP concat('^(\\\\(*(la|el|las|los|the|¿|¡|[0-9 ])*\\\\)* )*',acentosRegexp('".preg_replace(array('/^(\(*(la|el|las|los|the|¿|¡|[0-9 ])*\)* )*/'),array(''),$v)."'))";
		}
	}
	$$name->join='ventas_detalle_all USING(ventas_id)';
	$$name->columns='ventas.*';

	$$name->where=implode(' AND ',$where);
}
$$name->_query('SELECT');
													echo "<pre>".$$name->q_query."</pre>";
	$row=$$name->q_fetch_assoc;
				//									print_pre($row);
include("partial/tablaRejilla.php");
?>
