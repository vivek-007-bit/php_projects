<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "usersDB";

//connect the server
$conn = mysqli_connect($servername, $username, $password, $database);

//die if connection is not successfull
if (!$conn) {
    die("Sorry we failed to connect: " .mysqli_connect_error());
}
?>


