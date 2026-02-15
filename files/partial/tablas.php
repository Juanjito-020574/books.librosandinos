<?PHP
if($name=='listas'){
	$visible[ver]='1';
	$predet[ver]=$row[ver]='<a>Ver Listado</a>';
	$dataType=($tipo=='nuevo'?$nuevo:$edit);
	$dataVal=($tipo=='nuevo'?$predet:$row);
}
if($name=='pais_cli'){
	$dataType=($tipo=='nuevo'?$nuevo:$edit);
	$dataVal=($tipo=='nuevo'?$predet:$row);
}
if($name=='ofertas_cepal'){
	$nuevo['catalogo']='normal';
	$dataType=($tipo=='nuevo'?$nuevo:$edit);
	$dataVal=($tipo=='nuevo'?$predet:$row);
}
if($name=='ventas'){
	if($tipo=='nuevo'){
		$c=new DataBase;
		$c->tabla='usuarios_cli';
		$c->columns='usuarios_nick';
		$c->where="usuarios_nivel<=2 AND usuarios_nick!=''".($_SESSION['la']['usuarios']['usuarios_nivel']<7?" AND usuarios_id>=9":'');
		$c->_query('SELECT');
		$cRow=$c->q_fetch_assoc;
//								echo $c->q_query;
		do{
			$select['ventas_cliente'][$cRow['usuarios_nick']]=$cRow['usuarios_nick'];
		}while($cRow=mysqli_fetch_assoc($c->q_src));
	}
	if($row['ventas_clid']==9){$edit['ventas_cliente']='normal';}
//					print_pre($predet);
	switch($sUs_usuarios_nivel){
		case 7:
		break;
		case 6:
			$nuevo['ventas_usuario']='normal';
		break;
		case 5:
		break;
		case 4:
		break;
		case 3:
		break;
		case 2:
		break;
		case 1:
		break;
	}
	$dataType=($tipo=='nuevo'?$nuevo:$edit);
	$dataVal=($tipo=='nuevo'?$predet:$row);

//exit;
}
if($name=='user_data'||$name=='usuarios'||$name=='usuarios_cli'){
	$input='';
//	$nuevo['sendmail']=$edit['sendmail']='none';
//	$select['sendmail']=array('no'=>'no','yes'=>'si');
//	$visible['sendmail']=1;
//	$titulo['sendmail']='Enviar Mail';
	$predet['sendmail']='no';
	$row['sendmail']='no';
	if($name=='usuarios'){
		$predet['usuarios_nivel']=3;
		unset($select['usuarios_nivel']['1'],$select['usuarios_nivel']['2']);
	}
	if($name=='usuarios_cli'){
		$predet['usuarios_nivel']=2;
		$select['usuarios_nivel']=array('1'=>'estandar','2'=>'cliente');
		$edit['usuarios_nick']='read';

	}
	switch($sUs_usuarios_nivel){
		case 7:
			$edit['usuarios_nick']='normal';
			$edit['usuarios_mail']='smail';
			$edit['usuarios_nivel']=$nuevo['usuarios_nivel']='select';
		break;
		case 6:
			if($row['usuarios_nick']!=$sUs_usuarios_nick){
				$edit['usuarios_nick']='normal';
				$edit['usuarios_mail']='smail';
			}
			$edit['usuarios_nivel']=$nuevo['usuarios_nivel']='select';
		break;
		case 5:
			if($row['usuarios_nick']!=$sUs_usuarios_nick){
				$edit['usuarios_mail']=$nuevo['usuarios_mail']='smail';
			}
			$edit['usuarios_nivel']=$nuevo['usuarios_nivel']='select';
			if($row['usuarios_mail']!=$_SESSION['la']['usuarios']['usuarios_mail']){
				$edit['usuarios_pRec']='none';
			}
		break;
		case 4:
			if($row['usuarios_nick']!=$sUs_usuarios_nick){
				$edit['usuarios_mail']=$nuevo['usuarios_mail']='smail';
			}
			if($row['usuarios_mail']!=$_SESSION['la']['usuarios']['usuarios_mail']){
				$edit['usuarios_pRec']='none';
			}
		break;
		case 3:
		break;
		case 2:
		break;
		case 1:
		break;
	}
	$dataType=($tipo=='nuevo'?$nuevo:$edit);
	$dataVal=($tipo=='nuevo'?$predet:$row);
//	print_pre($dataType);
//	print_pre($dataVal);
	if($tipo=='nuevo'&&($name=='usuarios'||$name=='usuarios_cli')){
		$input.="<div>Llene los datos correspondientes.<br />La contraseña será enviada a su e-mail</div>";
	}
	if($tipo=='edit'&&($name=='usuarios'||$name=='usuarios_cli')){
		$input.="<div>Cuenta de &laquo;<b>$dataVal[usuarios_nick]</b>&raquo;</div>";
	}
	if($row['sendmail']&&$_SESSION['la']['usuarios']['usuarios_nivel']>3){
		$smChk=($dataVal['sendmail']=='yes'?' checked':'');
		$input.="Enviar datos al mail del usuario <input type='checkbox' class='send$name' id='sendmail' name='sendmail' value=$dataVal[sendmail] $smChk style='width:initial;' />";
	}
}
if($name=='clientes'){
	switch($sUs_usuarios_nivel){
		case 7:
		break;
		case 6:
		break;
		case 5:
		break;
		case 4:
		break;
		case 3:
		break;
		case 2:
		break;
		case 1:
		break;
	}
	$dataType=($tipo=='nuevo'?$nuevo:$edit);
	$dataVal=($tipo=='nuevo'?$predet:$row);
	if($tipo=='nuevo'&&$name=='usuarios'){
		$input.="<div>Los datos deben ser llenados</div>";
	}
	if($tipo=='edit'&&$name=='usuarios'){
		$input.="<div>Cuenta de &laquo;<b>$dataVal[usuarios_nick]</b>&raquo;</div>";
	}
}
if($name=='catalogo'){
	if($tipo=='nuevo'||($tipo=='edit'&&$row['tipo']!='blanket')){
		$select['estado']['cerrado']='cerrado';
		unset($select['estado']['procesando']);
	}
	if($row['tipo']!='oferta'&&$tipo=='edit'&&$row['registros']>0){unset($select['tipo']['oferta']);}
	switch($sUs_usuarios_nivel){
		case 7:
			$edit['tipo']='select';
		break;
		case 6:
			$edit['pais']='read';
			$edit['registros']='read';
			$edit['tipo']=($row['tipo']=='oferta'?'read':'select');
			$edit['file']=($row['estado']!='cerrado'?'select':'read');
			$edit['estado']='select';
		break;
		case 5:
			$edit['pais']='read';
			$edit['registros']='read';
			$edit['tipo']=($row['tipo']=='oferta'?'read':'select');
			$edit['file']=($row['estado']!='cerrado'?'select':'read');
			$edit['estado']=(($row['estado']!='abierto')&&($row['catalogo_usuario']!=$_SESSION['la']['usuarios']['usuarios_id'])?'read':'select');
		break;
		case 4:
		break;
		case 3:
		break;
		case 2:
		break;
		case 1:
		break;
	}
	print_pre($select);
	$dataType=($tipo=='nuevo'?$nuevo:$edit);
	$dataVal=($tipo=='nuevo'?$predet:$row);
}
if($name=='cepal'||$name=='cepal_aux'){
		//							echo $sUs_usuarios_nivel;
	$c=new DataBase;
	$c->tabla='catalogo';
	$c->where=($sUs_usuarios_nivel<=3?"tipo='blanket'":"tipo != 'oferta'")." and estado='abierto'";
	$c->order='tipo,cat';
	$c->_query('SELECT');
	$cRow=$c->q_fetch_assoc;
//echo $c->q_num_rows;
	do{
		if($name=='cepal_aux'){$predet['122']=$cRow['cat'];$predet['4']='A';}
//		print_pre(preg_match("/^[Aa]/",$cRow['cat']));
		$_cat[$cRow['cat']]=$cRow['cat'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ('.$cRow['tipo'].')';
	}while($cRow=mysqli_fetch_assoc($c->q_src));
	if($name=='cepal_aux'){
		$_mat=array('LITERATURA'=>'LITERATURA','NO LITERATURA'=>'NO LITERATURA','DERECHO'=>'DERECHO','REVISTAS'=>'REVISTAS');
		$nuevo['120']=$nuevo['11']=$nuevo['17']=$nuevo['21']=$nuevo['25']=$nuevo['27']=$nuevo['20']=$nuevo['41']=$nuevo['43']=$nuevo['48']='none';
		$nuevo['108']='hidden';
	}else{
		$mat=new DataBase;
		$mat->tabla='materias';
	//	$mat->columns='descripcion';
		$mat->_query('SELECT');
		$matRow=$mat->q_fetch_assoc;
		do{
			if($matRow['descripcion']!='NO LITERATURA'){$_mat[$matRow['descripcion']]=$matRow['descripcion'];}
		}while($matRow=mysqli_fetch_assoc($mat->q_src));
	}//print_pre($mat_);
	switch($sUs_usuarios_nivel){
		case 7:
			$select["122"]=$_cat;
            $edit["122"]='select';
			$select["80"]=$_mat;
			$edit["91"]='repetible';
		break;
		case 6:
			$select["122"]=$_cat;
            $edit["122"]='select';
			$select["80"]=$_mat;
			$edit["91"]='repetible';
		break;
		case 5:
			$select["122"]=$_cat;
			$select["80"]=$_mat;
		break;
		case 4:
			$select["122"]=$_cat;
			$select["80"]=$_mat;
		break;
		case 3:
			$select["122"]=$_cat;
			$select["80"]=$_mat;
		break;
		case 2:
		break;
		case 1:
		break;
	}
	$dataType=($tipo=='nuevo'?$nuevo:$edit);
	$dataVal=($tipo=='nuevo'?$predet:$row);
//	print_r($predet);
}
if($name=='pedidos'){
//print_pre($_REQUEST);
	switch($sUs_usuarios_nivel){
		case 7:
		break;
		case 6:
		break;
		case 5:
		break;
		case 4:
		break;
		case 3:
		break;
		case 2:
//			$edit['usuarios_id']=$nuevo['usuarios_id']='none';
		break;
		case 1:
//			$edit['usuarios_id']=$nuevo['usuarios_id']='none';
		break;
	}
//	print_pre($select[estado]);
	$dataType=($tipo=='nuevo'?$nuevo:$edit);
	$dataVal=($tipo=='nuevo'?$predet:$row);
}

?>
