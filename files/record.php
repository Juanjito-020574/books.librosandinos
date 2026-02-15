<?PHP
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
include($ruta.'system/database.php');
if(!isset($_SESSION)){session_start();}
?>
<div id="workdata">
<?PHP
$num=1;
extract($_REQUEST);
$name='ficha';
$view=(isset($_SESSION['la']['usuarios']['usuarios_nivel'])&&$_SESSION['la']['usuarios']['usuarios_nivel']<3?'ms':'all');
$$name = new DataBase;
$$name->tabla="cepal$view";
$$name->where="id='$num'";
$$name->_query('SELECT');
$row=$$name->q_fetch_assoc;
if($$name->q_num_rows==1){
	$compra='	<span class="boton" style="vertical-align:middle;"><a style="display:inline-block;padding:4px 10px;" onclick="addCart('.$row['id'].')">Comprar | <img src="images/addkart.png" style="margin-right:-8px;height:15px;"/></a></span>';
	//echo "Consulta '".$ficha->q_query."'";
	$field=array('autor','titulo','autor_i','coleccion','no_vol','tot_vols','isbn','vol_serie','no_serie','issn','fecha_pub','paginas','editorial','ciudad','pais','edicion','info_desc','impresion','idioma','notas','resumen','tabla_cont','descriptores','materia','formato','medidas','p_venta','codweb','id','imagen');
	$ft='';
	foreach($field as $v){
		if($row[$v]&&$v!='imagen' && $v!='id' && $v!='codweb'){
			if($v=='resumen'||$v=='tabla_cont'){$row[$v]=str_replace("\r\n","<br />",$row[$v]);}
			$ft.="<tr valign='top'><td valign='top' width='20%' style='text-align:right;font-weight:bold;text-transform:uppercase;text-shadow:1px 1px 0px;'>$v:</td><td width='78%' style='text-align:justify'><h3>$row[$v]</h3></td></tr>";
		}elseif($v=='imagen'){
			if(file_exists("../$row[$v]")){
				$imgSrc="<img src='./$row[$v]' title='$row[titulo]' alt='Book $row[titulo]' width='80%'/>";
			}else{
				$imgSrc="<img src='./images/books/product.png' title='$row[titulo]' alt='Book $row[titulo]' height='120px'/>";
			}
		}
	}
}else{
	$imgSrc="<img src='./images/books/product.png' title='El libro no existe' alt='El libro no existe' width='80%'/>";
	$ft="<p class='comentario'>Lo sentimos mucho.</p><p class='comentario'>El libro que usted busca no se encuentra en nuestra base de datos.</p>
	<p class='comentario'>Si conoce el titulo y el autor, por favor haga una búsqueda en la seccion de busquedas.</p>
	<p class='comentario'>Contactese con nuestros asesores para mas detalles.</p>";
}
?>
<article>
	<div>
	<table style="width: 95%;">
		<?PHP echo "$ft";?>
	</table>
	</div>
</article>
</div>
<div id="workdata_search" class="prnhide">
<header class="s-head">
		Ficha Bibliográfica
</header>
		<?PHP echo $imgSrc?>
	<div>
		<?PHP echo "$compra";?>
	<span class="boton" style="vertical-align:middle;"><a style="display:inline-block;padding:4px 10px;" onclick="closeDw()">Salir | <img src="images/bt_out.png" style="margin-right:-8px;height:15px;"/></a></span>
	</div>

<footer class="s-foot" style="position:inherit;bottom:0px;margin-bottom:0px;"><?PHP include('contact.php');?></footer>
</div>
<script type="text/javascript">
//document.onkeyup=escape;
</script>
