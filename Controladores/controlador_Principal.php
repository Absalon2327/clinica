<?php
require_once("../Modelo/Modelo.php");
require_once("sql_consultas/mostrar_consultas.php");

$modelo = new Modelo();
$htmltr = $html = "";
$cuantos = 0;
$cuantos_p = 0;
$cuantos_c = 0;
$total_consultas = 0;
$fecha_consulta = "";
$sql_consultas = total_consulta_dia();
$fecha_hoy = date('Y-m-d');
$resutl_consulta = $modelo->get_query($sql_consultas);

if ($resutl_consulta[0] == '1' && $resutl_consulta[4] >= 0) {

    foreach ($resutl_consulta[2] as $row) {

        $fecha_consulta = fecha($row['fecha_consulta']);

        if ($fecha_consulta == $fecha_hoy) {
            $total_consultas = $total_consultas + $row['monto_consulta'];
        } else {
        }
    }
} else {
    $total_consultas = 1;
}


$sql = "SELECT *,(SELECT count(*) as cuantos FROM tb_usuario) as cuantos FROM tb_usuario where 
estado='Activo'";
$sql_pa = "SELECT count(*) as cuantos_p FROM tb_paciente  WHERE  estado_paciente = 'activa';";
$sql_citas = "SELECT 
tb_cita.id_cita, 
tb_cita.id_paciente, 
DATE(tb_cita.fechahora_cita) as fecha,
tb_paciente.nombre_paciente as nombre, 
tb_paciente.apellido_paciente as apellido,
tb_paciente.dui_paciente as dui,
tb_paciente.tel_paciente as telefono,
TIME(tb_cita.fechahora_cita) as hora
FROM
tb_cita
INNER JOIN
tb_paciente
ON 
    tb_cita.id_paciente = tb_paciente.id_paciente
    WHERE estado_cita = 'activa';";
$sql_ci = "SELECT count(*) as cuantos_c from tb_cita WHERE estado_cita = 'activa'";
$result_pa = $modelo->get_query($sql_pa);
$result = $modelo->get_query($sql);
$result_cita = $modelo->get_query($sql_citas);
$result_ci_c = $modelo->get_query($sql_ci);

if ($result[0] == '1') {
    foreach ($result[2] as $row) {
        $cuantos = $row['cuantos'];
    }
}
if ($result_pa[0] == '1') {
    foreach ($result_pa[2] as $row2) {
        $cuantos_p = $row2['cuantos_p'];
    }
}
if ($result_ci_c[0] == '1') {
    foreach ($result_ci_c[2] as $row4) {
        $cuantos_c = $row4['cuantos_c'];
    }
}
if ($result_cita[0] == '1') {
    $fecha_actual = new DateTime(date('Y-m-d ')); //nueva variable para vencimiento//
    foreach ($result_cita[2] as $row3) {
        $fecha_final = new DateTime($row3['fecha']);
        $dias = $fecha_actual->diff($fecha_final)->format('%r%a');

        if ($dias == 0) {
            $htmltr .= '<tr>
               <td>' . $row3['nombre'] . '</td>
               <td>' . $row3['apellido'] . '</td>
               <td>' . $row3['dui'] . '</td>
               <td>' . $row3['telefono'] . '</td>
               <td>' . $row3['fecha'] . '</td>
               <td>' . $row3['hora'] . '</td>
             </tr>';
        }
    }
    $html .= '<table id="tabla_citas" class="table " cellspacing="0" width="100%">
    <thead class="table-dark">
        <tr>
            <th>NOMBRE</th>
            <th>APELLIDO</th>
            <th>DUI</th>
            <th>TELEFONO</th>
            <th>FECHA DE CITA</th>
            <th>HORA DE CITA</th>
        </tr>
    </thead>
    <tbody>';
    $html .= $htmltr;
    $html .= '</tbody>
        </table>';
    print json_encode(array("Exito", $cuantos, $cuantos_p, $cuantos_c, $sql_citas, $html, $dias, $fecha_actual, $fecha_final, $total_consultas, $fecha_consulta, $resutl_consulta[2]));
    exit();
} else {
    print json_encode(array("Error", $_POST, $result, $result_pa, $result_cita));
    exit();
}

function fecha($fecha3)
{

    //divido la feha de la hora
    $separacion = explode(" ", $fecha3);
    $hora = $separacion[1];
    $fecha = $separacion[0];

    return $fecha;
}
