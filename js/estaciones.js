$(document).ready(function () {
    $(".btn").tooltip();
    $(document).on("click", ".modificar", function () {
        id=$(this).data("id");
        nombre=$(this).data("nombre");
        descripcion=$(this).data("descripcion");
        prefijo=$(this).data("prefijo");
        $("#txtNombre").val(nombre);
        $("#txtDescripcion").val(descripcion);
        $("#txtPrefijo").val(prefijo);
        $("#tempId").val(id);
        $("#modificar").slideDown();
        $("#registrar").slideUp();
    });
    $(document).on("click", "#btnCancelar", function () {
        $("#modificar").slideUp();
        $("#registrar").slideDown();
        limpiarFormulario();
    });
    $(document).on("click", "#btnRegistrar", function () {
        nombre=$("#txtNombre").val();
        descripcion=$("#txtDescripcion").val();
        prefijo=$("#txtPrefijo").val();
        if (nombre=="" || descripcion=="" || prefijo==""){
            alert("Complete todos los campos!");
            return;
        }
        if (!confirm("¿Esta seguro de registrar esta estacion?")){
            return;
        }
        registrarEstacion(nombre, descripcion, prefijo);
    });
    $(document).on("click", "#btnModificar", function () {
        id=$("#tempId").val();
        nombre=$("#txtNombre").val();
        descripcion=$("#txtDescripcion").val();
        prefijo=$("#txtPrefijo").val();
        if (nombre=="" || descripcion=="" || prefijo==""){
            alert("Complete todos los campos!");
            return;
        }
        if (!confirm("Esta seguro de modificar esta estacion?")){
            return;
        }
        modificarEstacion(id,nombre,descripcion,prefijo);
    });
    $(document).on("click", ".eliminar", function () {
        id=$(this).data("id");
        if (id!=""){
            if (!confirm("Esta seguro de eliminar esta estacion?")){
                return;
            }else{
                eliminarEstacion(id);
            }
        }else{
            alert("Ocurrio un problema, intente nuevamente o comuniquese con el administrador del sistema!");
            location.reload();
        }
    });
});
function limpiarFormulario(){
    $("input[type = text]").val("");
    $("select").val("0");
    $("#txtNombre").focus();
}

function registrarEstacion(nombre, descripcion, prefijo){
    $.ajax({
        url     :"../controladores/controladores_generar_ticket.php",
        data    : {band:"registrarEstacion",nombre:nombre,descripcion:descripcion,prefijo:prefijo},
        dataType:"text",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            console.log(response);
            if (response=="1"){
                alert("Registro completado!");
                location.reload();
            }else{
                alert("Ha ocurrido un inconveniente, intente nuevamente o comuniquese con el administrador del sistema!");
            }
        }
    });
}

function modificarEstacion(id,nombre,descripcion,prefijo){
    $.ajax({
        url     :"../controladores/controladores_generar_ticket.php",
        data    : {band:"modificarEstacion",id:id,nombre:nombre,descripcion:descripcion,prefijo:prefijo},
        dataType:"text",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            console.log(response);
            if (response=="1"){
                alert("Modificacion Exitosa!");
                location.reload();
            }else{
                alert("Ha ocurrido un inconveniente, intente nuevamente o comuniquese con el administrador del sistema!");
            }
        }
    });
}

function eliminarEstacion(id){
    $.ajax({
        url     :"../controladores/controladores_generar_ticket.php",
        data    : {band:"eliminarEstacion",id:id},
        dataType:"text",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            console.log(response);
            if (response=="1"){
                alert("Eliminacion Exitosa!");
                location.reload();
            }else{
                alert("Ha ocurrido un inconveniente, intente nuevamente o comuniquese con el administrador del sistema!");
            }
        }
    });
}