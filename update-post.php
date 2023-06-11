<?php
session_start();
$conn   = mysqli_connect("localhost" , "root" ,"" ,"blog");


// prepare
if(isset($_POST["submit"])){
    $id = $_POST['id'];
    $title =trim(htmlspecialchars($_POST['title']));
    $body =trim(htmlspecialchars($_POST['body']));
}

$errors = [];
 
//validation
//valid title
if(empty($title)){
    $errors[]= " please enter your title";
}
elseif(!is_string($title)){
    $errors[] = " title must be string";
}
elseif(strlen($title )> 255){
    $errors[]= " title must be =>255 lenght";
}

//valid body
if(empty($body)){
    $errors[]= " please enter your body";
}
elseif(!is_string($body)){
    $errors[] = " body must be string";
}

// update query in db 
if(empty($errors)){
$query = "UPDATE posts set title ='$title' , body = '$body' where id = $id ";
$result = mysqli_query($conn , $query);

if($result == 1){
    header('location: index.php');
}
else{
    $_SESSION['errors'] = ["error occured ,please try again"];
    header("location: edit-post.php?id=$id");
  
}

}
else{
  $_SESSION['errors'] = $errors;
  header("location: edit-post.php?id=$id");
}
