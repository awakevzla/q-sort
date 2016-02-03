<?php
include_once '../modelos/tickets.php';
$ticket = new Tickets();//Amonestado, por Asesino de Felinos
$band = $_REQUEST["band"];
switch ($band) {
    case 'generar':
        $pref = $_REQUEST["pref"];
        $estid = $_REQUEST["estid"];
        $vip=$_REQUEST["vip"];
        $result["respuesta"] = $ticket->generarTicket($pref, $estid, $vip);
        echo json_encode($result);
        break;
    case 'atendiendo':
        $est = $_REQUEST["est"];
        $result["respuesta"] = $ticket->getAtendiendo($est);
        echo json_encode($result);
        break;
    case 'llamarPaciente':
        $est = $_REQUEST["est"];
        $id_atend = $ticket->getAtendiendo($est);
        $transferir=$_REQUEST["transferir"];
        if ($transferir==0) {
            $result = $ticket->cerrarTicket($id_atend["id"]);
        }
        if ($transferir && isset($id_atend["id"])){
            $ticket->trasladarPaciente($id_atend['estacion_id'], $transferir);
        }
        $result = $ticket->getSigPaciente($est);
        echo json_encode($result);
        break;
    case 'trasladarPaciente':
        $estacion_destino=$_REQUEST["estacion_destino"];
        $estacion_origen=$_REQUEST["estacion_origen"];
        echo $ticket->trasladarPaciente($estacion_origen, $estacion_destino);
        break;
    case 'registrarEstacion':
        $nombre=$_REQUEST["nombre"];
        $descripcion=$_REQUEST["descripcion"];
        $prefijo=$_REQUEST["prefijo"];
        $id_padre=$_REQUEST["id_padre"];
        $transferencia_id=$_REQUEST["transferencia_id"];
        echo $ticket->registrarEstacion($nombre, $descripcion, $prefijo, $id_padre, $transferencia_id);
        break;
    case 'modificarEstacion':
        $nombre=$_REQUEST["nombre"];
        $descripcion=$_REQUEST["descripcion"];
        $prefijo=$_REQUEST["prefijo"];
        $id=$_REQUEST["id"];
        $id_padre=$_REQUEST["id_padre"];
        $transferencia_id=$_REQUEST["transferir_id"];
        echo $ticket->modificarEstacion($id, $nombre, $descripcion, $prefijo, $id_padre, $transferencia_id);
        break;
    case 'eliminarEstacion':
        $id=intval($_REQUEST["id"]);
        echo $ticket->eliminarEstacion($id);
        break;
    case 'cerrarTicket':
        $estacion_id=intval($_REQUEST["estacion_id"]);
        echo $ticket->cerrarTicketAtendiendo($estacion_id);
        break;
}