
<?php
    include_once '../php/connection.php';
    include("./fpdf182/fpdf.php");

    $object = new Connection();
    $connection = $object->Connect();

    $curp = (isset($_POST['curp'])) ? $_POST['curp']:'';

    $query="SELECT * from datos WHERE curp = '$curp';";
    $result = $connection->prepare($query);
    $result->execute();
    $data = $result->fetchALL(PDO::FETCH_ASSOC);

    
    class PDF extends FPDF
    {
        // Cabecera de página
        function Header()
        {
            // Logo
            $this->Image('../imgs/banner.png',20,10,180);
            $this->Ln(35);
        }

        // Pie de página
        function Footer()
        {
            // Posición: a 1.5 cm del final
            $this->SetY(-30);
            $this->SetX(20);
            // Arial italic 8
            $this->SetFont('Helvetica','B',11);
            // Número de página
            $this->Cell(0,0,utf8_decode('*Nota: Si quieres modificar tus datos comunícate al siguiente correo: correo@ipn.mx'),0,0,'C');
            // Posición: a 1.5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Helvetica','B',9);
            // Número de página
            $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
        }
    }

    $margin = 30;
    $sizexl = 55;
    $sizexr = 95;
    $sizey = 7;
    $border = 0;
    $fontsize = 12;
    // Creación del objeto de la clase heredada
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    //Celda
    $pdf->SetLeftMargin($margin);

    //foreach($data as $note){ 
        $pdf->SetFont('Helvetica','B',$fontsize+1);
        $pdf->Cell($sizexl+$sizexr,$sizey,'Comprobante de Registro de Alumnos de Nuevo Ingreso',$border,1,'C');
        $pdf->SetFont('Helvetica','B',$fontsize+1);
        $pdf->Cell($sizexl+$sizexr,$sizey,'Periodo 2020-2',$border,1,'C');
        $pdf->Ln(5);
        $pdf->SetFont('Helvetica','B',$fontsize + 3);
        $pdf->Cell($sizexl+$sizexr,$sizey,'Datos Personales',$border,1,'C');
        $pdf->Ln(5);
        //CURP
        $pdf->SetFont('Helvetica','B',$fontsize);
        $pdf->Cell($sizexl,$sizey,'CURP: ',$border,0);
        $pdf->SetFont('Helvetica','',$fontsize);
        $pdf->MultiCell($sizexr,$sizey,utf8_decode($data[0]['curp']),$border,1);
        //Nombre
        $pdf->SetFont('Helvetica','B',$fontsize);
        $pdf->Cell($sizexl,$sizey,'Nombre: ',$border,0);
        $pdf->SetFont('Helvetica','',$fontsize);
        $pdf->MultiCell($sizexr,$sizey,utf8_decode($data[0]['nombre'] .' '.$data[0]['apellido_paterno'].' '.$data[0]['apellido_materno'] ),$border,1);
        //Boleta
        $pdf->SetFont('Helvetica','B',$fontsize);
        $pdf->Cell($sizexl,$sizey,'Boleta: ',$border,0);
        $pdf->SetFont('Helvetica','',$fontsize);
        $pdf->MultiCell($sizexr,$sizey,utf8_decode($data[0]['boleta'] ),$border,1);
        //Fecha de nacimiento
        $pdf->SetFont('Helvetica','B',$fontsize);
        $pdf->Cell($sizexl,$sizey,'Fecha de Nacimiento: ',$border,0);
        $pdf->SetFont('Helvetica','',$fontsize);
        $pdf->MultiCell($sizexr,$sizey,utf8_decode($data[0]['fecha_nacimiento'] ),$border,1);
        //Sexo
        $pdf->SetFont('Helvetica','B',$fontsize);
        $pdf->Cell($sizexl,$sizey,'Sexo: ',$border,0);
        $pdf->SetFont('Helvetica','',$fontsize);
        $pdf->MultiCell($sizexr,$sizey,utf8_decode($data[0]['sexo'] ),$border,1);
        //Sección de Contacto
        $pdf->Ln(5);
        $pdf->SetFont('Helvetica','B',$fontsize + 3);
        $pdf->Cell($sizexl+$sizexr,$sizey,'Contacto',$border,1,'C');
        $pdf->Ln(5);
        //Correo
        $pdf->SetFont('Helvetica','B',$fontsize);
        $pdf->Cell($sizexl,$sizey,'Correo: ',$border,0);
        $pdf->SetFont('Helvetica','',$fontsize);
        $pdf->MultiCell($sizexr,$sizey,utf8_decode($data[0]['correo']),$border,1);
        //Dirección
        $pdf->SetFont('Helvetica','B',$fontsize);
        $pdf->Cell($sizexl,$sizey,utf8_decode('Dirección: '),$border,0);
        $pdf->SetFont('Helvetica','',$fontsize);
        $pdf->MultiCell($sizexr,$sizey,utf8_decode($data[0]['calle'] .' '.$data[0]['numero'] .' '.$data[0]['colonia'] ),$border,1);
        //Código Postal
        $pdf->SetFont('Helvetica','B',$fontsize);
        $pdf->Cell($sizexl,$sizey,utf8_decode('Código Postal'),$border,0);
        $pdf->SetFont('Helvetica','',$fontsize);
        $pdf->MultiCell($sizexr,$sizey,utf8_decode($data[0]['codigo_postal'] ),$border,1);
        //Teléfono
        $pdf->SetFont('Helvetica','B',$fontsize);
        $pdf->Cell($sizexl,$sizey,utf8_decode('Teléfono'),$border,0);
        $pdf->SetFont('Helvetica','',$fontsize);
        $pdf->MultiCell($sizexr,$sizey,utf8_decode($data[0]['telefono'] ),$border,1);
        //Sección de Procedencia
        $pdf->Ln(5);
        $pdf->SetFont('Helvetica','B',$fontsize + 3);
        $pdf->Cell($sizexl+$sizexr,$sizey,'Procedencia',$border,1,'C');
        $pdf->Ln(5);
        //Escuela
        $pdf->SetFont('Helvetica','B',$fontsize);
        $pdf->Cell($sizexl,$sizey,utf8_decode('Escuela de Procedencia'),$border,0);
        $pdf->SetFont('Helvetica','',$fontsize);
        $pdf->MultiCell($sizexr,$sizey,utf8_decode($data[0]['escuela'] ),$border,1);
        //Entidad
        $pdf->SetFont('Helvetica','B',$fontsize);
        $pdf->Cell($sizexl,$sizey,utf8_decode('Entidad Federativa'),$border,0);
        $pdf->SetFont('Helvetica','',$fontsize);
        $pdf->MultiCell($sizexr,$sizey,utf8_decode($data[0]['entidad_federativa'] ),$border,1);
        //Promedio
        $pdf->SetFont('Helvetica','B',$fontsize);
        $pdf->Cell($sizexl,$sizey,utf8_decode('Promedio'),$border,0);
        $pdf->SetFont('Helvetica','',$fontsize);
        $pdf->MultiCell($sizexr,$sizey,utf8_decode($data[0]['promedio'] ),$border,1);
        //Promedio
        $pdf->SetFont('Helvetica','B',$fontsize);
        $pdf->Cell($sizexl,$sizey,utf8_decode('Opción'),$border,0);
        $pdf->SetFont('Helvetica','',$fontsize);
        $pdf->MultiCell($sizexr,$sizey,utf8_decode($data[0]['opcion'] ),$border,1);

    $pdf->Output();
?>