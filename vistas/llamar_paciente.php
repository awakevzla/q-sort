<?php
include "../modelos/tickets.php";
include "../clases/Sesion.php";
$sesion=new Sesion();
$modulo=new Tickets();
$pertenece=$sesion->getEstacion_pertenece();
$estaciones=$modulo->getEstaciones($pertenece);
$estacionPertenece=$modulo->getEstacionPertenece($pertenece);
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
    <script src="../js/bootstrap.min.js"></script>
    <script>
        var est=<?= $pertenece;?>;
    </script>
    <script src="../funciones_generales.js"></script>
    <style>
        .estaciones{
            width: 500px;
            height: 100px;
            font-size: 40px;
            text-align: left;
        }
    </style>
</head>
<body style="padding: 0 30px;">
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            ADMINISTRACIÓN DE COLAS <span style="float: right;text-decoration: underline;"><strong>Estación: <?php echo $estacionPertenece[0]["nombre"]."/".utf8_decode($estacionPertenece[0]["descripcion"]);?></strong></span><br>
            <br><div style="text-align: right;"><a style="color: white;" href="../clases/cerrar_sesion.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></div>
        </div>
        <div class="panel-body">
            <div class="row" style="text-align: center;" id="contOpcion">
                <div class="col-sm-12">
                    <a class="btn btn-success estaciones" id="llamar"><span class="glyphicon glyphicon-ok-circle"></span>Llamar Paciente</a><br><br>
                    <a class="btn btn-primary estaciones" id="trasladar"><span class="glyphicon glyphicon-ok-circle"></span>Trasladar Paciente</a><br><br>
                    <a class="btn btn-danger estaciones" id="cerrar"><span class="glyphicon glyphicon-ok-circle"></span>Cerrar Ticket</a><br><br>
                </div>
            </div><br>
            <div class="row" id="contEstaciones" style="text-align: center;">
                <div class="col-md-12">
                    <?php
                    foreach ($estaciones as $k=>$v){
                    ?>
                        <a class="btn btn-primary estaciones" style="text-align: left;" data-id="<?php echo $v["id"]; ?>"><span class="glyphicon glyphicon-ok-circle"></span><?php echo $v["nombre"]; ?></a><br><br>
                    <?php
                    }
                    ?>
                    <a class="btn btn-danger estaciones" id="volver" style="text-align: left;"><span class="glyphicon glyphicon-ok-circle"></span>Volver</a><br><br>
                </div>
            </div>
            <br>
            <div class="row" id="contTicket" style="text-align: center;">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align: center;"><p>ATENDIENDO</p></div>
                        <div class="panel-body">
                            <label class="form-control" style="height: auto;">Ticket: <span id="ticket"> ---/--- </span></label>
                            <label class="form-control" style="height: auto;">Clientes en espera: <span id="clEspera"> 0 </span></label>
                        </div>
                        <div class="panel-footer"><p >Clínica "La Guadalupe"</p></div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>