<?php
require_once("..\connection\connection.php");
require_once("..\logger\logger.php");
session_start();
$connect = connection();
if(isset($_POST["description"])){
    $username = $_SESSION["userData"]["username"];
    $des = $_POST["description"];
    $sql = "UPDATE users SET description = '$des' WHERE username='$username';";
    $res = mysqli_query($connect, $sql);
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"
        defer></script>
    <title>Modificar descripcion</title>
</head>
<body>
    <form action="modDes.php" method="POST">
        <div class="form-group">
            <label for="description"></label>
            <input type="text" class="form-control" id="description" name="description" 
            placeholder="<?= $_SESSION["userData"]["description"] ;?>"
            required/>
        </div>
        <input id="sendBttn" class="m-3 btn btn-primary" type="submit" value="Vedrunear" name="Vedrunear"/>
    </form>
</body>
</html>