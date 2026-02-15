<?PHP
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
include($ruta.'system/functions.php');$nivMin = 0;
include($ruta.'system/verif_user.php');
if(!isset($_SESSION))session_start();
extract($_REQUEST);
										print_pre($_REQUEST);
			//							print_pre($_SESSION['la']['compras']);
if(isset($datas)&&is_array($datas)&&isset($datas['sendmail'])){$sendmail=$datas['sendmail'];
unset($datas['sendmail']);}else{$sendmail='';}
$$tabla=new DataBase();$pq='';
if($tipo=='pedido'){
//	include('../system/database.php');
	$data=$_SESSION['la']['compras']['productos'];
	$pedido=new DataBase;
	$clname=preg_replace('/\:.*$/','',$clname);
	foreach($data as $i=>$v){
		$v['uniq_id']=$clname.'_'.$v['id'];
		$verifPed=new DataBase;
		$verifPed->query="SELECT * FROM pedidos WHERE pedidos_uniqid='$v[uniq_id]'";
		$verifPed->_query('SELECT');
					//						echo "<br><br>".$verifPed->q_query."<br><br>";
		$vpfa=$verifPed->q_fetch_assoc;
//		print_pre($vpfa);
		if($verifPed->q_num_rows>=1){
			if($vpfa['pedidos_reclamo']<5&&($vpfa['pedidos_estado']=='vigente'||$vpfa['pedidos_estado']=='en origen')){
			$claim=new DataBase;
			$claim->query="UPDATE pedidos SET pedidos_reclamo=(pedidos_reclamo+1) WHERE pedidos_uniqid='$v[uniq_id]'";
			$claim->_query('UPDATE');
			$err.="Registro Actualizado.<br>" ;
											echo "<br><br>".$claim->q_query."<br><br>";
			}else{
				$err.="Pedido enviado o Reclamo mayor a 5.<br>";
			}
			$pq.="";
		}else{
			$pq.="('".date('Ymd')."','$clid','$v[id]','$v[orden]','vigente','$v[cantidad]'), ";
			$err.="Pedido Guardado.<br>";
		}
	}
	if($pq!=''){
	$pquery='INSERT INTO pedidos (`pedidos_fecha`,`usuarios_id`,`cepal_id`,`pedidos_orden`,`pedidos_estado`,`pedidos_cantidad`) VALUES'.trim($pq,', ');
	$pedido->query=$pquery;
	$pedido->_query('INSERT');
			//								echo "<br><br>".$pedido->q_query."<br><br>";
	$err.="";
	}
	$msgQry=$err;
	unset($_SESSION['la']['compras']);
	echo "<script type='text/javascript'>$('#carro').load('files/cart_p.php');$('#login').load('files/login.php',{msgUsr:'$msgQry'})</script>";

}
if($tipo=='INSERT'){
	$cmp='';$vlr='';
	foreach($datas as $i=>$v){
		$cmp.="`$i`, ";
		$vlr.="'".$$tabla->_mysqli_real_escape_string($v)."', ";
		$querySlct[$i]=$v;
	}
	$$tabla->query="INSERT INTO $tabla (".trim($cmp,', ').") values (".trim($vlr,', ').")";
	$$tabla->_query($tipo);
//	echo $$tabla->q_query;
	switch($$tabla->q_aff_rows){
		case -1 :
		$msgQry = "Ha ocurrido un error al guardar los datos.";
		break;
		case 0 :
		$msgQry = "No se han modificado los datos.<br />No fue necesario guardar.";
		break;
		case 1 :
		$msgQry = "El Registro fue guardado satisfactoriamente.<br/>";
		break;
		case $rows['aff_rows']>1 :
		$msgQry = $$tabla->q_aff_rows." registros guardados satisfactoriamente.";
	}
	switch($tabla){
		case 'cepal':
			$cmpID='id';
		break;
		case 'user_data':
			$cmpID='usuarios_id';
		break;
		case 'usuarios_cli':
			$cmpID='usuarios_id';
		break;
		default:
			$cmpID=$tabla.'_id';
		break;
	}
	foreach($querySlct as $i=>$v){
		$where.=($v?"AND `$i`='$v' ":'');
	}
	$where="WHERE ".trim($where,'AND ');
//	echo $where;
	$$tabla->query="SELECT * FROM $tabla $where";
	$$tabla->_query('SELECT');
	$rw=$$tabla->q_fetch_assoc;
//	print_pre($rw);
	$id=$rw["$cmpID"];
}
if($tipo=='UPDATE'){
	switch($tabla){
		case 'cepal':
			$cmpID='id';
		break;
		case 'user_data':
			$cmpID='usuarios_id';
		break;
		case 'usuarios_cli':
			$cmpID='usuarios_id';
		break;
		case 'pedidos_detalle':
			$cmpID='pedidos_id';
		break;
		case 'catalogo':
			$cmpID='cat';
		break;
		default:
			$cmpID=$tabla.'_id';
		break;
	}
	$vlr='';
	foreach($datas as $i=>$v){
		if(!$vlr){
			$vlr.="`$i`='".$$tabla->_mysqli_real_escape_string(str_replace('\\','',$v))."'";
		}else{
			$vlr.=",`$i`='".$$tabla->_mysqli_real_escape_string(str_replace('\\','',$v))."'";
		}
	}
	$$tabla->query="UPDATE $tabla SET ".trim($vlr,', ')." WHERE $cmpID='$id'";
	$$tabla->_query($tipo);
		//								echo $$tabla->q_query;
	switch($$tabla->q_aff_rows){
		case -1 :
		$msgQry = "Ha ocurrido un error al guardar los datos.<br />".$$tabla->q_err;
		break;
		case 0 :
		$msgQry = "No se han modificado los datos.<br />No fue necesario guardar.";
		break;
		case 1 :
		$msgQry = "El Registro fue guardado satisfactoriamente.";
		if($tabla=='usuarios' && $id==$_SESSION['la']['usuarios']['usuarios_id']){
			foreach($datas as $i=>$v){
				$_SESSION['la']['usuarios']["$i"]=$v;
			}
		}
		break;
		case $$tabla->aff_rows>1 :
		$msgQry = $$tabla->q_aff_rows." registros guardados satisfactoriamente.";
	}
}
if($tipo =='DELETE'){
	$query=str_replace('\\\'','\'',$query);
	if($_SESSION['la']['usuarios']['usuarios_id'] == $id && $tabla=='usuarios'){
		$msgQry = "Usted no puede eliminar su propio registro.<br />Consulte con su Representante.";
	}else{
		$$tabla->query=$query;
		$$tabla->_query($tipo);
		switch($$tabla->q_aff_rows){
			case -1 :
			$msgQry = "Ha ocurrido un error al eliminar el registro.";
			break;
			case 0 :
			$msgQry = "No se ha eliminado el Registro.";
			break;
			case 1 :
			$msgQry = "Registro eliminado satisfactoriamente.";
			break;
			case $$tabla->q_aff_rows>1 :
			$msgQry = $$tabla->q_aff_rows." registros eliminado satisfactoriamente.";
		}
	}
}
if($tipo=='QUERY'){
					//												print_pre($_REQUEST);
	$querys=preg_split('/;/',str_replace("\\","",$datas['querys']),0,PREG_SPLIT_NO_EMPTY);
	$cont_=0;$err_=0;
	foreach($querys as $v){
		$$tabla->query=$v;
		$$tabla->_query(strtoupper(substr($v,0,6)));
	//	echo $$tabla->q_query;
		switch($$tabla->q_aff_rows){
			case -1 :
			$err_++;
			break;
			case 0 :
			break;
			case 1 :
			$cont_++;
			break;
		}
	}
	$msgQry = $cont_." consultas exitosas<br>".$err_." consultas fallidas<br>".$cont_+$err_." consultas en total.";
	echo $msgQry;
//	if(!$id){$id='1';}
}
if(($sendmail=='yes'||!$_SESSION['la']['usuarios']['usuarios_nick'])&&$$tabla->q_aff_rows>=1&&($tabla=='usuarios'||$tabla=='usuarios_cli')&&($tipo=='INSERT'||$tipo=='UPDATE')){
	$texto="Distinguido $datas[usuarios_nombres] $datas[usuarios_apellidos].\n
	Los datos para acceder a nuestro sitio son:<br/><br/>\n
	Nombre de usuario: $datas[usuarios_nick]<br/>\n
	Contraseña: $datas[usuarios_pRec]<br/><br/>\n
	Ahora usted puede ingresar a nuestro sitio y recibir las ventajas de estar registrado. Si requiere mas información relacionada con nuestros servicio pongase en contacto con nuestros operadores.<br/><br/>\n
	En su menu de usuarios encontrará las opciones habilitadas para su cuenta, recuerde que puede cambiar su contraseña de acceso a nuestro sistema en cualquier momento y le llegará una notificación de cambio de contraseña a su correo.<br/><br/>\n
	Guarde este mail con sus datos en un lugar seguro.<br/><br/>\n
	Atentamente la Administración de Libros Andinos.";
	$msgQry.="<br/>".pass_mail($datas,'Datos de Acceso Libros Andinos',$texto);
}
?>
<input id="salir_wd" type="button" class="boton" style="margin-bottom:10px;" onclick="closeDw()" value="Salir" />
<script type='text/javascript'>
if($('#gost2').css('z-index')<$('#wd').css('z-index')||$('#salir_wd').parent().attr('id')=='notice'){
	var url=decodeURIComponent(window.location.href.replace(/([\w\W]*\/)(\w*)(\.?\w*)(\??)(.*)/ig,'$2'));
	var qryStr=decodeURIComponent(window.location.href.replace(/([\w\W]*\/)(\w*)(\.?\w*)(\??)(.*)/ig,'$5'));
			//						console.log(url+qryStr);
	if(!url){$('#workarea').load('files/novelties.php')}else{$('#workarea').load('files/'+url+'.php'+(qryStr?'?'+qryStr:''),{id:'<?PHP echo($id);?>'});}
	$('#login').load('files/login.php',{msgUsr:"<?PHP echo $msgQry;?>"});
	$('#workarea').html(carga);
	$('#gost').detach();
}else{
	$('#gost #gost2').removeAttr('style');
	$('#gost #workdata_aux').detach();
	if($('#ventas_id')){
		$('#ventas_detalle').html(carga).load('files/partial/ventas_detalle.php',{id:$('#ventas_id').val(),name:'ventas'});
	}
}
</script>

