<?php
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
    $codigo_postal = (isset($_POST['codigo_postal'])) ? $_POST['codigo_postal']:'';
    $telefono = (isset($_POST['telefono'])) ? $_POST['telefono']:'';
    $escuela = (isset($_POST['escuela'])) ? $_POST['escuela']:'';
    $otra_escuela = (isset($_POST['otra_escuela'])) ? $_POST['otra_escuela']:'';
    if($escuela == 'otro'){
      $escuela = $otra_escuela;
    }
    $entidad = (isset($_POST['entidad'])) ? $_POST['entidad']:'';
    $promedio = (isset($_POST['promedio'])) ? $_POST['promedio']:'';
    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion']:'';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registro 2020-2</title>
    <link rel="icon" href="../imgs/escom.png">
    <script src="https://kit.fontawesome.com/1dac73aed0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="../javascript/registro.js"></script>
    <link rel="stylesheet" href="../css/registro.css">
</head>
<body>

  <nav class="navbar navbar-expand-sm navbar-light header fixed-top">
    <a class="navbar-brand" href="https://www.escom.ipn.mx/">
    <img src="../imgs/logoipn.png" height="50px">
      <img src="../imgs/escom.png" height="40px">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li>
                <a class="nav-link text-dark shine" href="../index.html">Inicio</a>
            </li>
            <li class="nav-item">
                <div class="dropdown">
                    <button class="btn  text-dark shine" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Registro
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="../html/registro.html">Registro</a>
                        <a class="dropdown-item" href="../html/consulta.html">Obtener PDF</a>
                    </div>
                </div>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right ">
            <li><a class="nav-link text-light" href="../html/login.html"><i class="fas fa-cog mr-1"></i><p class="admin" style="display: inline-block;">Administrador</p></a></li>
        </ul>
    </div>
  </nav>

  <div class="container-fluid content justify-content-center align-content-center">
    <div class="row">
      <div class="col-sm-2 bg-white "></div>
      <div class="col-sm-8 bg-white text-center p-3" id="content">
        <img class="mb-4 mt-4" src="../imgs/correcto.png" alt="" width="100" height="90">
        <h1>¡Registro Exitoso!</h1>
        <h3> Gracias <?php echo $nombre ?> </h3>
        <p>Puedes imprimir tu comprobante de registro</p>
        <button type="submit" form="generar" class="btn btn-success mb-4" id="generar-btn">Generar PDF</button>
        <br>
        <center>
          <div style="width:60%;justify:center;">
            <p style="font-size:11px;">
              <i class="fas fa-info-circle"></i>
              Si quieres modificar tus datos, comunícate al siguiente correo: <strong>correo@ipn.mx</strong>
            </p>
          </div>
        <center>
      </div>
      <div class="col-sm-2 bg-white"></div>
    </div>
  </div>
  <div class="text-center text-light bg-dark" style="margin-bottom:0">
  <img src="../imgs/logoSEP.png" width="90%;" style="max-width: 300px;">
    <div class="p-5">
        <h4> INSTITUTO POLITÉCNICO NACIONAL </h4>
        <p>D.R. Instituto Politécnico Nacional (IPN). Av. Luis Enrique Erro S/N, Unidad Profesional Adolfo López Mateos, Zacatenco, Delegación Gustavo A. Madero, C.P. 07738, Ciudad de México 2009-2013.</p>
        <p>Esta página es una obra intelectual protegida por la Ley Federal del Derecho de Autor, puede ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite la fuente completa y su dirección electrónica; su uso para otros fines, requiere autorización previa y por escrito de la Dirección General del Instituto.</p>
    </div>
  </div>
  <div style="display:none">
    <form action="../pdfs/buscarpdf.php" method="POST" id="generar" name="generar" target="_blank">
      <input type="text" id="curp" value="<?php echo $curp?>" name="curp">
    <form>
  </div>
</body>
</html>