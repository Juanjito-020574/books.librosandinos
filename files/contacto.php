<?PHP
if(!isset($_SESSION)){session_start();}
extract($_REQUEST);
if($_SESSION['local']){
  $mailToEncargados = "juanjito@localhost";
} else {
	$mailToEncargados = "Info Libros Andinos<info@librosandinos.com>";
}
if($_SESSION['la']['usuarios']['usuarios_nick']){
	$username = $_SESSION['la']['usuarios']['usuarios_nick']." (".$_SESSION['la']['usuarios']['usuarios_nombres']." ".$_SESSION['la']['usuarios']['usuarios_apellidos'].")";
	$usermail = $_SESSION['la']['usuarios']['usuarios_mail'];

	}
//	$param='archivo:"file/m_contacto.php",mailEmpresa:$("#mailEmpresa").val(),nombreUsuario:$("#nombreUsuario").val(),mailUsuario:$("#mailUsuario").val(),mailAsunto:$("#mailAsunto").val(),mailTexto:$("#mailTexto").val(),mailTextoUser:$("#mailTextoUser").val()';
?>
<!-- Inicio Block Contactos -->
<header class="s-head">
	Libros Andinos y Latinoamericanos.<br />South American Books.
		<p style="font-size: 0.8em;">
		Recolecion y distribucion de material bibliografico de la zona andina<br />
		Contactos
<!--		Phone: (591) 4-44-90930. Fax: (591) 4-44-82803 -->
		</p>
</header>
<form action="javascript:void(0)" method="post" id="contacto" style="margin:5px auto;">
<div style="">
	<input class='send' type="hidden" id="archivo" name="archivo" value="files/contacts.php" />
	<div><div class='label2' style="display: none;">
		<label for="mailEmpresa">Mail Libros Andinos:</label></div>
		<div class='text2' style="display: none;">
		<input class='send' type="text" id="mailEmpresa" name="mailEmpresa" value="<?PHP echo $mailToEncargados; ?>" readonly="yes" />
		</div></div>
	<div><div class='label2' style="width:15%;">
		<label for="nombreUsuario">Nombre:</label></div>
		<div class='text2' style="width:80%;">
		<input class='send' type="text" id="nombreUsuario" name="nombreUsuario" value="<?echo $username?>" />
	</div></div>
	<div><div class='label2' style="width:15%;">
		<label for="mailUsuario">Mail:</label></div>
		<div class='text2' style="width:80%;">
		<input class='send' type="text" id="mailUsuario" name="mailUsuario" value="<?echo $usermail?>" />
	</div></div>
	<div><div class='label2' style="width:15%;">
		<label for="mailAsunto">Asunto:</label></div>
		<div class='text2' style="width:80%;">
		<input class='send' type="text" id="mailAsunto" name="mailAsunto" value="" size="300" maxlength="300" />
	</div></div>
</div>
	<div class='text1' style="display:none;">
		<textarea class='send' id="mailTexto" name="mailTexto" style="width: 100%; height: 100px;"><?PHP echo $mailT;?></textarea>
	</div>
	<div class='label1'>
		<label for="mailTextoUser">Escriba su comentario</label>
	</div>
	<div class='text1'>
		<textarea class='send' id="mailTextoUser" style="max-width: 100%; height: 100px;" name="mailTextoUser" title="ingrese su comentario"></textarea>
	</div>
<input class="boton" onclick="sendMail('contacto')" type="submit" value="Enviar..." name="enviar_mail" id="enviar_mail" />
</form>
<footer class="s-foot"></footer>
<script type="text/javascript">
var WL="'"+window.location+"'",WL2=WL.replace('/files','/#files');
if(WL!=WL2){
	var head=document.getElementsByTagName('header')[0];
	head.parentNode.remove(head);
	window.location.replace(WL2.replace(/\'/ig,''));
}
title_('<?echo"$name $pagAct";?>');
</script>

