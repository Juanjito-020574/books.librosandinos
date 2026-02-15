<?PHP
$XR=(($sUs_usuarios_nivel>=$nivMin&&isset($dh['xls'])&&$dh['xls']>0)?"class='habil' href='javascript:void(0)' onclick=''":"class='deshabil'");
$NR=(($sUs_usuarios_nivel>=$nivMin&&isset($dh['add'])&&$dh['add']>0)?"class='habil' href='javascript:void(0)' onclick=''":"class='deshabil'");
$ER=(($sUs_usuarios_nivel>=$nivMin&&isset($dh['edit'])&&$dh['edit']>0)?"class='habil' href='javascript:void(0)' onclick=''":"class='deshabil'" );
$DR=(($sUs_usuarios_nivel>=$nivMin&&isset($dh['del'])&&$dh['del']>0)?"class='habil' href='javascript:void(0)' onclick=''":"class='deshabil'");
$SD=(($sUs_usuarios_nivel>=$nivMin)?"'" : "disabled='' class='deshabil'");
$excelReg="<div id='xls'><a $XR><img src='images/".($dh['xls']>0?'msexcel':'msdisab').".png' />Export</a></div><div class='separador'></div>";
$nuevoReg="<div id='add'><a $NR><img src='images/".($dh['add']>0?'add':'bt_disabled').".png' />Nuevo</a></div><div class='separador'></div>";
$editReg="<div id='edit'><a $ER><img src='images/".($dh['edit']>0?'editar':'edt_dis').".png' />Editar</a></div>";
$delReg="<div id='del'><a $DR><img src='images/".($dh['del']>0?'del':'bt_disabled').".png' />Borrar</a></div><div class='separador'></div>";
$optSerch=array_intersect_key($format['titulo'],array_filter($format['visible'],function ($element){ return ($element > 0); }));
print_pre($optSerch);
$search_select = "<select id='select_search' $SD title='seleccione el campo por el que quiere filtrar'>".$$name->_option($optSerch)."</select>";
$search = "<div id='search'><div class='text0'><img src='images/find.png' /><input placeholder='Busque $name aqui' id='filtrarTable' $SD type='text' title='escriba 1 o mas letras de la palabra que quiere filtrar' /><div class='separador'></div>$search_select</div></div>";
$menuEdicion="<div class='menuEdicion'>$excelReg$nuevoReg$delReg$editReg$search</div>";
if(!isset($msgTable)||$msgTable==''){
	$msgTable="&nbsp;&nbsp;&nbsp; REGISTROS: ".$$name->q_qty_rows['fr'];
	$msgTable.="&nbsp;&nbsp;&nbsp; VISIBLES: <div id='limit' class='".self()."'><input value='".$_SESSION['la']['limit'][self()]."' /></div>";
}
		//					print_pre($$name->q_query);
?>
<header class="s-head sTable">
<?PHP echo "TABLA: ".$tituloTabla.$msgTable.$menuEdicion;
?>
</header>
<div class="wabody" onscroll="scrollWABody()">
<table id="<?PHP echo "l_$name$view";?>">
<?PHP
echo "<thead><tr><th width='20px'><img class='chkdAll' src='images/checkstd.png' height='12px' /></th>";
$$name->leerTabla($format['visible'],$format['campo'],$format['titulo']);
echo ($$name->tabla=='catalogo'?'<th style="text-align:center;width:10%;">---</th>':'');
echo "</tr></thead><tbody class='filterBody' >";
$filtered_array = array_filter($format['visible'],function($element){return($element>=1);});//function($elemnt) es la funcion para el filtrado de los campos visibles para realizar el colspan
if($$name->q_num_rows==0){
	echo "<tr class='active'><td style='text-align:center;'>\n<img src='images/checkstd.png' height='12px' />
		</td><td colspan='".count($filtered_array)."' style='text-align:center;'>
		No existen registros</td></tr>";
}else{
	do{
		if(isset($row['ventas_id'])){
			$row['ventas_id']=str_pad($row['ventas_id'],5,0,STR_PAD_LEFT);
			$row['ventas_fact']=str_pad($row['ventas_fact'],5,0,STR_PAD_LEFT);
			$row['ventas_fecha']=date("M d, Y", strtotime($row['ventas_fecha']));
		}
		if(isset($row['usuarios_nivel'])){
			$row['usuarios_nivel']=$format['select']['usuarios_nivel'][$row['usuarios_nivel']];
//		print_pre($format);
		}
		if((isset($_SESSION['la']['usuarios'][$tId])&&$_SESSION['la']['usuarios'][$tId]==$row[$tId])||(isset($id)&&$id==$row[$tId])){
			echo "<tr id='$tId|$row[$tId]".($$name->tabla=='catalogo'?"|$row[tipo]":"")."' class='active clave'>\n<td width='20px' style='text-align:center;'>\n<img class='chkd' src='images/checkstd.png' height='12px' />\n</td>";
		}else{
			echo "<tr id='$tId|$row[$tId]".($$name->tabla=='catalogo'?"|$row[tipo]":"")."'>\n<td style='text-align:center;'>\n<img class='chkd' src='images/checkstd.png' height='12px' />\n</td>";
		}
		$$name->leerTabla($format['visible'],$format['campo'],$format['titulo'],$row,(isset($format['select'])?$format['select']:null));
		if($$name->tabla=='catalogo'){
			$of=($row['tipo']=='oferta'?'&tipo=oferta':'');
			$qrStr="cat=$row[cat]$of";
			echo "<td style='text-align:center;'><span class='ahtm'><a class='a' href='catalogsNum.html?".urlencode($qrStr)."'>Ver</a></span></td>";
		}
		echo "</tr>";
	}while($row = mysqli_fetch_assoc($$name->q_src));
}
echo '</tbody>';
if($name=='pedidos'&&$view=='_detalle'){
	$view='';
}
?>
<tfoot style="color: #FF6600;"><tr><td colspan='<?PHP echo count($filtered_array)+1;?>' id="msgT"></td></tr></tfoot>
</table>
</div>
<footer class="s-foot"></footer>
<div id="scriptRejilla">
<script type="text/javascript">
$('#limit>input').on('change',function(e){
	var query='<?PHP echo preg_replace(array('/[\n\r\t]+/m','/[\'\"]+/'),array(' ','\\\''),$$name->q_query);?>';
	$('#workarea').html(carga).load('files/'+$(this).parent().attr('class')+'.php',{<?PHP echo ($view!=''?"'view':'$view',":'');?>'limit':$(this).val(),query:query.replace(/(limit )([0-9]+)/ig,'$1'+$(this).val())})
})
$('#xls>a.habil').attr('onclick',"excelexp()");
$('#add>a.habil').attr('onclick',"newData('"+$('.wabody table').attr('id')+"')");
$('#edit>a.habil').attr('onclick',"editData('"+$('.wabody table').attr('id')+"','"+$('tr.active').find('td:nth-child(2)').text()+"')")
$('#del>a.habil').attr('onclick',"delData('"+$('.wabody table').attr('id')+"','"+$('tr.active').find('td:nth-child(2)').text()+"')")
tableFilter('#l_<?PHP echo "$name$view";?>','#filtrarTable',0,0);
$('.filterBody tr').activeReg();
$('img.chkd,img.chkdAll').checkRow();
$('#msgTable').html('<?PHP echo $$name->q_num_rows." ".$tituloTabla?>')
</script>
</div>