<?php
require_once("./../../Conexion/Conexion.php");


if (isset($_POST['action']) && $_POST['action'] == "restaurar" &&  $_POST['database'] != "") {
	$restorePoint = SGBD::limpiarCadena($_POST['database']);
	$sql = explode(";", file_get_contents($restorePoint));
	$totalErrors = 0;
	set_time_limit(60);
	$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
	$con->query("SET FOREIGN_KEY_CHECKS=0");
	for ($i = 0; $i < (count($sql) - 1); $i++) {
		if ($con->query($sql[$i] . ";")) {
		} else {
			$totalErrors++;
		}
	}
	$con->query("SET FOREIGN_KEY_CHECKS=1");
	$con->close();
	if ($totalErrors <= 0) {
		print json_encode(array("Exito"));
		exit();
	} else {
		print json_encode(array("Error"));
		exit();
	}
}

if (isset($_POST['action']) && $_POST['action'] == "eliminar" &&  $_POST['database'] != "") {
	if (unlink($_POST['database'])) {
		print json_encode(array("Exito"));
		exit();
	} else {
		print json_encode(array("Error"));
		exit();
	}
}
