<?php
include_once '../modelos/tickets.php';
$ticket = new Tickets();//Amonestado, por Asesino de Felinos
$band = $_REQUEST["band"];
switch ($band) {
    case 'verColas':
        echo json_encode($ticket->getColas());
        break;
    case 'generarGrafica':
        $fechaIni=$_REQUEST["fecha_inicio"];
        $fechaFin=$_REQUEST["fecha_fin"];
        echo json_encode($ticket->getCantidadPacientes($fechaIni, $fechaFin));
        break;
}