<?php
include "../clases/Sesion.php";
include "../modelos/usuarios.php";
$User=new Usuario();
$sesion=new Sesion();
if ($sesion->sesion_iniciada()==false){
    header('location:../login.php');
}
if ($sesion->getTipo_usuario()!=1){
    echo "<script>alert('¡Ésta página es solo para administradores!');</script>";
    header('location:../index.php');
}
$estaciones=$User->getEstaciones();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Gestion de Estaciones</title>
    <script src="../js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../css/vistas.css">
    <link rel="stylesheet" href="../js/media/css/jquery.dataTables.min.css">
    <script src="../js/media/js/jquery.dataTables.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/estaciones.js"></script>
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
            Gestion de Estaciones
        </div>
        <div class="panel-body">
            <div style="background-color: rgba(255,255,255,0.7);">
                <div id="formulario" class="form-horizontal">
                    <div class="form-group">
                        <label for="txtNombre" class="col-sm-1 control-label">Nombre</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="txtNombre" placeholder="Nombre">
                        </div>
                        <label for="txtDescripcion" class="col-sm-1 control-label">Descripcion</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="txtDescripcion" placeholder="Descripcion">
                        </div>
                        <label for="txtPrefijo" class="col-sm-1 control-label">Prefijo</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="txtPrefijo" placeholder="Prefijo" maxlength="3">
                        </div>
                    </div>
                    <div class="row" id="registrar">
                        <div class="col-md-3 col-md-offset-6">
                            <a class="btn btn-success" id="btnRegistrar"><span class="glyphicon glyphicon-floppy-save"></span> Registrar</a>
                        </div>
                    </div>
                    <div class="row" id="modificar" style="display: none;">
                        <div class="col-md-3 col-md-offset-6">
                            <a class="btn btn-warning" id="btnModificar"><span class="glyphicon glyphicon-floppy-save"></span> Guardar</a>
                            <a class="btn btn-danger" id="btnCancelar"><span class="glyphicon glyphicon-floppy-remove"></span> Cancelar</a>
                        </div>
                    </div>
                </div><br>
                <input type="text" id="tempId" value="" style="display: none;">
                <table id="tabUsuarios" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Prefijo</th>
                        <th>Accion</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($estaciones as $k=>$v){
                        echo "<tr>";
                            echo "<td>".$v["id"]."</td>";
                            echo "<td>".utf8_decode($v["nombre"])."</td>";
                            echo "<td>".utf8_decode($v["descripcion"])."</td>";
                            echo "<td>".$v["prefijo"]."</td>";
                            echo "<td style='width: 180px;'>
                                    <a class='btn btn-danger eliminar' data-toggle='tooltip' data-placement='top' data-id=".$v["id"]." title='Eliminar'><span class='glyphicon glyphicon-remove'></span></a>
                                    <a class='btn btn-warning modificar' data-toggle='tooltip' data-nombre='".utf8_decode($v["nombre"])."' data-descripcion='".utf8_decode($v["descripcion"])."' data-prefijo='".$v["prefijo"]."' data-id='".$v["id"]."' data-placement='top' title='Modificar'><span class='glyphicon glyphicon-edit'></span></a>
                                </td>";
                            echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>