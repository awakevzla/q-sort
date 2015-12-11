<?php
include_once '../modelos/tickets.php';
$ticket=new Tickets();
$estaciones=$ticket->getEstaciones(0);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Estadísticas</title>
    <script src="../js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/vistas.css">
    <script src="../js/bootstrap.min.js"></script>
    <style>
        .estaciones{
            width: 500px;
            height: 100px;
            font-size: 50px;
            text-align: left;
        }
        @media only screen and (max-width: 500px) {
            .container{
                color:red;
                padding: 0;
            }
            body{
                padding: 0;
            }
            .estaciones {
                width: 200px;
                height: 30px;
                font-size: 10px;
                text-align: left;
            }
        }
    </style>
</head>
<body style="padding: 0;">
<div class="container" style="width: 100%;padding: 0;">
    <div class="panel panel-primary">
        <div class="panel-heading">Módulo Estadístico</div>
        <div class="panel-body">
            <div class="row">

            </div>
        </div>
    </div>
</div>
</body>
</html>