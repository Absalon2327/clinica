<?php
@session_start();
require_once("../Modelo/Modelo.php");
require_once("sql_historial/mostrar_historiales.php");
$modelo = new Modelo();

if (isset($_POST['mostrar_registro_hc']) && $_POST['mostrar_registro_hc'] == "si_coneste_id") {

    $htmltr = $html = "";

    $sql_expediente = "";
    $sql_historial = ver_historial($_POST['id']);

    $result_expediente = "";
    $result_historial = $modelo->get_query($sql_historial);


    if ($result_historial[0] == '1') {

        foreach ($result_historial[2] as $row) {

            //$edad = evaluar_edad($row['edad']);

            $htmltr .= '<tr>
                                <td class="text-center">' . $row['diagnostico'] . '</td>
                                <td class="text-center">' . $row['receta'] . '</td>
                                <td class="text-center">' . datetimeformateado($row['fecha_consulta']) . '</td>                                
                                <td class="text-center">' . Hora($row['fecha_consulta']) . '</td>
                                <td class="text-center project-actions">			                        
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger btn_eliminar" 
                                        data-historial="' . $row['id_histo_cli'] . '"
                                        data-consulta="' . $row['idconsulta'] . '">
                                        Eliminar
                                        <i class="tf-icons bx bx-trash"></i>
                                    </button>
                                </td>	                           
                            </tr>';
        }
        $html .= '<table class="table" id="tabla_historiales">
						<thead class="table-dark">
							<tr>								
                                <th class="text-center">Diagnóstico</th>
                                <th class="text-center">Medicamento Aplicado</th>                                
                                <th class="text-center">Fecha</th>                                                               
                                <th class="text-center">Hora</th>
                                <th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody class="table-border-bottom-0">';
        $html .= $htmltr;
        $html .= '</tbody>
                    </table>';

        print json_encode(array("Exito", $html, $cuantos, $_POST, $result_historial[2][0]));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result_historial));
        exit();
    }
} else if (isset($_POST['elimnar_hc']) && $_POST['elimnar_hc'] == "si_coneste_id") {


    $array_actualizar_consulta = array(
        "table" => "tb_consulta",
        "id_consulta" => $_POST['idconsulta'],
        "estado_consulta" => 'inactiva'
    );

    $resultado_consulta = $modelo->actualizar_generica($array_actualizar_consulta);

    $array_eliminar = array(
        "table" => "tb_histo_clinico",
        "id_histo_cli" => $_POST['id']

    );

    if ($resultado_consulta[0] == '1' && $resultado_consulta[4] > 0) {

        $resultado_histo = $modelo->eliminar_generica($array_eliminar);

        if ($resultado_histo[0] == '1' && $resultado_histo[4] > 0) {
            print json_encode(array("Exito", $_POST, $resultado_histo, $resultado_consulta));
            exit();
        } else {
            print json_encode(array("Error histo", $_POST, $resultado_histo));
            exit();
        }
    } else {
        print json_encode(array("Error consulta", $_POST, $resultado_consulta));
        exit();
    }
} else {

    $htmltr = $html = "";
    $htmltr2 = $html2 = "";
    $cuantos = 0;
    $edad = 0;

    $sql_h_adultos = select_historiales();
    $result_h_adultos = $modelo->get_query($sql_h_adultos);

    $sql_h_niños = select_historiales();
    $result_h_niños = $modelo->get_query($sql_h_niños);

    if ($result_h_niños[0] == '1') {
        foreach ($result_h_niños[2] as $row2) {

            $edad = evaluar_edad($row2['edad']);

            if ($edad < 18) {
                $htmltr2 .= '<tr>
								<td class="text-center">' . $row2['paciente'] . '</td>
								<td class="text-center">' . datetimeformateado($row2['fecha_consulta']) . '</td>				  				
								<td class="text-center project-actions">			                        
                                    <button type="button" class="btn btn-sm rounded-pill btn-success btn_ver_registros" 
                                        data-expediente="' . $row2['id_expediente'] . '" data-historial="' . $row2['id_histo_cli'] . '">
                                        Ver Registros
                                        <i class="tf-icons bx bx-show"></i>
                                    </button>
								</td>	                           
	                        </tr>';
            }
        }
        $html2 .= '<table class="table" id="tabla_historial_niños">
						<thead class="table-dark">
							<tr>								
								<th class="text-center">Paciente</th>
								<th class="text-center">Última Visita</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody class="table-border-bottom-0">';
        $html2 .= $htmltr2;
        $html2 .= '</tbody>
                    </table>';
    } else {
        print json_encode(array("Error h_niños", $_POST, $result_h_niños));
        exit();
    }


    if ($result_h_adultos[0] == '1') {

        foreach ($result_h_adultos[2] as $row) {

            $edad = evaluar_edad($row['edad']);

            if ($edad >= 18) {
                $htmltr .= '<tr>
                                <td class="text-center">' . $row['paciente'] . '</td>
                                <td class="text-center">' . datetimeformateado($row['fecha_consulta']) . '</td>
                                <td class="text-center project-actions">			                        
                                    <button type="button" class="btn btn-sm rounded-pill btn-success btn_ver_registros" 
                                        data-expediente="' . $row['id_expediente'] . '" data-historial="' . $row['id_histo_cli'] . '">
                                        Ver Registros
                                        <i class="tf-icons bx bx-show"></i>
                                    </button>
                                </td>	                           
                            </tr>';
            }
        }
        $html .= '<table class="table" id="tabla_historial_adultos">
						<thead class="table-dark">
							<tr>								
                                <th class="text-center">Paciente</th>
                                <th class="text-center">Última Visita</th>
                                <th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody class="table-border-bottom-0">';
        $html .= $htmltr;
        $html .= '</tbody>
                    </table>';

        print json_encode(array("Exito", $html, $html2, $cuantos, $_POST, $result_h_adultos, $result_h_niños));
        exit();
    } else {
        print json_encode(array("Error h_adultos", $_POST, $result_h_adultos));
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
    $edad = intval($año_actual) - intval($año);

    return $edad;
}

function datetimeformateado($fecha3)
{

    //divido la feha de la hora
    $separacion = explode(" ", $fecha3);
    $hora = $separacion[1];
    $fecha = $separacion[0];

    $pos = strpos($fecha, "/");
    if ($pos === false) $fecha = explode("-", $fecha);
    else $fecha = explode("/", $fecha);
    $dia1 = (strlen($fecha[0]) == 1) ? '0' . $fecha[0] : $fecha[0];

    //Concateno la fecha formteada con la hora y un espacio
    $fecha1 = $fecha[2] . '-' . $fecha[1] . '-' . $dia1;

    return $fecha1;
}

function Hora($fecha)
{

    //divido la feha de la hora
    $separacion = explode(" ", $fecha);
    $hora = $separacion[1];

    return $hora;
}
