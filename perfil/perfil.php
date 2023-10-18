<?php
require_once("..\connection\connection.php");
require_once("..\logger\logger.php");
session_start();
$connect = connection();

if(isset($_GET["username"])){
    $username = $_GET["username"];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $res = mysqli_query($connect, $sql);
    $res = mysqli_fetch_assoc($res);
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
    <title>Perfil</title>
</head>
<body>
    <div>
        <h1 class="card-title"><?= $res['username'] ?></h1>
        <p class="card-text"><?= $res['description'] ?></p>
        <?php 
        $_SESSION["perfil"]["id"] =  $res['id'];
        $_SESSION["perfil"]["username"] =  $res['username'];
        ?>

        <?php if($_SESSION["userData"]["username"]!=$_SESSION["perfil"]["username"] 
        && !in_array("".$_SESSION["perfil"]["id"],$_SESSION["userData"]["follows"])):?>
            <a class="m-3 btn btn-primary" href="../crud/seguir.php?seguir=<?= $_SESSION["perfil"]["id"] ;?>">Seguir</a>
        <?php elseif(in_array("".$_SESSION["perfil"]["id"],$_SESSION["userData"]["follows"])): ?>
            <a class="m-3 btn btn-primary" href="../crud/seguir.php?unfollow=<?= $_SESSION["perfil"]["id"] ;?>">Dejar de seguir</a>
        <?php else:?>
            <a class="m-3 btn btn-primary" href="../crud/modDes.php" >Modificar</a>
            
        <?php endif ?>
    </div>
    <?php
    $id = $_SESSION["perfil"]["id"];
    $sql = "SELECT * FROM publications WHERE userId=$id";
    $res = mysqli_query($connect, $sql);
    ?>
    <?php while ($row = mysqli_fetch_array($res)): ?>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?= $_SESSION["perfil"]["username"] ?></h5>
            <p class="card-text"><?= $row['text'] ?></p>
            <p class="card-text"><?= $row['createDate'] ?></p>
        </div>
    </div>
    <?php endwhile; ?>
</body>
</html>