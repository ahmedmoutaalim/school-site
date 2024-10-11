<?php 
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'Db-AFAQ'; 

$connection = mysqli_connect($server, $username, $password, $database);
$connectionobj = new mysqli($server, $username, $password, $database);
?>