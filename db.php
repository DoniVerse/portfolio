<?php
$host = 'localhost'; 
$db = 'portfolio_db'; 
$user = 'root'; 
$pass = '123'; 

$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>