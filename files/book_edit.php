<?PHP
if(!function_exists('include_if_exists')){include('../system/functions.php');};$nivMin = 3;
include('../system/verif_user.php');
if(!isset($_SESSION))session_start();
extract($_REQUEST);
						//										print_r($_REQUEST);
$cmpID='id';$id=(isset($id)?$id:0);
$$name=new DataBase("$name");
$$name->where="$cmpID = '$id'";
$$name->_query('SELECT');
					//											print_pre($$name->q_desc);
$row=$$name->q_fetch_assoc;
extract($$name->q_desc);
include('partial/tablas.php');
$input='';
foreach($dataType as $i=>$v){
	include('partial/formType.php');
}
						//										print_pre($attr);
?>
<div id="workdata_search">
<header class="s-head">Registro y Edición de Libros</header>
<div class="form-botones">
	<input form="f_<?PHP echo $name;?>" type="submit" class="boton" style="margin-bottom:10px;" onclick="validar(f_<?PHP echo $name?>)" value="Guardar" />
	<input form="f_<?PHP echo $name;?>" type="button"  class="boton" style="margin-bottom:10px;" onclick="closeDw()" value="Salir" />
</div>
<?PHP if($tipo=='nuevo'&&$name=='cepal'){?>
<div id="fichaAlfredo">
	<div class="label">Ficha don Alfredo</div>
	<div id="alfredo"></div>
</div>
<?PHP }?>
<div id="form-descripciones" class="s-foot">Ver descripciones</div>
</div>
<div id="workdata">
<form id="f_<?PHP echo $name;?>" novalidate="" action="javascript:void(0)" method="post">
	<?PHP echo $input;?>
</form>
</div>
<script type="text/javascript">
<?PHP if($tipo=='nuevo'&&$name=='cepal'){?>
$(document).on('change','#10,#16,#12,#18,#30,#32,#31,#35,#38,#39,#41,#43,#47,#20,#71,#72,#98,#99,#100,#101,#102,#103,#114',fichAlfred)
fichAlfred();
$('#102').on('focus',function(){
	var pc=($('#101').val())/($('#99').val());
	$(this).val(parseFloat(pc).toFixed(2));
	fichAlfred();
})
function fichAlfred(){
	var _aut=($('#10').val()+$('#16').val()!=''?$('#10').val()+$('#16').val()+'. ':'');
	var _tit=($('#12').val()+$('#18').val()+$('#30').val()!=''?'<span style="font-weight:bold;text-transform:uppercase;">'+$('#12').val().replace(/[<>]/g,'')+$('#18').val().replace(/[<>]/g,'')+$('#30').val().replace(/[<>]/g,'')+'.</span> ':'');
	var _titNR=($('#32').val()!=''?$('#32').val()+'. ':'');
	var _titVR=($('#31').val()!=''?$('#31').val()+'. ':'');
	var _edt=($('#38').val()!=''?$('#38').val()+'. ':'');
	var _ciu=($('#39').val()!=''?$('#39').val()+'. ':'');
	var _edc=($('#41').val()!=''?$('#41').val()+'. ':'');
	var _año=($('#43').val()!=''?$('#43').val()+'. ':'');
	var _issn=($('#35').val()!=''?'ISSN:'+$('#35').val()+'. ':'');
	var _isbn=($('#47').val()!=''?'ISBN:'+$('#47').val()+'. ':'');
	var _med=($('#111').val()!=''?'('+$('#111').val()+') ':'');
	var _pag=($('#20').val()!=''?$('#20').val()+'Pág. ':'');
	var _resC=($('#71').val()!=''?$('#71').val()+'. ':'');
	var _resT=($('#72').val()!=''?$('#72').val()+'. ':'');
	var _stk=($('#114').val()>0?'<br />Stock: <span style="font-size:20px;">'+$('#114').val()+'+ </span>':'');
	var prc0=($('#98').val()!=''?'<tr><td class="rgt">Descto:</td><td class="flt">'+$('#98').val()+'</td></tr>':'');
	var prc1=($('#99').val()>0?'<tr><td class="rgt">TC:</td><td class="flt">'+parseFloat($('#99').val()).toFixed(2)+'</td></tr>':'');
	var prc2=($('#100').val()>0?'<tr><td class="rgt">P.CMN s/d:</td><td class="flt">'+parseFloat($('#100').val()).toFixed(2)+'</td></tr>':'');
	var prc3=($('#101').val()>0?'<tr><td class="rgt">P.CMN c/d:</td><td class="flt">'+parseFloat($('#101').val()).toFixed(2)+'</td></tr>':'');
	var prc4=($('#102').val()>=0?'<tr><td class="rgt">P.Neto:</td><td class="flt">'+parseFloat($('#102').val()).toFixed(2)+'</td></tr>':'');
	var prc5=($('#103').val()>0?'<tr><td class="rgt">P.Venta:</td><td class="flt">'+parseFloat($('#103').val()).toFixed(2)+'</td></tr>':'');
	var _prc='<span style="float:right;width:50%"><table class="simple">'+prc0+prc1+prc2+prc3+prc4+prc5+'</table></span>';
	var ficha=_aut+_tit+_titNR+_titVR+_edt+_ciu+_año+_pag+_edc+_resC+_resT+_issn+_isbn+_med+_stk+_prc;
	$('#fichaAlfredo #alfredo').html(ficha);
/*	if(($(this).attr('id')=='16'||$(this).attr('id')=='18'||$(this).attr('id')=='30')&&<?PHP echo "'$sUs_usuarios_nick'"?>=='sadmin'){
		search_titulos($(this).attr('id'),$(this).val());
	}*/
}
var fichas=new fichasLibros('<?PHP echo $sUs_usuarios_nick;?>');
fichas.init('fichasMiami',1);
//console.log(fichas);
<?PHP }?>
//bodyhide();
function search_titulos(campo,find){
	console.log(titulo)
	$('#'+campo).parent().append("<div id='_titulo_search'></div>")
	var suger='#_titulo_search';
	var datos = {tipo:'SELECT',tabla:'cepal',find:find,campo:campo};
	llamada=$.ajax({
		type:"POST",
		url:"files/partial/findbookTit.php",
		beforeSend: function(data2){
			if(httpR){
			httpR.abort();
			}
		httpR = data2;
		},
		data:datos,
		success:function(message){
			$(suger).empty();
			message = message;
			$(suger).append(message);
		}

	});
}
function fechaiso(fecha){
	var fechanorm = $(fecha).val();
//	console.log(fechanorm);
	$('#44').val($(fecha).val().replace(/-/g,''));
}
function autonew(imagen){
	var campo=$(imagen).parent().parent().find(':input');
	var valor='';
	$(campo).each(function(i,v){
		sep=i!=0?' | ':'';
		valor+=sep+$(v).val();
	})
//	alert(campo.attr('id')+'--'+valor);
	if($(imagen).attr('src')=='images/checkstd.png'){
		if(valor==''){
			alert('No puede guardar como plantilla un campo vacío')
		}else{
			$(imagen).load('files/partial/predet.php',{campo:campo.attr('id'),valor:valor});
			$(imagen).attr('src','images/checkon.png');
		}
	}else if($(imagen).attr('src')=='images/checkon.png'||$(imagen).attr('src')=='images/checkoff.png'){
		if(confirm('Desea borrar los valores por defecto para este campo?')){
			if($(campo).attr('class')=='repcepal'){
				$(campo).parent().parent().find('div').not(':first').detach()
				$(campo).parent().find('img:first').attr({src:'images/bt_mas.png',onclick:'addRep("'+$(campo).parent().attr('id')+'")'}).css('cursor','pointer');
			}
			$(campo).val('');
//			alert(window.applicationCache)
		$(imagen).load('files/partial/predet.php',{campo:campo.attr('id'),valor:valor,unset:'unset'});
		$(imagen).attr('src','images/checkstd.png');
		}
	}
}
$(document).on('change','.repcepal.47',barcode)
function barcode(){
	var _47=$('.repcepal.47');
	var valor='';
	_47.each(function(i,v){
		valor+=' '+$(v).val().replace(/(^[-\dBOX]{0,20}).*/ig,'$1');
	})
	$('#123').val(valor.replace(/^\s*|-|\s*$/ig,''));
}
$("#122").attr("onchange","_cat(this)");
var DR91=$('#91').parent().parent().find('input:last');
if(DR91.val()!='<?PHP echo $predet['91']?>'){
//	$('#91').parent().parent().parent().hide();
	if(DR91.val()){
		addRep(DR91.parent().attr('id'));
	}
	$('#91').parent().parent().find('input:last').val('<?PHP echo $predet['91']?>');
	$('#4').focus();
}
//$("#91").parent().parent().parent().css('display','none');
var fid='<?PHP echo $name;?>';
$('form#f_'+fid+' :input').not(':button,:submit,:image').attr('onblur','validar_campo(this)')
function validar_campo(v){
	if(!v.validity.valid){
		$(v).css('background-color','#FDD5F0');
	}else{
		$(v).removeAttr('style');
	}
}
var inputs=$('form#f_'+fid+' :input').not(':button,:submit,:image');
function validar(form){
	var valido=form.checkValidity()
	if(valido){
		<?PHP
		if($tipo=='nuevo'&&$name=='cepal'){
			echo "fichas.add('$sUs_usuarios_nick');\n";
		}
		echo $tipo."Reg('f_".$name."'".($tipo!='nuevo'?",'$id'":'').")";?>;
	}else{
		$.each(inputs,function(i,v){
			if(!v.validity.valid){
				$(v).css('background-color','#FDD5F0');
			}
		})
		$('#login').load('files/login.php',{msgUsr:"Llene correctamente los campos resaltados como se muestra en las descripciones"});
	}
}
function _cat(e){
	var code=$(e).val().substr(0,1);
	switch(code){
		case 'B':$("#40").val("Bolivia");$("#82").val("BO");break;
		case 'C':$("#40").val("Colombia");$("#82").val("CO");break;
		case 'H':$("#40").val("Chile");$("#82").val("CL");break;
		case 'E':$("#40").val("Ecuador");$("#82").val("EC");break;
		case 'P':$("#40").val("Perú");$("#82").val("PE");break;
		case 'V':$("#40").val("Venezuela");$("#82").val("VE");break;
		default:$("#40").val("");$("#82").val("");break;
	}
}
$(document)//muestra las descripciones de los campos en la barra de descripciones
	.on('focus',".send<?PHP echo "$name"?>, .rep<?PHP echo "$name"?>",function(){
		$('#form-descripciones').html($(this).attr('title'));
	})
	.on('blur',".send<?PHP echo "$name"?>, .rep<?PHP echo "$name"?>",function(){
		$('#form-descripciones').html('');
	})
var dpnd=$('.dependiente');
deps();
function deps(){//tratar de mejorar esta parte talvez con find o con data
//	alert($('#'+id).val())
	$(dpnd).removeAttr('style');
	$(dpnd).each(function(i,v){
		var valueDp=$(v).attr('value');
		var ancesDp=$(v).attr('ances');
		var re=new RegExp("["+$('#'+ancesDp).val()+"]",'g');
		var strg=valueDp.match(re);
	//	alert($('#'+ancesDp).val()+'-'+valueDp+'-'+strg+'\r\n\r\n'+$(v).html())
		if($('#'+ancesDp).val()!=strg){
			$(v).css('display','none');
			$(v).find('input').removeAttr('required').val('');
		}else{
			switch ($('#4').val()){
				case 'A':$('#12').attr('required','');break;
				case 'M':$('#18').attr('required','');break;
				case 'S':$('#30').attr('required','');break;
			}
		}
//		$('#'+ancesDp).attr('onchange','deps("'+$('#'+ancesDp).attr('id')+'")');
	})
}
function addRep(rep){
	var thisId=rep.split('_');
//	console.log(thisId);
	var newId=thisId[0]+"_"+thisId[1]+"_"+(parseInt(thisId[2],10)+1);
	if($('#'+rep+' input').eq(0).val()!=''){
	$('#'+rep).after('<div id="'+newId+'">'+(thisId[2]==0?'<hr style="margin:5px 0 2px 0;" />':'')+$('#'+rep).html()+'</div>');
	$('#'+rep+' img').eq(0).attr({src:'images/bt_disabled.png'}).css('cursor','text').removeAttr('onclick');
	$('#'+newId+' input').eq(0).attr({name:thisId[1]+'['+(parseInt(thisId[2],10)+1)+']',value:''});
	$('#'+newId+' img').eq(0).attr({id:'add'+thisId[1]+'_'+(parseInt(thisId[2],10)+1),onclick:'addRep("'+newId+'")'});
	$('#'+newId+' img').eq(1).attr({id:'rem'+thisId[1]+'_'+(parseInt(thisId[2],10)+1),onclick:'remRep("'+newId+'")',src:'images/bt_menos.png'}).removeAttr('disabled').css('cursor','pointer');
	$('#'+newId+' input').focus();
	}else{
		alert('CAMPO VACIO\nNo puede aumentar campos sobre un campo vacio. '+rep)
	}
}
function remRep(rep){
	var thisId=rep.split('_');
	var last=$('#'+rep).parents();
	$('#'+rep).detach()
	last.find('div:last img').eq(0).attr({src:'images/bt_mas.png',onclick:'addRep("'+last.find('div:last').attr('id')+'")'}).css('cursor','pointer');
	if(thisId[1]=='47'){barcode()}

}
$(document).on('change','#48,#99,#100,#101,#102,#103',function(){
	var num=parseFloat($(this).val()).toFixed(2);
	$(this).val(num);
})
</script>
