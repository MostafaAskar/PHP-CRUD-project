<?php 
session_start();
        $_SESSION['isLogin'] = false ;
        unset($_SESSION['userId']) ;
        unset ($_SESSION['userEmail']) ;
header('location: login.php');

