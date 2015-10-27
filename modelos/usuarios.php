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
          usr.tipo_id
        FROM usuarios usr
        JOIN tipos on tipos.id=usr.tipo_id;";
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
}