<?php
include "clases/Sesion.php";
$sesion = new Sesion();
if ($sesion->sesion_iniciada() == false) {
    header('location:login.php');
}
$usuario=$sesion->getNombre_usuario()." ".$sesion->getApellido_usuario();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="img/logo.png">
    <title>Q-Sort Sistema de Administradción de Colas</title>
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/vistas.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/eventos.js"></script>
    <style>
        .estaciones {
            width: 500px;
            height: 100px;
            font-size: 40px;
            text-align: left;
            background-image: url("img/guadalupe.jpg")  ;
            background-attachment: fixed;
        }
    </style>
</head>
<body style="padding: 0px;">
<div class="container" style="width: 100%;height: 90vh;padding: 0;">
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
                <a class="navbar-brand" href="" style="text-align: center;padding-top:9px;"><span style="content: url('img/logo_sinfondo.png');width: 30px;"></span></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php
                if ($sesion->getTipo_usuario() == 1) {
                    ?>
                    <ul class="nav navbar-nav">
                        <li><a class="menu" href="vistas/generar_ticket.php">Generar Ticket</a></li>
                        <li><a class="menu" href="vistas/llamar_paciente.php">Atender Pacientes</a></li>
                        <li><a class="menu" href="vistas/estaciones.php">Administrar estaciones</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Estadísticas <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a class="menu" href="vistas/ver_colas.php"><i class="fa fa-group"></i> Ver Colas</a></li>
                                <li><a class="menu" href="vistas/estadisticas.php"><i class="fa fa-male fa-lg"></i> Atención de Pacientes</a></li>
                                <li><a class="menu" href="vistas/estadisticas_tiempo.php"><i class="fa fa-clock-o"></i> Tiempo de Atención</a></li>
                            </ul>
                        </li>
                    </ul>
                    <?php
                }
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="menu">Bienvenido <?php echo $usuario; ?></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Cuenta <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="menu" href="vistas/cambiar_clave.php"><i class="fa fa-user"></i> Cambiar Clave</a></li>
                            <?php
                            if ($sesion->getTipo_usuario() == 1) {
                                ?>
                                <li><a class="menu" href="vistas/gestionar_usuarios.php"><span class="glyphicon glyphicon-align-justify"></span>
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
        <?php
        if ($sesion->getTipo_usuario() == 1){
        ?>
            <iframe id="iFrame" style="min-width: 100%;min-height: 100%;" src="vistas/ver_colas.php"
                frameborder="0"></iframe>
        <?php
        }else{
            ?>
            <iframe id="iFrame" style="min-width: 100%;min-height: 100%;" src="vistas/llamar_paciente.php"
                    frameborder="0"></iframe>
            <?php
        }
        ?>
    </div>
</div>
</body>
</html>