<?PHP
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
include($ruta.'system/functions.php');
include($ruta.'system/database.php');
if(!isset($_SESSION))session_start();
$h_title="buscador";
$name='find';
$view=(isset($_SESSION['la']['usuarios']['usuarios_nivel'])&&$_SESSION['la']['usuarios']['usuarios_nivel']<3?'ms':'all');
print_pre($_SESSION['la']['usuarios']['usuarios_nivel']);
extract($_REQUEST);
$wordsRep1=Array();
$where;
print_pre($_REQUEST);
//preg_match('/[\d\-]{8,20}/',$datos);
if(isset($datos)){
	$camp='concat(`';$valor='';$where='(';
	foreach($datos as $i=>$v){
		$camp.=(preg_match("/[\s\-\,]/",$i)?preg_replace("/[\s\-\,]+/",'`,`',$i):"`,`$i");
  //      echo preg_match('/[\s\-\,]/',$i)." - - ".$camp."<br>";
		$valor.=$v.' ';
	}
	$camp=str_replace('``,','',$camp)."`)";
	$word=preg_split("/[\s,]*(['\"\'\\\"]+[^'\"\'\\\"]*['\"\'\\\"]+)[\s,]*|[\s,]+/", $valor, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	foreach($word as $i=>$v){
		$v=strtolower($v);
		$v=str_replace(array('a','e','i','o','u','n'),array('(a|á|ä|à|A|Á|Ä|À)','(e|é|ë|è|E|É|Ë|È)','(i|í|ï|ì|I|Í|Ï|Ì)','(o|ó|ö|ò|O|Ó|Ö|Ò)','(u|ú|ü|ù|U|Ú|Ü|Ù)','(n|ñ|N|Ñ)'),$v);
		if(!in_array(preg_replace('/["\']/i','',$v),$wordsRep1)){
			$wordsRep1[]='(\s*'.preg_replace('/["\']/i','',$v)."\s*)";
		}
		$v=preg_replace(array('/^["\']/','/["\']$/'),array('',''),$v);
		$where.=$camp.' regexp \''.$v.(count($word)==$i+1?'\')':'\' AND ');
	}
	array_walk($wordsRep1, function(&$value, $index){
		$value = "/".$value."/i";
	});
		//								print_pre($where);
	$order='id DESC';
	$recView=10; //estos valores los recibo por GET
	$titTxt = "Libros encontrados.";
	$nodata="<p class='comentario'>Por favor verifique que las palabras que busca estén bién escritas, aunque es posible que no tengamos el libro.</p>
	<p class='comentario' style='background-color:#FFF;color:#F00;'>SI DESEA QUE NUESTRO PERSONAL HAGA UNA BUSQUEDA EN LA EDITORIAL QUE PUBLICO EL LIBRO O EN LAS LIBRERIAS DEL PAIS DE PUBLICACION, POR FAVOR CONTACTESE CON NUESTROS ASESORES.</p>";
	include "present.php";
}else{
	echo "<header class='s-head'>No se han escrito palabras.</header>
	<div>
	<p class='comentario'>Por favor, escriba una cadena en el campo de busqueda. tambien puede usar la búsqueda avanzada para acceder a mas opciones</p>
	</div>
	<footer class='s-foot'></footer>";
}
?>
