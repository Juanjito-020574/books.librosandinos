<?PHP
class DataBase{//para el subir al FTP borrar despues del '=' hasta los comentarios á '//'
//	private static $db_host='localhost',$db_user='librosandinos',$db_pass='libros_2015',$db_name='librosan_data';
	private static $db_host='72.29.64.235',$db_user='librosandinos_mysql',$db_pass='mysql_2019',$db_name='librosan_data';
	public $sess='la',$columns='*',$tabla,$join,$where,$group,$order,$limit,$query="",$q_src,$q_query,
	$q_fetch_assoc,$q_num_rows,$q_aff_rows,$q_message,$q_err,$q_qty_rows,$q_desc;
	protected $link;
	protected $rows=Array();
	protected $fields;
	public $names_ = "SET NAMES 'utf8'";
	private $lc_mess_ = "SET @@session.lc_messages = 'es_ES'";
//	private $gc_mess_ = "SET @@session.group_concat_max_len = 11024";

	/** Funcion Constructora. Devuelve la tabla y la lista de campos
	 * Si se especifica el nombre de la tabla se retornará la descripción de los campos */
	public function __construct($tabla=false,$campos=false){
		if($tabla){
			$this->tabla=$tabla;
			$this->q_desc=$this->_queryDesc($tabla,$campos);
		}
		if($campos){$this->columns=$campos;}
	}
	/** Conectar a la base de datos*/
	protected function open_db(){
		$this->link = mysqli_connect(self::$db_host,self::$db_user,self::$db_pass,self::$db_name);
		mysqli_query($this->link,$this->names_);
		mysqli_query($this->link,$this->lc_mess_);
//		mysqli_query($this->link,$this->gc_mess_);
	}
	/** Desconectar la base de datos*/
	protected function close_db(){
//		mysql_free_result($this->link);
		mysqli_close($this->link);
	}

	private function _querySel(){
		$querySel = "SELECT SQL_CALC_FOUND_ROWS $this->columns \nFROM $this->tabla \n".
			($this->join ? " JOIN $this->join \n" : "").
			($this->where ? " WHERE $this->where \n" : "").
			($this->group ? " GROUP BY $this->group" : "").
			($this->order ? " ORDER BY $this->order" : "").
			($this->limit ? " LIMIT $this->limit;" : ";");
		if(!$this->query || $this->query==null){
			$this->query = $querySel;
		}
	}
	public function _queryExtra(){
		$this->open_db();
			$this->q_src=mysqli_query($this->link,$this->query);
			$this->q_qty_rows=mysqli_query($this->link,'FOUND_ROWS();');
			$this->q_query=$this->query;
		//	$this->q_num_rows=mysqli_num_rows($this->q_src);
		//	$this->q_fetch_assoc=mysqli_fetch_assoc($this->q_src);
			$this->q_aff_rows=mysqli_affected_rows($this->link);
			$this->q_message = "Tiene $result[num_rows] registros.";
		$this->close_db();
	}

	private function _queryDesc($table,$campos=false){
		$descamp='';
		if($campos){
			$campos=preg_replace(array('/\*/','/,/'),array('','|'),$campos);
			$descamp=" where field regexp '$campos'";
		}
		$this->open_db();
		$qry=mysqli_query($this->link,"SHOW FULL COLUMNS FROM $table$descamp");
		$rows = mysqli_fetch_assoc($qry);
		$propiedadesTabla=array('visible'=>1,'nuevo'=>'normal','edit'=>'normal','predet'=>'','attr'=>'');
		do{
			parse_str($rows['Comment'],$comment);
			$row[$rows['Field']]=array_merge($propiedadesTabla,$comment);
		}while($rows=mysqli_fetch_assoc($qry));
						//								print_pre($row);
		$pass=substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
		foreach($row as $i=>$v){
			foreach($v as $vi=>$vv){
				if(($vi=='predet' || $vi=='select' || $vi== 'dep')&&$vv){
					$vv=str_replace(array('\\\\','\\'),array('\\','\\'),$vv);
					$r[$vi][$i]=eval("return $vv;");
				}else{
					$r[$vi][$i]=str_replace(array('\\\\','\\'),array('\\','\\'),$vv);
				}
			}
		}
		return $r;
		$this->close_db();
	}
	/** Ejecutar un query simple del tipo SELECT INSERT, DELETE, UPDATE */
	public function _query($type){
		$this->open_db();
		switch($type){
			case 'SELECT':
				$this->_querySel();
				$this->q_src = mysqli_query($this->link,$this->query);
				$this->q_qty_rows=mysqli_fetch_assoc(mysqli_query($this->link,'SELECT FOUND_ROWS() as `fr`;'));
				$this->q_query = $this->query;
				$this->q_num_rows = mysqli_num_rows($this->q_src);
				$this->q_fetch_assoc = mysqli_fetch_assoc($this->q_src);
				$this->q_message = "Tiene $this->q_num_rows registros.";
				$this->q_err = "(cod: ".mysqli_errno($this->link).") ".mysqli_error($this->link)."<br/>";
			break;
			case 'UPDATE':
				$this->q_src=mysqli_query($this->link,$this->query);
				$this->q_query=$this->query;
				$this->q_aff_rows = mysqli_affected_rows($this->link);
				$this->q_mensaje = "Se han modificado $this->q_aff_rows registros ";
				$this->q_err = "(cod: ".mysqli_errno($this->link)."): ".mysqli_error($this->link)."<br/>";
			break;
			case 'INSERT':
				$this->q_src=mysqli_query($this->link,$this->query);
				$this->q_query=$this->query;
				$this->q_aff_rows=mysqli_affected_rows($this->link);
				$this->q_message="Se han insertado $this->q_aff_rows registros ";
				$this->q_err = "(cod: ".mysqli_errno($this->link)."): ".mysqli_error($this->link)."<br/>";
			break;
			case 'DELETE':
				$this->q_src=mysqli_query($this->link,$this->query);
				$this->q_query=$this->query;
				$this->q_aff_rows=mysqli_affected_rows($this->link);
				$this->q_mensaje="Se han eliminado $this->q_aff_rows registros ";
				$this->q_err = "(cod: ".mysqli_errno($this->link)."): ".mysqli_error($this->link)."<br/>";
			break;
			default:
			break;
		}
		$this->close_db();
	}
	/** Funcion para encriptar los passwords*/
	public function _encript($text){
		$enc1 = hash("sha512",$text); //Encriptacion nivel 1
		$enc2 = crypt($enc1,"xtemp"); //Encriptacion nivel 2
		$enc3 = hash("sha1",$enc2); //Encriptacion nivel 3
		$enc4 = crypt($enc3, "xtemp"); //Encriptacion nivel 4
		$enc5 = hash("sha1",$enc3); //Encriptacion nivel 5
		return $enc5;
	}
	/** Funcion para crear los selects*/
	public function _option($arrayOpt,$selected=null,$tabla=null){
		$res='';
		($selected=='seleccionar'||!array_key_exists($selected,$arrayOpt) ? $res = "<option value='' label='seleccionar'>seleccionar</option>" : "");
		(!isset($selected) ? $res = "<option value='' label='columa(*)'>columa(*)</option>" : "");
//		print_pre($arrayOpt);
//		asort($arrayOpt);
		foreach($arrayOpt as $i => $v){
			if($i==$selected){
				$res .= "<option value='$i' label='$v' selected='' >$v</option>\n";
			}else{
				$res .= "<option value='$i' label='$v' >$v</option>\n";
			}
			if(($tabla=='usuarios'||$tabla=='usuarios_cli')&&$i==($_SESSION['la']['usuarios']['usuarios_nivel']-1)&&($_SESSION['la']['usuarios']['usuarios_nivel']<7)){
				break;
			}
		}
		return $res;
	}
	/** funcion para crear las columnas para las tablas de presentación de datos*/
	public function leerTabla($visible,$campo,$titulo,$columna=false,$select=false){
		if($columna){$etq="td";$value=$columna;}else{$etq="th";$value=$titulo;}
		foreach($visible as $i => $v){
			if(isset($select[$i][$value[$i]])){$value[$i]=$select[$i][$value[$i]];}
			switch($v){
				case -1:
					if($campo[$i]=='catalogo_id')$i='cat';
					echo"<$etq style='display:none' class='".($campo[$i]?$campo[$i]:$i)."'>".$value[$i]."</$etq>";
				break;
				case 0:
					echo"";
				break;
				default:
					echo"<$etq class='".($campo[$i]?$campo[$i]:$i)."'>".$value[$i]."</$etq>";
				break;
			}
		}
	}
	public function _mysqli_real_escape_string($cadena){
		$this->open_db();
		return mysqli_real_escape_string($this->link,$cadena);
	}
}
?>
