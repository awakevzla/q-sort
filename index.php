<?php
include "clases/Sesion.php";
$sesion = new Sesion();
if ($sesion->sesion_iniciada() == false) {
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llamar Paciente</title>
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/eventos.js"></script>
    <style>
        .estaciones {
            width: 500px;
            height: 100px;
            font-size: 40px;
            text-align: left;
        }
        body{
            background: url("img/guadalupe.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>
<body style="padding: 0 30px;">
<div class="container" style="width: 100%;height: 90vh;">
    <nav class="navbar navbar-inverse" style="margin-bottom: 0;">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Q-sort</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php
                if ($sesion->getTipo_usuario() == 1) {
                    ?>
                    <ul class="nav navbar-nav">
                        <li><a class="menu" href="vistas/generar_ticket.php">Generar Ticket</a></li>
                        <li><a class="menu" href="vistas/llamar_paciente.php">Atender Pacientes</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Estadísticas <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a class="menu" href="vistas/ver_colas.php"><i class="fa fa-group"></i> Ver Colas</a></li>
                                <li><a class="menu" href="vistas/mostrar_estadisticas.php"><i class="fa fa-bar-chart-o"></i> Estadísticas</a></li>
                            </ul>
                        </li>
                    </ul>
                    <?php
                }
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Cuenta <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="menu" href="#"><i class="fa fa-user"></i> Cambiar Clave</a></li>
                            <?php
                            if ($sesion->getTipo_usuario() == 1) {
                                ?>
                                <li><a class="menu" href="#"><span class="glyphicon glyphicon-align-justify"></span>
                                        Gestión de Usuario</a></li>
                                <?php
                            }
                            ?>
                            <li role="separator" class="divider"></li>
                            <li><a href="clases/cerrar_sesion.php"><span class="glyphicon glyphicon-off"></span> Cerrar
                                    Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div id="frame" style="width:100%;height: 100%;padding: 0;margin: 0;">
        <iframe id="iFrame" style="min-width: 100%;min-height: 100%;" src="vistas/llamar_paciente.php"
                frameborder="0"></iframe>
    </div>
</div>
</body>
</html>