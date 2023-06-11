<?php
session_start();
$conn   = mysqli_connect("localhost" , "root" ,"" ,"blog");

if(isset($_POST['submit'])){
    $title =trim(htmlspecialchars($_POST['title'])) ;
    $body =trim(htmlspecialchars($_POST['body'])) ;

}
// validation 

$errors = [];

if(empty($title)){
    $errors[]= " please enter your title";
}
elseif(! is_string($title)){
    $errors[] = " title must be string";
}
elseif(strlen($title )> 255){
    $errors[]= " title must be =>255 lenght";
}
if(empty($body)){
    $errors[]= " please enter your body";
}
elseif(! is_string($body)){
    $errors[] = " body must be string";
}




if(empty($errors)){
        // insert to db 
        $query = "INSERT INTO posts (title , body , user_id) VALUES ('$title' , '$body' ,10)" ;
        $result = mysqli_query($conn , $query);
        
        if($result){
            header('location: index.php');
        }else{
            
        $_SESSION['errors']= ["error occured ,please try again"];
        header("location: create-post.php");
        }
}
else{
         $_SESSION['errors'] = $errors;
         header('location: create-post.php');
    }
