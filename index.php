<?php
include_once 'clases/Sesion.php';
$sesion = new Sesion();
if($sesion->sesion_iniciada()==true){
    $sesion->redirigir();
}
?>

<!doctype html>
<html>
<header>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Iniciar Sesión</title>
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</header>
<body>
<form action="clases/iniciar_sesion.php" method="post">
    <div class="panel panel-primary" style="max-width: 40%;margin: 0 auto;">
        <div class="panel-heading" style="text-align: center;"><p>Iniciar Sesión</p></div>
        <div class="panel-body" style="text-align: center;">
            <input type="text" placeholder="Usuario" name="usuario" class="form-control"><br>
            <input type="password" placeholder="******" name="clave" class="form-control"><br>
            <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-log-in"></span>&nbsp; Iniciar
            </button>
        </div>
        <div class="panel-footer"><p></p></div>
    </div>
</form>
</body>
<script>
    $("input[type=text]").focus();
</script>
</html>