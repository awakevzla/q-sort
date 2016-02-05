<?php
use clases_generales\Sql;

include_once '../db/Sql.php';

class Contenido{
    function Contenido(){
        $this->con=new Sql();
        $this->con->abrir_conexion();
    }
    function getTipos(){
        $sql="SELECT * from tipos_eventos_2;";
        $stm=$this->con->consulta_bd($sql);
        $array=$this->con->obtener_array_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        return $array;
    }

    function setArchivos($ruta, $duracion, $tipo){
        $sql="INSERT INTO eventos_2(ruta, duracion, tipo_evento_id) VALUES ('$ruta', $duracion, $tipo)";
        $this->con->consulta_bd($sql);
        return 1;
    }

    function setMensaje($mensaje, $hablado, $tipo){
        $sql="INSERT INTO eventos_2(mensaje, voz, tipo_evento_id) VALUES ('$mensaje', $hablado, $tipo)";
        $this->con->consulta_bd($sql);
        return 1;
    }

    function getEventos(){
        $sql="SELECT ev.id, ev.voz, ev.duracion, ev.mensaje, ev.ruta, tp.evento as tipo_evento, tp.id as tipo_evento_id from eventos_2 ev INNER JOIN tipos_eventos_2 tp on tp.id=ev.tipo_evento_id ORDER by ev.id ASC;";
        $stm=$this->con->consulta_bd($sql);
        $array=$this->con->obtener_array_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        return $array;
    }

    function eliminarEvento($id){
        $sql="DELETE FROM eventos_2 where id=$id";
        $this->con->consulta_bd($sql);
        return 1;
    }

    function reordenarEvento($id_temp, $id_new){
        $sql="SELECT * from eventos_2 WHERE id=$id_new";
        $stm=$this->con->consulta_bd($sql);
        $cant=$this->con->obtener_numero_registros($stm);
        $this->con->iniciar_transaccion();
        try{
            if ($cant){
                $sql="UPDATE eventos_2 set id=0 WHERE id=$id_new";
                $this->con->consulta_bd($sql);
                $sql="UPDATE eventos_2 set id=$id_new WHERE id=$id_temp";
                $this->con->consulta_bd($sql);
                $sql="UPDATE eventos_2 set id=$id_temp WHERE id=0";
                $this->con->consulta_bd($sql);
            }else{
                $sql="UPDATE eventos_2 set id=$id_new WHERE id=$id_temp";
                $this->con->consulta_bd($sql);
            }
        }catch (PDOException $e){
            $this->con->deshacer_transaccion();
            return "error";
        }
        $this->con->guardar_transaccion();
        return 1;
    }

    function setLista(){
        $sql="INSERT INTO eventos_2 (tipo_evento_id) VALUES (3)";
        $this->con->consulta_bd($sql);
        return 1;
    }
}