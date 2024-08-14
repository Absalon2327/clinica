<?php
date_default_timezone_set('America/El_Salvador');
$fecha = "";
$fecha = date("Y-m-d");
$expediente = $_GET['idexpe'];
?>
<!DOCTYPE html>
<?php
require_once('../../Menus/bloqueo_pantalla.php'); ?>
<html lang="es" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
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
                        <form method="POST" id="fr_registrar_consulta" name="fr_registrar_consulta">
                            <input type="hidden" id="idexpediente" name="idexpediente" value="<?php echo $expediente ?>">
                            <input type="hidden" id="almacenar_datos" name="almacenar_datos" value="nueva_consulta">
                            <input type="hidden" id="idexpe_preparado" name="idexpe_preparado">  

                            <div class="row">
                                <div class="col-xxl">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h3 class="card-title" id="nombre_paciente_c">...</h3>
                                            <h6 id="num_expediente_c">...</h6>
                                            <h6 id="edad_paciente_c">...</h6>
                                            <h6 id="sexo_paciente_c">...</h6>
                                        </div>
                                        <hr class="m-0">
                                        <!-- DATOS DE PREPARACIÓN -->

                                        <div class="card-body">
                                            <div class="col-12">
                                                <div class="row mb-3">
                                                    <div class="col-sm-6">
                                                        <h6 class="mb-0">
                                                            <strong>DATOS PREVIOS: </strong>
                                                        </h6>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-6">
                                                        <label class="col-sm-4 col-form-label">Presion Arterial</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class='bx bx-pulse'></i></span>
                                                            <input type="text" class="form-control" id="presion_a_c" name="presion_a_c" placeholder="..." readonly />
                                                        </div>
                                                        <label class="col-form-label">Peso</label>
                                                        <div class="col-sm-4 input-group  input-group-merge">
                                                            <span class="input-group-text"><i class='bx bx-body'></i></span>
                                                            <input type="text" class="form-control" id="peso_c" name="peso_c" placeholder="..." readonly />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-sm-2 col-form-label">Altura</label>
                                                        <div class="col-sm-4 input-group input-group-merge">
                                                            <span class="input-group-text"><i class='bx bx-ruler'></i></span>
                                                            <input type="text" class="form-control" id="altura_ac" name="altura_ac" placeholder="..." readonly />
                                                        </div>
                                                        <label class="col-sm-2 col-form-label">Temperatura</label>
                                                        <div class="col-sm-4 input-group  input-group-merge">
                                                            <span class="input-group-text"><i class='bx bxs-thermometer'></i></span>
                                                            <input type="text" class="form-control" id="temperatura_c" name="temperatura_c" placeholder="..." readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- DIAGNÓSTICO  -->
                            <div class="row">
                                <div class="col-xxl">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row mb-3 ">
                                                <div class="col-sm-4">
                                                    <small class="mb-0">
                                                        <strong>DIAGNÓSTICO:</strong>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <textarea id="diagnostico_consulta" name="diagnostico_consulta" class="form-control" placeholder="Describa el diagnóstico actual del paciente"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MEDICAMENTO RECETADO -->
                            <div class="row">
                                <div class="col-xxl">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <div class="row mb-3">
                                                    <div class="col-sm-6">
                                                        <h6 class="mb-0">
                                                            <strong>RECETA: </strong>
                                                        </h6>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-2">
                                                        <small class="mb-2">
                                                            DESCRIPCIÓN
                                                        </small>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <textarea id="receta_consulta" name="receta_consulta" class="form-control" placeholder="Describa el medicamento aplicado..."></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MONTO DE LA CONSULTA -->
                            <div class="row">
                            <div class="col-xxl">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row mb-3 ">
                                                <div class="col-sm-4">
                                                    <small class="mb-0">
                                                        <strong>MONTO $:</strong>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <input type="number" min="0" id="monto_consulta" name="monto_consulta" class="form-control" placeholder="$00.00"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- BOTONES DE CONTROL -->
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <a href="index.php" class="btn btn-info">
                                        <i class="tf-icons bx bx-left-arrow-circle"></i>Volver
                                    </a>
                                </div>
                                <div class="col-sm-6 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="tf-icons bx bx-check"></i>Finalizar
                                    </button>
                                    <button type="reset" class="btn btn-secondary">
                                        <i class="tf-icons bx bx-trash"></i>Limpiar
                                    </button>
                                </div>

                            </div>
                        </form>
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
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>


    <?php
    require_once('../../Footers/footer_scripst.php');
    ?>

    <script src="../../Scripts/nueva_consulta_funciones.js"></script>
</body>

</html>