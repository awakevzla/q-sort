<?php
use clases_generales\Sql;
include_once '../clases/Sesion.php';
include_once '../db/Sql.php';
class Auditoria{
    CONST REGISTRAR="REGISTRAR",MODIFICAR="MODIFICAR",ELIMINAR="ELIMINAR",IMPRIMIR="IMPRIMIR";
    function Auditoria(){
        $this->sesion = new Sesion();
        $this->id_usuario = $this->sesion->getId_usuario();
        $this->ip=($this->obtener_ip()=='::1')?"localhost":$this->obtener_ip();
        $this->con = new Sql();
        $this->con->abrir_conexion();
    }
    function obtener_ip(){
        if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        else if(!empty($_SERVER["HTTP_CLIENT_IP"]))
            return $_SERVER["HTTP_CLIENT_IP"];
        else
            return $_SERVER["REMOTE_ADDR"];
    }
    function registro_operacion($tipo_operacion, $evento){
        $sql="INSERT INTO registro_operaciones (usuario_id, tipo_evento, evento, ip)  VALUES ($this->id_usuario, '$tipo_operacion', '$evento', '$this->ip')";
        $this->con->consulta_bd($sql);
    }
}