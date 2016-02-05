function eliminarEvento(id){
    $.ajax({
        url     :"../controladores/controladores_contenido.php",
        data    : {id:id,band:"eliminarEvento"},
        dataType:"json",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            if (response==1){
                alert("Eliminación Exitosa!");
                location.reload();
            }else{
                alert("Ocurrió un inconveniente al intentar eliminar el recurso, intente nuevamente!");
                location.reload();
            }
        }
    });
}

function reordenarEvento(id_temp, id_new){
    $.ajax({
        url     :"../controladores/controladores_contenido.php",
        data    : {id_temp:id_temp,id_new:id_new,band:"reordenarEvento"},
        dataType:"json",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            console.log(response);
            if (response==1){
                alert("Se ha reordenado con éxito!");
                location.reload();
            }else{
                alert("Ocurrió un inconveniente al intentar reordenar eventos, intente nuevamente!");
                location.reload();
            }
        }
    });
}
$(document).ready(function(){
    $('#duracion').clockpicker({
        autoclose: true
    });
    $("#formArchivos").hide();
    $("#formMensajes").hide();
    $(".eliminar").click(function () {
        id=$(this).data("id");
        if (id){
            if(!confirm("¿Está seguro de eliminar éste evento?")){
                return;
            }
            eliminarEvento(id);
        }else{
            alert("Ocurrió un problema, comuníquese con el administrador del sistema!");
        }
    });

    $(".reordenar").click(function () {
        id=$(this).data("id");
        $("#id_temp").val(id);
        $("#posicion").val(id);
        $("#mod_reordenar").modal();
    });
    $("#guardar").click(function () {
        if (!confirm("¿Estás seguro de guardar éste reordenamiento?")){
            return;
        }
        id_temp=$("#id_temp").val();
        id_new=$("#posicion").val();
        reordenarEvento(id_temp, id_new);
    });
    $(document).on("change", "#selTipo", function () {
        id=$(this).val();
        switch (id) {
            case '0':
                $("input[type!=submit]").val("");
                $("#formArchivos").slideUp();
                $("#formMensajes").slideUp();
                break;
            case '1':
                $("#formatos").html("<strong>Formatos</strong>: Mp4, Avi, Webm, Swf");
                $("#formMensajes").slideUp();
                $("#formArchivos").slideDown();
                break;
            case '2':
                $("#formatos").html("<strong>Formatos</strong>: Jpg, Png");
                $("#formMensajes").slideUp();
                $("#formArchivos").slideDown();
                break;
            case '3':
                alert("¡Haga Click en Registrar para guardar la reproducción de la lista!");
                break;
            case '4':
                $("#formMensajes").slideDown();
                $("#formArchivos").slideUp();
                break;
        }
    });
    $("#registrar").click(function (e) {
        e.preventDefault();
        if (!confirm("¿Está seguro de registrar éste contenido?")){
            return;
        }
        id_tipo=$("#selTipo").val();
        switch (id_tipo){
            case '0':
                alert("¡Debe seleccionar un tipo de evento!");
                break;
            case '1':
                archivo=$("#archivo").val();
                duracion=$("#duracion").val();
                if (archivo=="" || duracion==""){
                    alert("Debe completar todos los campos!");
                }else{
                    $("#formulario").submit();
                }
                break;
            case '2':
                archivo=$("#archivo").val();
                duracion=$("#duracion").val();
                if (archivo=="" || duracion==""){
                    alert("Debe completar todos los campos!");
                }else{
                    $("#formulario").submit();
                }
                break;
            case '3':
                $("#formulario").submit();
                break;
            case '4':
                mensaje=$("#mensaje").val();
                if (mensaje==""){
                    alert("¡Debe escribir un Mensaje!");
                }else{
                    $("#formulario").submit();
                }
                break;
        }
    });
    $("[name='my-checkbox']").bootstrapSwitch();
    $(".progress").hide();
    $("#formulario").ajaxForm({
        beforeSend:function(){
            $(".progress").show();
        },
        uploadProgress:function(event, position, total, percentComplete){
            $(".progress-bar").width(percentComplete+"%");
            $(".sr-only").html(percentComplete);
        },
        success:function(){},
        complete:function(e){
            $(".progress").hide();
            resp= e.responseText;
            if (resp!="1"){
                switch (resp){
                    case 'error_formato':
                        alert("!Error de Formato, lea la documentación del sistema para ver los formatos soportados!");
                        location.reload();
                        break;
                    default :
                        alert("¡Ocurrió un inconveniente al cargar el evento, verifique o intente nuevamente!");
                        location.reload();
                        break;
                }
            }else{
                alert("Registro completado!");
                location.reload();
            }
        }
    });
});