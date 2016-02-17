<?php
include_once '../modelos/configuracion.php';
$config=new Configuracion();
$maximo_transferencia=$config->maximo_transferencia;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Configuraciones Generales</title>
    <script src="../js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/vistas.css">
    <link rel="stylesheet" href="../dist/sweetalert.css">
    <link rel="stylesheet" href="../css/bootstrap.switch.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap.switch.js"></script>
    <script src="../dist/sweetalert.min.js"></script>
    <script>
        var est =<?= $maximo_transferencia;?>;
    </script>
    <script src="../js/config_general.js?r=<?=date('d-m-Y H:i:s')?>"></script>
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
        <div class="panel-heading">Configuración General</div>
        <div class="panel-body">
            <div class="form-inline">
                <div class="form-group">
                    <label for="cantidad_transferencias">Máxima cantidad de Transferencias</label>
                    <div class="input-group">
                        <div class="input-group-addon">#</div>
                        <input type="number" class="form-control" id="cantidad_transferencias" placeholder="Cantidad" min="1">
                    </div>
                </div><br><br>
                <a class="btn btn-success" id="guardar_configuracion"><span class="glyphicon glyphicon-floppy-save"> Guardar</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>