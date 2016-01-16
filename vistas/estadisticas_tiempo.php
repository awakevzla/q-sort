<?php
$fechaInicio=date('Y-m-').'01';
$fechaFin=date('Y-m-d');

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Estadísticas</title>
    <link rel="stylesheet" href="../jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="../jquery-ui/jquery-ui.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../jquery-ui/jquery-ui.js"></script>
    <script src="../jquery-ui/datepicker-es.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <script src="../js/highcharts.js"></script>
    <script src="../js/exporting.js"></script>
    <link rel="stylesheet" href="../css/vistas.css">
    <script src="../js/bootstrap.min.js"></script>
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
    <script>
        $(document).ready(function () {
            $("#contTabResumen").hide();
            function getPromedioTiempo(fecha){
                $.ajax({
                    url     :"../controladores/controladores_estadisticas.php",
                    data    : {fecha:fecha,band:'getPromedioTiempo'},
                    dataType:"json",
                    type    :"post",
                    beforeSend: function () {
                        $("*").css("cursor", "wait");
                    },
                    error   : function(resp){
                        $("*").css("cursor", "default");
                        alert("!Ha ocurrido un error!");
                        console.log(resp);
                    },
                    success:function(response){
                        $("*").css("cursor", "default");
                        console.log(response);
                        strHTML="";
                        $.each(response, function (k, v) {
                            strHTML+="<tr>";
                            strHTML+="<td>"+v["estacion"]+"</td>";
                            strHTML+="<td>"+v["diferencia_segundos"]+"</td>";
                            strHTML+="<td>"+v["diferencia"]+"</td>";
                            strHTML+="</tr>";
                        });
                        $("#tabResumen tbody").html(strHTML);
                        $("#contTabResumen").slideDown();
                    }
                });
            }
            $(".datepicker").datepicker({
                maxDate:'0'
            });
            $("#btnConsultar").click(function () {
                fecha=$("#txtFecha").val();
                if (fecha!=""){
                    getPromedioTiempo(fecha);
                }else{
                    alert("Debe seleccionar una fecha!");
                }
            });
        });
    </script>
</head>
<body style="padding: 0;">
<div class="container" style="width: 100%;padding: 0;">
    <div class="panel panel-primary">
        <div class="panel-heading">Módulo Estadístico</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-4">
                    <label for="txtFecha">Fecha</label>
                    <input type="text" id="txtFecha" readonly class="form-control datepicker">
                </div>
                <div class="col-lg-4"><br>
                    <a class="btn btn-success" id="btnConsultar">Consultar</a>
                </div>
            </div>
            <div id="contTabResumen">
                <table id="tabResumen" class="table table-bordered table-stripped">
                    <thead>
                        <tr>
                            <th>Estación</th>
                            <th>Tiempo (segundos)</th>
                            <th>Tiempo (H:M:S)</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div id="container"></div>
        </div>
    </div>
</div>
</body>
</html>