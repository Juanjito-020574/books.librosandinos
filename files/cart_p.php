<?PHP
if(!isset($_SESSION))session_start();
if(isset($_SESSION['la']['compras']['productos'])){$compras=$_SESSION['la']['compras']['productos'];}else{$compras='';}
$jsonCompras='';
//				print_r($compras);
//				echo "NIVEL:".$_SESSION['la']['usuarios']['usuarios_nivel']."<br>";
if(!isset($_SESSION['la']['usuarios']['usuarios_nivel'])&&is_array($compras)){
	echo "Para VALIDAR SU COMPRA, debe ser usuarios registrado.";
	$clase="style='background-color:rgba(157,30,47,.2);box-shadow:none;color:#555;' onclick='alerta()'";
	$val='Enviar';$title='Enviar solicitud';
	$tit_="Nro Orden:";
}elseif(isset($_SESSION['la']['usuarios']['usuarios_nivel'])&&$_SESSION['la']['usuarios']['usuarios_nivel']<3){
	$clase="onclick='cart_send()'";
	$val='Enviar';$title='Enviar solicitud';
	$tit_="Nro Orden:";
}else{
	if(!function_exists('selectClient')){
		if(is_dir('system'))$ruta='';else $ruta='../';
		include($ruta.'system/functions.php');
	}
	$cat_opt=selectClient('pedido');
	$clase="onclick='alert(\"Seleccione un cliente\")' id='savePedido'";
	$val='Guardar';$title='Guardar Pedido';
	$tit_="Orden:";
	if(isset($_SESSION['la']['compras']['productos'])){
		foreach($_SESSION['la']['compras']['productos'] as $i=>$v){
			$compra[$i]['id']=$v['id'];
			$compra[$i]['cantidad']=$v['cantidad'];
			$compra[$i]['orden']=isset($v['orden'])?$v['orden']:'';
		}
	$jsonCompras=json_encode($compra);
	}
//	echo $jsonCompras;
}
if($compras){
?>
<!-- Shopping cart It's important that the id of this div is 'shopping_cart' -->
<div id="cartFly" style="">
<div class="table_scroll" id='shopping_cart'>
<?PHP echo isset($cat_opt)?$cat_opt:'';?>
	<table id='shopping_cart_items'>
	<thead>
		<tr id="cart_shop" style="">
			<th style="font-size: 7pt;width:10%;">Cnt</th>
			<th style="font-size: 8pt;width:80%;">Titulo</th>
			<th style="font-size: 7pt;width:10%;">Rem</th>
		</tr>
	</thead>
	<tbody>
<?PHP
//$class=array("class='cart'","class='cart odd'");
//$contador=0;
$suma=$sumaVol=$contador=0;
$tnum=isset($v['tit_num'])?$v['tit_num']:'';
foreach($compras as $k => $v){
	$Volum=$v['cantidad'];
	$sumaVol=$sumaVol+$Volum;
	$subto=$v['cantidad']*$v['precio'];
	$suma=$suma+$subto;
	$contador++;
$titulo=(strlen($v["titulo"])<100?($v['titulo']." ".$tnum):(trim(substr($v["titulo"],0,99),'/[Ã\s]/')."... ".$tnum));


?>
	<tr>
	<td style="text-align:right;" ><?PHP echo $Volum?></td>
	<td><?PHP echo $titulo;?>
		<?PHP if(isset($_SESSION['la']['usuarios']['usuarios_nivel'])&&$_SESSION['la']['usuarios']['usuarios_nivel']<7){?>
		<div style="text-align:right;">
			<label style="width:38%;" for="<?PHP echo $k?>"><?PHP echo $tit_?></label>
			<span class="text0" style="width:60%;display:inline-block;" >
				<input type="text" class="pedidos_orden" id="<?PHP echo $k?>" value="<?PHP echo isset($v['orden'])?$v['orden']:'';?>" placeholder="Número de Orden"/>
			</span>
		</div>
		<?PHP }?>
	</td>
	<td style="text-align:center;"><a href="javascript:void(0)" onclick="remCart('<?PHP echo $v['id']?>')"><img src='images/remove.png' width="10px" /></a></td>
	</tr>
<?PHP }?>
	</tbody>
	<tfoot>
		<tr class="font" id='shopping_cart_totalprice'>
			<td style="text-align:right;"><div class="anim"><?PHP echo $sumaVol;?></div></td>
			<td style="text-align:left;width:80%;">Total Volumenes</td>
			<td>...</td>
		</tr>
	</tfoot>
</table>

</div>
</div>
<?PHP
?>
	<div class="boton">
		<?PHP echo "<a ".$clase." title='".$title."'>".$val."</a>"?>
	</div>
<?PHP
}else{echo("<div id='cart_shop' style='text-align:center;'><div class='anim'><p class='noticia'>No exisiten registros</p></div></div>");}
?>
<script type="text/javascript">
$('#shopping_cart select.usuarios_id').on('change',function(){
	if($('#savePedido').attr('onclick').toString().substr(0,5)=='alert'||$(this).val()){
		var compras='<?PHP echo $jsonCompras?>';
		compras=compras.toString().replace(/\"/ig,"'");
//		console.log(compras);
		$('#savePedido').attr('onclick','pedidosSave()');
	}else{
		$('#savePedido').attr('onclick','alert("seleccione un cliente")');
	}
})
var last_1=parseInt($('.table_scroll tbody tr:nth-last-child(1)').css('height'))||0;
var last_2=parseInt($('.table_scroll tbody tr:nth-last-child(2)').css('height'))||0;
var last_3=parseInt($('.table_scroll tbody tr:nth-last-child(3)').css('height'))||0;
var altIni=last_1+last_2+last_3;
var altFin=altIni;
var ancIni=parseInt($('.table_scroll tbody').css('width'));
var body_=document.querySelector('.table_scroll tbody')||0;
var bheight=body_.scrollHeight||0;
$('.table_scroll tbody').css({'max-height':altIni+'px'});
if(altIni<bheight){
	$('#carro').parent().parent().hover(function(){
		$('body').css('overflow-y','hidden');
		$('.table_scroll tbody').css({'overflow-y':'auto','max-height':(altFin)+'px'});
		if(altFin<bheight){
			$('.table_scroll tbody').css({'width':(ancIni+17)+'px'});
		}
		body_.scrollTop=bheight;
	},function(){
		$('body').removeAttr('style');
		$('.table_scroll tbody').removeAttr('style').css({'max-height':altIni+'px'});
		body_.scrollTop=bheight;
	});
}
$('.table_scroll tbody tr:last-child').find('input').focus();
function alerta(){
	alert('Por favor ingrese con su "NOMBRE DE USUARIO" y "CONTRASEÑA"\n\nSi aun no es usuario registrado, puede hacerlo de manera gratuita\ndesde el Botón "NUEVO" del "ACCESO DE USUARIOS" en la parte \nderecha de la pantalla')
}
</script>