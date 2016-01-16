$(document).ready(function () {
    $("#contEstaciones").hide();
    $('#boton').attr("disabled", true);
    atendiendo(est);

    $("#llamar").click(function () {
        //llamarPaciente($(".selEstacion").val());
        llamarPaciente(est);                     //(2) HAY QUE CAMBIARLO POR LA VARIABLE ESTACION ACTUAL
        $('#llamar').attr("disabled", true);

        setTimeout(function(){
          $("#llamar").attr("disabled", false);
        },5000);
    });
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
        trasladarPaciente(est, id);
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
            atendiendo(est);
        }
    });
}

function trasladarPaciente(est, id){
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
            atendiendo(est);
        }
    });
}

function atendiendo(est){
    $.ajax({
        url     :"../controladores/controladores_generar_ticket.php",
        data    : {est:est,band:"atendiendo"},
        dataType:"json",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            console.log(response);
            response=response.respuesta;
            console.log(response.correlativo);
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

function llamarPaciente(est){
    $.ajax({
        url     :"../controladores/controladores_generar_ticket.php",
        data    : {est:est,band:"llamarPaciente"},
        dataType:"JSON",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            console.log(response);
            if (response=="0"){
                alert("No hay pacientes en espera!");
            }
            atendiendo(est);
        }
    });
}