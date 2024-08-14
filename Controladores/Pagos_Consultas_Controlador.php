<?php
@session_start();
require_once("../Modelo/Modelo.php");
require_once("sql_consultas/mostrar_consultas.php");
$modelo = new Modelo();


if (isset($_POST['almacenar_datos']) && $_POST['almacenar_datos'] == "nuevo_pago") {


	$array_insertar = array(
		"table" => "tb_pagos",
		"id_consulta" => $_POST['idconsulta'],
		"monto_pago" => $_POST['monto_consulta_pago_g'],
		"fecha_pago" => date("Y-m-d G:i:s"),
		"estado_pago" => "activo"
	);

	$array_actualizar_consulta = array(
		"table" => "tb_consulta",
		"id_consulta" => $_POST['idconsulta'],
		"estado_consulta" => 'pagada'
	);


	$resultado = $modelo->insertar_generica($array_insertar);

	$resultado_consulta = $modelo->actualizar_generica($array_actualizar_consulta);



	if ($resultado[0] == '1' && $resultado[4] > 0) {

		if ($resultado_consulta[0] == '1' && $resultado_consulta[4] > 0) {

			print json_encode(array("Exito", $_POST, $resultado, $resultado_consulta));
			exit();

		} else {

			print json_encode(array("Error consulta", $_POST, $resultado, $resultado_consulta));
			exit();
		}
	} else {
		print json_encode(array("Error pagos", $_POST, $resultado, $resultado_consulta));
		exit();
	}
} else if (isset($_POST['consultar_info']) && $_POST['consultar_info'] == "si_coneste_id") {


	$sql_rea = consulta_realizada_especifica($_POST['idconsulta']);
	$sql_pg = pagos($_POST['idpago']);

	$result_pg = $modelo->get_query($sql_pg);
	$resultado = $modelo->get_query($sql_rea);

	if ($resultado[0] == '1' || $result_pg[0] == '1') {
		print json_encode(array("Exito", $_POST, $resultado[2][0], $result_pg[2][0]));
		exit();
	} else {
		print json_encode(array("Error", $_POST, $resultado));
		exit();
	}
} else if (isset($_POST['inactivar_pago']) && $_POST['inactivar_pago'] == "si_coneste_id") {
    $array_update = array(
        "table" => "tb_pagos",
        "id_pagos" => $_POST['id'],
        "estado_pago" => "inactivo"

    );
    $resultado = $modelo->actualizar_generica($array_update);
    if ($resultado[0] == '1' && $resultado[4] > 0) {
        print json_encode(array("Exito", $_POST, $resultado, $resultado[4]));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $resultado));
        exit();
    }
} else {

	$htmltr = $html = "";
	$htmltr2 = $html2 = "";
	$cuantos = 0;
	$edad = 0;

	$sql = consulta_realizada_pago();
	$result_rea = $modelo->get_query($sql);

	$sql_pg = consulta_pagada();
	$result_pg = $modelo->get_query($sql_pg);

	if ($result_rea[0] == '1') {
		foreach ($result_rea[2] as $row2) {

			$edad = evaluar_edad($row2['fecha_paciente']);

			$htmltr2 .= '<tr>
								<td>' . $row2['nombre_paciente'] . ' ' . " " . ' ' . $row2['apellido_paciente'] . '</td>
								<td>' . datetimeformateado($row2['fecha_consulta']) . '</td>
				  				<td>$ ' . $row2['monto_consulta'] . '</td>
								<td class="text-center project-actions">			                        
									<button class="btn btn-sm rounded-pill btn-info btn_facturar"
										data-consulta="' . $row2['id_consulta'] . '" data-expediente="' . $row2['id_expediente'] . '">
										Facturar <i class="bx bxs-file"></i>
									</button>
								</td>	                           
	                        </tr>';
		}
		$html2 .= '<table class="table" id="tabla_consulta_pendiente">
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
		print json_encode(array("Error consulta", $_POST, $result_rea));
		exit();
	}


	if ($result_pg[0] == '1') {

		foreach ($result_pg[2] as $row) {

			$edad = evaluar_edad($row['fecha_paciente']);

			$htmltr .= '<tr>
							<td>' . $row['nombre_paciente'] . ' ' . " " . ' ' . $row['apellido_paciente'] . '</td>
							<td>' . datetimeformateado($row['fecha_consulta']) . '</td>
				  			<td>$ ' . $row['monto_consulta'] . '</td>
							<td class="text-center project-actions">			                        
								<button class="btn btn-sm rounded-pill btn-success btn_verpago" data-pago="' . $row['id_pagos'] . '">Ver
                                    <i class="tf-icons bx bx-show"></i>
								</button>
                                <button class="btn btn-sm rounded-pill btn-danger btn_inactivar" data-pago="' . $row['id_pagos'] . '">Inactivar
                                    <i class="tf-icons bx bx-trash"></i>
								</button>
							</td>	                           
	                    </tr>';
		}
		$html .= '<table class="table" id="tabla_consulta_pagada">
						<thead class="table-dark">
							<tr>								
								<th>Paciente</th>
								<th>Fecha</th>
								<th>Monto</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody class="table-border-bottom-0">';
		$html .= $htmltr;
		$html .= '</tbody>
                    </table>';

		print json_encode(array("Exito", $html, $html2, $cuantos, $_POST, $result_pg, $result_rea));
		exit();
	} else {
		print json_encode(array("Error pago", $_POST, $result_pg));
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
