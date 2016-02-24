$(document).ready(function () {
    $("#contEstaciones").hide();
    $('#boton').attr("disabled", true);
    atendiendo(est, padre);
    $("#llamar").click(function () {
        //llamarPaciente($(".selEstacion").val());
        trans=transferir;
        atiende=$("#ticket").text();
        $('#llamar').attr("disabled", true);
        $('#rellamar').attr("disabled", true);
        $('#cerrar').attr("disabled", true);
        cantidad_registros=0;
        if (atiende!="---/---"){
            if (!confirm("¿Desea transferir el paciente a "+transferir_est+"?")){
                trans=0;
                llamarPaciente(est, trans, padre, prioridad);
            }else{
                $.ajax({
                    url     :"../controladores/controladores_generar_ticket.php",
                    data    : {est:est,band:"getCantidadRegistro"},
                    dataType:"text",
                    type    :"post",
                    async   :false,
                    error   : function(resp){
                        alert("!Ha ocurrido un error!");
                        console.log(resp);
                    },
                    success: function(resp){
                        cantidad_registros=parseInt(resp);
                    }
                });
                console.log(cantidad_registros);
                if (cantidad_registros>maximo_transferencia){
                    swal({
                        title: "Demasiadas Transferencias",
                        text: "¡Éste ticket posee "+maximo_transferencia+" transferencias!, ¿Desea transferir de todas formas?",
                        type: "input",
                        inputType: "password",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        closeOnCancel:false,
                        animation: "slide-from-top",
                        inputPlaceholder: "Ingrese contraseña"
                    }, function(inputValue){
                        if (inputValue === false){
                            trans=0;
                            llamarPaciente(est, trans, padre, prioridad);
                            swal("Ticket Cerrado", "El Ticket en atención fue cerrado con éxito!", "success");
                            return false;
                        }
                        if (inputValue === "") {
                            swal.showInputError("Debe escribir la contraseña");
                            return false
                        }
                        console.log(inputValue);
                        $.ajax({
                            url     :"../controladores/controladores_usuarios.php",
                            data    : {clave:inputValue,band:"validarClave"},
                            dataType:"text",
                            type    :"post",
                            async   :false,
                            error   : function(resp){
                                alert("!Ha ocurrido un error!");
                                console.log(resp);
                            },
                            success: function(resp){
                                console.log(resp);
                                if (parseInt(resp)==1){
                                    llamarPaciente(est, trans, padre, prioridad);
                                    swal("Transferido", "El Ticket fue transferido!", "success");
                                }else if(parseInt(resp)>1){
                                    swal("Error", "Ocurrió un error, intente nuevamente", "error");
                                }else{
                                    swal("Error", "Contraseña Incorrecta, intente nuevamente", "error");
                                }
                            }
                        });
                    });
                }else{
                    llamarPaciente(est, trans, padre, prioridad);
                }
            }
        }else{
            $('#llamar').attr("disabled", true);
            $('#rellamar').attr("disabled", true);
            $('#cerrar').attr("disabled", true);
            llamarPaciente(est, trans, padre, prioridad);
        }

        setTimeout(function(){
            $("#llamar").attr("disabled", false);
            $('#rellamar').attr("disabled", false);
            $('#cerrar').attr("disabled", false);

        },5000);
    })

    //desde aqui comienzo la funcion re-llamar
    $("#rellamar").click(function () {
        id=$("#ticket").data("idatend");
        atiende=$("#ticket").text();
        if (atiende!="---/---"){
            REllamar(id);                     //(2) HAY QUE CAMBIARLO POR LA VARIABLE ESTACION ACTUAL
            //console.log(id);
            $('#rellamar').attr("disabled", true);
            $('#llamar').attr("disabled", true);
            $('#cerrar').attr("disabled", true);
            setTimeout(function(){
                $("#rellamar").attr("disabled", false);
                $("#llamar").attr("disabled", false);
                $('#cerrar').attr("disabled", false);
            },5000);
        }else{
            //$("#llamar").click();           <---- DEBERIA LLAMAR A OTRO TIcKET PERO FALTA HACERLO
            alert("No está atendiendo a Ningún Paciente");
        }

    });
    //hasta aqui


    $("#trasladar").click(function () {
        $("#contOpcion").slideUp();
        $("#contEstaciones").slideDown();
    });
    $("#volver").click(function () {
        $("#contEstaciones").slideUp();
        $("#contOpcion").slideDown();
    });
    $("#cerrar").click(function () {
        if (!confirm("¿Está seguro de cerrar éste ticket?")){
            return;
        }
        cerrarTicket(est);
    });
    $(".trasladar").click(function () {
        id=$(this).data("id");
        trasladarPaciente(est, id, padre);
    });
});

function cerrarTicket(estacion_id){
    $.ajax({
        url     :"../controladores/controladores_generar_ticket.php",
        data    : {estacion_id:estacion_id,band:"cerrarTicket"},
        dataType:"text",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            console.log(response);
            if (response=="1"){
                alert("Cerrado Exitósamente!");
            }else{
                alert("Ocurrió un inconveniente al cerrar ticket, intente nuevamente o comuníquese con el administrador");
                location.reload();
            }
            atendiendo(est, padre);
        }
    });
}

function trasladarPaciente(est, id, padre){
    if (!confirm("¿Está seguro de trasladar a éste paciente?")){
        return;
    }
    $.ajax({
        url     :"../controladores/controladores_generar_ticket.php",
        data    : {estacion_destino:id,estacion_origen:est,band:"trasladarPaciente"},
        dataType:"json",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            console.log(response);
            if (response=="1"){
                alert("Fue trasladado el paciente exitósamente!");
            }else{
                alert("Ocurrió un inconveniente al trasladar al paciente, intente nuevamente o comuníquese con el administrador");
                location.reload();
            }
            console.log("va a llamar atendiendo");
            atendiendo(est, padre);
        }
    });
}

function atendiendo(est, padre){
    $.ajax({
        url     :"../controladores/controladores_generar_ticket.php",
        data    : {est:est,padre:padre,band:"atendiendo"},
        dataType:"json",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            console.log(response);
            response=response.respuesta;
            if (response["correlativo"]==undefined){   // SI NO ESTA ATENDIENDO A NADIE
                $("#ticket").html("---/---");
                $("#ticket").attr("data-id_atend",0);
            }
            $("#ticket").html(response["correlativo"]);
            $("#clEspera").html(response["clEspera"]);
            $("#ticket").attr("data-idatend", parseInt(response["id"]));
        }
    });
}

function llamarPaciente(est, transferir, padre, prioridad){
    $.ajax({
        url     :"../controladores/controladores_generar_ticket.php",
        data    : {est:est, transferir:transferir, padre:padre,prioridad:prioridad,band:"llamarPaciente"},
        dataType:"JSON",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            console.log(response);
            if (response=="0"){
                swal({
                    title: "Atención",
                    text: "No hay pacientes en espera!",
                    timer: 2000,
                    showConfirmButton: false
                });
            }else if(response=='error_duplicado'){
                alert("Ocurrió un inconveniente al llamar paciente, intente nuevamente");
                location.reload();
            }
            atendiendo(est, padre);
        }
    });
}
///************FUNCION RE-LLAMAR PACIENTE****************************/
function REllamar(id){
    $.ajax({
        url     :"../controladores/controladores_generar_ticket.php",
        data    : {id:id,band:"rellamar"},
        dataType:"text",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
        },
        success:function(response){
            console.log(response);
            if (response=="1"){

            }else{
                alert("Ocurrió un inconveniente al cerrar ticket, intente nuevamente o comuníquese con el administrador");
                location.reload();
            }
            //atendiendo(est, padre);
        }
    });
}