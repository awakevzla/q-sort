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
});