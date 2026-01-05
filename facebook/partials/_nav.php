<?php

    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true) {
        $loggedin = true;
    }
    else {
        $loggedin = false;
    }

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand mb-2" href="/facebook/index.php">
      <img src="assets/image.png" alt="Fb-logo" width="37" height="35">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class=" btn btn-outline-primary me-3 mb-2" aria-current="page" href="/facebook/index.php">Home</a>
        </li>';

if ($loggedin) {
    echo '<li class="nav-item">
            <a class="btn btn-outline-primary me-3 mb-2" href="/facebook/login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-primary me-3 mb-2" href="/facebook/signup.php">Sign Up</a>
          </li>';
}

if (!$loggedin) {
    echo '<li class="nav-item">
            <a class="btn btn-outline-primary me-3 mb-2" href="/facebook/myprofile.php">My Profile</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-primary mb-2" href="/facebook/messenger.php">Messenger</a>
          </li>';
}


echo '</ul>';


echo '<div class="d-flex ms-auto align-items-center">';
echo '<form class="d-flex me-2" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>';

if (!$loggedin) {
    echo '<a class="btn btn-outline-danger" href="/facebook/logout.php">Log Out</a>';
}

echo '</div>'; 

echo '</div>
  </div>
</nav>';
?>
