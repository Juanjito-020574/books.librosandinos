<?PHP //$b debe definirse en el archivo origen
$b="";
if(isset($f)){
	$b.="&f=$f";
}
if(isset($datos)){
	foreach($datos as $i=>$v){
		$b.="&datos[$i]=".preg_replace("/[\s.,]/","+",$v);
	}
}
?>
<ul id='paginar'>
	<?PHP if($pagAct>1) { ?>
<li><a class="a" href="<?PHP echo "$arch?".urlencode("num=1$b")?>" title="Primero"><<</a></li>
<li><a class="a" href="<?PHP echo "$arch?".urlencode("num=$pagPrev$b")?>" title="Anterior"><</a></li>
	<?PHP }else{?>
<li style="visibility: hidden;"><a><<</a></li>
<li style="visibility: hidden;"><a><</a></li>
	<?PHP }?>
<div><?PHP	echo "Página <font style='font-weight: bold;'>$pagAct</font> de <font style='font-weight: bold;'>$pagLast</font>";?></div>
	<?PHP if($pagAct<$pagLast) {?>
<li><a class="a" href="<?PHP echo "$arch?".urlencode("num=$pagNext$b")?>" title="Siguiente" >></a></li>
<li><a class="a" href="<?PHP echo "$arch?".urlencode("num=$pagLast$b")?>" title="Ultimo" >>></a></li>
	<?PHP }else{?>
<li style="visibility: hidden;"><a>></a></li>
<li style="visibility: hidden;"><a>>></a></li>
		<?PHP } ?>
</ul>
<?PHP //Fin Paginador?>
