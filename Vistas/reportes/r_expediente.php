<?php
@session_start();
require_once("../../Modelo/Core.php");
require_once("../../Controladores/consultas_expedientes/mostrar_expedientes.php");
require_once("../../libs/dompdf/vendor/autoload.php");
$modelo = new Modelo();
$idexp = $_GET['id'];

$sql = editar_expediente($idexp);

$result = $modelo->get_query($sql);

$edad = evaluar_edad($result[2][0]['fecha_paciente']);

$fecha_mestruacion = dateformateado($result[2][0]['fecha_ultima_menstruacion']);
$fecha_embarazo = dateformateado($result[2][0]['fecha_ultimo_parto']);

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
function dateformateado($fecha3)
{

    //divido la feha de la hora
    $separacion = explode("-", $fecha3);
    $dia1 = (strlen($separacion[0]) == 1) ? '0' . $separacion[0] : $separacion[0];

    //Concateno la fecha formteada con la hora y un espacio
    $fecha = $separacion[2] . '-' . $separacion[1] . '-' . $dia1;
    return $fecha;
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
                                <br>
                                <hr class="m-0">
                                <hr class="m-0">
                                <hr class="m-0">
                                <div class="modal-body">
                                    <h6>

                                        <!-- hereditarios y familiares -->
                                        <!-- tipo de familia -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p> <strong><small>HEREDITARIOS Y FAMILIARES: </small></strong></p>
                                                    </div>
                                                    <div class="col-sm-2 mb-3">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <p><strong><small><small>PARENTESCO</small></small></strong></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <small>
                                                            <small>
                                                                <p><strong>DIABETES MELLITUS </strong></p>
                                                                <p><strong>HIPERTENIÓN ARTERIAL </strong></p>
                                                                <p><strong>CARDIOPATÍA ISQUÉMICA </strong></p>
                                                                <p><strong>CANCER </strong></p>
                                                                <p><strong>OTROS </strong></p>
                                                            </small>
                                                        </small>
                                                    </div>
                                                    <div class="col-sm-2 mb-3">
                                                        <small>
                                                            <p><?php echo $result[2][0]['diabetes_mellitus'] ?></p>
                                                            <p> <?php echo $result[2][0]['hipertension_arterial'] ?></p>
                                                            <p> <?php echo $result[2][0]['cardipatia_isquemica'] ?></p>
                                                            <p> <?php echo $result[2][0]['cancer'] ?></p>
                                                            <p>
                                                                <?php
                                                                if ($result[2][0]['otro_hereditario'] == "n/a") {
                                                                    echo "...";
                                                                } else {
                                                                    echo $result[2][0]['otro_hereditario'];
                                                                }
                                                                ?>
                                                            </p>
                                                        </small>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <small>
                                                            <p>
                                                                <?php
                                                                if ($result[2][0]['parentesco_diabetes'] == "n/a") {
                                                                    echo "...";
                                                                } else {
                                                                    echo $result[2][0]['parentesco_diabetes'];
                                                                }
                                                                ?>
                                                            </p>
                                                            <p>
                                                                <?php
                                                                if ($result[2][0]['parentesco_hip_ar'] == "n/a") {
                                                                    echo "...";
                                                                } else {
                                                                    echo $result[2][0]['parentesco_hip_ar'];
                                                                }
                                                                ?>
                                                            </p>
                                                            <p>
                                                                <?php
                                                                if ($result[2][0]['parentesco_card_isq'] == "n/a") {
                                                                    echo "...";
                                                                } else {
                                                                    echo $result[2][0]['parentesco_card_isq'];
                                                                }
                                                                ?>
                                                            </p>
                                                            <p>
                                                                <?php
                                                                if ($result[2][0]['parentesco_can'] == "n/a") {
                                                                    echo "...";
                                                                } else {
                                                                    echo $result[2][0]['parentesco_can'];
                                                                }
                                                                ?>
                                                            </p>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <small>
                                                            <small>
                                                                <p><strong>TIPO DE FAMILIA: </strong></p>
                                                                <p><strong>ROL DE LA MADRE: </strong></p>
                                                                <p><strong>FAMILIAR RESPOSABLE DEL PACIENTE: </strong></p>
                                                                <p><strong>FAMILIA: </strong></p>
                                                                <p><strong>DISFUNCIONES FAMILIARES: </strong></p>
                                                            </small>
                                                        </small>
                                                    </div>
                                                    <div class="col-sm-6 mb-3">
                                                        <small>
                                                            <small>
                                                                <p><?php echo $result[2][0]['tipo_familia'] ?></p>
                                                                <p><?php echo $result[2][0]['rol_madre'] ?></p>
                                                                <p>
                                                                    <?php
                                                                    if ($result[2][0]['nombres_encargado'] == null) {
                                                                        echo "Sin Encargado";
                                                                    } else {
                                                                        echo $result[2][0]['nombres_encargado'];
                                                                    }
                                                                    ?>
                                                                </p>
                                                                <p><?php echo $result[2][0]['familia'] ?> </p>
                                                                <p><?php echo $result[2][0]['disfunciones_familiares'] ?></p>
                                                            </small>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <!-- personales no patológicos -->
                                        <div class="row">
                                            <p> </small><strong>PERSONALES NO PATOLÓGICOS: </strong></small></p>
                                            <div class="row">

                                                <div class="col-sm-3">
                                                    <small>
                                                        <small>
                                                            <p> <strong>ESTADO CIVIL </strong></p>
                                                            <p><strong>RELIGIÓN </strong></p>
                                                            <p><strong>HABITACIÓN </strong></p>
                                                            <p><strong>OCUPACIÓN </strong></p>
                                                            <p><strong>RUBRO DE LA EMPRESA </strong></p>
                                                            <p><strong>ACTIVIDAD FÍSICA</strong></p>
                                                        </small>
                                                    </small>
                                                </div>
                                                <div class="col-sm-3 mb-3">
                                                    <small>
                                                        <small>
                                                            <p> <?php echo $result[2][0]['esado_civil'] ?></p>
                                                            <p> <?php echo $result[2][0]['religion'] ?></p>
                                                            <p> <?php echo $result[2][0]['habitacion'] ?></p>
                                                            <p> <?php echo $result[2][0]['ocupacion'] ?></p>
                                                            <p>
                                                                <?php
                                                                if ($result[2][0]['actividad_empresa'] == "n/a") {
                                                                    echo "...";
                                                                } else {
                                                                    echo $result[2][0]['actividad_empresa'];
                                                                }
                                                                ?>
                                                            </p>
                                                            <p> <?php echo $result[2][0]['actividad_fisica'] ?></p>
                                                        </small>
                                                    </small>
                                                </div>
                                                <div class="col-sm-3">
                                                    <small>
                                                        <small>
                                                            <p><strong>ESCOLARIDAD </strong></p>
                                                            <p><strong>ALIMENTACIÓN (Diaria) </strong></p>
                                                            <p><strong>HIGIENE PERSONAL </strong></p>
                                                            <p><strong>TIEMPO EN LA OCUPACIÓN (Diario) </strong></p>
                                                            <p><strong>FACTORES DE RIESGO LABORAL </strong></p>
                                                        </small>
                                                    </small>
                                                </div>
                                                <div class="col-sm-3">
                                                    <small>
                                                        <small>
                                                            <p><?php echo $result[2][0]['escolaridad'] ?></p>
                                                            <p><?php echo $result[2][0]['alimentacion'] ?></p>
                                                            <p><?php echo $result[2][0]['higiene_personal'] ?></p>
                                                            <p>
                                                                <?php
                                                                if ($result[2][0]['tiempo_ocupacion'] == "n/a") {
                                                                    echo "...";
                                                                } else {
                                                                    echo $result[2][0]['tiempo_ocupacion'];
                                                                }
                                                                ?>
                                                            </p>
                                                            <p>
                                                                <?php
                                                                if ($result[2][0]['factores_riesgo_laboral'] == "n/a") {
                                                                    echo "...";
                                                                } else {
                                                                    echo $result[2][0]['factores_riesgo_laboral'];
                                                                }
                                                                ?>
                                                            </p>
                                                        </small>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <!-- personales patológicos -->
                                        <div class="row">
                                            <p> <strong> </strong></p>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p> <small><strong>PERSONALES PATOLÓGICOS: </strong></small></p>
                                                </div>
                                                <div class="col-sm-3 mb-3">
                                                    <small>
                                                        <p> <?php echo $result[2][0]['patologias'] ?></p>
                                                    </small>
                                                </div>
                                                <div class="col-sm-3">
                                                </div>
                                                <div class="col-sm-3">
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>

                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <!--  -->
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <!-- GINECOBSTETRICOS -->
                                        <div class="row">
                                            <p> <strong>GINECOBSTETRICOS: </strong></p>
                                            <div class="row">

                                                <div class="col-sm-3">
                                                    <small>
                                                        <small>
                                                            <p><strong>MENARCA </strong></p>
                                                            <p><strong>INICIO VIDA SEXUAL </strong></p>
                                                            <p><strong>FECHA ÚLTIMA MENSTRUACIÓN </strong></p>
                                                            <p><strong>NÚMERO DE HIJOS </strong></p>
                                                            <p><strong>BAJO PESO AL NACER</strong></p>
                                                            <p><strong>NÚMERO DE PAREJAS</strong></p>
                                                            <p><strong>HOMOSEXUALES</strong></p>
                                                        </small>
                                                    </small>
                                                </div>
                                                <div class="col-sm-3 mb-3">
                                                    <small>
                                                        <small>
                                                            <p> <?php echo $result[2][0]['menarca'] ?></p>
                                                            <p> <?php echo $result[2][0]['inicio_vida_sexual'] ?></p>
                                                            <p>
                                                                <?php
                                                                if ($fecha_mestruacion == "00-00-0000") {
                                                                    echo "...";
                                                                } else {
                                                                    echo $fecha_mestruacion;
                                                                }
                                                                ?>
                                                            </p>
                                                            <p> <?php echo $result[2][0]['num_hijos'] ?></p>
                                                            <p>
                                                                <?php
                                                                if ($result[2][0]['bajo_peso_nacer'] == "n/a") {
                                                                    echo "...";
                                                                } else {
                                                                    echo $result[2][0]['bajo_peso_nacer'];
                                                                }
                                                                ?>
                                                            </p>
                                                            <p> <?php echo $result[2][0]['num_parejas'] ?></p>
                                                            <p> <?php echo $result[2][0]['num_homosexuales'] ?></p>
                                                        </small>
                                                    </small>
                                                </div>
                                                <div class="col-sm-3">
                                                    <small>
                                                        <small>
                                                            <p><strong>NÚMERO DE EMBARAZOS </strong></p>
                                                            <p><strong>PARTOS </strong></p>
                                                            <p><strong>FECHA ÚLTIMO PARTO</strong></p>
                                                            <p><strong>MACROSÓMICOS VIVOS</strong></p>
                                                            <p><strong>HETEROSEXUALES</strong></p>
                                                            <p><strong>BISEXUALES </strong></p>
                                                        </small>
                                                    </small>
                                                </div>
                                                <div class="col-sm-3">
                                                    <small>
                                                        <small>
                                                            <p><?php echo $result[2][0]['num_embarazos'] ?></p>
                                                            <p><?php echo $result[2][0]['num_partos'] ?></p>
                                                            <p>
                                                                <?php
                                                                if ($fecha_embarazo == "00-00-0000") {
                                                                    echo "...";
                                                                } else {
                                                                    echo $fecha_embarazo;
                                                                }
                                                                ?>
                                                            </p>
                                                            <p><?php echo $result[2][0]['macrosomicos_vivos'] ?></p>
                                                            <p><?php echo $result[2][0]['num_heteros'] ?></p>
                                                            <p><?php echo $result[2][0]['num_bisexuales'] ?></p>
                                                        </small>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <!-- MÉTODOS DE PLANIFICACIÓN FAMILIAR -->
                                        <div class="row">
                                            <p> <strong> </strong></p>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <small>
                                                        <p> <strong>MÉTODOS DE PLANIFICACIÓN FAMILIAR: </strong></p>
                                                    </small>
                                                </div>
                                                <div class="col-sm-6 mb-3">
                                                    <small>
                                                        <p>
                                                            <?php
                                                            if ($result[2][0]['metodo_planificacion_familiar'] == "n/a") {
                                                                echo "...";
                                                            } else {
                                                                echo $result[2][0]['metodo_planificacion_familiar'];
                                                            }
                                                            ?>
                                                        </p>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <!-- PADECIMIENTO ACTUAL -->
                                        <div class="row">
                                            <p> <strong> </strong></p>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p>
                                                        <small>
                                                            <h6> <strong>PADECIMIENTO ACTUAL: </strong>
                                                            </h6>
                                                        </small>
                                                    </p>
                                                </div>
                                                <div class="col-sm-6 mb-3">
                                                    <p id="padecimiento_v">
                                                        <small>
                                                            <h6> <?php echo $result[2][0]['padecimiento_actual'] ?></h6>
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <!-- APARATOS Y SISTEMAS -->
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p>
                                                        <small>
                                                            <h6> <strong>APARATOS Y SISTEMAS: </strong></h6>
                                                        </small>
                                                    </p>
                                                </div>
                                                <div class="col-sm-6 mb-3">

                                                    <p id="aparatos_v">
                                                        <small>
                                                            <h6><?php echo $result[2][0]['aparatos_sistemas'] ?></h6>
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <!-- AUXILIARES DE DIAGNÓSTICO PREVIO -->
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p>
                                                        <small>
                                                            <h6> <strong>AUXILIARES DE DIAGNÓSTICO PREVIO: </strong></h6>
                                                        </small>
                                                    </p>

                                                </div>
                                                <div class="col-sm-6 mb-3">

                                                    <p id="aux_diag_previo_v">
                                                        <small>
                                                            <h6><?php echo $result[2][0]['auxiliares_diagnostico_previo'] ?></h6>
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <hr class="m-0">
                                    </h6>
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