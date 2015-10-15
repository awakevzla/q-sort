<?php
require_once 'Sesion.php';
$usuario = $_REQUEST["usuario"];
$clave = $_REQUEST["clave"];

$sesion = new Sesion();
try {
    $sesion->crear_sesion($usuario, $clave);

    if ($sesion->sesion_iniciada() == true) {
        header("location:../");
    }
    else {
        header("Location: ../index.php");
    }

} catch (Exception $e) {
    echo $e->getMessage();
}