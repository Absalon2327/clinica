<!DOCTYPE html>
<?php
require_once('../../Menus/bloqueo_pantalla.php'); ?>
<html lang="es" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Expedientes | Registro</title>
    <meta name="description" content="" />


    <?php
    require_once('../../Headers/headers.php');
    ?>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php
            require_once('../../Menus/layout_meu.php');
            ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->


                <?php
                require_once('../../Menus/menu_bar.php');
                ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">


                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Bootstrap Table with Header - Light -->
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <h3>Expedientes</h3>
                                </div>
                                <div class="nav-align-top mb-4">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-adultos" aria-controls="navs-top-adultos" aria-selected="true">
                                                Adultos
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-ninios" aria-controls="navs-top-ninios" aria-selected="false">
                                                Niños
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link bnt-primary">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" checked="true" name="estado_expedientes" id="expe_activo" value="option1" />
                                                    <label class="form-check-label" for="expe_activo">Activos</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="estado_expedientes" id="expe_inactivo" value="option2" />
                                                    <label class="form-check-label" for="expe_inactivo">Inactivos</label>
                                                </div>
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link bnt-primary btn" id="btn_select_paciente" style="background: #696CFF; color: #fff;">Nuevo Expediente
                                                <i class="tf-icons bx bx-plus"></i>
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="navs-top-adultos" role="tabpanel">
                                            <div class="table-responsive text-nowrap">
                                                <div class="card-body" id="expedientes_adultos">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="navs-top-ninios" role="tabpanel">
                                            <div class="table-responsive text-nowrap">
                                                <div class="card-body" id="expedientes_niños">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / Content -->


                        <!-- Footer -->
                        <?php
                        require_once('../../Footers/footer.php');
                        ?>
                        <!-- / Footer -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->

                    <!-- MODAL PARA SELEECIONAR EL PACIENTE -->
                    <div class="modal fade" id="seleccionar_paciente" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel4">Seleccione el Paciente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <hr class="m-0">
                                <div class="modal-body">
                                    <div class="nav-align-top mb-4">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-adultos_pacientes" aria-controls="navs-top-adultos_pacientes" aria-selected="true">
                                                    Adultos
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-ninios_pacientes" aria-controls="navs-top-ninios_pacientes" aria-selected="false">
                                                    Niños
                                                </button>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="navs-top-adultos_pacientes" role="tabpanel">
                                                <div class="table-responsive text-nowrap" id="tabla_paciente_anadir_ad">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="navs-top-ninios_pacientes" role="tabpanel">
                                                <div class="table-responsive text-nowrap" id="tabla_paciente_anadir_ninios">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="m-0">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL PARA VER EXPEDIENTE -->
                    <div class="modal fade" id="ver_expediente" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <img class="col-sm-4" src="./../../assets/img/favicon/img_repo.jpg" alt="" style="width: 110px; height: 110px;">
                                    <h5 class="modal-title text-center col-sm-4" id="modalFullTitle">
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
                                                EXPEDIENTE N° <strong id="num_expediente">1</strong>
                                               <input type="hidden" id="idexpedient" name="idexpedient">
                                            </h6>
                                        </strong>

                                    </h5>
                                    <img class="col-sm-4" src="./../../assets/img/favicon/img_repo.jpg" alt="" style="width: 110px; height: 110px;">
                                </div>
                                <div class="row text-center">
                                    <div class="col-sm-4">
                                        PACIENTE: <strong id="nombre_paciente_v">...</strong><br>
                                    </div>
                                    <div class="col-sm-4">
                                        EDAD: <strong id="edad_paciente_v">...</strong><br>
                                    </div>
                                    <div class="col-sm-4">
                                        SEXO: <strong id="sexo_paciente_v">...</strong><br>
                                    </div>
                                </div>
                                <br>
                                <hr class="m-0">
                                <hr class="m-0">
                                <hr class="m-0">
                                <div class="modal-body">

                                    <!-- hereditarios y familiares -->
                                    <!-- tipo de familia -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p> <strong>HEREDITARIOS Y FAMILIARES: </strong></p>
                                                </div>
                                                <div class="col-sm-2 mb-3">
                                                </div>
                                                <div class="col-sm-4">
                                                    <p><strong><small>PARENTEZCO</small></strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <small>
                                                        <p><strong>DIABETES MELLITUS </strong></p>
                                                        <p><strong>HIPERTENIÓN ARTERIAL </strong></p>
                                                        <p><strong>CARDIOPATÍA ISQUÉMICA </strong></p>
                                                        <p><strong>CANCER </strong></p>
                                                        <p><strong>OTROS </strong></p>
                                                    </small>
                                                </div>
                                                <div class="col-sm-2 mb-3">
                                                    <small>
                                                        <p id="diabetes_v"> ...</p>
                                                        <p id="hipertension_v"> ...</p>
                                                        <p id="cardiopatia_v"> ...</p>
                                                        <p id="cancer_v"> ...</p>
                                                        <p id="otro_hereditario_v"> ...</p>
                                                    </small>
                                                </div>
                                                <div class="col-sm-4">
                                                    <small>
                                                        <p id="p_diabetes_v">...</p>
                                                        <p id="p_hipertension_v">...</p>
                                                        <p id="p_cardiopatia_v">...</p>
                                                        <p id="p_cancer_v">...</p>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <small>
                                                        <p><strong>TIPO DE FAMILIA: </strong></p>
                                                        <p><strong>ROL DE LA MADRE: </strong></p>
                                                        <p><strong>FAMILIAR RESPOSABLE DEL PACIENTE: </strong></p>
                                                        <p><strong>FAMILIA: </strong></p>
                                                        <p><strong>DISFUNCIONES FAMILIARES: </strong></p>
                                                    </small>
                                                </div>
                                                <div class="col-sm-6 mb-3">
                                                    <small>
                                                        <p id="tipo_familia_v">...</p>
                                                        <p id="rol_madre_v">...</p>
                                                        <p id="responsable_v">...</p>
                                                        <p id="Familia"> ... </p>
                                                        <p id="dis_fam_v">...</p>
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
                                        <p> <strong>PERSONALES NO PATOLÓGICOS: </strong></p>
                                        <div class="row">

                                            <div class="col-sm-3">
                                                <small>
                                                    <p> <strong>ESTADO CIVIL </strong></p>
                                                    <p><strong>RELIGIÓN </strong></p>
                                                    <p><strong>HABITACIÓN </strong></p>
                                                    <p><strong>OCUPACIÓN </strong></p>
                                                    <p><strong>RUBRO DE LA EMPRESA </strong></p>
                                                    <p><strong>ACTIVIDAD FÍSICA</strong></p>
                                                </small>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <small>
                                                    <p id="estado_civil_v"> ...</p>
                                                    <p id="religion_v"> ...</p>
                                                    <p id="habitacion_v"> ...</p>
                                                    <p id="ocupacion_v"> ...</p>
                                                    <p id="rubro_empresa_v"> ...</p>
                                                    <p id="actividad_fisica_v"> ...</p>
                                                </small>
                                            </div>
                                            <div class="col-sm-3">
                                                <small>
                                                    <p><strong>ESCOLARIDAD </strong></p>
                                                    <p><strong>ALIMENTACIÓN (Diaria) </strong></p>
                                                    <p><strong>HIGIENE PERSONAL </strong></p>
                                                    <p><strong>TIEMPO EN LA OCUPACIÓN (Diario) </strong></p>
                                                    <p><strong>FACTORES DE RIESGO LABORAL </strong></p>
                                                </small>
                                            </div>
                                            <div class="col-sm-3">
                                                <small>
                                                    <p id="escolaridad_v">...</p>
                                                    <p id="alimentacion_v">...</p>
                                                    <p id="higiene_v">...</p>
                                                    <p id="tiempo_ocupacion_v">...</p>
                                                    <p id="fact_riesgo_labo_v">...</p>
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
                                                <p> <strong>PERSONALES PATOLÓGICOS: </strong></p>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <p id="patologicos_v"> ...</p>
                                            </div>
                                            <div class="col-sm-3">
                                            </div>
                                            <div class="col-sm-3">
                                            </div>
                                        </div>
                                    </div>
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
                                                    <p><strong>MENARCA </strong></p>
                                                    <p><strong>INICIO VIDA SEXUAL </strong></p>
                                                    <p><strong>FECHA ÚLTIMA MENSTRUACIÓN </strong></p>
                                                    <p><strong>NÚMERO DE HIJOS </strong></p>
                                                    <p><strong>BAJO PESO AL NACER</strong></p>
                                                    <p><strong>NÚMERO DE PAREJAS</strong></p>
                                                    <p><strong>HOMOSEXUALES</strong></p>
                                                </small>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <small>
                                                    <p id="menarca_v"> ...</p>
                                                    <p id="in_vida_sex_v"> ...</p>
                                                    <p id="fech_ult_menst_v"> ...</p>
                                                    <p id="num_hijos_v"> ...</p>
                                                    <p id="bajo_peso_v"> ...</p>
                                                    <p id="num_parejas_v"> ...</p>
                                                    <p id="num_homo_v"> ...</p>
                                                </small>
                                            </div>
                                            <div class="col-sm-3">
                                                <small>
                                                    <p><strong>NÚMERO DE EMBARAZOS </strong></p>
                                                    <p><strong>PARTOS </strong></p>
                                                    <p><strong>FECHA ÚLTIMO PARTO</strong></p>
                                                    <p><strong>MACROSÓMICOS VIVOS</strong></p>
                                                    <p><strong>HETEROSEXUALES</strong></p>
                                                    <p><strong>BISEXUALES </strong></p>
                                                </small>
                                            </div>
                                            <div class="col-sm-3">
                                                <small>
                                                    <p id="num_embarazos_v">...</p>
                                                    <p id="num_partos_v">...</p>
                                                    <p id="fech_ult_part_v">...</p>
                                                    <p id="macros_v">...</p>
                                                    <p id="num_hete_v">...</p>
                                                    <p id="num_bis_v">...</p>
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
                                                <p> <strong>MÉTODOS DE PLANIFICACIÓN FAMILIAR: </strong></p>
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <p id="metodo_pf_v"> ...</p>
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
                                                <p> <strong>PADECIMIENTO ACTUAL: </strong></p>
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <p id="padecimiento_v"> ...</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <hr class="m-0">
                                    <hr class="m-0">
                                    <hr class="m-0">
                                    <!-- APARATOS Y SISTEMAS -->
                                    <div class="row">
                                        <p> <strong> </strong></p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p> <strong>APARATOS Y SISTEMAS: </strong></p>
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <p id="aparatos_v"> ...</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <hr class="m-0">
                                    <hr class="m-0">
                                    <hr class="m-0">
                                    <!-- AUXILIARES DE DIAGNÓSTICO PREVIO -->
                                    <div class="row">
                                        <p> <strong> </strong></p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p> <strong>AUXILIARES DE DIAGNÓSTICO PREVIO: </strong></p>
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <p id="aux_diag_previo_v"> ...</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <hr class="m-0">
                                    <hr class="m-0">
                                    <hr class="m-0">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        Cerrar
                                    </button>
                                    <button type="button" class="btn btn-success btn_imprimir">Imprimir<i class="tf-icons bx bx-printer"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL PARA PREPARAR -->
                    <div class="modal fade" id="md_preparar" tabindex="-1" aria-hidden="true" style="background: static;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h5 class="modal-title"><span id="titulo">Preparar paciente</span></h5>
                                    <div class="modal-header">
                                        <button type="button" class="btn-close btn_cerrar_up_p" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-sm-3">
                                            Expediente N°: <strong id="num_expe_p">...</strong><br>
                                        </div>
                                        <div class="col-sm-3">
                                            PACIENTE: <strong id="nombre_paciente_p">...</strong><br>
                                        </div>
                                        <div class="col-sm-3">
                                            EDAD: <strong id="edad_paciente_p">...</strong><br>
                                        </div>
                                        <div class="col-sm-3">
                                            SEXO: <strong id="sexo_paciente_p">...</strong><br>
                                        </div>
                                    </div>

                                    <hr style="background: slategrey;">

                                    <form method="POST" name="form_preparar" id="form_preparar">
                                        <input type="hidden" name="idexpediente" id="idexpediente">                                        
                                        <input type="hidden" name="idpaciente" id="idpaciente">
                                        <input type="hidden" name="preparar_paciente" id="preparar_paciente" value="si_preparalo">

                                        <div class="row g-2">
                                            <div class="col mb-0">
                                                <label for="presion_p">Presión arterial</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="presion_p" name="presion_p" class="form-control" oninput="validarprecion()" autocomplete="off" onkeypress="return soloNumeros(event)" placeholder="120/80" maxlength="7" required />
                                                </div>
                                            </div>

                                            <div class="col mb-0">
                                                <label for="temperatura_p">Temperatura</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="temperatura_p" name="temperatura_p" onclick="validartempbegi()" onblur="validartempend()" autocomplete="off" class="form-control" onkeypress="return soloNumeros(event)" placeholder="37° C" maxlength="7" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="col mb-0">
                                                <label for="altura_p">Altura</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="altura_p" name="altura_p" onclick="validaraltbegi()" onblur="validaraltend()" autocomplete="off" class="form-control" onkeypress="return soloNumeros(event)" placeholder="1.80mt" maxlength="8" required />
                                                </div>
                                            </div>

                                            <div class="col mb-0">
                                                <label for="peso_p">Peso</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="peso_p" name="peso_p" onclick="validarpesobegi()" onblur="validarpesoend()" autocomplete="off" class="form-control" onkeypress="return soloNumeros(event)" placeholder="90Kg" maxlength="5" required />
                                                </div>
                                            </div>
                                        </div>

                                        <hr style="background: slategrey;">

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary btn_cerrar_p" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar datos</button>
                                        </div>


                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

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
    <script src="../../Scripts/expediente_funciones.js"></script>

</body>

</html>