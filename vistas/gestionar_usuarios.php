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
$usuarios=$User->getUsuarios();
$tipos=$User->getTipos();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Gestión de Usuarios</title>
    <script src="../js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../css/vistas.css">
    <link rel="stylesheet" href="../js/media/css/jquery.dataTables.min.css">
    <script src="../js/media/js/jquery.dataTables.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/usuarios.js"></script>
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
                Gestión de Usuarios
            </div>
            <div class="panel-body">
                <div style="background-color: rgba(255,255,255,0.7);">
                    <div id="formulario" class="form-horizontal">
                        <div class="form-group">
                            <label for="txtLogin" class="col-sm-1 control-label">Login</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="txtLogin" placeholder="Login">
                            </div>
                            <label for="txtNombres" class="col-sm-1 control-label">Nombres</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="txtNombres" placeholder="Nombres">
                            </div>
                            <label for="txtApellidos" class="col-sm-1 control-label">Apellidos</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="txtApellidos" placeholder="Apellidos">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="selTipo" class="col-sm-1 control-label">Tipo</label>
                            <div class="col-sm-3">
                                <select id="selTipo" class="form-control">
                                    <option value="0">Seleccione...</option>
                                    <?php
                                    foreach ($tipos as $k=>$v) {
                                        echo "<option value='".$v["id"]."'>".$v["nombre"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label for="password" class="col-sm-1 control-label">Clave</label>
                            <div class="col-sm-3">
                                <input type="password" id="password" class="form-control">
                            </div>
                            <label for="password_2" class="col-sm-1 control-label">Repita Clave</label>
                            <div class="col-sm-3">
                                <input type="password" id="password_2" class="form-control">
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
                                <a class="btn btn-danger" id="btnModificar"><span class="glyphicon glyphicon-floppy-remove"></span> Cancelar</a>
                            </div>
                        </div>
                    </div>
                    <table id="tabUsuarios" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Login</th>
                            <th>Nombre y apellido</th>
                            <th>Tipo</th>
                            <th>Baneado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($usuarios as $k=>$v){
                            echo "<tr>";
                            echo "<td>".$v["login"]."</td>";
                            echo "<td>".$v["nombre_completo"]."</td>";
                            echo "<td>".$v["tipo"]."</td>";
                            echo "<td>".$v["baneado"]."</td>";
                            echo "<td style='width: 180px;'>
                                <a class='btn btn-danger eliminar' data-toggle='tooltip' data-nombre='".$v["nombre"]."' data-apellido='".$v["apellido"]."' data-login='".$v["login"]."' data-tipo='".$v["tipo_id"]."' data-id=".$v["id"]." data-placement='top' title='Eliminar'><span class='glyphicon glyphicon-remove'></span></a>
                                <a class='btn btn-warning modificar' data-toggle='tooltip' data-id=".$v["id"]." data-placement='top' title='Modificar'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-default bloquear' data-toggle='tooltip' data-id=".$v["id"]." data-placement='top' title='Bloquear'><i class='fa fa-lock'></i></a>
                                <a class='btn btn-success desbloquear' data-toggle='tooltip' data-id=".$v["id"]." data-placement='top' title='Desbloquear'><i class='fa fa-unlock'></i></a>
                                </td>";
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