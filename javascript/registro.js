
$(document).on("click","#guardar",function(){
	option = 4;
	curp = $("#curp").val()
	$.post("../php/crud.php",{curp:curp,option:option},
		function(data){
			console.log(data);
			if(data == "true") {
				$("#datos").submit();
			} else {
				alert("El CURP ya ha sido registrado\nPuedes consultarlo en la sección consultar PDF");
			}
		}
	);
	validarCampos();
});
$(document).on('click','#confirmar',function(){
	//Seleccion de escuela
	$.post(
		'../php/insert.php',
		{
			nombre: $("#nombre").val(),
			apellido_paterno: $("#apellido_paterno").val(),
			apellido_materno: $("#apellido_materno").val(),
			boleta: $("#boleta").val(),
			curp: $("#curp").val(),
			fecha_nacimiento: $("#fecha_nacimiento").val(),
			sexo: $("#sexo").val(),
			correo: $("#correo").val(),
			calle: $("#calle").val(),
			numero: $("#numero").val(),
			colonia: $("#colonia").val(),
			codigo_postal: $("#codigo_postal").val(),
			telefono: $("#telefono").val(),
			escuela: $("#escuela").val(),
			entidad: $("#entidad").val(),
			promedio: $("#promedio").val(),
			opcion: $("#opcion").val(),
		},
		function(result){
			console.log(result);
			if(result == "success"){
				  $('#confirmacion').submit();
			} else if(result == "error de conexion"){
				alert("Error en la conexión");
			} else if (result == "unsuccess") {
				alert("El CURP ya ha sido registrado\nPuede consultarlo en la sección consultar PDF");
			} else {
  				alert("Error en el servidor");
			}
		}
	);
});
$(document).on('click','#limpiar',function(){
	reset();
});
$(document).on('click','#generar-btn',function(){
	$("#generar").submit();
	$(location).attr('href', '../index.html');
});

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

//Revisa que opción de escuela se eligió y activa/desactiva la casilla para otra escuela
function revisarOpcion(opcion){
	var elemento = document.getElementById('otra_escuela_div');
	if(opcion == 'otro')
		elemento.style.display='inline-block';
	else
		elemento.style.display='none';
}
//Regresa a la página para modificar datos
function goback(){
	window.history.back();
}
//Al volver a la página se verifica si está activada la casilla para otra escuela
$(document).ready(function(){
	var url = window.location.pathname;
	var filename = url.substring(url.lastIndexOf('/')+1);
	console.log(filename);
	if(filename == 'registro.html')
		revisarOpcion($("#escuela").val());
});
//Regresa todos los campos a la normalidad
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
}
