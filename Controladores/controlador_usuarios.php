<?php
require_once("../Modelo/Modelo.php");
$modelo = new Modelo();
 if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos'] == "si_registro") {
    $encontro = "";
	//consulta para obtener el nombre 
	$sql = "SELECT
    dui,usuario 
    FROM
    tb_usuario;";

	$result_nombre = $modelo->get_query($sql);
    if ($result_nombre[0] == '1'){
        foreach ($result_nombre[2] as $row) {

			if ($row['dui'] == $_POST['duif'] && $row['usuario'] == $_POST['usuariof']) {
				$encontro = "dui y usuario econtrado";
				break;
			}else if ($row['dui'] == $_POST['duif']){
                $encontro = "dui econtrado";
				break;  
            }else if ($row['usuario'] == $_POST['usuariof']){
                $encontro = "usuario econtrado";
                break; 
            }
		}
   
        if ($encontro == "dui y usuario econtrado") {
			print json_encode(array("Error", "ya existen estos datos de usuario y dui", $result_nombre));
			exit();
			//si encontramos un usuario con un usuario creado, notificamos antes de guardar

		}else if ($encontro == "usuario econtrado" ){
            print json_encode(array("Error", "existe usuario", $result_nombre));
			exit();
        }else if ($encontro == "dui econtrado" ){
            print json_encode(array("Error", "existe dui", $result_nombre));
			exit();
        }
        else {
            $id_insertar = $modelo->retonrar_id_insertar("tb_usuario");
            $array_insertar = array(
                "table" => "tb_usuario",
                "idusuario" => $id_insertar,
                "dui" => $_POST['duif'],
                "nombre" => $_POST['nombref'],
                "usuario" => $_POST['usuariof'],
                "contrasena" => $modelo->encriptarlas_contrasenas($_POST['contrasenaf']),
                "tipo" => $_POST['tipof'],
                "estado"=>"Activo"
            );
            $result = $modelo->insertar_generica($array_insertar);
            if ($result[0] == '1') {
                print json_encode(array("Exito", $_POST, $result[2][0]));
                exit();
            } else {
                print json_encode(array("Error", $_POST, $result));
                exit();
            }

        }
    }else{
        $id_insertar = $modelo->retonrar_id_insertar("tb_usuario");
        $array_insertar = array(
            "table" => "tb_usuario",
            "idusuario" => $id_insertar,
            "dui" => $_POST['duif'],
            "nombre" => $_POST['nombref'],
            "usuario" => $_POST['usuariof'],
            "contrasena" => $modelo->encriptarlas_contrasenas($_POST['contrasenaf']),
            "tipo" => $_POST['tipof'],
            "estado"=>"Activo"
        );
        $result = $modelo->insertar_generica($array_insertar);
        if ($result[0] == '1') {
            print json_encode(array("Exito", $_POST, $result[2][0]));
            exit();
        } else {
            print json_encode(array("Error", $_POST, $result));
            exit();
        }
    }
  
  
}else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos']=="si_actualizalo") {
  
    $array_update = array(
        "table" => "tb_usuario",
        "idusuario" => $_POST['llave_persona'],
        "dui" => $_POST['duif'],
        "nombre" => $_POST['nombref'],
        "usuario" => $_POST['usuariof'],
        "tipo" => $_POST['tipof'],
       // "contrasena"=>$_POST['contrasenaf']
    );
    $resultado = $modelo->actualizar_generica($array_update);

    if($resultado[0]=='1' && $resultado[4]>0){
        print json_encode(array("Exito",$_POST,$resultado));
        exit();

    }else {
        print json_encode(array("Error",$_POST,$resultado));
        exit();
    }


}else if (isset($_POST['consultar_info']) && $_POST['consultar_info'] == "si_condui_especifico") {
    $sql ="SELECT contrasena FROM tb_usuario WHERE idusuario = '" . $_POST['id'] . "'";
    $resultado = $modelo->get_query($sql);
    if ($resultado[0]==1 ){
        $verificacion = $modelo->desencrilas_contrasena($_POST['contrasenaf'],$resultado[2][0]['contrasena']);   
    }
	$resultado = $modelo->get_todos("tb_usuario", "WHERE idusuario = '" . $_POST['id'] . "'");
	if ($resultado[0] == '1') {
		print json_encode(array("Exito", $_POST, $resultado[2][0]));
		exit();
	} else {
		print json_encode(array("Error", $_POST, $resultado));
		exit();
	}
}else if (isset($_POST['action']) && $_POST['action'] == "invalidar" &&  $_POST['id'] != "") {
    $array_update = array(
        "table" => "tb_usuario",
        "idusuario" => $_POST['id'],
        "estado" => "inactiva"
    );

    $result = $modelo->actualizar_generica($array_update);

    if ($result[0] == '1' && $result[4] > 0) {
        print json_encode(array("Exito", $_POST, $result));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
} else {
    //$result_select = $modelo->crear_select($array_select);
    $htmltr = $html = "";
    $cuantos = 0;
    $sql = "SELECT *,(SELECT count(*) as cuantos FROM tb_usuario) as cuantos FROM tb_usuario where estado='Activo'";
    $result = $modelo->get_query($sql);
    if ($result[0] == '1') {
        foreach ($result[2] as $row) {
            $cuantos = $row['cuantos'];
            $tipo = ($row['tipo'] == 2) ? "Empleado" : "Administrador";
            $htmltr .= '<tr>
                                <td>' . $row['nombre'] . '</td>
                                <td>' . $row['dui'] . '</td>
	                            <td>' . $row['usuario'] . '</td>
	                            <td>' . $tipo . '</td>
	                            <td class="text-center">

                                    <a class="btn btn-sm rounded-pill btn-info btn_editar"
                                     data-idusuario="' . $row['idusuario'] . '" >Modificar
                                     <i class="tf-icons bx bx-pencil"></i>
                                     </a>
                                   <a class="btn btn-sm rounded-pill btn-danger btn_inactivar"   data-idusuario= "' . $row['idusuario'] . '" >Inactivar
                                   <i class="tf-icons bx bx-trash"></i>
                                   </a>
                            </td>
                        </tr>';
        }
        $html .= '<table id="tabla_usuarios" class="table " cellspacing="0" width="100%">
                    <thead class="table-dark">

                        <tr>
                            <th>Nombre</th>
                            <th>DUI</th>
                            <th>Usuario</th>
                            <th>Tipo de Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
        $html .= $htmltr;
        $html .= '</tbody>
                    	</table>';
        print json_encode(array("Exito", $html,  $cuantos, $sql));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
}
?>
