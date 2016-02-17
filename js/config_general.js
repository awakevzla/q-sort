$(document).ready(function () {
    $("#cantidad_transferencias").val(est);
    $("#guardar_configuracion").click(function () {
        swal({
            title: "Confirme",
            text: "¿Está seguro de guardar la Configuración?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Guardar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm){
            if (isConfirm) {
                cantidad=$("#cantidad_transferencias").val();
                $.ajax({
                    url     :"../controladores/controladores_configuracion.php",
                    data    : {cantidad_transferencias:cantidad,band:"guardarConfiguracion"},
                    dataType:"json",
                    type    :"post",
                    error   : function(resp){
                        swal({
                            title: "Error",
                            text: "Ocurrió un error, intente nuevamente!",
                            timer: 2000,
                            type:   "error",
                            showConfirmButton: false
                        });
                        location.reload();
                    },
                    success:function(response){
                        if (parseInt(response)==1){
                            swal({
                                title: "Guardado",
                                text: "Configuración Guardada Exitósamente!",
                                timer: 2000,
                                type:   "success",
                                showConfirmButton: false
                            });
                        }else{
                            swal({
                                title: "Error",
                                text: "Ocurrió un error, intente nuevamente!",
                                timer: 2000,
                                type:   "error",
                                showConfirmButton: false
                            });
                        }
                    }
                });
            } else {
                swal("Cancelado", "Registro de Configuración Cancelado", "error");
            }
        });
    });
});