<?php
include_once '../modelos/contenido.php';
$band=$_REQUEST["band"];
$contenido=new Contenido();
switch($band){
    case 'eliminarEvento':
        $id=intval($_REQUEST["id"]);
        echo $contenido->eliminarEvento($id);
        break;
    case 'reordenarEvento':
        $id_temp=$_REQUEST["id_temp"];
        $id_new=$_REQUEST["id_new"];
        echo $contenido->reordenarEvento($id_temp,$id_new);
        break;
}