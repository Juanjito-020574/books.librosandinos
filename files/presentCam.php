<?PHP
									//							echo $nivel;
switch($name){
	case 'novelties':
		$cmp=array('autor','titulo','autor_i','isbn','issn','paginas','editorial','edicion','fecha_pub','medidas','stock',
'p_venta','codweb','id','imagen');
		$class='dobleCol';
		extract(presCepal($row,$cmp,false,$nivel));
		$head=$pv."<span class='figure'><figure id='slidingProduct".$row['id']."' class='sliding_product'>".$stk1.$imgSrc."</figure></span>".$codCtrol;
		$foot=$cart.$ficha.$edit;
	break;
	case 'offers':
		$cmp=array('autor','titulo','autor_i','coleccion','no_vol','tot_vols','isbn','vol_serie','no_serie','issn',
'paginas','editorial','ciudad','edicion','fecha_pub','medidas','stock','p_venta','codweb','id','imagen');
		$class='singleCol';
		extract(presCepal($row,$cmp,false,$nivel));
		$head="<figure id='slidingProduct".$row['id']."' class='sliding_product'>".$stk1.$imgSrc."</figure>";
		$foot=$pv.$codCtrol.$cart.$ficha.$edit;
	break;
	case 'find':
		$cmp=array('autor','titulo','autor_i','coleccion','no_vol','tot_vols','isbn','vol_serie','no_serie','issn',
'paginas','editorial','ciudad','edicion','fecha_pub','medidas','stock','p_venta','codweb','id','imagen');
		$class='singleCol';
		$row2=preg_replace($wordsRep1,'<strong>$1</strong>',$row);
		extract(presCepal($row2,$cmp,false,$nivel));
		$head="<figure id='slidingProduct".$row['id']."' class='sliding_product'>".$stk1.$imgSrc."</figure>";
		$foot=$pv.$codCtrol.$cart.$ficha.$edit;
	break;
}?>
<article class="<?PHP echo $class;?>">
	<header class="a-head"><?PHP echo $head;?>
	</header>
	<div class="libro">
		<?PHP echo $txt;?>
	</div>
	<footer class="a-foot">
		<?PHP echo $foot;?>
	</footer>
</article>
