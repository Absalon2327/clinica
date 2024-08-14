<?php
date_default_timezone_set('America/El_Salvador');
$fecha = "";
$fecha = date("Y-m-d");
$paciente = $_GET['id'];
$expediente = $_GET['idexp'];
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
<?php
require_once('../../Menus/bloqueo_pantalla.php'); ?>
<html lang="es" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Expedientes | Editar</title>
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
                        <form method="POST" id="fr_registro_expedientes" name="fr_registro_expedientes">


                            <!-- hereditarios y familiares -->
                            <div class="row">
                                <div class="col-xxl">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h3 class="card-title" id="nombre_paciente" name="nombre_paciente">Expediente - </h3>
                                            <h6 class="card-title" id="num_expediente" name="num_expediente">N°: </h6>
                                            <h6 class="card-title" id="edad_paciente_e" name="edad_paciente_e">Edad: </h6>
                                            <h6 class="card-title" id="sexo_paciente_e" name="sexo_paciente_e">Sexo: </h6>
                                            <input type="hidden" id="id_paciente" name="id_paciente" value="<?php echo $paciente ?>">                                            
                                            <input type="hidden" id="id_expediente" name="id_expediente" value="<?php echo $expediente ?>">
                                            <input type="hidden" id="almacenar_datos" name="almacenar_datos" value="nuevo_expediente">
                                            <input type="hidden" id="existente" name="existente" value="1">
                                        </div>
                                        <hr class="m-0">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <div class="row mb-3">
                                                    <div class="col-sm-6">
                                                        <h6 class="mb-0">
                                                            <strong>HEREDITARIOS Y FAMILIARES: </strong>
                                                        </h6>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <h6 class="mb-0">
                                                            PARENTEZCO:
                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label" for="basic-default-name">Diabetes Mellitus</label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="rbtn_diabetes_mellitus" id="rbtn_diabetes_melli_si" value="SI" />
                                                            <label class="form-check-label" for="rbtn_diabetes_melli_si">SI</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="rbtn_diabetes_mellitus" id="rbtn_diabetes_melli_no" value="NO" />
                                                            <label class="form-check-label" for="rbtn_diabetes_melli_no">NO</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" id="select_parentesco_diabetes" name="select_parentesco_diabetes">
                                                            <option value="Seleccione" selected="">Seleccionar</option>
                                                            <option value="Madre">Madre</option>
                                                            <option value="Padre">Padre</option>
                                                            <option value="Abuelos">Abuelos</option>
                                                            <option value="Tios">Tíos</option>
                                                            <option value="Primos">Primos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label" for="basic-default-company">Hipertesnsión Arterial</label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="rbtn_hipertension_arterial" id="rbtn_hiper_arte_si" value="SI" />
                                                            <label class="form-check-label" for="rbtn_hiper_arte_si">SI</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="rbtn_hipertension_arterial" id="rbtn_hiper_arte_no" value="NO" />
                                                            <label class="form-check-label" for="rbtn_hiper_arte_no">NO</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" id="select_parentesco_hipertension" name="select_parentesco_hipertension">
                                                            <option value="Seleccione" selected="">Seleccionar</option>
                                                            <option value="Madre">Madre</option>
                                                            <option value="Padre">Padre</option>
                                                            <option value="Abuelos">Abuelos</option>
                                                            <option value="Tios">Tíos</option>
                                                            <option value="Primos">Primos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label" for="basic-default-company">Cardiopatia Isquémica</label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="rbtn_cardiopatia" id="rbtn_cardiopatia_si" value="SI" />
                                                            <label class="form-check-label" for="rbtn_cardiopatia_si">SI</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="rbtn_cardiopatia" id="rbtn_cardiopatia_no" value="NO" />
                                                            <label class="form-check-label" for="rbtn_cardiopatia_no">NO</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" id="select_parentesco_cardiopatia" name="select_parentesco_cardiopatia">
                                                            <option value="Seleccione" selected="">Seleccionar</option>
                                                            <option value="Madre">Madre</option>
                                                            <option value="Padre">Padre</option>
                                                            <option value="Abuelos">Abuelos</option>
                                                            <option value="Tios">Tíos</option>
                                                            <option value="Primos">Primos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label" for="basic-default-company">Cancer</label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="rbtn_cancer" id="rbtn_cancer_si" value="SI" />
                                                            <label class="form-check-label" for="rbtn_cancer_si">SI</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="rbtn_cancer" id="rbtn_cancer_no" value="NO" />
                                                            <label class="form-check-label" for="rbtn_cancer_no">NO</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" id="select_parentesco_cancer" name="select_parentesco_cancer">
                                                            <option value="Seleccione" selected="">Seleccionar</option>
                                                            <option value="Madre">Madre</option>
                                                            <option value="Padre">Padre</option>
                                                            <option value="Abuelos">Abuelos</option>
                                                            <option value="Tios">Tíos</option>
                                                            <option value="Primos">Primos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-form-label" for="otros_hereitarios">Otros</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="otros_hereitarios" name="otros_hereitarios" placeholder="..." />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- tipo de familia -->
                            <div class="row">
                                <div class="col-xxl">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row mb-3 ">
                                                <div class="col-sm-4">
                                                    <small class="mb-0">
                                                        <strong>TIPO DE FAMILIA:</strong>
                                                    </small>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_tipo_familia" id="rbtn_tf_nuclear" value="NUCLEAR" />
                                                        <label class="form-check-label" for="rbtn_tf_nuclear"> <small>NUCLEAR</small> </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_tipo_familia" id="rbtn_tf_extensa" value="EXTENSA" />
                                                        <label class="form-check-label" for="rbtn_tf_extensa"><small>EXTENSA</small></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_tipo_familia" id="rbtn_tf_compuesta" value="COMPUESTA" />
                                                        <label class="form-check-label" for="rbtn_tf_compuesta"><small>COMPUESTA</small></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-4">
                                                    <small class="mb-0">
                                                        <strong>ROL DE LA MADRE:</strong>
                                                    </small>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_rol_madre" id="rbtn_rm_em" value="E-M" />
                                                        <label class="form-check-label" for="rbtn_rm_em"><small>E-M</small></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_rol_madre" id="rbtn_rm_ec" value="E-C" />
                                                        <label class="form-check-label" for="rbtn_rm_ec"><small>E-C</small></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_rol_madre" id="rbtn_rm_es" value="E-S" />
                                                        <label class="form-check-label" for="rbtn_rm_es"><small>E-S</small></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-4">
                                                    <small class="mb-0">
                                                        FAMILIAR RESPONSABLE DEL PACIENTE
                                                    </small>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="encargado_paciente" name="encargado_paciente" placeholder="LOREM IPSUM" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-2">
                                                    <small class="mb-0">
                                                        FAMILIA
                                                    </small>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_familia" id="rbtn_f_i" value="I" />
                                                        <label class="form-check-label" for="rbtn_f_i"><small>I</small></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_familia" id="rbtn_f_d" value="D" />
                                                        <label class="form-check-label" for="rbtn_f_d"><small>D</small></label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <small class="mb-0">
                                                        DISFUNCIONES FAMILIARES
                                                    </small>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_disfunciones_familiares" id="rbtn_df_si" value="SI" />
                                                        <label class="form-check-label" for="rbtn_df_si"> <small>SI</small> </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_disfunciones_familiares" id="rbtn_df_no" value="NO" />
                                                        <label class="form-check-label" for="rbtn_df_no"> <small>NO</small> </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- personales no patológicos -->
                            <div class="row">
                                <div class="col-xxl">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <div class="row mb-3">
                                                    <div class="col-sm-6">
                                                        <h6 class="mb-0">
                                                            <strong>PERSONALES NO PATOLÓGICOS: </strong>
                                                        </h6>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-2">
                                                        <small class="mb-2">
                                                            ESTADO CIVIL
                                                        </small>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" id="select_estado_civil" name="select_estado_civil" aria-label="Default select example">
                                                            <option value="Seleccione" selected="">Seleccionar</option>
                                                            <option value="Soltero">Soltero</option>
                                                            <option value="Acompañado">Acompañado</option>
                                                            <option value="Casado">Casado</option>
                                                            <option value="Divorciado">Divorciado</option>
                                                            <option value="Viudo">Viudo</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <small class="mb-2">
                                                            ESCOLARIDAD
                                                        </small>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" id="select_escolaridad" name="select_escolaridad" aria-label="Default select example">
                                                            <option value="Seleccione" selected="">Seleccionar</option>
                                                            <option value="Básica">Básica</option>
                                                            <option value="Bachillerato">Bachillerato</option>
                                                            <option value="Educación Superior">Educación Superior</option>
                                                            <option value="Profesional">Profesional</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-2">
                                                        <small class="mb-2">
                                                            RELIGIÓN
                                                        </small>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" id="select_religion" name="select_religion" aria-label="Default select example">
                                                            <option value="Seleccione" selected="">Seleccionar</option>
                                                            <option value="Cristiano Evangélico">Cristiano Evangélico</option>
                                                            <option value="Católico">Católico</option>
                                                            <option value="Gnóstico">Gnóstico</option>
                                                            <option value="Agnóstico">Agnóstico</option>
                                                            <option value="Testigo de Jehova">Testigo de Jehova</option>
                                                            <option value="Adventista">Adventista</option>
                                                            <option value="Ninguna">Ninguna</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <small class="mb-2">
                                                            ALIMENTACIÓN (Por día)
                                                        </small>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" id="select_alimentacion" name="select_alimentacion" aria-label="Default select example">
                                                            <option value="Seleccione" selected="">Seleccionar</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="0">0</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-2">
                                                        <small class="mb-2">
                                                            HABITACIÓN
                                                        </small>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" id="select_habitacion" name="select_habitacion" aria-label="Default select example">
                                                            <option value="Seleccione" selected="">Seleccionar</option>
                                                            <option value="Casa Propia">Casa propia</option>
                                                            <option value="Alquilado">Alquilado</option>
                                                            <option value="Prestado">Prestado</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <small class="mb-2">
                                                            HIGIENE PERSONAL
                                                        </small>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" id="select_higiene" name="select_higiene" aria-label="Default select example">
                                                            <option value="Seleccione" selected="">Seleccionar</option>
                                                            <option value="Una vez al día">Una vez al día</option>
                                                            <option value="Dos veces al día">Dos veces al día</option>
                                                            <option value="Tres veces al día">Tres veces al día</option>
                                                            <option value="Una Vez a la semana">Una Vez a la semana</option>
                                                            <option value="Dos Veces a la semana">Dos Veces a la semana</option>
                                                            <option value="Tres Veces a la semana">Tres Veces a la semana</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-2">
                                                        <small class="mb-2">
                                                            OCUPACIÓN
                                                        </small>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" id="select_ocupacion" name="select_ocupacion" aria-label="Default select example">
                                                            <option value="Seleccione" selected="">Seleccionar</option>
                                                            <option value="Deportista">Deportista</option>
                                                            <option value="Empleado">Empleado</option>
                                                            <option value="Oficios Varios">Oficios Varios</option>
                                                            <option value="Negocio Propio">Negocio Propio</option>
                                                            <option value="Estudiante">Estudiante</option>
                                                            <option value="Ninguna">Ninguna</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <small class="mb-2">
                                                            TIEMPO EN LA OCUPACIÓN (Horas por día)
                                                        </small>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" id="select_tiempo_ocupacion" name="select_tiempo_ocupacion" aria-label="Default select example">
                                                            <option value="Seleccione" selected="">Seleccionar</option>
                                                            <option value="12">12</option>
                                                            <option value="8">8</option>
                                                            <option value="6">6</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-2">
                                                        <small class="mb-2">
                                                            RUBRO DE LA EMPRESA
                                                        </small>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" id="select_rubro_empresa" name="select_rubro_empresa" aria-label="Default select example">
                                                            <option value="Seleccione" selected="">Seleccionar</option>
                                                            <option value="Alimenticio">Alimenticio</option>
                                                            <option value="Turístico">Turístico</option>
                                                            <option value="Industrial">Industrial</option>
                                                            <option value="Automotriz">Automotriz</option>
                                                            <option value="Administrativo">Administrativo</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <small class="mb-2">
                                                            FACTORES DE RIESGO LABORAL
                                                        </small>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" id="select_factores_riesgo_laboral" name="select_factores_riesgo_laboral" aria-label="Default select example">
                                                            <option value="Seleccione" selected="">Seleccionar</option>
                                                            <option value="Inseguridad">Inseguridad</option>
                                                            <option value="Extorsión">Extorsión</option>
                                                            <option value="Competencia">Competencia</option>
                                                            <option value="Enfermedad">Enfermedad</option>
                                                            <option value="Ninguno">Ninguno</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-2">
                                                        <small class="mb-2">
                                                            ACTIVIDAD FÍSICA
                                                        </small>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" id="select_actividad_fisica" name="select_actividad_fisica" aria-label="Default select example">
                                                            <option value="Seleccione" selected="">Seleccionar</option>
                                                            <option value="Correr">Correr</option>
                                                            <option value="Futbol">Football</option>
                                                            <option value="Nadar">Nadar</option>
                                                            <option value="Basketball">Basketball</option>
                                                            <option value="Entrenamiento Progresivo">Entrenamiento Progresivo</option>
                                                            <option value="Ninguna">Ninguna</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- personales patológicos -->
                            <div class="row">
                                <div class="col-xxl">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <div class="row mb-3">
                                                    <div class="col-sm-6">
                                                        <h6 class="mb-0">
                                                            <strong>PERSONALES PATOLÓGICOS: </strong>
                                                        </h6>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <small class="mb-2" id="especifique_otro_patologico" name="especifique_otro_patologico">
                                                            Especifique
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-6">
                                                        <select class="form-select form-select-lg" id="select_personales_patologicos" name="select_personales_patologicos" aria-label="Default select example">
                                                            <option value="Seleccione" selected="">Seleccionar</option>
                                                            <option value="MÉDICO">MÉDICO</option>
                                                            <option value="QUIRÚRGICO">QUIRÚRGICO</option>
                                                            <option value="TRANSFUNCIONALES TABAQUISMO">TRANSFUNCIONALES TABAQUISMO</option>
                                                            <option value="ALCOHOLISMOS">ALCOHOLISMOS</option>
                                                            <option value="ALÉRGICOS">ALÉRGICOS</option>
                                                            <option value="DEPENDENCIA A DROGAS O MEDICAMENTOS">DEPENDENCIA A DROGAS O MEDICAMENTOS</option>
                                                            <option value="NINIGUNA">NINIGUNA</option>
                                                            <option value="OTRO">OTRO</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <textarea id="otra_patologia" name="otra_patologia" class="form-control" placeholder="..." aria-label="..." disabled="true"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- GINECOBSTETRICOS -->
                            <div class="row">
                                <div class="col-xxl">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">
                                                            <strong>GINECOBSTETRICOS: </strong>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label" for="menarca_g">MENARCA:</label>
                                                <div class="col-sm-3">
                                                    <input type="number" min="1" class="form-control" id="menarca_g" name="menarca_g" placeholder="1" />
                                                    <small class="col-sm-2 col-form-label tex-center"> <small>Edad</small> </small>
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="numero_embarazos">Número de Embarazos:</label>
                                                <div class="col-sm-4">
                                                    <input type="number" min="0" class="form-control" id="numero_embarazos" name="numero_embarazos" placeholder="1" />
                                                    <small class="col-sm-2 col-form-label tex-center"> <small>Cantidad</small> </small>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label" >Vida sexual activa</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="rbtn_vida_sex" id="rbtn_vs_si" value="SI" />
                                                            <label class="form-check-label" for="rbtn_vs_si">SI</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="rbtn_vida_sex" id="rbtn_vs_no" value="NO" />
                                                            <label class="form-check-label" for="rbtn_vs_no">NO</label>
                                                        </div>
                                                        <input type="number" min="5" max="70" class="form-control" id="innicio_sexualidad" name="innicio_sexualidad" placeholder="Edad" />
                                                    </div>

                                                </div>
                                                <label class="col-sm-2 col-form-label" >Partos</label>
                                                <div class="col-sm-4">
                                                    <input type="number" min="0" class="form-control" id="num_partos" name="num_partos" placeholder="1" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label" >Fecha última menstruación</label>
                                                <div class="col-sm-3">
                                                    <input class="form-control" type="date" value="<?php echo $fecha ?>" max="<?php echo $fecha ?>" id="fecha_ult_menstruacion" name="fecha_ult_menstruacion">
                                                </div>
                                                <label class="col-sm-2 col-form-label" >Fecha último parto</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" value="<?php echo $fecha ?>" max="<?php echo $fecha ?>" id="fecha_ult_parto" name="fecha_ult_parto">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label" >Número de hijos</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <input type="number" min="0" class="form-control" id="num_hijos" name="num_hijos" placeholder="1" />
                                                    </div>
                                                </div>
                                                <label class="col-sm-2 col-form-label" >Macrosómicos vivos</label>
                                                <div class="col-sm-4">
                                                    <input type="number" min="0" class="form-control" id="num_macros" name="num_macros" placeholder="1" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" >Bajo peso al Nacer</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_bajo_peso_nacer" id="rbtn_bpn_si" value="SI" />
                                                        <label class="form-check-label" for="rbtn_bpn_si">SI</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_bajo_peso_nacer" id="rbtn_bpn_no" value="NO" />
                                                        <label class="form-check-label" for="rbtn_bpn_no">NO</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">

                                                <label class="col-sm-3 col-form-label" >Número de parejas</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <input type="number" min="0" class="form-control" id="num_parejas" name="num_parejas" placeholder="1" />
                                                    </div>
                                                </div>
                                                <label class="col-sm-2 col-form-label" >Heterosexuales</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="number" min="0" class="form-control" id="num_parejas_hetero" name="num_parejas_hetero" placeholder="1" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label" >Homosexuales</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <input type="number" min="0" class="form-control" id="num_parejas_homo" name="num_parejas_homo" placeholder="1" />
                                                    </div>
                                                </div>
                                                <label class="col-sm-2 col-form-label" >bisexuales</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="number" min="0" class="form-control" id="num_parejas_bi" name="num_parejas_bi" placeholder="1" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-12">
                                                    <h6 class="mb-0">
                                                        <strong>Método de Planificación Familiar</strong>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-12">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_metodo_plinificacion" id="rbtn_mp_diu" value="DIU" />
                                                        <label class="form-check-label" for="rbtn_mp_diu">DIU</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_metodo_plinificacion" id="rbtn_mp_hormonal" value="Hormonal" />
                                                        <label class="form-check-label" for="rbtn_mp_hormonal">Hormonal</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_metodo_plinificacion" id="rbtn_mp_quirurgico" value="Quirúrgico" />
                                                        <label class="form-check-label" for="rbtn_mp_quirurgico">Quirúrgico</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_metodo_plinificacion" id="rbtn_mp_otro" value="Otro" />
                                                        <label class="form-check-label" for="rbtn_mp_otro">Otro</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rbtn_metodo_plinificacion" id="rbtn_mp_ninguno" value="Ninguno" />
                                                        <label class="form-check-label" for="rbtn_mp_ninguno">Ninguno</label>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="text" id="otro_metodo_planificacion" name="otro_metodo_planificacion" placeholder="Especifique el método..." />
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
                                        <i class="tf-icons bx bx-check"></i>Guardar
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

    <script src="../../Scripts/nuevo_expediente_funciones.js"></script>
</body>

</html>