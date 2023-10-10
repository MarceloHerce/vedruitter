<?php
    require_once("connection/connection.php");
    require_once("logger/logger.php");
?>
<?php 
    $project_name = "loggers";
    $fecha_actual = date("YmdHis");
    $ruta = dirname(__FILE__)."\\logs\\{$project_name}_{$fecha_actual}.log";

    echo "hola";
    $edad = "23";
    var_dump($ruta);
    var_dump($edad);
    if ($edad >= 18) {
        log_message("Es mayor de edad", "INFO", $ruta);
    } else if ($edad >= 0) {
        log_message("No es mayor de edad", "WARNING", $ruta);
    }  else {
        log_message("No existen edades negativas", "ERROR", $ruta);
    }
?>