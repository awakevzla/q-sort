function registrarUsuario(login, nombres, apellidos, tipo, clave_1, clave_2){
    if (clave_1==""){
        alert("Debe ingresar una clave!");
        $("#password").focus();
        return;
    }
    if (clave_1 != clave_2){
        alert("Las claves ingresadas no coinciden!");
        $("#password").focus();
        return;
    }
    if (login==""){
        alert("Ingrese un login!");
        $("#txtLogin").focus();
        return;
    }
    if (nombres==""){
        alert("Debe ingresar un nombre!");
        $("#txtNombres").focus();
        return;
    }
    if (apellidos==""){
        alert("Debe ingresar un apellido!");
        $("#txtApellidos").focus();
        return;
    }
    if (tipo=="0"){
        alert("Seleccione un tipo de usuario!");
        return;
    }
}
$(document).ready(function () {
    $("#tabUsuarios").dataTable({
        language: {
            url: '../js/media/js/Spanish.json'
        }
    });
    $(".btn").tooltip();
    $(document).on("click", ".modificar", function () {
        id=$(this).data('id');

    });
    $(document).on("click", "#btnRegistrar", function () {
        login=$("#txtLogin").val();
        nombres=$("#txtNombres").val();
        apellidos=$("#txtApellidos").val();
        tipo=$("#selTipo").val();
        password=$("#password").val();
        password_2=$("#password_2").val();
        registrarUsuario(login,nombres,apellidos,tipo,password, password_2)
    });
});