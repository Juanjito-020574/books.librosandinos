<?PHP 
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
if(!isset($_SESSION))session_start();
include($ruta.'system/functions.php');$nivMin=3;
include($ruta.'system/verif_user.php');
extract($_REQUEST);
if($sUs_usuarios_nivel<3){
	echo "<script>window.location.replace('#list_compras.html');</script>";
	exit;
}
$name='pedidos';
$view=(!isset($view)?'_pais':$view);
$tId=(!isset($tId)?'pedidos_pais':$tId);
$tituloTabla='Pedidos';
					//						print_pre($_REQUEST);
$$name=new DataBase("$name$view");
if(isset($findInto)&&isset($data)&&is_array($data)){
	foreach($data as $i=>$v){
		$where[]="$i REGEXP concat('^(\\\\(*(la|el|las|los|the|¿|¡|\\\"|[0-9])*\\\\)* )*',acentosRegexp('".str_replace('+',' ',$v)."'))";
	}
	$$name->columns="pedidos$view.*";
	$$name->join4='pedidos_cod USING(usuarios_id)';
	$$name->where=implode(' AND ',$where);
	$$name->group='usuarios_id';
}
$$name->_query('SELECT');
				//							echo $$name->q_query;
$row=$$name->q_fetch_assoc;
$format=$$name->q_desc;
$$name->order="`$tId` DESC";
$format['titulo']['paises']='Pais';
$format['titulo']['pedidos_cant']='Cantidad';
				//							print_pre($format);
$dh['add']=1;$dh['edit']=1;$dh['del']=0;
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
<script type="text/javascript">
	$('th.pedidos_cant').attr('width','15%');
	$('td.pedidos_cant').css({'text-align':'right','padding-right':'8px'});
	title_('<?PHP echo $tituloTabla;?>')
</script>

