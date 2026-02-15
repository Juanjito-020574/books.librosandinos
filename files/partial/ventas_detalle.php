<?PHP
if(!function_exists('detalle_venta_tabla')){
	require('../../system/functions.php');
	require('../../system/database.php');
}
extract($_REQUEST);
		//															print_pre($_REQUEST);
		//															echo $cepal_id;

if(!session_start()){session_start();}
$filas=detalle_venta_tabla($id,isset($cepal_id)?$cepal_id:null);
$mx=($_SESSION['la']['usuarios']['usuarios_nivel']>=6&&count($filas['mx'])>0?"<a id='em' onclick='em(\"".implode(',',$filas['mx'])."\")'>Exportar marc21</a>":'');
if($filas['_view'][0]==0){$title="Mostrar las columnas completas";$html="+";}else{$title="Ocultar los columnas que no se imprimen";$html="-";}
//		estamos convirtiendo la selección en función para ver si así se puede arreglar los campos
?>
<table id="<?PHP echo $name?>-ed">
	<thead>
		<tr class="prnhide_head">
			<th class="no_v"><span id="hideprnhide" class="link" style="font-size:18px;cursor:pointer;" title="<?PHP echo $title?>" onclick="hideprnhide()"><?PHP echo $html?></span></th>
			<th class="codigo_v prnhide"<?PHP echo $filas['_view'][1]?>><span id="codigo_v" class="ocultar" title="1" onclick="ocultarVentasEd('codigo_v')"><img src="images/prnoff.png" width="15px" title="Haga click para mostrar esta columna en la impresion" /></span></th>
			<th class="order_v prnhide"<?PHP echo $filas['_view'][2]?>><span id="order_v" class="ocultar" title="2" onclick="ocultarVentasEd('order_v')"><img src="images/prnoff.png" width="15px" title="Haga click para mostrar esta columna en la impresion" /></span></th>
			<th class="autor_v"></th>
			<th class="titulo_v"><?PHP echo $mx;?></th>
			<th class="editor_v"></th>
			<th class="cantidad_v prnhide"<?PHP echo $filas['_view'][3]?>><span id="cantidad_v" class="ocultar" title="3" onclick="ocultarVentasEd('cantidad_v')"><img src="images/prnoff.png" width="15px" title="Haga click para mostrar esta columna en la impresion" /></span></th>
			<th class="precio_v prnhide"<?PHP echo $filas['_view'][4]?>><span id="precio_v" class="ocultar" title="4" onclick="ocultarVentasEd('precio_v')"><img src="images/prnoff.png" width="15px" title="Haga click para mostrar esta columna en la impresion" /></span></th>
			<th class="total_v"></th>
		</tr>
		<tr>
			<th class="no_v">No.</th>
			<th class="codigo_v prnhide"<?PHP echo $filas['_view'][1]?>>Cod</th>
			<th class="order_v prnhide"<?PHP echo $filas['_view'][2]?>>Order No.</th>
			<th class="autor_v">Author</th>
			<th class="titulo_v">Title</th>
			<th class="editor_v">Publisher</th>
			<th class="cantidad_v prnhide"<?PHP echo $filas['_view'][3]?>>Qty</th>
			<th class="precio_v prnhide"<?PHP echo $filas['_view'][4]?>>Unit</th>
			<th class="total_v">Price</th>
		</tr>
	</thead>
	<tbody>
	<?PHP echo $filas['filas'];?>
	</tbody>
</table>
<script type="text/javascript">
remStyleTime('<?PHP echo $name?>-ed tbody tr',5);
$(".autor_v input,.titulo_v input,.editorial_v input").focus(function(){$(this).css('text-transform','none')}).blur(function(){$(this).removeAttr('style')});
var find_stock=$('#findStock').parent().html();
if($('#<?PHP echo $name?>-ed tbody tr').length>=35){
	$('#findStock').parent().html('Ha llegado a limite de registros permitidos para una factura. continue en una nueva factura').css('text-align','left').addClass('read');
}else{
	$('#findStock').parent().html(find_stock);
}
var views=$('#ventas_view').val();
for(var i=0,z=i+1;i<$('.ocultar').length;i++,z++){
	var este=$('.ocultar')[i];
	if(views.substr(z,1)==1){ocultarVentasEd($(este).attr('id'),1)}
}
$('.cantidad_v input, .precio_v input').on('change',function(){
//	console.log(this)
	if($(this)[0].validity.valid){
		$('#'+$(this).attr('id')).parent().removeAttr('style');
		saveCP($(this).attr('id'));
	}else{
		$('#'+$(this).attr('id')).parent().css('background-color','#F00');
	}
})
$('.order_v input,.autor_v input,.titulo_v input,.editorial_v input').on('change',function(){
	saveATP($(this).attr('id'))
})
$('tbody input.codigo').on('change',function(){//borrar registro del detalle de ventas y de la tabla ventas_detalle
	var detalle_id=$(this).parent().parent().find('td:last input').val()
	$(this).parent().html('<img src="images/anim.gif" />')
	$('#temporal').load('files/ventas_q.php',{name:'ventas_detalle',regId:detalle_id,ventas_id:parseInt($('#ventas_id').val(),10),fnc:'borrar_venta'});

})
<?PHP if($_SESSION['la']['usuarios']['usuarios_nivel']>=6){?>
function em(ids){//'files/marcx.php?ids='+ids+'&factura='+$('#ventas_id').val()+'&cliente='+$('#ventas_cliente').val()
	var getvar = '?ids='+ids+'&factura='+$('#ventas_fact').val()+'&voucher='+$('#ventas_id').val()+'&cliente='+$('#ventas_cliente').val();
	mv=window.open('files/marcx.php'+getvar,'mrk',"height=500px,width=600px,toolbar=yes,menubar=yes,location=yes");
//	mv.document.body.bgColor='#adf';
//	$(mv.document.body).append('<textarea id="datosMarc" name="datosMarc" style="width:100%;height:100%;"></textarea><a onclick="marcExp()" style="position:absolute;right:30px;top:0px;border: 1px solid grey;color:#fff;background-color:grey;padding:2px 10px;border-radius:6px;cursor:pointer;">Guardar</a>');
//	$(mv).load('files/marcx.php',{ids:ids,factura:$('#ventas_fact').val(),voucher:$('#ventas_fact').val(),cliente:$('#ventas_cliente').val()});
//	$(mv).append()
}
$('tbody td.no_v').on('dblclick',function(){
		editData('cepal',$(this).attr('id'));
})
<?PHP }?>
$('#findStock').focus();
</script>
