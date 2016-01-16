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
        var datos;
        var fecha_inicio='<?=$fechaInicio;?>';
        var fecha_fin='<?=$fechaFin;?>';
        function graficar(fecha_inicio, fecha_fin){
            $.ajax({
                url     :"../controladores/controladores_estadisticas.php",
                data    : {fecha_inicio:fecha_inicio,fecha_fin:fecha_fin,band:'generarGrafica'},
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
                    dias=response.fechas.length;
                    $("#dias").html(dias);
                    datos=response["datos"];
                    strHTML="";
                    $.each(datos, function (k, v) {
                        strHTML+="<tr>";
                        strHTML+="<td>"+v.name+"</td>";
                        cant=0;
                        $.each(v.data, function (l, m) {
                             cant=cant+parseInt(m);
                        });
                        strHTML+="<td>"+cant+"</td>";
                        strHTML+="</tr>";
                    });
                    $("#tabResumen tbody").html(strHTML);
                    $('#container').highcharts({
                        title: {
                            text: 'Pacientes en Rango de Tiempo',
                            x: -20 //center
                        },
                        subtitle: {
                            text: 'Clientes Atendidos',
                            x: -20
                        },
                        xAxis: {
                            categories: response["fechas"]
                        },
                        yAxis: {
                            title: {
                                text: 'Cantidad de Pacientes'
                            },
                            plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                        },
                        tooltip: {
                            valueSuffix: ' Pacientes'
                        },
                        legend: {
                            layout: 'horizontal',
                            align: 'middle',
                            verticalAlign: 'top',
                            borderWidth: 0
                        },
                        series: datos,
                        credits:{
                            enabled:false
                        }
                    });
                    $("#contTabResumen").slideDown();
                }
            });
        }
        $(document).ready(function () {
            $("#txtFechaInicio").val(fecha_inicio);
            $("#txtFechaFin").val(fecha_fin);
            $(".datepicker").datepicker({
                maxDate:'0'
            });
            //graficar(fecha_inicio,fecha_fin);
            $("#btnConsultar").click(function () {
                fecha_inicio=$("#txtFechaInicio").val();
                fecha_fin=$("#txtFechaFin").val();
                if (fecha_inicio=="" || fecha_fin==""){
                    alert("Debe seleccionar el intervalo de fechas!");
                    return;
                }else{
                    graficar(fecha_inicio, fecha_fin);
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
                    <label for="txtFechaInicio">Fecha inicio</label>
                    <input type="text" id="txtFechaInicio" readonly class="form-control datepicker">
                </div>
                <div class="col-lg-4">
                    <label for="txtFechaFin">Fecha fin</label>
                    <input type="text" id="txtFechaFin" readonly class="form-control datepicker">
                </div>
                <div class="col-lg-4"><br>
                    <a class="btn btn-success" id="btnConsultar"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</a>
                </div>
            </div>
            <div id="contTabResumen" style="display: none;">
            <table id="tabResumen" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Estación</th>
                        <th>Pacientes Atendidos en <span id="dias"></span> dia(s)</th>
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