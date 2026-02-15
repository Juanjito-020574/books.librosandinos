<?PHP
if(!function_exists('include_if_exists')){include('../system/functions.php');};$nivMin = 3;
include('../system/verif_user.php');
if(!isset($_SESSION))session_start();
extract($_REQUEST);
		//											print_pre($_REQUEST);
if($fnc=='guardar_ventas'){
	$venun=$_SERVER['REMOTE_ADDR'].'-'.microtime().'-'.rand(1,100000);
	if($ventas_fecha&&$ventas_cliente){
		$$fnc=new DataBase();
		$$fnc->query="INSERT INTO ventas (ventas_fecha,ventas_cliente,ventas_usuario,ventas_unico)values('$ventas_fecha','$ventas_cliente','".$_SESSION['la']['usuarios']['usuarios_nick']."','$venun')";
		$$fnc->_query('INSERT');
		$aa1="$('$div').html(carga1.replace('cargando...','actualizando...'));
notice('".($$fnc->q_aff_rows==1?$$fnc->q_message:$$fnc->q_err)."');";
	}
	$selVe=new DataBase();
	$selVe->query="SELECT ventas_id FROM ventas WHERE ventas_unico='$venun' AND ventas_cliente='$ventas_cliente'";
	$selVe->_query('SELECT');
	$rowvenun=$selVe->q_fetch_assoc;
	$id=$rowvenun['ventas_id'];
	$aa2="$('#workarea').load('files/list_ventas.php',{id:'$id'});
$('#wd').load('files/ventas_edit.php',{tipo:'edit',name:'ventas',id:'$id'/*,mC:$mC*/});";
	echo "<script type='text/javascript'>
$aa1$aa2
</script>";
}
if($fnc=='guardar_registro'){
	$$fnc=new DataBase();
	$$fnc->query="INSERT INTO ventas_detalle (ventas_id,cepal_id)values($ventas_id,$cepal_id)";
	$$fnc->_query('INSERT');
	echo $$fnc->q_query;
	$detCampo=detalle_venta_tabla($ventas_id);
	echo '<script type="text/javascript">
var tr2,tv2;
var href=chainState(window.location.href);
var url=href.url+".php"+(href.prm?"?"+href.prm:"");
$("#workarea").load("files/"+url,{id:"'.$ventas_id.'"});
$("#ventas_detalle").load("files/partial/ventas_detalle.php",{id:'.$ventas_id.',name:"ventas",cepal_id:'.$cepal_id.'});
tr2=parseFloat('.$detCampo['total'].');
$("#ventas_tbook").val(tr2.toFixed(2));
Totalizar();
</script>';
}
if($fnc=='guardar_registro_all'){
			//									print_pre($_REQUEST);
$cmpAdic='';$cmpAdicVal="";
	switch ($tabla){
		case 'catalogooferta_cepal':
			$table='catalogooferta';$view='_cepal';
		break;
		case 'pedidos_usuario':
		$view='_usuario';$table='pedidos';$cmpAdic=',pedidos_fecha';$cmpAdicVal=",'".date('Y-m-d')."'";
		break;
		case 'listas':
		$view='_all';$table='listas_detalle';
		break;
		default:
		$table=$tabla;
		break;
	}
	$$fnc=new DataBase();
	$$fnc->query="INSERT INTO $table ($campo_id,cepal_id$cmpAdic)values('$id_val','$cepal_id'$cmpAdicVal)";
	$$fnc->_query('INSERT');
	echo $$fnc->q_query;
//	$detCampo=detalle_list_tabla($id,$tabla,$cmpID,$data);
	echo '<script type="text/javascript">
var href=chainState(window.location.href);
var url=href.url+".php"+(href.prm?"?"+href.prm:"");
$("#workarea").load("files/"+url,{id:"'.$id_val.'"});
$("#list_detalle").load("files/partial/list_detalle.php",{id:"'.$id_val.'",name:"'.$table.$view.'",cmpID:"'.$campo_id.'"});
</script>';
}
if($fnc=='update_campo'){
				//						print_pre($_REQUEST);
	switch($name){
		case 'ventas_detalle':$list='ventas';$dts="{id:$regVal}";break;
		case 'catalogooferta_cepal':$list='edit';$view='_cepal';$name='catalogooferta';$dts="{id:\"$regVal\",name:\"$name$view\"}";break;
		default:$list='edit';$id=$dts="";break;
	}
	if($campoName=='ventas_glosa'||$campoName=='ventas_head'){
		$campoVal=preg_replace(array('/<\/div>/','/<div>|<br>|&lt;br&gt;/','/<.*>/',"/&nbsp;|\s+$/"),array('','\\n','',''),$campoVal);
	}
	$$fnc=new DataBase();
	$$fnc->query="UPDATE $name SET $campoName=".($campoVal?"'$campoVal'":"''")." WHERE $regId='$regVal'";
	$$fnc->_query('UPDATE');
										echo $$fnc->q_query;
	if(!isset($noscript)){ //para los campos del que no quiero que refresquen la lista de ventas
		echo '<script type="text/javascript">
var href=chainState(window.location.href);
var url=href.url+".php"+(href.prm?"?"+href.prm:"");
$("#workarea").load("files/"+url,{id:"'.$regVal.'"});
</script>';
	}
}
if($fnc=='borrar_venta'){
				//								print_pre($_REQUEST);
	$$fnc=new DataBase();
	$$fnc->query="DELETE FROM $name WHERE detalle_id='$regId'";
	$$fnc->_query('DELETE');
	$detCampo=detalle_venta_tabla($ventas_id);
	echo '<script type="text/javascript">
var tr2,tv2;
var href=chainState(window.location.href);
var url=href.url+".php"+(href.prm?"?"+href.prm:"");
$("#workarea").load("files/"+url,{id:"'.$ventas_id.'"});
$("#ventas_detalle").load("files/partial/ventas_detalle.php",{id:'.$ventas_id.',name:"ventas"});
tr2=parseFloat('.$detCampo['total'].')||0;
$("#ventas_tbook").val(tr2.toFixed(2));
Totalizar();
</script>';
//break;
}
if($fnc=='borrar_lista'){
	$$fnc=new DataBase();
	$$fnc->query="DELETE FROM $tablaMadre WHERE $campoId='$regId'";
	$$fnc->_query('DELETE');
			//								echo $$fnc->q_query;
//	$detCampo=detalle_list_tabla($id,$tablaMadre,$campoId);
	echo '<script type="text/javascript">
var href=chainState(window.location.href);
var url=href.url+".php"+(href.prm?"?"+href.prm:"");
$("#workarea").load("files/"+url,{id:"'.$id.'"});
$("#list_detalle").load("files/partial/list_detalle.php",{id:"'.$id.'",name:"'.$name.'"});
</script>';
//break;
}
if($fnc=='cerrar_catalogo'){
	$$fnc=new DataBase();
	$$fnc->query="UPDATE catalogo SET estado='cerrado' WHERE cat='$id'";
	$$fnc->_query('UPDATE');
	if(!$noscript){ //para los campos del que no quiero que refresquen la lista de ventas
echo "<script type='text/javascript'>
var tm = 5000;
$('#notice').html('').fadeOut(1000)
$('#notice').html('Se ha cerrado el catalogo \"$id\"...').show()
setTimeout(function(){
$('#notice').html('').show()
$('#notice').html('Se ha cerrado el catalogo \"$id\"...').fadeOut(1000).html('');
},tm)
</script>";
	}
}

?>
