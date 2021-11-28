<?php

$host ="localhost";
$username ="root";
$password = "";
$database = "member_db";

//Connection
$con = mysqli_connect("$host","$username","$password","$database");

// Check connection
if(!$con)
{
    header("Location: ../errors/db.php");
    die();
}
else
{
    echo "";
}
?>