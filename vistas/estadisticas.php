<?php
/*include_once '../modelos/tickets.php';
$ticket=new Tickets();
$estaciones=$ticket->getEstaciones(0);*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Estadísticas</title>
    <script src="../js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
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
        $(document).ready(function () {
            $.ajax({
                url     :"../modelos/tickets.php",
                data    : {fecha_inicio:'2015-12-01',fecha_fin:'2015-12-12'},
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
                    datos=response["datos"];
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
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle',
                            borderWidth: 0
                        },
                        series: datos
                    });
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
                <div class="col-lg-1">

                </div>
            </div>
            <div id="container"></div>
        </div>
    </div>
</div>
</body>
</html>