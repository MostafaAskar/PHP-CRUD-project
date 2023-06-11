<?php
require_once('../functions.php');
$conn = mysqli_connect( "localhost" , "root" ,"","blog");
header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    
    $query = "DELETE FROM posts WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if($result){
        echo json_encode("post deleted successfully");
    }else{
        RenderError("failed to delet post" , 500);
        
    }
    
}else{
    RenderError("method not allowed " , 500);
}