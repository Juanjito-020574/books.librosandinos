var carga="<div style='padding:100px 10px 0px;margin:10% auto;color:#FFFFFF'><p>Por favor espere un momento.</p><p>Los datos se están cargando...</p><br /><img src='images/anim.gif'/></div>"
var carga1="<input type='image' src='images/bt_menos.png' style='width:25px;height:25px;float:right;' onclick='closeDw()' />"+carga;
var carga2='<progress value="0" max="100">0%</progress>';
var charge='<progress></progress>';
var httpR,llamada;
//inicio document ready
$(document).ready(function(){
	$('.menu').accordion();
	document.onkeyup=escape;
	$('.table_scroll tbody tr:last-child').find('input').blur();
})//fin document ready

//Incicio de detectParent();
function detectParent(div,content){
	console.log($('#'+div).parent().attr('id'));
	if($('#'+div).parents('#gost').length==0){
		$('#'+div).parent().html(content);
	}
}//fin detectParent;

function historial(elements){
	console.log($(elements));
	$(document).on('click',elements,function(e){
		console.log(this);
		e.preventDefault();
		$(this).hist();
	})

}
function notice(notice){
	var msgOld=$('#notice').html();
	var tm = 5000;
	$('#notice').html('');
	if(msgOld!=notice){
		$('#notice').html(msgOld).fadeOut(1000)
		$('#notice').html(notice).show()
		setTimeout(function(){
			$('#notice').html(msgOld).show()
			$('#notice').html(notice).fadeOut(1000);
		},tm)
	}
}

$(document).on('change','.filtro',function(){
//	console.log($('.filtro'));
	var cpais=$('#paises').val();
	var cgest=$('#gestiones').val().toString();
	if(cpais=='Aa'||cgest=='Aa'){$('#catalogo tr').removeAttr('style').removeClass('_show');}
	$('#catalogo tr').hide().removeClass('_show');
	$('#catalogo tr.'+cpais+'.'+cgest).show().addClass(function(){
		if(cpais!='Aa'||cgest!='Aa'){return '_show'}
	});
//	$('tr').css('background-color','transparent');
	$('._show:odd').css('background-color','rgba(157,30,47,0.1');
	$('._show:even').css('background-color','rgba(157,30,47,0.0');
})

	$(document).on('click','.findToggle',findToggle);
//	$(document).on('change','#f_cepal #12,#f_cepal #18,#f_cepal #30',function(){
//		console.log('para habilitar registros duplicados yo me entiendo');
//	})
	$(document).on('blur focus','#findStock',function(){$(this).val('');});
	$(document).on('mouseout','#suger_findStock .resultado',function(){
		if(!$('#suger_findStock').find('.sele').length){
		$('#form-descripciones').html('Seleccione un elemento para ver su descripción')
		//	console.log($('#suger_findStock').find('.sele').length)
		};
	})
	$(document).on('mouseover','#suger_findStock .resultado',function(){
		var desc=$(this).attr('title')||'No facturado para este cliente';
		if(!$('#suger_findStock').find('.sele').length){
			$('#form-descripciones').html(desc);
		//	console.log($('#suger_findStock').find('.sele').length)
		};
	})
$(document).on('contextmenu','.copyRightClick',function(){var sel=window.getSelection(),range=document.createRange();range.selectNodeContents(this);sel.removeAllRanges();sel.addRange(range);})


function addOferta(cat,id){
	editData(cat,id);
}
//funciones para cargar los formularios Nuevo, Edit, Delete;
function scrollWABody(){
	var cabH=$('#cabecera').height(),footH=$('#pie').height(),sheadH=$('#workarea>.s-head').height(),bodyH=$('html').height();
	var wabodyH=window.innerHeight-(cabH+footH+sheadH+55);
	var wbdy=$('.wabody'),crp=$('#cuerpo');
	var top=(typeof(wbdy[0].scrollTop)!='undefined'?wbdy[0].scrollTop:0);
	if(top>0&&((wbdy[0].scrollHeight)>(wabodyH+cabH))){
		$('#cabecera').slideUp();
		//wbdy.animate({height:(wabodyH+cabH)},0)
		wbdy.height(wabodyH+cabH);
		crp.height('auto');
	}else{
		$('#cabecera').slideDown('normal',function(){$(this).removeAttr('style');});
		//wbdy.animate({height:(wabodyH-cabH)},0)
		wbdy.removeAttr('style');
		crp.removeAttr('style');
	}
}
function remStyleTime(elem,sec){
	setTimeout(function(){
		$('#'+elem).removeAttr('style')
	},(sec*1000))
}
function pad(n, length){
	var  n = n.toString();
	while(n.length < length)
		n = "0" + n;
	return n;
}
function title_(name){
	$('.title').html(name+' www.librosandinos.com');
}
function bodyhide(){
//	$('#gost').hover($('body').css('overflow','hidden'))
}
function closeDw(id){
	if(!id){
		$('#gost').detach();
		$('html').removeAttr('style')
	}else{
		$('#'+id).detach();
		$('#gost2').removeAttr('style');
	}
}
$(document).on('click','#sendmail',function(){
	if(!$(this).attr('checked')||$(this).val()=='no'){
		$(this).val('yes');
		$(this).attr('checked','true');
	}else{
		$(this).val('no');
		$(this).removeAttr('checked');
	}
//	console.log($(this).val());
})
function ficha(id){
	var dts={num:id};
	htmlOverflow();
	if($('#cabecera').prev().attr('id')!='gost'){
		$('#cabecera').before('<div id="gost"><div id="gost2"></div><div id="wd"></div></div>')
		$('#gost>#wd').html(carga1);
		$('#gost>#wd').load('files/record.php',dts);
	}else{
		$('#gost>#gost2').css('z-index','103');
		$('#gost>#wd').before('<div id="workdata_aux"></div>');
		$('#gost>#workdata_aux').html(carga1);
		$('#gost>#workdata_aux').load('files/record.php',dts);
	}
}
function fichaMia(){
	if($('#cabecera').prev().attr('id')!='gost'){
		$('#cabecera').before('<div id="gost"><div id="gost2"></div><div id="wd"></div></div>')
		$('#gost>#wd').html(carga1);
		$('#gost>#wd').load('files/catalogRecord.php');
	}else{
		$('#gost>#gost2').css('z-index','103');
		$('#gost>#wd').before('<div id="workdata_aux"></div>');
		$('#gost>#workdata_aux').html(carga1);
		$('#gost>#workdata_aux').load('files/catalogRecord.php');
	}
}
function newCatOf(name,id){
	var destino='files/list_edit.php';
//	var search='<div id="workdata_search"></div>'
	if($('#cabecera').prev().attr('id')!='gost'){
		$('#cabecera').before('<div id="gost"><div id="gost2"></div><div id="wd"></div></div>')
		$('#gost>#wd').html(carga1);
		$('#gost>#wd').load(destino,{tipo:'nuevo',name:name,id:id});
	}else{
		$('#gost>#gost2').css('z-index','103');
		$('#gost>#wd').before('<div id="workdata_aux"></div>');
		$('#gost>#workdata_aux').html(carga1);
		$('#gost>#workdata_aux').load(destino,{tipo:'nuevo',name:name,id:id,remove:'workdata_aux'});
	}
	htmlOverflow();
}
function newData(name){//function para insertar nuevo Registro;
	if(name.substr(0,2)=='l_'){name=name.substr(2);}
	var destino='files/editDB.php',stl='';
	if(name=='cepal'||name=='cepal_aux'){destino='./files/book_edit.php';}
	if(name=='ventas'){destino='files/ventas_edit.php';}
	if(name=='pedidos_usuario'||name=='pedidos_pais'){destino='files/list_edit.php';}
	if(name=='listas'){destino='files/list_edit.php';}
	if($('#cabecera').prev().attr('id')!='gost'){
		$('#cabecera').before('<div id="gost"><div id="gost2"></div><div id="wd"></div></div>')
		$('#gost>#wd').html(carga1);
		$('#gost>#wd').load(destino,{tipo:'nuevo',name:name});
	}else{
		$('#gost>#gost2').css('z-index','103');
		$('#gost>#wd').before('<div id="workdata_aux"></div>');
		$('#gost>#workdata_aux').html(carga1);
		$('#gost>#workdata_aux').load(destino,{tipo:'nuevo',name:name,remove:'workdata_aux'});
	}
	htmlOverflow();
}
function editData(name,id){//function para editar registro
	if(id){
		if(name.substr(0,2)=='l_'){name=name.substr(2);}
		var destino='files/editDB.php',stl='';
		if(name=='cepal'||name=='cepal_aux'){destino='files/book_edit.php';}
		if(name=='ventas'){destino='files/ventas_edit.php';}
		if(name=='pedidos_usuario'||name=='pedidos_pais'){destino='files/list_edit.php';}
		if(name=='listas'){destino='files/list_edit.php';}
		if(name=='catalogooferta_cepal'){destino='files/list_edit.php';}
		if($('#cabecera').prev().attr('id')!='gost'){
			$('#cabecera').before('<div id="gost"><div id="gost2"></div><div id="wd"></div></div>')
			$('#gost>#wd').html(carga1);
			$('#gost>#wd').load(destino,{tipo:'edit',name:name,id:id});
		}else{
			$('#gost>#gost2').css('z-index','103');
			$('#gost>#wd').before('<div id="workdata_aux"></div>');
			$('#gost>#workdata_aux').html(carga1);
			$('#gost>#workdata_aux').load(destino,{tipo:'edit',name:name,id:id,remove:'workdata_aux'});
		}
		htmlOverflow();
	}else(alert("Debe seleccionar el registro que quiere editar"))
}
function delData(name,id){//function para eliminar registro
	if(id){
		var cmpID;
		if(name.substr(0,2)=='l_'){name=name.substr(2);}
		if(name=='usuarios_cli'){cmpID='usuarios_id';}else{cmpID=name+'_id';}
		var dts={tipo:'DELETE',tabla:name,id:id,};
		dts.query="DELETE FROM "+name+" WHERE "+cmpID+" = '"+id+"'";
//		$('#cabecera').before('<div id="gost"><div id="gost2"></div><div id="workdata"></div></div>')
//		$('#gost>#workdata').html(carga1)
//		$('#gost>#workdata').load('files/sql.php',dts)
		$('#notice').load('files/sql.php',dts)
	}else(alert("Seleccione el registro que desa aliminar"))
}
function editPass(id){//Sirve para mostrar la ventana que cambia la contraseñá del usuario
	if($('#cabecera').prev().attr('id')!='gost'){
		$('#cabecera').before('<div id="gost"><div id="gost2"></div><div id="wd"></div></div>')
	}
	var data = {id:id,
	antPass: $('#newpass_'+id+' #antPass').val(),
	newPass: $('#newpass_'+id+' #newPass').val(),
	newPass2: $('#newpass_'+id+' #newPass2').val(),
	passMail: $('#passMail').val(),
	}
	$('#gost>#wd').html(carga1).load('files/usrpass.php',data);
}
//
function nuevoReg(form){
	var name=$('#'+form).attr('id');//el boton debe ser hijo directo del form
	var data = $('#'+name).find('.send'+form.substr(2));
	var rep = $('#'+name).find('.rep'+form.substr(2));
	var dts = {tipo:'INSERT',tabla:form.substr(2),};
	dts.datas={};
	$.each(data,function(i,v){
		dts.datas[$(v).attr('id')]=$(v).val();
	})
	var cero=''
	$.each(rep,function(i,v){
		if($(v).attr('id')==cero){
			if($(v).val()!=''){
				dts.datas[$(v).attr('id')]+=' | '+$(v).val();
			}
		}else{
			if($(v).val()!=''){
				dts.datas[$(v).attr('id')]=$(v).val();
			}
		}
		cero=$(v).attr('id');
	})
//	alert($('#gost2').css('z-index')+"<"+$('#workdata').css('z-index'))
	if($('#gost2').css('z-index')<$('#wd').css('z-index')){
		$('#gost>#wd').html(carga1);
		$('#gost>#wd').load('files/sql.php',dts);
	}else{
		$('#gost>#workdata_aux').html(carga1);
		$('#gost>#workdata_aux').load('files/sql.php',dts);
	}
}
function editReg(form,id){
	var name=$('#'+form).attr('id');//el boton debe ser hijo directo del form
	var data = $('#'+name).find('.send'+form.substr(2));
	var rep = $('#'+name).find('.rep'+form.substr(2));
//	alert(data.length);
	var dts = {tipo:'UPDATE',tabla:form.substr(2),id:id,};
	dts.datas={};
	$.each(data,function(i,v){
		dts.datas[$(v).attr('name')]=$(v).val();
	})
	var cero=''
	$.each(rep,function(i,v){
		if($(v).attr('id')==cero){
				dts.datas[$(v).attr('id')]+=' | '+$(v).val();
		}else{
			dts.datas[$(v).attr('id')]=$(v).val();
		}
		cero=$(v).attr('id');
	})
//	alert(($('#gost2').css('z-index')<$('#workdata').css('z-index'))+"\n"+form.substr(2))
	if($('#gost2').css('z-index')<$('#wd').css('z-index')){
		$('#gost #wd').html(carga1);
		$('#gost #wd').load('files/sql.php',dts);
	}else{
		$('#gost #workdata_aux').html(carga1);
		$('#gost #workdata_aux').load('files/sql.php',dts);
	}
}
function editBook(form,id){
	var name=$('#'+form).attr('id');//el boton debe ser hijo directo del form
	var data = $('#'+name).find('.send'+form);
	var rep = $('#'+name).find('.rep'+form);
	var dts = {tipo:'UPDATE',tabla:name,id:id,};
	dts.datas={};
	$.each(data,function(i,v){
		dts.datas[$(v).attr('name')]=$(v).val();
	})
	var cero=''
	$.each(rep,function(i,v){
		if($(v).attr('id')==cero){
			if($(v).val()!=''){
				dts.datas[$(v).attr('id')]+=' | '+$(v).val();
			}
		}else{
			dts.datas[$(v).attr('id')]=$(v).val();
		}
		cero=$(v).attr('id');
	})
	if($('#cabecera').prev().attr('id')!='gost'){
		$('#cabecera').before('<div id="gost"><div id="gost2"></div><div id="wd"></div></div>')
	}
	if($('#gost2').css('z-index')<$('#workdata').css('z-index')){
		$('#gost>#wd').html(carga1);
		$('#gost>#wd').load('files/sql.php',dts);
	}else{
		$('#gost>#workdata_aux').html(carga1);
		$('#gost>#workdata_aux').load('files/sql.php',dts);
	}
}
//Fin de carga de formularios Nuevo,Edit,Delete;
/**Funcion para enviar emails*/
function cart_send(){
	if($('#cabecera').prev().attr('id')!='gost'){
		$('#cabecera').before('<div id="gost"><div id="gost2"></div><div id="wd"></div></div>')
	}
	if($('#gost2').css('z-index')<$('#wd').css('z-index')){
		$('#gost>#wd').html(carga1);
		$('#gost>#wd').load('files/cartSend.php');
	}else{
		$('#gost>#workdata_aux').html(carga1);
		$('#gost>#workdata_aux').load('files/cartSend.php');
	}
	htmlOverflow();
}
function aceptar(time){
	!time?time=3000:time;
	$('#gost').detach();
	$('html').removeAttr('style')
	$('#notice').stop().fadeIn(200).delay(time).fadeOut(200);
}

/*Funciones de pedidos revisar*/
function pedidosSave(){
//	console.log(data);
//	$('#notice').load('files/sql.php',{tipo:'pedido',cliente:cliente});
	$('#workarea').html(carga).load('files/sql.php',{tipo:'pedido',clid:$('#pedido_usuarios_id option:selected').val(),clname:$('#pedido_usuarios_id option:selected').text()});
}
$(document).on('change','.pedidos_orden,#pedido_usuarios_id',function(){
	var id=$(this).attr('id');
	var val=$(this).val();
	var data={id:id,val:val};
	if($(this).attr('id')=='pedido_usuarios_id'){
		data.cliente='cliente';
	}
	console.log(data);
	$('#notice').load('files/orders.php',data)
})
function sendMail(form){
	var frm=$("#"+form);
	var cmp = frm.find('.send');
	var sql = frm.find('.sql');
	var dts={tabla:form,};
	$.each(cmp,function(i,v){
		dts[$(v).attr('name')] = $(v).val();
	})
/*	if(sql){
	dts.sql={}
	$.each(sql,function(i,v){
		dts.sql[$(v).attr('name')] = $(v).val();
	})
	}*/
	if(form!='contacto'){
		$('#workdata').html(carga).load('files/sendmail.php',dts);
	}else{
		dts['archivo']=form;
		$('#workarea').html(carga).load('files/sendmail.php',dts);
	}
return false;
}
//fin de send mails
//Login
function log_in(){//función que hace el loggeo al sistema;
	if($('#cabecera').prev().attr('id')!='gost'&&document.getElementById('logg').checkValidity()){
		$('#cabecera').before('<div id="gost"><div id="gost2"><div style="color:#ffffff;">'+carga+'</div></div></div>')
	}
	$('#login').load('files/login.php',{user:$('#user').val(),pass:$('#pass').val(),logg:'login'});
}
function log_off(){//funcion para salir de la zona loggeada;
	if($('#cabecera').prev().attr('id')!='gost'){
		$('#cabecera').before('<div id="gost"><div id="gost2">'+carga+'</div></div>')
	}
	$('#login').load('files/login.php',{logg:'logoff'})
}
/*function canc_rest(){//funcion para cancelar reingreso de pagina;
	unsetCookie('mck');
	window.location.reload();
}
function rest_log_in(){//funcion para restaurar el login
	$('#login').load('files/login.php',{user:$('#user').val(),pass:$('#pass').val(),logg:'login'});
}
// fin login
/**Funcion adfly cart;*/
function addCart(id){
$("#slidingProduct"+id).effect("transfer",{to:$("#cart_shop"),className:"ui-transfer"},500);
$("#carro .anim").html("<img src='images/anim.gif' />");
$('#carro').load('files/cart_add.php',{productId:id,cantidad:1});
}
function remCart(id){
$("#carro .anim").html("<img src='images/anim.gif' />");
$('#carro').load('files/cart_rem.php',{productId:id,cantidad:1});
}
function htmlOverflow(){
	$('html').css('overflow','hidden')
}
function escape(event){
	var keyCode=event.keyCode;
//	console.log(keyCode);
	with (event){
		if(document.activeElement.id=='findStock'){
			event.preventDefault;
			var IDs=document.activeElement.id,
			arr=IDs.split('_'),
			tabla="cepal_stock",
			input="#"+IDs,
			suger="#suger_"+IDs,
			value=normalize($(input).val()),
			cliente=$("#f_ventas #ventas_cliente").val(),
			fact_id=$("#f_ventas #ventas_id").val(),
			cmpID=$(".__id").attr('id'),
			campoVal=$('.__id').val();
if(llamada&&llamada.readyState!=4){
	llamada.abort();
}
			switch (keyCode){
				case 8:
					$(suger).empty().hide();
				break;
				case 13:
					var sele=$(suger).find('div.sele'),sel=$(suger).find('.sele span'),frm=$('#workdata form').attr('id').toString();
					if(sele.length>0){
						if(fact_id){send_tbody(sel)}else if(sel.attr('onclick')){send_tbody_list(sel)};
						$(suger).empty().hide();
					}else if($(input).val().length>=3){
						$(suger).empty().html('Buscando...').show();
						var datos = {tipo:'SELECT',tabla:tabla,find:value,cliente:cliente,cmpID:cmpID,campoVal:campoVal,fact_id:fact_id,form:frm};
						llamada=$.ajax({
							type:"POST",
							url:"files/partial/findbook.php",
							beforeSend: function(data2){
								if(httpR){
								httpR.abort();
								}
							httpR = data2;
							},
							data:datos,
							success:function(message){
								$(suger).empty();$('#findStock').val('')
								message = message;
								$(suger).append(message);
							}

						});
					}else{
						$(suger).empty().html('Escriba al menos tres letras y presione ENTER para buscar');
					}
					$('#form-descripciones').html('Seleccione un elemento para ver su descripcion');
				break;
				case 40:
					var cant=$(suger+' div'),sel=$(suger).find('div.sele')||false;
					if(sel.length<1){$(cant[0]).addClass('sele');
					}else{sel.removeClass('sele');
						if(sel.next().length>0){sel.next().addClass('sele');
						}else{$(cant[0]).addClass('sele');}
					}
					var sH=$(suger),nsel=$(suger).find('div.sele')||false;
					if(nsel){var pos=parseInt(nsel.position().top);
						if(pos<0){sH.scrollTop(sH.scrollTop()+pos)
						}else if((pos+$(sel).height())>200){
							sH.scrollTop(((pos+$(sel).height())-200)+sH.scrollTop())
						}
					}
					var desc=$(suger).find('div.sele').attr('title')||'No facturado para este Cliente';
					$('#form-descripciones').html(desc);
				break;
				case 38:
					var cant=$(suger+' div'),cl=cant.length-1,sel=$(suger).find('div.sele');
					if(sel.length<1){$(cant[cl]).addClass('sele');
					}else{sel.removeClass('sele');
						if(sel.prev().length>0){sel.prev().addClass('sele');
						}else{$(cant[cl]).addClass('sele');}}
					var sH=$(suger),nsel=$(suger).find('div.sele')||false
					if(nsel){var pos=parseInt(nsel.position().top);
						if(pos<0){sH.scrollTop(sH.scrollTop()+pos)
						}else if((pos+$(sel).height())>200){
							sH.scrollTop(((pos+$(sel).height())-200)+sH.scrollTop())
						}
					}
					var desc=$(suger).find('div.sele').attr('title')||'No facturado para este Cliente';
					$('#form-descripciones').html(desc);
				break;
				case 37:
					$(suger).empty().hide();
				break;
				case 39:
					$(suger).empty().hide();
				break;
				case 27:
					$(suger).empty().hide();
				break;
				default:
					$(suger).empty().hide();
				break;
			}


		}else{
			switch(keyCode){
				case 27:
					if(document.activeElement.tagName=='TEXTAREA'||document.activeElement.tagName=='SELECT'||document.activeElement.tagName=='INPUT'&&document.activeElement.id!='findStock'){
	//				alert(document.activeElement.id+' -\n '+$('#gost').attr('id'))

					}else if($('#gost').attr('id')=='gost'){
						$('#gost').detach();
						$('html').removeAttr('style');
					}
				break;
				case 116:
					$('html').detach()
				break;
				default:
				break
			}
		}
	}
}
/*		var fecha=new Date();
		var mes=fecha.getMonth()
		fecha.setMonth(mes+1);

		alert(fecha+" - ");

/**Funcion Set Cookie*/
function setCookie(name,value,/**in miliseconds*/expire){
	expires=new Date();
	if(!expire){
		expires.setMonth(expires.getMonth()+1)
	}else{
		expires.setTime(expires.getTime()+expire);
	}
	cookie=name+"="+value+";expires="+expires.toUTCString()+";path='/'";
	return document.cookie=cookie;
}
function unsetCookie(name){
	expires=new Date();
	expires.setTime(expires.getTime()-(60*60*24*1000));
	cookie=name+"=;expires="+expires.toUTCString()+";path='/'";
	return document.cookie=cookie;
}
function readCookie(name){
	if(!name){sn=true;name='mck';}else{sn=false;}
	cookie=document.cookie;
	cookies=cookie.split('; ');
	var ck={};
	ck[name]={}

	for(var i=0;i<cookies.length;i++){
		key=cookies[i].split('=');
		ind=key[0];val=key[1];
		ci=cookies[i]
		key0=ci.match("(^[a-zA-Z0-9]+)\\\[(.*)\\\]");
		if(key0&&(key0[1]==name||sn)){
			ind0=ind.split('[');
			i00=key0[1];i01=key0[2] ;
			ck[name][i01]=val;
		}else if(ind==name||sn){
			ck[ind]=val;
		}
	}
//	console.log(ck);
	return ck;
}
//function
//End funcion Cookies
/**Funcion menus history*/
function menu(inicio){//----------------inicio menu-------------------
	var destino = "#workarea";
if(llamada&&llamada.readyState!=4){
	llamada.abort();
}
	$(document).on('click',inicio, function(e) {
		e.preventDefault;
		$(destino).html(carga);
		switch($(this).attr('class')){
			case 'a':
			if (!$(this).attr('href')){
				page=decodeURIComponent(window.location.hash);
			}else{
				page=decodeURIComponent($(this).attr("href"));
			}
//alert(page)
			break;
			case 'submit':
				page=$(this).parent().attr('action');
				form=$(this).parent().attr('id');
				var hash = window.location.hash.substr(1);//alert(hash)
				if($('#'+form).attr('method')=='get'){
				}
			break;
		}
		$.history.load(page);
		return false;
	});
	function loadGET(page) {
		$(destino).html(carga);
		page=page.replace(/(.*)\.html(.*)/,'files/$1.php$2');
		$.ajax({
			url:page,
			type:'get',
			success: function(){$(destino).load(page)},
			error: function(){$(destino).load('files/vacio.php')}
		});
	}
	opciones=$.browser.mozilla?{}:{unescape : "/?áäàéëèíïìóöòúüù&"};
	$.history.init(function(page) {
		loadGET(page == "" ? "novelties.html" : page);
	},opciones);

}; //--------------fin menu-------------

function gostChau(){
/*	var ckie=readCookie(),a={length:0};
	$.each(ckie,function(i,v){
		if(i!='mck'&&i!='PHPSESSID'){
			a[i]=v.split('law1024');
			a.length++;
		}
	})
	console.log(ckie.mck+'-'+ckie.PHPSESSID);console.log(ckie);
	if(a.length>0&&ckie.mck!=ckie.PHPSESSID){
		$('#login').css('z-index',parseInt($('#gost').css('z-index'))+1)
		$('#gost2').html('<div class="gostNotice">'+
		'<p>¡¡'+a[ckie.mck][1]+' no ha cerrado la anterior sesion!!.</p>'+
		'<p>Es posible que haya cerrado el navegador sin cerrar su session.</p>'+
		'<p>Para restaurar su sesion escriba la contraseña y haga click en acceder.</p>'+
		'<p>Si usted no es "'+a[ckie.mck][1]+'" haga click en cancelar</p>'+
		'<a class="boton" id="clgost">cancelar</a></div>')
	}else{*/
		$('#gost').detach();
		$('body').removeAttr('onload');
//	}
}
var normalize = (function() {
	var	from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç",
			to   = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuuNnCc",
			mapping={};
	for(var i=0,j=from.length;i<j;i++ )
		mapping[from.charAt(i)]=to.charAt(i);
	return function(str){
		var ret=[];
		for(var i=0,j=str.length;i<j;i++){
			var c=str.charAt(i);
			if(mapping.hasOwnProperty(str.charAt(i)))
				ret.push(mapping[c]);
			else
				ret.push(c);
			}
		return ret.join('');
	}
})();
function oc(){
	alert('cerrando');
	window.close;
}

// funciones para find
$(document).on('click','#advFind .tabTit>div',function(){
	$(this).parent().find('.select').removeClass('select');
	$(this).addClass('select');
	$('.tabView').find('div.use').removeClass('use');
	$('.tabView').find('.'+$(this).attr('id')).addClass('use');
/*	if($(this).attr('id')!='libros'){
		window.history.pushState('','','#list_'+$(this).attr('id')+'.html');
	}else{
		window.history.pushState('','','#find.html')
	}*/
})
function findToggle(){
	$('#fastFind,#advFind').slideToggle();
	$('#titleFast,#titleAdv,#toggleFast,#toggleAdv').toggle();

}
$(document).on('submit','#buscarF,#buscarA,#buscarB,#buscarC',function(e){
		e.preventDefault();
		console.log(e);
		return false;
	})
function findFast(el){
	var form=$(el).parents('form');
	var formId=form.attr('id');
	var act,get='&',cam=$('#'+formId+' .send'),actenc='';
	$.each(cam,function(i,v){
		if($(v).val()){
			get+="datos["+$(v).attr('id')+"]="+$(v).val();
		}
	})
	get=normalize(get.replace(/[\s]+/g,'+'));
	act='num=1&f='+formId.replace('buscar','')+get;
	actenc=encodeURIComponent(act);
	if(window.location.hash!="find.html?"+actenc){
//		var href="librosandinos.com/find.html?"+actenc;
//		var stt=chainState(href);
//		console.log(stt)
//		window.history.pushState(stt,null,stt.url+'.html'+(stt.prm?'?'+stt.prm:''));
		window.location.assign("find.html?"+actenc);
	}else{
		$('#workarea').load('files/find.php?'+act);
	}
}
function findAdv(formId){
	var cam=$('#'+formId+' .send'),tabla=$('#'+formId).parent().attr('id').toString().substr(2),

	dts={findInto:1,data:{}},act='',actenc='';
	$.each(cam,function(i,v){
		if($(v).val()){
			dts.data[$(v).attr('id')]=normalize($(v).val());
		}
	})
	act=decodeURIComponent($.param(dts));
	actenc=encodeURIComponent(act);
	console.log(actenc)
				$('#workarea').html(carga).load('files/list_'+tabla+'.php',dts,function(req){if(req.slice(0,15)=='<!DOCTYPE html>'){$(this).load('files/vacio.php')}})

/*	if(window.location.hash!="#list_"+tabla+".html?"+actenc){
		llamada=window.location.assign("#list_"+tabla+".html?"+actenc);
		llamada.abort();
	}else{
		$('#workarea').html(carga2).load('files/list_'+tabla+'.php?'+act);
	}
	*/
//	console.log(dts);

}
//fin de funciones para find
/** Backaup ISO*/
function backiso(){
	window.open('files/catalogsIso.php','Iso.Application',"toolbar=no,menubar=no,location=no");
}
// fin backup ISO
/** funciones de exportacion*/
function excelexp(tId){
//	tId=tId||undefined;
console.log(tId);
	var cam='',ct='',id='';
	var chkd=$('.wabody table tbody tr.chkd_');
	var tbl=$('.wabody table').attr('id');
	if(typeof(tId)!='undefined'&&tId.match(/^catalogo\-/)){tbl='l_catalogo';}
	switch(tbl){
		case 'l_ventas':id='voucher';orden='`voucher`,`orden`';columns='`voucher`,`invoice`,`fecha`,`orderNo`,`autor`,`titulo`,`editorial`,`cantidad`,`precioUnit`,`total`,`cliente`';break;
		case 'l_catalogo':id='catalogo';orden='`catalogo`,`codigo`,`orderMat`,`orden`';columns='`codigo`,`autor`,`titulo`,`editor`,`editorial`,`coleccion`,`ciudad`,`paginas`,`fecha`,`ISBN`,`p_compra`,`p_venta`';break;
		case 'l_usuarios_cli':id='id';orden='`cliente`';columns='`cliente`,`mail`,`web`,`nombres`,`apellidos`,`empresa`,`dirInvoice`,`telefono`,`direccion`,`ciudad`,`pais`',tbl='l_clientes';break;
		default:
		$('#'+tbl).attr('class');
		break;
	}
	var aa={};
	if(typeof(tId)==='undefined'||!tId){
		$.each(chkd,function(i,v){
			//id=$(v).attr('id').replace(/^([a-z0-9_]+)\|.*/ig,'$1');
			ct+=$(v).attr('id').replace(/^[a-z_]*\|([0-9a-z_\\s]+)$/ig,'$1').replace(/^0+/,'')+'|';
			aa[$(v).attr('id')]=$(v).attr('id');
		})
		cam='&'+id+'='+ct.slice(0,-1)
//			console.log(aa);
	}else if(tId.match(/^catalogo-/g)){
		cam='&'+id+'='+tId.replace('catalogo-','');ct=cam;
	}else{
		cam='&'+id+'='+tId.replace(/^0+/,'');ct=cam;
	}
	cam=cam+'&tId='+id+'&orden='+orden+'&columns='+columns;
//	console.log(cam);
	if(ct){
		window.open('files/excel_all.php?view=_'+tbl.substr(2,3)+cam,tbl.substr(2),"toolbar=no,menubar=no,location=no");
	}else{
		alert('Marque el cuadro que hay en el lado izquierdo del registro o registros que quiere exportar a excel.')
	}
}
