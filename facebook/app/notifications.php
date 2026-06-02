<?php
     
     session_start();

     include "../config/db_connect.php";

     $name = $_SESSION['name'];
     $username = $_SESSION['username'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../fav-icon.png" type="image">
    <link rel="stylesheet" href="../app/assets/libs/bootstrap.css">
    <title>Notifications:
        <?php echo  $username;?>
    </title>
</head>

<body>
    <?php include "api/navbar.php"; ?>


    <script src="../app/assets/libs/bootstrap.js"></script>
</body>

</html>