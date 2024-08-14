<?php
@session_start();
include_once("../Modelo/Modelo.php");
$modelo = new Modelo();
if (isset($_POST['iniciar_sesion']) && $_POST['iniciar_sesion'] == "si_nueva") {

    $_SESSION['intentos'] = (isset($_SESSION['intentos'])) ? "" : 0;
    if ($_SESSION['intentos'] == 3) {
        $_SESSION['hora_bloqueo'] = date("Y-m-d G:i:s");
        print json_encode("Bloqueo");
    } else {
        $sql = "SELECT * FROM tb_usuario as t WHERE t.usuario='$_POST[usuariologin]'";

        $resultado = $modelo->get_query($sql);
        if ($resultado[0] == 1 && $resultado[4] == 1) {
            $verificacion = $modelo->desencrilas_contrasena($_POST['contraseña_login'], $resultado[2][0]['contrasena']);
            if ($verificacion[0] === 1) {
                $_SESSION['logueado'] = "si";
                $_SESSION['bloquear_pantalla'] = "no";
                $_SESSION['nombre'] = $resultado[2][0]['nombre'];
                $_SESSION['tipof'] = $resultado[2][0]['tipo'];
                $_SESSION['usuario'] = $resultado[2][0]['usuario'];
                $array = array("Exito", "Bienvenido al sistema " . $resultado[2][0]['nombre'], $resultado, $_SESSION);
                print json_encode($array);
                
            } else {
                $_SESSION['intentos']++;
                $array = array("Error", "La contraseña no coincide", $resultado, $_SESSION);
                print json_encode($array);
            }
        } else {
            $array = array("Error", "Datos no existen", $resultado);
            print json_encode($array);
        }
    }
}else if (isset($_POST['validando_dui']) && $_POST['validando_dui']=="si_validalo") {

    $resultado = $modelo->get_todos("tb_usuario","WHERE dui='".$_POST['dui']."'");
    if($resultado[0]=='1' && $resultado[1]>0){
        print json_encode(array("Exito",$_POST,$resultado[2][0]['idusuario'],$resultado,$resultado[2][0]));
        exit();

    }else {
        print json_encode(array("Error",$_POST,$resultado));
        exit();
    }

} 
else if (isset($_POST['validar_nuevo_pass']) && $_POST['validar_nuevo_pass']=="si_actualizalo") {

    $array_update = array(
        "table" => "tb_usuario",
        "idusuario" => $_POST['id_persona'],
        "contrasena"=>$modelo->encriptarlas_contrasenas($_POST['contrasena']),
         
    );
    $resultado = $modelo->actualizar_generica($array_update);

    if($resultado[0]=='1' && $resultado[4]>0){
        print json_encode(array("Exito",$_POST,$resultado));
        exit();

    }else {
        print json_encode(array("Error",$_POST,$resultado));
        exit();
    }



}
else if (isset($_POST['desbloquear']) && $_POST['desbloquear'] == "si_con_contrasena") {
    $sql = "SELECT * from tb_usuario where usuario = '$_SESSION[usuario]'";
    $resultado = $modelo->get_query($sql);
    if ($resultado[0] == 1 && $resultado[4] == 1) {
        $verificacion = $modelo->desencrilas_contrasena($_POST['contraseña_bloq'], $resultado[2][0]['contrasena']);
        if ($verificacion[0] === 1) {
            $array = array("Exito", "Bienvenido nuevamente " . $resultado[2][0]['nombre'], $resultado);
            $_SESSION['logueado'] = "si";
            $_SESSION['bloquear_pantalla'] = "no";
            print json_encode($array);
        } else {
            $array = array("Error", "La contraseña no coincide", $resultado);
            print json_encode($array);
        }
    } else {
        $array = array("Error", "Datos no existen", $resultado);
        print json_encode($array);
    }
} else {
    print json_encode(array("Error", "No entro a ningun if"));
}
