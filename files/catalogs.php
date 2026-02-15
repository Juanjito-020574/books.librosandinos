<?PHP
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
if(!isset($_SESSION))session_start();
include($ruta.'system/functions.php');$nivMin=0;
include($ruta.'system/verif_user.php');
$name='catalogo';
$$name=new DataBase("$name");
$$name->order="catalogo_id DESC";
if(!isset($_SESSION['la']['usuarios']['usuarios_nivel'])||$sUs_usuarios_nivel<5){
$$name->where="`tipo`='blanket'";
}
if(!isset($_SESSION['la']['usuarios']['usuarios_nivel'])||$sUs_usuarios_nivel<3){
$$name->where="`tipo`='blanket' AND `estado`='cerrado'";
}
$$name->_query('SELECT');
$row=$$name->q_fetch_assoc;
$tabCat='';
$paises['Aa']='pais';
$gestiones['Aa']='gestion';
//echo $$name->q_query;
do{
$tabCat.="<tr class='$row[pais] _$row[gestion] Aa'><td style='display:none;'>$row[cat]</td>";
$tabCat.="<td>$row[nombre] $row[periodo] $row[gestion]. No. $row[cat]</td>";
$tabCat.="<td style='text-align:center;width:50px;'><span class='ahtm'><a class='a' href='catalogsNum.html?".urlencode("cat=$row[cat]".($row['tipo']=='oferta'?'&tipo='.$row['tipo']:''))."'>Ver</a></span></td>";
$tabCat.="</tr>";
if($row['gestion']>0){$gestiones["_".$row['gestion']]=$row['gestion'];}
if($row['pais']!=''){$paises[$row['pais']]=$row['pais'];}
}While($row=mysqli_fetch_assoc($$name->q_src));
ksort($paises);ksort($gestiones);
//								print_pre($gestiones);
//								print_pre($paises);
?>
<header class="s-head">
LISTA DE CATALOGOS
<div>filtrar por:
<div class="select2" style="width:auto;">
<select class="filtro" style="width:auto;" id="paises"><?PHP echo $$name->_option($paises,'Aa');?></select>
<select class="filtro" style="width:auto;" id="gestiones"><?PHP echo $$name->_option($gestiones,'Aa');?></select>
</div>
</div>
</header>
<div class="wabody" onscroll="scrollWABody()">
<table id="catalogo">
<tbody>
<?PHP echo $tabCat?>
</tbody>
</table>
</div>
<footer class="s-foot">
</footer>
