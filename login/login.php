<?php
    require_once("..\connection\connection.php");
    require_once("..\logger\logger.php");
    #$ruta = dirname(__FILE__)."\\logs\\{$project_name}_{$fecha_actual}.log";
    $ruta ="..\\logs\\{$project_name}_{$fecha_actual}.log";
    $connect = connection();
    session_start();
    
    if(isset($_POST)){
        $email = trim($_POST["mail"]);
        $pass = $_POST["password"];
        log_message("POST recibido","INFO",$ruta);
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $res = mysqli_query($connect, $sql);
        if ($res && mysqli_num_rows($res) == 1) {
            $usuario = mysqli_fetch_assoc($res);
    
            if (password_verify($pass, $usuario["password"])) {
                $_SESSION["usuario"] = $usuario;
                $_SESSION["userData"] = $usuario;
                log_message("Login correcto","INFO",$ruta);
                header("Location: ../index.php");
            } else {
                $_SESSION["error_login"] = "Login incorrecto";
                log_message("Login incorrecto","ERROR",$ruta);
                header("Location: ../index.php");
            }
        } else {
            $_SESSION["error_login"] = "Login incorrecto";
            header("Location: ../index.php");
        }
    } else{

    }

?>