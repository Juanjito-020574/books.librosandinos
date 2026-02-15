<?PHP
//error_reporting(0);
if(!isset($_SESSION))session_start();
require_once "system/functions.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title class="title">Libros Andinos</title>
<meta charset="utf-8" />
		<meta http-equiv="Expires" content="0" />
		<meta http-equiv="Last-Modified" content="0" />
		<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
<meta name="description" content="Venta de libros de los paises andinos, Bolivia, Chile, Colombia, Ecuador, Perú, Venezuela"/>
<meta name="robots" content="index,follow" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<meta name="google-site-verification" content="RBD--XNLzWQXpgIus7eWZliMeS3Zd-ykTf904nnXhuA" />
<link rel="canonical" href="http://librosandinos.com/" />
<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="icon" href="images/favicon.ico" />
<link rel="stylesheet" href="style/style.css" media="all" />
<link rel="stylesheet" href="style/stylePrint.css" media="print" />
<!-- <script type="text/javascript" src="js/cssrefresh.js"></script> -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui-1.9.1.custom.min.js"></script>
<script src="js/jquery.history.my.js"></script>
<script src="js/jquery.func.js"></script>
<script src="js/ventas.func.js"></script>
<script src="js/indexedDB.js"></script>
<script src="js/marcx.js"></script>
<script src="js/script.js"></script>
</head>
<body onload="gostChau()" >
<div id="gost"><div id="gost2"><div style='padding:150px 10px 0px;color:#FFFFFF;'><p>Por favor espere un momento.</p><p>Los datos se están cargando...</p><br /><img src='images/anim.gif' alt=""/></div></div></div>
<div id="notice"></div>
<header id="cabecera">
	<div class="logo"><img src="images/logo2.png" alt="" />
	</div>
	<div id="login">
	<?PHP include("files/login.php")?>
	</div>
</header>
<nav id="menuBar">
	<ul id="menu">
		<li><a class="a" href="start.html">Inicio</a></li>
		<li><a class="a" href="novelties.html">Novedades</a></li>
		<li><a class="a" href="offers.html">Ofertas</a></li>
		<li><a class="a" href="catalogs.html">Catalogos</a></li>
		<li><a class="a" href="magazines.html">Revistas</a></li>
		<li><a class="a" href="contacts.html">Contactos</a></li>
		<?PHP if(isset($_SESSION['la']['usuarios'])){include("files/usrmn.php");} ?>
	</ul>
</nav>
<div id="cuerpo">
	<aside id="tools">
		<div class="menuFloat">
			<div id="search">
				<?PHP include('files/finder.php');?>
			</div>
			<div id="cart">
				<?PHP include('files/cart.php');?>
			</div>
		</div>
	</aside>
	<section id="workarea" >
		<h1>Librería Libros Andinos</h1>
		<h2>Material Bibliográfico de la Zona Andina</h2>
		<p><b>Bolivia, chile, Colombia, Ecuador, Perú, Venezuela</b></p>
	</section>
</div>
<footer id="pie"><?PHP include("files/contact.php");?>
	<div class="copyright">&copy; juanjito.tk</div>
</footer>
<div id="v-logo"><img src="images/LABW.png" width="110" alt="" /><div class="title_v"><p>LIBROS ANDINOS</p><p>P.O. Box 164900</p><p>Miami, Florida 33116-4900</p></div></div>
</body>
</html>
