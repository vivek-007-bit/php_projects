<?php
session_start();
include "partials/_dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['userName'];
    $password = $_POST['password'];

    $sql = "SELECT name, username, password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $row['name'];
            $_SESSION['username'] = $row['username'];

            header("Location: /app/index.php");
            exit();
        } else {
            echo "Invalid Credentials";
        }

    } else {
        echo "Invalid Credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diary | Online Secured Journaling App</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="shortcut icon" href="/diary-app/assets/favicon.png" type="image/x-icon">

</head>

<body>
<?php include "partials/_nav.php"; ?>
    <div class="box">
        <form action="#" method="post" class="form" id="loginForm">
            <h1>Login</h1>
            <label for="userName">UserName
                <input type="text" name="userName" id="userName" placeholder="Type your Username" required>
            </label>
            <label for="password">Password
                <input type="Password" name="password" id="password" placeholder="Type your Password"
                    required>
            </label>
            <button class="btn" type="submit">Login</button>
            <label class="form-end">
                Don't have an account? <a href="signup.php">Sign Up</a>
            </label>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</body>


</html>
