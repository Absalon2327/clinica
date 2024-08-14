<?php
@session_start();
date_default_timezone_set('America/El_Salvador');
$fecha = "";
$fecha = date("Y-m-d") ?>
<!DOCTYPE html>
<?php
require_once('../../Menus/bloqueo_pantalla.php');
?>
<html lang="es" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<title>Pacientes | Registro</title>

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
                <div class="content-page">
                    <div class="content">
                        <div class="page-content-wrapper">
                            <!-- Content -->
                            <div class="container-xxl flex-grow-1 container-p-y">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card card-primary card-tabs">
                                            <div class="card-header p-0 pt-2">
                                                <div class="row">
                                                    <div class="col-xl-14">
                                                        <h6 class="text-muted">Pacientes</h6>
                                                        <div class="nav-align-top mb-4">
                                                            <ul class="nav nav-tabs" role="tablist">
                                                                <li class="nav-item">
                                                                    <button type="button" class="nav-link active" role="tab" id="btn_activa" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                                                                        Adultos
                                                                    </button>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <button type="button" class="nav-link" role="tab" id="btn_activa" data-bs-toggle="tab" data-bs-target="#navs-top-profile_ni" aria-controls="navs-top-profile_ni" aria-selected="false">
                                                                        Niños
                                                                    </button>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <button type="button" class="nav-link" role="tab" id="btn_inactiva" data-bs-toggle="tab" data-bs-target="#navs-top-profile_inac" aria-controls="navs-top-profile_inac" aria-selected="false">
                                                                        Inactivos
                                                                    </button>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <button type="button" class="btn btn-primary btn_nuevo" role="tab" aria-controls="navs-top-messages" aria-selected="false">
                                                                        Nuevo Paciente
                                                                        <i class="tf-icons bx bx-message-add"></i>
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                            <input type="hidden" id="update" name="update">
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                                                                    <div class="table-responsive text-nowrap" id="tabla_paciente_a">
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="navs-top-profile_ni" role="tabpanel">
                                                                    <div class="table-responsive text-nowrap" id="tabla_paciente_n">
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="navs-top-profile_inac" role="tabpanel">
                                                                    <div class="table-responsive text-nowrap" id="tabla_paciente_i">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="update" name="update">
                                            <input type="hidden" id="id_cita" name="id_cita">
                                        </div>
                                    </div>
                                </div>
                                <div class="container-xl flex-grow-1 container-p-y">
                                    <!-- Bootstrap Table with Header - Light -->
                                    <!-- variable para saber el tipo de paciente -->
                                    <!--  <input type="hidden" id="tipo_paciente" name="tipo_paciente"> -->

                                    <!-- MODAL PARA EL PACIENTE -->
                                    <div class="modal fade" id="md_paciente" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel4">Nuevo Paciente</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <hr class="m-0">
                                                <div class="modal-body">
                                                    <div class="nav-align-top mb-4">
                                                        <ul class="nav nav-tabs" role="tablist">
                                                            <li class="nav-item">
                                                                <button type="button" id="btn_tab_adulto" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-adultos" aria-controls="navs-top-adultos" aria-selected="true">
                                                                    Adultos
                                                                </button>
                                                            </li>
                                                            <li class="nav-item">
                                                                <button type="button" id="btn_tab_nino" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-ninios" aria-controls="navs-top-ninios" aria-selected="false">
                                                                    Niños
                                                                </button>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div class="tab-pane fade active show" id="navs-top-adultos" name="navs-top-adultos" role="tabpanel">
                                                                <form method="POST" name="registrar_paciente_ad" id="registrar_paciente_ad">
                                                                    <input type="hidden" id="paciente_tipo" name="paciente_tipo">
                                                                    <input type="hidden" id="tipo_paciente" name="tipo_paciente" value="adulto">
                                                                    <input type="hidden" id="id_paciente" name="id_paciente" value="0">
                                                                    <input type="hidden" id="nuevo_paciente_d" name="nuevo_paciente_d" value="insertar_ad">
                                                                    <div class="row g-2">
                                                                        <div class="col mb-0">
                                                                            <label class="col-sm-2 col-form-label" for="dui_paciente_ad">DUI</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span id="dui_paciente2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                                                <input type="text" class="form-control" id="dui_paciente_ad" name="dui_paciente_ad" placeholder="1234678-9" maxlength="10" minlength="10" required oninput="validacionDui()" onkeypress="return soloNumeros(event)" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col mb-0">
                                                                            <label class="col-sm-2 col-form-label" for="nombre_paciente_ad">Nombre</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span id="nombre_paciente2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                                                <input type="text" class="form-control" id="nombre_paciente_ad" name="nombre_paciente_ad" placeholder="John" onkeypress="return soloLetras(event)" maxlength="50" autocomplete="off" required />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row g-2">
                                                                        <div class="col mb-0">
                                                                            <label class="col-sm-2 col-form-label" for="apellido_paciente_ad">Apellido</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span id="apellido_paciente2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                                                <input type="text" class="form-control" autocomplete="off" id="apellido_paciente_ad" name="apellido_paciente_ad" placeholder="Doe" onkeypress="return soloLetras(event)" maxlength="50" required />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col mb-0">
                                                                            <label class="col-sm-2 col-form-label" for="fecha_paciente">Fecha</label>
                                                                            <input class="form-control" type="date" max="2004-12-31" onchange="validarfecha()" id="fecha_paciente" name="fecha_paciente">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row g-2">
                                                                        <div class="col mb-0">
                                                                            <label class="col-sm-2 col-form-label" for="edad_paciente">Edad</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span id="edad_paciente2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                                                <input type="number" class="form-control" id="edad_paciente" name="edad_paciente" placeholder="1" disabled />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col mb-0">
                                                                            <label class="col-sm-2 col-form-label" for="direccion_paciente_ad">Dirección</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span id="direccion_paciente2" class="input-group-text"><i class="bx bx-message"></i></span>
                                                                                <input type="text" class="form-control" autocomplete="off" id="direccion_paciente_ad" name="direccion_paciente_ad" placeholder="Final 2 Av. Sur" maxlength="50" minlength="10" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row g-2">
                                                                        <div class="col mb-0">
                                                                            <label class="col-sm-2 col-form-label" for="telefono_paciente_ad">Teléfono</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <span id="telefono_paciente2" class="input-group-text"><i class="bx bx-phone"></i></span>
                                                                                <input type="text" class="form-control" autocomplete="off" id="telefono_paciente_ad" name="telefono_paciente_ad" maxlength="9" placeholder="1234-5678" required oninput="validacionTelefono()" onkeypress="return soloNumeros(event)" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col mb-0">
                                                                            <label for="emailLarge" class="form-label">Sexo</label>
                                                                            <div class="form-group">
                                                                                <div class="icheck-primary d-inline">
                                                                                    <input type="radio" value="Masculino" id="sexo_p_ad_m" name="sexo_paciente_ad" checked>
                                                                                    <label for="radioPrimary1"> Masculino</label>
                                                                                </div>
                                                                                <div class="icheck-primary d-inline">
                                                                                    <input type="radio" value="Femenino" id="sexo_p_ad_f" name="sexo_paciente_ad">
                                                                                    <label for="radioPrimary2"> Femenino</label>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                        <button class="btn btn-primary" id="btn_guardar">Guardar Paciente</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="tab-pane fade" id="navs-top-ninios" name="navs-top-ninios" role="tabpanel">
                                                                <form method="POST" name="registrar_paciente_nino" id="registrar_paciente_nino">
                                                                    <input type="hidden" id="paciente_tipo" name="paciente_tipo">
                                                                    <input type="hidden" id="t_paciente" name="t_paciente" value="ninio">
                                                                    <input type="hidden" id="id_paciente_n" name="id_paciente_n" value="0">
                                                                    <input type="hidden" id="nuevo_paciente_n" name="nuevo_paciente_n" value="insertar_nino">

                                                                    <!-- Datos Nino -->
                                                                    <div class="row">
                                                                        <div class="col-xxl">
                                                                            <div class="card mb-4">
                                                                                <div class="card-body">
                                                                                    <div class="col-12">
                                                                                        <div class="row g-2">
                                                                                            <div class="col mb-0">
                                                                                                <label class="col-sm-2 col-form-label" for="nombre_paciente_nino">Nombre</label>
                                                                                                <div class="input-group input-group-merge">
                                                                                                    <span id="nombre_paciente2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                                                                    <input type="text" class="form-control" autocomplete="off" id="nombre_paciente_nino" name="nombre_paciente_nino" placeholder="John" onkeypress="return soloLetras(event)" maxlength="50" required />
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col mb-0">
                                                                                                <label class="col-sm-2 col-form-label" for="apellido_paciente_nino">Apellido</label>
                                                                                                <div class="input-group input-group-merge">
                                                                                                    <span id="apellido_paciente2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                                                                    <input type="text" class="form-control" autocomplete="off" id="apellido_paciente_nino" name="apellido_paciente_nino" placeholder="Doe" onkeypress="return soloLetras(event)" maxlength="50" required />
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row g-2">
                                                                                            <div class="col mb-0">
                                                                                                <label class="col-sm-2 col-form-label" for="fecha_paciente_nino">Fecha</label>
                                                                                                <input class="form-control" type="date" max="<?php echo $fecha ?>" min="2005-01-01" onchange="validarfecha()" id="fecha_paciente_nino" name="fecha_paciente_nino">
                                                                                            </div>
                                                                                            <div class="col mb-0">
                                                                                                <label class="col-sm-2 col-form-label" for="edad_paciente_nino">Edad</label>
                                                                                                <div class="input-group input-group-merge">
                                                                                                    <span id="edad_paciente2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                                                                    <input type="number" class="form-control" id="edad_paciente_nino" name="edad_paciente_nino" placeholder="1" disabled />
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row g-2">
                                                                                            <div class="col mb-0">
                                                                                                <label for="emailLarge" class="form-label">Sexo</label>
                                                                                                <div class="form-group">
                                                                                                    <div class="icheck-primary d-inline">
                                                                                                        <input type="radio" value="Masculino" id="radioPrimary1" name="sexo_paciente_nino" checked>
                                                                                                        <label for="radioPrimary1"> Masculino</label>
                                                                                                    </div>
                                                                                                    <div class="icheck-primary d-inline">
                                                                                                        <input type="radio" value="Femenino" id="radioPrimary2" name="sexo_paciente_nino">
                                                                                                        <label for="radioPrimary2"> Femenino</label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Encargado -->
                                                                    <div class="row">
                                                                        <div class="col-xxl">
                                                                            <div class="card mb-4">
                                                                                <div class="card-body">
                                                                                    <div class="col-12">
                                                                                        <div class="row mb-3">
                                                                                            <div class="col-sm-6">
                                                                                                <h6 class="mb-0">
                                                                                                    <strong>Encargado: </strong>
                                                                                                </h6>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row g-2">
                                                                                            <div class="col mb-0">
                                                                                                <label class="col-sm-2 col-form-label" for="nombre_paciente_en">Nombre</label>
                                                                                                <div class="input-group input-group-merge">
                                                                                                    <span id="nombre_paciente_en2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                                                                    <input type="text" class="form-control" autocomplete="off" id="nombre_paciente_en" name="nombre_paciente_en" placeholder="John" onkeypress="return soloLetras(event)" maxlength="50" required />
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col mb-0">
                                                                                                <label class="col-sm-2 col-form-label" for="direccion_en_paciente">Dirección</label>
                                                                                                <div class="input-group input-group-merge">
                                                                                                    <span id="direccion_paciente2" class="input-group-text"><i class="bx bx-message"></i></span>

                                                                                                    <input type="text" class="form-control" autocomplete="off" id="direccion_en_paciente" name="direccion_en_paciente" placeholder="Final 2 Av. Sur" maxlength="50" minlength="10" />

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row g-2">
                                                                                            <div class="col mb-0">
                                                                                                <label class="col-sm-2 col-form-label" for="telefono_en_paciente">Teléfono</label>
                                                                                                <div class="input-group input-group-merge">
                                                                                                    <span id="telefono_en_paciente2" class="input-group-text"><i class="bx bx-phone"></i></span>
                                                                                                    <input type="text" class="form-control" autocomplete="off" id="telefono_en_paciente" name="telefono_en_paciente" placeholder="1234-5678" maxlength="9" minlength="9" required oninput="validacionTelefono2()" onkeypress="return soloNumeros(event)" />
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col mb-0">
                                                                                            <label class="col-sm-2 col-form-label" for="select_parentesco_nino">Parentezco</label>
                                                                                                <select class="form-select" id="select_parentesco_nino" name="select_parentesco_nino">
                                                                                                    <option value="Seleccione" selected="">Seleccionar</option>
                                                                                                    <option value="Madre">Madre</option>
                                                                                                    <option value="Padre">Padre</option>
                                                                                                    <option value="Abuelos">Abuelos</option>
                                                                                                    <option value="Tios">Tíos</option>
                                                                                                    <option value="Primos">Primos</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                                            <button class="btn btn-primary" id="btn_guardar_nino">Guardar Paciente</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="m-0">
                                                <div class="modal-footer">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Preparar Paciente -->
                                    <!-- <div class="modal fade" id="preparar" tabindex="-1" aria-hidden="true" style="background: static;">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h5 class="modal-title"><span id="titulo">Preparar paciente</span></h5>
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close btn_cerrar_up_p" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="row g-2">

                                                        <div class="col-4 mb-0">
                                                            <label for="nombre_cita">DUI de Paciente:</label>
                                                            <div class="input-group">
                                                                <input type="text" id="dui_preparar" name="dui_preparar" class="form-control" placeholder="DUI del paciente" maxlength="10" disabled />
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <hr style="background: slategrey;">

                                                    <form method="POST" name="formulario_registro_cita_preparar" id="formulario_registro_cita_preparar">
                                                        <input type="hidden" name="idpaciente" id="idpaciente">

                                                        <div class="row g-2">
                                                            <div class="col mb-0">
                                                                <label for="presion_p">Precion arterial</label>
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
                                                                    <input type="text" id="altura_p" name="altura_p" onclick="validaraltbegi()" onblur="validaraltend()" autocomplete="off" class="form-control" onkeypress="return soloNumeros(event)" placeholder="1.80mt" maxlength="5" required />
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
                                                            <button type="submit" class="btn btn-primary" id="btn_guardar_p">Guardar datos</button>
                                                        </div>


                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>

                        </div>
                        <!-- Content wrapper -->

                    </div>

                </div>
                <!-- Footer -->
                <?php
                require_once('../../Footers/footer.php');
                ?>


            </div>
            <!-- Content wrapper -->
            <!-- / Layout page -->
        </div>
    </div>

    <?php
    require_once('../../Footers/footer_scripst.php');
    ?>

    <script src="../../Scripts/paciente_funciones.js"></script>
</body>

</html>