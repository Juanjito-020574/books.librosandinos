<?PHP 
require_once('database.php');
class Login extends DataBase{
	public $login;
	public $logout;
	public $loged;
	public $msgUsr;
	public $data = array();

	public function __construct($tabla=null){
		if($tabla){
			parent::__construct($tabla);
		}
	}

	/**_loged() Metodo de Login que verifica si el usuario se ha conectado*/
	public function _loged(){
		$this->msgUsr = $this->loged;
	}

	/**_logout() Metodo de Login para desconectar al usuario*/
	public function _logout(){
		if(!isset($_SESSION))session_start();
		unset($_SESSION[$this->sess]);
		$this->msgUsr = $this->logout;
	}

	/**_login() Metodo de Login para conectar a un usuario*/
	public function _login(){
		if($this->data["user"]=="" || $this->data["pass"]==""){
			$this->msgUsr = "Debe llenar todos los campos";
		}else{
			$this->columns = "usuarios_id,usuarios_nick,usuarios_pass,usuarios_mail,usuarios_nombres,usuarios_apellidos,usuarios_nivel,usuarios_session";
			$this->where = "usuarios_nick='".$this->_mysqli_real_escape_string($this->data['user'])."' AND usuarios_pass = '".$this->_encript($this->_mysqli_real_escape_string($this->data['pass']))."'";
			$this->_query("SELECT");
			$user = $this->q_fetch_assoc;
			if($this->q_num_rows == 1){
				$this->_regSess($user);
				$this->msgUsr=$this->login;
			}elseif($this->data["user"]!=$user["usuarios_nick"]&&$this->data["pass"]!=$user["usuarios_pass"]){
				$this->msgUsr = "Nombre de Usuario y/o Contraseña incorrectos";
			}
		}
	}

	/**_regSess Metodo de Login para registrar las sesiones al logearse*/
	private function _regSess($data){
		if(!isset($_SESSION))session_start();
		$this->query="UPDATE user_data SET usuarios_session='".session_id()."' WHERE usuarios_id='$data[usuarios_id]'" ;
		$this->_query('UPDATE');
		if($this->q_aff_rows==1){$data['usuarios_session']=session_id();}
		foreach($data as $i=>$v){
			$ii = explode('_',$i);
			$_SESSION[$this->sess][$ii[0]][$i]=$v;
		}
		if(isset($_SESSION['la']['compras'])){
			$compras=$_SESSION['la']['compras'];
			foreach($compras as $i=>$v){
				$_SESSION['la']['compras'][$i]['usuarios_id']=$data['usuarios_id'];
				$_SESSION['la']['compras'][$i]['uniq_id']=$data['usuarios_id']."_".$_SESSION['la']['compras'][$i]['id'];
			}
		}
	}
}
?>