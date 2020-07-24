<?php
    $host = "localhost";
	$dbUser = "root";
	$dbName = "registro_alumnos_2020_2";
	$dbPassword = "";
	
	//Crear Conexion
	$connection = new mysqli($host, $dbUser,$dbPassword,$dbName);

    $curp = (isset($_POST['curp'])) ? $_POST['curp']:'';

    $query = "SELECT curp FROM datos where curp = '$curp';";
    $res = $connection->prepare($query);
    $res->execute();
    $res->store_result();
    $rnum = $res-> num_rows;
    if($rnum == 0){
        echo "false";
    } else {
        echo "true";
    }
    $connection->close();
?>