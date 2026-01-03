<?php
include "partials/_dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Input fields
    $name = $_POST['name'];
    $username = $_POST['userName'];
    $password = $_POST['password'];
    $confirm_Password = $_POST['confirm_password'];

    // Check password match
    if ($password == $confirm_Password) {

        // Check if username already exists
        $existsSql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $existsSql);
        $numExistsRows = mysqli_num_rows($result);

        if ($numExistsRows > 0) {
            echo "Username Already Exists";
        } else {

            // Hash password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // Insert user
            $sql = "INSERT INTO users (name, username, password, created_at)
                    VALUES ('$name', '$username', '$hash', CURRENT_TIMESTAMP)";

            if (mysqli_query($conn, $sql)) {
                echo 'Signup Successful You can login to continue <a href="login.php">Login</a>';
            } else {
                echo "Error inserting user";
            }
        }

    } else {
        echo "Passwords Didn't Match";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" href="/diary-app/css/style.css">
    <link rel="stylesheet" href="/diary-app/css/responsive.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="shortcut icon" href="/diary-app/assets/favicon.png" type="image/x-icon">


</head>

<body>
<?php include "partials/_nav.php"; ?>
    <div class="box">
        <form action="#" method="post" class="form" id="signupForm">
            <h1>Sign Up</h1>
            <label for="name">Name
                <input type="text" name="name" id="name" placeholder="Enter your name" required>
            </label>

            <label for="UserName">UserName
                <input type="text" name="userName" id="userName" placeholder="Choose a username" required>
            </label>

            <label for="Password">Password
                <input type="Password" name="password" id="password" placeholder="Enter password" required>
            </label>

            <label for="confirm_password">Confirm Password
                <input type="Password" name="confirm_password" id="confirm_password" placeholder="Re-Enter password"
                    required>
            </label>

            <button class="btn" type="submit">Sign Up</button>
            <label class="form-end">
                Already have an account? <a href="login.php">Login</a>
            </label>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</body>

</html>