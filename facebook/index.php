<?php
    session_start();
    $name = $_SESSION['name'];
    $username = $_SESSION['username'];

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
        header("location: login.php");
        exit;
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome: <?php echo  $name; ?></title>
    <link rel="stylesheet" href="libs/bootstrap.css">
        <link rel="shortcut icon" href="assets/image.png" type="image/x-icon">
</head>

<body>
    <?php include "partials/_nav.php"; ?>

    <div class="container mt-4" >
                <?php 
                      echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
                                <strong> Welcome: $name </strong><br>
                                <p>Username: $username</p>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                            </div>";
                 ?>

                <?php
                   echo "<div class='alert alert-success alert-dismissible fade show'>
                                <strong>Suggested For You</strong><br>
                                <p>....</p>
                            </div>";
                ?>

                <?php
                   echo "<div class='alert alert-success alert-dismissible fade show'>
                                <strong>People You May Know</strong><br>
                                <p>....</p>
                            </div>";
                ?>

                <?php
                   echo "<div class='alert alert-success alert-dismissible fade show'>
                                <strong>People Also Search For</strong><br>
                                <p>....</p>
                            </div>";
                ?>
    </div>

    <script src="libs/bootstrap.js"></script>
</body>


</html>