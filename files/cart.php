<div class="asTitle" id="titleCart">
<?PHP
if(!isset($_SESSION['la']['usuarios']['usuarios_nivel'])){
	echo "Compras-Pedidos";
}else{
	if($_SESSION['la']['usuarios']['usuarios_nivel']<5){
		echo "Compras-Pedidos";
	}else{
		echo "Pedidos x Cliente";
	}
}

//echo (isset($_SESSION['la']['usuarios']['usuarios_nivel'])&&$_SESSION['la']['usuarios']['usuarios_nivel']<7)?"Compras-Pedidos":"Catalogos de Oferta";?>
</div>
<div class="asContent">
	<div id="carro">
		<?PHP include "cart_p.php";?>
	</div>
</div>
