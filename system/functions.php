<?PHP
function self(){
	if(!isset($_SESSION))session_start();
	$s=preg_replace('/.*\/([a-z_]+)+\.php/','$1',$_SERVER['PHP_SELF']);
	if(!isset($_SESSION['la']['limit'][$s]))$_SESSION['la']['limit'][$s]=20;
	return $s;
}
/** SESS($name,$camp,$val);*/
function presCepal($datos,$campos,$name=false,$nivel=false){
	$s=array('txt'=>'','pv'=>'');
	foreach($campos as $n){
		$v=(preg_match('/\\\\/',$datos[$n])?preg_replace('/\\\\/','',$datos[$n]):$datos[$n]);
		switch($n){
			case "id":
			$s['ficha']="<span><a onclick=\"ficha('$v')\" ><img src='images/ficha.png' height='25px' /></a></span>";
			$s['cart']="<span><a onclick=\"addCart($v)\" ><img src='images/addkart.png' height='25px' /></a></span>";
			$s['edit']=$nivel<3?"":"<span><a onclick=\"editData('cepal','$v')\" ><img src='images/edit.png' height='25px' /></a></span>";
			break;
			case "codweb":
			if(substr(preg_replace('/(<.+>)(.*)(<\/.+>)/','$2',$datos['codinca']),-3)!='000'){$v=$datos['codinca'];}
			$s['codCtrol']="<span class='codigo'>Codigo:<br>$v</span>";
//			echo (preg_replace('/(<.+>)(.*)(<\/.+>)/','$2',$v));
			break;
			case "autor":
			$s['txt'].=($v?"<i><h2>$v.</h2></i>":"");
			break;
			case "titulo":
			$s['txt'].="<h1><span class='titulo'>$v.</span></h1>";
			break;
			case "autor_i":
			$s['txt'].=($v?"<h3>$v. </h3>":"");
			break;
			case "coleccion":
			$s['txt'].=($v?"<u>Col: $v</u>. ":"");
			break;
			case "no_vol":
			$s['txt'].=($v?"<u>No. $v</u>. ":"");
			break;
			case "isbn":
			$s['txt'].=($v?"ISBN: <h3>$v</h3>. ":"");
			break;
			case "vol_serie":
			$s['txt'].=($v?"$v. ":"");
			break;
			case "no_serie":
			$s['txt'].=($v?"No. $v. ":"");
			break;
			case "issn":
			$s['txt'].=($v?"ISSN: $v. ":"");
			break;
			case "paginas":
			$s['txt'].=($v?"$v Pág. ":"");
			break;
			case "editorial":
			$s['txt'].=($v?"Ed. $v. ":"");
			break;
			case "ciudad":
			$s['txt'].=($v?"$v. ":"");
			break;
			case "edicion":
			$s['txt'].=($v?"$v. ":"");
			break;
			case "fecha_pub":
			$s['txt'].=($v?"$v. ":"");
			break;
			case "formato":
			$s['txt'].=($v?"$v. ":"");
			break;
			case "medidas":
			$s['txt'].=($v?"($v) ":"");
			break;
			case "stock":
			$s['stk1']=($v<2?'<div class="stock_limitado"><img src="images/stock.png"></div>':'');
			$s['stk2']=($v<2?'<img src="images/stock.png" style="height:30px;background-color:rgba(255,255,255,0.5);">':'');
			break;
			case "imagen":
			if(file_exists("../$v")){
				$s['imgSrc']="<img src='./$v' title='".$datos['titulo']."' alt='Book ".str_replace('images/books/','',$v)."' width='100%'/>";
			}else{
				$s['imgSrc']="<img src='./images/books/product.png' title='".$datos['titulo']."' alt='Book ".str_replace('images/books/','',$v)."' width='100%'/>";
			}
			break;
			case "p_venta":$p_old='';
			if($datos['oferta']>0&&$datos['oferta']<$v){
				$p_old="<p style='text-decoration:line-through;color:#777;'>($v)</p>";
				$p_="<p>$datos[oferta]</P>";
			}else{$p_="<p>$v</p>";}
			$s['pv'].=("<span class='precio'>Precio:<br>\$us.:$p_old$p_</span>");
			break;
			default:
			break;
		}
	}
	session_write_close();
	return $s;
}
function selectClient($tipo,$colId=false,$json=false){
	if(!$colId){$colId='usuarios_id';}
	if(!class_exists('DataBase')){if(file_exists("system/database.php")){include('system/database.php');}else{include('../system/database.php');}}
	$cat=new DataBase;
	$cat->tabla='usuarios_cli';
	$cat->columns='usuarios_id,usuarios_nick';
	if($tipo=="pedido"){$cat->where='usuarios_id>10';}
	$cat->order='usuarios_nick';
	$cat->_query('SELECT');
	$catrow=$cat->q_fetch_assoc;
	$cat_opt="<div><div class='label2'><label for='usuarios_id'>Cliente:</label></div><div class='text2'><select class='$colId' id='$tipo"."_$colId' title='Clientes'>";
	$cat_opt.="<option value=''>Seleccionar cliente</option>";
	do{
		if(!$json){
			$cat_opt.="<option value='$catrow[usuarios_id]'>$catrow[usuarios_nick]</option>";
		}else{
			$json_cli[$catrow['usuarios_id']]=$catrow['usuarios_nick'];
		}
	}while($catrow=mysqli_fetch_assoc($cat->q_src));
	$cat_opt.="</select></div></div>";
	return ($json?$json_cli:$cat_opt);
}
function list_args($name){
	switch($name){
		case 'pedidos_pais':
			$data['titlePrint']='Listado de pedidos por pais';
			$data['cmpID']='pedidos_pais';
			$data['tablaRel']='pedidos_cod';
			$data['tablaMadre']=array('tabla'=>'pedidos','cmpID'=>'pedidos_id');
			$data['cmpRel']=array('tit'=>'Pais','cmp'=>'paises','val'=>'paises');
			$data['cmpTabla']=array('fecha'=>array('pedidos_fecha','8%','text'),
			'codigo'=>array('codigo','9%','text','hide'),'No.Orden'=>array('pedidos_orden','10%','num'),
			'cliente'=>array('usuarios_nick','9%','l_text'),'autor'=>array('autor','20%','l_text'),
			'titulo'=>array('titulo','38%','l_text'),'estado'=>array('pedidos_estado','8%','l_text'),
			'clm'=>array('pedidos_reclamo','3%','ent'),'cnt'=>array('pedidos_cantidad','3%','num'));
		break;
		case 'pedidos_usuario':
			$data['titlePrint']='Listado de pedidos por Cliente';
			$data['cmpID']='usuarios_id';
			$data['tablaRel']='pedidos_cod';
			$data['tablaMadre']=array('tabla'=>'pedidos','cmpID'=>'pedidos_id');
			$data['cmpRel']=array('tit'=>'Cliente','cmp'=>'usuarios_nick','val'=>selectClient('pedido'));
			$data['cmpTabla']=array('fecha'=>array('pedidos_fecha','8%','text'),
			'codigo'=>array('codigo','9%','text','hide'),'No.Orden'=>array('pedidos_orden','10%','num'),
			'autor'=>array('autor','20%','l_text'),
			'titulo'=>array('titulo','38%','l_text'),'estado'=>array('pedidos_estado','8%','l_text'),
			'clm'=>array('pedidos_reclamo','3%','ent'),'cnt'=>array('pedidos_cantidad','3%','num'));
		break;
		case 'catalogooferta_cepal':
			$data['titlePrint']='Listado de libros Catalogo de Oferta';
			$data['cmpID']='catalogo_cat';
			$data['tablaRel']=$name;
			$data['tablaMadre']=array('tabla'=>'catalogooferta','cmpID'=>'catalogooferta_id');
			$data['cmpRel']=array('tit'=>'Catalogo No','cmp'=>'catalogo_cat','val'=>'catalogo_cat');
			$data['cmpTabla']=array('codigo'=>array('codigo','10%','text','hide'),'grupo'=>array('grupo','10%','text'),
			'autor'=>array('autor','20%','l_text'),'titulo'=>array('titulo','40%','l_text'),
			'editorial'=>array('editorial','20%','l_text'),'stock'=>array('stock','5%','ent','hide'),
			'precio'=>array('precio','5%','num'));
		break;
		case 'listas':
			$data['titlePrint']='Listado de Libros';
			$data['cmpID']='listas_id';
			$data['tablaRel']='listas_detalle_all';
			$data['tablaMadre']=array('tabla'=>'listas','cmpID'=>'listas_id');
			$data['cmpRel']=array('tit'=>'Usuario','cmp'=>'listas_usuario','val'=>'listas_usuario');
			$data['cmpTabla']=array('codigo'=>array('codigo','10%','text','hide'),
			'autor'=>array('autor','20%','l_text'),'titulo'=>array('titulo','40%','l_text'),
			'editorial'=>array('editorial','20%','l_text'),
			'precio'=>array('precio','10%','num'));
		break;
		default:
			$data['cmpID']=$name."_id";
			$data['tablaRel']=$name;
		break;
	}
	return $data;
}
function detalle_list_tabla($id,$tabla,$cmpID,$data=null){
$detCampo='';$mx=array();$campV;$cant=0;
	$detalle=new DataBase();
	$detalle->tabla=$tabla;
	$detalle->where="$cmpID='$id'";
	$detalle->order="CONCAT(autor,' ',titord)";
	$detalle->_query('SELECT');
	$rowdet=$detalle->q_fetch_assoc;
	$style='style=""';
			//											echo $detalle->q_query;
			//											echo $tabla;
	switch ($tabla) {
		case 'catalogooferta_cepal':$cmpID='catalogooferta_id';break;
		case 'pedidos_cod':$cmpID='pedidos_id';break;
		case 'pedidos_usuario':$cmpID='usuarios_id';break;
		case 'listas_detalle_all':$cmpID='listas_id';break;
		default:$cmpID=$tabla.'_id';break;
	}
	if($detalle->q_num_rows>0){
		do{
			if(isset($rowdet['pedidos_estado'])&&$rowdet['pedidos_estado']=='enviado'){
				$prnhide=' prnhide';
			}else{
				$prnhide='';
			}
			$detCampo.="<tr id='".$rowdet[$cmpID]."' class='$cmpID$prnhide'><td class='no_l'></td>";
			foreach($data as $i=>$v){
				$campV=($v[2]=='l_text'?htmlspecialchars($rowdet[$v[0]],ENT_QUOTES):$rowdet[$v[0]]);
				$detCampo.="<td class='$v[0]_l $v[2]'><input class='$v[0]' value='$campV' /></td>";
			}
			$detCampo.="</tr>";
			$arr_cant[]=$rowdet['cepal_id'];
			$mx[]=$rowdet['cepal_id'];
		}while($rowdet=mysqli_fetch_assoc($detalle->q_src));
		$cant=count($arr_cant);
	}
	$return=array('filas'=>$detCampo,'cantidad'=>$cant,'mx'=>$mx);
	return $return;
}
function detalle_venta_tabla($id,$cepal_id=null){
	$detCampo='';$_view=$mx=array();$cant=$tot='';
	$detalle=new DataBase();
	$detalle->tabla='ventas_detalle_all';
	//$detalle->columns='*';
	$detalle->where="ventas_id='$id'";
	$detalle->order="CONCAT(detalle_autor,' ',titord)";
	$detalle->_query('SELECT');
						//									echo $detalle->q_query;
	$rowdet=$detalle->q_fetch_assoc;
	$__A=str_split(($rowdet['ventas_view']?$rowdet['ventas_view']:'100100'));
	foreach($__A as $i=>$v){if($v==0&&$i!=0&&$__A[0]==0){$_view[$i]=' style="display:none;"';}else{$_view[$i]=$v;}}
	if($detalle->q_num_rows>0){
		do{
			$detCampo.="<tr".(isset($cepal_id)&&$cepal_id==$rowdet['cepal_id']?' style="background-color:#FFA64A;"':'')."><td class='no_v' id='$rowdet[cepal_id]'></td>";
			$detCampo.="<td class='codigo_v prnhide'$_view[1]><input class='codigo' id='codigo_$rowdet[cepal_id]' value='$rowdet[codigo]'/></td>";
			$detCampo.="<td class='order_v prnhide'$_view[2]><input class='detalle_orden' id='orden_$rowdet[cepal_id]' value='$rowdet[detalle_orden]'/></td>";
			$detCampo.="<td class='autor_v'><input class='detalle_autor' id='autor_$rowdet[cepal_id]' value='".htmlspecialchars($rowdet['detalle_autor'],ENT_QUOTES)."'/></td>";
			$detCampo.="<td class='titulo_v'><input class='detalle_titulo' id='titulo_$rowdet[cepal_id]' value='".htmlspecialchars($rowdet['detalle_titulo'],ENT_QUOTES)."'/></td>";
			$detCampo.="<td class='editorial_v'><input class='detalle_editorial' id='editorial_$rowdet[cepal_id]' value='".htmlspecialchars($rowdet['detalle_editorial'],ENT_QUOTES)."'/></td>";
			$detCampo.="<td class='cantidad_v prnhide'$_view[3]><input class='detalle_cantidad' id='cantidad_$rowdet[cepal_id]' value='$rowdet[detalle_cantidad]' pattern='[0-9]+'/></td>";
			$detCampo.="<td class='precio_v prnhide'$_view[4]><input class='detalle_precio' id='precio_$rowdet[cepal_id]' value='$rowdet[detalle_precio]' pattern='[0-9\.]+'/></td>";
			$detCampo.="<td class='total_v read'><input class='detalle_total' id='total_$rowdet[cepal_id]' value='$rowdet[detalle_total]' readonly='' title='No puede cambiar este valor' /></td>";
			$detCampo.="<td style='display:none;'><input class='detalle_id' id='id_$rowdet[cepal_id]' value='$rowdet[detalle_id]'/></td>";
			$detCampo.="</tr>";
			$arr_cant[]=$rowdet['detalle_cantidad'];
			$arr_tot[]=$rowdet['detalle_total'];
			$mx[]=$rowdet['cepal_id'];
		}while($rowdet=mysqli_fetch_assoc($detalle->q_src));
		$cant=array_sum($arr_cant);$tot=array_sum($arr_tot);
	}
	$return=array('filas'=>$detCampo,'cantidad'=>$cant,'total'=>$tot,'mx'=>$mx,'_view'=>$_view);
	return $return;
}
function pass_mail($datas,$asunto,$mensaje){
	$cabeceras1 = "MIME-Version: 1.0 \n";
	$cabeceras1.= "Content-type: text/html; charset=UTF-8 \n";
	$cabeceras1.= "To: " . $datas['usuarios_mail']."\n";
	$cabeceras1.= "From: info@librosandinos.com \n";
	$cabeceras1.= "Cc: \n";
	$cabeceras1.= "Bcc: \n";

	$cabeceraTexto="<!DOCTYPE html><html lang='es'>\n<head>\n<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />\n";
	$cabeceraTexto.="<style type='text/css'>\n*{margin:5px auto;}\n.content{padding:10px;border:2px solid #000;width:90%;background-color:#FFE3BD;}\nh1{padding:5px;font-size:1.2em;clear:both;text-align:center;width:100%;}\nh2{margin:0px;padding:5px 30px;font-size:1em;clear:both;}\n</style>\n</head>\n";
	$cabeceraTexto.="<body style='background-color:#FFA64A;'>\n<div class='content'>\n<img src='http://localhost/LA_nvo/images/LAS-logo.png' height='70px' />\n<h1>Mensaje</h1>\n<h2>Usuario: ".$datas['usuarios_nick']."(".$datas['usuarios_mail'].")<br />Asunto: $asunto\n</h2>\n";
	$cabeceraTexto.="<div style='width:90%;'>\n".$mensaje."\n</div>\n";
	$cabeceraTexto.="<div style='width:90%; text-align:center;color:#F00;'>\nNo responda a este mensaje!!\n</div>\n</div>\n</body>\n</html>\n";
	if(mail($datas['usuarios_mail'],$asunto,$cabeceraTexto,$cabeceras1)){
		$ret="Los datos fueron enviados a su e-mail.<br/>Revise su correo puede que se encuentre en la bandeja de sospechosos.";
	}else{
		$ret="No se pudo enviar el el mensaje. contactese con nuestros representantes para que le den de alta.";
	}
	return $ret;
}
function print_pre($source){
	echo "<pre>";print_r($source);echo "</pre>";
}
function print_prev($source){
	echo "<pre class='v'>";print_r($source);echo "</pre>";
}
function include_if_exists($file,$nivMin=null){
	file_exists($file)?$r="":$r="../";
	include("$r$file");
	if($nivMin){
		return $nivMin;
	}
}
function base64_encode_image($filename,$filetype=null) {
	if ($filename) {
		$imgbinary = fread(fopen($filename, "r"), filesize($filename));
		return chunk_split(base64_encode($imgbinary));
	}
}
?>