<?PHP
//print_r($_REQUEST);
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
include($ruta.'system/functions.php');
include($ruta.'system/database.php');
$name='novelties';$num=1;
extract($_REQUEST);
$titTxt='Novedades';
$view='novelties';
$recView=20; //estos valores los recibo por GET
//$where='((`fecha_compra` <= curdate()) and ((`fecha_compra` + interval 30 day) >= curdate())) and p_venta>0 and stock>1 and descriptores!=""';
//$order='`id` DESC';
$nodata="<p class='comentario'>Lo sentimos mucho, pero no se han registrado libros nuevos en los últimos 30 días.</p>
<p class='comentario'>Todas las novedades que ingresan a nuestro sistema son mostradas en esta sección solamente por por el lapso de 30 días.</p>
<p class='comentario'>Si desea buscar algún titulo en especial por favor utilice nuestras herramientas de búsqueda rápida o búsqueda avanzada</p>";
include "present.php";
?>