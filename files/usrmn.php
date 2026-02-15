<?PHP
if(!isset($_SESSION))session_start();$pCli='';
$us=$_SESSION['la']['usuarios'];
$pruebasMysql="<li><a class='a' href='pruebas_mysql.html'>Mysql</a></li>";
$listUser="<li><a class='a' href='list_usuarios.html'>Administrar Usuarios</a></li>";
$listVenta="<li><a class='a' href='list_ventas.html'>Administrar Ventas</a></li>";
$listCli="<li><a class='a' href='list_clientes.html'>Administrar Clientes</a></li>";
$listUsr="<li><a class='a' href='list_listas.html'>Administrar Listas</a></li>";
if($us['usuarios_nivel']<3){
	$href="purchase_orders.html";
	$htm="Estado de las compras";
}else{
	$href="purchase.html";
	$htm="Administrar pedidos";
	if($us['usuarios_nivel']>4){
		$pCli="<li><a class='a' href='purchase.html?view=_usuario'>Pedidos por cliente</a></li>";
	}else{$pCli='';}
}
$listCompra="<li><a class='a' href='$href'>$htm</a></li>$pCli";
$listCatalogo="<li><a class='a' href='list_catalogo.html'>Administrar Catalogos</a></li>";
$isoSql="<li><a class='a' href='iso2709_sql.html'>Importar ISO</a></li>";
$newBook="<li><a onclick='newData(\"cepal\")'>Registrar Nuevo Libro</a></li>";
$fichaBook="<li><a onclick='fichaMia()'>Fichas Asignacion</a></li>";
$listpais_cli="<li><a class='a' href='list_clientes_pais.html'>Clientes por pais</a></li>";
$BackupISO="<li><a onclick='backiso()'>Backup ISO</a></li>";
?>
<li><a>Usuario: <?PHP echo strtoupper($us['usuarios_nick']);?></a>
	<ul>
		<li><a class='sessClose' onclick='log_off()'>Cerrar Sesión de Usuario</a></li>
		<li><a onclick="editData('<?PHP echo $us['usuarios_nivel']<3?'usuarios_cli':'usuarios'?>','<?PHP echo $us['usuarios_id'];?>')" >Administrar Cuenta</a></li>
		<li><a onclick="editPass('<?PHP echo $us['usuarios_id'];?>')" >Cambiar Contraseña</a></li>
		<?PHP
		switch($_SESSION['la']['usuarios']['usuarios_nivel']){
			case '1'://cliente estandar
				echo "$listCompra";
			break;
			case '2'://cliente frecuente
				echo "$listCompra";
			break;
			case '3'://operador
				echo "$listCompra$newBook$fichaBook";
			break;
			case '4'://vendedor
				echo "$listVenta$listCompra$newBook$fichaBook";
			break;
			case '5'://administrador
				echo "$listCatalogo$listUser$listCli$listVenta$listCompra$newBook$fichaBook$listpais_cli";
			break;
			case '6'://superadministrador
				echo "$listCatalogo$listUser$listCli$listVenta$listCompra$newBook$fichaBook$listUsr$listpais_cli$isoSql$BackupISO";
			break;
			case '7'://programador
				echo "$listCatalogo$listUser$listCli$listVenta$listCompra$newBook$fichaBook$listUsr$listpais_cli$isoSql$BackupISO$pruebasMysql";
			break;
		}
		?>
	</ul>
</li>
