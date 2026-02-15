<?PHP
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
if(!isset($_SESSION))session_start();
include($ruta.'system/functions.php');$nivMin=0;
include($ruta.'system/verif_user.php');
extract($_REQUEST);
					//								print_pre($_REQUEST);
$campos=$materia_=$codInNew=$edt_=$ped_='';$numeracion=1;
$name='catalogo';$view='_cepal';$ped='';$cat_='';$prm='';
$row=array('id'=>'','catalogo'=>'','4'=>'','3'=>'','120'=>'','103'=>'0.00','titulo'=>'','ficha'=>'NO EXISTEN LIBROS PARA MOSTRAR','prm'=>'','orden'=>'','materia'=>'CATALOGO VACIO','orderMat'=>'','catalogo_id'=>'','cat'=>'','tipo'=>'','registros'=>'','estado'=>'','nombre'=>$cat,'periodo'=>'','gestion'=>date('Y'),'file'=>'','pais'=>'','send'=>'','text'=>'','catalogo_usuario'=>0);
if(isset($tipo)){$view=$tipo.$view;$cat_='_cat';}
if(isset($sUs_usuarios_nivel)&&$sUs_usuarios_nivel<=2){
	$ped=",(SELECT pedidos_cantidad from pedidos WHERE cepal_id=$name$view.id AND usuarios_id = '".$sUs_usuarios_id."')as `pedido`";
}elseif(isset($sUs_usuarios_nivel)&&$sUs_usuarios_nivel>2){
	$ped=",(SELECT count(pedidos_cantidad) from pedidos WHERE cepal_id=$name$view.id)as `pedido`";
}
$$name=new DataBase;
$$name->columns="* $ped";
$$name->tabla="$name$view";
$$name->where="catalogo$cat_='$cat'";
if(!isset($_SESSION['la']['usuarios']['usuarios_nivel'])||$_SESSION['la']['usuarios']['usuarios_nivel']<3){
	$$name->where.=" AND `4`regexp'[MS]'";
}
$$name->order='orderMat,prm,orden';
$$name->_query('SELECT');
			//										print_pre($$name->q_query);
if($$name->q_num_rows>0)$row=$$name->q_fetch_assoc;
extract($row,EXTR_PREFIX_ALL,'ss');
do{
	($ss_tipo=='oferta'?$row['120']=$row['grupo']:'');
	$precioVen=(isset($row['precio'])?$row['precio']:$row['103']);
	if($ss_file!='none'){
		if($materia_!=$row['materia']){
			if($materia_==''){
				$campos.="<table id='catalogo-$cat-".str_replace(array(' ','-'),array('',''),$row['materia'])."' class='catCep'>";
			}else{
				$campos.="</tbody></table><table id='catalogo-$cat-".str_replace(array(' ','-'),array('',''),$row['materia'])."' class='catCep'>";
			}
		$campos.="<thead><tr><th class='colspan' colspan='3'>".$row['materia']."</th></tr>
<tr><th class='firstchild'>NUM.</th><th>DESCRIPCION</th><th>\$US</th></tr></thead><tbody>";
		}
	}else{
		if($materia_==''){
					//									echo '<br>'.$materia_;
			$campos.="<table id='catalogo-$cat' class='catCep'>
<thead><tr><th class='colspan' colspan='3'></th></tr>
<tr><th class='firstchild'>NUM.</th><th>DESCRIPCION</th><th>\$US</th></tr></thead><tbody>";
		}
	}
	$campos.=(($row['120']!=$prm||$row['materia']!=$materia_)&&$ss_file!='none'?"<tr class='prm' style=''><td colspan='3'>$row[120]</td></tr>" : "");
	$campos.="<tr><td>".($row['estado']!='cerrado'||$ss_tipo=='oferta'?$numeracion:(substr($row[3],-3)+0)).".</td>
	<td class='sliding_product descr'><div class='copyRightClick'>";
	$a=0;
	$campos.=$row['ficha'].'<br>';
	if(isset($_SESSION['la']['usuarios']['usuarios_nivel'])&&$_SESSION['la']['usuarios']['usuarios_nivel']>2){
		$edt_=($$name->q_qty_rows['fr']?"<span class='link'><a onclick='editData(\"cepal\",\"".$row['id']."\")'>Editar</a></span>":'');
		$ped_=(isset($row['pedido'])?"<!--<span class='link' style='margin:0 15px;'><a onclick='pedidos(\"$row[id]\",\"$row[titulo]\")'>pedido: $row[pedido]</a></span>-->":"");
	}
	if(!isset($_SESSION['la']['usuarios']['usuarios_nivel'])||$sUs_usuarios_nivel<3){
		$ped_="<span class='link' style='margin:0 15px;'><a onclick='addCart(\"$row[id]\")'><img src='images/addkart.png' height='25px' /></a></span>";
	}
	$campos.="</div><div style='margin:5px;'>".$ped_.$edt_."</div></td><td>$precioVen</td></tr>";
	$materia_=$row['materia'];
	$prm=$row['120'];
	($row['estado']=='procesando'?$codInNew.="UPDATE cepal SET `3`=CONCAT(\'$cat | \',LPAD($numeracion,3,0)) WHERE id=$row[id];":'');
	$numeracion++;

}while($row=mysqli_fetch_assoc($$name->q_src));
	$campos.="</tbody></table>";
?>
<header class="s-head">
	<?PHP
	echo "$ss_nombre $ss_periodo $ss_gestion<br />No. de Catalogo: $ss_cat. Registros: ".$$name->q_qty_rows['fr'].". ";
	if(isset($sUs_usuarios_nivel)&&$sUs_usuarios_nivel>2){
		echo $ss_cat;
		?>
	<div class="no-title">
		Estado del Catalogo: <?PHP echo $ss_estado;?>&nbsp;&nbsp;--&nbsp;&nbsp;
		Exportar a: <span class="link"><a onclick='excelexp("<?PHP  echo "catalogo-$ss_cat";?>")'><img src="images/msexcel.png" height="20" alt="EXCEL" style="vertical-align: middle;"/></a></span>
		<?PHP if($sUs_usuarios_nivel>4||($sUs_usuarios_nivel>3&&$ss_estado=='cerrado')){?>
<span class="link"><a onclick='wordcat("<?PHP  echo "cat=$ss_cat&nombre=$ss_nombre&periodo=$ss_periodo&gestion=$ss_gestion&estado=$ss_estado&tipo=$ss_tipo&file=$ss_file";?>")'><img src="images/msword.png" height="20" alt="WORD" style="vertical-align: middle;"/></a></span>
		<?PHP }?>
		<?PHP if($sUs_usuarios_nivel>6||($ss_estado=='cerrado'&&$sUs_usuarios_nivel>4)&&(!isset($tipo))){?>
		<span class="link"><a onclick='isocat("<?PHP  echo "cat=$ss_cat";?>")'><img src="images/iso.png" height="20" alt="ISO" style="vertical-align: middle;"/></a></span><br />
		<?PHP }elseif($ss_estado=='abierto'&&$sUs_usuarios_nivel>4&&($ss_tipo=='oferta'||$tipo=='oferta')){?>
		<span class="link"><a onclick='editData("catalogooferta_cepal","<?PHP echo ($cat);?>")'>EDITAR REGISTROS</a></span><br />
		<?PHP }
		if($ss_estado=='procesando'){
			echo "<span class='link'><a onclick='closecat(\"$ss_cat\")'>Cerrar Catalogo</a></span>";
		}?>
	</div>
	<?PHP }?>
</header>
<section class="wabody" onscroll="scrollWABody()" style="margin:0px;min-height:300px;">
<?PHP  echo $campos;?>
</section>
<footer class="s-foot"></footer>
<script type="text/javascript">
/** funciones para catalogsNum*/
function pedidos(id,titulo){
	var dts={name:'pedidos',id:id,titulo:titulo,usuario:'<?PHP  echo (isset($sUs_usuarios_id)?"$sUs_usuarios_id":'');?>'}
	if($('#cabecera').prev().attr('id')!='gost'){$('#cabecera').before('<div id="gost" style=""><div id="workdata"></div></div>')}
	$('#gost>#workdata').html(carga1);
	$('#gost>#workdata').load('files/pedidos.php',dts);
}
function wordcat(id){
	window.open('files/catalogsDoc.php?<?PHP  echo "cat=$ss_cat&nombre=$ss_nombre&periodo=$ss_periodo&gestion=$ss_gestion&estado=$ss_estado&tipo=$ss_tipo&file=$ss_file";?>','<?PHP  echo $ss_cat?>',"toolbar=no,menubar=no,location=no");
}
function isocat(id){
	window.open('files/catalogsIso.php?<?PHP  echo "cat=$ss_cat";?>','Iso.Application',"toolbar=no,menubar=no,location=no");
}
function closecat(id){
	if(confirm("Va ha cerrar el Catálogo \"<?PHP  echo $ss_cat;?>\"\n\n"+
		"Tenga en cuenta que cuando se cierra un catálogo\n"+
		"ya no será posible añadir mas libros ni modificar\n"+
		"el órden, el Código del Libro será asignado según\n"+
		"el órden del catálogo.\n\n"+
		"Asegurese de crear una nuevo catálogo para el país\n"+
		"antes de cerrar un catálogo tipo Blanket.\n\n")){
		var dts = {tipo:'QUERY'};
		var codInNew='<?PHP  echo $codInNew;?>';
		dts.datas={querys:"UPDATE catalogo SET estado='cerrado' WHERE cat='"+id+"';"+codInNew,id:'<?PHP  echo $row['id'];?>'};
		if($('#cabecera').prev().attr('id')!='gost'){$('#cabecera').before('<div id="gost"><div id="gost2"></div><div id="wd"></div></div>')}
		$('#gost>#wd').html(carga1).load('files/sql.php',dts);
	}
}
//fin de funciones para gatalogsNum
</script>