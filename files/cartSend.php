<?PHP
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
include($ruta.'system/functions.php');
if(!isset($_SESSION))session_start();
extract($_REQUEST);
if(isset($_SERVER['HTTP_HOST'])&&$_SERVER['HTTP_HOST']=='localhost'){
	$mailToEncargados = "juanjito@localhost";
} else {
	$mailToEncargados = "Ventas Libros Andinos &lt;ventas@librosandinos.com&gt;";
}
if(isset($_SESSION['la']['usuarios'])){
	$username=$_SESSION['la']['usuarios']['usuarios_nick']." (".$_SESSION['la']['usuarios']['usuarios_nombres']." ".$_SESSION['la']['usuarios']['usuarios_apellidos'].")";
	$usermail=$_SESSION['la']['usuarios']['usuarios_mail'];
}else{
	$username='';
	$usermail='';
}
?>
<div id="workdata_search">
	<header class="s-head">
		Bandeja de salida: <?PHP echo $mailToEncargados;?>
	</header>
	<div class="form-botones">
		<input class="boton" form="sendRequest" onclick="sendMail('sendRequest')" type="submit" value="Enviar..." name="enviar_mail" id="enviar_mail" style="margin-bottom:10px;"/>
		<input type="button" class="boton" style="margin-bottom:10px;" onclick="closeDw()" value="Salir" />
	</div>
	<div id="form-descripciones" class="s-foot"><?PHP //include('contact.php');?></div>
</div>
<?PHP
$anadir="<p class='notice'>La cesta de compras esta vacía, agregue productos y vuelva a intentarlo</p>
<p class='notice'>Volver en <span id='contador'></span> segundos</p>";
if(!isset($_SESSION['la']['compras'])) {
	$compras=$_SESSION['la']['compras'];
	echo($anadir);
}else{
	$compras=$_SESSION['la']['compras'];
	if((count($compras))<1){
		echo($anadir);
	}else{
		$compras=$_SESSION['la']['compras'];
$mailT='';
?>
<div id="workdata">
<form action="javascript:void(0)" method="post" id="sendRequest" name="sendRequest" style="margin:5px auto;">
<div style="">
	<input class='send' type="hidden" id="archivo" name="archivo" value="files/cartSend.php" />
	<div><div class='label2' style="display:none;">
		<label for="mailEmpresa">Mail Libros Andinos:</label></div>
		<div class='text2' style="display:none;">
		<input class='send' type="text" id="mailEmpresa" name="mailEmpresa" value="<?PHP echo $mailToEncargados; ?>" readonly="yes" />
		</div></div>
	<div><div class='label2' style="width:15%;">
		<label for="nombreUsuario">Usuario:</label></div>
		<div class='text2' style="width:80%;">
		<input class='send' type="text" id="nombreUsuario" name="nombreUsuario" value="<?PHP echo $username?>" />
	</div></div>
	<div><div class='label2' style="width:15%;">
		<label for="mailUsuario">Mail:</label></div>
		<div class='text2' style="width:80%;">
		<input class='send' type="text" id="mailUsuario" name="mailUsuario" value="<?PHP echo $usermail?>" />
	</div></div>
	<div style="display:none;"><div class='label2' style="width:15%;">
		<label for="mailUsuarioCc">Mail Copy:</label></div>
		<div class='text2' style="width:80%;">
		<input class='send' type="text" id="mailUsuarioCc" name="mailUsuarioCc" value="<?PHP echo $usermailCc?>" />
	</div></div>
	<div><div class='label2' style="width:15%;">
		<label for="mailAsunto">Asunto:</label></div>
		<div class='text2' style="width:80%;">
		<input class='send' type="text" id="mailAsunto" name="mailAsunto" value="Pedido de Libros" size="300" maxlength="300" />
	</div></div>
</div>
	<div class='label1'>
		<label for="mailTextoUser">Escriba su comentario</label>
	</div>
	<div class='text1'>
		<textarea class='send' id="mailTextoUser" style="max-width: 100%; height: 100px;" name="mailTextoUser" title="ingrese su comentario"></textarea>
	</div>
	<div class='label1'>
		<label for="mailPedido">Lista de pedido:</label>
	</div>
	<div class="mailPedido" style="margin: 0px 0px 5px 0px;">
	<?PHP
	$mailT.="<table style='font-size:0.9em;' border=1><thead style='font-size:0.7em;text-align:center;'><tr>
	<th width='15%' >Cod.</td>
	<th width='55%'>Titulo</td>
	<th width='5%'>Cant.</td>
	<th width='10%'>\$us.</td>
	<th width='10%'>Total</td></tr></thead><tbody>";
$suma=$sumaVol=$contador=0;
	foreach($compras as $k => $v){
echo "<input type='hidden' class='sql send' id='id' name='id[$v[id]]' value='".date('Ymd').",&$v[usuarios_id],&".$_SESSION['la']['usuarios']['usuarios_nick'].",&$v[id],&".$v['titulo'].",&$v[orden],&$v[estado],&$v[cantidad],&$v[uniq_id]' />";
		$Volum=$v['cantidad'];
		$sumaVol=$sumaVol+$Volum;
		$subto=$v['cantidad']*$v['precio'];
		$suma=$suma+$subto;
		$contador++;
		$codW= '<div style="font-size:0.7em;">('.$v['codweb'].')</div>';
		$cod = $v['codinca']."<br />".$codW;
		if ($v['autor']==""){
			$titulos = $v['titulo'];
		}else $titulos = "<i>$v[autor]</i>. $v[titulo]";
	$mailT.="<tr>
			<td align='center'>$cod</td>
			<td>$titulos</td>
			<td align='center'>$v[cantidad]</td>
			<td align='right'>$v[precio]</td>
			<td align='right'>".number_format($subto,2)."</td>
			</tr>";
	}
	$mailT.="</tbody><tfoot><tr>
			<td align='right'></td>
			<td align='right'>TOTALES:&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td align='center'>".$sumaVol."</td>
			<td></td>
			<td align=right>".number_format($suma,2)."</td>
			</tr></tfoot>";
	$mailT.="</table>";
	echo($mailT);
	?>
	</div>
	<div class='label1' style="display:none;">
		<label for="mailTexto">Mail Texto</label>
	</div>
	<div class='text1' style="display:none;">
		<textarea class='send' id="mailTexto" name="mailTexto" style="width: 100%; height: 100px;"><?PHP echo $mailT;?></textarea>
	</div>
</form>
</div>
<?PHP
	}
}
?>
<!--</a> -->
<script type="text/javascript">
$('#contador').html('5');
var tempID;
tempID=setInterval(function(){
	var time=parseInt($('#contador').html());
	$('#contador').html(time-1);
	if(time==1){
		clearInterval(tempID);
		window.location.replace('#novelties.html')
	}
},1000)
//if(window.location.hash=='#cartSend.html'){$('.title').html('enviar mail-www.librosandinos.com');}
</script>
