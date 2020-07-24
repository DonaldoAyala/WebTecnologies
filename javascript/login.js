$(document).on("click","#enviar",function(e){
    usuario=$.trim($("#usuario").val());
    contrasena=$.trim($("#contrasena").val());
    verificacion=$.trim($('#verificacion').val());
    verificacion = atLeastOneIsChecked = $('input[name="verificacion"]:checked').length > 0;
    if(verificacion){
        $.post(
            '../php/login.php',
            {
                usuario:usuario,
                contrasena:contrasena,
            },
            function(data){
                if(data == "correcto"){
                    $(location).attr('href','../php/index.php');
                } else {
                    alert("Contraseña o Usuario Incorrectos");
                }
            }
        );
    } else {
        alert('Eres un robot?');
    }
    
});

