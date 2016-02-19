<?php
use clases_generales\Sql;

require_once dirname(__FILE__) . '/../db/Sql.php';

class Sesion
{
    public $id_usuario = NULL;
    public $login = NULL;
    public $cedula_usuario = NULL;
    public $nombre_usuario = NULL;
    public $apellido_usuario = NULL;
    public $tipo_usuario = NULL;
    public $id_sistema = NULL;
    public $vip = NULL;

    function __construct()
    {
        if (!isset($_SESSION))
            session_start();

        if ($this->sesion_iniciada() == true) {
            $this->setId_usuario($_SESSION["id_usuario"]);
            $this->setLogin($_SESSION["login"]);
            $this->setNombre_usuario($_SESSION["nombre_usuario"]);
            $this->setApellido_usuario($_SESSION["apellido_usuario"]);
            $this->setTipo_usuario($_SESSION["tipo_usuario"]);
            $this->setVip($_SESSION["vip"]);
            $this->setEstacion_pertenece($_SESSION["estacion_pertenece"]);
        }
        $this->con = new Sql();
        return true;
    }

    function sesion_iniciada()
    {
        if (!empty($_SESSION["id_usuario"]))
            return true;
        else
            return false;
    }

    function verificarClave($clave){
        $this->con->abrir_conexion();
        $login=$this->getLogin();
        $sql="SELECT * from usuarios where login='$login' and clave=md5('$clave')";
        $stm=$this->con->consulta_bd($sql);
        $result=$this->con->obtener_numero_registros($stm);
        return $result;
    }

    function crear_sesion($usuario, $clave)
    {
        $this->con->abrir_conexion();
        $sql = "SELECT * from usuarios WHERE login=lower('$usuario') and clave=md5('$clave');";
        $stm=$this->con->consulta_bd($sql);
        $datos=$this->con->obtener_array_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        $sql = "SELECT * from usuarios WHERE login=lower('$usuario');";
        $stm=$this->con->consulta_bd($sql);
        $usuario=$this->con->obtener_array_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        if (count($datos)==1 && $datos[0]["baneado"]==0){
            $this->setLogin($datos[0]["login"]);
            $this->setApellido_usuario($datos[0]["apellido"]);
            $this->setNombre_usuario($datos[0]["nombre"]);
            $this->setId_usuario($datos[0]["id"]);
            $this->setTipo_usuario($datos[0]["tipo_id"]);
            $this->setVip($datos[0]["vip"]);
            $this->setEstacion_pertenece($datos[0]["estacion_id"]);
            $resp["resp"]=1;
            $sql="update usuarios set intentos = 0 WHERE login=lower('".$usuario[0]["login"]."')";
            $this->con->consulta_bd($sql);
            $this->registro_logueo();
            return $resp;
        }else if (count($datos)==1 && $datos[0]["baneado"]==1){
            $resp["resp"]=2;
            $resp["motivo"]="baneado";
            return $resp;
        }else if(count($datos)==0){
            if (count($usuario)>0){
                $resp["resp"]=2;
                $resp["motivo"]="claveInvalida";
                $sql="update usuarios set intentos = intentos+1 WHERE login=lower('".$usuario[0]["login"]."')";
                $this->con->consulta_bd($sql);
                $sql = "SELECT intentos from usuarios WHERE login=lower('".$usuario[0]["login"]."');";
                $stm=$this->con->consulta_bd($sql);
                $intentos=$this->con->obtener_array_consulta($stm, Sql::ARRAY_ASOCIATIVO);
                if ($intentos[0]["intentos"]>10){
                    $sql="update usuarios set baneado = 1 WHERE login=lower('".$usuario[0]["login"]."')";
                    $this->con->consulta_bd($sql);
                    $resp["resp"]=2;
                    $resp["motivo"]="baneado";
                    return $resp;
                }
            }else{
                $resp["resp"]=2;
                $resp["motivo"]="usuarioInvalido";
            }
            return $resp;
        }else{
            $resp["resp"]=2;
            $resp["motivo"]="otro";
            return $resp;
        }
    }

    function registro_logueo(){
        $this->con->abrir_conexion();
        $ip=$this->obtener_ip();
        $sql="INSERT INTO registro_log (usuario_id, ip) VALUES ($this->id_usuario, '$ip')";
        try{
            $this->con->consulta_bd($sql);
        }catch (PDOException $e){
            return $e->getMessage();
        }
        return 1;
    }

    function obtener_ip(){
        if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        else if(!empty($_SERVER["HTTP_CLIENT_IP"]))
            return $_SERVER["HTTP_CLIENT_IP"];
        else
            return $_SERVER["REMOTE_ADDR"];
    }

    function destruir_sesion()
    {
        $this->setId_usuario(NULL);
        $this->setLogin(NULL);
        $this->setNombre_usuario(NULL);
        $this->setApellido_usuario(NULL);
        $this->setTipo_usuario(NULL);
        return session_destroy();
    }

    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario)
    {
        $_SESSION["id_usuario"] = $id_usuario;
        $this->id_usuario = $id_usuario;
    }

    public function getNombre_usuario()
    {
        return $this->nombre_usuario;
    }

    public function setNombre_usuario($nombre_usuario)
    {
        $_SESSION["nombre_usuario"] = $nombre_usuario;
        $this->nombre_usuario = $nombre_usuario;
    }

    public function getApellido_usuario()
    {
        return $this->apellido_usuario;
    }

    public function setApellido_usuario($apellido_usuario)
    {
        $_SESSION["apellido_usuario"] = $apellido_usuario;
        $this->apellido_usuario = $apellido_usuario;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($tipo_usuario)
    {
        $_SESSION["login"] = $tipo_usuario;
        $this->login = $tipo_usuario;
    }

    public function getTipo_usuario()
    {
        return $this->tipo_usuario;
    }

    public function setTipo_usuario($tipo_usuario)
    {
        $_SESSION["tipo_usuario"] = $tipo_usuario;
        $this->tipo_usuario = $tipo_usuario;
    }

    public function getEstacion_pertenece()
    {
        return $this->estacionPertenece;
    }

    public function getVip()
    {
        return $this->vip;
    }

    public function setVip($vip)
    {
        $_SESSION["vip"] = $vip;
        $this->vip = $vip;
    }

    public function setEstacion_pertenece($estacion_pertenece)
    {
        $_SESSION["estacion_pertenece"] = $estacion_pertenece;
        $this->estacionPertenece = $estacion_pertenece;
    }

    function redirigir(){
        if ($this->tipo_usuario==1){
            header("location:login.php");
        }else{

        }
    }
}