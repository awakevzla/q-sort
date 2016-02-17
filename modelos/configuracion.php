<?php
use clases_generales\Sql;

include_once '../db/Sql.php';
class Configuracion{
    function Configuracion(){
        $this->con = new Sql();
        $this->con->abrir_conexion();
        $this->maximo_transferencia=$this->getMaximoTransferencia();
    }
    function getMaximoTransferencia(){
        $sql="SELECT maximo_transferencia from configuraciones_generales";
        $stm=$this->con->consulta_bd($sql);
        $maximo=$this->con->obtener_fila_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        return $maximo["maximo_transferencia"];
    }
    function guardarConfiguracion($cantidad_transferencias){
        $sql="UPDATE configuraciones_generales SET maximo_transferencia=$cantidad_transferencias";
        $this->con->consulta_bd($sql);
        return 1;
    }
}