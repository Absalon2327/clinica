<?php
@session_start();
require_once '../Conexion/Conexion.php';
/**
 *
 */
class Modelo
{

    function __construct()
    {
        # code...
    }

    public static function insertar_datos($array_values)
    {
        $tabla = "";
        $elcodigo = "";
        $values = "";
        $llaves = "";
        $as = 0;
        foreach (array_keys($array_values) as $key) {
            $as++;
            if ($key === 'table') {
                $tabla = $array_values[$key];
            }
            if ($as > 1) {
                $llaves .= $key;
                $values .= "'" . $array_values[$key] . "'";
                if ($as < count($array_values)) {
                    $values .= ",";
                    $llaves .= ",";
                }
            }
            if ($key === 'codigo') {
                $elcodigo = $array_values[$key];
            }
        }
        $sql = "INSERT INTO $tabla($llaves)values($values)";;
        try {
            $comando = Conexion::getInstance()->getDb()->prepare($sql);
            $comando->execute();
            $cuantos = $comando->rowCount();
            return array("1", $elcodigo, "Insertado", $sql, $cuantos);
        } catch (Exception $e) {
            return array("0", "error", $e->getMessage(), $e->getLine(), $sql);
        }
    }


    public static function get_query($query, $tipo = "")
    {
        $sql = $query;
        try {
            $comando = Conexion::getInstance()->getDb()->prepare($sql);
            $comando->execute();
            if ($tipo == "") {
                $result = $comando->fetchAll(PDO::FETCH_ASSOC);
            }
            $cuantos = $comando->rowCount();
            return array(1, "exito", $result, $query, $cuantos);
        } catch (Exception $e) {
            return array(-1, "error", $e->getMessage(), $sql);
        }
    }

    public static function get_todos($tabla, $where = "")
    {
        $sql = "SELECT * FROM $tabla $where";
        try {
            $comando = Conexion::getInstance()->getDb()->prepare($sql);
            $comando->execute();
            $result = $comando->fetchAll(PDO::FETCH_ASSOC);
            $cuantos = $comando->rowCount();
            return array(1, "exito", $result, "", $cuantos);
        } catch (Exception $e) {
            return array(-1, "error", $e->getMessage(), $sql);
        }
    }

    //insert into table ()values()
    //update table set campo = value()
    public static function actualizar_generica($array_values)
    {
        //preparo variables
        $tabla = "";
        $elcodigo = "";
        $wherid = "";
        $valor_whereid = "";
        $values = "";
        $llaves = "";
        $sentencia_update = "";
        $as = 0;
        $agregando_as = "";
        foreach (array_keys($array_values) as $key) { //recorro el array que me envia mi json
            $as++;
            if ($key === 'table') { //obtengo tabla
                $tabla = $array_values[$key];
            } else if ($as === 2) { //obtengo id para update
                $valor_whereid = $array_values[$key];
                $wherid = $key;
            } else if ($as > 2) { //creo los set
                $llaves .= $key;
                $values .= "'" . $array_values[$key] . "'";
                $sentencia_update .= $key . '=' . "'" . $array_values[$key] . "'";
                if ($as < count($array_values)) {
                    $values .= ",";
                    $llaves .= ",";
                    $sentencia_update .= ',';
                }
                $agregando_as .= $as;
            }
            if ($key === 'codigo') {
                $elcodigo = $array_values[$key];
            }
        }

        $sql = "UPDATE $tabla SET $sentencia_update WHERE $wherid = '$valor_whereid'"; //String de update creada
        /*return array("1","2",$sql,$as,$agregando_as);
	 		exit();*/
        try {
            $comando = Conexion::getInstance()->getDb()->prepare($sql); //ejecutro la actualización
            $comando->execute();
            $cuantos = $comando->rowCount();
            return array("1", $elcodigo, array("Actualizado", $sql), "", $cuantos); //retorno en caso de exito
            //echo json_encode(array("exito" => $exito));
        } catch (Exception $e) {
            return array("0", "Error al actualizar", $e->getMessage(), $e->getLine(), $sql); //retorno mensajes en caso de error
        }
    }
}
