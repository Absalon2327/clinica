<?php
session_start();
require_once("./../../Conexion/Conexion.php");

$dui = (isset($_GET["dui"])) ? $_GET["dui"] : "";

$sql = "SELECT ci.id_cita as id, pa.nombre_paciente as nombre, pa.apellido_paciente as apellido, pa.dui_paciente as dui, pa.tel_paciente as telefono, DATE_FORMAT(ci.fechahora_cita, '%d/%m/%Y') as fecha, DATE_FORMAT(ci.fechahora_cita, '%r') as hora, ci.estado_cita as estado  FROM `tb_cita` as ci, `tb_paciente` as pa WHERE ci.estado_cita = 'inactiva' AND ci.id_paciente = pa.id_paciente AND pa.dui_paciente LIKE '%$dui%' ORDER BY ci.fechahora_cita;";
$comando = Conexion::getInstance()->getDb()->prepare($sql);
$comando->execute();
$result = $comando->fetchAll(PDO::FETCH_ASSOC);

if ($result) { ?>

    <table class="table" id="tabla_citasInactivas" style="min-width: 845px">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>DUI</th>
                <th>Telefono</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
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
                    <td><?php echo $row['estado'] ?></td>
                    <td class="text-center">

                        <button type="button" class="btn btn-sm rounded-pill btn-info btn_activar" data-id='<?php echo $row['id']; ?>' data-toggle="tooltip">Activar
                            <i class="tf-icons bx bx-sort-up"></i>
                        </button>
                    </td>
                </tr>

            <?php } ?>

        </tbody>
    </table>

<?php } else {
    echo "No se encontraron registros";
} ?>