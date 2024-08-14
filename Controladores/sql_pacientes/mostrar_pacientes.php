<?php
function select_pacientes()
{
    return $sql = "SELECT
						* 
					FROM
						tb_paciente 
					WHERE
						estado_paciente = 'activo';";
}

function select_pacientes_in()
{
    return $sql = "SELECT
                        *
                    FROM
                        tb_paciente AS pa
                    WHERE
                        pa.estado_paciente = 'inactivo';";
}

function sql_pacientes_multi($dui)
{
    return $sql = "SELECT 
                        pa.dui_paciente
                     FROM 
                        tb_paciente AS pa
                    WHERE 
                        pa.dui_paciente = '$dui'";
}

function sql_pacientes_multii($tel)
{
    return $sql = "SELECT 
                        pa.tel_paciente
                     FROM 
                        tb_paciente AS pa
                    WHERE 
                        pa.tel_paciente = '$tel'";
}

function sql_pacientes_nombre($nombre)
{
    return $sql = "SELECT 
                        pa.nombres_encargado
                     FROM 
                        tb_paciente AS pa
                    WHERE 
                         pa.nombres_encargado = '$nombre'";
}
