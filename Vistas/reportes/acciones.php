<?php
require('./../../fpdf/fpdf.php');

$ruta = (isset($_GET["ruta"])) ? $_GET["ruta"] : "";
$pdf = new FPDF();

if (isset($_POST['action']) && $_POST['action'] == "eliminar" &&  $_POST['database'] != "") {
    if (unlink($_POST['database'])) {
        print json_encode(array("Exito"));
        exit();
    } else {
        print json_encode(array("Error"));
        exit();
    }
}


if (isset($_GET['ruta'])) {
    echo '<object class="pdfview" type="application/pdf" data="' . $ruta . '"></object>';
}
