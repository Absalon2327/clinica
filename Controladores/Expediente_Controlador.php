<?php
@session_start();
require_once("../Modelo/Modelo.php");
require_once("consultas_expedientes/mostrar_expedientes.php");
$modelo = new Modelo();

//PERSONALES NO PATOLÓGICOS:
$rubro_empresa = "";
$id_expediente = "";
$riesgo_laboral = "";
$tipo_actividad = "";

//PATOLÓGICOS
$patologia = "";
$otra_patologia = "";

//GINECOBSTETRICOS
$menarca = "";
$in_vida_sex = "";
$num_hijos = "";
$num_embarazos = "";
$num_partos = "";
$fecha_ult_menstruacion = "";
$fecha_ult_parto = "";
$macrosomicos = "";
$bajo_peso = "";
$num_parejas = "";
$num_hete = "";
$num_homo = "";
$num_bi = "";

$sistemas = "";
$padecimiento = "";
$auxiliares = "";


//Método de Planificación Familiar y tiempo de usarlo
$rbtn_mtpf = "";
$otro_mtpf = "";

if (isset($_POST['almacenar_datos']) && $_POST['almacenar_datos'] == "nuevo_expediente") {

    //PERSONALES NO PATOLÓGICOS:
    if (isset($_POST['select_rubro_empresa'])) {
        $rubro_empresa = $_POST['select_rubro_empresa'];
    }
    if (isset($_POST['select_factores_riesgo_laboral'])) {
        $riesgo_laboral = $_POST['select_factores_riesgo_laboral'];
    }

    //PATOLÓGICOS
    if (isset($_POST['otra_patologia'])) {
        $patologia = $_POST['otra_patologia'];
    } else {
        $patologia = $_POST['select_personales_patologicos'];
    }

    //GINECOBSTETRICOS
    if (isset($_POST['menarca_g'])) {
        $menarca = $_POST['menarca_g'];
    } else {
        $menarca = "0";
    }
    if (isset($_POST['innicio_sexualidad'])) {
        $in_vida_sex = $_POST['innicio_sexualidad'];
    } else {
        $in_vida_sex = "0";
    }
    if (isset($_POST['numero_embarazos'])) {
        $num_embarazos = $_POST['numero_embarazos'];
    } else {
        $num_embarazos = "0";
    }
    if (isset($_POST['num_partos'])) {
        $num_partos = $_POST['num_partos'];
    } else {
        $num_partos = "0";
    }
    if (isset($_POST['num_hijos'])) {
        $num_hijos = $_POST['num_hijos'];
    } else {
        $num_hijos = "0";
    }
    if (isset($_POST['fecha_ult_menstruacion'])) {
        $fecha_ult_menstruacion = $_POST['fecha_ult_menstruacion'];
    }
    if (isset($_POST['fecha_ult_parto'])) {
        $fecha_ult_parto = $_POST['fecha_ult_parto'];
    }
    if (isset($_POST['num_macros'])) {
        $macrosomicos = $_POST['num_macros'];
    } else {
        $macrosomicos = "0";
    }
    if (isset($_POST['rbtn_bajo_peso_nacer'])) {
        $bajo_peso = $_POST['rbtn_bajo_peso_nacer'];
    } else {
        $bajo_peso = "n/a";
    }
    if (isset($_POST['num_parejas'])) {
        $num_parejas = $_POST['num_parejas'];
    } else {
        $num_parejas = "0";
    }
    if (isset($_POST['num_parejas_hetero'])) {
        $num_hete = $_POST['num_parejas_hetero'];
    } else {
        $num_hete = "0";
    }
    if (isset($_POST['num_parejas_homo'])) {
        $num_homo = $_POST['num_parejas_homo'];
    } else {
        $num_homo = "0";
    }
    if (isset($_POST['num_parejas_bi'])) {
        $num_bi = $_POST['num_parejas_bi'];
    } else {
        $num_bi = "0";
    }

    //Método de Planificación Familiar y tiempo de usarlo
    if (isset($_POST['rbtn_metodo_plinificacion'])) {
        $rbtn_mtpf = $_POST['rbtn_metodo_plinificacion'];
    } else {
        $rbtn_mtpf = "n/a";
    }
    if (isset($_POST['otro_metodo_planificacion'])) {
        $otro_mtpf = $_POST['otro_metodo_planificacion'];
    } else {
        $otro_mtpf = "n/a";
    }

    //esta parte asigna un valor a los campos antes de guardar para que no vayan nullos
    if ($_POST['select_parentesco_diabetes'] == 'Seleccione') {
        $diabetes_parent = 'n/a';
    } else {
        $diabetes_parent = $_POST['select_parentesco_diabetes'];
    }

    if ($_POST['select_parentesco_hipertension'] == 'Seleccione') {
        $hipertension_parent = 'n/a';
    } else {
        $hipertension_parent = $_POST['select_parentesco_hipertension'];
    }

    if ($_POST['select_parentesco_cardiopatia'] == 'Seleccione') {
        $cardipatia_parent = 'n/a';
    } else {
        $cardipatia_parent = $_POST['select_parentesco_cardiopatia'];
    }

    if ($_POST['select_parentesco_cancer'] == 'Seleccione') {
        $cancer_parent = 'n/a';
    } else {
        $cancer_parent = $_POST['select_parentesco_cancer'];
    }

    if (isset($_POST['select_tiempo_ocupacion'])) {
        $tiempo_ocupacion = $_POST['select_tiempo_ocupacion'];
    } else {
        $tiempo_ocupacion = 'n/a';
    }

    if (isset($_POST['select_rubro_empresa'])) {
        $rubro_empresa = $_POST['select_rubro_empresa'];
    } else {
        $rubro_empresa = 'n/a';
    }

    if (isset($_POST['select_factores_riesgo_laboral'])) {
        $riesgo_laboral = $_POST['select_factores_riesgo_laboral'];
    } else {
        $riesgo_laboral = 'n/a';
    }

    if ($_POST['otros_hereitarios'] != "") {
        $otros_hereditarios = $_POST['otros_hereitarios'];
    } else {
        $otros_hereditarios = 'n/a';
    }

    if ($_POST['otra_patologia'] == '') {
        $otra_patologia = $patologia;
    } else {
        $otra_patologia = $_POST['otra_patologia'];
    }

    if (isset($_POST['rbtn_metodo_plinificacion']) && $_POST['otro_metodo_planificacion'] == "") {
        $otro_mtpf = $_POST['rbtn_metodo_plinificacion'];
    } else if ($_POST['otro_metodo_planificacion'] != "") {
        $otro_mtpf = $_POST['otro_metodo_planificacion'];
    } else {
        $otro_mtpf = "n/a";
    }

    if ($_POST['existente'] == "0") {
        $id_expediente == NULL;
    } else {
        $id_expediente = $_POST['id_expediente'];
    }

    if ($_POST['aparatos_sistemas'] == "") {
        $sistemas = "Ninguno";
    } else {
        $sistemas = $_POST['aparatos_sistemas'];
    }

    if ($_POST['padecimiento_actual'] == "") {
        $padecimiento = "Ninguno";
    } else {
        $padecimiento = $_POST['padecimiento_actual'];
    }

    if ($_POST['auxiliares_diagnostico_previo'] == "") {
        $auxiliares = "Ninguno";
    } else {
        $auxiliares = $_POST['auxiliares_diagnostico_previo'];
    }




    //GUARDANDO LOS DATOS DEL EXPEDIENTE
    $array_insertar = array(
        //hereditarios y familiares
        "table" => "tb_expediente",
        "id_expediente" => $id_expediente,
        "id_paciente" => $_POST['id_paciente'],
        "diabetes_mellitus" => $_POST['rbtn_diabetes_mellitus'],
        "parentesco_diabetes" => $diabetes_parent,
        "hipertension_arterial" => $_POST['rbtn_hipertension_arterial'],
        "parentesco_hip_ar" => $hipertension_parent,
        "cardipatia_isquemica" => $_POST['rbtn_cardiopatia'],
        "parentesco_card_isq" => $cardipatia_parent,
        "cancer" => $_POST['rbtn_cancer'],
        "parentesco_can" => $cancer_parent,
        "otro_hereditario" => $otros_hereditarios,
        //tipo familia
        "tipo_familia" => $_POST['rbtn_tipo_familia'],
        "rol_madre" => $_POST['rbtn_rol_madre'],
        "familia" => $_POST['rbtn_familia'],
        "disfunciones_familiares" => $_POST['rbtn_disfunciones_familiares'],
        //personale no patológicos
        "esado_civil" => $_POST['select_estado_civil'],
        "escolaridad" => $_POST['select_escolaridad'],
        "religion" => $_POST['select_religion'],
        "alimentacion" => $_POST['select_alimentacion'],
        "habitacion" => $_POST['select_habitacion'],
        "higiene_personal" => $_POST['select_higiene'],
        "ocupacion" => $_POST['select_ocupacion'],
        "tiempo_ocupacion" => $tiempo_ocupacion,
        "actividad_empresa" => $rubro_empresa,
        "factores_riesgo_laboral" => $riesgo_laboral,
        "actividad_fisica" => $_POST['select_actividad_fisica'],
        //patologías        
        "patologias" => $otra_patologia,
        //GINECOBSTETRICOS
        "menarca" => $menarca,
        "num_embarazos" => $num_embarazos,
        "inicio_vida_sexual" => $in_vida_sex,
        "num_partos" => $num_partos,
        "fecha_ultima_menstruacion" => $fecha_ult_menstruacion,
        "fecha_ultimo_parto" => $fecha_ult_parto,
        "num_hijos" => $num_hijos,
        "macrosomicos_vivos" => $macrosomicos,
        "bajo_peso_nacer" => $bajo_peso,
        "num_parejas" => $num_parejas,
        "num_heteros" => $num_hete,
        "num_homosexuales" => $num_homo,
        "num_bisexuales" => $num_bi,
        "metodo_planificacion_familiar" => $otro_mtpf,
        "padecimiento_actual" => $padecimiento,
        "aparatos_sistemas" =>  $sistemas,
        "auxiliares_diagnostico_previo" => $auxiliares,
        "estado_expe" => 'activo',
        "estado_preparacion" => 0
    );

    if ($_POST['existente'] == "0") {
        $resultado = $modelo->insertar_generica($array_insertar);
    } else {
        $resultado = $modelo->actualizar_generica($array_insertar);
    }


    if ($resultado[0] == '1' && $resultado[4] > 0) {
        print json_encode(array("Exito", $_POST, $resultado));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $resultado));
        exit();
    }
} else if (isset($_POST['ver_expediente']) && $_POST['ver_expediente'] == "si_coneste_id") {

    $resultado = $modelo->get_todos("tb_expediente", "WHERE id_expediente = '" . $_POST['id_expe'] . "'");
    $result_paciente = $modelo->get_todos("tb_paciente", "WHERE id_paciente = '" . $_POST['idpaciente'] . "'");
    $result_encargado = $modelo->get_query(mostrar_paciente($_POST['idpaciente']));

    if ($resultado[0] == '1') {
        print json_encode(array("Exito", $_POST, $resultado[2][0], $result_paciente[2][0], $result_encargado[2][0]['nombres_encargado']));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $resultado, $result_paciente));
        exit();
    }
} else if (isset($_POST['editar_expediente']) && $_POST['editar_expediente'] == "si_coneste_id") {

    $resultado = $modelo->get_todos("tb_expediente", "WHERE id_expediente = '" . $_POST['id_expe'] . "'");
    $result_paciente = $modelo->get_todos("tb_paciente", "WHERE id_paciente = '" . $_POST['idpaciente'] . "'");
    $result_encargado = $modelo->get_query(mostrar_paciente($_POST['idpaciente']));

    if ($resultado[0] == '1') {
        print json_encode(array("Exito", $_POST, $resultado[2][0], $result_paciente[2][0], $result_encargado[2][0]['nombres_encargado']));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $resultado, $result_paciente));
        exit();
    }
} else if (isset($_POST['inactivar_expediente']) && $_POST['inactivar_expediente'] == "si_coneste_id") {
    $array_update = array(
        "table" => "tb_expediente",
        "id_expediente" => $_POST['id'],
        "estado_expe" => "inactivo"

    );
    $resultado = $modelo->actualizar_generica($array_update);
    if ($resultado[0] == '1' && $resultado[4] > 0) {
        print json_encode(array("Exito", $_POST, $resultado, $resultado[4]));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $resultado));
        exit();
    }
} else if (isset($_POST['reactivar_expediente']) && $_POST['reactivar_expediente'] == "si_coneste_id") {
    $array_update = array(
        "table" => "tb_expediente",
        "id_expediente" => $_POST['id'],
        "estado_expe" => "activo"

    );
    $resultado = $modelo->actualizar_generica($array_update);
    if ($resultado[0] == '1' && $resultado[4] > 0) {
        print json_encode(array("Exito", $_POST, $resultado, $resultado[4]));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $resultado));
        exit();
    }
} else if (isset($_POST['mostrar_paciente']) && $_POST['mostrar_paciente'] == "si_coneste_id") {

    $resultado = $modelo->get_query(mostrar_paciente($_POST['id']));
    if ($resultado[0] == '1') {
        print json_encode(array("Exito", $_POST, $resultado[2][0]));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $resultado));
        exit();
    }
} else if (isset($_POST['cargar_pacientes']) && $_POST['cargar_pacientes'] == "si_cargalos") {

    $htmltr = $html = "";
    $htmltr2 = $html2 = "";
    $cuantos = 0;
    $edad_adulto = 0;
    $edad_ninio = 0;
    $verificar = "";

    $result_adultos = $modelo->get_query(select_pacientes());
    $result_ninios = $modelo->get_query(select_pacientes());

    if ($result_adultos[0] == '1') {

        foreach ($result_adultos[2] as $row2) {

            $edad_adulto = evaluar_edad($row2['fecha_paciente']);
            $verificar = verficar_paciente($row2['id_paciente']);

            if ($edad_adulto >= 18 && $verificar == 'no_existe') {

                $htmltr2 .= '<tr>
                                <td><strong>' . $row2['dui_paciente'] . '</strong></td>
                                <td>' . $row2['nombre_paciente'] . '</td>
                                <td>' . $row2['apellido_paciente'] . '</td>
                                <td class="text-center">
                                    <a class="btn btn-sm rounded-pill btn-info btn_anadir_expediente" data-idpaciente= "' . $row2['id_paciente'] . '" >Añadir                                    
                                    </a>
                                </td>
                            </tr>';
            }
        }
        $html2 .= '<table class="table" id="tabla_paciente_anadir_adulto">
                        <thead class="table-dark">
                            <tr>
                                <th>Dui</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">';
        $html2 .= $htmltr2;
        $html2 .=       '</tbody>
                    </table>';
    } else {
        print json_encode(array("Error activas", $_POST, $result_adultos, $edad_adulto));
        exit();
    }

    if ($result_ninios[0] == '1' || $result_ninios[0] == '1') {

        foreach ($result_ninios[2] as $row) {

            $edad_ninio = evaluar_edad($row['fecha_paciente']);
            $verificar = verficar_paciente($row['id_paciente']);

            if ($edad_ninio < 18 && $verificar == 'no_existe') {
                $htmltr .= '<tr>
                                <td><strong>' . $row['nombres_encargado'] . '</strong></td>
                                <td>' . $row['nombre_paciente'] . '</td>
                                <td>' . $row['apellido_paciente'] . '</td>
                                <td class="text-center">
                                    <a class="btn btn-sm rounded-pill btn-info btn_anadir_expediente" data-idpaciente= "' . $row['id_paciente'] . '" >Añadir
                                    </a>
                                </td>
                            </tr>';
            }
        }
        $html .= '  <table class="table" id="tabla_paciente_anadir_nin">
                        <thead class="table-dark">
                            <tr>
                                <th>Encargado</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">';
        $html .= $htmltr;
        $html .=        '</tbody>
                    </table>';


        print json_encode(array("Exito", $html2, $html, $cuantos, $_POST, $result_ninios, $result_adultos, $verificar));
        exit();
    } else {
        print json_encode(array("Error inactivas", $_POST, $result_ninios));
        exit();
    }
} else if (isset($_POST['preparar_paciente']) && $_POST['preparar_paciente'] == "si_preparalo") {


    $array_insertar = array(
        "table" => "tb_preparar",
        "idexpediente" => $_POST['idexpediente'],
        "presion_consulta" => $_POST['presion_p'],
        "temp_consulta" => $_POST['temperatura_p'],
        "altura_consulta" => $_POST['altura_p'],
        "peso_consulta" => $_POST['peso_p'],
        "estado_preparacion" => 1 //estado 1 representa que esta sin realizar

    );

    $array_actualizar = array(
        "table" => "tb_expediente",
        "id_expediente" => $_POST['idexpediente'],
        "estado_preparacion" => 1
    );

    $resultado = $modelo->insertar_generica($array_insertar);
    $resultado_p = $modelo->actualizar_generica($array_actualizar);

    if ($resultado[0] == '1' && $resultado[4] > 0) {

        if ($resultado_p[0] == '1' && $resultado_p[4] > 0) {

            print json_encode(array("Exito", $_POST, $resultado, $resultado_p));
            exit();
        } else {

            print json_encode(array("Error expediente", $_POST, $resultado, $resultado_p));
            exit();
        }
    } else {
        print json_encode(array("Error preparar", $_POST, $resultado, $resultado_p));
        exit();
    }
} else {
    $htmltr = $html = "";
    $htmltr2 = $html2 = "";
    $cuantos = 0;
    $edad_adulto = 0;
    $edad_ninio = 0;
    $acciones = "";
    $estado = "";
    $btn_preparado = "";

    if (isset($_POST['estado_expe']) && $_POST['estado_expe'] == "activo") {
        $result_adultos = $modelo->get_query(select_todos_activos());
        $result_ninios = $modelo->get_query(select_todos_activos());
        $estado = "ac";
    } else if (isset($_POST['estado_expe']) && $_POST['estado_expe'] == "inactivo") {
        $result_adultos = $modelo->get_query(select_todos_inactivos());
        $result_ninios = $modelo->get_query(select_todos_inactivos());
        $estado = "inac";
    } else {
        $estado = "ac";
        $result_adultos = $modelo->get_query(select_todos_activos());
        $result_ninios = $modelo->get_query(select_todos_activos());
    }




    if ($result_adultos[0] == '1') {
        $btn_preparado = "";

        foreach ($result_adultos[2] as $row2) {

            if ($row2['estado_preparacion'] == 0) {
                $btn_preparado = '<button type="button" class="btn btn-sm rounded-pill btn-warning btn_preparar" data-idexpediente= "' . $row2['id_expediente'] . '" data-paciente= "' . $row2['id_paciente'] . '" >Preparar
                                    <i class="tf-icons bx bx-body"></i>
                                </button>';
            } else {
                $btn_preparado = '<button type="button" class="btn btn-sm rounded-pill btn-secondary" >Preparado
                                    <i class="tf-icons bx bx-check"></i>
                                </button>';
            }



            if ($estado == "ac") {
                $acciones = '<td class="text-center">
                                <button type="button" class="btn btn-sm rounded-pill btn-success btn_ver" data-idexpediente= "' . $row2['id_expediente'] . '" data-paciente= "' . $row2['id_paciente'] . '" >Ver
                                    <i class="tf-icons bx bx-show"></i>
                                </button>
                                ' . $btn_preparado . '
                                <button type="button" class="btn btn-sm rounded-pill btn-info btn_editar"  data-idexpediente= "' . $row2['id_expediente'] . '" data-paciente= "' . $row2['id_paciente'] . '">Editar
                                    <i class="tf-icons bx bx-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm rounded-pill btn-danger btn_inactivar" data-idexpediente= "' . $row2['id_expediente'] . '">Inactivar
                                    <i class="tf-icons bx bx-trash"></i>
                                </button>
                            </td>';
            } else {
                $acciones = '<td class="text-center">
                                <button type="button" class="btn btn-sm rounded-pill btn-info btn_reactivar" data-idexpediente= "' . $row2['id_expediente'] . '">Reactivar
                                    <i class="tf-icons bx bx-plus"></i>
                                </button>
                            </td>';
            }

            $edad_adulto = evaluar_edad($row2['fecha_paciente']);

            if ($edad_adulto >= 18) {
                $htmltr2 .= '<tr>
                                <td><strong>' . $row2['id_expediente'] . '</strong></td>
                                <td><strong>' . $row2['paciente'] . '</strong></td>
                                <td>' . $row2['direccion_paciente'] . '</td>
                                <td>' . $edad_adulto . '</td>
                                ' . $acciones . '
                            </tr>';
            }
        }
        $html2 .= ' <table class="table" id="tabla_expedientes_adultos">
                        <thead class="table-dark">
                            <tr>
                                <th>N°</th>
                                <th>Paciente</th>
                                <th>Dirección</th>
                                <th>Edad</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">';
        $html2 .= $htmltr2;
        $html2 .=       '</tbody>
                    </table>';
    } else {
        print json_encode(array("Error activas", $_POST, $result_adultos, $edad_adulto));
        exit();
    }

    if ($result_ninios[0] == '1') {
        $btn_preparado = "";


        foreach ($result_ninios[2] as $row) {

            if ($row['estado_preparacion'] == 0) {
                $btn_preparado = '<button type="button" class="btn btn-sm rounded-pill btn-warning btn_preparar" data-idexpediente= "' . $row['id_expediente'] . '" data-paciente= "' . $row['id_paciente'] . '" >Preparar
                                    <i class="tf-icons bx bx-body"></i>
                                </button>';
            } else {
                $btn_preparado = '<button type="button" class="btn btn-sm rounded-pill btn-secondary" >Preparado
                                    <i class="tf-icons bx bx-check"></i>
                                </button>';
            }

            if ($estado == "ac") {
                $acciones = '<td class="text-center">
                                <button type="button" class="btn btn-sm rounded-pill btn-success btn_ver" data-idexpediente= "' . $row['id_expediente'] . '" data-paciente= "' . $row['id_paciente'] . '">Ver
                                    <i class="tf-icons bx bx-show"></i>
                                </button>
                                ' . $btn_preparado . '
                                <button type="button" class="btn btn-sm rounded-pill btn-info btn_editar"  data-idexpediente= "' . $row['id_expediente'] . '" data-paciente= "' . $row['id_paciente'] . '">Editar
                                    <i class="tf-icons bx bx-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm rounded-pill btn-danger btn_inactivar" data-idexpediente= "' . $row['id_expediente'] . '">Inactivar
                                    <i class="tf-icons bx bx-trash"></i>
                                </button>
                            </td>';
            } else {
                $acciones = '<td class="text-center">
                                <button type="button" class="btn btn-sm rounded-pill btn-info btn_reactivar" data-idexpediente= "' . $row['id_expediente'] . '">Reactivar
                                    <i class="tf-icons bx bx-plus"></i>
                                </button>
                            </td>';
            }

            $edad_ninio = evaluar_edad($row['fecha_paciente']);

            if ($edad_ninio < 18) {
                $htmltr .= '<tr>
                                <td><strong>' . $row['id_expediente'] . '</strong></td>
                                <td><strong>' . $row['paciente'] . '</strong></td>
                                <td>' . $row['direccion_paciente'] . '</td>
                                <td>' . $edad_ninio . '</td>
                                ' . $acciones . '
                            </tr>';
            }
        }
        $html .= '  <table class="table" id="tabla_expedientes_ninios">
                        <thead class="table-dark">
                            <tr>
                                <th>N°</th>
                                <th>Paciente</th>
                                <th>Dirección</th>
                                <th>Edad</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">';
        $html .= $htmltr;
        $html .=        '</tbody>
                    </table>';


        print json_encode(array("Exito", $html2, $html, $cuantos, $_POST, $result_ninios, $result_adultos, $edad_adulto, $edad_ninio));
        exit();
    } else {
        print json_encode(array("Error inactivas", $_POST, $result_ninios));
        exit();
    }
}

function verficar_paciente($id)
{
    $validacion = "";
    $result = "";
    $modelo = new Modelo();
    $result = $modelo->get_query(verificar_paciente_añadido($id));
    if ($result[2][0]['Expdiente'] != null) {
        $validacion = 'existe';
    } else {
        $validacion = 'no_existe';
    }
    return $validacion;
}
function evaluar_edad($fecha_naci)
{
    $edad = 0;
    $año_actual = "";
    $año_actual = date("Y");
    //divido la fecha para obtener el año
    $separacion = explode("-", $fecha_naci);
    $año = $separacion[0];
    $edad = intval($año_actual) - intval($año);

    return $edad;
}
