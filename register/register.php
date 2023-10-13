<?php 

if (isset($_POST["username"])) {
    require_once("../connection/connection.php");
    require_once("..\logger\logger.php");
    session_start();
    $connect = connection();
    //Recoger los datos
    $username = isset($_POST["username"]) ? mysqli_real_escape_string($connect, $_POST["username"]) : false;
    $mail = isset($_POST["mail"]) ? mysqli_real_escape_string($connect, trim($_POST["mail"])) : false;
    $pass = isset($_POST["password"]) ? mysqli_real_escape_string($connect, $_POST["password"]) : false;

    $arrayErrores = array();
    //Hacemos validadores necesarios
    if (!empty($username) && !is_numeric($username)) {
        $usernameValidado = true;
    } else {
        $usernameValidado = false;
        $arrayErrores["username"] = "El username no es valido";
    }

    if (!empty($mail) && filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $mailValidado = true;
    } else {
        $mailValidado = false;
        $arrayErrores["mail"] = "El mail no es valido";
    }

    if (!empty($pass)) {
        $passValidado = true;
    } else {
        $passValidado = false;
        $arrayErrores["password"] = "El password no es valido";
    }

    $guardarUsuario = false;
    if(count($arrayErrores) == 0) {
        $guardarUsuario = true;
        
        $passSegura = password_hash($pass, PASSWORD_BCRYPT, ["cost" => 4]);
        //password_verify($pass, $passSegura);

        $sql = "INSERT INTO users VALUES( 0,'$username', '$mail', '$passSegura','', CURDATE());";
        $guardar = mysqli_query($connect, $sql);

        if ($guardar) {
            $_SESSION["completado"] = "Registro completado";
        } else {
            $_SESSION["errores"]["general"] = "Fallo en el registro";
        }
    } else {
        $_SESSION["errores"] = $arrayErrores;
    }
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"
        defer></script>
    <title>Registro</title>
</head>
<body>
    <div class="container mt-5">
        <form action="register.php" method="POST">
        <div class="form-group">
            <label for="UserName">UserName</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="username"
            required/>
        </div>
        <div class="form-group">
            <label for="Mail">Mail</label>
            <input type="text" class="form-control" id="mail" name="mail" placeholder="mail"
            required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"/>
        </div>
        <div class="form-group">
            <label for="Password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="ChameleonShirt1234" 
            required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
        </div>
        <input id="sendBttn" class="m-3 btn btn-primary" type="submit" value="Enviar" name="submit"/>
        </form>
    </div>
</body>
</html>