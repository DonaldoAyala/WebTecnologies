<?php
    $host = "localhost";
	$dbUser = "root";
	$dbName = "registro_alumnos_2020_2";
	$dbPassword = "";
	
	//Crear Conexion
	$connection = new mysqli($host, $dbUser,$dbPassword,$dbName);

    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario']:'';
    $contrasena = (isset($_POST['contrasena'])) ? $_POST['contrasena']:'';

    $select = "select * from admin where usuario = '$usuario' and contrasena = '$contrasena';";
    $stmnt = $connection->prepare($select);
    $stmnt->execute();
    $stmnt->store_result();
    $rnum = $stmnt-> num_rows;
    if($rnum == 0){
        echo "incorrecto";
    } else {
        echo "correcto";
    }
?>