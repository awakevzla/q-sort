<?php
include "../modelos/tickets.php";
include "../clases/Sesion.php";
$sesion = new Sesion();
$modulo = new Tickets();
if ($sesion->sesion_iniciada() == false) {
    header('location:../login.php');
}
$arrayColas=$modulo->getColas();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Llamar Paciente</title>
    <script src="../js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../css/vistas.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/estadisticas.js"></script>
    <style>
        .estaciones {
            width: 500px;
            height: 70px;
            font-size: 40px;
            text-align: left;
        }
    </style>
</head>
<body style="padding:0;">
<div class="container" style="width: 100%;padding: 0;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Ver Colas
        </div>
        <div class="panel-body">
            <div style="background-color: rgba(255,255,255,0.7);">
            <table id="tabColas" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Estación</th>
                        <th>Atención</th>
                        <th colspan="4" style="text-align: center;">En Espera</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>IMAGENEOLOGÍA</td>
                        <td>IMG-001</td>
                        <td>IMG-002</td>
                        <td>IMG-003</td>
                        <td>IMG-004</td>
                        <td>IMG-005</td>
                        <td><a class="btn btn-info">Ver Mas</a></td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>