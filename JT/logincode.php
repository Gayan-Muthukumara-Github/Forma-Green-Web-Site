<?php
session_start();
include('config/dbcon.php');

if(isset($_POST['login_btn']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $log_query = "SELECT * FROM member WHERE email='$email' AND password='$password' LIMIT 1";
    $log_query_run = mysqli_query($con, $log_query);

    if(mysqli_num_rows($log_query_run) > 0)
    {
        $_SESSION['status'] = "Logged In Successfully";
        header('Location: index.php');
    }
    else
    {
        $_SESSION['status'] = "Invalid Email of password";
        header('Location: ../admin/login.php');
    }

    
}
else
{
    $_SESSION['status'] = "Access Denied";
    header('Location: ../admin/login.php');
}
