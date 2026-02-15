<?PHP
error_reporting(0);
if(!isset($_SESSION)){session_start();}
extract($_REQUEST);
if(isset($_SERVER['HTTP_HOST'])&&$_SERVER['HTTP_HOST']=='localhost'){
	$mailToEncargados = "juanjito@localhost";
} else {
	$mailToEncargados = "Info Libros Andinos<info@librosandinos.com>";
}
if(isset($_SESSION['la']['usuarios'])){
	$username=$_SESSION['la']['usuarios']['usuarios_nick']." (".$_SESSION['la']['usuarios']['usuarios_nombres']." ".$_SESSION['la']['usuarios']['usuarios_apellidos'].")";
	$usermail=$_SESSION['la']['usuarios']['usuarios_mail'];
}else{
	$username='';
	$usermail='';
}
//	$param='archivo:"file/m_contacto.php",mailEmpresa:$("#mailEmpresa").val(),nombreUsuario:$("#nombreUsuario").val(),mailUsuario:$("#mailUsuario").val(),mailAsunto:$("#mailAsunto").val(),mailTexto:$("#mailTexto").val(),mailTextoUser:$("#mailTextoUser").val()';
?>
<!-- Inicio Block Contactos -->
<header class="s-head">
	Libros Andinos y Latinoamericanos.<br />South American Books.
		<p style="font-size: 0.8em;">
		Recolecion y distribucion de material bibliografico de la zona andina<br />
		Contactos
		</p>
</header>
<form action="javascript:void(0)" method="post" id="contacto" style="margin:5px auto;">
<div>
	<input class='send' type="hidden" id="archivo" name="archivo" value="files/contacts.php" />
	<div><div class='label2' style="display: none;">
		<label for="mailEmpresa">Mail Libros Andinos:</label></div>
		<div class='text2' style="display: none;">
		<input class='send' type="text" id="mailEmpresa" name="mailEmpresa" value="<?PHP echo $mailToEncargados; ?>" readonly="yes" />
		</div></div>
	<div><div class='label2' style="width:15%;">
		<label for="nombreUsuario">Nombre:</label></div>
		<div class='text2' style="width:80%;">
		<input class='send' type="text" id="nombreUsuario" name="nombreUsuario" required="" value="<?PHP echo $username?>"/>
	</div></div>
	<div><div class='label2' style="width:15%;">
		<label for="mailUsuario">Mail:</label></div>
		<div class='text2' style="width:80%;">
		<input class='send' type="mail" id="mailUsuario" name="mailUsuario" required="" value="<?PHP echo $usermail?>" />
	</div></div>
	<div><div class='label2' style="width:15%;">
		<label for="mailAsunto">Asunto:</label></div>
		<div class='text2' style="width:80%;">
		<input class='send' type="text" id="mailAsunto" name="mailAsunto" required="" value="" size="300" maxlength="300" />
	</div></div>
</div>
<?PHP if(isset($mailT)){?>	<div class='text1' style="display:none;">
		<textarea class='send' id="mailTexto" name="mailTexto" style="width: 100%; height: 100px;"><?PHP echo $mailT;?></textarea>
	</div><?PHP }?>
	<div class='label1'>
		<label for="mailTextoUser">Escriba su comentario</label>
	</div>
	<div class='text1'>
		<textarea class='send' id="mailTextoUser" style="max-width: 100%; height: 100px;" name="mailTextoUser" placeholder="Ingrese sus comentarios"></textarea>
	</div>
<input class="boton" onclick="sendMail('contacto')" type="submit" value="Enviar..." name="enviar_mail" id="enviar_mail" />
</form>
<footer class="s-foot"></footer>

