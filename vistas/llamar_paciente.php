<?php
include "../modelos/tickets.php";
include "../clases/Sesion.php";
include "../modelos/configuracion.php";
$configuracion= new Configuracion();
$sesion = new Sesion();
$modulo = new Tickets();
if ($sesion->sesion_iniciada() == false) {
    header('location:../login.php');
}
$maximo_transferencia=$configuracion->maximo_transferencia;
$pertenece = $sesion->getEstacion_pertenece();
if (!$pertenece){
    die("<script>alert('Éste usuario no posee estación asociada!');</script>");
}
$estacionInfo=$modulo->getEstacion($pertenece);
$transferir=$estacionInfo[0]["transferir_id"];
$padre=$estacionInfo[0]["id_padre"];
$prioridad=$estacionInfo[0]["prioridad"];
$transf_estacion="";
$estaciones = $modulo->getEstaciones($pertenece);
foreach ($estaciones as $k=>$v) {
    if ($transferir==$v["id"]){
        $transf_estacion=$v["nombre"];
    }
}
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
    <link rel="stylesheet" href="../dist/sweetalert.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src="../dist/sweetalert.min.js"></script>
    <script>
        var est =<?= $pertenece;?>;
        var transferir =<?= $transferir;?>;
        var maximo_transferencia =<?= $maximo_transferencia;?>;
        var padre =<?= $padre;?>;
        var transferir_est ='<?= $transf_estacion;?>';
        var prioridad ='<?= $prioridad;?>';
    </script>
    <script src="../funciones_generales.js?r=<?= date('d-m-Y H:i:s') ?>"></script>
    <style>
        .estaciones {
            width: 500px;
            height: 70px;
            font-size: 40px;
            text-align: left;
        }
        @media only screen and (max-width: 700px) {
            .container{
                color:red;
                padding: 0;
            }
            body{
                padding: 0;
            }
            .estaciones {
                width: 300px;
                height: 40px;
                font-size: 20px;
                text-align: left;
            }
        }
        @media only screen and (max-width: 500px) {
            .panel-heading{
                font-size:10px;
            }
            .container{
                color:red;
                padding: 0;
            }
            body{
                padding: 0;
            }
            .estaciones {
                width: 150px;
                height: 40px;
                font-size: 15px;
                text-align: left;
            }
        }
    </style>
</head>
<body style="padding:0;">
<div class="container" style="width: 100%;padding: 0;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            ADMINISTRACIÓN DE COLAS <span
                style="float: right;text-decoration: underline;"><strong>Estación: <?php echo utf8_decode($estacionPertenece[0]["nombre"]) . "/" . utf8_decode($estacionPertenece[0]["descripcion"]); ?></strong></span>
        </div>
        <div class="panel-body">
            <table align="center" style="width: 100%;">
                <tr>
                    <td>
                        <div class="row" style="text-align: center;" id="contOpcion">
                            <div class="col-sm-12">
                                <button class="btn btn-success estaciones" id="llamar"><span
                                        class="glyphicon glyphicon-bell"></span></span> Llamar Paciente</button><br><br>
                                <?php
                                if (!$transferir){
                                ?>
                                <button class="btn btn-primary estaciones" id="trasladar"><i class="fa fa-exchange"></i> Trasladar
                                    Paciente</button><br><br>
                                <?php
                                }
                                ?>
                                <button class="btn btn-primary estaciones" id="rellamar"><i class="fa fa-exchange"></i> Re-Llamar</button><br><br>
                                <button class="btn btn-danger estaciones" id="cerrar"><span
                                        class="glyphicon glyphicon-ban-circle"></span> Cerrar
                                    Ticket</button><br><br>
                            </div>
                        </div>
                        <br>

                        <div class="row" id="contEstaciones" style="text-align: center;">
                            <div class="col-md-12">
                                <?php
                                foreach ($estaciones as $k => $v) {
                                    ?>
                                    <a class="btn btn-primary estaciones trasladar" style="text-align: left;"
                                       data-id="<?php echo $v["id"]; ?>"><span
                                            class="glyphicon glyphicon-ok-circle"></span><?php echo utf8_decode($v["nombre"]); ?></a><br><br>
                                    <?php
                                }
                                ?>
                                <button class="btn btn-danger estaciones" id="volver" style="text-align: left;"><span
                                        class="glyphicon glyphicon-ok-circle"></span>Volver</button><br><br>
                            </div>
                        </div>
                        <br>
                    </td>
                    <td>
                        <div class="row" id="contTicket" style="text-align: center;">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading" style="text-align: center;"><p>ATENDIENDO / ESTACIÓN: <b><?php echo strtoupper(utf8_decode($estacionPertenece[0]["nombre"]))?></b></p></div>
                                    <div class="panel-body">
                                        <label class="form-control" style="height: auto;">Ticket: <span id="ticket"> ---/--- </span></label>
                                        <label class="form-control" style="height: auto;">Clientes en espera: <span
                                                id="clEspera"> 0 </span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>