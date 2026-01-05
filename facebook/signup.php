<?php
$ShowAlert = false;
$showError = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        include "partials/_dbconnect.php";

        $name = $_POST["name"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        //$exists = false;


        //check whether this username exists
        $existsSql = "Select * from users where username='$username'";

        $result = mysqli_query($conn, $existsSql);
        $numExistsRows = mysqli_num_rows($result);

        if ($numExistsRows > 0 ) {
            //$exists = true;
             $showError = "UserName Already Exists";
             
        }else {
            //$exists = false;
                if (($password == $cpassword)) {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `users` (`full_Name`, `username`, `password`, `tstamp`) VALUES ('$name', '$username', '$hash', current_timestamp())";
                    $result = mysqli_query($conn, $sql);

                    if ($result ) {
                        $ShowAlert = true;   
                    }
                }
                else{
                    $showError = "Passwords do not match";
                }
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

    <?php
        if ($ShowAlert) {
                 echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                      <strong>Sign up was successful</strong> <a class='link-info' href='login.php'>Click here to login</a> 
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
    <div class="err-msg"></div>
    <div class="container" style="width: 450px; max-width: 100vw;">
        <form class="border border-dark my-5 rounded p-5" method="post">
            <h1 class="mb-4 text-center fw-bold">Sign Up</h1>
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