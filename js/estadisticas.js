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
            colas=response["porEstacion"];
            strHTML="";
            bandAtend=0;
            bandCola=0;
            console.log(estaciones);
            $.each(estaciones, function (k, v) {
                console.log(v);
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
                        console.log(bandCola);
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
                strHTML+="<td><a class='btn btn-info' data-estacion='"+v["id"]+"'>Ver Mas</a></td>";
                strHTML+="</tr>";
                bandCola=0;
                bandAtend=0;
            });
            $("#tabColas tbody").html(strHTML);
        }
    });
}
$(document).ready(function () {
    cargarColas();
});