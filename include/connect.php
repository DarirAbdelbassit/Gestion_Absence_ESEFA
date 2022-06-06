<?php
$server = "127.0.0.1";
$user = "root";
$pass = "";
$database = "esefa";

try{
    $conn = mysqli_connect($server,$user,$pass,$database);
}
catch(mysqli_sql_exception $e){
    die("Unfortunately, no connection!");
}
?>