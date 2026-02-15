<?PHP
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
if(!function_exists('include_if_exists'))include($ruta.'system/functions.php');
include($ruta.'system/Login.php');
if(!isset($_SESSION))session_start();
$logg='';$closeBotton='';
extract($_REQUEST);
		//										print_pre($_REQUEST);
$ob = 'user_data';
$$ob = new Login;
$$ob->tabla=$ob;
$$ob->data = $_REQUEST;

if((isset($_SESSION['la']['usuarios']) && $logg=='')){
		$$ob->loged = "--- <span>".$_SESSION['la']['usuarios']['usuarios_nick']."</span> ---<br />Revisa tu menu de usuario para mas opciones habilitadas en tu cuenta";
		$$ob->_loged();
}else{
	switch($logg){
		case 'login':
			$$ob->login = "<script type=\"text/javascript\">$(\"body\").empty();self.location.reload();</script>";
			$$ob->_login();
		break;
		case 'logoff':
			$$ob->logout = "<script type=\"text/javascript\">/*unsetCookie('mck');unsetCookie('".session_id()."');*/$(\"body\").empty();self.location.reload();</script>";
			$$ob->_logout();
	}
?>
	<form id="logg" style="" method="post" autocomplete="off" action="javascript:void(0)">
		<div class="formLog">
			<input type="text" id="user" name="user" placeholder="Usuario" required="" />
		</div>
		<div class="formLog">
			<input type="password" id="pass" name="pass" placeholder="Contraseña" required="" /><!--cambiar por password -->
		</div>
		<input class="submitLog" type="button" onclick="newData('<?PHP echo (!isset($_SESSION['la']['usuarios']['usuarios_nivel'])||$_SESSION['la']['usuarios']['usuarios_nivel']<3)?'usuarios_cli':'usuarios'?>')" value="Nuevo" />
		<input class="submitLog" type="submit" onclick="log_in()" value="Acceder" />
	</form>
<?PHP
}
$msgExt=(!isset($msgUsr) ? (substr($$ob->msgUsr,0,7)!='<script'?$$ob->msgUsr:'') : $msgUsr);
?>
<div id="msgUsr"><?PHP if(isset($_SESSION['la']['usuarios'])){
echo "Bienvenid@:<br />&laquo; <strong>".$_SESSION['la']['usuarios']['usuarios_nick']."</strong> &raquo;".($_SESSION['la']['usuarios']['usuarios_nivel']>4?"<br />":'');
}?></div>
<div id="scpt"><?PHP echo $$ob->msgUsr;?></div>
<script type='text/javascript'>
	notice('<?PHP echo "$msgExt";?>');
</script>
