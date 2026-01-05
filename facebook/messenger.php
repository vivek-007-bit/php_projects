<?php
    session_start();
    include "partials/_dbconnect.php";
    $user = $_SESSION['name'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger:
        <?php echo  $user ?>
    </title>
    <link rel="stylesheet" href="libs/bootstrap.css">
    <link rel="shortcut icon" href="assets/image.png" type="image/x-icon">
</head>

<body>
    <?php include "partials/_nav.php"; ?>
    <script src="libs/bootstrap.js"></script>
</body>
</html>
