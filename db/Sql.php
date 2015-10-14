<?php
	//Conecta la Aplicacion al Servidor de la Base de Datos
	namespace clases_generales;
	date_default_timezone_set('America/Caracas');
	use PDO,Exception;
	require_once dirname(__FILE__).'/parametros_bd.php';
	class Sql {
		private $dsn=NULL,$motor_bd=NULL,$servidor_bd=NULL,$puerto_bd=NULL,$nombre_bd=NULL,$usuario_bd=NULL,$password_bd=NULL,
		$driver_options=array();
		private static $debug=TRUE;
		const ARRAY_INDEXADO=1,ARRAY_ASOCIATIVO=2,ARRAY_OBJETOS=3;
                const DRIVER_MYSQL = "mysql", DRIVER_POSTGRESQL  = "pgsql";
		public $obj_pdo=NULL,$pdo_statement=NULL;
		
		function __construct(){
			$this->motor_bd = MOTOR_BD;
			$this->servidor_bd = SERVIDOR_BD;
			$this->puerto_bd = PUERTO_BD;
			$this->nombre_bd = NOMBRE_BD;
			$this->usuario_bd = USUARIO_BD;
			$this->password_bd = CLAVE_BD;
			$this->charset = CHARSET;
			$this->driver_options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => FALSE);
			$this->dsn = $this->obtener_dsn();
			if(empty($this->motor_bd) || empty($this->servidor_bd) || empty($this->puerto_bd) || empty($this->nombre_bd) || empty($this->usuario_bd) || empty($this->password_bd) || empty($this->dsn))
				throw new Exception("<b>Error:</b> Verifique los parametros de Conexion!");
		}
		
		function abrir_conexion_especifica($servidor,$usuario,$password,$nombre_BD,$puerto = NULL,$motor_bd = NULL,$array_opciones = array()){
			
			if(!empty($puerto))
				$this->puerto_bd = $puerto;
                        
                        if(!empty($motor_bd))
                            $this->motor_bd = $motor_bd;
                        
                        $this->servidor_bd = $servidor;
			$this->nombre_bd = $nombre_BD;
			$this->usuario_bd = $usuario;
			$this->password_bd = $password;
			if(!empty($array_opciones))
				$this->driver_options = $array_opciones;
			$this->dsn = $this->obtener_dsn();
			$this->abrir_conexion();
		}
		
	// Abre la conexion a la Base de Datos
	   function abrir_conexion(){
	   		try {
	   			$this->obj_pdo = new PDO($this->dsn, $this->usuario_bd, $this->password_bd,$this->driver_options);
                                $this->obj_pdo->query("SET NAMES 'utf8'");
	   			return $this->obj_pdo;
	   		}catch (Exception $e){
	   			$msj="Ocurrió un Error Al intentar conectar con el Servidor!";
	   			if(Sql::get_debug_status()==TRUE)
	   				$msj.="<br>".$e->getMessage();
	   			 	throw new Exception($msj);
	   		}
	   }
	
	   // Cierra la conexion a la Base de Datos
	   function cerrar_conexion(){
	   		unset($this->obj_pdo);
	   }
	   
	   //obtener data source name
	   function obtener_dsn(){
	    	return $this->dsn = $this->motor_bd.":host=".$this->servidor_bd.";port=".$this->puerto_bd.";dbname=".$this->nombre_bd;
	   }
	   
	   
	   //EJECUTA CONSULTA SQL
	   function consulta_bd($sql){

		   	try {
		   		
		   		if(empty($this->obj_pdo)){
		   			throw new Exception("NO EXISTE CONEXIÓN CON EL SERVIDOR DE BASE DE DATOS!");
		   		}
		   		$this->pdo_statement=$this->obj_pdo->query($sql);
		   		if(empty($this->pdo_statement)){
		   			$msj="PROBLEMA AL EJECUTAR LA CONSULTA!";
		   			if (Sql::get_debug_status()==true)
		   				$msj.=" SQL: \"".htmlspecialchars($sql)."\" ...".$this->obtener_error();
		   			throw new Exception($msj);
		   		}else
		   			return $this->pdo_statement;
		   	}catch (Exception $e){
		   		echo "<b>ERROR: </b>".htmlentities($e->getMessage());
		   	}
		   	
	   }
	   
	   function __toString(){
	   	if(is_object($this->obj_pdo))
	   		$msj = $this->obj_pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);
	   	else
	   		$msj = " OBJ NO CREADO ";
	   	
	   	return "Conectado al servidor $this->motor_bd $this->servidor_bd, puerto $this->puerto_bd, base de datos: $this->nombre_bd, estado: ".$msj;
	   }
	   
	
	   
	   //OBTIENE EL ARREGLO COMPLETO DE UNA CONSULTA
	   function obtener_array_consulta($pdo_statement=NULL,$tipo_array=NULL){
	   	//tipo 1 : array indexado .... tipo 2 : array asociativo
	   	if(empty($tipo_array) || $tipo_array==Sql::ARRAY_INDEXADO)
	   		$tipo_array_pdo=PDO::FETCH_NUM;
	   		else if($tipo_array==Sql::ARRAY_ASOCIATIVO)
	   			$tipo_array_pdo=PDO::FETCH_ASSOC;
	   		else if($tipo_array==Sql::ARRAY_OBJETOS)
	   			$tipo_array_pdo=PDO::FETCH_OBJ;
	   		
	   		if(!empty($pdo_statement))
	   			$result_tmp=$pdo_statement;
	   		else
	   			$result_tmp=$this->pdo_statement;

           ################### EDITADO PARA QUE HAGA EL UTF8_DECODE #######################
           $array_informacion=array();
           $devolverarray = array();
           $devolverarray2 = array();
           if($array_informacion=$result_tmp->fetchAll($tipo_array_pdo))
           {
               unset($result_tmp);
               foreach ($array_informacion as $key1 => $value1){
                   foreach ($value1 as $key => $value) {
                       if (gettype($value) == "string") {
                           $devolverarray[$key] = utf8_encode($value);
                       } else {
                           $devolverarray[$key] = $value;
                       }
                   }
                   $devolverarray2[$key1]=$devolverarray;
               }
               return $devolverarray2   ;
           }
	   		########   ASI ESTABA #############
	   		/*$array_informacion=array();

		   	if($array_informacion=$result_tmp->fetchAll($tipo_array_pdo))
		   	{	
		   		unset($result_tmp);

		   		return $array_informacion;
		   	}*/
           ###################################################
		   	else
		   		return $array_informacion;

		   	
		   	
	   }
	   
	   //OBTIENE EL ARREGLO COMPLETO DE UNA CONSULTA
	   function obtener_fila_consulta($pdo_statement=NULL,$tipo_array=NULL){
		   	if(empty($tipo_array) || $tipo_array==Sql::ARRAY_INDEXADO)
		   		$tipo_array_pdo=PDO::FETCH_NUM;
		   	else if($tipo_array==Sql::ARRAY_ASOCIATIVO)
		   		$tipo_array_pdo=PDO::FETCH_ASSOC;
		   	else if($tipo_array==Sql::ARRAY_OBJETOS)
		   		$tipo_array_pdo=PDO::FETCH_OBJ;
		   	
		   	if(!empty($pdo_statement))
		   		$result_tmp=$pdo_statement;
		   	else
		   		$result_tmp=$this->pdo_statement;
		   	
		   	$array_informacion=array();
		   	if(is_object($result_tmp) && $info=$result_tmp->fetch($tipo_array_pdo))
		   	{
		   		return $info;
		   	}
		   	elseif(!is_object($result_tmp) || empty($result_tmp))
		   	{
		   		throw new Exception("Ocurrió un error al obtener la información!");
		   	}
	   }
	   
	   //OBTIENE EL NOMBRE DE LOS CAMPOS DE LA CONSULTA POR MEDIO DEL OBJETO RESULT
	   function obtener_nombres_campos($ob_pdo=NULL)
	   {
	   	$meta_columnas = array();
	   	
	   	if(is_object($ob_pdo)){
	   		for($i=0;$i < $ob_pdo->columnCount();$i++)
	   		{
	   			$meta_columnas[] = $ob_pdo->getColumnMeta($i);
	   		}
	   	}
	   	else
	   	{
	   		for($i=0;$i < $this->pdo_statement->columnCount();$i++)
	   		{
	   			$meta_columnas[] = $this->pdo_statement->getColumnMeta($i);
	   		}
	   	}
		   	  
		   return $meta_columnas;
	   }
	   
	   //OBTIENE EL NUMERO DE REGISTROS QUE RETORNO UNA CONSULTA
	   function obtener_numero_registros($pdo_statement=NULL){
	   		if(is_object($pdo_statement))
				return $pdo_statement->rowCount();
				else
					return $this->pdo_statement->rowCount();
	   }
	   
	   //CANTIDAD DE COLUMNAS RETORNADAS
	   function obtener_cantidad_columnas($pdo_statement=NULL){
		   	if(!is_object($this->pdo_statement))
		   		return $pdo_statement->columnCount();
		   	else
		   		return $this->pdo_statement->columnCount();
	   }
	   
	   //CANTIDAD DE REGISTROS ALTERADOS POR UN UPDATE
		function cantidad_registros_modificados($pdo_statement=NULL){
			if(is_object($pdo_statement))
				return $pdo_statement->rowCount();
				else
					return $this->pdo_statement->rowCount();
		}
	   
	   //OBTIENE EL VALOR DEL CAMPO AUTO INCREMENT DEL ULTIMO INSERT REALIZADO
	   function obtener_insert_id($obj_pdo=NULL){
	   		if(is_object($obj_pdo))
	   			return $obj_pdo->lastInsertId;
	   			else
	   				return $this->obj_pdo->lastInsertId();
	   }
	   
	   //OBTIENE EL ERROR GENERADO POR LA ULTIMA CONSULTA SQL
	   function obtener_error(){
	   		$array=$this->obj_pdo->errorInfo();
	   		return $array[2];
	   }
	   
	   //MANEJA LAS OPERACIONES DE TRANSACCIONES
	   function comprobar_transaccion(){
	   		return $this->obj_pdo->inTransaction();
	   }
	   
	   function iniciar_transaccion(){
	   		return $this->obj_pdo->beginTransaction();
	   }
	   
	   function guardar_transaccion(){
	   		return $this->obj_pdo->commit();
	   }
	   
	   function deshacer_transaccion(){
	   		return $this->obj_pdo->rollBack();
	   }
		 
	   /*SENTENCIASA PREPARADAS*/
	   function consulta_preparada($sql_preparada,$array_parametros){
	   	
	   		$obj_stm = $this->obj_pdo->prepare($sql_preparada);
	   
	   	if(!is_object($obj_stm)){
	   		throw new Exception("<b>Error:<b>Error al preparar la consulta!".$this->obtener_error());	   		
	   	}
	   	
		   	if(is_array($array_parametros)){
		   		
		   			$est_stmt=$obj_stm->execute($array_parametros);
		   		
		   		if(empty($est_stmt)){
		   			$array_info = $obj_stm->errorInfo();
		   			throw new Exception("<b>Error:</b> Ocurrió un error al ejecutar la consulta Preparada! ".$array_info[2]);
		   		}
		   		else{
		   			$this->pdo_statement=$obj_stm;
		   			unset($est_stmt);
		   			return $this->pdo_statement;
		   		}
		   	}
		   	else
		   	{
		   		throw new Exception("<b>Error:</b>Verifica los parametros de la sentencia Preparada");
		   	}
	   }
	   
		/* CURSORES BD */
	   
	   
		/* GETTERS AND SETTERS*/
		
		/*MOSTRAR ERRORES EN EL SERVIDOR DE BASE DE DATOS*/
		static function get_debug_status(){
			return Sql::$debug;
		}
		
		static function set_debug_status($estado_debug){
			Sql::$debug=$estado_debug;
		}
                
                public function getMotor_bd() {
                    return $this->motor_bd;
                }

                public function getServidor_bd() {
                    return $this->servidor_bd;
                }

                public function getPuerto_bd() {
                    return $this->puerto_bd;
                }

                public function getNombre_bd() {
                    return $this->nombre_bd;
                }

                public function getUsuario_bd() {
                    return $this->usuario_bd;
                }

                public function getDriver_options() {
                    return $this->driver_options;
                }

                public function getObj_pdo() {
                    return $this->obj_pdo;
                }

                public function getPdo_statement() {
                    return $this->pdo_statement;
                }

                public function setMotor_bd($motor_bd) {
                    $this->motor_bd = $motor_bd;
                }

                public function setServidor_bd($servidor_bd) {
                    $this->servidor_bd = $servidor_bd;
                }

                public function setPuerto_bd($puerto_bd) {
                    $this->puerto_bd = $puerto_bd;
                }

                public function setNombre_bd($nombre_bd) {
                    $this->nombre_bd = $nombre_bd;
                }

                public function setUsuario_bd($usuario_bd) {
                    $this->usuario_bd = $usuario_bd;
                }

                public function setDriver_options($driver_options) {
                    $this->driver_options = $driver_options;
                }

                public function setObj_pdo($obj_pdo) {
                    $this->obj_pdo = $obj_pdo;
                }

                public function setPdo_statement($pdo_statement) {
                    $this->pdo_statement = $pdo_statement;
                }
}
?>