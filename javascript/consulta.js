$(window).keydown(function(event){
    if(event.keyCode == 13) {
    event.preventDefault();
    request();
    return false;
    }
});
$(document).on("click","#consultar",function(){
    request();
});

function request() {
    curp = $.trim($("#curp").val());
    $.post(
        '../php/consulta.php',
        {
            curp:curp,
        },
        function(data){
            if(data == "true"){
                $('#consulta').submit();
            } else if (data == "false") {
                alert("No se encontró registro del CURP");
            } else {
                alert("Error");
            }
        }
    );
}