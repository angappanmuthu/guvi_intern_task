$(document).ready(function() {
    $("div").click(function () {
       var content = $(this).html();
       $("#result").text( content );
    });
 });