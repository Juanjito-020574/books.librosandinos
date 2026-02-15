<?php //áéíóú
require_once('../../system/database.php');
if(!session_start()){session_start();}
extract($_REQUEST);
				//										print_r($_REQUEST);
$join=$whereAnd=$clkComp='';
$barcode=(preg_match('/^[0-9]{6,20}$/',$find)?$find:null);
$find=preg_replace('/^(el |la |los |las |the |¿|!|\"|[0-9]+ |[IVXLCDM]+ )/','',$find);
switch($form){
	case 'f_catalogooferta_cepal':
	$clkComp='_list';
	$join=" left join catalogooferta on (catalogooferta.cepal_id=id and ($cmpID=null or $cmpID='$campoVal'))";
	$columnComp=",$cmpID as asign";
//	$whereAnd="$cmpID!='$campoVal'";
	break;
	case 'f_pedidos_usuario':
	$clkComp='_list';
	$join=" left join pedidos on (pedidos.cepal_id=id and ($cmpID=null or $cmpID='$campoVal'))";
	$columnComp=",$cmpID as asign";
//	$whereAnd="$cmpID!='$campoVal'";
	break;
	case 'f_listas':
	$clkComp='_list';
	$columnComp="";
	break;
	case 'f_ventas':
	$columnComp=",ventas_repeat('$cliente',id) as `repeat`";
	break;
}
$consulta = new DataBase();
$consulta->tabla="cepal_stock$join";
$consulta->columns="id,find$columnComp";
$consulta->where="titulo REGEXP concat('^(\\\\(*(la|el|las|los|the|¿|¡|\\\"|[0-9]+|[IVXLCDM]+)*\\\\)* )*',acentosRegexp('$find')) OR codigo REGEXP concat('^',acentosRegexp('$find'))";
if($barcode){$consulta->columns.=',1 as bc';$consulta->where="barcode REGEXP '$barcode'";}
$consulta->whereAnd=$whereAnd;
$consulta->order='id desc';
$consulta->join1='';
$consulta->_query('SELECT');
$result = $consulta->q_fetch_assoc;
						//							echo "<br>$consulta->q_query<br>";
if($consulta->q_num_rows>0){
	$option='';
	if($consulta->q_num_rows==1&&!isset($result['repeat'])&&isset($result['bc'])){
		echo "<div class='resultado' id='result_$result[id]' style='display:none;'><span id='bc'></span></div><script>send_tbody($('#bc'))</script>";
	}else{
	do{
		$cant=$bg="";$clk="send_tbody$clkComp(this)";
		if(isset($result['repeat'])){
			eval("$result[repeat];");
//			print_r($result[repeat]);
			foreach($venid_ as $i=>$v){
				$cant.="Factura No. ".str_pad($v,6,'0',STR_PAD_LEFT).": $detcan_[$i] unidad".($detcan_[$i]>1?'es':'').". Cliente:$vencli_[$i]\n";
				if($v==$fact_id){
					$clk="cantidad_ed(\"cantidad_$result[id]\")";
					$bg="background-color:#FF0;color:#F00;'title='".$cant."El Registro Existe en esta factura\nSi Continua se incrementará la cantidad en 1 unidad";
				}
			}
			($bg==''?$bg="background-color:#0F0;color:#F00;'title='$cant":$bg=$bg);
		}
		if(isset($result['asign'])){
			$cant='Este registro ya existe en la lista';
			$bg="background-color:#0F0;color:#F00;'title='$cant";
			$clk='';
		}
		$option.="<div class='resultado' id='result_$result[id]' style='$bg'>";//<img src='images/checkstd.png' height='10px' />
		$option.="<span class='find' onclick='$clk'>$result[find]</span>";
		$option.="</div>";
	}while($result=mysqli_fetch_assoc($consulta->q_src));
	echo $option;
	}
}else{
	if($_SESSION['la']['usuarios']['usuarios_nivel']>=4){
		$nuevoLibro="<br>Desea crear un registro <a class='aLog' onclick='newData(\"cepal_aux\")'>Mínimo</a> o un registro <a class='aLog' onclick='newData(\"cepal\")'>Completo</a>";
	}
	echo "<span class='link'>\"$find\"</span> no se encuentra en la base de datos.$nuevoLibro";
}

?>
