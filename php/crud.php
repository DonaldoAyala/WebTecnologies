<?php
  include_once 'connection.php';
  //Datos de conexión
	$host = "localhost";
	$dbUser = "root";
	$dbName = "registro_alumnos_2020_2";
	$dbPassword = "";
	
	//Crear Conexion
	$connection = new mysqli($host, $dbUser,$dbPassword,$dbName);

  $curp = (isset($_POST['curp'])) ? $_POST['curp']:'';
  $boleta = (isset($_POST['boleta'])) ? $_POST['boleta']:'';
  $nombre = (isset($_POST['nombre'])) ? $_POST['nombre']:'';
  $apellido_paterno = (isset($_POST['apellido_paterno'])) ? $_POST['apellido_paterno']:'';
  $apellido_materno = (isset($_POST['apellido_materno'])) ? $_POST['apellido_materno']:'';
  $fecha_nacimiento = (isset($_POST['fecha_nacimiento'])) ? $_POST['fecha_nacimiento']:'';
  $sexo = (isset($_POST['sexo'])) ? $_POST['sexo']:'';
  $correo = (isset($_POST['correo'])) ? $_POST['correo']:'';
  $colonia = (isset($_POST['colonia'])) ? $_POST['colonia']:'';
  $calle = (isset($_POST['calle'])) ? $_POST['calle']:'';
  $numero = (isset($_POST['numero'])) ? $_POST['numero']:'';
  $cp = (isset($_POST['codigo_postal'])) ? $_POST['codigo_postal']:'';
  $telefono = (isset($_POST['telefono'])) ? $_POST['telefono']:'';
  $escuela = (isset($_POST['escuela'])) ? $_POST['escuela']:'';
  $entidad = (isset($_POST['entidad_federativa'])) ? $_POST['entidad_federativa']:'';
  $promedio = (isset($_POST['promedio'])) ? $_POST['promedio']:'';
  $opcion = (isset($_POST['opcion'])) ? $_POST['opcion']:'';
  $option = (isset($_POST['option'])) ? $_POST['option']:'';

  switch($option) { 
    case "1":
      $query =
      "insert into datos values(
        '$curp',
        '$boleta',
        '$nombre',
        '$apellido_paterno',
        '$apellido_materno',
        '$fecha_nacimiento',
        '$sexo',
        '$correo',
        '$colonia',
        '$calle',
        '$numero',
        '$cp',
        '$telefono',
        '$escuela',
        '$entidad',
        '$promedio',
        '$opcion'
      );";
      $res = $connection->prepare($query);
      $res->execute();

      $query = "SELECT curp,boleta FROM datos ORDER BY curp DESC LIMIT 1";
      $res = $connection->prepare($query);
      $res->execute();
      $data = $res->fetchALL(PDO::FETCH_ASSOC);
    break;
    case "2":
      $query = "UPDATE datos SET  boleta='$boleta',
                                  nombre='$nombre',
                                  apellido_paterno='$apellido_paterno',
                                  apellido_materno='$apellido_materno',
                                  fecha_nacimiento='$fecha_nacimiento',
                                  sexo='$sexo',
                                  correo='$correo',
                                  colonia='$colonia',
                                  calle='$calle',
                                  numero=$numero,
                                  codigo_postal=$cp,
                                  telefono='$telefono',
                                  escuela='$escuela',
                                  entidad_federativa='$entidad',
                                  promedio=$promedio,
                                  opcion='$opcion'
                                   WHERE curp='$curp'";
      $res = $connection->prepare($query);
      $res->execute();

      $query = "SELECT curp,nombre,boleta FROM datos WHERE curp='$id'";
      $res = $connection->prepare($query);
      $res->execute();
      $data = $res->fetchALL(PDO::FETCH_ASSOC);
    break;
    case "3":
      $query = "DELETE FROM datos WHERE curp='$curp'";
      $res = $connection->prepare($query);
      $res->execute();
    break;
    //Verificar si el curp no ha sido registrado
    case "4":
      $select = "select * from datos where curp = '$curp' limit 1;";
      $stmnt = $connection->prepare($select);
      $stmnt->execute();
      $stmnt->store_result();
      $rnum = $stmnt->num_rows;
      if($rnum == 0){
        echo "true";
      } else {
        echo "false";
      }
      break;
    }
  $connection = null;
?>