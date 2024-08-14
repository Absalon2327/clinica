<?php
require_once("./../../Conexion/Conexion.php");
require('./../../fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage('P', 'A4');
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetFont('Arial', '', 12);
$pdf->AliasNbPages();
$pdf->SetTopMargin(10);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);

/* Encabezado */

/* header del PDF */
$pdf->Image('./../../assets/img/favicon/header.png', 0, 0, 210, 100);
/* Logo del PDF */
$pdf->Image('./../../assets/img/favicon/img_black.png', 9, 10, 30, 30);

/* --- Cell --- */
$pdf->SetXY(153, 12);
$pdf->Cell(0, 4, 'Fecha: ' . date("d/m/Y"), 0, 1, 'L', false);
/* --- Cell --- */
$pdf->SetXY(10, 35);
$pdf->SetFont('', 'BI', 18);
$pdf->Cell(0, 4, 'CLINICA MEDICA FAMILIAR', 0, 1, 'C', false);
$pdf->SetTextColor(0);
/* --- Cell --- */
$pdf->SetXY(10, 40);
$pdf->SetFont('', 'BI', 10);
$pdf->Cell(0, 4, utf8_decode('Dr. Roberto Omar Bonilla Umaña'), 0, 1, 'C', false);
$pdf->SetTextColor(0);

/* --- Line --- */
$pdf->Line(15, 45, 195, 45);

/* --- Cell --- */
$pdf->SetXY(10, 50);
$pdf->SetFontSize(11);
$pdf->Cell(0, 4, 'REPORTE DE CITAS PENDIENTES', 0, 1, 'C', false);
/* Encabezado */

$pdf->Ln(12);
$pdf->Cell(13);
/* Tabla */
$sql = "SELECT ci.id_cita as id, pa.nombre_paciente as nombre, pa.apellido_paciente as apellido, pa.dui_paciente as dui, pa.tel_paciente as telefono, DATE(ci.fechahora_cita) as fecha, TIME(ci.fechahora_cita) as hora, ci.estado_cita as estado, ci.preparada_cita as preparada  FROM `tb_cita` as ci, `tb_paciente` as pa WHERE ci.estado_cita = 'activa' AND ci.id_paciente = pa.id_paciente ORDER BY ci.fechahora_cita;";
$comando = Conexion::getInstance()->getDb()->prepare($sql);
$comando->execute();
$result = $comando->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    // Colors, line width and bold font
    $pdf->setFillColor(255, 0, 0);
    $pdf->setTextColor(255);
    $pdf->setDrawColor(128, 0, 0);
    $pdf->setLineWidth(0.3);
    $pdf->setFont('', 'B');
    // Header
    $w = array(40, 35, 40, 45);
    $header = array('Nombre', 'DUI', 'Fecha', 'Hora');
    $num_headers = count($header);
    for ($i = 0; $i < $num_headers; ++$i) {
        $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
    }
    $pdf->Ln();
    // Color and font restoration
    $pdf->setFillColor(224, 235, 255);
    $pdf->setTextColor(0);
    $pdf->setFont('');
    // Data
    $fill = 1;
    foreach ($result as $row) {
        $pdf->Cell(13);
        $pdf->Cell($w[0], 6, $row['nombre'] . ' ' . $row['apellido'], 'LR', 0, 'C', $fill);
        $pdf->Cell($w[1], 6, $row['dui'], 'LR', 0, 'C', $fill);
        $pdf->Cell($w[0], 6, $row['fecha'], 'LR', 0, 'C', $fill);
        $pdf->Cell($w[3], 6, $row['hora'], 'LR', 0, 'C', $fill);
        $pdf->Ln();
        $fill = !$fill;
    }
    $pdf->Cell(13);
    $pdf->Cell(array_sum($w), 0, '', 'T');
} else {
    echo "No se encontraron registros";
}
/* Tabla */

/* Pie de pagina */
//Posicion
$pdf->SetY(-15);
//Arial italic 8
$pdf->SetFont('Arial', 'I', 8);
//Numero de pagina
$pdf->Cell(0, 5, 'Pagina ' . $pdf->PageNo() . '/{nb}', 0, 0, 'R');
/* Pie de pagina */

$pdf->Output('created_pdf.pdf', 'I');
