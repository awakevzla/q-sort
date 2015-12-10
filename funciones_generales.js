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

    });
    $(".trasladar").click(function () {
        id=$(this).data("id");
        trasladarPaciente(est, id);
    });
});

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
            if (response["respuesta"]==null || response["correlativo"]==undefined){   // SI NO ESTA ATENDIENDO A NADIE
                $("#ticket").html("---/---");
                $("#ticket").attr("data-id_atend",0);
                return;
            }
            console.log(response);
            $("#ticket").html(response["respuesta"]["ticket"]);
            $("#clEspera").html(response["respuesta"]["clEspera"]);
            $("#ticket").attr("data-idatend", parseInt(response["respuesta"]["id"]));
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