<?php
include_once 'clases/Sesion.php';
$sesion = new Sesion();
if($sesion->sesion_iniciada()==true){
    $sesion->redirigir();
}
if (isset($_GET["r"])){
    switch($_GET["r"]){
        case 'claveInvalida':
            echo "<script>alert('¡Clave Inválida, verifique e intente nuevamente!');</script>";
            break;
        case 'usuarioInvalido':
            echo "<script>alert('¡Usuario Inválido, verifique e intente nuevamente!');</script>";
            break;
        case 'baneado':
            echo "<script>alert('¡Su usuario se encuentra bloqueado por muchos intentos fallidos!');</script>";
            break;
        case 'otro':
            echo "<script>alert('¡Ocurrió un problema al intentar iniciar sesión!');</script>";
            break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="align">
<div class="site__container">

    <div class="grid__container">
        <form action="clases/iniciar_sesion.php" method="post" class="form form--login">
            <div class="form__field">
                <label class="fontawesome-user" for="login__username"><i class="fa fa-user"></i></label>
                <input id="login__username" type="text" name="usuario" class="form__input" placeholder="Usuario" required>
            </div>
            <div class="form__field">
                <label class="fontawesome-lock" for="login__password"><i class="fa fa-certificate"></i></label>
                <input id="login__password" type="password" name="clave" class="form__input" placeholder="Clave" required>
            </div>
            <div class="form__field">
                <input type="submit" value="Ingresar">
            </div>
        </form>
    </div>

</div>
</body>
</html>