<?php
    require_once("connection\connection.php");
    require_once("logger\logger.php");
    session_start();
    $connect = connection();
?>
<?php 
    // $project_name = "loggers";
    // $fecha_actual = date("YmdHis");
    // $ruta = dirname(__ LE__)."\\logs\\{$project_name}_{$fecha_actual}.log";
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
    <link rel="stylesheet" href="css/style.css">

    <title>vedruitter</title>
</head>
<body>
    <?php if(!isset($_SESSION["usuario"])):?>
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
        <!-- Sesion iniciada -->
        <main>
            <!-- Barra nav -->
            <div id="l-bar">
                
            </div>
            <!-- Publicaciones -->
            <div id="c-bar">
                
            </div>
            <!-- Menu movil -->
            <div id="m-bar">
                <div id="home">
                <svg viewBox="0 0 100 100" aria-hidden="true" class="r-1nao33i r-4qtqp9 r-yyyyoo r-lwhw9o r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-cnnz9e"><path d="M21.591 7.146L12.52 1.157c-.316-.21-.724-.21-1.04 0l-9.071 5.99c-.26.173-.409.456-.409.757v13.183c0 .502.418.913.929.913H9.14c.51 0 .929-.41.929-.913v-7.075h3.909v7.075c0 .502.417.913.928.913h6.165c.511 0 .929-.41.929-.913V7.904c0-.301-.158-.584-.408-.758z"/></svg>
                </div>
            </div>
            <!-- Recomendaciones -->
            <div id="r-bar">
                
            </div>
        </main>
        <!-- Sesion iniciada -->
    <?php else:?>
        <!-- 3) La página principal de la aplicación o timeline, a la que se accederá sólo cuando estés logueado. 
        En ella aparecerá la información de tu usuario así como un formulario para escribir un nuevo tweet y los tweets 
        de las personas que sigues. Deberá aparecer una opción para mostrar los tweets de todo el mundo lo sigas o no. 
        El nombre de cada usuario en el tweet debe ser un enlace que te lleve a la página perfil del usuario. 
        También debe aparecer un enlace para cerrar sesión. -->
        <?php
        var_dump($_SESSION["userData"]);
        ?>

        <div class="container mt-5">
            <!-- Datos usuario -->
            <?= "Hola ".$_SESSION["userData"]["username"];?>
            <?= $_SESSION["userData"]["email"];?>
            <a href="login/logout.php" class="m-3 btn btn-primary">Logout</a>
            <!-- Datos usuario -->
            <!-- Escribir twit -->
            <form action="index.php" method="POST">
                <div class="form-group">
                    <label for="publicacion"></label>
                    <input type="text" class="form-control" id="publicacion" name="publicacion" placeholder="¡¿Que está pasando?!"
                    required/>
                </div>
                <input id="sendBttn" class="m-3 btn btn-primary" type="submit" value="Vedrunear" name="Vedrunear"/>
            </form>
            <?php
            if(isset($_POST["Vedrunear"])){
                echo "post mandado";
                $name = $_SESSION["userData"]["username"];
                $sql = "SELECT id FROM users WHERE username = '$name'";
                $res = mysqli_query($connect, $sql);
                $res = mysqli_fetch_assoc($res);
                $_SESSION["userData"]["id"] = $res["id"];
                var_dump($_SESSION["userData"]);

                $id = $_SESSION["userData"]["id"];
                $text = $_POST["publicacion"];
                $sql = "INSERT INTO publications VALUES (0, $id, '$text', CURDATE())";
                $res = mysqli_query($connect, $sql);
                header("Location: index.php");
            }
            ?>
            <!-- Escribir twit -->
            <!-- Mostrar tweet seguidos o todos -->
            <div>
                <button id="seguidosB" onclick="toggleContent('seguidos')" class="m-3 btn btn-primary">Seguidos</button>
                <button id="todosB" onclick="toggleContent('todos')" class="m-3 btn btn-primary">Todos  </button>

            </div>
            <script>
                function toggleContent( n ) {
                    const divSeguidos = document.getElementById('seguidos');
                    const divTodos = document.getElementById('todos');

                    if (n === 'seguidos') {
                        divSeguidos.style.display = 'block';
                        divTodos.style.display = 'none';
                    } else {
                        divSeguidos.style.display = 'none';
                        divTodos.style.display = 'block';
                            }
                }
            </script>
            <div id="seguidos" style="display: none;">
                <?php
                    // Contenido PHP que quieres mostrar u ocultar
                    echo "¡Este es el contenido que se muestra seguidos!";
                    $id = $_SESSION["userData"]["id"];
                    $sql = "SELECT * FROM publications WHERE userId = (SELECT userToFollowId FROM follows WHERE users_id = $id)";
                    $res = mysqli_query($connect, $sql);
                ?>
                <?php while ($row = mysqli_fetch_array($res)): ?>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['userId'] ?></h5>
                        <p class="card-text"><?= $row['text'] ?></p>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <div id="todos" style="display: none;">
                <?php
                    // Contenido PHP que quieres mostrar u ocultar
                    echo "¡Este es el contenido que se muestra todo!";
                    $sql = "SELECT * FROM publications AS pu JOIN users AS us ON pu.userId = us.id";
                    $res = mysqli_query($connect, $sql);
                    #var_dump(mysqli_fetch_assoc($res));
                ?>
                <?php while ($row = mysqli_fetch_array($res)): ?>
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['userId'] ?><a href=""><?= $row['username'] ?></a></h5>
                            <p class="card-text"><?= $row['text'] ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php
            // var_dump($_POST);
            // $connect = connection();
            // $sql = "SELECT * FROM users WHERE email = '$email'";
            // $res = mysqli_query($connect, $sql);
            ?>
        </div>
    <?php endif ?>
</body>
</html>