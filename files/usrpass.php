<?PHP
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
include($ruta.'system/functions.php');$nivMin=1;$msgPass='';
include($ruta.'system/verif_user.php');
if(!isset($_SESSION))session_start();
?>
<div id="workdata">
<?PHP
extract($_REQUEST);
$cPass = new DataBase();
if(isset($passMail)){
	$pass=$cPass->_encript($antPass);
if(!$antPass|| !$newPass || !$newPass2 ){
	$msgPass="Todos los campos deben ser llenados!!!";
//	$_SESSION['la']['usuarios']['usuarios_pass']=$cPass->_encript('juanjito2');
//	$_SESSION['la']['usuarios']['usuarios_pRec']='juanjito2';
}else if($newPass!=$newPass2){
	$msgPass="Los PASOS 2 y 3 deben ser identicos!!!";
}else if($pass!=$_SESSION['la']['usuarios']['usuarios_pass']){
	$msgPass="Su Password no es correcto!!!";
//	echo $_SESSION['la']['usuarios']['usuarios_pass'].'-'.$_SESSION['la']['usuarios']['usuarios_pRec'];
}
if(!$msgPass){
	$pass=$cPass->_encript($newPass);
	$cPass->query = "UPDATE user_data SET usuarios_pass='".$cPass->_mysqli_real_escape_string($pass)."',
		usuarios_pRec='".$cPass->_mysqli_real_escape_string($newPass)."' WHERE usuarios_id='$id'";
	$cPass->_query('UPDATE');

	if($cPass->q_aff_rows==1){
		$datas=$_SESSION['la']['usuarios'];
		$texto="Distinguido $datas[usuarios_nombres] $datas[usuarios_apellidos].\n
		Usted a cambiado la contraseña para acceder a nuestro sitio. Sus datos ahora son:<br/><br/>\n
		Nombre de usuario: $datas[usuarios_nick].<br/>\n
		Contraseña: $newPass.<br/><br/>\n
		Ahora usted puede ingresar a nuestro sitio y recibir las ventajas de estar registrado. Si requiere mas información relacionada con nuestros servicio pongase en contacto con nuestros operadores.<br/><br/>\n
		En su menu de usuarios encontrará las opciones habilitadas para su cuenta, recuerde que puede cambiar su contraseña de acceso a nuestro sistema en cualquier momento y le llegará una notificación de cambio de contraseña a su correo.<br/><br/>\n
		Guarde este mail con sus datos en un lugar seguro.<br/><br/>\n
		Atentamente la Administración de Libros Andinos.";
		if(pass_mail($datas,'Cambio de Contraseña Libros Andinos',$texto)){
			$_SESSION['la']['usuarios']['usuarios_pass']=$cPass->_encript($newPass);
			$_SESSION['la']['usuarios']['usuarios_pRec']= $newPass;
			$msgPass = "Le enviamos un correo electrónico con su nueva contraseña!!!";
		}else{
			$cPass->query = "UPDATE user_data SET usuarios_pass='".$_SESSION['la']['usuarios']['usuarios_pass']."',
				usuarios_pRec='".$_SESSION['la']['usuarios']['usuarios_pRec']."' WHERE usuarios_id='$id'";
			$cPass->_query('UPDATE');
		}
	}else{
		$msgPass="Lo sentimos, pero no se pudo cambiar su password, intentelo de nuevo";
	}
	echo "
	<script type='text/javascript'>
		$('#login').load('files/login.php',{msgUsr:'$msgPass'});
	//	$('#workarea').html(carga)
		$('#gost').detach();
	</script>";
}
}
?>
<div style='text-align:center;color:#ff0000'><b><?PHP echo $msgPass;?></b></div>
<div class="titulo">Llene los Campos</div>
<form id="newpass_<?PHP echo $id;?>" method="post" action="javascript:void(0)" style="width:80%;margin:0 auto;">
<div class="label0"><label for="antPass">PASO 1: Escriba su contraseña actual</label></div><div class="text1"><input value="" type="password" id="antPass" name="antPass" required="" /></div>
<div class="label0"><label for="newPass">PASO 2: Escriba su contraseña Nueva</label></div><div class="text1"><input value="" type="password" id="newPass" name="newPass" required="" /></div>
<div class="label0"><label for="newPass2">PASO 3: Repita su contraseña Nueva</label></div><div class="text1"><input value="" type="password" id="newPass2" name="newPass2" required="" /></div>
</form>
</div>
<div id="workdata_search">
<header class="s-head">
	Cambiar contraseña de <?PHP echo strtoupper($_SESSION['la']['usuarios']['usuarios_nick']);?><br />
	<input style="display: inline-block;" form="newpass_<?PHP echo $id;?>" class='aLog' id="passMail" type='submit' value='Cambiar' onclick='editPass("<?PHP echo $id?>")'/>
	<input style="display: inline-block;" class="aLog" type="button" value="Cancelar" onclick="closeDw()" />
</header>
</div>
