<?php

$ruta = './../../backups/';

if (is_dir($ruta)) {
    if ($aux = opendir($ruta)) { ?>

        <table class="table" id="tabla_respaldo" style="min-width: 845px">
            <thead class="table-dark">
                <tr>
                    <th>Respaldo</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                <?php while (($archivo = readdir($aux)) !== false) {
                    if ($archivo != "." && $archivo != "..") {
                        $nombrearchivo = str_replace(".sql", "", $archivo);
                        $nombrearchivo = str_replace("-", ":", $nombrearchivo);
                        $ruta_completa = $ruta . $archivo;
                        if (!is_dir($ruta_completa)) { ?>
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>
                                        <?php echo $nombrearchivo . ".sql"; ?>
                                    </strong>
                                </td>

                                <td class="text-center">
                                    <button type="button" class="btn btn-sm rounded-pill btn-success btn_restaurar" data-base='<?php echo $ruta_completa; ?>' data-toggle="tooltip">Restaurar
                                        <i class="tf-icons bx bx-data"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger btn_eliminar" data-base='<?php echo $ruta_completa; ?>' data-toggle="tooltip">Eliminar
                                        <i class="tf-icons bx bx-trash"></i>
                                    </button>
                                </td>
                            </tr>

                <?php }
                    }
                }
                ?>

            </tbody>
        </table>

<?php

    }
    closedir($aux);
}
?>