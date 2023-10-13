<?php
    require_once("connection\connection.php");
    require_once("logger\logger.php");
?>
<?php 
    // $project_name = "loggers";
    // $fecha_actual = date("YmdHis");
    // $ruta = dirname(__FILE__)."\\logs\\{$project_name}_{$fecha_actual}.log";
    // $edad = "23";
    // var_dump($ruta);
    // var_dump($edad);
    // if ($edad >= 18) {
    //     log_message("Es mayor de edad", "INFO", $ruta);
    // } else if ($edad >= 0) {
    //     log_message("No es mayor de edad", "WARNING", $ruta);
    // }  else {
    //     log_message("No existen edades negativas", "ERROR", $ruta);
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Trabajito del juaky">
    <meta name="keywords" content="twitter vedruna diversion mirada">
    <meta name="language" content="ES">
    <meta name="author" content="marcelo.herce@vedruna.es">
    <meta name="robots" content="index,follow">
    <meta name="revised" content="Tuesday, February 11th, 2023, 01:00pm">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE-edge, chrome1">

    <!-- Añado la fuente Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"
        defer></script>

    <title>vedruitter</title>
</head>
<body>
    <main>
        <div class="container mt-5">
            <form action="login/login.php" method="POST">
            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="username"
                required/>
            </div>
            <div class="form-group">
                <label for="mail">Mail</label>
                <input type="text" class="form-control" id="mail" name="mail" placeholder="mail"
                required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="ChameleonShirt1234" 
                required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
            </div>
            <input id="sendBttn" class="m-3 btn btn-primary" type="submit" value="Enviar" name="submit"/>
            <a href="register\register.php">¿No estas registrado?</a>
            </form>
        </div>
    </main>
</body>
</html>