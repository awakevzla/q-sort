<?php
include "../clases/Sesion.php";
$sesion = new Sesion();
if ($sesion->sesion_iniciada() == false) {
    header('location:../login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Cambiar Clave</title>
    <script src="../js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../css/vistas.css">
    <link rel="stylesheet" href="../css/cmx_form.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src="../dist/jquery.validate.min.js"></script>
    <style>
        .estaciones {
            width: 500px;
            height: 70px;
            font-size: 40px;
            text-align: left;
        }
    </style>
    <script>
        $(document).ready(function () {
            $("#clave_anterior").focus();
            $("#formulario").validate({
                rules:{
                    clave_anterior:{
                        required:true
                    },
                    clave_nueva:{
                        required:true,
                        minlength: 5
                    },
                    clave_nueva_2:{
                        required:true,
                        minlength: 5,
                        equalTo:'#clave_nueva'
                    }
                },messages:{
                    clave_anterior:'Ingrese la clave anterior',
                    clave_nueva:{
                        required:'Ingrese la clave anterior',
                        minlength:'La contraseña debe tener al menos 5 caracteres'
                    },
                    clave_nueva_2:{
                        required:'Debe repetir la contraseña nueva',
                        minlength:'La contraseña debe tener al menos 5 caracteres',
                        equalTo:'La contraseña no coincide!'
                    }

                },
                debug:true,
                submitHandler:function(form){
                    clave_anterior=$("#clave_anterior").val();
                    clave_nueva=$("#clave_nueva").val();
                    $.ajax({
                        url     :"../controladores/controladores_usuarios.php",
                        data    : {band:'cambiarClave', clave_anterior:clave_anterior,clave_nueva:clave_nueva},
                        dataType:"json",
                        type    :"post",
                        error   : function(resp){
                            alert("!Ha ocurrido un error!");
                            console.log(resp);
                        },
                        success:function(response){
                            console.log(response);
                        }
                    });
                }

            });
        });
    </script>
</head>
<body style="padding:0;">
<div class="container" style="width: 100%;padding: 0;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Cambiar Clave
        </div>
        <div class="panel-body" style="background-color: rgba(255,255,255,0.7);">
            <form id="formulario" class="form-inline" style="text-align: left;width: 400px;margin: 0 auto;">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" style="width: 160px;">Contraseña Anterior</div>
                        <input type="password" name="clave_anterior" class="form-control" id="clave_anterior" placeholder="Clave Anterior">
                    </div><br><br>
                    <div class="input-group">
                        <div class="input-group-addon" style="width: 160px;">Contraseña Nueva</div>
                        <input type="password" name="clave_nueva" class="form-control" id="clave_nueva" placeholder="Clave Nueva">
                    </div><br><br>
                    <div class="input-group">
                        <div class="input-group-addon" style="width: 160px;">Repita Contraseña</div>
                        <input type="password" name="clave_nueva_2" class="form-control" id="clave_nueva_2" placeholder="Repita la Nueva Clave">
                    </div>
                </div>
                <br><br>
                <button type="submit" class="btn btn-primary" id="cambiarClave">Cambiar Clave</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>