<?php
@session_start();

?>
<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Clínica medica familiar | Dr.Omar Bonilla</title>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />
  <!-- Core CSS -->
  <link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css" />
  <!-- Helpers -->
  <script src="../../assets/vendor/js/helpers.js"></script>

  <script src="../../assets/js/config.js"></script>
</head>

<body>
  <!-- Content -->
  <style type="text/css" media="screen">
    .hiden {
      display: none;
    }

    .mostrar {
      display: block;
    }

    body {
      background-image: linear-gradient(rgba(5, 7, 12, 0.25), rgba(5, 7, 12, 0.25)),
        url('../../assets/img/favicon/6724-doctores.jpg');
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card text-white gray-primary mb-3 ">
          <div class="card-body ">
            <!-- Logo -->
            <h3 class="text-center m-0">
              <a href="" class="logo logo-admin"><img src="../../assets/img/favicon/logiton.png" height="" alt="logo"></a>
            </h3>
            <div class="p-2">
              <h2 class="form-label font-18 m-b-7 text-center">Recuperar Contraseña</h>
                <p class="form-label text-center">Ingrese su DUI para recuparar la contraseña.</p>
            </div>
            <!-- /Logo -->
            <form name="validar_dui" id="validar_dui" class="mb-3">
              <input type="hidden" name="validando_dui" value="si_validalo">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="user-thumb text-center m-b-30">
                  <img src="../../assets/img/icons/unicons/user.png" alt class="w-px-40 h-auto rounded-circle" /><br>

                </div>
              </a>

              <div class="form-group">
                <label for="dui">DUI</label>
                <div class="input-group input-group-merge">
                  <span id="dui_usuario" class="input-group-text"><i class="bx bx-user"></i></span>
                  <input type="text" required class="form-control" id="dui" name="dui" autocomplete="off" placeholder="1234678-9" maxlength="10" minlength="10" required oninput="validacionDui()" onkeypress="return soloNumeros(event)">
                </div>
              </div>
              <div class="mb-3 text-center">
                </br>
                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Validar</button>
              </div>
            </form>
            <form class="hiden form-horizontal m-t-30" id="actualizar_pass" name="actualizar_pass">
              <input type="hidden" name="validar_nuevo_pass" value="si_actualizalo">
              <input type="hidden" name="id_persona" id="id_persona">
              <div class="form-group">
                <label for="clave_usuario" class="form-label">Contraseña</label>
                <div class="input-group input-group-merge">
                  <span id="contrasenaf" class="input-group-text"><i class="bx bx-key"></i></span>
                  <input type="password" autocomplete="off" class="form-control" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña" required>
                </div>
              </div>

              <div class="form-group">
                <label for="recontrasena">Repita su contraseña</label>
                <div class="input-group input-group-merge">
                  <span id="contrasenaf" class="input-group-text"><i class="bx bx-key"></i></span>
                  <input type="password" autocomplete="off" data-parsley-required-message="Campo requerido" class="form-control" id="recontrasena" name="recontrasena" placeholder="Repita su contraseña" required>
                </div>
              </div>

              <div class="mb-3 text-center">
                </br>
                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Validar</button>
              </div>

            </form>
          </div>
        </div>

      </div>
    </div>

  </div>
  <!-- Core JS -->
  <!-- build:js ../../assets/vendor/js/core.js -->
  <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../../assets/vendor/libs/popper/popper.js"></script>
  <script src="../../assets/vendor/js/bootstrap.js"></script>
  <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="../../assets/vendor/js/menu.js"></script>
  <script src="../../assets/vendor/libs/jquery-validation/jquery.validate.min.js"></script>
  <script src="../../assets/vendor/libs/jquery-validation/additional-methods.min.js"></script>
  <script src="../../assets/vendor/libs/sweetalert2/sweetalert2.all.js"></script>
  <script src="../../assets/vendor/libs/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="../../assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
  <script src="../../assets/vendor/libs/sweetalert2/sweetalert2.min.js"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="assets/js/main.js"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script>

  </script>
  <script src="../../Scripts/ingreso_funciones.js" type="text/javascript" charset="utf-8" async defer></script>

</body>

</html>