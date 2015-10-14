<?php
use clases_generales\Sql;

include_once '../db/Sql.php';

class Tickets
{
    function Tickets()
    {
        $this->con = new Sql();
        $this->campo=array();
        $this->valor=array();
        $this->creada=false;
    }

    function generarTicket($pref, $estid)
    {
        $correlativo="001";
        $sql = "SELECT
          correlativo,
          ticket
        FROM cola
        WHERE date_format(fecha_hora_inicio, '%d-m-Y') = date_format(CURDATE(), '%d-m-Y')
        ORDER BY correlativo DESC
        LIMIT 1;";
        $this->con->abrir_conexion();
        $stm=$this->con->consulta_bd($sql);
        $ticket=$this->con->obtener_fila_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        if ($ticket["correlativo"]==""){
            $sql="INSERT INTO cola (correlativo, ticket, estacion_id, estado_id) VALUES ('001', '".strtoupper($pref)."-".$correlativo."', $estid, 1);";
            $this->con->consulta_bd($sql);
        }else{
            $correlativo=intval($ticket["correlativo"])+1;
            $correlativo=str_pad($correlativo, 3, '0', STR_PAD_LEFT);
            $sql="INSERT INTO cola (correlativo, ticket, estacion_id, estado_id) VALUES ('$correlativo', '".strtoupper($pref)."-".$correlativo."', $estid, 1);";
            $this->con->consulta_bd($sql);
        }
        $sql = "SELECT
          correlativo,
          ticket
        FROM cola
        WHERE date_format(fecha_hora_inicio, '%d-m-Y') = date_format(CURDATE(), '%d-m-Y')
        ORDER BY correlativo DESC
        LIMIT 1;";
        $this->con->abrir_conexion();
        $stm=$this->con->consulta_bd($sql);
        $ticket=$this->con->obtener_fila_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        return $ticket;
    }

    function getEstaciones($pertenece){
        $sql="SELECT id, nombre, prefijo from estaciones where id!=$pertenece;";
        $this->con->abrir_conexion();
        $stm=$this->con->consulta_bd($sql);
        $arrayEstaciones=$this->con->obtener_array_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        $this->con->cerrar_conexion();
        return $arrayEstaciones;
    }

    function getEstacionPertenece($pertenece){
        $sql="SELECT id, nombre, descripcion from estaciones where id=$pertenece;";
        $this->con->abrir_conexion();
        $stm=$this->con->consulta_bd($sql);
        $arrayEstaciones=$this->con->obtener_array_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        $this->con->cerrar_conexion();
        return $arrayEstaciones;
    }

    function getAtendiendo($est){

        $sql = "SELECT id, ticket, 0 as clEspera from cola WHERE estacion_id=$est and estado_id=2;";
        $this->con->abrir_conexion();
        $stm=$this->con->consulta_bd($sql);
        $ticket=$this->con->obtener_fila_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        if($ticket){
            $sql = "SELECT COUNT(id) as clEspera FROM cola WHERE  cola.estacion_id=$est and cola.estado_id=1";
            $this->con->abrir_conexion();
            $stm=$this->con->consulta_bd($sql);
            $Cespera=$this->con->obtener_fila_consulta($stm, Sql::ARRAY_ASOCIATIVO);
            $ticket["clEspera"]=$Cespera["clEspera"];
        }
        return $ticket;
    }

    function getSigPaciente($est){
        $sql="SELECT
            id
        FROM cola
        WHERE date_format(fecha_hora_inicio, '%d-m-Y') = date_format(CURDATE(), '%d-m-Y') and estacion_id=$est and estado_id=1
        ORDER BY correlativo ASC
        LIMIT 1;";
        $this->con->abrir_conexion();
        $stm=$this->con->consulta_bd($sql);
        $ticket=$this->con->obtener_fila_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        if ($ticket){
            $this->generasql("cola", "estado_id", 2, true, true, "where id=" . $ticket["id"], true);
        }else{
            return 0;
        }
        return $ticket;
    }

    function ejecutasql($psql){
        $conexion = new Sql();
        $conexion->abrir_conexion();
        try {
            $result= $conexion->consulta_bd(trim($psql));
        } catch (PDOException $e) {
            $response["error"] = $e->getMessage();
            return 0;
        }
        $conexion->cerrar_conexion();
        return 1;
    }



    function generasql($ptabla,$pcampo,$pvalor,$termina=false,$remplaza=false,$pfor="",$solouno=false){
        // global $campo, $tabla,$creada,$valor,$campo,$valor,$creada;
        if (($termina==false) || ($solouno==true)){
            if ($this->creada==false){
                unset($this->campo);
                unset($this->valor);
                $this->campo=array();
                $this->valor=array();
                $this->creada=true;
                //$primero=$this->remplazasql($ptabla,$pcampo,$pvalor,$termina,$remplaza,$pfor,$solouno);
            }else{
            }
        }
        $this->creada=true;
        array_push($this->campo,$pcampo);
        switch (gettype($pvalor)) {
            case 'string':
                array_push($this->valor,"'".trim($pvalor)."'");
                break;
            case 'integer':
                array_push($this->valor,strval($pvalor));
                break;
            default:
                array_push($this->valor,"'".trim($pvalor)."'");
                break;
        }

        if ($termina==true){
            if ($remplaza==false){
                $linea2="";
                $linea1="insert into ".$ptabla." (";
                $i=0;
                foreach ($this->valor as $v){
                    $linea1 =$linea1 . $this->campo[$i]. ",";
                    $linea2=$linea2 . $this->valor[$i]. ",";
                    $i++;
                }
                $linea1 = substr($linea1,0,strlen($linea1)-1) . ") values (";
                $linea2 = substr($linea2,0,strlen($linea2)-1) . ")";
                $this->creada=false;
                $misql=$linea1.$linea2;
            }else{
                $linea2="";
                $linea1="update ".$ptabla." set ";
                $i=0;
                foreach ($this->valor as $v){
                    $linea1 =$linea1 . $this->campo[$i]. " = ".$this->valor[$i]. ",";
                    $i++;
                }
                $linea1 = substr($linea1,0,strlen($linea1)-1);
                if($pfor!=null){
                    $linea1 = $linea1 . " ".$pfor;
                }
                $misql=$linea1;
            }
            $this->creada=false;
            //$s= new comunal();
            //$resp=$s->ejecutasql(trim($misql));
           // return $misql;
            $conexion = new Sql();
            $conexion->abrir_conexion();
            try {
                $result= $conexion->consulta_bd(trim($misql));
            } catch (PDOException $e) {
                $response["error"] = $e->getMessage();
                return 0;
            }
            $conexion->cerrar_conexion();
            return 1;
        }

        //alert(misql);

    }
}