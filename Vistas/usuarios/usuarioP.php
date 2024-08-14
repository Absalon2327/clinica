<?php
@session_start();
@include 'Menus/bloqueo_pantalla.php';
date_default_timezone_set('America/El_Salvador');
$fecha = "";
$fecha = date("Y-m-d") ?>
<!DOCTYPE html>

<html lang="es" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<title>Usuario | Registro</title>

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
            <!-- Layout container -->
            <div class="layout-page">

                <?php
                require_once('../../Menus/menu_bar.php');
                ?>
                <div class="content-page">
                    <div class="content">
                        <div class="page-content-wrapper">
                            <div class="container-xxl flex-grow-1 container-p-y">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Registro de Usuarios</h3>
                                        <div class="col-12 text-end">
                                            <button type="submit" id="registrar_usuario" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#md_registrar_usuario">Nuevo Usuario
                                                <i class="tf-icons bx bx-check"></i>
                                            </button>
                                        </div>
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="card m-b-20">
                                                    <div class="card-body" id="datos_tabla">

                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->

                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mt-3">
                                            <!-- Modal -->
                                            <div class="modal fade" id="md_registrar_usuario" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form name="formulario_registro" id="formulario_registro">
                                                                <input type="hidden" id="ingreso_datos" name="ingreso_datos" value="si_registro">
                                                                <input type="hidden" id="llave_persona" name="llave_persona" value="si_registro">
                                                                <div class="row">
                                                                    <div class="col-xl-14">
                                                                        <div class="nav-align-top mb-4">
                                                                            <div class="card-header">
                                                                                <h3>Registro de Usuarios</h3>
                                                                                <div class="col-12 text-end">

                                                                                </div>

                                                            <div class="row">
                                                           <div class="col-md-6">
                                                         <label class="form-label" for="nombre_usuario">Nombre</label>
                                                      <div class="input-group input-group-merge">
                                                     <span id="nombref2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                     <input type="text" class="form-control" id="nombref" name="nombref" autocomplete="off" placeholder="Ingrese su nombre completo" onkeypress="return soloLetras(event)" maxlength="20" required />
                                                     </div>
                                                     </div>

                                                     <div class="col-md-6">
                                                    <label class="form-label" for="usuario_usuario">Usuario</label>
                                                    <div class="input-group input-group-merge">
                                                    <span id="usuariof2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                     <input type="text" class="form-control" autocomplete="off" id="usuariof" name="usuariof" placeholder="Ingrese su usuario" maxlength="15" required />
                                                    </div>
                                                     </div>
                                                    <div class="col-md-6">
                                                    <label class="form-label" for="dui_usuario">DUI</label>
                                                    <div class="input-group input-group-merge">
                                                    <span id="dui_usuario" class="input-group-text"><i class="bx bx-user"></i></span>
                                                    <input type="text" class="form-control" id="duif" name="duif" autocomplete="off"placeholder="1234678-9" maxlength="10" minlength="10" required oninput="validacionDui()" onkeypress="return soloNumeros(event)" />
                                                    </div>
                                                    </div>

                                                   <div class="col-md-6">
                                                   <label for="clave_usuario" class="form-label">Contraseña</label>
                                                <div class="input-group input-group-merge">
                                                <span id="contrasena" class="input-group-text"><i class="bx bx-key"></i></span>
                                                <input type="password" id="contrasenaf" class="form-control" name="contrasenaf" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                                                 </div>
                                                 </div>

                                                <div class="col-md-6">
                                                <div class="form-group">
                                                <label class="form-label">Tipo de Usuario</label>
                                                <select id="tipof" name="tipof" class="form-control select2">
                                                <option value="Seleccione" selected >Seleccione</option>
                                                <option value="1">Administrador</option>
                                                <option value="2">Empleado</option>
                                                </select>
                                                                                        </div>
                                                                                    </div>
                                                                                  
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-primary btn_cerrar_class">
                                                                Cerrar
                                                            </button>
                                                            
                                                            <button type="submit" id="boton_enviar" class="btn btn-sm btn-primary">Guardar
                                                                <i class="tf-icons bx bx-check"></i>
                                                            </button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div><!-- container -->

                    </div> <!-- Page content Wrapper -->
                </div>
                <?php
                require_once('../../Footers/footer.php');
                ?>
            </div>
        </div>
        <!-- Content wrapper -->
    </div>

    <?php
    require_once('../../Footers/footer_scripst.php');
    ?>

    <script src="../../Scripts/usuarios_funciones.js"></script>
 
</body>

</html>