//Se añaden las columnas de los botones a la tabla
$(document).ready(function(){
    TableNotes=$("#tableNotes").DataTable({
        responsive: true,
        "columnDefs":[{
            "targets":0,
            "data":null,
            "defaultContent":"<button type='button' class='btnEdit btn btn-success' data-toggle='modal' data-target='#exampleModal'id='btnEdit' >  <i class='fa fa-edit'></i></button><button type='submit' class='btnDelete btn btn-danger'  id='btnDelete' ><i class='fas fa-trash-alt'></i></button>"
        }]
    });
var rowtable;
//Se reinicia el formulario al dar click en nuevo registro
$(document).on("click","#new",function(){
    reset();
    option=1;
});
//Función que toma la información de la tabla, y la pone en el 
//formulario para que pueda ser editada, al presionar el botón editar
//También se hace la petición al servidor para modificar la información
$(document).on("click","#btnEdit",function(){
    reset();
    rowtable=$(this).closest("tr");
    curp=rowtable.find('td:eq(1)').text();
    boleta=rowtable.find('td:eq(2)').text();
    nombre=rowtable.find('td:eq(3)').text();
    apellido_paterno=rowtable.find('td:eq(4)').text();
    apellido_materno=rowtable.find('td:eq(5)').text();
    fecha_nacimiento=rowtable.find('td:eq(6)').text();
    sexo=rowtable.find('td:eq(7)').text();
    correo=rowtable.find('td:eq(8)').text();
    colonia=rowtable.find('td:eq(9)').text();
    calle=rowtable.find('td:eq(10)').text();
    numero=rowtable.find('td:eq(11)').text();
    codigo_postal=rowtable.find('td:eq(12)').text();
    telefono=rowtable.find('td:eq(13)').text();
    escuela=rowtable.find('td:eq(14)').text();
    entidad_federativa=rowtable.find('td:eq(15)').text();
    promedio=rowtable.find('td:eq(16)').text();
    opcion=rowtable.find('td:eq(17)').text();

    var elemento = document.getElementById('otra_escuela_div');
    var res = escuela.slice(0,9);
    if (res != "CEC y T #") {
        elemento.style.display='inline-block';
        $("#select_escuela option[value='otro']").prop('selected','selected');
        $("#otra_escuela").val(escuela);
    } else {
        elemento.style.display='none';
        $("#select_escuela option[value='"+escuela+"']").prop('selected','selected');
    }
    $("#curp").val(curp);
    $("#boleta").val(boleta);
    $("#nombre").val(nombre);
    $("#apellido_paterno").val(apellido_paterno);
    $("#apellido_materno").val(apellido_materno);
    $("#fecha_nacimiento").val(fecha_nacimiento);
    $("input[name=sexo][value=" + sexo + "]"). prop('checked', true);
    $("#correo").val(correo);
    $("#colonia").val(colonia);
    $("#calle").val(calle);
    $("#numero").val(numero);
    $("#codigo_postal").val(codigo_postal);
    $("#telefono").val(telefono);
    $("#select_entidad option[value='"+entidad_federativa+"']").prop('selected','selected');
    $("#promedio").val(promedio);
    $("input[name=opcion][value=" + opcion + "]"). prop('checked', true);
    document.getElementById("curp").readOnly = true;
    option=2;
});
//Función que lleva a cabo la eliminación de registros
$(document).on("click","#btnDelete",function(){
    rowtable=$(this);
    curp=$(this).closest('tr').find('td:eq(1)').text();
    option=3;
    if(confirm('¿Estas seguro que quieres eliminar el registro?')){
    TableNotes.row(rowtable.parents('tr')).remove().draw();
        $.post(
            'crud.php',
            {curp:curp,option:option},
            function(data){
                console.log("Eliminación Correcta");
            }
        );
    }     
});
//Oculta el formulario modal
$(document).on("click","#cancelar",function(){
    $('#exampleModal').modal('hide');
});
$(document).on("click","#limpiar",function(){
    $('#exampleModal').modal('hide');
});
/*
  Función que verifica que tipo de accion se debe hacer,
  (1) Si se quiere guardar un nuevo registro, se llama la función 
  que verifica que el curp no este en la base de datos.
  (2) Si se actualiza, simplemente se llama a la función de submit
  con la respectiva opcion 2 para que se actualicen los datos
*/
$("#datos").submit(function(e){
    e.preventDefault();
    if(option == 1){
        validate_and_submit();
    } else if(option == 2) {
        submit();
    }
        
});
//Función que lleva a cabo el proceso de registro, valida campos, 
//y hace la solicitud al servidor
function submit(){
    if(validarCampos()){
        var esc= document.getElementById("escuela").value;
        if(esc == "otro"){
            esc = document.getElementById("otra_escuela").value;
        }
        curp=$.trim($("#curp").val());
        boleta=$.trim($("#boleta").val());
        nombre=$.trim($("#nombre").val());
        apellido_paterno=$.trim($("#apellido_paterno").val());
        apellido_materno=$.trim($("#apellido_materno").val());
        fecha_nacimiento=$.trim($("#fecha_nacimiento").val());
        sexo=$.trim($('input[name=sexo]:checked').val());
        correo=$.trim($("#correo").val());
        colonia=$.trim($("#colonia").val());
        calle=$.trim($("#calle").val());
        numero=$.trim($("#numero").val());
        codigo_postal=$.trim($("#codigo_postal").val());
        telefono=$.trim($("#telefono").val());
        entidad_federativa=$.trim($("#entidad_federativa").val());
        promedio=$.trim($("#promedio").val());
        opcion=$.trim($('input[name=opcion]:checked').val());
        $.post(
            'crud.php',
            {
                curp:curp,
                boleta:boleta,
                nombre:nombre,
                apellido_paterno:apellido_paterno,
                apellido_materno:apellido_materno,
                fecha_nacimiento:fecha_nacimiento,
                sexo:sexo,
                correo:correo,
                colonia:colonia,
                calle:calle,
                numero:numero,
                codigo_postal:codigo_postal,
                telefono:telefono,
                escuela:esc,
                entidad_federativa:entidad_federativa,
                promedio:promedio,
                opcion:opcion,
                option:option,
            },
            function(data){
                $('#exampleModal').modal('hide');
                if(option == 1){
                    rowtable = TableNotes.row.add([
                        "",
                        curp,
                        boleta,
                        nombre,
                        apellido_paterno,
                        apellido_materno,
                        fecha_nacimiento,
                        sexo,
                        correo,
                        colonia,
                        calle,
                        numero,
                        codigo_postal,
                        telefono,
                        esc,
                        entidad_federativa,
                        promedio,
                        opcion
                        ]).draw();
                    var i;
                    for (i = 2; i < 18; i++) {
                        TableNotes.column([i]).visible(false);
                    }
                } else {
                    TableNotes.row(rowtable).data([
                                                        "",
                                                        curp,
                                                        boleta,
                                                        nombre,
                                                        apellido_paterno,
                                                        apellido_materno,
                                                        fecha_nacimiento,
                                                        sexo,
                                                        correo,
                                                        colonia,
                                                        calle,
                                                        numero,
                                                        codigo_postal,
                                                        telefono,
                                                        esc,
                                                        entidad_federativa,
                                                        promedio,
                                                        opcion
                                                        ]).draw();
                }
            }
        );
    }
}
//Verifica que el curp no haya sido registrado en la base de datos
function validate_and_submit(){
    curp=$.trim($("#curp").val());
    opcion = 4;
    $.post('crud.php',{curp:curp,option:opcion},function(data){
            if(data == "true") {
                submit();
            } else if(data == "false") {
                alert("El curp ya ha sido registrado.");
            } else {
                console.log("error");
            }
        }
    );
    
}
});
//Revisa la opcion de la escuela elegida para mostrar 
//el input otra_escuela en caso de ser necesario
function revisarOpcion(opcion){
	var elemento = document.getElementById('otra_escuela_div');
	if(opcion == 'otro')
		elemento.style.display='inline-block';
	else
		elemento.style.display='none';
}
//Se validan todos los campos con expresiones regulares
function validarCampos(){
	var todoCorrecto = true;
	var buffer = "";
	var alreadyScrolled = false;
	//Patrones
	var patronBoleta = /^([0-9]{10,10}|(PE|PP)[0-9]{8,8})(?!([A-Z]|[0-9]))$/;
	var patronNombre = /[A-Z]{1}[a-z]( [A-Z]{1}[a-z])?/;
	var patronApellido = /[A-Z]{1}[a-z]/;
	var patronCurp = /^[A-Z]{4}[0-9]{6}[A-Z]{6}([A-Z]|[0-9]){2}$/;
	var patronCorreo = /@[a-z]./;
	var patronCalle = /([A-Z]|[a-z]| )+/;
	var patronNumero = /^[0-9]{1,4}$/;
	var patronColonia = /([A-Z]|[a-z]|[0-9])+/;
	var patronCodigoPostal = /^[0-9]{5,5}$/;
	var patronTel = /^[0-9]{10,10}$/;
	var patronPromedio = /^[0-9]{1,2}(.[0-9]{1,2})?$/;
	//Comprobación de campos
	
	buffer = document.getElementById("curp").value;
	if(!patronCurp.test(buffer)){
		todoCorrecto = false;
		document.getElementById("curp").style.borderColor = "red";
		document.getElementById("aviso_curp").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("curp").scrollIntoView();
			window.scrollBy(0,-120);
		}
	}  else {
		document.getElementById("curp").style.borderColor = "lightgray";
		document.getElementById("aviso_curp").style.display = "none";
	}
	buffer = document.getElementById("boleta").value;
	if(!patronBoleta.test(buffer)) {
		todoCorrecto = false;
		document.getElementById("boleta").style.borderColor = "red";
		document.getElementById("aviso_boleta").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("boleta").scrollIntoView();
			window.scrollBy(0,-120);
		}
	} else {
		document.getElementById("boleta").style.borderColor = "lightgray";
		document.getElementById("aviso_boleta").style.display = "none";
	}
	buffer = document.getElementById("nombre").value;
	if(!patronNombre.test(buffer)){
		document.getElementById("nombre").style.borderColor = "red";
		document.getElementById("aviso_nombre").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("nombre").scrollIntoView();
			window.scrollBy(0,-120);
		}
	}  else {
		document.getElementById("nombre").style.borderColor = "lightgray";
		document.getElementById("aviso_nombre").style.display = "none";
	}
	buffer = document.getElementById("apellido_paterno").value;
	if(!patronApellido.test(buffer)){
		todoCorrecto = false;
		document.getElementById("apellido_paterno").style.borderColor = "red";
		document.getElementById("aviso_apellido_paterno").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("apellido_paterno").scrollIntoView();
			window.scrollBy(0,-120);
		}
	}  else {
		document.getElementById("apellido_paterno").style.borderColor = "lightgray";
		document.getElementById("aviso_apellido_paterno").style.display = "none";
	}
	buffer = document.getElementById("apellido_materno").value;
	if(!patronApellido.test(buffer)){
		todoCorrecto = false;
		document.getElementById("apellido_materno").style.borderColor = "red";
		document.getElementById("aviso_apellido_materno").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("apellido_materno").scrollIntoView();
			window.scrollBy(0,-120);
		}
	}  else {
		document.getElementById("apellido_materno").style.borderColor = "lightgray";
		document.getElementById("aviso_apellido_materno").style.display = "none";
	}
	//Comprobación de fecha
	var fecha = document.getElementById("fecha_nacimiento").value;
	if(fecha.length <= 0) {
		todoCorrecto = false;
		document.getElementById("fecha_nacimiento").style.borderColor = "red";
		document.getElementById("aviso_fecha_nacimiento").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("fecha_nacimiento").scrollIntoView();
			window.scrollBy(0,-120);
		}
	} else {
		document.getElementById("fecha_nacimiento").style.borderColor = "lightgray";
		document.getElementById("aviso_fecha_nacimiento").style.display = "none";
	}
	//Comprobación de radio Button 'sexo'
	if ($('input[name=sexo]:checked').length <= 0) {
		todoCorrecto = false;
		document.getElementById("aviso_sexo").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("aviso_sexo").scrollIntoView();
			window.scrollBy(0,-120);
		}
	} else {
		document.getElementById("aviso_sexo").style.display = "none";
	}
	buffer = document.getElementById("correo").value;
	if(!patronCorreo.test(buffer)){
		todoCorrecto = false;
		document.getElementById("correo").style.borderColor = "red";
		document.getElementById("aviso_correo").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("correo").scrollIntoView();
			window.scrollBy(0,-120);
		}
	}  else {
		document.getElementById("correo").style.borderColor = "lightgray";
		document.getElementById("aviso_correo").style.display = "none";
	}
	buffer = document.getElementById("colonia").value;
	if(!patronColonia.test(buffer)){
		todoCorrecto = false;
		document.getElementById("colonia").style.borderColor = "red";
		document.getElementById("aviso_colonia").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("colonia").scrollIntoView();
			window.scrollBy(0,-120);
		}
	}  else {
		document.getElementById("colonia").style.borderColor = "lightgray";
		document.getElementById("aviso_colonia").style.display = "none";
	}
	buffer = document.getElementById("calle").value;
	if(!patronCalle.test(buffer)){
		todoCorrecto = false;
		document.getElementById("calle").style.borderColor = "red";
		document.getElementById("aviso_calle").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("calle").scrollIntoView();
			window.scrollBy(0,-120);
		}
	}  else {
		document.getElementById("calle").style.borderColor = "lightgray";
		document.getElementById("aviso_calle").style.display = "none";
	}
	buffer = document.getElementById("numero").value;
	if(!patronNumero.test(buffer)){
		todoCorrecto = false;
		document.getElementById("numero").style.borderColor = "red";
		document.getElementById("aviso_numero").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("numero").scrollIntoView();
			window.scrollBy(0,-120);
		}
	}  else {
		document.getElementById("numero").style.borderColor = "lightgray";
		document.getElementById("aviso_numero").style.display = "none";
	}
	buffer = document.getElementById("codigo_postal").value;
	if(!patronCodigoPostal.test(buffer)){
		todoCorrecto = false;
		document.getElementById("codigo_postal").style.borderColor = "red";
		document.getElementById("aviso_codigo_postal").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("codigo_postal").scrollIntoView();
			window.scrollBy(0,-120);
		}
	}  else {
		document.getElementById("codigo_postal").style.borderColor = "lightgray";
		document.getElementById("aviso_codigo_postal").style.display = "none";
	}
	buffer = document.getElementById("telefono").value;
	if(!patronTel.test(buffer)){
		todoCorrecto = false;
		document.getElementById("telefono").style.borderColor = "red";
		document.getElementById("aviso_telefono").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("telefono").scrollIntoView();
			window.scrollBy(0,-120);
		}
	}  else {
		document.getElementById("telefono").style.borderColor = "lightgray";
		document.getElementById("aviso_telefono").style.display = "none";
	}
	//Comprobación de select box 'escuela'
	var opcion = document.getElementById('escuela').value;
	if(opcion == "default"){
		todoCorrecto = false;
		document.getElementById("escuela").style.borderColor = "red";
		document.getElementById("aviso_escuela").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("escuela").scrollIntoView();
			window.scrollBy(0,-120);
		}
	} else if (opcion == "otro") {
		var nombre = document.getElementById('otra_escuela').value;
		document.getElementById('escuela').style.borderColor = "lightgray";
		document.getElementById("aviso_escuela").style.display = "none";
		if(nombre.length <= 0){
			todoCorrecto = false;
			document.getElementById('otra_escuela').style.borderColor = "red";
			document.getElementById("aviso_otra_escuela").style.display = "inline";
			if(!alreadyScrolled) {
				alreadyScrolled = true;
				document.getElementById("otra_escuela").scrollIntoView();
				window.scrollBy(0,-120);
			}
		} else {
			document.getElementById('otra_escuela').style.borderColor = "lightgray";
			document.getElementById("aviso_otra_escuela").style.display = "none";
		}
	} else {
		document.getElementById('escuela').style.borderColor = "lightgray";
		document.getElementById('otra_escuela').style.borderColor = "lightgray";
		document.getElementById("aviso_escuela").style.display = "none";
		document.getElementById("aviso_otra_escuela").style.display = "none";
	}
	//Comprobación de select box 'entidad_federativa'
	opcion = document.getElementById("entidad_federativa").value;
	if(opcion == "default"){
		todoCorrecto = false;
		document.getElementById("entidad_federativa").style.borderColor = "red";
		document.getElementById("aviso_entidad_federativa").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("entidad_federativa").scrollIntoView();
			window.scrollBy(0,-120);
		}
	} else {
		document.getElementById("entidad_federativa").style.borderColor = "lightgray";
		document.getElementById("aviso_entidad_federativa").style.display = "none";
	}
	buffer = document.getElementById("promedio").value;
	if(!patronPromedio.test(buffer)){
		todoCorrecto = false;
		document.getElementById("promedio").style.borderColor = "red";
		document.getElementById("aviso_promedio").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("promedio").scrollIntoView();
			window.scrollBy(0,-120);
		}
	}  else {
		document.getElementById("promedio").style.borderColor = "lightgray";
		document.getElementById("aviso_promedio").style.display = "none";
	}
	//Comprobación de radio Button 'opcion'
	if ($('input[name=opcion]:checked').length <= 0) {
		todoCorrecto = false;
		document.getElementById("aviso_opcion").style.display = "inline";
		if(!alreadyScrolled) {
			alreadyScrolled = true;
			document.getElementById("aviso_opcion").scrollIntoView();
			window.scrollBy(0,-120);
		}
	} else {
		document.getElementById("aviso_opcion").style.display = "none";
	}
	return todoCorrecto;
}
function reset(){
    curp="";
    boleta="";
    nombre="";
    apellido_paterno="";
    apellido_materno="";
    fecha_nacimiento="";
    sexo="";
    correo="";
    colonia="";
    calle="";
    numero="";
    codigo_postal="";
    telefono="";
    escuela="";
    entidad_federativa="";
    promedio="";
    opcion="";
    $("#curp").val(curp);
    $("#boleta").val(boleta);
    $("#nombre").val(nombre);
    $("#apellido_paterno").val(apellido_paterno);
    $("#apellido_materno").val(apellido_materno);
    $("#fecha_nacimiento").val(fecha_nacimiento);
    $('input[name=sexo]').prop('checked',false);
    $("#correo").val(correo);
    $("#colonia").val(colonia);
    $("#calle").val(calle);
    $("#numero").val(numero);
    $("#codigo_postal").val(codigo_postal);
    $("#telefono").val(telefono);
    $("#escuela").prop('selectedIndex',0);
    $("#entidad_federativa").prop('selectedIndex',0);
    $("#promedio").val(promedio);
    $("#otra_escuela").val("");
    $('input[name=opcion]').prop('checked',false);
    document.getElementById("curp").readOnly = false;
    document.getElementById("boleta").style.borderColor = "lightgray";
    document.getElementById("aviso_boleta").style.display = "none";
    document.getElementById("nombre").style.borderColor = "lightgray";
    document.getElementById("aviso_nombre").style.display = "none";
    document.getElementById("apellido_paterno").style.borderColor = "lightgray";
    document.getElementById("aviso_apellido_paterno").style.display = "none";
    document.getElementById("apellido_materno").style.borderColor = "lightgray";
    document.getElementById("aviso_apellido_materno").style.display = "none";
    document.getElementById("curp").style.borderColor = "lightgray";
    document.getElementById("aviso_curp").style.display = "none";
    document.getElementById("correo").style.borderColor = "lightgray";
    document.getElementById("aviso_correo").style.display = "none";
    document.getElementById("calle").style.borderColor = "lightgray";
    document.getElementById("aviso_calle").style.display = "none";
    document.getElementById("numero").style.borderColor = "lightgray";
    document.getElementById("aviso_numero").style.display = "none";
    document.getElementById("colonia").style.borderColor = "lightgray";
    document.getElementById("aviso_colonia").style.display = "none";
    document.getElementById("codigo_postal").style.borderColor = "lightgray";
    document.getElementById("aviso_codigo_postal").style.display = "none";
    document.getElementById("telefono").style.borderColor = "lightgray";
    document.getElementById("aviso_telefono").style.display = "none";
    document.getElementById("promedio").style.borderColor = "lightgray";
    document.getElementById("aviso_promedio").style.display = "none";
    document.getElementById('escuela').style.borderColor = "lightgray";
    document.getElementById('otra_escuela').style.borderColor = "lightgray";
    document.getElementById("aviso_escuela").style.display = "none";
    document.getElementById("aviso_otra_escuela").style.display = "none";
    document.getElementById("entidad_federativa").style.borderColor = "lightgray";
    document.getElementById("aviso_entidad_federativa").style.display = "none";
    document.getElementById("fecha_nacimiento").style.borderColor = "lightgray";
    document.getElementById("aviso_fecha_nacimiento").style.display = "none";
    document.getElementById("aviso_sexo").style.display = "none";
    document.getElementById("aviso_opcion").style.display = "none";
    revisarOpcion();
}