<?PHP

require_once("./../../Conexion/Conexion.php");
require('./../../fpdf/fpdf.php');

class PDF extends FPDF
{

    function Header()
    {
        /* Encabezado */
        // Select Arial bold 15
        $this->SetFont('Arial', 'B', 20);
        // Move to the right
        /* marca de agua */
        $this->Image('./../../assets/img/favicon/img_marca.jpg', 40, 110, 125, 110);
        /* Logo del PDF */
        $this->Image('./../../assets/img/favicon/img_repo.jpg', 9, 10, 30, 30);

        $this->Image('./../../assets/img/favicon/img_repo.jpg', 170, 10, 30, 30);
        // Framed title
        $this->SetXY(10, 15);
        $this->Cell(0, 4, utf8_decode('CLÍNICA MEDICA FAMILIAR'), 0, 0, 'C');

        $this->SetXY(10, 20);
        $this->SetFont('', 'BI', 13);
        $this->Cell(0, 4, utf8_decode('Dr. Roberto Omar Bonilla Umaña'), 0, 1, 'C', false);

        $this->SetXY(10, 25);
        $this->SetFont('', 'BI', 17);
        $this->Cell(0, 4, 'J.V.P.M. 9955', 0, 0, 'C');

        $this->SetFont('', 'BI', 9);
        $this->SetXY(10, 30);
        $this->SetFontSize(9);
        $this->Cell(0, 4, utf8_decode('Consulta Médica para Adultos y Niños, Terapia Respiratoria,'), 0, 1, 'C', false);
        $this->Cell(0, 4, utf8_decode('Pequeña Cirugía, Tratamiento de Ulceras, Toma de Citologías'), 0, 1, 'C', false);
        /* --- Line --- */
        $this->Line(10, 44, 200, 45);
        $this->Line(10, 44.2, 200, 45.2);
        $this->Line(10, 45, 200, 46);
        $this->Ln(12);
        /* Encabezado */
    }

    function Footer()
    {
        /* Pie de pagina */
        //Posicion
        $this->SetY(-25);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 4, utf8_decode('San Vicente 3° Av. Norte #4, Barrio el Calvario'), 0, 1, 'C', false);
        $this->Cell(0, 4, 'Cel.: 6002-6295', 0, 1, 'C', false);
        $this->Cell(0, 4, utf8_decode('Horarios: Lunes a Sábado de 8:00 AM a 3:00 PM'), 0, 1, 'C', false);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        //Numero de pagina
        $this->Cell(0, 5, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'R');
        /* Pie de pagina */
    }
}


$pdf = new PDF();
$pdf->AddPage('P', 'A4');
$pdf->SetMargins(11, 11, 11);
$pdf->SetAutoPageBreak(true, 25);
$pdf->AliasNbPages();

/* Datos personales */
$pdf->SetFont('', 'B', 10);
$pdf->SetXY(9, 47);
$pdf->Cell(0, 4, 'Nombre:_________________________________________________________________________________________', 0, 1, 'L', false);
$pdf->SetXY(9, 55);
$pdf->Cell(0, 4, 'Edad:_______________________________________', 0, 0, 'L', false);
$pdf->SetXY(100, 55);
$pdf->Cell(0, 4, 'Fecha:___________________________', 0, 1, 'L', false);


/* Tabla */

$pdf->Ln();
$pdf->Cell(13);
// Colors, line width and bold font
$pdf->setFillColor(204, 200, 200);
$pdf->setDrawColor(88, 95, 101);
$pdf->setLineWidth(0.3);
$pdf->setFont('', 'B');
// Header
$w = array(40, 35, 40, 45);
$header = array('Nombre', 'DUI', 'Fecha', 'Hora');
$num_headers = count($header);
for ($i = 0; $i < $num_headers; ++$i) {
    $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
}
// Color and font restoration
$pdf->setFillColor(224, 235, 255);
$pdf->setTextColor(0);
$pdf->setFont('');
$pdf->Ln();

for ($i = 0; $i < 50; $i++) {
    $pdf->Cell(13);
    $pdf->Cell($w[0], 6, 'Kevin Mejia', 'LR', 0, 'C', 0);
    $pdf->Cell($w[1], 6, '00000000-0', 'LR', 0, 'C', 0);
    $pdf->Cell($w[0], 6, '25/12/2022', 'LR', 0, 'C', 0);
    $pdf->Cell($w[3], 6, '10:00', 'LR', 0, 'C', 0);
    $pdf->Ln();
}
$pdf->Cell(13);
$pdf->Cell(array_sum($w), 0, '', 'T');

/* Tabla */

$pdf->Output('created_pdf.pdf', 'I');
