<?php
require_once 'Sesion.php';
$usuario = $_REQUEST["usuario"];
$clave = $_REQUEST["clave"];

$sesion = new Sesion();
try {
    $resp=$sesion->crear_sesion($usuario, $clave);
    if ($resp["resp"]==1) {
        header("location:../");
    }else{
        switch ($resp["motivo"]){
            case 'claveInvalida':
                header("location:../login.php?r=claveInvalida");
                break;
            case 'usuarioInvalido':
                header("location:../login.php?r=usuarioInvalido");
                break;
            case 'baneado':
                header("location:../login.php?r=baneado");
                break;
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}