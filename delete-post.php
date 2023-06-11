<?php

session_start();
$conn   = mysqli_connect("localhost" , "root" ,"" ,"blog");


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE FROM posts WHERE id = $id";
    $result = mysqli_query($conn, $query);

    header("location: index.php");
}
