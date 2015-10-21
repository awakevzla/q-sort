<?php
include "../modelos/tickets.php";
include "../clases/Sesion.php";
$sesion = new Sesion();
$modulo = new Tickets();
if ($sesion->sesion_iniciada() == false) {
    header('location:../login.php');
}
$modulo->getTodasEstaciones();
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
            <div class="row">
                <div class="col-">

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>