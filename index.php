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
  <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />
  <!-- Core CSS -->
  <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
  <!-- Helpers -->
  <script src="assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="assets/js/config.js"></script>
</head>

<body>
  <!-- Content -->
  <style>
    body {
      background-image: linear-gradient(rgba(5, 7, 12, 0.25), rgba(5, 7, 12, 0.25)),
        url('assets/img/favicon/6724-doctores.jpg');
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
              <a href="index.php" class="logo logo-admin"><img src="assets/img/favicon/logiton.png" height="" alt="logo"></a>
            </h3>
            <div class="p-2">
              <h2 class="form-label font-18 m-b-7 text-center">Bienvenido</h>
                <p class="form-label text-center">Para iniciar ingrese sus credenciales.</p>
            </div>
            <!-- /Logo -->
            <form name="formulario_login" id="formulario_login" class="mb-3" action="index.html" method="POST">
              <input type="hidden" id="iniciar_sesion" name="iniciar_sesion" value="si_nueva" />
              <div class="mb-3">
                <label for="usuario-login" class="form-label">Usuario</label>
                <div class="input-group input-group-merge">
                  <span id="login-usuario" class="input-group-text"><i class="bx bx-user"></i></span>
                  <input type="text" class="form-control" autocomplete="off" id="usuariologin" name="usuariologin" placeholder="Ingrese su nombre de usuario" autofocus required />
                </div>
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="contrasena">Contraseña</label>
                  <a href="Vistas/usuarios/recuperar_contra.php">
                    <small>¿Has olvidado tu contraseña?</small>
                  </a>
                </div>

                <div class="input-group input-group-merge">
                  <span id="contrasenaf" class="input-group-text"><i class="bx bx-key"></i></span>
                  <input type="password" id="contraseña_login" class="form-control" name="contraseña_login" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" autocomplete="off" require />

                </div>
              </div>

              <div class="mb-3 text-center">
                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Iniciar sesión</button>
              </div>

            </form>
          </div>
        </div>

      </div>
    </div>

  </div>
  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="assets/vendor/js/menu.js"></script>
  <script src="assets/vendor/libs/jquery-validation/jquery.validate.min.js"></script>
  <script src="assets/vendor/libs/jquery-validation/additional-methods.min.js"></script>
  <script src="assets/vendor/libs/sweetalert2/sweetalert2.all.js"></script>
  <script src="assets/vendor/libs/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
  <script src="assets/vendor/libs/sweetalert2/sweetalert2.min.js"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="assets/js/main.js"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <script src="Scripts/ingreso_funciones.js" type="text/javascript" charset="utf-8" async defer></script>

</body>

</html>