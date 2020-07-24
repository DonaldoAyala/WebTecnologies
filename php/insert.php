<?php 
	$boleta = isset($_POST['boleta'])?$_POST['boleta']:'';
	$nombre = isset($_POST['nombre'])?$_POST['nombre']:'';
	$apellido_paterno = isset($_POST['apellido_paterno'])?$_POST['apellido_paterno']:'';
	$apellido_materno = isset($_POST['apellido_materno'])?$_POST['apellido_materno']:'';
	$curp = isset($_POST['curp'])?$_POST['curp']:'';
	$date = isset($_POST['fecha_nacimiento'])?$_POST['fecha_nacimiento']:'';
	$sexo = isset($_POST['sexo'])?$_POST['sexo']:'';
	$correo = isset($_POST['correo'])?$_POST['correo']:'';
	$calle = isset($_POST['calle'])?$_POST['calle']:'';
	$numero = isset($_POST['numero'])?$_POST['numero']:'';
	$colonia = isset($_POST['colonia'])?$_POST['colonia']:'';
	$cp = isset($_POST['codigo_postal'])?$_POST['codigo_postal']:'';
	$telefono = isset($_POST['telefono'])?$_POST['telefono']:'';
	$escuela = isset($_POST['escuela'])?$_POST['escuela']:'';
	$entidad = isset($_POST['entidad'])?$_POST['entidad']:'';
	$promedio = isset($_POST['promedio'])?$_POST['promedio']:'';
	$opcion = isset($_POST['opcion'])?$_POST['opcion']:'';

	//Formateo para el registro de la fecha
	$ndate = date("Y-m-d",strtotime($date));
	
	//Datos de conexión
	$host = "localhost";
	$dbUser = "root";
	$dbName = "registro_alumnos_2020_2";
	$dbPassword = "";
	
	//Crear Conexion
	$db = new mysqli($host, $dbUser,$dbPassword,$dbName);
	if($db -> connect_errno){
		echo "error de conexion";
		die('Conection error');
	} else {
		$select = "select * from datos where curp = '$curp' limit 1;";
		$insert = "insert into datos(curp,boleta,nombre,apellido_paterno,apellido_materno,fecha_nacimiento,sexo,correo,calle,numero,colonia,codigo_postal,telefono,escuela,entidad_federativa,promedio,opcion) values('$curp','$boleta','$nombre','$apellido_paterno','$apellido_materno','$ndate','$sexo','$correo','$calle',$numero,'$colonia',$cp,'$telefono','$escuela','$entidad',$promedio,'$opcion');";
		$stmnt = $db->prepare($select);
		$stmnt->execute();
		$stmnt->store_result();
		$rnum = $stmnt->num_rows;
		if($rnum == 0){
			$stmnt->close();
			$stmnt = $db->prepare($insert);
			$stmnt->execute();
			echo "success";
		} else {
			echo "unsuccess";
		}
		$stmnt->close();
		$db->close();
	}
 ?>
