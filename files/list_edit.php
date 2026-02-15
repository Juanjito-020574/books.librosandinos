<?PHP
if(!function_exists('include_if_exists')){include('../system/functions.php');};$nivMin = 3;
include('../system/verif_user.php');
if(!isset($_SESSION))session_start();$id=0;
extract($_REQUEST);
?>
<div id="workdata" class="print"><div>
<?PHP
			//															print_pre($_REQUEST);
extract(list_args($name));
			//															print_pre(list_args($name));
//$descamp=($tipo=='nuevo'?"ventas_cliente,ventas_fecha":false);
$$name=new DataBase($name);
extract($$name->q_desc);
$$name->columns="*";
$$name->where="$cmpID = '$id'";
$$name->_query('SELECT');
$row=$$name->q_fetch_assoc;
			//															print_r(list_args($name));
			//															echo $$name->q_query;
?>
<form id="f_<?PHP echo $name;?>" novalidate="" action="javascript:void(0)" method="post">
	<div id='v-ref'>
		<span class='v-ref prnhide'><?PHP echo ($tipo=='nuevo'?$cmpRel['val']:'');?></span>
		<span class='v-ref'>
			<div>
				<div class="label2">Id.:</div>
				<div class="text2 read">
					<input type="text" id="<?PHP echo $cmpID?>" class="__id" disabled="" value="<?PHP echo "$id";?>" />
				</div>
			</div>
			<div>
				<div class="label2"><?PHP echo $cmpRel['tit']?>.:</div>
				<div class="text2 read">
					<input type="text" id="<?PHP echo $cmpRel['cmp']?>" class="__id" disabled="" value="<?PHP echo $row[$cmpRel['cmp']];?>" />
				</div>
			</div>
		</span>
	</div>
	<div class='title_list'><p><?PHP echo "$titlePrint"?></p><p>fecha: <?PHP echo date('Y-m-d')?></p></div>
	<div id="list_detalle"></div>
</form></div>
</div>
<div id="workdata_search" class="prnhide">
<header class="s-head">
Registro y Edicion de <?PHP echo $name."--".$_SESSION['la']['usuarios']['usuarios_nivel']."--";?>
<div class="form-botones" style="width:90%;height:auto;">
	<span class="boton" style="vertical-align:middle;"><a style="display:inline-block;padding:4px 10px;" onclick="window.print()"><img src="images/prnprn.png" style="margin-left:-8px;height:15px;" /> | Imprimir</a></span>
	<span class="boton" style="vertical-align:middle;"><a style="display:inline-block;padding:4px 10px;" onclick="closeDw()">Salir | <img src="images/bt_out.png" style="margin-right:-8px;height:15px;"/></a></span>
</div>
</header>
<div id="temporal"></div>
<div class='v-ref'></div>
<?PHP if($name!='pedidos_pais'){?>
<div class="text0" id="book" style="width:95%;">
	<input autocomplete="off" class="send<?PHP echo $name?>" id="findStock" name="findStock" autofocus="true" value="" type="text" placeholder="Escriba el titulo o el codigo del libro que desea buscar." title="Buscar libros en la base de datos" />
	<div class="suger" id="suger_findStock"></div>
</div>
<?PHP }?>
<div id="form-descripciones" class="s-foot">Ver descripciones</div>
</div>
<?PHP
session_write_close();
?>
<script type="text/javascript">
var cmpTabla=<?PHP echo json_encode($cmpTabla);?>;
$('select#pedido_usuarios_id').on('change',function(){
	$('input#usuarios_id').val($(this).val());
	$('input#usuarios_nick').val($(this).find('option[value='+$(this).val()+']').text());
	$(this).parent().parent().detach();
})
//console.log(cmpTabla);
$('#list_detalle').html(carga).load('files/partial/list_detalle.php',{id:'<?PHP echo $id;?>',name:'<?PHP echo "$name";?>'});
<?PHP if($_SESSION['la']['usuarios']['usuarios_nivel']>=6){?>
$(document).on('dblclick','tbody td.no_l',function(){
	editData('cepal',$(this).parent().attr('id'));
})
<?PHP }?>
</script>
