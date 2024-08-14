<!DOCTYPE html>
<?php
require_once('../../Menus/bloqueo_pantalla.php'); ?>
<html lang="es" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Consultas | Pagos</title>
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
                                    <h3>Consultas pendiente de Facturar</h3>
                                </div>
                                <div class="nav-align-top mb-4">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-pendientes" aria-controls="navs-top-pendientes" aria-selected="true">
                                                Pendientes de Pagar
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-pagadas" aria-controls="navs-top-pagadas" aria-selected="false">
                                                Pagadas
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="navs-top-pendientes" role="tabpanel">
                                            <div class="table-responsive text-nowrap">
                                                <div class="card-body" id="tabla_consultas_pendientes">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="navs-top-pagadas" role="tabpanel">
                                            <div class="table-responsive text-nowrap">
                                                <div class="card-body" id="tabla_consultas_pagadas">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / Content -->

                        <!-- MODAL DE LA FACTURA O RECETA -->
                        <div class="modal fade" id="md_pago_consulta" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <form method="POST" id="fr_registrar_pago" name="fr_registrar_pago">
                                        <input type="hidden" id="almacenar_datos" name="almacenar_datos" value="nuevo_pago">
                                        <input type="hidden" id="idconsulta" name="idconsulta">
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
                                                        <strong>
                                                            CONSULTA
                                                        </strong>
                                                    </h6>
                                                </strong>

                                            </h5>
                                            <img class="col-sm-4" src="./../../assets/img/favicon/img_repo.jpg" alt="" style="width: 110px; height: 110px;">
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-sm-3">
                                                PACIENTE: <strong id="nombre_paciente_pago">...</strong><br>
                                            </div>
                                            <div class="col-sm-3">
                                                EDAD: <strong id="edad_paciente_pago">...</strong><br>
                                            </div>
                                            <div class="col-sm-3">
                                                FECHA: <strong id="fecha_consulta_pago">...</strong><br>
                                            </div>
                                            <div class="col-sm-3">
                                                HORA: <strong id="hora_consulta_pago">...</strong><br>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="modal-body">

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
                                                        <p id="medicamento_recetado_pago"> ...</p>
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
                                                <div class="row">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-3">
                                                        <p> <strong>MONTO: </strong></p>
                                                    </div>
                                                    <div class="col-sm-3 mb-3">
                                                        <p id="monto_consulta_pago"> ...</p>
                                                        <input type="hidden" id="monto_consulta_pago_g" name="monto_consulta_pago_g">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  -->
                                            <div class="row">
                                                <div class="col-sm-6"></div>
                                                <div class="col-sm-6">
                                                    <hr class="m-0">
                                                    <hr class="m-0">
                                                    <hr class="m-0">
                                                </div>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                Cerrar
                                            </button>
                                            <button type="submit" class="btn btn-primary">Pagar<i class="tf-icons bx bx-money"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL DE PAGOS -->
                        <div class="modal fade" id="md_pagos" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <!-- <form method="POST" id="fr_registrar_pago" name="fr_registrar_pago">   -->
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
                                                    <strong>
                                                        CONSULTA
                                                    </strong>
                                                </h6>
                                            </strong>

                                        </h5>
                                        <img class="col-sm-4" src="./../../assets/img/favicon/img_repo.jpg" alt="" style="width: 110px; height: 110px;">
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-sm-3">
                                            PACIENTE: <strong id="nombre_paciente_pagado">...</strong><br>
                                        </div>
                                        <div class="col-sm-3">
                                            EDAD: <strong id="edad_paciente_pagado">...</strong><br>
                                        </div>
                                        <div class="col-sm-3">
                                            FECHA: <strong id="fecha_consulta_pagado">...</strong><br>
                                        </div>
                                        <div class="col-sm-3">
                                            HORA: <strong id="hora_consulta_pagado">...</strong><br>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="modal-body">

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
                                                    <p id="medicamento_recetado_pagado"> ...</p>
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
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-3">
                                                    <p> <strong>MONTO: </strong></p>
                                                </div>
                                                <div class="col-sm-3 mb-3">
                                                    <p id="monto_consulta_pagado"> ...</p>
                                                    <!-- <input type="hidden" id="monto_consulta_pagado_g" name="monto_consulta_pago_g"> -->
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="row">
                                            <div class="col-sm-6"></div>
                                            <div class="col-sm-6">
                                                <hr class="m-0">
                                                <hr class="m-0">
                                                <hr class="m-0">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Cerrar
                                        </button>
                                        <button type="button" class="btn btn-success btn_imprimir">Imprimir<i class="tf-icons bx bx-printer"></i></button>
                                    </div>
                                    <!-- </form> -->
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

    <script src="../../Scripts/pagos_consultas_funciones.js"></script>
</body>

</html>