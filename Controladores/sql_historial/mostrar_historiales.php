<?php
function select_historiales()
{
    return $sql = "SELECT
                        CONCAT( tb_paciente.nombre_paciente, ' ', tb_paciente.apellido_paciente ) AS paciente,
                        tb_expediente.id_expediente,
                        tb_histo_clinico.id_histo_cli,
                        tb_histo_clinico.idconsulta,
                        tb_histo_clinico.diagnostico_consulta AS diagnostico,
                        tb_histo_clinico.estado_hc,
                        tb_consulta.receta_consulta AS receta,
                        MAX( tb_consulta.fecha_consulta ) AS fecha_consulta,
                        tb_paciente.sexo_paciente,
                        tb_paciente.nombres_encargado AS encargado,
                        tb_paciente.fecha_paciente AS edad 
                    FROM
                        tb_histo_clinico
                        INNER JOIN tb_consulta ON tb_histo_clinico.idconsulta = tb_consulta.id_consulta
                        INNER JOIN tb_preparar ON tb_consulta.id_expediente_preparado = tb_preparar.id_expe_preparado
                        INNER JOIN tb_expediente ON tb_preparar.idexpediente = tb_expediente.id_expediente
                        INNER JOIN tb_paciente ON tb_expediente.id_paciente = tb_paciente.id_paciente 
                    WHERE
                        tb_expediente.estado_expe = 'activo'
                    GROUP BY
                        paciente";
}

function ver_historial($id)
{
    return $sql = "SELECT
                        CONCAT( tb_paciente.nombre_paciente, ' ', tb_paciente.apellido_paciente ) AS paciente,
                        tb_expediente.id_expediente,
                        tb_histo_clinico.id_histo_cli,
                        tb_histo_clinico.idconsulta,
                        tb_histo_clinico.diagnostico_consulta AS diagnostico,
                        tb_histo_clinico.estado_hc,
                        tb_consulta.receta_consulta AS receta,
                        tb_consulta.fecha_consulta,
                        tb_paciente.sexo_paciente,
                        tb_paciente.nombres_encargado AS encargado,
                        tb_paciente.fecha_paciente AS edad,
                        tb_consulta.estado_consulta
                    FROM
                        tb_histo_clinico
                        INNER JOIN tb_consulta ON tb_histo_clinico.idconsulta = tb_consulta.id_consulta
                        INNER JOIN tb_preparar ON tb_consulta.id_expediente_preparado = tb_preparar.id_expe_preparado
                        INNER JOIN tb_expediente ON tb_preparar.idexpediente = tb_expediente.id_expediente
                        INNER JOIN tb_paciente ON tb_expediente.id_paciente = tb_paciente.id_paciente 
                    WHERE
                        estado_hc = 'activo'                         
                        AND tb_consulta.estado_consulta = 'pagada' 
                        AND tb_expediente.id_expediente = $id";
}
