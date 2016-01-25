$(document).ready(function () {
    $("[name='my-checkbox']").bootstrapSwitch();
    $("#contTicket").hide();
    $(".estaciones").click(function () {
        pref=$(this).data("pref");
        estid=$(this).data("estid");
        nombre=$(this).data("nombre");
        vip=$("#vip").is(":checked");
        vip=(vip)?1:0;
        if (!confirm("¿Generar Ticket para "+nombre+"?")){
            return;
        }
        $.ajax({
            url     :"../controladores/controladores_generar_ticket.php",
            data    : {pref:pref,estid:estid,vip:vip,band:"generar"},
            dataType:"json",
            type    :"post",
            error   : function(resp){
                alert("!Ha ocurrido un error!");
                console.log(resp);
            },
            success:function(response){
                console.log(response);
                $("#ticket").html(response["respuesta"]["ticket"]);
                $("#contTicket").slideDown();
                $("#vip").bootstrapSwitch('state', false);
                setTimeout(function(){
                    $("#contTicket").slideUp();
                },5000);
            }
        });
    });
});