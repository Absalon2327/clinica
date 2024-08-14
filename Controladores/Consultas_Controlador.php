<?php
@session_start();
require_once("../Modelo/Modelo.php");
require_once("sql_consultas/mostrar_consultas.php");
$modelo = new Modelo();


if (isset($_POST['almacenar_datos']) && $_POST['almacenar_datos'] == "nueva_consulta") {


	$array_insertar = array(
		"table" => "tb_consulta",
		"id_expediente_preparado" => $_POST['idexpe_preparado'],
		"receta_consulta" => $_POST['receta_consulta'],
		"fecha_consulta" => date("Y-m-d G:i:s"),
		"monto_consulta" => $_POST['monto_consulta'],
		"estado_consulta" => 'realizada'
	);

	$array_actualizar_exp = array(
		"table" => "tb_expediente",
		"id_expediente" => $_POST['idexpediente'],
		"estado_preparacion" => 0
	);

	$array_actualizar_pre = array(
		"table" => "tb_preparar",
		"id_expe_preparado" => $_POST['idexpe_preparado'],
		"estado_preparacion" => 0
	);

	$resultado = $modelo->insertar_generica($array_insertar);

	$resultado_p = $modelo->actualizar_generica($array_actualizar_exp);

	$resultado_pre = $modelo->actualizar_generica($array_actualizar_pre);



	if ($resultado[0] == '1' && $resultado[4] > 0) {

		if ($resultado_p[0] == '1' && $resultado_p[4] > 0) {

			if ($resultado_pre[0] == '1' && $resultado_pre[4] > 0) {

				$ultima_consulta = $modelo->get_query(ultima_consulta_realizada());

				if ($ultima_consulta[0] == '1' && $ultima_consulta[4] > 0) {

					$array_insertar_historial = array(
						"table" => "tb_histo_clinico",
						"idconsulta" => $ultima_consulta[2][0]['id_consulta'],
						"diagnostico_consulta" => $_POST['diagnostico_consulta'],
						"estado_hc" => 'activo'
					);

					$resultado_hc = $modelo->insertar_generica($array_insertar_historial);

					if ($resultado_hc[0] == '1' && $resultado_hc[4] > 0) {

						print json_encode(array("Exito", $_POST, $resultado, $resultado_p, $resultado_pre, $resultado_hc));
						exit();

					} else {						
						print json_encode(array("Error hc", $_POST, $resultado, $resultado_p, $resultado_pre, $resultado_hc));
						exit();
					}
				} else {
					print json_encode(array("Error id_conuslta", $_POST, $ultima_consulta));
					exit();
				}
			} else {
				print json_encode(array("Error preparar", $_POST, $resultado, $resultado_p, $resultado_pre));
				exit();
			}
		} else {

			print json_encode(array("Error expediente", $_POST, $resultado, $resultado_p, $resultado_pre));
			exit();
		}
	} else {
		print json_encode(array("Error consulta", $_POST, $resultado, $resultado_p, $resultado_pre));
		exit();
	}
} else if (isset($_POST['consultar_info']) && $_POST['consultar_info'] == "si_coneste_id") {

	$sql = expediente_preparados_paciente($_POST['id']);
	$sql_p = datos_preparacion($_POST['id']);
	$sql_vc = ver_consulta_finalizada($_POST['idconsulta']);

	$resultado = $modelo->get_query($sql);
	$resultado_p = $modelo->get_query($sql_p);
	$result_vc = $modelo->get_query($sql_vc);

	if ($resultado[0] == '1') {
		print json_encode(array("Exito", $_POST, $resultado[2][0], $resultado_p[2][0], $result_vc[2][0]));
		exit();
	} else {
		print json_encode(array("Error", $_POST, $resultado, $resultado_p));
		exit();
	}
} else {

	$htmltr = $html = "";
	$htmltr2 = $html2 = "";
	$cuantos = 0;
	$edad = 0;

	$sql = expediente_preparados();
	$result = $modelo->get_query($sql);

	$sql_c = consulta_realizada();
	$result_consultas = $modelo->get_query($sql_c);

	if ($result_consultas[0] == '1') {
		foreach ($result_consultas[2] as $row2) {

			$edad = evaluar_edad($row2['fecha_paciente']);

			$htmltr2 .= '<tr>
								<td>' . $row2['nombre_paciente'] . ' ' . " " . ' ' . $row2['apellido_paciente'] . '</td>
								<td>' . datetimeformateado($row2['fecha_consulta']) . '</td>
				  				<td>$ ' . $row2['monto_consulta'] . '</td>
								<td class="text-center project-actions">			                        
									<button class="btn btn-sm rounded-pill btn-success btn_ver_consulta"
										data-consulta="' . $row2['id_consulta'] . '" data-expediente="' . $row2['id_expediente'] . '"  >
										Ver <i class="tf-icons bx bx-show"></i>
									</button>
								</td>	                           
	                        </tr>';
		}
		$html2 .= '<table class="table" id="tabla_consulta_realizada">
						<thead class="table-dark">
							<tr>								
								<th>Paciente</th>
								<th>Fecha</th>
								<th>Monto</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody class="table-border-bottom-0">';
		$html2 .= $htmltr2;
		$html2 .= '</tbody>
                    </table>';
	} else {
		print json_encode(array("Error consulta", $_POST, $result_consultas));
		exit();
	}


	if ($result[0] == '1') {

		foreach ($result[2] as $row) {

			$edad = evaluar_edad($row['fecha_paciente']);

			$htmltr .= '<tr>
							<td>' . $row['nombre_paciente'] . ' ' . " " . ' ' . $row['apellido_paciente'] . '</td>
							<td>' . $edad . '</td>
				  			<td>' . $row['sexo_paciente'] . '</td>
							<td class="text-center project-actions">			                        
								<button class="btn btn-sm rounded-pill btn-info btn_realizar_consulta"
								data-expediente = "' . $row['id_expediente'] . '">
									Realizar <i class="tf-icons bx bx-pencil"></i>
								</button>
							</td>	                           
	                    </tr>';
		}
		$html .= '<table class="table" id="tabla_consulta_pendiente">
						<thead class="table-dark">
							<tr>								
								<th>Paciente</th>
								<th>Edad</th>
								<th>Sexo</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody class="table-border-bottom-0">';
		$html .= $htmltr;
		$html .= '</tbody>
                    </table>';

		print json_encode(array("Exito", $html, $html2, $cuantos, $_POST, $result, $result_consultas));
		exit();
	} else {
		print json_encode(array("Error preparacion", $_POST, $result));
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
    $fecha1 = $fecha[2] . '-' . $fecha[1] . '-' . $dia1 . ' ' . $hora;
    return $fecha1;
}
