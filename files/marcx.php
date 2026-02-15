<?php
header("Content-Type: text/plain");
header("Content-Disposition: attachment; filename=".substr($_REQUEST['cliente'],0,3)."_".str_pad($_REQUEST['factura'],5,'0',STR_PAD_LEFT).".txt;");
header("Content-Transfer-Encoding: text");
extract($_REQUEST);
		//							print_r($_REQUEST);
//$id=explode(',',$ids);
$idCon=preg_replace('/\,/',' or id=',$ids);
include('../system/database.php');
$c=new DataBase();
$c->tabla='marcx';
$c->where="id=$idCon";
$c->order="orden";
$c->_query('SELECT');
$row=$c->q_fetch_assoc;
$n=0;
		//							print_r($row);
		//							echo "<pre>";print_r($c->q_query);echo '</pre>';
//		echo "<textarea id='datosMarc' name='datosMarc' style='width:100%;height:100%;'>";
		echo "Comprobante No.:  ".$voucher."\r\n";
		echo "Factura No.:      ".$factura."\r\n";
		echo "Cliente:          ".$cliente."\r\n\r\n\r\n";

$lang;$resultado='';
do{
//	$ord[$n]['codigo']="\r\n".$row['id']."\r\n";
	$lang=preg_replace(array('/español|es/i','/ingles|english|en/i','/frances|francais|fr/i'),array('esp','eng','fra'),$row['idioma']);
	$isbn=($row['isbn']?"=020  \\\\\$a".str_replace('-','',$row['isbn'])."\r\n":'');
	$edicion=($row['edicion']?"=250  \\\\\$a$row[edicion].\r\n":'');
	$aut=explode('; ',$row['autor']);
	$v_aut=$aut[0];
	if(count($aut)>0){
		$auts=preg_replace('/(.*)\,\s(.*)/','$2 $1',$aut[0]);
	}
	$autor=($v_aut?"=100  1\\\$a$v_aut.\r\n":'');
	$tit=preg_split('/ ; |\. |\: |\; /',$row['titulo']);
	$tit0=$tit[0];$tit1=$tit;
	unset($tit1[0]);
	$tit1=implode('. ',$tit1);
	if(!$row['autor']){$i1='0';}else{$i1='1';}
	$i2=(strlen($tit0))-(strlen(preg_replace('/^(el |la |las |los |[0-9]+ |[IVXLCDM]+ )(.*)/i','$2',$tit0)));
	$titulo="=245  $i1$i2\$a$tit0".($tit1?" :\$b$tit1":'');
	$edt=($row['editorial']?" :\$b".preg_replace('/ \; |\; /',' :$b',$row['editorial']):'');
	$ciud=($row["ciudad"]?"\$a$row[ciudad]":"[S.l.]");
	$ano=($row['fecha_pub']?",\$c".preg_replace('/(\d{4})/','$1',$row['fecha_pub']) :'');
	$editorial=($row['editorial']?"=260  \\\\$ciud$edt$ano.\r\n":'');
	$pag=($row['paginas']?"\$a$v p":'\$a1 v');
	$ill=($row['info_desc']?". :\$bill":'');
	$alto=($row['medidas']?". ;\$c".preg_replace('/(\d{2})( x \d{2})( cm)/','$1$3',$row['medidas']):"");
	$descr="=300  \\\\$pag$ill$alto.\r\n";
	$colec=preg_replace('/(.*)\. (serie.*)/i','$a$1.$p$2',$row['coleccion']);
	$col=($row['coleccion']?"=440  \\\\$colec$num.\r\n":'');
	$_001="la ".str_pad($factura,5,'0',STR_PAD_LEFT)."X".str_pad(($n+1),3,'0',STR_PAD_LEFT);
	$_005=date('YmdHis.0');
	$ano_08=($row['fecha_pub']?"s".preg_replace('/(\d{4})/','$1',$row['fecha_pub'])."\\\\\\\\":"b\\\\\\\\\\\\\\\\");
	$pais_08=($row['pais']?strtolower(preg_replace(array('/bolivia|bo/i','/colombia|co/i','/chile|cl/i','/ecuador|ec/i','/peru|perú|pe/i','/venezuela|ve/i'),array('bo\\','ck\\','cl\\','ec\\','pe\\','ve\\'),$row['pais'])):'\\\\\\');
	$ill_08=($row['info_desc']?"a\\\\\\":'\\\\\\\\');
	$_0823='\\\\\\\\\\\\000\\0\\';
	$_008=date('ymd')."$ano_08$pais_08$ill_08$_0823$lang\\d";
	$_923="\\\\\$d".date('Ymd')."\$n".str_pad($factura,4,0,STR_PAD_LEFT)."\$sBoCbLA";
//		$ord[$n][$i]=marcTxt($i,$v);

	$ord[$n]['_LDR']="=LDR  00000nam\\\\22000005a\\4500$ldr\r\n";
	$ord[$n]['_001']="=001  $_001\r\n";
	$ord[$n]['_003']="=003  BoCbLA\r\n";
	$ord[$n]['_005']="=005  $_005\r\n";
	$ord[$n]['_008']="=008  $_008\r\n";
	$ord[$n]['_020']=$isbn;
	$ord[$n]['_040']="=040  \\\\\$aBoCbLA".($lang?"\$b$lang":'')."\$cBoCbLA\r\n";
	$ord[$n]['_100']=$autor;
	$ord[$n]['_245'].=$titulo.($auts?" /\$c$auts":'').".\r\n";
	$ord[$n]['_260']=$editorial;
	$ord[$n]['_300']=$descr;
	$ord[$n]['_440']=$col;
	$ord[$n]['_923']="=923  $_923\r\n\r\n";
	$acentos=array('/á/','/é/','/í/','/ó/','/ú/','/ñ/');
	$reemplazos=array('{E2}a','{E2}e','{E2}i','{E2}o','{E2}u','{E4}n');
	if(preg_match("/^lc/i",$cliente)){
		echo preg_replace($acentos,$reemplazos,implode('',$ord[$n]));
	}else{
//		echo implode ('..',$row)."\n\n";
		echo implode('',$ord[$n]);
	}
	$n++;
}while($row=mysqli_fetch_assoc($c->q_src));
//												echo "</pre>";
//echo "</textarea>";
//echo '<a id="link"  style="position:absolute;right:30px;top:0px;border: 1px solid grey;color:#fff;background-color:grey;padding:2px 10px;border-radius:6px;cursor:pointer;">Guardar</a>';
function marcTxt($i,$v){
	switch($i){
		case 'id':
		$$i="=id  $v\r\n";
		break;
	}
	return $$i;
}

?>

