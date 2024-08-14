<?php
session_start();
require_once("./../../Conexion/Conexion.php");

/* $fecha = (isset($_GET["fecha"])) ? $_GET["fecha"] : "";
$dui = (isset($_GET["dui"])) ? $_GET["dui"] : "";
 */
$sql = "SELECT id_paciente as id, CONCAT(nombre_paciente,' ', apellido_paciente) as nombre, sexo_paciente as sexo, estado_paciente as estado FROM `tb_paciente` WHERE estado_paciente = 'activo';";
$comando = Conexion::getInstance()->getDb()->prepare($sql);
$comando->execute();
$result = $comando->fetchAll(PDO::FETCH_ASSOC);

if ($result) { ?>

    <table class="table" id="tabla_pacientes" style="min-width: 845px">
        <thead class="table-dark">
            <th>ID</th>
            <th>Nombre</th>
            <th>Sexo</th>
            <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">

            <?php foreach ($result as $row) { ?>

                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                        <strong>
                            <?php echo $row['nombre']; ?>
                        </strong>
                    </td>
                    <td><?php echo $row['sexo'] ?></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm rounded-pill btn-warning btn_preparar" data-bs-toggle="modal" data-bs-target="#preparar" data-dui='<?php echo $row['dui']; ?>' data-id='<?php echo $row['id']; ?>' data-idex='<?php echo $row['idex']; ?>' data-preparada='<?php echo $row['preparada']; ?>' data-toggle="tooltip">Preparar
                            <i class="tf-icons bx bx-body"></i>
                        </button>
                    </td>
                </tr>

            <?php } ?>

        </tbody>
    </table>

<?php } else {
    echo "No se encontraron registros";
} ?>