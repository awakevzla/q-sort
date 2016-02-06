$(document).ready(function () {
    $(".btn").tooltip();
    $("input").blur(function () {
        valor=$(this).val().toUpperCase();
        $(this).val(valor);
    });
    $(document).on("click", ".modificar", function () {
        id=$(this).data("id");
        nombre=$(this).data("nombre");
        descripcion=$(this).data("descripcion");
        prefijo=$(this).data("prefijo");
        id_padre=$(this).data('padre');
        transferir_id=$(this).data('transferir');
        prioridad=$(this).data("prioridad");
        $("#txtNombre").val(nombre);
        $("#txtDescripcion").val(descripcion);
        $("#txtPrefijo").val(prefijo);
        $("#selPadre").val(id_padre);
        $("#selTransferencia").val(transferir_id);
        $("#selPrioridad").val(prioridad);
        console.log(id_padre);
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
        id_padre=$("#selPadre").val();
        transferir=$("#selTransferencia").val();
        prioridad=$("#selPrioridad").val();
        if (nombre=="" || descripcion=="" || prefijo==""){
            alert("Complete todos los campos!");
            return;
        }
        if (!confirm("¿Está seguro de registrar esta estacion?")){
            return;
        }
        registrarEstacion(nombre, descripcion, prefijo, id_padre, transferir, prioridad);
    });
    $(document).on("click", "#btnModificar", function () {
        id=$("#tempId").val();
        nombre=$("#txtNombre").val();
        descripcion=$("#txtDescripcion").val();
        prefijo=$("#txtPrefijo").val();
        id_padre=$("#selPadre").val();
        transferir_id=$("#selTransferencia").val();
        prioridad=$("#selPrioridad").val();
        if (nombre=="" || descripcion=="" || prefijo==""){
            alert("Complete todos los campos!");
            return;
        }
        if (!confirm("Esta seguro de modificar esta estacion?")){
            return;
        }
        modificarEstacion(id,nombre,descripcion,prefijo,id_padre, transferir_id, prioridad);
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

function registrarEstacion(nombre, descripcion, prefijo, id_padre, transferencia_id, prioridad){
    $.ajax({
        url     :"../controladores/controladores_generar_ticket.php",
        data    : {band:"registrarEstacion",prioridad:prioridad,nombre:nombre,descripcion:descripcion,prefijo:prefijo,id_padre:id_padre,transferencia_id:transferencia_id},
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

function modificarEstacion(id,nombre,descripcion,prefijo,id_padre, transferir_id, prioridad){
    $.ajax({
        url     :"../controladores/controladores_generar_ticket.php",
        data    : {band:"modificarEstacion",prioridad:prioridad,id:id,nombre:nombre,descripcion:descripcion,prefijo:prefijo,id_padre:id_padre,transferir_id:transferir_id},
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