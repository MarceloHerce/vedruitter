<?php
require_once("..\connection\connection.php");
require_once("..\logger\logger.php");
session_start();
$connect = connection();

if(isset($_GET["seguir"]) && $_GET["seguir"]!=$_SESSION["userData"]["id"]){
    $idUser = $_SESSION["userData"]["id"];
    $idToFollow = $_GET["seguir"];
    $sql = "INSERT INTO follows VALUES ($idUser, $idToFollow)";
    $res = mysqli_query($connect, $sql);
    array_push($_SESSION["userData"]["follows"],$idToFollow);
    header("Location: ../index.php");
}
if(isset($_GET["unfollow"]) && $_GET["unfollow"]!=$_SESSION["userData"]["id"]){
    $idUser = $_SESSION["userData"]["id"];
    $idToFollow = $_GET["unfollow"];
    $sql = "DELETE FROM follows WHERE users_id=$idUser AND userToFollowId=$idToFollow";
    $posicion = array_search($idToFollow, $_SESSION["userData"]["follows"]);
    unset($_SESSION["userData"]["follows"][$posicion]);
    $res = mysqli_query($connect, $sql);
    header("Location: ../index.php");
}
?>