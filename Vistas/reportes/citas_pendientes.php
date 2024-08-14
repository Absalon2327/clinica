<?PHP

require_once("./../../Conexion/Conexion.php");
require('./../../fpdf/fpdf.php');

$day=date("d");
$mont=date("m");
$year=date("Y");
$hora=date("H-i-s");
$fecha=$day.'_'.$mont.'_'.$year;
$ID = $fecha."_(".$hora."_hrs).pdf";

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

        $this->SetFont('Arial', 'B', 11);
        $this->SetXY(10, 30);
        $this->Cell(0, 4, 'REPORTE DE CITAS PENDIENTES', 0, 1, 'C', false);
        $this->SetFontSize(9);
        $this->Cell(0, 4, 'Este reporte muestra las citas pendientes', 0, 1, 'C', false);
        $this->Cell(0, 4, 'hasta la fecha ' . date('d/m/Y'), 0, 1, 'C', false);
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

$pdf->Ln();
$pdf->Cell(13);
/* Tabla */
$sql = "SELECT ci.id_cita as id, pa.nombre_paciente as nombre, pa.apellido_paciente as apellido, pa.dui_paciente as dui, pa.tel_paciente as telefono, DATE(ci.fechahora_cita) as fecha, TIME(ci.fechahora_cita) as hora, ci.estado_cita as estado, ci.preparada_cita as preparada  FROM `tb_cita` as ci, `tb_paciente` as pa WHERE ci.estado_cita = 'activa' AND ci.id_paciente = pa.id_paciente ORDER BY ci.fechahora_cita;";
$comando = Conexion::getInstance()->getDb()->prepare($sql);
$comando->execute();
$result = $comando->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    // Colors, line width and bold font
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

    foreach ($result as $row) {
        $pdf->Cell(13);
        $pdf->Cell($w[0], 6, utf8_decode($row['nombre']) . ' ' . utf8_decode($row['apellido']), 'LR', 0, 'C', 0);
        $pdf->Cell($w[1], 6, $row['dui'], 'LR', 0, 'C', 0);
        $pdf->Cell($w[0], 6, $row['fecha'], 'LR', 0, 'C', 0);
        $pdf->Cell($w[3], 6, $row['hora'], 'LR', 0, 'C', 0);
        $pdf->Ln();
    }
    $pdf->Cell(13);
    $pdf->Cell(array_sum($w), 0, '', 'T');
} else {
    echo "No se encontraron registros";
}
/* Tabla */

$pdf->Output('Citas_pendientes.pdf', 'I'); //Es oara la vista previa del archivo
$pdf->Output('./../../documentos/CitasPendientes'.$ID, 'F'); //Es Para el almacenamiento del archivo
