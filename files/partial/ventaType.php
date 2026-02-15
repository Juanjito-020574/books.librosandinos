<?php //configuración de tipo de campos para ventas
$dependiente='';$autonew=(isset($autonew)?$autonew:'');
switch($v){
	case 'auto':
	break;
	case 'none':
	break;
	case 'unic':
		if($dataVal['ventas_fact']<=0){
			$dataVal['ventas_fact']=0;
			$vf=' medio prnhide';
			$vi=' medio';
			$lbl=$titulo[$i];
		}else{
			$vf=' medio';
			$vi=' medio prnhide';
			$lbl=$titulo['ventas_fact'];
		}
		$dataVal['ventas_id']=str_pad($dataVal['ventas_id'],5,0,STR_PAD_LEFT);
		$dataVal['ventas_fact']=str_pad($dataVal['ventas_fact'],5,0,STR_PAD_LEFT);
		$input[$i]="<div$dependiente>
			<div class='label2'><label for='$i'>$lbl:</label>$autonew
				<span id='ventas_id_fact' class='prnhide' onclick=\"ocultarVentasIDat('ventas_id,#ventas_fact','ventas_id_fact')\">
					<img src='images/prnon.png' width='15px' title='Oculta en Invoice No: en la impresión' />
				</span>
			</div>
			<div class='text2 read' ondblclick='changeFactura()'>
			<input class='send$name $vi' readonly='' type='text' id='$i' name='$i' value='$dataVal[$i]' required autofocus $attr[ventas_id] />
			<input class='send$name $vf' type='text' id='ventas_fact' name='ventas_fact' value='$dataVal[ventas_fact]' required autofocus $attr[ventas_fact] />
			</div></div>";
	break;
	case 'mail':
		$input[$i]="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i]: *</label>$autonew</div>
			<div class='text2'><input class='send$name' type='email' id='$i' name='$i' value='$dataVal[$i]' required $attr[$i] /></div></div>";
	break;
	case 'pass':
		$input[$i]="<div$dependiente style='display:none;'><div class='label2' style='display:none;'><label for='$i'>$titulo[$i]: </label>$autonew</div>
			<div class='text2'><input class='send$name' type='password' id='$i' name='$i' value='$dataVal[$i]' $attr[$i] /></div></div>";
	break;
	case 'hidden':
		$input[$i]="<div$dependiente style='display:none;'><div class='label2'><label for='$i'>$titulo[$i]: </label>$autonew</div>
			<div class='text2'><input class='send$name' type='text' id='$i' name='$i' value='$dataVal[$i]' $attr[$i] /></div></div>";
	break;
	case 'select':
		$slct="<select class='send$name' id='$i' name='$i' $attr[$i]>";
		asort($select[$i]);
		$slct.=$$name->_option($select[$i],$dataVal[$i],$name!='cepal'?$name:null);
		if($name=='usuarios'&&$dataVal['usuarios_id']==$_SESSION['la']['usuarios']['usuarios_id']){
			$slct.="<option value='".$_SESSION['la']['usuarios']['usuarios_nivel']."' label='".$select[$i][$_SESSION['la']['usuarios']['usuarios_nivel']]."' selected='' >".$select[$i][$_SESSION['la']['usuarios']['usuarios_nivel']]."</option>";
		}
		$slct.="</select>";
		$input[$i]="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i]: </label>$autonew</div>
			<div class='text2'>$slct</div></div>";
	break;
	case 'repetible':
		$xxx = explode(' | ',$dataVal[$i]);
		$repet='';
		for($z=0;$z<count($xxx);$z++){
			if(count($xxx)>1 && $z<(count($xxx)-1)){
				$mas="<img id='add".$i."_$z' src='images/bt_disabled.png' width='15' height='15' style='width:15px;cursor:text;vertical-align:bottom;' />";
			}else{
				$mas="<img id='add".$i."_$z' src='images/bt_mas.png' onclick='addRep(\"rep_".$i."_$z\")' width='15' height='15' style='width:15px;cursor:pointer;vertical-align:bottom;' />";
			}
			switch($z){
				case 0:
					$repet.="<div id='rep_$i"."_$z'><input style='width:87%;' class='rep$name' type='text' id='$i' name='rep_".$i."[$z]' value='$xxx[$z]' $attr[$i] />
					$mas
					<img id='rem".$i."_$z' src='images/bt_disabled.png' width='15' height='15' style='width:15px;cursor:text;vertical-align:bottom;' />
					</div>";
				break;
				default:
					$repet.="<div id='rep_$i"."_$z'><hr style='margin:5px 0 2px 0;' /><input style='width:87%;' class='rep$name' type='text' id='$i' name='rep_".$i."[$z]' value='$xxx[$z]' $attr[$i] />
					$mas
					<img id='rem".$i."_$z' src='images/bt_menos.png' onclick='remRep(\"rep_".$i."_$z\")' width='15' height='15' style='width:15px;cursor:pointer;vertical-align:bottom;' />
					</div>";
				break;
			}
		}
		$input[$i]="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i]:</label>$autonew</div> ";
		$input[$i]="<div class='text2'id='rep$i'>$repet</div></div>";
	break;
	case 'read':
		$input[$i]="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i]:</label>$autonew</div>
			<div class='text2 read'><input class='send$name' type='text' id='$i' name='$i' value='$dataVal[$i]' readonly='' title='No se puede cambiar el valor' /></div></div>";
		$label[$i]="$titulo[$i]";$valorCampo[$i]="$i";
	break;
	case 'textarea':
		$input[$i]="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i]:</label>$autonew</div>
			<div class='text2'><textarea rows='5' class='send$name' id='$i' name='$i' value='$dataVal[$i]' $attr[$i]>$dataVal[$i]</textarea></div></div>";
	break;
	case 'tahidden':
		$input[$i]="<div$dependiente style='display:none;'><div class='label2'><label for='$i'>$titulo[$i]:</label>$autonew</div>
			<div class='text2'><textarea rows='5' class='send$name' id='$i' name='$i' value='$dataVal[$i]' $attr[$i]>$dataVal[$i]</textarea></div></div>";
	break;
	case 'date':
		$input[$i]="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i]:</label>$autonew
					<span id='ventas_fecha_hide' class='prnhide' onclick=\"ocultarVentasIDat('ventas_fecha_view','ventas_fecha_hide')\">
						<img src='images/prnon.png' width='15px' title='Oculta en Invoice No: en la impresión' />
					</span>
		</div>
			<div class='text2 read'>
			<input id='ventas_fecha_view' type='text' readonly='' ondblclick='changeDate()' value='".date("M d, Y",strtotime($dataVal[$i]))."' />
			<input class='send$name prnhide' style='display:none;' onblur='hideDate()' type='date' id='$i' name='$i' value='$dataVal[$i]' $attr[$i] />
		</div></div>";
	break;
	case 'porcentaje':
		$input[$i]="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i] <span>$dataVal[ventas_porcentaje]</span><span><input type='text' id='ventas_porcentaje' value='$dataVal[ventas_porcentaje]' onchange='ventasDiscount()' /></span>%:</label>$autonew</div>
			<div class='text2 read'><input class='send$name' readonly='' type='text' id='$i' name='$i' value='$dataVal[$i]' $attr[$i] /></div></div>";
	break;
	case 'taxes':
		$input[$i]="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i] <span>$dataVal[ventas_taxes]</span><span><input type='text' id='ventas_taxes' value='$dataVal[ventas_taxes]' onchange='ventasTaxes()' /></span>%:</label>$autonew</div>
			<div class='text2 read'><input class='send$name' readonly='' type='text' id='$i' name='$i' value='$dataVal[$i]' $attr[$i] /></div></div>";
	break;
	default:
		$input[$i]="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i]:</label>$autonew</div>
			<div class='text2'><input class='send$name' type='text' id='$i' name='$i' value='$dataVal[$i]' $attr[$i] /></div></div>";
		$label[$i]="$titulo[$i]";$valorCampo[$i]="$i";
	break;
}
?>
