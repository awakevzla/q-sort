<?php
include_once '../modelos/configuracion.php';
$config=new Configuracion();
$band=$_REQUEST["band"];
switch($band){
    case 'guardarConfiguracion':
        $cantidad_transferencias=$_REQUEST["cantidad_transferencias"];
        echo $config->guardarConfiguracion($cantidad_transferencias);
        break;
}