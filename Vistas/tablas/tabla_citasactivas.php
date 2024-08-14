<?php
session_start();
require_once("./../../Conexion/Conexion.php");

$sql = "SELECT ex.id_expediente as idex, ci.id_cita as id, pa.nombre_paciente as nombre, pa.apellido_paciente as apellido, pa.dui_paciente as dui, pa.tel_paciente as telefono, DATE_FORMAT(ci.fechahora_cita, '%d/%m/%Y') as fecha, DATE_FORMAT(ci.fechahora_cita, '%r') as hora, ci.estado_cita as estado, ci.preparada_cita as preparada  FROM `tb_cita` as ci, `tb_paciente` as pa, `tb_expediente` as ex WHERE ci.estado_cita = 'activa' AND ci.id_paciente = pa.id_paciente AND ex.id_paciente = pa.id_paciente ORDER BY ci.fechahora_cita;";
$comando = Conexion::getInstance()->getDb()->prepare($sql);
$comando->execute();
$result = $comando->fetchAll(PDO::FETCH_ASSOC);

if ($result) { ?>

    <table class="table" id="tabla_citas" style="min-width: 845px">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>DUI</th>
                <th>Telefono</th>
                <th>Fecha</th>
                <th>Hora</th>
                <!-- <th>Estado</th> -->
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">

            <?php foreach ($result as $row) { ?>

                <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                        <strong>
                            <?php echo $row['nombre'], ' ', $row['apellido']; ?>
                        </strong>
                    </td>
                    <td><?php echo $row['dui'] ?></td>
                    <td><?php echo $row['telefono'] ?></td>
                    <td><?php echo $row['fecha'] ?></td>
                    <td><?php echo $row['hora'] ?></td>
                    <!-- <td><?php echo $row['estado'] ?></td> -->
                    <td class="text-center">
                        <?php
                        if ($row['preparada'] == 0) { ?>
                            <button type="button" class="btn btn-sm rounded-pill btn-warning btn_preparar" data-bs-toggle="modal" data-bs-target="#preparar" data-dui='<?php echo $row['dui']; ?>' data-id='<?php echo $row['id']; ?>' data-idex='<?php echo $row['idex']; ?>' data-preparada='<?php echo $row['preparada']; ?>' data-toggle="tooltip">Preparar
                                <i class="tf-icons bx bx-body"></i>
                            </button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-sm rounded-pill btn-secondary btn_preparar" data-bs-toggle="modal" data-bs-target="#preparar" data-dui='<?php echo $row['dui']; ?>' data-id='<?php echo $row['id']; ?>' data-idex='<?php echo $row['idex']; ?>' data-preparada='<?php echo $row['preparada']; ?>' data-toggle="tooltip">Preparar
                                <i class="tf-icons bx bx-check"></i>
                            </button>
                        <?php } ?>
                        <button type="button" class="btn btn-sm rounded-pill btn-info btn_editar" data-bs-toggle="modal" data-bs-target="#nuevacita" data-nombre='<?php echo $row['nombre']; ?>' data-apellido='<?php echo $row['apellido']; ?>' data-dui='<?php echo $row['dui']; ?>' data-telefono='<?php echo $row['telefono']; ?>' data-id='<?php echo $row['id']; ?>' data-toggle="tooltip">Editar
                            <i class="tf-icons bx bx-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-sm rounded-pill btn-danger btn_inactivar" data-id='<?php echo $row['id']; ?>' data-toggle="tooltip">Inactivar
                            <i class="tf-icons bx bx-trash"></i>
                        </button>
                    </td>
                </tr>

            <?php } ?>

        </tbody>
    </table>

<?php } else {
    echo "No se encontraron registros";
} ?>