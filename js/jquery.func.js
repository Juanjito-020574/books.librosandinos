/*workareaHeight*/
(function($){
	$.fn.waHeight = function(){
		return this.scroll(function(e){console.log(e)});
	};
})(jQuery);
/*fin workareaHeight*/
/*autoFix*/
(function($){
	$.fn.autoFix = function(){
//		var sel=this;
//		console.log(this)
//		var divTop=this.selector.offset().top;
		this.scroll(function(e){
		var y = this.scrollTop
				console.log(this.scrollTop);
			if(y>0){
				$('#menuBar').css({'position':'fixed','top':'0px','width':'calc(100vw - 15px)'})
				$('#tools .menuFloat').css({'position':'fixed','top':'24px','width':$('#tools .menuFloat').parent().css('width')})
				$('#links .menuFloat').css({'position':'fixed','top':'24px','width':$('#links .menuFloat').parent().css('width')})
		//		$('#pie').css({'position':'relative'})
			}else{
				$('#menuBar,.menuFloat,#pie').removeAttr('style')
			}
		})
	};
})(jQuery);
/*fin autoFix*/
/*buscarX*/
(function($){
	$.fn.accordion = function(){
		var menu = $('li').parent()
		$('#menu>li').hover(function(){
				$(this).find('ul').show();
			}, function() {
				$(this).find('ul').removeAttr('style')
		})
		$('li ul').click(function(){
			$('li ul').removeAttr('style');
		});
	};
})(jQuery);
/*fin buscarX*/
/*inicio registro activo*/
(function($){
	/**
	* addclass active
	*/
$.fn.activeReg=function(){
//	console.log(this);
	return this.on('click',function(e){
		var cod='';
//		$(this).parent().find('.active td:first').html("<img src='images/checkstd.png' height='12px' />");
		$(this).parent().find('.active').removeClass('active');
		if($(this).parent().find('.chkd_').length<1){
			$(this).addClass('active');
			cod=$('tr.active').attr('id').split('|')||'';
		}
//		$(this).find('td:first').html("<img src='images/checkon.png' height='12px' />");
			$('#add>a.habil').attr('onclick',"newData('"+$(this).parents('table').attr('id')+"')");
			$('#edit>a.habil').attr('onclick',"editData('"+$(this).parents('table').attr('id')+"','"+(cod[1]||'')+"')");
			$('#del>a.habil').attr('onclick',"delData('"+$(this).parents('table').attr('id')+"','"+(cod[1]||'')+"')");
//		console.log(cod);
	})
}
})(jQuery);
(function($){
$.fn.checkRow=function(){
//													console.log(this);
	return this.on('click',function(e){
		var r=$(this).attr('src');
		var h=$('#xls a:first').attr('class');
		var c=$(this).attr('class');
//													console.log(c+r);
		if(h=='habil'){
			switch(c+r){
				case 'chkdimages/checkstd.png':
				$(this).attr('src','images/checkon.png');
				$(this).parents('tr').addClass('chkd_');
				break;
				case 'chkdimages/checkon.png':
				$(this).attr('src','images/checkstd.png');
				$(this).parents('tr').removeClass('chkd_');
				break;
				case 'chkdAllimages/checkstd.png':
				$(this).parents('table').find('img.chkd').attr('src','images/checkon.png');
				$(this).attr('src','images/checkon.png');
				$(this).parents('table').find('tbody tr').addClass('chkd_')
				break;
				case 'chkdAllimages/checkon.png':
				$(this).parents('table').find('img.chkd').attr('src','images/checkstd.png');
				$(this).attr('src','images/checkstd.png');
				$(this).parents('table').find('tbody tr').removeClass('chkd_')
				break;
			}
		}
	})
}
})(jQuery);
/*fin registro activo*/
/*campos obligatorios*/
(function($){
$.fn.oblRes = function(clase){

}
})(jQuery);

/*fin campos obligatorios*/
/*filtro para tablas*/
function tableFilter(table_selector, input_selector, search_level, colspan) {

	var table = $(table_selector);
	if(table.length == 0)
		return;

	var input = $(input_selector);
	if(input.length == 0)
		return;

	if(search_level == "undefined" || search_level <= 1)
		search_level = 1;

	if(colspan == "undefined" || colspan < 0)
		colspan = 2;

	$(input).keyup(function(e){
			if(e.keyCode == 8){//keyCode 8 == RETROCESO
				$(table).find('tbody tr').show();
			}
		if($(this).val().length >= search_level) {
			// Ocultamos las filas que no contienen el contenido del edit.
			$(table).find('tbody tr').addClass('_show');
			if($('#select_search').val() == ''){
				$(table).find("tbody tr").not(":contains(\"" + $(this).val() + "\")").hide().removeAttr('class');
			} else {
				$(table).find('tbody td.'+$('#select_search').val()).not(":contains(\"" + $(this).val() + "\")").parent().hide().removeAttr('class');
			}
			// Si no hay resultados, lo indicamos.
			if($(table).find("tbody tr._show").length == 0) {
				$('#msgT').attr('colspan',$(table).find('thead th:visible').length);
				$('#msgT').html('No hay resultados que coincidan con la búsqueda');
			} else{
				$('#msgT').attr('colspan',0)
				$('#msgT').html('');
			}
		} else {
			// Borramos la fila de que no hay resultados.
			$('#msgT').attr('colspan',0)
			$('#msgT').html('');
		}
	$('._show:odd').css('background-color','rgba(157,30,47,0.1');
	$('._show:even').css('background-color','rgba(157,30,47,0.0');
	});
}

jQuery.expr[':'].contains = function(a, i, m) {
return jQuery(a).text().toLowerCase().indexOf(m[3].toLowerCase()) >= 0;
};
/**
* buscar y autocompletar en Ventas
*/
/*(function($){
$.fn.autoComVen = function(){
	return this.on({'keyup':function(e){
//		console.log(e.keyCode);
		e.preventDefault;
		var IDs=$(this).attr('id'),arr=IDs.split('_'),tabla="cepal_stock",input="#"+IDs,
		suger="#suger_"+IDs,value=normalize($(input).val()),cliente=$("#f_ventas #ventas_cliente").val(),
		fact_id=$("#f_ventas #ventas_id").val(),keycod=e.keyCode;
		switch (keycod){
			case 8:
				$(suger).empty()//.hide();
			break;
			case 13:
				var sele=$(suger).find('div.sele'),sel=$(suger).find('.sele span');
				if(sele.length>0){send_tbody(sel),$(suger).empty();
				}else if($(this).val().length>=3){
					$(suger).empty().html('Buscando...').show();
					var datos = {tipo:'SELECT',tabla:tabla,find:value,cliente:cliente,fact_id:fact_id};
					$.ajax({type: "POST",url: "files/partial/findbook.php",data: datos,success: function(message){$(suger).empty();message = message;$(suger).append(message);}
					});
				}else{
					$(suger).empty().html('Escriba al menos tres letras y presione ENTER para buscar');
				}
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
			break;
			case 37:
				$(suger).empty()//.hide();
			break;
			case 39:
				$(suger).empty()//.hide();
			break;
			case 27:
				$(suger).empty()//.hide();
			break;
			default:
				$(suger).empty()//.hide();
			break;
		}
	},
	'blur':function(){
//		$('#suger_'+$(this).attr('id')).empty().hide();
	}})
	$(this).focus()
}
})(jQuery);*/

