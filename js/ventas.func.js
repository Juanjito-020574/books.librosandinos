function hideprnhide(){
	var view=$('#ventas_view').val().toString();
	var fin=view.substr(1);
	if($('#hideprnhide').html()=='-'){
		$('#ventas-ed .prnhide').hide();
		$('#hideprnhide').html('+');
		$('#ventas_view').val('0'+fin)
	}else{
		$('#ventas-ed .prnhide').removeAttr('style');
		$('#hideprnhide').html('-');
		$('#ventas_view').val('1'+fin)
	}
	guardarVenta('ventas','#ventas_view','update_campo')
}
function saveATP(id){
	var regVal=$('#'+id).parent().parent().find('td:last input');
	var v_id=parseInt($('#ventas_id').val(),10);
	$('#temporal').load('files/ventas_q.php',{name:'ventas_detalle',campoVal:$('#'+id).val(),campoName:$('#'+id).attr('class'),regId:$(regVal).attr('class'),regVal:$(regVal).val(),fnc:'update_campo',noscript:v_id});
}
function saveATP_list(name,campoName,campoVal,regId,regVal){
	var data={name:name,campoVal:campoVal,campoName:campoName,regId:regId,regVal:regVal,fnc:'update_campo',noscript:regId}
	$('#temporal').load('files/ventas_q.php',data);
}
function cantidad_ed(id){
	$('.suger').hide();
	$('#'+id).focus();
	var c_r=parseInt($('#'+id).val(),10);
	$('#'+id).val(c_r+1);
	saveCP(id)
}
function saveCP(id){
	var cepal_id=id.split('_');
	$('#total_'+cepal_id[1]).focus();
	var regVal=$('#'+id).parent().parent().find('td:last input');
	var tr=parseInt($('#cantidad_'+cepal_id[1]).val(),10)*parseFloat($('#precio_'+cepal_id[1]).val());
	var val=$('#'+id).val(),valor;
	var oldtot=parseFloat($('#total_'+cepal_id[1]).val()),newtot,tbook;
	switch($('#'+id).attr('class')){
		case 'detalle_cantidad':
		valor=parseInt(val,10);
		$('#'+id).val(valor);
		break;
		case 'detalle_precio':
		valor=parseFloat(val);
		$('#'+id).val(valor.toFixed(2));
		break;
	}
	$('#total_'+cepal_id[1]).val(tr.toFixed(2))
	newtot=parseFloat($('#total_'+cepal_id[1]).val());
	tbook=(parseFloat($('#ventas_tbook').val())-oldtot)+newtot;
	$('#ventas_tbook').val(tbook.toFixed(2))
	Totalizar();
	var v_id=parseInt($('#ventas_id').val(),10);
	$('#temporal').load('files/ventas_q.php',{name:'ventas_detalle',campoVal:$('#'+id).val(),campoName:$('#'+id).attr('class'),regId:$(regVal).attr('class'),regVal:$(regVal).val(),fnc:'update_campo',id:v_id});
};
function send_tbody(dato){
	var ventas_id=parseInt($('#ventas_id').val(),10);
	var cepal_id=$(dato).parent().attr('id').substr(7);
	var tabla="#ventas-ed tbody";
	$(tabla).parent().find('thead tr:first-child th:first-child').html('<img src="images/anim.gif" />')
	$('#temporal').load('files/ventas_q.php',{name:'ventas_detalle',ventas_id:ventas_id,cepal_id:cepal_id,div:tabla,fnc:'guardar_registro'});
	$('.suger').empty().hide();
	var desc='seleccione un elemento para ver su descripcion';
	$('#form-descripciones').html(desc);

}
//enviar a tbody otras tablas que no son ventas
function send_tbody_list(dato){
//	console.log(dato);
	var cmpID=$('.__id').attr('id');
	var cmpVal=$('.__id').val();
	var cepal_id=$(dato).parent().attr('id').substr(7);
	var tabla=$('#workdata form').attr('id').toString().substr(2);
	var div=".list-ed tbody";
	$(div).parent().find('thead tr:first-child th:first-child').html('<img src="images/anim.gif" />')
	$('#temporal').load('files/ventas_q.php',{name:'list_detalle',campo_id:cmpID,id_val:cmpVal,cepal_id:cepal_id,div:div,tabla:tabla,fnc:'guardar_registro_all'});
	$('.suger').empty().hide();
}
function ocultarVentasIDat(idHide,idThis){
	var lbl=$('#'+idThis).parent().find('label').html(),lgt=$('#'+idHide).length,last=$('#'+idHide)[lgt-1];
	if($('#'+idThis+' img').attr('src')=='images/prnon.png'){
//	console.log(lbl);
//	console.log($(last).attr('id'))
		if($(last).attr('id')=='ventas_fact'&&lbl=='Voucher No.:'){
			$('#'+idThis).parent().find('label').html('Invoice No.:');
		}
		$('#'+idHide).addClass('prnhideDoble');
		$('#'+idThis+' img').attr({'src':'images/prnoff.png','title':'haga click para ocultar este campo en la impresion'});
	}else{
		if($(last).attr('id')=='ventas_fact'&&lbl=='Invoice No.:'&&$(last).val()<=0){
			$('#'+idThis).parent().find('label').html('Voucher No.:');
		}
		$('#'+idHide).removeClass('prnhideDoble');
		$('#'+idThis+' img').attr({'src':'images/prnon.png','title':'Haga click para ocultar este campo en la impresion'});
	}
}
function ocultarVentasEd(clase,cmb){
	if($('#'+clase+' img').attr('src')=='images/prnon.png'){
		$('#ventas-ed,.tfoot, table.list-ed').find("."+clase).addClass('prnhide');
		$('#'+clase+' img').attr({'src':'images/prnoff.png','title':'Haga click para mostrar esta columna en la impresion'});
	}else{
		$('#ventas-ed,.tfoot, table.list-ed').find("."+clase).removeClass('prnhide');
		$('#'+clase+' img').attr({'src':'images/prnon.png','title':'Haga click para ocultar esta columna en la impresion'});
	}
	if(!cmb){
		var chl=parseInt($('#'+clase).attr('title'),10);
		var views=$('#ventas_view').val().toString();
		var ini=views.substr(0,chl);
		var mid=views.substr(chl,1)==0?1:0;
		var fin=views.substr(chl+1);
//		console.log(ini+' '+mid+' '+fin);
		$('#ventas_view').val(ini+''+mid+''+fin)
		guardarVenta('ventas','#ventas_view','update_campo')
	}
}
function guardarVenta(name,campo,fnc){
	var regVal=parseInt($('#ventas_id').val(),10);
	var regId=$('#ventas_id').attr('id');
	$('#temporal').load('files/ventas_q.php',{ventas_id:regVal,name:name,campoVal:$(campo).val(),campoName:$(campo).attr('id'),regId:regId,regVal:regVal,fnc:fnc});
}
function ventasDiscount(){
	var vtbook=parseFloat($('#ventas_tbook').val());
	var vperc=parseFloat(($('#ventas_porcentaje').val()/100));
	$('#ventas_discount').val((vtbook*vperc).toFixed(2));
	$('#ventas_porcentaje').parent().parent().find('span:first').html((vperc*100).toFixed(1));
	guardarVenta('ventas','#ventas_porcentaje','update_campo');
	guardarVenta('ventas','#ventas_discount','update_campo');
	Totalizar();
	if(vperc>"0.00"){
		$('#ventas_tbook,#ventas_discount').parent().parent().removeAttr('class')
	}else{
		$('#ventas_tbook,#ventas_discount').parent().parent().addClass('prnhide')
	}
}
function ventasTaxes(){
	var vstot=parseFloat($('#ventas_subtotal').val());
	var vtax=parseFloat($('#ventas_taxes').val())
	var vtaxPerc=parseFloat(($('#ventas_taxes').val()/100));
	$('#ventas_impuesto').val((vstot*vtaxPerc).toFixed(2));
	$('#ventas_taxes').parent().parent().find('span:first').html((vtax.toFixed(2)));
	guardarVenta('ventas','#ventas_taxes','update_campo');
	guardarVenta('ventas','#ventas_impuesto','update_campo');
	Totalizar();
	if(vtax>0){
		$('#ventas_subtotal,#ventas_impuesto').parent().parent().removeAttr('class')
	}else{
		$('#ventas_impuesto').parent().parent().addClass('prnhide')
		if($('#ventas_envio').val()==0){
			$('#ventas_subtotal').parent().parent().addClass('prnhide')
		}
	}
}
function Totalizar(){//funcion para retornar los totales en ventas
	var vtbook=parseFloat($('#ventas_tbook').val());
	var vperc=parseFloat(($('#ventas_porcentaje').val()/100));
	var vdisco=parseFloat(vtbook*vperc);
	var vsubto=vtbook-vdisco;
	var vtaxes=parseFloat(($('#ventas_taxes').val()));
	var vimpue=parseFloat(vsubto*(vtaxes/100))
	var venvio=parseFloat($('#ventas_envio').val());
	var vtotal=vsubto+vimpue+venvio;
	$('#ventas_discount').val(vdisco.toFixed(2));
	$('#ventas_subtotal').val(vsubto.toFixed(2));
	$('#ventas_impuestos').val(vimpue.toFixed(2));
	$('#ventas_total').val(vtotal.toFixed(2));
//console.log(vtotal);
}
(function($){
	$.fn.setTextareaHeight=function(){
		return this.each(function(){
			var ta=$(this),tar=ta.attr('rows'),ih=parseInt(ta.height()/tar),
			sh=parseInt(ta[0].scrollHeight),h=sh/ih;
			// init height
			$(this).attr('rows',parseInt(h));
			ta.on({
				'keyup':function(){
					ta.attr('rows',tar);
					sh=parseInt(ta[0].scrollHeight);
					h=sh/ih;
					ta.attr('rows',parseInt(h));
					},
				'focus':function(){
					ta.parent().css({'overflow':'hidden','max-height':'none'});
				},
				'blur':function(){
					ta.parent().removeAttr('style')
				}
//			console.log('ih: '+ih+'\nsh: '+sh+'\ntar: '+tar+'\nh: '+h);//+'\nnh: '+nh+'\nnsh: '+nsh)

			});
		})
	}
})(jQuery);
