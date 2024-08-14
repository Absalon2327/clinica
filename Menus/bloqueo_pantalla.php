<?php
    @session_start();
    date_default_timezone_set('America/El_Salvador');
    
    if (isset($_SESSION['logueado']) && $_SESSION['logueado'] == "si") {
        if ($_SESSION['bloquear_pantalla'] == "no") {
            // code...

        } else {

            header("Location: ../usuarios/v_bloquear_pantalla.php");
        }
    } else {
        header("Location:../../index.php");
    }
    ?>