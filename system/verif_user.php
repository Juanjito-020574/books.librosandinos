<?PHP if(!isset($_SESSION))session_start();
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
include($ruta.'system/database.php');$box='';
if(!isset($_SESSION['la']['usuarios'])&&$nivMin!=0){
	$box="<header class='s-head' style='color:#ff0000;'>!!!ERROR DE REGISTRO¡¡¡</header><p class='comentario'>Usted debe ser usuario registrado y tener permiso para acceder a sección.</p><p class='comentario' >Si dispone de un Nombre de Usuario y Contraseña acceda a su cuenta en la parte superior derecha de la ventana.</p><p class='comentario' >Si desea puede registrarse y solicitar a nuestros administradores los permisos para acceder a esta seccion.</p><p class='comentario' style='text-align: center;'><img src='images/logo2.png' style='height:55px;' /></p><footer class='s-foot'><div class='contacto'>Si necesita más información contáctese con nuestros asesores a los siguientes mails: <div class='contacto-mail'><a href='mailto:maryaran@hotmail.com'>maryaran@hotmail.com</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href='mailto:marcovar88@yahoo.com'>marcovar88@yahoo.com</a></div></div></footer>";
	echo "<div id='detectParent'><script>detectParent('detectParent',\"$box\")</script></div>";
	exit;
}
if(isset($_SESSION['la']['usuarios']['usuarios_nivel'])&&$_SESSION['la']['usuarios']['usuarios_nivel']<$nivMin){
	$box="<header class='s-head' style='color:#ff0000;'>!!!ALERTA DE REGISTRO¡¡¡</header><p class='comentario'>Lo sentimos mucho. pero usted no cuenta con los permisos necesarios para acceder a esta sección.</p><p class='comentario' >Usted puede pedir a nuestros Administradores que le otorgue los permisos nesesarios para acceder a esta sección.</p><p class='comentario' style='text-align: center;'><img src='images/logo2.png' style='height:55px;' /></p><footer class='s-foot'><div class='contacto'>Si necesita más información contáctese con nuestros asesores a los siguientes mails: <div class='contacto-mail'><a href='mailto:maryaran@hotmail.com'>maryaran@hotmail.com</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href='mailto:marcovar88@yahoo.com'>marcovar88@yahoo.com</a></div></div></footer>";
	echo "<div id='detectParent'><script>detectParent('detectParent',\"$box\")</script></div>";
	exit;
}
if(isset($_SESSION['la']['usuarios'])){extract($_SESSION['la']['usuarios'],EXTR_PREFIX_ALL,'sUs');}
?>
