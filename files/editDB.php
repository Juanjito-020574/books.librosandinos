<?PHP
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
include($ruta.'system/functions.php');$nivMin=1;
include($ruta.'system/verif_user.php');
if(!isset($_SESSION))session_start();
?>
<div id="workdata">
<?PHP extract($_REQUEST);
				//								print_pre($_REQUEST);
switch($name){
	case 'cepal':
		$cmpID='id';
	break;
	case 'user_data':
		$cmpID='usuarios_id';
	break;
	case 'usuarios_cli':
		if($id<10)$name="user_data";
		$cmpID='usuarios_id';
	break;
	case 'catalogo':
		$cmpID='cat';
	break;
	default:
		$cmpID=$name.'_id';
	break;
}
$$name=new DataBase("$name");
($tipo=='edit'?$$name->where="$cmpID = '$id'":"");
$$name->limit='3';
$$name->_query('SELECT');
$row=$$name->q_fetch_assoc;
				//							print_pre($$name->q_desc);
extract($$name->q_desc);
					//						echo $$name->q_query;
					//						echo $sUs_usuarios_nick;
if(isset($row['usuarios_nick'])&&$row['usuarios_nick']==$sUs_usuarios_nick&&$name!='pedidos'){
	$edit['usuarios_nivel']='hidden';
}
include('partial/tablas.php');
					//						print_pre($dataVal);
$input='';
foreach($dataType as $i=>$v){
	include('partial/formType.php');
}
					//						echo $tipo."Reg('".$name."','$id')";
?>
	<form id="f_<?PHP echo $name;?>" name="f_<?PHP echo $name;?>" novalidate="" action="javascript:void(0)" method="post">
		<?PHP echo $input;?>
	</form>
</div>
<div id="workdata_search">
	<header id="wsh" class="s-head">
		Registro y Edicion de <?PHP echo ($name=='usuarios_cli'?'Clientes':$name);?><br />
		<input type="submit" class="aLog" style="margin-bottom:10px;" form="f_<?PHP echo $name?>" onclick="validar(f_<?PHP echo $name?>)" value="Guardar" />
		<input type="button" class="aLog" style="margin-bottom:10px;" onclick="closeDw()" value="Salir" />
	</header>
	<div id="form-descripciones" class="s-foot">Ver descripciones</div>
</div>
<script type="text/javascript">
$(".send<?PHP echo "$name"?>")//muestra las descripciones de lso campos en la barra de descripciones
	.on('focus',function(){
		$('#form-descripciones').html($(this).attr('title'));
	})
	.on('blur',function(){
		$('#form-descripciones').html('');
	})
var fid='<?PHP echo $name;?>';
$('form#f_'+fid+' :input').not(':button,:submit,:image').attr('onblur','validar_campo(this)')
function validar_campo(v){
	if(!v.validity.valid){
		$(v).css('background-color','#FDD5F0');
	}else{
		$(v).css('background-color','transparent');
	}
}
var inputs=$('form#f_'+fid+' :input').not(':button,:submit,:image');
function validar(form){
	var valido=form.checkValidity()
//	console.log(valido)
	if(valido){
		<?PHP echo $tipo."Reg('f_".$name."'".($tipo!='nuevo'?",'$id'":'').")";?>;
	}else{
		$.each(inputs,function(i,v){
			if(!v.validity.valid){
				$(v).css('background-color','#FDD5F0');
			}
		})
		$('#login').load('files/login.php',{msgUsr:"Llene correctamente los campos resaltados como se muestra en las descripciones"});
	}
}
</script>
