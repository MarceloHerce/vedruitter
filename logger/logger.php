<?php 
    $project_name = "loggers";
    $fecha_actual = date("YmdHis");
    $ruta = "logs\\{$project_name}_{$fecha_actual}.log";

    function log_message($message, $gravedad, $ruta) {
        error_log("[{$gravedad}]:".date("Y-m-d H:i:s").": ".print_r($message, true)."\n", 3, $ruta);
    }
    
    //Ejemplos
    // error_log(date("Y-m-d H:i:s").": Ejecutando la linea 5\n", 3, $ruta);
    // error_log(date("Y-m-d H:i:s").": Error en la linea 6\n", 3, $ruta);
    // echo "Logger";
    // log_message("Esto es un mensaje usando una funcion", "INFO", $ruta);
    // $array = ["Maria", "Marcelo", "Jouse"];
    // log_message($array, "INFO" ,$ruta);
?>