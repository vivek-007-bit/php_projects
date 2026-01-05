<?php

$login = false;
$showError = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        include "partials/_dbconnect.php";

        $name = $_POST["name"];
        $username = $_POST["username"];
        $password = $_POST["password"];

            $sql = "Select * from users where username='$username'";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);

            if ($num == 1) {
                while($row = mysqli_fetch_assoc($result)){
                    if (password_verify($password, $row['password'])) {
                        $login = true;
                        session_start();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['name'] = $name;
                        $_SESSION['username'] = $username;
                        header("location: index.php");    
                    }
                }
            
            }

          else{
            $showError = "Invalid Credentials";
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

    <?php
        if ($login) {
                 echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                      <strong>Login successful</strong>
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                    </div>";
                  }

        if ($showError) {
                      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error: </strong> $showError
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                    </div>";
            }
    ?>
    <div class="container" style="width: 450px; max-width: 100vw;">
        <form class="border border-dark my-5 rounded p-5" method="post">
            <h1 class="mb-4 text-center fw-bold">Login</h1>
            <div class="mb-3">
                <label for="username" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-text fs-6">
                <a href="forgetPassword.php" class="link-primary fw-semibold text-decoration-none">
                    Forget Password?
                    </a>
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