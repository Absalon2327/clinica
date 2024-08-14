<?php
@session_start();
?>
<!DOCTYPE html>
<html lang="es" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Reportes</title>
    <link rel="stylesheet" href="./../../assets/css/estiloV.css">
    <?php require_once('../../Headers/headers.php'); ?>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php require_once('../../Menus/layout_meu.php'); ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php require_once('../../Menus/menu_bar.php'); ?>
                <!-- / Navbar -->

                <!-- Extra Large Modal -->
                <div class="modal fade" id="visualizador" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close btn_cerrar_up" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div id="objeto">

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Bootstrap Table with Header - Light -->

                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">

                                    <div class="col-lg-7">
                                        <div class="list-group">
                                            <div class="row g-2">
                                                <div class="col-2 mb-0">
                                                    <h3>Reportes</h3>
                                                </div>

                                                <div class="col mb-0">
                                                    <select id="reportes" name="reportes" class="form-select">
                                                        <option value="">Seleccione reporte</option>
                                                        <option value="./citas_pendientes.php">Citas Pendientes</option>
                                                        <option value="./pacientes_mayores.php">Pacientes Mayores</option>
                                                        <option value="./pacientes_menores.php">Pacientes Menores</option>
                                                    </select>
                                                </div>

                                                <div class="col mb-0">
                                                    <button class="btn btn-primary" onclick="reportes_ready()">Generar
                                                        <i class="menu-icon tf-icons bx bxs-report"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="nav-align-top mb-4">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" role="tabpanel">
                                            <div class="table-responsive-tiny text-nowrap">
                                                <div id="tablaDocumentos"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- / Content -->

                        <!-- Footer -->
                        <?php require_once('../../Footers/footer.php'); ?>
                        <!-- / Footer -->
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

        </div>

        <?php require_once('../../Footers/footer_scripst.php'); ?>

        <script src="../../Scripts/reporte_funciones.js"></script>
</body>

</html>