<?php
require_once('../functions.php');

$conn = mysqli_connect("localhost" , "root" ,"","blog");
header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id']) && $_GET['id'] != '' ){
        $id = $_GET['id'];


        $query = "SELECT * FROM posts WHERE id =$id ";
        $result = mysqli_query($conn ,$query );


        if(mysqli_num_rows($result)!= 0){
            $post = mysqli_fetch_assoc($result);
            $postJson = json_encode($post);
    
            echo $postJson;
        }else{
            RenderError("Not found" , 404);
        }
    
    }


}else{
    RenderError("method not allowed" , 405);
    
}





