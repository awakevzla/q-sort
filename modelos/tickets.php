<?php
use clases_generales\Sql;

include_once '../db/Sql.php';

class Tickets
{
    function Tickets()
    {
        $this->con = new Sql();
        $this->campo = array();
        $this->valor = array();
        $this->creada = false;
    }

    function generarTicket($pref, $estid)
    {
        $correlativo = "001";
        $sql = "SELECT
          correlativo,
          ticket
        FROM cola
        WHERE date_format(fecha_hora_inicio, '%d-%m-%Y') = date_format(CURDATE(), '%d-%m-%Y')
        ORDER BY correlativo DESC
        LIMIT 1;";
        $this->con->abrir_conexion();
        $stm = $this->con->consulta_bd($sql);
        $ticket = $this->con->obtener_fila_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        if ($ticket["correlativo"] == "") {
            $sql = "INSERT INTO cola (correlativo, ticket, estacion_id, estado_id) VALUES ('001', '" . strtoupper($pref) . "-" . $correlativo . "', $estid, 1);";
            $this->con->consulta_bd($sql);
        } else {
            $correlativo = intval($ticket["correlativo"]) + 1;
            $correlativo = str_pad($correlativo, 3, '0', STR_PAD_LEFT);
            $sql = "INSERT INTO cola (correlativo, ticket, estacion_id, estado_id) VALUES ('$correlativo', '" . strtoupper($pref) . "-" . $correlativo . "', $estid, 1);";
            $this->con->consulta_bd($sql);
        }
        $sql = "SELECT
          correlativo,
          ticket
        FROM cola
        WHERE date_format(fecha_hora_inicio, '%d-%m-%Y') = date_format(CURDATE(), '%d-%m-%Y')
        ORDER BY correlativo DESC
        LIMIT 1;";
        $this->con->abrir_conexion();
        $stm = $this->con->consulta_bd($sql);
        $ticket = $this->con->obtener_fila_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        return $ticket;
    }

    function getEstaciones($pertenece)
    {
        $sql = "SELECT id, nombre, prefijo from estaciones where id!=$pertenece AND activo=TRUE;";
        $this->con->abrir_conexion();
        $stm = $this->con->consulta_bd($sql);
        $arrayEstaciones = $this->con->obtener_array_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        $this->con->cerrar_conexion();
        return $arrayEstaciones;
    }

    function getTodasEstaciones()
    {
        $sql = "SELECT id, nombre, prefijo from estaciones WHERE activo=TRUE;";
        $this->con->abrir_conexion();
        $stm = $this->con->consulta_bd($sql);
        $arrayEstaciones = $this->con->obtener_array_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        foreach ($arrayEstaciones as $k=>$v){
            $arrayEstaciones[$k]["nombre"]=utf8_decode($v["nombre"]);
        }
        $this->con->cerrar_conexion();
        return $arrayEstaciones;
    }

    function getEstacionPertenece($pertenece)
    {
        $sql = "SELECT id, nombre, descripcion from estaciones where id=$pertenece AND activo=TRUE;";
        $this->con->abrir_conexion();
        $stm = $this->con->consulta_bd($sql);
        $arrayEstaciones = $this->con->obtener_array_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        $this->con->cerrar_conexion();
        return $arrayEstaciones;
    }

    function getAtendiendo($est)
    {

        $sql = "SELECT id, ticket, 0 as clEspera, correlativo from cola WHERE estacion_id=$est and estado_id=2 and date_format(fecha_hora_inicio, '%d-%m-%Y') = date_format(CURDATE(), '%d-%m-%Y');";
        $this->con->abrir_conexion();
        $stm = $this->con->consulta_bd($sql);
        $ticket = $this->con->obtener_fila_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        //if($ticket){
        $sql = "SELECT COUNT(id) as clEspera FROM cola WHERE  cola.estacion_id=$est and cola.estado_id=1 and date_format(fecha_hora_inicio, '%d-%m-%Y') = date_format(CURDATE(), '%d-%m-%Y')";
        $this->con->abrir_conexion();
        $stm = $this->con->consulta_bd($sql);
        $Cespera = $this->con->obtener_fila_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        $ticket["clEspera"] = $Cespera["clEspera"];
        //}
        return $ticket;
    }

    function getSigPaciente($est)
    {
        $sql = "SELECT
            id
        FROM cola
        WHERE date_format(fecha_hora_inicio, '%d-%m-%Y') = date_format(CURDATE(), '%d-%m-%Y') and estacion_id=$est and estado_id=1
        ORDER BY id ASC
        LIMIT 1;";
        $this->con->abrir_conexion();
        $stm = $this->con->consulta_bd($sql);
        $ticket = $this->con->obtener_fila_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        if ($ticket) {
            $fechaHora=date('Y-m-d H:i:s');
            $this->generasql("cola", "fecha_hora_atencion", "$fechaHora");
            $this->generasql("cola", "estado_id", 2, true, true, "where id=" . $ticket["id"]);
        } else {
            return 0;
        }
        return $ticket;
    }

    function ejecutasql($psql)
    {
        $conexion = new Sql();
        $conexion->abrir_conexion();
        try {
            $result = $conexion->consulta_bd(trim($psql));
        } catch (PDOException $e) {
            $response["error"] = $e->getMessage();
            return 0;
        }
        $conexion->cerrar_conexion();
        return 1;
    }


    function generasql($ptabla, $pcampo, $pvalor, $termina = false, $remplaza = false, $pfor = "", $solouno = false)
    {
        // global $campo, $tabla,$creada,$valor,$campo,$valor,$creada;
        if (($termina == false) || ($solouno == true)) {
            if ($this->creada == false) {
                unset($this->campo);
                unset($this->valor);
                $this->campo = array();
                $this->valor = array();
                $this->creada = true;
                //$primero=$this->remplazasql($ptabla,$pcampo,$pvalor,$termina,$remplaza,$pfor,$solouno);
            } else {
            }
        }
        $this->creada = true;
        array_push($this->campo, $pcampo);
        switch (gettype($pvalor)) {
            case 'string':
                array_push($this->valor, "'" . trim($pvalor) . "'");
                break;
            case 'integer':
                array_push($this->valor, strval($pvalor));
                break;
            default:
                array_push($this->valor, "'" . trim($pvalor) . "'");
                break;
        }

        if ($termina == true) {
            if ($remplaza == false) {
                $linea2 = "";
                $linea1 = "insert into " . $ptabla . " (";
                $i = 0;
                foreach ($this->valor as $v) {
                    $linea1 = $linea1 . $this->campo[$i] . ",";
                    $linea2 = $linea2 . $this->valor[$i] . ",";
                    $i++;
                }
                $linea1 = substr($linea1, 0, strlen($linea1) - 1) . ") values (";
                $linea2 = substr($linea2, 0, strlen($linea2) - 1) . ")";
                $this->creada = false;
                $misql = $linea1 . $linea2;
            } else {
                $linea2 = "";
                $linea1 = "update " . $ptabla . " set ";
                $i = 0;
                foreach ($this->valor as $v) {
                    $linea1 = $linea1 . $this->campo[$i] . " = " . $this->valor[$i] . ",";
                    $i++;
                }
                $linea1 = substr($linea1, 0, strlen($linea1) - 1);
                if ($pfor != null) {
                    $linea1 = $linea1 . " " . $pfor;
                }
                $misql = $linea1;
            }
            $this->creada = false;
            //$s= new comunal();
            //$resp=$s->ejecutasql(trim($misql));
            // return $misql;
            $conexion = new Sql();
            $conexion->abrir_conexion();
            try {
                $result = $conexion->consulta_bd(trim($misql));
            } catch (PDOException $e) {
                $response["error"] = $e->getMessage();
                return 0;
            }
            $conexion->cerrar_conexion();
            return 1;
        }

        //alert(misql);

    }

    function getColas()
    {
        $conex = new Sql();
        $conex->abrir_conexion();
        $sql = "SELECT
          cola.id        AS cola_id,
          est.nombre     AS estacion,
          est.id         AS estacion_id,
          ticket,
          estado_id,
          estados.nombre AS estados
        FROM cola
          JOIN estaciones est ON est.id = cola.estacion_id
          JOIN estados ON estados.id = cola.estado_id
        WHERE date(cola.fecha_hora_inicio) = CURDATE();";
        $stm = $conex->consulta_bd($sql);
        $Result = array();
        $arrayR = array();
        $arrayColas = $conex->obtener_array_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        foreach ($arrayColas as $k => $v) {
            $arrayR[$v["estacion_id"]][$v["estado_id"]][$v["cola_id"]]["estado_id"] = $v["estado_id"];
            $arrayR[$v["estacion_id"]][$v["estado_id"]][$v["cola_id"]]["estacion_id"] = $v["estacion_id"];
            $arrayR[$v["estacion_id"]][$v["estado_id"]][$v["cola_id"]]["ticket"] = $v["ticket"];
            $arrayR[$v["estacion_id"]][$v["estado_id"]][$v["cola_id"]]["estado"] = $v["estados"];
            $arrayR[$v["estacion_id"]][$v["estado_id"]][$v["cola_id"]]["estacion"] = $v["estacion"];
            $arrayR[$v["estacion_id"]][$v["estado_id"]][$v["cola_id"]]["cola_id"] = $v["cola_id"];
        }
        $Result["porEstacion"] = $arrayR;
        $Result["estaciones"] = $this->getTodasEstaciones();
        return $Result;
    }

    function cerrarTicketAtendiendo($estacon_id){
        $atendiendo = $this->getAtendiendo($estacon_id);
        $id = $atendiendo["id"];
        if ($id) {
            $this->cerrarTicket($id);
        } else {
            return "No hay paciente en atencion";
        }
        return 1;
    }

    function cerrarTicket($id)
    {
        $conex = new Sql();
        $conex->abrir_conexion();
        $sql = "UPDATE cola SET fecha_hora_fin=CURRENT_TIMESTAMP, estado_id=3 where id=$id";
        $conex->consulta_bd($sql);
    }

    function trasladarPaciente($estacion_origen, $estacion_destino)
    {
        $conex = new Sql();
        $conex->abrir_conexion();
        $atendiendo = $this->getAtendiendo($estacion_origen);
        $id = $atendiendo["id"];
        if ($id) {
            $this->cerrarTicket($id);
        } else {
            return "No hay paciente en atencion";
        }
        $sql = "INSERT INTO cola (correlativo, ticket, estacion_id, estado_id) VALUES ('" . $atendiendo["correlativo"] . "', '" . $atendiendo["ticket"] . "', $estacion_destino, 1)";
        $conex->consulta_bd($sql);
        return 1;
    }

    function getCantidadPacientes($fecha_inicio, $fecha_fin){
        $datos=array();
        $fechas=$this->fechasEnRango($fecha_inicio, $fecha_fin);
        $datos["fechas"]=$fechas;
        $estaciones=$this->getEstaciones(0);
        foreach($estaciones as $k=>$v){
            $datos["datos"][$k]["name"]=utf8_decode($v["nombre"]);
            $datos["datos"][$k]["data"]=array();
            //$datos["datos"][$k]["y"]=array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17);
            foreach($fechas as $date){
                $cant=$this->getCantidadPacientesFecha($date, $v["id"]);
                array_push($datos["datos"][$k]["data"], (intval($cant))?intval($cant):0);
            }
        }
        return $datos;
    }

    function getCantidadPacientesFecha($fecha, $estacion){
        $conex = new Sql();
        $conex->abrir_conexion();
        $sql="SELECT
          count(DISTINCT correlativo) as cantidad
        FROM cola
          WHERE date(fecha_hora_inicio) = '$fecha' and estacion_id=$estacion and estado_id=3;";
        $stm=$conex->consulta_bd($sql);
        $array=$conex->obtener_array_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        $cantidad=$array[0]["cantidad"];
        return $cantidad;
    }

    function fechasEnRango($strDateFrom, $strDateTo)
    {
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.

        // could test validity of dates here but I'm already doing
        // that in the main script

        $aryRange = array();

        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

        if ($iDateTo >= $iDateFrom) {
            array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
            while ($iDateFrom < $iDateTo) {
                $iDateFrom += 86400; // add 24 hours
                array_push($aryRange, date('Y-m-d', $iDateFrom));
            }
        }
        return $aryRange;
    }

    function registrarEstacion($nombre, $descripcion, $prefijo){
        $sql="INSERT INTO estaciones (nombre, descripcion, prefijo) VALUES ('$nombre', '$descripcion', '$prefijo')";
        $this->con->abrir_conexion();
        $this->con->consulta_bd($sql);
        return 1;
    }

    function modificarEstacion($id, $nombre, $descripcion, $prefijo){
        $sql="UPDATE estaciones SET nombre='$nombre', descripcion='$descripcion', prefijo='$prefijo' WHERE id=$id";
        $this->con->abrir_conexion();
        $this->con->consulta_bd($sql);
        return 1;
    }

    function eliminarEstacion($id){
        $this->con->abrir_conexion();
        $sql="delete from estaciones where id=$id";
        $this->con->consulta_bd($sql);
        return 1;
    }

    function getTiempoPromedio($fecha){
        $this->con->abrir_conexion();
        $sql="SELECT
          estacion_id,
          est.nombre as estacion,
          round(AVG(TIME_TO_SEC(timediff(fecha_hora_fin, fecha_hora_atencion)))) as diferencia_segundos,
          TIME_FORMAT(SEC_TO_TIME(AVG(TIME_TO_SEC(timediff(fecha_hora_fin, fecha_hora_atencion)))), '%H:%i:%s') AS diferencia
        FROM cola
          JOIN estaciones est on est.id=cola.estacion_id
        WHERE date(fecha_hora_inicio)='$fecha' and !isnull(fecha_hora_fin)
        GROUP BY estacion_id;";
        $stm=$this->con->consulta_bd($sql);
        $array=$this->con->obtener_array_consulta($stm, Sql::ARRAY_ASOCIATIVO);
        foreach($array as $k=>$v){
            $array[$k]["estacion"]=utf8_decode($v["estacion"]);
        }
        return $array;
    }
}