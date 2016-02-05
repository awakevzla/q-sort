<?php
include "../clases/Sesion.php";
include "../modelos/contenido.php";
$contenido = new Contenido();
$sesion = new Sesion();
if ($sesion->sesion_iniciada() == false) {
    header('location:../login.php');
}
$tipos=$contenido->getTipos();
$eventos=$contenido->getEventos();
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
    <link rel="stylesheet" href="../css/bootstrap-clockpicker.css">
    <link rel="stylesheet" href="../css/bootstrap.switch.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.form.js"></script>
    <script src="../js/bootstrap-clockpicker.min.js"></script>
    <script src="../js/bootstrap.switch.js"></script>
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
                    <div class="row">
                        <label for="selTipo" class="col-sm-1 col-lg-offset-4 control-label">Seleccione Evento</label>
                        <div class="col-sm-2">
                            <select name="selTipo" id="selTipo" class="form-control">
                                <option value="0">Seleccione...</option>
                                <?php
                                foreach($tipos as $k=>$v){
                                    echo "<option value='".$v["id"]."'>".$v["evento"]."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group row" id="formArchivos" >
                        <div style="width: 35%;margin: 0 auto;">
                            <p class="bg-danger" id="formatos" style="border-radius: 15px;padding: 15px;box-shadow: 1px 5px 5px darkgray;">Formatos:</p>
                        </div>
                        <label for="archivo" class="col-sm-1 col-lg-offset-3 control-label">Archivo</label>
                        <div class="col-sm-2">
                            <input class="form-control" type="file" name="archivo" id="archivo">
                        </div>
                        <label for="duracion" class="col-sm-1 control-label">Duracion (MM:SS)</label>
                        <div class="col-sm-1">
                            <input type="text" name="duracion" class="form-control" id="duracion" placeholder="00:00">
                        </div>
                    </div>
                    <div class="form-group row" id="formMensajes" >
                        <label for="mensaje" class="col-sm-1 col-lg-offset-3 control-label">Mensaje</label>
                        <div class="col-sm-2">
                            <textarea name="mensaje" id="mensaje" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <label for="hablado" class="col-sm-1 control-label">Hablado</label>
                        <div class="col-sm-2">
                            <input type="checkbox" data-on-text="SI" data-off-text="NO" name="my-checkbox" id="hablado">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-offset-6 col-sm-1">
                            <input class="btn btn-success" type="submit" id="registrar" value="Registrar" name="subir">
                        </div>
                    </div>
                </form>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width: 0%">
                    </div>
                </div>
            </div><br><br>
            <div>
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>Orden</th>
                        <th>Tipo de Evento</th>
                        <th>Duración</th>
                        <th>Mensaje</th>
                        <th>Hablado</th>
                        <th>Contenido</th>
                        <th style="width: 250px;">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($eventos as $k=>$v){
                                $mensaje=($v["mensaje"]=="" or $v["mensaje"]==null)?"N/A":$v["mensaje"];
                                if ($v["voz"]!=0 and ($mensaje!="" or $mensaje!=null)){
                                    $voz=($v["voz"]==1)?"Si":"No";
                                }else{
                                    $voz="N/A";
                                }
                                if ($v["ruta"]!="" or $v["ruta"]!=null){
                                    $ruta="<a class='btn btn-info' href='".$v["ruta"]."' target='_blank'>Ver Contenido</a>";
                                }else{
                                    $ruta="N/A";
                                }
                                $duracion=($v["duracion"]=="" or $v["duracion"]==null)?"N/A":$v["duracion"];
                                echo "<tr>";
                                echo "<td>".$v["id"]."</td>";
                                echo "<td>".$v["tipo_evento"]."</td>";
                                echo "<td>".$duracion."</td>";
                                echo "<td>".utf8_decode($mensaje)."</td>";
                                echo "<td>".$voz."</td>";
                                echo "<td>".$ruta."</td>";
                                echo "<td>";
                                echo "<a class='btn btn-danger eliminar' data-id=".$v["id"]."><span class='glyphicon glyphicon-remove'>Eliminar</a>";
                                echo "<a class='btn btn-primary reordenar' data-id=".$v["id"]."><span class='glyphicon glyphicon-sort-by-order'></span> Reordenar</a>";
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
<div class="modal fade" id="mod_reordenar" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">Reordenar Evento</div>
                    <div class="panel-body">
                        <input type="hidden" id="id_temp">
                        <strong>ADVERTENCIA:</strong>Si la posición escogida ya está en uso, ambas serán intercambiadas<br><br>
                        <div class="row">
                            <label for="posicion" class="col-sm-2 control-label">Posición</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" min="0" id="posicion">
                            </div>
                            <div class="col-sm-5">
                                <a class="btn btn-success" id="guardar">Guardar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
</html>