$(document).ready(function () {
    $(".menu").click(function (e) {
        url=$(this).attr('href');
        $("#iFrame").attr('src', url);
        e.preventDefault();
    });
});