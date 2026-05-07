<?php

$hostname = getenv("hostname");
$username   = getenv("username");
$password   = getenv("password");
$database   = getenv("database");
$port       = getenv("port");

$conn = mysqli_connect($hostname, $username, $password, $database, $port);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
