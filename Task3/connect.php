<?php

$host = "localhost";
$user = "root";
$pass = "";
$db  = "simplylogin";

$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_error){
    echo "failed to connect!".$connect->connect_error;
}
?>