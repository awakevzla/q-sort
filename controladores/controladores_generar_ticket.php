<?php
include_once '../modelos/tickets.php';
$ticket = new Tickets();//Amonestado, por Asesino de Felinos
$band = $_REQUEST["band"];
switch ($band) {
    case 'generar':
        $pref = $_REQUEST["pref"];
        $estid = $_REQUEST["estid"];
        $result["respuesta"] = $ticket->generarTicket($pref, $estid);
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
        if (isset($id_atend["id"])) {
            $result = $ticket->cerrarTicket($id_atend["id"]);
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
        echo $ticket->registrarEstacion($nombre, $descripcion, $prefijo);
        break;
    case 'modificarEstacion':
        $nombre=$_REQUEST["nombre"];
        $descripcion=$_REQUEST["descripcion"];
        $prefijo=$_REQUEST["prefijo"];
        $id=$_REQUEST["id"];
        echo $ticket->modificarEstacion($id, $nombre, $descripcion, $prefijo);
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