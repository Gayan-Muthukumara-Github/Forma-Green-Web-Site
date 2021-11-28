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
        foreach($log_query_run as $row)
        {
            $member_id = $row['member_id'];
            $member_name = $row['member_name'];
            $email = $row['email'];
            $phone_phone = $row['phone_number'];
            $uType_ID = $row['uType_ID'];
        } 

        $_SESSION['auth'] = "$uType_ID";
        $_SESSION['auth_user'] = [
            'member_id' =>$member_id,
            'member_name' =>$member_name,
            'email' =>$email,
            'phone' =>$phone
        ];
        $_SESSION['status'] = "Logged In Successfully";
        header('Location: index.php');

    }
    else
    {
        $_SESSION['status'] = "Invalid Email of password";
        header('Location: login.php');
    }

    
}
else
{
    $_SESSION['status'] = "Access Denied";
    header('Location: login.php');
}
