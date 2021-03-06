<?php
include_once '../modelos/usuarios.php';
include "../clases/Sesion.php";
$sesion = new Sesion();
$usuarios=new Usuario();
$band=$_REQUEST["band"];
switch ($band){
    case 'getUsuarios':
        echo json_encode($usuarios->getUsuarios());
        break;
    case 'registrarUsuario':
        $login=$_REQUEST["login"];
        $nombres=$_REQUEST["nombres"];
        $apellidos=$_REQUEST["apellidos"];
        $clave=$_REQUEST["clave"];
        $tipo=$_REQUEST["tipo"];
        $estacion=$_REQUEST["estacion"];
        $vip=$_REQUEST["vip"];
        echo $usuarios->registrarUsuario($login, $nombres, $apellidos, $tipo, $clave, $estacion, $vip);
        break;
    case 'getEstaciones':
        echo json_encode($usuarios->getEstaciones());
        break;
    case 'eliminarUsuario':
        $id=$_REQUEST["id"];
        echo $usuarios->eliminarUsuario($id);
        break;
    case 'banearUsuario':
        $id=$_REQUEST["id"];
        echo $usuarios->banearUsuario($id);
        break;
    case 'desbanearUsuario':
        $id=$_REQUEST["id"];
        echo $usuarios->desbanearUsuario($id);
        break;
    case 'modificarUsuario':
        $login=$_REQUEST["login"];
        $nombres=$_REQUEST["nombres"];
        $apellidos=$_REQUEST["apellidos"];
        $clave=$_REQUEST["clave"];
        $tipo=$_REQUEST["tipo"];
        $estacion=$_REQUEST["estacion"];
        $id=$_REQUEST["id"];
        $vip=$_REQUEST["vip"];
        $resp=$usuarios->modificarUsuario($login, $nombres, $apellidos, $tipo, $clave, $estacion, $id, $vip);
        if ($resp==1){
            $sesion->setVip($vip);
        }
        echo $resp;
        break;
    case 'cambiarClave':
        $clave_anterior=$_REQUEST["clave_anterior"];
        $clave_nueva=$_REQUEST["clave_nueva"];
        $usuario_id=$sesion->getId_usuario();
        echo $usuarios->cambiarClave($usuario_id, $clave_anterior, $clave_nueva);
        break;
    case 'validarClave':
        $clave=$_REQUEST["clave"];
        echo $sesion->verificarClave($clave);
        break;
}