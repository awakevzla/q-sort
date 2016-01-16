var _colas={};
var _estaciones={};
function cargarColas(){
    $.ajax({
        url     :"../controladores/controladores_estadisticas.php",
        data    : {band:"verColas"},
        dataType:"json",
        type    :"post",
        error   : function(resp){
            alert("!Ha ocurrido un error!");
            console.log(resp);
        },
        success:function(response){
            estaciones=response["estaciones"];
            _estaciones=estaciones;
            colas=response["porEstacion"];
            _colas=colas;
            strHTML="";
            bandAtend=0;
            bandCola=0;
            $.each(estaciones, function (k, v) {
                strHTML+="<tr>";
                strHTML+="<td>"+v["nombre"]+"</td>";
                if (colas[v["id"]]!=undefined){
                    if (colas[v["id"]][2]!=undefined) {
                        $.each(colas[v["id"]][2], function (l, m) {
                            /*if (bandAtend==0){*/
                            strHTML += "<td>" + m["ticket"] + "</td>";
                            /*}
                             bandAtend=1;*/
                        });
                    }else{
                        strHTML+="<td>--/---</td>";
                    }
                    if (colas[v["id"]][1]!=undefined){
                        $.each(colas[v["id"]][1], function (l, m) {
                            if (bandCola<4){
                                strHTML+="<td>"+m["ticket"]+"</td>";
                            }
                            bandCola++;
                        });
                    }else{
                    }
                    if (bandCola<4){
                        for(i=0;i<4-bandCola;i++){
                            strHTML+="<td>--/---</td>";
                        }
                    }
                }else{
                    strHTML+="<td>--/---</td>";
                    strHTML+="<td>--/---</td>";
                    strHTML+="<td>--/---</td>";
                    strHTML+="<td>--/---</td>";
                    strHTML+="<td>--/---</td>";
                }
                strHTML+="<td><a class='btn btn-info ver_mas' data-estacion='"+v["id"]+"'>Ver Mas</a></td>";
                strHTML+="</tr>";
                bandCola=0;
                bandAtend=0;
            });
            $("#tabColas tbody").html(strHTML);
        }
    });
}

function ver_cola(estacion_id){
    strHTML="";
    band=0;
    $.each(_colas[estacion_id][1], function (k, v) {
        (band==0)?$("#nombre_estacion").html(v["estacion"]):band=1;
        band=1;
        strHTML+='<li class="list-group-item">'+v["ticket"]+'</li>';
    });
    $("#lista").html(strHTML);
    $("#colas").modal();
}

$(document).ready(function () {
    cargarColas();
    $(document).on("click", ".ver_mas", function () {
        estacion=$(this).data("estacion");
        ver_cola(estacion);
    });
});