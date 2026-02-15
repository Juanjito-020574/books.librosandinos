<?PHP 
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
if(!function_exists('include_if_exists')){include($ruta.'system/functions.php');}
include($ruta.'system/database.php');
if(!isset($_SESSION))session_start();
$name='magazines';
$view='s';
extract($_REQUEST);
$recView=10; //estos valores los recibo por GET
if(isset($num) && $num){
	$recStart=($num-1)*$recView;
	$pagAct=$num; //caso contrario los iniciamos
}else{
	$recStart=0;
	$pagAct=1;
}
$$name=new DataBase;
$$name->tabla="cepal$view";
$$name->limit="$recStart,$recView";
$$name->_query('SELECT');
$row=$$name->q_fetch_assoc;
$recQty=$$name->q_qty_rows['fr'];

$recLast=$recStart+$$name->q_num_rows;

$arch="$name.html";
$b="";
$titTxt = "<b>$recQty </b>Revistas para Consulta y Venta";
if(isset($recQty)){
$pagPrev=$pagAct-1;
$pagNext=$pagAct+1;
if(($recQty%$recView)>0){//verificamos la division del total de registros y los registros a mostrar tiene residuo para ver si llevar ? decimales
	$pagLast=floor($recQty/$recView)+1;// si hay residuo usamos funcion floor para que me devuelva la parte entera, SIN REDONDEAR, y le sumamos una unidad para obtener la ultima pagina
}else{
	$pagLast=$recQty/$recView;//si no hay residuo dividimos el total de registros por los registros a mostrar
}
?>
<header class="s-head">
	<?PHP echo "$titTxt";
	//echo "mostrando ".($recStart+1)." a ".$recLast." registros";
	include "paginator.php";?>
</header>
<div class="wabody">
<?PHP 
//echo $$name->tabla;
do{
	echo"<article class='singleCol'>
		<div style='font-family:SantanaBold, Arial;text-align:center;'>$row[titulo]</div>
		<div style='width:100%;text-align:left'>";
	include('revistas_cam.php');
	echo"</div></article>";
}While($row=mysqli_fetch_assoc($$name->q_src));
?>
	
</div>
<footer class="s-foot">
</footer>
<?PHP } else {
	include "vacio.php";
}?>
<script type="text/javascript">

var wabodyH=$('.wabody').height(),cabeceraH=$('#cabecera').height();
$('.wabody').scroll(function(e){
	var top=this.scrollTop;
	if(top>0&&this.scrollHeight>500){$('#cabecera').hide();$(this).height(wabodyH+cabeceraH);
	}else{$('#cabecera').removeAttr('style');$(this).removeAttr('style');
	}
});
title_('<?PHP echo"$name $pagAct";?>');
</script>
