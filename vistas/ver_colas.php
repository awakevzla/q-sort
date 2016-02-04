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
    <script src="../js/estadisticas.js?r=<?= date('d-m-Y H:i:s') ?>"></script>
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
                    </tbody>
                </table>
                <div class="modal fade" role="dialog" id="colas">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3>Cola de la estación <span id="nombre_estacion"></span></h3>
                            </div>
                            <div class="modal-body" style="overflow-y: scroll;height: 40vh;">
                                <ul class="list-group" id="lista">

                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>
        </div>
    </div>
</div>
</body>
</html>