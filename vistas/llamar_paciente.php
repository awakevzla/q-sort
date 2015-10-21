<?php
include "../modelos/tickets.php";
include "../clases/Sesion.php";
$sesion = new Sesion();
$modulo = new Tickets();
if ($sesion->sesion_iniciada() == false) {
    header('location:../login.php');
}
$pertenece = $sesion->getEstacion_pertenece();
$estaciones = $modulo->getEstaciones($pertenece);
$estacionPertenece = $modulo->getEstacionPertenece($pertenece);
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
    <script>
        var est =<?= $pertenece;?>;
    </script>
    <script src="../funciones_generales.js?r=<?= date('d-m-Y H:i:s') ?>"></script>
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
            ADMINISTRACIÓN DE COLAS <span
                style="float: right;text-decoration: underline;"><strong>Estación: <?php echo $estacionPertenece[0]["nombre"] . "/" . utf8_decode($estacionPertenece[0]["descripcion"]); ?></strong></span>
        </div>
        <div class="panel-body">
            <div class="row" style="text-align: center;" id="contOpcion">
                <div class="col-sm-12">
                    <a class="btn btn-success estaciones" id="llamar"><span
                            class="glyphicon glyphicon-bell"></span></span> Llamar Paciente</a><br><br>
                    <a class="btn btn-primary estaciones" id="trasladar"><i class="fa fa-exchange"></i> Trasladar
                        Paciente</a><br><br>
                    <a class="btn btn-danger estaciones" id="cerrar"><span
                            class="glyphicon glyphicon-ban-circle"></span> Cerrar
                        Ticket</a><br><br>
                </div>
            </div>
            <br>

            <div class="row" id="contEstaciones" style="text-align: center;">
                <div class="col-md-12">
                    <?php
                    foreach ($estaciones as $k => $v) {
                        ?>
                        <a class="btn btn-primary estaciones" style="text-align: left;"
                           data-id="<?php echo $v["id"]; ?>"><span
                                class="glyphicon glyphicon-ok-circle"></span><?php echo $v["nombre"]; ?></a><br><br>
                        <?php
                    }
                    ?>
                    <a class="btn btn-danger estaciones" id="volver" style="text-align: left;"><span
                            class="glyphicon glyphicon-ok-circle"></span>Volver</a><br><br>
                </div>
            </div>
            <br>

            <div class="row" id="contTicket" style="text-align: center;">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align: center;"><p>ATENDIENDO / ESTACIÓN: <b><?php echo strtoupper($estacionPertenece[0]["nombre"])?></b></p></div>
                        <div class="panel-body">
                            <label class="form-control" style="height: auto;">Ticket: <span id="ticket"> ---/--- </span></label>
                            <label class="form-control" style="height: auto;">Clientes en espera: <span
                                    id="clEspera"> 0 </span></label>
                        </div>
                        <div class="panel-footer"><p>Clínica "La Guadalupe"</p></div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>