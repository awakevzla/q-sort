<?php
include_once '../modelos/tickets.php';
$ticket=new Tickets();
$estaciones=$ticket->getEstaciones(0);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Generar Tickets</title>
    <script src="../js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/vistas.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/generar_ticket.js?r=<?=date('d-m-Y H:i:s')?>"></script>
    <style>
        .estaciones{
            width: 500px;
            height: 100px;
            font-size: 50px;
            text-align: left;
        }
    </style>
</head>
<body style="padding: 0;">
<div class="container" style="width: 100%;padding: 0;">
    <div class="panel panel-primary">
        <div class="panel-heading">ADMINISTRACIÓN DE COLAS</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="text-align: center;">
                    <?php
                    foreach($estaciones as $k=>$v){
                        ?>
                        <a class="btn btn-primary estaciones" data-estid="<?php echo $v["id"]; ?>" data-pref="<?php echo $v["prefijo"]; ?>" data-nombre="<?php echo $v["nombre"]; ?>" id="aps"><span class="glyphicon glyphicon-ok-circle"></span> <?php echo $v["nombre"]; ?></a><br><br>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row" id="contTicket">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align: center;"><p style="font-size: 40px;">Ticket</p></div>
                        <div class="panel-body">
                            <label class="form-control" style="font-size: 25px;height: auto;">Ticket: <span id="ticket"></span></label>
                        </div>
                        <div class="panel-footer"><p style="font-size: 20px;">Clínica "La Guadalupe"</p></div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>