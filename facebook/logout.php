<?php
session_start();

session_unset();
session_destroy();

header("Location: login.php");
exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="libs/bootstrap.css">
        <link rel="shortcut icon" href="assets/image.png" type="image/x-icon">

</head>

<body>
    <?php
        include "partials/_nav.php";
    ?>
    <script src="libs/bootstrap.js"></script>
</body>

</html>