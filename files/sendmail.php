<?PHP
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
if(!function_exists('include_if_exists')){include($ruta.'system/functions.php');}
if(!isset($_SESSION))session_start();
extract($_REQUEST);
						print_pre($_REQUEST);
?>
<?PHP
$src = 'data:image/png;base64,'.base64_encode_image('../images/logo2Small.png','png');
if(($mailUsuario!="") && ($nombreUsuario!="") ){
	$mailTexto=(isset($mailTexto)?str_replace('\\','',$mailTexto):'');

	$cabeceras1 = "MIME-Version: 1.0 \n";
	$cabeceras1.= "Content-type: text/html; charset=UTF-8 \n";
	$cabeceras1.= "To: " . $mailEmpresa."\n";
	$cabeceras1.= "From: " . $mailUsuario . " \n";
//	$cabeceras1.= "Cc: $mailUsuarioCc \n";
	$cabeceras1.= "Bcc: \n";

	$cabeceraTexto="<!DOCTYPE html><html lang='es'>\n<head>\n<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />\n";
	$cabeceraTexto.="<style type='text/css'>\n*{margin:5px auto;}\n.content{padding:10px;border:2px solid #000;width:90%;background-color:#FFE3BD;}\nh1{padding:5px;font-size:1.2em;clear:both;text-align:center;width:100%;}\nh2{margin:0px;padding:5px 30px;font-size:1em;clear:both;}\ntable{width:100%;margin:10px auto;border-collapse:collapse;}\ntable,td,th{border-color:#8C6531;}\n</style>\n</head>\n";
	$cabeceraTexto.="<body style='background-color:#FFA64A;color:#8C6531;'>\n<div class='content'>\n<img src='$src' height='60px' style='display:block;position:absolute;margin-top:-15px;margin-left:-16px;' />\n<h1>Mensaje</h1>\n<h2>Usuario: ".$nombreUsuario."(".$mailUsuario.")<br />Asunto: $mailAsunto\n</h2>\n";
	$cabeceraTexto.="<div style='width:90%;'>\n".$mailTexto."\n<p style='border:1px solid #8C6531;padding:8px;'>".preg_replace('/\n/','<br />',$mailTextoUser)."</p>\n</div>\n";
	$cabeceraTexto.="<div style='width:90%; text-align:center;color:#F00;'>\nSe debe dar respuesta urgente!!\n</div>\n</div>\n</body>\n</html>\n";
	if(mail($mailEmpresa,$mailAsunto,$cabeceraTexto,$cabeceras1)){
	/*echo("<table border='1px'><tr><td align=right style='vertical-align:top;'>De:</td><td>$nombreUsuario</td></tr><tr><td align=right style='vertical-align:top;'>Mail:</td><td>$mailUsuario</td></tr>");
	echo("<tr><td align=right style='vertical-align:top;'>Para:</td><td>$mailEmpresa</td></tr><tr><td align=right style='vertical-align:top;'>Comentario:</td><td>".preg_replace('/\n/','<br />',$mailTextoUser)."<br></td></tr></table><br />");
	if($archivo == "files/cart_send.php"){
	echo("Lista Libros: $mailTexto");
	}*/
		if($archivo=="files/cartSend.php"){
			include('../system/database.php');
				//							print_pre($id);
			$pedido=new DataBase;$pq='';
			foreach($id as $i=>$v){$a=explode(',&',$v);
				$pq.="('$a[0]','$a[1]','$a[2]','$a[3]','$a[4]','$a[5]','$a[6]','$a[7]','$a[8]'), ";
			}
			$pedido->query='INSERT INTO pedidos (`pedidos_fecha`,`usuarios_id`,`usuarios_nick`,`cepal_id`,`cepal_titulo`,`pedidos_orden`,`pedidos_estado`,`pedidos_cantidad`,`pedidos_uniqid`) VALUES '.trim($pq,', ').' ON DUPLICATE KEY UPDATE `pedidos_fecha`=values(`pedidos_fecha`), `pedidos_reclamo`=if(`pedidos_reclamo`<5,`pedidos_reclamo`+1,`pedidos_reclamo`)';
			$pedido->_query('INSERT');
			if($pedido->q_aff_rows>0){
				unset($_SESSION['la']['compras']);
				echo "<script type='text/javascript'>$('#carro').load('files/cart_p.php');volver('".$archivo."');</script>";
			}else{
				echo "<p class='notice'>No se pudo insertar. Error: $pedido->q_err</p>";
			}
		}
		echo"<p class='notice'>Su mensaje fue enviado correctamnte a nuestros operadores.</p><p class='notice'>Pronto tendrá una respuesta.</p>";
	}else{
		echo"<p class='notice'>Hubo un error al enviar su mensaje, por favor intentelo de nuevo.</p>";
	}
} else {
	echo "<p class='notice'>Debe llenar los campos Nombre de usuario y Mail Usuario</p>";
}
if($tabla=='contacto'){
	$archivo="files/contacts.php";
	echo "<div class='boton' style='margin:10px auto;'>
<a onclick=\"volver('$archivo')\" >Volver</a>
</div>";
}
?>
<script type="text/javascript">
function volver(url){
	if(url=='files/cartSend.php'){
		gostChau();
	}else{
		$('#workarea').html(carga);
		$('#workarea').load(url);
	}
	return false;
}
</script>