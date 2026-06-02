<?php
    include "../config/db_connect.php";

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

                header("Location: ../app/home.php");
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
    <link rel="shortcut icon" href="../fav-icon.png" type="image">
    <link rel="stylesheet" href="../app/assets/libs/bootstrap.css">
    <title>Login</title>
</head>

<body style="background-color:rgba(0, 115, 255, 0.75);">
    <div class="container" style="width: 450px; max-width: 100vw; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <form class="border border-dark my-5 rounded p-5" method="post" style="background-color: #ffffff;">
            <h1 class="mb-4 text-center fw-bold" style="display: flex; justify-content: center; align-items: center; gap: 10px">
             <img src="../fav-icon.png" style="height: 33px; width: 33px">
                Login
            </h1>

            <?php if ($showErr): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>
                    <?php echo $error; ?>
                </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
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
    <script src="../app/assets/libs/bootstrap.js"></script>
</body>

</html>