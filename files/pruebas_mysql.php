<?PHP
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
include($ruta.'system/functions.php');$nivMin = 7;
include($ruta.'system/verif_user.php');
if(!isset($_SESSION))session_start();
				//						print_pre($_SERVER);
extract($_REQUEST);
			//							print_r($_REQUEST);
if($sql){
	$name=trim(preg_replace('/(.+)(from )([\w\d_]+)(\s*.*)/','$3',$sql));
	$column=trim(preg_replace('/select(.+)from .*/','$1',$sql));
	$$name=new DataBase($name,($column?$column:null));
	$$name->query=$sql;
	$format=$$name->q_desc;
	$dh['add']=0;$dh['edit']=0;$dh['del']=0;$dh['xls']=0;
	$$name->_query('SELECT');
	$row=$$name->q_fetch_assoc;
}
?>
<form id="f_sql" action="javascript:void(0)" method="post">
<div class="text0 sql">
	<textarea id="sql"><?PHP echo $sql;?></textarea>
</div>
<input id="send_sql" type="submit" class="boton" style="margin-bottom:10px;" onclick="sql_send()" value="send" />
<input id="salir_wd" type="button" class="boton" style="margin-bottom:10px;" onclick="closeDw()" value="Salir" />
</form>
<div id="resultSql"><?PHP echo $$name->q_query;echo $table;
	if($row){
		do{
			$rows[$row[array_keys($row)[0]]]=json_encode($row,JSON_FORCE_OBJECT | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE);
		}while($row = mysqli_fetch_assoc($$name->q_src));
		print_prev($rows);
	}?></div>
<script type='text/javascript'>
function sql_send(){
	var sql=$('#sql').val();
	$('#workarea').load('files/pruebas_mysql.php',{sql:sql});
}
</script>

