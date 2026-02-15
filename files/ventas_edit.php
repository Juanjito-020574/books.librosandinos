<?php if(!isset($_SESSION))session_start();
if(!function_exists('include_if_exists')){include('../system/functions.php');};$nivMin = 4;
include('../system/verif_user.php');
?>
<div id="workdata" class="print">
<?PHP						//												print_pre($_REQUEST);
extract($_REQUEST);
$print=$tipo=='nuevo'?'display:none;':'';
$cmpID=$name."_id";
$descamp=($tipo=='nuevo'?"ventas_cliente,ventas_fecha,ventas_dirfact,ventas_usuario":false);
$$name=new DataBase($name,$descamp);
extract($$name->q_desc);
if($tipo=='nuevo'){
	$$name->where="$cmpID='0'";
}else{
	$$name->columns="*,if(ventas_dirfact='',(select usuarios_dirfact from usuarios_cli where ventas_cliente=usuarios_nick),ventas_dirfact) as usuarios_dirfact";
	$$name->where="$cmpID = '$id'";
}
$$name->_query('SELECT');
							//											print_pre($$name->q_desc);
							//											echo $$name->q_query;
$row=$$name->q_fetch_assoc;
include('partial/tablas.php');
foreach($dataType as $i=>$v){
	include('partial/ventaType.php');
}
							//											print_pre($dataVal);
?>

<div><form id="f_<?PHP echo $name;?>" class="form0" novalidate="" action="javascript:void(0)" method="post">
<?PHP if($tipo=='nuevo'){?>
	<div id='v-ref'>
		<span class='v-ref prnhide'><?PHP echo $input['ventas_cliente']?></span>
		<span class='v-ref'><?PHP echo $input['ventas_fecha'];?></span>
	</div>
	<div class='prnhide'><?PHP echo $input['ventas_dirfact'];?></div>
<?PHP $return='display:none';
}else{
	switch ($row['ventas_foot']){
		case 'return': $return='display:block;';$noreturn='display:none;';break;
		case 'no_return': $return='display:none;';$noreturn='display:block;';break;
		case 'none':$return='display:none;';$noreturn='display:none;';break;
	}
?>
	<div class="form-campos" id="form-campos">
	<div id="ventas_approval_stamp">
		<?PHP echo($row['ventas_approval']!='None'&&$row['ventas_approval']?(preg_match('/[A-Z]/',$row['ventas_approval'],$pais)?"<img src='images/approval$pais[0].png' />":''):'')?>
	</div>
	<div id='v-ref'>
		<span class='v-ref prnhide'><?PHP echo $input['ventas_cliente'];?></span>
		<span class='v-ref'><?PHP echo"$input[ventas_fecha]$input[ventas_id]";?></span>
	</div>
	<div class='datos_cli_emp'>
		<div class='cli_dir'>
			<div class='label2'><label style='font-size:10pt;'>SEND BOOKS TO: </label></div>
			<div class='text2'><div class='pay'><?PHP echo (isset($mC)&&$mC==1&&$dataVal['ventas_clid']==9?"<textarea id='ventas_dirfact' rows='5'></textarea>":str_replace("\n","<br />",$dataVal['usuarios_dirfact']));?></div></div>
		</div>
		<div class='pay_dir'>
			<div class='label2'><label style='font-size:10pt;'>Pay to: </label></div>
			<div class='text2'><div class='pay'>LIBROS ANDINOS<br />P.O. Box 164900<br />Miami, Florida 33116-4900</div></div>
		</div>
	</div>
	<div style="position:relative;">
		<div class="head_v">
			<?PHP $vH=explode('||',$row['ventas_head']);?>
			<textarea id="headEditable" name="headEditable[0]" rows="1" class="ventas_head send<?PHP echo $name?>" style="text-align:left;width:49.6%;" title="Comentarios de Cabecera"><?PHP echo $vH[0];?></textarea>
			<span class="prnhide" style="border-left:1px solid;"></span>
			<textarea id="headEditable" name="headEditable[1]" rows="1" class="ventas_head send<?PHP echo $name?>" style="text-align:right;width:49.6%;" title="Comentarios de Cabecera"><?PHP echo (isset($vH[1])?$vH[1]:'');?></textarea>
		</div>
	</div>
	<div id="ventas_detalle">
	</div>
	<div class="tfoot">
		<span id="glosa" class="prnhide ocultar" title="5" onclick="ocultarVentasEd('glosa')">
			<img src="images/prnoff.png" width="15px" title="Haga click para mostrar los comentarios en la impresion" />
		</span>
		<span id="txtsize" class="prnhide">
			<a class="txtsize_16">16</a>
			<a class="txtsize_18">18</a>
			<a class="txtsize_20">20</a>
		</span>
		<div class="footGlosa">
			<div class="glosa prnhide">
				<textarea id="glosaEditable" rows="2" class="ventas_glosa" title="Glosa de la factura"><?PHP echo $row['ventas_glosa'];?></textarea>
			</div>
			<div id="ventas_mark_stamp">
				<?PHP echo($row['ventas_mark']&&$row['ventas_mark']!='none'?"<img src='images/mark_sent.png' />":'')?>
			</div>
		</div>
		<div class="totales" id="totales">
		<?PHP echo "$input[ventas_tbook]$input[ventas_discount]$input[ventas_subtotal]$input[ventas_impuesto]$input[ventas_envio]$input[ventas_total]";?>
		</div>
	</div>
	</div>
<?PHP }?></form></div>
</div>
<div id="workdata_search" class="prnhide">
<header class="s-head">
Registro y Edicion de <?PHP echo $name;?>
<div class="form-botones" style="width:90%;height:auto;">
	<span class="boton" style="vertical-align:middle;<?PHP echo $print?>"><a style="display:inline-block;padding:4px 10px;" onclick="window.print()"><img src="images/prnprn.png" style="margin-left:-8px;height:15px;" /> | Imprimir</a></span>
	<span id="detalle_excel" class="boton" style="vertical-align:middle;"><a style="display:inline-block;padding:4px 10px;" >Exportar | <img src="images/msexcel.png" style="margin-right:-8px;height:15px;"/></a></span>
	<span class="boton" style="vertical-align:middle;"><a style="display:inline-block;padding:4px 10px;" onclick="closeDw()">Salir | <img src="images/bt_out.png" style="margin-right:-8px;height:15px;"/></a></span>
</div>
</header>
<div id="temporal"></div>
<div class='v-ref'><?PHP echo ($tipo=='edit'?"$input[ventas_approval]$input[ventas_foot]$input[ventas_view]$input[ventas_mark]":''); ?></div>
<div class="text0" id="book" style="width:95%;">
	<input autocomplete="off" class="send<?PHP echo $name?>" id="findStock" name="findStock" autofocus="true" value="" type="text" placeholder="Escriba el titulo o el codigo del libro que desea buscar." title="Buscar libros en la base de datos" />
	<div class="suger" id="suger_findStock"></div>
</div>
<div id="form-descripciones" class="s-foot">Ver descripciones</div>
</div>
<?PHP
session_write_close();
?>
<script type="text/javascript">

$('#detalle_excel').on('click',function(e){
	e.preventDefault();
	excelexp($('#ventas_id').val());
//	var data={'view':'_ven','tId':'voucher','voucher':$('#ventas_id').val()};
//	var dt='view=_ven&tId=voucher&val='+$('#ventas_id').val()+'&orden=voucher,orden';
//	window.open('files/excel_all.php?'+dt,data['name'],"toolbar=no,menubar=no,location=no");
})
$('#txtsize a').on('click',function(){
	var txtsize=$(this).text();
	if(txtsize==16){$('#glosaEditable').removeAttr('style');}else{$('#glosaEditable').css('font-size',txtsize+'px')}
})
$('#ventas_detalle').html(carga).load('files/partial/ventas_detalle.php',{id:$('#ventas_id').val(),name:'ventas'});
$('#headEditable,#glosaEditable').setTextareaHeight();
$('#ventas_fact').on('change',function(){
	var campoVal=parseInt($(this).val(),10)||0;
	$(this).val(pad(campoVal,6));
//		console.log($('#ventas_id_fact>img').attr('src'));
	if(campoVal==0){
		$(this).addClass('prnhide');
		$('#ventas_id').removeClass('prnhide');
		if($('#ventas_id_fact>img').attr('src')=='images/prnon.png'){
			$(this).parent().parent().find('label').html('Voucher No.:');
		}
//		console.log($(this).parent().parent().find('label').html())
	}else{
		$(this).removeClass('prnhide');
		$('#ventas_id').addClass('prnhide');
		if($('#ventas_id_fact>img').attr('src')=='images/prnon.png'){
			$(this).parent().parent().find('label').html('Invoice No.:');
		}
//		console.log($(this).parent().parent().find('label').html())
	}
	$('#temporal').load('files/ventas_q.php',{ventas_id:parseInt($('#ventas_id').val(),10),name:'ventas',campoVal:campoVal,campoName:$(this).attr('id'),regId:'ventas_id',regVal:parseInt($('#ventas_id').val(),10),fnc:'update_campo',noscript:'0'});
})

$('#headEditable,#glosaEditable').on('change',function(){
	var campoVal;
	if($(this).attr('id')=='headEditable'){
		var numHead=$(headEditable[0]).val()+"||"+$(headEditable[1]).val()
		campoVal=numHead;
	}else{
		campoVal=$(this).val();
	}
//	console.log($(this).attr('id'))
	$('#temporal').load('files/ventas_q.php',{ventas_id:parseInt($('#ventas_id').val(),10),name:'ventas',campoVal:campoVal,campoName:$(this).attr('class'),regId:'ventas_id',regVal:parseInt($('#ventas_id').val(),10),fnc:'update_campo',noscript:'0'});
})
if($('#ventas_porcentaje').val()!=0){
	$('#ventas_tbook,#ventas_discount').parent().parent().removeClass('prnhide');
}else{
	$('#ventas_tbook,#ventas_discount').parent().parent().addClass('prnhide');
}
$('.footGlosa .glosa').on('click',function(){
	$('#glosaEditable').focus();
})
/*$('#ventas_glosa').on('change',function(){
	var regVal=parseInt($('#ventas_id').val(),10);
	var regId='ventas_id'
	$('#temporal').load('files/ventas_q.php',{ventas_id:regVal,name:'ventas',campoVal:$(this).val(),campoName:$(this).attr('id'),regId:regId,regVal:regVal,fnc:'update_campo'});
})*/
$('#ventas_mark').on('change',function(){
	var regVal=parseInt($('#ventas_id').val(),10);
	var regId='ventas_id';
	$('#temporal').load('files/ventas_q.php',{ventas_id:regVal,name:'ventas',campoVal:$(this).val(),campoName:$(this).attr('id'),regId:regId,regVal:regVal,fnc:'update_campo'});
	if($(this).val()!='none'){
		$('#ventas_mark_stamp').html('<img src="images/mark_sent.png" />');
	}else{
		$('#ventas_mark_stamp').html('');
	}
})
$('#ventas_approval').on('change',function(){
	var regVal=parseInt($('#ventas_id').val(),10);
	var regId='ventas_id';
	$('#temporal').load('files/ventas_q.php',{ventas_id:regVal,name:'ventas',campoVal:$(this).val(),campoName:$(this).attr('id'),regId:regId,regVal:regVal,fnc:'update_campo'});
	if($(this).val()!='None'){
		$('#ventas_approval_stamp').html('<img src="images/approval'+$('#ventas_approval').val().match(/[A-Z]/)+'.png" />');
	}else{
		$('#ventas_approval_stamp').html('');
	}
})
$('#ventas_foot').on('change',function(){
	$('.foot_prn>div').hide()
	var regVal=parseInt($('#ventas_id').val(),10);
	var regId='ventas_id'
	$('#temporal').load('files/ventas_q.php',{ventas_id:regVal,name:'ventas',campoVal:$(this).val(),campoName:$(this).attr('id'),regId:regId,regVal:regVal,fnc:'update_campo'});
	if($(this).val()!='none'){
		$('#'+$(this).val()).show();
	}
})
$('#wd').after('<div class="foot_prn">'+
'<div id="return" style="<?PHP echo (isset($return)?$return:'')?>"><p>BOOK RETURNS</p><p>LIBROS ANDINOS</p><p>P.O. Box 164900</p><p>Miami, FL 33116-4900</p></div>'+
'<div id="no_return" style="<?PHP echo (isset($noreturn)?$noreturn:'')?>">'+
'Books of US$ 15.00 or less, if unwanted, can be discarded and the invoice adjusted.<br>Books being sent at \"NO COST\" or \"OPCIONAL\" may be also discarded and the invoice adjusted.<br/>You do not need to return them to the Miami Address.'+
'</div>'+
'</div>')
$('select#ventas_cliente').on('change',function(){
	var cli=$(this).val(),fec=$('#ventas_fecha').val();
//	var mC=($(this).val()==' CLIENTE:(Llenar Datos)')?1:0;
	if($(this).val()){
		var ventas_data={name:'ventas',fnc:'guardar_ventas',ventas_fecha:fec,ventas_cliente:cli,div:'#workdata'/*,mC:mC*/};
		$('#workdata').load('files/ventas_q.php',ventas_data);
		$(this).val('')
	}
})
$('input#ventas_cliente,textarea#ventas_dirfact').on('change',function(){
	var thisId=$(this).attr('id');
	guardarVenta('ventas','#'+thisId,'update_campo');
})
if($('#ventas_envio').val()>0){
	$('#ventas_subtotal,#ventas_envio').parent().parent().removeAttr('class');
}else{
	$('#ventas_subtotal,#ventas_envio').parent().parent().addClass('prnhide');
}
$('#ventas_envio').on('change',function(){
	var thisval=parseFloat($(this).val());
	if(thisval>0){
		$('#ventas_subtotal,#ventas_envio').parent().parent().removeAttr('class')
	}else{
		$('#ventas_envio').parent().parent().addClass('prnhide')
		if($('#ventas_impuesto').val()==0){
			$('#ventas_subtotal').parent().parent().addClass('prnhide')
		}
	}
	$(this).val(thisval.toFixed(2));
	guardarVenta('ventas','#ventas_envio','update_campo');
	Totalizar();
});
if($('#ventas_impuesto').val()>0){
	$('#ventas_subtotal,#ventas_impuesto').parent().parent().removeAttr('class')
}else{
	$('#ventas_impuesto').parent().parent().addClass('prnhide');
	if($('#ventas_envio').val()==0){
		$('#ventas_subtotal').parent().parent().addClass('prnhide')
	}
}
function changeDate(){
	$('#ventas_fecha').show();
	$('#ventas_fecha_view').hide();
}
function hideDate(){
	var meses=new Array('Ene','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	var new_date=new Date($('#ventas_fecha').val())
	var nuevaFecha=meses[new_date.getMonth()]+' '+(new_date.getDate()+1)+', '+new_date.getFullYear()
	$('#ventas_fecha_view').val(nuevaFecha)
	$('#ventas_fecha_view').show();
	$('#ventas_fecha').hide();
	guardarVenta('ventas','#ventas_fecha','update_campo');
}
$(".send<?PHP echo "$name"?>, .rep<?PHP echo "$name"?>")//muestra las descripciones de lso campos en la barra de descripciones
	.on('focus',function(){
		$('#form-descripciones').html($(this).attr('title'));
	})
	.on('blur',function(){
		$('#form-descripciones').html('');
	})
</script>
