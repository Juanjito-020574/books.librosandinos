<?php
header("Content-Type: application/force-download; charset=ISO-8859-1");
header("Content-Disposition: inline; filename=".($_GET['cat']?$_GET['cat']:'cepal-'.date('Y-m-d')).".iso;");
header("Content-Transfer-Encoding: binary");
if(!function_exists('include_if_exists')){include('../system/functions.php');};$nivMin=1;
include('../system/verif_user.php');
extract($_REQUEST);
if(!isset($_SESSION))session_start();
$name='cepal';$campos='';
$$name=new DataBase;
$$name->names_="SET NAMES cp850";
$$name->tabla=$name;
$$name->where=($cat?"`122`='$cat'":"");
$$name->order="`3`";
$$name->_query('SELECT');
$row=$$name->q_fetch_assoc;
do{
	$psc=0;
	$campo='';
	$valor='';
	$dir='';
	foreach($row as $i=>$v){
		if($v!=''&&$i!='id'){
			if(count(explode(' | ',$v))>1){
				foreach(explode(' | ',$v) as $vv){
					$valor.="$vv";
					$dir.=str_pad($i, 3, "0", STR_PAD_LEFT).str_pad(strlen("$vv"),4,"0",STR_PAD_LEFT).str_pad($psc,5,"0",STR_PAD_LEFT);
					$psc+=strlen("$vv");
				}
			}else{
				$valor.="$v";
				$dir.=str_pad($i, 3, "0", STR_PAD_LEFT).str_pad(strlen("$v"),4,"0",STR_PAD_LEFT).str_pad($psc,5,"0",STR_PAD_LEFT);
				$psc+=strlen("$v");
			}
		}
	}
	$head=array(str_pad((strlen("$dir")+strlen("$valor")+24),5,"0",STR_PAD_LEFT),"0000000",str_pad((strlen("$dir")+24),5,"0",STR_PAD_LEFT),"0004500");
	$registro=implode('',$head)."$dir$valor";
	$campos.=chunk_split($registro,80,"\r\n");
}While($row=mysqli_fetch_assoc($$name->q_src));
echo $campos;
?>
