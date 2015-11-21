function registrarUsuario(login, nombres, apellidos, tipo, clave_1, clave_2, estacion){
    if (clave_1==""){
        alert("Debe ingresar una clave!");
        $("#password").focus();
        return;
    }
    if (clave_1 != clave_2){
        alert("Las claves ingresadas no coinciden!");
        $("#password").focus();
        return;
    }
    if (login==""){
        alert("Ingrese un login!");
        $("#txtLogin").focus();
        return;
    }
    if (nombres==""){
        alert("Debe ingresar un nombre!");
        $("#txtNombres").focus();
        return;
    }
    if (apellidos==""){
        alert("Debe ingresar un apellido!");
        $("#txtApellidos").focus();
        return;
    }
    if (tipo=="0"){
        alert("Seleccione un tipo de usuario!");
        return;
    }
    if (tipo!="1" && estacion=="0"){
        alert("Debe seleccionar una estación!");
        return;
    }

    $.ajax({
        url     :"../controladores/controladores_usuarios.php",
        data    : {band:"registrarUsuario", login:login, nombres:nombres, apellidos:apellidos, tipo:tipo, clave:clave_1, estacion:estacion},
        dataType:"text",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            console.log(response);
            if (parseInt(response)==1){
                alert("Registro completo!");
                limpiarFormulario();
            }else{
                alert("Ocurrió un error al intentar registrar, intente nuevamente o comuníquese con el administrador del sistema.");
            }
        }
    });
}
function limpiarFormulario(){
    $("input[type = text]").val("");
    $("input[type = password]").val("");
    $("select").val("0");
    $("#txtLogin").focus();
    getUsuarios();
}
function getUsuarios(){
    $.ajax({
        url     :"../controladores/controladores_usuarios.php",
        data    : {band:"getUsuarios"},
        dataType:"json",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            console.log(response);
            dibujarTabla('tabUsuarios', response);
        }
    });
}
function dibujarTabla(tabla, datos){
    $("#"+tabla).dataTable().fnClearTable();
    $("#"+tabla).dataTable().fnDestroy();
    strHTML="";
    $.each(datos, function (k, v) {
        strHTML+="<tr>";
        strHTML+="<td>"+v["login"]+"</td>";
        strHTML+="<td>"+v["nombre_completo"]+"</td>";
        strHTML+="<td>"+v["tipo"]+"</td>";
        strHTML+="<td>"+v["estacion"]+"</td>";
        strHTML+="<td>"+v["baneado"]+"</td>";
        strHTML+="<td>";
            strHTML+="<a class='btn btn-danger eliminar' data-toggle='tooltip' data-placement='top' data-id="+v["id"]+" title='Eliminar'><span class='glyphicon glyphicon-remove'></span></a>";
            strHTML+="<a class='btn btn-warning modificar' data-toggle='tooltip' data-nombre='"+v["nombre"]+"' data-estacion='"+v["estacion_id"]+"' data-apellido='"+v["apellido"]+"' data-login='"+v["login"]+"' data-tipo='"+v["tipo_id"]+"' data-id="+v["id"]+" data-placement='top' title='Modificar'><span class='glyphicon glyphicon-edit'></span></a>";
            strHTML+="<a class='btn btn-default bloquear' data-toggle='tooltip' data-id="+v["id"]+" data-placement='top' title='Bloquear'><i class='fa fa-lock'></i></a>";
            strHTML+="<a class='btn btn-success desbloquear' data-toggle='tooltip' data-id="+v["id"]+" data-placement='top' title='Desbloquear'><i class='fa fa-unlock'></i></a>";
        strHTML+="</td>";
        strHTML+="</tr>";
    });
    $("#"+tabla+" tbody").html(strHTML);
    $("#"+tabla).dataTable({
        language: {
            url: '../js/media/js/Spanish.json'
        }
    });
}

function eliminarUsuario(id){
    $.ajax({
        url     :"../controladores/controladores_usuarios.php",
        data    : {band:"eliminarUsuario", id:id},
        dataType:"text",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            console.log(response);
            if (parseInt(response)==1){
                alert("Se ha eliminado el usuario exitosamente!");
                limpiarFormulario();
            }else{
                alert("Ocurrió un error al intentar eliminar el usuario, intente nuevamente o comuníquese con el administrador del sistema.");
                limpiarFormulario();
            }
        }
    });
}
function banearUsuario(id){
    $.ajax({
        url     :"../controladores/controladores_usuarios.php",
        data    : {band:"banearUsuario", id:id},
        dataType:"text",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            console.log(response);
            if (parseInt(response)==1){
                alert("Se ha bloqueado el usuario exitosamente!");
                limpiarFormulario();
            }else{
                alert("Ocurrió un error al intentar bloquear el usuario, intente nuevamente o comuníquese con el administrador del sistema.");
                limpiarFormulario();
            }
        }
    });
}
function desbanearUsuario(id){
    $.ajax({
        url     :"../controladores/controladores_usuarios.php",
        data    : {band:"desbanearUsuario", id:id},
        dataType:"text",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            console.log(response);
            if (parseInt(response)==1){
                alert("Se ha bloqueado el usuario exitosamente!");
                limpiarFormulario();
            }else{
                alert("Ocurrió un error al intentar bloquear el usuario, intente nuevamente o comuníquese con el administrador del sistema.");
                limpiarFormulario();
            }
        }
    });
}

function modificarUsuario(login, nombres, apellidos, tipo, clave, clave_2, estacion, id){
    if (id=="" || !parseInt(id) || parseInt(id)<1){
        console.log(id, login, nombres, apellidos, tipo, clave, clave_2, estacion);
        alert("Ocurrió un problema, intente nuevamente o comuníquese con el administrador del sistema!");
        return;
    }
    if (clave!=""){
        if (clave != clave_2){
            alert("Las claves ingresadas no coinciden!");
            $("#password").focus();
            return;
        }
    }
    if (login==""){
        alert("Ingrese un login!");
        $("#txtLogin").focus();
        return;
    }
    if (nombres==""){
        alert("Debe ingresar un nombre!");
        $("#txtNombres").focus();
        return;
    }
    if (apellidos==""){
        alert("Debe ingresar un apellido!");
        $("#txtApellidos").focus();
        return;
    }
    if (tipo=="0"){
        alert("Seleccione un tipo de usuario!");
        return;
    }
    if (tipo!="1" && estacion=="0"){
        alert("Debe seleccionar una estación!");
        return;
    }
    $.ajax({
        url     :"../controladores/controladores_usuarios.php",
        data    : {band:"modificarUsuario", login:login, nombres:nombres, apellidos:apellidos, tipo:tipo, clave:clave, estacion:estacion, id:id},
        dataType:"text",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            console.log(response);
            if (parseInt(response)==1){
                alert("Usuario Modificado!");
                limpiarFormulario();
            }else{
                alert("Ocurrió un error al intentar modificar usuario, intente nuevamente o comuníquese con el administrador del sistema.");
            }
        }
    });
}
$(document).ready(function () {
    $("#tabUsuarios").dataTable({
        language: {
            url: '../js/media/js/Spanish.json'
        }
    });
    $(".btn").tooltip();
    $(document).on("click", ".modificar", function () {
        id=$(this).data('id');

    });
    $(document).on("click", "#btnRegistrar", function () {
        login=$("#txtLogin").val();
        nombres=$("#txtNombres").val();
        apellidos=$("#txtApellidos").val();
        tipo=$("#selTipo").val();
        password=$("#password").val();
        password_2=$("#password_2").val();
        estacion=$("#selEstacion").val();
        if (!confirm("¿Está seguro de registrar éste usuario?")){
            return;
        }
        registrarUsuario(login,nombres,apellidos,tipo,password, password_2, estacion)
    });
    $(document).on("blur", "#txtLogin", function () {
        valor=$(this).val();
        $(this).val(valor.toLowerCase());
    });
    $(document).on("click", ".eliminar", function () {
        id=$(this).data("id");
        if (!confirm("¿Está seguro de eliminar éste usuario?")){
            return;
        }
        eliminarUsuario(id);
    });
    $(document).on("click", ".bloquear", function () {
        if (!confirm("¿Está seguro de bloquear éste usuario?")){
            return;
        }
        id=$(this).data("id");
        banearUsuario(id);
    });
    $(document).on("click", ".desbloquear", function () {
        if (!confirm("¿Está seguro de desbloquear éste usuario?")){
            return;
        }
        id=$(this).data("id");
        desbanearUsuario(id);
    });
    $(document).on("click", ".modificar", function(){
        login=$(this).data("login");
        nombres=$(this).data("nombre");
        apellidos=$(this).data("apellido");
        tipo_id=$(this).data("tipo");
        estacion=$(this).data("estacion");
        id=$(this).data("id");
        $("#modificar").slideDown();
        $("#registrar").slideUp();
        $("#txtLogin").val(login);
        $("#txtNombres").val(nombres);
        $("#txtApellidos").val(apellidos);
        $("#selTipo").val(tipo_id);
        $("#selEstacion").val(estacion);
        $("#tempId").val(id);
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });
    $(document).on("click", "#btnCancelar", function () {
        $("#modificar").spassword_2lideUp();
        $("#registrar").slideDown();
        limpiarFormulario();
    });
    $(document).on("click", "#btnModificar", function () {
        if (!confirm("¿Está seguro de modificar éste usuario?")){
            return;
        }
        login=$("#txtLogin").val();
        nombres=$("#txtNombres").val();
        apellidos=$("#txtApellidos").val();
        tipo=$("#selTipo").val();
        clave=$("#password").val();
        clave_2=$("#password_2").val();
        estacion=$("#selEstacion").val();
        id=$("#tempId").val();
        modificarUsuario(login, nombres, apellidos, tipo, clave, clave_2, estacion, id);
    });
});