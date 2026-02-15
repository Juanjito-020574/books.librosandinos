<?php
if(!function_exists('detalle_venta_tabla')){
	require('../../system/functions.php');
	require('../../system/database.php');
}
if(!isset($_SESSION))session_start();
extract($_REQUEST);
			//														print_pre($_REQUEST);
extract(list_args($name));
			//														print_pre(list_args($name));
$data=$cmpTabla;
$filas=detalle_list_tabla($id,$tablaRel.(isset($view)?$view:''),$cmpID,$data);
$tit1=$tit2='';
foreach($data as $i=>$v){
	$hide='';
	if($v[3]=='hide'){
$hide="<span id='$v[0]_l' class='prnhide' onclick=\"ocultarVentasEd('$v[0]_l',1)\">
<img src='images/prnoff.png' width='15px' title='Ocultar columna en la impresión' />
</span>";
	}
	$tit1.="<th class='$v[0]_l' style='width:$v[1];'>$hide</th>\n";
	$tit2.="<th class='$v[0]_l' style='width:$v[1];'>$i</th>\n";
}
//$mx=($_SESSION['la']['usuarios']['usuarios_nivel']>=6&&count($filas['mx'])>0?"<a id='em' onclick='em(\"".implode(',',$filas['mx'])."\")'>Exportar marc21</a>":'');
//if($filas['_view'][0]==0){$title="Mostrar las columnas completas";$html="+";}else{$title="Ocultar los columnas que no se imprimen";$html="-";}
//		estamos convirtiendo la selección en función para ver si así se puede arreglar los campos
?>
<table id="<?echo $name?>-ed" class="list-ed">
	<thead>
		<tr class="prnhide_head">
			<th class="no_l"></th>
<?echo $tit1;?>
		</tr>
		<tr>
			<th class="no_l">No.</th>
<?echo $tit2;?>
		</tr>
	</thead>
	<tbody>
	<?PHP echo $filas[filas];?>
	</tbody>
</table>
<script type="text/javascript">
$('.codigo_l,.grupo_l,.stock_l').addClass('prnhide');
$('.list-ed .l_text input,.list-ed .ent input').attr('readonly','');
$(".autor_v input,.titulo_v input,.editorial_v input").focus(function(){$(this).css('text-transform','none')}).blur(function(){$(this).removeAttr('style')});
var find_stock=$('#findStock').parent().html();
/*if($('#<?echo $name?>-ed tbody tr').length>=35){
	$('#findStock').parent().html('Ha llegado a limite de registros permitidos para una factura. continue en una nueva factura').css('text-align','left').addClass('read');
}else{
	$('#findStock').parent().html(find_stock);
}*/
var views=$('#ventas_view').val();
for(var i=0,z=i+1;i<$('.ocultar').length;i++,z++){
	var este=$('.ocultar')[i];
	if(views.substr(z,1)==1){ocultarVentasEd($(este).attr('id'),1);}
}
$('#findStock').focus();
$('.list-ed tbody .codigo_l input').on('change',function(){//borrar registro del detalle de ventas y de la tabla ventas_detalle
	var detalle_id=$(this).parent().parent().attr('id')
	var data={name:'<?echo $name?>',id:'<?echo $id?>',tablaMadre:'<?echo $tablaMadre['tabla']?>',
		regId:detalle_id,campoId:'<?echo $tablaMadre['cmpID']?>',fnc:'borrar_lista'}
	$(this).parent().html('<img src="images/anim.gif" />');
	$('#temporal').load('files/ventas_q.php',data);
})
$('.list-ed tbody input.stock,.list-ed tbody input.precio,.list-ed tbody input.pedidos_orden,.list-ed tbody input.pedidos_fecha').on('change',function(){//borrar registro del detalle de ventas y de la tabla ventas_detalle
	var name='pedidos';
	var campoName=$(this).attr('class');
	var campoVal=$(this).val();
	var regId=$(this).parent().parent().attr('class');
	var regVal=$(this).parent().parent().attr('id');
	saveATP_list(name,campoName,campoVal,regId,regVal);
})

</script>