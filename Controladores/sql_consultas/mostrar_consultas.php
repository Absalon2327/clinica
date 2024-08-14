<?php
function expediente_preparados(){
    return $sql = "SELECT
                        * 
                    FROM
                        tb_preparar
                        INNER JOIN tb_expediente ON tb_preparar.idexpediente = tb_expediente.id_expediente
                        INNER JOIN tb_paciente ON tb_expediente.id_paciente = tb_paciente.id_paciente 
                    WHERE
                        tb_preparar.estado_preparacion = 1";
}

function consulta_realizada(){

    return $sql = "SELECT
                        * 
                    FROM
                        tb_consulta
                        INNER JOIN tb_preparar ON tb_consulta.id_expediente_preparado = tb_preparar.id_expe_preparado
                        INNER JOIN tb_expediente ON tb_preparar.idexpediente = tb_expediente.id_expediente
                        INNER JOIN tb_paciente ON tb_expediente.id_paciente = tb_paciente.id_paciente 
                    WHERE
                        tb_consulta.estado_consulta = 'realizada' 
	                    OR tb_consulta.estado_consulta = 'pagada'";

}

function consulta_realizada_pago(){

    return $sql = "SELECT
                        * 
                    FROM
                        tb_consulta
                        INNER JOIN tb_preparar ON tb_consulta.id_expediente_preparado = tb_preparar.id_expe_preparado
                        INNER JOIN tb_expediente ON tb_preparar.idexpediente = tb_expediente.id_expediente
                        INNER JOIN tb_paciente ON tb_expediente.id_paciente = tb_paciente.id_paciente 
                    WHERE
                        tb_consulta.estado_consulta = 'realizada'";

}

function expediente_preparados_paciente($id){
    return $sql = "SELECT
                        * 
                    FROM
                        tb_preparar
                        INNER JOIN tb_expediente ON tb_preparar.idexpediente = tb_expediente.id_expediente
                        INNER JOIN tb_paciente ON tb_expediente.id_paciente = tb_paciente.id_paciente 
                    WHERE
                        tb_preparar.estado_preparacion = 1
                    AND tb_expediente.id_expediente = $id";
}

function datos_preparacion($id){
    return $sql = "SELECT
                        * 
                    FROM
                        tb_preparar 
                    WHERE
                        idexpediente = $id";
}

function ultima_consulta_realizada(){

    return $sql = "SELECT
                        * 
                    FROM
                        tb_consulta
                        INNER JOIN tb_preparar ON tb_consulta.id_expediente_preparado = tb_preparar.id_expe_preparado
                        INNER JOIN tb_expediente ON tb_preparar.idexpediente = tb_expediente.id_expediente
                        INNER JOIN tb_paciente ON tb_expediente.id_paciente = tb_paciente.id_paciente 
                    WHERE
                        tb_consulta.estado_consulta = 'realizada' 
                        OR tb_consulta.estado_consulta = 'pagada'
                    ORDER BY 
                        tb_consulta.id_consulta DESC 
                        LIMIT 1";

}

function ver_consulta_finalizada($id){
   return $sql =  "SELECT
                        * 
                    FROM
                        tb_histo_clinico
                        INNER JOIN tb_consulta ON tb_histo_clinico.idconsulta = tb_consulta.id_consulta
                        INNER JOIN tb_preparar ON tb_consulta.id_expediente_preparado = tb_preparar.id_expe_preparado
                        INNER JOIN tb_expediente ON tb_preparar.idexpediente = tb_expediente.id_expediente
                        INNER JOIN tb_paciente ON tb_expediente.id_paciente = tb_paciente.id_paciente 
                    WHERE
                        tb_consulta.id_consulta = $id";
}

function consulta_pagada(){

    return $sql = "SELECT
                        * 
                    FROM
                        tb_pagos
                        INNER JOIN tb_consulta ON tb_pagos.id_consulta = tb_consulta.id_consulta
                        INNER JOIN tb_preparar ON tb_consulta.id_expediente_preparado = tb_preparar.id_expe_preparado
                        INNER JOIN tb_expediente ON tb_preparar.idexpediente = tb_expediente.id_expediente
                        INNER JOIN tb_paciente ON tb_expediente.id_paciente = tb_paciente.id_paciente 
                    WHERE
                        tb_pagos.estado_pago = 'activo'";

}

function pagos($id){

    return $sql = "SELECT
                        * 
                    FROM
                        tb_pagos
                        INNER JOIN tb_consulta ON tb_pagos.id_consulta = tb_consulta.id_consulta
                        INNER JOIN tb_preparar ON tb_consulta.id_expediente_preparado = tb_preparar.id_expe_preparado
                        INNER JOIN tb_expediente ON tb_preparar.idexpediente = tb_expediente.id_expediente
                        INNER JOIN tb_paciente ON tb_expediente.id_paciente = tb_paciente.id_paciente 
                    WHERE
                        tb_pagos.id_pagos = $id
                        AND tb_pagos.estado_pago = 'activo'";

}

function pagos_imprimir($id){

    return $sql = "SELECT
                        * 
                    FROM
                        tb_pagos
                        INNER JOIN tb_consulta ON tb_pagos.id_consulta = tb_consulta.id_consulta
                        INNER JOIN tb_preparar ON tb_consulta.id_expediente_preparado = tb_preparar.id_expe_preparado
                        INNER JOIN tb_expediente ON tb_preparar.idexpediente = tb_expediente.id_expediente
                        INNER JOIN tb_paciente ON tb_expediente.id_paciente = tb_paciente.id_paciente                        
	                    INNER JOIN tb_histo_clinico ON tb_consulta.id_consulta = tb_histo_clinico.idconsulta  
                    WHERE
                        tb_consulta.id_consulta = $id
                        AND tb_pagos.estado_pago = 'activo'";

}

function consulta_realizada_especifica($id){

    return $sql = "SELECT
                        * 
                    FROM
                        tb_consulta
                        INNER JOIN tb_preparar ON tb_consulta.id_expediente_preparado = tb_preparar.id_expe_preparado
                        INNER JOIN tb_expediente ON tb_preparar.idexpediente = tb_expediente.id_expediente
                        INNER JOIN tb_paciente ON tb_expediente.id_paciente = tb_paciente.id_paciente 
                    WHERE
                        tb_consulta.estado_consulta = 'realizada'
                        AND tb_consulta.id_consulta = $id";

}

function total_consulta_dia(){

    return $sql = "SELECT
                        tb_consulta.monto_consulta,
                        tb_consulta.fecha_consulta 
                    FROM
                        tb_consulta";

}