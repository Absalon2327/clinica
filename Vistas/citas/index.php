<!DOCTYPE html>
<?php
require_once('../../Menus/bloqueo_pantalla.php'); ?>
<html lang="es" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Citas | Registro</title>

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

                        <!-- Modal Nueva Cita -->
                        <div class="modal fade" id="nuevacita" tabindex="-1" aria-hidden="true" style="background: static;">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h5 class="modal-title"><span id="titulo">Nueva Cita</span></h5>
                                        <div class="modal-header">
                                            <button type="button" class="btn-close btn_cerrar_up" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="row g-2">

                                            <div class="col mb-0">
                                                <label for="nombre_cita">DUI de Paciente:</label>
                                                <div class="input-group">
                                                    <input type="text" id="dui_paciente" name="dui_paciente" class="form-control" oninput="validacionDuiP()" onkeypress="return soloNumeros(event)" placeholder="DUI del paciente" maxlength="10" />
                                                </div>
                                            </div>

                                            <div class="col mb-0">
                                                <label for="nombre_cita">Acciones:</label>
                                                <div class="input-group">
                                                    <button type="button" id="buscarP" onclick="Buscarpaciente()" class="btn btn-primary">Buscar paciente</button>
                                                    &nbsp;
                                                    <button type="button" id="nuevoP" value="Nuevo paciente" onclick="redirection()" class="btn btn-primary">Nuevo paciente</button>
                                                </div>
                                            </div>
                                        </div>

                                        <hr style="background: slategrey;">

                                        <form method="POST" name="formulario_registro_cita" id="formulario_registro_cita">

                                            <div class="row g-2">
                                                <div class="col mb-0">
                                                    <label for="nombre_cita">Nombre</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="nombre_cita" name="nombre_cita" class="form-control" onkeypress="return soloLetras(event)" placeholder="Nombre del paciente" maxlength="15" disabled required />
                                                    </div>
                                                </div>

                                                <div class="col mb-0">
                                                    <label for="apellido_cita">Apellido</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="apellido_cita" name="apellido_cita" class="form-control" onkeypress="return soloLetras(event)" placeholder="Dapellido del paciente" maxlength="15" disabled required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row g-2">
                                                <div class="col mb-0">
                                                    <label for="dui_cita">DUI</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="dui_cita" name="dui_cita" class="form-control" oninput="validacionDui()" onkeypress="return soloNumeros(event)" placeholder="DUI del paciente" maxlength="10" minlength="10" disabled required />
                                                    </div>
                                                </div>

                                                <div class="col mb-0">
                                                    <label for="telefono_cita">Telefono</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="telefono_cita" name="telefono_cita" class="form-control" oninput="validacionTelefono()" onkeypress="return soloNumeros(event)" placeholder="Telefono del paciente" maxlength="9" minlength="9" disabled required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col mb-0">
                                                <label for="fechahora_cita">Fecha y hora</label>
                                                <div class="input-group mb-3">
                                                    <input type="datetime-local" class="form-control" id="fechahora_cita" name="fechahora_cita" min="<?php echo date('Y-m-d'); ?>T00:00Z" required />
                                                </div>
                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary btn_cerrar" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary" id="btn_guardar">Guardar Cita</button>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Modal Preparar Paciente -->
                        <div class="modal fade" id="preparar" tabindex="-1" aria-hidden="true" style="background: static;">
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

                                            <div class="row g-2">
                                                <div class="col mb-0">
                                                    <label for="presion_p">Presión arterial</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="presion_p" name="presion_p" class="form-control" oninput="validarprecion()" onkeypress="return soloNumeros(event)" placeholder="120/80" maxlength="7" required />
                                                    </div>
                                                </div>

                                                <div class="col mb-0">
                                                    <label for="temperatura_p">Temperatura</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="temperatura_p" name="temperatura_p" onclick="validartempbegi()" onblur="validartempend()" class="form-control" onkeypress="return soloNumeros(event)" placeholder="37° C" maxlength="7" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row g-2">
                                                <div class="col mb-0">
                                                    <label for="altura_p">Altura</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="altura_p" name="altura_p" onclick="validaraltbegi()" onblur="validaraltend()" class="form-control" onkeypress="return soloNumeros(event)" placeholder="1.80mt" maxlength="5" required />
                                                    </div>
                                                </div>

                                                <div class="col mb-0">
                                                    <label for="peso_p">Peso</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="peso_p" name="peso_p" onclick="validarpesobegi()" onblur="validarpesoend()" class="form-control" onkeypress="return soloNumeros(event)" placeholder="90Kg" maxlength="5" required />
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
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <h3>Citas</h3>

                                    <!--   <div class="col-lg-5">
                                        <div class="list-group">
                                            <a class="list-group-item flex-column align-items-start ">
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="buscar_fecha">Fecha</label>
                                                        <div class="input-group">
                                                            <input type="date" id="buscar_fecha" name="buscar_fecha" class="form-control" onchange="buscarporfecha()" min="2021-12-31" />

                                                        </div>
                                                    </div>

                                                    <div class="col mb-0">
                                                        <label for="buscar_dui">DUI</label>
                                                        <div class="input-group">
                                                            <input type="text" id="buscar_dui" name="buscar_dui" class="form-control" oninput="validacionDuiB()" onkeypress="return soloNumeros(event)" placeholder="DUI del paciente" maxlength="10" minlength="10" />
                                                        </div>
                                                    </div>
                                                    <div class="form-text">
                                                        Buscar registros por fecha o DUI
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div> -->
                                </div>

                                <input type="hidden" id="id_expediente" name="id_expediente">
                                <input type="hidden" id="id_paciente" name="id_paciente">
                                <input type="hidden" id="id_cita" name="id_cita">
                                <input type="hidden" id="update" name="update">

                                <div class="nav-align-top mb-4">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <button type="button" class="nav-link active" id="btn_activa" onclick="cargartablactivas()" role="tab" data-bs-toggle="tab" aria-selected="true">Citas activas</button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" id="btn_inactiva" onclick="cargartablainactivas()" role="tab" data-bs-toggle="tab" aria-selected="false">Citas inactivas</button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#nuevacita" style="background: #696CFF; color: #fff;">Nueva Cita
                                                <i class="tf-icons bx bx-message-add"></i>
                                            </button>
                                        </li>
                                    </ul>

                                    <input type="hidden" id="tabla" name="tabla">

                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" role="tabpanel">
                                            <div class="table-responsive-tiny text-nowrap">
                                                <div id="tablaCitas"></div>
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

        <script src="../../Scripts/citas_funciones.js"></script>
</body>

</html>