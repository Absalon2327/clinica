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

            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Nueva </span> Cita</h4>

            <div class="row">
              <!-- Basic -->
              <div class="col-md-10" style="margin-right: auto; margin-left: auto;">
                <div class="card mb-4">
                  <h5 class="card-header">Datos personales para la cita</h5>
                  <div class="card-body demo-vertical-spacing demo-only-element">

                    <label class="form-label" for="basic-default-password12">Nombre:</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Nombres" aria-label="Username" aria-describedby="basic-addon11" />
                    </div>

                    <label class="form-label" for="basic-default-password12">Apellido:</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Apellidos" aria-label="Username" aria-describedby="basic-addon11" />
                    </div>

                    <label class="form-label" for="basic-default-password12">DUI:</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="DUI" aria-label="Username" aria-describedby="basic-addon11" />
                    </div>

                    <label class="form-label" for="basic-default-password12">Telefono:</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Telefono" aria-label="Username" aria-describedby="basic-addon11" />
                    </div>


                    <label class="form-label" for="basic-default-password12">Fecha:</label>
                    <div class="input-group">
                      <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                    </div>


                    <label class="form-label" for="basic-default-password12">Hora:</label>
                    <div class="input-group">
                      <input class="form-control" type="time" value="12:30:00" id="html5-time-input" />
                    </div>

                    <p align="right">
                      <button type="submit" class="btn btn-primary">Reservar</button>
                    </p>

                  </div>

                </div>

              </div>

            </div>

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
  </div>
  <!-- / Layout wrapper -->z

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <?php
  require_once('../../Footers/footer_scripst.php');
  ?>
</body>

</html>