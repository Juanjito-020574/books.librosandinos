<?PHP 
if(!function_exists('include_if_exists')){include('../system/functions.php');}
include_if_exists('system/database.php');
session_start();$num=1;
$name='offers';
extract($_REQUEST);
$view='ms';
$titTxt='Libros en Oferta';
$recView=10;
$where='oferta>0';
$order='';
$nodata="Por el momento no tenemos ofertas.<br />
Todas las ofertas aparecen en esta sección.";
include "present.php";
?>
