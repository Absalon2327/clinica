<?php

use Sabberworm\CSS\Property\Import;

@session_start();
require_once("../Conexion/Conexion.php");
require_once("../centro/modelo.php");
$modelo = new Modelo();

if (isset($_POST['nueva_cita']) && $_POST['nueva_cita'] == "insertar") {

    $array_insertar = array(
        "table" => "tb_cita",
        "id_cita" => NULL,
        "id_paciente" => $_POST['id_paciente'],
        "fechahora_cita" => $_POST['fechahora_cita'],
        "preparada_cita" => 0,
        "estado_cita" => "activa"
    );

    $result = $modelo->insertar_datos($array_insertar);
    if ($result[0] == '1') {
        print json_encode(array("Exito", $_POST, $result));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
}

if (isset($_POST['consulta_datos']) && $_POST['consulta_datos'] == "insertar") {

    $array_insertar = array(
        "table" => "tb_preparar",
        "id_expe_preparado" => NULL,
        "idexpediente" => $_POST['id_expediente'],
        "id_cita" => $_POST['id_cita'],
        "presion_consulta" => $_POST['presion'],
        "temp_consulta" => $_POST['temperatura'],
        "altura_consulta" => $_POST['altura'],
        "peso_consulta" => $_POST['peso'],
        "estado_preparacion" => 1
    );

    $result1 = $modelo->insertar_datos($array_insertar);

    $array_update = array(
        "table" => "tb_cita",
        "id_cita" => $_POST['id_cita'],
        "preparada_cita" => 1
    );

    $result2 = $modelo->actualizar_generica($array_update);

    if ($result1[0] == '1' && $result2[0] == '1') {
        print json_encode(array("Exito", $_POST, $result1));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result1));
        exit();
    }
}

if (isset($_POST['consulta_datos']) && $_POST['consulta_datos'] == "modificar") {

    $array_update = array(
        "table" => "tb_consulta",
        "id_cita" => $_POST['id_cita'],
        "presion_consulta" => $_POST['presion'],
        "temp_consulta" => $_POST['temperatura'],
        "altura_consulta" => $_POST['altura'],
        "peso_consulta" => $_POST['peso']
    );

    $result = $modelo->actualizar_generica($array_update);

    if ($result[0] == '1' && $result[4] > 0) {
        print json_encode(array("Exito", $_POST, $result));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
}

if (isset($_POST['cambiar_cita']) && $_POST['cambiar_cita'] == "modificar") {

    $array_update = array(
        "table" => "tb_cita",
        "id_cita" => $_POST['id_cita'],
        "fechahora_cita" => $_POST['fechahora_cita']
    );

    $result = $modelo->actualizar_generica($array_update);

    if ($result[0] == '1' && $result[4] > 0) {
        print json_encode(array("Exito", $_POST, $result));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
}

if (isset($_POST['action']) && $_POST['action'] == "invalidar" &&  $_POST['id'] != "") {
    $array_update = array(
        "table" => "tb_cita",
        "id_cita" => $_POST['id'],
        "estado_cita" => "inactiva"
    );

    $result = $modelo->actualizar_generica($array_update);

    if ($result[0] == '1' && $result[4] > 0) {
        print json_encode(array("Exito", $_POST, $result));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
}

if (isset($_POST['action']) && $_POST['action'] == "activar" &&  $_POST['id'] != "") {
    $array_update = array(
        "table" => "tb_cita",
        "id_cita" => $_POST['id'],
        "estado_cita" => "activa"
    );

    $result = $modelo->actualizar_generica($array_update);

    if ($result[0] == '1' && $result[4] > 0) {
        print json_encode(array("Exito", $_POST, $result));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
}




if (isset($_POST['action']) && $_POST['action'] == "verificar_consulta" &&  $_POST['id_cita'] != "") {
    $consulta = $modelo->get_todos("tb_preparar", "WHERE id_cita = '" . $_POST['id_cita'] . "' AND idexpediente = '" . $_POST['id_expediente'] . "' ");

    if ($consulta[0] == '1' && isset($consulta[2][0])) {
        $resp = [
            "error" => 'Exito',
            "presion" => $consulta[2][0]['presion_consulta'],
            "temp" => $consulta[2][0]['temp_consulta'],
            "altura" => $consulta[2][0]['altura_consulta'],
            "peso" => $consulta[2][0]['peso_consulta']
        ];
        print json_encode($resp);
        exit();
    } else {
        $resp = [
            "error" => 'Error',
        ];
        print json_encode($resp);
        exit();
    }
}

if (isset($_POST['action']) && $_POST['action'] == "inactivar_citas") {

    $sql = "SELECT * FROM `tb_cita` WHERE fechahora_cita < NOW() AND estado_cita = 'activa';";
    $comando = Conexion::getInstance()->getDb()->prepare($sql);
    $comando->execute();
    $result = $comando->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {

        foreach ($result as $row) {
            $array_update = array(
                "table" => "tb_cita",
                "id_cita" => $row['id_cita'],
                "estado_cita" => "inactiva"
            );
            $modelo->actualizar_generica($array_update);
        }
        print json_encode(array("Exito", $_POST, $result));
        exit();
    } else {
        print json_encode(array("Exito", $_POST, $result));
        exit();
    }
}

if (isset($_POST['action']) && $_POST['action'] == "verificardui" &&  $_POST['dui'] != "") {

    $paciente = $modelo->get_todos("tb_paciente", "WHERE dui_paciente = '" . $_POST['dui'] . "'");

    if ($paciente[0] == '1' && isset($paciente[2][0])) {

        $paciente1_validar = $modelo->get_todos("tb_expediente", "WHERE id_paciente =  '" . $paciente[2][0]['id_paciente'] . "'");
        if ($paciente1_validar[0] == '1' && isset($paciente1_validar[2][0])) {

            $paciente2_validar = $modelo->get_todos("tb_cita", "WHERE id_paciente =  '" . $paciente[2][0]['id_paciente'] . "' AND preparada_cita = 0 AND estado_cita = 'activa'");
            if ($paciente2_validar[0] == '1' && isset($paciente2_validar[2][0])) {
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
                "error" => 'SinExpediente',
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
}
