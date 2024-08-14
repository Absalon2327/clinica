<?php if ($_SESSION['tipof'] == '1') { ?>
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <!-- logo de menu -->
        <div class="topbar-left">
            <div class="">
                <a href="../../Vistas/principal/index.php" class="logo text-center"><img src="../../assets/img/favicon/logito_letras.png" width="90%" alt="logo" style="margin: 10px;"></a>
            </div>
        </div>
        <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li id="menu_inicio" class="menu-item">
                <a href="../../Vistas/principal/index.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Inicio">Inicio</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Menu</span>
            </li>
            <li id="menu_expediente" class="menu-item">
                <a href="../expediente/index.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Expedientes">Expedientes</div>
                </a>
            </li>

            <li id="menu_pacientes" class="menu-item">
                <a href="../paciente/index.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-circle"></i>
                    <div data-i18n="Pacientes">Pacientes</div>
                </a>
            </li>

            <li id="menu_historial" class="menu-item">
                <a href="../historial_clinico/index.php" class="menu-link ">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Historial_Clinico">Historial Clínico</div>
                </a>
            </li>

            <li id="menu_citas" class="menu-item">
                <a href="../citas/index.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-id-card"></i>
                    <div data-i18n="Citas">Citas</div>
                </a>
            </li>

            <li id="menu_consultas" class="menu-item">
                <a href="../consultas/index.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-task"></i>
                    <div data-i18n="Consultas">Consultas</div>
                </a>
            </li>
            <!-- Components -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Configuracion</span></li>
            <!-- Cards -->
            <li class="menu-item">
                <a href="../usuarios/usuarioP.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-circle"></i>
                    <div data-i18n="Usuarios">Usuarios</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-transfer-alt"></i>
                    <div data-i18n="Extended UI">Movimientos</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="../consultas/pagos_consultas.php" class="menu-link">
                            <div data-i18n="Perfect Scrollbar">Cobros de Consultas</div>
                        </a>
                    </li>
                </ul>
            </li>

            <li id="menu_respaldos" class="menu-item">
                <a href="../respaldos/index.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-box"></i>
                    <div data-i18n="User interface">Respaldo</div>
                </a>
            </li>

            <li id="menu_reportes" class="menu-item">
                <a href="../reportes/index.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-report"></i>
                    <div data-i18n="User interface">Reportes</div>
                </a>
            </li>
    
        </ul>
    </aside>
<?php } else { ?>
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <!-- logo de menu -->
        <div class="topbar-left">
            <div class="">
                <a href="../../Vistas/principal/index.php" class="logo text-center"><img src="../../assets/img/favicon/logito_letras.png" width="90%" alt="logo" style="margin: 10px;"></a>
            </div>
        </div>
        <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li id="menu_inicio" class="menu-item">
                <a href="../../Vistas/principal/index.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Inicio">Inicio</div>
                </a>
            </li>

            <li id="menu_pacientes" class="menu-item">
                <a href="../paciente/index.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-circle"></i>
                    <div data-i18n="Pacientes">Pacientes</div>
                </a>
            </li>
            <li id="menu_expediente" class="menu-item">
                <a href="../expediente/index.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Expedientes">Expedientes</div>
                </a>
            </li>
            <li id="menu_citas" class="menu-item">
                <a href="../citas/index.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-id-card"></i>
                    <div data-i18n="Citas">Citas</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-transfer-alt"></i>
                    <div data-i18n="Extended UI">Movimientos</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="../consultas/pagos_consultas.php" class="menu-link">
                            <div data-i18n="Perfect Scrollbar">Cobros de Consultas</div>
                        </a>
                    </li>
                </ul>
            </li>
            <!--      <li class="menu-item">
            <a href="../respaldos/index.php" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface">Respaldo</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="ui-accordion.html" class="menu-link">
                        <div data-i18n="Accordion">Resturar Base de Datos</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Alerts">Respaldo de Base de Datos</div>
                    </a>
                </li>
            </ul>
        </li> -->


        </ul>
    </aside>
<?php } ?>