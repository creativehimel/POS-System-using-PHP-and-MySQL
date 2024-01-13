<?php 
define("DB_HOST","localhost");
define("DB_USER","himel");
define("DB_PASS","admin@123");
define("DB_NAME","pos_system_php");

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$conn){
    die("Connection Failed: ". mysqli_connect_error());
}

?>