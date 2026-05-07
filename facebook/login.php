<?php

include "partials/_dbconnect.php";
$showErr = false;
$error = " ";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT name, username, password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $row['name'];
            $_SESSION['username'] = $row['username'];

            header("Location: index.php");
            exit();

        } else {
            $showErr = true;
            $error = "Invalid Credentials";
        }
    } else {
        $showErr = true;
        $error = "Invalid Credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="libs/bootstrap.css">
    <link rel="shortcut icon" href="assets/image.png" type="image/x-icon">

</head>

<body>
    <?php
        include "partials/_nav.php";
    ?>
    <div class="container" style="width: 450px; max-width: 100vw; margin-top: 100px;">
        <form class="border border-dark my-5 rounded p-5" method="post">
            <h1 class="mb-4 text-center fw-bold">Login</h1>

        <?php if ($showErr): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><?php echo $error; ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-check my-3">
                <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember Me?
                </label>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Login</button>
            <div class="mb-3">
                <div class="form-text fs-6">
                    New to Facebook?
                    <a href="signup.php" class="link-primary fw-semibold text-decoration-none">
                        Sign Up
                    </a>
                </div>
            </div>

        </form>
    </div>
    <script src="libs/bootstrap.js"></script>
</body>

</html>