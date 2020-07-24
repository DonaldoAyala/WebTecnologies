<?php
    include_once './connection.php';
    $object = new Connection();
    $connection = $object->Connect();
    $query="SELECT * from datos;";
    $result = $connection->prepare($query);
    $result->execute();
    $data = $result->fetchALL(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba CRUD</title>
    <link rel="icon" href="../imgs/escom.png">
    <script src="https://kit.fontawesome.com/1dac73aed0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK10PAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="../javascript/crud.js"></script>
    <link rel="stylesheet" href="../css/administrador.css">
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
                <li><a class="nav-link text-light" href="#"><i class="fas fa-cog mr-3"></i><p class="admin" style="display: inline-block;">Administrador</p></a></li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid content" style="height: auto;">
        <div class="row">
            <div class="col-sm-1 tabla"></div>
            <div class="col-sm-10">
            <br>
            <button type="button" id="new" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Añadir Registro  <i class="fa fa-plus"></i> 
            </button>
            <br><br>
            <table id="tableNotes" class="table " width="100%">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Operación</th>
                        <th scope="col">CURP</th>
                        <th style="display:none" scope="col">Boleta</th>
                        <th style="display:none" scope="col">Nombre</th>
                        <th style="display:none" scope="col">Apellido Paterno</th>
                        <th style="display:none" scope="col">Apellido Materno</th>
                        <th style="display:none" scope="col">Fecha de Nacimiento</th>
                        <th style="display:none" scope="col">Sexo</th>
                        <th style="display:none" scope="col">Correo</th>
                        <th style="display:none" scope="col">Colonia</th>
                        <th style="display:none" scope="col">Calle</th>
                        <th style="display:none" scope="col">Número</th>
                        <th style="display:none" scope="col">Código Postal</th>
                        <th style="display:none" scope="col">Teléfono</th>
                        <th style="display:none" scope="col">Escuela</th>
                        <th style="display:none" scope="col">Entidad Fed.</th>
                        <th style="display:none" scope="col">Promedio</th>
                        <th style="display:none" scope="col">Opción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($data as $note){
                    ?>
                        <tr>
                            <td></td>
                            <td><?php echo $note['curp'] ?></td>
                            <td style="display:none"><?php echo $note['boleta'] ?></td>
                            <td style="display:none"><?php echo $note['nombre'] ?></td>
                            <td style="display:none"><?php echo $note['apellido_paterno'] ?></td>
                            <td style="display:none"><?php echo $note['apellido_materno'] ?></td>
                            <td style="display:none"><?php echo $note['fecha_nacimiento'] ?></td>
                            <td style="display:none"><?php echo $note['sexo'] ?></td>
                            <td style="display:none"><?php echo $note['correo'] ?></td>
                            <td style="display:none"><?php echo $note['colonia'] ?></td>
                            <td style="display:none"><?php echo $note['calle'] ?></td>
                            <td style="display:none"><?php echo $note['numero'] ?></td>
                            <td style="display:none"><?php echo $note['codigo_postal'] ?></td>
                            <td style="display:none"><?php echo $note['telefono'] ?></td>
                            <td style="display:none"><?php echo $note['escuela'] ?></td>
                            <td style="display:none"><?php echo $note['entidad_federativa'] ?></td>
                            <td style="display:none"><?php echo $note['promedio'] ?></td>
                            <td style="display:none"><?php echo $note['opcion'] ?></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            </div>
            <div class="col-sm-1 tabla"></div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <h2 class="text-center">Formulario de Registro</h2>
                    <form id="datos" name="datos" accept-charset="utf-8">
                        <fieldset>
                            <legend>Identidad</legend>
                            <div class="form-group">
                                <label>CURP </label>
                                <input type="text" class="form-control" id="curp" placeHolder="CURP" name="curp">
                                <div id="aviso_curp" style="display: none;" >
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Ingresa un formato correcto de CURP ej. 'BADD110313HCMLNS09'
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Boleta</label>
                                <input type="text" class="form-control" id="boleta" placeHolder="Boleta" name="boleta">
                                <div id="aviso_boleta" style="display: none;" >
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Ingresa un formato correcto de boleta ej. 'PE12345678','PP12345678','0123456789'
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" id="nombre" placeHolder="Nombre" name="nombre">
                                <div id="aviso_nombre" style="display: none;" >
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Por favor ingresa un formato válido ej. 'Juan' 'Jose'
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Apellido Paterno</label>
                                <input type="text" class="form-control" id="apellido_paterno" placeHolder="Apellido Paterno" name="apellido_paterno">
                                <div id="aviso_apellido_paterno" style="display: none;" >
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Por favor ingresa un formato válido ej. 'Montes' 'García'
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Apellido Materno</label>
                                <input type="text" class="form-control" id="apellido_materno" placeHolder="Apellido Materno" name="apellido_materno">
                                <div id="aviso_apellido_materno" style="display: none;" >
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Por favor ingresa un formato válido ej. 'Montes' 'García'
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" placeHolder="Fecha Nacimiento" name="fecha_nacimiento">
                                <div id="aviso_fecha_nacimiento" style="display: none;">
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Por favor selecciona una fecha
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label id="sexo_label">Sexo: </label>
                                <div id="aviso_sexo" style="display: none;">
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Por favor selecciona una opción
                                    </p>
                                </div>
                                <div class="form-check" id="div_sexo1">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexo" value="Masculino">
                                    <label class="form-check-label" for="exampleRadios1">Masculino</label>
                                </div>
                                <div class="form-check" id="div_sexo2">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexo" value="Femenino">
                                    <label class="form-check-label" for="exampleRadios1">Femenino</label>
                                </div>
                            </div>
                        </fieldset>
                        <hr class="my-1"/>
                        <fieldset>
                            <legend>Contacto</legend>
                            <div class="form-group">
                                <label>Correo</label>
                                <input type="text" class="form-control" id="correo" placeHolder="Correo" name="correo">
                                <div id="aviso_correo" style="display: none;">
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Por favor ingresa un correo válido
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Colonia</label>
                                <input type="text" class="form-control" id="colonia" placeHolder="Colonia" name="colonia">
                                <div id="aviso_colonia" style="display: none;">
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Por favor ingresa un formato válido
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Calle</label>
                                <input type="text" class="form-control" id="calle" placeHolder="Calle" name="calle">
                                <div id="aviso_calle" style="display: none;">
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Por favor ingresa un formato válido
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Número</label>
                                <input type="text" class="form-control" id="numero" placeHolder="Numero" name="numero">
                                <div id="aviso_numero" style="display: none;">
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Por favor ingresa un número
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Código Postal</label>
                                <input type="text" class="form-control" id="codigo_postal" placeHolder="Código Postal" name="codigo_postal">
                                <div id="aviso_codigo_postal" style="display: none;">
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Por favor ingresa un código postal válido
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Teléfono (de 10 dígitos)</label>
                                <input type="text" class="form-control" id="telefono" placeHolder="Teléfono" name="telefono">
                                <div id="aviso_telefono" style="display: none;">
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Por favor ingresa un número de teléfono válido
                                    </p>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Contacto</legend>
                            <div class="form-group" id="select_escuela">
                                <label>Escuela</label>
                                <div id="aviso_escuela" style="display: none;">
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Por favor selecciona una escuela
                                    </p>
                                </div>
                                <select class="form-control" id="escuela" onchange="revisarOpcion(this.value)" name="escuela" required>
                                    <option value="default" selected="selected">Escuela de procedencia</option>
                                    <option value="CEC y T # 1 GONZALO VÁZQUEZ VELA">CEC y T #  1 GONZALO VÁZQUEZ VELA</option>
                                    <option value="CEC y T # 2 MIGUEL BERNARD PERALES">CEC y T #  2 MIGUEL BERNARD PERALES</option>
                                    <option value="CEC y T # 3 ESTANISLAO RAMÍREZ RUIZ">CEC y T #  3 ESTANISLAO RAMÍREZ RUIZ</option>
                                    <option value="CEC y T # 4 LÁZARO CÁRDENAS DEL RÍO">CEC y T #  4 LÁZARO CÁRDENAS DEL RÍO</option>
                                    <option value="CEC y T # 5 BENITO JUÁREZ GARCÍA">CEC y T #  5 BENITO JUÁREZ GARCÍA</option>
                                    <option value="CEC y T # 6 MIGUEL OTHÓN DE MENDIZÁBAL">CEC y T #  6 MIGUEL OTHÓN DE MENDIZÁBAL</option>
                                    <option value="CEC y T # 7 CUAUHTÉMOC">CEC y T #  7 CUAUHTÉMOC</option>
                                    <option value="CEC y T # 8 NARCISO BASSOLS GARCÍA">CEC y T #  8 NARCISO BASSOLS GARCÍA</option>
                                    <option value="CEC y T # 9 JUAN DE DIOS BÁTIZ PAREDES">CEC y T #  9 JUAN DE DIOS BÁTIZ PAREDES</option>
                                    <option value="CEC y T # 10 CARLOS VALLEJO MÁRQUEZ">CEC y T #  10 CARLOS VALLEJO MÁRQUEZ</option>
                                    <option value="CEC y T # 11 WILFRIDO MASSIEU PÉREZ">CEC y T #  11 WILFRIDO MASSIEU PÉREZ</option>
                                    <option value="CEC y T # 12 JOSÉ MA. MORELOS Y PAVÓN">CEC y T #  12 JOSÉ MA. MORELOS Y PAVÓN</option>
                                    <option value="CEC y T # 13 RICARDO FLORES MAGÓN">CEC y T #  13 RICARDO FLORES MAGÓN</option>
                                    <option value="CEC y T # 14 LUIS ENRIQUE ERRO SOLER">CEC y T #  14 LUIS ENRIQUE ERRO SOLER</option>
                                    <option value="CEC y T # 15 DIÓDORO ANTÚNEZ ECHEGARAY">CEC y T #  15 DIÓDORO ANTÚNEZ ECHEGARAY</option>
                                    <option value="CEC y T # 16 HIDALGO">CEC y T # 16 HIDALGO</option>
                                    <option value="CEC y T # 17 LEÓN-GUANAJUATO">CEC y T # 17 LEÓN-GUANAJUATO</option>
                                    <option value="CEC y T # 18 ZACATECAS">CEC y T # 18 ZACATECAS</option>
                                    <option value="CET WALTER CROSS BUCHANANS">CET WALTER CROSS BUCHANANS</option>
                                    <option value="otro">Otra</option>
                                </select>
                            </div>
                            <div class="form-group" style="display:none;" id="otra_escuela_div">
                                <label style="display: inline-block;">Nombre de la Escuela</label>
                                <input type="text" class="form-control" id="otra_escuela" placeHolder="Nombre de la Escuela" name="otra_escuela">
                                <div id="aviso_otra_escuela" style="display: none;">
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Por favor ingresa el nombre de tu escuela
                                    </p>
                                </div>
                            </div>
                            <div class="form-group" id="select_entidad">
                                <label>Entidad Federativa Escolar</label>
                                <div id="aviso_entidad_federativa" style="display: none;">
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Por favor selecciona la entidad federativa de tu escuela
                                    </p>
                                </div>
                                <select class="form-control" id="entidad_federativa" name="entidad" required>
                                    <option value="default">Entidad Federativa</option>
                                    <option value="Aguascalientes">Aguascalientes</option>
                                    <option value="Baja California">Baja California</option>
                                    <option value="Baja California Sur">Baja California Sur</option>
                                    <option value="Campeche">Campeche</option>
                                    <option value="Chiapas">Chiapas</option>
                                    <option value="Chihuahua">Chihuahua</option>
                                    <option value="Coahuila de Zaragoza">Coahuila de Zaragoza</option>
                                    <option value="Colima">Colima</option>
                                    <option value="Distrito Federal">Distrito Federal</option>
                                    <option value="Durango">Durango</option>
                                    <option value="Guanajuato">Guanajuato</option>
                                    <option value="Guerrero">Guerrero</option>
                                    <option value="Hidalgo">Hidalgo</option>
                                    <option value="Jalisco">Jalisco</option>
                                    <option value="México">México</option>
                                    <option value="Michoacán de Ocampo">Michoacán de Ocampo</option>
                                    <option value="Morelos">Morelos</option>
                                    <option value="Nayarit">Nayarit</option>
                                    <option value="Nuevo León">Nuevo León</option>
                                    <option value="Oaxaca">Oaxaca</option>
                                    <option value="Puebla">Puebla</option>
                                    <option value="Querétaro">Querétaro</option>
                                    <option value="Quintana Roo">Quintana Roo</option>
                                    <option value="San Luis Potosí">San Luis Potosí</option>
                                    <option value="Sinaloa">Sinaloa</option>
                                    <option value="Sonora">Sonora</option>
                                    <option value="Tabasco">Tabasco</option>
                                    <option value="Tamaulipas">Tamaulipas</option>
                                    <option value="Tlaxcala">Tlaxcala</option>
                                    <option value="Veracruz de Ignacio de la Llave">Veracruz de Ignacio de la Llave</option>
                                    <option value="Yucatán">Yucatán</option>
                                    <option value="Zacatecas">Zacatecas</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Promedio</label>
                                <input type="text" class="form-control" id="promedio" placeHolder="Promedio" name="promedio" >
                                <div id="aviso_promedio" style="display: none;">
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Por favor ingresa tu promedio con máximo dos decimales
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>ESCOM fue tu opción: </label>
                                <div id="aviso_opcion" style="display: none;">
                                    <p style="font-size:14px;" class="pr-1 pt-1 text-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Por favor selecciona una opción
                                    </p>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="opcion" id="opcion" value="Primera" >
                                    <label class="form-check-label" for="opcion">Primera</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="opcion" id="opcion" value="Segunda" >
                                    <label class="form-check-label" for="opcion">Segunda</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="opcion" id="opcion" value="Tercera" >
                                    <label class="form-check-label" for="opcion">Tercera</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="opcion" id="opcion" value="Cuarta" >
                                    <label class="form-check-label" for="opcion">Cuarta</label>
                                </div>
                            </div>
                        </fieldset>
                        <center>
                            <button type="submit"  form="datos" class="btn btn-success">Guardar</button>
                            <button type="reset" id="cancelar" class="btn btn-secondary">Cancelar</button>
                        </center>
                        <br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>