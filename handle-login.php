<?php 

session_start();
$conn   = mysqli_connect("localhost" , "root" ,"" ,"blog");

if(isset($_POST['submit'])){
    $email =trim(htmlspecialchars($_POST['email'])) ;
    $password =trim(htmlspecialchars($_POST['password'])) ;

}
// validation 

$errors = [];

if(empty($email)){
    $errors[]= " please enter your email";
}
elseif(! filter_var($email , FILTER_VALIDATE_EMAIL)){
    $errors[] = " email is not valid";
}
elseif(strlen($email )> 255){
    $errors[]= " email must be =>255 lenght";
}
if(empty($password)){
    $errors[]= " please enter your password";
}
elseif(! is_string($password)){
    $errors[] = " password must be string";
}



if(empty($errors)){
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn , $query);

    if(mysqli_num_rows($result) == 1){
       $user =  mysqli_fetch_assoc($result);
       $isLogin = password_verify($password , $user['password']);
       if($isLogin){
        $_SESSION['isLogin'] = true ;
        $_SESSION['userId'] = $user['id'] ;
        $_SESSION['userEmail'] = $user['email'];
        header("location: index.php");
       }else{
        $_SESSION['errors'] = ["credentials are not correct "] ;
        header("location: login.php");
       }
    }else{
        $_SESSION['errors'] = ["credentials are not correct "] ;
        header("location: login.php");
    }

}else{
    $_SESSION['errors'] = $errors ;
    header("location: login.php");
}