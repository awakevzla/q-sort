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
        if ($id_atend) {// Si esta atendiendo a un paciente -> cambia el estatus a despachado
            $result = $ticket->generasql("cola", "estado_id", 3, true, true, "where id=" . $id_atend["id"], true);
        }
        $result = $ticket->getSigPaciente($est);
        echo json_encode($result);
        break;
}