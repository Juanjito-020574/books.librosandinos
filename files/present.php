<?PHP
if(!isset($_SESSION))session_start();
$nivel=isset($_SESSION['la']['usuarios']['usuarios_nivel'])?$_SESSION['la']['usuarios']['usuarios_nivel']:0;
									//										echo $nivel;
if(isset($num)){
	$recStart=($num-1)*$recView;
	$pagAct=$num;
}else{
	$recStart=0;
	$pagAct=1;
}
$$name=new DataBase;
$$name->tabla="cepal$view";
$$name->where=(isset($where)?$where:'');
$$name->order=(isset($order)?$order:'');
$$name->limit="$recStart,$recView";
$$name->_query('SELECT');
$row=$$name->q_fetch_assoc;	//									echo $$name->q_query;
if($$name->q_num_rows>0){
	$recQty=$$name->q_qty_rows['fr'];
	$recLast=$recStart+$$name->q_num_rows;
	$arch="$name.html";
	$titTxt = "<b>$recQty</b> $titTxt.";
	$pagPrev=$pagAct-1;
	$pagNext=$pagAct+1;
	if(($recQty%$recView)>0){
		$pagLast=floor($recQty/$recView)+1;
	}else{
		$pagLast=$recQty/$recView;
	}
	if($num<=$pagLast){?>
	<header class="s-head">
		<?PHP echo "$titTxt";?>
		<?PHP include "paginator.php";?>
	</header>
	<div class="wabody" onscroll="scrollWABody()">
	<?PHP do{include "presentCam.php";}While($row=mysqli_fetch_assoc($$name->q_src));?>
	</div>
	<footer class="s-foot">
	</footer>
	<?PHP }else{if($arch!='files/find.php')include('vacio.php');}
}else{
	echo "<header class='s-head'>$titTxt</header>
	<div>$nodata</div>
	<footer class='s-foot'>";
	include('contact.php');
	echo "</footer>";
}
?>
<script type="text/javascript">
title_('<?PHP echo"$name $pagAct";?>');
$('#buscarF input,#buscarA input').not(':submit').val('');
<?PHP echo isset($findCamp)?$findCamp:'';?>
</script>