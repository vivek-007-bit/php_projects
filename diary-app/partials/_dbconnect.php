<?php
$servername = getenv("DB_HOST");
$username   = getenv("DB_USER");
$password   = getenv("DB_PASS");
$database   = getenv("DB_NAME");
$port       = getenv("DB_PORT");

$conn = mysqli_connect($servername, $username, $password, $database, $port);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
