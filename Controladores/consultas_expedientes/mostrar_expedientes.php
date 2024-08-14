<?php
function select_todos_activos()
{
    return $sql = "SELECT
                        tb_expediente.*, 
                        CONCAT(tb_paciente.nombre_paciente, ' ', tb_paciente.apellido_paciente) AS paciente,                        
                        tb_paciente.direccion_paciente,
                        tb_paciente.sexo_paciente,
	                    tb_paciente.fecha_paciente,
                        tb_paciente.nombres_encargado
                    FROM
                        tb_expediente
                        INNER JOIN tb_paciente ON tb_expediente.id_paciente = tb_paciente.id_paciente 
                    WHERE
                        estado_expe = 'activo'";
}

function mostrar_paciente($id)
{
    return $sql = "SELECT
                        tb_paciente.id_paciente,
                        CONCAT(tb_paciente.nombre_paciente, ' ', tb_paciente.apellido_paciente) AS paciente, 
                        tb_paciente.dui_paciente, 
                        tb_paciente.fecha_paciente, 
                        tb_paciente.tel_paciente, 
                        tb_paciente.direccion_paciente, 
                        tb_paciente.nombres_encargado, 
                        tb_paciente.sexo_paciente, 
                        tb_paciente.estado_paciente
                    FROM
                        tb_paciente 
                    WHERE
                        estado_paciente = 'activo' 
                        AND id_paciente = $id";
}

function select_todos_inactivos()
{
    return $sql = "SELECT
                        tb_expediente.*,
                        CONCAT(tb_paciente.nombre_paciente, ' ', tb_paciente.apellido_paciente) AS paciente,
                        tb_paciente.direccion_paciente,
                        tb_paciente.sexo_paciente,
                        tb_paciente.fecha_paciente 
                    FROM
                        tb_expediente
                        INNER JOIN tb_paciente ON tb_expediente.id_paciente = tb_paciente.id_paciente 
                    WHERE
                        estado_expe = 'inactivo'";
}

function select_pacientes()
{
    return $sql = "SELECT
                        tb_paciente.id_paciente,
                        tb_paciente.dui_paciente,
                        tb_paciente.nombre_paciente,
                        tb_paciente.apellido_paciente,
                        tb_paciente.fecha_paciente,
                        tb_paciente.nombres_encargado
                    FROM
                        tb_paciente 
                    WHERE
                        tb_paciente.estado_paciente = 'activo'";
}

function paciente_encargado($id)
{
    return $sql = "SELECT
                        tb_paciente.sexo_paciente,
                        tb_paciente.fecha_paciente,
                        CONCAT( tb_paciente.nombre_paciente, ' ', tb_paciente.apellido_paciente ) AS paciente,
                        ( SELECT CONCAT( t.nombre_paciente, ' ', t.apellido_paciente ) 
                                FROM 
                                tb_paciente t 
                                WHERE 
                                id_paciente = tb_paciente.id_encargado ) AS encargado
                    FROM
                        tb_paciente 
                    WHERE
                        tb_paciente.id_paciente = '$id'";
}


function verificar_paciente_añadido($id)
{
    return $sql = "SELECT
                        tb_expediente.id_paciente AS Expdiente 
                    FROM
                        tb_expediente
                        INNER JOIN tb_paciente ON tb_expediente.id_paciente = tb_paciente.id_paciente 
                    WHERE
                        tb_expediente.id_paciente = $id ";
}

function editar_expediente($id)
{
    return $sql = "SELECT
                        CONCAT( tb_paciente.nombre_paciente, ' ', tb_paciente.apellido_paciente ) AS paciente,
                        tb_paciente.fecha_paciente,
                        tb_paciente.sexo_paciente,
                        tb_paciente.nombres_encargado,
                        tb_expediente.* 
                    FROM
                        tb_expediente
                        INNER JOIN tb_paciente ON tb_expediente.id_paciente = tb_paciente.id_paciente 
                    WHERE
                        tb_expediente.id_expediente = $id ";
}
