<?php
include "../clases/Sesion.php";
$sesion = new Sesion();
if ($sesion->sesion_iniciada() == false) {
    header('location:../login.php');
}
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
    <script src="../js/jquery.form.js"></script>
    <script src="../js/subir_archivo.js?r=<?= date('d-m-Y H:i:s') ?>"></script>
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
            Administrar Contenido
        </div>
        <div class="panel-body">
            <div style="background-color: rgba(255,255,255,0.7);">
                <form name="formulario" id="formulario" enctype="multipart/form-data" action="archivos.php" method="post">
                    <input class="form-control" type="file" name="archivo"><br>
                    <input class="btn btn-default" type="submit" value="Subir" name="subir">
                </form>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width: 0%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>