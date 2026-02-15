<?PHP
//header("Content-Type: application/Word; charset=utf-8;");
//header("Content-Disposition: inline; filename=$_REQUEST[cat].doc;");
if(!function_exists('include_if_exists')){include('../system/functions.php');};$nivMin = 2;
include('../system/verif_user.php');
extract($_REQUEST);
if(!isset($_SESSION))session_start();
$name='pais_cli';
$$name=new DataBase("$name");
$$name->_query('SELECT');
$row=$$name->q_fetch_assoc;
	do{
		$arr[$row['pais_cli_pais']]=$row['pais_cli_clientes'];
	}while($row = mysqli_fetch_assoc($$name->q_src));
$json=json_encode($arr);
?>
<div id="workdata">
<?PHP
//print_pre($json);
?>
	<div id="fichaMiami" style="margin:10px;">
		<div style="width:100%;text-align:left;box-shadow:none;background:transparent;">
		</div>
	</div>
</div>
<div id="workdata_search">
	<header id="wsh" class="s-head">
		Fichas para enviar a Miami<br />
<!--		<input type="submit" class="aLog" style="margin-bottom:10px;" form="f_<?PHP echo $name?>" onclick="validar(f_<?PHP echo $name?>)" value="Guardar" /> -->
		<input type="button"  class="aLog" style="margin-bottom:10px;" onclick="closeDw()" value="Salir" />
	</header>
	<div id="filtros">Filtrar registros por:
		<div>
			<div class="label2">Fecha</div>
			<div class="text2">
				<input id="fecha" type="date" value="<?PHP echo date('Y-m-d')?>"  /></div>
			</div>
		</div>
	<div id="form-descripciones" class="s-foot">Ver descripciones</div>
</div>
<script type="text/javascript">
var fichas=new fichasLibros('<?PHP echo $sUs_usuarios_nick;?>');
var pc=<?PHP echo $json?>;
//console.log(pc);
fichas.init('fichasMiami',1,pc);
$('#filtros #fecha').on('change',function(){
	fichas.open('fichasMiami');
})
$('#fichaMiami').on('contextmenu',function(){var sel=window.getSelection(),range=document.createRange();range.selectNodeContents(this);sel.removeAllRanges();sel.addRange(range);});
</script>