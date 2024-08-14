<?php
@session_start();
date_default_timezone_set('America/El_Salvador');

require_once("../Modelo/Modelo.php");
require_once("sql_pacientes/mostrar_pacientes.php");
$modelo = new Modelo();
$dui = "";
$tel = "";
$nombre = "";

if (isset($_POST['nuevo_paciente_n']) && $_POST['nuevo_paciente_n'] == "insertar_nino") {

    //esta parte asigna un valor a los campos antes de guardar para que no vayan nullos
    if ($_POST['select_parentesco_nino'] == 'Seleccione') {
        $nino_parent = 'n/a';
    } else {
        $nino_parent = $_POST['select_parentesco_nino'];
    }

    if (isset($_POST['nombre_paciente_en'])) {
        $nombre = $_POST['nombre_paciente_en'];
    }

    $result = $modelo->get_query(sql_pacientes_nombre($nombre));

    if ($result[0] == '1' && $result[4] > 0) {

        print json_encode(array("Error nino2", mb_strtoupper($result[2][0]['nombre_paciente_en']), $result));
        exit();
    } else {
        $array_insertar = array(
            "table" => "tb_paciente",
            "nombre_paciente" => $_POST['nombre_paciente_nino'],
            "apellido_paciente" => $_POST['apellido_paciente_nino'],
            "fecha_paciente" => $_POST['fecha_paciente_nino'],
            "sexo_paciente" => $_POST['sexo_paciente_nino'],
            "direccion_paciente" => $_POST['direccion_en_paciente'],
            "nombres_encargado" => $_POST['nombre_paciente_en'],
            "tel_paciente" => $_POST['telefono_en_paciente'],
            "parentesco_nino" => $nino_parent,
            "estado_paciente" => "activo"
        );

        $result = $modelo->insertar_generica($array_insertar);

        if ($result[0] == '1') {

            print json_encode(array("Exito nino", $_POST, $result));
            exit();
        } else {
            print json_encode(array("Error nino", $_POST, $result));
            exit();
        }
    }
} else if (isset($_POST['nuevo_paciente_d']) && $_POST['nuevo_paciente_d'] == "insertar_ad") {

    if (isset($_POST['dui_paciente_ad'])) {
        $dui = $_POST['dui_paciente_ad'];
    }

    if (isset($_POST['telefono_paciente_ad'])) {
        $tel = $_POST['telefono_paciente_ad'];
    }

    $result = $modelo->get_query(sql_pacientes_multi($dui));
    $result2 = $modelo->get_query(sql_pacientes_multii($tel));

    if ($result[0] == '1' && $result[4] > 0) {

        print json_encode(array("Error Paciente", mb_strtoupper($result[2][0]['dui_paciente_ad']), $result));
        exit();
    } else if ($result2[0] == '1' && $result2[4] > 0) {

        print json_encode(array("Error Paciente2", mb_strtoupper($result2[2][0]['telefono_paciente_ad']), $result2));
        exit();
    } else {
        $array_insertar = array(
            "table" => "tb_paciente",
            "dui_paciente" => $_POST['dui_paciente_ad'],
            "nombre_paciente" => $_POST['nombre_paciente_ad'],
            "apellido_paciente" => $_POST['apellido_paciente_ad'],
            "fecha_paciente" => $_POST['fecha_paciente'],
            "direccion_paciente" => $_POST['direccion_paciente_ad'],
            "tel_paciente" => $_POST['telefono_paciente_ad'],
            "sexo_paciente" => $_POST['sexo_paciente_ad'],
            "estado_paciente" => "activo"

        );

        $result = $modelo->insertar_generica($array_insertar);

        if ($result[0] == '1') {

            print json_encode(array("Exito adulto", $_POST, $result));
            exit();
        } else {
            print json_encode(array("Error adulto", $_POST, $result));
            exit();
        }
    }
} else if (isset($_POST['consulta_datos']) && $_POST['consulta_datos'] == "insertar") {

    $array_insertar = array(
        "table" => "tb_consulta",
        "id_consulta" => NULL,
        "presion_consulta" => $_POST['presion'],
        "temp_consulta" => $_POST['temperatura'],
        "altura_consulta" => $_POST['altura'],
        "peso_consulta" => $_POST['peso']
    );

    $result1 = $modelo->insertar_generica($array_insertar);

    $array_update = array(
        "table" => "tb_paciente",
        "id_paciente" => $_POST['idpaciente'],
        "estado_preparado" => '1'
    );

    $result2 = $modelo->actualizar_generica($array_update);

    if ($result1[0] == '1') {
        print json_encode(array("Exito", $_POST, $result1));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result1));
        exit();
    }
} else if (isset($_POST['action']) && $_POST['action'] == "verificardui" &&  $_POST['dui'] != "") {

    $paciente = $modelo->get_todos("tb_paciente", "WHERE dui_paciente = '" . $_POST['dui'] . "'");

    if ($paciente[0] == '1' && isset($paciente[2][0])) {
        $paciente_validar = $modelo->get_todos("tb_cita", "WHERE id_paciente =  '" . $paciente[2][0]['id_paciente'] . "' AND preparada_cita = 0 AND estado_cita = 'activa'");
        if ($paciente_validar[0] == '1' && isset($paciente_validar[2][0])) {
            $resp = [
                "error" => 'Pendiente',
            ];
            print json_encode($resp);
            exit();
        } else {
            $resp = [
                "error" => 'Exito',
                "id" => $paciente[2][0]['id_paciente'],
                "nombre" => $paciente[2][0]['nombre_paciente'],
                "apellido" => $paciente[2][0]['apellido_paciente'],
                "dui" => $paciente[2][0]['dui_paciente'],
                "telefono" => $paciente[2][0]['tel_paciente']
            ];
            print json_encode($resp);
            exit();
        }
    } else {
        $resp = [
            "error" => 'Error',
        ];
        print json_encode($resp);
        exit();
    }
} else if (isset($_POST['action']) && $_POST['action'] == "invalidar" &&  $_POST['id'] != "") {
    $array_update = array(
        "table" => "tb_paciente",
        "id_paciente" => $_POST['id'],
        "estado_paciente" => "inactivo"
    );

    $result = $modelo->actualizar_generica($array_update);

    if ($result[0] == '1' && $result[4] > 0) {
        print json_encode(array("Exito", $_POST, $result));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
} else if (isset($_POST['action']) && $_POST['action'] == "activar" &&  $_POST['id'] != "") {
    $array_update = array(
        "table" => "tb_paciente",
        "id_paciente" => $_POST['id'],
        "estado_paciente" => "activo"
    );

    $result = $modelo->actualizar_generica($array_update);

    if ($result[0] == '1' && $result[4] > 0) {
        print json_encode(array("Exito", $_POST, $result));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
} else if (isset($_POST['nuevo_paciente_d']) && $_POST['nuevo_paciente_d'] == "si_actualizalo") {
    $array_update = array(
        "table" => "tb_paciente",
        "id_paciente" => $_POST['id_paciente'],
        "dui_paciente" => $_POST['dui_paciente_ad'],
        "nombre_paciente" => $_POST['nombre_paciente_ad'],
        "apellido_paciente" => $_POST['apellido_paciente_ad'],
        "fecha_paciente" => $_POST['fecha_paciente'],
        "direccion_paciente" => $_POST['direccion_paciente_ad'],
        "tel_paciente" => $_POST['telefono_paciente_ad'],
        "sexo_paciente" => $_POST['sexo_paciente_ad'],
        "estado_paciente" => "activo"
    );
    $result = $modelo->actualizar_generica($array_update);

    if ($result[0] == '1' && $result[4] > 0) {
        print json_encode(array("Exito", $_POST, $result));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
} else if (isset($_POST['nuevo_paciente_n']) && $_POST['nuevo_paciente_n'] == "si_actualizaloo") {
    $array_update = array(
        "table" => "tb_paciente",
        "id_paciente" => $_POST['id_paciente_n'],
        "nombres_encargado" => $_POST['nombre_paciente_en'],
        "nombre_paciente" => $_POST['nombre_paciente_nino'],
        "apellido_paciente" => $_POST['apellido_paciente_nino'],
        "fecha_paciente" => $_POST['fecha_paciente_nino'],
        "direccion_paciente" => $_POST['direccion_en_paciente'],
        "tel_paciente" => $_POST['telefono_en_paciente'],
        "sexo_paciente" => $_POST['sexo_paciente_nino'],
        "parentesco_nino" => $_POST['select_parentesco_nino'],
        "estado_paciente" => "activo"
    );
    $result = $modelo->actualizar_generica($array_update);

    if ($result[0] == '1' && $result[4] > 0) {
        print json_encode(array("Exito ninoo", $_POST, $result));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
} else if (isset($_POST['consultar_info']) && $_POST['consultar_info'] == "si_coneste_id") {

    $result = $modelo->get_todos("tb_paciente", "WHERE id_paciente = '" . $_POST['id'] . "'");
    if ($result[0] == '1') {
        print json_encode(array("Exito", $_POST, $result[2][0]));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
} else {
    $htmltr = $html = "";
    $htmltr2 = $html2 = "";
    $htmltr3 = $html3 = "";
    $cuantos = 0;
    $edad_adulto = 0;
    $edad_ninio = 0;
    $btn_preparado = "";
    $sqlnino = "SELECT * FROM tb_paciente";
    $sqladulto = "SELECT * FROM tb_paciente";
    // $sqlinactivo = "SELECT * FROM tb_paciente";
    $sqlinactivo = $modelo->get_query(select_pacientes_in());
    $result_adultos = $modelo->get_query(select_pacientes());
    $result_ninios = $modelo->get_query(select_pacientes());

    if ($sqlinactivo[0] == 1) {

        foreach ($sqlinactivo[2] as $row3) {

            $htmltr3 .= '<tr>
                                <td><strong>' . $row3['nombre_paciente'] . '</strong></td>
                                <td>' . $row3['apellido_paciente'] . '</td>
                                <td>' . $row3['tel_paciente'] . '</td>
                                <td>' . $row3['direccion_paciente'] . '</td>
                                <td class="text-center">
                                </a>
                                <button type="button" class="btn btn-sm rounded-pill btn-info btn_activar" data-id= "' . $row3['id_paciente'] . '" >Activar
                                    <i class="tf-icons bx bx-sort-up"></i>
                                </button>
                                </td>
                            </tr>';
        }
        $html3 .= '<table class="table" id="tabla_paciente_inactivo">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">';
        $html3 .= $htmltr3;
        $html3 .=       '</tbody>
                    </table>';
    } else {
        print json_encode(array("Error inactivas", $_POST, $sqlinactivo));
        exit();
    }

    if ($result_adultos[0] == 1) {

        foreach ($result_adultos[2] as $row2) {
            /* if ($row2['estado_preparado'] == '0') {
                $btn_preparado = '<button type="button" class="btn btn-sm rounded-pill btn-warning btn_preparar" data-bs-toggle="modal" data-bs-target="#preparar" data-duipaciente= "' . $row2['dui_paciente'] . '" data-preparada= "' . $row2['preparada'] . '" data-id= "' . $row2['id'] . '" data-idpaciente= "' . $row2['id_paciente'] . '">Preparar
                <i class="tf-icons bx bx-body"></i>
                </button>';
            } else {
                $btn_preparado = '<button type="button" class="btn btn-sm rounded-pill btn-success" >Preparado
                <i class="tf-icons bx bx-check"></i>
                </button>';
            } */
            $edad_adulto = evaluar_edad($row2['fecha_paciente']);

            if ($edad_adulto >= 18) {
                $htmltr2 .= '<tr>
                                <td><strong>' . $row2['dui_paciente'] . '</strong></td>
                                <td>' . $row2['nombre_paciente'] . '</td>
                                <td>' . $row2['apellido_paciente'] . '</td>
                                <td>' . $row2['tel_paciente'] . '</td>
                                <td>' . $row2['direccion_paciente'] . '</td>
                                <td class="text-center">
                                ' . $btn_preparado . '
                <button type="button" class="btn btn-sm rounded-pill btn-info btn_modificar" data-bs-toggle="modal" data-bs-target="#md_paciente" data-idpaciente= "' . $row2['id_paciente'] . '" >Modificar
                    <i class="tf-icons bx bx-pencil"></i>
                    </button>
                    <button type="button" class="btn btn-sm rounded-pill btn-danger btn_inactivar" data-id= "' . $row2['id_paciente'] . '" >Inactivar
                    <i class="tf-icons bx bx-trash"></i>
                    </button>
                </td>
                            </tr>';
            }
        }
        $html2 .= '<table class="table" id="tabla_paciente_adulto">
                        <thead class="table-dark">
                            <tr>
                                <th>Dui</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
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

    if ($result_ninios[0] == 1) {

        foreach ($result_ninios[2] as $row) {

            /* if ($row['estado_preparado'] == '0') {
                $btn_preparado = '<button type="button" class="btn btn-sm rounded-pill btn-warning btn_preparar" data-bs-toggle="modal" data-bs-target="#preparar" data-duipaciente= "' . $row['dui_paciente'] . '" data-preparada= "' . $row['preparada'] . '" data-id= "' . $row['id'] . '" data-idpaciente= "' . $row['id_paciente'] . '">Preparar
                <i class="tf-icons bx bx-body"></i>
                </button>';
            } else {
                $btn_preparado = '<button type="button" class="btn btn-sm rounded-pill btn-success" >Preparado
                <i class="tf-icons bx bx-check"></i>
                </button>';
            } */

            $edad_ninio = evaluar_edad($row['fecha_paciente']);

            if ($edad_ninio < 18) {
                $htmltr .= '<tr>
                                <td><strong>' . $row['nombre_paciente'] . '</strong></td>
                                <td>' . $row['apellido_paciente'] . '</td>
                                <td>' . $row['nombres_encargado'] . '</td>
                                <td>' . $row['tel_paciente'] . '</td>
                                <td>' . $row['direccion_paciente'] . '</td>
                                <td class="text-center">
                                ' . $btn_preparado . ' 
                                    <button type="button" class="btn btn-sm rounded-pill btn-info btn_modificar_nino" data-bs-toggle="modal" data-bs-target="#md_paciente" data-idpaciente= "' . $row['id_paciente'] . '" >Modificar
                                        <i class="tf-icons bx bx-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm rounded-pill btn-danger btn_inactivar" data-id= "' . $row['id_paciente'] . '" >Inactivar
                                        <i class="tf-icons bx bx-trash"></i>
                                        </button>
                                </td>
                            </tr>';
            }
        }
        $html .= '  <table class="table" id="tabla_paciente_nin">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Nombre Encargado</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">';
        $html .= $htmltr;
        $html .=        '</tbody>
                    </table>';


        print json_encode(array("Exito", $html2, $html, $cuantos, $_POST, $result_ninios, $result_adultos, $edad_ninio,  $sqlinactivo, $html3,  $edad_adulto));
        exit();
    } else {
        print json_encode(array("Error activas ninios", $_POST, $result_ninios));
        exit();
    }
}

function evaluar_edad($fecha_naci)
{
    $edad = 0;
    $año_actual = "";
    $año_actual = date("Y");
    //divido la fecha para obtener el año
    $separacion = explode("-", $fecha_naci);
    $año = $separacion[0];
    $edad = intval($año_actual)  - intval($año);
    return $edad;
}
