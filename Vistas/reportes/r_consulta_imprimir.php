<?php
@session_start();
require_once("../../Modelo/Core.php");
require_once("../../Controladores/consultas_expedientes/mostrar_expedientes.php");
require_once("../../Controladores/sql_consultas/mostrar_consultas.php");
require_once("../../libs/dompdf/vendor/autoload.php");
$modelo = new Modelo();
$idexp = $_GET['idexp'];

$idcons = $_GET['idcons'];

$sql = editar_expediente($idexp);
$sql_pago = pagos_imprimir($idcons);

$result = $modelo->get_query($sql);
$result_pago = $modelo->get_query($sql_pago);

$edad = evaluar_edad($result[2][0]['fecha_paciente']);

$fecha_consulta = datetimeformateado($result_pago[2][0]['fecha_pago']);


function evaluar_edad($fecha_naci)
{
    $edad = 0;
    $año_actual = "";
    $año_actual = date("Y");
    //divido la fecha para obtener el año
    $separacion = explode("-", $fecha_naci);
    $año = $separacion[0];
    $edad = intval($año_actual) - intval($año);

    return $edad;
}
function datetimeformateado($fecha3)
{

    //divido la feha de la hora
    $separacion = explode(" ", $fecha3);
    $hora = $separacion[1];
    $fecha = $separacion[0];

    $pos = strpos($fecha, "/");
    if ($pos === false) $fecha = explode("-", $fecha);
    else $fecha = explode("/", $fecha);
    $dia1 = (strlen($fecha[0]) == 1) ? '0' . $fecha[0] : $fecha[0];

    //Concateno la fecha formteada con la hora y un espacio
    $fecha1 = $fecha[2] . '-' . $fecha[1] . '-' . $dia1 . ' ' . $hora;
    return $fecha1;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expediente</title>

    <?php
    require_once('../../Headers/headers.php');
    ?>

</head>

<body>

    <!-- <img src="./../../assets/img/favicon/img_marca.jpg" style="" alt="" > -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Bootstrap Table with Header - Light -->

                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="./../../assets/img/favicon/img_repo.jpg" alt="" style="width: 110px; height: 110px;">
                                        </div>
                                        <div class="col-4">
                                            <h5 class="text-center">
                                                <strong> CLÍNICA MEDICA FAMILIAR <br>
                                                    <small>Dr. Roberto Omar Bonilla Umaña</small><br>
                                                    J.V.P.M. 9955
                                                    <h6>
                                                        <small>
                                                            <strong>
                                                                Consulta Médica para Adultos y Niños, Terapia Respiratoria,<br>
                                                                Pequeña Cirugía, Tratamiento de Ulceras, Toma de Citologías
                                                            </strong>
                                                        </small><br><br><br>
                                                        EXPEDIENTE N° <strong> <?php echo $idexp ?> </strong>
                                                    </h6>
                                                </strong>
                                            </h5>
                                        </div>
                                        <div class="col-4 text-end">
                                            <img src="./../../assets/img/favicon/img_repo.jpg" alt="" style="width: 110px; height: 110px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-sm-4">
                                        PACIENTE: <strong><?php echo $result[2][0]['paciente'] ?></strong><br>
                                    </div>
                                    <div class="col-sm-4">
                                        EDAD: <strong><?php echo $edad ?></strong><br>
                                    </div>
                                    <div class="col-sm-4">
                                        SEXO: <strong><?php echo $result[2][0]['sexo_paciente'] ?></strong><br>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <!--  -->
                                    <hr class="m-0">
                                    <hr class="m-0">
                                    <hr class="m-0">
                                    <!-- DIAGNÓSTICO -->
                                    <div class="row">
                                        <p> <strong> </strong></p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p> <strong>DIAGNÓSTICO: </strong></p>
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <p> <?php echo $result_pago[2][0]['diagnostico_consulta'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <hr class="m-0">
                                    <hr class="m-0">
                                    <hr class="m-0">
                                    <!-- RECETA -->
                                    <div class="row">
                                        <p> <strong> </strong></p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p> <strong>MEDICAMENTO RECETADO: </strong></p>
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <p> <?php echo $result_pago[2][0]['receta_consulta'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <hr class="m-0">
                                    <hr class="m-0">
                                    <hr class="m-0">
                                    <!-- MONTO -->
                                    <div class="row">

                                        <p> <strong> </strong></p>
                                        <div class="row ">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-3 mb-3">
                                                <p> <strong>MONTO: </strong></p>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <p> <?php echo '$ '. $result_pago[2][0]['monto_pago'] ?></p>
                                                <hr class="m-0">
                                                <hr class="m-0">
                                                <hr class="m-0">
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->

                                </div>
                            </div>
                        </div>
                        <!-- / Content -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>
            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
    </div>

    <?php
    require_once('../../Footers/footer_scripst.php');
    ?>
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>