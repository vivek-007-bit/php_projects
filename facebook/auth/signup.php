<?php
    include "../config/db_connect.php";
    
    $showErr = false;
    $error = " ";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Input fields
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_Password = $_POST['cpassword'];

        // Check password match
        if ($password == $confirm_Password) {

            // Check if username already exists
            $existsSql = "SELECT * FROM users WHERE username='$username'";
            $result = mysqli_query($conn, $existsSql);
            $numExistsRows = mysqli_num_rows($result);

            if ($numExistsRows > 0) {
                $showErr = true;
                $error = "Username Already Exists";
            } else {

                // Hash password
                $hash = password_hash($password, PASSWORD_DEFAULT);

                // Insert user
                $sql = "INSERT INTO users (name, username, password, created_at)
                        VALUES ('$name', '$username', '$hash', CURRENT_TIMESTAMP)";

                if (mysqli_query($conn, $sql)) {
                    $showErr = true;
                    $error = "Signup Successful Now You Can Login ";
                } else {
                    $showErr = true;
                    $error = "Error inserting user";
                }
            }

        } else {
            $error = "Passwords Didn't Match";
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
    <title>Signup</title>
</head>

<body style="background-color:rgba(0, 115, 255, 0.75);">
    <div class="container" style="width: 450px; max-width: 100vw; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <form class="border border-dark my-5 rounded p-5" method="post" style="background-color: #ffffff;">
        <h1 class="mb-4 text-center fw-bold" style="display: flex; justify-content: center; align-items: center; gap: 10px">
             <img src="../fav-icon.png" style="height: 33px; width: 33px">
                Sign Up
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
                <label for="username" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" required>
                <div class="form-text">Make sure you type the same password.</div>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Sign Up</button>
            <div class="mb-3">
                <div class="form-text fs-6">
                    Already Have An Account?
                    <a href="login.php" class="link-primary fw-semibold text-decoration-none">
                        Login
                    </a>
                </div>
            </div>
        </form>
    </div>
    <script src="../app/assets/libs/bootstrap.js"></script>
</body>

</html>