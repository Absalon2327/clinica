<?php
@session_start();
?>
<!DOCTYPE html>
<html lang="es" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Respaldo | Restauración</title>

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

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Bootstrap Table with Header - Light -->

                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <h3>Respaldo y restauración</h3>
                                </div>

                                <div class="nav-align-top mb-4">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" onclick="crearcopia()" style="background: #696CFF; color: #fff;">Nueva Copia de Seguridad
                                                <i class="tf-icons bx bx-message-add"></i>
                                            </button>
                                        </li>
                                    </ul>

                                    <input type="hidden" id="tabla" name="tabla">

                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" role="tabpanel">
                                            <div class="table-responsive-tiny text-nowrap">
                                                <div id="tablaRespaldo"></div>
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

        <script src="../../Scripts/respaldo_funciones.js"></script>
</body>

</html>