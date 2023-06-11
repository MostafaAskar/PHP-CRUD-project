<?php
require_once('../functions.php');

$conn = mysqli_connect( "localhost" , "root" ,"","blog");
header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = trim(htmlspecialchars($_POST['title']));
    $body = trim(htmlspecialchars($_POST['body']));

    // validation 

$errors = [];
//title
if(empty($title)){
    $errors[]= " please enter your title";
}
elseif(! is_string($title)){
    $errors[] = " title must be string";
}
elseif(strlen($title )> 255){
    $errors[]= " title must be =>255 lenght";
}
//body
if(empty($body)){
    $errors[]= " please enter your body";
}
elseif(! is_string($body)){
    $errors[] = " body must be string";
}


    if(empty($errors)){
        $query = "INSERT INTO posts (title , body , user_id) VALUES ('$title' , '$body' , 10)" ;
        $result = mysqli_query($conn , $query) ;
        
        switch($result){
            case true: echo "post stored successfully";break;
            case false: echo "failed to store post" ; break;
        }


        // if($result){
        //     echo json_encode("post stored successfully");
        // }else{
        //     RenderError("failed to store post" , 500);
            
        // }
        

    }else{
        $errorsJson = json_encode($errors);
        echo $errorsJson ;
        }


}else{
    RenderError("method not allowed" , 405);
}
