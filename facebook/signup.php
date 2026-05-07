<?php
include "partials/_dbconnect.php";

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
    <title>SignUp</title>
    <link rel="stylesheet" href="libs/bootstrap.css">
    <link rel="shortcut icon" href="assets/image.png" type="image/x-icon">
</head>

<body>
    <?php
        include "partials/_nav.php";    
    ?>
    <div class="container" style="width: 450px; max-width: 100vw; margin-top: 100px;">
        <form class="border border-dark my-5 rounded p-5" method="post">
            <h1 class="mb-4 text-center fw-bold">Sign Up</h1>
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
    <script src="libs/bootstrap.js"></script>
</body>

</html>