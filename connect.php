<?php

$servername = "localhost";
$username = "root";
$password = "root";
$database = "ornet";

$conn = mysqli_connect($servername,$username,$password,$database);

if($conn){
    echo "";
}else{
    die(mysqli_error($conn));
}
?>