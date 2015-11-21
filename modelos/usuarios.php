<?php
use clases_generales\Sql;

include_once '../db/Sql.php';

class Usuario
{
    function Usuario()
    {
        $this->con = new Sql();
        $this->con->abrir_conexion();
    }

    function getUsuarios()
    {
        $sql = "SELECT
          usr.id,
          usr.login,
          usr.nombre,
          usr.apellido,
          concat(usr.nombre, ' ', usr.apellido) AS nombre_completo,
          CASE WHEN (usr.baneado=1) THEN 'Si' ELSE 'No' END AS baneado,
          usr.intentos,
          tipos.nombre as tipo,
          usr.tipo_id,
          CASE WHEN (ISNULL(est.id)) THEN 'N/A' ELSE est.nombre END as estacion,
          est.id as estacion_id
        FROM usuarios usr
        JOIN tipos on tipos.id=usr.tipo_id
        LEFT JOIN estaciones est on est.id=usr.estacion_id;";
        $stm = $this->con->consulta_bd($sql);
        $usuarios = $this->con->obtener_array_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        return $usuarios;
    }

    function getTipos(){
        $sql="SELECT
          id,
          nombre
        FROM tipos;";
        $stm=$this->con->consulta_bd($sql);
        $tipos=$this->con->obtener_array_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        return $tipos;
    }

    function getEstaciones(){
        $sql="SELECT
          id,
          nombre
        FROM estaciones;";
        $stm=$this->con->consulta_bd($sql);
        $array=$this->con->obtener_array_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        return $array;
    }

    function registrarUsuario($login, $nombres, $apellidos, $tipo, $clave, $estacion_id){
        $estacion=(intval($estacion_id)==0)?'':intval($estacion_id);
        $sql="INSERT INTO usuarios (login, clave, nombre, apellido, tipo_id, estacion_id)
            VALUES ('$login', md5('$clave'), '$nombres', '$apellidos', $tipo, '$estacion');";
        $this->con->iniciar_transaccion();
        try{
            $this->con->consulta_bd($sql);
        }catch (PDOException $e){
            $this->con->deshacer_transaccion();
            return $e->getMessage();
        }
        $this->con->guardar_transaccion();
        return 1;
    }

    function eliminarUsuario($id){
        $sql="DELETE FROM usuarios WHERE id=$id";
        $this->con->consulta_bd($sql);
        return 1;
    }

    function banearUsuario($id){
        $sql="UPDATE usuarios set baneado=1 WHERE id=$id";
        $this->con->consulta_bd($sql);
        return 1;
    }
    function desbanearUsuario($id){
        $sql="UPDATE usuarios set baneado=0 WHERE id=$id";
        $this->con->consulta_bd($sql);
        return 1;
    }
    function modificarUsuario($login, $nombres, $apellidos, $tipo, $clave, $estacion, $id){
        if ($clave=="")
            $sql = "UPDATE usuarios set login='$login', nombre='$nombres', apellido='$apellidos', tipo_id=$tipo, estacion_id=$estacion WHERE id=$id";
        else
            $sql = "UPDATE usuarios set login='$login', clave=md5('$clave'), nombre='$nombres', apellido='$apellidos', tipo_id=$tipo, estacion_id=$estacion WHERE id=$id";
        $this->con->iniciar_transaccion();
        try{
            $this->con->consulta_bd($sql);
        }catch (PDOException $e){
            $this->con->deshacer_transaccion();
            return $e->getMessage();
        }
        $this->con->guardar_transaccion();
        return 1;
    }
}