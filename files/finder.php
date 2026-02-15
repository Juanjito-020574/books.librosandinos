<?PHP if(!isset($_SESSION))session_start();?>
<div class="asTitle" id="titleFinder">
	<div id="titleFast">Búsqueda Rápida</div>
	<div id="titleAdv">Búsqueda Avanzada</div>
</div>
<div class="asContent" id="finder">
	<div class="findToggle" id="toggleFast">cambiar a búsqueda avanzada +</div>
	<div class="findToggle" id="toggleAdv">cambiar a búsqueda rápida +</div>
	<div id="fastFind">
	<form id="buscarF" action="javascript:void(0)" method="get">
		<div class="text0">
			<input class="send" type="text" id="autor-autor_i-titulo-isbn-barcode" value="" placeholder="Escriba las palabras para buscar" />
		</div>
		<input class="boton" type="submit" onclick="findFast(this)" id="fastBtn" value="Buscar..." />
	</form>
	</div>
	<div id="advFind">
	<div class="tabTit">
		<div class="select" id="libros">Libros</div>
<?PHP if(isset($_SESSION['la']['usuarios']['usuarios_nivel'])&&$_SESSION['la']['usuarios']['usuarios_nivel']>3){?>
		<div id="ventas">Facturas</div>
		<div id="pedidos">Pedidos</div>
<?PHP }?>
	</div>
	<div class="tabView">
	<div class="libros use" id="sffindA">
		<form id="buscarA" action="javascript:void(0)" method="get"><!-- autocomplete="off"-->
		<?PHP if(isset($_SESSION['la']['usuarios']['usuarios_nivel'])&&$_SESSION['la']['usuarios']['usuarios_nivel']>2){?>
			<div class="label2"><label for="codigo">Codigo:</label></div><div class="text2">
				<input class="send" type="text" id="codinca-codweb" value="" placeholder="codigo" />
			</div>
		<?PHP }?>
			<div class="label2"><label for="autor-autor_i">Autor:</label></div><div class="text2">
				<input class="send" type="text" id="autor-autor_i" value="" placeholder="Autor" />
			</div>
			<div class="label2"><label for="titulo">Titulo:</label></div><div class="text2">
				<input class="send" type="text" id="titulo" value="" placeholder="Titulo" />
			</div>
			<div class="label2"><label for="coleccion">Coleccion:</label></div><div class="text2">
				<input class="send" type="text" id="coleccion" value="" placeholder="Coleccion" />
			</div>
			<div class="label2"><label for="editorial">Editorial:</label></div><div class="text2">
				<input class="send" type="text" id="editorial" value="" placeholder="Editorial" />
			</div>
			<div class="label2"><label for="resumen-tabla_cont-descriptores-materia">Resumen:</label></div><div class="text2">
				<input class="send" type="text" id="resumen-tabla_cont-descriptores-materia" placeholder="Contenido" value="" />
			</div>
			<input class="boton" type="submit" onclick="findFast(this)" id="advBtn" value="Buscar..." />
		</form>
	</div>
<?PHP if(isset($_SESSION['la']['usuarios']['usuarios_nivel'])&&$_SESSION['la']['usuarios']['usuarios_nivel']>3){?>
	<div class="ventas" id="sfventas">
		<form id="buscarB" action="javascript:void(0)" method="get"><!-- autocomplete="off"-->
			<div class="label2"><label for="codigo">Codigo:</label></div><div class="text2">
				<input class="send" type="text" id="codigo" value="" placeholder="Codigo" />
			</div>
			<div class="label2"><label for="detalle_autor">Autor:</label></div><div class="text2">
				<input class="send" type="text" id="detalle_autor" value="" placeholder="Autor" />
			</div>
			<div class="label2"><label for="detalle_titulo">Titulo:</label></div><div class="text2">
				<input class="send" type="text" id="detalle_titulo" value="" placeholder="Titulo" />
			</div>
			<div class="label2"><label for="detalle_orden">No. Orden:</label></div><div class="text2">
				<input class="send" type="text" id="detalle_orden" value="" placeholder="No. de Orden" />
			</div>
			<input class="boton" type="submit" onclick="findAdv('buscarB')" id="advBtnV" value="Buscar..." />
		</form>
	</div>
	<div class="pedidos" id="sfpedidos">
		<form id="buscarC" action="javascript:void(0)" method="get"><!-- autocomplete="off"-->
			<div class="label2"><label for="codigo">Codigo:</label></div><div class="text2">
				<input class="send" type="text" id="codigo" value="" placeholder="Codigo" />
			</div>
			<div class="label2"><label for="titulo">Titulo:</label></div><div class="text2">
				<input class="send" type="text" id="titulo" value="" placeholder="Titulo" />
			</div>
			<div class="label2"><label for="pedidos_orden">No. Orden:</label></div><div class="text2">
				<input class="send" type="text" id="pedidos_orden" value="" placeholder="No. de Orden" />
			</div>
			<input class="boton" type="submit" onclick="findAdv('buscarC')" id="advBtnP" value="Buscar..." />
		</form>
	</div>
<?PHP }?>
	</div>
	</div>
</div>
