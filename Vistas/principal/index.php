<?php
@session_start();
date_default_timezone_set('America/El_Salvador');

if (isset($_SESSION['logueado']) && $_SESSION['logueado'] == "si") {
    if ($_SESSION['bloquear_pantalla'] == "no") {
        // code...

    } else {

        header("Location: ../usuarios/v_bloquear_pantalla.php");
    }
} else {
    header("Location: ../../index.php");
}
?>
<!DOCTYPE html>

<html lang="es" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <?php
    require_once('../../Headers/headers.php');
    ?>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php
            require_once('../../Menus/layout_meu.php');
            ?>

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php
                require_once('../../Menus/menu_bar.php');
                ?>
                <div class="content-page">
                    <div class="content">
                        <div class="page-content-wrapper">
                            <div class="container-xxl flex-grow-1 container-p-y">

                                <div class="card">
                                    <div class="row">

                                        <div class="col-lg-3 col-md-12 col-3 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="../../assets/img/icons/unicons/paciente.png" alt="Credit Card" class="rounded" />
                                                        </div>

                                                    </div>
                                                    <span class="fw-semibold d-block mb-1">Pacientes</span>
                                                    <h3 class="card-title text-nowrap mb-1" id="cantidad_Pacientes">$4</h3>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12 col-3 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="../../assets/img/icons/unicons/consulta.png" alt="Credit Card" class="rounded" />
                                                        </div>

                                                    </div>
                                                    <span>Consultas</span>
                                                    <h3 class="card-title text-nowrap mb-1" id="cantidad_consultas">$4</h3>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-12 col-3 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="../../assets/img/icons/unicons/cita_m.png" alt="chart success" class="rounded" />
                                                        </div>

                                                    </div>
                                                    <span class="fw-semibold d-block mb-1">Citas</span>

                                                    <h3 class="card-title text-nowrap mb-1" id="cantidad_citas">$4</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12 col-3 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="../../assets/img/icons/unicons/usercolor.png" alt="chart success" class="rounded" />
                                                        </div>

                                                    </div>
                                                    <span>Usuarios</span>

                                                    <h3 class="card-title text-nowrap mb-1" id="cantidad_usuarios">$4</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- Row -->
                                    <div class="card-header">
                                        <h3>Citas programadas</h3>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card m-b-20">
                                                    <div class="card-body" id="datos_tabla">

                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div>

                                </div>
                                <?php
                                require_once('../../Footers/footer.php');
                                ?>
                            </div> <!-- Content wrapper -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php
    require_once('../../Footers/footer_scripst.php');
    ?>

    <script type="text/javascript">
        //activamos el boton del menu lateral 
        document.getElementById('menu_inicio').classList.add('active');
    </script>
    <script src="../../Scripts/principal.js"></script>
</body>

</html>