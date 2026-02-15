<?PHP
$dependiente='';
if(isset($dep[$i])&&is_array($dep[$i])){
	$dependiente=" class='dependiente' ances='".implode('|',array_keys($dep[$i]))."' value='".implode('|',$dep[$i])."'";
//	$input.=$dependiente;
}
$autonew=$style='';
$clkAN=(($campo[$i]==47||$campo[$i]==35)?'':"onclick='autonew(this)'");
if($name=='cepal'&&$tipo=='nuevo'){//
	if(!isset($_SESSION['la']['predet'][$i])){
		$autonew="<img src='images/checkstd.png'height='10px' $clkAN title='Valor predeterminado para siguientes registros'/>";
	}else{
		$autonew="<img src='images/checkoff.png'height='10px' $clkAN title='Eliminar valor predeterminado para siguientes registros'/>";
		$dataVal[$i]=$_SESSION['la']['predet'][$i];
	}
}
$dataVal[$i]=(isset($dataVal[$i])?preg_replace('/\\\\/','',htmlspecialchars($dataVal[$i],ENT_QUOTES)):'');
$frc='';
if($tipo=='nuevo'){
	$frc=' *';
}
$attr[$i]=(isset($attr[$i])?str_replace('\\n','<br>',$attr[$i]):'');
switch($v){
	case 'auto':
	break;
	case 'none':
	break;
	case 'unic':
		$input.="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i]:$frc</label>$autonew</div>
			<div class='text2'><input class='send$name' type='text' id='$i' name='$i' value=\"$dataVal[$i]\" required autofocus $attr[$i] /></div></div>";
	break;
	case 'mail':
		$input.="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i]:$frc</label>$autonew</div>
			<div class='text2'><input class='send$name' type='email' id='$i' name='$i' value=\"$dataVal[$i]\" $attr[$i] /></div></div>";
	break;
	case 'umail':
		$input.="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i]:$frc</label>$autonew</div>
			<div class='text2'><input class='send$name' type='email' id='$i' name='$i' value=\"$dataVal[$i]\" required $attr[$i] /></div></div>";
	break;
	case 'smail':
		$input.="<div$dependiente><div class='label2'><label for='$i'>
			$titulo[$i]:$frc</label>$autonew</div>
			<div class='text2'><input class='send$name' type='email' id='$i' name='$i' value=\"$dataVal[$i]\" required $attr[$i] /></div></div>";
	break;
	case 'pass':
		$input.="<div$dependiente style='display:none;'><div class='label2' style='display:none;'><label for='$i'>$titulo[$i]: </label>$autonew</div>
			<div class='text2'><input class='send$name' type='password' id='$i' name='$i' value=\"$dataVal[$i]\" $attr[$i] /></div></div>";
	break;
	case 'hidden':
		$input.="<div$dependiente style='display:none;'><div class='label2'><label for='$i'>$titulo[$i]: </label>$autonew</div>
			<div class='text2'><input class='send$name' type='text' id='$i' name='$i' value=\"$dataVal[$i]\" $attr[$i] /></div></div>";
	break;
	case 'select':
		if(isset($select[$i])){
			$slct="<select class='send$name' id='$i' name='$i' $attr[$i]>";
			$slct.=$$name->_option($select[$i],$dataVal[$i],$name!='cepal'?$name:null);
			if($name=='usuarios'&&$dataVal['usuarios_id']==$_SESSION['la']['usuarios']['usuarios_id']){
				$slct.="<option value='".$_SESSION['la']['usuarios']['usuarios_nivel']."' label='".$select[$i][$_SESSION['la']['usuarios']['usuarios_nivel']]."' selected='' >".$select[$i][$_SESSION['la']['usuarios']['usuarios_nivel']]."</option>";
			}
			$slct.="</select>";
		}else{$slct='';}
		$input.="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i]: </label>$autonew</div>
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
					$repet.="<div id='rep_$i"."_$z'><input class='rep$name $i' type='text' id='$i' name='rep_".$i."[$z]' value='$xxx[$z]' $attr[$i] />
					$mas
					<img id='rem".$i."_$z' src='images/bt_disabled.png' width='15' height='15' style='width:15px;cursor:text;vertical-align:bottom;' />
					</div>";
				break;
				default:
					$repet.="<div id='rep_$i"."_$z'><hr style='margin:5px 0 2px 0;' /><input class='rep$name' type='text' id='$i' name='rep_".$i."[$z]' value='$xxx[$z]' $attr[$i] />
					$mas
					<img id='rem".$i."_$z' src='images/bt_menos.png' onclick='remRep(\"rep_".$i."_$z\")' width='15' height='15' style='width:15px;cursor:pointer;vertical-align:bottom;' />
					</div>";
				break;
			}
		}
		$input.="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i]: </label>$autonew</div> ";
		$input.="<div class='text2'id='rep$i'>$repet</div></div>";
	break;
	case 'repetibletxt':
		$xxx = explode(' | ',$dataVal[$i]);
		$repet='';
		for($z=0;$z<count($xxx);$z++){
			$divisor=($z>0)?"<hr style='margin:5px 0 2px 0;' />":'';
			$repet.="<div id='rep_$i"."_$z'>$divisor<input style='width:87%;' class='rep$name' type='text' id='$i' name='rep_".$i."[$z]' value='$xxx[$z]' readonly='' $attr[$i] />
			</div>";
		}
		$input.="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i]: </label>$autonew</div> ";
		$input.="<div class='text2'id='rep$i' style='background-color:rgba(210,210,210,0.35)'>$repet</div></div>";
	break;
	case 'read':
		$input.="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i]: </label>$autonew</div>
			<div class='text2 read'><input class='send$name' type='text' id='$i' name='$i' value=\"$dataVal[$i]\" readonly='' title='No se puede cambiar el valor' /></div></div>";
	break;
	case 'textarea':
		if($name=='catalogo'&&$dataVal['tipo']!='oferta'&&($i=='send'||$i=='text')){$style=" style='display:none;'";}
		$input.="<div$dependiente$style><div class='label2'><label for='$i'>$titulo[$i]: </label>$autonew</div>
			<div class='text2'><textarea rows='5' class='send$name' id='$i' name='$i' value=\"$dataVal[$i]\" $attr[$i]>$dataVal[$i]</textarea></div></div>";
	break;
	case 'date':
		$input.="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i]: </label>$autonew</div>
			<div class='text2'><input class='send$name' type='date' id='$i' name='$i' value=\"$dataVal[$i]\" $attr[$i] /></div></div>";
	break;
	default:
		$input.="<div$dependiente><div class='label2'><label for='$i'>$titulo[$i]: </label>$autonew</div>
			<div class='text2'><input class='send$name' type='text' id='$i' name='$i' value=\"$dataVal[$i]\" $attr[$i] /></div></div>";
	break;
}
?>
