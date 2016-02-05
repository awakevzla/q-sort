<?php
use clases_generales\Sql;

include_once '../db/Sql.php';
include_once '../db/parametros_bd.php';
include "../modelos/contenido.php";
$contenido=new Contenido();

function convertirSegundos($time) {
    $sec = 0;
    foreach (array_reverse(explode(':', $time)) as $k => $v) $sec += pow(60, $k) * $v;
    return $sec;
}

$conex= new Sql();
$dir="../recursos/";
$tipo=$_REQUEST["selTipo"];
switch($tipo){
    case '1':
        $formatos=array('mp4', 'avi', 'swf', 'webm', 'ogv');
        $archivo=$_FILES["archivo"]["name"];
        $ext = pathinfo($archivo, PATHINFO_EXTENSION);
        if(!in_array($ext,$formatos) ) {
            die('error_formato');
        }
        $direccion=str_replace(' ', '_', $dir.basename($_FILES["archivo"]["name"]));
        move_uploaded_file($_FILES["archivo"]["tmp_name"], $direccion);
        chmod($direccion, 0777);
        $url="http://".SERVIDOR_BD."/q-sort/recursos/".str_replace(' ', '_',basename($_FILES["archivo"]["name"]));
        $duracion=convertirSegundos($_REQUEST["duracion"]);
        echo $contenido->setArchivos($url,$duracion,$tipo);
        break;
    case '2':
        $formatos=array('JPG', 'jpg', 'PNG', 'png');
        $archivo=$_FILES["archivo"]["name"];
        $ext = pathinfo($archivo, PATHINFO_EXTENSION);
        if(!in_array($ext,$formatos) ) {
            die('error_formato');
        }
        $direccion=str_replace(' ', '_', $dir.basename($_FILES["archivo"]["name"]));
        move_uploaded_file($_FILES["archivo"]["tmp_name"], $direccion);
        chmod($direccion, 0777);
        $url="http://".SERVIDOR_BD."/q-sort/recursos/".str_replace(' ', '_',basename($_FILES["archivo"]["name"]));
        $duracion=convertirSegundos($_REQUEST["duracion"]);
        echo $contenido->setArchivos($url,$duracion,$tipo);
        break;
    case '3':
        echo $contenido->setLista();
        break;
    case '4':
        $mensaje=$_REQUEST["mensaje"];
        $hablado=(isset($_REQUEST["my-checkbox"]))?1:0;
        echo $contenido->setMensaje($mensaje,$hablado,$tipo);
        break;
}