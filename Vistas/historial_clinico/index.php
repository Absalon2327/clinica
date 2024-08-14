<?php
@session_start();
?>
<!DOCTYPE html>
<?php
require_once('../../Menus/bloqueo_pantalla.php'); ?>
<html lang="es" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Historial | Registro</title>
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
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Bootstrap Table with Header - Light -->
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <h3>Historial Clínico</h3>
                                </div>
                                <div class="nav-align-top mb-4">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-adultos_hc" aria-controls="navs-adultos_hc" aria-selected="true">
                                                Adultos
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-niños_hc" aria-controls="navs-niños_hc" aria-selected="false">
                                                Niños
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="navs-adultos_hc" role="tabpanel">
                                            <div class="table-responsive text-nowrap">
                                                <div class="card-body" id="tabla_adultos_hc">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="navs-niños_hc" role="tabpanel">
                                            <div class="table-responsive text-nowrap">
                                                <div class="card-body" id="tabla_niños_hc">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / Content -->

                        <!-- MODAL DE REGISTROS -->
                        <div class="modal fade" id="ver_historial" tabindex="-1" aria-hidden="true">
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
                                                    EXPEDIENTE N° <strong id="num_expediente_hc">1</strong>
                                                </h6>
                                            </strong>

                                        </h5>
                                        <img class="col-sm-4" src="./../../assets/img/favicon/img_repo.jpg" alt="" style="width: 110px; height: 110px;">
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-sm-3">
                                            PACIENTE: <strong id="nombre_paciente_hc">...</strong><br>
                                        </div>
                                        <div class="col-sm-3">
                                            EDAD: <strong id="edad_paciente_hc">...</strong><br>
                                        </div>
                                        <div class="col-sm-3">
                                            SEXO: <strong id="sexo_paciente_hc">...</strong><br>
                                        </div>
                                        <div class="col-sm-3">
                                            ENCARGADO: <strong id="encargado_hc">...</strong><br>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="modal-body">

                                        <!--  -->
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <hr class="m-0">
                                        <!-- TABLA -->
                                        <div class="table-responsive text-nowrap">
                                            <div class="card-body" id="tabla_registros_hc">
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
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <?php
                        require_once('../../Footers/footer.php');
                        ?>
                        <!-- / Footer -->

                        <div class="content-backdrop fade"></div>
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

    <script src="../../Scripts/historial_clinico_funciones.js"></script>

</body>

</html>