<?php

#navbar before login/Signup
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand mr-2" href="/facebook/index.php">
      <img src="assets/image.png" alt="Fb-logo" width="37" height="35">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class=" btn btn-outline-primary mx-2" aria-current="page" href="/facebook/index.php">
          Home
        </a>
        </li>
        
        <li class="nav-item">
            <a class="btn btn-outline-primary mx-2" href="/facebook/login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-primary mx-2" href="/facebook/signup.php">Sign Up</a>
          </li>
          
        </ul>
  </div>
</nav>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome:
    <?php echo  $name; ?>
  </title>
  <link rel="stylesheet" href="libs/bootstrap.css">
  <link rel="shortcut icon" href="assets/image.png" type="image/x-icon">
</head>

<body>

</body>


</html>