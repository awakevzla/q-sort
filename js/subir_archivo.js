$(document).ready(function(){
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
        complete:function(){
            $(".sr-only").html("¡Completado!");
            $(".progress").hide();
            alert("Se ha subido el archivo completamente");
        }
    });
});